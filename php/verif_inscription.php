<?php
session_start();

include('connexion_user.php');
//conversion en htmlentities pour eviter les intrusions de code 

$today = date("Y-m-d H:i:s"); 
$success = 1;
$data ='';

function istring($var) : bool
{
    if(preg_match("/\d+/", $var)){
        return true;
    }
    return false;
}

//verif

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
    $success=0;
    $data='Veuillez remplir tous les champs';
}

//verif si le nom n'est pas deja dans la bdd
$verifQuery = $db_user->prepare('SELECT * FROM client WHERE nom = ? OR mail = ?');
$verifQuery->execute(array(htmlentities($_POST['nom']), htmlentities($_POST['mail'])));
$array_name = $verifQuery->fetchAll();
if(!empty($array_name)){
    $success = 0;
    $data = "Nom ou adresse mail déjà pris, veuillez réessayer";
}





if($success == 1){
    try{
        $arraySup=array(
            'id' => uniqid("", false),
            'nom' => htmlentities($_POST['nom']),
            'password' => htmlentities($_POST['password']),
            'mail' => htmlentities($_POST['mail']),
            'datesignup' => $today,
            'contrat' => 0,
            'adresse' => htmlentities($_POST['adresse']),
            'is_admin' => 0,
            'is_seller' => 0,
            'nbproduct' => 0,
            'histocommand' => "",
        );
        //On utilise les requêtes préparées et des marqueurs nommés 
        $sth = $db_user->prepare(
            "INSERT INTO client (id, nom, password, mail, datesignup, contrat, adresse, is_admin, is_seller, nbproduct, histocommand) VALUES (:id, :nom, :password, :mail, :datesignup, :contrat, :adresse, :is_admin, :is_seller, :nbproduct, :histocommand)"
        );
        $sth->execute($arraySup);
        $data = "ok";
        
    }catch(PDOException $e){
        $data =  "Erreur : " . $e->getMessage();
    }
    //code pour client = 1, vendeur = 2, admin = 3
    $_SESSION['connecte'] = 1;

    //recupération de la table client et passage en variable de session
    $queryUser = $db_user->prepare("SELECT * FROM client WHERE nom = ?");
    $queryUser->execute(array(htmlentities($_POST['nom'])));
    $Array_user = $queryUser->fetchAll();
    $_SESSION['user'] = $Array_user[0];
}

echo $data;
?>