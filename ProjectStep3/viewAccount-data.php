<?php
  //connect to the database
  require_once('include/db_connection.php');

  echo '<h1 class="center-text">Welcome back, '.$_SESSION["fullName"].'</h1>';

  //variables used for the SELECT statement and to display as form values
  $name = $type = $email = $phonenum = $program = $yearOfStudy = $img_src = $pname = $db_password = "";

  try{
    $pdo = openConnection();
  } catch (PDOException $e){
    die($e->getMessage());
  }
  //sql select statement
  $sql = "SELECT name, typeOfUser, yearOfStudy, program, username, password, profilePicture, email, phonenum FROM users WHERE username = ?";
  if($stmt = $pdo->prepare($sql)){
    $stmt->bindValue(1, $_SESSION["username"]);
    if($stmt->execute()){
      if($row = $stmt->fetch()){ //go through the row and get the variables
        $name = $row["name"];
        $type = $row["typeOfUser"];
        $yearOfStudy = $row["yearOfStudy"];
        $program = $row["program"];
        $db_password = $row["password"];
        $img_src = $row["profilePicture"];
        $email = $row["email"];
        $phonenum = $row["phonenum"];
      }
    }else{
      print("<script>window.alert('Oops! Something went wrong. Please try again later.');window.location.href = 'login.php';</script>");
    }
  }

  if(!empty($img_src)){
    $uploads_dir = 'uploads/profilePictures/'.$img_src;
  }

  //variables for entered values
  $entered_name = $entered_email = $entered_phone = $entered_program = $entered_year = $entered_pname = "";
  $validName = $validEmail = $validPassword = false;
  $nameError = $emailError = $passwordError = "";

  //if the form was submitted
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    //data validation
    if (empty($_POST["name"])){ //if no name was entered in the form
      $nameError = "Your name cannot be empty"; //give this variable an error message (the variable is used in the html below)
    } elseif(!preg_match("/^[a-zA-Z ]*$/",$_POST["name"])){  //if a name WAS entered
      $nameError = "You must enter a valid name. A name can only contain letters, hyphens, and spaces.";
    }else {
      $entered_name = $_POST["name"];
      $validName = TRUE;
    }

    if (empty($_POST["email"])){
      $emailError = "You must provide an email address.";
    } elseif(!preg_match("/[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/",$_POST["email"])){
      $emailError = "Invalid email format. A valid email contains characters before and after '@' and at least two characters after '.'";
    } else {
      $entered_email = $_POST["email"];
      $sql = "SELECT username, email FROM users WHERE email = ?";
      if($stmt = $pdo->prepare($sql)){
        $stmt->bindValue(1, $entered_email); // Bind variable to the prepared statement as a parameter
        $stmt->execute(); // Attempt to execute the prepared statement
        if($row = $stmt->fetch()){
          if(strcmp($row["username"], $_SESSION["username"])==0){
            $validEmail = TRUE;
          }else{
            $emailError = "That email is already associated with an account that isn't yours.";
          }
        }
      }
    }

    if(!empty($_POST["phonenum"])){
      $entered_phone = $_POST["phonenum"];
    }

    if(!empty($_POST["program"])){
      $entered_program = $_POST["program"];
    }

    $entered_year = $_POST["yearOfStudy"];

    if(!empty($_FILES["profilePicture"]["name"])){

      //to create unique and readable file name, it's username-YYYY-mm-dd.ext
      $uploadDate = date("Y-m-d");
      $ext = end((explode(".", $_FILES["profilePicture"]["name"]))); # extra () to prevent notice
      $pname = $_SESSION["username"]."-".$uploadDate.".".$ext;

      #temporary file name to store file
      $tname = $_FILES["profilePicture"]["tmp_name"];

      #upload directory path
      $uploads_dir = 'uploads/profilePictures/';

      #TO move the uploaded file to specific location
      move_uploaded_file($tname, $uploads_dir.$pname);
    }

    if(empty($_POST["password"])){
      $passwordError = "You must enter your password to save changes.";
    }else{
      $entered_password = $_POST["password"];
      if(strcmp($entered_password, $db_password)==0){
        $validPassword = TRUE;
      }else{
        print("<script>window.alert('The password you entered was incorrect. Please re-enter your new information and try again.');</script>");
      }
    }

    if($validName && $validEmail && $validPassword){

      $data = "";
      $updateSQL = "";
      if(empty($pname)){
        $data = array($entered_name, $entered_year, $entered_program, $entered_email, $entered_phone, $_SESSION["username"]);

        $updateSQL = "UPDATE users SET name = ?, yearOfStudy = ?, program = ?, email = ?, phonenum = ? WHERE username = ?";
      }else{
        $data = array($entered_name, $entered_year, $entered_program, $pname, $entered_email, $entered_phone, $_SESSION["username"]);

        $updateSQL = "UPDATE users SET name = ?, yearOfStudy = ?, program = ?, profilePicture = ?, email = ?, phonenum = ? WHERE username = ?";
      }

      $stmt = $pdo->prepare($updateSQL);

      $stmt->execute($data);

      print("<script>window.alert('Successfully saved your updated information!');window.location.href = 'viewAccount.php';</script>");
    }
  }

  closeConnection($pdo);
?>
<form id="accountInfo" name="accountInformation" method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <fieldset>
    <img src="<?php if(empty($img_src)){echo 'images/icons8-person-64.png';} else {echo $uploads_dir;} ?>" alt="Profile Picture">
    <table class="tableFieldset">
      <tbody>
        <tr>
          <th><label> Username: </label>
            <td> <input disabled type="text" name="username" value="<?php echo $_SESSION["username"]; ?>" title="Please contact an admin to change your username."></td>
          </tr>
          <th><label> Member Type: </label>
            <td> <input disabled type="text" name="typeOfUser" value="<?php echo $type; ?>"></td>
          </tr>
          <tr>
            <th><label> Name: </label></th>
            <td> <input type="text" name="name" title="Full name" autofocus  value = "<?php echo $name;?>"><?php echo "<span class=\"leftBlank\">".$nameError."</span>";?></td>
          </tr>
          <tr>
            <th><label> Email Address: </label></th>
            <td> <input type="text" name="email" value="<?php echo $email; ?>" required><?php echo "<span class=\"leftBlank\">".$emailError."</span>";?></td>
          </tr>
          <tr>
            <th><label>Phone Number:</label></th>
            <td><input type="text" name="phonenum" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" value="<?php echo $phonenum; ?>" title="Must be a 10-digit phone number in the format 123-456-7890"></td>
          </tr>
          <tr>
            <th><label>Program/Degree: </label></th>
            <td><input type="text" name="program" value="<?php echo $program; ?>"></td>
          </tr>
          <tr>
            <th><label>Year of Study: </label></th>
            <td><input  type="number" name="yearOfStudy" value="<?php echo $yearOfStudy; ?>" min="1" max="5"></td>
          </tr>
          <tr>
            <th><label>Profile Picture:</label></th>
            <td><input type="file" name="profilePicture" accept="image/*"></td>
          </tr>
          <tr>
            <td colspan="2" class="center-text"><br>Enter your password to save your changes.</td>
          </tr>
          <tr>
            <th><label>Password:</label></th>
            <td><?php echo "<span class=\"leftBlank\">".$passwordError."</span>";?><br><input type="password" name="password" required></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"><input type="submit" value="Save"></td>
          </tr>
        </tfoot>
      </table>
    </fieldset>
  </form>
