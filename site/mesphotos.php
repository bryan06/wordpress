<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
		<title>Mes Photos</title>
        <link rel="stylesheet" href="css/entete_style.css">
        <link rel="stylesheet" href="css/mesphotos.css">
	</head>
	<body>

		<header>
			<?php include("entete.php"); ?>
        </header>
        <div class="container">
            <div id="entete"><h2> Galleries des photos</h2> </div>
            <section id="content">
                <div class="gallery">

                    <ul>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                    </ul>
                    <ul>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                        <li><img class="fancybox" rel="group" src="http://placehold.it/100x100"/></li>
                    </ul>
                    <!-- Add jQuery library -->
                    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
                    <!-- Add fancyBox -->
                    <link rel="stylesheet" href="source/jquery.fancybox.css" type="text/css" media="screen" />
                    <script type="text/javascript" src="source/jquery.fancybox.pack.js"></script>
                    <script type="text/javascript">
                        $(document).ready(function() {
                            $(".fancybox").fancybox();
                        });
                    </script>
                    <form class="sphoto" action="form_mesphotos.php" method="POST" enctype="multipart/form-data">
                        Titre: <input id="titlephoto" type="text" name="name">
                        Ajouter photo:<input src="" type="file" name="file">
                        <input type="submit" name="submit">
                    </form>
                </div>

            </section>
            <footer></footer>
         </div>

    </body>
</html>
