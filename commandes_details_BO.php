<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Détail commande</title>
</head>
<body>
    
</body>
</html>


<center><h1>Détails commande</h1></center>


<?php
include_once("_include.php");
include_once("_check_admin.php");


$db = new DB();
$pdo = $db->getDB();



$stmt = $pdo->prepare("SELECT idcommande, commande.idclient, nom, date, libelle FROM commande 
INNER JOIN client ON client.idclient = commande.idcommande 
INNER JOIN etat ON etat.idetat = commande.idetat
WHERE idcommande = :idcommande");
$stmt->bindParam(':idcommande', $_GET["idcommande"]);
$stmt->execute();
$result = $stmt->fetch();
?>

<div class="text-center" action="commandes_details_BO.php" method="">

<div>
<?php echo "<b>".ucfirst(LANGUE["idcommande"])."</b> ".$result["idcommande"] ?>
</div>

<div>
<?php echo "<b>".ucfirst(LANGUE["idclient"])."</b> ".$result["idclient"] ?>
</div>

<div>
<?php echo "<b>".ucfirst(LANGUE["nom"])."</b> ".$result["nom"]?>
</div>

<div>
<?php echo "<b>".ucfirst(LANGUE["date"])."</b> ".$result["date"]?>
</div>

<div>
<?php echo "<b>".ucfirst(LANGUE["libelle"])."</b> ".$result["libelle"]?>
</div>

</div>



<center><a href="commandes.php">Retour liste des commandes</a></center>

