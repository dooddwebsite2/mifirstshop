<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>
    <?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">
            
              
                <?php include("./include/profiles/profile_navleft.php");?>
                <?php

?>
                <div class="col-md-9">
                    <div class="box">
                        <h1>รายการโปรด</h1>
                        <p class="lead">หากรายการโปรดใดที่ไม่แสดง นั่นแปลว่าสินค้าดังกล่าวถูกลบทิ้งไปจากระบบหรือไม่ก็ขายหมดแล้ว.</p>
                       
                        <form>
                        <?php
                        $account_prod_count = count(get_account_rel_product($user_id,'','','','','','')) > 0 ? get_account_rel_product($user_id,'','','','','','') : 0;
                   // echo '<PRE>';
                  //  print_r($account_prod_count);
                        ?>
                        <div class="row products">
                            <?php
                            if($account_prod_count != 0){
                                foreach($account_prod_count[$user_id]['child'] as $_kArr => $_vArr){
                                $prod_id = $account_prod_count[$user_id]['child'][$_kArr]['product_id'] > 0 ? $account_prod_count[$user_id]['child'][$_kArr]['product_id'] : 0;

                                $img1 = empty($account_prod_count[$user_id]['child'][$_kArr]["product_img1"]) ? 'no_image.png' : $account_prod_count[$user_id]['child'][$_kArr]["product_img1"];
                                $img1_path = empty($account_prod_count[$user_id]['child'][$_kArr]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$prod_id.'/'.$img1;
                                
                               
                                $cate_id = count(getProduct_withCategory($prod_id, '','' ,'','','','','')) > 0 ? getProduct_withCategory($prod_id, '','' ,'','','','','') : 0 ; 
                              
                            ?>
                            <div class="col-md-3 col-sm-4">
                                <div class="product">
                                    <div class="flip-container">
                                        <div class="flipper">
                                            <div class="front">
                                                <a href="detail.php?product_id=<?php echo $prod_id;?>&cate_id=<?php echo $cate_id[$prod_id]['parent_id'];?>">
                                                    <img src="<?php echo $img1_path;?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                            <div class="back">
                                            <a href="detail.php?product_id=<?php echo $prod_id;?>&cate_id=<?php echo $cate_id[$prod_id]['parent_id'];?>">
                                                     <img src="<?php echo $img1_path;?>" alt="" class="img-responsive">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <a href="#" class="invisible">
                                        <img src="img/product1.jpg" alt="" class="img-responsive">
                                    </a>
                                    <div class="text">
                                        <h3> <a href="detail.php?product_id=<?php echo $prod_id;?>&cate_id=<?php echo $cate_id[$prod_id]['parent_id'];?>"><?php echo $account_prod_count[$user_id]['child'][$_kArr]['product_name'];?></a></h3>
                                        <p class="price"><?php echo $account_prod_count[$user_id]['child'][$_kArr]['product_price'].'฿';?></p>
                                        <p class="buttons">
                                            <a href="detail.php?product_id=<?php echo $prod_id;?>&cate_id=<?php echo $cate_id[$prod_id]['parent_id'];?>" class="btn btn-default">View detail</a>
                                            <a href="basket.html" class="btn btn-primary"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </p>
                                    </div>
                                    
                                </div>
                                
                                </div>
                            <?php 
                                 }
                                } 
                            ?>
                            
                        </div>  
                        </form>

                        

                       
                    </div>
                </div>

            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <?php  include("./include/copyright.php");?>

    </div>
    <!-- /#all -->


</body>

<?php


?>

<?php
$profileArrays = LoginFunc($user_id,'','','1');
?>
<script>
var u_pass = '<?php echo $profileArrays[$user_id]['u_pass'] ?>';
var user_id = '<?php echo $user_id;?>';

</script>
</html>


