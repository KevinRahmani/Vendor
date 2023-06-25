<?php
session_start();

$tab=explode("-",$_GET['id']);
$signe=$tab[0];
$id_recup=$tab[1];

//fonction qui sécurise les requetes mysql contre les injections SQL
include('connexion_stock.php');


$sqlQuery = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']). ' WHERE id=?';
$Category = $db->prepare($sqlQuery);
$Category->execute(array($id_recup));
$Array_Category = $Category->fetchAll();

$stat ='';

//pour le btn plus
if($signe == 'plus'){
    //parcours du panier aevc key & values
    foreach ($_SESSION['panier'] as $key => $tab_panier){
        //correspondance de l'id avec le produit 
        if($tab_panier['id'] == $id_recup){
            //check si assez en stock
            if(intval($tab_panier['quantity']) < intval($Array_Category[0]['stock'])){
                //incrémente le panier php
                $_SESSION['panier'][$key]['quantity']=intval($_SESSION['panier'][$key]['quantity']) + 1;
                //variable pour le js
                $stat ='plus-ok';
                break;
            }else{
                $stat ='plus-fail';
                break;
            }
        }
    }
    
}

//pour minus
if($signe == 'minus'){
    //parcours du panier
    foreach ($_SESSION['panier'] as  $key => $tab_panier){
        //correspondance de l'id
        if($tab_panier['id'] == $id_recup){
            //check si le panier a une quantité sup a 0
            if($tab_panier['quantity'] > 0){
                $stat = "minus-ok";
                //decrémentation
                $_SESSION['panier'][$key]['quantity']=intval($_SESSION['panier'][$key]['quantity']) - 1;
                //si le stock du panier tombe a 0 on supprime la ligne du panier
                if(intval($_SESSION['panier'][$key]['quantity']) == 0){
                    $stat = "minus-unset";
                    unset($_SESSION['panier'][$key]);
                }
                break;
            }
        }
    } 
}


echo json_encode(['stat' => $stat]);
?>