<?php
session_start();

foreach($_SESSION['panier'] as $panier_min){
    if($panier_min['id'] == $_GET['id']){
        $new_tab=$panier_min;
    }
}


//on vide la ligne
foreach($_SESSION['panier'] as $key => $tab_min){
    if($tab_min == $new_tab){
        unset($_SESSION['panier'][$key]);
        $status ='ok';
        break;
    }
}

echo json_encode(['status' => $status]);
?>