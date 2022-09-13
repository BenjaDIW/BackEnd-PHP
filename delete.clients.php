<?php
include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

$stmt = $pdo->prepare("DELETE FROM client WHERE idclient = :idclient");
$stmt->bindParam(':idclient', $_GET["idclient"]);
$stmt->execute();
?>