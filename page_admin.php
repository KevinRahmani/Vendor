<?php
session_start();

include ('php/connexion_stock.php');
include("php/connexion_user.php");

//recuperation des infos de l'admin
$adminQuery = $db_user->prepare('SELECT * FROM admin WHERE id =?');
$adminQuery->execute(array($_SESSION['user']['id']));
$arrayadmin = $adminQuery->fetchAll();
$_SESSION['user'] = $arrayadmin[0];


//liste des produits du vendeur
$sqlQuery = 'SELECT * FROM automobile WHERE vendeur="Vendor"
UNION SELECT * FROM `bricolage, jardin et animalerie` WHERE vendeur="Vendor"
UNION SELECT * FROM `cuisine et maison` WHERE vendeur="Vendor"
UNION SELECT * FROM `high-tech` WHERE vendeur="Vendor"
UNION SELECT * FROM `livre` WHERE vendeur="Vendor"
UNION SELECT * FROM `musique, dvd et blu-ray` WHERE vendeur="Vendor"
UNION SELECT * FROM `sports et loisirs` WHERE vendeur="Vendor"
UNION SELECT * FROM `vetements` WHERE vendeur="Vendor"';
$sql = $db->prepare($sqlQuery);
$sql->execute();
$arrayproduit = $sql->fetchAll();



//nom de toutes les tables  de la bdd
$sqlTable ="SELECT TABLE_NAME 
FROM information_schema.tables 
WHERE TABLE_TYPE='BASE TABLE' 
AND TABLE_SCHEMA='stock_vendor'";
$sqlX = $db->prepare($sqlTable);
$sqlX->execute();
$Array_Categorie = $sqlX->fetchAll();

//tableau de tout les vendeurs
$slqVendeur = $db_user->prepare("SELECT * FROM vendeur");
$slqVendeur->execute();
$Array_Vendeur = $slqVendeur->fetchAll(PDO::FETCH_ASSOC);


//liste des sociétés de livreur
$sqlSociete = $db_user->prepare("SELECT DISTINCT societe FROM livreur");
$sqlSociete->execute();
$Array_societe = $sqlSociete->fetchAll();


//liste des livreurs
$sqlLivreur = $db_user->prepare("SELECT * FROM livreur");
$sqlLivreur->execute();
$Array_livreur = $sqlLivreur->fetchAll();

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
    <link rel="stylesheet" href="css/page_admin.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        if(isset($_SESSION['connecte'])){
            if($_SESSION['connecte'] == 3){
                include('php/header.php');
    ?>
                <h2 class="title"><?php echo "Bonjour Administrateur ".strtoupper($_SESSION['user']['nom']) . ", ravis de vous revoir";?></h2>
                <div class="sous_titre">Gérez vos informations, ainsi que la confidentialité et la sécurité de vos données pour profiter au mieux des services Vendor. <a href="about_us.php">En savoir plus</a></div>

                <!-- info admin -->
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
                        <div class="num_client">ID admin : <?php echo $_SESSION['user']['id'];?></div>
                        <div class="categorie">Catégorie : <?php echo "Administrateur";?></div>
                        <div class="mail_all">
                            <div class="title_mail">Envoyer un mail promotionnel à tous les clients :</div>
                            <button id="mail_client">Envoyer</button>
                        </div>
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
                            
                                foreach($arrayproduit as $produit_min){
                                    echo "Nom : " . $produit_min['nom'] . "<br/>Quantité vendue : " . $produit_min['sales'] ."<br/>" . "CA produit : " . intval($produit_min['sales']) * intval($produit_min['prix']) . " €<br/><br/>";
                                }
                                echo "TOTAL CA : " . $_SESSION['user']['nbtotalsales'] . " €";
                                echo " <br>dont ventes externes : " .$_SESSION['user']['externe']. " €";
                            
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
                                <label for="adresse"> Adresse : </label><input type="text" value="<?php echo $_SESSION['user']['adresse'];?>" placeholder="Adresse" name="adresse">
                            </div>
                            <input type="submit" value="Envoyer" class="submit_coord">
                            <div id="erreur"></div>
                        </form>
                    </div>
                </div>

                <!-- ajouter/supprimer vendeur Vendor -->

                <div class="container ">
                    <div class="title_add">
                        <div class="container_chevron">
                            <div class ="div_coord">Ajouter un vendeur</div>
                            <i class="fa-solid fa-chevron-down" id="chevron3"></i>
                        </div>
                        <!-- ajouter un vendeur -->
                        <div class="sous_titre_histo">Un nouvel arrivé dans le marketplace ?</div>
                        <div class="notActive" id="toggle_add">
                            <form method="POST" action="php/addVendeur.php" id="form_add_Vendeur">
                                <select name="categorie" class="select_class">
                                    <?php
                                        echo "<option value=''>Choisissez une catégorie</option>";
                                        foreach ($Array_Categorie as $categorie) {
                                            echo "<option value='".$categorie[0]."'>".$categorie[0]."</option>";
                                        }
                                    ?>
                                </select>
                                <div class="coord1">
                                    <label for="nom">Nom :</label><input type="text" placeholder="nom" name="nom">
                                </div>
                                <div class="coord1">
                                    <label for="password">Password :</label><input type="password" placeholder="password" name="password">
                                </div>
                                <div class="coord1">
                                    <label for="mail">Mail :</label><input type="text" placeholder="mail" name="mail">
                                </div>
                                <div class="coord1">
                                    <label for="adresse">Adresse :</label><input type="text" placeholder="adresse" name="adresse">
                                </div>  
                                <input type="submit" value="Envoyer" class="submit_coord" style="margin-right: 40%">                              
                            </form>
                            <div class="erreur_add_Vendeur"></div>
                        </div>
                    </div>

                    <!-- supprimer un vendeur -->
                    <div class="title_remove">
                        <div class="container_chevron">
                            <div class="div_coord">Supprimer un vendeur</div>
                            <i class="fa-solid fa-chevron-down" id="chevron4"></i>
                        </div>
                        <div class="line_coord">Un changement dans votre équipe ?</div>
                        <form method="POST" action="php/delete_vendeur.php" class="notActive" id="form_delete_vendeur">
                            <select name="categorie" class="select_class" id="select_supp_vendeur">
                                <?php
                                    echo "<option value=''>Choisissez une option</option>";
                                    foreach ($Array_Vendeur as $vendeur) {
                                        echo "<option id='".$vendeur['categorie']."' value='".$vendeur['nom']."'>".$vendeur['nom']."</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" value="Envoyer" class="submit_coord">
                        </form>
                        <div class="erreur_add_Vendeur" id="erreur_delete"></div>
                    </div>
                </div>

                <!-- Partie ajouter un livreur -->

                <div class="container ">
                    <div class="title_add_livreur">
                        <div class="container_chevron">
                            <div class ="div_coord">Ajouter un livreur</div>
                            <i class="fa-solid fa-chevron-down" id="chevron5"></i>
                        </div>
                        <!-- ajouter un livreur -->
                        <div class="sous_titre_histo">Un nouveau livreur dans le marketplace ?</div>
                        <div class="notActive" id="toggle_add_livreur">
                            <form method="POST" action="php/addLivreur.php" id="form_add_livreur">
                                <select name="categorie" class="select_class">
                                    <?php
                                        echo "<option value=''>Choisissez une société</option>";
                                        foreach ($Array_societe as $societe) {
                                            echo "<option value='".$societe[0]."'>".$societe[0]."</option>";
                                        }
                                    ?>
                                </select>
                                <div class="coord1">
                                    <label for="nom">Nom :</label><input type="text" placeholder="nom" name="nom">
                                </div>
                                <div class="coord1">
                                    <label for="password">Password :</label><input type="password" placeholder="password" name="password">
                                </div>
                                <div class="coord1">
                                    <label for="permis">Permis :</label><input type="text" placeholder="Type de permis" name="permis">
                                </div>
                                <div class="coord1">
                                    <label for="adresse">Adresse :</label><input type="text" placeholder="adresse" name="adresse">
                                </div>  
                                <div class="coord1">
                                    <label for="mail">Mail :</label><input type="text" placeholder="mail" name="mail">
                                </div>
                                <input type="submit" value="Envoyer" class="submit_coord" style="margin-right: 40%">                              
                            </form>
                            <div class="erreur_add_livreur"></div>
                        </div>
                    </div>

                    <!-- supprimer un livreur -->
                    <div class="title_remove_livreur">
                        <div class="container_chevron">
                            <div class="div_coord">Supprimer un livreur</div>
                            <i class="fa-solid fa-chevron-down" id="chevron6"></i>
                        </div>
                        <div class="line_coord">Un livreur de moins dans votre équipe ?</div>
                        <form method="POST" action="php/delete_livreur.php" class="notActive" id="form_delete_livreur">
                            <select name="categorie" class="select_class" id="select_supp_livreur">
                                <?php
                                    echo "<option value=''>Choisissez une option</option>";
                                    foreach ($Array_livreur as $livreur) {
                                        echo "<option id='".$livreur['id']."' value='".$livreur['nom']."'>".$livreur['nom']."</option>";
                                    }
                                ?>
                            </select>
                            <input type="submit" value="Envoyer" class="submit_coord">
                        </form>
                        <div class="erreur_add_livreur" id="erreur_delete_livreur"></div>
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
                                            <select name="categorie" id="categorie" class="select_class">
                                                <?php
                                                    echo "<option value=''>Choisissez une option</option>";
                                                    foreach ($Array_Categorie as $categorie) {
                                                        echo "<option value='".$categorie[0]."'>".$categorie[0]."</option>";
                                                    }
                                                ?>
                                            </select>
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
                                        <form method="POST" action="php/modif_produit.php" id="modif_produit"  enctype="multipart/form-data">
                                            <select name="categorie_modif" id="modif_categorie" class="select_class">
                                            <?php
                                                echo "<option value=''>Choisissez une catégorie</option>";
                                                foreach ($Array_Categorie as $categorie) {
                                                    echo "<option value='".$categorie[0]."'>".$categorie[0]."</option>";
                                                }
                                            ?>
                                            </select>
                                            <select name="list_produit_modif" id="list_produit_modif" class="select_class">
                                                
                                            </select>
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
                                    </li>
                                </ul>
                            </li>
                            <li class="deroulant">
                                <div class="delete_product">
                                    <div class="title_y" id="supp">Supprimer un produit</div>
                                    <div class="sous_titre_y">Selectionner un produit à supprimer dans la liste déroulant : </div>
                                    <ul class="sous notActive" id="sous_supp">
                                        <li>
                                            <select name="categorie_supp" id="supp_categorie" class="select_class">
                                            <?php
                                                echo "<option value=''>Choisissez une catégorie</option>";
                                                foreach ($Array_Categorie as $categorie) {
                                                    echo "<option value='".$categorie[0]."'>".$categorie[0]."</option>";
                                                }
                                            ?>
                                            </select>
                                            <form method="POST" action="php/supp_produit.php" id="supp_produit">
                                                <select name="list_produit_supp" id="list_produit_supp" class="select_class">
                                                    
                                                </select>
                                                <input type="submit" value="Valider" class="btn_submit_add">
                                            </form>
                                            <div id="erreur_supp" class="erreur_supp"></div>
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
    <script src="js/admin.js"></script>
</body>
</html>