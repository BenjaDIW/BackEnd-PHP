<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

$stmtUpdate = $pdo->prepare("UPDATE produit SET 
                                nom = :nom, 
                                prix = :prix
                                WHERE idproduit = :idproduit");

$stmtUpdate->bindParam(':nom', $_GET["nom"]);
$stmtUpdate->bindParam(':prix', $_GET["prix"]);
$stmtUpdate->bindParam(':idproduit', $_GET["idproduit"]);
$stmtUpdate->execute();

header('Location: produits.php');







?>