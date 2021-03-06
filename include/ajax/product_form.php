<?php require_once('../../config.php'); ?>
<?php
session_start();
 $ds = DIRECTORY_SEPARATOR; 

$action = isset($_POST['action']) ? $_POST['action'] : '';
$id = isset($_POST['id']) ? $_POST['id'] : 0;
$product_id = isset($_POST['product_id']) ? $_POST['product_id'] : 0;
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

$Object_SUMS = empty($_POST['Object_SUMS']) ? "" : $_POST['Object_SUMS'];
$Object_AMOUNT = empty($_POST['Object_AMOUNT']) ? "" : $_POST['Object_AMOUNT'];
$Object_RECEIPT = empty($_POST['Object_RECEIPT']) ? "" : $_POST['Object_RECEIPT'];
$Object_AddressInfo = empty($_POST['Object_AddressInfo']) ? "" : $_POST['Object_AddressInfo'];
$delivery_method = empty($_POST["delivery_method"]) ? "" :$_POST["delivery_method"];
$payments_method = empty($_POST["payments_method"]) ? "" :$_POST["payments_method"];
$review_method = empty($_POST["review_method"]) ? "" :$_POST["review_method"];
if(!empty($_FILES)){
    $target_img_path = returnPath('tmp_img',$session_id,'','');
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

if($action == 'product_details')
{
    $prodArrays = getProduct_withCategory($id, '','' ,'','','','','');

    $img1 = empty($prodArrays[$id]["product_img1"]) ? 'no_image.png' : $prodArrays[$id]["product_img1"];
    $img2 = empty($prodArrays[$id]["product_img2"]) ? 'no_image.png' : $prodArrays[$id]["product_img2"];
    $img3 = empty($prodArrays[$id]["product_img3"]) ? 'no_image.png' : $prodArrays[$id]["product_img3"];
    $img4 = empty($prodArrays[$id]["product_img4"]) ? 'no_image.png' : $prodArrays[$id]["product_img4"];
    $img1_path = empty($prodArrays[$id]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$id.'/'.$img1;
    $img2_path = empty($prodArrays[$id]["product_img2"]) ? 'img/'.$img2 : 'img/product/'.$id.'/'.$img2;
    $img3_path = empty($prodArrays[$id]["product_img3"]) ? 'img/'.$img3 : 'img/product/'.$id.'/'.$img3;
    $img4_path = empty($prodArrays[$id]["product_img4"]) ? 'img/'.$img4 : 'img/product/'.$id.'/'.$img4;
    $product_type = (!empty($prodArrays[$id]["product_type"]) && $prodArrays[$id]["product_type"] == 1) ? 'ของใหม่' : 'ของมือสอง';
    $product_stock= $prodArrays[$id]["product_stock"] > 0 ? $prodArrays[$id]["product_stock"] : 0;
    $product_discount= $prodArrays[$id]["product_discount"] > 0 ? $prodArrays[$id]["product_discount"] : 1;
    $product_discount_txt = $prodArrays[$id]["product_discount"] > 0 ? $prodArrays[$id]["product_discount"] : 0; 
    $product_percent = $prodArrays[$id]["product_discount"] > 0 ? 100 : 1;
    $product_price= $prodArrays[$id]["product_price"] > 0 ? ( $prodArrays[$id]["product_price"] - ($prodArrays[$id]["product_price"] * (($prodArrays[$id]["product_discount"]) / $product_percent) )) : 0;
   
    $html = "<h2 style='display: inline;'><b><u>ข้อมูลสินค้า</u></b>&nbsp;(เหลือใน stock จำนวน ".$product_stock.")</h2>";
    $html.= "<h3><b>ชื่อสินค้า:</b>&nbsp;".$prodArrays[$id]['product_name']."</h3>";
    $html.= "<h3><b>หมวดหมู่:</b>&nbsp;".$prodArrays[$id]['parent_name_th'].'->'.implode(", ", $prodArrays[$id]['sub_cate_name'])."</h3>";
    $html.= "<h3><b>ประเภทสินค้า:</b>&nbsp;".$product_type."</h3>";
    $html.= "<h3><b>ลดราคา:</b>&nbsp;".$product_discount_txt."%</h3>";
    $html.= "<h3><b>ราคา(฿):</b>&nbsp;".$product_price."</h3>";
    $html.= "<h3><b>รายละเอียด:</b>&nbsp;</h3><p>".$prodArrays[$id]['product_detail']."</p>";
    $html.= '<div class="row">';
    $html.= '<div class="col-xs-3 col-sm-3" align="center" ><img src="'.$img1_path.'" class="img img-responsive"  alt=""></div>';
    $html.= '<div class="col-xs-3 col-sm-3" align="center" ><img src="'.$img2_path.'" class="img img-responsive"  alt=""></div>';
    $html.= '<div class="col-xs-3 col-sm-3" align="center" ><img src="'.$img3_path.'" class="img img-responsive"  alt=""></div>';
    $html.= '<div class="col-xs-3 col-sm-3" align="center" ><img src="'.$img4_path.'" class="img img-responsive"  alt=""></div>';
    $html.= '</div>';
    $html.= '<hr>';
    $html.= '<h2><b><u>การจัดส่ง</u></b></h2>';
    $html.= '<h3><b>เลขอ้างอิง:</b>&nbsp;'.$prodArrays[$id]['product_id_ref'].'</h3>';
    $html.= '<h3><b>น้ำหนัก:</b>&nbsp;'.$prodArrays[$id]['product_logistic_weight'].'</h3>';
    $html.= '<h3><b>ขนาด (กว้างxยาวxสูง):</b>&nbsp;'.$prodArrays[$id]['product_logistic_size_1'].'x'.$prodArrays[$id]['product_logistic_size_2'].'x'.$prodArrays[$id]['product_logistic_size_3'].'&nbsp;cm.</h3>';                                       
    $html.= '<h3><b>ค่าจัดส่ง:</b>&nbsp;'.$prodArrays[$id]['product_logistic_amount'].'</h3>';
    $html.= '<h3><b>จัดส่งสินค้าทางไหน:</b>&nbsp;'.$prodArrays[$id]['product_logistic_send'].'</h3>';
    
    
    echo $html;
}
if($action == 'product_add'){
    //echo $session_id;
    $target_img_path = returnPath('tmp_img',$session_id,'','only_id');
   
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
       
        $sql = "INSERT INTO product(product_name,product_create_date,product_price,product_discount
        ,product_stock,product_type,product_detail,product_id_ref,product_logistic_weight,product_logistic_size_1
        ,product_logistic_size_2,product_logistic_size_3,product_logistic_amount,product_logistic_time,product_logistic_send
        ,create_by,product_img1,product_img2,product_img3,product_img4)
        VALUES ('{$product_name}', '{$date_now}', '{$product_price}','{$product_discount}','{$product_stock}','{$product_type}'
        ,'{$product_desc}','{$product_id_ref}','{$product_logistic_weight}','{$product_logistic_size_1}'
        ,'{$product_logistic_size_2}','{$product_logistic_size_3}','{$product_logistic_amount}'
        ,'{$product_logistic_time}','{$product_logistic_send}','{$session_id}'
        ,'{$files_name[0]}','{$files_name[1]}','{$files_name[2]}','{$files_name[3]}');";
        executeQuery($sql);

         $prodArrays = getProduct(0,' product_create_date DESC',1,'',$session_id);
        foreach($prodArrays as $_k => $v){
            $product_id = $prodArrays[$_k]['product_id'];
        }
        $target_prod_path = returnPath('product','',$product_id,'');
        $sqls = " INSERT INTO product_cate_rel(product_id,cate_id_multi) 
        VALUES ('{$product_id}','".implode(',',$subArrays)."');";
        executeQuery($sqls);
        foreach($files as $_original_file => $_original_file_value){ 
            rename($_original_file_value, $target_prod_path.basename($_original_file_value));
        } 
        
    }
   
}
if($action == 'product_add_img'){
   echo $session_id;
}
if($action == 'product_delete_img'){
    echo 'product_delete_img';
    echo ' id : >>'.$id. '<<';
    echo $_filename;
}
if($action == 'product_delete'){
    $_QUERYARRAYS =  array();
    $_QUERYARRAYS[] = "DELETE FROM product WHERE product_id = {$id}";
    $_QUERYARRAYS[] = "DELETE FROM product_cate_rel WHERE product_id = {$id}";
    $_QUERYARRAYS[] = "DELETE FROM product_brand_rel WHERE product_id = {$id}";
    $_QUERYARRAYS[] = "DELETE FROM account_rel_product WHERE product_id = {$id}";
    DELETE_STRUCTURE($_QUERYARRAYS);
 }
if($action == 'insert_favourite'){
    $date_now = date("Y-m-d H:i:s");
    $sql = "INSERT INTO account_rel_product(auth_account_id,product_id,create_date)
    VALUES ('{$session_id}', '{$id}','{$date_now}');";
    executeQuery($sql);
}

if($action == 'add_to_cart'){
    $bool = false;
    if(count($_SESSION['cart']['product'] > 0)){
        foreach($_SESSION['cart']['product'] as $_key => $_val){
            if($_val == $product_id){
                $bool = true;
            }
        }
    }    
    if($product_id > 0 && $bool == false){
        $_SESSION['cart']['product'][] = $product_id;
    }
}

if($action == 'save_to_cart'){
    // save amount and product id
    
    if(count($Object_SUMS)  > 0 && count($Object_AMOUNT) && count($Object_RECEIPT) > 0){
        foreach($Object_SUMS as $_keys => $_value){
            $_SESSION['cart']['orders'][$_keys]['product_id'] = $_keys;
            $_SESSION['cart']['orders'][$_keys]['value'] = $_value > 0 ? $_value : 0;
            $_SESSION['cart']['orders'][$_keys]['amount'] = $Object_AMOUNT[$_keys] > 0 ? $Object_AMOUNT[$_keys] : 0;
        }
        $_SESSION['cart']['receipt_orders'] = $Object_RECEIPT;
    }
}
if($action == 'save_to_cart_order_1'){
    $_SESSION['cart']['orders_1'] = $Object_AddressInfo;
}
if($action == 'save_to_cart_order_2'){
    $_SESSION['cart']['orders_2'] = $delivery_method;
}
if($action == 'save_to_cart_order_3'){
    $_SESSION['cart']['orders_3'] = $payments_method;
}
if($action == 'save_to_cart_order_4'){
   
    
    $order_purchase_number = "1X".substr(str_shuffle("abcdefghijklmnopqrstuvwxyz"), 0, rand(5,10))."-001".rand(1000000000,9999999999);
    $date_now = date("Y-m-d H:i:s");
    $quert_insert_orders = " INSERT INTO orders(order_account_id,order_create_date,order_date
    ,order_modifiled_date,order_status,order_purchase_number,order_payment_method
    ,order_shipping_method,order_customer_firstname_info,order_customer_lastname_info
    ,order_customer_company_info,order_customer_position_info,order_customer_address_info
    ,order_customer_phone_info,order_customer_fax_info,order_customer_email_info
    ,order_tax
    ,order_shipping_rate
    ,order_sum_orders,
    order_sum_all)  
    VALUES ('{$session_id}'
    , '{$date_now}'
    ,'{$date_now}'
    ,'{$date_now}'
    ,0
    ,'{$order_purchase_number}'
    ,'{$_SESSION['cart']['orders_2']}'
    ,'{$_SESSION['cart']['orders_3']}'
    ,'{$_SESSION['cart']['orders_1']['firstname']}'
    ,'{$_SESSION['cart']['orders_1']['lastname']}'
    ,'{$_SESSION['cart']['orders_1']['company']}'
    ,'{$_SESSION['cart']['orders_1']['position']}'
    ,'{$_SESSION['cart']['orders_1']['address']}'
    ,'{$_SESSION['cart']['orders_1']['phone']}'
    ,'{$_SESSION['cart']['orders_1']['fax']}'
    ,'{$_SESSION['cart']['orders_1']['email']}'
    ,'{$_SESSION['cart']['receipt_orders']['tax_orders']}'
    ,'{$_SESSION['cart']['receipt_orders']['logistic_orders']}'
    ,'{$_SESSION['cart']['receipt_orders']['sum_orders']}'
    ,'{$_SESSION['cart']['receipt_orders']['sum_all']}');";
    executeQuery($quert_insert_orders);

    $_SESSION['cart']['orders_4']['order_purchase_number'] = $order_purchase_number;
    $get_order_rel_prod =  get_order_rel_table($session_id,'',$order_purchase_number,'','','','','');
    if(count($Object_SUMS)  > 0 && count($Object_AMOUNT)){
        foreach($Object_SUMS as $_keys => $_value){
            $query_insert_order_rel = " INSERT INTO orders_rel_product(order_id,product_id,product_price,product_amount)  
            VALUES ( '{$get_order_rel_prod[$session_id]['attr']['order_id']}','{$_keys}','{$_value}','{$Object_AMOUNT[$_keys]}');";
            executeQuery($query_insert_order_rel);
        }
        unset($_SESSION['cart']);
        echo json_encode(array('order_id'=>$get_order_rel_prod[$session_id]['attr']['order_id']));   
    }
    
}
if($action == 'delete_to_cart'){
    if(count($_SESSION['cart']['product'] > 0)){
        foreach($_SESSION['cart']['product'] as $_key => $_val){
            if($_val == $product_id){
                unset($_SESSION['cart']['product'][$_key]);
                if(isset($_SESSION['cart']['orders'][$_val])){
                    unset($_SESSION['cart']['orders'][$_val]);
                }
            }
        }
    }  
}
?>

