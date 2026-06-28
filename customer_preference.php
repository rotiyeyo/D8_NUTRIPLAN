<?php
include("header_customer.php");
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}
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
	font-size:38px;
	text-shadow:3px 3px #304a72;
	margin-bottom:25px;
}

.pref-grid{
	display:grid;
	grid-template-columns:repeat(2, 220px);
	gap:12px 50px;
	justify-content:center;
}

.pref-btn{
	background:#243853;
	color:white;
	border:none;
	border-radius:15px;
	padding:15px 20px;
	font-size:18px;
	font-weight:bold;
	cursor:pointer;
	text-align:left;
}

.pref-btn.selected{
	background:#6d1c1c;
}

.icon{
	font-size:25px;
	margin-right:12px;
}

.btn-continue{
	margin-top:25px;
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
	<h2 class="onboard-title">Customise your meal<br>preferences</h2>

	<form action="preference-process.php" method="POST">

		<input type="hidden" name="preferences" id="prefValue">

		<div class="pref-grid">
			<button type="button" class="pref-btn" value="vegetarian" onclick="selectPref(this)">
				<span class="icon">💡</span> Vegetarian
			</button>

			<button type="button" class="pref-btn" value="mediterranean" onclick="selectPref(this)">
				<span class="icon">🤲</span> Mediterranean
			</button>

			<button type="button" class="pref-btn" value="pescatarian" onclick="selectPref(this)">
				<span class="icon">🧺</span> Pescatarian
			</button>

			<button type="button" class="pref-btn" value="balanced" onclick="selectPref(this)">
				<span class="icon">🍱</span> Balanced Diet
			</button>
		</div>

		<input type="submit" value="Looks good! Let's continue" class="btn-continue">

	</form>
</div>

<script>
function selectPref(btn){
	document.querySelectorAll('.pref-btn').forEach(b => b.classList.remove('selected'));
	btn.classList.add('selected');
	document.getElementById('prefValue').value = btn.value;
}

document.querySelector("form").addEventListener("submit", function(e){
	if(document.getElementById("prefValue").value == ""){
		e.preventDefault();
		alert("Please choose your meal preference first.");
	}
});
</script>

<?php include("footer.php"); ?>