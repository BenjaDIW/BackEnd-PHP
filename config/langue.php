<?php
if(!isset($_COOKIE["LANGUE"])){
	$_COOKIE["LANGUE"] = CONFIG["LANGUE"];
}

switch($_COOKIE["LANGUE"]){
	case "FR":
		$lang=parse_ini_file($appPath."/public/assets/langues/fr.ini");
		break;
	case "EN":
		$lang=parse_ini_file($appPath."/public/assets/langues/en.ini");
		break;
	default:
		print_r("Language not defined!");
		break;
}
define("LANGUE", $lang);
?>