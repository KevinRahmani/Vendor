<?php
session_start();

include('php/connexion_stock.php');

function premierMot($chaine, $separateur1 = ' ', $separateur2 = ',', $separateur3 = '-') {
    $mots = preg_split('/[' . $separateur1 . $separateur2 . $separateur3 . ']+/', trim($chaine));
    return $mots[0];
  }
  
  
  
$mode = "categorie_display_left";

//en fonction du nbSales
$Array_Products = array();

$sqlQ1 = $db->prepare("SELECT * FROM `automobile` ORDER BY sales DESC");
$sqlQ1->execute();
$Array1 = $sqlQ1->fetchAll();

$sqlQ2 = $db->prepare("SELECT * FROM `bricolage, jardin et animalerie` ORDER BY `sales` DESC");
$sqlQ2->execute();
$Array2 = $sqlQ2->fetchAll();

$sqlQ3 = $db->prepare("SELECT * FROM `cuisine et maison` ORDER BY `sales` DESC");
$sqlQ3->execute();
$Array3 = $sqlQ3->fetchAll();

$sqlQ4 = $db->prepare("SELECT * FROM `high-tech` ORDER BY `sales` DESC");
$sqlQ4->execute();
$Array4 = $sqlQ4->fetchAll();

$sqlQ5 = $db->prepare("SELECT * FROM `livre` ORDER BY `sales` DESC");
$sqlQ5->execute();
$Array5 = $sqlQ5->fetchAll();

$sqlQ6 = $db->prepare("SELECT * FROM `musique, dvd et blu-ray` ORDER BY `sales` DESC");
$sqlQ6->execute();
$Array6 = $sqlQ6->fetchAll();

$sqlQ7 = $db->prepare("SELECT * FROM `sports et loisirs` ORDER BY `sales` DESC");
$sqlQ7->execute();
$Array7 = $sqlQ7->fetchAll();

$sqlQ8 = $db->prepare("SELECT * FROM `vetements` ORDER BY `sales` DESC");
$sqlQ8->execute();
$Array8 = $sqlQ8->fetchAll();


$Array_One = array(
    "automobile" => $Array1[0],
    "bricolage, jardin et animalerie" => $Array2[0],
    "cuisine et maison" => $Array3[0],
    "high-tech" => $Array4[0],
    "livre" => $Array5[0],
    "musique, dvd et blu-ray" => $Array6[0],
    "sports et loisirs" => $Array7[0],
    "vetements" => $Array8[0],
);

$Array_second = array(
    "automobile" => "Roulez dans nos meilleures routières",
    "bricolage, jardin et animalerie" => "Bricolage et jardin ? Amusez-vous bien !",
    "cuisine et maison" => "Pour des femmes heureuses !",
    "high-tech" => "Pour des Hommes heureux",
    "livre" => "Une envie de voyager ?",
    "musique, dvd et blu-ray" => "Un plaisir pour les yeux et les oreilles !",
    "sports et loisirs" => "Devenez la meilleure version de vous-même !",
    "vetements" => "Des beaux habits pour une belle journée",
);

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
    <link rel="stylesheet" href="css/popular.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>

</head>
<body>
    <?php include "php/header.php";?>
    <section class="container_body">

    <section class="products" id="produit">
        <h1>Nos produits populaires</h1>

        <?php
            foreach ($Array_One as $key_one => $product){
                foreach ($Array_second as $key_second => $citation){
                    if($key_one == $key_second){
        ?>
        <!-- Partie titre -->
                <div class="<?php echo $mode; ?>">
                    <div class="titre_categorie" id="<?php echo premierMot($key_one) ;?>">
                        <div class="titre"> <?php echo $key_one; ?></div>
                        <div class="sous_titre"><?php echo $citation; ?></div>
                    </div>

        <!-- Partie Image -->

                    <div class="box_truc">
                        <div class="image">
                            <a href="produit.php?categorie=<?php echo $key_one.'&amp;id='.$product['id'];?>">
                                <img src="<?php echo $product['image']; ?>1.jpg" alt="<?php echo $product['nom'] ?>">
                            </a>
                            <div class="icons" id="<?php echo $product['id']; ?>" value = "<?php echo $key_one;?>">
                                <button class="fa-solid fa-minus button_rose" id="minus"></button>
                                <button class="cart-btn envoyer" id="submit"><span>Ajouter au panier</span></button>
                                <button class="fa-solid fa-plus button_rose" id="plus"></button>
                                <input type="text" readonly="readonly" class="number_product" id="<?php echo $product['id']; ?>" value="0"></input>
                            </div>
                            <div class="content">
                                <h3><?php echo $product['marque']." ".$product['nom']; ?></h3>
                                <div class="price">
                                    <?php
                                        echo $product['prix']." €";
                                        echo '  | Stock : ' . $product['stock'];
                                                    
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        <?php
                        if($mode == "categorie_display_left"){
                            $mode = "categorie_display_right";
                        } else {
                            $mode = "categorie_display_left";
                        }
                        break;
                    } 
                }
            }
        ?>            
    </section>
    <?php
        include('php/footer.php');
    ?>
    
                            
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>                        
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/popular.js"></script>
    <script src="js/header.js"></script>
    


</body>
</html>


