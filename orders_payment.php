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
                <li><?php echo 'ชำระเงิน';?></li>
            </ul>
        </div>

                <div class="col-md-9" id="checkout">
                    <?php
                    $nav_title = 'payment';
                    ?>
                    <div class="box">
                        <form method="post" action="checkout2.html">
                            <h1>ชำระเงิน</h1>
                            <?php include("./include/product/order_nav_checkout.php");?>

                            <div class="content">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4><b><?php echo !empty(func_payment_method('bangkok_bank','header')) ? func_payment_method('bangkok_bank','header') : '';?></b></h4>

                                            <h4><b><?php echo !empty(func_payment_method('bangkok_bank','content')) ? func_payment_method('bangkok_bank','content') : '';?><br>** โอนแล้วแจ้งสลิป ชื่อที่อยู่ด้วยนะ</b></h4>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payments" value="bangkok_bank" <?php echo isset($_SESSION['cart']['orders_3']) && $_SESSION['cart']['orders_3'] == 'bangkok_bank' ? 'checked' : ''; ?> >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                               <h4><b><?php echo !empty(func_payment_method('krugthai_bank','header')) ? func_payment_method('krugthai_bank','header') : '';?></b></h4>

                                                <h4><b><?php echo !empty(func_payment_method('krugthai_bank','content')) ? func_payment_method('krugthai_bank','content') : '';?><br>** โอนแล้วแจ้งสลิป ชื่อที่อยู่ด้วยนะ</b></h4>

                                            <div class="box-footer text-center">

                                                <input type="radio" name="payments" value="krugthai_bank" <?php echo isset($_SESSION['cart']['orders_3']) && $_SESSION['cart']['orders_3'] == 'krugthai_bank' ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4><b><?php echo !empty(func_payment_method('kbank_bank','header')) ? func_payment_method('kbank_bank','header') : '';?></b></h4>

                                            <h4><b><?php echo !empty(func_payment_method('kbank_bank','content')) ? func_payment_method('kbank_bank','content') : '';?><br>** โอนแล้วแจ้งสลิป ชื่อที่อยู่ด้วยนะ</b></h4>
                                           
                                            <div class="box-footer text-center">

                                                <input type="radio" name="payments" value="kbank_bank" <?php echo isset($_SESSION['cart']['orders_3']) && $_SESSION['cart']['orders_3'] == 'kbank_bank' ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box shipping-method">

                                            <h4><b><?php echo !empty(func_payment_method('scb_bank','header')) ? func_payment_method('scb_bank','header') : '';?></b></h4>

                                            <h4><b><?php echo !empty(func_payment_method('scb_bank','content')) ? func_payment_method('scb_bank','content') : '';?><br>** โอนแล้วแจ้งสลิป ชื่อที่อยู่ด้วยนะ</b></h4>
                                           
                                            <div class="box-footer text-center">

                                                <input type="radio" name="payments" value="scb_bank" <?php echo isset($_SESSION['cart']['orders_3']) && $_SESSION['cart']['orders_3'] == 'scb_bank' ? 'checked' : ''; ?>>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.row -->
                            </div>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="orders_delivery.php" class="btn btn-default"><i class="fa fa-chevron-left"></i>ย้อนกลับ</a>
                                </div>
                                <div class="pull-right">
                                    <span  onclick="save_draft_order_payment()" class="btn btn-primary">ดำเนินการต่อ<i class="fa fa-chevron-right"></i>
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
// token: 252960368604914|2EKT7ljBxQcsrYuGvWY0VOVKZFA

// echo '<PRE>';
// print_r($_SESSION);
//$coupon_code = array("cc4d555f999" => "25%");
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

function save_draft_order_payment(){
    var payments_method = $("input[name='payments']:checked"). val() != 'undefined' && $("input[name='payments']:checked"). val() != null ? $("input[name='payments']:checked"). val() : 0 ;
    if(payments_method != 0){
        $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';    
        $.ajax({
            type: "POST",
            url: url,
            data: {payments_method:payments_method,action:"save_to_cart_order_3"},
            success: function(data,status,xhr){
                $('#loadingDiv').hide();
                window.location.href = "orders_review.php";
            }
        });
    }
    else{
        alert('กรุณาเลือกชำระเงิน');
    }
 
}

</script>
</html>