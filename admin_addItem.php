<?php
session_start();
include("connection.php");

if(!isset($_SESSION['admin'])){
	header("Location: signin.php");
	exit();
}

$message = "";

if(isset($_POST['save'])){

	$mealName = $_POST['mealName'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$image = $_POST['image'];
	$status = $_POST['status'];

	if(isset($_POST['allergy'])){
		$allergy = implode(",", $_POST['allergy']);
	}
	else{
		$allergy = "";
	}

	$query = "INSERT INTO menu_item
	(meal_name, description, price, category, allergy, image, status)
	VALUES
	('$mealName','$description','$price','$category','$allergy','$image','$status')";

	mysqli_query($condb, $query);

	$message = "Item added successfully!";
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>NUTRIPLAN+</title>

<style>
*{
	margin:0;
	box-sizing:border-box;
	font-family:"Lucida Sans", sans-serif;
}

body{
	background:repeating-linear-gradient(
		90deg,
		#b7aa55,
		#b7aa55 35px,
		#9b8869 35px,
		#9b8869 70px
	);
	color:#6d1c1c;
}

.header{
	background:#6d1c1c;
	color:white;
	padding:15px 30px;
	display:flex;
	justify-content:space-between;
	align-items:center;
}

.header a{
	color:white;
	text-decoration:none;
	font-weight:bold;
}

.main{
	padding:35px;
	display:flex;
	gap:50px;
}

.left{
	width:45%;
}

.right{
	width:40%;
	border-left:3px solid #7a5542;
	padding-left:35px;
}

h1{
	font-size:55px;
}

h2{
	margin-bottom:20px;
}

label{
	display:block;
	margin-top:12px;
	font-weight:bold;
}

input, textarea, select{
	width:100%;
	padding:12px;
	border:none;
	border-radius:5px;
	background:#f5d7af;
}

textarea{
	height:150px;
}
.choice-box{
	display:grid;
	grid-template-columns:repeat(2,1fr);
	gap:10px;
	margin-top:10px;
}

.choice-box label{
	background:#f5d7af;
	padding:10px;
	border-radius:8px;
	margin-top:0;
}
.save-btn, .back-btn{
	margin-top:30px;
	width:100%;
	padding:15px;
	border:none;
	border-radius:12px;
	background:#4c343b;
	color:white;
	font-weight:bold;
	font-size:18px;
	cursor:pointer;
}

.message{
	margin-top:15px;
	font-weight:bold;
	color:green;
}
</style>

</head>
<body>

<div class="header">

	<a href="admin_dashboard.php">
		<h2>NUTRIPLAN+</h2>
	</a>

	<div>
		<a href="admin_dashboard.php">DASHBOARD.</a>
		&nbsp;&nbsp;&nbsp;
		<a href="admin_orderHistory.php">ORDERS.</a>
	</div>

</div>

<form method="post">

<div class="main">

	<div class="left">

		<h1>ADD ITEM</h1>
		<h2>Add a new menu item.</h2>

		<label>Meal Name</label>
		<input type="text" name="mealName" required>

		<label>Description</label>
		<textarea name="description" required></textarea>

		<label>Price (MYR)</label>
		<input type="number" step="0.01" name="price" required>

	</div>

	<div class="right">

		<label>Category</label>
		<select name="category">
			<option>Vegetarian</option>
			<option>Balanced Diet</option>
			<option>Mediterranean</option>
			<option>Pescatarian</option>
		</select>

		<label>Image Filename</label>
		<input type="text" name="image" placeholder="nasilemak.jpg" required>

		<label>Food Allergies</label>

		<div class="choice-box">
			<label><input type="checkbox" name="allergy[]" value="peanuts"> Peanuts</label>
			<label><input type="checkbox" name="allergy[]" value="egg"> Egg</label>
			<label><input type="checkbox" name="allergy[]" value="seafood"> Seafood</label>
			<label><input type="checkbox" name="allergy[]" value="soybeans"> Soybeans</label>
			<label><input type="checkbox" name="allergy[]" value="dairy"> Dairy</label>
			<label><input type="checkbox" name="allergy[]" value="none"> None</label>
		</div>

		<label>Status</label>
		<select name="status">
			<option>Available</option>
			<option>Unavailable</option>
		</select>

		<button type="submit" name="save" class="save-btn">
			Save Item!
		</button>
		
		<a href="admin_dashboard.php">
			<button type="button" class="back-btn">Back</button>
		</a>

		<p class="message"><?php echo $message; ?></p>

	</div>

</div>

</form>

</body>
</html>