<?php
session_start();

include('connexion_stock.php');
include('connexion_user.php');


try{
    foreach($_SESSION['panier'] as $key => $tab_min){

    //decrementer le stock : check
    $decrementerQuery = $db->prepare('UPDATE '. PDObackquote($tab_min['categorie']). ' SET stock=stock-? WHERE id=?');
    $decrementerQuery->execute(array($tab_min['quantity'] ,$tab_min['id']));

    //incrementer les ventes du produit : check
    $incrementerSales = $db->prepare('UPDATE '. PDObackquote($tab_min['categorie']). ' SET sales=sales+? WHERE id=?');
    $incrementerSales->execute(array($tab_min['quantity'],$tab_min['id']));

    //incrementer histocommand user : check
    if($_SESSION['connecte'] == 1){
        $incrementerCommand = $db_user->prepare('UPDATE client SET histocommand=CONCAT(histocommand,"<br><br>",?," : ",?," ",?,"<br>","Quantite : ",?) WHERE nom=?');
        $incrementerCommand->execute(array($tab_min['date'], $tab_min['marque'], $tab_min['nom'], $tab_min['quantity'],$_SESSION['user']['nom']));
    
        //incrementer nbproducts : check
        $incrementerNbProduct = $db_user->prepare('UPDATE client SET nbproduct=nbproduct+? WHERE nom=?');
        $incrementerNbProduct->execute(array($tab_min['quantity'],$_SESSION['user']['nom']));
    }

    //incrementer CA vendeur nbtotalsales : check
    if($tab_min['vendeur'] == "Vendor"){
        //si c'est Vendor le vendeur 
        $incrementerSalesVendeur = $db_user->prepare('UPDATE admin SET nbtotalsales=? WHERE nom=?');
        $incrementerSalesVendeur->execute(array(ceil(doubleval($tab_min['prix'])*doubleval($tab_min['quantity'])),"Vendor"));
    } else {
        //sinon si c un vendeur lambda
        $incrementerSalesVendeur = $db_user->prepare('UPDATE vendeur SET nbtotalsales=? WHERE nom=?');
        $incrementerSalesVendeur->execute(array(ceil(doubleval($tab_min['prix'])*doubleval($tab_min['quantity'])*0.95),$tab_min['vendeur']));

        //incremente part de l'admin
        $incrementerSalesAdmin = $db_user->prepare('UPDATE admin SET nbtotalsales=? WHERE nom=?');
        $quota = ceil(doubleval($tab_min['prix'])*doubleval($tab_min['quantity'])*0.05);
        $incrementerSalesAdmin->execute(array($quota,"Vendor"));

        $incrementerSalesAdmin = $db_user->prepare('UPDATE admin SET externe=? WHERE nom=?');
        $quota = ceil(doubleval($tab_min['prix'])*doubleval($tab_min['quantity'])*0.05);
        $incrementerSalesAdmin->execute(array($quota,"Vendor"));
    }

    

    }
}catch (Exception $e) {
    $data = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
$data = "ok";


//supprime le panier 
unset($_SESSION['panier']);
echo $data;
?>