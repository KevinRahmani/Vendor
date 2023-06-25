<?php
session_start();

//fonction qui sécurise les requetes mysql contre les injections SQL
include('connexion_stock.php');
$today = date("Y-m-d H:i:s"); 


$sqlQuery = 'SELECT * FROM '. PDObackquote($_SESSION['categorie']). ' WHERE id=?';
$Category = $db->prepare($sqlQuery);
$Category->execute(array($_GET['id']));
$Array_Category = $Category->fetchAll();

//initiate variables
$stock =0;
$status = '';


foreach($Array_Category as $product){
    if(intval($product['stock']) >= intval($_GET['quantity'])){
        $status='ok';   
        //une ligne de ce produit existe déjà donc on ajoute la quantité désirée
        if(!empty($_SESSION['panier'])){
            //parcours le panier et trouve le produit
            foreach($_SESSION['panier'] as $key => $tab_min_panier){
                //correspondance
                if($tab_min_panier['id'] == $_GET['id']){    
                    //check si la quantité demandé et celle du panier est inférieur au stock 
                    if($tab_min_panier['quantity'] + $_GET['quantity'] <= $product['stock'])   {       
                        $_SESSION['panier'][$key]['quantity']+=intval($_GET['quantity']);
                        break 2;
                    //si supérieur, $stock prend la valeur maximale restante ie : valeur du stock initial - valeur quantité du panier
                    }else{
                        $status = 'not-enough';
                        $stock = intval($product['stock'])-intval($_SESSION['panier'][$key]['quantity']);
                        break 2;
                    }
                }   
            }
            //si la ligne du panier n'existe pas on la crée
            $newData =array(
                'nom' => (string) $product['nom'],
                'id' => (string) $product['id'],
                'vendeur' => (string) $product['vendeur'],
                'quantity' => (int) $_GET['quantity'],
                'image' => (string) $product['image'],
                'type' => (string) $product['type'],
                'marque' => (string) $product['marque'],
                'prix' => (string) $product['prix'],
                'date' => $today,
                'categorie' => (string) $_SESSION['categorie'],
            ); 
            $_SESSION['panier'][]=$newData;
            break;  
        //si le panier n'existe pas on le crée           
        }else{    
            $newData =array(
                'nom' => (string) $product['nom'],
                'id' => (string) $product['id'],
                'vendeur' => (string) $product['vendeur'],
                'quantity' => (int) $_GET['quantity'],
                'image' => (string) $product['image'],
                'type' => (string) $product['type'],
                'date' => $today,
                'marque' => (string) $product['marque'],
                'prix' => (string) $product['prix'],
                'categorie' => (string)  $_SESSION['categorie'],
            );
            $_SESSION['panier'][]=$newData;
            break;
        }
    }else{
        $status='not enough';
        $stock=intval($product['stock']);
        break ;
    }
}

echo json_encode(array('status' => $status, 'stock' => $stock));


?>