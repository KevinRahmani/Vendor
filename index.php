<?php
session_start();
include('php/connexion_stock.php');

//High-Tech Smartphone
$sqlQuery = 'SELECT * FROM `high-tech` WHERE type = "Téléphones"';
$High_Tech = $db->prepare($sqlQuery);
$High_Tech->execute();
$Array_High_Tech = $High_Tech->fetchAll();

//High-Tech Montres connectées 
$MontreQuery = 'SELECT * FROM `high-tech` WHERE type = "Montres connectées"';
$High_Tech_Montre = $db->prepare($MontreQuery);
$High_Tech_Montre->execute();
$Array_High_Tech_Montre = $High_Tech_Montre->fetchAll();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/intro.css">
    <link rel="stylesheet" href="css/swiper-bundle.min.css" />
    <link rel="stylesheet" href="css/index.css">
    <link rel="stylesheet" href="css/footer.css">
    
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    
    
    <title>Vendor</title>
</head>
<body>
    <?php include "php/intro.php";?>
    <?php include "php/header.php"; ?>

    <section class="container_body">
        <div class="presentation">
            <img src="img/presentation.jpg" alt="presentation">
            <div class="note">Design your life, Vendor will make it</div>
        </div>
        <div class="box-container">
            <div class="title">Nos produits du moment    : <span class="gras">Smartphone</span></div>  
            <!-- High-tech Smartphone carousel-->
            <div class="carousel_container swiper">
                <div class="slide-container">       
                    <div class="card-wrapper swiper-wrapper">
                        <?php 
                            foreach ($Array_High_Tech as $product_High_Tech){
                        ?>
                                <div class="card swiper-slide">
                                    <a href="produit.php?categorie=high-tech&amp;id=<?php echo $product_High_Tech['id'];?>">
                                        <div class="img-box">
                                            <img src="<?php echo $product_High_Tech['image'];?>1.jpg" alt="">
                                        </div>
                                    </a>
                                    <div class="product-details">
                                        <img src="img/logo/<?php echo $product_High_Tech['marque'];?>.jpg" alt="">
                                        <div class="name-category">
                                            <h3 class="name"><?php echo $product_High_Tech['nom'];?>-<span class="gras"><?php echo $product_High_Tech['prix'];?> euros</span></h3>
                                            <h4 class="constructeur"><?php echo $product_High_Tech['marque'];?></h4>
                                        </div>
                                    </div>
                                </div>
                        <?php 
                            }
                        ?>
                    </div>
                </div>
                <div class="swiper-button-next swiper-navBtn"></div>
                <div class="swiper-button-prev swiper-navBtn"></div>
                <div class="swiper-pagination"></div>
            </div>
            <div class="vendor-name">-Vendor-</div>
        </div>
        <!-- High-tech Montres carousel-->
        <section id="tranding">
            <div class="second-slide text-Montre">
                <h3 class="text-center section-subheading">Nouveautés</h3>
                <h1 class="text-cent section-heading">Montres connectées</h1>
            </div>
            <div class="second-slide">
                <div class="swiper tranding-slider">
                    <div class="swiper-wrapper">
                        <!-- Slide start -->
                        <?php
                            foreach ($Array_High_Tech_Montre as $product_High_Tech_Montre){
                        ?>
                                <div class="swiper-slide tranding-slide">
                                    <div class="tranding-slide-img">
                                        <img src="<?php echo $product_High_Tech_Montre['image'];?>1.jpg" alt="">
                                    </div>
                                    <a href="produit.php?categorie=high-tech&amp;id=<?php echo $product_High_Tech_Montre['id'];?>">
                                        <div class="tranding-slide-content">
                                            <h1 class="montre-prix"><?php echo $product_High_Tech_Montre['prix'];?> euros</h1>
                                            <div class="tranding-slide-content-bottom">
                                                <h2 class="montre-name"><?php echo $product_High_Tech_Montre['nom'];?></h2>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                        <!-- Slide end  -->
                        <?php
                            }
                        ?>
                    </div>
                    <div class="tranding-slider-control">
                        <div class="swiper-button-prev slider-arrow">
                            <ion-icon name="arrow-back-outline"></ion-icon>
                        </div>
                        <div class="swiper-button-next slider-arrow">
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </div>
                        <div class="swiper-pagination"></div>
                    </div>
                </div>
            </div>
        </section>
        <section class="cartes_cadeau">
            <div class="titre_carte">
                <div class="sous-titre"><span>Vendor</span> cartes cadeaux</div>
                <div class="sous-titre-deux">Dites Merci avec une carte cadeau</div>
                <div class="sous-titre-deux">De 10 à 1000 euros pour vous et vos proches !</div>
            </div>
            <div class="img_carte">
                <img src="img/cartes_cadeau.png" alt="">
            </div>
        </section> 
        <section class="categorie_moment">
            <div class="categorie-titre">Nos catégories du moment</div>
            <div class="carre-categorie">
                <div class="carre-child">
                    <a href="categorie.php?categorie=bricolage, jardin et animalerie">
                        <img src="img/bricolage, jardin et animalerie/bricolage, jardin et animalerie.jpg" alt="">
                        <div class="carre-info">Bricolage, Jardin et Maison</div>
                    </a>
                </div>
                <div class="carre-child">
                    <a href="categorie.php?categorie=livre">
                        <img src="img/Livre/livres.jpg" alt="">
                        <div class="carre-info">Livres</div>
                    </a>
                </div>
                <div class="carre-child">
                    <a href="categorie.php?categorie=high-tech">
                        <img src="img/High-tech/high-tech.jpeg" alt="">
                        <div class="carre-info">High-Tech</div>
                    </a>
                </div>
                <div class="carre-child">
                    <a href="categorie.php?categorie=sports et loisirs">
                        <img src="img/sports et loisirs/sports et loisirs.jpg" alt="">
                        <div class="carre-info">Sports et Loisirs</div>
                    </a>
                </div>
                <div class="carre-child">
                    <a href="categorie.php?categorie=vetements">
                        <img src="img/vetements/vetement.jpg" alt="">
                        <div class="carre-info">Vêtements</div>
                    </a>
                </div>
            </div>
        </section>                   

    </section>
    
    <?php include "php/footer.php"; ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>           
    <script src="js/swiper-bundle.min.js"></script>
    <script src="js/index.js"></script>                  
    <script src="js/intro.js"></script>
    <script src="js/header.js"></script>
</body>
</html>