<?php
include("connection.php");
include("header_customer.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

if(!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0){
	header("Location: menu.php");
	exit();
}

$username = $_SESSION['username_c'];

$custQuery = mysqli_query($condb,
"SELECT * FROM customer_data WHERE username_c='$username'");

$customer = mysqli_fetch_array($custQuery);

$subtotal = 0;

foreach($_SESSION['cart'] as $item){
	$subtotal = $subtotal + ($item['price'] * $item['qty']);
}

$deliveryFee = 5.99;
$serviceTax = $subtotal * 0.06;
$grandTotal = $subtotal + $deliveryFee + $serviceTax;

if(isset($_POST['place_order'])){

	$firstname = $_POST['firstname'] ?? $customer['firstname_c'];
	$lastname  = $_POST['lastname'] ?? $customer['lastname_c'];
	$phone     = $_POST['phone'] ?? $customer['phonenum_c'];
	$address   = $_POST['address'] ?? $customer['address_c'];
	$payment = $_POST['payment'];

	mysqli_query($condb,
	"UPDATE customer_data
	SET firstname_c='$firstname',
	lastname_c='$lastname',
	phonenum_c='$phone',
	address_c='$address'
	WHERE username_c='$username'");

	$items = "";

	foreach($_SESSION['cart'] as $item){
		$items = $items . $item['name'] . " x" . $item['qty'] . ", ";
	}

	mysqli_query($condb,
		"INSERT INTO orders(username_c, items, total, payment_method, order_date)
		VALUES('$username','$items','$grandTotal','$payment',NOW())");

		$order_id = mysqli_insert_id($condb);

		unset($_SESSION['cart']);

		echo "<script>
		alert('Order placed successfully!');
		window.location.href='receipt.php?id=$order_id';
		</script>";
	}
?>

<title>Checkout</title>

<style>
body{
	margin:0;
	padding:0;
	background:#7086a0;
}

.wrapper{
	width:100%;
	margin:0;
}

.header{
	background:#6d1c1c;
	padding:15px 25px;
	display:flex;
	justify-content:space-between;
	align-items:center;
}

.header a{
	color:white;
	text-decoration:none;
	font-weight:bold;
}

.nav{
	display:flex;
	gap:30px;
}

.title{
	text-align:center;
	font-size:55px;
	text-shadow:3px 3px #3d4b5c;
	margin:25px 0;
}

.checkout-content{
	display:flex;
	padding:0 45px 30px;
	gap:45px;
}

.left{
	width:45%;
}

.right{
	width:45%;
	border-left:2px solid #c7d1db;
	padding-left:45px;
}

.customer-card{
	font-weight:bold;
	margin-bottom:25px;
}

.customer-card p{
	margin:3px 0;
}

.edit-btn{
	margin-top:10px;
	background:#1f3b60;
	color:white;
	border:none;
	padding:8px 25px;
	border-radius:6px;
	font-weight:bold;
	cursor:pointer;
}

.summary-row{
	display:flex;
	justify-content:space-between;
	font-weight:bold;
	margin:5px 0;
}

.payment-box{
	margin-top:25px;
	background:#7a5542;
	padding:15px;
	border-radius:8px;
}

.payment-box label{
	display:flex;
	justify-content:space-between;
	margin:8px 0;
	font-weight:bold;
}

.food-card{
	background:#f5d7af;
	color:#6d1c1c;
	border-radius:20px;
	padding:15px;
	display:flex;
	align-items:center;
	gap:15px;
	margin-bottom:25px;
}

.food-card img{
	width:130px;
	height:130px;
	border-radius:50%;
	object-fit:cover;
}

.food-info h3{
	margin:0;
}

.food-info p{
	margin:5px 0;
	font-weight:bold;
}

.bottom-bar{
	background:#243853;
	padding:15px 35px;
	display:flex;
	justify-content:flex-end;
	align-items:center;
	gap:25px;
}

.total{
	background:#89b7e5;
	padding:12px 40px;
	border-radius:25px;
	font-weight:bold;
}

.checkout{
	background:#6d7f95;
	color:white;
	border:none;
	padding:12px 45px;
	border-radius:25px;
	font-weight:bold;
	cursor:pointer;
}

.box input, .box textarea{
	width:100%;
	padding:10px;
	margin-bottom:10px;
	border:none;
	border-radius:8px;
}

.customer-card{
	background:#f5d7af;
	color:#6d1c1c;
	padding:20px;
	border-radius:15px;
	margin-bottom:25px;
}

.cust-name{
	font-family:'Anton', sans-serif;
	font-size:26px;
	letter-spacing:1px;
}

.cust-phone{
	font-family:'Anton', sans-serif;
	font-size:20px;
	letter-spacing:1px;
}

.cust-address{
	font-family:'Anton', sans-serif;
	font-size:20px;
	letter-spacing:1px;
}

.back-cart{
	background:#7a5542;
	color:white;
	text-decoration:none;
	padding:12px 30px;
	border-radius:25px;
	font-weight:bold;
}
</style>

<form method="post">

<div class="wrapper">

	<h1 class="title">YAY! LET'S CHECKOUT!</h1>

	<div class="checkout-content">

		<div class="left">

			<div class="customer-card" id="displayInfo">

				<p class="cust-name">
					<?php echo $customer['firstname_c']." ".$customer['lastname_c']; ?>
				</p>

				<p class="cust-phone">
					<?php echo $customer['phonenum_c']; ?>
				</p>

				<p class="cust-address">
					<?php echo $customer['address_c']; ?>
				</p>
			</div>

			<div class="box" id="editInfo" style="display:none;">
				<label>First Name</label>
				<input type="text" name="firstname" value="<?php echo $customer['firstname_c']; ?>">

				<label>Last Name</label>
				<input type="text" name="lastname" value="<?php echo $customer['lastname_c']; ?>">

				<label>Phone</label>
				<input type="text" name="phone" value="<?php echo $customer['phonenum_c']; ?>">

				<label>Address</label>
				<textarea name="address"><?php echo $customer['address_c']; ?></textarea>
				<button type="button" class="edit-btn" onclick="cancelEdit()">
					Cancel
				</button>
			</div>

			<div class="summary-row">
				<span>Subtotal</span>
				<span>MYR <?php echo number_format($subtotal,2); ?></span>
			</div>

			<div class="summary-row">
				<span>Delivery</span>
				<span>MYR <?php echo number_format($deliveryFee,2); ?></span>
			</div>

			<div class="summary-row">
				<span>Service Tax</span>
				<span>MYR <?php echo number_format($serviceTax,2); ?></span>
			</div>

			<div class="payment-box">
				<p><b>Payment method</b></p>

				<label>
					Cash
					<input type="radio" name="payment" value="Cash" required>
				</label>

				<label>
					Credit or debit card
					<input type="radio" name="payment" value="Card">
				</label>

				<label>
					Online Banking
					<input type="radio" name="payment" value="Online Banking">
				</label>
			</div>

		</div>

		<div class="right">

			<?php foreach($_SESSION['cart'] as $row){ ?>

			<div class="food-card">
				<img src="images/<?php echo $row['image']; ?>">

				<div class="food-info">
					<h3><?php echo $row['name']; ?></h3>
					<p>Qty: <?php echo $row['qty']; ?></p>
					<p>Price: MYR <?php echo number_format($row['price'],2); ?></p>
				</div>
			</div>

			<?php } ?>

		</div>
	</div>

	<div class="bottom-bar">

		<a href="order_More.php" class="back-cart">
			← Back to Cart
		</a>

		<div class="total">
			Total : RM <?php echo number_format($grandTotal,2); ?>
		</div>

		<button type="submit" name="place_order" class="checkout">
			Place Order
		</button>

	</div>

</div>

</form>

<script>
function showEdit(){
	document.getElementById("displayInfo").style.display="none";
	document.getElementById("editInfo").style.display="block";
}

function cancelEdit(){
	document.getElementById("displayInfo").style.display="block";
	document.getElementById("editInfo").style.display="none";
}
</script>

<?php include("footer.php"); ?>
