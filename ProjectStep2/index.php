<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
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

  <main id="findLeftovers">
    <h1>Where can I find leftovers?</h1>
    <p>Please note that when leftovers are posted, they are only available while supplies last. The "time left" is used to ensure we distribute the leftovers within a safe time limit. </p>
    <article>
      <h2><time datetime="2020-01-15 10:03">January 15th at 10:03am</time> <span class="time-remaining" title="Leftovers available while supplies last. This is only a freshness countdown.">Time left: 0:00</span></h2>
      <figure>
      <img src="images/food-posts/2020-01-15-1003.jpg" width="450" height="350" class="img-fluid" alt="Scones, ice coffee, Kashi bars, and smoothies">
      <figcaption>Scones, Iced Coffee, Kashi bars, and Smoothies</figcaption>
      </figure>
      <p>Where: Global Collegia in EME</p>
      <p>Estimated amount of food saved: __ kg</p>
      <p>Free scones, ice coffee, Kashi bars, and smoothies in the Global Collegia EME!!</p>
    </article>
    <article>
    	<h2><time datetime="2020-01-07 13:20">January 7th at 1:20pm</time> <span class="time-remaining" title="Freshness Countdown">Time left: 0:00</span></h2>
      <figure>
      <img src="images/food-posts/2020-01-07-1320.jpg" alt="Pastries, Juice, and Kashi bars">
      <figcaption>Pastries, Juice, and Kashi bars</figcaption>
      </figure>
      <p>Where: UNC collegia</p>
      <p>Estimated amount of food saved: __ kg</p>
      <p>Welcome back from winter break! Here are some pastries, juice, and Kashi bars!</p>
    </article>
    <article>
      <h2><time datetime="2019-12-13 13:40">December 13th at 1:40pm</time> <span class="time-remaining" title="Freshness Countdown">Time left: 0:00</span></h2>
      <figure>
      <img src="images/food-posts/2019-12-13-1340.jpg" alt="Lasagna and Sandwiches">
      <figcaption>Lasagna and Sandwiches</figcaption>
      </figure>
      <p>Where: Global collegia</p>
      <p>Estimated amount of food saved: __ kg</p>
      <p>Come grab some fuel! Beef and spinach lasagna, veggie lasagna, and veggie sandwiches!</p>
    </article>
    <article>
      <h2><time datetime="2019-12-12 15:55">December 12th at 3:55pm</time> <span class="time-remaining" title="Freshness Countdown">Time left: 0:00</span></h2>
      <figure>
      <img src="images/food-posts/2019-12-12-1555.jpg" alt="Sandwiches and Chicken">
      <figcaption>Sandwiches and Chicken</figcaption></figure>
      <p>Where: The Pantry's fridge and freezer (UNC)</p>
      <p>Estimated amount of food saved: __ kg</p>
      <p>Leftovers from Sunshine!</p>
    </article>
  </main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
