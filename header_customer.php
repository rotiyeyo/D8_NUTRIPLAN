<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}

$current_page = basename($_SERVER['PHP_SELF']);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="header">
	<a href="menu.php">
		<h1>NUTRIPLAN+</h1>
	</a>

	<?php if($current_page == "customer_preference.php"){ ?>
		<ul>
			<li><a href="allergies.php">SKIP</a></li>
		</ul>

	<?php } else if($current_page == "allergies.php"){ ?>
		<ul>
			<li><a href="menu.php">SKIP</a></li>
		</ul>

	<?php } else { ?>
		<ul>
			<li><a href="order_More.php">CART.</a></li>
			<li><a href="customer_personalInfo.php">SETTING.</a></li>
		</ul>
	<?php } ?>

</div>