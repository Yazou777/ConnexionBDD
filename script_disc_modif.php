<?php

/////////////////////////////////////// VERIFICATION TYPE FICHIER DÉPLACEMENT ET RENAME/////////////////////////////////////////////////


var_dump($_FILES);

if ($_FILES['fichier']['error'] == 0){
    // On met les types autorisés dans un tableau (ici pour une image)
$aMimeTypes = array("image/gif", "image/jpeg", "image/pjpeg", "image/png", "image/x-png", "image/tiff");

// On extrait le type du fichier via l'extension FILE_INFO 
$finfo = finfo_open(FILEINFO_MIME_TYPE);
$mimetype = finfo_file($finfo, $_FILES["fichier"]["tmp_name"]);
finfo_close($finfo);

if (in_array($mimetype, $aMimeTypes))
{
    $img = true;
    /* Le type est parmi ceux autorisés, donc OK, on va pouvoir 
       déplacer et renommer le fichier */
       $id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
       $rename = (isset($_POST['titre']) && $_POST['titre'] != "") ? $_POST['titre'] : Null;
       var_dump($rename);
       var_dump($_FILES["fichier"]["type"]);


       $file = explode('/',$_FILES["fichier"]["type"]);
       var_dump($file[1]);
       
   move_uploaded_file($_FILES["fichier"]["tmp_name"], "img/".$rename.".".$file[1]); 
 
} 
else 
{
   // Le type n'est pas autorisé, donc ERREUR

   echo "Type de fichier non autorisé";    
   exit;
}   
}
 






///////////////////////////////////////////////////VÉRIFICATION INFO NON VIDE//////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////// INFO PRÉ REMPLI//////////////////////////////////////////////////////////////////////////


    // Récupération du Nom :
    if (isset($_POST['titre']) && $_POST['titre'] != "") {
        $titre = $_POST['titre'];
    }
    else {
        $titre = Null;
    }

    // Récupération de l'URL (même traitement, avec une syntaxe abrégée)
    $id = (isset($_POST['id']) && $_POST['id'] != "") ? $_POST['id'] : Null;
    $artist = (isset($_POST['artist']) && $_POST['artist'] != "") ? $_POST['artist'] : Null;
    var_dump($artist);
    // $picture = (isset($_POST['fichier']) && $_POST['fichier'] != "") ? $_POST['fichier'] : Null;  
    // var_dump($picture);
    $year = (isset($_POST['year']) && $_POST['year'] != "") ? $_POST['year'] : Null; 
    var_dump($year);
    $genre = (isset($_POST['genre']) && $_POST['genre'] != "") ? $_POST['genre'] : Null; 
    $label = (isset($_POST['label']) && $_POST['label'] != "") ? $_POST['label'] : Null; 
    $price = (isset($_POST['price']) && $_POST['price'] != "") ? $_POST['price'] : Null; 
    // En cas d'erreur, on renvoie vers le formulaire
    if ($id == Null) {
        header("Location: disc.php");
    }
    elseif ($titre== Null || $artist== Null || $year== Null || $genre== Null || $label== Null || $price== Null) {
        header("Location: disc_modif.php?id=".$id);
        exit;
    }
   
    





    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db.php"; 
    $db = connexionBase();









    /////////////////////////////////////////////////////////////////// UPDATE INFO/////////////////////////////////////////////////////////////////

try {
    // Construction de la requête INSERT sans injection SQL :

    $requete = $db->prepare("UPDATE disc SET disc_title = :titre, disc_year = :year, disc_genre = :genre, disc_label = :label, disc_price = :price, disc.artist_id = :artistid WHERE disc_id = :id;"); 

    // Association des valeurs aux paramètres via bindValue() :

    $requete->bindValue(":id", $id, PDO::PARAM_INT);
    $requete->bindValue(":titre", $titre, PDO::PARAM_STR);
    $requete->bindValue(":year", $year, PDO::PARAM_INT);
    $requete->bindValue(":genre", $genre, PDO::PARAM_STR);
    $requete->bindValue(":label", $label, PDO::PARAM_STR);
    $requete->bindValue(":price", $price, PDO::PARAM_STR);
    // $requete->bindValue(":fichier", $monimage, PDO::PARAM_STR);
    $requete->bindValue(":artistid", $artist, PDO::PARAM_INT);

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
// header("Location: disc.php");

// Fermeture du script
// exit;
 





//////////////////////////////////////////////////////////////////// UPDATE SI IMAGE UPLOADER/////////////////////////////////////////////////////////////////


if ($img == true)
{

 $monimage =$rename.".".$file[1];
 var_dump($monimage);

 
 try {
 $requete = $db->prepare("UPDATE disc SET disc_picture = :picture WHERE disc_id = :id;"); 
 $requete->bindValue(":id", $id, PDO::PARAM_INT);
 $requete->bindValue(":picture", $monimage, PDO::PARAM_STR);
    // Lancement de la requête :
    $requete->execute();

    // Libération de la requête (utile pour lancer d'autres requêtes par la suite) :
    $requete->closeCursor();
 }
 catch (Exception $e) {
  var_dump($requete->queryString);
  var_dump($requete->errorInfo());
  echo "Erreur : " . $requete->errorInfo()[2] . "<br>";
  die("Fin du script (script_disc_ajout.php)");
}
}
// Si OK: redirection vers la page artists.php
header("Location: disc.php");

// Fermeture du script
exit;

?>