<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Ajouter produit</title>
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
        var prix = document.getElementById("prix").value;
        // Récupérer l'idabonnement
        
        
        // var url = 'abonne_ajouter_ajax.php?nom=' + nom + '&prenom=' + prenom + '&idabonnement=' + idabonnement;
        // On créer un objet de type XMLHttpRequest
        let xhr = new XMLHttpRequest();
        // Il va intéroger la page test_ajax_server.php en GET
        // xhr.open('GET', url);
        xhr.open('GET', 'add_produits_ajax.php?nom=' + nom + '&prix=' + prix);
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

<a href="produits.php">Retour produits</a>


<h2><?php echo ucfirst(LANGUE["ajouter"]); ?> Produit </h2>

<?php
$db = new DB();
$pdo = $db->getDB();
    $stmt = $pdo->prepare("SELECT * FROM produit");
    $stmt->execute();

    
?>
<form form action="add_produits_ajax.php" method="GET">
    <div>
        <label for="nom"><?php echo ucfirst(LANGUE["nom"]); ?> :</label>
        <input type="text" id="nom" name="nom">
    </div>
    <div>
        <label for="prix"><?php echo ucfirst(LANGUE["prix"]); ?> :</label>
        <input type="text" id="prix" name="prix">
    </div>
       
    <div>
        <button type="button" onclick="functionAjax()">Submit</button>
    </div>

    <div id="result"></div>
</form>