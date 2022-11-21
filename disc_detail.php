<?php
    // On se connecte à la BDD via notre fichier db.php :
    require "db.php";
    $db = connexionBase();

    // On récupère l'ID passé en paramètre :
    $id = $_GET["id"];

    // On crée une requête préparée avec condition de recherche :
    $requete = $db->prepare("SELECT * FROM disc JOIN artist ON artist.artist_id = disc.artist_id WHERE disc_id=?");
    // on ajoute l'ID du disque passé dans l'URL en paramètre et on exécute :
    $requete->execute(array($id));
    
    // on récupère le 1e (et seul) résultat :
    $myDisc = $requete->fetch(PDO::FETCH_OBJ);
    // var_dump($myDisc); 
    if ($myDisc == false){
        echo 'erreur id<br><br>';
    }
    // on clôt la requête en BDD
    $requete->closeCursor();
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <title>PDO - Détail</title>
    </head>
    <body>

 

    
    <legend class="h1">Details</legend>
<div class="row">
    <div class="form-group col-6">
        <label for="titre">Title</label>
        <input type="text" name="titre" id="titre" class="form-control" value="<?= $myDisc->disc_title ?>" readonly="readonly">
        
    </div>

  
    <div class="form-group col-6">
        <label for="artist">Artist</label>
        <input type="text" name="artist" id="artist" class="form-control" value="<?= $myDisc->artist_name ?>" readonly="readonly">
        </div>
        

        <div class="form-group col-6">
        <label for="year">Year</label>
        <input type="text" name="year" id="year" class="form-control" value="<?= $myDisc->disc_year ?>" readonly="readonly">
        </div>
        

        <div class="form-group col-6">
        <label for="genre">Genre :</label>
        <input type="text" name="genre" id="genre" class="form-control" value="<?= $myDisc->disc_genre ?>" readonly="readonly">
        </div>
        

        <div class="form-group col-6">
        <label for="label">Label :</label>
        <input type="text" name="label" id="label" class="form-control" value="<?= $myDisc->disc_label ?>" readonly="readonly">
        </div>
        

        <div class="form-group col-6">
        <label for="price">Prix :</label>
        <input type="text" name="price" id="price" class="form-control" value="<?= $myDisc->disc_price ?>" readonly="readonly">
        </div>


        <div class="form-group col-12 pl-0">
       <label for="picture" class="col-12"> Picture</label>
        <img class="img-fluid col-6" src="/img/<?= $myDisc->disc_picture ?>" id="picture" readonly="readonly">
        </div>

</div>


<script>
        function geek() {
           if ((confirm("Etes vous sur ?")) == true) {
            document.location.href="script_disc_delete.php?id=<?= $myDisc->disc_id ?>"; 
           }
          
        }
</script>


        <a href="disc_modif.php?id=<?= $myDisc->disc_id ?>"><button class="btn btn-primary btn-sm">Modifier</button></a>
        <a href=""  onclick="geek()" ><button class="btn btn-primary btn-sm">Supprimer</button></a>
        <a href="disc.php"><button class="btn btn-primary btn-sm">Retour</button></a>
        
       
        

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    </body>


</html>