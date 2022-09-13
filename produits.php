<script type="text/javascript">
    function functionAjaxProduit(idproduit){
       
        let xhr = new XMLHttpRequest();
      
        xhr.open('GET', 'delete.produits.php?idproduit='+idproduit);
       
        xhr.onreadystatechange = function () {
            const DONE = 4;
            const OK = 200;
            
            if (xhr.readyState === DONE) {
               
                if (xhr.status === OK) {
                    document.getElementById("result_"+idproduit).innerHTML = "supprimé";
                }
                else{
                    
                    alert("erreur "+xhr.status);
                }
            }
        };
        
        xhr.send();
    }
</script>
<?php

include_once("_include.php");
include_once("_check_admin.php");

?>

<a href="BO.php">Back Office</a>

<a href="add_produits.php">Ajouter produit</a>

<a href="search_produits.php"><?php echo ucfirst(LANGUE["recherche"]); ?> <?php echo ucfirst(LANGUE["produit"]); ?></a>

<?php

$db = new DB();
$pdo = $db->getDB();



if(!isset($_GET["limit"])){
    $_GET["limit"] = 0;
}


$stmt = $pdo->prepare("SELECT * FROM produit ORDER BY idproduit LIMIT :limit_min, 25");
$stmt->bindParam(":limit_min", $_GET["limit"], PDO::PARAM_INT);
$stmt->execute();


    $tableau = "<table>";
    $tableau.= "<tr>";
    $tableau.= "<th>".ucfirst(LANGUE["idproduit"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["nom"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["prix"])."</th>";
  
 
    $tableau.= "<th>".ucfirst(LANGUE["modifier"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["supprimer"])."</th>";
    $tableau.= "<th>".ucfirst(LANGUE["détails"])."</th>";
    $tableau.= "</tr>";
    
    foreach($stmt->fetchAll() as $row){
        $tableau.= "<tr>";
        $tableau.= "<td>";
      
        $tableau.= $row["idproduit"];
        
        $tableau.= "</td>";
        
        $tableau.= "<td>"."<center>".$row["nom"]."<center>"."</td>";
        
        $tableau.= "<td>".$row["prix"]."€"."</td>";
        
  

        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='update_form_produit.php?idproduit=".$row["idproduit"]."'>";
        $tableau.= ucfirst(LANGUE["modifier"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "<td id='result_".$row["idproduit"]."'>";
        $tableau.= "<button type='button' onclick='functionAjaxProduit(" . $row["idproduit"] . ")'>";
        $tableau.= ucfirst(LANGUE["supprimer"]);
        $tableau.= "</button>";        
        $tableau.= "</td>";


        $tableau.= "<td>";
        $tableau.= "<button type='button'>"; 
        $tableau.= "<a href='produits_details_BO.php?idproduit=".$row["idproduit"]."'>";
        $tableau.= ucfirst(LANGUE["détails"]);
        $tableau.= "</a>";
        $tableau.= "</button>"; 
        $tableau.= "</td>";

        $tableau.= "</tr>";
    }
    $tableau.= "</table>";
    
    echo $tableau;

    $stmtPagination = $pdo->prepare("SELECT count(*) as nb FROM produit ");
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
<a href='produits.php?limit=<?php echo $limitMin; ?>'>page précédente</a> ||| <a href='produits.php?limit=<?php echo $limitMax; ?>'>page suivante</a>