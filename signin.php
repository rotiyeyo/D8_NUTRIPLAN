<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="auth-wrap">
	<div class="left">
		<img src="images/mealkit2box.jpg" alt="Meal Kit">
	</div>

	<div class="right">
		<h2 class="auth-heading">
			Sign in to your <span class="brand-inline">NUTRIPLAN+</span> account
		</h2>

		<p class="auth-subtext">
			Enjoy a seamless, personalised experience without re-entering your details every time.
		</p>

		<form action="signin-process.php" method="POST">
			<div class="field-group">
				<label>Username</label>
				<input type="text" name="username" required>
			</div>

			<div class="field-group">
				<label>Password</label>
				<input type="password" name="password" required>
			</div>

			<a href="updatepasscust.php" class="forgot-link">Forgot your password?</a>

			<input type="submit" value="Get started" class="btn-primary">
			
			<p class="signup-link">
				Don't have an account?
				<a href="createaccount.php">Create an account</a>
			</p>
			
		</form>
	</div>
</div>

<?php include("footer.php"); ?>