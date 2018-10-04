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
                <li><?php echo 'ที่อยู่จัดส่ง';?></li>
            </ul>
        </div>

                <div class="col-md-9" id="checkout">
                    <?php
                    $nav_title = 'addr';
                    ?>
                    <div class="box">
                        <form method="post" action="checkout2.html">
                            <h1>ที่อยู่จัดส่ง</h1>
                            <?php include("./include/product/order_nav_checkout.php");?>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="firstname">ชื่อ</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['firstname']:''; ?>" id="firstname">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="lastname">นามสกุล</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['lastname']:''; ?>" id="lastname">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="company">บริษัท(ถ้ามี)</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['company']:''; ?>" id="company">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="position">ตำแหน่ง(ถ้ามี)</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['position']:''; ?>" id="position">
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->

                                <div class="row">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label for="address">ที่อยู่</label>
                                            <textarea rows="4" class="form-control" value="" id="address" cols="50"><?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['address']:''; ?></textarea>
                                        </div>
                                    </div>
                                  
                                </div>
                                <!-- /.row -->
                                <div class="row">
                               

                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="phone">เบอร์โทรศัพท์</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['phone']:''; ?>" id="phone">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="fax">เบอร์โทรสาร</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['fax']:''; ?>" id="fax">
                                        </div>
                                    </div>
                                    <div class="col-sm-4 col-md-4">
                                        <div class="form-group">
                                            <label for="email">อีเมล์</label>
                                            <input type="text" class="form-control" value="<?php echo isset($_SESSION['cart']['orders_1']) ? $_SESSION['cart']['orders_1']['email']:''; ?>" id="email">
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="basket.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>ย้อนกลับ</a>
                                </div>
                                <div class="pull-right">
                                    <span  onclick="save_draft_order_address()" class="btn btn-primary">ดำเนินการต่อ<i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- /.box -->


                </div>
                <!-- /.col-md-9 -->

                <?php include("./include/product/order_summary.php");?>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->
        
        <?php  include("./include/copyright.php");?>



    </div>
    <!-- /#all -->


    




</body>
<?php
// echo '<PRE>';
// print_r($_SESSION);
?>
<script src="js/product/orders_summary.js"></script>
<script>
var Object_SUMS = <?= count(json_encode($_SESSION['cart']['receipt_orders']));?> > 0 ? <?= json_encode($_SESSION['cart']['receipt_orders']);?> : 0;

$( document ).ready(function() {
    if(Object_SUMS != 0){
     set_orders_summary(
      Object_SUMS['sum_orders']
     ,Object_SUMS['logistic_orders']
     ,Object_SUMS['tax_orders']
     ,Object_SUMS['sum_all']);
    }
});

function save_draft_order_address(){
    var firstname = $('#firstname').val();
    var lastname = $('#lastname').val();
    var company = $('#company').val();
    var position = $('#position').val();
    var address =$('textarea#address').val();
    var phone = $('#phone').val();
    var fax = $('#fax').val();
    var email = $('#email').val();
    
    var Object_AddressInfo = {"firstname":firstname,"lastname":lastname,"company":company,
        "position":position,"address":address,"phone":phone,"fax":fax,"email":email
    };
    var Obj_rechk = Object_Check(Object_AddressInfo);
    if(Obj_rechk == true){
        $('#loadingDiv').show();
            var url = './include/ajax/product_form.php';    
                $.ajax({
                type: "POST",
                url: url,
                data: {Object_AddressInfo:Object_AddressInfo,action:"save_to_cart_order_1"},
                success: function(data,status,xhr){
                    $('#loadingDiv').hide();
                    window.location.href = "orders_delivery.php";
                }
        });
    }
    else{
        alert('กรุณากรอกข้อมูลให้ครบถ้วน');
    }
}

function Object_Check(Obj){
    if(Object.keys(Obj).length > 0){
        for (var key in Obj) {
            if((Obj[key] == '' || Obj[key] == null || Obj[key] == 'undefined'  ) && key != 'company' && key != 'position')
            {
                return false;
            }
        }
    }

    return true;
}

</script>
</html>