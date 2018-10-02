<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>

    <style>
    disabled {
        pointer-events: none;*/
        cursor: default;
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
                        <li><?php echo $cate_information['parent_name_th'];?></li>
                    </ul>
                </div>

                <div class="col-md-3">
                    <!-- *** MENUS AND FILTERS ***
 _________________________________________________________ -->
                    
                        <?php include("./include/category/category_navleft.php");?>
                    
                        <?php //include("./include/category/category_brand.php");?>
                    
                    

           
                    <!-- *** MENUS AND FILTERS END *** -->

                   
                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1><a href="category.php?cate_id=<?php echo $cate_id;?>"><?php echo $cate_information['parent_name_th'];?></a><?php if(!empty($sub_cate_active_name)){echo ' -> '.$sub_cate_active_name;}?></h1>
                        <h3><?php echo $cate_information['cate_desc'];?></h3>
                    </div>

                    <div class="box info-bar">
                        <div class="row">
                            <div class="col-sm-12 col-md-4 products-showing">
                                Showing
                                <strong>12</strong> of
                                <strong>25</strong> products
                            </div>

                            <div class="col-sm-12 col-md-8  products-number-sort">
                                <div class="row">
                                    <form class="form-inline">
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-number">
                                                <strong>Show</strong>
                                                <a href="#" class="btn btn-default btn-sm btn-primary">12</a>
                                                <a href="#" class="btn btn-default btn-sm">24</a>
                                                <a href="#" class="btn btn-default btn-sm">All</a> products
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-6">
                                            <div class="products-sort-by">
                                                <strong>Sort by</strong>
                                                <select name="sort-by" class="form-control">
                                                    <option>Price</option>
                                                    <option>Name</option>
                                                    <option>Sales first</option>
                                                </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                
                    ?>
                    <div class="row products">
                        <?php
                     
                        $product_cate_id = empty($_GET['cate_id']) ? '' : $_GET['cate_id'];
                        $product_sub_cate_id = empty($_GET['sub_cate_id']) ? '' : $_GET['sub_cate_id'];
                        $prodArrays = getProduct_withCategory('', $product_cate_id,$product_sub_cate_id ,'','','','','');
                     

                        ?>
                        <?php 
                    
                        foreach($prodArrays as $_prodKeys => $_prodValue){
                           $product_id = empty($prodArrays[$_prodKeys]['product_id']) ? '' : $prodArrays[$_prodKeys]['product_id'];
                           $product_name = empty($prodArrays[$_prodKeys]['product_name']) ? '' : $prodArrays[$_prodKeys]['product_name'];
                           $product_create_date = empty($prodArrays[$_prodKeys]['product_create_date']) ? '' : $prodArrays[$_prodKeys]['product_create_date'];
                           $product_active = empty($prodArrays[$_prodKeys]['product_active']) ? '' : $prodArrays[$_prodKeys]['product_active'];
                           $product_img1 = empty($prodArrays[$_prodKeys]['product_img1']) ? '' : $prodArrays[$_prodKeys]['product_img1'];
                           $product_price = empty($prodArrays[$_prodKeys]['product_price']) ? 0 : $prodArrays[$_prodKeys]['product_price'];
                           $strProductDate= strtotime($product_create_date);
                           $strbeforeDate = strtotime("-1 day", $strProductDate);
                           
                           $strtomorrowDate = strtotime("+1 day", $strProductDate);

                        //   echo date("Y-m-d H:i:s", $strbeforeDate);
                        //   echo '<BR>';
                        //   echo date("Y-m-d H:i:s", $strProductDate);
                        //   echo '<BR>';
                        //   echo date("Y-m-d H:i:s", $strtomorrowDate);
                        
                          
                        ?>
                        <div id="<?php echo $product_id;?>" class="col-md-4 col-sm-6">
                            <div class="product">
                                <div class="flip-container">
                                    <div class="flipper">
                                        <div class="front">
                                            <a href="detail.php?product_id=<?php echo $product_id;?>&cate_id=<?php echo $product_cate_id;?>">
                                                <img src="img/product/<?php echo $product_id;?>/<?php echo $product_img1;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="detail.php?product_id=<?php echo $product_id;?>&cate_id=<?php echo $product_cate_id;?>">
                                                <img src="img/product/<?php echo $product_id;?>/<?php echo $product_img1;?>" alt="" class="img-responsive">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <a href="detail.php" class="invisible">
                                    <img src="img/product/<?php echo $product_id;?>/<?php echo $product_img1;?>" alt="" class="img-responsive">
                                </a>
                                <div class="text">
                                    <h3>
                                        <a href="detail.php?product_id=<?php echo $product_id;?>&cate_id=<?php echo $product_cate_id;?>"><?php echo $product_name;?></a>
                                    </h3>
                                    <p class="price"><?php echo $product_price.'฿';?></p>
                                    <p class="buttons">
                                        <a href="detail.php?product_id=<?php echo $product_id;?>&cate_id=<?php echo $product_cate_id;?>" class="btn btn-default">ดูรายละเอียด</a>
                                        <?php
                              
                                        ?>
                                        <?php include("./include/product/add_to_cart.php");?>
                                    </p>
                                </div>
                                <!-- /.text -->
                                <!-- <div class="ribbon sale">
                                    <div class="theribbon">SALE</div>
                                    <div class="ribbon-background"></div>
                                </div> -->
                                <!-- /.ribbon -->
                                <?php 
                                  if (($strProductDate > $strbeforeDate) && ($strProductDate < $strtomorrowDate)){
                              
                                ?>
                                <div class="ribbon new">
                                    <div class="theribbon">NEW</div>
                                    <div class="ribbon-background"></div>
                                </div>
                                <?php
                                  } 
                                ?>
                                <!-- /.ribbon -->

                                <!-- <div class="ribbon gift">
                                    <div class="theribbon">GIFT</div>
                                    <div class="ribbon-background"></div>
                                </div> -->
                                <!-- /.ribbon -->
                            </div>
                            <!-- /.product -->
                        </div>
                        <?php
                            }
                        ?>


                        
                        <!-- /.col-md-4 -->
                    </div>
                    <!-- /.products -->

                    <div class="pages">

                        <!-- <p class="loadMore">
                            <a href="#" class="btn btn-primary btn-lg">
                                <i class="fa fa-chevron-down"></i> Load more</a>
                        </p> -->

                        <ul class="pagination">
                            <li>
                                <a href="#">&laquo;</a>
                            </li>
                            <li class="active">
                                <a href="#">1</a>
                            </li>
                            <li>
                                <a href="#">2</a>
                            </li>
                            <li>
                                <a href="#">3</a>
                            </li>
                            <li>
                                <a href="#">4</a>
                            </li>
                            <li>
                                <a href="#">5</a>
                            </li>
                            <li>
                                <a href="#">&raquo;</a>
                            </li>
                        </ul>
                    </div>


                </div>
                <!-- /.col-md-9 -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->


        <!-- /#footer -->

        <!-- *** FOOTER END *** -->

        <!-- *** COPYRIGHT ***
 _________________________________________________________ -->
        <?php  include("./include/copyright.php");?>
        <!-- *** COPYRIGHT END *** -->
    </div>
    <!-- /#all -->
</body>
<script>
var u_id = <?php echo $u_id;?>;
function add_to_cart(user_id,product_id){
    var user_id = user_id;
    var product_id = product_id;
    if(u_id > 0){
        $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';    
            $.ajax({
            type: "POST",
            url: url,
            data: {user_id:user_id,product_id:product_id,action:"add_to_cart"},
            success: function(data,status,xhr){
                $('#loadingDiv').hide();
                window.location.href = "category.php?cate_id=<?php echo $product_cate_id;?>";
            }
        });
    }
    else{
        alert('กรุณาเข้าสู่ระบบ');
    }
}
</script>
</html>