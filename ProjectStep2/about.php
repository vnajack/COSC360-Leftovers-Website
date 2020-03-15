<!DOCTYPE html>
<html lang="en">
<head>
  <title>About Us</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    include "include/checkLoggedIn.inc.php";
    include "include/top-navigation-bar.inc.php";
    include "include/left-column.inc.php";
  ?>
  <main id="aboutUs">
	<h1>About Us</h1>
		<h2>Who We Are</h2>
		<p> Founded in ____, the Leftovers Club is an initiative working to reduce food waste at UBCO. We provide free food whereabouts, access to community events, and useful nutrition/food tips.</p>
		<p> Goals: </p>
		<ol>
			<li> Reduce food waste </li>
			<li> Provide knowledge on food drop whereabouts </li>
			<li> Have involvement opportunities </li>
			<li> Food sustainability, education, and awareness </li>
			<li> Teach you how to eat healthy on a budget </li>
			<li> Hold fun and educational community events </li>
		</ol>
		<p><a href= "https://www.cbc.ca/news/canada/toronto/food-waste-report-second-harvest-1.4981728">According to CBC</a>, in 2019, 58% of food in Canada is wasted. Not only does this have a lasting environmental impact, but the food that’s being thrown out is in perfectly good condition and thus could still be consumed.</p>
		<h2>Contact Us</h2>
		<p>Contact us by email <a href="mailto:leftoversubco@gmail.com?Subject=From%20Leftovers%20Club%20Website" target="_top"><img src='images/email_16.png'></a> or through Facebook <a href="https://www.facebook.com/LeftoversUBCO/"><img src="images/facebook_16.png" alt="Facebook Link"></a></p>
	</main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
