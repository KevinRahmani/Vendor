<?php
session_start();
include('connexion_stock.php');

$data="";
$success =1;

//supprime un produit

if(!empty($_POST)){
    foreach ($_POST as $post_min){
        if(empty($post_min) || $post_min == NULL || $post_min == ''){
            $success = 0;
            $data = "Veuillez rentrer des valeurs";
        }
    }

} else {
    $success = 0;
    $data = "Veuillez rentrer des valeurs";
}

if(!isset($_POST['list_produit_supp'])){
    $success = 0;
    $data = "Veuillez rentrer des valeurs";
}

if($success == 1){

    if($_SESSION['connecte'] == 2){
        $categorie = $_SESSION['user']['categorie'];
    } else if($_SESSION['connecte'] == 3){
        $categorie = $_POST['selectValue'];
    }

    try{
        $sqlQuery = $db->prepare("DELETE FROM ".PDObackquote($categorie). " WHERE vendeur LIKE ? AND id=?");
        $sqlQuery->execute(array($_SESSION['user']['nom'],$_POST['list_produit_supp']));
        $data="ok";
    }catch (Exception $e) {
        $data = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}


echo $data
?>