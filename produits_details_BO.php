<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Détail produit</title>
</head>
<body>
    
</body>
</html>


<center><h1>Détails produit</h1></center>


<?php
include_once("_include.php");
include_once("_check_admin.php");


$db = new DB();
$pdo = $db->getDB();

$stmt = $pdo->prepare("SELECT produit_commande.idproduit, nom, prix, count(produit_commande.idcommande) AS NBproduit FROM produit_commande
INNER JOIN commande ON commande.idcommande = produit_commande.idcommande
INNER JOIN produit ON produit.idproduit = produit_commande.idproduit WHERE produit.idproduit = :idproduit");
$stmt->bindParam(':idproduit', $_GET["idproduit"]);
$stmt->execute();
$result = $stmt->fetch();
?>

<div class="text-center" action="produits_details_BO.php" method="">

<?php echo "<img src='public/assets/images/produits/".$result["idproduit"].".jpg'  width='150' height='150'/>"?>             


<div>
<?php echo "<b>".ucfirst(LANGUE["nom"])."</b> ".$result["nom"] ?>
</div>

<div>
<?php echo "<b>".ucfirst(LANGUE["prix"])."</b> ".$result["prix"] .'€'?>
</div>

<div>
<?php echo "<b>"."Nombre de commande avec ce produit"."</b> ". $result["NBproduit"]?>
</div>

</div>



<center><a href="produits.php">Retour liste des produits</a></center>

