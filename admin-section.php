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
                        <span onclick="window.location.href='admin-addsection.php'" class="btn btn-default btn-sm btn-success pull-right" style="margin-top:5px;"><i class="fas fa-plus"></i> เพิ่ม</span></h1>
                        <form>
                            <?php
                             
                       
                             $condArrays = getContent('','','','','','','content_id');
                            //   echo '<PRE>';
                            //   print_r($condArrays);
                         
                            ?>
                            <div class="table-responsive">
                                <table id="table_content" class="table table-striped table-hover dt-responsive display nowrap"   cellspacing="0" style="width:100%" >
                                       
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
        
                                                <td  align="left"><a href="#" onClick="call_contentModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" ><?php echo $content_name;?></a></td>
                                                <td  align="left"><a href="#" onClick="call_contentModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" >
                                                <?php echo $content_preface;?>
                                                </a></td>
                                                <td  align="center"><a href="#" onClick="call_contentModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด" > <?php echo $condArrays[$condProd]['attr']['u_name'];?></a></td>
                                                <td align="center"><a href="#" onClick="call_contentModalAction(<?php echo $condProd;?>)"   title="คลิ๊กเพื่อดูรายละเอียด"><?php echo isset($condArrays[$condProd]['child'])? count($condArrays[$condProd]['child']) : '0';?></a></td>
                                                <td  align="left"><a href="admin-updsection.php?content_id=<?php echo $condProd;?>"  >แก้ไข</a>/<span class="actions"  onClick="call_delContent(<?php echo $condProd;?>)">ลบ</span></td>
                                            
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
    $('#table_content').DataTable( {
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


function call_delContent(condProd){
    $('#loadingDiv').show();
    var url = './include/ajax/content_form.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                content_id: condProd,
                action: "content_delete"
            },
            success: function (data, status, xhr) {
                $('#loadingDiv').hide();
                alert('ลบข้อมูลเสร็จสมบูรณ์');
                window.location.href = "admin-section.php?";
            }
        });
}
function call_contentModalAction(condProd){
    $('#loadingDiv').show();
            var url = './include/ajax/content_form.php';
            $.ajax({
                type: "POST",
                url: url,
                data: {
                    content_id: condProd,
                    action: "content_detail"
                },
                success: function (data, status, xhr) {
                    $('#loadingDiv').hide();
                    var contents = data;
                    $('#productdetailmodal').find('#productdetailmodalLabel_headerTxt').html('บทความ');
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
