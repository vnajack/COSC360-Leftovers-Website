<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create a Food Post</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    require_once('include/globals.inc.php');
    require_once("include/top-navigation-bar.inc.php");
    require_once("include/left-column.inc.php");

  ?>
  <main id="leftoversForm">
  <?php
  if(isLoggedIn()){
    require_once("createFoodPost-form.php");
  }else{
    require_once("include/error-notLoggedIn.inc.php");
  }
  ?>
  </main>
  <?php
    require_once("include/right-column.inc.php");
    require_once("include/footer.inc.php");
  ?>
</body>
</html>
