<?php
include_once("_include.php");
include_once("_check_admin.php");


$db = new DB();
$pdo = $db->getDB();

if(isset($_GET["idclient"]) && isset($_GET["date"]) && isset($_GET["idetat"])){
    // On fait l'insert ici
    $stmt = $pdo->prepare("INSERT INTO commande (idclient, date, idetat) VALUES (:idclient, :date, :idetat)");
    $stmt->bindParam(':idclient', $_GET["idclient"]);
    $stmt->bindParam(':date', $_GET["date"]);
    $stmt->bindParam(':idetat', $_GET["idetat"]);
   

    $stmt->execute();
    echo "Commande ajoutée !";
}
else{
    echo "Merci de saisir des données !";
}