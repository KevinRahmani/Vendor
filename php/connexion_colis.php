<?php

try
{
        $db_colis = new PDO('mysql:host=localhost;dbname=colis;charset=utf8', 
        'root', 
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


?>