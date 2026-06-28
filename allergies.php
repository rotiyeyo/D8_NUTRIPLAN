<?php
include("header_customer.php");
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$allergyQuery = mysqli_query($condb,
"SELECT * FROM allergy_list");
?>

<style>
body{
	background:repeating-linear-gradient(
		90deg,
		#6f879f,
		#6f879f 30px,
		#304a72 30px,
		#304a72 60px
	);
}

.onboard-body{
	text-align:center;
	padding:35px 20px;
	color:#f5d7af;
}

.onboard-title{
	font-size:45px;
	text-shadow:3px 3px #304a72;
	margin-bottom:35px;
}

.allergy-grid{
	display:grid;
	grid-template-columns:repeat(4, 220px);
	gap:18px;
	justify-content:center;
}

.allergy-label{
	background:#243853;
	color:white;
	border-radius:15px;
	padding:18px;
	font-size:18px;
	font-weight:bold;
	text-align:left;
}

.allergy-label input{
	margin-right:12px;
	transform:scale(1.3);
}

.btn-continue{
	margin-top:35px;
	padding:13px 35px;
	border:none;
	border-radius:20px;
	background:#d8b300;
	color:white;
	font-weight:bold;
	cursor:pointer;
}
</style>

<div class="onboard-body">
	<h2 class="onboard-title">Do you have any food allergies?</h2>

	<form action="allergies-process.php" method="POST">

		<div class="allergy-grid">

			<?php while($row = mysqli_fetch_array($allergyQuery)){ ?>
				<label class="allergy-label">
					<input type="checkbox" 
						   name="allergies[]" 
						   value="<?php echo $row['id_allergies']; ?>">
					<?php echo $row['allergy_name']; ?>
				</label>
			<?php } ?>

		</div>

		<input type="submit" value="Looks good! Let's continue" class="btn-continue">

	</form>
</div>

<?php include("footer.php"); ?>