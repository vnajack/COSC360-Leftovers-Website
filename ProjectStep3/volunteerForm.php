<!DOCTYPE html>
<html lang="en">
<head>
  <title>Volunteer Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
  //include files
  require_once("include/globals.inc.php");
  require_once("include/top-navigation-bar.inc.php");
  require_once("include/left-column.inc.php");

  //connect to the database
  require_once('include/db_connection.php');

  //prepare variables for data validation
  $name  = $whyVolunteer = $yearOfStudy =  $username = $password = $email = $securityQuestion = $securityResponse = $program = $phonenum = $pname = "";
  $typeOfUser = "Pending Applicant";
  $validName = $validWhyVolunteer = $validUsername = $validPassword= $validEmail= $validSecurityQuestion = $validSecurityResponse =  FALSE;
  $nameError = $whyVolunteerError = $usernameError = $passwordError = $emailError =  $securityQuestionError = $securityResponseError = "";

  //data validation upon submit
  if ($_SERVER["REQUEST_METHOD"] == "POST"){ //essentially is just checking for when the submit button has been pressed

    if (empty($_POST["name"])){ //if no name was entered in the form
      $nameError = "Please enter your name"; //give this variable an error message (the variable is used in the html below)
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])){  //if a name WAS entered
      $nameError = "You must enter a valid name. A name can only contain letters, hyphens, and spaces.";
    }else {
      $name = $_POST["name"];
      $validName = TRUE;
    }

    if (!isset($_POST["whyVolunteer"])){ //text areas are weird, you can't check if they're empty
      $whyVolunteerError = "Please provide an answer for why you want to volunteer with us.";
    } else {
      $whyVolunteer = $_POST["whyVolunteer"];
      $validWhyVolunteer = TRUE;
    }

    if (empty($_POST["username"])){
      $usernameError = "Enter a username.";
    } elseif(!preg_match("/[a-zA-Z0-9]+/",$_POST["username"])){
      $usernameError = "Your username can only contains letters and numbers. No punctuation or special characters.";
    } else {
      $username = $_POST["username"];
      $sql = "SELECT username FROM users WHERE username = ?";
      if($stmt = $pdo->prepare($sql)){
        $stmt->bindValue(1, $username); // Bind variable to the prepared statement as a parameter
        $stmt->execute(); // Attempt to execute the prepared statement
        if($stmt->rowCount() > 0){ // if the query returns anything greater than 0, then that username is already taken
          $usernameError = "That username is already taken. Please choose a different username";
        } else {
          $validUsername = TRUE; //we finally have a valid username
        }
      }
    }

    if (empty($_POST["password"])){
      $passwordError = "A password is required.";
    } elseif(!preg_match("/.{6,}/",$_POST["password"])){ //checks to see if the format is valid
      $passwordError = "Your password must contain 6 or more characters";
    } else {
      $password = $_POST["password"];
      $validPassword= TRUE;
    }


    if (empty($_POST["email"])){
      $emailError = "Please provide your email address.";
    } elseif(!preg_match("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$_POST["email"])){
      $emailError = "Invalid email format. A valid email contains characters before and after '@' and at least two characters after '.'";
    } else {
      $email = $_POST["email"];
      $sql = "SELECT email FROM users WHERE email = ?";
      if($stmt = $pdo->prepare($sql)){
        $stmt->bindValue(1, $email); // Bind variable to the prepared statement as a parameter
        $stmt->execute(); // Attempt to execute the prepared statement
        if($stmt->rowCount() > 0){ // if the query returns anything greater than 0, then that email is already being used
          $emailError = "That email is already associated with an account.";
        } else {
          $validEmail = TRUE;
        }
      }
    }

    if(!isset($_POST["securityQuestion"])){
      $securityQuestionError = "Please select a security question";
    } else {
      $securityQuestion = $_POST["securityQuestion"];
      $validSecurityQuestion = TRUE;
    }

    if(empty($_POST["securityResponse"])){
      $securityResponseError = "Please provide an answer to your security question";
    } else {
      $securityResponse = $_POST["securityResponse"];
      $validSecurityResponse = TRUE;
    }

    //setting not requred fields
    if(!empty($_POST["program"])){
      $program = $_POST["program"];
    }

    if(!empty($_POST["other"])){
      $other = $_POST["other"];
    }

    if(!empty($_POST["phonenum"])){
      $phonenum = $_POST["phonenum"];
    }
    if(!empty($_POST["skills"])){
      $skills = implode(", ",$_POST["skills"]);
    }

    $yearOfStudy = $_POST["yearOfStudy"];
    $availabilityChoices = $_POST["availabilityChoices"];

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

    //if all the data has been entered correctly, open a connection to the server and submit the data
    if ($validName && $validWhyVolunteer && $validUsername && $validPassword && $validEmail && $validSecurityQuestion && $validSecurityResponse) {
      try{
        $pdo = openConnection();
      } catch (PDOException $e){
        die($e->getMessage());
      }

      $data = array($name, $typeOfUser, $yearOfStudy, $program, $whyVolunteer, $availabilityChoices, $skills, $other, $username, $password, $pname, $email, $phonenum, $securityQuestion, $securityResponse);

      $sql="INSERT INTO users (name, typeOfUser, yearOfStudy,program,whyVolunteer,availabilityChoices, skills, other, username, password, profilePicture, email, phonenum, securityQuestion, securityResponse) VALUES
      (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

      $stmt = $pdo->prepare($sql);

      $stmt->execute($data);

      closeConnection($pdo);

      //echo "<p>Submitted: ". implode(", ", $data) ."</p>";
      print("<script>window.alert('Thank you for wanting to volunteer with us! An admin will approve your account soon.');window.location.href = 'index.php';</script>");
    }
  }

  ?>
  <main id="volunteerForms">
    <h1>Volunteer Application Form</h1>
    <p><span class="important-notice"> An asterisk (*) indicates a required field.</span></p>
    <form id="volunteer" name="volunteerApplication" method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <fieldset id="volunteerApplication">
        <h2>Part 1: Volunteer Application</h2>
        <p>This part of the form tells us about who you are</p>
        <p><label>Full Name:<span class="important-notice">*</span> </label>
          <input type="text" name="name" title="Full name" autofocus  value = "<?php echo $name;?>"><span class="leftBlank"><?php echo $nameError;?></span></p>
        <p><label>Year of Study: </label><select name="yearOfStudy" title="Year of Study">
          <option>1</option>
          <option>2</option>
          <option>3</option>
          <option>4</option>
          <option>5+</option>
        </select></p>
        <p><label>Program/Degree: </label> <input type="text" name="program" title="Program/Degree" value = "<?php echo $program;?>"></p>
        <p><label>Why do you want to volunteer with the Leftovers club?<span class="important-notice">*</span></label><br>
          <!-- Textareas work by having their value as the content between the tags !-->
          <span class="leftBlank"><?php echo $whyVolunteerError;?></span><textarea name="whyVolunteer" id="reason" form="volunteer" title="Why do you want to volunteer?" rows=5><?php if(isset($_POST['whyVolunteer'])) {echo htmlentities ($_POST['whyVolunteer']); }?></textarea></p>
            <p><label>What is your general availability? </label> <select name="availabilityChoices" title="What is your general availability">
              <option>Any time</option>
              <option>Mornings</option>
              <option>Afternoons</option>
              <option>Evenings</option>
              <option>Weekends</option>
              <option>Limited</option>
            </select></p>
            <p><label>What kind of strengths and skills do you have to contribute to the club? </label>
              <table>
                <tr>
                  <td><input type="checkbox" name="skills[]" value="design">Design</td>
                  <td><input type="checkbox" name="skills[]" value="photography">Photography</td>
                  <td><input type="checkbox" name="skills[]" value="heavy lifting">Heavy Lifting</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="skills[]" value="public speaking">Public speaking</td>
                  <td><input type="checkbox" name="skills[]" value="quick response time">Quick response time to messages</td>
                  <td><input type="checkbox" name="skills[]" value="connections">Connections with on-campus organizations</td>
                </tr>
                <tr>
                  <td><input type="checkbox" name="skills[]" value="adaptable">Ability to adapt to new circumstances</td>
                  <td><input type="checkbox" name="skills[]" value="marketing">Marketing experience</td>
                  <td><input type="checkbox" name="skills[]" value="cooking">Cooking</td>
                </tr>
              </table>
              <p><label> Tells us about any other relevant information (such as time constraints, other skills, or anything else you want to share). </label><br>
              <textarea name="other" form="volunteer" title="Tell us more" rows=5><?php if(isset($_POST['other'])) {echo htmlentities ($_POST['other']); }?></textarea></p>
                </fieldset>
                <fieldset id="createAccount">
                  <h2>Part 2: Create an Account</h2>
                  <p>Once your volunteer application is accepted you can log in using the credentials you choose here.</p>
                  <table class="tableFieldset">
                    <tr>
                      <th><label>Username:<span class="important-notice">*</span></label></th>
                      <td><span class="leftBlank"><?php echo $usernameError;?></span><br><input type="text" name="username" title="Can only contain letters and numbers. No punctuation or special characters." value = "<?php echo $username;?>"></td>
                    </tr>
                    <tr>
                      <th><label>Password:<span class="important-notice">*</span></label></th>
                      <td><span class="leftBlank"><?php echo $passwordError;?></span><br><input type="password" name="password" title="Your password must contain 6 or more characters"  value = "<?php echo $password;?>"></td>
                    </tr>
                    <tr>
                      <th><label>Profile Picture:</label></th>
                      <td><input type="file" name="profilePicture" title="Please upload a picture so we can verify who you are" accept="image/*" value = "<?php echo $profilePicture;?>"></td>
                    </tr>
                    <tr>
                      <th><label>Email:<span class="important-notice">*</span></label></th>
                      <td><span class="leftBlank"><?php echo $emailError;?></span><br><input type="email" name="email"  value = "<?php echo $email;?>"></td>
                    </tr>
                    <tr>
                      <th><label>Phone Number:</label></th>
                      <td><input type="text" name="phonenum" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" title="Must be a 10-digit phone number in the format 123-456-7890" value = "<?php echo $phonenum;?>"></td>
                    </tr>
                    <tr>
                      <th><label>Choose a security question:<span class="important-notice">*</span></label></th>
                      <td><span class="leftBlank"><?php echo $securityQuestionError;?></span><br><select name="securityQuestion" id="secQuestion" title="This is used to reset your password if you forget it">
                        <option value="" disabled selected hidden>Choose a security question</option>
                        <option value="Q1">What is the name of your first pet?</option>
                        <option value="Q2">What was the first name of your childhood best friend?</option>
                      </select></td>
                    </tr>
                    <tr>
                      <th><label>Answer for security question:<span class="important-notice">*</span></label></th>
                      <td><span class="leftBlank"><?php echo $securityResponseError;?></span><input type="text" name="securityResponse"  title="Please enter a response to your security question"  value = "<?php echo $securityResponse;?>"></td>
                    </tr>
                  </table>
                </fieldset>
                <input type="submit" value="Submit">
              </form>
            </main>
            <?php
            require_once("include/right-column.inc.php");
            require_once("include/footer.inc.php");
            ?>
          </body>
          </html>
