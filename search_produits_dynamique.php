



<?php
include_once("_include.php");
include_once("_check_admin.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new DB();
$pdo = $db->getDB();
if(isset($_GET['recherche'])){
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE  lower(nom) LIKE  lower(CONCAT('%', :nom, '%'))  
    ORDER BY nom ASC 
    ");
  $stmt->bindParam(':nom', $_GET["recherche"]);
$stmt->execute();

$tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idproduit"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["nom"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["prix"])."</th>";
  
 
    $tableau.= "<th>".ucfirst(LANGUE["modifier"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["supprimer"])."</th>";

    $tableau.= "<th>".ucfirst(LANGUE["détails"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= $row["idproduit"];
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["nom"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["prix"]."€"."</td>";
        
  

        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='update_form_produit.php?idproduit=".$row["idproduit"]."'>";
        $tableau.= ucfirst(LANGUE["modifier"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "<td id='result_".$row["idproduit"]."'>";
        $tableau.= "<button type='button' onclick='functionAjax2(" . $row["idproduit"] . ")'>";
        $tableau.= ucfirst(LANGUE["supprimer"]);
        $tableau.= "</button>";   
        
        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='produits_details_BO.php?idproduit=".$row["idproduit"]."'>";
        $tableau.= ucfirst(LANGUE["détails"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";


        $tableau.= "</tr>";
    }
    $tableau.= "</table>";
    
    echo $tableau;

}