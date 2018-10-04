<form id="action_product" action="./include/ajax/category_form.php" method="post" enctype="multipart/form-data">
    <?php
    $prodType = getProductType();
    $cate_id = 0;
    if(isset($_GET['cate_id'])){
        $cate_id = $_GET['cate_id'];
        $cateArrs = getSubCategory($cate_id,'','','','','','');
      
        // echo '<PRE>';
        
        // print_R($cateArrs);
    }
    ?>    
    <div class="col-md-9">
        <div class="box">
            <h1><?php echo (!empty($cateArrs) && isset($_GET['cate_id'])) ? 'แก้ไขหมวดหมู่' : 'เพิ่มหมวดหมู่';?></h1>
            <p class="lead">กรุณากรอกข้อมูลให้ครบถ้วนทุกช่อง ไม่ได้ validate มันเยอะ</p>
            <p class="text-muted">** สำคัญมากพวกหมวดหมู่ต้องเลือกด้วยห้ามปล่อยว่าง
                ถ้าไม่มีหมวดหมู่ที่ต้องการก็ไปสร้างซะ</p>
            <hr>
            <h3>
                <b>
                    <u>ข้อมูลพื้นฐานหมวดหมู่</u>
                </b>
            </h3>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="cate_name_th">* หมวดหมู่</label>
                        <input type="text" class="form-control" id="cate_name_th" value="<?php echo (!empty($cateArrs) && isset($_GET['cate_id'])) ?  $cateArrs[$cate_id]['parent_name_th']: '';?>">
                    </div>
                </div>
               
            </div>
            <?php 
            ?>

            <p class="read">รูปภาพหมวดหมู่ (* ขนาด 320x280 pixels ต้องมี1รูป)</p>
        
              <div id="myAwesomeDropzone" type="file" class="dropzone">

              </div>
           
              <br>
              <div class="row">
              
                <div class="col-xs-10 col-sm-11">
                    
                    <div class="form-group">
                        <label id="sub_category_label" for="sub_category">* หมวดหมู่ย่อย<span id="lengthSubCate">&nbsp;(ต้องเพิ่มอย่างน้อย 1 ตัว)</span></label> 
                        <span id="sub_cate_tag"></span>
                      
                        <input type="text" class="form-control"   id="sub_category" value="<?php echo (!empty($cateArrs) && isset($_GET['cate_id'])) ?  $cateArrs[$cate_id]['parent_name_th']: '';?>">
                   
                      
                    </div>
                    

                </div>
                <div class="col-xs-2 col-sm-1" style="top:30px;">
                    <div class="form-group">
                        <span id="plusId" onclick="appendTag()" class="fa fa-plus " style="cursor:pointer;"></span>
                        
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="cate_desc" style="display: inline;vertical-align: top;">* รายละเอียด</label>
                        <textarea rows="4" type="text" class="form-control"  id="cate_desc"><?php echo (!empty($cateArrs) && isset($_GET['cate_id'])) ?  $cateArrs[$cate_id]['cate_desc']: '';?></textarea>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-sm-12 text-center">
                <?php
                  if(!empty($cateArrs) && isset($_GET['cate_id']))
                  {
                ?>
                             <button class="btn btn-success" type="submit" alt="submit" id="submits_upd" value="Upload"><i class="fa fa-save"></i>&nbsp;แก้ไขสินค้า</button>
              
                <?php
                  }else {
                ?>
                    <button class="btn btn-success" type="submit" alt="submit" id="submits" value="Upload"><i class="fa fa-save"></i>&nbsp;เพิ่มหมวดหมู่</button>
                <?php
                  }
                ?>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="subCateId" recieveTxt="" >
</form>


<script>
    var subCateIdArrays= <?php echo isset($cateArrs[$cate_id]['child']) ? json_encode($cateArrs[$cate_id]['child']) : json_encode(array()); ?>;
        
    $(function() {
        var cate_id = '<?php echo empty($cate_id) || ($cate_id == 0) ? 0 : $cate_id;?>';
           
        if(cate_id > 0){
         
            call_subCategory($('#category').val());
            $.each(subCateIdArrays, function($_keys, $_elem)
            {
                call_action($_keys);
                appendTag($_keys);
            });
        }   
    });
    function call_action(id){
        
        $('#sub_category').attr("recieveTxt",subCateIdArrays[id].sub_cate_name_th);
        $('#sub_category').val(subCateIdArrays[id].sub_cate_name_th);
    }
    function appendTag(id){
        var subCateId = Math.floor(Math.random() * 100000);
        var id = id ?  id : 0;
        if($('#sub_category').val() && (!$('span').is("#tag_"+subCateId)) && ($('#sub_cate_tag').children("span").attr("hiddenTxt") != $('#sub_category').val())){
            $('#sub_cate_tag').append($("<span>" + $('#sub_category').val() + " X" + "</span>")
            .attr("style","cursor:pointer;")
            .attr("onclick","hiddenTag("+ id+")")
            .attr("class","badge badge-light align-middle")
            .attr("id","tag_" + id)
            .attr("hiddenTxt",$('#sub_category').val())
            .attr("hiddenValue",id)
            .attr("value",$('#sub_category').val()));
        }
        else{
            alert('ดูดีๆ มันมีหมวดหมู่ย่อยอยุไหมหรือมันมี tag เดิมอยุแล้ว');
        }
        if(id){
            $("#sub_cate_tag").append($("tag_" + subCateId).attr("hiddenValue",id));
        }
        $('#sub_category').val('');
        if($('#sub_cate_tag > span').size() > 0){
            $('#lengthSubCate').hide();
        }
    }
   
    function hiddenTag(id){
        if(id > 0){
            var url = './include/ajax/category_form.php';    
            $.ajax({    
                type: "POST",
                url: url,
                data: {sub_cate_id:id,action:"category_search_prod"},
                success: function(data,status,xhr){
                    var jsonArraysList = JSON.parse(xhr.responseText);
                    var count = 0;
                    var html = 'สินค้ามีการผูกอยู่กับหมวดหมู่นี้อยู่ ลบไม่ได้ ต้องไปแก้ความสัมพันธ์สินค้าดังกล่าวก่อน' + "\n";
                    if(jsonArraysList.status == true){
                        $.each(jsonArraysList.prodArrays, function($_prodKeys, $_prodVal)
                        {
                            ++ count;
                            html += count + ". " + $_prodVal.product_name + "\n";
                        });
                        alert(html);
                    }else{
                        remoteTag(id);
                    }
                    // window.location.href = "admin-category.php";alert("เพิ่มข้อมูลเสร็จสมบูรณ์");
                }
            });
        }
        else{
            remoteTag(id);
        }
    }

   function remoteTag(id){
        $("span#tag_"+id).remove();
        if($('#sub_cate_tag > span').size() == 0){
            $('#lengthSubCate').show();
        }
   }
   function call_subCategory(id){
       var subid = id ? id : 0;
       var cateArrays = <?php echo json_encode($cate_Arr); ?>;
       $('#sub_category').empty();
       $('#sub_cate_tag').empty();
       if(cateArrays && subid > 0){
        $.each( cateArrays[subid]['child'], function( i, l ){
            $('#sub_category').append($("<option></option>")
            .attr("value",cateArrays[subid]['child'][i]['sub_cate_id'])
            .text(cateArrays[subid]['child'][i]['sub_cate_name_th']));
        });
       }
   }

    function findSubCateId_Return(type){
      var subCateArr = [];
      var type = type ? type : '';
      if($('#sub_cate_tag').children().length > 0){
      
            $.each( $('#sub_cate_tag').children(), function( i, l ){
                if(type == 'return_hiddenValue'){
                    var subCate_value = l ? $(l).attr("hiddenvalue") : 0 ; 
                }else{
                    var subCate_value = l ? $(l).attr("value") : 0 ; 
                }
                subCateArr.push(subCate_value);
            });
      }
      return subCateArr;

    }
 
</script>
