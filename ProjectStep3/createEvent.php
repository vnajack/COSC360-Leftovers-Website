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
    require_once("include/globals.inc.php");
    require_once("include/top-navigation-bar.inc.php");
    require_once("include/left-column.inc.php");

  ?>
  <main id="eventForm">
    <?php
    if(!isLoggedIn()){
      include "include/error-notLoggedIn.inc.php";
    }else if(isAdmin()){
      include "createEvent-form.php";
    }else{
      include "include/error-mustBeAdmin.inc.php";
    }
    ?>

  </main>
  <?php
  require_once("include/right-column.inc.php");
  require_once("include/footer.inc.php");
  ?>
</body>
</html>
