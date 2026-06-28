<?php
session_start();
include('header_admin.php');
?>
<div class="setting-wrap">

    <div class="setting-left">
        <h1 class="setting-title">MANAGE YOUR INFO & MAKE YOUR EXPERIENCE JUST RIGHT</h1>

        <p class="signout-text">Are you sure?</p>

        <a href="signout-process.php">
            <input type="button" value="Sure !" class="btn-setting">
        </a>
        <br><br>
        <a href="admin_dashboard.php">
            <input type="button" value="No" class="btn-setting">
        </a>

    </div>

    <div class="setting-right">

        <div class="setting-menu">
            <a href="setting.php">PERSONAL INFORMATION</a>
            <a href="setting-security.php">ACCOUNT & SECURITY</a>
            <a href="admin_signOut.php" class="menu-active">SIGN OUT</a>
        </div>

    </div>

</div>

<?php include('footer.php'); ?>