<!DOCTYPE html>
<html lang="en">

<?php include("./include/header.php");?>
<?php include("./include/category/category_variable.php");?>
<body>
    <?php include("./include/navbar.php");?>

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
    $(document).ready(function() {
        var session_id = '<?php echo $user_id;?>';
    
// Dropzone.autoDiscover = false;
var myFORMDropzone = new Dropzone("div#myAwesomeDropzone", {                   
    url: './include/ajax/category_form.php',
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
	var url = './include/ajax/category_form.php';
     	$.ajax({
			type: "POST",
			url: url,
			data: {session_id:session_id,file_name:file_name,action:"category_delete_img"},
			success: function(data,status,xhr){
				console.log(data);
	 		}
	 	});		
	 var _ref;
	 return (_ref = file.previewElement) != null ? _ref.parentNode.removeChild(file.previewElement) : void 0;        
     },
    init: function() {
    
 		var startUpload = document.getElementById("#myAwesomeDropzone");
         var submitButton = document.querySelector("#submit-all")
        myFORMDropzone = this;
		Dropzone.options.myFORMDropzone = false;
        myFORMDropzone.on("addedfile", function(file) {
            
       
         
        });

        myFORMDropzone.on("processing", function(file) {
            //set autoProcessQueue to true, so every file gets uploaded
            this.options.autoProcessQueue = true;
            processing = true;
            var file_name = file.name;
            var url = './include/ajax/category_form.php';    
                $.ajax({
                type: "POST",
                url: url,
                data: {session_id:session_id,file_name:file_name,action:"category_add_img"},
                success: function(data,status,xhr){
                    console.log(data);
                }
            });
           
        });
        myFORMDropzone.on('queuecomplete', function() {
            if(true == processing)
            {
             
            var category = $('#cate_name_th').val();
            var cate_desc = $('#cate_desc').val();

            var subArrays  = findSubCateId_Return();
            console.log(subArrays);
            if(subArrays.length > 0 )
            {   
                var url = './include/ajax/category_form.php';    
                $.ajax({    
                    type: "POST",
                    url: url,
                    data: {session_id:session_id
                        ,category:category
                        ,subArrays: subArrays
                        ,cate_desc: cate_desc
                        ,action:"category_add"},
                    success: function(data,status,xhr){
                        window.location.href = "admin-category.php";alert("เพิ่มข้อมูลเสร็จสมบูรณ์");
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
			 
		this.on("success", function(file, responseText) {
		
		});
				
		this.on("error", function(file, response){
                    // alert('อัพโหลดไฟล์ไม่ได้');
			});
      	});
    }
});

    $("#submits").click(function (e) {
            e.preventDefault();
            var category = $('#cate_name_th').val().length;
            var cate_desc = $('#cate_desc').val().length;
            var subArrays  = findSubCateId_Return();
            if (myFORMDropzone.getQueuedFiles().length >= 1  
             && subArrays.length > 0 && category > 0  && cate_desc > 0 ) { 
                myFORMDropzone.processQueue();
            }
            else{
                alert('กรุณาตรวจสอบข้อมูล');
            }
            
           
            
    });
});
</script>

</html>