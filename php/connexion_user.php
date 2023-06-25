<?php

try
{
        $db_user = new PDO('mysql:host=localhost;dbname=user_vendor;charset=utf8', 
        'root', 
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


?>