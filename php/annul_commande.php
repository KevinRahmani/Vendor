<?php
session_start();


$statue='ok';
unset($_SESSION['panier']);

echo json_encode(['statue' => $statue]);
?>