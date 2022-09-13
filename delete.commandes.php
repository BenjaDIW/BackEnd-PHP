<?php
include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

$stmt = $pdo->prepare("DELETE FROM commande WHERE idcommande = :idcommande");
$stmt->bindParam(':idcommande', $_GET["idcommande"]);
$stmt->execute();
?>