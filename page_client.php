<?php
session_start();
include("php/connexion_user.php");

$clientQuery = $db_user->prepare('SELECT * FROM client WHERE id =?');
$clientQuery->execute(array($_SESSION['user']['id']));
$arrayUser = $clientQuery->fetchAll();
$_SESSION['user'] = $arrayUser[0];
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
    <link rel="stylesheet" href="css/page_client.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php
        if(isset($_SESSION['connecte'])){
            if($_SESSION['connecte'] == 1){
                include('php/header.php');
    ?>
                <h2 class="title"><?php echo "Bonjour ".strtoupper($_SESSION['user']['nom']) . ", ravis de vous revoir";?></h2>
                <div class="sous_titre">Gérez vos informations, ainsi que la confidentialité et la sécurité de vos données pour profiter au mieux des services Vendor. <a href="about_us.php">En savoir plus</a></div>

                <!-- info client -->
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
                        <div class="num_client">ID client : <?php echo $_SESSION['user']['id'];?></div>
                        <div class="dateSignUp">Date de création du compte : <?php echo $_SESSION['user']['datesignup'];?></div>
                        <div class="contrat">Adhérent Premium : <?php if($_SESSION['user']['contrat'] == 0){ echo "Non";} else{ echo "Oui";} ?></div>
                        <?php if($_SESSION['user']['contrat'] == 1){echo "<div class='endcontrat'> Date de fin de contrat : ".$_SESSION['user']['endcontrat']."</div>";}?>
                        <div class="adresse">Adresse : <?php echo $_SESSION['user']['adresse'];?></div>
                        <div class="categorie">Catégorie : <?php if($_SESSION['connecte'] == 1){echo "Client";}?></div>
                        <div class="nbProduct">Nombre de produit acheté sur Vendor : <?php echo $_SESSION['user']['nbproduct'];?></div>
                    </div>
                </div>
                <div class="container ">
                    <div class="title_histo">
                        <div class="container_chevron">
                            <div id ="div_histo">Historique de commande : </div>
                            <i class="fa-solid fa-chevron-down" id="chevron"></i>
                        </div>
                        <div class="sous_titre_histo">Voir mon historique de commande</div>
                        <div class="notActive" id="toggle_histo"><?php echo $_SESSION['user']['histocommand'];?></div>
                    </div>
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

                <!-- contrat Vendor -->
                <div class="contrat_info">
                    <div class="container_chevron">
                        <div class="title_contrat">Abonnement premium</div>
                        <i class="fa-solid fa-chevron-down" id="chevron3"></i>
                    </div>
                    <div class="contrat_text">En souscrivant à l'abonnement premium Vendor, vous bénéficierez de nombreux avantages, comme par exemple des réductions sur vos achats, des frais de livraisons offerts et une livraison express à partir de seulement 9,99 euros par an.</div>
                    <div id="container_contrat_button" class="notActive">
                        <div id="sign">
                            <?php 
                                if($_SESSION['user']['contrat'] == 0 && $_SESSION['connecte'] == 1){
                                    echo "Signer le contrat avec Vendor (attention cette action est irréversible) : </div><button class='contrat_Vendor' id='contrat_Vendor'>Signer</button>" ;
                                }
                                else if($_SESSION['user']['contrat'] == 1 && $_SESSION['connecte'] == 1){
                                    echo "Vous possédez déjà un contrat avec Vendor, resigner pour 1 an ? (9,99 €)</div><button class='contrat_Vendor' id='contrat_Vendor'>Re-sign</button>";
                                }
                            ?>
                    </div>
                </div>

    <?php

                include("php/footer.php");
            } else{
                echo "<h2> Veuillez quitter la page, vous n'etes pas un client</h2>";
            }
        } else{
            echo "<h2>Veuillez quitter cette page, vous n'etes pas autorisé</h2>";
        }
    ?>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="js/header.js"></script>
    <script src="js/page_client.js"></script>
</body>
</html>