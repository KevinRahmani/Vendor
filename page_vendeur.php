<?php
session_start();

include ('php/connexion_stock.php');
include("php/connexion_user.php");

$VendeurQuery = $db_user->prepare('SELECT * FROM vendeur WHERE id =?');
$VendeurQuery->execute(array($_SESSION['user']['id']));
$arrayVendeur = $VendeurQuery->fetchAll();
$_SESSION['user'] = $arrayVendeur[0];


//liste des produits du vendeur
$produitVendeur = $db->prepare('SELECT * FROM ' . PDObackquote($_SESSION['user']['categorie']) . ' WHERE vendeur=?');
$produitVendeur->execute(array($_SESSION['user']['nom']));
$arrayproduit = $produitVendeur->fetchAll();



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
    <link rel="stylesheet" href="css/page_vendeur.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if(isset($_SESSION['connecte'])){
            if($_SESSION['connecte'] == 2){
                include('php/header.php');
    ?>
                <h2 class="title"><?php echo "Bonjour vendeur ".strtoupper($_SESSION['user']['nom']) . ", ravis de vous revoir";?></h2>
                <div class="sous_titre">Gérez vos informations, ainsi que la confidentialité et la sécurité de vos données pour profiter au mieux des services Vendor. <a href="about_us.php">En savoir plus</a></div>

                <!-- info vendeur -->
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
                        <div class="num_client">ID vendeur : <?php echo $_SESSION['user']['id'];?></div>
                        <div class="dateSignUp">Date de création du compte : <?php echo $_SESSION['user']['datesignup'];?></div>
                        <?php if($_SESSION['user']['contrat'] == 1){echo "<div class='endcontrat'> Date de fin de contrat : ".$_SESSION['user']['endcontrat']."</div>";}?>
                        <div class="adresse">Adresse : <?php echo $_SESSION['user']['adresse'];?></div>
                        <div class="categorie">Catégorie : <?php if($_SESSION['connecte'] == 2){echo "Vendeur";}?></div>
                        <div class="nbProduct">Catégorie concerné : <?php echo $_SESSION['user']['categorie'];?></div>
                    </div>
                </div>

                <!-- container liste des produits vendus et acheté  -->
                <div class="container ">
                    <div class="title_histo">
                        <div class="container_chevron">
                            <div id ="div_histo">Chiffres de ventes : </div>
                            <i class="fa-solid fa-chevron-down" id="chevron"></i>
                        </div>
                        <div class="sous_titre_histo">Voir mon historique de ventes</div>

                        <!-- avoir dans un tableau l'ensemble des produits du vendeur, les afficher et afficher la quantité vendue pour chaque produit, ensuite multiplier par le prix unitaire  -->

                        <div class="notActive" id="toggle_histo">
                            <?php 
                            if($_SESSION['user']['contrat'] == 1){
                                foreach($arrayproduit as $produit_min){
                                    echo "Nom : " . $produit_min['nom'] . "<br/>Quantité vendue : " . $produit_min['sales'] ."<br/>" . "CA produit : " . intval($produit_min['sales']) * intval($produit_min['prix']) . " €<br/><br/>";
                                }
                                echo "TOTAL CA : " . $_SESSION['user']['nbtotalsales'] . " € Hors commission, " . (intval($_SESSION['user']['nbtotalsales'])) . " € TTC";
                            } else{
                                echo "Signer d'abord le contrat Vendor";
                            }
                            ?>
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

                <!-- contrat Vendor -->
                <div class="contrat_info">
                    <div class="container_chevron">
                        <div class="title_contrat">Contrat Vendor</div>
                        <i class="fa-solid fa-chevron-down" id="chevron3"></i>
                    </div>
                    <div class="contrat_text">En souscrivant à notre contrat Vendor, vous accéder à notre MarketPlace. Ainsi, vous pouvez modifier, ajouter & supprimer un produit, gérer le stock de ces derniers. Vendor prend une comission de 5% sur ses produits externes  .</div>
                    <div id="container_contrat_button" class="notActive">
                        <div id="sign">
                            <?php 
                                if($_SESSION['user']['contrat'] == 0 && $_SESSION['connecte'] == 2){
                                    echo "Signer le contrat avec Vendor (attention cette action est irréversible) : </div> <button class='contrat_Vendor' id='contrat_Vendor'>Signer</button>" ;
                                }
                                else if($_SESSION['user']['contrat'] == 1 && $_SESSION['connecte'] == 2){
                                    echo "Vous possédez déjà un contrat avec Vendor, resigner pour 5 an ?</div><button class='contrat_Vendor' id='contrat_Vendor'>Re-sign</button>";

                                }
                            ?>
                    </div>
                    <div class="resil">
                        <div class="container_resil">
                            <?php 
                            if($_SESSION['user']['contrat'] == 1){
                                echo "Résilier le contrat avec Vendor (attention cette action est irréversible et supprimera le compte) : </div><button class='contrat_Vendor' id='resil'>Résilier</button>"; 
                            } else{
                                echo "</div>";
                            }
                            ?>
                    </div>
                </div>


                <!-- partie ajouter modifier supprimer un produit -->
                <div class="container_modif">
                    <div class="title_x">Gestion des produits</div>
                    <div class="flex_container_modif">
                        <ul id="list-first">
                            <li class="deroulant">
                                <div class="title_y" id="add">Ajouter un produit</div>
                                <div class="sous_titre_y">Remplisser les champs pour ajouter un produit</div>
                                <ul class="sous notActive" id="sous_add">
                                    <li>
                                        <form method="POST" action="php/addProduct.php" id="add_produit" enctype="multipart/form-data">
                                            <input type="text" name="nom" placeholder="Nom">
                                            <input type="text" name="marque" placeholder="Marque">
                                            <input type="text" name="prix" placeholder="Prix">
                                            <input type="text" name="stock" placeholder="Stock">                                        
                                            <input type="text" name="type" placeholder="Type">
                                            <input type="text" name="couleur" placeholder="Couleur">
                                            <textarea name="description" placeholder="Description"></textarea>
                                            <input name="image" type="file" >
                                            <input type="submit" value="Valider" class="btn_submit_add">
                                        </form>
                                        <div class="erreur_add"></div>
                                    </li>
                                </ul>
                            </li>
                            <li class="deroulant">
                                <div class="title_y" id="modif">Modifier un produit</div>
                                <div class="sous_titre_y">Selectionner un produit à modifier</div>
                                <ul class="sous notActive" id="sous_modif">
                                    <li>
                                        <?php
                                            if(!empty($arrayproduit)){
                                        ?>
                                            <select name="list_produit_modif" id="list_produit_modif">
                                                <?php
                                                    echo "<option value=''>Choisissez une option</option>";
                                                    foreach($arrayproduit as $tab_min){
                                                        echo "<option value=". $tab_min['id'] .">". $tab_min['nom'] ."</option>";
                                                    }
                                                ?>
                                            </select>
                                            <form method="POST" action="php/modif_produit.php" id="modif_produit"  enctype="multipart/form-data">
                                                <input type="text" name="nom" placeholder="Nom" id="modif_nom">
                                                <input type="text" name="prix" placeholder="prix" id="modif_prix">
                                                <input type="text" name="stock" placeholder="Stock" id="modif_stock">
                                                <input type="text" name="type" placeholder="Type" id="modif_type">
                                                <input type="text" name="couleur" placeholder="Couleur" id="modif_couleur">
                                                <textarea name="description" placeholder="Description" id="modif_description"></textarea>
                                                <input type="file" name="image2">
                                                <input type="submit" value="Valider" class="btn_submit_add">
                                            </form>
                                            <div class="erreur_modif"></div>
                                        <?php
                                            } else {
                                                echo "<div class='erreur_modif'>Pas de produit à modifier</div>";
                                            }
                                        ?>
                                    </li>
                                </ul>
                            </li>
                            <li class="deroulant">
                                <div class="delete_product">
                                    <div class="title_y" id="supp">Supprimer un produit</div>
                                    <div class="sous_titre_y">Selectionner un produit à supprimer dans la liste déroulant : </div>
                                    <ul class="sous notActive" id="sous_supp">
                                        <li>
                                            <?php
                                            if(!empty($arrayproduit[0])){
                                            ?>
                                                <form method="POST" action="php/supp_produit.php" id="supp_produit">
                                                    <select name="list_produit_supp" id="list_produit_supp">
                                                        <?php
                                                            echo "<option value=''>Choisissez une option</option>";
                                                            foreach($arrayproduit as $tab_min){
                                                                echo "<option value=". $tab_min['id'] .">". $tab_min['nom'] ."</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                    <input type="submit" value="Valider" class="btn_submit_add">
                                                </form>
                                            <?php
                                            } else{
                                                echo "<div class='erreur_modif'></div>";
                                            }
                                            ?>
                                            <div class="erreur_supp" id="erreur_supp"></div>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
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
    <script src="js/vendeur.js"></script>
</body>
</html>