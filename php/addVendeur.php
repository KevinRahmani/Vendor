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




//verifie si nom pas deja present dans la bdd a faire


if($success == 1){
    $ArrayVendeur = array(
        "id" => $id,
        "nom" => htmlentities($_POST['nom']),
        "password" => htmlentities($_POST['password']),
        "mail" => htmlentities($_POST['mail']),
        "categorie" => $_POST['categorie'],
        "adresse" => htmlentities($_POST['adresse']),
        "contrat" => 0,
        "datesignup" => date("Y-m-d"),
        "endcontrat" => '0000-00-00',
        "nbtotalsales" => 0,
    );

    try {
        $sqlQuery = $db_user->prepare("INSERT INTO vendeur VALUES (:id, :nom, :password, :mail, :categorie, :adresse, :contrat, :datesignup, :endcontrat, :nbtotalsales)");
        $sqlQuery->execute($ArrayVendeur);
        $data = "ok";
    }catch (Exception $e) {
        echo $e;
    }
}


echo $data
?>