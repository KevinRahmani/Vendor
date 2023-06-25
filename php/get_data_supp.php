<?php
session_start();
include('connexion_stock.php');

$data = "";
$response = "";
$success =1;

if (!isset($_POST['valueSelect']) || $_POST['valueSelect'] == "") {
    $data = "Le paramètre n'a pas été envoyé.";
    echo $data;
    $success = 0;
} 

//recupere les produits dans la catégorie dont le vendeur est Vendor
if($success == 1){
    try {
        $sqlQuery = $db->prepare("SELECT * FROM ". PDObackquote($_POST['valueSelect'])." WHERE vendeur = 'Vendor'");
        $sqlQuery->execute();
        
        $ArrayQuery = $sqlQuery->fetchAll();
        $data ="ok";

    } catch (Exception $e) {
        echo "Error: ".$e->getMessage();
    }

    $response = array("data" => $data, "ArrayQuery" => $ArrayQuery);
}

echo json_encode($response);
?>