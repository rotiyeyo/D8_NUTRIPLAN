<?php
include("header_admin.php");
include("connection.php");
?>

<div class="setting-wrap">

	<div class="setting-left">
		<h1 class="setting-title">
			MANAGE YOUR INFO & MAKE YOUR EXPERIENCE JUST RIGHT
		</h1>

		<form action="setting-security-process.php" method="POST">

			<div class="field-group">
				<label>Current Password</label>
				<input type="text" name="current_password" required>
			</div>

			<div class="field-group">
				<label>New Password</label>
				<input type="text" name="new_password" required>
			</div>

			<div class="field-group">
				<label>Confirm New Password</label>
				<input type="text" name="confirm_password" required>
			</div>

	</div>

	<div class="setting-right">

		<div class="setting-menu">
			<a href="setting.php">PERSONAL INFORMATION</a>
			<a href="setting-security.php" class="menu-active">
				ACCOUNT & SECURITY
			</a>
			<a href="admin_signOut.php">SIGN OUT</a>
		</div>

		<input type="submit" value="Save !" class="btn-setting">

	</div>

	</form>

</div>

<?php include('footer.php'); ?>