<head>

    <meta charset="utf-8">
    <meta name="robots" content="all,follow">
    <meta name="googlebot" content="index,follow,snippet,archive">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Obaju e-commerce template">
    <meta name="author" content="Ondrej Svestka | ondrejsvestka.cz">
    <meta name="keywords" content="">

    <title>
        MIFIRST SHOP : เว็บไซต์ขายเสื้อผ้าแฟชั่น เครื่องประดับ กระเป๋า ฯ
    </title>

    <meta name="keywords" content="">

    <!-- <link href='css/fonts/font-google.css?family=Roboto:400,500,700,300,100' rel='stylesheet' type='text/css'> -->

    <!-- styles -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/owl.carousel.css" rel="stylesheet">
    <link href="css/owl.theme.css" rel="stylesheet">

    <!-- theme stylesheet -->
    <link href="css/style.default.css" rel="stylesheet" id="theme-stylesheet">

    <!-- your stylesheet with modifications -->
    <link href="css/custom.css" rel="stylesheet">

    <script src="js/respond.min.js"></script>

    <link rel="shortcut icon" href="favicon.png">

        <!-- *** SCRIPTS TO INCLUDE ***
 _________________________________________________________ -->
 <script src="js/jquery-1.11.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.cookie.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/modernizr.js"></script>
    <script src="js/bootstrap-hover-dropdown.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/front.js"></script>
    <script src="js/bootstrapValidator.js"></script>

</head>

<!-- include center config -->
<?php require_once("config.php");?>


<!-- include loading  -->
<?php require_once("loading.php");?>

<script>
$(document).ready(function(){
$('body').find('img[src$="https://cdn.rawgit.com/000webhost/logo/e9bd13f7/footer-powered-by-000webhost-white2.png"]').remove();
});
</script>
<!-- include modal dialog -->
<?php
foreach (glob("./include/modal/*.php") as $modalDialog)
{
    require_once $modalDialog;
}




?>