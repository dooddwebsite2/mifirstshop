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
$content_id=isset($_POST["content_id"])?$_POST["content_id"]:"";



if(!empty($_FILES)){
    $allowedExts = array("gif", "jpeg", "jpg", "png");

    // Get filename.
    $temp = explode(".", $_FILES["file"]["name"]);

    // Get extension.
    $extension = end($temp);

    // An image check is being done in the editor but it is best to
    // check that again on the server side.
    // Do not use $_FILES["file"]["type"] as it can be easily forged.
    $finfo = finfo_open(FILEINFO_MIME_TYPE);
    $mime = finfo_file($finfo, $_FILES["file"]["tmp_name"]);

    if ((($mime == "image/gif")
    || ($mime == "image/jpeg")
    || ($mime == "image/pjpeg")
    || ($mime == "image/x-png")
    || ($mime == "image/png"))
    && in_array($extension, $allowedExts)) {
        // Generate new random name.
        $name = sha1(microtime()) . "." . $extension;

        // Save file in the uploads folder.
        move_uploaded_file($_FILES["file"]["tmp_name"], getcwd() . "/uploads/" . $name);

        // Generate response.
        $response = new StdClass;
        $response->link = "/uploads/" . $name;
        echo stripslashes(json_encode($response));
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

if($action == 'content_detail')
{
    $condArrays = getContent($content_id,'','','','','','content_id');
    
    $content_name = empty($condArrays[$content_id]['attr']["content_name"]) ? 'ไม่มีชื่อบทความ' : $condArrays[$content_id]['attr']["content_name"];
    $content_preface = empty($condArrays[$content_id]['attr']["content_preface"]) ? 'ไม่มีชื่อบทความ' : $condArrays[$content_id]['attr']["content_preface"];
    $u_name= empty($condArrays[$content_id]['attr']["u_name"]) ? 'ไม่มีชื่อบทความ' : $condArrays[$content_id]['attr']["u_name"];
    $content_create_date= empty($condArrays[$content_id]['attr']["content_create_date"]) ? 'ไม่มีชื่อบทความ' : $condArrays[$content_id]['attr']["content_create_date"];
    $content_paragraph1= empty($condArrays[$content_id]['attr']["content_paragraph1"]) ? '' : $condArrays[$content_id]['attr']["content_paragraph1"];
    $content_paragraph2= empty($condArrays[$content_id]['attr']["content_paragraph2"]) ? '' : $condArrays[$content_id]['attr']["content_paragraph2"];
    $content_paragraph3= empty($condArrays[$content_id]['attr']["content_paragraph3"]) ? '' : $condArrays[$content_id]['attr']["content_paragraph3"];
    $content_paragraph4= empty($condArrays[$content_id]['attr']["content_paragraph4"]) ? '' : $condArrays[$content_id]['attr']["content_paragraph4"];
  

    $html = "<h2 style='display: inline;'><b><u>ข้อมูลบทความ</u></b></h2>";
    $html.= "<h3><b>ชื่อ:</b>&nbsp;<a href='post.php?content_id={$content_id}'>".$content_name.'&nbsp;(คลิ๊กที่นี่เพื่อไปยังบทความ) '."</a>&nbsp;<br><b>เขียนโดย</b>:&nbsp;{$u_name} / {$content_create_date} </h3>";
    $html.= "<h3><b>บทนำ:</b><br>&nbsp;&nbsp;".$content_preface."</h3>";
    $html.= "<h3><b>เนื้อหา:</b>&nbsp;";
    $html.= empty($content_paragraph1) ? '' : '<br>&nbsp;&nbsp;'.$content_paragraph1.'';
    $html.= empty($content_paragraph2) ? '' : '<br>&nbsp;&nbsp;'.$content_paragraph2.'';
    $html.= empty($content_paragraph3) ? '' : '<br>&nbsp;&nbsp;'.$content_paragraph3.'';
    $html.= empty($content_paragraph4) ? '' : '<br>&nbsp;&nbsp;'.$content_paragraph4.'';
    $html.= "</h3>";
  
    
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

