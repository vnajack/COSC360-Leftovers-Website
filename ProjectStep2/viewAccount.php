<!DOCTYPE html>
<html lang="en">
<head>
  <title>My Account</title>
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

    global $isLoggedIn;
  ?>
  <main id="viewAccount">
    <?php
    if(!$isLoggedIn){
      include "include/error-notLoggedIn.inc.php";
      include "include/right-column.inc.php";
    }else{
      include "viewAccount-data.php";
    }
    ?>
  </main>
</div> <!-- this tag is not a stray its opening part is in the external javascript. it's here because this is a two-column layout. -->
  <?php
    include "include/footer.inc.php";
  ?>
</body>
</html>
