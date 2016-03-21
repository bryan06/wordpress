<?php
try {
    $bdd = new PDO('mysql:host=172.16.2.229;dbname=cwitter', 'root', 't1FNdGWx5z');
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}


if (isset($_POST['submit'])){
    $name=$_FILES['file']['name'];
    $tmp_name=$_FILES['file']['name'];
    $location='utilisateur/mesphotos';
    $target="utilisateur/".$name;
    if(move_uploaded_file($tmp_name,$location.$name)) {
        echo "photo chargé";
        $name = $_POST['name'];
        $req = $bdd->prepare('INSERT INTO mesphotos(p_img, p_title) VALUES (:p_img, :p_name)');
        $req = execute(array(
            'p_img' => $target,
            'p_name' => $nom,
        ));
    }else{
        echo"photo non chargé";
    }
    $result=$bdd->prepare('SELECT * FROM mesphotos where p_id= ?');
        while($row=$result->fetch()){
            echo "<img src=".$row['p_img']." &nbsp ;>";
        }


}

?>