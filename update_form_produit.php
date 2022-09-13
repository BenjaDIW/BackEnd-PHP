<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

if(isset($_GET["idproduit"])){
    $stmt = $pdo->prepare("SELECT *
                    FROM produit WHERE idproduit = :idproduit");
    $stmt->bindParam(':idproduit', $_GET["idproduit"]);
    $stmt->execute();
    $resultat = $stmt->fetch();}


?>

<a href="produits.php"><?php echo ucfirst(LANGUE["produits"]); ?></a>

<form action="update_produits.php" method="GET">
            <div>
                <input type="hidden" id="idproduit" name="idproduit" value="<?php echo $resultat['idproduit']; ?>">


                <label for="nom"><?php echo ucfirst(LANGUE["nom"]); ?> :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $resultat['nom']; ?>">
            </div>
            <div>
                <label for="prix "><?php echo ucfirst(LANGUE["prix"]); ?> :</label>
                <input type="text" id="prix" name="prix" value="<?php echo $resultat['prix']; ?>">€
            </div>

            <input type="submit" value="Submit" />
           

</form>