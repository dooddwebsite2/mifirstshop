<!DOCTYPE html>
<html lang="en">


<?php include("./include/header.php");?>

<body>
   
<?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                       <li>
                            <?php include("./include/content/page_breadcrumb.php");?>
                        </li>
                        <li>สมัครสมาชิก</li>
                    </ul>

                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>สมัครสมาชิก</h1>

                        <p class="lead"></p>
                        <p>เงื่อนไขการสมัครสมาชิก
                            <br>1.ลูกค้าแจ้งคืนสินค้าได้ในกรณีที่สินค้าเกิดการชำรุด
                        </p>
                        <p class="text-muted">ถ้ามีปัญหาหรือคำถามอะไรสามารถติดต่อเราได้ที่ <a href="contact.php"> คลิ๊กที่นี่ !!</a></p>

                        <hr>

                        <form action="customer-orders.html" method="post">
                            <div class="form-group">
                                <label for="name">ชื่อ*</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">อีเมล์*</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">รหัสผ่าน*</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-user-md"></i> สมัครสมาชิก</button>
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="banner">
                        <a href="#">
                            <img src="img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                    <div class="banner">
                        <a href="#">
                            <img src="img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                    <div class="banner">
                        <a href="#">
                            <img src="img/banner.jpg" alt="sales 2014" class="img-responsive">
                        </a>
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

</html>
