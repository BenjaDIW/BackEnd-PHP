<?php
include_once("_include.php");
session_start();
session_regenerate_id();

// if($page = "BO"){
    if($_SESSION['admin'] != true){
        header('Location: connexion.php');
        echo "non connecté";
    }
// }