<?php
session_start();

include('connexion_user.php');
$data ='';
$success = 1;
$id = uniqid(false);

if(!empty($_POST))
{
    foreach ($_POST as $post_min){
        if(empty($post_min) || $post_min == '' || $post_min == NULL){
            $data = "Veuillez rentrer des valeurs";
            $success = 0;
        }
    }
} else {
    $data ="Veuillez rentrer des valeurs";
    $success = 0;
}

if($_POST['categorie'] ==""){
    $success=0;
    $data = "Veuillez rentrer une societe";
}



//verifie si nom pas deja present dans la bdd a faire


if($success == 1){
    $ArrayVendeur = array(
        "id" => $id,
        "nom" => htmlentities($_POST['nom']),
        "password" => htmlentities($_POST['password']),
        "mail" => htmlentities($_POST['mail']),
        "datesignup" => date('Y-m-d'),
        "societe" => htmlentities($_POST['categorie']),
        "contrat" => 1,
        "nbColis" => 0,
        "type_permis" => htmlentities($_POST['permis']),
        "nbLivraison" => 0,
        "adresse" => htmlentities($_POST['adresse']),
    );

    try {
        $sqlQuery = $db_user->prepare("INSERT INTO livreur VALUES (:id, :nom, :password, :mail, :datesignup, :societe, :contrat, :nbColis, :type_permis, :nbLivraison, :adresse)");
        $sqlQuery->execute($ArrayVendeur);
        $data = "ok";
    }catch (Exception $e) {
        echo $e;
    }
}


echo $data
?>