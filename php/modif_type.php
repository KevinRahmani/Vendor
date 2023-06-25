<?php
session_start();
include('connexion_stock.php');

//default
$sqlQuery = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']);
$Category = $db->prepare($sqlQuery);
$Category->execute();
$Array_Cat = $Category->fetchAll();

//croissant 

$croissantQuery = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']) . 'ORDER BY prix ASC';
$croissant = $db->prepare($croissantQuery);
$croissant->execute();
$Array_croissant = $croissant->fetchAll();

//decroissant
$decroissantQuery = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']) . 'ORDER BY prix DESC';
$decroissant = $db->prepare($decroissantQuery);
$decroissant->execute();
$Array_decroissant = $decroissant->fetchAll();

//marque
$marqueQuery = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']) . 'ORDER BY marque ASC';
$marque = $db->prepare($marqueQuery);
$marque->execute();
$Array_marque = $marque->fetchAll();

//type

$typeQuery = 'SELECT DISTINCT type FROM '. PDObackquote($_SESSION['categorie']);  
$type = $db->prepare($typeQuery);
$type->execute();
$Array_type = $type->fetchAll();




$data = array();

if(isset($_GET['option'])){
    switch ($_GET['option']) {
        case "croissant" : 
            $data = $Array_croissant; 
            break;
        case "decroissant" : 
            $data = $Array_decroissant; 
            break;
        case "marque" : 
            $data = $Array_marque; 
            break;
        default : 
            $data = $Array_Cat;
            break;
    }
}

//type query
if(isset($_GET['option'])){
    foreach ( $Array_type as $type ){
        if($type[0] == $_GET['option']){
            $query = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']) . ' WHERE type = ?';  
            $typeSelec = $db->prepare($query);
            $typeSelec->execute(array($_GET['option']));
            $data = $typeSelec->fetchAll();
        }
    }
}
echo json_encode(['data' => $data, 'categorie' => $_SESSION['categorie']]);
?>