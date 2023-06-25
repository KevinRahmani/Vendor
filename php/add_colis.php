<?php
session_start();

include("connexion_user.php");
include("connexion_stock.php");
include("connexion_colis.php");


$SocieteLivraison = $_SESSION['arrayLivreur']["Livreur"]; //récupération du select dans facture.php
// echo $_SESSION['arrayLivreur']["Livreur"];
    //code à optimiser au niveau du nombre d'utilisation des variables

    //pour chaque element du panier     
    foreach($_SESSION['panier'] as $colis)
    {
        // Declare a date
        $Date = date("Y-m-d");
        // Add days to date 
        switch ($SocieteLivraison) {
            case 'Colissimo':
                $date_livraison = date('Y-m-d', strtotime($Date. ' + 2 days'));
                break;
            case 'Chronopost':
                $date_livraison = date('Y-m-d', strtotime($Date. ' + 5 days'));
                break;
            case 'MondialRelay':
                $date_livraison = date('Y-m-d', strtotime($Date. ' + 7 days'));
                break;
            default:
                $date_livraison = date('Y-m-d', strtotime($Date. ' + 2 days'));
                break;
        }
        


        //préparation du colis 
        $colis['client_id'] = $_SESSION['user']['id'];
        $colis['adresse'] = $_SESSION['user']['adresse'];
        $colis['date_livraison']= $date_livraison;
        $colis['produit_id'] = $colis['id'];

        //volume d'un colis=1 -> petit, = 2 -> moyen, = 3 -> grand
        //produit type automobile = grand, produit type meuble et bricolage et sport = moyen, autres produits = petits
        //high-tech particulier car différentes tailles de produits donc on trie en fonction du 'type'
        //id catégories 000 = auto, 100= bricolage, 200= cuisine et maison, 300=hightech, 400=livres,600=musique,700=sport, 800=vetements

        switch (intdiv($colis['produit_id'],100)) { // division entiere par 100 pour ne tenir compte que du 1er chiffre qui permet de distinguer les catégories
            case 0: // automobiles
                $colis['volume_colis']=3;
                break;
            
            case 1: //bricolage
                $colis['volume_colis']=2;
                break;
            case 2: //cuisine et maison
                $colis['volume_colis']=2;
                break;
            case 3: // high-tech
                if(strcmp($colis['type'],"Téléphones et montres connectées")==0){
                    $colis['volume_colis']=1;
                }elseif(strcmp($colis['type'],"Audio")==0)
                {
                    $colis['volume_colis']=1;
                }elseif(strcmp($colis['type'],"TV et projecteurs")==0)
                {
                    $colis['volume_colis']=2;
                }
                elseif(strcmp($colis['type'],"Objets connectés")==0)
                {
                    $colis['volume_colis']=1;
                }
                elseif(strcmp($colis['type'],"Photo")==0)
                {
                    $colis['volume_colis']=2;
                }
                else
                {
                    $colis['volume_colis']=1;
                }
                break;  
                            
            case 4: //livres
                $colis['volume_colis']=1;
                break;
            case 6: //musique
                $colis['volume_colis']=1;
                break;
            case 7: //sport
                $colis['volume_colis']=2;
                break;   
            case 8: //vetements
                $colis['volume_colis']=1;
                break; 
        }

        switch($colis['volume_colis']) {
            case 3:
                $permis = 'c';
                break;
            default :
                $permis = 'b';
                break;
        }

        
        //récuperation informations livreur avec le moins de livraisons
    $livreur = $db_user->prepare("SELECT id FROM livreur WHERE nbColis= (SELECT min(nbColis) FROM livreur WHERE societe = '".$SocieteLivraison."' AND type_permis = '".$permis."') AND societe = '".$SocieteLivraison."' AND type_permis = '".$permis."'");
    $livreur->execute();
    $livreur = $livreur->fetchAll();

    foreach($livreur as $tmp)
        {
            $colis['livreur_id']= $tmp[0];

        }
        // $colis['livreur_id'] = 648794167;

        //création du tableau à envoyer dans la db
        $values=array(
            'id' => rand(0, 6000000),   // creation temporaire d'un id aléatoire
            'id_produit' => htmlentities($colis['produit_id']),
            'adresse_livraison' => htmlentities($colis['adresse']),
            'id_livreur' => htmlentities( $colis['livreur_id']),
            'id_client' => htmlentities($colis['client_id']),
            'date_livraison' => htmlentities($colis['date_livraison']),
            'taille' => htmlentities( $colis['volume_colis']),
            'etat' => htmlentities( "en cours"),
            'connecte' => intval($_SESSION['connecte'])    
        ); 

        //insertion du colis dans la base de données
        $insert_db = $db_colis->prepare("INSERT INTO colis (id, id_produit, adresse_livraison, id_livreur, id_client, date_livraison, taille, etat,connecte)
         VALUES (:id, :id_produit, :adresse_livraison, :id_livreur, :id_client, :date_livraison, :taille, :etat, :connecte)");
        $insert_db->execute($values);

        

        //modification du nombre de colis affecté au livreur
        $livreur_id= $colis['livreur_id'];
        $modif_affectation_livreur = $db_user->prepare('UPDATE livreur SET nbColis = (nbColis+1) WHERE id='.$livreur_id);
        $modif_affectation_livreur->execute();
    }
    $response ='ok';
echo $response;
?>