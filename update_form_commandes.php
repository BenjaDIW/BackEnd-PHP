<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

if(isset($_GET["idcommande"])){
    $stmt = $pdo->prepare("SELECT *
                    FROM commande WHERE idcommande = :idcommande");
    $stmt->bindParam(':idcommande', $_GET["idcommande"]);
    $stmt->execute();
    $resultat = $stmt->fetch();}

$stmtLibelle = $pdo->prepare("SELECT * FROM etat");
$stmtLibelle->execute();

?>

<a href="commandes.php"><?php echo ucfirst(LANGUE["commandes"]); ?></a>

<form action="update_commandes.php" method="GET">
            <div>
                <input type="hidden" id="idcommande" name="idcommande" value="<?php echo $resultat['idcommande']; ?>">
            </div>
            

            <div>
                <label for="idetat"><?php echo ucfirst(LANGUE["libelle"]); ?>:</label>
                <select name="idetat">
                <?php
                    $liste = "";
                    foreach($stmtLibelle->fetchAll() as $row){
                        $liste .= "<option value='".$row['idetat']."'";
                        
                        // On sélectionne l'abonnement qui de l'abonné
                        if($resultat['idetat'] == $row["idetat"]){
                            $liste .= " selected";
                        }
                        $liste .= ">";

                        $liste .=$row['libelle'];
                        $liste .= "</option>";
                    }
                    echo $liste;
                ?>
                </select>
            </div>

            <input type="submit" value="Submit" />
        </form>
