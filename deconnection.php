<?php
include_once("_include.php");
session_start(); // On récupère la session
unset($_SESSION['admin']); // détruit la variable
session_destroy(); // détruit la session
header("Location: index.php"); // redirection
