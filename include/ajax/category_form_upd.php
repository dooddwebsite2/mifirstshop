<?php require_once('../../config.php'); ?>
<?php
 $ds = DIRECTORY_SEPARATOR; 

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$session_id =isset($_POST["session_id"])?$_POST["session_id"]:0;
$cate_id= isset($_POST['cate_id']) ? $_POST['cate_id'] : 0;
$cate_name_th=isset($_POST["cate_name_th"])?$_POST["cate_name_th"]:"";
$cate_desc=isset($_POST["cate_desc"])?$_POST["cate_desc"]:"";
$subArrays=empty($_POST["subArrays"])? "":$_POST["subArrays"];
$txtArray=empty($_POST["txtArray"])? "":$_POST["txtArray"];
$_filename =empty($_POST["file_name"])? "":$_POST["file_name"];
if(!empty($_FILES)){
    $target_img_path = returnPath('category','',$cate_id,'');
    foreach($_FILES['file']['name'] as $_keys => $_info_files){
        $temp = $_FILES['file']['tmp_name'][$_keys];
        $original_filename = explode(".",$_FILES['file']['name'][$_keys]); 
        $newfiles = MD5($original_filename[0]).'.'.pathinfo($_FILES['file']['name'][$_keys], PATHINFO_EXTENSION);
        if (file_exists($target_img_path.$newfiles)) {unlink($target_img_path.$newfiles);}
        move_uploaded_file($temp, $target_img_path.$newfiles);
    }   
}

if($action == 'list_image'){
    $target_prod_paths = returnPath('category','',$cate_id,'');
    $prod_files['img']['full_path'] = glob("{$target_prod_paths}*.*", GLOB_BRACE);
    $count = 0;
    foreach($prod_files['img']['full_path'] as $_original_file => $_original_file_value){ 
        $prod_files['img']['relative_path'][] =  basename($_original_file_value); 
        $prod_files['img']['img_size'][] =  filesize($_original_file_value);

    } 
    echo json_encode($prod_files);

}

if($action == 'category_upd'){
    $target_img_path = returnPath('category','',$cate_id,'');
    $folders = glob("{$target_img_path}*", GLOB_BRACE);
    $date_now = date("Y-m-d H:i:s");
    $time_stamp = getTimeStamp('',$date_now);
    $files_name = array();
    if(count($folders) > 0){
        // ด้านล่างวนลูปเอาชื่อไฟล์ใส่ใน array
        foreach($folders as $_original_file => $_original_file_value){ 
            $files_name[] =  basename($_original_file_value); 
        } 
     
        $_keys_search  = array_keys($subArrays,0); 
        $Query = " UPDATE category set cate_img_1 = '{$files_name[0]}',cate_desc='{$cate_desc}',cate_name_th='{$cate_name_th}',cate_modified_date='{$date_now}' WHERE cate_id = {$cate_id} ";
        executeQuery($Query);

        $sql = " DELETE FROM sub_category WHERE  cate_id ={$cate_id} AND sub_cate_id NOT IN (".implode(',',$subArrays).") ";
        executeQuery($sql);
        if(count($_keys_search) > 0 ){
            foreach($_keys_search as $_t => $k_s){
                $sqls = " INSERT INTO sub_category(cate_id,sub_cate_name_th) 
                VALUES ('{$cate_id}','".$txtArray[$k_s]."');";
                executeQuery($sqls);
            }
        }
    }
   
}
if($action == 'product_add_img'){
   echo ''.$session_id.' << add img ..';
}
if($action == 'category_delete_img'){

    $target_img_path = returnPath('category','',$cate_id,'');
    echo $target_img_path.$_filename;
    if (file_exists($target_img_path.$_filename)) {unlink($target_img_path.$_filename);}
}
if($action == 'category_delete'){
    $prodArrays = getProduct_withCategory('',$cate_id,'','','','','','');
    $status = count($prodArrays) > 0 ? true : false;
   // $html = 'สินค้ามีการผูกอยู่กับหมวดหมู่นี้อยู่ ลบไม่ได้ ต้องไปแก้ความสัมพันธ์สินค้าดังกล่าวก่อน'. "\n";
   $html = "";
    if($status == false){
        $_QUERYARRAYS =  array();
        $_QUERYARRAYS[] = "DELETE FROM category WHERE cate_id = {$cate_id}";
        $_QUERYARRAYS[] = "DELETE FROM sub_category WHERE cate_id = {$cate_id}";
        DELETE_STRUCTURE($_QUERYARRAYS);
        $html .= "ลบข้อมูลเสร็จสมบูรณ์";
    }
    echo json_encode(array('prodArrays' => $prodArrays, 'html' => $html,  'status'=>$status));
}

?>

