<?php

/*
Script d'installation et de configuration de la base de données



*/
require_once('../lang.php');

session_start();

if (isset($_GET['action'])){
	$action=$_GET['action'];
}
else{
	$action=null;
}

echo "<!DOCTYPE html>";
echo "<html>";
echo "<head><title>"._INSTALL_PAGE_TITLE."</title><meta charset='utf-8'/></head><body>";

switch($action){
	case "create":
		// on tente de créer la base de données
		create_db();
		break;
	case "install":
		// on crée les tables correctement et insert les données par défaut
		break;
	case "config":
		// on remplis le fichier de configuration
		break;
	default:
		// on affiche la page principale avec le choix de l'action à effectuer.
		echo _INSTALL_PAGE_WELCOME_MESSAGE."<br/>";
		echo _INSTALL_PAGE_QUESTION."<br/>";
		echo "<ul>";
		echo "<li><a href='?action=create'>"._INSTALL_PAGE_CHOICE_CREATE."</a></li>";
		echo "<li><a href='?action=install'>"._INSTALL_PAGE_CHOICE_INSTALL."</a></li>";
		echo "<li><a href='?action=config'>"._INSTALL_PAGE_CHOICE_CONFIG."</a></li>";
		echo "</ul>";
		break;
}

echo "</body></html>";

function create_db(){
	if(isset($_POST['password'])){
		$_SESSION['root_pwd']=$_POST['password'];
		$link = @mysqli_connect("localhost",'root',$_SESSION['root_pwd']) or die(_CREATE_PAGE_CONNECT_ERROR);
		
	}
	else{
		// Mot de passe inconnu. On affiche le formulaire qui le demande
		echo _CREATE_PAGE_QUESTION."<br/>";
		echo "<form action='#' method='POST'><input type='password' name='password'/><input type='submit'/></form>";
	}
}

?>