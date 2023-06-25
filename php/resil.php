<?php
session_start();
include('connexion_user.php');
$data ="";
//delete le compte de la bdd


try{
    $sqlQuery = $db_user->prepare("DELETE FROM vendeur WHERE id=?");
    $sqlQuery->execute(array($_SESSION['user']['id']));
    unset($_SESSION['user'], $_SESSION['connecte']);
    $data ="ok";
} catch(Exception ){
    $data = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

echo $data;
?>