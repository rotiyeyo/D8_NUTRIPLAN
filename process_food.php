<?php
session_start();
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];
$meal_pref = $_POST['meal_pref'];
$allergies = $_POST['allergies'] ?? array();

mysqli_query($condb,
"DELETE FROM customer_prefer WHERE username_c='$username'");

mysqli_query($condb,
"INSERT INTO customer_prefer(username_c, id_preference)
VALUES('$username','$meal_pref')");

mysqli_query($condb,
"DELETE FROM customer_allergy WHERE username_c='$username'");

foreach($allergies as $id){
	mysqli_query($condb,
	"INSERT INTO customer_allergy(username_c, id_allergies)
	VALUES('$username','$id')");
}

$_SESSION['message'] = "Food preferences updated successfully!";

header("Location: foodPreferences.php");
exit();
?><?php
session_start();
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];
$meal_pref = $_POST['meal_pref'];
$allergies = $_POST['allergies'] ?? array();

mysqli_query($condb,
"DELETE FROM customer_prefer WHERE username_c='$username'");

mysqli_query($condb,
"INSERT INTO customer_prefer(username_c, id_preference)
VALUES('$username','$meal_pref')");

mysqli_query($condb,
"DELETE FROM customer_allergy WHERE username_c='$username'");

foreach($allergies as $id){
	mysqli_query($condb,
	"INSERT INTO customer_allergy(username_c, id_allergies)
	VALUES('$username','$id')");
}

$_SESSION['message'] = "Food preferences updated successfully!";

header("Location: foodPreferences.php");
exit();
?>