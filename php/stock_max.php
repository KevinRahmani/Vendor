<?php
session_start();
include('connexion_stock.php');

//requete pour le stock

$sqlQuery = 'SELECT * FROM ' . PDObackquote($_SESSION['categorie']) . ' WHERE id = ?';
$sqlStock = $db->prepare($sqlQuery);
$sqlStock->execute(array($_GET['id']));
$stock_array = $sqlStock->fetchAll();


echo json_encode(array('data' => $stock_array));

?>