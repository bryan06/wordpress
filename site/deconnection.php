<?php
try {
    $bdd = new PDO('mysql:host=172.16.2.229;dbname=cwitter', 'root', 't1FNdGWx5z');
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