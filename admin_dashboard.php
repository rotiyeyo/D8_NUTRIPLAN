<?php
session_start();
include("connection.php");

$search = "";
$filter = "";

$sql = "SELECT * FROM menu_item WHERE 1";

if(isset($_GET['filter'])){
	$filter = $_GET['filter'];

	if($filter == "available"){
		$sql .= " AND status='Available'";
	}
	else if($filter == "unavailable"){
		$sql .= " AND status='Unavailable'";
	}
}

if(isset($_GET['search']) && $_GET['search'] != ""){
	$search = $_GET['search'];

	$sql .= " AND (
		meal_name LIKE '%$search%'
		OR category LIKE '%$search%'
		OR status LIKE '%$search%'
	)";
}

$query = mysqli_query($condb, $sql);
$totalMenuQuery = mysqli_query($condb, "SELECT * FROM menu_item");
$totalMenu = mysqli_num_rows($totalMenuQuery);


$availableQuery = mysqli_query($condb, "SELECT * FROM menu_item WHERE status='Available'");
$totalAvailable = mysqli_num_rows($availableQuery);

$unavailableQuery = mysqli_query($condb, "SELECT * FROM menu_item WHERE status='Unavailable'");
$totalUnavailable = mysqli_num_rows($unavailableQuery);
$customerQuery = mysqli_query($condb, "SELECT * FROM customer_data");
$totalCustomers = mysqli_num_rows($customerQuery);

$orderQuery = mysqli_query($condb, "SELECT * FROM orders ORDER BY id_order DESC LIMIT 5");
$totalOrders = mysqli_num_rows($orderQuery);
?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<title>Admin</title>

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

a{
	color: white;
	text-decoration: none;
	font-weight: bold;
}

.dashboard{
	padding: 35px;
}

.dashboard h1{
	font-size: 45px;
}

.dashboard h3{
	margin-bottom: 20px;
}

.top-area{
	display: flex;
	gap: 25px;
	margin-top: 20px;
}

.stats{
	width: 180px;
}

.stat-box{
	background-color: #f5d7af;
	padding: 20px;
	border-radius: 8px;
	margin-bottom: 15px;
	text-align: center;
}

.stat-box h2{
	font-size: 60px;
}

.orders{
	background-color: #f5d7af;
	padding: 20px;
	border-radius: 8px;
	width: 70%;
}

table{
	width: 100%;
	border-collapse: collapse;
	font-size: 14px;
}

th,td{
	padding: 8px;
	border-bottom: 1px solid #7a5542;
	text-align: left;
}

.menu-nav{
	background-color: #8b5747;
	padding: 15px 30px;
	display: flex;
	gap: 50px;
	margin-top: 30px;
}

.menu-nav a{
	text-decoration: underline;
}

.filter{
	padding: 20px 30px;
	display: flex;
	gap: 20px;
}

.filter button{
	background-color: #6d1c1c;
	color: white;
	border: none;
	padding: 12px 25px;
	border-radius: 8px;
	font-weight: bold;
}

.card-area{
	display: grid;
	grid-template-columns: repeat(2, 1fr);
	gap: 20px;
	padding: 0 30px 30px;
}

.menu-card{
	background-color: #f5d7af;
	border-radius: 15px;
	padding: 15px;
	display: flex;
	gap: 15px;
	align-items: center;
}

.menu-card img{
	width: 120px;
	height: 100px;
	object-fit: cover;
	border-radius: 50%;
	background-color: #ddd;
}

.menu-card button{
	background-color: #7a5542;
	color: white;
	border: none;
	padding: 8px 20px;
	border-radius: 8px;
	font-weight: bold;
}

.filter form{
	display:flex;
	gap:10px;
}

.filter input{
	padding:12px;
	border:none;
	border-radius:8px;
	background:#f5d7af;
}
</style>
</head>

<body>

<div class="header">
	<a href="admin_dashboard.php">
		<h2>NUTRIPLAN+</h2>
	</a>

	<div>
		<li><a href="setting.php">SETTING.</a></li>
	</div>
</div>

<div class="dashboard">
	<h1>GLAD TO HAVE YOU BACK, ADMIN</h1>
	<h3>Here's what's happening with NutriPlan+ today.</h3>

	<div class="top-area">
		<div class="stats">
			<div class="stat-box">
				<p>Menu Items</p>
				<h2><?php echo $totalMenu; ?></h2>
					<small>
						<?php echo $totalUnavailable; ?> unavailable
					</small>
			</div>

			<a href="admin_customers.php" style="text-decoration:none;color:inherit;">
				<div class="stat-box">
					<p>Customers</p>
					<h2><?php echo $totalCustomers; ?></h2>
					<small>Registered customers</small>
				</div>
			</a>
		</div>

		<div class="orders">
		<h3>Recent Orders</h3>

		<table>
			<tr>
				<th>Order ID</th>
				<th>Customer</th>
				<th>Items</th>
				<th>Total</th>
				<th>Date</th>
			</tr>

			<?php
			if($totalOrders == 0){
			?>
				<tr>
					<td colspan="5" style="text-align:center;">
						No order data available yet.
					</td>
				</tr>
			<?php
			}
			else{
				while($order = mysqli_fetch_array($orderQuery)){
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
	</div>
</div>
</div>

<div class="menu-nav">
	<a href="admin_dashboard.php">MENU MANAGEMENT.</a>
	<a href="admin_orderHistory.php">ORDER HISTORY.</a>
</div>

<div class="filter">

	<a href="admin_dashboard.php">
		<button type="button">
			ALL (<?php echo $totalMenu; ?>)
		</button>
	</a>

	<a href="admin_dashboard.php?filter=available">
		<button type="button">
			AVAILABLE (<?php echo $totalAvailable; ?>)
		</button>
	</a>

	<a href="admin_dashboard.php?filter=unavailable">
		<button type="button">
			UNAVAILABLE (<?php echo $totalUnavailable; ?>)
		</button>
	</a>

	<a href="admin_addItem.php">
		<button type="button">ADD ITEM</button>
	</a>

	<form method="get">
		<input type="text"
		name="search"
		placeholder="Search meal..."
		value="<?php echo $search; ?>">

		<button type="submit">
			SEARCH
		</button>
	</form>

</div>

<div class="card-area">

	<?php while($menu = mysqli_fetch_array($query)){ ?>

	<div class="menu-card">
		<img src="images/<?php echo $menu['image']; ?>">

		<div>
			<h3><?php echo $menu['meal_name']; ?></h3>

			<p>
				Price: MYR <?php echo number_format($menu['price'], 2); ?>
			</p>

			<p><?php echo $menu['category']; ?></p>

			<a href="admin_updateItem.php?id=<?php echo $menu['id_menu']; ?>">
				<button>UPDATE</button>
			</a>
		</div>
	</div>

	<?php } ?>

</div>

</body>
</html>