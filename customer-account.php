<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>
    <?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

              
                <?php include("./include/profiles/profile_navleft.php");?>
                <?php

?>
                <div class="col-md-9">
                    <div class="box">
                        <h1>บัญชีผู้ใช้</h1>
                        <p class="lead">แก้ไขรหัสผ่านที่นี่.</p>
                        <p class="text-muted">รหัสผ่านจะต้องมีความยาวไม่น้อยกว่า4ตัวอักษร ไม่อนุญาติให้มีช่องว่างและอักขระพิเศษจำพวก / ( ) , \ ก-ฮ ๑-๙</p>

                        <h3>เปลี่ยนรหัสผ่าน</h3>

                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_old">*&nbsp;รหัสเก่า</label>
                                        <input type="password" class="form-control" id="password_old">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_1">*&nbsp;รหัสใหม่</label>
                                        <input type="password" class="form-control" id="password_1">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="password_2">*&nbsp;กรอกรหัสใหม่อีกครั้ง</label>
                                        <input type="password" class="form-control" id="password_2">
                                    </div>
                                </div>
                            </div>
                            <!-- /.row -->

                            <div class="col-sm-12 text-center">
                                <span  class="btn btn-primary" onclick="register_pwdChk()">
                                    <i class="fa fa-save"></i>บันทึกรหัสผ่าน</span>
                            </div>
                        </form>

                        <hr>

                       
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
<script>


</script>
</html>