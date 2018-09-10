<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>
<?php include("./include/category/category_variable.php");?>
<body>
    <?php include("./include/navbar.php");?>
    <style>
        .dz-image img{width: 100%;height: 100%;}
    </style>
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
 var content_id = '<?php echo empty($content_id) || ($content_id == 0) ? 0 : $content_id;?>';

    $("#submits_upd").click(function (e) {
            e.preventDefault();
            var html = $('div#content_paragraph').froalaEditor('html.get');
            var content_name = $('#content_name').val();
            var content_preface = $('#content_preface').val();
            $('#loadingDiv').show();
            var url = './include/ajax/content_form.php';
            $.ajax({
                type: "POST",
                url: url,
                data: {
               
                    content_id:content_id,
                    content_name:content_name,
                    content_preface:content_preface,
                    sections: html,
                    action: "content_update"
                },
                success: function (data, status, xhr) {
                    $('#loadingDiv').hide();
                    alert('แก้ไขข้อมูลเสร็จสมบูรณ์');
                    window.location.href = "admin-section.php?";
                }
            });
    });

</script>

</html>