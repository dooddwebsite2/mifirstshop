<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>


<body>
    <style>
    a.disabled {
        /*pointer-events: none;*/
        /*cursor: default;*/
    }
    </style>
    <?php include("./include/navbar.php");?>
    <?php include("./include/category/category_variable.php");?>
    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

             <div class="col-md-12 ContentTxt">
                    <ul class="breadcrumb">
                        <li>
                            <?php include("./include/content/page_breadcrumb.php");?>
                        </li>
                        <li><?php echo $cate_information['parent_name_th'];?></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    <?php include("./include/category/category_navleft.php");?>
                </div>
                <?php
                
                $u_id = !empty($_SESSION['user_id']) ?  deCodeMD5_ONETABLE($_SESSION['user_id'],'id','auth_account') : 0;

                
                if($_GET['product_id']){
                    $product_id = $_GET['product_id'];
                    
                    $account_prod_count = count(get_account_rel_product($u_id,$product_id,'','','','','')) > 0 ? count(get_account_rel_product($u_id,$product_id,'','','','','')) : 0;
                    $prodArrays = getProduct($product_id,' product_create_date DESC',1,'','');
                    $img1 = empty($prodArrays[$product_id]["product_img1"]) ? 'no_image.png' : $prodArrays[$product_id]["product_img1"];
                    $img1_path = empty($prodArrays[$product_id]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$product_id.'/'.$img1;

                    $img2 = empty($prodArrays[$product_id]["product_img2"]) ? 'no_image.png' : $prodArrays[$product_id]["product_img2"];
                    $img2_path = empty($prodArrays[$product_id]["product_img2"]) ? 'img/'.$img2 : 'img/product/'.$product_id.'/'.$img2;

                    $img3 = empty($prodArrays[$product_id]["product_img3"]) ? 'no_image.png' : $prodArrays[$product_id]["product_img3"];
                    $img3_path = empty($prodArrays[$product_id]["product_img3"]) ? 'img/'.$img3 : 'img/product/'.$product_id.'/'.$img3;

                    $img4 = empty($prodArrays[$product_id]["product_img4"]) ? 'no_image.png' : $prodArrays[$product_id]["product_img4"];
                    $img4_path = empty($prodArrays[$product_id]["product_img4"]) ? 'img/'.$img4 : 'img/product/'.$product_id.'/'.$img4;
                  
                }
                ?>
                <div class="col-md-9 ">

                    <div class="row" id="productMain">
                        <div class="col-sm-6">
                            <div id="mainImage" align="center">
                                <img src="<?php echo $img1_path;?>" alt="" class="img-responsive">
                            </div>

                        

                        </div>
                        <div class="col-sm-6">
                            <div class="box">
                                <h1 class="text-center"><?php echo $prodArrays[$product_id]['product_name'];?></h1>
                                <p class="goToDescription"><a href="#details" class="scroll-to">คลิ๊กเพื่อดูรายละเอียดสินค้า</a>
                                </p>
                                <p class="price"><?php echo $prodArrays[$product_id]['product_price'] > 0 ? $prodArrays[$product_id]['product_price'] : 0;?>฿</p>

                                <p class="text-center buttons">
                                    <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> เพิ่มลงตระกร้า</a> 
                                    <a href="#"  onclick="fav_action(<?php echo $product_id;?>)" class="<?php echo $account_prod_count > 0 ? 'btn btn-default disabled ' : 'btn btn-default';?>"><i class="fa fa-heart"></i> <?php echo $account_prod_count > 0 ? 'เพิ่มลงรายการโปรดแล้ว ' : 'เพิ่มรายการโปรด';?></a>
                                </p>


                            </div>

                            <div class="row" id="thumbs">
                                <div class="col-xs-4">
                                    <a href="<?php echo $img2_path;?>" class="thumb" >
                                        <img src="<?php echo $img2_path;?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="<?php echo $img3_path;?>" class="thumb">
                                        <img src="<?php echo $img3_path;?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                                <div class="col-xs-4">
                                    <a href="<?php echo $img4_path;?>" class="thumb">
                                        <img src="<?php echo $img4_path;?>" alt="" class="img-responsive">
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>


                    <div class="box" id="details">
                        <p>
                            <h1>รายละเอียดสินค้า</h1>
                            <p><?php echo $prodArrays[$product_id]['product_detail'];?></p>
                            <?php
                            if(!empty($prodArrays[$product_id]['product_meterial'])){
                            ?>
                            <h4>วัตถุดิบ</h4>
                                <p><?php echo $prodArrays[$product_id]['product_meterial'];?></p>
                            <?php
                            }
                            ?>

                            <?php
                            if(!empty($prodArrays[$product_id]['product_size'])){
                            ?>
                            <h4>ขนาด</h4>
                            <ul>
                                <p><?php echo $prodArrays[$product_id]['product_size'];?></p>
                            </ul>

                            <?php
                            }
                            ?>
                         
                            <!-- <div class="social">
                                <h4>Show it to your friends</h4>
                                <p>
                                    <a href="#" class="external facebook" data-animate-hover="pulse"><i class="fa fa-facebook"></i></a>
                                    <a href="#" class="external gplus" data-animate-hover="pulse"><i class="fa fa-google-plus"></i></a>
                                    <a href="#" class="external twitter" data-animate-hover="pulse"><i class="fa fa-twitter"></i></a>
                                    <a href="#" class="email" data-animate-hover="pulse"><i class="fa fa-envelope"></i></a>
                                </p>
                            </div> -->
                    </div>
                    <?php
                    $prod_cateArrays = getProduct_withCategory('', '','' ,'','','','','');
                    unset($prod_cateArrays[$product_id]);
                 
                    if(count($prod_cateArrays) > 0){

                        
                    ?>
                    <div class="row same-height-row">
                        <div class="col-md-3 col-sm-6">
                            <div class="box same-height">
                                <h3>สินค้าที่คุณอาจจะชอบ</h3>
                            </div>
                        </div>
                      
                        <div class="col-md-3 col-sm-6">
                            <div class="product same-height">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.php">
                                                <img src="img/product2.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.php">
                                                <img src="img/product2_2.jpg" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.php" class="invisible">
                                    <img src="img/product2.jpg" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>Fur coat</h3>
                                    <p class="price">$143</p>
                                </div>
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php
                        }
                        ?>
                      
                            <!-- /.product -->
                        </div>

                    </div>

              

                </div>
                <!-- /.col-md-9 -->
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
var u_id = <?php echo $u_id;?>;
var cate_id = <?php echo isset($_GET['cate_id']) ? $_GET['cate_id'] : 0;?>;
function fav_action(product_id){
    if(u_id > 0){
        $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                session_id: u_id,
                id: product_id,
                action: "insert_favourite"
            },
            success: function (data, status, xhr) {
                $('#loadingDiv').hide();
                window.location.href = "detail.php?product_id="+ product_id +"&cate_id=" + cate_id + "";
            }
        });
    }
    else{
        alert('กรุณาเข้าสู่ระบบ');
    }
}
</script>
</html>