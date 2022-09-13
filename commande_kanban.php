

<a href="BO.php">Back Office</a>

<?php

include_once("_include.php");
include_once("_check_admin.php");



$db = new DB();
$pdo = $db->getDB();


if(!isset($_GET["limit"])){
    $_GET["limit"] = 0;
}

$stmt = $pdo->prepare("SELECT idcommande FROM commande 
INNER JOIN etat ON etat.idetat = commande.idetat
WHERE libelle = 'attente de paiement' LIMIT :limit_min, 25");
$stmt->bindParam(":limit_min", $_GET["limit"], PDO::PARAM_INT);
$stmt->execute();

$stmt2 = $pdo->prepare("SELECT idcommande FROM commande 
INNER JOIN etat ON etat.idetat = commande.idetat
WHERE libelle = 'envoyée' LIMIT :limit_min, 25");
$stmt2->bindParam(":limit_min", $_GET["limit"], PDO::PARAM_INT);
$stmt2->execute();



$tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>"."Attente de Paiement"."</th>";
    $tableau.= "<th>"."Envoyée"."</th>";
    $tableau.= "<th>"."En préparation"."</th>";
  
 
    $tableau.= "<th>"."Perdue"."</th>";

    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= "commande" . " " . $row["idcommande"];
        
        $tableau.= "</td>";
       
        $tableau.= "</tr>";
        
}

        

    
    $tableau.= "</table>";
    
    echo $tableau;

 

    $stmtPagination = $pdo->prepare("SELECT count(*) as nb FROM commande ");
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
<a href='commande_kanban.php?limit=<?php echo $limitMin; ?>'>page précédente</a> ||| <a href='commande_kanban.php?limit=<?php echo $limitMax; ?>'>page suivante</a>