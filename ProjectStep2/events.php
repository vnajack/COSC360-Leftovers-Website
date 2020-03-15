<!DOCTYPE html>
<html lang="en">
<head>
  <title>Events</title>
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
  <main id="eventsList">
  		<section id="upcomingEvents">
  		  	<h1>Upcoming Events</h1>
  	    	<article>
  				<h2>Pickling Party</h2>
  		        <img src="#" alt="Poster for Pickling Event"> <!-- poster here-->
  				<p>When: <time datetime="2020-02-01 12:00">February xth at xx:xx</time></p>
  		        <p>Where: Location TBD</p>
  		        <p>Are you interested in learning how to pickle? Stop by to learn how to reduce food waste through pickling. Don't forget to bring your own ___. We supply the ___.</p>
  			</article>
  			<article>
  				<h2>Some other event</h2>
  		        <img src="#" alt="Poster for other event"> <!-- poster here-->
  		        <p>When: <time datetime="2020-03-01 12:00">March xth at xx:xx</time></p>
  		        <p>Where: Location TBD</p>
  		        <p>Add more information for this event here</p>
  			</article>
  		</section>
  		<br>
  		<section id="pastEvents">
        	<h1>Past Events</h1>
  	     	<article>
  		        <h2>How-to Kombucha</h2>
  		        <img src="#" alt="Poster for How-to Kombucha"> <!-- poster or picture from event here-->
  		        <p>When: <time datetime="2019-04-12 18:00">April 12th, 2019 at 6:00pm</time></p>
  		        <p>Where: </p>
  		        <p>Add more information for this event here</p>
  	      	</article>
  	      	<article>
  		        <h2>Pickling Event</h2>
  		        <img src="#" alt="Poster for Pickling Event"> <!-- poster or picture from event here-->
  		        <p>When: <time datetime="2019-02-13 17:00">February 13th, 2019 at 5:00pm</time></p>
  		        <p>Where: Senior collegium</p>
  		        <p>Add more information for this event here</p>
  	      	</article>
  		</section>
  	</main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
