<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Ajouter client</title>
</head>
<body>
    
</body>
</html>

<script type="text/javascript">
    function functionAjax(){
        // On récupère les valeurs du formulaire
        // Récupérer le nom
        var nom = document.getElementById("nom").value;
        // Récupérer le prenom
        var email = document.getElementById("email").value;
        // Récupérer l'idabonnement
        var telephone = document.getElementById("telephone").value;
        var idrole = document.getElementById("idrole").value;
        
        // var url = 'abonne_ajouter_ajax.php?nom=' + nom + '&prenom=' + prenom + '&idabonnement=' + idabonnement;
        // On créer un objet de type XMLHttpRequest
        let xhr = new XMLHttpRequest();
        // Il va intéroger la page test_ajax_server.php en GET
        // xhr.open('GET', url);
        xhr.open('GET', 'add_clients_ajax.php?nom=' + nom + '&email=' + email + '&telephone=' + telephone + '&idrole=' + idrole);
        // xhr.open('GET', 'abonne_ajouter_ajax.php?nom='+nom);
        // On va récupérer le contenu / réponse après l'exécution de la page
        xhr.onreadystatechange = function () {
            
        // alert("function");
            const DONE = 4;
            const OK = 200;
            // La requête a été exécutée xhr.open('GET', 'abonne_ajouter_ajax.php');
            if (xhr.readyState === DONE) {
                // Si la réponse est 200 donc un succès https://developer.mozilla.org/en-US/docs/Web/HTTP/Status
                if (xhr.status === OK) {
                    document.getElementById("result").innerHTML = xhr.responseText;
                }
                else{
                    // en cas d'erreur on affiche le message d'erreur dans le div result
                    document.getElementById("result").innerHTML = xhr.status;
                }
            }
        };
        // On envoie la requête
        xhr.send();
    }
</script>

<?php
// $page = "BO";
include_once("_include.php");
include_once("_check_admin.php");


?>
<a href="BO.php">Back Office</a>

<a href="clients.php">Retour liste des clients</a>


<h2><?php echo ucfirst(LANGUE["ajouter"]); ?> Client </h2>

<?php

$db = new DB();
$pdo = $db->getDB();
    $stmt = $pdo->prepare("SELECT * FROM client");
    $stmt->execute();

    $stmtLibelle = $pdo->prepare("SELECT * FROM role");
    $stmtLibelle->execute();
?>
<form form action="add_clients_ajax.php" method="GET">
    <div>
        <label for="nom"><?php echo ucfirst(LANGUE["nom"]); ?> :</label>
        <input type="text" id="nom" name="nom">
    </div>
    <div>
        <label for="email"><?php echo ucfirst(LANGUE["email"]); ?> :</label>
        <input type="email" id="email" name="email">
    </div>
    <div>
        <label for="telephone"><?php echo ucfirst(LANGUE["telephone"]); ?> :</label>
        <input type="tel" id="telephone" name="telephone">
    </div>


    <div>
                <label for="idrole"><?php echo ucfirst(LANGUE["libelle"]); ?>:</label>
                <select name="idrole">
                <?php
                    $liste = "";
                    foreach($stmtLibelle->fetchAll() as $row){
                        $liste .= "<option value='".$row['idrole']."'";
                        
                        // On sélectionne l'abonnement qui de l'abonné
                        
                        $liste .= ">";

                        $liste .= $row['libelle'];
                        $liste .= "</option>";
                    }
                    echo $liste;
                ?>
                </select>
            </div>
   
    <div>
        <button type="button" onclick="functionAjax()">Submit</button>
    </div>

    <div id="result"></div>
</form>