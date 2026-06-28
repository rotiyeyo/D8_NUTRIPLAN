<?php
session_start();
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];
$address = $_POST['address'];

mysqli_query($condb,
"UPDATE customer_data
SET address_c='$address'
WHERE username_c='$username'");

$_SESSION['message'] = "Delivery address updated successfully!";

header("Location: deliveryDetails.php");
exit();
?>