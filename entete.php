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
if (!($_SESSION['id'])) header('Location: index.php');
?>
<div id="header">
    <ul>
        <li><a href="timeline.php">Accueil</a></li>
        <li><a href="profil.php">Profil</a></li>
        <li><a href="followers.php">Followers</a></li>
        <li><a href="suivre.php">Suivre des personnes</a></li>
        <li><a href="deconnection.php">Déconnexion</a></li>
    </ul>
</div>
<?php
    $reponse = $bdd->prepare('SELECT * FROM utilisateur where id= ?');
    $reponse->execute(array($_SESSION['id'],
    ));
    $resultat=$reponse->fetch();
?>


    <div id="header_bottom">
        <div id="photo">
            <?php
                if(!empty($resultat['image']))
                {
                    ?>
                    <img width="200" height="200" class="profil" src="utilisateur/image/<?php echo $resultat['image']; ?>" border="3"/>
                    <?php
                }
            ?>
        </div>

        <div id="user_name">
            <h1> <?php echo $resultat['prenom'];echo "  "; echo $resultat['nom'];?>  </h1>
        </div>
		
    </div>
	<form action="search.php" method="post">
		<table id="search">
			<tr>
				<td><input type="text" placeholder="nom" name="nom"></td>
				<td><input type="text" placeholder="prenom" name="prenom"></td>
				<td><input type="submit"  value="Recherche" name="submit_search" /></td>
			</tr>
		</table>
	</form>
