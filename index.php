<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>


<body>

    <?php // include("./include/topbar.php");?>


    <?php include("./include/navbar.php");?>

    <div id="all">

        <div id="content">

            <div class="container">
                <div class=" col-md-12 ">
                 
                        <div id="main-slider">
                        
                            <div class="item">
                                <img src="img/main-slider1.jpg" alt="" class="img-responsive">

                            </div>
                            <div class="item">
                                <img class="img-responsive" src="img/main-slider2.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="img/main-slider3.jpg" alt="">
                            </div>
                            <div class="item">
                                <img class="img-responsive" src="img/main-slider4.jpg" alt="">
                            </div>
                        </div>
                  
                        
                    
                </div>
            </div>
            
         


            <?php  include("./include/advantages_homepage.php");?>

            <?php  include("./include/category_display.php");?>


            <?php  include("./include/product/hot_product.php");?>

            <?php  // include("./include/home_slider_footer.php");?>

            <!-- *** BLOG HOMEPAGE ***
 _________________________________________________________ -->
            <?php  include("./include/content/home_page.php");?>

            <!-- *** BLOG HOMEPAGE END *** -->

        </div>
        <!-- /#content -->

        <?php // include("./include/footer.php");?>



        <?php  include("./include/copyright.php");?>



    </div>
    <!-- /#all -->



    <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->


</body>


</html>