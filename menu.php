<?php
include("header_customer.php");
include("connection.php");

$username = $_SESSION['username_c'];

/* get customer preference */
$prefQuery = mysqli_query($condb,
"SELECT id_preference FROM customer_prefer
WHERE username_c='$username'");

$prefData = mysqli_fetch_array($prefQuery);
$id_preference = $prefData['id_preference'] ?? "";

/* get preference name */
$prefName = "";

if($id_preference != ""){
	$pq = mysqli_query($condb,
	"SELECT preference_name FROM diet_preference
	WHERE id_preference='$id_preference'");

	$pr = mysqli_fetch_array($pq);
	$prefName = $pr['preference_name'];
}

/* base query */
$sql = "SELECT * FROM menu_item WHERE status='Available'";

/* filter by preference n categ */
if($prefName != ""){
	$sql .= " AND category='$prefName'";
}

/* filter allergies */
$allergyQuery = mysqli_query($condb,
"SELECT id_allergies FROM customer_allergy
WHERE username_c='$username'");

while($row = mysqli_fetch_array($allergyQuery)){
	$id_allergy = $row['id_allergies'];

	$aq = mysqli_query($condb,
	"SELECT allergy_name FROM allergy_list
	WHERE id_allergies='$id_allergy'");

	$ar = mysqli_fetch_array($aq);

	if($ar){
		$allergyName = $ar['allergy_name'];
		$sql .= " AND allergy NOT LIKE '%$allergyName%'";
	}
}

$query = mysqli_query($condb, $sql);
?>

<style>
.hero{
	height:750px;
	display:flex;
	flex-direction:column;
	justify-content:center;
	align-items:center;
	text-align:center;
	color:#243853;
	background-image:url("./images/menuBG.png");
	background-size:cover;
	background-position:center;
}

.hero h1{
	font-size:45px;
	margin-bottom:10px;
}

.hero p{
	font-size:20px;
	font-weight:bold;
}

.menu-section{
	padding:50px 40px;
	background-color:#7a5542;
	color:white;
}

.menu-section h1{
	font-size:28px;
	margin-bottom:10px;
}

.menu-section p{
	margin-bottom:20px;
}

.menu-section h2{
	text-align:center;
	font-size:35px;
	margin-bottom:30px;
	color:#f3d5ad;
}

.menu-wrapper{
	display:flex;
	align-items:center;
	gap:20px;
}

.arrow{
	width:50px;
	height:50px;
	border:none;
	border-radius:50%;
	font-size:25px;
	cursor:pointer;
	background-color:#6d1c1c;
	color:white;
}

.card-container{
	display:flex;
	gap:20px;
	overflow-x:auto;
	scroll-behavior:smooth;
	width:100%;
	padding:10px;
}

.card-container::-webkit-scrollbar{
	display:none;
}

.card{
	min-width:250px;
	background-color:#5f7f9c;
	border-radius:10px;
	padding:20px;
	flex-shrink:0;
	text-align:center;
	color:white;
}

.card img{
	width:100%;
	height:180px;
	object-fit:cover;
	border-radius:10px;
	background-color:#ddd;
}

.card h3{
	margin-top:15px;
}

.card p{
	margin-top:10px;
	font-weight:bold;
	color:white;
}

button.add{
	margin-top:15px;
	padding:10px 20px;
	border:none;
	border-radius:5px;
	background-color:#6d1c1c;
	color:white;
	cursor:pointer;
}
</style>

<div class="hero">
</div>

<div class="menu-section">

	<h1>HERE'S WHAT WE THINK YOU'LL LOVE</h1>
	<p>We've matched these recipes to your preferences — give them a try!</p>

	<h2>Recommended Meals</h2>

	<div class="menu-wrapper">

		<button class="arrow" onclick="moveLeft()">&#10094;</button>

		<div class="card-container" id="slider">

			<?php while($menu = mysqli_fetch_array($query)){ ?>

				<div class="card">

					<img src="images/<?php echo $menu['image']; ?>">

					<h3><?php echo $menu['meal_name']; ?></h3>

					<p>MYR <?php echo number_format($menu['price'], 2); ?></p>

					<a href="selected_Menu.php?id=<?php echo $menu['id_menu']; ?>">
						<button class="add">View Details</button>
					</a>

				</div>

			<?php } ?>

		</div>

		<button class="arrow" onclick="moveRight()">&#10095;</button>

	</div>
</div>

<script>
function moveLeft(){
	document.getElementById("slider").scrollBy({
		left:-300,
		behavior:"smooth"
	});
}

function moveRight(){
	document.getElementById("slider").scrollBy({
		left:300,
		behavior:"smooth"
	});
}
</script>

<?php include("footer.php"); ?>