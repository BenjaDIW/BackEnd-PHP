<?php
include_once("_include.php");
include_once("_check_admin.php");


$db = new DB();
$pdo = $db->getDB();

if(isset($_GET["nom"]) && isset($_GET["email"]) && isset($_GET["telephone"]) && isset($_GET["idrole"])){
    // On fait l'insert ici
    $stmt = $pdo->prepare("INSERT INTO client (nom, email,telephone, idrole) VALUES (:nom, :email, :telephone, :idrole)");
    $stmt->bindParam(':nom', $_GET["nom"]);
    $stmt->bindParam(':email', $_GET["email"]);
    $stmt->bindParam(':telephone', $_GET["telephone"]);
    $stmt->bindParam(':idrole', $_GET["idrole"]);

    $stmt->execute();
    echo "Client ajouté !";
}
else{
    echo "Merci de saisir des données !";
}