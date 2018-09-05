<!-- *** HOT PRODUCT SLIDESHOW ***
 _________________________________________________________ -->
<div id="hot">

    <div class="box">
        <div class="container">
            <div class="col-md-12" align="center">
                <h2 class="ThaifontBangnam headerTxt">หมวดหมู่</h2>
            </div>
        </div>
    </div>

    <div class="container ThaifontBangnam ContentTxt">
        <div class="product-slider">
                <?php
                    /* get Category Query */

                    $cateArrays = getCategory('',''," CONVERT (cate_name_th USING tis620) ",'');
        
                    
                    /* ------------------ */
                ?>
               
            <?php if(!empty($cateArrays)){ 
                $x = 1;
                $rowCount = count($cateArrays);
               
               do {

            ?>
            <div class="item">
                <?php if(isset($cateArrays[$x])) {?>
                <div class="product">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <a href="category.php?cate_id=<?php echo $cateArrays[$x]['cate_id'];?>">
                                    <img src="<?php echo 'img/category/'.$cateArrays[$x]['cate_id'].'/';?><?php echo $cateArrays[$x]['cate_img_1'];?>" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="back">
                            <a href="category.php?cate_id=<?php echo $cateArrays[$x]['cate_id'];?>">
                                    <img src="<?php echo 'img/category/'.$cateArrays[$x]['cate_id'].'/';?><?php echo $cateArrays[$x]['cate_img_1'];?>" alt="" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="category.php?cate_id=<?php echo $cateArrays[$x]['cate_id'];?>" class="invisible">
                        <img src="<?php echo 'img/category/'.$cateArrays[$x]['cate_id'].'/';?><?php echo $cateArrays[$x]['cate_img_1'];?>" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3>
                            <a href="category.php?cate_id=<?php echo $cateArrays[$x]['cate_id'];?>"><?php echo $cateArrays[$x]['cate_name_th'];?></a>
                        </h3>

                    </div>

                </div>
                <?php } ?>
                <?php if(isset($cateArrays[$x + 1])) {?>
                <div class="product">
                    <div class="flip-container">
                        <div class="flipper">
                            <div class="front">
                                <a href="category.php?cate_id=<?php echo $cateArrays[$x + 1]['cate_id'];?>">
                                    <img src="<?php echo 'img/category/'.$cateArrays[$x + 1]['cate_id'].'/';?><?php echo $cateArrays[$x + 1]['cate_img_1'];?>" alt="" class="img-responsive">
                                </a>
                            </div>
                            <div class="back">
                            <a href="category.php?cate_id=<?php echo $cateArrays[$x + 1]['cate_id'];?>">
                                    <img src="<?php echo 'img/category/'.$cateArrays[$x + 1]['cate_id'].'/';?><?php echo $cateArrays[$x + 1]['cate_img_1'];?>" alt="" class="img-responsive">
                                </a>
                            </div>
                        </div>
                    </div>
                    <a href="category.php?cate_id=<?php echo $cateArrays[$x + 1]['cate_id'];?>" class="invisible">
                        <img src="<?php echo 'img/category/'.$cateArrays[$x + 1]['cate_id'].'/';?><?php echo $cateArrays[$x + 1]['cate_img_1'];?>" alt="" class="img-responsive">
                    </a>
                    <div class="text">
                        <h3>
                            <a href="category.php?cate_id=<?php echo $cateArrays[$x + 1]['cate_id'];?>"><?php echo $cateArrays[$x + 1]['cate_name_th'];?></a>
                        </h3>

                    </div>

                </div>
                <?php } ?>
            </div>
            <?php 
              $x += 2;
              } while ($x <= $rowCount);
            }
            ?>



        </div>
        <!-- /.product-slider -->
    </div>
    <!-- /.container -->

</div>
<!-- /#hot -->

<!-- *** HOT END *** -->

<!-- กล่องเป๋า
<a href="https://www.freepik.com/free-vector/variety-of-bags_956777.htm">Designed by Freepik</a> -->