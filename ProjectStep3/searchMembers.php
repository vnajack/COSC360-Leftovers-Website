<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
  //include files
  require_once("include/globals.inc.php");
  require_once("include/top-navigation-bar.inc.php");
  require_once("include/db_connection.php");

  try{
    $pdo = openConnection();
  } catch (PDOException $e){
    die($e->getMessage());
  }
  ?>
  <main id="memberList">

    <?php
    if (isset($_POST['submit-search'])){ //if search button was clicked
      //obtains what the user entered in the text field
      $searchTerm = $_POST["search"];
      echo "<p><a href=\"memberList.php\">&laquo; Back to Member List</a></p>";
      echo '<h1>Results for \'<u>'.$searchTerm.'</u>\'</h1>';
      //sets up to find the keyword anywhere in a post
      $searchFor = '%' .$searchTerm . '%';

      $sql = "SELECT name, typeOfUser, yearOfStudy, program, whyVolunteer, availabilityChoices, skills, other, profilePicture, email, phonenum FROM users WHERE (name Like '$searchFor' OR  email Like '$searchFor' OR typeOfUser Like '$searchFor')";
      $result = $pdo->query($sql); //executes the query (could also use a prepared statement like I did in validateLogin.)

      //obtains the number of rows returned from the query
      $nRows = $pdo->query("SELECT count(*) FROM users WHERE (name Like '$searchFor' OR  email Like '$searchFor' OR typeOfUser Like '$searchFor')")->fetchColumn();

      if ($nRows == 0){ //if no rows are returned,
        echo "<p> There are no users that match with the keyword '$searchTerm'. </p>";
      } else { //if there are results

        echo '
        <table>
        <tr>
        <th scope=\'col\' id=\'profilePic\'>Picture</th>
        <th scope=\'col\' id=\'fullName\'>Name</th>
        <th scope=\'col\' id=\'phoneNum\'>Phone Number</th>
        <th scope=\'col\' id=\'email\'>Email</th>
        <th scope=\'col\' id=\'program\'>Program/Degree</th>
        <th scope=\'col\' id=\'yearOfStudy\'>Year of Study</th>';

        if(isAdmin()){
          echo '
          <th scope=\"col\" id=\"availability\">Availability</th>
          <th scope=\"col\" id=\"skills\">Strengths</th>
          <th scope=\"col\" id=\"reason\">Reason for Joining</th>
          <th scope=\"col\" id=\"more\">Other Information</th>';
        }

        echo '<th scope=\"col\" id=\"memberType\">Member Type</th>';

        if(isAdmin()){
          echo '<th scope=\"col\" id=\"editDelete\">Edit/Delete</th>';
        }
        echo '</tr>'; //End of table header row

        //initialize variables from database
        while ($row = $result->fetch()){
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
            <a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-edit-30.png\" alt=\"Edit Icon\"></a>
            &nbsp; &nbsp;
            <a href=\"#\"><img class=\"editDelete\" src=\"images/icons8-delete-48.png\" alt=\"Delete Icon\"></a>
            </td>";
          }

          echo '</tr>'; //close row for user
        }
      }
    }
    closeConnection($pdo);
    echo '
    </table>
    </main>';

    require_once("include/footer.inc.php");
    ?>
  </body>
  </html>
