<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Member</title>
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
  <main id="viewMember">
    <?php
    if(isLoggedIn() && isAdmin()){
      require_once("viewEditMember-data.php");
    }elseif(isLoggedIn()){
      require_once("include/error-mustBeAdmin.inc.php");
    }else{
      require_once("include/error-notLoggedIn.inc.php");
      require_once("include/right-column.inc.php");
    }
    ?>
  </main>
</div> <!-- this tag is not a stray its opening part is in an included. it's here because this is a two-column layout. -->
  <?php
    require_once("include/footer.inc.php");
  ?>
</body>
</html>
