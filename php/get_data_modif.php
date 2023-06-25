<?php
session_start();
include("connexion_stock.php");

if($_SESSION['connecte'] == 2){
    $categorie = $_SESSION['user']['categorie'];
} else if($_SESSION['connecte'] == 3){
    $categorie = $_POST['categorie'];
}

try{


    $sqlQuery = $db->prepare("SELECT * FROM ".PDObackquote($categorie)." WHERE id=?");
    $sqlQuery->execute(array($_POST['id']));
    $arrayQuery = $sqlQuery->fetchAll();
    $ArrayProduct = $arrayQuery[0];

}catch (Exception $e) {
    echo $e;
}

echo json_encode($ArrayProduct);
?>