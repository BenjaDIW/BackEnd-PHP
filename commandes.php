<script type="text/javascript">
    function functionAjax(idcommande){
       
        let xhr = new XMLHttpRequest();
      
        xhr.open('GET', 'delete.commandes.php?idcommande='+idcommande);
       
        xhr.onreadystatechange = function () {
            const DONE = 4;
            const OK = 200;
            
            if (xhr.readyState === DONE) {
               
                if (xhr.status === OK) {
                    document.getElementById("result_"+idcommande).innerHTML = "supprimé";
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

<a href="search_commandes.php">Rechercher une commande</a>

<a href="add_commandes.php">Ajouter une commande</a>
 

<a href="commande_kanban.php">Etat des commandes</a>


<?php

include_once("_include.php");
include_once("_check_admin.php");

$db = new DB();
$pdo = $db->getDB();


if(!isset($_GET["limit"])){
    $_GET["limit"] = 0;
}

$stmt = $pdo->prepare("SELECT idcommande, idclient, date, libelle FROM commande INNER JOIN etat ON etat.idetat = commande.idetat ORDER BY idcommande LIMIT :limit_min, 25");
$stmt->bindParam(":limit_min", $_GET["limit"], PDO::PARAM_INT);

$stmt->execute();

$tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idcommande"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["idclient"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["date"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["libelle"])."</th>"; 
    $tableau.= "<th>".ucfirst(LANGUE["modifier"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["supprimer"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["détails"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= $row["idcommande"];
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["idclient"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["date"]."</td>";
        
        $tableau.= "<td>".$row["libelle"]."</td>";

         

        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='update_form_commandes.php?idcommande=".$row["idcommande"]."'>";
        $tableau.= ucfirst(LANGUE["modifier"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "<td id='result_".$row["idcommande"]."'>";
        $tableau.= "<button type='button' onclick='functionAjax(" . $row["idcommande"] . ")'>";
        $tableau.= ucfirst(LANGUE["supprimer"]);
        $tableau.= "</button>"; 
        
        
        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='commandes_details_BO.php?idcommande=".$row["idcommande"]."'>";
        $tableau.= ucfirst(LANGUE["détails"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";


        $tableau.= "</tr>";


    }
    $tableau.= "</table>";
    
    echo $tableau;

    $stmtPagination = $pdo->prepare("SELECT count(*) as nb FROM commande ");
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
<a href='commandes.php?limit=<?php echo $limitMin; ?>'>page précédente</a> ||| <a href='commandes.php?limit=<?php echo $limitMax; ?>'>page suivante</a>