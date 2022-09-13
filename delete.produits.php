<?php
include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

$stmt = $pdo->prepare("DELETE FROM produit WHERE idproduit = :idproduit");
$stmt->bindParam(':idproduit', $_GET["idproduit"]);
$stmt->execute();
?>