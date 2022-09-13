<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

$stmtUpdate = $pdo->prepare("UPDATE client SET 
                                nom = :nom, 
                                email = :email, 
                                telephone = :telephone,
                                idadresse = :idadresse,
                                idrole = :idrole
                                WHERE idclient = :idclient");

$stmtUpdate->bindParam(':nom', $_GET["nom"]);
$stmtUpdate->bindParam(':email', $_GET["email"]);
$stmtUpdate->bindParam(':telephone', $_GET["telephone"]);
$stmtUpdate->bindParam(':idadresse', $_GET["idadresse"]);
$stmtUpdate->bindParam(':idrole', $_GET["idrole"]);
$stmtUpdate->bindParam(':idclient', $_GET["idclient"]);
$stmtUpdate->execute();

header('Location: clients.php');







?>



