<?php
session_start();
$data ="";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';


if(!empty($_POST)){
    foreach ($_POST as $post_min){
        if(empty($post_min) || $post_min == NULL || $post_min == ''){
            $success = 0;
            $data = "Veuillez rentrer des valeurs";
        }
    }
} else {
    $success = 0;
    $data = "Veuillez rentrer des valeurs";
}


$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->AuthType = 'LOGIN';
    $mail->Username   = 'vendor.cytech@gmail.com';                     //SMTP username
    $mail->Password   = 'equviwkdazlpsgfr';                               //SMTP password
    $mail->SMTPSecure = 'tls';          //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('vendor.cytech@gmail.com', 'Vendor');
    $mail->addAddress("vendor.cytech@gmail.com", $_POST['name']);     //Add a recipient             

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Contact Client !';

    $mail->Body    =  "M.".$_POST['name']." nous envoie : ".$_POST['message'];

    $mail->send();

    $data = "ok";
} catch (Exception $e) {
    $data = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

echo $data;

?>