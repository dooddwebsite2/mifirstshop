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
        var product_id = '<?php echo empty($product_id) || ($product_id == 0) ? 0 : $product_id;?>';
        var prodMethod;
// Dropzone.autoDiscover = false;
var myFORMDropzone = new Dropzone("div#myAwesomeDropzone", {                   
    url: './include/ajax/product_form_upd.php',
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
	var url = './include/ajax/product_form_upd.php';
  
        if( confirm("ถ้าลบรูปนี้คือหายจริงอย่างถาวรเลยนะ ยืนยันจะลบใช่ไหม?") == true){
            $.ajax({
                type: "POST",
                url: url,
                data: {product_id:product_id,file_name:file_name,action:"product_delete_img"},
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
       
        if(product_id > 0){
            var url = './include/ajax/product_form_upd.php';    
                $.ajax({    
                    type: "POST",
                    url: url,
                    data: {id:product_id,action:"list_image"},
                    success: function(data,status,xhr){
                        var jsonImglist = JSON.parse(xhr.responseText);
                        var count = 0;
                        processing = false;
                        $.each( jsonImglist.img.full_path, function( i, l ){
              
                            // var imageUrl = window.location.hostname + '/img/product/' + product_id + '/' + l.relative_path[count];
                            var imageUrl =  '/mifirstshop/img/product/' + product_id + '/' + jsonImglist.img.relative_path[count];
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
            var url = './include/ajax/product_form_upd.php';    
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
                prodMethod = callInherProd();
               
                if(prodMethod.subArrays.length > 0 )
                {
                    var url = './include/ajax/product_form_upd.php';       
                    $.ajax({    
                        type: "POST",
                        url: url,
                        data: {session_id:session_id
                            ,product_id:product_id
                            ,product_name:prodMethod.product_name
                            ,product_price:prodMethod.product_price
                            ,product_discount:prodMethod.product_discount
                            ,product_stock:prodMethod.product_stock
                            ,category:prodMethod.category
                            ,product_id_ref:prodMethod.product_id_ref
                            ,product_type:prodMethod.product_type
                            ,product_desc:prodMethod.product_desc
                            ,product_logistic_weight:prodMethod.product_logistic_weight
                            ,product_logistic_size_1:prodMethod.product_logistic_size_1
                            ,product_logistic_size_2:prodMethod.product_logistic_size_2
                            ,product_logistic_size_3:prodMethod.product_logistic_size_3
                            ,product_logistic_amount:prodMethod.product_logistic_amount
                            ,product_logistic_time:prodMethod.product_logistic_time
                            ,product_logistic_send:prodMethod.product_logistic_send
                            ,subArrays:prodMethod.subArrays
                            ,action:"product_upd"},
                        success: function(data,status,xhr){
                            //window.location.href = "admin-product.php";alert("เพิ่มข้อมูลเสร็จสมบูรณ์");
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
             formData.append("product_id",product_id);
			 
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
            
            if (myFORMDropzone.getAcceptedFiles().length >= 4  
             && prodMethod.subArrays.length > 0 
             && prodMethod.product_name != '' 
             && prodMethod.product_price > 0 
             && prodMethod.product_stock > 0 
             && prodMethod.category > 0 
             && prodMethod.product_id_ref != '') { 
                myFORMDropzone.processQueue();
                if(prodMethod.subArrays.length > 0 )
                {
                    var url = './include/ajax/product_form_upd.php';       
                    $.ajax({    
                        type: "POST",
                        url: url,
                        data: {session_id:session_id
                            ,product_id:product_id
                            ,product_name:prodMethod.product_name
                            ,product_price:prodMethod.product_price
                            ,product_discount:prodMethod.product_discount
                            ,product_stock:prodMethod.product_stock
                            ,category:prodMethod.category
                            ,product_id_ref:prodMethod.product_id_ref
                            ,product_type:prodMethod.product_type
                            ,product_desc:prodMethod.product_desc
                            ,product_logistic_weight:prodMethod.product_logistic_weight
                            ,product_logistic_size_1:prodMethod.product_logistic_size_1
                            ,product_logistic_size_2:prodMethod.product_logistic_size_2
                            ,product_logistic_size_3:prodMethod.product_logistic_size_3
                            ,product_logistic_amount:prodMethod.product_logistic_amount
                            ,product_logistic_time:prodMethod.product_logistic_time
                            ,product_logistic_send:prodMethod.product_logistic_send
                            ,subArrays:prodMethod.subArrays
                            ,action:"product_upd"},
                        success: function(data,status,xhr){
                            window.location.href = "admin-product.php";alert("แก้ไขข้อมูลเสร็จสมบูรณ์");
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
        $('#product_name').val()
        ,$('#product_price').val()
        ,$('#product_discount').val()
        ,$('#product_stock').val() 
        ,$('#category').val()
        ,$('#product_id_ref').val()
        ,$('#product_type').val()
        ,$('#product_desc').val()
        ,$('#product_logistic_weight').val()
        ,$('#product_logistic_size_1').val()
        ,$('#product_logistic_size_2').val()
        ,$('#product_logistic_size_3').val()
        ,$('#product_logistic_amount').val()
        ,$('#product_logistic_time').val()
        ,$('#product_logistic_send').val()
        ,findSubCateId_Return());
    return prodMethod;
}
function InherObjectsProd(product_name,product_price,product_discount,product_stock,
        category,product_id_ref,product_type,product_desc,product_logistic_weight
        ,product_logistic_size_1,product_logistic_size_2,product_logistic_size_3
        ,product_logistic_amount,product_logistic_time,product_logistic_send,mysubArrays){
        
        this.product_name = product_name;
        this.product_price = product_price;
        this.product_discount = product_discount;
        this.product_stock = product_stock;
        this.category = category;
        this.product_id_ref = product_id_ref;
        this.product_type = product_type;
        this.product_desc = product_desc;
        this.product_logistic_weight = product_logistic_weight;
        this.product_logistic_size_1 = product_logistic_size_1;
        this.product_logistic_size_2 = product_logistic_size_2;
        this.product_logistic_size_3 = product_logistic_size_3;
        this.product_logistic_amount = product_logistic_amount;
        this.product_logistic_time = product_logistic_time;
        this.product_logistic_send = product_logistic_send;
        this.subArrays  = mysubArrays;
       

}
</script>

</html>