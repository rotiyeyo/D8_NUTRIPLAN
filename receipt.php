<?php
include("header_customer.php");
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

if(!isset($_GET['id'])){
	header("Location: menu.php");
	exit();
}

$id = $_GET['id'];
$username = $_SESSION['username_c'];

$orderQuery = mysqli_query($condb,
"SELECT * FROM orders 
WHERE id_order='$id' AND username_c='$username'");

$order = mysqli_fetch_array($orderQuery);

if(!$order){
	header("Location: menu.php");
	exit();
}

$custQuery = mysqli_query($condb,
"SELECT * FROM customer_data WHERE username_c='$username'");

$customer = mysqli_fetch_array($custQuery);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="style.css">
</head>

<div style="background:#7a5542; min-height:80vh; padding:40px;">

	<div style="background:#f5d7af; color:#6d1c1c; width:600px; margin:auto; padding:30px; border-radius:15px;">

		<h1 style="text-align:center;">NUTRIPLAN+ RECEIPT</h1>

		<p><b>Receipt No:</b> #<?php echo $order['id_order']; ?></p>
		<p><b>Date:</b> <?php echo $order['order_date']; ?></p>

		<hr>

		<p><b>Customer:</b> <?php echo $customer['firstname_c']." ".$customer['lastname_c']; ?></p>
		<p><b>Phone:</b> <?php echo $customer['phonenum_c']; ?></p>
		<p><b>Address:</b> <?php echo $customer['address_c']; ?></p>

		<hr>

		<p><b>Items:</b></p>
		<p><?php echo $order['items']; ?></p>

		<p><b>Payment Method:</b> <?php echo $order['payment_method']; ?></p>

		<h2>Total: RM <?php echo number_format($order['total'], 2); ?></h2>

		<a href="orderStatus.php">
			<button>Order Status</button>
		</a>

		<a href="menu.php">
			<button>Back to Menu</button>
		</a>

	</div>

</div>

<?php include("footer.php"); ?>