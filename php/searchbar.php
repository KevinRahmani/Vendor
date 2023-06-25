<?php
include("connexion_stock.php");


$percent = 0.0;
$status = "";
$research = "";
$product_categorie = "";

//filtre de recherche 
if(isset($_GET['task'])){
    if($_GET['task'] != ""){


        $status = "Produit non trouvé, veuillez réessayer";
        //array qui contient toutes les categories 
        $Array_categorie = array (
            "automobile",
            "bricolage, jardin et animalerie",
            "cuisine et maison",
            "high-tech",
            "livre",
            "musique, dvd et blu-ray",
            "sports et loisirs",
            "vetements",
        );

        //parcours le tableau et check si le texte ressemble aux categories
        foreach ($Array_categorie as $categorie){
            similar_text((string) $categorie, (string) $_GET['task'], $percent);
            if($percent > 75.00){
                $research = $categorie;
                $status = "categorie";
                break;
            }
        }

        //parcours les categories et regarde la correspondance avec un produit
        if($research ==""){
            foreach ($Array_categorie as $categorie){
                $sqlQuery = $db->prepare("SELECT * FROM " .PDObackquote($categorie). "WHERE SOUNDEX(nom) = SOUNDEX(?);");
                $sqlQuery->execute(array($_GET['task']));
                $ArrayQuery = $sqlQuery->fetchAll();
    
                //regarde si le tableau du fetch est vide 
    
                if(!empty($ArrayQuery)){
                    $Array_product = $ArrayQuery[0];
                    if(!empty($Array_product)){
                        $status = "produit";
                        $product_categorie = $categorie;
                        $research = $Array_product;
                        break;
                    }
                }
    
            }
        }

    } else {
        $status = "Vous n'avez rien recherché";
    } 
} else {
    $status = "Error: undefined task";
}

//categorie si oui => categorie si non => effectue une recherceh dans chaque table avec un like 




echo json_encode(array("status" => $status, "research" => $research, "product_categorie" => $product_categorie));
?>