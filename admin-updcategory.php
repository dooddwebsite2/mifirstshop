<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>
<?php include("./include/category/category_variable.php");?>
<body>
    <?php include("./include/navbar.php");?>
    <style>
        .dz-image img{width: 100%;height: 100%;}
    </style>
    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">
              
                <?php include("./include/profiles/profile_navleft.php");?>

                <?php include("./include/category/action_category.php");?>




            </div>
            <!-- /.container -->
        </div>
        <!-- /#content -->

        <?php  include("./include/copyright.php");?>

    </div>
    <!-- /#all -->


</body>
<script>
 var cate_id = '<?php echo empty($cate_id) || ($cate_id == 0) ? 0 : $cate_id;?>';
    $(document).ready(function() {
        var session_id = '<?php echo $user_id;?>';
       
        var prodMethod;
// Dropzone.autoDiscover = false;
var myFORMDropzone = new Dropzone("div#myAwesomeDropzone", {                   
    url: './include/ajax/category_form_upd.php',
    acceptedFiles: "image/*",
	acceptedFiles: ".png,.jpg,.jpeg",
    addRemoveLinks: true,
    maxFilesize: 2048,
    uploadMultiple: true, 
    maxFiles: 1,
    autoProcessQueue: false,
    parallelUploads: 1,
	 removedfile: function(file) {
   
	var file_name = file.name;
	var url = './include/ajax/category_form_upd.php';
  
        if( confirm("ถ้าลบรูปนี้คือหายจริงอย่างถาวรเลยนะ ยืนยันจะลบใช่ไหม?") == true){
            $.ajax({
                type: "POST",
                url: url,
                data: {cate_id:cate_id,file_name:file_name,action:"category_delete_img"},
                success: function(data,status,xhr){
                    console.log(data);
                }
            });		
            var _ref;
            return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;    
        }
       
	    
     },
    init: function() {
       // var mockFile = { name: "def6d90e829e50c63f98c387daecd138.png", size: 12345 };
 		var startUpload = document.getElementById("#myAwesomeDropzone");
         var submitButton = document.querySelector("#submit-all")
        myFORMDropzone = this;
        Dropzone.options.myFORMDropzone = false;
       
        if(cate_id > 0){
            var url = './include/ajax/category_form_upd.php';    
                $.ajax({    
                    type: "POST",
                    url: url,
                    data: {cate_id:cate_id,action:"list_image"},
                    success: function(data,status,xhr){
                        
                        var jsonImglist = JSON.parse(xhr.responseText);
                        var count = 0;
                        processing = false;
                        $.each( jsonImglist.img.full_path, function( i, l ){
              
                            // var imageUrl = window.location.hostname + '/img/category/' + cate_id + '/' + l.relative_path[count];
                            var imageUrl =  '/mifirstshop/img/category/' + cate_id + '/' + jsonImglist.img.relative_path[count];
                            var mockFile = {
                                name: jsonImglist.img.relative_path[count] ,
                                size: jsonImglist.img.img_size[count],
                                accepted: true,
                                kind: 'image'
                            };
                             myFORMDropzone.emit("addedfile", mockFile);
                             myFORMDropzone.emit("thumbnail", mockFile, imageUrl);
                             myFORMDropzone.emit("complete", mockFile);
                             myFORMDropzone.files.push(mockFile);
                             
                             ++ count;
                           
                        });
                         
                    }
                });
           
        }
        myFORMDropzone.on("addedfile", function(file) { });

        myFORMDropzone.on("processing", function(file) {
            //set autoProcessQueue to true, so every file gets uploaded
            this.options.autoProcessQueue = true;
            processing = true;
            var file_name = file.name;
            var url = './include/ajax/category_form_upd.php';    
                $.ajax({
                type: "POST",
                url: url,
                data: {session_id:session_id,cate_id:cate_id,file_name:file_name,action:"category_add_img"},
                success: function(data,status,xhr){
                    console.log(data);
                }
            });
           
        });
        myFORMDropzone.on('queuecomplete', function() {
            if(true == processing)
            {
                prodMethod = callInherProd();
               
                if(prodMethod.subArrays.length > 0 )
                {
                    var url = './include/ajax/category_form_upd.php';       
                    $.ajax({    
                        type: "POST",
                        url: url,
                        data: {session_id:session_id
                            ,cate_id:cate_id
                            ,cate_name_th:prodMethod.cate_name_th
                            ,cate_desc:prodMethod.cate_desc
                            ,subArrays:prodMethod.subArrays
                            ,txtArray:prodMethod.txtArray
                            ,action:"category_upd"},
                        success: function(data,status,xhr){
                            alert("แก้ไขข้อมูลเสร็จสมบูรณ์");
                            window.location.href = "admin-category.php?";
                            
                        }
                    });
                }
                else{
                    alert('อย่า"งง" เช็คดีๆว่าใส่ข้อมูลครบไหม field ที่ไม่มี * ปล่อยว่างได้นอกนั้นใส่ให้ถูก')
                }
            
            }
        });
       this.on("sending", function(file, xhr, formData){
             formData.append("session_id",session_id);
             formData.append("cate_id",cate_id);
			 
		this.on("success", function(file, responseText) {
		
		});
				
		this.on("error", function(file, response){
                    // alert('อัพโหลดไฟล์ไม่ได้');
			});
      	});
    }
});

    $("#submits_upd").click(function (e) {
            e.preventDefault();
            
            prodMethod = callInherProd();
            
            if (myFORMDropzone.getAcceptedFiles().length >= 1  
             && prodMethod.cate_name_th != '' 
             && prodMethod.cate_desc != '') { 
                myFORMDropzone.processQueue();
                if(prodMethod.subArrays.length > 0 )
                {
                    var url = './include/ajax/category_form_upd.php';       
                    $.ajax({    
                        type: "POST",
                        url: url,
                        data: {session_id:session_id
                            ,cate_id:cate_id
                            ,cate_name_th:prodMethod.cate_name_th
                            ,cate_desc:prodMethod.cate_desc
                            ,subArrays:prodMethod.subArrays
                            ,txtArray:prodMethod.txtArray
                            ,action:"category_upd"},
                        success: function(data,status,xhr){
                            alert("แก้ไขข้อมูลเสร็จสมบูรณ์");
                            window.location.href = "admin-category.php?";
                            
                        }
                    });
                }
                else{
                    alert('อย่า"งง" เช็คดีๆว่าใส่ข้อมูลครบไหม field ที่ไม่มี * ปล่อยว่างได้นอกนั้นใส่ให้ถูก')
                }
              
            }
            else{
                alert('กรุณาตรวจสอบข้อมูล');
            }
            
           
            
    });
});


// เรียก function ให้ส่งค่าไปในคลาสที่สืบทอด
function callInherProd(){
        var prodMethod = new InherObjectsProd(
        $('#cate_name_th').val()
        ,$('#cate_desc').val()
        ,findSubCateId_Return('return_hiddenValue')
        ,findSubCateId_Return());
    return prodMethod;
}
function InherObjectsProd(cate_name_th,cate_desc,mysubArrays,txtArrays){
        
        this.cate_name_th = cate_name_th;
        this.cate_desc = cate_desc;
        this.subArrays  = mysubArrays;
        this.txtArray = txtArrays;
    
}
</script>

</html>