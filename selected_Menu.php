<?php
include("connection.php");
include("header_customer.php");

if(!isset($_GET['id'])){
	header("Location: menu.php");
	exit();
}

$id = $_GET['id'];

$query = mysqli_query($condb, "SELECT * FROM menu_item WHERE id_menu='$id'");
$menu = mysqli_fetch_array($query);

if(!$menu){
	header("Location: menu.php");
	exit();
}

if(isset($_POST['add'])){

	$itemName = $_POST['name'];
	$itemPrice = $_POST['price'];
	$itemQty = $_POST['quantity'];
	$itemImage = $_POST['image'];

	$found = false;

	if(isset($_SESSION['cart'])){
		for($i = 0; $i < count($_SESSION['cart']); $i++){

			if($_SESSION['cart'][$i]['name'] == $itemName){
				$_SESSION['cart'][$i]['qty'] += $itemQty;
				$found = true;
			}
		}
	}

	if($found == false){
		$_SESSION['cart'][] = array(
			"name" => $itemName,
			"price" => $itemPrice,
			"qty" => $itemQty,
			"image" => $itemImage
		);
	}

	header("Location: order_More.php");
	exit();
}
?>

<style>
body{
	background-color:#7a5542;
	color:white;
}

.detail-section{
	padding:40px;
	display:flex;
	gap:40px;
	align-items:center;
}

.detail-text{
	width:50%;
}

.detail-text h1{
	font-size:50px;
	margin-bottom:15px;
}

.badge{
	background-color:#d8b300;
	padding:8px 25px;
	border-radius:20px;
	display:inline-block;
	margin-bottom:15px;
}

.price{
	font-size:20px;
	font-weight:bold;
	margin-bottom:5px;
}

.line{
	border-top:2px solid white;
	margin:20px 0;
}

.detail-text li{
	margin-bottom:10px;
	line-height:1.5;
}

.food-img{
	width:45%;
	text-align:center;
}

.food-img img{
	width:420px;
	height:420px;
	object-fit:cover;
	border-radius:50%;
	display:block;
	margin:auto;
}

.quantity-box{
	margin-top:30px;
	display:flex;
	align-items:center;
	gap:15px;
}

.quantity-box input{
	width:70px;
	padding:10px;
	text-align:center;
	font-size:18px;
}

.add-btn{
	margin-top:25px;
	padding:15px 50px;
	border:none;
	border-radius:10px;
	background-color:#5f7f9c;
	color:white;
	font-weight:bold;
	cursor:pointer;
}

.back-btn{
	margin-top:15px;
	padding:12px 25px;
	border:none;
	border-radius:8px;
	background:#6d1c1c;
	color:white;
	font-weight:bold;
	cursor:pointer;
}
</style>

<div class="detail-section">

	<div class="detail-text">

		<h1><?php echo $menu['meal_name']; ?></h1>

		<div class="badge">⭐ Recommended</div>

		<p class="price">
			MYR <?php echo number_format($menu['price'], 2); ?>
		</p>

		<p><u>Shipping calculated at check out</u></p>

		<div class="line"></div>

		<ul>
			<li><?php echo $menu['description']; ?></li>
			<li>Category: <?php echo $menu['category']; ?></li>
			<li>Status: <?php echo $menu['status']; ?></li>
		</ul>

		<form method="post">

			<input type="hidden" name="name" value="<?php echo $menu['meal_name']; ?>">
			<input type="hidden" name="price" value="<?php echo $menu['price']; ?>">
			<input type="hidden" name="image" value="<?php echo $menu['image']; ?>">

			<div class="quantity-box">
				<label>Quantity:</label>
				<input type="number" name="quantity" id="quantity" value="1" min="1" oninput="calculateTotal()">
			</div>

			<p class="price">
				Total: MYR <span id="totalPrice"><?php echo number_format($menu['price'], 2); ?></span>
			</p>

			<a href="menu.php">
				<button type="button" class="back-btn">← Back</button>
			</a>

			<button type="submit" name="add" class="add-btn">
				Add to Cart
			</button>

		</form>
	</div>

	<div class="food-img">
		<img src="images/<?php echo $menu['image']; ?>">
	</div>

</div>

<script>
function calculateTotal(){
	var price = <?php echo $menu['price']; ?>;
	var quantity = document.getElementById("quantity").value;
	var total = price * quantity;

	document.getElementById("totalPrice").innerHTML = total.toFixed(2);
}
</script>

<?php include("footer.php"); ?>