<?php

include_once("_include.php");


?>


<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Boutique</title>

 
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


<?php

include_once("_include.php");

session_start();


if(!isset($_GET["limit"])){
    $_GET["limit"] = 0;
}

$db = new DB();
$pdo = $db->getDB();

$stmt = $pdo->prepare("SELECT * FROM produit ORDER BY idproduit LIMIT :limit_min, 25");
$stmt->bindParam(":limit_min", $_GET["limit"], PDO::PARAM_INT);

$stmt->execute();


$tableau = "<center>"."<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["produit"])."</th>";
    $tableau.= "<th>"."<a href='tri_boutique_idproduit.php'>".ucfirst(LANGUE["idproduit"])."</th>";
    $tableau.= "<th>"."<center>"."<a href='tri_boutique_nom.php'>".ucfirst(LANGUE["nom"])."<center>"."</th>";
    $tableau.= "<th>"."<a href='tri_boutique_prix.php'>".ucfirst(LANGUE["prix"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
        $tableau.= "<a href='produits_details.php?idproduit=".$row['idproduit']."'>"  ."<img src='public/assets/images/produits/".$row["idproduit"].".jpg'  width='50' height='50'/>".    "</a>";
        $tableau.= "<td>";
        
        $tableau.= "<center>".$row["idproduit"]."<center>";
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["nom"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["prix"]."</td>";
        $tableau.= "<td>"."<a href='addPanier.php' class='btn btn-success' role='button'>Ajouter</a>"."</td>";

        
    }
    $tableau.= "</table>"."</center>";

    echo $tableau;


    $stmtPagination = $pdo->prepare("SELECT count(*) as nb FROM client ");
    $stmtPagination->execute();
    $resultat = $stmtPagination->fetch();

    $limitMin = $_GET["limit"]-25;
    $limitMax = $_GET["limit"]+25;

    if($limitMin < 0){
        $limitMin = 0;
    }
    if($limitMax >= $resultat['nb']){
        $limitMax = $resultat['nb']-1;
    }


    ?>

<br/>

?>

<center><a href='tri_boutique_idproduit.php?limit=<?php echo $limitMin; ?>'>page précédente</a> ||| <a href='tri_boutique_idproduit.php?limit=<?php echo $limitMax; ?>'>page suivante</a></center>