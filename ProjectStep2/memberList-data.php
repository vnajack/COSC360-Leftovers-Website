<?php
  include "include/checkLoggedIn.inc.php";

  global $isVolunteerLoggedIn, $isAdminLoggedIn;

  ?>
<table>
  <tr> <!-- Start of table header -->
    <th scope="col" id="profilePic">Picture</th>
    <th scope="col" id="fullName">Name</th>
    <th scope="col" id="phoneNum">Phone Number</th>
    <th scope="col" id="email">Email</th>
    <th scope="col" id="program">Program/Degree</th>
    <?php
    if($isAdminLoggedIn){
      echo "<th scope=\"col\" id=\"yearOfStudy\">Year of Study</th>";
      echo "<th scope=\"col\" id=\"availability\">Availability</th>";
      echo "<th scope=\"col\" id=\"skills\">Strengths</th>";
      echo "<th scope=\"col\" id=\"reason\">Reason for Joining</th>";
      echo "<th scope=\"col\" id=\"more\">Other Information</th>";
    }
    ?>

    <th scope="col" id="memberType">Member Type</th>

    <?php
    if($isAdminLoggedIn){
      echo "<th scope=\"col\" id=\"editDelete\">Edit/Delete</th>";
    }
    ?>
  </tr> <!-- End of table header -->
  <tr> <!-- Begin entries here -->
    <td><img src="images/icons8-person-64.png" alt="Profile Picture"></td>
    <td>Jane Doe</td>
    <td>123-123-1234</td>
    <td>jane.doe@alumni.ubc.ca</td>
    <td>Bachelor of Commerce</td>
    <?php
    if($isAdminLoggedIn){
      echo "<td>3</td>";
      echo "<td>Afternoons</td>";
      echo "<td>I want to help reduce food waste. I also like free food!</td>";
      echo "<td>Heavy Lifting, Public Speaking</td>";
      echo "<td>If possible, I would like to help with marketing and social media</td>";
    }
    ?>
    <td>Basic</td>
    <?php
    if($isAdminLoggedIn){
      echo "<td><a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-edit-30.png\" alt=\"Edit Icon\"></a><a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-delete-48.png\" alt=\"Delete Icon\"></a></td>";
    }
    ?>
  </tr>
  <tr>
    <td><img src="images/icons8-person-64.png" alt="Profile Picture"></td>
    <td>Jesse LastName</td>
    <td>234-234-2345</td>
    <td>jesse.lastname@alumni.ubc.ca</td>
    <td>Program Name</td>
    <?php
    if($isAdminLoggedIn){
      echo "<td>3</td>";
      echo "<td>Any time</td>";
      echo "<td>Reason for joinin here</td>";
      echo "<td>Here are my strengths</td>";
      echo "<td>I wrote something here</td>";
    }
    ?>

    <td>Volunteer</td>

    <?php
    if($isAdminLoggedIn){
      echo "<td><a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-edit-30.png\" alt=\"Edit Icon\"></a><a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-delete-48.png\" alt=\"Delete Icon\"></a></td>";
    }
    ?>
  </tr>
  <tr>
    <td><img src="images/icons8-person-64.png" alt="Profile Picture"></td>
    <td>Samantha S</td>
    <td>456-456-4567</td>
    <td>samantha.s@alumni.ubc.ca</td>
    <td>Program</td>
    <?php
    if($isAdminLoggedIn){
      echo "<td>4</td>";
      echo "<td>Any time</td>";
      echo "<td>This is my reason for joining</td>";
      echo "<td>Strengths listed here</td>";
      echo "<td>Here is some other information</td>";
    }
    ?>

    <td>Admin</td>

    <?php
    if($isAdminLoggedIn){
      echo "<td><a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-edit-30.png\" alt=\"Edit Icon\"></a><a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-delete-48.png\" alt=\"Delete Icon\"></a></td>";
    }
    ?>
  </tr>
</table>
