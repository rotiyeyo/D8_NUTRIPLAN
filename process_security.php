<?php
session_start();
include("connection.php");

if(isset($_POST['current_password'])){

	$username = $_SESSION['username_c'];

	$currentPassword = $_POST['current_password'];
	$newPassword = $_POST['new_password'];

	$query = mysqli_query($condb,
	"SELECT * FROM customer_data
	WHERE username_c='$username'");

	$user = mysqli_fetch_array($query);

	if($user['password_c'] == $currentPassword){

		mysqli_query($condb,
		"UPDATE customer_data
		SET password_c='$newPassword'
		WHERE username_c='$username'");

		$_SESSION['message'] =
		"Password updated successfully!";
	}
	else{

		$_SESSION['message'] =
		"Current password is incorrect!";
	}
}

header("Location: accountSecurity.php");
exit();
?>