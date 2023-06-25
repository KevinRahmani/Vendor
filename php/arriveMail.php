<?php
session_start();

include ('connexion_colis.php');
include('connexion_user.php');

$id_colis = $_POST['colis'];
$sqlQuery = $db_colis->prepare("SELECT * FROM colis WHERE id = ?");
$sqlQuery->execute(array($id_colis));
$arrayQuery = $sqlQuery->fetchAll();
$array_client = $arrayQuery[0];

switch($array_client['connecte']){
    case 1 :
        $sqQueryClient = $db_user->prepare("SELECT * FROM client WHERE id = ?");
        $sqQueryClient->execute(array($array_client['id_client']));
        $arrayClient = $sqQueryClient->fetchAll();
        $array_client2 = $arrayClient[0]; 
        break;
    case 2 :
        $sqQueryClient = $db_user->prepare("SELECT * FROM vendeur WHERE id = ?");
        $sqQueryClient->execute(array($array_client['id_client']));
        $arrayClient = $sqQueryClient->fetchAll();
        $array_client2 = $arrayClient[0];
        break;

    case 3 : 
        $sqQueryClient = $db_user->prepare("SELECT * FROM admin WHERE id = ?");
        $sqQueryClient->execute(array(intval($array_client['id_client'])));
        $arrayClient = $sqQueryClient->fetchAll();
        $array_client2 = $arrayClient[0];
        break;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$data = '';

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 0;                      //Enable verbose debug output
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
    $mail->addAddress($array_client2['mail'], $array_client2['nom']);     //Add a recipient             

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Commande Vendor arrivee !';

    $mail->Body    = '<h2>Vendor vous remercie de votre patience</h2><br><br>Votre colis est bien arrivé, nous vous en souhaitons bonne récéption !';

    $mail->send();

    $data = "ok";
} catch (Exception $e) {
    $data = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}


echo $data;
?>