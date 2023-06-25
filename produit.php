<?php
session_start();

include('php/connexion_stock.php');

//data for the product 
if(isset($_GET['categorie']) && isset($_GET['id'])){
    $sqlQuery = 'SELECT * FROM '.PDObackquote($_GET['categorie']). ' WHERE id=?';
    $productQuery = $db->prepare($sqlQuery);
    $productQuery->execute(array($_GET['id']));
    $product_Array = $productQuery->fetchAll();
    $product = $product_Array[0];

    $_SESSION['categorie'] = $_GET['categorie'];
    $_SESSION['id'] = $_GET['id'];
}

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
    <link rel="stylesheet" href="css/produit.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>
<body>
    <?php
        include('php/header.php');
    ?>
        <section class="resume_produit">

        <div class="image-wrap">


            <div class="contour">
                <div class="image" style="background-image:url('<?php echo $product['image'].'1.jpg' ?>')">
                </div>
            </div>

            <div class="description">

                <div class="name"><?php echo $product['marque']." ".$product['nom'] . ' :'; ?></div>
                <hr>

                <div class="tout_prix">
                    <div id="montant"><?php echo $product['prix'] ?> €</div>
                    <div id="taxe">
                        <pre> TTC</pre>
                    </div>
                </div><br>

                <div class="icons" id="<?php echo $product['id']; ?>">
                    <button class="cart-btn envoyer" id="submit"><span>Ajouter au panier<i style="padding-left:6px;" class="fa-solid fa-basket-shopping"></i></span></button>
                    <button class="fa-solid fa-minus button_rose" id="minus"></button>
                    <button class="fa-solid fa-plus button_rose" id="plus"></button>
                    <input type="text" readonly="readonly" class="number_product" id="<?php echo $product['id']; ?>" value="0"></input>
                </div>
                <hr>

                <div class="longue">
                    <p class="titre_info"><b>Description</b></p>
                </div>
                <div class="description_txt">
                    <?php echo $product['description'] ?>
                </div>
                <hr>

                <div class="longue">
                    <p class="titre_info"><b>Caractéristique</b></p>
                </div>
                <div class="type">
                    <ul>
                        <li><span>Couleur :</span>  <?php echo $product['couleur'];?></li>
                        <li><span>Type :</span>  <?php echo $product['type'];?></li>
                        <li><span>Stock :</span>  <?php echo $product['stock'];?></li>
                        <li><span>Vendeur :</span> <?php echo $product['vendeur'];?></li>
                    </ul>
                </div>
                <hr>
                <div class="ref_produit">
                    <p>Référence du produit : <?php echo $product['id'] ?></p>
                </div>

            </div>
        </div>
    </section>
    <?php
        include('php/footer.php');
    ?>


    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>                        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/header.js"></script>
    <script src="js/produit.js"></script>
    
</body>
</html>