


<?php
include_once("_include.php");
include_once("_check_admin.php");

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$db = new DB();
$pdo = $db->getDB();

if(isset($_GET['recherche'])){
    $stmt = $pdo->prepare("SELECT idclient, nom, email, telephone, idadresse, idrole
                            FROM client
                            
                            WHERE lower(nom) LIKE lower(CONCAT('%', :nom, '%'))
                            ORDER BY nom ASC 
                            ");
    $stmt->bindParam(':nom', $_GET["recherche"]);
   
    $stmt->execute();




    $tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idclient"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["nom"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["email"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["telephone"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["idadresse"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["idrole"])."</th>";
 
    $tableau.= "<th>".ucfirst(LANGUE["modifier"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["supprimer"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["détails"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= $row["idclient"];
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["nom"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["email"]."</td>";
        
        $tableau.= "<td>".$row["telephone"]."</td>";

        $tableau.= "<td>"."<center>".$row["idadresse"]."</center>"."</td>";

        $tableau.= "<td>"."<center>".$row["idrole"]."<center>"."</td>";

   

        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='update_form_clients.php?idclient=".$row["idclient"]."'>";
        $tableau.= ucfirst(LANGUE["modifier"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "<td id='result_".$row["idclient"]."'>";
        $tableau.= "<button type='button' onclick='functionAjaxClient(" . $row["idclient"] . ")'>";
        $tableau.= ucfirst(LANGUE["supprimer"]);
        $tableau.= "</button>"; 
        
        
        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='clients_details_BO.php?idclient=".$row["idclient"]."'>";
        $tableau.= ucfirst(LANGUE["détails"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "</tr>";
    }
    $tableau.= "</table>";
    
    echo $tableau;


}