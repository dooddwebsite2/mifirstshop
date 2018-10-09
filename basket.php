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
                            
                            <?php
                            $amount_disabled = false;
                            ?>
                            <?php include("./include/product/order_list.php");?>

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