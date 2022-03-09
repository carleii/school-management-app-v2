<?php
$host = "localhost";
$user = "root";
$pssw = "";
try {
	$database = new mysqli($host, $user, $pssw, "scolaricx") or die("unable to connect");
} catch (Exception $e) {
	exit();
}
