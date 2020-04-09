<!DOCTYPE html>
<html lang="en">
<head>
  <title>Edit Food Post</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    require_once('include/globals.inc.php');
    require_once("include/top-navigation-bar.inc.php");
    require_once("include/left-column.inc.php");

  ?>
  <main id="leftoversForm">
  <?php
  if(isLoggedIn() && isAdmin()){
    require_once('include/db_connection.php');
    echo "<a href=\"index.php\">&laquo; Back to Leftovers Posts</a>";

    try{
      $pdo = openConnection();
    } catch (PDOException $e){
      die($e->getMessage());
    }

    //defines our form vairables, setting them to be empty as default
    $postID = $timeOfPost = $minutesSafe = $postFoodItems = $postDescription = $postLocation = $postAmount = $pname = $donorName = $postEditUsername = $img_src = "";

    if($_SERVER["REQUEST_METHOD"] == "GET"){
      $postID = $_GET["postID"];
      $_SESSION["edit"] = $postID;
    }
    if($_SERVER["REQUEST_METHOD"] == "POST"){
      $postID = $_SESSION["edit"];
    }

    $sql = "SELECT postID, timeOfPost, minutesSafe, postFoodItems, postDescription, postLocation, postAmount, postPicture, donorName, postUsername, postEditUsername FROM foodpost WHERE postID = ?";
    if($stmt = $pdo->prepare($sql)){
      $stmt->bindValue(1, $postID);
      if($stmt->execute()){
        if($row = $stmt->fetch()){
          $timeOfPost = $row["timeOfPost"];
          $minutesSafe = $row["minutesSafe"];
          $postFoodItems = $row["postFoodItems"];
          $postDescription = $row["postDescription"];
          $postLocation = $row["postLocation"];
          $postAmount = $row["postAmount"];
          $img_src = $row["postPicture"];
          $donorName = $row["donorName"];
          $postUsername = $row["postUsername"];
          $postEditUsername = $row["postEditUsername"];
        }
      }
    }

    $uploads_dir = 'uploads/foodPostPictures/'.$img_src;


    //variables for entered values
    $postDate = $postDateTime = $entered_minutesSafe = $entered_postFoodItems = $entered_postDescription = $entered_postLocation = $entered_postAmount = $pname = $entered_donorName = $entered_postEditUsername = "";
    $validminutesSafe = $validpostFoodItems = $validpostLocation = $validDonorName = FALSE;
    $minutesSafeError = $postFoodItemsError = $postLocationError = $donorNameError = "";


    if($_SERVER["REQUEST_METHOD"] == "POST"){

      if(empty($_POST["updateDateTime"])){
        $postDateTime = $timeOfPost;
        $postDate = subst($timeOfPost, 0, 10)."-".subst($timeOfPost, 12, 13).subst($timeOfPost, 15, 16);
      }else{ //if the user wanted to update the date and time of the post, then this would not be empty
        $postDateTime = date("Y-m-d H:i:s");
        $postDate = date("Y-m-d-hi");
      }


      if (empty($_POST["minutesSafe"])){
        $minutesSafeError= "Please select how much longer the leftovers will be fresh. This is the length of time until it can no longer be consumed safely (unless otherwise indicated by the food donor.";
      } else {
        $entered_minutesSafe = $_POST["minutesSafe"];
        $validminutesSafe = TRUE;
      }

      if (empty($_POST["postFoodItems"])){
        $postFoodItemsError = "Please list the food items you picked up.";
      } else {
        $entered_postFoodItems = $_POST["postFoodItems"];
        $validpostFoodItems = TRUE;
      }

      $entered_postDescription = $_POST["postDescription"];

      if (empty($_POST["postLocation"])){
        $postLocationError = "Please indicate where you are taking the leftovers.";
      } else {
        $entered_postLocation = $_POST["postLocation"];
        $validpostLocation= TRUE;
      }

      $entered_postAmount = $_POST["postAmount"];

      if (empty($_POST["donorName"])){
        $donorNameError = "Please give credit to those who gave us their leftovers.";
      } else {
        $entered_donorName= $_POST["donorName"];
        $validDonorName= TRUE;
      }

      if(!empty($_FILES["postPicture"]["name"])){

        //create specific name for food post picture
        $ext = end((explode(".", $_FILES["postPicture"]["name"]))); # extra () to prevent notice
        $pname = $postDate.".".$ext;

        #temporary file name to store file
        $tname = $_FILES["postPicture"]["tmp_name"];

        #upload directory path
        $uploads_dir = 'uploads/foodPostPictures/';

        #TO move the uploaded file to specific location
        move_uploaded_file($tname, $uploads_dir.$pname);
      }

      if ($validminutesSafe && $validpostFoodItems && $validpostLocation && $validDonorName) { //if all the data has been entered correctly

        $data = $updateSQL = "";
        if(empty($pname)){
          $data = array($postDateTime, $entered_minutesSafe, $entered_postFoodItems, $entered_postDescription, $entered_postLocation, $entered_postAmount, $entered_donorName, $_SESSION["username"], $postID);

          $updateSQL = "UPDATE foodpost SET timeOfPost = ?, minutesSafe = ?, postFoodItems = ?, postDescription = ?, postLocation = ?, postAmount = ?, donorName = ?, postEditUsername = ? WHERE postID = ?";

        }else{
          $data = array($postDateTime, $entered_minutesSafe, $entered_postFoodItems, $entered_postDescription, $entered_postLocation, $entered_postAmount, $pname, $entered_donorName, $_SESSION["username"], $postID);

          $updateSQL = "UPDATE foodpost SET timeOfPost = ?, minutesSafe = ?, postFoodItems = ?, postDescription = ?, postLocation = ?, postAmount = ?, postPicture = ?, donorName = ?, postEditUsername = ? WHERE postID = ?";

        }

        $stmt = $pdo->prepare($updateSQL);

        $stmt->execute($data);

        print("<script>window.alert('Successfully saved updated the food post!');window.location.href = 'editFoodPost.php?postID=".$postID."';</script>");
      }

    }

    closeConnection($pdo);

  ?>

  <form id="foodPost" name="updatePost" method="POST"  enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <h1>Update the Leftovers Post</h1>
    <p class="reminder">Reminder: we can only keep food out for 30 minutes until it needs to be refrigerated or completely eaten <strong>unless</strong> otherwise indicated by the food donor.</p>
    <p><span class="important-notice"> An asterisk (*) indicates a required field.</span></p>
    <fieldset>
      <img src="<?php echo $uploads_dir; ?>" alt="<?php echo $postFoodItems; ?>">
      <table class="tableFieldset">
        <tr>
          <th><label>Update the date and time of this post?</label></th>
          <td><input type="checkbox" name="updateDateTime" value="yes">If checked, the date and time will be updated</td>
          <td></td>
        </tr>
        <tr>
          <th><label>How much longer (in minutes) will the leftovers be fresh?<span class="important-notice">*</span></label></th>
          <td><input type="number" name="minutesSafe" min="1" max="45" title="How much longer the leftovers will be fresh (in minutes)"value = "<?php echo $minutesSafe;?>"></td>
          <?php echo "<td><span class=\"leftBlank\">".$minutesSafeError."</span></td>";?>
        </tr>
        <tr>
          <th><label>Updated image:</label></th>
          <td><input type="file"  name="postPicture" accept="image/*" title="You can update the image of the leftovers" value = "<?php echo $postPicture;?>"></td>
          <td></td>
        </tr>
        <tr>
          <th><label>List the food items you picked up:<span class="important-notice">*</span></label></th>
          <td><input type="text"  name="postFoodItems" title="Please list the food items you picked up." value = "<?php echo $postFoodItems;?>"></td>
          <?php echo "<td><span class=\"leftBlank\">".$postFoodItemsError."</span></td>";?>
        </tr>
        <tr>
          <th><label>Where can these leftovers be found?<span class="important-notice">*</span></label></th>
          <td><input type="text" name="postLocation" title="Please indicate where you are taking the leftovers." value = "<?php echo $postLocation;?>"></td>
          <?php echo "<td><span class=\"leftBlank\">".$postLocationError."</span></td>";?>
        </tr>
        <tr>
          <th><label>Write a message for your post:</label></th>
          <td><input type="text" name="postDescription" title="Add some pizzazz to your post" value="<?php echo $postDescription;?>"></td>
          <td></td>
        </tr>
        <tr>
          <th><label>About how much food (in kg) has been saved?</label></th>
          <td><input type="number" name="postAmount" min=1 title="how much food has been saved?" value = "<?php echo $postAmount;?>"></td>
          <td></td>
        </tr>
        <tr>
          <th><label>Where did the leftovers come from?<span class="important-notice">*</span></label></th>
          <td><input type="text" name="donorName" title="Where did these leftovers come from?" value = "<?php echo $donorName;?>"></td>
          <?php echo "<td><span class=\"leftBlank\">".$donorNameError."</span></td>";?>
        </tr>
        <tr>
          <th><label>The last member to update this post:</label></th>
          <td><input disabled type="text" name="postEditUsername" title="This will be automatically updated" value="<?php if(empty($postEditUsername)){echo $postUsername;}else{echo $postEditUsername;}?>"></td>
          <td></td>
        </tr>
      </table>
    </fieldset>
    <input id="postFoodDrop" type="submit" value="Save">
  </form>

  <?php
  }elseif (isLoggedIn()) {
    require_once("include/error-mustBeAdmin.inc.php");
  }else{
    require_once("include/error-notLoggedIn.inc.php");
  }
  ?>
  </main>
  <?php
    require_once("include/right-column.inc.php");
    require_once("include/footer.inc.php");
  ?>
</body>
</html>
