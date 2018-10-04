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
                    $nav_title = 'delivery';
                    ?>
                    <div class="box">
                        <form method="post" action="checkout2.html">
                            <h1>ที่อยู่จัดส่ง</h1>
                            <?php include("./include/product/order_nav_checkout.php");?>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>ไปรษณีย์พัสดุธรรมดา</h4>

                                            <p>ไม่จำกัดน้ำหนัก ไม่สามารถตรวจสอบสถานะทางอินเทอร์เน็ตได้ ระยะเวลาในการจัดส่งภาคกลาง 3-5 วัน ระยะเวลาในการจัดส่งภาคอื่น 5-7 วัน</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="delivery" value="delivery1" <?php echo isset($_SESSION['cart']['orders_2']) && $_SESSION['cart']['orders_2'] == 'delivery1' ? 'checked' : ''; ?> >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>ไปรษณีย์พัสดุลงทะเบียน</h4>

                                            <p>น้ำหนักสินค้าไม่เกิน 1.7 กก. ตรวจสอบสถานะทางอินเทอร์เน็ตได้ ระยะเวลาในการจัดส่งภาคกลาง 3-5 วัน ระยะเวลาในการจัดส่งภาคอื่น 5-7 วัน</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="delivery" value="delivery2" <?php echo isset($_SESSION['cart']['orders_2']) && $_SESSION['cart']['orders_2'] == 'delivery2' ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4>ไปรษณีย์พัสดุ ส่งพิเศษ</h4>

                                            <p>ไม่จำกัดน้ำหนัก ตรวจสอบสถานะทางอินเทอร์เน็ตได้ ระยะเวลาในการจัดส่งภาคกลาง 1-2 วัน ระยะเวลาในการจัดส่งภาคอื่น 2-3 วัน</p>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="delivery" value="delivery3" <?php echo isset($_SESSION['cart']['orders_2']) && $_SESSION['cart']['orders_2'] == 'delivery3' ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="orders_addr.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>ย้อนกลับ</a>
                                </div>
                                <div class="pull-right">
                                    <span  onclick="save_draft_order_delivery()" class="btn btn-primary">ดำเนินการต่อ<i class="fa fa-chevron-right"></i>
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

function save_draft_order_delivery(){
    var delivery_method = $("input[name='delivery']:checked"). val() != 'undefined' && $("input[name='delivery']:checked"). val() != null ? $("input[name='delivery']:checked"). val() : 0 ;
    if(delivery_method != 0){
        $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';    
        $.ajax({
            type: "POST",
            url: url,
            data: {delivery_method:delivery_method,action:"save_to_cart_order_2"},
            success: function(data,status,xhr){
                $('#loadingDiv').hide();
                window.location.href = "orders_payment.php";
            }
        });
    }
    else{
        alert('กรุณาเลือกวิธีการจัดส่งพัสดุ');
    }
 
}

</script>
</html>