<?php
session_start();

include('connexion_user.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/Exception.php';
require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';

$response ="";

function envoyer_mail($ArrayClient){
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
        foreach($ArrayClient as $arrayMin){
            $mail->addAddress($arrayMin['mail'],$arrayMin['nom']);
        }


        //Attachments         //Add attachments
        $mail->addAttachment('../img/Automobile/4/1.jpg', 'C3.jpg');    //Optional name
        $mail->addAttachment('../img/Automobile/16/1.jpg', 'Audi_Q4.jpg');    
        $mail->addAttachment('../img/Automobile/8/1.jpg', 'Golf.jpg');    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Promotion Vendor !';

        $mail->Body    = "<h2>VENTE FLASH Vendor</h2><br><br>Bonjour ,<br><b>Nos autos phares sont actuellement en promotions !!
                        </b><br>La fameuse <i>Golf GTI</i>, spécialité de nos allemands est actuellement en promotion à -30% !<br>Mais ce n'est pas tout ! 
                        la <i>Citroen C3</i> et l' <i>Audi Q4</i> sont eux aussi en promotion pendant une durée limitée alors venez en profiter !!";

        $mail->send();
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}



if($_SESSION['connecte'] == 3)
{
    try{
        $sqlQuery = $db_user->prepare("SELECT * FROM client");
        $sqlQuery->execute();
        $ArrayClient = $sqlQuery->fetchAll();
    }catch (Exception $e){
        $response = "Error :".$e->getMessage();
    }
    envoyer_mail($ArrayClient);
    $response = "ok";
}


echo $response;

?>