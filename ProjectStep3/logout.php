<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    require_once("include/globals.inc.php");
    $_SESSION["username"] = "";
    session_destroy();
    $isLoggedIn = FALSE;
    $isVolunteerLoggedIn = FALSE;
    $isAdminLoggedIn = FALSE;

    require_once("include/top-navigation-bar.inc.php");
    require_once("include/left-column.inc.php");
    require_once("validateLogin.php"); //For index/events/etc, I embedded the php since it made more sense to retrieve and display info.
    //However, having a separate page to validate login info seemed more suitable than embedding
  ?>
  <main id="logoutPage">
  <h1>Thank you</h1>
  <p>You have successfully logged out.</p>

  </main>
<?php
  require_once("include/right-column.inc.php");
  require_once("include/footer.inc.php");
?>
</body>
</html>
