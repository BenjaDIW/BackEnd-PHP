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

session_start();
$db = new DB();
$pdo = $db->getDB();


$stmt = $pdo->prepare("SELECT * FROM produit WHERE idproduit = :idproduit");
$stmt->bindParam(':idproduit', $_GET["idproduit"]);
$stmt->execute();
$result = $stmt->fetch();
?>

<div class="text-center" action="produits_details.php" method="">

<?php echo "<img src='public/assets/images/produits/".$result["idproduit"].".jpg'  width='150' height='150'/>"?>          


<div>
<?php echo "<b>".ucfirst(LANGUE["nom"])."</b> ".$result["nom"] ?>
</div>

<div>
<?php echo "<b>".ucfirst(LANGUE["prix"])."</b> ".$result["prix"] .'€'?>
</div>

<div>
<?php echo "Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perspiciatis, ad." ?>
</div>


</div>



<center><a href="boutique.php"><?php echo ucfirst(LANGUE["boutique"]); ?></a></center>

