<?php

$host_name = "localhost";
$sql_name = "root";
$sql_pass = "";
$db_name = "nutriplan";

$condb = mysqli_connect($host_name, $sql_name, $sql_pass, $db_name);

#the other way ->  $condb = mysqli_connect ("localhost", "root", "", "nutriplan");

if (!$condb)
{
	die ("Oops! We’re having trouble connecting to the database.");
}else{
	#echo "You are now connected to the database.";
}

?>
