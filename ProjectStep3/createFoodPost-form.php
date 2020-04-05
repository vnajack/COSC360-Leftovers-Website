<?php
require_once('include/db_connection.php');

//defines our form vairables, setting them to be empty as default
$minutesSafe = $postFoodItems = $postDescription = $postLocation = $postAmount = $pname = $donorName = "";

//a boolean variable used to indicate if all values have been entered correctly (indicates whether to go to index.php or not)
$validPicture = $validminutesSafe = $validpostFoodItems = $validpostLocation = $validDonorName = FALSE;

//initializes error variables
$postPictureError = $minutesSafeError = $postFoodItemsError = $postLocationError = $donorNameError = "";


if ($_SERVER["REQUEST_METHOD"] == "POST"){

  $postDateTime = date("Y-m-d h:i:s");
  $postDate = date("Y-m-d");

  if (empty($_POST["minutesSafe"])){
    $minutesSafeError= "Please select how much longer the leftovers will be fresh. This is the length of time until it can no longer be consumed safely (unless otherwise indicated by the food donor.";
  } else {
    $minutesSafe = $_POST["minutesSafe"];
    $validminutesSafe = TRUE;
  }

  if (empty($_POST["postFoodItems"])){
    $postFoodItemsError = "Please list the food items you picked up.";
  } else {
    $postFoodItems = $_POST["postFoodItems"];
    $validpostFoodItems = TRUE;
  }

  $postDescription = $_POST["postDescription"];

  if (empty($_POST["postLocation"])){
    $postLocationError = "Please indicate where you are taking the leftovers.";
  } else {
    $postLocation = $_POST["postLocation"];
    $validpostLocation= TRUE;
  }

  $postAmount = $_POST["postAmount"];

  if (empty($_POST["donorName"])){
    $donorNameError = "Please give credit to those who gave us their leftovers.";
  } else {
    $donorName= $_POST["donorName"];
    $validDonorName= TRUE;
  }

  if(empty($_FILES["postPicture"]["name"])){
    $postPictureError = "You must upload a picture of the leftovers!";
  }else{
    $validPicture = TRUE;

    $pname = $postDate.'-'.$_FILES["postPicture"]["name"]; //can't have two posts with the same date and time, so it's unique and won't get replaced

    #temporary file name to store file
    $tname = $_FILES["postPicture"]["tmp_name"];

    #upload directory path
    $uploads_dir = 'uploads/foodPostPictures/';

    #TO move the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.$pname);
  }

  if ($validminutesSafe && $validpostFoodItems && $validpostLocation && $validDonorName && $validPicture) { //if all the data has been entered correctly
    try{
      $pdo = openConnection();
    } catch (PDOException $e){
      die($e->getMessage());
    }

    $data = array($postDateTime, $minutesSafe, $postFoodItems, $postDescription, $postLocation, $postAmount, $pname, $_SESSION["username"], $donorName);
    $sql="INSERT INTO foodpost (timeOfPost, minutesSafe, postFoodItems, postDescription, postLocation, postAmount, postPicture, postUsername, donorName) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute($data);

    closeConnection($pdo);

    header('Location: index.php'); //redirect to index.php

  }
}
?>

<form id="foodPost" name="makePost" method="POST"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <h1>Post Leftovers to the Public</h1>
  <p><span class="important-notice"> An asterisk (*) indicates a required field.</span></p>
  <fieldset>
    <p><strong>Please fill out the following details to post the leftovers to the public.</strong></p>
    <p class="reminder center-text">Reminder: we can only keep food out for 30 minutes until it needs to be refrigerated<br>or completely eaten <strong>unless</strong> otherwise indicated by the food donor.</p>
    <table class="tableFieldset">
      <tr>
        <th><label>How much longer (in minutes) will the leftovers be fresh?<span class="important-notice">*</span></label></th>
        <td><input type="number" name="minutesSafe" min="1" max="45" title="How much longer the leftovers will be fresh?"value = "<?php echo $minutesSafe;?>"></td>
        <span class="leftBlank"><?php echo '<td>'.$minutesSafeError.'</td>';?></span>
      </tr>
      <tr>
        <th><label>Image of Food:<span class="important-notice">*</span></label></th>
        <td><input type="file"  name="postPicture" accept="image/*" title="Pleave provide an image of the leftovers" required value = "<?php echo $postPicture;?>"></td>
        <span class="leftBlank"><?php echo '<td>'.$postPictureError.'</td>';?></span>
      </tr>
      <tr>
        <th><label>List the food items you picked up:<span class="important-notice">*</span></label></th>
        <td><input type="text"  name="postFoodItems" title="Please list the food items you picked up." value = "<?php echo $postFoodItems;?>"></td>
        <span class="leftBlank"><?php echo '<td>'.$postFoodItemsError.'</td>';?></span>
      </tr>
      <tr>
        <th><label>Where will these leftovers be located?<span class="important-notice">*</span></label></th>
        <td><input type="text" name="postLocation" title="Please indicate where you are taking the leftovers." value = "<?php echo $postLocation;?>"></td>
        <span class="leftBlank"><?php echo '<td>'.$postLocationError.'</td>';?></span>
      </tr>
      <tr>
        <th><label>Write a message for your post (e.g., Welcome back from winter break!)</label></th>
        <td><input type="text" name="postDescription" title="Add some pizzazz to your post" value="<?php echo $postDescription;?>"></td>
      </tr>
      <tr>
        <th><label>Provide an estimate of how much food has been saved (in kg):</label></th>
        <td><input type="number" name="postAmount" min=1 title="how much food has been saved?" value = "<?php echo $postAmount;?>"></td>
      </tr>
      <tr>
        <th><label>Where did the leftovers come from?<span class="important-notice">*</span></label></th>
        <td><input type="text" name="donorName" title="Where did these leftovers come from?" value = "<?php echo $donorName;?>"></td>
        <span class="leftBlank"><?php echo '<td>'.$donorNameError.'</td>';?></span>
      </tr>
    </table>
  </fieldset>
  <input id="postFoodDrop" type="submit" value="Post">
</form>
