<?php
if(session_status() == PHP_SESSION_NONE){
	session_start();
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<link rel="stylesheet" href="style.css">
</head>

<body>

<div class="header">

    <a href="admin_dashboard.php">
        <h1>NUTRIPLAN+</h1>
    </a>

    <ul>
        <li><a href="admin_dashboard.php">DASHBOARD.</a></li>
    </ul>

</div>