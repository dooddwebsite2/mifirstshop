<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>
    <style>
        #mappic {
            border-radius: 5px;
            cursor: pointer;
            transition: 0.3s;
        }

        #mappic:hover {
            opacity: 0.7;
        }
    </style>
    <?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li>
                            <?php include("./include/content/page_breadcrumb.php");?>
                        </li>
                        <li>ติดต่อเรา</li>
                    </ul>

                </div>


                <div class="col-md-12">


                    <div class="box" id="contact">
                        <h1>ติดต่อเรา</h1>

                        <p>หากเพื่อนๆกำลังมีปัญหากับสินค้าของเราสามารถติดต่อได้ตามด้านล่างนี้เลยนะค่ะ</p>
                        <b>
                            <p>* เวลาทำการจันทร์- อาทิตย์ ตั้งแต่ 9.00 น. จนถึง 16.30 น.</p>
                        </b>

                        <hr>

                        <div class="row">
                            <div class="col-sm-4">
                                <h3>
                                    <i class="fa fa-map-marker"></i> ที่อยู่</h3>
                                <p>21 ลาดพร้าว 110
                                    <br>กทม.
                                    <br>แขวงพลับพลา เขตวังทองหลาง

                                    <br>รหัสไปรษณีย์ 10310
                                    <br>
                                    <strong>ประเทศไทย</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3>
                                    <i class="fa fa-phone"></i> โทร</h3>
                                <p class="text-muted">เวลาทำการจันทร์- อาทิตย์
                                    <br>ตั้งแต่ 9.00 น. จนถึง 16.30 น. </p>
                                <p>
                                    <strong>089-2221342</strong>
                                </p>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-4">
                                <h3>
                                    <i class="fa fa-envelope"></i> Line / Facebook</h3>
                                <p class="text-muted">เวลาทำการจันทร์- อาทิตย์
                                    <br>ตั้งแต่ 9.00 น. จนถึง 16.30 น. </p>
                                <ul>
                                    <li>
                                        <strong>Line ID :
                                            <a href="http://line.me/ti/p/mifirst">mifirst</a>
                                        </strong>
                                    </li>
                                    <li>
                                        <strong>Facebook :
                                            <a href="https://www.facebook.com/banitowninbox"> Mifirst First</a>
                                    </li>
                                </ul>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>
                        <!-- /.row -->

                        <hr>

                        <!-- <div id="map">

                        </div> -->


                        <!-- <img id="mappic" src="img/main-slider1.jpg" alt="แผนที่" class="img-responsive"> -->

                        <!-- <iframe id="map" width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCZEVlFGU3e-IavlW5izHVeGY3dEpfZchE&q=ladprao+110,ladprao+110" >
                        </iframe> -->

                        <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=13.7981058,100.5806117&amp;key=AIzaSyCZEVlFGU3e-IavlW5izHVeGY3dEpfZchE"></iframe>

                     
                        <hr>

                        <h2>แบบฟอร์มการติดต่อ</h2>

                        <form method="post" action="" data-toggle="modal" id="contactForm">




                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="firstname">ชื่อ*</label>
                                        <input type="text" class="form-control" id="firstname" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="lastname">นามสกุล*</label>
                                        <input type="text" class="form-control" id="lastname" required>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="email">อีเมล์*</label>
                                        <input type="email" class="form-control" id="email" required>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="subject">หัวข้อ*</label>
                                        <input type="text" class="form-control" id="subject" required>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="message">รายละเอียด*</label>
                                        <textarea id="message" class="form-control" required></textarea>
                                    </div>
                                </div>

                                <!-- <div class="col-sm-12 text-center">
                                    <button  class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">
                                        <i class="fa fa-envelope-o"></i> ส่งข้อมูล</button>

                                </div> -->
                                <div class="col-sm-12 text-center">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-envelope-o"></i> ส่งข้อมูล</button>
                                    </button>
                                </div>
                            </div>


                            <!-- /.row -->
                        </form>


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


</body>

<script>
    $('#contactForm').on('submit', function (e) {

        e.preventDefault(); //stop submit
        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();

        if (firstname || lastname || email || subject || message) {
            //Check if checkbox is checked then show modal
            $('#confirmModal').modal('show');
        }
    });
</script>




<!-- Modal IMAGE Only-->
<div id="myModal" class="modalImg">

    <!-- The Close Button -->
    <span id="closemodal" onclick="closes();" class="close">X</span>

    <!-- Modal Content (The Image) -->
    <img class="modalimg-content" id="img01">

    <!-- Modal Caption (Image Text) -->
    <div id="caption"></div>
</div>

<style>
    /* Style the Image Used to Trigger the Modal */

    /* The Modal (background) */

    .modalImg {
        display: none;
        /* Hidden by default */
        position: fixed;
        /* Stay in place */
        z-index: 1;
        /* Sit on top */
        padding-top: 100px;
        /* Location of the box */
        left: 0;
        top: 0;
        width: 100%;
        /* Full width */
        height: 100%;
        /* Full height */
        overflow: auto;
        /* Enable scroll if needed */
        background-color: rgb(0, 0, 0);
        /* Fallback color */
        background-color: rgba(0, 0, 0, 0.9);
        /* Black w/ opacity */
    }

    /* Modal Content (Image) */

    .modalimg-content {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
    }

    /* Caption of Modal Image (Image Text) - Same Width as the Image */

    #caption {
        margin: auto;
        display: block;
        width: 80%;
        max-width: 700px;
        text-align: center;
        color: #ccc;
        padding: 10px 0;
        height: 150px;
    }

    /* Add Animation - Zoom in the Modal */

    .modalimg-content,
    #caption {
        animation-name: zoom;
        animation-duration: 0.6s;
    }

    @keyframes zoom {
        from {
            transform: scale(0)
        }
        to {
            transform: scale(1)
        }
    }

    /* The Close Button */

    .close {
        position: absolute;
        top: 15px;
        right: 35px;
        color: #f1f1f1;
        font-size: 40px;
        font-weight: bold;
        transition: 0.3s;
    }

    .close:hover,
    .close:focus {
        color: #bbb;
        text-decoration: none;
        cursor: pointer;
    }

    /* 100% Image Width on Smaller Screens */

    @media only screen and (max-width: 700px) {
        .modalimg-content {
            width: 100%;
        }
    }
</style>

<script>
    $(document).ready(function () {

        // imageClick();
       // var width_div = $(".box").width();
       // initialize(width_div);

    });

    // function initialize(width_div) {
    //     var heightSize = width_div > 878 ? 3 : 4;
    //     var height_div = $(".box").height() / heightSize;
    //     $("#map").width(width_div);
    //     $("#map").height(height_div);
    // }

    // $(window).resize(function () {
    //     var width_div = $(".box").width();
    //     initialize(width_div);
    // });

    // function imageClick() {

    //     var modal = document.getElementById('myModal');

    //     // Get the image and insert it inside the modal - use its "alt" text as a caption
    //     var img = document.getElementById('mappic');
    //     var modalImg = document.getElementById("img01");
    //     var captionText = document.getElementById("caption");
    //     img.onclick = function () {
    //         modal.style.display = "block";
    //         modalImg.src = this.src;
    //         captionText.innerHTML = this.alt;
    //     }

    // }

    // function closes() {

    //     $('#myModal').css('display', 'none');
    // }
</script>


</html>