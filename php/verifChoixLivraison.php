<?php
session_start();
$response ='';
$_SESSION['arrayLivreur'] = array(
    "Livreur" => "",
    "Duree" => "",
    "Prix" => "",
);

if(isset($_POST['valueSelect'])){
    if($_POST['valueSelect'] != ""){
        //admin
        if( $_SESSION['connecte'] ==  3 ){
                $_SESSION['arrayLivreur']["Livreur"] = "Colissimo";  
                $_SESSION['arrayLivreur']["Duree"] = 2;
                $_SESSION['arrayLivreur']["Prix"] = 0;
                unset($_SESSION['arrayLivraison']);
                $response = "ok";
            //vendeur or user
        } else if($_SESSION['connecte'] == 1 || $_SESSION['connecte'] == 2){
            if($_SESSION['user']['contrat'] == 1 ){
                $_SESSION['arrayLivreur']["Livreur"] = "Colissimo";  
                $_SESSION['arrayLivreur']["Duree"] = 2;
                $_SESSION['arrayLivreur']["Prix"] = 0;
                unset($_SESSION['arrayLivraison']);
                $response = "ok";
            } else{
                foreach($_SESSION['arrayLivraison'] as $key => $value){
                    if($key == $_POST['valueSelect']){
                        $_SESSION['arrayLivreur']["Livreur"] = $_POST['valueSelect'];  
                        $_SESSION['arrayLivreur']["Duree"] = $value['Duree'];
                        $_SESSION['arrayLivreur']["Prix"] = $value['Prix'];
                        $_SESSION['prixtot'] +=$value['Prix'];
                        unset($_SESSION['arrayLivraison']);
                        $response = "ok";
                    }
                }
    
            }
        }    
    } else{
        $response ="Veuillez choisir une entreprise de livraison";
    }
} else {
    $response ="fail";
}

echo $response;
?>