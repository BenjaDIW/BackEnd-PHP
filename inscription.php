<?php

include_once("_include.php");

session_start();


?>


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
            
            <a class="nav-link text-warning font-weight-bold " href="contact.php"><?php echo ucfirst(LANGUE["contact"]); ?></a>
          </li>
          <li class="nav-item">
            
            <a class="nav-link text-info font-weight-bold" href="reglages.php"><?php echo ucfirst(LANGUE["reglages"]); ?></a>
          </li>
        </ul>
       
          
        </form>
      </div>
    </nav>
  </body>
</html>


    <div class="container">
    <h2 class= "text-center">Inscription</h2>
<form action="insert_inscription.php" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" />
            </div>
            <div class="form-group col-md-6">
              <label for="tel">Téléphone</label>
              <input type="tel" class="form-control" id="tel" name="tel" />
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-12">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" />
            </div>
            
          </div>

         

          <div class="form-group">
            <label for="password">Mot De Passe</label>
            <input type="password" class="form-control" id="password" name="password" />
          </div>

         
        <input type="hidden" class="form-control" id="cle" name="cle" />

          

        

          <button type="submit" class="btn btn-dark btn-block mr-5 my-4">
            Valider
          </button>
        </form>
        </div>
  
</body>
</html>