<?php
session_start();
ob_start();

include('connexion_stock.php');
include('connexion_user.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$data = '';

//buffer
echo '<h2>Vendor vous remercie de votre achat</h2><br><br>';
echo 'Bonjour ' . $_SESSION['user']['nom'] . ',<br>L\'équipe Vendor est heureuse de vous envoyer votre récapitulatif de commande :<br><br>';
echo '<h4>Commande :</h4>';
foreach ($_SESSION['panier'] as $tab_min) {
    echo "Nom : " . $tab_min['nom'] . "<br>";
    echo "Référence : " . $tab_min['id'] . "<br>";
    echo "Quantité : " . $tab_min['quantity'] . "<br>";
    echo "Prix unitaire : " . $tab_min['prix'] . "<br><br>";
}

switch ($_SESSION['connecte']) {
    //client
    case 1:
        if($_SESSION['user']['contrat'] == 1){
            echo "Remise fidelité Vendor -5% : Prix total : " . $_SESSION['prixtot'] . " euros.<br>";
        }else {
           echo "Prix total : " . $_SESSION['prixtot'] . " euros.<br>";
        }
        break;
    
    //vendeur
    case 2:
        echo "Remise partenariat Vendor -5% : Prix total : " . $_SESSION['prixtot'] . " euros.<br>";
        break;
    //admin
    case 3:
        echo "Remise totale admin Vendor : Prix total : " . $_SESSION['prixtot'] . " euros.<br>";
        break;  

}

echo "Votre livraison vous sera acheminée par : ".$_SESSION['arrayLivreur']['Livreur']." arrivera dans : ".$_SESSION['arrayLivreur']['Duree']." jours";
echo "<br>Nous vous remercions de votre confiance, à très vite<br>";

$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 1;                      //Enable verbose debug output
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
    $mail->addAddress($_SESSION['user']['mail'], $_SESSION["user"]['nom']);     //Add a recipient             

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'Commande Vendor !';

    $mail->Body    = ob_get_clean();

    $mail->send();

    $data = "ok";
} catch (Exception $e) {
    $data = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

ob_end_clean();
echo json_encode(array('data' => $data));
?>