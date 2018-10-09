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
                <li><?php echo 'ตรวจสอบการสั่งซื้อ';?></li>
            </ul>
        </div>

     

                 <div class="col-md-9" id="checkout">
                    <?php
                    $nav_title = 'order';
                    ?>
                    <div class="box">
                        <form method="post" action="checkout2.html">
                            <h1>ตรวจสอบการสั่งซื้อ</h1>
                           
                            <?php include("./include/product/order_nav_checkout.php");?>

                             <?php
                             $amount_disabled = true;
                             ?>
                            <?php include("./include/product/order_list.php");?>

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="orders_payment.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> ย้อนกลับ</a>
                                </div>
                                <div class="pull-right">
                                   
                                    <span onclick="save_draft_review()" class="btn btn-primary">ยืนยันการสั่งซื้อ <i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box -->
               
                  

                </div>
                <!-- /.col-md-9 -->

               <?php include("./include/product/order_summary.php");?>


                   

                </div>
                <!-- /.col-md-3 -->

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

  
  <?php // include("./include/footer.php");?>

<div id="fb-root"></div>
        
<?php  include("./include/copyright.php");?>


</div>
<!-- /#all -->

</body>
<script src="js/product/orders_summary.js"></script>



<script>
// token 
// EAADmEOzptvIBAEwHxpGqnnuUpx1DcP7uGqcQ5eMChyAv3ZAlEaXwSccd3vPCEFKTwoP5QqxTSAH7IZCvGOSk2ZAKaKcZCbyEmTTvWd3vGCbry3iuanZAjxc1KWHmZBguXRAZB74dHadZCWgcvUrxuZCqIwZCaRoA49hqbb0eDXesjxT3pkZAPd164tF


var Object_SUMS = {};
var Object_AMOUNT = {};

$( document ).ready(function() {
    on_load_set_default_value();
});
function save_draft_review(){
   var review_method = true;
    $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';    
            $.ajax({
            type: "POST",
            url: url,
            data: {review_method:review_method,action:"save_to_cart_order_4"},
            success: function(data,status,xhr){
                $('#loadingDiv').hide();
                window.location.href = "orders_review.php";
            }
    });
}
</script>
</html>