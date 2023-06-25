<?php
session_start();
include("connexion_user.php");
$response = '';

if(isset($_GET['type'])){
    //partie client
    if($_SESSION['connecte'] == 1){
        if($_GET['type'] == "Signer"){
            //contrat 1 == true
            $contratSQL = $db_user->prepare("UPDATE client SET contrat = 1 WHERE id =?");
            $contratSQL->execute(array($_SESSION['user']['id']));
    
            //end contract 
            $futureDate=date('Y-m-d', strtotime('+1 year'));
            $endcontrat = $db_user->prepare("UPDATE client SET endcontrat=? WHERE id =?");
            $endcontrat->execute(array($futureDate,$_SESSION['user']['id']));
    
            $response ="success";
        } else if($_GET['type'] == "Re-sign"){
    
            //recupere de la bdd la date de contrat
            $startdate = $db_user->prepare("SELECT endcontrat FROM client WHERE id=?");
            $startdate->execute(array($_SESSION['user']['id']));
            $array_start_date = $startdate->fetchAll();
            $date = $array_start_date[0][0];
    
            //la met à jour
            $futureDate=date('Y-m-d', strtotime('+1 year', strtotime($date)));
            $endcontrat = $db_user->prepare("UPDATE client SET endcontrat=? WHERE id =?");
            $endcontrat->execute(array($futureDate,$_SESSION['user']['id'])); 
            $response = "success";

        }
        //met +10 a nb totalSales de Vendor

        $CA_Vendor = $db_user->prepare("UPDATE admin SET nbtotalsales = nbtotalsales +10 WHERE nom = 'Vendor'");
        $CA_Vendor->execute();


        //partie vendeur
    } else if( $_SESSION['connecte'] == 2){
        if($_GET['type'] == "Signer"){
            //contrat 1 == true
            $contratSQL = $db_user->prepare("UPDATE vendeur SET contrat = 1 WHERE id =?");
            $contratSQL->execute(array($_SESSION['user']['id']));
    
    
            //end contract 
            $futureDate=date('Y-m-d', strtotime('+5 year'));
            $endcontrat = $db_user->prepare("UPDATE vendeur SET endcontrat=? WHERE id =?");
            $endcontrat->execute(array($futureDate,$_SESSION['user']['id']));
    
            $response ="success";
        } else if($_GET['type'] == "Re-sign"){
    
            //recupere de la bdd la date de contrat
            $startdate = $db_user->prepare("SELECT endcontrat FROM vendeur WHERE id=?");
            $startdate->execute(array($_SESSION['user']['id']));
            $array_start_date = $startdate->fetchAll();
            $date = $array_start_date[0][0];
    
            //la met à jour
            $futureDate=date('Y-m-d', strtotime('+5 year', strtotime($date)));
            $endcontrat = $db_user->prepare("UPDATE vendeur SET endcontrat=? WHERE id =?");
            $endcontrat->execute(array($futureDate,$_SESSION['user']['id'])); 
            $response = "success";
        }
    }
} else{
    echo "Error";
}

echo $response;
?>