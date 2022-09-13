<?php

// A la première connexion on récupère la langue par défaut du fichier de configuration
// par la suite on utilisera les cookies
if(!isset($_COOKIE["LANGUE"])){
	$_COOKIE["LANGUE"] = CONFIG["LANGUE"];
}

switch($_COOKIE["LANGUE"]){
	case "FR":
		$lang=parse_ini_file($appPath."\\public\\assets\\langues\\fr.ini");
		break;
	case "EN":
		$lang=parse_ini_file($appPath."\\public\\assets\\langues\\en.ini");
		break;
	default:
		print_r("Language not defined!");
		break;
}
// Même logique que dans load_configuration.php
define("LANGUE", $lang);
?>