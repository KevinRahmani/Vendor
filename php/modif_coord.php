<?php
session_start();
include("connexion_user.php");

function istring($var) : bool
{
    if(preg_match("/\d+/", $var)){
        return true;
    }
    return false;
}

$data ='';


function is_free($nom, $mail,$db_user) : bool
{
    $sqlQueryNom = $db_user->prepare("SELECT nom FROM client WHERE nom=?");
    $sqlQueryNom->execute(array($nom));
    
    $sqlQuerymail = $db_user->prepare("SELECT mail FROM client WHERE mail=?");
    $sqlQuerymail->execute(array($mail));

    $arrayQueryNOM = $sqlQueryNom->fetchAll();
    $arrayQueryMail = $sqlQuerymail->fetchAll();


    if(empty($arrayQueryMail[0]) && empty($arrayQueryNOM[0])){
        return true;
    } 
    if(empty($arrayQueryNOM) && $_POST['mail'] == $arrayQueryMail[0]['mail']){
        return true;
    }
    if(empty($arrayQueryMail) && $_POST['nom'] == $arrayQueryNOM[0]['nom']){
        return true;
    }
    return false;
}

$success = 1;

if((empty($_POST['nom'])) || (istring($_POST['nom']))){
    $success=0;
    $data='Veuillez remplir tous les champs';
}
if((empty($_POST['mail'])) || (!preg_match ( " /^.+@.+\.[a-zA-Z]{2,}$/ " , $_POST['mail']))){
    $success=0;
    $data='Veuillez remplir tous les champs';
}
if(empty($_POST['password'])){
    $success=0;
    $data='Veuillez remplir tous les champs';
}
if(empty($_POST['adresse'])){
    if($_SESSION['connecte'] != 3){
        $success=0;
        $data='Veuillez remplir tous les champs';
    }
}

//nom
if($success == 1 && is_free($_POST['nom'],$_POST['mail'],$db_user)){
    //nom
    if($_SESSION['connecte'] == 1){
        $sqlQueryName = $db_user->prepare("UPDATE client SET nom=? WHERE id=? ");
        $sqlQueryName->execute(array(htmlentities($_POST['nom']),$_SESSION['user']['id']));
    
        //mail
        $sqlQueryMail = $db_user->prepare("UPDATE client SET mail=? WHERE id=? ");
        $sqlQueryMail->execute(array(htmlentities($_POST['mail']),$_SESSION['user']['id']));
    
        //password
        $sqlQueryPassword = $db_user->prepare("UPDATE client SET password=? WHERE id=? ");
        $sqlQueryPassword->execute(array(htmlentities($_POST['password']),$_SESSION['user']['id']));
    
        //adresse
        $sqlQueryAdresse = $db_user->prepare("UPDATE client SET adresse=? WHERE id=? ");
        $sqlQueryAdresse->execute(array(htmlentities($_POST['adresse']),$_SESSION['user']['id']));
    
        $data ="ok";
    } else if($_SESSION['connecte'] == 2){
        //nom
        $sqlQueryName = $db_user->prepare("UPDATE vendeur SET nom=? WHERE id=? ");
        $sqlQueryName->execute(array(htmlentities($_POST['nom']),$_SESSION['user']['id']));
    
        //mail
        $sqlQueryMail = $db_user->prepare("UPDATE vendeur SET mail=? WHERE id=? ");
        $sqlQueryMail->execute(array(htmlentities($_POST['mail']),$_SESSION['user']['id']));
    
        //password
        $sqlQueryPassword = $db_user->prepare("UPDATE vendeur SET password=? WHERE id=? ");
        $sqlQueryPassword->execute(array(htmlentities($_POST['password']),$_SESSION['user']['id']));
    
        //adresse
        $sqlQueryAdresse = $db_user->prepare("UPDATE vendeur SET adresse=? WHERE id=? ");
        $sqlQueryAdresse->execute(array(htmlentities($_POST['adresse']),$_SESSION['user']['id']));
        
        $data ="ok";
    } else if($_SESSION['connecte'] == 3){
        //nom
        $sqlQueryName = $db_user->prepare("UPDATE admin SET nom=? WHERE id=? ");
        $sqlQueryName->execute(array(htmlentities($_POST['nom']),$_SESSION['user']['id']));
    
        //mail
        $sqlQueryMail = $db_user->prepare("UPDATE admin SET mail=? WHERE id=? ");
        $sqlQueryMail->execute(array(htmlentities($_POST['mail']),$_SESSION['user']['id']));
    
        //password
        $sqlQueryPassword = $db_user->prepare("UPDATE admin SET password=? WHERE id=? ");
        $sqlQueryPassword->execute(array(htmlentities($_POST['password']),$_SESSION['user']['id']));

        //adresse
        $sqlQueryAdresse = $db_user->prepare("UPDATE admin SET adresse=? WHERE id=? ");
        $sqlQueryAdresse->execute(array(htmlentities($_POST['adresse']),$_SESSION['user']['id']));

        $data ="ok";
    }else if($_SESSION['connecte'] == 4){
        //nom
        $sqlQueryName = $db_user->prepare("UPDATE livreur SET nom=? WHERE id=? ");
        $sqlQueryName->execute(array(htmlentities($_POST['nom']),$_SESSION['user']['id']));
    
        //mail
        $sqlQueryMail = $db_user->prepare("UPDATE livreur SET mail=? WHERE id=? ");
        $sqlQueryMail->execute(array(htmlentities($_POST['mail']),$_SESSION['user']['id']));
    
        //password
        $sqlQueryPassword = $db_user->prepare("UPDATE livreur SET password=? WHERE id=? ");
        $sqlQueryPassword->execute(array(htmlentities($_POST['password']),$_SESSION['user']['id']));

        //adresse
        $sqlQueryPassword = $db_user->prepare("UPDATE livreur SET adresse=? WHERE id=? ");
        $sqlQueryPassword->execute(array(htmlentities($_POST['adresse']),$_SESSION['user']['id']));

        $data ="ok";
    }
}else{
    $data = "error : Coordonnées déjà prises";
}

echo $data;
?>