<?php 
session_start();
include ('connexion_colis.php');
include ('connexion_user.php');
$values=array(
    'id' => htmlentities($_GET['id_colis']),    
);
$delete_db = $db_colis->prepare("DELETE FROM colis WHERE id=:id");
$delete_db->execute($values);

//modification du nombre de colis affecté au livreur
$livreur_id= $_SESSION['user']['id'];
$modif_affectation_livreur = $db_user->prepare('UPDATE livreur SET nbColis = (nbColis-1) WHERE id='.$livreur_id);
$modif_affectation_livreur->execute();

$_SESSION['user']['nbColis'] = $_SESSION['user']['nbColis'] - 1;

$response = "ok";
echo $response;
?>