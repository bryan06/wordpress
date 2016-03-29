<?php
try {
    $bdd = new PDO('mysql:host=10.10.4.188;dbname=cwitter', 'cwitter', 'cwitter');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}
session_start();
session_unset ();
session_destroy ();
header ('location: index.php');
?>