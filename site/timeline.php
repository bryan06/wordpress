<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Cwitter</title>
            <link rel="stylesheet" href="css/body_style.css">
            <link rel="stylesheet" href="css/entete_style.css">

    </head>
    <body>
        <header>
            <?php include("entete.php"); ?>
        </header>



        <div id="alt_actualite">
            <h2>Actualités :</h2><br>

            <form id="formtime" action="form_timeline.php" method="post">

                <p>
                    <?php
                    if (empty($resultat['image'])) {
                        ?>
                        <img width="70" height="70" src="utilisateur/image/<?php echo $resultat['image']; ?>" border="3"
                             class="positionImage"/>
                        <?php
                    }
                    ?>
                    <?php echo $resultat['prenom'];echo "  "; echo $resultat['nom'] ?><br>
                    <textarea id="mypublication" name="publication" rows="5" cols="70"placeholder="Publication"></textarea><br>
                    <input type="submit" style=" margin-left: 40em" value="Publier" >
                </p>

                <?php
				$req=$bdd->prepare('SELECT image FROM utilisateur, news WHERE news.auteur = :id_utilisateur');
				$req->execute(array(
					'id_utilisateur' => $_SESSION['id'],
				));
				$image=$req->fetch();
                 $reponse = $bdd->query('SELECT * FROM utilisateur ORDER BY nom');
				echo'<table>';
				while ($donnees = $reponse->fetch()) {
					   $reponse2 = $bdd->query("SELECT * FROM news WHERE auteur=".$donnees['id']."
												ORDER BY date_creation");
				?>
				<tr><?php
						echo '<td class=pic><img class=timeline src=utilisateur/image/'.$image['image'].'></td>';
						echo '<td class=name><h1>' . $donnees['nom'] . ' ' . $donnees['prenom'] . '</h1></td>';
				?>
					<tr>
						<?php
								while ($donnees2 = $reponse2->fetch()) {
									echo '<td class=publication>';
									echo ' Publié le : ' . $donnees2['date_creation'] . '<br/>';
									echo $donnees2['publication'] . '</br/>';
									echo '</td>';
								}
				?>
				   
			</tr>
		</li>
		<?php
		}
		echo '</ol>';
		?>
	</body>
</html>




            </form>
        </div>
    </body>
</html>



