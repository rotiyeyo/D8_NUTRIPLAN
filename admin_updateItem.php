<?php
session_start();
include("connection.php");

if(!isset($_SESSION['admin'])){
	header("Location: signin.php");
	exit();
}

if(!isset($_GET['id'])){
	header("Location: admin_dashboard.php");
	exit();
}

$id = $_GET['id'];
$message = "";

if(isset($_POST['save'])){
	$mealName = $_POST['mealName'];
	$description = $_POST['description'];
	$price = $_POST['price'];
	$category = $_POST['category'];
	$status = $_POST['status'];
	$image = $_POST['image'];
	
	if(isset($_POST['allergy'])){
		$allergy = implode(",", $_POST['allergy']);
	}
	else{
		$allergy = "";
	}

	$query = "UPDATE menu_item SET
	meal_name='$mealName',
	description='$description',
	price='$price',
	category='$category',
	allergy='$allergy',
	image='$image',
	status='$status'
	WHERE id_menu='$id'";

	mysqli_query($condb, $query);

	$message = "Item updated successfully!";
}

if(isset($_POST['delete'])){
	mysqli_query($condb, "DELETE FROM menu_item WHERE id_menu='$id'");

	header("Location: admin_dashboard.php");
	exit();
}

	$result = mysqli_query($condb, "SELECT * FROM menu_item WHERE id_menu='$id'");
	$menu = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Update Item</title>

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
.save-btn, .delete-btn, .back-btn{
	margin-top:20px;
	width:100%;
	padding:15px;
	border:none;
	border-radius:12px;
	color:white;
	font-weight:bold;
	font-size:18px;
	cursor:pointer;
}
.save-btn{
	background:#4c343b;
}
.delete-btn, .back-btn{
	background:#7a5542;
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
		<a href="admin_addItem.php">ADD ITEM.</a>
		&nbsp;&nbsp;&nbsp;
		<a href="admin_orderHistory.php">ORDERS.</a>
	</div>
</div>

<form method="post">

<div class="main">

	<div class="left">
	<h1>UPDATE ITEM</h1>
	<h2>Edit and update existing item details.</h2>

	<label>Meal Name</label>
	<input type="text" name="mealName" value="<?php echo $menu['meal_name']; ?>" required>

	<label>Description</label>
	<textarea name="description" required><?php echo $menu['description']; ?></textarea>

	<label>Price (MYR)</label>
	<input type="number" step="0.01" name="price" value="<?php echo $menu['price']; ?>" required>

	<label>Image Filename</label>
	<input type="text" name="image" value="<?php echo $menu['image']; ?>" required>

	<label>Food Allergies</label>

	<div class="choice-box">
		<label><input type="checkbox" name="allergy[]" value="peanuts" <?php if(strpos($menu['allergy']?? '','peanuts')!==false) echo "checked"; ?>> Peanuts</label>
		<label><input type="checkbox" name="allergy[]" value="egg" <?php if(strpos($menu['allergy']?? '','egg')!==false) echo "checked"; ?>> Egg</label>
		<label><input type="checkbox" name="allergy[]" value="seafood" <?php if(strpos($menu['allergy']?? '','seafood')!==false) echo "checked"; ?>> Seafood</label>
		<label><input type="checkbox" name="allergy[]" value="soybeans" <?php if(strpos($menu['allergy']?? '','soybeans')!==false) echo "checked"; ?>> Soybeans</label>
		<label><input type="checkbox" name="allergy[]" value="dairy" <?php if(strpos($menu['allergy']?? '','dairy')!==false) echo "checked"; ?>> Dairy</label>
		<label><input type="checkbox" name="allergy[]" value="none" <?php if(strpos($menu['allergy']?? '','none')!==false) echo "checked"; ?>> None</label>
	</div>
</div>

	<div class="right">
		<label>Category</label>
		<select name="category">
			<option <?php if($menu['category']=="Vegetarian"){echo "selected";} ?>>Vegetarian</option>
			<option <?php if($menu['category']=="Balanced Diet"){echo "selected";} ?>>Balanced Diet</option>
			<option <?php if($menu['category']=="Mediterranean"){echo "selected";} ?>>Mediterranean</option>
			<option <?php if($menu['category']=="Pescatarian"){echo "selected";} ?>>Pescatarian</option>
		</select>

		<label>Availability Status</label>
		<select name="status">
			<option <?php if($menu['status']=="Available"){echo "selected";} ?>>Available</option>
			<option <?php if($menu['status']=="Unavailable"){echo "selected";} ?>>Unavailable</option>
		</select>

		<button type="submit" name="delete" class="delete-btn">Delete Item</button>
		<button type="submit" name="save" class="save-btn">Save!</button>

		<a href="admin_dashboard.php">
			<button type="button" class="back-btn">Back</button>
		</a>
		
		<p class="message"><?php echo $message; ?></p>
	</div>

</div>

</form>

</body>
</html>