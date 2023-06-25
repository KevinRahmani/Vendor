<?php
    session_start();
    require("php/connexion_stock.php");
    require("php/connexion_user.php");
    require("php/connexion_colis.php");

    $LivreurQuery = $db_user->prepare('SELECT * FROM livreur WHERE id =?');
    $LivreurQuery->execute(array($_SESSION['user']['id']));
    $arrayLivreur = $LivreurQuery->fetchAll();
    $_SESSION['user'] = $arrayLivreur[0];

    $nb_date_livraison = $db_colis->query("SELECT COUNT(DISTINCT date_livraison) FROM colis WHERE id_livreur = ".$_SESSION['user']['id']);
    if (!$nb_date_livraison) {
        die('Error: ' . print_r($db_colis->errorInfo(), true));
    }
    
    $nb_date = $nb_date_livraison->fetchColumn();

    $sql = $db_colis->prepare("SELECT DISTINCT date_livraison FROM colis WHERE id_livreur = ? ORDER BY date_livraison ASC");
    $sql->execute(array($_SESSION['user']['id']));
    $date_livraison = $sql->fetchAll();
    $sql = $db_colis->query("SELECT * FROM colis WHERE id_livreur = ".$_SESSION['user']['id']);
    $colis = $sql->fetchAll();
    $sql = $db_colis->query("SELECT COUNT(*) FROM colis WHERE id_livreur = ".$_SESSION['user']['id']);
    $nb_colis = $sql->fetchColumn();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor</title>

    <link rel="stylesheet" type="text/css" href="css/header.css">
    <link rel="stylesheet" type="text/css" href="css/footer.css">
    <link rel="stylesheet" type="text/css" href="css/planning.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/82e270d318.js" crossorigin="anonymous"></script>
</head>
<body><?php
        if(isset($_SESSION['connecte'])){
            if($_SESSION['connecte'] == 4){
                include('php/livreur_header.php');
    ?>

    <div class="titre">
        <h1>Voici votre planing :</h1> 
    </div>

<div class="carousel-container">
  <?php for ($i = 0; $i < $nb_date; $i++) { ?>
    <div class="carousel-slide">
      <?php $current_date = $date_livraison[$i]['date_livraison']; ?>
      <h2 class="date"> <i class="fa fa-calendar"></i><?php echo $current_date; ?></h2>
      <?php $colis_list = array_filter($colis, function($col) use ($current_date) {
          return $col['date_livraison'] == $current_date;
        });
        if (!empty($colis_list)) { ?>
        <table class="desc">
          <thead>
            <tr>
              <th>Numéro du colis</th>
              <th>Adresse de livraison</th>
              <th>Id du client</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($colis_list as $col) { ?>
              <tr>
                <td><?php echo $col['id']; ?></td>
                <td><?php echo $col['adresse_livraison']; ?></td>
                <td><?php echo $col['id_client']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
      <?php } else { ?>
        <p class="no-colis">Aucun colis n'est prévu pour cette date.</p>
      <?php } ?>
    </div>
  <?php } ?>
  <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
  <a class="next" onclick="plusSlides(1)">&#10095;</a>
</div>


<?php
    include("php/footer.php.");
        } else{
    echo "<h2> Veuillez quitter la page, vous n'etes pas un livreur</h2>";
    }
    } else{
        echo "<h2>Veuillez quitter cette page, vous n'etes pas autorisé</h2>";
        echo $_SESSION['connecte'];
    }
?>

<script src="js/planning.js"></script>
</body>
</html>