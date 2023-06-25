<?php
session_start();

include('connexion_stock.php');
$response ='';


function fusionnerDoublons($tableau)
{
    $nouveauTableau = array();

    foreach ($tableau as $element) {
        $id = $element['id'];
        $quantity = intval($element['quantity']);

        if (isset($nouveauTableau[$id])) {
            $nouveauTableau[$id]['quantity'] += $quantity;
        } else {
            $nouveauTableau[$id] = $element;
        }
    }

    return array_values($nouveauTableau);
}


//verifie si le panier existe 
if(isset($_SESSION['panier'])){
    //parcours l'ensemble des lignes du panier et cherche un produit appartenant au même type que celui désiré 
    foreach($_SESSION['panier'] as $key => $ligne_panier){
        try{

            //recupere les infos du prix le moins cher et l'enregistre dans un tableau ArrayProduit
            $sqlQuery = $db->prepare("SELECT * FROM ".PDObackquote($ligne_panier['categorie'])." WHERE type LIKE ? ORDER BY prix ASC");
            $sqlQuery->execute(array($ligne_panier['type']));
            $ArrayQuery = $sqlQuery->fetchAll();
            $ArrayProduit = $ArrayQuery[0];

            //verifie si assez en stock
            if(intval($ligne_panier['quantity']) > intval($ArrayProduit['stock'])){
                $_SESSION['panier'][$key]['quantity'] = $ArrayProduit['stock'];
            }
            
            //modifie cette partie dans la ligne du panier
            $_SESSION['panier'][$key]['nom'] = $ArrayProduit['nom'];
            $_SESSION['panier'][$key]['id'] = $ArrayProduit['id'];
            $_SESSION['panier'][$key]['vendeur'] = $ArrayProduit['vendeur'];
            $_SESSION['panier'][$key]['image'] = $ArrayProduit['image'];
            $_SESSION['panier'][$key]['marque'] = $ArrayProduit['marque'];
            $_SESSION['panier'][$key]['prix'] = $ArrayProduit['prix'];

            $response ='ok';

        }catch(Exception $e){
            $response += "Error: ".$e->getMessage()."<br>";
        }
    }
    
    // $tabIndex = array();
    
    $newBasket = fusionnerDoublons($_SESSION['panier']);
    $_SESSION['panier'] = $newBasket;


} else {
    $response = "Panier vide, problème detecté ";
}




echo $response;
?>