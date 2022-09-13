<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

$stmtUpdate = $pdo->prepare("UPDATE commande SET 
                               
                                idetat = :idetat
                                WHERE idcommande = :idcommande");

$stmtUpdate->bindParam(':idetat', $_GET["idetat"]);
$stmtUpdate->bindParam(':idcommande', $_GET["idcommande"]);

$stmtUpdate->execute();


header('Location: commandes.php');




?>