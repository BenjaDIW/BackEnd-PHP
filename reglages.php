<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once("_include.php");

session_start();


if(isset($_GET["langue"])){
    // on crée le cookie
    if($_GET["langue"] == "EN"){
        setcookie("LANGUE", "EN", time()+3600);
    }
    else{
        setcookie("LANGUE", "FR", time()+3600);
    }
    header('Location: index.php');
}
// S'il n'y a pas de GET langue, on affiche le formulaire
else{
?>
<form action="reglages.php" method="GET">
    <div>
        <label for="langue">Langue</label>
        <input type="text" id="langue" name="langue">
    </div>
    <input type="submit" value="Submit" />
</form>
<?php
}