<?php
session_start();

if (!empty ($_POST['username']) and !empty($_POST['new_password']) and !empty($_POST['confirm_password']))
{
	include('connection.php');
	
	$_username         = trim($_POST['username']);
	$new_password     = trim($_POST['new_password']);
	$confirm_password = trim($_POST['confirm_password']);
	
	# check if passwords match
	if ($new_password == $confirm_password)
	{
		# check if username exist in database
		$query = "SELECT * FROM customer_data WHERE username_c = '".$_username."'";
		$do_query = mysqli_query ($condb, $query);
		
		if(mysqli_num_rows($do_query) == 1)
		{
			#username found? update
			$query_update = "UPDATE customer_data SET password_c = '".$new_password."' WHERE username_c = '".$_username."'";
			$do_update = mysqli_query($condb, $query_update);
			
			if ($do_update)
			{
				echo "<script> alert ('Password reset successful! Please sign in.');
				window.location.href = 'signin.php'; </script>";
			}
			else
			{
				die("<script> alert('Failed to reset password. Please try again.');
				window.history.back(); </script>");
			}
		}
		else
		{
			//username not found?
			die("<script>alert('Oops! No account matches that username. Please check and try again.')
			window.history.back(); </script>");
		}
	}
	else
	{
		# password do not match
		die("<script>alert('Password do not match. Please try again.');
		window.history.back(); </script>");
	}
}
else
{
	die("<script>alert('Almost there! Please complete all fields.');
	window.history.back(); </script>");
}
?>