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

                        <form method="post" action="checkout1.html">

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
                                            $price = empty($prodArrays[$_vals]['product_price']) ? 0 : $prodArrays[$_vals]['product_price'];
                                           
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
                                                <input id="input_amout_<?php echo $_vals;?>" onchange="cal_sums(<?php echo $_vals;?>,<?php echo $percents;?>,<?php echo $price;?>,<?php echo $prodArrays[$_vals]['product_stock'];?>)" type="number" value="<?php echo 1;?>" min="0" max="<?php echo $prodArrays[$_vals]['product_stock'];?>"  class="form-control">
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
                                    <a href="category.php" class="btn btn-default"><i class="fa fa-chevron-left"></i> Continue shopping</a>
                                </div>
                                <div class="pull-right">
                                    <button class="btn btn-default"><i class="fa fa-refresh"></i> Update basket</button>
                                    <button type="submit" class="btn btn-primary">Proceed to checkout <i class="fa fa-chevron-right"></i>
                                    </button>
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

                <div class="col-md-3">
                    <div class="box" id="order-summary">
                        <div class="box-header">
                            <h3>รายการสั่งซื้อ</h3>
                        </div>
                        <p class="text-muted">สำหรับรายละเอียดของของการสั่งซื้อนั้น เพื่อความรวดเร็ว และรวมถึงความถูกต้องในการบันทึกบัญชีเมื่อสั่งซื้อเสร็จและชำระเงินมีปัญหาใดๆ กรุณารีบติดต่อเราโดยทันที </p>

                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>ยอดสั่งซื้อในออเดอร์</td>
                                        <th><span id="sum_orders" class="input_sum" value=""></span></th>
                                    </tr>
                                    <tr>
                                        <td>ค่าจัดส่ง</td>
                                        <th><span id="logistic_orders" value=""></span></th>
                                    </tr>
                                    <tr>
                                        <td>ภาษี</td>
                                        <th><span id="tax_orders" value=""></span></th>
                                    </tr>
                                    <tr class="total">
                                        <td>รวมสุทธิ</td>
                                        <th><span id="sum_all" class="input_sum" value=""></span></th>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>


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
<script>
var Object_SUMS = {};
// set logistic 
var logistic_val = 30;
// set tax
var tax = 0;
$( document ).ready(function() {
    if($('.sum_input').length > 0){
        $('.sum_input').each(function(x,y) {
            Object_SUMS[$(y).attr("hidden_id")] = $(y).val() > 0 ? $(y).val() : 0;
        });
        cal_all(Object_SUMS);
        console.log(Object_SUMS);
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
    }
    else{
        alert("จำนวนสินค้าในสต็อคมีไม่เพียงพอ");
    }
}

function cal_all(Obj_all){
    var total = 0;
    if(Object.keys(Obj_all).length > 0){
        for (var key in Obj_all) {
            total += parseFloat(Obj_all[key]);
        }
    }
    $('#footer_sums').val(total + " ฿");
    $('#sum_orders').text(total + " ฿");
    $('#logistic_orders').text(logistic_val + " ฿");
    var tax  = tax > 0 ? tax  : 0; 
    $('#tax_orders').text(tax + " %");
   
    var sums = (total + logistic_val) - ((total + logistic_val) * tax) / 100;
    $('#sum_all').text(sums + " ฿");
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

</script>
</html>