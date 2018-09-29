
<?php require_once('../timezones.php');?>
<?php require_once('../../config.php'); ?>
<?php
session_start();
$action = isset($_POST['action']) ? $_POST['action'] : '';
$user_modal = isset($_POST['user_modal']) ? $_POST['user_modal'] : '';
$password_modal = isset($_POST['password_modal']) ? $_POST['password_modal'] : '';
if($action == 'login_request')
{
    $status = false;
    $msg = "";
    $profileArrays = LoginFunc('',$user_modal,$password_modal,'1');
  
    if(count($profileArrays) > 0 ) { 
        $status = true;
        $_SESSION['start'] = time(); // เก็บเวลาปัจจุบัน
        // SET เวลาให้ SESSION นี้อยู่ได้ไม่เกิน 1800วิ เกินกว่านั้นให้ session destroy
        $_SESSION['expire'] = $_SESSION['start'] + (300 * 60);
      
    }
    else{
        $msg = "ไม่สามารถเข้าสู่ระบบได้";
    }
  
    echo json_encode(array('profiles' => $profileArrays, 'status' => $status, 'msg'=>$msg));
}
?>