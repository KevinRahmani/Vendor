<?php
session_start();

include ('php/connexion_stock.php');
include("php/connexion_user.php");
include ('php/connexion_colis.php');


$LivreurQuery = $db_user->prepare('SELECT * FROM livreur WHERE id =?');
$LivreurQuery->execute(array($_SESSION['user']['id']));
$arrayLivreur = $LivreurQuery->fetchAll();
$_SESSION['user'] = $arrayLivreur[0];


//liste des colis du livreur        a changer
/*$produitVendeur = $db->prepare('SELECT * FROM ' . PDObackquote($_SESSION['user']['categorie']) . ' WHERE vendeur=?');
$produitVendeur->execute(array($_SESSION['user']['nom']));
$arrayproduit = $produitVendeur->fetchAll();
*/


$nb_colis = $db_colis->query("SELECT COUNT(id) FROM colis WHERE date_livraison = CURDATE() AND id_livreur = ".$_SESSION['user']['id']);
         if (!$nb_colis) {
            die('Error: ' . print_r($db_colis->errorInfo(), true));
        }
        $nbcolis = $nb_colis->fetchColumn();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/page_livreur.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if(isset($_SESSION['connecte'])){
            if($_SESSION['connecte'] == 4){
                include('php/livreur_header.php');
    ?>
                <h2 class="title"><?php echo "Bonjour livreur ".strtoupper($_SESSION['user']['nom']) . ", ravis de vous revoir";?></h2>
                <div class="sous_titre">Gérez vos informations, ainsi que la confidentialité et la sécurité de vos données pour profiter au mieux des services Vendor. <a href="about_us.php">En savoir plus</a></div>

                <!-- info livreur -->
                <div class="container_user">
                    <div class="container_title">
                        <div class="second_container">
                            <div class="title2">Mon compte Vendor :</div>
                            <div class="sous_titre2">Consulter les données de votre compte Vendor !</div>
                        </div>
                        <img src="img/user.svg" alt="">
                    </div>
                    <button id="button_user_info">Consulter mes données</button>
                    <div class="notActive" id="toggle_user">
                        <div class="nom ">Nom : <?php echo $_SESSION['user']['nom'];?></div>
                        <div class="mail">Mail : <?php echo $_SESSION['user']['mail']; ?></div>
                        <div class="num_client">ID livreur : <?php echo $_SESSION['user']['id'];?></div>
                        <div class="adresse">Adresse : <?php echo $_SESSION['user']['adresse'];?></div>
                        <div class="categorie">Catégorie : <?php if($_SESSION['connecte'] == 4){echo "Livreur";}?></div>
                        <div class="nbProduct">Type de permis : <?php echo $_SESSION['user']['type_permis'];?></div>
                    </div>
                </div>


                <div class="container ">
                    <div class="title_histo">
                        <div class="container_chevron">
                            <div id ="div_histo">Colis : </div>
                            <i class="fa-solid fa-chevron-down" id="chevron"></i>
                        </div>
                        <div class="sous_titre_histo2"><a href="colis.php">Voir mes colis</a></div>

                        <div class="notActive" id="toggle_histo">
                            <div class="sous_titre_histo">Total de colis à livrer : <?php echo $nbcolis;?></div> 
                        </div>
                    </div>

                    <!-- changer les coordonnées -->
                    <div class="title_coord">
                        <div class="container_chevron">
                            <div class="div_coord">Changer vos coordonnées</div>
                            <i class="fa-solid fa-chevron-down" id="chevron2"></i>
                        </div>
                        <div class="line_coord">Un changement dans vos coordonnées ?</div>
                        <form method="POST" action="php/modif_coord.php" class="notActive" id="form_coord">
                            <div class="coord_1">
                                <label for="nom">Nom :</label><input type="text" value="<?php echo $_SESSION['user']['nom'];?>" placeholder="Nom" name="nom">
                            </div>
                            <div class="coord_1">
                                <label for="mail">Mail : </label><input type="email" value="<?php echo $_SESSION['user']['mail'];?>" placeholder="Mail" name="mail">
                            </div>
                            <div class="coord_1">
                                <label for="password"> Password : </label><input type="password" value="<?php echo $_SESSION['user']['password'];?>" placeholder="Password" name="password">
                            </div>
                            <div class="coord_1">
                                <label for="adresse">Adresse : </label><input type="text" value="<?php echo $_SESSION['user']['adresse'];?>" placeholder="Adresse" name="adresse" >
                            </div>
                            <input type="submit" value="Envoyer" class="submit_coord">
                            <div id="erreur"></div>
                        </form>
                    </div>
                </div>


                <?php

                            include("php/footer.php");
                        } else{
                            echo "<h2> Veuillez quitter la page, vous n'etes pas un vendeur</h2>";
                        }
                    } else{
                        echo "<h2>Veuillez quitter cette page, vous n'etes pas autorisé</h2>";
                        echo $_SESSION['connecte'];
                        
                    }
                ?>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/header.js"></script>
    <script src="js/livreur.js"></script>
</body>
</html><script src=""></script>