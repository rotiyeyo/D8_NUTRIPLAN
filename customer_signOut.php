<?php
session_start();
$page_title = "NUTRIPLAN+ · Logout Confirmation";
include 'header_customer.php';
?>
<div class="setting-page">
	<div class="page">

		<div class="left">
			<div class="headline">
				MANAGE YOUR INFO &amp; MAKE YOUR EXPERIENCE JUST RIGHT
			</div>

			<div class="signout-prompt">Are you sure?</div>

			<div class="signout-stack">
				<form method="POST" action="process_signout.php" style="width:100%">
					<button type="submit" class="gold-btn">Sure !</button>
				</form>

				<a href="menu.php" class="gold-btn">No</a>
			</div>
		</div>

		<div class="divider"></div>

		<div class="sidebar">
			<nav class="sidebar-nav">
				<a href="customer_personalInfo.php">Personal Information</a>
				<a href="deliveryDetails.php">Delivery Details</a>
				<a href="foodPreferences.php">Food Preferences</a>
				<a href="accountSecurity.php">Account Security</a>
				<a href="customer_signOut.php" class="active">Sign Out</a>
			</nav>
		</div>

	</div>
</div>

<?php include("footer.php"); ?>