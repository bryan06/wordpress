<?php
try {
    $bdd = new PDO('mysql:host=172.16.3.5;dbname=cwitter', 'root', 'CASmfh65222');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(isset($_POST['mail'])) $email = $_POST['mail'];
if(isset($_POST['mdp'])) $mdp = sha1($_POST['mdp']);


$req = $bdd->prepare('SELECT id, prenom, mail, mdp, ville, profession FROM utilisateur  WHERE mail = :mail AND mdp = :mdp');
$req->execute(array(
    'mail' => $email,
    'mdp' => $mdp,
));

$resultat = $req->fetch();
if (!$resultat)
{
    echo 'Mauvais email ou mot de passe !';
    header('Location index.php?err=1');
}
else
{
    session_start();
    $_SESSION['id']=$resultat['id'];
	$_SESSION['prenom']=$resultat['prenom'];
	$_SESSION['mail']=$resultat['mail'];
	$_SESSION['ville']=$resultat['ville'];
	$_SESSION['profession']=$resultat['profession'];
    echo $_SESSION['id'];
    header('Location: timeline.php');
}
?>

