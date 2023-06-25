<?php
session_start();

if(isset($_SESSION['connecte'])){
    if($_SESSION['connecte'] == 4){
        include ('php/livreur_header.php');
        include ('php/connexion_colis.php');
        include ('php/connexion_user.php');


        $LivreurQuery = $db_user->prepare('SELECT * FROM livreur WHERE id =?');
        $LivreurQuery->execute(array($_SESSION['user']['id']));
        $arrayLivreur = $LivreurQuery->fetchAll();
        $_SESSION['user'] = $arrayLivreur[0];
        
        $var = $db_colis->query('SELECT * FROM colis WHERE date_livraison = CURDATE() AND id_livreur = '.$_SESSION['user']['id']);
        $aujd_colis = $var->fetchAll();


        $nb_date_livraison = $db_colis->query("SELECT COUNT(date_livraison) FROM colis WHERE date_livraison = CURDATE() AND id_livreur = ".$_SESSION['user']['id']);
         if (!$nb_date_livraison) {
            die('Error: ' . print_r($db_colis->errorInfo(), true));
        }
        $nb_date = $nb_date_livraison->fetchColumn();

        $clientQuery = $db_colis->prepare('SELECT * FROM colis WHERE id_livreur =? AND date_livraison=?');
        $clientQuery->execute(array($_SESSION['user']['id'],date("Y-m-d")));
        $arrayColis = $clientQuery->fetchAll();
        $addresses = array();
        array_push($addresses,$_SESSION['user']['adresse']);
        foreach($arrayColis as $colis){
            array_push($addresses,$colis['adresse_livraison']);
        }
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

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>
<body>
    <div>   
        <h1><p id="title">Le trajet le plus rapide pour les colis d'ajourd'hui : </p></h1> 
        <br>
        <div id="map"></div>
        <div id="msg"></div>
        <table class="tab">
            <thead>
                <tr>
                <th>Numéro du colis</th>
                <th>Adresse de livraison</th>
                <th>Nom du client</th>
                <th>Etat de livraison</th>
                </tr>
            </thead>
            <tbody>
            <?php for ($i = 0; $i < $nb_date; $i++) { 
                if($aujd_colis[$i]['connecte'] == 1){
                    $nom_client = $db_user->prepare('SELECT nom FROM client WHERE id = :client_id');
                    $nom_client->execute(array('client_id' => $aujd_colis[$i]['id_client']));
                    $nom = $nom_client->fetch();
                } else if($aujd_colis[$i]['connecte'] == 2){
                    $nom_client = $db_user->prepare('SELECT nom FROM vendeur WHERE id = :client_id');
                    $nom_client->execute(array('client_id' => $aujd_colis[$i]['id_client']));
                    $nom = $nom_client->fetch();
                } else if($aujd_colis[$i]['connecte'] ==3 ){
                    $nom_client = $db_user->prepare('SELECT nom FROM admin WHERE id = :client_id');
                    $nom_client->execute(array('client_id' => intval($aujd_colis[$i]['id_client'])));
                    $nom = $nom_client->fetch();
                }
                    
            ?>
                
                
              <tr>
                <td><?php echo $aujd_colis[$i]['id']; ?></td>
                <td><?php echo $aujd_colis[$i]['adresse_livraison']; ?></td>
                <td><?php echo $nom['nom']; ?></td>
                <td><button id="livre" class="livre" onclick="deliveredFunction(<?php echo $aujd_colis[$i]['id']; ?>)">Livré</button>
                <button id="retard" class="retard" onclick="retardFunction(<?php echo $aujd_colis[$i]['id']; ?>)">Retardé</button></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
    </div>

<?php

include("php/footer.php");
} else{
echo "<h2> Veuillez quitter la page, vous n'etes pas un livreur</h2>";
}
} else{
echo "<h2>Veuillez quitter cette page, vous n'etes pas autorisé</h2>";
}
?>

<script>
var letters = ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];

function geolocate(address_param){ 

    return new Promise(resolve => {
    
        fetch(`https://maps.googleapis.com/maps/api/geocode/json?address=${address_param}&key=AIzaSyDrZd1M6_USsMsCg6aPzNKCJDIG86_eOg4`)
        .then((response) => {
            return response.json();
        }).then(jsonData => {
            resolve(jsonData.results[0].geometry.location); 
        })
        .catch(error => {
            console.log(error);
        })
    
    });

}

function calculateDistance(origin,destination){

    let directionsService = new google.maps.DirectionsService();

    const route = {
        origin: origin,
        destination: destination,
        travelMode: 'DRIVING'
    }

    return directionsService.route(route);

}

async function get_coordinates() {
  let adress_array = JSON.parse('<?php echo json_encode($addresses); ?>');

  let promises = adress_array.map(address => geolocate(address));
  let coordinates = await Promise.all(promises);

  return coordinates;
}



async function get_graph(){

    let coordinates = await get_coordinates();
    let graph = [];

    for (let i = 0; i < coordinates.length; i++) {
        let vertex = [];
        for (let j = 0; j < coordinates.length; j++) {
            if (i != j){
                let origin = coordinates[i];
                let destination = coordinates[j];
                let distance = await calculateDistance(origin,destination);
                distance = distance.routes[0].legs[0].distance.text.slice(0,-3);
                vertex.push(parseInt(distance));
            }else{
                vertex.push(0);
            }
        
        }
        graph.push(vertex);
    }

    return new Promise(resolve => {

        resolve([graph,coordinates]);

    });

}

function get_index_min(my_list, route_list){

    let min_index = 0;
    let min = Infinity;

    for(let i = 0; i < my_list.length; i++){
        if (!(route_list.includes(i))){

            if (my_list[i] < min){
                min = my_list[i];
                min_index = i;
            }
        }
    }

    return min_index;

}


async function get_route() {
    let getGraph = await get_graph();
    let graph = getGraph[0];
    let coordinates = getGraph[1];

    let route_list = [0];
    let index = 0;
    
    while (route_list.length < graph.length){
        my_list = graph[index];
        index = get_index_min(my_list, route_list);
        route_list.push(index);
    }
    
    return new Promise(resolve => {

        resolve([route_list,coordinates]);

    });
}
async function init() {
  var map;
  let getRoute = await get_route();
  let route = getRoute[0];
  let coordinates = getRoute[1];

  const center = coordinates[0];
  const options = { zoom: 15, scaleControl: true, center: center };
  map = new google.maps.Map(document.getElementById('map'), options);

  let directionsService = new google.maps.DirectionsService();

  const letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ'; // Lettres de l'alphabet

  for (let i = 1; i < route.length; i++) {
    if(i == 1){
        
  const startIcon = {
  path: google.maps.SymbolPath.CIRCLE, // Forme du marqueur (cercle)
  fillColor: 'green', // Couleur de remplissage (vert)
  fillOpacity: 1, // Opacité de remplissage (1 = opaque)
  strokeWeight: 0, // Épaisseur de la bordure (0 = pas de bordure)
  scale: 12 // Taille de l'icône
};

const markerDepart = coordinates[route[0]];

const startMarker = new google.maps.Marker({
      position: markerDepart,
      map: map,
      icon: startIcon, // Utiliser l'icône spéciale
      title: 'Départ'
    });
    }
    const markerLabel = letters[i - 1]; // Récupérer la lettre correspondante à l'étape
    const markerPosition = coordinates[route[i]]; // Récupérer la position de l'étape

    // Créer le marqueur personnalisé avec la lettre comme étiquette
    const marker = new google.maps.Marker({
      position: markerPosition,
      map: map,
      label: markerLabel,
      title: 'Étape ' + markerLabel
    });

    const driving_route = {
      origin: coordinates[route[i - 1]],
      destination: coordinates[route[i]],
      travelMode: 'DRIVING'
    };

    directionsService.route(driving_route, function(response, status) {
      if (status !== 'OK') {
        window.alert('Directions request failed due to ' + status);
        return;
      } else {
        let directionsRenderer = new google.maps.DirectionsRenderer({
          map: map,
          suppressMarkers: true, // Supprimer les marqueurs automatiques
          preserveViewport: true // Conserver la vue actuelle de la carte
        });
        directionsRenderer.setDirections(response);
      }
    });
  }
}

function deliveredFunction(colis_id){

    $.ajax({
        method : "POST",
        url: "php/arriveMail.php",
        data: {"colis":colis_id},
        success: function (response) {
            if(response == "ok"){
                $.ajax({
                    url: "php/delivered.php?id_colis="+colis_id,
                    success: function (data) {
                        if(data == "ok"){
                            $(location).prop('href', 'planning.php');
                        }else{
                            console.log("failed to remove colis");
                        }
                    },
                    error: function(textStatus, errorThrown) {
                        console.log("AJAX request failed: " + textStatus + ", " + errorThrown);
                    }
                });
            }
        }
    });
}

function retardFunction(colis_id){
            $.ajax({
            url: "php/retard.php?id_colis="+colis_id,
            success: function (response) {
            if(response == "ok"){
                $(location).prop('href', 'planning.php')
            }else{
                console.log("failed to add a day to the delivery date");
            }
            },
            error: function(textStatus, errorThrown) {
            console.log("AJAX request failed: " + textStatus + ", " + errorThrown);
            }
        });
        }

</script>



<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDrZd1M6_USsMsCg6aPzNKCJDIG86_eOg4&callback=init"></script>
</body>







<style>
    .tab {
    width: 100%;
    border: 1px solid black;
    border-radius: 10px;
    padding: 10px;
    background-color: black;
  }
    
  .tab td {
    text-align : center;
    border: 1px solid black;
    padding: 10px
  }
  
  .tab th {
    text-align : center;
    border: 1px solid black;
    padding: 10px;
    background-color: #f2f2f2;
    font-weight: bold;
  }

  .tab tr {
    text-align : center;
    background-color: #f2f2f2;
  }

  .tab tr:nth-child(even) {

    text-align : center;
    background-color: #f2f2f2;
  }
    .livre{ 
        grid-area: livre;}

    #livre{
        border: 1px solid black;
        border-radius: 10px;
        padding: 10px;
        background-color: #d7dcde;
        color: blue;
        font-size: 120%;
        width: 45%;
        height: 80%;
        margin-top: 10px;
        border: none;
        cursor: pointer;
     }

    
    #livre:hover{
        background-color: #b0b8b2;
        color: #33F0FF;
    }

    .retard{ 
        grid-area: livre;}

    #retard{

        border: 1px solid black;
        border-radius: 10px;
        padding: 10px;
        background-color: #d7dcde;
        color: red;
        font-size: 120%;
        width: 45%;
        height: 80%;
        margin-top: 10px;
        border: none;
        cursor: pointer;
     }

    
    #retard:hover{
        background-color: #b0b8b2;
        color: #FF8A33;
    }

    #title {
        margin-left: 5%;
    }
       
    #map {
        height: 800px;
        width: 100%;
    }
</style>