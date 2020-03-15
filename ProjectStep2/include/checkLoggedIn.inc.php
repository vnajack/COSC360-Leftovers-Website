<?php

$isLoggedIn = true; // in future, use SQL to check if logged in

if($isLoggedIn){  //if the user is logged in, use SQL to check if user is admin or volunteer
  $isAdminLoggedIn = true;
  $isVolunteerLoggedIn = false;
}

?>
