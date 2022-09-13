<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Connexion</title>
</head>
<body>
    
</body>
</html>

<?php

include_once("_include.php");
session_start();

$db = new DB();
$pdo = $db->getDB();


if(isset($_POST['idclient']) && isset($_POST['login']) && isset($_POST['mdp'])){
  $stmtId = $pdo->prepare("SELECT cle
  FROM client
  WHERE idrole = 2 OR idrole = 3");


$stmtId->execute();

$cle = $stmtId->fetch()['cle'];

$password = sha1("ifocop_diw_2022".sha1($cle).$_POST['mdp']);

$stmtClient = $pdo->prepare("SELECT idclient, count(*) as NBclient FROM client WHERE (idrole = 2 OR idrole = 3) AND password = :password AND email = :email");
    $stmtClient->bindParam(':password', $password);
    $stmtClient->bindParam(':email', $_POST['login']);
      
    $stmtClient->execute();

    $resultClient = $stmtClient->fetch(); 

  

    if($resultClient['NBclient'] == 1){
        $_SESSION['login'] = true;
        $_SESSION['idclient'] = $resultClient['idclient'];
        print_r($_SESSION);
        echo "vous êtes connecté";
        
        sleep(2);
        header('Location: index.php');
    }
    else{
        echo "Erreur dans le login/mdp";
    }
}



if(isset($_POST['login']) && isset($_POST['mdp'])){
     
    $stmtId = $pdo->prepare("SELECT cle
                            FROM client
                            WHERE idrole = 1 OR idrole = 4");
    
    
    $stmtId->execute();

    $cle = $stmtId->fetch()['cle'];

    $password = sha1("ifocop_diw_2022".sha1($cle).$_POST['mdp']);

    $stmt = $pdo->prepare("SELECT count(*) as nb FROM client WHERE (idrole = 1 OR idrole = 4) AND password = :password AND email = :email");
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':email', $_POST['login']);
      
    $stmt->execute();

    $result = $stmt->fetch(); 

    if($result['nb'] == 1){
        $_SESSION['admin'] = true;
        print_r($_SESSION);
        echo "vous êtes connecté";
        
        sleep(2);
        header('Location: index_admin.php');
    }
    else{
        echo "Erreur dans le login/mdp";
    }
}
 
else{
       
?>
<div class="container">
    <h2 class= "text-center">Se connecter</h2>
<form action="connexion.php" method="POST">


              <input type="hidden" class="form-control" id="idclient" name="idclient" />

          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="login">Email</label>
              <input type="email" class="form-control" id="login" name="login" />
            </div>
            <div class="form-group col-md-6">
              <label for="mdp">Mot De Passe</label>
              <input type="password" class="form-control" id="mdp" name="mdp" />
            </div>
          </div>
 
          <button type="submit" class="btn btn-dark btn-block mr-5 my-4">
            Se connecter
          </button>
</form>

</div>
<?php
}
?>

<a class="nav-link text-center text-primary font-weight-bold" href="index.php"><?php echo ucfirst(LANGUE["accueil"]); ?></a>
