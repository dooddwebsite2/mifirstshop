<!DOCTYPE html>
<html lang="en">


<?php include("./include/header.php");?>

<body>
   
<?php include("./include/navbar.php");?>

    <div id="all" class="ThaifontBangnam ContentTxt">

        <div id="content">
            <div class="container">

                <div class="col-md-12">

                    <ul class="breadcrumb">
                       <li>
                            <?php include("./include/content/page_breadcrumb.php");?>
                        </li>
                        <li>สมัครสมาชิก</li>
                    </ul>

                </div>

                <div class="col-md-9">
                    <div class="box">
                        <h1>สมัครสมาชิก</h1>

                       
                        <p class="lead" id="regis_condition"><u><b>เงื่อนไขการสมัครสมาชิก</b></u>
                         
                        </p>
                        <p class="lead">1.ลูกค้าแจ้งคืนสินค้าและขอเงินคืนได้ในกรณีที่สินค้าเกิดการชำรุดระยะเวลาไม่เกิน7วันหลังได้รับสินค้า
                            <br>2.ลูกค้าไม่สามารถเปลี่ยนหรือขอเงินคืนได้ในกรณีที่สินค้าเกิดตำหนิหลังจากได้รับสินค้า(เช็คตำหนิก่อนส่ง)
                            <br>3.หากจงใจกระทำทุจริตอันใดที่ส่งผลต่อภาพลักษณ์ของแบรนด์หรือสินค้าโดยจงใจและไม่มีเหตุสมควรจะถูกดำเนินคดีและแบนบัญชีผู้ใช้ทันที
                            <br>4.หากโพสต์ถ้อยคำและข้อความที่หยาบคายที่ส่งผลต่อการรำคาญของผู้อื่น หากพบเห็นจะถูกแบนบัญชีผู้ใช้ทันทีโดยไม่มีการแจ้งเตือน
                            <br>5.เมื่อลูกค้าโอนเงินหากจะยกเลิกรายการสั่งซื้อสามารถยกเลิกได้ก่อนระยะเวลาไม่เกิน1วันหลังการสั่งซื้อ</p>
                        <p class="text-muted">ถ้ามีปัญหาหรือคำถามอะไรสามารถติดต่อเราได้ที่ <a href="contact.php"> คลิ๊กที่นี่ !!</a></p>

                        <hr>

                        <form action="customer-orders.html" method="post">
                            <div class="form-group">
                                <label for="name">ชื่อผู้ใช้งาน*</label>
                                <input type="text" class="form-control" id="name">
                            </div>
                            <div class="form-group">
                                <label for="email">อีเมล์*</label>
                                <input type="text" class="form-control" id="email">
                            </div>
                            <div class="form-group">
                                <label for="password">รหัสผ่าน (รหัสผ่านจะต้องมีความยาวไม่น้อยกว่า4ตัวอักษร ไม่อนุญาติให้มีช่องว่างและอักขระพิเศษจำพวก / ( ) , \ ก-ฮ ๑-๙)*</label>
                                <input type="password" class="form-control" id="password">
                            </div>
                            <div class="text-center checkbox">
                                <label>
                                <input id="chkBox_cond" type="checkbox" onchange="checkboxFunc(this)"> ฉันได้อ่านและเข้าใจข้อตกลงของ&nbsp;Mifirst Shop 
                                </label>&nbsp;<a href="#" onclick="slideTo('regis_condition','up');">ข้อตกลงและเงื่อนไข.</a>
                            </div>
                            <div class="text-center">
                                <span id="regisButton" onclick="registerFunc()" class="btn btn-primary" style="cursor:pointer;"><i class="fa fa-user-md"></i>&nbsp;สมัครสมาชิก</span>
                        
                            </div>
                        </form>
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="banner">
                        <a href="#">
                            <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                    <div class="banner">
                        <a href="#">
                            <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
                        </a>
                    </div>
                    <div class="banner">
                        <a href="#">
                            <img src="img/banner1.jpg" alt="sales 2014" class="img-responsive">
                        </a>
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
var condCheck = false;
$(document).ready(function() {

    checkboxFunc();
    
});
function checkboxFunc(chkBox){
        $("#regisButton").css("pointer-events", $('#chkBox_cond').prop('checked') ? "auto" : "none");
}
 function slideTo(body,type) {
    // alert('555');
 }
 function registerFunc(){
     var name = $('#name').val();
     var email = $('#email').val();
     var password = $('#password').val();
     if((name != '' && name.length != 0 ) && (email != '' & email.length != 0 ) && (password != '' & password.length != 0)){
        var url = './include/ajax/register_form.php';    
                    $.ajax({
                    type: "POST",
                    url: url,
                    data: {name:name,email:email,password:password,action:"insert_profiles"},
                    success: function(data,status,xhr){
                        var jsonStatus = JSON.parse(xhr.responseText);
                        if(jsonStatus.status  == false){
                            alert("ตรวจพบผู้ใช้งาน " + name + " มีอยู่แล้วในระบบ");
                        }
                        else{
                            alert('สมัครสมาชิกเสร็จสมบูรณ์');
                            sendRequest(name,password);
                            
                        }
                    }
        });
     }
     else{
         alert('กรุณาตรวจสอบข้อมูล');
     }
 

 }
</script>

</html>
