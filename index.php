<?php

include_once("_include.php");

session_start();

?>

<script type="text/javascript">
    function functionAjax(){
        var recherche = document.getElementById("recherche").value;
        
        // Si le nombre de caractères est inférieur à 3, pour éviter de faire des recherches lourdes et longues, on n'appelle pas la page abonne_recherche_dynamique.php
        if (recherche.length < 2) {
            document.getElementById("resultats").innerHTML = "Saisir au moins 2 caractères.";
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_produit_dynamique_boutique.php?recherche='+recherche);
            xhr.onreadystatechange = function () {
                const DONE = 4;
                const OK = 200;
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        document.getElementById("resultats").innerHTML = xhr.responseText;
                    }
                    else{
                        document.getElementById("resultats").innerHTML = xhr.status;
                    }
                }
            };
            xhr.send();   
        }
    }
</script>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Evaluation</title>

 
  </head>
  <body>




    <nav class="mb-4 responsive navbar navbar-expand-lg navbar-light">
      <!-- Ligne avec inscription Menu + Bouton -->
      <button
        class="navbar-toggler"
        type="button"
        data-toggle="collapse"
        data-target="#navbarTogglerDemo01"
        aria-controls="navbarTogglerDemo01"
        aria-expanded="false"
        aria-label="Toggle navigation"
      >
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Mettre la liste ul dans la navbar-collapse -->
      <div
        class="collapse navbar-collapse justify-content-center"
        id="navbarTogglerDemo01"
      >
        <!-- Passage de l'élément ul en navbar-nav soit flex-direction: column -->
        <!-- <ul class="nav justify-content-center"> -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link text-primary font-weight-bold" href="index.php"><?php echo ucfirst(LANGUE["accueil"]); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-secondary font-weight-bold" href="boutique.php"><?php echo ucfirst(LANGUE["boutique"]); ?></a>
          </li>
          </li>
          <li class="nav-item">
            <a class="nav-link text-success font-weight-bold" href="inscription.php"><?php echo ucfirst(LANGUE["inscription"]); ?></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-danger font-weight-bold" href="connexion.php"><?php echo ucfirst(LANGUE["se_connecter"]); ?></a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-secondary font-weight-bold" href="membre.php">Espace membre</a>
          </li>


          <li class="nav-item">
            
            <a class="nav-link text-warning font-weight-bold " href="contact.php"><?php echo ucfirst(LANGUE["contact"]); ?></a>
          </li>
          <li class="nav-item">
            
            <a class="nav-link text-info font-weight-bold" href="reglages.php"><?php echo ucfirst(LANGUE["reglages"]); ?></a>
          </li>
          <li class="nav-item">
            
            <a class="nav-link text-danger font-weight-bold" href="deconnection.php"><?php echo ucfirst(LANGUE["deconnection"]); ?></a>
          </li>


        </ul>
       
          
        </form>
      </div>
    </nav>



    <form class="text-center">
          
          <div class="form-group ">
          <label for="recherche"><?php echo ucfirst(LANGUE["recherche"]); ?></label>
          <input type="text" id="recherche" name="recherche" oninput="functionAjax()">
         
</div>
</form>



<div class="text-center" id="resultats"></div>
  </body>
</html>


