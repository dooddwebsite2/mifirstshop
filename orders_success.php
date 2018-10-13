<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>


<body>
    <style>
    a.disabled {
        /*pointer-events: none;*/
        /*cursor: default;*/
    }
    .input_sum{
        border:none;
        background-color:transparent;
    }
    </style>
    <?php include("./include/navbar.php");?>
    <?php include("./include/category/category_variable.php");?>

     <div id="all" class="ThaifontBangnam">

<div id="content">
    <div class="container">

        <div class="col-md-12 ContentTxt">
            <ul class="breadcrumb">
                <li>
                    <?php include("./include/content/page_breadcrumb.php");?>
                </li>
                <li><?php echo 'รายละเอียดการสั่งซื้อ';?></li>
            </ul>
        </div>
        <?php 
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
        $user_id = deCodeMD5_ONETABLE($user_id,'id','auth_account');
        $get_order_rel_prod =  get_order_rel_table($user_id,$_GET['order_id'],'','','','','','');
        
        // echo '<PRE>';
        // print_r($get_order_rel_prod);
        ?>
     

                <div class="col-md-6 col-sm-6 col-xs-12" id="orders_addr">

                    <div class="box">

                        <form method="post" action="">

                            <h1>รายละเอียดการสั่งซื้อ(ที่อยู่จัดส่ง)</h1>
                          
                            <h2 class="text-muted"><b>ที่อยู่จัดส่ง</b></h2>
                            <h3 class="text-muted"><b>ชื่อ.</b><?php echo $get_order_rel_prod[$user_id]['attr']['order_customer_firstname_info'].' '.$get_order_rel_prod[$user_id]['attr']['order_customer_lastname_info']?></h3>
                            <h3 class="text-muted"><b>บริษัท.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_company_info'])? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_company_info']?>&nbsp;<b>ตำแหน่ง.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_position_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_position_info'];?></h3>
                        
                            <h3 class="text-muted"><b>ที่อยู่.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_address_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_address_info'];?></h3>
                            <h3 class="text-muted"><b>เบอร์.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_phone_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_phone_info'];?></h3>
                            <h3 class="text-muted"><b>fax.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_fax_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_fax_info'];?></h3>
                            <h3 class="text-muted"><b>email.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_email_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_email_info'];?></h3>
                            

                            <!-- <div class="box-footer">
                                <div class="pull-left">
                                    <a href="index.php?activeNav=6a992d5529f459a44fee58c733255e86" class="btn btn-default"><i class="fa fa-chevron-left"></i> ย้อนกลับ</a>
                                </div>
                                <div class="pull-right">
                                   
                                    <span onclick="save_draft_product()" class="btn btn-primary">ดำเนินการต่อ <i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                            </div> -->
                        </form>
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col-md-6 -->

                 <div class="col-md-6 col-sm-6 col-xs-12" id="orders_shipping_bank">

                    <div class="box">

                        <form method="post" action="">

                            <h1>รายละเอียดการสั่งซื้อ(ที่อยู่จัดส่ง)</h1>
                        
                            <h2 class="text-muted"><b>ที่อยู่จัดส่ง</b></h2>
                            <h3 class="text-muted"><b>ชื่อ.</b><?php echo $get_order_rel_prod[$user_id]['attr']['order_customer_firstname_info'].' '.$get_order_rel_prod[$user_id]['attr']['order_customer_lastname_info']?></h3>
                            <h3 class="text-muted"><b>บริษัท.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_company_info'])? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_company_info']?>&nbsp;<b>ตำแหน่ง.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_position_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_position_info'];?></h3>
                        
                            <h3 class="text-muted"><b>ที่อยู่.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_address_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_address_info'];?></h3>
                            <h3 class="text-muted"><b>เบอร์.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_phone_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_phone_info'];?></h3>
                            <h3 class="text-muted"><b>fax.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_fax_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_fax_info'];?></h3>
                            <h3 class="text-muted"><b>email.</b><?php echo empty($get_order_rel_prod[$user_id]['attr']['order_customer_email_info']) ? '-' : $get_order_rel_prod[$user_id]['attr']['order_customer_email_info'];?></h3>
                       
                        </form>
                    </div>
                    <!-- /.box -->
                    </div>
                    <!-- /.col-md-6 -->

               

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

  
  <?php // include("./include/footer.php");?>


        
<?php  include("./include/copyright.php");?>



</div>
<!-- /#all -->


</body>
<script src="js/product/orders_summary.js"></script>
<script>
var Object_SUMS = {};
var Object_AMOUNT = {};

$( document ).ready(function() {
    on_load_set_default_value(); 
});



function delete_product(product_id){

    $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';    
            $.ajax({
            type: "POST",
            url: url,
            data: {product_id:product_id,action:"delete_to_cart"},
            success: function(data,status,xhr){
                $('#loadingDiv').hide();
                delete Object_SUMS[product_id];
                window.location.href = "basket.php";
            }
    });
}
function save_draft_product(){
   
    var sum_orders = $('#sum_orders').attr("value");
    var logistic_orders = $('#logistic_orders').attr("value");
    var tax_orders  = $('#tax_orders').attr("value");
    var sum_all = $('#sum_all').attr("value");
    var Object_RECEIPT = {"sum_orders":sum_orders,"logistic_orders":logistic_orders,"tax_orders":tax_orders,"sum_all":sum_all}
    if(!jQuery.isEmptyObject(Object_SUMS) && !jQuery.isEmptyObject(Object_AMOUNT)){
        $('#loadingDiv').show();
            var url = './include/ajax/product_form.php';    
                $.ajax({
                type: "POST",
                url: url,
                data: {Object_SUMS:Object_SUMS,Object_AMOUNT:Object_AMOUNT,Object_RECEIPT:Object_RECEIPT,action:"save_to_cart"},
                success: function(data,status,xhr){
                    $('#loadingDiv').hide();
                    window.location.href = "orders_addr.php";
                }
        });
    }
    else{
        alert('กรุณาเลือกสินค้า');
    }
}
</script>
</html>