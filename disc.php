<?php

    // on importe le contenu du fichier "db.php"
    include "db.php";
    // on exécute la méthode de connexion à notre BDD
    $db = connexionBase();

    // on lance une requête pour chercher toutes les fiches d'artistes
    $requete = $db->query("SELECT * FROM disc Join artist ON artist.artist_id = disc.artist_id");
    // on récupère tous les résultats trouvés dans une variable
    $tableau = $requete->fetchAll(PDO::FETCH_OBJ);
    // var_dump($tableau);
    // on clôt la requête en BDD
    $requete->closeCursor();

    $requete = $db->query("SELECT count(*) as nb FROM disc");
    $nbDisc = $requete->fetchAll(PDO::FETCH_OBJ);
    $requete->closeCursor();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <title>PAGE ACCUEIL</title>  
</head>

<body>



<div class="row">
<?php foreach ($nbDisc as $nbD):
?>
  <div class="col-6 font-weight-bold display-3 mb-2"> Liste des disques (<?= $nbD->nb ?>)</div>
  
  <?php endforeach; ?>
  <div class="col-6 d-flex align-items-end justify-content-end align-items-center "><a href="disc_new.php" class="btn btn-primary btn-sm mr-3">Ajouter</a>  </div>
</div>



<div class="row">
<?php foreach ($tableau as $disc):
// var_dump($disc);
?>



 <img class="img-fluid col-3 mb-2" src="/img/<?= $disc->disc_picture ?>">
 
 
 <div class=" mb-3 col-3 card border-0 " > 
 <div class="card-body pl-0">
    <div class="font-weight-bold h5 mb-0"><?= $disc->disc_title ?></div>
    <div class="font-weight-bold"><?= $disc->artist_name ?></div>
    <div><?='<strong>Label : </strong>'.$disc->disc_label?></div>
    <div><strong>Year : </strong><?= $disc->disc_year ?></div>
    <div><?='<strong>Genre : </strong>'.$disc->disc_genre ?></div>
  
    
     
</div>
   <div class="card-footer bg-transparent border-0 pl-0"><a href="disc_detail.php?id=<?= $disc->disc_id ?>" class="btn btn-primary btn-sm ">Détails</a>  </div>
   </div>                                      

<?php endforeach; ?>
</div>  















<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</body>
</html>