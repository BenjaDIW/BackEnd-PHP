<?php
include_once("_include.php");

session_start();


$db = new DB();
$pdo = $db->getDB();


$stmt = $pdo->prepare("INSERT INTO client (nom, telephone, email, password, cle) VALUES (:nom, :telephone, :email, :password, :cle)");


$cle=(rand(1000000, 1000000000));

$password = sha1("ifocop_diw_2022".sha1($cle).$_POST['password']);


$stmt->bindParam(':nom', $_POST['nom']);
$stmt->bindParam(':telephone', $_POST['tel']);
$stmt->bindParam(':email', $_POST['email']);
$stmt->bindParam(':password', $password);
$stmt->bindParam(':cle', $cle);

$stmt->execute();

header('Location: inscription.php');