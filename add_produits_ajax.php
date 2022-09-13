<?php
include_once("_include.php");
include_once("_check_admin.php");


$db = new DB();
$pdo = $db->getDB();

if(isset($_GET["nom"]) && isset($_GET["prix"])){
    // On fait l'insert ici
    $stmt = $pdo->prepare("INSERT INTO produit (nom, prix) VALUES (:nom, :prix)");
    $stmt->bindParam(':nom', $_GET["nom"]);
    $stmt->bindParam(':prix', $_GET["prix"]);
   

    $stmt->execute();
    echo "Produit ajouté !";
}
else{
    echo "Merci de saisir des données !";
}