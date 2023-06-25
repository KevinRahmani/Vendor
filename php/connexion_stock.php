<?php
function PDObackquote( $value )
{
    if( is_array($value) )
        return implode(', ', array_map('PDObackquote', $value));
     
    return '`'.str_replace(array('`', '.'), array('``', '`.`'), $value).'`';
}
 
try
{
	$db = new PDO('mysql:host=localhost;dbname=stock_vendor;charset=utf8', 
        'root', 
        '',
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION],);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

?>