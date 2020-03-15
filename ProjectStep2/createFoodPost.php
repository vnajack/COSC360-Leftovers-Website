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
    include "include/checkLoggedIn.inc.php";
    include "include/top-navigation-bar.inc.php";
    include "include/left-column.inc.php";
  ?>
  <main id="leftoversForm">
  <?php
  if(!$isLoggedIn){
    include "include/error-notLoggedIn.inc.php";
  }else{
    include "createFoodPost-form.php";
  }
  ?>
  </main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
