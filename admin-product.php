<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>

<body>
    <?php include("./include/navbar.php");?>
 
    <div id="all" class="ThaifontBangnam ContentTxt">
        <style>
            .actions{
               color:#4fbfa8;
               text-decoration:none;
               cursor:pointer;
            }
        </style>
        <div id="content">
            <div class="container">
          
              <style>

            </style>

                <?php include("./include/profiles/profile_navleft.php");?>
              
                <div class="col-md-9">
                    <div class="box">
                        <h1>สินค้า&nbsp;&nbsp;
                        <span onclick="window.location.href='admin-addproduct.php'" class="btn btn-default btn-sm btn-success pull-right" style="margin-top:5px;"><i class="fa fa-pencil"></i> เพิ่ม</span></h1>
                        <!-- <p class="lead">เพิ่ม ลบ แก้ไข ข้อมูลสินค้าได้ที่นี่ (เฉพาะสิทธิ์ผู้ดูแลระบบเท่านั้น)</p>
                        <p class="text-muted">** หมายเหตุ เมื่อลบสินค้าแล้วความสัมพันธ์ของตารางอื่นที่ผูกกับสินค้าตัวนี้จะหายไปทั้งหมดอย่างถาวร ดูดีๆก่อนลบอย่ามือลั่น !!</p> -->


                        <form>
                            <?php
                                  $prodArrays = getProduct_withCategory('', '','' ,'','','','','');   
                            ?>
                            <div class="table-responsive">
                                <table id="table_product" class="table table-striped table-hover dt-responsive display nowrap"   cellspacing="0" style="width:100%" >
                                       
                                <thead>
                                            <tr>
                                                <!-- <th  style="text-align: center;">#</th> -->
                                                <th   style="text-align: center;">ชื่อสินค้า</th>
                                                <th   style="text-align: center;">&nbsp;</th>
                                                <th   style="text-align: center;">หมวดหมู่</th>
                                                <th   style="text-align: center;" >จำนวนสินค้า</th>
                                                <!-- <th  style="text-align: center;" >รายละเอียด</th> -->
                                                <th   style="text-align: center;" >ราคา(฿)</th>
                                                <th   >&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <?php 
                                                foreach($prodArrays as $keyProd => $valProd){
                                                    ?>
                                                <tr>
                                                    <?php

                                                    $product_details = empty($prodArrays[$keyProd]['product_detail']) ? '-':$prodArrays[$keyProd]['product_detail'];
                                                    $img1 = empty($prodArrays[$keyProd]["product_img1"]) ? 'no_image.png' : $prodArrays[$keyProd]["product_img1"];
                                                    $img1_path = empty($prodArrays[$keyProd]["product_img1"]) ? 'img/'.$img1 : 'img/product/'.$keyProd.'/'.$img1;

                                                    if( strlen( $product_details) > 50) {
                                                        
                                                        $str = explode("...",wordwrap( $product_details, 50, "...", true));
                                                        $product_details = $str[0] . '...';
                                                        
                                                    }

                                                    $product_discount= $prodArrays[$keyProd]["product_discount"] > 0 ? $prodArrays[$keyProd]["product_discount"] : 1;
                                                    $product_discount_txt = $prodArrays[$keyProd]["product_discount"] > 0 ? $prodArrays[$keyProd]["product_discount"] : 0; 
                                                    $product_percent = $prodArrays[$keyProd]["product_discount"] > 0 ? 100 : 1;
                                                    $product_price= $prodArrays[$keyProd]["product_price"] > 0 ? ( $prodArrays[$keyProd]["product_price"] - ($prodArrays[$keyProd]["product_price"] * (($prodArrays[$keyProd]["product_discount"]) / $product_percent) )) : 0;
   
                                            ?>
                                                <!-- <td  align="center"><a href="#"  onClick="call_productModalAction(<?php echo $keyProd;?>)" title="คลิ๊กเพื่อดูรายละเอียด"><?php echo $keyProd; ?></a></td>
                                                -->
                                                <td  align="left"><a href="#"  onClick="call_productModalAction(<?php echo $keyProd;?>)" title="คลิ๊กเพื่อดูรายละเอียด" ><?php echo $prodArrays[$keyProd]['product_name'];?></a></td>
                                                <td  align="left"><a href="#"  onClick="call_productModalAction(<?php echo $keyProd;?>)" title="คลิ๊กเพื่อดูรายละเอียด" >
                                                    <img src="<?php echo $img1_path;?>" class="img img-responsive" style="max-width: 50px;max-height:50px;" alt="">
                                                </a></td>
                                                <td  align="center"><a href="#"  onClick="call_productModalAction(<?php echo $keyProd;?>)" title="คลิ๊กเพื่อดูรายละเอียด" ><?php echo $prodArrays[$keyProd]['parent_name_th'].'->'.implode(", ", $prodArrays[$keyProd]['sub_cate_name']);?></a></td>
                                                <td align="center"><a href="#"  onClick="call_productModalAction(<?php echo $keyProd;?>)" title="คลิ๊กเพื่อดูรายละเอียด"><?php echo $prodArrays[$keyProd]['product_stock'];?></a></td>
                                                <td  align="center"><a href="#"  onClick="call_productModalAction(<?php echo $keyProd;?>)" title="คลิ๊กเพื่อดูรายละเอียด"><?php echo $product_price;?></a></td>
                                                <td  align="left"><a href="admin-updproduct.php?product_id=<?php echo $keyProd;?>"  >แก้ไข</a>/<span class="actions"  onClick="call_deleteFunc(<?php echo $keyProd;?>)">ลบ</span></td>
                                                </tr>
                                            <?php
                                                }
                                            ?>
                                          
                                        </tbody>
                                </table>
                            </div>
                            <input id="hiddenProdId" type="hidden">
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
    
    $('#table_product').DataTable( {
      responsive: true,
        "columnDefs": [
            
            { "width": "10%", "targets": 0 },
            { "width": "10%", "targets": 1 ,"orderable": false },
            { "width": "30%", "targets": 2 },
            { "width": "10%", "targets": 3 },
            { "width": "20%", "targets": 4 },
            { "width": "20%", "targets": 5 ,"orderable": false},

        ],

    } );

    

} );


function call_deleteFunc(keyProd){
    $('#loadingDiv').show();
        var url = './include/ajax/product_form.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                id: keyProd,
                action: "product_delete"
            },
            success: function (data, status, xhr) {
                $('#loadingDiv').hide();
                window.location.href = "admin-product.php?";
            }
        });
}
function call_productModalAction(keyProd){
    $('#loadingDiv').show();
            var url = './include/ajax/product_form.php';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: keyProd,
                    action: "product_details"
                },
                success: function (data, status, xhr) {
                    $('#loadingDiv').hide();
                    var contents = data;
                    $("#productdetailmodal").find(".modal-body").html(contents);
                    $('#productdetailmodal').modal('show');
                }
            });
   
}

</script>
</html>


<!-- back up
// rowReorder: {
//     selector: 'td:nth-child(2)'
// },
    // scrollX: true,
// scrollY:        "300px",

// scrollCollapse: true,

// paging:         true, -->
