<?php
session_start();
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];
$preference = $_POST['preferences'];

if($preference == "vegetarian"){
	$id_preference = 1;
}
else if($preference == "mediterranean"){
	$id_preference = 2;
}
else if($preference == "pescatarian"){
	$id_preference = 3;
}
else if($preference == "balanced"){
	$id_preference = 4;
}

$sql = "INSERT INTO customer_prefer (username_c, id_preference)
VALUES ('$username', '$id_preference')";

$do_query = mysqli_query($condb, $sql);

if($do_query){
	echo "<script>window.location.href = 'allergies.php';</script>";
}
else{
	die("<script>
	alert('Oops! We could not save your information. Try again.');
	window.location.href = 'preference.php';
	</script>");
}
?>