<?php
session_start();

include("header_admin.php");
include("connection.php");

if(!isset($_SESSION['admin'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_a'];

$query = mysqli_query($condb,
"SELECT * FROM admin_data WHERE username_a='$username'");

$m = mysqli_fetch_array($query);
?>

<div class="setting-wrap">

    <div class="setting-left">
        <h1 class="setting-title">MANAGE YOUR INFO & MAKE YOUR EXPERIENCE JUST RIGHT</h1>

        <form action="setting-process.php" method="POST">

            <div class="field-group">
                <label>First Name</label>
				<input type="text" name="firstname" value="<?php echo $m['firstname_a']; ?>">
            </div>

            <div class="field-group">
                <label>Last Name</label>
				<input type="text" name="lastname" value="<?php echo $m['lastname_a']; ?>">
            </div>

            <div class="field-group">
                <label>Email Address</label>
				<input type="email" name="email" value="<?php echo $m['email_a']; ?>">
            </div>

            <div class="field-group">
                <label>Phone Number</label>
				<input type="text" name="phonenumber" value="<?php echo $m['phonenum_a']; ?>">
            </div>

        </div>

        <div class="setting-right">

            <div class="setting-menu">
                <a href="setting.php" class="menu-active">PERSONAL INFORMATION</a>
                <a href="setting-security.php">ACCOUNT & SECURITY</a>
                <a href="admin_signOut.php">SIGN OUT</a>
            </div>

            <input type="submit" value="Save !" class="btn-setting">

        </div>

    </form>

</div>

<?php include('footer.php'); ?>