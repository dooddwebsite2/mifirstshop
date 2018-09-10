<style>
  #insertImage-1 > .fa-picture-o:before{
    content: "\f291";
    font-family: "FontAwesome";
  }
</style>
<form id="action_content" action="./include/ajax/category_form.php" method="post" enctype="multipart/form-data">

    <?php
     $content_id = 0;
    // $condArrays = getContent('','','','','','','content_id');
    if(isset($_GET['content_id'])){
        $content_id = $_GET['content_id'];
        $condArrays = getContent($content_id,'','','','','','content_id');
      
        // echo '<PRE>';
        
        // print_R($condArrays);

    }
    ?>    
    <div class="col-md-9">
        <div class="box">
            <h1><?php echo (!empty($condArrays) && isset($_GET['content_id'])) ? 'แก้ไขบทความ' : 'เพิ่มบทความ';?></h1>
            <p class="lead">กรุณากรอกข้อมูลให้ครบถ้วนทุกช่อง ไม่ได้ validate มันเยอะ</p>
            <p class="text-muted">** สำคัญมากพวกหมวดหมู่ต้องเลือกด้วยห้ามปล่อยว่าง
                ถ้าไม่มีหมวดหมู่ที่ต้องการก็ไปสร้างซะ</p>
            <hr>
            <h3>
                <b>
                    <u>ข้อมูลพื้นฐานบทความ</u>
                </b>
            </h3>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="content_name">* ชื่อบทความ</label>
                        <input type="text" class="form-control" id="content_name" value="<?php echo (!empty($condArrays) && isset($_GET['content_id'])) ?  $condArrays[$content_id]['attr']['content_name']: '';?>">
                    </div>
                </div>
               
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="content_preface">* บทนำ</label>
                        <textarea id="content_preface" class="form-control" rows="8"><?php echo (!empty($condArrays) && isset($_GET['content_id'])) ?  $condArrays[$content_id]['attr']['content_preface']: '';?></textarea>
                    </div>
                </div>
               
            </div>
            <?php 
            ?>

            
            
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label for="content_paragraph" style="display: inline;vertical-align: top;">* เนื้อหา</label>
                        <div id="content_paragraph" ></div>
                    </div>
                </div>
            </div>
          
            <div class="row">
                <div class="col-sm-12 text-center">
                <?php
                  if(!empty($condArrays) && isset($_GET['content_id']))
                  {
                ?>
                             <button class="btn btn-success" type="submit" alt="submit" id="submits_upd" value="Upload"><i class="fa fa-save"></i>&nbsp;แก้ไขบทความ</button>
              
                <?php
                  }else {
                ?>
                    <button class="btn btn-success" type="submit" alt="submit" id="submits" value="Upload"><i class="fa fa-save"></i>&nbsp;เพิ่มบทความ</button>
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
        var content_id = '<?php echo empty($content_id) || ($content_id == 0) ? 0 : $content_id;?>';
    $(function() {
       
        $('div#content_paragraph').froalaEditor({
        height: 600,
        placeholderText: '',

        // Set the image upload URL.
        imageUploadURL: 'upload_img.php',

        imageUploadParams: {
        id: 'my_editor'
        },
        quickInsertButtons: ['image', 'table'],
        toolbarButtons: ['fullscreen', 'bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', '|', 'fontFamily', 'fontSize', 'color', 'inlineStyle', 'paragraphStyle', '|', 'paragraphFormat', 'align', 'formatOL', 'formatUL', 'outdent', 'indent', 'quote', '-', 'insertLink', 'insertImage', 'embedly', 'insertTable', '|', 'specialCharacters', 'insertHR', 'selectAll', 'clearFormatting', '|', 'print', 'help', 'html', '|', 'undo', 'redo']
            
        })
        
        if(content_id > 0){
            var html = <?php echo isset($condArrays[$content_id]['attr']['content_paragraph1']) ? json_encode($condArrays[$content_id]['attr']['content_paragraph1']) : json_encode('') ;?>;
            //console.log(html);
            $('div#content_paragraph .fr-element').html(html);
        }
    });
 
</script>
