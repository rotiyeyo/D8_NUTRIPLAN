<?php
session_start();
include('connection.php');

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];

if(isset($_POST['allergies'])){

	foreach($_POST['allergies'] as $allergy){

		$query = "INSERT INTO customer_allergy(username_c, id_allergies)
		VALUES ('$username', '$allergy')";

		mysqli_query($condb, $query);
	}

	header("Location: menu.php");
	exit();
}
else{
	echo "<script>
	alert('Please choose at least one allergy.');
	window.location.href='allergies.php';
	</script>";
}
?>