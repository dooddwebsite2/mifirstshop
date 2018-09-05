
<!-- include center config -->
<?php require_once("timezones.php");?>
<?php
session_start();
if(isset($_GET['profileUserID']) && isset($_SESSION["expire"]))
{ 
    $_SESSION["user_id"] = $_GET['profileUserID'];
  
}
$now = time(); // Checking the time now when home page starts.
// print_R($_SESSION);
// echo 'time now '.date("Y-m-d H:i:s",$now);
// print_r($_SESSION);
// echo 'expire  '.date("Y-m-d H:i:s",$_SESSION["expire"]);
if(isset($_SESSION["expire"])){
    if ($now > $_SESSION["expire"]) {
        session_destroy();
        header('Location: index.php?activeNav=6a992d5529f459a44fee58c733255e86');
       
    }
}

?>
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

    <!-- DATATABLE JQUERY PLUGIN -->
    <link rel="stylesheet" type="text/css" href="css/datatable/jquery-datatable.min.css">
    
    <link rel="stylesheet" type="text/css" href="css/datatable/jquery_datatable_rowreorder.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatable/jquery_datatable_responsive.min.css">
    <!-- JQUERY ROW EDITOR PLUGIN -->
    <!-- <link rel="stylesheet" type="text/css" href="css/datatable/jquery_datatable_button.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatable/jquery_datatable_editor.min.css">
    <link rel="stylesheet" type="text/css" href="css/datatable/jquery_datatable_select.min.css"> -->
   <!-- DROPZONE CSS -->
    <link rel="stylesheet" type="text/css" href="css/dropzone/basic.min.css">
    <link rel="stylesheet" type="text/css" href="css/dropzone/basic.css">
    <link rel="stylesheet" type="text/css" href="css/dropzone/dropzone.min.css">
   


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
    <script type="text/javascript" charset="utf8" src="js/datatable/jquery_datatable.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/datatable/jquery_datatable_rowreoder.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/datatable/jquery_datatable_responsive.min.js"></script>
    <!-- JQUERY DATATABLE SELECT , EDITOR , BUTTON PLUGINS-->
    <!-- <script type="text/javascript" charset="utf8" src="js/datatable/jquery_datatable_editor.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/datatable/jquery_datatable_button.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/datatable/jquery_datatable_select.min.js"></script> -->
    <!-- DROPZONE PLUGIN -->
    <script type="text/javascript" charset="utf8" src="js/dropzone/dropzone.min.js"></script>
    <script type="text/javascript" charset="utf8" src="js/dropzone/dropzone.js"></script>
    <script type="text/javascript" charset="utf8" src="js/dropzone/dropzone-amd-module.min.js"></script>
</head>

<!-- include center config -->
<?php require_once("config.php");?>


<!-- include loading  -->
<?php require_once("loading.php");?>

<script>
$(document).ready(function(){
    Dropzone.autoDiscover = false;
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
