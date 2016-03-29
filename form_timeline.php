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

$auteur = $_SESSION['id'];
$publication = $_POST['publication'];
$date_creation = date("Y-m-d");

$req = $bdd->prepare('INSERT INTO news(auteur, publication, date_creation) VALUES (:auteur, :publication, :date_creation)');
$req->execute(array(
    'auteur' => $auteur,
    'publication' => $publication,
    'date_creation' => $date_creation,

));
header('Location: timeline.php');