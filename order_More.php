<?php
session_start();

if(isset($_POST['clear'])){
	unset($_SESSION['cart']);
	header("Location: order_More.php");
	exit();
}

include("connection.php");

	if(isset($_POST['checkout'])){

		if(!isset($_SESSION['username_c'])){
		header("Location: signin.php");
		exit();
	}

	$username = $_SESSION['username_c'];
	$items = "";
	$total = 0;

	foreach($_SESSION['cart'] as $item){
		$items = $items . $item['name'] . ", ";
		$subtotal = $item['price'] * $item['qty'];
		$total = $total + $subtotal;
	}

	$query = "INSERT INTO orders(username_c, items, total, order_date)
	VALUES('$username', '$items', '$total', NOW())";

	mysqli_query($condb, $query);

	unset($_SESSION['cart']);

	echo "<script>
	alert('Order placed successfully!');
	window.location.href='orderStatus.php';
	</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Order More</title>

<style>
*{
	margin:0;
	box-sizing:border-box;
	font-family:"Lucida Sans", sans-serif;
}

body{
	background-color:#7a5542;
	color:white;
}

.header{
	background-color:#6d1c1c;
	padding:15px 30px;
	display:flex;
	justify-content:space-between;
	align-items:center;
}

ul{
	list-style:none;
	display:flex;
	gap:20px;
}

a{
	color:white;
	text-decoration:none;
	font-weight:bold;
}

.logo{
	color:white;
	text-decoration:none;
}

.container{
	width:80%;
	margin:50px auto;
	background:white;
	color:black;
	padding:30px;
	border-radius:15px;
}

.container h1{
	color:#6d1c1c;
	margin-bottom:20px;
}

.success{
	text-align:center;
	margin-bottom:30px;
}

table{
	width:100%;
	border-collapse:collapse;
	margin-top:20px;
}

th, td{
	border:1px solid #ccc;
	padding:15px;
	text-align:center;
}

th{
	background:#6d1c1c;
	color:white;
}

.total{
	text-align:right;
	margin-top:20px;
	font-size:22px;
	font-weight:bold;
}

.btn{
	display:inline-block;
	padding:12px 25px;
	background:#6d1c1c;
	color:white;
	border:none;
	border-radius:8px;
	margin-top:20px;
	cursor:pointer;
	text-decoration:none;
}

.empty{
	text-align:center;
	font-size:20px;
	margin:30px;
}
</style>
</head>

<body>

<div class="header">
	<a href="menu.php" class="logo">
		<h1>NUTRIPLAN+</h1>
	</a>

	<ul>
		<li><a href="order_More.php">CART.</a></li>
		<li><a href="setting.php">SETTING.</a></li>
	</ul>
</div>

<div class="container">

	<?php
	if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
		echo "<h1>Your Cart</h1>";
		echo "<p class='empty'>Your cart is empty.</p>";
		echo "<a href='menu.php' class='btn'>Back to Menu</a>";
	}
	else{
		$grandTotal = 0;
	?>

	<div class="success">
		<h1>Item Added Successfully!</h1>
		<p>Your meal has been added to cart.</p>
	</div>

	<h1>Your Cart</h1>

	<table>
		<tr>
			<th>No</th>
			<th>Meal Name</th>
			<th>Price (RM)</th>
			<th>Quantity</th>
			<th>Subtotal (RM)</th>
		</tr>

		<?php
		$no = 1;

		foreach($_SESSION['cart'] as $item){
			$subtotal = $item['price'] * $item['qty'];
			$grandTotal = $grandTotal + $subtotal;
		?>

		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $item['name']; ?></td>
			<td><?php echo number_format($item['price'], 2); ?></td>
			<td><?php echo $item['qty']; ?></td>
			<td><?php echo number_format($subtotal, 2); ?></td>
		</tr>

		<?php
			$no++;
		}
		?>

	</table>

	<div class="total">
		Total: RM <?php echo number_format($grandTotal, 2); ?>
	</div>

	<a href="menu.php" class="btn">Order More</a>
	<a href="checkout.php" class="btn">Checkout</a>

	<form method="post" style="display:inline;">
		<button type="submit" name="clear" class="btn">Clear Cart</button>
	</form>

	<?php
	}
	?>

</div>

</body>
</html>