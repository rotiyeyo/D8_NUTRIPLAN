<?php
$page_title = "NUTRIPLAN+ · Account Security";
include("header_customer.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

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

			<form id="main-form" method="POST" action="process_security.php">
			  <div class="field">
				<label>Current Password</label>
				<input type="text" name="current_password" required>
			  </div>
			  <div class="field">
				<label>New Password</label>
				<input type="text" name="new_password" required>
			  </div>
		</form>
  </div>

  <div class="divider"></div>

  <div class="sidebar">
		<nav class="sidebar-nav">
		  <a href="customer_personalInfo.php">Personal Information</a>
		  <a href="deliveryDetails.php">Delivery Details</a>
		  <a href="foodPreferences.php">Food Preferences</a>
		  <a href="accountSecurity.php" class="active">Account &amp; Security</a>
		  <a href="customer_signOut.php">Sign Out</a>
		</nav>
		<div class="save-wrap">
		  <button class="save-btn" onclick="document.getElementById('main-form').submit()">Save !</button>
		</div>
	  </div>
	</div>
</div>
<?php include("footer.php"); ?>