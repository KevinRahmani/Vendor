<?php
session_start();

include("php/connexion_user.php");
$prixtotHT = 0;
$_SESSION['prixtot'] = 0;

$_SESSION['arrayLivraison'] = array(
    'Colissimo' => array(
        "Prix" => 4.95,
        "Duree" => 2,
    ),
    'MondialRelay' => array(
        "Prix" => 1,
        "Duree" => 7,
    ),
    'Chronopost' => array(
        "Prix" => 2.95,
        "Duree" => 5,
    ),
);

$arrayPrime = array(
    'Colissimo' => array(
        "Prix" => 0,
        "Duree" => 2,
    ),
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
    <link rel="stylesheet" href="css/facture.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>
<body>
<?php
    if (!empty($_SESSION['panier'])) {
    ?>
        <?php include('php/header.php') ?>
        <div class="facture">
            <h2>Votre facture</h2>
            <table>
                <tr>
                    <th>Produit</th>
                    <th>Nom</th>
                    <th>Quantité</th>
                    <th>Référence</th>
                    <th>Prix HT</th>
                    <th>Prix TTC</th>
                    <th>TOTAL</th>
                </tr>

                <?php
                foreach ($_SESSION['panier'] as $tab_min) {
                    echo '<tr class="produit">';
                    echo '<td><img src="' . $tab_min['image'] .'1.jpg'. '" class="img_product"></img></td>';
                    echo '<td>' .$tab_min['marque']." ". $tab_min['nom'] . '</td>';
                    echo
                    '<td>
                                        <div class="quantite">
                                            <input type="text" size="5" id="text_' . $tab_min["id"] . '" readonly="readonly" class="input_btn" value="' . $tab_min["quantity"] . '"/>
                                        </div>
                                    </td>';
                    echo '<td>' . $tab_min["id"] . '</td>';
                    echo '<td>' . (floatval($tab_min["prix"]) * (1 - 20 / 100)) . ' €</td>';
                    echo '<td>' . $tab_min['prix'] . ' €</td>';
                    echo '<td class="totalprix"><b>' . floatval($tab_min["prix"]) * floatval($tab_min['quantity']) . ' €<b/></td>';
                    echo '</tr>';
                }
                echo '<tr>
                    <td colspan = 6></td>';
                echo '<td class="total">';
                foreach ($_SESSION['panier'] as $tab_min) {
                    $prixtotHT += (floatval(($tab_min["prix"]) * floatval($tab_min['quantity'])) * (1 - 20 / 100));
                }
                echo $prixtotHT . ' € HT</td></tr> <hr>';

                echo '<tr><td colspan=6></td>';
                echo '<td class="total"><b>';
                foreach ($_SESSION['panier'] as $tab_min) {
                    $_SESSION['prixtot'] += floatval($tab_min["prix"]) * floatval($tab_min['quantity']);
                }
                echo $_SESSION['prixtot'] . ' € TTC</b></td></tr>';
                
                switch ($_SESSION['connecte']) {
                    //client
                    case 1:

                        //remise -5% + frais de livraison offert
                        if($_SESSION['user']['contrat'] == 1){
                            echo '<tr><td colspan=5></td>';
                            echo '<td  colspan=2 class="total2"><b>';
                            (float) $_SESSION['prixtot']*=0.95;
                            echo "Remise fidelité Vendor -5% : " . floatval($_SESSION['prixtot'])  . ' € TTC</b></td></tr>';
                            $_SESSION['arrayLivraison'] = $arrayPrime;
                        }
                        break;
                    
                    //vendeur
                    case 2:
                        echo '<tr><td colspan=5></td>';
                        echo '<td  colspan=2 class="total2"><b>';
                        (float) $_SESSION['prixtot']*=0.95;
                        $_SESSION['arrayLivraison'] = $arrayPrime;
                        echo "Remise partenariat Vendor -5% : " . floatval($_SESSION['prixtot']) . ' € TTC</b></td></tr>';
                        break;
                    //admin
                    case 3:
                        echo '<tr><td colspan=5></td>';
                        echo '<td  colspan=2 class="total2"><b>';
                        $_SESSION['prixtot'] = 0;
                        $_SESSION['arrayLivraison'] = $arrayPrime;
                        echo "Remise total : " . $_SESSION['prixtot'] . ' € TTC</b></td></tr>';
                        break;  

                }
                echo '<tr><td colspan=4></td>';
                echo '<td class="livraison" colspan=3>Choix du mode de livraison : 
                <select name="selectedLivreur" id="filter_product">
                    <option value="">Selectionner une société de livraison</option>';
                    foreach ($_SESSION['arrayLivraison'] as $key => $value) {
                        echo '<option value="'.$key.'">'.$key. ' - '.$value['Duree'].' jours ouvrés - '.$value['Prix'].' €'.'</option>';
                    }   
                    
                '</select>
                </td>';
                echo '</table>';
                ?>
                <div class="validation">
                    <button id="annuler">Annuler</button>
                    <button id="envoyer">Envoyer</button>
                </div>
                <div class="message_info"></div>
        </div>
        </div>

        <?php include('php/footer.php') ?>

    <?php
    } else {
        echo '<h2> Panier vide veuillez quitter cette page</h2>';
    }
    ?>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="js/header.js"></script>
    <script src="js/facture.js"></script>
</body>
</html>
       