<?php 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Nutri+</title>
	<link rel="stylesheet" href="style.css">
</head>
<body>

<nav class="navbar">
    <a href="mainpage.php">NUTRIPLAN+</a>
</nav>

<div class="mainpage-wrap">
    <div class="left">
        <div class="brand-hero">NUTRIPLAN+</div>
        <p class="tagline">Simplify your experience with saved details for faster, personalised meal planning.</p>

        <div class="kit-images">
            <img src="images/mealkit2box.jpg" alt="Meal Kit Box">
        </div>
    </div>

    <div class="right">
        <img src="images/mealkithand.jpg" alt="Meal Kit Hand">

        <a href="createaccount.php">
            <input type="button" value="Get started" class="btn-primary" style="width:360px; cursor:pointer;">
        </a>

        <p style="font-weight:700; color:var(--brown-dark);">
            Already have an account? <a href="signin.php" style="color:var(--slate-btn); font-weight:800;">Sign in</a>
        </p>
    </div>
</div>

<?php 
	include("footer.php");
?>
</body>
</html>

<!--    ------------------------------
<h1>NUTRIPLAN+</h1>
<p>Simplify your experience with saved details for faster, personalised meal planning.</p>

<a href = "createaccount.php"> <button>Get Started</button> </a>
<p>Already have an account? <a href = "signin.php"> Sign in </a> </p>


CHECK THIS!!!!!
-->