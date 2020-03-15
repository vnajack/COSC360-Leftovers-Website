<!DOCTYPE html>
<html lang="en">
<head>
  <title>Member List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    include "include/checkLoggedIn.inc.php";
    include "include/top-navigation-bar.inc.php";

    global $isLoggedIn;
  ?>
	<main id="memberList">
    <?php
    if(!$isLoggedIn){
      include "include/error-notLoggedIn.inc.php";
    }else{
      include "memberList-data.php";
    }
    ?>
	</main>
  <?php
    include "include/footer.inc.php";
  ?>
</body>
</html>
