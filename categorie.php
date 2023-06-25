<?php
session_start();
$_SESSION['categorie'] = $_GET['categorie'];

include('php/connexion_stock.php');


//categorie
$sqlQuery = 'SELECT * FROM '. PDObackquote($_GET['categorie']);
$Category = $db->prepare($sqlQuery);
$Category->execute();
$Array_Category = $Category->fetchAll();


//type pour select

$typeQuery = 'SELECT DISTINCT type FROM '. PDObackquote($_GET['categorie']);  
$type = $db->prepare($typeQuery);
$type->execute();
$Array_type = $type->fetchAll();

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
    <link rel="stylesheet" href="css/categorie.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php 
        include "php/header.php";
         
    ?>
        <section class="container-body">
            <div class="fond_accueil">
                <img src="img/<?php echo $_GET['categorie']."/".$_GET['categorie'].".jpg";?>" alt="">
                <div class="container">
                    <div class="titre_section">
                        <?php
                            echo $_GET['categorie'];
                        ?>
                    </div>
                    <div class="citation">You want it, Vendor will make it</div>
                    <div class="lien_ancre">
                        <a href="#produit">Commander maintenant !</a>
                    </div>
                </div>
            </div>
        </section>

        <section class="products" id="produit">
            <div class="titre-container">
                <h1 class="titre_produit">NOS DERNIERS PRODUITS :</h1>
                <select name="" id="filter_product">
                    <option value="">Selectionner une option</option>
                    <option value="croissant">Prix croissant</option>
                    <option value="decroissant">Prix décroissant</option>
                    <option value="marque">Marque</option>
                    <?php
                        foreach($Array_type as $product_type){
                    ?>
                        <option value="<?php echo $product_type[0];?>"><?php echo $product_type[0];?></option>
                    <?php
                        }
                    ?>
                </select>
            </div>
            <div class="box-container">
                <?php 
                    foreach ($Array_Category as $product_category){
                        if((int) $product_category['stock'] > 0){
                ?>
                            <div class="box">
                                <div class="image">
                                    <a href="produit.php?categorie=<?php echo $_GET['categorie'].'&amp;id='.$product_category['id'];?>">
                                        <img src="<?php echo $product_category['image']; ?>1.jpg" alt="<?php echo $product_category['nom'] ?>">
                                    </a>
                                    <div class="icons" id="<?php echo $product_category['id']; ?>">
                                        <button class="fa-solid fa-minus button_rose" id="minus"></button>
                                        <button class="cart-btn envoyer" id="submit"><span>Ajouter au panier</span></button>
                                        <button class="fa-solid fa-plus button_rose" id="plus"></button>
                                        <input type="text" readonly="readonly" class="number_product" id="<?php echo $product_category['id']; ?>" value="0"></input>
                                    </div>
                                    <div class="content">
                                        <h3><?php echo $product_category['marque']." ".$product_category['nom']; ?></h3>
                                        <div class="price">
                                            <?php
                                                echo $product_category['prix']." €";
                                                echo '  | Stock : ' . $product_category['stock'];
                                                            
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                <?php
                        }
                    }
                ?>
            </div>
        </section>
        <?php include "php/footer.php"; ?>
    
                            
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>                        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/categorie.js"></script>
    <script src="js/header.js"></script>
</body>
</html>