<?php
  include "checkLoggedIn.inc.php";
  global $isLoggedIn, $isVolunteerLoggedIn, $isAdminLoggedIn;
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
            if(!$isLoggedIn){ //if the user is not logged in
              echo "<a href=\"login.php\">Log In</a>"; //only show the login button
            }else{  //if a user is logged in
              echo "<div class=\"dropdown\">"; //start opening the logged-in user dropdown menu
              echo "<a href=\"javascript:void(0)\" class=\"dropbtn\">";

              if($isAdminLoggedIn){ //check if they're an admin. In which case, create the "Admin Dropdown Menu"
                echo "Admin</a>";
                echo "<div class=\"dropdown-content\">";
                echo "<a href=\"createEvent.php\">Create an Event</a>";
              }else if($isVolunteerLoggedIn){ //check it they're a volunter. In which case, create the "Volunteer Dropdown Menu"
                echo "Volunteer</a>";
                echo "<div class=\"dropdown-content\">";
              }
              echo "<a href=\"createFoodPost.php\">Create a Leftovers Post</a>";
              echo "<a href=\"memberList.php\">Member List</a>";
              echo "</div></div>"; //for both admins and volunteers, still need to close the dropdown menus, have a "My Account" link, and a log out button
              echo "<a href=\"viewAccount.php\">My Account</a><a href=\"index.php\">Log Out</a>";
            }
          ?>
        </div>
      </div>
    </div>
  </nav>
</div>
