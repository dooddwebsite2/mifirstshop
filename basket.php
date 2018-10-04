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
                <li><?php echo 'ตระกร้าสินค้า';?></li>
            </ul>
        </div>

     

                <div class="col-md-9" id="basket">

                    <div class="box">

                        <form method="post" action="">

                            <h1>ตระกร้าสินค้า</h1>
                            <p class="text-muted">You currently have <?php echo count($_SESSION['cart']['product']);?> item(s) in your cart.</p>
                            
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th colspan="2">สินค้า</th>
                                            <th>จำนวน</th>
                                            <th>ราคาต่อหน่วย&nbsp;(฿)</th>
                                            <th>ลดราคา&nbsp;(%)</th>
                                            <th align="center" colspan="2">รวม&nbsp;(฿)</th>
                                           
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
                                                <input id="input_amout_<?php echo $_vals;?>" onchange="cal_sums(<?php echo $_vals;?>,<?php echo $percents;?>,<?php echo $prodArrays[$_vals]['product_price'];?>,<?php echo $prodArrays[$_vals]['product_stock'];?>)" type="number" value="<?php echo $amount;?>" min="0" max="<?php echo $prodArrays[$_vals]['product_stock'];?>"  hidden_id="<?php echo $_vals;?>" class="form-control input_amount">
                                            </td>
                                            <td><span><?php echo $prodArrays[$_vals]['product_price'].'';?></span></td>
                                            <td><span><?php echo empty($prodArrays[$_vals]['product_discount']) ? 0 : $prodArrays[$_vals]['product_discount'];?></span></td>
                                            <td><input id="sums_<?php echo $_vals;?>"  class="sum_input input_sum" hidden_id="<?php echo $_vals;?>"  style="text-align: left; " value="<?php echo $price.'';?>" disabled></td>
                                            <td><a href="#" onclick="delete_product(<?php echo $_vals;?>)"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                 
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="5">รวม</th>
                                            <th colspan="2"><input id="footer_sums" class="input_sum" style="text-align:right;" value="" disabled></th>
                                        </tr>
                                    </tfoot>
                                </table>

                            </div>
                            <!-- /.table-responsive -->

                            <div class="box-footer">
                                <div class="pull-left">
                                    <a href="index.php?activeNav=6a992d5529f459a44fee58c733255e86" class="btn btn-default"><i class="fa fa-chevron-left"></i> ย้อนกลับ</a>
                                </div>
                                <div class="pull-right">
                                   
                                    <span onclick="save_draft_product()" class="btn btn-primary">ดำเนินการต่อ <i class="fa fa-chevron-right"></i>
                                    </span>
                                </div>
                            </div>

                        </form>

                    </div>
                    <!-- /.box -->


                    <?php
                    $prod_cateArrays = getProduct_withCategory('', '','' ,'','','','','');
                    // unset($prod_cateArrays[$product_id]);
                    $prod_cateArrays = array_slice($prod_cateArrays,0,3);
                                        
                 
                    if(count($prod_cateArrays) > 0){
                            
                        
                    ?>
                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>สินค้าที่คุณอาจจะชอบ</h3>
                            </div>
                        </div>
                        <?php
                        foreach($prod_cateArrays as $_prod_cate_keys => $_prod_cate_value){
                            $prod_id = $prod_cateArrays[$_prod_cate_keys]['product_id'] > 0 ? $prod_cateArrays[$_prod_cate_keys]['product_id'] : 0;

                            $img1 = empty($prod_cateArrays[$_prod_cate_keys]["product_img1"]) ? 'no_image.png' : $prod_cateArrays[$_prod_cate_keys]["product_img1"];
                            $img1_path = empty($prod_cateArrays[$_prod_cate_keys]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$prod_id.'/'.$img1;
                            
                        ?>
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.php?product_id=<?php echo $prod_id;?>&cate_id=<?php echo $prod_cateArrays[$_prod_cate_keys]['parent_id'];?>">
                                            <img src="<?php echo $img1_path;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                           <a href="detail.php?product_id=<?php echo $prod_id;?>&cate_id=<?php echo $prod_cateArrays[$_prod_cate_keys]['parent_id'];?>">
                                            <img src="<?php echo $img1_path;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="#" class="invisible">
                                    <img src="img/product2.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3><?php echo $prod_cateArrays[$_prod_cate_keys]['product_name'];?></h3>
                                    <p class="price"><?php echo $prod_cateArrays[$_prod_cate_keys]['product_price'].'';?></p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php
                        }
                        ?>
                        <?php
                        }
                        ?>
                      
                            <!-- /.product -->
                        </div>


                </div>
                <!-- /.col-md-9 -->

               <?php include("./include/product/order_summary.php");?>


                    <div class="box">
                        <div class="box-header">
                            <h4>Coupon code</h4>
                        </div>
                        <p class="text-muted">รหัสคูปองจะได้จากโปรโมชั่นหน้าเพจ คอยติดตามนะค่ะ ^^</p>
                        <form>
                            <div class="input-group">

                                <input type="text" class="form-control">

                                <span class="input-group-btn">

					<button class="btn btn-primary" type="button"><i class="fa fa-gift"></i></button>

				    </span>
                            </div>
                            <!-- /input-group -->
                        </form>
                    </div>

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
    if($('.sum_input').length > 0){
        $('.sum_input').each(function(x,y) {
            var product_id = $(y).attr("hidden_id") > 0 ? $(y).attr("hidden_id") : 0;
            Object_SUMS[product_id] = $(y).val() > 0 ? $(y).val() : 0;
            
        });
        call_amount(".input_amount");
        cal_all(Object_SUMS);
        
    }
    
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