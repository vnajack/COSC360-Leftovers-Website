<?php
 require_once('include/globals.inc.php');
 $date = date("F jS Y"); //TODO: This is just taking today's date, so we need to figure out how to get the last date it was updated
?>

<footer>
  <div id="footer-container">
    <div id="footer-left">
      <h1>Our Partners</h1>
      <a href="https://www.ubcsuo.ca/"><img src="images/logo_ubcsuo.png" alt="UBCSUO Logo"></a>
      <a href="https://enactusubco.ca/"><img src="images/logo_enactus.jpg" alt="Enactus Logo"></a>
      <a href="https://enactusubco.ca/project-roots/"><img src="images/logo_projectRoots.png" alt="Project Roots Logo"></a>
    </div>
    <div id="footer-middle">
      <h1>Contact Us</h1>
  		<p>Email us at <a href="mailto:leftoversubco@gmail.com?Subject=From%20Leftovers%20Club%20Website" target="_top">leftoversUBCO@gmail.com</a> or send us a message on <a href="https://www.facebook.com/LeftoversUBCO/">Facebook</a>.</p>
      <p id="last-edited">Last edited <time datetime="<?php echo $date; ?>"><?php echo $date; ?></time>.</p>
    </div>
    <div id="footer-right">
      <h1>More Resources</h1>
      <a href="https://lovefoodhatewaste.ca/about/food-waste/"><img src="images/logo_LFHW.png" alt="Love Food Hate Waste Canada Logo"></a>
      <a href="https://feeditforward.ca/"><img src="images/logo_FIF.png" alt="Feed It Forward Logo"></a>
    </div>
  </div>
</footer>
