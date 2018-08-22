<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>
    <?php include("./include/navbar.php");?>
 
    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">
          
              
                <?php include("./include/profiles/profile_navleft.php");?>
              
                <div class="col-md-9">
                    <div class="box">
                        <h1>สินค้า&nbsp;&nbsp;<span class="btn btn-default btn-sm btn-success pull-right" style="margin-top:5px;">
                                    <i class="fa fa-pencil"></i> เพิ่ม</span></h1>
                        <p class="lead">เพิ่ม ลบ แก้ไข ข้อมูลสินค้าได้ที่นี่ (เฉพาะสิทธิ์ผู้ดูแลระบบเท่านั้น)</p>
                        <p class="text-muted">** หมายเหตุ เมื่อลบสินค้าแล้วความสัมพันธ์ของตารางอื่นที่ผูกกับสินค้าตัวนี้จะหายไปทั้งหมดอย่างถาวร ดูดีๆก่อนลบอย่ามือลั่น !!</p>


                        <form>
                            <?php
                                  $prodArrays = getProduct('', '','' ,'','','');
                       
                         
                            ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover dt-responsive display nowrap" cellspacing="0" id="table_product">
                                        <thead>
                                            <tr>
                                                <th style="text-align: center;">#</th>
                                                <th style="text-align: center;">ชื่อสินค้า</th>
                                                <th style="text-align: center;"></th>
                                                <th>หมวดหมู่</th>
                                                <th>รายละเอียด</th>
                                                <th>ราคา</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                foreach($prodArrays as $keyProd => $valProd){

                                                    $product_details = $prodArrays[$keyProd]['product_detail'];
                                                    if( strlen( $product_details) > 300) {
                                                        $str = explode( "\n", wordwrap( $product_details, 300));
                                                        $product_details = $str[0] . '...';
                                                    }
                                            ?>
                                                <td  align="center"><?php echo $keyProd; ?></td>
                                                <td  align="left"><?php echo $prodArrays[$keyProd]['product_name'];?></td>
                                                <td  align="left"><a href="#">
                                                    <img src="img/product/<?php echo $keyProd;?>/<?php echo $prodArrays[$keyProd]['product_img1'];?>" class="img img-responsive" alt="">
                                                </a></td>
                                                <td  align="left"><?php echo $prodArrays[$keyProd]['parent_name_th'].'->'.implode(", ", $prodArrays[$keyProd]['sub_cate_name']);?></td>
                                                <td  align="left"><?php echo $product_details;?></td>
                                                <td  align="center"><?php echo $prodArrays[$keyProd]['product_price'];?></td>
                                                <td  align="center"><a href="#">แก้ไข</a>/<a href="#">ลบ</a></td>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                </table>
                            </div>
                        </form>

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
$(document).ready( function () {
    $('#table_product').DataTable();
} );


</script>
</html>