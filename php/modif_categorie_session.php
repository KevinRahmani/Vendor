<?php
session_start();
$response ='';

if(isset($_POST['categorie'])){
    if($_POST['categorie'] != ""){
        $_SESSION['categorie'] = $_POST['categorie'];
        $response ="ok";
    } else{
        $response ="vide";
    }
} else {
    $response ="fail";
}

echo $response;
?>