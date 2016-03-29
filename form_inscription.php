<?php
try {
    $bdd = new PDO('mysql:host=10.10.4.188;dbname=cwitter', 'cwitter', 'cwitter');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

if(isset($_POST['nom'])) $nom = $_POST['nom'];
if(isset($_POST['prenom'])) $prenom = $_POST['prenom'];
if(isset($_POST['mail'])) $email = $_POST['mail'];
if(isset($_POST['mdp'])) $mdp = sha1($_POST['mdp']);
if(isset($_POST['naissance'])) $naissance = $_POST['naissance'];
if(isset($_POST['sexe'])) $sexe = $_POST['sexe'];

if(isset($_POST['submit_connexion']))
{
    $nom = htmlspecialchars(strtoupper($_POST['nom']));
    $prenom = htmlspecialchars(ucfirst($_POST['prenom']));
    $email = htmlspecialchars($_POST['mail']);
    $mdp = sha1($_POST['mdp']);
    $mdp2 = sha1($_POST['mdp2']);
    $naissance = htmlspecialchars($_POST['naissance']);
    $sexe = htmlspecialchars($_POST['sexe']);
    if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['mail']) AND !empty($_POST['mdp']) AND !empty($_POST['mdp2']) AND !empty($_POST['naissance']) AND !empty($_POST['sexe']))
    {

        if (filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $reqemail= $bdd->prepare("SELECT * FROM utilisateur WHERE mail= ? ");
            $reqemail->execute(array($email));
            $emailexist = $reqemail->rowCount();
            if($emailexist == 0 )
            {
                if ($mdp == $mdp2)
                {
                    $req = $bdd->prepare('INSERT INTO utilisateur(nom, prenom, mail, mdp, naissance,sexe, image) VALUES (:nom, :prenom, :mail, :mdp, :naissance, :sexe, :image)');
                    $req->execute(array(
                        'nom' => $nom,
                        'prenom' => $prenom,
                        'mail' => $email,
                        'mdp' => $mdp,
                        'naissance' => $naissance,
                        'sexe' => $sexe,
                        'image' => "default.jpg",
                    ));
					$req2 = $bdd->prepare('INSERT INTO followers(nom, prenom, mail) VALUES (:nom, :prenom, :email)');
					$req2->execute(array(
						'nom' => $nom,
						'prenom' => $prenom,
						'email' => $email,
					));
                    echo "ok";
                    $reqconnect = $bdd->prepare('SELECT id, prenom, mail, mdp FROM utilisateur  WHERE mail = :mail AND mdp = :mdp');
                    $reqconnect->execute(array(
                        'mail' => $email,
                        'mdp' => $mdp,
                    ));
                    $resultatconnect = $reqconnect->fetch();
                    session_start();
                    $_SESSION['id']=$resultatconnect['id'];
					$_SESSION['prenom']=$resultatconnect['prenom'];
					$_SESSION['mail']=$resultatconnect['mail'];
					$_SESSION['ville']=$resultatconnect['ville'];
					$_SESSION['profession']=$resultatconnect['profession'];
                    header('Location: timeline.php');
                }
                else
                {
                    $erreur= "Votre mote de passe doit etre identique !";
                }
            }
            else
            {
                $erreur= "Adresse mail déja utilisé ! ";
            }
        }
        else
        {
            $erreur="Votre adresse mail n'est pas valide !";
        }
    }
    else
    {
         $erreur="Tout les champs doivent etre complétés !";
    }
}


?>
