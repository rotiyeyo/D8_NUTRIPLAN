<?php
session_start();

if (!empty($_POST['username']) and !empty($_POST['password']))
{
	include('connection.php');

	$username = $_POST['username'];
	$password = $_POST['password'];

	$query_admin = "SELECT * FROM admin_data
	WHERE username_a='$username'
	AND password_a='$password'";

	$admin_result = mysqli_query($condb, $query_admin);

	if(mysqli_num_rows($admin_result)==1){
		$admin = mysqli_fetch_array($admin_result);

		$_SESSION['admin'] = true;
		$_SESSION['username_a'] = $admin['username_a'];

		header("Location: admin_dashboard.php");
		exit();
	}

	$query_login = "SELECT * FROM customer_data
	WHERE username_c = '$username'
	AND password_c = '$password' ";

	$do_query = mysqli_query($condb, $query_login);

	if(mysqli_num_rows($do_query)==1)
	{
		$m = mysqli_fetch_array($do_query);

		$_SESSION['username_c'] = $m['username_c'];
		$_SESSION['password'] = $m['password_c'];

		$checkPrefer = mysqli_query($condb, 
		"SELECT * FROM customer_prefer 
		WHERE username_c = '".$m['username_c']."'");

		if(mysqli_num_rows($checkPrefer) > 0){
			echo "<script>window.location.href = 'menu.php';</script>";
		}
		else{
			echo "<script>window.location.href = 'customer_preference.php';</script>";
		}
	}
	else
	{
		die("<script>
		alert('Hmm we could not sign you in. Please try again.');
		window.location.href='signin.php';
		</script>");
	}
}
else
{
	die("<script>
	alert('Pop in your username and password to continue.');
	window.location.href='signin.php';
	</script>");
}
?>