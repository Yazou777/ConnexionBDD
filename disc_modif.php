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


     // on lance une requête pour chercher toutes les fiches d'artistes
     $requete = $db->query("SELECT * FROM artist");
     // on récupère tous les résultats trouvés dans une variable
     $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
     // var_dump($tableau);
     // on clôt la requête en BDD
     $requete->closeCursor();
?>


<!DOCTYPE html>
<html lang="fr"  class="px-5 py-5">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

    <title>Modifier un vinyle</title>
</head>
<body>




    <form action ="script_disc_modif.php" method="post" enctype="multipart/form-data">

<fieldset>
    
    <legend class="h1">Modifier un vinyle</legend>

    <div class="form-group">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" id="titre" class="form-control" value="<?= $myDisc->disc_title ?>">
        
    </div>

    <div class="form-group">
                       <label for="artist">Nom de l'artiste :</label>
                       <select class="form-control"  id="artist" name="artist" >
                       <option value="<?= $myDisc->artist_id ?>"  selected><?= $myDisc->artist_name ?></option>
                    <?php foreach ($tableau as $artist): ?>

        <?php /*var_dump($artist);*/ // Le var_dump() est écrit à titre informatif ?>

                        <option  value="<?= $artist->artist_id ?>"><?= $artist->artist_name ?></option>
                    <?php endforeach; ?>  
                       </select>
    </div>

    
    
        <div class="form-group">
        <label for="year">Année de sortie :</label>
        <input type="text" name="year" id="year" class="form-control" value="<?= $myDisc->disc_year ?>">
        </div>
        

        <div class="form-group">
        <label for="genre">Genre :</label>
        <input type="text" name="genre" id="genre" class="form-control" value="<?= $myDisc->disc_genre ?>">
        </div>
        

        <div class="form-group">
        <label for="label">Label :</label>
        <input type="text" name="label" id="label" class="form-control" value="<?= $myDisc->disc_label ?>">
        </div>
        

        <div class="form-group">
        <label for="price">Prix :</label>
        <input type="text" name="price" id="price" class="form-control" value="<?= $myDisc->disc_price ?>">
        </div>


        <div class="form-group mb-0">
        <label for="fichier">Picture</label>
        <br>
        <input type="file" name="fichier" id="fichier" > 
        </div>
        <img class="img-fluid" src="/img/<?= $myDisc->disc_picture ?>" id="picture" readonly="readonly">
        
        </fieldset>
        
      
        <input class="btn btn-primary btn-sm" type="submit" value="Modifier">
        

    </form>
        <a href="disc.php"><button class="btn btn-primary btn-sm">Retour</button></a>
        <input type="reset" value="reset" class="btn btn-primary btn-sm">
   


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>