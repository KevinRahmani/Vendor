<?php
session_start();
include('connexion_user.php');
include('connexion_stock.php');
$data ='';
$success = 1;


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


if($success == 1){

    try {
        //supprime le livreur de la bdd des users
        $sqlQuery = $db_user->prepare("DELETE FROM livreur WHERE id = ?");
        $sqlQuery->execute(array($_POST['id_livreur']));
    
        
        $data = "ok";

    } catch (Exception $e){
        echo $e;
    }

}


echo $data; 
?>