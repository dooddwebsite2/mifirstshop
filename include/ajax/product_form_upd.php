<?php require_once('../../config.php'); ?>
<?php
 $ds = DIRECTORY_SEPARATOR; 

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$session_id =isset($_POST["session_id"])?$_POST["session_id"]:0;
//$file_name=isset($_POST['file_name'])?$_POST['file_name']:'';
$product_name=isset($_POST["product_name"])?$_POST["product_name"]:"-";
$product_price=isset($_POST["product_price"])?$_POST["product_price"]:0;
$product_discount=isset($_POST["product_discount"])?$_POST["product_discount"]:0;
$product_stock=isset($_POST["product_stock"])?$_POST["product_stock"]:0;
$category=isset($_POST["category"])?$_POST["category"]:"";
$product_id_ref=isset($_POST["product_id_ref"])?$_POST["product_id_ref"]:"-";
$product_type=isset($_POST["product_type"])?$_POST["product_type"]:"";
$product_desc=isset($_POST["product_desc"])?$_POST["product_desc"]:"-";
$product_logistic_weight=isset($_POST["product_logistic_weight"])?$_POST["product_logistic_weight"]:"-";
$product_logistic_size_1=isset($_POST["product_logistic_size_1"])?$_POST["product_logistic_size_1"]:"-";
$product_logistic_size_2=isset($_POST["product_logistic_size_2"])?$_POST["product_logistic_size_2"]:"-";
$product_logistic_size_3=isset($_POST["product_logistic_size_3"])?$_POST["product_logistic_size_3"]:"-";
$product_logistic_amount=isset($_POST["product_logistic_amount"])?$_POST["product_logistic_amount"]:"-";
$product_logistic_time=isset($_POST["product_logistic_time"])?$_POST["product_logistic_time"]:"-";
$product_logistic_send=isset($_POST["product_logistic_send"])?$_POST["product_logistic_send"]:"-";
$subArrays=empty($_POST["subArrays"])? "":$_POST["subArrays"];
$_filename =empty($_POST["file_name"])? "":$_POST["file_name"];
$product_id =empty($_POST["product_id"])? 0:$_POST["product_id"];

if(!empty($_FILES)){
    $target_img_path = returnPath('product','',$product_id,'');
    //array_map('unlink', glob("{$target_img_path}*"));
    foreach($_FILES['file']['name'] as $_keys => $_info_files){
        $temp = $_FILES['file']['tmp_name'][$_keys];
        $original_filename = explode(".",$_FILES['file']['name'][$_keys]); 
        $newfiles = MD5($original_filename[0]).'.'.pathinfo($_FILES['file']['name'][$_keys], PATHINFO_EXTENSION);
        if (file_exists($target_img_path.$newfiles)) {unlink($target_img_path.$newfiles);}
        move_uploaded_file($temp, $target_img_path.$newfiles);
    }   
}

if($action == 'list_image'){
    $target_prod_paths = returnPath('product','',$id,'');
    $prod_files['img']['full_path'] = glob("{$target_prod_paths}*.*", GLOB_BRACE);
    $count = 0;
    foreach($prod_files['img']['full_path'] as $_original_file => $_original_file_value){ 
        $prod_files['img']['relative_path'][] =  basename($_original_file_value); 
        $prod_files['img']['img_size'][] =  filesize($_original_file_value);

    } 
    echo json_encode($prod_files);

}

if($action == 'product_upd'){
    $target_img_path = returnPath('product','',$product_id,'');
    $folders = glob("{$target_img_path}*", GLOB_BRACE);
    $date_now = date("Y-m-d H:i:s");
    $time_stamp = getTimeStamp('',$date_now);
    $files_name = array();
    if(count($folders) > 0){
        // ด้านล่างวนลูปเอาชื่อไฟล์ใส่ใน array
        foreach($folders as $_original_file => $_original_file_value){ 
            $files_name[] =  basename($_original_file_value); 
        } 
       
        $sql = "UPDATE product SET product_name='{$product_name}',product_modified_date='{$date_now}'
        ,product_price ='{$product_price}',product_discount='{$product_discount}'
        ,product_stock='{$product_stock}',product_type='{$product_type}',product_detail='{$product_desc}'
        ,product_id_ref='{$product_id_ref}',product_logistic_weight='{$product_logistic_weight}'
        ,product_logistic_size_1 ='{$product_logistic_size_1}'
        ,product_logistic_size_2='{$product_logistic_size_2}'
        ,product_logistic_size_3='{$product_logistic_size_3}'
        ,product_logistic_amount='{$product_logistic_amount}'
        ,product_logistic_time='{$product_logistic_time}',product_logistic_send='{$product_logistic_send}'
        ,product_img1='{$files_name[0]}',product_img2='{$files_name[1]}',product_img3='{$files_name[2]}'
        ,product_img4='{$files_name[3]}' WHERE product_id = {$product_id}";
        executeQuery($sql);

        $target_prod_path = returnPath('product','',$product_id,'');
        $sqls = " UPDATE  product_cate_rel SET cate_id_multi ='".implode(',',$subArrays)."' WHERE product_id = {$product_id}";
        executeQuery($sqls);
      
    }
   
}
if($action == 'product_add_img'){
   echo ''.$session_id.' << add img ..';
}
if($action == 'product_delete_img'){

    $target_img_path = returnPath('product','',$product_id,'');
    echo $target_img_path.$_filename;
    if (file_exists($target_img_path.$_filename)) {unlink($target_img_path.$_filename);}
}
if($action == 'product_delete'){
    $_QUERYARRAYS =  array();
    $_QUERYARRAYS[] = "DELETE FROM product WHERE product_id = {$id}";
    $_QUERYARRAYS[] = "DELETE FROM product_cate_rel WHERE product_id = {$id}";
    $_QUERYARRAYS[] = "DELETE FROM product_brand_rel WHERE product_id = {$id}";
    DELETE_STRUCTURE($_QUERYARRAYS);
 }

?>

