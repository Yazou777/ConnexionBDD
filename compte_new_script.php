<?php
    // Récupération du Nom :

    
    
    if (isset($_POST['mdp']) && $_POST['mdp'] != "" ) {
        $mdp = $_POST['mdp'];
    }
    else {
        $mdp = Null;
    }
var_dump($_POST['mdp']);
    // Récupération de l'URL (même traitement, avec une syntaxe abrégée)
    $email = (isset($_POST['email']) && $_POST['email'] != "") ? $_POST['email'] : Null;
    var_dump($email);
   
    // En cas d'erreur, on renvoie vers le formulaire
    if ($mdp == Null) {
        header("Location: compte_new.php");
        exit;
    }

    $hashmdp = password_hash("$mdp", PASSWORD_DEFAULT);
    var_dump($hashmdp);


    // S'il n'y a pas eu de redirection vers le formulaire (= si la vérification des données est ok) :
    require "db_compte.php"; 
    $db = connexionBase();



try {
    // Construction de la requête INSERT sans injection SQL :
    $requete = $db->prepare("INSERT INTO auth (email, mdp) VALUES (:email, :mdp);"); 

    // Association des valeurs aux paramètres via bindValue() :
    $requete->bindValue(":email", $email, PDO::PARAM_STR);
    $requete->bindValue(":mdp", $hashmdp, PDO::PARAM_STR);

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
    die("Fin du script (compte_new_script.php)");
}

// Si OK: redirection vers la page artists.php
header("Location: login_form.php");

// Fermeture du script
exit;
?>