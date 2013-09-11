<?php
//Par sécurité, encore une fois
if(!defined("DASISH")) { exit(); }

//Appel Connexion
function ConnexionBDD($serverPath, $port, $user, $pass, $base)
{
	$PARAM_hote=$serverPath; // le chemin vers le serveur
	$PARAM_port=$port;
	$PARAM_nom_bd=$base; // le nom de votre base de données
	$PARAM_utilisateur=$user; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe=$pass; // mot de passe de l'utilisateur pour se connecter

	try
	{
		$connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd,
		$PARAM_utilisateur,
		$PARAM_mot_passe);
		return $connexion;
	}
	catch(Exception $e)
	{
		$erreure = 'Erreur : '.$e->getMessage().'<br />';
		$erreure .= 'N° : '.$e->getCode();
		return $erreure;
	}
}

$DB = ConnexionBDD(Wserver, Wport, Wuser, Wpassword, Wtable);
if(!is_string($DB))
{	
	$result=$DB->query("SET NAMES 'utf8'");
}
else
{
	if(MODE == "Production") {
		exit('Database out of service');
	}
	elseif(MODE == "Test") {
		print($DB);
		exit();
	}
}
?>