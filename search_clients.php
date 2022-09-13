<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="stylesheet" href="public\assets\bootstrap-4.5.3-dist\css\bootstrap.min.css"/>
    <title>Recherche client</title>
</head>
<body>
    
</body>
</html>

<script type="text/javascript">
    function functionAjaxClient(idclient){
       
        let xhr = new XMLHttpRequest();
      
        xhr.open('GET', 'delete.clients.php?idclient='+idclient);
       
        xhr.onreadystatechange = function () {
            const DONE = 4;
            const OK = 200;
            
            if (xhr.readyState === DONE) {
               
                if (xhr.status === OK) {
                    document.getElementById("result_"+idclient).innerHTML = "supprimé";
                }
                else{
                    
                    alert("erreur "+xhr.status);
                }
            }
        };
        
        xhr.send();
    }




    function functionAjax(){
        var recherche = document.getElementById("recherche").value;
        
        // Si le nombre de caractères est inférieur à 3, pour éviter de faire des recherches lourdes et longues, on n'appelle pas la page abonne_recherche_dynamique.php
        if (recherche.length < 2) {
            document.getElementById("resultats").innerHTML = "Saisir au moins 2 caractères.";
        } else {
            let xhr = new XMLHttpRequest();
            xhr.open('GET', 'search_clients_dynamique.php?recherche='+recherche);
            xhr.onreadystatechange = function () {
                const DONE = 4;
                const OK = 200;
                if (xhr.readyState === DONE) {
                    if (xhr.status === OK) {
                        document.getElementById("resultats").innerHTML = xhr.responseText;
                    }
                    else{
                        document.getElementById("resultats").innerHTML = xhr.status;
                    }
                }
            };
            xhr.send();   
        }
    }
</script>

<?php
include_once("_include.php");
include_once("_check_admin.php");


?>


<!-- <form>
    <div>
        <label for="recherche"><?php echo ucfirst(LANGUE["recherche"]); ?> :</label>
        <input type="text" id="recherche" name="recherche" oninput="functionAjax()">
    </div>
</form> -->

<a href="BO.php">Back Office</a>


<h2><?php echo ucfirst(LANGUE["recherche"]); ?> client</h2>

    

<form>
          
            <div class="form-group ">
            <label for="recherche"><?php echo ucfirst(LANGUE["recherche"]); ?></label>
            <input type="text" id="recherche" name="recherche" oninput="functionAjax()">
           
</div>
</form>



<div id="resultats"></div>