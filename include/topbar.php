  <!-- *** TOPBAR ***
 _________________________________________________________ -->

 <div id="top" class="">
    <div class="container ThaifontBangnam ">
        <div class="col-md-6 offer" data-animate="fadeInDown">
            
        </div>
        <div class="col-md-6  " data-animate="fadeInDown">
            <ul class="menu">
                <?php if(empty($_SESSION['user_id'])){ ?>
                <li><a href="#"  data-toggle="modal" data-target="#login-modal">เข้าสู่ระบบ</a></li>
                <?php } ?>
                <?php if(!empty($_SESSION['user_id'])){
                    $u_id = deCodeMD5_ONETABLE($_SESSION['user_id'],'id','auth_account');
                    $profileArr = LoginFunc($u_id,'','');
                    $firstKeyProd = empty($u_id) ? '' : array_keys($profileArr)[0];
                    $user_name = empty($firstKeyProd) ? '' : $profileArr[$firstKeyProd]['u_name'];

                    
                    ?>
                <li><a href="customer-account.php" >จัดการข้อมูล <?php echo $user_name;?></a></li>
                <?php } ?>
                <?php if(empty($_SESSION['user_id'])){ ?>
                <li><a href="register.php">สมัครสมาชิก</a>
                </li>
                <?php } ?>
                <?php if(!empty($_SESSION['user_id'])){ ?>
                 <li><a id="Logout" href="./include/ajax/logout_form.php" onclick="LogoutAction()">ออกจากระบบ</a></li>
                <?php } ?>
                <!--<li><a href="#">Recently viewed</a>
                </li> -->
            </ul>
        </div>
    </div>
    

</div>
<script>
function LogoutAction()
{
    // เผื่ออนาคตต้องใช้เก็บอะไร
    // $('#loadingDiv').show();
    // var url = './include/ajax/post_form.php';
    // $.ajax({
    //     type: "POST",
    //     url: url,
    //     data: {
    //         action: "logout_form"
    //     },
    //     success: function (data, status, xhr) {
    //         $('#loadingDiv').hide();
    //         window.location.href = "/mifirstshop/index.php?activeNav=6a992d5529f459a44fee58c733255e86";
              
    //     }
    // });
    //window.location.href = "/mifirstshop/index.php?activeNav=6a992d5529f459a44fee58c733255e86";
            
}
</script>
<!-- *** TOP BAR END *** -->
