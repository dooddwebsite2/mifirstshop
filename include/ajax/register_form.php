<?php require_once('../../config.php'); ?>
<?php
$ds = DIRECTORY_SEPARATOR; 
$action = isset($_POST['action']) ? $_POST['action'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email =isset($_POST["email"])?$_POST["email"]: '';
$password = isset($_POST["password"])?$_POST["password"]: '';
if($action == 'insert_profiles'){
    $profileArrays = LoginFunc('',$name,'');
    if(count($profileArrays) == 0){
        $sqls = " INSERT INTO auth_account(u_name,email,u_pass,role_id,u_active) 
        VALUES ('{$name}','{$email}',MD5('".$password."'),2,1);";
        executeQuery($sqls);
        echo json_encode(array('status'=>true));
    }
    else{ 
        echo json_encode(array('status'=>false));
    }
}

?>