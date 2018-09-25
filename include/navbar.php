
<?php include("./include/topbar.php");?>

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

            <a class="navbar-brand home" href="index.php?activeNav=6a992d5529f459a44fee58c733255e86" data-animate-hover="bounce">
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

                <li id="faq" class="<?php if( $navActive == 'blog'){echo 'active';}?> ThaifontBangnam navBarHeader">
                    <a href="blog.php?activeNav=<?php echo md5('blog');?>">บทความ</a>
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

                
                        </li>
                    </ul>
                </li>
            </ul>

        </div>
      

    </div>
    <!-- /.container -->
</div>
<!-- /#navbar -->
</form>
<!-- <div class="container">
    <div class="row">
        <div class="col-md-3 col-sm-3 col-xs-3 banner">
            <a href="#">
                <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3   banner">
            <a href="#">
                <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3  banner">
            <a href="#">
                <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
            </a>
        </div>
        <div class="col-md-3 col-sm-3 col-xs-3  banner">
            <a href="#">
                <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
            </a>
        </div>
    </div>
</div>
<br> -->
<!-- *** NAVBAR END *** -->