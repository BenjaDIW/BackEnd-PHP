<?php
include_once("_include.php");

session_start();


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new DB();
$pdo = $db->getDB();

if(isset($_GET['recherche'])){
    $stmt = $pdo->prepare("SELECT * FROM produit WHERE lower(nom) LIKE lower(CONCAT('%', :nom, '%'))  
    ORDER BY nom ASC 
    ");
  $stmt->bindParam(':nom', $_GET["recherche"]);
$stmt->execute();

$tableau ="<center>" ."<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idproduit"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["nom"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["prix"])."</th>";
  
 

    $tableau.= "<th>".ucfirst(LANGUE["détails"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= "<a href='produits_details.php?idproduit=".$row['idproduit']."'>"  ."<img src='public/assets/images/produits/".$row["idproduit"].".jpg'  width='50' height='50'/>".    "</a>";
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["nom"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["prix"]."€"."</td>";       
        
        $tableau.= "<td>";
 
        $tableau.= "<a class='btn btn-info' role='button' href='produits_details.php?idproduit=".$row["idproduit"]."'>";
        $tableau.= ucfirst(LANGUE["détails"]);
        $tableau.= "</a>";
       
        $tableau.= "</td>";

        $tableau.= "<td>"."<a href='addPanier.php' class='btn btn-success' role='button'>Ajouter</a>"."</td>";



        $tableau.= "</tr>";
    }
    $tableau.= "</table>". "</center>";
    
    echo $tableau;

}