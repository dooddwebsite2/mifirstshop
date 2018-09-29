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
                        <h1>บัญชีลูกค้า</h1>
                        <p class="lead">แบนลูกค้า,ลบบัญชีทิ้ง,ตรวจสอบประวัติการสั่งซื้อ คร่าวๆ</p>
                        <p class="text-muted">เมื่อแบนจะสามารถกลับมาใช้ใหม่ได้เมื่อเราปลดแบน ไม่สามารถเลือกแบนโดยตั้งเวลาได้<br>**แต่ถ้าเราลบทิ้งจะหายไปถาวรไม่สามารถกู้คืนได้ (แก้ไขสิทธิ์ role ต้องไปแก้ในฐานข้อมูลเอา TABLE auth_account เอา)</p>
                    
                        <form>
                        <div class="table-responsive">
                                <table id="table_product" class="table table-striped table-hover dt-responsive display nowrap"   cellspacing="0" style="width:100%" >
                                       
                                <thead>
                                            <tr>
                                            <?php
                                            
                                            ?>
                                                <th    style="text-align: center;">ชื่อผู้ใช้</th>
                                                <th style="text-align: center;">บทบาท</th>
                                                <th   style="text-align: center;">ประวัติการสั่งซื้อ</th>
                                                <th  style="text-align: center;" >แบนบัญชีผู้ใช้</th>
                                                <th   style="text-align: center;">ลบบัญชีผู้ใช้ถาวร</th>
                                             
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                        <?php
                                            $auth_account = LoginFunc('','','','');
                                            unset($auth_account[$user_id]);
                                          
                                            foreach($auth_account as $_keys => $_value){
                                        ?>
                                            <tr>
                                            <?php                                    
                                            ?>
        
                                                <td  align="left"><?php echo $auth_account[$_keys]['u_name'] ? $auth_account[$_keys]['u_name']: "";?></td>
                                                <td align="left"><?php echo $roles[$auth_account[$_keys]['role_id'] - 1];?></td>
                                                <td  align="center"><a href="#" onclick="view_action(<?php echo $_keys;?>)">ดูรายละเอียด</a></td>
                                                <td  align="center"><a  href="#" onclick="ban_action(<?php echo $_keys;?>,<?php echo $auth_account[$_keys]['u_active'];?>)" >
                                                    <?php echo $auth_account[$_keys]['u_active'] > 0 ? "แบน":"ปลดแบน"?>
                                            </a>
                                                </td>
                                                <td  align="center"><a href="#" onclick="delete_action(<?php echo $_keys;?>)">ลบ</a></td>
                                            
                                            </tr>
                                        <?php
                                            }
                                        ?>
                                          
                                        </tbody>
                                </table>
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

<?php


?>

<?php
$profileArrays = LoginFunc($user_id,'','','');
?>
<script>
$(document).ready( function () {
    
    $('#table_product').DataTable( {
      responsive: true,
        "columnDefs": [
            
            { "width": "30%", "targets": 0 },
            { "width": "30%", "targets": 1  },
            { "width": "30%", "targets": 2 },

            { "width": "10%", "targets": 3 ,"orderable": false },

        ],

    } );

    

} );
function view_action(id){
    alert(id);
}
function delete_action(id){
    var del_butt = confirm("ยืนยันจะลบบัญชีนี้ใช่ไหม ?");
    if (del_butt == true) {
        var url = './include/ajax/register_form.php';    
                    $.ajax({
                    type: "POST",
                    url: url,
                    data: {user_id:id,action:"delete_user"},
                    success: function(data,status,xhr){
                        var jsonStatus = JSON.parse(xhr.responseText);
                        if(jsonStatus.status  == false){
                            alert("ไม่สามารถลบบัญชีผู้ใช้นี้ได้");
                        }
                        else{
                            window.location.href = "customer-admin.php";alert("ดำเนินการเสร็จสมบูรณ์");
                        }
                }
        });
    } else {
        console.log('cancle');
    }
}
function ban_action(id,status){
    var ban_butt = confirm("ยืนยันจะแบนบัญชีนี้ใช่ไหม ?");
    if (ban_butt == true) {
        var url = './include/ajax/register_form.php';    
                    $.ajax({
                    type: "POST",
                    url: url,
                    data: {user_id:id,status:status,action:"ban_user"},
                    success: function(data,status,xhr){
                        var jsonStatus = JSON.parse(xhr.responseText);
                        if(jsonStatus.status  == false){
                            alert("ไม่สามารถแบนบัญชีผู้ใช้นี้ได้");
                        }
                        else{
                            window.location.href = "customer-admin.php";alert("ดำเนินการเสร็จสมบูรณ์");
                        }
                }
        });
    } else {
        console.log('cancle');
    }
}

</script>
</html>


