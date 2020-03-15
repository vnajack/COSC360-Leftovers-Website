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

    global $isLoggedIn, $isAdminLoggedIn;
  ?>
  <main id="eventForm">
    <?php
    if(!$isLoggedIn){
      include "include/error-notLoggedIn.inc.php";
    }else if(!$isAdminLoggedIn){
      include "include/error-mustBeAdmin.inc.php";
    }else{
      include "createEvent-form.php";
    }
    ?>

  </main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
