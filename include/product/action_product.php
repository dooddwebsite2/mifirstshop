<form id="action_product" action="./include/ajax/product_form.php" method="post" enctype="multipart/form-data">
    <?php
    $prodType = getProductType();
    ?>    
    <div class="col-md-9">
        <div class="box">
            <h1>เพิ่มสินค้า</h1>
            <p class="lead">กรุณากรอกข้อมูลให้ครบถ้วนทุกช่อง ไม่ได้ validate มันเยอะ</p>
            <p class="text-muted">** สำคัญมากพวกหมวดหมู่ต้องเลือกด้วยห้ามปล่อยว่าง
                ถ้าไม่มีหมวดหมู่ที่ต้องการก็ไปสร้างซะ</p>
            <hr>
            <h3>
                <b>
                    <u>ข้อมูลพื้นฐานสินค้า</u>
                </b>
            </h3>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_name">* ชื่อสินค้า</label>
                        <input type="text" class="form-control" id="product_name">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_price">* ราคา</label>
                        <input type="number" step="0.01" class="form-control" id="product_price">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_discount">* ส่วนลด</label>
                        <input type="number" step="0.01" class="form-control" id="product_discount">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="product_stock">* จำนวน</label>
                        <input type="number" class="form-control" id="product_stock">
                    </div>
                </div>
            </div>
            <?php 
            // echo '<PRE>';
            // print_r($cate_Arr); 
            ?>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="category">* หมวดหมู่</label>
                        <select class="form-control" id="category" onchange="call_subCategory(this.value)">
                                <?php
                                    foreach($cate_Arr as $_parentKeys => $_parentValue){
                                ?>
                                    <option value="<?=$_parentKeys;?>"><?=$cate_Arr[$_parentKeys]['parent_name_th'];?></option>
                                <?php
                                    }
                                ?>

                        </select>
                    </div>
                </div>
                <div class="col-xs-8 col-sm-5">
                    
                    <div class="form-group">
                        <label id="sub_category_label" for="sub_category">หมวดหมู่ย่อย<span id="lengthSubCate">&nbsp;(ต้องเพิ่มอย่างน้อย 1 ตัว)</span></label> 
                        <span id="sub_cate_tag"></span>
                      
                        <select class="form-control" id="sub_category" onchange="call_action(this.value)">     
                        </select>
                      
                    </div>
                    

                </div>
                <div class="col-xs-2 col-sm-1" style="top:30px;">
                    <div class="form-group">
                        <span id="plusId" onclick="appendTag()" class="fa fa-plus " style="cursor:pointer;"></span>
                        
                    </div>
                </div>
      
               
            </div>
            <div class="row">
            <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_id_ref">* เลขอ้างอิงสินค้า</label>
                        <input type="text" class="form-control" id="product_id_ref">
                    </div>
                </div>
             <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_type">* สภาพสินค้า</label>
                        <select class="form-control" id="product_type">
                        <?php
                            foreach($prodType as $_prodTypeKeys => $_prodTypeValue){
                        ?>
                            <option value="<?=$_prodTypeKeys;?>"><?=$prodType[$_prodTypeKeys]['th'];?></option>
                        <?php
                            }
                        ?>

                        </select>
                       
                    </div>
                </div>
               
                        </div>
            <p class="read">รูปภาพ (* ขนาด 450x600 pixels ต้องมี4รูป)</p>
        
              <div id="myAwesomeDropzone" class="dropzone">

              </div>
           
              <br>
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="product_desc">* รายละเอียดสินค้า</label>
                        <textarea rows="4" type="text" class="form-control" id="product_desc"> </textarea>
                    </div>
                </div>
            </div>
            <hr>
            <h3>
                <b>
                    <u>การจัดส่ง</u>
                </b>
            </h3>
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="product_logistic_weight">น้ำหนัก(kg)</label>
                        <input type="number" step="0.01" class="form-control" id="product_logistic_weight">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="product_logistic_size_1">กว้าง (cm)</label>
                        <input type="number" step="0.01" class="form-control" id="product_logistic_size_1">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="product_logistic_size_2">ยาว (cm)</label>
                        <input type="number" step="0.01" class="form-control" id="product_logistic_size_2">
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="form-group">
                        <label for="product_logistic_size_3">สูง (cm)</label>
                        <input type="number" step="0.01" class="form-control" id="product_logistic_size_3">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_logistic_amount">ค่าจัดส่ง</label>
                        <input type="number" step="0.01" class="form-control" id="product_logistic_amount">
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_logistic_amount">ระยะเวลาการจัดส่ง ( เช่น 7 วัน)</label>
                        <input type="text" class="form-control" id="product_logistic_time">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="product_logistic_send">ส่งสินค้าทางไหน (เช่น ems)</label>
                        <input type="text" class="form-control" id="product_logistic_send">
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-sm-12 text-center">
                    <button class="btn btn-success" type="submit" alt="submit" id="submits" value="Upload"><i class="fa fa-save"></i>&nbsp;เพิ่มสินค้า</button>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="subCateId" recieveTxt="" >
</form>


<script>

    $(function() {
        call_subCategory($("#category option:first").attr('selected','selected').val());
        call_action($( "#sub_category option:selected" ).val());
    });
    function call_action(id){
        $('#subCateId').val(($( "#sub_category option:selected" ).val()));
        $('#subCateId').attr("recieveTxt",$( "#sub_category option:selected" ).text());
    }
    function appendTag(){
       var subCateId = $('#subCateId').val();
      
        if($('#subCateId').val() && (!$('span').is("#tag_"+subCateId) )){
            $('#sub_cate_tag').append($("<span></span>")
            .attr("style","cursor:pointer;")
            .attr("onclick","hiddenTag("+ $('#subCateId').val()+")")
            .attr("class","badge badge-light align-middle")
            .attr("id","tag_" + $('#subCateId').val())
            .attr("hiddenTxt",$('#subCateId').attr("recieveTxt"))
            .attr("value",$('#subCateId').val()).text($('#subCateId').attr("recieveTxt") + " X"));
        }
        else{
            alert('ดูดีๆ มันมีหมวดหมู่ย่อยอยุไหมหรือมันมี tag เดิมอยุแล้ว');
        }
        
        if($('#sub_cate_tag > span').size() > 0){
            $('#lengthSubCate').hide();
        }
    }

    function hiddenTag(id){
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
       call_action($( "#sub_category option:selected" ).val());

   }

    function findSubCateId_Return(){
      var subCateArr = [];
      
      if($('#sub_cate_tag').children().length > 0){
      
            $.each( $('#sub_cate_tag').children(), function( i, l ){
                var subCate_value = l ? $(l).attr("value") : 0 ;
                //var subCate_txt = l ? $(l).attr("hiddenTxt") : '-';
                // subCateArr[subCate_value] = [];
                // subCateArr[subCate_value]['name'] = subCate_txt;
                // subCateArr[subCate_value]['value'] = subCate_value;   
                subCateArr.push(subCate_value);
            });
      }
    // remove empty array
      //subCateArr = subCateArr.filter(v=>v.name && v.value);
      return subCateArr;

    }
</script>