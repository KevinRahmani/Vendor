<?php
session_start();

include('connexion_user.php');
include('connexion_colis.php');
$data='';
$success = 1;

if((empty($_POST['name']))){
    $success=0;
    $data='Veuillez remplir tous les champs';
}
if(empty($_POST['password'])){
    $success=0;
    $data='Veuillez remplir tous les champs';
}

if($success == 1){
    try{

        //recherche si client
        $ConnexionQuery = $db_user->prepare('SELECT * FROM client WHERE nom = ? AND password = ?');
        $ConnexionQuery->execute(array(htmlentities($_POST['name']),htmlentities($_POST['password'])));
        $Array_user = $ConnexionQuery->fetchAll();
        if(!empty($Array_user[0])){
            $_SESSION['user']=$Array_user[0];
            $_SESSION['connecte'] = 1;
            $data ="ok";
        }else{
            //recherche si vendeur
            $ConnexionVendeur = $db_user->prepare('SELECT * FROM vendeur WHERE nom = ? AND password = ?');
            $ConnexionVendeur->execute(array(htmlentities($_POST['name']),htmlentities($_POST['password'])));
            $Array_Vendeur = $ConnexionVendeur->fetchAll();
            if(!empty($Array_Vendeur[0])){
                $_SESSION['user']=$Array_Vendeur[0];
                $_SESSION['connecte'] = 2;
                $data ="ok";
            } else{
                //recherche si admin
                $ConnexionAdmin = $db_user->prepare('SELECT * FROM admin WHERE nom = ? AND password = ?');
                $ConnexionAdmin->execute(array(htmlentities($_POST['name']),htmlentities($_POST['password'])));
                $Array_Admin = $ConnexionAdmin->fetchAll();
                if(!empty($Array_Admin[0])){
                    $_SESSION['user']=$Array_Admin[0];
                    $_SESSION['connecte'] = 3;
                    $data ="ok";
                }else{ 
                    //recherche si livreur
                    $ConnexionLivreur = $db_user->prepare('SELECT * FROM livreur WHERE nom = ? AND password = ?');
                    $ConnexionLivreur->execute(array(htmlentities($_POST['name']),htmlentities($_POST['password'])));
                    $Array_Livreur = $ConnexionLivreur->fetchAll();
                    if(!empty($Array_Livreur[0])){
                        $_SESSION['user']=$Array_Livreur[0];
                        $_SESSION['connecte'] = 4;
                        $data ="livreur";
                    }else{ 

                        $data = "Utilisateur ou mot de passe incorrect";
                    }
                }
            }
        }
    }catch(PDOException $e){
        echo "Erreur : " . $e->getMessage();
    }
}

echo $data;
?>