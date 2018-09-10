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
                        <h1>หมวดหมู่&nbsp;&nbsp;
                        <span onclick="window.location.href='admin-addcategory.php'" class="btn btn-default btn-sm btn-success pull-right" style="margin-top:5px;"><i class="fas fa-plus"></i> เพิ่ม</span></h1>
                        <form>
                            <?php
                             
                                  $cateArrays = getSubCategory('','','');
                    
                            ?>
                            <div class="table-responsive">
                                <table id="table_product" class="table table-striped table-hover dt-responsive display nowrap"   cellspacing="0" style="width:100%" >
                                       
                                <thead>
                                            <tr>
                                            
                                                <th    style="text-align: center;">หมวดหมู่</th>
                                                <th   style="text-align: center;">&nbsp;</th>
                                                <th   style="text-align: center;">หมวดหมู่ย่อย</th>
                                                <th  style="text-align: center;" >รายละเอียด</th>
                                                <th   >&nbsp;</th>
                                             
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <?php 
                                                foreach($cateArrays as $keyProd => $valProd){
                                                    ?>
                                                <tr>
                                                    <?php

                                                    $cate_desc = empty($cateArrays[$keyProd]['cate_desc']) ? '-':$cateArrays[$keyProd]['cate_desc'];
                                                    if( strlen( $cate_desc) > 50) {
                                                        
                                                        $str = explode("...",wordwrap( $cate_desc, 50, "...", true));
                                                        $cate_desc = $str[0] . '...';
                                                        
                                                    }
                                                
                                                    $img1 = empty($cateArrays[$keyProd]["parent_img_1"]) ? 'no_image.png' : $cateArrays[$keyProd]["parent_img_1"];
                                                    $img1_path = empty($cateArrays[$keyProd]["parent_img_1"]) ? 'img/'.$img1 : 'img/category/'.$keyProd.'/'.$img1;
                                                    
                     
                                            ?>
        
                                                <td  align="left"><a href="#" onClick="call_productModalAction(<?php echo $keyProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" ><?php echo $cateArrays[$keyProd]['parent_name_th'];?></a></td>
                                                <td  align="left"><a href="#" onClick="call_productModalAction(<?php echo $keyProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" >
                                                    <img src="<?php echo $img1_path;?>" class="img img-responsive" style="max-width: 50px;max-height:50px;" alt="">
                                                </a></td>
                                                <td  align="center"><a href="#" onClick="call_productModalAction(<?php echo $keyProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" ><?php echo implode(", ", $cateArrays[$keyProd]['sub_cate_name']);?></a></td>
                                                <td align="center"><a href="#" onClick="call_productModalAction(<?php echo $keyProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด"><?php echo $cate_desc;?></a></td>
                                                <td  align="left"><a href="admin-updcategory.php?cate_id=<?php echo $keyProd;?>"  >แก้ไข</a>/<span class="actions"  onClick="call_delCategory(<?php echo $keyProd;?>)">ลบ</span></td>
                                            
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
            { "width": "10%", "targets": 1  },
            { "width": "30%", "targets": 2 },
            { "width": "40%", "targets": 3  },
            { "width": "10%", "targets": 4 ,"orderable": false },

        ],

    } );

    

} );


function call_delCategory(keyProd){
    $('#loadingDiv').show();
        var url = './include/ajax/category_form_upd.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                cate_id: keyProd,
                action: "category_delete"
            },
            success: function (data, status, xhr) {
                $('#loadingDiv').hide();
                var jsonArraysList = JSON.parse(xhr.responseText);
                var html = 'สินค้ามีการผูกอยู่กับหมวดหมู่นี้อยู่ ลบไม่ได้ ต้องไปแก้ความสัมพันธ์สินค้าดังกล่าวก่อน' + "\n";
                var count=0;
                if(jsonArraysList.status == true){
                    $.each(jsonArraysList.prodArrays, function($_prodKeys, $_prodVal)
                    {
                        ++ count;
                        html += count + ". " + $_prodVal.product_name + "\n";
                    });
                    alert(html);
                }else{
                   alert('ลบข้อมูลเสร็จสมบูรณ์');
                   window.location.href = "admin-category.php?";
                }
            }
        });
}
function call_productModalAction(keyProd){
    $('#loadingDiv').show();
            var url = './include/ajax/category_form.php';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: keyProd,
                    action: "category_detail"
                },
                success: function (data, status, xhr) {
                    $('#loadingDiv').hide();
                    var contents = data;
                    $('#productdetailmodal').find('#productdetailmodalLabel_headerTxt').html('หมวดหมู่');
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
