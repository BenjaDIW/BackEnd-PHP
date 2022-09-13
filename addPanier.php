
<?php
include_once("_include.php");
session_start();

if(isset($_GET['idproduit']) && isset($_GET['qte'])) {
 $_SESSION['panier'][$_GET['idproduit']] = $_SESSION['panier'][$_GET['idproduit']] + $_GET['qte'];
}










