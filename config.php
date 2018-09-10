<?php

 /* 
    $dbhost = "localhost";
    $dbuser ="id6811427_mifirstshop";
    $dbpassword ="0145678911";
    $dbname ="id6811427_mifirstshop";
    */


/* db config */
$img_blog = $_SERVER["DOCUMENT_ROOT"]."/img/blog/";


/* set date */
date_default_timezone_set("Asia/Bangkok");

/* PRODUCT DIRECTORY */
 
function returnPath($str,$session_id,$product_id,$type){
    $ds = DIRECTORY_SEPARATOR; 
    $date_now = date("Y-m-d H:i:s");
    $date_time = new DateTime($date_now);
    $time_stamp = $date_time->getTimestamp();
    $session_id = empty($session_id) ? 0 : $session_id;
    $product_id = empty($product_id) ? 0 : $product_id;
    switch ($str) {
        case "tmp_img":
            $str = 'tmp'.$ds.$session_id.'__';
            $str .= $type == 'only_id' ? '' :$time_stamp.$ds;
        break;
        case "tmp_category":
            $str = 'tmp'.$ds.'category'.$ds.$session_id.'__';
            $str .= $type == 'only_id' ? '' :$time_stamp.$ds;
        break;
        case "product":
            $str = 'img'.$ds.'product'.$ds.$product_id.$ds;
        break;
        case "category":
            $cate_id = empty($product_id) ? 0 : $product_id;
             $str = 'img'.$ds.'category'.$ds.$cate_id.$ds;     
        break;
        case "relative_category":
            $str = 'img'.$ds.'category'.$ds.$product_id.$ds;
        break;
        default:
            echo "errors";
    }

    if (!file_exists(dirname( __FILE__ ).$ds.$str) && $type != 'only_id') {
        mkdir(dirname( __FILE__ ).$ds.$str, 0777, true);
    }
    return dirname( __FILE__ ).$ds.$str;
}
/* GET ONLY TIMESTAMP */
function getTimeStamp($timp_stamp,$date_now){
    
    $date_time = new DateTime($date_now);
    $time_stamp = $date_time->getTimestamp();
    return $time_stamp;
}
/* PRODUCT TYPE มือหนึ่ง : มือสอง*/
function getProductType(){
    $prodType[1]['th'] = "มือหนึ่ง";
    $prodType[1]['en'] = "first hand";

    $prodType[2]['th'] = "มือสอง";
    $prodType[2]['en'] = "second hand";
    return $prodType;
}

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
function getCategory($cate_id,$session_id,$order_by,$limits) {
    $conditionCate = '';
    $conditionCate .= ($cate_id == 0 ) ? '' : " AND category.cate_id = {$cate_id} ";
    $conditionCate .= ($session_id == 0 ) ? '' : " AND category.create_by = {$session_id} ";
    $ConditionOrders = empty($order_by) ? '' : " {$order_by} ";
    $Conditionlimits = empty($limits) ? '' : " LIMIT {$limits} ";
    $QueryString = "SELECT * FROM category WHERE cate_active = 1 {$conditionCate} ORDER BY {$ConditionOrders} {$Conditionlimits}";
    $cateArrays = array();
    $resultStr = sendQuery($QueryString);
    $rowCount = 0;
    
    
    while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {
        ++ $rowCount;
        $cateArrays[$rowCount]['cate_id'] = empty($rows['cate_id'])?'-':$rows['cate_id'];                            
        $cateArrays[$rowCount]['cate_name_th'] = empty($rows['cate_name_th'])?'-':$rows['cate_name_th'];
        $cateArrays[$rowCount]['cate_name_en'] =  empty($rows['cate_name_en'])?'-':$rows['cate_name_en'];
        $cateArrays[$rowCount]['cate_img_1'] =  empty($rows['cate_img_1'])?'-':$rows['cate_img_1'];
        $cateArrays[$rowCount]['cate_img_2'] =  empty($rows['cate_img_2'])?'-':$rows['cate_img_2'];
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
        $cateArrays[$rows['parent_id']]['cate_img_1'] =  empty($rows['cate_img_1'])?'-':$rows['cate_img_1'];
        $cateArrays[$rows['parent_id']]['sub_cate_name'][] =  empty($rows['sub_cate_name_th'])? '' :$rows['sub_cate_name_th'];
        $sub_cate_id = empty($rows['sub_cate_id']) ? 0 : $rows['sub_cate_id'];
        $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] = array();    
        if($sub_cate_id != 0 ){
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_name_th'] = empty($rows['sub_cate_name_th'])?'':$rows['sub_cate_name_th'];
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_name_en'] =  empty($rows['sub_cate_name_en'])?'':$rows['sub_cate_name_en'];
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_img_1'] =  empty($rows['sub_cate_img_1'])?'':$rows['sub_cate_img_1'];
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['sub_cate_id'] =  empty($rows['sub_cate_id'])?'':$rows['sub_cate_id'];
            $cateArrays[$rows['parent_id']]['child'][$sub_cate_id] ['parent_id'] =  empty($rows['parent_id'])?'':$rows['parent_id'];
        }
        // $cateArrays[$rowCount]['cate_img_1'] =  '';
    } 
    return $cateArrays;

}
/* END GET SUBCATEGORY */



/* MAIN GET PRODUCT จะเอาความสัมพันธ์ที่ผูกกับ product มาด้วย */
function getProduct_withCategory($product_id,$cate_id,$sub_cate_id,$product_orderby,$product_limit,$typeofSex,$session_id,$like_sub_id){

    $conditionProd = " WHERE 1=1 ";
    $conditionProd .= ($product_id == 0 ) ? '' : " AND product.product_id = {$product_id} ";
    $conditionProd .= empty($session_id) ? '' : " AND product.create_by = {$session_id} ";
    $conditionProd .= empty($like_sub_id) ? '' : " AND product_cate_rel.cate_id_multi = '{$like_sub_id}' ";
    $conditionProd .= empty($product_orderby) ? '' : " ORDER BY {$product_orderby} ";
    $conditionProd .= empty($product_limit) ? '' : " LIMIT {$product_limit} ";
    $conditionCate =  empty($cate_id) ? '' : " WHERE r2.cate_id = {$cate_id} ";
    $conditionCate .= empty($sub_cate_id) ? '' : " AND r2.sub_cate_id = {$sub_cate_id} "; 
    $QueryString = "SELECT r2.*,(SELECT cate_name_th  FROM category WHERE cate_id = r2.cate_id) AS parent_name_th,(SELECT cate_id  FROM category WHERE cate_id = r2.cate_id) AS parent_id FROM (
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
        $prodArrays[$rows['product_id']]['product_discount'] =  empty($rows['product_discount'])? 0 :$rows['product_discount'];
        $prodArrays[$rows['product_id']]['product_shopee_url'] =  empty($rows['product_shopee_url'])? '' :$rows['product_shopee_url'];
        $prodArrays[$rows['product_id']]['parent_name_th'] =  empty($rows['parent_name_th'])? '' :$rows['parent_name_th'];
        $prodArrays[$rows['product_id']]['parent_id'] =  empty($rows['parent_id'])? '' :$rows['parent_id'];
        $prodArrays[$rows['product_id']]['is_for_all'] =  empty($rows['is_for_all'])? '' :$rows['is_for_all'];

        $prodArrays[$rows['product_id']]['product_id_ref'] =  empty($rows['product_id_ref'])? '' :$rows['product_id_ref'];
        $prodArrays[$rows['product_id']]['product_logistic_weight'] =  empty($rows['product_logistic_weight'])? '' :$rows['product_logistic_weight'];
        $prodArrays[$rows['product_id']]['product_logistic_size_1'] =  empty($rows['product_logistic_size_1'])? '' :$rows['product_logistic_size_1'];
        $prodArrays[$rows['product_id']]['product_logistic_size_2'] =  empty($rows['product_logistic_size_2'])? '' :$rows['product_logistic_size_2'];
        $prodArrays[$rows['product_id']]['product_logistic_size_3'] =  empty($rows['product_logistic_size_3'])? '' :$rows['product_logistic_size_3'];
        $prodArrays[$rows['product_id']]['product_logistic_amount'] =  empty($rows['product_logistic_amount'])? '' :$rows['product_logistic_amount'];
        $prodArrays[$rows['product_id']]['product_logistic_send'] =  empty($rows['product_logistic_send'])? '' :$rows['product_logistic_send'];
        $prodArrays[$rows['product_id']]['product_stock'] =  empty($rows['product_stock'])? 0 :$rows['product_stock'];
       
        $prodArrays[$rows['product_id']]['product_type'] =  empty($rows['product_type'])? '' :$rows['product_type'];
        $prodArrays[$rows['product_id']]['product_logistic_time'] =  empty($rows['product_logistic_time'])? '' :$rows['product_logistic_time'];
       
        
        $sub_cate_id = empty($rows['sub_cate_id']) ? 0 : $rows['sub_cate_id'];
        if($sub_cate_id != 0){
            $prodArrays[$rows['product_id']]['sub_cate_name'][] =  empty($rows['sub_cate_name_th'])? '' :$rows['sub_cate_name_th'];
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

/* GET PRODUCT เอาแต่ฟิลด์ทั้งหมดที่อยู่ใน product มาไม่สนใจสินค้าที่ผูกใน Category และ Subcate มาแสดงทั้งหมด */
function getProduct($product_id,$product_orderby,$product_limit,$typeofSex,$session_id){
    
    $conditionProd = " WHERE 1=1 ";
    $conditionProd .= ($product_id == 0 ) ? '' : " AND product.product_id = {$product_id} ";
    $conditionProd .= empty($session_id) ? '' : " AND product.create_by = {$session_id} ";
    $conditionProd .= empty($product_orderby) ? '' : " ORDER BY {$product_orderby} ";
    $conditionProd .= empty($product_limit) ? '' : " LIMIT {$product_limit} ";
 
    $QueryString = "SELECT * FROM product {$conditionProd}";
     
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

        $prodArrays[$rows['product_id']]['product_id_ref'] =  empty($rows['product_id_ref'])? '' :$rows['product_id_ref'];
        $prodArrays[$rows['product_id']]['product_logistic_weight'] =  empty($rows['product_logistic_weight'])? '' :$rows['product_logistic_weight'];
        $prodArrays[$rows['product_id']]['product_logistic_size_1'] =  empty($rows['product_logistic_size_1'])? '' :$rows['product_logistic_size_1'];
        $prodArrays[$rows['product_id']]['product_logistic_size_2'] =  empty($rows['product_logistic_size_2'])? '' :$rows['product_logistic_size_2'];
        $prodArrays[$rows['product_id']]['product_logistic_size_3'] =  empty($rows['product_logistic_size_3'])? '' :$rows['product_logistic_size_3'];
        $prodArrays[$rows['product_id']]['product_logistic_amount'] =  empty($rows['product_logistic_amount'])? '' :$rows['product_logistic_amount'];
        $prodArrays[$rows['product_id']]['product_logistic_send'] =  empty($rows['product_logistic_send'])? '' :$rows['product_logistic_send'];
        $prodArrays[$rows['product_id']]['product_stock'] =  empty($rows['product_stock'])? '' :$rows['product_stock'];
       
        $prodArrays[$rows['product_id']]['product_type'] =  empty($rows['product_type'])? '' :$rows['product_type'];
       
        
      
       
    } 
    return $prodArrays;
}



/* GET CONTENT */
function getContent($content_id,$session_id,$comment_id,$content_name,$order_by,$limit,$fields){
    $conditionCond = " WHERE 1=1 ";
    $conditionCond .= ($content_id == 0 ) ? '' : " AND content.content_id = {$content_id} ";
    $conditionCond .= empty($session_id) ? '' : " AND content.content_create_by = {$session_id} ";
    $conditionCond .= empty($comment_id) ? '' : " AND content_comment.comment_id = {$comment_id} ";
    $conditionCond .= empty($content_name) ? '' : " AND content.content_name Like '%{$content_name}%' ";
    $conditionCond .= empty($order_by) ? '' : " ORDER BY {$order_by} ";
    $conditionCond .= empty($limit) ? '' : " LIMIT {$limit} ";
 
    $QueryString = "SELECT content.*,content_comment.comment_email,content_comment.comment_message
    ,content_comment.comment_poster_name,content_comment.comment_subject,content_comment.comment_id
    ,auth_account.u_name FROM content 
    LEFT JOIN content_comment 
    ON content.content_id = content_comment.content_id
    LEFT JOIN auth_account ON content.content_create_by = auth_account.id
     {$conditionCond}
    ";
   
    $condArrays = array();
    $resultStr = sendQuery($QueryString);
    if (empty($resultStr)) {
        return $condArrays;
    }
    $fields = empty($fields) ? 'content_id' : $fields;
    while($rows = $resultStr->fetch_assoc()){
        $condArrays[$rows[$fields]]['attr'] = $rows;
        if(!is_null($rows['comment_id'])){
            $condArrays[$rows[$fields]]['child'][] = empty($rows['comment_id']) ? '' : $rows;
        }
    }


    
    return $condArrays;

}



function deCodeMD5($str)
{
    $navBarArray = array("6a992d5529f459a44fee58c733255e86"=>"index",
    "126ac9f6149081eb0e97c2e939eaad52"=>"blog",
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



/* LOGIN FUNCTION */
function LoginFunc($user_id,$user_name,$user_pwd) {
    $conditionProd = ($user_id == 0 ) || empty($user_id) ? '' : "AND auth_account.id= {$user_id} ";
    $conditionProd .= empty($user_name)  ? '' : "AND auth_account.u_name = '{$user_name}' ";
    $conditionProd .= empty($user_pwd)  ? '' : " AND auth_account.u_pass = md5('{$user_pwd}') ";
    $QueryString = "SELECT * FROM auth_account 
    JOIN auth_role ON auth_account.role_id = auth_role.role_id  WHERE u_active = 1 
    {$conditionProd}
    ";
    // echo $QueryString;
    // exit;
    $profileArrays = array();
    $resultStr = sendQuery($QueryString);
    while($rows = mysqli_fetch_array($resultStr,MYSQLI_BOTH)) {
        $profileArrays[$rows['id']]['id'] = empty($rows['id'])?'':$rows['id'];       
        $profileArrays[$rows['id']]['hashKeys'] = empty($rows['id'])?'':md5($rows['id']);                       
        $profileArrays[$rows['id']]['u_name'] = empty($rows['u_name'])?'-':$rows['u_name'];
        $profileArrays[$rows['id']]['u_pass'] =  empty($rows['u_pass'])?'-':$rows['u_pass'];
        $profileArrays[$rows['id']]['first_login'] =  empty($rows['first_login'])?'':$rows['first_login'];
        $profileArrays[$rows['id']]['last_login'] =  empty($rows['last_login'])?'':$rows['last_login'];
        $profileArrays[$rows['id']]['count_page'] =  empty($rows['count_page'])?'':$rows['count_page'];
        $profileArrays[$rows['id']]['count_login'] =  empty($rows['count_login'])?'':$rows['count_login'];
        $profileArrays[$rows['id']]['user_description'] =  empty($rows['user_description'])?'':$rows['user_description'];
        $profileArrays[$rows['id']]['email'] =  empty($rows['email'])?'':$rows['email'];
        $profileArrays[$rows['id']]['creator'] =  empty($rows['creator'])?'':$rows['creator'];
        $profileArrays[$rows['id']]['created'] =  empty($rows['created'])?'':$rows['created'];
        $profileArrays[$rows['id']]['modified'] =  empty($rows['modified'])?'':$rows['modified'];
        $profileArrays[$rows['id']]['first_name'] =  empty($rows['first_name'])?'':$rows['first_name'];
        $profileArrays[$rows['id']]['last_name'] =  empty($rows['last_name'])?'':$rows['last_name'];
        $profileArrays[$rows['id']]['role_id'] =  empty($rows['role_id'])?'':$rows['role_id'];
    
    
    } 
    return $profileArrays;
}
/* END LOGIN FUNCTION */

/* DECODE HASH MD5 LOGIN PARAMETERS */


/* END DECODE HASH MD5  PARAMETERS  */
function deCodeMD5_onetable($hashKeys,$columns,$table){
    $QueryString = "SELECT {$columns} FROM {$table} WHERE md5({$columns}) = '{$hashKeys}' LIMIT 1";
    $resultStr = sendQuery($QueryString);
    $row= mysqli_fetch_assoc($resultStr);
    return empty($row[$columns]) ? '' : $row[$columns];

}



// ต้องส่งเป็น array มาเท่านั้น
function DELETE_STRUCTURE($STR_ARRAYS){
    if(!empty($STR_ARRAYS)){
        foreach($STR_ARRAYS as $_KEYS => $_QUERYSTRING){
                executeQuery($_QUERYSTRING);
        }
    }
}
/* FACEBOOK API */
function sendInboxMessage() {
   
}


/* -- */
?>