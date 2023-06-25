<?php
session_start();
include('connexion_stock.php');
//data
$data='';
$id = random_int(1000,100000);
$success=1;

//verifie si tt est rentré 

if(!empty($_POST)){
    foreach ($_POST as $post_min){
        if(empty($post_min) || $post_min == NULL || $post_min == ''){
            $success = 0;
            $data = "Veuillez rentrer des valeurs";
        }
    }

} else {
    $success = 0;
    $data = "Veuillez rentrer des valeurs";
}

if($_FILES['image']['error'] == 4){
    $success = 0;
    $data = "Pas d'image ";
}

$arrayInsert = array(
    "id" => $id,
    "nom" => $_POST['nom'],
    "marque" => $_POST['marque'],
    "prix" => $_POST['prix'],
    "vendeur" => $_SESSION['user']['nom'],
    "stock" => $_POST['stock'],
    "type" => $_POST['type'],
    "couleur" => $_POST['couleur'],
    "description" => $_POST['description'],
    "sales" => 0,
    "image" => "",
);

if($_SESSION['connecte'] == 2){
    $arrayInsert['image'] = "img/".$_SESSION['user']['categorie']."/".$id."/";
} else if($_SESSION['connecte'] == 3){
    $arrayInsert['image'] = "img/".$_POST['categorie']."/".$id."/";
}

if($success == 1)
{
    try{

        if($_SESSION['connecte'] == 2){
            $sqlQuery = $db->prepare("INSERT INTO ". PDObackquote($_SESSION['user']['categorie'])." VALUES (:id, :nom, :marque, :prix, :vendeur, :stock, :type, :couleur, :description, :sales, :image)");
        } else if($_SESSION['connecte'] == 3){
            $sqlQuery = $db->prepare("INSERT INTO ". PDObackquote($_POST['categorie'])." VALUES (:id, :nom, :marque, :prix, :vendeur, :stock, :type, :couleur, :description, :sales, :image)");
        }
        $sqlQuery->execute($arrayInsert);

        //verifie su ya bien une image telecharge
        $uploadOk = 1;
        $imageFileType = new SplFileInfo($_FILES["image"]["name"]); 

        //verifie le format de l'image
        if($imageFileType->getExtension() != "jpg" ) {
            $uploadOk = 0;
            $data = "Mauvais format veuillez choisir un jpg";
        }

        //upload l'image
        if($uploadOk == 1){
                  
            $_FILES["image"]["name"] = "1.jpg";

            if($_SESSION['connecte'] == 2){
                $categorie = $_SESSION['user']['categorie'];
                mkdir("../img/$categorie/$id");
                $target_dir = "../img/$categorie/$id/";
            } else if($_SESSION['connecte'] == 3){
                $categorie =$_POST['categorie'];
                mkdir("../img/$categorie/$id");
                $target_dir = "../img/$categorie/$id/";
            }   
            $target_file = $target_dir . basename($_FILES["image"]["name"]);

            if(move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
                $data = "ok";
            } else {
                $data = "fail move";
            }
        } else {
            $data = "fail";
        }

        
    }catch (Exception $e) {
        echo $e;
    }
} 

echo $data;

?>