<?php
  include "checkLoggedIn.inc.php";
  global $isLoggedIn;
?>
</section>
<section id="right-sidebar">
  <article>
    <h1>Get Involved</h1>
    <ul class="nav-pills">
      <li><a href="index.php">Where can I find leftovers?</a></li>
      <?php
      if(!$isLoggedIn){
        echo "<li><a href=\"volunteerForm.php\">How can I volunteer?</a></li>";
      }
      ?>
      <li><a href="foodDonorForm.php">What if I have leftovers?</a></li>
    </ul>
  </article>
</section>
</div>
