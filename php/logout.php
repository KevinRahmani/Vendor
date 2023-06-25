<?php
session_start();

unset($_SESSION['user'], $_SESSION['connecte'], $_SESSION['panier']);
$response ="ok";
echo $response;
?>