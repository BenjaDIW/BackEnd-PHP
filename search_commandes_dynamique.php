<?php
include_once("_include.php");
include_once("_check_admin.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new DB();
$pdo = $db->getDB();

if(isset($_GET['recherche'])){
    $stmt = $pdo->prepare("SELECT idcommande, idclient, date, libelle FROM commande INNER JOIN etat ON etat.idetat = commande.idetat WHERE date LIKE CONCAT('%', :date, '%') ");
  $stmt->bindParam(':date', $_GET["recherche"]);
$stmt->execute();



$tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idcommande"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["idclient"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["date"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["libelle"])."</th>"; 
    $tableau.= "<th>".ucfirst(LANGUE["modifier"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["supprimer"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= $row["idcommande"];
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["idclient"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["date"]."</td>";
        
        $tableau.= "<td>".$row["libelle"]."</td>";

         

        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='update_form_commandes.php?idcommande=".$row["idcommande"]."'>";
        $tableau.= ucfirst(LANGUE["modifier"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "<td id='result_".$row["idcommande"]."'>";
        $tableau.= "<button type='button' onclick='functionAjaxCommande(" . $row["idcommande"] . ")'>";
        $tableau.= ucfirst(LANGUE["supprimer"]);
        $tableau.= "</button>";        
        $tableau.= "</tr>";
    }
    $tableau.= "</table>";
    echo $tableau;

}