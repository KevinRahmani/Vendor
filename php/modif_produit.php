<?php
session_start();
include('connexion_stock.php');
//data
$data='';
$success=1;


//verifie si tt est rentré 

if(!empty($_POST)){
    foreach ($_POST as $key => $post_min){
        if(empty($post_min) || $post_min == NULL || $post_min == ''){
            $success = 0;
            $data = "Veuillez rentrer des valeurs";
        }
    }
} else {
    $success = 0;
    $data = "Veuillez rentrer des valeurs";
}


//si pas d'image 
if($_FILES['image2']['error'] == 4){
    $img = false;
} else {
    $img = true;
}

//connect to database and recup the results

if($_SESSION['connecte'] == 2){
    $categorie = $_SESSION['user']['categorie'];
} else if($_SESSION['connecte'] == 3){
    $categorie = $_POST['categorie'];
}


if($success == 1)
{

    try{

        $sqlQuery= $db->prepare("SELECT * FROM ".PDObackquote($categorie)." WHERE id=?");
        $sqlQuery->execute(array(intval($_POST['id'])));
        $ArrayBigMomUwU = $sqlQuery->fetchAll();
        $ArrayProduit = $ArrayBigMomUwU[0];
    }catch (Exception $e) {
        echo $e;
    }
    
    //update array
    $ArrayProduit['nom'] = $_POST['nom'];
    $ArrayProduit['prix'] = $_POST['prix'];
    $ArrayProduit['stock'] = $_POST['stock'];
    $ArrayProduit['type'] = $_POST['type'];
    $ArrayProduit['couleur'] = $_POST['couleur'];
    $ArrayProduit['description'] = $_POST['description'];
    
    
    try{

        //update la ligne en question
        $sqlQuery = $db->prepare("UPDATE ". PDObackquote($categorie)." SET nom=?, prix=?, stock=?, type=?, couleur=?, description=?, sales=?, image=? WHERE id=?");
        $sqlQuery->execute(array($ArrayProduit['nom'],$ArrayProduit['prix'],$ArrayProduit['stock'],$ArrayProduit['type'],$ArrayProduit['couleur'],$ArrayProduit['description'],$ArrayProduit['sales'],$ArrayProduit['image'], $_POST['id']));

        //verifie su ya bien une image telecharge
        if($img){
            $uploadOk = 1;
            $imageFileType = new SplFileInfo($_FILES["image2"]["name"]); 
            
            //verifie le format de l'image
            if($imageFileType->getExtension() != "jpg" ) {
                $uploadOk = 0;
                $data= "Mauvais format de l'image, jpg svp !";
            }

            if($uploadOk == 1){
                $_FILES["image2"]["name"] = "1.jpg";
                $target_dir = "../img/".$categorie."/".$_POST['id']."/";
                $target_file = $target_dir . basename($_FILES["image2"]["name"]);
                //supprime l'ancienne image
                if(unlink($target_dir."1.jpg")){
                    //upload l'image
                    if(move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file)){
                        $data ="ok";
                    } else {
                        $data  = "fail move";
                    }
                } else {
                    $data = "fail upload";
                }
            }
        } else {
            $data = "ok";
        }
    }catch (Exception $e) {
        echo $e;
    }
}

echo $data

?>