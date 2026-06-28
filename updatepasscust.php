<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NutriPlan+</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>




<div class="auth-wrap">
    <div class="left">
        <h2 class="auth-heading">
            Forgot your <span class="brand-inline">NUTRIPLAN+</span> password?
        </h2>
        <br>

        <form action="updatepasscust-process.php" method="POST">

            <div class="field-group">
                <label>Username</label>
                <input type="text" name="username" required>
            </div>

            <div class="field-group">
                <label>Create new password</label>
                <input type="text" name="new_password" required>
            </div>

            <div class="field-group">
                <label>Confirm your password</label>
                <input type="text" name="confirm_password" required>
            </div>

            <div class="btn-row">
                <a href="signin.php"><input type="button" value="Back to sign in" class="btn-primary" style="cursor:pointer;"></a>
                <input type="submit" value="Reset password" class="btn-primary">
            </div>

        </form>
    </div>

    <div class="right-info">
        <img src="images/mealkit2box.jpg" alt="Meal Kit">
        <p>It's easy to forget. Enter your username (that you used to create your account) and new password. Then, we will reset your password.</p>
    </div>
</div>

<?php include('footer.php'); ?>
<!--
<h2>Forgot your NUTRIPLAN+ password?</h2>
<form action = 'updatepasscust-process.php' method = 'POST'>

	Username                 <input type = 'text'        name='username'         required>    <br>
	Create new password      <input type = 'password'    name='new_password'     required>    <br>
	Confirm your password    <input type = 'password'    name='confirm_password' required>    <br>
	
							 <a href     = "signin.php">        Back to sign in.   </a>
							 <input type = 'submit'             value='Reset password'>

</form>
CHECK THIS!!!!!!!!
-->


