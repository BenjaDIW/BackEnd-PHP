<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Détails client</title>
</head>
<body>
    
</body>
</html>


<center><h1>Détails client</h1></center>


<?php
include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();


$stmt = $pdo->prepare("SELECT idclient, nom, email, telephone FROM client WHERE idclient = :idclient");
$stmt->bindParam(':idclient', $_GET["idclient"]);
$stmt->execute();
$result = $stmt->fetch();

$stmtAdresse = $pdo->prepare("SELECT idclient, pays, ville, adresse FROM  adresse 
INNER JOIN client ON adresse.idadresse = client.idadresse WHERE idclient = :idclient");
$stmtAdresse->bindParam(':idclient', $_GET["idclient"]);
$stmtAdresse->execute();
$resultAdresse = $stmtAdresse->fetch();

$stmtLibelle = $pdo->prepare("SELECT libelle FROM role INNER JOIN client ON client.idrole = role.idrole WHERE idclient = :idclient");
$stmtLibelle->bindParam(':idclient', $_GET["idclient"]);
$stmtLibelle->execute();
$resultLibelle = $stmtLibelle->fetch();

$stmtLast = $pdo->prepare("SELECT commande.idcommande, date, nom, qte FROM commande
INNER JOIN produit_commande ON produit_commande.idcommande = commande.idcommande INNER JOIN produit ON produit.idproduit = produit_commande.idproduit
WHERE idclient = :idclient ORDER BY date DESC");
$stmtLast->bindParam(':idclient', $_GET["idclient"]);
$stmtLast->execute();
$resultLast = $stmtLast->fetch();


$stmtNB = $pdo->prepare("SELECT count(*) AS NB FROM commande WHERE idclient = :idclient;");
$stmtNB->bindParam(':idclient', $_GET["idclient"]);
$stmtNB->execute();
$resultNB = $stmtNB->fetch();



$stmtAVG = $pdo->prepare("SELECT AVG(qte) AS AVG FROM produit_commande 
INNER JOIN commande ON commande.idcommande = produit_commande.idcommande
WHERE commande.idclient = :idclient");
$stmtAVG->bindParam(':idclient', $_GET["idclient"]);
$stmtAVG->execute();
$resultAVG = $stmtAVG->fetch();


?>

<div class="text-center" action="clients_details_BO.php" method="GET">

<?php echo "<img src='public/assets/images/clients/".$result["idclient"].".jpg'  width='150' height='150'/>"?>          


<div>
<?php echo "<b>"."idclient"."</b> ".$result["idclient"] ?>
</div>

<div>
<?php echo "<b>"."nom"."</b> ".$result["nom"]?>
</div>

<div>
<?php echo "<b>"."email"."</b> ".$result["email"] ?>
</div>

<div>
<?php echo "<b>"."telephone"."</b> ".$result["telephone"] ?>
</div>


<div>
<?php echo "<b>"."pays"."</b> ".$resultAdresse["pays"]?>
</div>


<div>
<?php echo "<b>"."ville"."</b> ".$resultAdresse["ville"] ?>
</div>

<div>
<?php echo "<b>"."adresse"."</b> ".$resultAdresse["adresse"] ?>
</div>

<div>
<?php echo "<b>"."libelle"."</b> ".$resultLibelle["libelle"] ?>
</div>



<div>
<?php echo "<b>"."ID dernière commande"."</b> ".$resultLast["idcommande"]?>
</div>
<div>
<?php echo "<b>"."Date de la dernière commande"."</b> ".$resultLast["date"]?>
</div>
<div>
<?php echo "<b>"."Contenu de la dernière commande"."</b> ".$resultLast["nom"] . " " . "<b>"."Quantité"."</b> " .$resultLast["qte"] ?>
</div>




<div>
<?php echo "<b>"."Nombre de commande"."</b> ".$resultNB['NB'];?>
</div>

<div>
<?php echo "<b>"."Volume Moyen"."</b> ".$resultAVG["AVG"]?>
</div>

</div>

<center><a href="clients.php">Retour liste des clients</a></center>