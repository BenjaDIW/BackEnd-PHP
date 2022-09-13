<script type="text/javascript">
    function functionAjax(idclient){
       
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
</script>

<a href="BO.php">Back Office</a>

<a href="search_clients.php">Rechercher un client</a>

<a href="add_clients.php">Ajouter un client</a>

<?php

include_once("_include.php");
include_once("_check_admin.php");



$db = new DB();
$pdo = $db->getDB();


if(!isset($_GET["limit"])){
    $_GET["limit"] = 0;
}

$stmt = $pdo->prepare("SELECT idclient, nom, email, telephone, idadresse, idrole FROM client LIMIT :limit_min, 25");
$stmt->bindParam(":limit_min", $_GET["limit"], PDO::PARAM_INT);

$stmt->execute();




    $tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idclient"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["nom"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["email"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["telephone"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["idadresse"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["idrole"])."</th>";
 
    $tableau.= "<th>".ucfirst(LANGUE["modifier"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["supprimer"])."</th>";

    $tableau.= "<th>".ucfirst(LANGUE["détails"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= $row["idclient"];
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["nom"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["email"]."</td>";
        
        $tableau.= "<td>".$row["telephone"]."</td>";

        $tableau.= "<td>"."<center>".$row["idadresse"]."</center>"."</td>";

        $tableau.= "<td>"."<center>".$row["idrole"]."<center>"."</td>";

   

        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='update_form_clients.php?idclient=".$row["idclient"]."'>";
        $tableau.= ucfirst(LANGUE["modifier"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "<td id='result_".$row["idclient"]."'>";
        $tableau.= "<button type='button' onclick='functionAjaxClient(" . $row["idclient"] . ")'>";
        $tableau.= ucfirst(LANGUE["supprimer"]);
        $tableau.= "</button>";
        
        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='clients_details_BO.php?idclient=".$row["idclient"]."'>";
        $tableau.= ucfirst(LANGUE["détails"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";


        $tableau.= "</tr>";
    }
    $tableau.= "</table>";
    
    echo $tableau;

    $stmtPagination = $pdo->prepare("SELECT count(*) as nb FROM client ");
    $stmtPagination->execute();
    $resultat = $stmtPagination->fetch();

    $limitMin = $_GET["limit"]-25;
    $limitMax = $_GET["limit"]+25;

    if($limitMin < 0){
        $limitMin = 0;
    }
    if($limitMax >= $resultat['nb']){
        $limitMax = $resultat['nb']-1;
    }


    ?>

<br/>
<a href='clients.php?limit=<?php echo $limitMin; ?>'>page précédente</a> ||| <a href='clients.php?limit=<?php echo $limitMax; ?>'>page suivante</a>