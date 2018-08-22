<div class="modal fade ThaifontBangnam ContentTxt" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="Login" aria-hidden="true">
        <div class="modal-dialog modal-sm">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h3 class="modal-title" id="Login">เข้าสู่ระบบ</h3>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" id="user-modal" placeholder="username" required>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" id="password-modal" placeholder="password" required>
                        </div>

                        <p class="text-center">
                            <button class="btn btn-primary" onclick="sendRequest()"><i class="fa fa-sign-in"></i> เข้าสู่ระบบ</button>
                        </p>

                    </form>

                    <p class="text-center text-muted">ยังไม่ได้เป็นสมาชิกใช่ไหม?</p>
                    <p class="text-center text-muted"><a href="register.php"><strong>สมัครสมาชิกตอนนี้</strong></a>&nbsp;ใช้เวลาไม่นานสมัครเลย&nbsp;เพื่อสิทธิ์พิเศษที่จะตามมาในอนาคตอีกมากมายเลยน้าา ^^</p>

                </div>
            </div>
        </div>
    </div>


    <script>
    function sendRequest() {

        var user_modal = $('#user-modal').val();
        var password_modal = $('#password-modal').val();   
        $('#loadingDiv').show();
        var url = './include/ajax/login_form.php';
        $.ajax({
            type: "POST",
            url: url,
            data: {
                user_modal: user_modal,
                password_modal: password_modal,
                action: "login_request"
            },
            success: function (data, status, xhr) {
                $('#loadingDiv').hide();
                var hashKeys;
                var jsonData = JSON.parse(xhr.responseText);
                if(jsonData.status == false)
                {
                    alert(jsonData.msg);
                    return;
                }

                for(var k in jsonData.profiles) 
                {
                    hashKeys = jsonData.profiles[k].hashKeys;
                }
                window.location.href = "/mifirstshop/index.php?activeNav=6a992d5529f459a44fee58c733255e86" + "&profileUserID=" + hashKeys;
                $('#login-modal').modal('toggle');
                
               
                

            }
        });

    }
</script>