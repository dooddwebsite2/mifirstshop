<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#confirmModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade ThaifontBangnam ContentTxt" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="confirmModalLabel">ยืนยันการส่งข้อมูล</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <h2><b>กรุณากรอกข้อมูลให้ครบถ้วนและตามความจริงนะค่ะ ^^</b></h2>
                <h3>หากพบปัญหาอะไรติดต่อได้จากด้านล่างนี่เลยค้าา
                        <br><b>*เวลาทำการจันทร์- อาทิตย์ ตั้งแต่ 9.00 น. จนถึง 16.30 น.</b></h3>
                
                    <div class="row">

                        <!-- /.col-sm-4 -->
                        <div class="col-sm-6">
                            <h3>
                                <i class="fa fa-phone"></i> โทร</h3>
                        
                            <p>
                                <strong>089-2221342</strong>
                            </p>
                        </div>
                        <!-- /.col-sm-4 -->
                        <div class="col-sm-6">
                            <h3>
                                <i class="fa fa-envelope"></i> Line / Facebook</h3>
                            
                           
                                    <strong>Line ID :
                                        <a href="http://line.me/ti/p/mifirst">mifirst</a>
                                    </strong>
                                
                                <br>
                                    <strong>Facebook :
                                        <a href="https://www.facebook.com/banitowninbox"> Mifirst First</a>
                                
                           
                        </div>
                        <!-- /.col-sm-4 -->
                   
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">ปิด</button>
                <button type="button" class="btn btn-primary" onclick="sendRequestContact()">ยืนยัน</button>
            </div>
        </div>
    </div>
</div>

<script>
    function sendRequestContact() {

        var firstname = $('#firstname').val();
        var lastname = $('#lastname').val();
        var email = $('#email').val();
        var subject = $('#subject').val();
        var message = $('#message').val();
        
        $('#loadingDiv').show();
        var url = './include/ajax/contact_form.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                firstname: firstname,
                lastname: lastname,
                email: email,
                subject: subject,
                message: message,
                action: "contact_request"
            },
            success: function (data, status, xhr) {
                $('#loadingDiv').hide();
                $('#confirmModal').modal('toggle');
                alert('ส่งข้อมูลแล้ว');
                

            }
        });

    }
</script>