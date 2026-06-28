<?php
session_start();
include("connection.php");

if(!isset($_SESSION['admin'])){
	header("Location: signin.php");
	exit();
}

$query = mysqli_query($condb, "SELECT * FROM orders ORDER BY id_order DESC");
$totalOrder = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>NUTRIPLAN+</title>

<style>
*{
	margin: 0;
	box-sizing: border-box;
	font-family: "Lucida Sans", sans-serif;
}

body{
	background: repeating-linear-gradient(
		90deg,
		#b7aa55,
		#b7aa55 35px,
		#9b8869 35px,
		#9b8869 70px
	);
	color: #6d1c1c;
}

.header{
	background-color: #6d1c1c;
	color: white;
	padding: 15px 30px;
	display: flex;
	justify-content: space-between;
	align-items: center;
}

.header a{
	color: white;
	text-decoration: none;
	font-weight: bold;
}

.main{
	padding: 40px;
}

h1{
	font-size: 60px;
	margin-bottom: 10px;
}

.subtitle{
	font-size: 25px;
	font-weight: bold;
	margin-bottom: 40px;
}

.content{
	display: flex;
	gap: 40px;
	align-items: flex-start;
}

.total-box{
	background-color: #f5d7af;
	width: 180px;
	padding: 25px;
	border-radius: 8px;
	text-align: center;
}

.total-box h2{
	font-size: 80px;
}

.order-box{
	background-color: #f5d7af;
	padding: 25px;
	border-radius: 8px;
	width: 75%;
}

table{
	width: 100%;
	border-collapse: collapse;
}

th,td{
	padding: 12px;
	border-bottom: 1px solid #7a5542;
	text-align: left;
}

.view{
	text-align: right;
	margin-top: 20px;
	font-size: 20px;
	font-weight: bold;
}
.back-btn{
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
</style>
</head>

<body>

<div class="header">
	<a href="admin_dashboard.php">
		<h2>NUTRIPLAN+</h2>
	</a>

	<div>
		<a href="setting.php">SETTING.</a>
	</div>
</div>

<div class="main">
	<h1>ORDER HISTORY</h1>
	<p class="subtitle">View all your past orders and their details.</p>

	<div class="content">
		<div class="total-box">
			<p>Total Order</p>
			<h2><?php echo $totalOrder; ?></h2>
			<hr>
			<p>Today</p>
		</div>

		<div class="order-box">
			<h2>Recent Orders</h2>

			<table>
				<tr>
					<th>Order ID</th>
					<th>Customer</th>
					<th>Items</th>
					<th>Total</th>
					<th>Date</th>
				</tr>

				<?php
				if($totalOrder == 0){
				?>
				<tr>
					<td colspan="5" style="text-align:center;">No order data available yet.</td>
				</tr>
				<?php
				}
				else{
					while($order = mysqli_fetch_array($query)){
				?>
				<tr>
					<td><?php echo $order['id_order']; ?></td>
					<td><?php echo $order['username_c']; ?></td>
					<td><?php echo $order['items']; ?></td>
					<td>RM <?php echo number_format($order['total'], 2); ?></td>
					<td><?php echo $order['order_date']; ?></td>
				</tr>
				<?php
					}
				}
				?>
			</table>
			<a href="admin_dashboard.php">
				<button type="button" class="back-btn">Back</button>
			</a>
		</div>
	</div>
</div>

</body>
</html>