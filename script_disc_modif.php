<?php
    // Récupération du Nom :
    if (isset($_POST['titre']) && $_POST['titre'] != "") {
        $titre = $_POST['titre'];
    }
    else {
        $titre = Null;
    }

    // Récupération de l'URL (même traitement, avec une syntaxe abrégée)
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
    var_dump($artist);
    $picture = (isset($_POST['fichier']) && $_POST['fichier'] != "") ? $_POST['fichier'] : Null;  
    var_dump($picture);
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null; 
    var_dump($year);
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null; 
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null; 
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null; 
    // En cas d'erreur, on renvoie vers le formulaire
    if ($titre == Null) {
        header("Location: disc_modif.php?id=".$id);
        exit;
    }

    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();



try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("UPDATE disc SET disc_title = :titre, disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price, disc_picture = :fichier, artist_id = :artist WHERE disc_id = :id;"); 

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":titre", $titre, PDO::PARAM_STR);
    $requete->bindValue(":year", $year, PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_STR);
    $requete->bindValue(":fichier", $monimage, PDO::PARAM_STR);
    $requete->bindValue(":artist", $artist, PDO::PARAM_INT);

    // Lancement de la requête :
    $requete->execute();

    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();

}

// Gestion des erreurs
catch (Exception $e) {
    var_dump($requete->queryString);
    var_dump($requete->errorInfo());
    echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
    die("Fin du script (script_disc_ajout.php)");
}

// Si OK: redirection vers la page artists.php
header("Location: disc.php");

// Fermeture du script
exit;
?>