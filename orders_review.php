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

                           
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต่อหน่วย&nbsp;(฿)</th>
                                            <th>ลดราคา&nbsp;(%)</th>
                                            <th align="center" colspan="1">รวม&nbsp;(฿)</th>
                                           
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // get product from session
                                        foreach($_SESSION['cart']['product'] as $_keys => $_vals){
                                            $prodArrays = getProduct($_vals,' product_create_date DESC',1,'','');
                                            $img1 = empty($prodArrays[$_vals]["product_img1"]) ? 'no_image.png' : $prodArrays[$_vals]["product_img1"];
                                            $img1_path = empty($prodArrays[$_vals]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$_vals.'/'.$img1;
                                            
                                            $percents = empty($prodArrays[$_vals]['product_discount']) ? 0 : $prodArrays[$_vals]['product_discount'];
                                            if(isset($_SESSION['cart']['orders'][$_vals]))
                                            {
                                                $price = $_SESSION['cart']['orders'][$_vals]['value'];
                                                $amount = $_SESSION['cart']['orders'][$_vals]['amount'];
                                            }else{
                                                $price = empty($prodArrays[$_vals]['product_price']) ? 0 : $prodArrays[$_vals]['product_price'];
                                                $amount = 1;
                                            }
                                        ?>
                                        <tr>
                                            <td>
                                                <a href="#">
                                                    <img src="<?php echo $img1_path;?>" alt="White Blouse Armani">
                                                </a>
                                            </td>
                                            <td><a href="#"><?php echo $prodArrays[$_vals]['product_name'].'&nbsp;(คงเหลือในสต็อค&nbsp;'.$prodArrays[$_vals]['product_stock']. ')';?></a>
                                            </td>
                                            <td>
                                                <input id="input_amout_<?php echo $_vals;?>" onchange="cal_sums(<?php echo $_vals;?>,<?php echo $percents;?>,<?php echo $prodArrays[$_vals]['product_price'];?>,<?php echo $prodArrays[$_vals]['product_stock'];?>)" type="number" value="<?php echo $amount;?>" min="0" max="<?php echo $prodArrays[$_vals]['product_stock'];?>"  hidden_id="<?php echo $_vals;?>" class="form-control input_amount" disabled>
                                            </td>
                                            <td><span><?php echo $prodArrays[$_vals]['product_price'].'';?></span></td>
                                            <td><span><?php echo empty($prodArrays[$_vals]['product_discount']) ? 0 : $prodArrays[$_vals]['product_discount'];?></span></td>
                                            <td><input id="sums_<?php echo $_vals;?>"  class="sum_input input_sum" hidden_id="<?php echo $_vals;?>"  style="text-align: left; " value="<?php echo $price.'';?>" disabled></td>
                                            
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="4">รวม</th>
                                            <th colspan="2"><input id="footer_sums" class="input_sum" style="text-align:right;" value="" disabled></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

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
    if($('.sum_input').length > 0){
        $('.sum_input').each(function(x,y) {
            var product_id = $(y).attr("hidden_id") > 0 ? $(y).attr("hidden_id") : 0;
            Object_SUMS[product_id] = $(y).val() > 0 ? $(y).val() : 0;
            
        });
        call_amount(".input_amount");
        cal_all(Object_SUMS);
        
    }
    console.log(Object_SUMS);
});
function cal_sums(product_id,percents,price,stock){
    
    var product_value = $('#input_amout_' + product_id).val();
    if(product_value <= stock){
        var percents  = percents > 0 ? percents  : 0; 
        var sums = (product_value * price) - (price * percents) / 100;
        $('#sums_'+ product_id).val(sums);
        Object_SUMS[product_id] = sums > 0 ? sums : 0;
        cal_all(Object_SUMS);
        call_amount(".input_amount");
    }
    else{
        alert("จำนวนสินค้าในสต็อคมีไม่เพียงพอ");
    }
}
function call_amount(prod_class){
    if($(prod_class).length > 0){
        $(prod_class).each(function(x,y) {
            var product_id = $(y).attr("hidden_id") > 0 ? $(y).attr("hidden_id") : 0;
            Object_AMOUNT[product_id] = $('#input_amout_' + product_id).val();
        });
    }
}



function save_draft_review(){
   
    $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';    
            $.ajax({
            type: "POST",
            url: url,
            data: {action:"save_to_cart_order_3"},
            success: function(data,status,xhr){
                $('#loadingDiv').hide();
                window.location.href = "orders_delivery.php";
            }
    });
}
</script>
</html>