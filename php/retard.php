<?php 
session_start();
include ('connexion_colis.php');
include ('connexion_user.php');
$values=array(
    'id' => htmlentities($_GET['id_colis']),    
);
$add_days = $db_colis->prepare("UPDATE colis SET date_livraison = DATE_ADD(date_livraison, INTERVAL 1 DAY) WHERE id=:id");
$add_days->execute($values);

$response = "ok";
echo $response;
?>