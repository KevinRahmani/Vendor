<?php
session_start();

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
    <link rel="stylesheet" href="css/panier.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
    
</head>
<body>
    <?php include('php/header.php'); ?>

    <div class="resume_panier">
        <?php
        if (!empty($_SESSION['panier'])) {
        ?>
            <h2>Votre panier :</h2>
            <table>
                <tr>
                    <th>Image</th>
                    <th>Vendeur</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Référence</th>
                    <th>Prix unitaire TTC</th>
                </tr>
                <?php
                foreach ($_SESSION['panier'] as $tab_min) {
                    echo '<tr>';
                    echo '<td><img src="' . $tab_min['image']."1.jpg" . '"class="img_product"></img></td>';
                    echo '<td>'. $tab_min['vendeur'].'</td>';
                    echo '<td>' . $tab_min['marque']." " .$tab_min['nom'] . '</td>';
                    echo
                    '<td>
                        <div class="change_quantity">
                            <button class="button-minus" id="minus-' . $tab_min["id"] . '" role="button"><i class="fa-solid fa-minus"></i></button>
                            <input type="text" size="5" id="' . $tab_min["id"] . '" readonly="readonly" class="input_btn" value="' . $tab_min["quantity"] . '"/>
                            <button class="button-add" id="plus-' . $tab_min["id"] . '" role="button"><i class="fa-solid fa-plus"></i></button>
                        </div>
                    </td>';
                    echo '<td>' . $tab_min["id"] . '</td>';
                    echo '<td>' . $tab_min["prix"] . '</td>';
                    echo '<td class="bg_none"><button id="' . $tab_min["id"] . '"><i class="fa-solid fa-xmark"></i></button></td>';
                    echo '</tr>';
                }
                echo '</table>';
                ?>
                <div class="validation">
                    <button id="annuler">Annuler</button>
                    <button id="valider">Valider</button>
                    <button id="opti">Optimiser le panier</button>
                </div>
                <div class="erreur" id="erreur"></div>
            <?php
        } else {
            echo '<h2>Votre panier est vide</h2>';
        }
            ?>
    </div>
    <?php
        include ('php/footer.php');
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/header.js"></script>
    <script src="js/panier.js"></script>
</body>
</html>