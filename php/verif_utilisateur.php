<?php
session_start();

//vérifie si le client est connécté 
$data ='';
if(isset($_SESSION['connecte'])){
    $data='ok';
}

echo $data
?>