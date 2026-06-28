<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Create Account</title>
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="auth-wrap createaccount">
	<div class="left">
		<img src="images/mealkit2box.jpg" alt="Meal Kit">
	</div>

	<div class="right">
		<h2 class="auth-heading">
			Create an <span class="brand-inline">NUTRIPLAN+</span> account
		</h2>

		<a href="signin.php" class="small-link">
			Already have an account? Sign in here
		</a>

		<form action="createaccount-process.php" method="POST">

			<div class="form-grid">

				<div class="field-group">
					<label>First Name</label>
					<input type="text" name="firstname">
				</div>

				<div class="field-group">
					<label>Email</label>
					<input type="email" name="email">
				</div>

				<div class="field-group">
					<label>Last Name</label>
					<input type="text" name="lastname">
				</div>

				<div class="field-group">
					<label>Phone number</label>
					<input type="text" name="phonenumber">
				</div>

				<div class="field-group">
					<label>Username</label>
					<input type="text" name="username" required>
				</div>

				<div class="field-group">
					<label>Password</label>
					<input type="text" name="password" required>
				</div>

			</div>

			<div class="field-group">
				<label>Address</label>
				<textarea name="address"></textarea>
			</div>

			<input type="submit" value="Create account" class="btn-primary" style="width:260px;">

		</form>
	</div>
</div>

<?php include("footer.php"); ?>