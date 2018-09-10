<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>
<?php include("./include/category/category_variable.php");?>
<body>
    <?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">
              
                <?php include("./include/profiles/profile_navleft.php");?>

                <?php include("./include/content/action_content.php");?>




            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <?php  include("./include/copyright.php");?>

    </div>
    <!-- /#all -->


</body>
<script>
    $(document).ready(function() {
        var session_id = '<?php echo $user_id;?>';
    

    $("#submits").click(function (e) {
            e.preventDefault();
          
           
            
    });
});
</script>

</html>