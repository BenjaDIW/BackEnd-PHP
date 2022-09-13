<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();

if(isset($_GET["idclient"])){
    $stmt = $pdo->prepare("SELECT *
                    FROM client WHERE idclient = :idclient");
    $stmt->bindParam(':idclient', $_GET["idclient"]);
    $stmt->execute();
    $resultat = $stmt->fetch();}

$stmtAdresse = $pdo->prepare("SELECT * FROM adresse");
$stmtAdresse->execute();
$resultatAdresse = $stmtAdresse->fetch();


$stmtRole = $pdo->prepare("SELECT * FROM role");
$stmtRole->execute();



?>
<a href="clients.php"><?php echo ucfirst(LANGUE["clients"]); ?></a>

<form action="update_clients.php" method="GET">
            <div>
                <input type="hidden" id="idclient" name="idclient" value="<?php echo $resultat['idclient']; ?>">


                <label for="nom"><?php echo ucfirst(LANGUE["nom"]); ?> :</label>
                <input type="text" id="nom" name="nom" value="<?php echo $resultat['nom']; ?>">
            </div>
            <div>
                <label for="email "><?php echo ucfirst(LANGUE["email"]); ?> :</label>
                <input type="email" id="email" name="email" value="<?php echo $resultat['email']; ?>">
            </div>

            <div>
                <label for="telephone "><?php echo ucfirst(LANGUE["telephone"]); ?> :</label>
                <input type="tel" id="telephone" name="telephone" value="<?php echo $resultat['telephone']; ?>">
            </div>

            <div>
                <label for="ville ">Ville :</label>
                <input type="text" id="ville" name="ville" value="<?php echo $resultatAdresse['ville']; ?>">
            </div>

            <div>
                <label for="pays ">Pays :</label>
                <input type="text" id="pays" name="pays" value="<?php echo $resultatAdresse['pays']; ?>">
            </div>


            <div>
                <label for="adresse"><?php echo ucfirst(LANGUE["adresse"]); ?>:</label>
                <input type="text" id="adresse" name="adresse" value="<?php echo $resultatAdresse['adresse']; ?>">
                <!-- <select name="idadresse"> -->
                <?php
                    // $liste = "";
                    // foreach($stmtAdresse->fetchAll() as $row){
                    //     $liste .= "<option value='".$row['idadresse']."'";
                        
                    //     // On sélectionne l'abonnement qui de l'abonné
                    //     if($resultat['idadresse'] == $row["idadresse"]){
                    //         $liste .= " selected";
                    //     }
                    //     $liste .= ">";

                    //     $liste .= $row['ville']." | ".$row['pays']. " | " .$row['adresse'];
                    //     $liste .= "</option>";
                    // }
                    // echo $liste;
                ?>
                <!-- </select> -->
            </div>


            <div>
                <label for="idrole"><?php echo ucfirst(LANGUE["role"]); ?>:</label>
                <select name="idrole">
                <?php
                    $liste = "";
                    foreach($stmtRole->fetchAll() as $row){
                        $liste .= "<option value='".$row['idrole']."'";
                        
                        // On sélectionne l'abonnement qui de l'abonné
                        if($resultat['idrole'] == $row["idrole"]){
                            $liste .= " selected";
                        }
                        $liste .= ">";
                        $liste .= $row['libelle'];
                        $liste .= "</option>";
                        
                        
                    }
                    echo $liste;
                ?>
                </select>
            </div>
            <input type="submit" value="Submit" />
        </form>