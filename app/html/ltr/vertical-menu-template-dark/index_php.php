<?php
//DISABLE WARNING
// error_reporting(E_ERROR | E_PARSE);
//DISABLE ERROR
// error_reporting(0);
require 'classe_package.php';
require 'classe_package_cloud.php';
require 'database_connection.php';
// VERIFY IF THE COOKIE EXIST EITHER GO TO THE LOGIN PAGE
$last_view = date("r");
if (!isset($_COOKIE['user_cookie'])) {
	header("Location: auth-login.php");
	exit();
	# code...
} else {
	// IF THE COOKIE EXIST WE EXTEND THE DURATION
	$cookie = $_COOKIE['user_cookie'];
	setcookie("user_cookie", $cookie, time() + 60 * 60);
	$tab = explode("µ", $cookie);
	$matricule_user = addslashes($tab[0]);
	$tab_1 = explode("£", $tab[1]);
	$matricule_etablissement = addslashes($tab_1[0]);
	$query = mysqli_query($database, "SELECT * FROM etablissement WHERE matricule_etablissement = '$matricule_etablissement' ");
	$result = mysqli_fetch_assoc($query);
	$logo = $result['logo'];
	$statut = $result['statut'];
	$date_creation = $result['date_creation'];
	$nom_etablissement = $result['nom_etablissement'];
	$date_academique = $tab_1[1];
	$query = mysqli_query($database, "SELECT * FROM utilisateur WHERE matricule_utlisateur = '$matricule_user' ");
	$result = mysqli_fetch_assoc($query);
	$name = $result["nom_utilisateur"] . ' ' . $result['prenom_utilisateur'];
	$email = $result['email_utilisateur'];

	//SETTING THE WHOLE USER
	$role = $result["role"];
	if ($role == "admin") {
		$user = new admin;
	} elseif ($role == "headmaster") {
		$user = new headmaster;
		# code...
	} elseif ($role == "secretary") {
		$user = new secretary;
		# code...
	} elseif ($role == "teacher") {
		$user = new teacher;
		# code...
	} elseif ($role == "comptable") {
		$user = new comptable;
		// code...
	}
}
