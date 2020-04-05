<?php
  //connect to the database
  require_once('include/db_connection.php');

  echo '<a href=\"memberList.php\">&laquo; Back to Member List</a>';

  //variables used for the SELECT statement and to display as form values
  $username = $name = $type = $yearOfStudy = $program = $availabilityChoices = $skills = $email = $phonenum = $img_src = $pname = $uploads_dir = "";

  try{
    $pdo = openConnection();
  } catch (PDOException $e){
    die($e->getMessage());
  }

  if($_SERVER["REQUEST_METHOD"] == "GET"){
    $username = $_GET["username"];
    $_SESSION["edit"] = $username;
  }elseif(!$_SESSION["editOK"]){
    $username = $_SESSION["edit"];
  }else{
    $username = $_POST["username"];
  }
    //sql select statement
    $sql = "SELECT name, typeOfUser, yearOfStudy, program, skills, username, password, profilePicture, email, phonenum FROM users WHERE username = ?";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindValue(1, $username);
      if($stmt->execute()){
        if($row = $stmt->fetch()){ //go through the row and get the variables
          $name = $row["name"];
          $type = $row["typeOfUser"];
          $yearOfStudy = $row["yearOfStudy"];
          $program = $row["program"];
          $skills = $row["skills"];
          $email = $row["email"];
          $phonenum = $row["phonenum"];
          $img_src = $row["profilePicture"];

          echo '<h1 class="center-text">You are Editing <br>'.$name.'\'s Profile</h1>'; //print the header once you have the name
        }
      }else{
        print("<script>window.alert('Oops! Something went wrong. Please try again later.');window.location.href = 'memberList.php';</script>");
      }
    }

    if(!empty($img_src)){
      $uploads_dir = 'uploads/profilePictures/'.$img_src;
    }else{
      $uploads_dir = 'images/icons8-person-64.png';
    }

  //variables for entered values
  $entered_username = $entered_name = $entered_type = $entered_year = $entered_program = $entered_skills = $entered_email = $entered_phone = "";
  $validUsername = $validName = $validEmail = $validPassword = $validType = false;
  $usernameError = $nameError = $emailError = $passwordError = $typeError = $pictureError = "";

  //if the form was submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    //data validation
    if (empty($_POST["name"])){ //if no name was entered in the form
      $nameError = "This member's name cannot be empty"; //give this variable an error message (the variable is used in the html below)
    } elseif(!preg_match("/^[a-zA-Z\\- ]*$/",$_POST["name"])){  //if a name WAS entered
      $nameError = "You must enter a valid name. A name can only contain letters, hyphens, and spaces.";
    }else {
      $entered_name = $_POST["name"];
      $validName = TRUE;
    }

    if (empty($_POST["username"])){
      $usernameError = "The member must have a username. Please enter a username.";
    } elseif(!preg_match("/[a-zA-Z0-9]+/",$_POST["username"])){
      $usernameError = "The username can only contains letters and numbers. No punctuation or special characters.";
    } else {
      $entered_username = $_POST["username"];
      $sql = "SELECT username FROM users WHERE username = ?";
      if($stmt = $pdo->prepare($sql)){
        $stmt->bindValue(1, $entered_username); // Bind variable to the prepared statement as a parameter
        $stmt->execute(); // Attempt to execute the prepared statement
        if($row = $stmt->fetch()){
          if(strcmp($row["username"], $username)==0){ //if it's the same username as before, we're good.
            $validUsername = TRUE;
          } else { //if there is a username that matches with the entered one, and it isn't the same as the $_GET username, then it's arleady taken
            $usernameError = "That username is already taken by another user. Please choose a different username";
          }
        }else{
          $validUsername = TRUE;
        }
      }
    }

    if (empty($_POST["email"])){
      $emailError = "You must provide an email address for this member.";
    } elseif(!preg_match("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$_POST["email"])){
      $emailError = "Invalid email format. A valid email contains characters before and after '@' and at least two characters after '.'";
    } else {
      $entered_email = $_POST["email"];
      $sql = "SELECT username, email FROM users WHERE email = ?";
      if($stmt = $pdo->prepare($sql)){
        $stmt->bindValue(1, $entered_email); // Bind variable to the prepared statement as a parameter
        $stmt->execute(); // Attempt to execute the prepared statement
        if($row = $stmt->fetch()){
          if(strcmp($row["username"], $_SESSION["edit"])==0){
            $validEmail = TRUE;
          }else{
            $emailError = "That email is already associated with an account that isn't yours.";
          }
        }else{
          $validEmail = TRUE;
        }
      }
    }

    if(empty($_POST["typeOfUser"])){
      $typeError = "You must assign a type to this member";
    }elseif(strcmp($_POST["typeOfUser"], "Admin")==0 || strcmp($_POST["typeOfUser"], "Volunteer")==0 || strcmp($_POST["typeOfUser"], "Pending Applicant")==0){
      $entered_type = $_POST["typeOfUser"];
      $validType = TRUE;
    }else{
      $typeError = "Invalid member type. Please select a valid member type.";
    }

    if(!empty($_POST["phonenum"])){
      $entered_phone = $_POST["phonenum"];
    }

    if(!empty($_POST["program"])){
      $entered_program = $_POST["program"];
    }

    $entered_year = $_POST["yearOfStudy"];

    $entered_skills = $_POST["skills"];

    if(!empty($_FILES["profilePicture"]["name"])){
      //to create unique and readable file name, it's username-YYYY-mm-dd.ext
      $uploadDate = date("Y-m-d");
      $ext = end((explode(".", $_FILES["profilePicture"]["name"]))); # extra () to prevent notice
      $pname = $username."-".$uploadDate.".".$ext;

      #temporary file name to store file
      $tname = $_FILES["profilePicture"]["tmp_name"];

      #upload directory path
      $uploads_dir = 'uploads/profilePictures/';

      #TO move the uploaded file to specific location
      move_uploaded_file($tname, $uploads_dir.$pname);
    }

    if($validUsername && $validName && $validEmail && $validType){
      $_SESSION["editOK"] = TRUE;

      $data = "";
      $updateSQL = "";
      if(empty($pname)){
        $data = array($entered_username, $entered_name, $entered_type, $entered_year, $entered_program, $entered_skills, $entered_email, $entered_phone,  $_SESSION["edit"]);

        $updateSQL = "UPDATE users SET username = ?, name = ?, typeOfUser = ?, yearOfStudy = ?, program = ?, skills = ?, email = ?, phonenum = ? WHERE username = ?";

      }else{
        $data = array($entered_username, $entered_name, $entered_type, $entered_year, $entered_program, $pname, $entered_skills, $entered_email, $entered_phone,  $_SESSION["edit"]);

        $updateSQL = "UPDATE users SET username = ?, name = ?, typeOfUser = ?, yearOfStudy = ?, program = ?, profilePicture = ?, skills = ?, email = ?, phonenum = ? WHERE username = ?";

      }

      $stmt = $pdo->prepare($updateSQL);

      $stmt->execute($data);

      print("<script>window.alert('Successfully saved updated ".$entered_name."\'s information!');window.location.href = 'viewEditMember.php?username=".$entered_username."';</script>");
    }else{
      print("<script>window.alert('Error. Unable to update information. Please try again later.');</script>");
      $_SESSION["editOK"] = FALSE;
    }
  }


  closeConnection($pdo);
?>
<form id="accountInfo" name="accountInformation" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <fieldset>
    <img src="<?php echo $uploads_dir; ?>" alt="Profile Picture">
    <table class="tableFieldset">
      <tbody>
        <tr>
          <th><label> Username: </label>
            <td><input type="text" name="username" value="<?php echo $username; ?>"><span class="leftBlank"><?php echo $usernameError; ?></span></td>

          </tr>

          <tr>
            <th><label>Name: </label></th>
            <td><input autofocus type="text" name="name" title="Full name" value = "<?php echo $name;?>"></td>
            <span class="leftBlank"><?php echo '<td>'.$nameError.'</td>';?></span>
          </tr>

          <th><label>Member Type: </label>
            <td>
              <input <?php if(strcmp($type, "Admin")==0){echo 'checked';} ?> type="radio" name="typeOfUser" value="Admin"><label for="Admin">Admin</label><br>
              <input <?php if(strcmp($type, "Volunteer")==0){echo 'checked';} ?> type="radio" name="typeOfUser" value="Volunteer"><label for="Volunteer">Volunteer</label><br>
              <input <?php if(strcmp($type, "Pending Applicant")==0){echo 'checked';} ?> type="radio" name="typeOfUser" value="Pending Applicant"><label for="Pending Applicant">Pending Applicant</label>
            </td>
          </tr>

          <tr>
            <th><label>Year of Study: </label></th>
            <td><input type="number" name="yearOfStudy" value="<?php echo $yearOfStudy; ?>" min="1" max="5"></td>
          </tr>

          <tr>
            <th><label>Program/Degree: </label></th>
            <td><input type="text" name="program" value="<?php echo $program; ?>"></td>
          </tr>

          <tr>
            <th><label>Skills: </label></th>
            <td><input type="text" name="skills" value="<?php echo $skills; ?>"></td>
          </tr>

          <tr>
            <th><label> Email Address: </label></th>
            <td> <input type="text" name="email" value="<?php echo $email; ?>" required><span class="leftBlank"><?php echo $emailError;?></span></td>
          </tr>
          <tr>
            <th><label>Phone Number:</label></th>
            <td><input type="text" name="phonenum" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $phonenum; ?>" title="Must be a 10-digit phone number in the format 123-456-7890"></td>
          </tr>

          <tr>
            <th><label>Profile Picture:</label></th>
            <td><input type="file" name="profilePicture" title="Choose a file for the profile picture" accept="image/*"></td>
          </tr>

          <tr>
            <td colspan="2" class="center-text important-notice"><br>Please ensure you have the correct information for this member before saving.</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"><input type="submit" value="Save"></td>
          </tr>
          <tr>
            <td colspan="2"><input type="button" value="Cancel and Go Back" onclick="location.href='memberList.php'" title="No changes will be made and you will return to the member list."></td>
          </tr>
        </tfoot>
      </table>
    </fieldset>
  </form>
