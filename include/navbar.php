<!-- *** NAVBAR ***
 _________________________________________________________ -->
<?php


/* set default navBar active */
if(isset($_GET)){$navActive = empty($_GET['activeNav']) ? '6a992d5529f459a44fee58c733255e86' : deCodeMD5($_GET['activeNav']);}
?>
<form name="navBarPost" action="" method="post">
<div class="navbar navbar-default yamm" role="navigation" id="navbar">
    <div class="container">
        <div class="navbar-header">

            <a class="navbar-brand home" href="index.php" data-animate-hover="bounce">
                <img src="img/logo.png" alt="Obaju logo" class="hidden-xs">
                <img src="img/logo-small.png" alt="Obaju logo" class="visible-xs">
                <span class="sr-only">Obaju - go to homepage</span>
            </a>
            <div class="navbar-buttons">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <i class="fa fa-align-justify"></i>
                </button>
                <!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
                <a class="btn btn-default navbar-toggle" href="basket.html">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="hidden-xs">3 items in cart</span>
                </a> -->
            </div>
        </div>
        <!--/.navbar-header -->
        <!-- <ul class="nav nav-pills" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="pill" href="#home">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#men">Menu 1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="pill" href="#female">Menu 2</a>
            </li>
            <li class="nav-item">
                    <a class="nav-link" data-toggle="pill" href="#contact">Menu 2</a>
                </li>
        </ul> -->


        <div class="navbar-collapse collapse" id="navigation">

            <ul class="nav navbar-nav navbar-left">
                <li id="home" class="nav-item <?php if( $navActive == 'index'){echo 'active';}?> ThaifontBangnam navBarHeader">
                    <a href="index.php?activeNav=<?php echo md5('index'); ?>">หน้าหลัก</a>
                </li>

                
                <li id="men" class="<?php if( $navActive == 'men'){echo 'active';}?> dropdown yamm-fw">
                    <a href="#" class="dropdown-toggle ThaifontBangnam navBarHeader" data-toggle="dropdown" data-hover="dropdown" data-delay="200">ผู้ชาย
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Clothing</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php?activeNav=<?php echo md5('men');?>">T-shirts</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Shirts</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Pants</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Accessories</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Shoes</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Casual</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Accessories</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Casual</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Casual</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Featured</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                        </ul>
                                        <h5 class="ThaifontBangnam headerTxt">Looks and trends</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.yamm-content -->
                        </li>
                    </ul>
                </li>

                <li id="female" class="<?php if( $navActive == 'female'){echo 'active';}?>  dropdown yamm-fw">
                    <a href="#" class=" dropdown-toggle ThaifontBangnam navBarHeader" data-toggle="dropdown" data-hover="dropdown" data-delay="200">ผู้หญิง
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Clothing</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php?activeNav=<?php echo md5('female');?>">T-shirts</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Shirts</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Pants</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Accessories</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Shoes</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Casual</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Accessories</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Casual</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Casual</a>
                                            </li>
                                        </ul>
                                        <h5 class="ThaifontBangnam headerTxt">Looks and trends</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="category.php">Trainers</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Sandals</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Hiking shoes</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="banner">
                                            <a href="#">
                                                <img src="img/banner.jpg" class="img img-responsive" alt="">
                                            </a>
                                        </div>
                                        <div class="banner">
                                            <a href="#">
                                                <img src="img/banner2.jpg" class="img img-responsive" alt="">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.yamm-content -->
                        </li>
                    </ul>
                </li>

                <li id="faq" class="<?php if( $navActive == 'questions'){echo 'active';}?> ThaifontBangnam navBarHeader">
                    <a href="questions.php?activeNav=<?php echo md5('questions');?>">คำถามที่พบบ่อย</a>
                </li>
                <li id="howtobuy" class="<?php if( $navActive == 'howtobuy'){echo 'active';}?>  ThaifontBangnam navBarHeader">
                    <a href="howtobuy.php?activeNav=<?php echo md5('howtobuy');?>">วิธีการชำระเงิน</a>
                </li>
                <li id="contact" class="<?php if( $navActive == 'contact'){echo 'active';}?>  ThaifontBangnam navBarHeader">
                    <a href="contact.php?activeNav=<?php echo md5('contact');?>">ติดต่อเรา</a>
                </li>

                <!-- <li class="dropdown yamm-fw">
                    <a href="#" class="dropdown-toggle ThaifontBangnam navBarHeader" data-toggle="dropdown" data-hover="dropdown" data-delay="200">Template
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <div class="yamm-content">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Shop</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="index.php">Homepage</a>
                                            </li>
                                            <li>
                                                <a href="category.php">Category - sidebar left</a>
                                            </li>
                                            <li>
                                                <a href="category-right.html">Category - sidebar right</a>
                                            </li>
                                            <li>
                                                <a href="category-full.html">Category - full width</a>
                                            </li>
                                            <li>
                                                <a href="detail.html">Product detail</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">User</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="register.html">Register / login</a>
                                            </li>
                                            <li>
                                                <a href="customer-orders.html">Orders history</a>
                                            </li>
                                            <li>
                                                <a href="customer-order.html">Order history detail</a>
                                            </li>
                                            <li>
                                                <a href="customer-wishlist.html">Wishlist</a>
                                            </li>
                                            <li>
                                                <a href="customer-account.html">Customer account / change password</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Order process</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="basket.html">Shopping cart</a>
                                            </li>
                                            <li>
                                                <a href="checkout1.html">Checkout - step 1</a>
                                            </li>
                                            <li>
                                                <a href="checkout2.html">Checkout - step 2</a>
                                            </li>
                                            <li>
                                                <a href="checkout3.html">Checkout - step 3</a>
                                            </li>
                                            <li>
                                                <a href="checkout4.html">Checkout - step 4</a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="col-sm-3">
                                        <h5 class="ThaifontBangnam headerTxt">Pages and blog</h5>
                                        <ul class="ThaifontBangnam headerTxt">
                                            <li>
                                                <a href="blog.php">Blog listing</a>
                                            </li>
                                            <li>
                                                <a href="post.html">Blog Post</a>
                                            </li>
                                            <li>
                                                <a href="faq.html">FAQ</a>
                                            </li>
                                            <li>
                                                <a href="text.html">Text page</a>
                                            </li>
                                            <li>
                                                <a href="text-right.html">Text page - right sidebar</a>
                                            </li>
                                            <li>
                                                <a href="404.html">404 page</a>
                                            </li>
                                            <li>
                                                <a href="contact.php">Contact</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- /.yamm-content -->
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
        <!--/.nav-collapse -->

        <!-- <div class="navbar-buttons">

            <div class="navbar-collapse collapse right" id="basket-overview">
                <a href="basket.html" class="btn btn-primary navbar-btn">
                    <i class="fa fa-shopping-cart"></i>
                    <span class="hidden-sm">3 items in cart</span>
                </a>
            </div>
     

            <div class="navbar-collapse collapse right" id="search-not-mobile">
                <button type="button" class="btn navbar-btn btn-primary" data-toggle="collapse" data-target="#search">
                    <span class="sr-only">Toggle search</span>
                    <i class="fa fa-search"></i>
                </button>
            </div>

        </div>

        <div class="collapse clearfix" id="search">

            <form class="navbar-form" role="search">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search">
                    <span class="input-group-btn">

                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-search"></i>
                        </button>

                    </span>
                </div>
            </form>

        </div> -->
        <!--/.nav-collapse -->

    </div>
    <!-- /.container -->
</div>
<!-- /#navbar -->
</form>

<!-- *** NAVBAR END *** -->