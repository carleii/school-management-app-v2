<<<<<<< HEAD
<?php
//parametres de connection à la base de données
//1. l'hote
$host = 'localhost';
//2. l'utilisateur
$user = 'root';
//3. mot de passe
$pssw = '';
//4. base de données
$db = 'cloud';
//requette de connection
$db = new mysqli($host, $user, $pssw, $db) or die("Unable to conenct" . mysqli_error($db));
=======
<?php
//parametres de connection à la base de données
//1. l'hote
$host = 'localhost';
//2. l'utilisateur
$user = 'root';
//3. mot de passe
$pssw = '';
//4. base de données
$db = 'cloud';
//requette de connection
$db = new mysqli($host, $user, $pssw, $db) or die("Unable to conenct" . mysqli_error($db));
>>>>>>> 7680b2b4b185c0f8881ecb7801c52a1ec48f7c9b
