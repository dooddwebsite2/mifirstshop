<?php require_once('../../config.php'); ?>
<?php
$action = isset($_POST['action']) ? $_POST['action'] : '';
$name = isset($_POST['name']) ? $_POST['name'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$comment = isset($_POST['comment']) ? $_POST['comment'] : '';
$content_id = isset($_POST['comment']) ? $_POST['content_id'] : 0;
if($action == 'post_form')
{
    $datetimes = date("Y-m-d H:i:s");
    $sqls = "INSERT INTO content_comment(content_id,comment_poster_name,comment_email,comment_message,comment_datetime)
    VALUES ('{$content_id}', '{$name}', '{$email}','{$comment}','{$datetimes}');";
    executeQuery($sqls);
}
?>