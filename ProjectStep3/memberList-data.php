<?php
  require_once("include/globals.inc.php");
  require_once("include/db_connection.php");
  try{
    $pdo = openConnection();
  } catch (PDOException $e){
    die($e->getMessage());
  }
  ?>

<table id="memberList-main">
  <tr> <!-- Start of table header -->
    <th scope="col" id="profilePic">Picture</th>
    <th scope="col" id="fullName">Name</th>
    <th scope="col" id="phoneNum">Phone Number</th>
    <th scope="col" id="email">Email</th>
    <th scope="col" id="program">Program/Degree</th>
    <th scope="col" id="yearOfStudy">Year</th>
    <?php

    if(isAdmin()){
      echo "<th scope=\"col\" id=\"availability\">Availability</th>";
      echo "<th scope=\"col\" id=\"skills\">Strengths</th>";
      echo "<th scope=\"col\" id=\"reason\">Reason for Joining</th>";
      echo "<th scope=\"col\" id=\"more\">Other Information</th>";
    }

    echo "<th scope=\"col\" id=\"memberType\">Member Type</th>";

    if(isAdmin()){
      echo "<th scope=\"col\" id=\"editDelete\">Edit/Delete</th>";
    }
    echo "</tr>"; //End of table header row

    $sql = "SELECT name, username, typeOfUser, yearOfStudy, program, whyVolunteer, availabilityChoices, skills, other, profilePicture, email, phonenum FROM users";
    $result = $pdo->query($sql);
    while($row = $result->fetch()){
      //initialize variables from database
      $username = $row["username"];
      $img_src = $row["profilePicture"];
      $fullName = $row["name"];
      $phonenum = $row["phonenum"];
      $email = $row["email"];
      $program = $row["program"];
      $yearOfStudy = $row["yearOfStudy"];
      $availabilityChoices = $row["availabilityChoices"];
      $whyVolunteer = $row["whyVolunteer"];
      $skills = $row["skills"];
      $other = $row["other"];
      $typeOfUser = $row["typeOfUser"];

      //adjust variables as needed for display
      $uploads_dir = "images/icons8-person-64.png";
      if(!empty($img_src)){
        $uploads_dir = 'uploads/profilePictures/'.$img_src;
      }

      //create a row for a user
      echo '<tr>
      <td><img src="'.$uploads_dir.'" alt="profile picture"></td>
      <td>'.$fullName.'</td>
      <td>'.$phonenum.'</td>
      <td>'.$email.'</td>
      <td>'.$program.'</td>
      <td>'.$yearOfStudy.'</td>';

      if(isAdmin()){ //volunteer application information is hidden to admins only
        echo '
        <td>'.$availabilityChoices.'</td>
        <td>'.$skills.'</td>
        <td>'.$whyVolunteer.'</td>
        <td>'.$other.'</td>';
      }

      echo '<td>'.$typeOfUser.'</td>';

      if(isAdmin()){ //these features are only available to Admins
        echo "<td>
        <a href=\"viewEditMember.php?username=".$username."\"><img class=\"editDelete\" src=\"images/icons8-edit-30.png\" alt=\"Edit Icon\"></a>
        &nbsp; &nbsp;
        <a href=\"deleteMember.php?username=".$username."\"><img class=\"editDelete\" src=\"images/icons8-delete-48.png\" alt=\"Delete Icon\"></a>
        </td>";
      }

      echo '</tr>'; //close row for user
    }
    closeConnection($pdo);
  ?>
</table>
