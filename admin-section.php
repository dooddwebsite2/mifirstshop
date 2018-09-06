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
                        <h1>บทความ&nbsp;&nbsp;
                        <span onclick="window.location.href='admin-addsection.php'" class="btn btn-default btn-sm btn-success pull-right" style="margin-top:5px;"><i class="fa fa-pencil"></i> เพิ่ม</span></h1>
                        <form>
                            <?php
                             
                       
                             $condArrays = getContent('','','','','','','content_id');
                            //  echo '<PRE>';
                            //  print_r($condArrays);
                         
                            ?>
                            <div class="table-responsive">
                                <table id="table_product" class="table table-striped table-hover dt-responsive display nowrap"   cellspacing="0" style="width:100%" >
                                       
                                <thead>
                                            <tr>
                                            
                                                <th    style="text-align: center;">บทความ</th>
                                                <th   style="text-align: center;">คำนำ</th>
                                                <th   style="text-align: center;">ผู้สร้าง</th>
                                                <th  style="text-align: center;" >แสดงความคิดเห็น</th>
                                                <th   >&nbsp;</th>
                                             
                                            </tr>
                                        </thead>
                                        <tbody>
                                          
                                            <?php 
                                                foreach($condArrays as $condProd => $valProd){
                                                    ?>
                                                <tr>
                                                    <?php

                                                    $content_name = empty($condArrays[$condProd]['attr']['content_name']) ? '-':$condArrays[$condProd]['attr']['content_name'];
                                                    if( strlen( $content_name) > 50) {
                                                        
                                                        $str = explode("...",wordwrap( $content_name, 50, "...", true));
                                                        $content_name = $str[0] . '...';
                                                        
                                                    }
                                                    $content_preface = empty($condArrays[$condProd]['attr']['content_preface']) ? '-':$condArrays[$condProd]['attr']['content_preface'];
                                                    if( strlen( $content_preface) > 150) {
                                                        
                                                        $str = explode("...",wordwrap( $content_preface, 150, "...", true));
                                                        $content_preface = $str[0] . '...';
                                                        
                                                    }

                                                
                     
                                            ?>
        
                                                <td  align="left"><a href="#" onClick="call_productModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" ><?php echo $content_name;?></a></td>
                                                <td  align="left"><a href="#" onClick="call_productModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" >
                                                <?php echo $content_preface;?>
                                                </a></td>
                                                <td  align="center"><a href="#" onClick="call_productModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" > <?php echo $condArrays[$condProd]['attr']['u_name'];?></a></td>
                                                <td align="center"><a href="#" onClick="call_productModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด"><?php echo isset($condArrays[$condProd]['child'])? count($condArrays[$condProd]['child']) : '0';?></a></td>
                                                <td  align="left"><a href="admin-updcategory.php?cate_id=<?php echo $condProd;?>"  >แก้ไข</a>/<span class="actions"  onClick="call_delCategory(<?php echo $condProd;?>)">ลบ</span></td>
                                            
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

<!-- <textarea id="froala-editor">Initialize the Froala WYSIWYG HTML Editor on a textarea.</textarea> -->



<script>
$(document).ready( function () {
    // $('textarea#froala-editor').froalaEditor();
    $('#table_product').DataTable( {
      responsive: true,
        "columnDefs": [
            
            { "width": "10%", "targets": 0 },
            { "width": "40%", "targets": 1  },
            { "width": "40%", "targets": 2 },
            { "width": "5%", "targets": 3  },
            { "width": "5%", "targets": 4 ,"orderable": false },

        ],

    } );

    

} );


function call_delCategory(condProd){
    $('#loadingDiv').show();
        var url = './include/ajax/category_form_upd.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                cate_id: condProd,
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
function call_productModalAction(condProd){
    $('#loadingDiv').show();
            var url = './include/ajax/category_form.php';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    id: condProd,
                    action: "content_detail"
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
