<?php
session_start();
include("connection.php");

if(!isset($_SESSION['username_a'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_a'];

$currentPassword = $_POST['current_password'];
$newPassword = $_POST['new_password'];
$confirmPassword = $_POST['confirm_password'];

$query = mysqli_query($condb,
"SELECT * FROM admin_data
WHERE username_a='$username'");

$user = mysqli_fetch_array($query);

if($currentPassword != $user['password_a']){

	echo "<script>
	alert('Current password is incorrect!');
	window.location.href='setting-security.php';
	</script>";
	exit();
}

if($newPassword != $confirmPassword){

	echo "<script>
	alert('New password and confirm password do not match!');
	window.location.href='setting-security.php';
	</script>";
	exit();
}

mysqli_query($condb,
"UPDATE admin_data
SET password_a='$newPassword'
WHERE username_a='$username'");

echo "<script>
alert('Password updated successfully!');
window.location.href='setting-security.php';
</script>";
?>