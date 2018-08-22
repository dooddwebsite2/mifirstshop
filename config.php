<?php

 /* 
    $dbhost = "localhost";
    $dbuser ="id6811427_mifirstshop";
    $dbpassword ="0145678911";
    $dbname ="id6811427_mifirstshop";
    */


/* db config */
$img_blog = $_SERVER["DOCUMENT_ROOT"]."/img/blog/";
$img_cate = "img/category/";

/* set date */
date_default_timezone_set("Asia/Bangkok");


/* DB Connection */
function db() {
    $dbhost = "localhost";
    $dbuser ="root";
    $dbpassword ="";
    $dbname ="mifirstshop";
    // Create connection
    $conn = new mysqli($dbhost,$dbuser, $dbpassword,$dbname);
    $conn->query("set names utf8");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }	
    return $conn;
}

function sendQuery($str)
{
    $conn = db();
    $results = mysqli_query($conn,$str);
    return $results;
}

function executeQuery($str)
{
    $connf = db();
    mysqli_query($connf,$str);
  
}
/* END db config */

/* GET PARENT CATEGORY */
function getCategory() {
    $QueryString = "SELECT * FROM category WHERE cate_active = 1 ORDER BY CONVERT (cate_name_th USING tis620);";
    $cateArrays = array();
    $resultStr = sendQuery($QueryString);
    $rowCount = 0;
    while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {
        ++ $rowCount;
        $cateArrays[$rowCount]['cate_id'] = empty($rows['cate_id'])?'-':$rows['cate_id'];                            
        $cateArrays[$rowCount]['cate_name_th'] = empty($rows['cate_name_th'])?'-':$rows['cate_name_th'];
        $cateArrays[$rowCount]['cate_name_en'] =  empty($rows['cate_name_en'])?'-':$rows['cate_name_en'];
        $cateArrays[$rowCount]['cate_img_1'] =  empty($rows['cate_img_1'])?'-':$rows['cate_img_1'];
        // $cateArrays[$rowCount]['cate_img_1'] =  '';
    } 
    return $cateArrays;
               
}
/* --------- */
/* GET SUBCATEGORY  */
function getSubCategory($cate_id,$cate_orderby,$cate_limit)
{
    $QueryString = "SELECT category.cate_id as parent_id,category.cate_name_th as parent_name_th,
    category.cate_name_en as parent_name_en,category.cate_desc as cate_desc,category.cate_img_1 as parent_img_1,
    sub_category.sub_cate_id as sub_cate_id,sub_category.sub_cate_name_th,
    sub_category.sub_cate_name_en,sub_category.sub_cate_img_1  FROM category LEFT JOIN sub_category 
    ON category.cate_id = sub_category.cate_id ";
    if(!empty($cate_id)){
        $QueryString .= " WHERE category.cate_id = {$cate_id} ";
    }
    if(!empty($cate_orderby))
    {
        $QueryString .= " ORDER BY {$cate_orderby} ";
    }
    if(!empty($cate_limit)) { $QueryString .= " LIMIT {$cate_limit}"; }

    $cateArrays = array();
    $resultStr = sendQuery($QueryString);
    while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {
        $cateArrays[$rows['parent_id']]['parent_name_th'] =  empty($rows['parent_name_th'])?'-':$rows['parent_name_th'];
        $cateArrays[$rows['parent_id']]['parent_img_1'] =  empty($rows['parent_img_1'])?'-':$rows['parent_img_1'];
        $cateArrays[$rows['parent_id']]['cate_desc'] =  empty($rows['cate_desc'])?'-':$rows['cate_desc'];
        $sub_cate_id = empty($rows['sub_cate_id']) ? 0 : $rows['sub_cate_id'];
        $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] = array();    
        if($sub_cate_id != 0 ){
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_name_th'] = empty($rows['sub_cate_name_th'])?'':$rows['sub_cate_name_th'];
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_name_en'] =  empty($rows['sub_cate_name_en'])?'':$rows['sub_cate_name_en'];
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_img_1'] =  empty($rows['sub_cate_img_1'])?'':$rows['sub_cate_img_1'];
        }
        // $cateArrays[$rowCount]['cate_img_1'] =  '';
    } 
    return $cateArrays;

}
/* END GET SUBCATEGORY */



/* GET PRODUCT */
function getProduct($product_id,$cate_id,$sub_cate_id,$product_orderby,$product_limit,$typeofSex){

    $conditionProd = ($product_id == 0 ) ? '' : "WHERE product.product_id = {$product_id} ";
    $conditionProd .= empty($product_orderby) ? '' : " ORDER BY {$product_orderby} ";
    $conditionProd .= empty($product_limit) ? '' : " LIMIT {$product_limit} ";
    $conditionCate =  empty($cate_id) ? '' : " WHERE r2.cate_id = {$cate_id} ";
    $conditionCate .= empty($sub_cate_id) ? '' : " AND r2.sub_cate_id = {$sub_cate_id} "; 
    $QueryString = "SELECT r2.*,(SELECT cate_name_th  FROM category WHERE cate_id = r2.cate_id) AS parent_name_th FROM (
        SELECT  * FROM (
            SELECT product.*,product_cate_rel.cate_id_multi,product_cate_rel.product_cate_rel_id,
            product_cate_rel.product_cate_rel_name 
            FROM product
            LEFT JOIN product_cate_rel 
            ON product.product_id = product_cate_rel.product_id
            {$conditionProd}

            
        ) r1
        JOIN sub_category AS s ON FIND_IN_SET(s.sub_cate_id,r1.cate_id_multi)
        )r2  {$conditionCate} 
        ";
        // echo $QueryString;
        // exit;
    $prodArrays = array();
    $resultStr = sendQuery($QueryString);
    if (empty($resultStr)) {
        return $prodArrays;
    }
    while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {
        $prodArrays[$rows['product_id']]['product_id'] =  empty($rows['product_id'])?'-':$rows['product_id'];
        $prodArrays[$rows['product_id']]['product_name'] =  empty($rows['product_name'])?'-':$rows['product_name'];
        $prodArrays[$rows['product_id']]['is_for_men'] =  empty($rows['is_for_men'])?'':$rows['is_for_men'];
        $prodArrays[$rows['product_id']]['is_for_female'] =  empty($rows['is_for_female'])?'':$rows['is_for_female'];
        $prodArrays[$rows['product_id']]['is_for_kid'] =  empty($rows['is_for_kid'])?'':$rows['is_for_kid'];
        $prodArrays[$rows['product_id']]['product_create_date'] =  empty($rows['product_create_date'])?'':$rows['product_create_date'];
        $prodArrays[$rows['product_id']]['product_active'] =  empty($rows['product_active'])?'':$rows['product_active'];
        $prodArrays[$rows['product_id']]['product_img1'] =  empty($rows['product_img1'])?'':$rows['product_img1'];
        $prodArrays[$rows['product_id']]['product_img2'] =  empty($rows['product_img2'])?'':$rows['product_img2'];
        $prodArrays[$rows['product_id']]['product_img3'] =  empty($rows['product_img3'])?'':$rows['product_img3'];
        $prodArrays[$rows['product_id']]['product_img4'] =  empty($rows['product_img4'])?'':$rows['product_img4'];
        $prodArrays[$rows['product_id']]['product_img5'] =  empty($rows['product_img5'])?'':$rows['product_img5'];
        $prodArrays[$rows['product_id']]['product_price'] =  empty($rows['product_price'])? 0 :$rows['product_price'];
        $prodArrays[$rows['product_id']]['product_detail'] =  empty($rows['product_detail'])? '' :$rows['product_detail'];
        $prodArrays[$rows['product_id']]['product_meterial'] =  empty($rows['product_meterial'])? '' :$rows['product_meterial'];
        $prodArrays[$rows['product_id']]['product_size'] =  empty($rows['product_size'])? '' :$rows['product_size'];
        $prodArrays[$rows['product_id']]['product_discount'] =  empty($rows['product_discount'])? '' :$rows['product_discount'];
        $prodArrays[$rows['product_id']]['product_shopee_url'] =  empty($rows['product_shopee_url'])? '' :$rows['product_shopee_url'];
        $prodArrays[$rows['product_id']]['parent_name_th'] =  empty($rows['parent_name_th'])? '' :$rows['parent_name_th'];
        $prodArrays[$rows['product_id']]['is_for_all'] =  empty($rows['is_for_all'])? '' :$rows['is_for_all'];
        $sub_cate_id = empty($rows['sub_cate_id']) ? 0 : $rows['sub_cate_id'];
        if($sub_cate_id != 0){
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_id'] = empty($sub_cate_id)? '' : $sub_cate_id;
        
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_name_th'] = empty($rows['sub_cate_name_th'])? '' :$rows['sub_cate_name_th'];
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_name_en'] = empty($rows['sub_cate_name_en'])? '' :$rows['sub_cate_name_en'];
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_img_1'] = empty($rows['sub_cate_img_1'])? '' :$rows['sub_cate_img_1'];
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_img_2'] = empty($rows['sub_cate_img_2'])? '' :$rows['sub_cate_img_2'];
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_img_3'] = empty($rows['sub_cate_img_3'])? '' :$rows['sub_cate_img_3'];
            $prodArrays[$rows['product_id']]['child'][$sub_cate_id]['sub_cate_desc'] = empty($rows['sub_cate_desc'])? '' : $rows['sub_cate_desc'];
        
        }
       
    } 
    return $prodArrays;
        
    
}
/* END GET PRODUCT */

function deCodeMD5($str)
{
    $navBarArray = array("6a992d5529f459a44fee58c733255e86"=>"index",
    "d2fc17cc2feffa1de5217a3fd29e91e8"=>"men",
    "273b9ae535de53399c86a9b83148a8ed"=>"female",
    "478669c7fa549970e36eac591cdca62e"=>"questions",
    "102685074fe53ed33357daab1a296678"=>"howtobuy",
    "2f8a6bf31f3bd67bd2d9720c58b19c9a"=>"contact");

    if (array_key_exists($str, $navBarArray)) {
        $str = $navBarArray[$str];
    }

    
    return $str;
}




/* FACEBOOK API */
function sendInboxMessage() {
   
}


/* -- */
?>