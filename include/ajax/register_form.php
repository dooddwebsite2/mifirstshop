<?php require_once('../../config.php'); ?>
<?php
$ds = DIRECTORY_SEPARATOR; 
$action = isset($_POST['action']) ? $_POST['action'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email =isset($_POST["email"])?$_POST["email"]: '';
$id =isset($_POST["user_id"])?$_POST["user_id"]: '';
$status =isset($_POST["status"])?$_POST["status"]: '';
$password = isset($_POST["password"])?$_POST["password"]: '';
if($action == 'insert_profiles'){
    $profileArrays = LoginFunc('',$name,'','1');
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
if($action == 'update_password'){
    $sql = "UPDATE auth_account SET u_pass =  md5('{$password}') WHERE id = {$id} ";

    executeQuery($sql);
    echo json_encode(array('status'=>true));
}
if($action == 'ban_user'){
    $status = $status > 0 ? 0 : 1;
    $sql = "UPDATE auth_account SET u_active =  '{$status}' WHERE id = {$id} ";
 
    executeQuery($sql);
    echo json_encode(array('status'=>true));

}

if($action == 'delete_user'){
    $_QUERYARRAYS =  array();
    $_QUERYARRAYS[] = "DELETE FROM auth_account WHERE id = {$id}";
    $_QUERYARRAYS[] = "UPDATE category SET create_by = NULL WHERE create_by = {$id} ";
    $_QUERYARRAYS[] = "UPDATE category SET content_create_by = NULL WHERE content_create_by = {$id} ";
    DELETE_STRUCTURE($_QUERYARRAYS);

    echo json_encode(array('status'=>true));
}

?>