<?php
  require_once("globals.inc.php");
?>
<header></header>
<div class="top-sticky">
  <nav>
    <a class="active" href="index.php">Leftovers Club</a>
    <div class="float-right">
      <div class="main-nav-dropdown">
        <a class="nav-icon" href="javascript:void(0)"><img src="images/icons8-menu-30.png"></a>
        <div class="main-nav">
          <div class="dropdown">
            <a href="javascript:void(0)" class="dropbtn">Get Involved</a>
            <div class="dropdown-content">
              <a href="index.php">Find Leftovers</a>
              <a href="volunteerForm.php">Become a Volunteer</a>
              <a href="foodDonorForm.php">Give Us Leftovers</a>
            </div>
          </div>
          <a href="events.php">Events</a>
          <a href="about.php">About Us</a>
          <?php

            if(!isLoggedIn()) { //if the user is not logged in
              echo "<a href=\"login.php\">Log In</a>"; //only show the login button
            }else{  //if a user is logged in
              echo "<div class=\"dropdown\">"; //start opening the logged-in user dropdown menu

              if(isApproved()){
                echo "<a href=\"javascript:void(0)\" class=\"dropbtn\">";

                if(isAdmin()){ //check if they're an admin. In which case, create the "Admin Dropdown Menu"
                  echo "Admin</a>";
                  echo "<div class=\"dropdown-content\">";
                  echo "<a href=\"createEvent.php\">Create an Event</a>";
                }elseif(isVolunteer()) { //otherwise, create the "Volunteer Dropdown Menu"
                  echo "Volunteer</a>";
                  echo "<div class=\"dropdown-content\">";
                }
                echo "<a href=\"createFoodPost.php\">Create a Leftovers Post</a>";
                echo "<a href=\"memberList.php\">Member List</a>";
                echo "</div>"; //for both admins and volunteers, still need to close the dropdown menus, have a "My Account" link, and a log out button
              }
              echo "</div>";
              echo "<a href=\"viewAccount.php\">My Account</a>";
              echo "<a href=\"logout.php\">Log Out</a>";
            }
          ?>
        </div>
      </div>
    </div>
  </nav>
</div>
