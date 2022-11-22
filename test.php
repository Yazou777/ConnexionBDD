

<input type="text" name="year" id="year" class="form-control" >

<?php

$f = :year;
function mdpComplexe($mdp){
    $resultat = preg_match ('/(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8}/', :year);
    if ($resultat == true) {
      echo 'mdp sécurisé<br>';
    }
    else {
      echo 'mdp faible<br>';
    }
  }
  mdpComplexe('TopSecret42')
      ?>