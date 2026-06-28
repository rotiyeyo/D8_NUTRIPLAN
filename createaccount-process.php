<?php
session_start();
include("connection.php");

if(!empty($_POST)){

	if(strlen($_POST['password']) < 3){
		die("<script>
		alert('That password is a little too tiny. Your password needs at least 3 characters.');
		window.location.href='createaccount.php';
		</script>");
	}

	$check = mysqli_query($condb,
	"SELECT * FROM customer_data
	WHERE username_c='".$_POST['username']."'");

	if(mysqli_num_rows($check) > 0){
		die("<script>
		alert('Username already exists. Please choose another username.');
		window.location.href='createaccount.php';
		</script>");
	}

	$sql_save = "INSERT INTO customer_data
	(firstname_c, lastname_c, username_c, email_c, phonenum_c, password_c, address_c)
	VALUES
	('".$_POST['firstname']."',
	'".$_POST['lastname']."',
	'".$_POST['username']."',
	'".$_POST['email']."',
	'".$_POST['phonenumber']."',
	'".$_POST['password']."',
	'".$_POST['address']."')";

	$do_query = mysqli_query($condb, $sql_save);

	if($do_query){
		
		$_SESSION['username_c'] = $_POST['username'];
		$_SESSION['password'] = $_POST['password'];
		
		echo "<script>
		alert('You’re all set! Registration successful.');
		window.location.href='customer_preference.php';
		</script>";
	}
	else{
		echo "<script>
		alert('Registration failed, let’s try that again.');
		window.location.href='createaccount.php';
		</script>";
	}
}
else{
	echo "<script>
	alert('Almost there! Please complete all fields before continuing.');
	window.location.href='createaccount.php';
	</script>";
}
?>