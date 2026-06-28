<?php
include("header_customer.php");
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];

$query = mysqli_query($condb,
"SELECT address_c FROM customer_data WHERE username_c='$username'");

$user = mysqli_fetch_array($query);

$message = $_SESSION['message'] ?? '';
unset($_SESSION['message']);
?>

<div class="setting-page">
	<div class="page">

		<div class="left">
			<div class="headline">
				MANAGE YOUR INFO & MAKE YOUR EXPERIENCE JUST RIGHT
			</div>
			
		<?php if($message != ""){ ?>
			<div class="toast"><?php echo $message; ?></div>
		<?php } ?>

		<form id="main-form" method="POST" action="process_delivery.php">
			<div class="field">
				<label>Delivery Address</label>

				<textarea name="address"
				placeholder="Enter your delivery address here..."><?php echo $user['address_c']; ?></textarea>
			</div>
		</form>
	  </div>

	  <div class="divider"></div>

	  <div class="sidebar">
		<nav class="sidebar-nav">
		  <a href="customer_personalInfo.php">Personal Information</a>
		  <a href="deliveryDetails.php" class="active">Delivery Details</a>
		  <a href="foodPreferences.php">Food Preferences</a>
		  <a href="accountSecurity.php">Account &amp; Security</a>
		  <a href="customer_signOut.php">Sign Out</a>
		</nav>
		<div class="save-wrap">
		  <button class="save-btn" onclick="document.getElementById('main-form').submit()">Save !</button>
		</div>
	  </div>
	</div>
<?php include("footer.php"); ?>