<?php require_once('../../config.php'); ?>
<?php
 $ds = DIRECTORY_SEPARATOR; 

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id=isset($_POST["id"])?$_POST["id"]:"";
$cate_id=isset($_POST["cate_id"])?$_POST["cate_id"]:"";
$_filename =empty($_POST["file_name"])? "":$_POST["file_name"];
$session_id=empty($_POST["session_id"])? 0:$_POST["session_id"];
$category =empty($_POST["category"])? "":$_POST["category"];
$cate_desc =empty($_POST["cate_desc"])? "":$_POST["cate_desc"];
$subArrays=empty($_POST["subArrays"])? "":$_POST["subArrays"];
$sub_cate_id=isset($_POST["sub_cate_id"])?$_POST["sub_cate_id"]:"";

if(!empty($_FILES)){
    $target_img_path = returnPath('tmp_category',$session_id,'','');
    foreach($_FILES['file']['name'] as $_keys => $_info_files){
        $temp = $_FILES['file']['tmp_name'][$_keys];
        $original_filename = explode(".",$_FILES['file']['name'][$_keys]); 
        $newfiles = MD5($original_filename[0]).'.'.pathinfo($_FILES['file']['name'][$_keys], PATHINFO_EXTENSION);
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

if($action == 'category_detail')
{
    $cateArrays = getSubCategory($id,'','');
    
    $img1 = empty($cateArrays[$id]["parent_img_1"]) ? 'no_image.png' : $cateArrays[$id]["parent_img_1"];
    $img1_path = empty($cateArrays[$id]["parent_img_1"]) ? 'img/'.$img1 : 'img/category/'.$id.'/'.$img1;

    $html = "<h2 style='display: inline;'><b><u>ข้อมูลหมวดหมู่</u></b></h2>";
    $html.= "<h3><b>หมวดหมู่:</b>&nbsp;".$cateArrays[$id]['parent_name_th']."</h3>";
    $html.= "<h3><b>หมวดหมู่ย่อย:</b>&nbsp;".implode(", ", $cateArrays[$id]['sub_cate_name'])."</h3>";
    $html.= "<h3><b>รายละเอียด:</b>&nbsp;".$cateArrays[$id]['cate_desc']."</h3>";
    $html.= '<div class="row">';
    $html.= '<div class="col-xs-12 col-sm-12 col-md-12" align="center" ><img src="'.$img1_path.'" class="img img-responsive"  alt=""></div>';
    $html.= '</div>';
 
    
    echo $html;
}

if($action == 'category_add')
{
    //echo $session_id;
    $target_img_path = returnPath('tmp_category',$session_id,'','only_id');
   
    $folders = glob("{$target_img_path}*", GLOB_BRACE);
    $date_now = date("Y-m-d H:i:s");
    $time_stamp = getTimeStamp('',$date_now);
    $fol_tmp = '';$fol_tmps = '';
    foreach($folders as $_fol => $_folpath) {
        $fol_tmp =  $_folpath ?  explode("__",$_folpath) : '';
        $fol_tmps = ($fol_tmp[1] > $fol_tmps) ?  $fol_tmp[1] : $fol_tmps;
    }
 
    $search_keys = empty($folders)? 0 :  array_search($target_img_path.$fol_tmps,$folders);
    // move all find to directory
    $files = glob("{$folders[$search_keys]}{$ds}*.*", GLOB_BRACE);

    $files_name = array();
    if(count($files) > 0){
        // ด้านล่างวนลูปเอาชื่อไฟล์ใส่ใน array
        foreach($files as $_original_file => $_original_file_value){ 
            $files_name[] =  basename($_original_file_value); 
        } 
       
        $sql = "INSERT INTO category(cate_name_th,cate_create_date,cate_desc
        ,create_by,cate_img_1,cate_active)
        VALUES ('{$category}', '{$date_now}', '{$cate_desc}','{$session_id}'
        ,'{$files_name[0]}',1);";
        executeQuery($sql);

        $cateArrays = getCategory($cate_id,'',' cate_create_date DESC ',' 1');

        foreach($cateArrays as $_k => $v){
            $cate_id = $cateArrays[$_k]['cate_id'];
        }

        $target_prod_path = returnPath('category','',$cate_id,'');
              
        foreach($subArrays as $_k => $_v){
            $sqls = " INSERT INTO sub_category(cate_id,sub_cate_name_th) 
            VALUES ('{$cate_id}','".$_v."');";
            executeQuery($sqls);
        }
        foreach($files as $_original_file => $_original_file_value){ 
            rename($_original_file_value, $target_prod_path.basename($_original_file_value));
        } 
        
    }
}
if($action == 'category_search_prod')
{
    $prodArrays = getProduct_withCategory('','','','','','','',$sub_cate_id);
    $status = count($prodArrays) > 0 ? true : false; 
    echo json_encode(array('prodArrays' => $prodArrays, 'status'=>$status));
}
?>

