<?php
session_start();
include("connection.php");

if(!isset($_SESSION['admin'])){
	header("Location: signin.php");
	exit();
}

$query = mysqli_query($condb,
"SELECT * FROM customer_data");

$totalCustomers = mysqli_num_rows($query);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Customers</title>

<style>
*{
	margin:0;
	box-sizing:border-box;
	font-family:"Lucida Sans", sans-serif;
}

body{
	background: repeating-linear-gradient(
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
	padding:40px;
}

h1{
	font-size:55px;
	margin-bottom:10px;
}

.subtitle{
	font-size:22px;
	font-weight:bold;
	margin-bottom:30px;
}

.content{
	display:flex;
	gap:30px;
	align-items:flex-start;
}

.total-box{
	background:#f5d7af;
	width:180px;
	padding:25px;
	border-radius:10px;
	text-align:center;
}

.total-box h2{
	font-size:70px;
}

.customer-box{
	background:#f5d7af;
	padding:25px;
	border-radius:10px;
	width:80%;
}

table{
	width:100%;
	border-collapse:collapse;
}

th,td{
	padding:12px;
	border-bottom:1px solid #7a5542;
	text-align:left;
}

.back-btn{
	display:inline-block;
	margin-top:20px;
	padding:12px 25px;
	background:#7a5542;
	color:white;
	text-decoration:none;
	border-radius:8px;
	font-weight:bold;
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

<div class="main">

	<h1>CUSTOMERS</h1>
	<p class="subtitle">View all registered customers.</p>

	<div class="content">

		<div class="total-box">
			<p>Total Customers</p>
			<h2><?php echo $totalCustomers; ?></h2>
		</div>

		<div class="customer-box">

			<h2>Customer List</h2>

			<table>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Email</th>
					<th>Phone Number</th>
				</tr>

				<?php while($customer = mysqli_fetch_array($query)){ ?>

				<tr>
					<td><?php echo $customer['firstname_c']; ?></td>
					<td><?php echo $customer['lastname_c']; ?></td>
					<td><?php echo $customer['email_c']; ?></td>
					<td><?php echo $customer['phonenum_c']; ?></td>
				</tr>

				<?php } ?>

			</table>

			<a href="admin_dashboard.php" class="back-btn">
				← Back to Dashboard
			</a>

		</div>

	</div>

</div>

</body>
</html>