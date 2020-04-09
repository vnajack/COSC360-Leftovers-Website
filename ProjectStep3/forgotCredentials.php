<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgotten Credentials</title>
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
    require_once('include/db_connection.php'); //connect to database

    echo "<a href=\"login.php\">&laquo; Back to Login</a>";

    try{
        $pdo = openConnection();
    } catch (PDOException $e){
        die($e->getMessage());
    }
    $email = $username = $password = $securityQuestion = $securityResponse = "";

    $emailError = $credentialError = $securityQuestionError = $securityResponseError = "";

    $validEmail = $validSecurityQuestion = $validSecurityResponse  =  FALSE;

    $dbsecurityQuestion = $dbSecurityResponse = $dbUsername = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST"){
      $email = $_POST["email"];
        if (!preg_match("/[a-zA-Z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/",$email)) { //checks to see if the format is valid
        $emailError = "Invalid email format. A valid email contains characters before and after '@' and at least two characters after '.'";
      } else {
        $sql = "SELECT email FROM users WHERE email = ?";
        if($stmt = $pdo->prepare($sql)){
            // Bind variable to the prepared statement as a parameter
            $stmt->bindValue(1, $email);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // if the query returns 0 rows, then that email doesn't exist in the database
                if($stmt->rowCount() == 0){
                  $emailError = "There are no accounts associated with that email.";
        } else {
            $validEmail = TRUE;
        }
        }
      }
    }
    //!!!!NOTE:To recover the user's password/username, we are using a means to authenticate the user by ensuring they pick the correct security question AND response
    //As such, since there is this second means of authentification, the user will recieve an email with their username and password in it ONLY if everythin matches with What's in the database. This servers to replace an UPDATE statement, since the user
    //can still use their original password
      if ($validEmail == TRUE){
        //verifying that the security question matches with the account
        $securityQuestion = $_POST["securityQuestion"];
        $sql = "SELECT email, securityQuestion FROM users WHERE (email = ? AND securityQuestion = ?)";
        if($stmt = $pdo->prepare($sql)){
            // Bind variable to the prepared statement as a parameter
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $securityQuestion);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // if the query returns anything greater than 0, then that email is already being used
                if($stmt->rowCount() == 0){
                    $securityQuestionError = "That is not the correct security question associated with " .$email;
                } else {
                      $validSecurityQuestion = TRUE;
                }
              }
        }
      }

      if ($validEmail && $validSecurityQuestion ==TRUE){
        $securityResponse = $_POST["securityResponse"];
        $sql = "SELECT email, securityQuestion, securityResponse FROM users WHERE (email = ? AND securityQuestion = ? AND securityResponse = ?)";

        if($stmt = $pdo->prepare($sql)){
            // Bind variable to the prepared statement as a parameter
            $stmt->bindValue(1, $email);
            $stmt->bindValue(2, $securityQuestion);
            $stmt->bindValue(3, $securityResponse);

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // if the query returns anything greater than 0, then that email is already being used
                if($stmt->rowCount() == 0){
                  $securityResponseError = "That is not the correct security answer associated with " .$email;
                } else {
                  $validSecurityResponse = TRUE;
                }
              }
            }
          }


        if ($validEmail && $validSecurityQuestion && $validSecurityResponse  == TRUE) { //if all the data has been entered correctly
          $sql = "SELECT username, password FROM users WHERE (email = ?)";

          if($stmt = $pdo->prepare($sql)){
              // Bind variable to the prepared statement as a parameter
              $stmt->bindValue(1, $email);
              // Attempt to execute the prepared statement
              if($stmt->execute()){
                while ($row = $stmt->fetch()){
                  $username = $row["username"];
                  $password = $row["password"];
                }
              }



         $to = $email;
                      $subject = 'Recovery of your Password';
                      $txt = 'Hello ' .$username. ' - your password is ' .$password;
                      $headers = 'From: your_site_admin@gmail.com';
                      $x=mail($to,$subject,$txt,$headers);

             closeConnection($pdo);

        print("<script>window.alert('Check your email to recover your login credentials.');window.location.href = 'login.php';</script>");
        }
    }
  }
  ?>
  <main id="forgottenCredentials">
    <h1>Forgot Credentials</h1>
    <form name="getCredentials" method=post  action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" autocomplete="off">
      <fieldset>
        <p><strong>Fill out the following fields to obtain your credentials.</strong></p>
        <table class="tableFieldset">
          <tr>
            <th><label>What is the email address associated with your account?</label><span class="leftBlank"><?php echo $emailError;?></span></th>
            <td><input type="email" name="email" required value = "<?php echo $email;?>"></td>
          </tr>
          <tr>
            <th><label> Which credential(s) did you forget? <span class="leftBlank"><?php echo $credentialError;?></span></label></th>
            <td><input type="checkbox" name="credentials[]" value="<?php echo $username;?>">Username &nbsp;<input type="checkbox" name="credentials[]" value="<?php echo $password;?>">Password</td>
          </tr>
          <tr>
            <th><label>Choose a security question:<span class="important-notice">*</span></label></th>
  					<td><span class="leftBlank"><?php echo $securityQuestionError;?></span><select name="securityQuestion" id="secQuestion" title="This is used to reset your password if you forget it">
  						<option value="" disabled selected hidden>Choose a security question</option>
  						<option value="Q1">What is the name of your first pet?</option>
  						<option value ="Q2">What was the first name of your childhood best friend?</option>
  					</select></td>
          </tr>
          <tr>
            <th><label>Provide the answer to your security question:</label></th>
            <td><span class="leftBlank"><?php echo $securityResponseError;?></span><input type="text" name="securityResponse" required value = "<?php echo $securityResponse;?>"></td>
          </tr>
        </table>
      </fieldset>
      <input type = "submit">
    </form>
  </main>

  <?php
    require_once("include/right-column.inc.php");
    require_once("include/footer.inc.php");
  ?>
</body>
</html>
