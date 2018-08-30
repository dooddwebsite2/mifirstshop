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

                <?php include("./include/product/action_product.php");?>




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
    url: './include/ajax/product_form.php',
    acceptedFiles: "image/*",
	acceptedFiles: ".png,.jpg,.jpeg",
    addRemoveLinks: true,
    maxFilesize: 2048,
    uploadMultiple: true, 
    maxFiles: 4,
    autoProcessQueue: false,
    parallelUploads: 4,
	 removedfile: function(file) {
   
	var file_name = file.name;
	var url = './include/ajax/product_form.php';
     	$.ajax({
			type: "POST",
			url: url,
			data: {session_id:session_id,file_name:file_name,action:"product_delete_img"},
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
            var url = './include/ajax/product_form.php';    
                $.ajax({
                type: "POST",
                url: url,
                data: {session_id:session_id,file_name:file_name,action:"product_add_img"},
                success: function(data,status,xhr){
                    console.log(data);
                }
            });
           
        });
        myFORMDropzone.on('queuecomplete', function() {
            if(true == processing)
            {
                var product_name = $('#product_name').val();
                var product_price = $('#product_price').val();
                var product_discount = $('#product_discount').val();
                var product_stock = $('#product_stock').val();
                var category = $('#category').val();
                var product_id_ref = $('#product_id_ref').val();
                var product_type = $('#product_type').val();
                var product_desc = $('#product_desc').val();
                var product_logistic_weight = $('#product_logistic_weight').val();
                var product_logistic_size_1 = $('#product_logistic_size_1').val();
                var product_logistic_size_2 = $('#product_logistic_size_2').val();
                var product_logistic_size_3 = $('#product_logistic_size_3').val();
                var product_logistic_amount = $('#product_logistic_amount').val();
                var product_logistic_time = $('#product_logistic_time').val();
                var product_logistic_send = $('#product_logistic_send').val();
       
           
            //var subArrays = [];
                var subArrays  = findSubCateId_Return();
            // if(subArrays.length > 0 && product_name != '' && product_price > 0 
            //    && product_stock > 0 && category > 0 && product_id_ref != '' )
            if(subArrays.length > 0 )
            {
                
                // alert(session_id);
                // var jsonSubArr = JSON.stringify(subArrays);
                // console.log(subArrays);
                // console.log(jsonSubArr);
                var url = './include/ajax/product_form.php';    
           
                $.ajax({    
                    type: "POST",
                    url: url,
                    data: {session_id:session_id
                        ,product_name:product_name
                        ,product_price:product_price
                        ,product_discount:product_discount
                        ,product_stock:product_stock
                        ,category:category
                        ,product_id_ref:product_id_ref
                        ,product_type:product_type
                        ,product_desc:product_desc
                        ,product_logistic_weight:product_logistic_weight
                        ,product_logistic_size_1:product_logistic_size_1
                        ,product_logistic_size_2:product_logistic_size_2
                        ,product_logistic_size_3:product_logistic_size_3
                        ,product_logistic_amount:product_logistic_amount
                        ,product_logistic_time:product_logistic_time
                        ,product_logistic_send:product_logistic_send
                        ,subArrays: subArrays
                        ,action:"product_add"},
                    success: function(data,status,xhr){
                        window.location.href = "admin-product.php";alert("เพิ่มข้อมูลเสร็จสมบูรณ์");
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
            var product_name = $('#product_name').val();
            var product_price = $('#product_price').val();
            var product_discount = $('#product_discount').val();
            var product_stock = $('#product_stock').val();
            var category = $('#category').val();
            var product_id_ref = $('#product_id_ref').val();
            var product_type = $('#product_type').val();
            var product_desc = $('#product_desc').val();
            var product_logistic_weight = $('#product_logistic_weight').val();
            var product_logistic_size_1 = $('#product_logistic_size_1').val();
            var product_logistic_size_2 = $('#product_logistic_size_2').val();
            var product_logistic_size_3 = $('#product_logistic_size_3').val();
            var product_logistic_amount = $('#product_logistic_amount').val();
            var product_logistic_time = $('#product_logistic_time').val();
            var product_logistic_send = $('#product_logistic_send').val();
            var subArrays  = findSubCateId_Return();
            if (myFORMDropzone.getQueuedFiles().length >= 4  
             && subArrays.length > 0 && product_name != '' && product_price > 0 
             && product_stock > 0 && category > 0 && product_id_ref != '') { 
                myFORMDropzone.processQueue();
            }
            else{
                alert('กรุณาตรวจสอบข้อมูล');
            }
            
           
            
    });
});
</script>

</html>