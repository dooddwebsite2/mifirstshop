<!-- include email -->
<?php require_once('../../lib/PHPMailer/class.phpmailer.php'); ?>

<?php
$action = isset($_POST['action']) ? $_POST['action'] : '';
$firstname = isset($_POST['firstname']) ? $_POST['firstname'] : '';
$lastname = isset($_POST['lastname']) ? $_POST['lastname'] : '';
$email = isset($_POST['email']) ? $_POST['email'] : '';
$subject = isset($_POST['subject']) ? $_POST['subject'] : '';
$message = isset($_POST['message']) ? $_POST['message'] : '';

if($action == 'contact_request')
{
    $mail             = new PHPMailer();
    $body = '
    <html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <title>หัวข้อ:'.$subject.'</title>
    </head>
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>
    <body>
        <h1>หัวข้อ:'.$subject.'</h1>
        <table style=" border: 1px solid #dddddd;width: 1024px; height: 378px;">
            <tr>
                <th>ชื่อ:</th><td>'.$firstname.' '.$lastname.'</td>
            </tr>
            <tr style="background-color: #e0e0e0;">
                <th>Email:</th><td>'.$email.'</td>
            </tr>
            <tr>
                <th>ข้อความร้องเรียน:</th><td>'.$message.'</td>
            </tr>
        </table>
    </body>
    </html>';

    $mail->IsSMTP(); // telling the class to use SMTP
    
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "tls";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 587;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "dooddwebsite2@gmail.com";  // GMAIL username
    $mail->Password   = "dooddwebsite";            // GMAIL password
    
    $mail->SetFrom('dooddwebsite2@gmail.com', 'Warning: MIFIRST SHOP!!');
    
    $mail->AddReplyTo("dooddwebsite2@gmail.com","Warning: MIFIRST SHOP!!");
    
    $mail->Subject    = "Warning: MIFIRST SHOP(email:".$email.") !!";
    
    $mail->AltBody    = "Warning: MIFIRST SHOP!!"; // optional, comment out and test
    
    $mail->MsgHTML($body);
    
    $address = "dooddwebsite2@gmail.com";
    $mail->AddAddress($address, "MIFIRST SHOP");
    
    if(!$mail->Send()) {
      echo 'Mailer Error:'.$mail->ErrorInfo;
    } else {
      echo "Message sent!";
    }
}
?>