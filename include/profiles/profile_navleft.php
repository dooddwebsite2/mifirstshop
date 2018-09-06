<div class="col-md-12">

    <ul class="breadcrumb">
        <li>
            <?php include("./include/content/page_breadcrumb.php");?>
        </li>
        <li>จัดการข้อมูล</li>
    </ul>

</div>

<?php

    $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : "";
    if(empty($user_id)){
        echo '<script>window.location.href = "index.php?activeNav=6a992d5529f459a44fee58c733255e86";alert("กรุณาเข้าสู่ระบบ");</script>';
        
    }
    
   
    /* SECURITY DECODE MD5 ONE TABLE*/
    $user_id = deCodeMD5_ONETABLE($user_id,'id','auth_account');
    /* END SECURITY DECODE MD5 ONE TABLE*/
    $profilesArrays = LoginFunc($user_id,'','');
    $firstKeysProfile = empty($user_id) ? '' : array_keys($profilesArrays)[0];
    $role_id = empty($firstKeysProfile) ? '' : $profilesArrays[$firstKeysProfile]['role_id'];
?>

<!-- *** CUSTOMER MENU ***
 _________________________________________________________ -->

<div class="col-md-3">
<?php 
 if ($role_id == 1){

 ?>
    <div class="panel panel-default sidebar-menu">

        <div class="panel-heading">
            <h3 class="panel-title">*สิทธิ์เฉพาะผู้ดูแลระบบ</h3>
        </div>

        <div class="panel-body">

            <ul class="nav nav-pills nav-stacked">

                <li>
                    <a href="admin-product.php">
                        <i class="fa fa-shopping-cart"></i>สินค้า</a>
                </li>
                <li>
                    <a href="admin-category.php">
                        <i class="fa fa-list-alt"></i>หมวดหมู่</a>
                </li>
                <li>
                    <a href="admin-section.php">
                        <i class="fa fa-book"></i>บทความ</a>
                </li>
                <li>
                    <a href="customer-account.php">
                        <i class="fa fa-user"></i>บัญชีลูกค้า</a>
                </li>

            </ul>
        </div>

    </div>
    <?php
    }
 ?>
    <div class="panel panel-default sidebar-menu">

        <div class="panel-heading">
            <h3 class="panel-title">จัดการข้อมูล</h3>
        </div>

        <div class="panel-body">

            <ul class="nav nav-pills nav-stacked">
                <li class="">
                    <a href="customer-account.php">
                        <i class="fa fa-user"></i>ข้อมูลส่วนตัว</a>
                </li>

                <li>
                    <a href="customer-orders.html">
                        <i class="fa fa-list"></i>รายการสั่งซื้อของฉัน</a>
                </li>
                <li>
                    <a href="customer-wishlist.html">
                        <i class="fa fa-heart"></i>รายการโปรด</a>
                </li>

                <li>
                    <a href="index.php">
                        <i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>

    </div>

</div>
<!-- /.col-md-3 -->

<!-- *** CUSTOMER MENU END *** -->