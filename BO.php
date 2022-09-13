<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include_once("_include.php");
include_once("_check_admin.php");


?>


<h1>Back Office - Ecommerce</h1>
<h3></h3>


<table>
    <tr>
    <th>
    <a href="clients.php"><?php echo ucfirst(LANGUE["clients"]); ?></a> <br>
    </th>
    <th>
    <a href="produits.php"><?php echo ucfirst(LANGUE["produits"]); ?></a><br>
    </th>
    <th>
    <a href="commandes.php"><?php echo ucfirst(LANGUE["commandes"]); ?></a></a><br>
    </th>
    <th>
    <a href="reglages.php"><?php echo ucfirst(LANGUE["reglages"]); ?></a></a><br>
    </th>
    <th>
    <a href="index_admin.php"><?php echo ucfirst(LANGUE["accueil"]); ?></a></a><br>
    </th>
    </tr>
    
</table> 






