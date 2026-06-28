<?php
include("header_customer.php");
include("connection.php");

if(!isset($_SESSION['username_c'])){
	header("Location: signin.php");
	exit();
}

$username = $_SESSION['username_c'];

/* current preference */
$prefQuery = mysqli_query($condb,
"SELECT id_preference FROM customer_prefer
WHERE username_c='$username'");

$prefData = mysqli_fetch_array($prefQuery);
$sel_meal = $prefData['id_preference'] ?? "";

/* current allergies */
$sel_allergies = array();

$allergyQuery = mysqli_query($condb,
"SELECT id_allergies FROM customer_allergy
WHERE username_c='$username'");

while($row = mysqli_fetch_array($allergyQuery)){
	$sel_allergies[] = $row['id_allergies'];
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

			<form id="main-form" method="POST" action="process_food.php">

				<input type="hidden" name="meal_pref" id="meal_pref_val" value="<?php echo $sel_meal; ?>">

				<div class="section-label">Meal Preferences</div>

				<div class="pref-grid">
					<button type="button" class="pref-btn <?php if($sel_meal==1) echo 'sel'; ?>" data-meal="1" onclick="pickMeal(this)">Vegetarian</button>
					<button type="button" class="pref-btn <?php if($sel_meal==2) echo 'sel'; ?>" data-meal="2" onclick="pickMeal(this)">Mediterranean</button>
					<button type="button" class="pref-btn <?php if($sel_meal==3) echo 'sel'; ?>" data-meal="3" onclick="pickMeal(this)">Pescatarian</button>
					<button type="button" class="pref-btn <?php if($sel_meal==4) echo 'sel'; ?>" data-meal="4" onclick="pickMeal(this)">Balanced Diet</button>
				</div>

				<div class="section-label">Food Allergies</div>

				<div class="allergy-grid" id="allergy-grid">

					<?php
					$list = mysqli_query($condb, "SELECT * FROM allergy_list");

					while($a = mysqli_fetch_array($list)){
						$id = $a['id_allergies'];
						$name = $a['allergy_name'];
						$checked = in_array($id, $sel_allergies);
					?>

					<button type="button"
						class="allergy-btn <?php if($checked) echo 'sel'; ?>"
						data-allergy="<?php echo $id; ?>"
						onclick="toggleAllergy(this)">
						<span class="dot"></span><?php echo $name; ?>
					</button>

					<?php } ?>

				</div>

				<div id="allergy-inputs">
					<?php foreach($sel_allergies as $id){ ?>
						<input type="hidden" name="allergies[]" value="<?php echo $id; ?>">
					<?php } ?>
				</div>

			</form>
		</div>

		<div class="divider"></div>

		<div class="sidebar">
			<nav class="sidebar-nav">
				<a href="customer_personalInfo.php">Personal Information</a>
				<a href="deliveryDetails.php">Delivery Details</a>
				<a href="foodPreferences.php" class="active">Food Preferences</a>
				<a href="accountSecurity.php">Account Security</a>
				<a href="customer_signOut.php">Sign Out</a>
			</nav>

						<div class="save-wrap">
				<button class="save-btn" onclick="document.getElementById('main-form').submit()">Save !</button>
			</div>
		</div>
	</div>
</div>

<script>
function pickMeal(btn){
	document.querySelectorAll('.pref-btn').forEach(b => b.classList.remove('sel'));
	btn.classList.add('sel');
	document.getElementById('meal_pref_val').value = btn.dataset.meal;
}

function toggleAllergy(btn){
	btn.classList.toggle('sel');

	var container = document.getElementById('allergy-inputs');
	container.innerHTML = '';

	document.querySelectorAll('#allergy-grid .allergy-btn.sel').forEach(function(b){
		var input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'allergies[]';
		input.value = b.dataset.allergy;
		container.appendChild(input);
	});
}
</script>

<?php include("footer.php"); ?>