<!DOCTYPE html>
<html lang="fr"  class="px-5 py-5">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">   
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="css/RegEx.css" >

    <title>Se connecter</title>
</head>
<body>

    <h1>Authentification</h1>

    

    <br>
    <br>

    <form action ="login_script.php" method="post" >

    

    <div class="form-group">
        <label for="email">Identifiant</label><br>
        <input type="text" name="email" id="email" class="form-control" placeholder='Email'>
        <small id="usernameHelp" class="form-text">Format non valide</small>
    </div>
        
    <div class="form-group">
        <label for="mdp">Mot de passe</label><br>
        <input type="text" name="mdp" id="mdp" class="form-control" placeholder='Contient au moins 12 caractéres'>
        <small id="usernameHelp" class="form-text">Doit contenir au minimum 1 majuscule 1 misnuscule 1 chiffre 1 symbole et faire 12 caractéres</small>
    </div>

        <input type="submit" value="Se connecter">
        <a href="compte_new.php" class="btn btn-primary btn-sm ">Créer un compte</a>
       
     

    </form>


    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="js/regex_form_auth.js"></script>
</body>
</html>