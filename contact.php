<?php 

session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Document</title>
</head>
<body>


    <div class="container">
    <h2 class= "text-center">Nous contacter</h2>
<form action="envoyerMail.php" method="POST">
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="nom">Nom</label>
              <input type="text" class="form-control" id="nom" name="nom" />
            </div>
            <div class="form-group col-md-6">
              <label for="prenom">Prénom</label>
              <input type="text" class="form-control" id="prenom" name="prenom" />
            </div>
          </div>
          
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="email">Email</label>
              <input type="email" class="form-control" id="email" name="email" />
            </div>
            <div class="form-group col-md-6">
              <label for="tel">Téléphone</label>
              <input type="tel" class="form-control" id="tel" />
            </div>
          </div>

         

          <div class="form-group">
            <label for="sujet">Sujet</label>
            <input type="text" class="form-control" id="sujet" name="sujet" />
          </div>

          <div class="form-group">
            <label for="message">Message</label>
            <textarea class="form-control" id="message" name="message" rows="3">
Laissez votre message</textarea>
          </div>

        

          <button type="submit" class="btn btn-dark btn-block mr-5 my-4">
            Envoyer
          </button>
        </form>
        </div>
  
</body>
</html>