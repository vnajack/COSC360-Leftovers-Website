<!DOCTYPE html>
<html lang="en">
<head>
  <title>Food Donor Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
  <script src="include/foodDonorValidation.js"></script>
</head>
<body>
  <?php
  //include files
  require_once('include/globals.inc.php');
  require_once('include/top-navigation-bar.inc.php');
  require_once('include/left-column.inc.php');
  require_once('include/db_connection.php');

  $donor = $foodDescription = $kg = $pickUpDate = $eventName = $eventLocation = "";
  $validDonor = $validDescription = $validKG= $validPickUpDate = FALSE;
  $donorError = $foodDescriptionError = $kgError = $pickUpDateError = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST"){ //essentially is just checking for when the submit button has been pressed
    if(empty($_POST['donor'])){
      $donorError = "You forgot to select who is donating the food!";
    } else {
      $donor = $_POST['donor'];
      $validDonor = TRUE;
    }

    if(strcmp($donor,"onCampusEvent")==0 || strcmp($donor,"other")==0){
      $eventName = $_POST["eventName"];
      $eventLocation = $_POST["eventLocation"];
    }

    if (empty($_POST["foodDescription"])){
      $foodDescriptionError = "Tell us about the items that can be picked up.";
    } else {
      $foodDescription = $_POST["foodDescription"];
      $validDescription = TRUE;
    }

    if (empty($_POST["kg"])){
      $kgError = "Please provide an estimate for how much food is available to be picked up.";
    } else {
      $kg = $_POST["kg"];
      $validKG = TRUE;
    }

    if (empty($_POST["pickUpDate"])){
      $pickUpDateError = "Select a date and time for pickup from the calendar and time indicator.";
    } else {
      $pickUpDate = $_POST["pickUpDate"];
      $validPickUpDate = TRUE;
    }

    if ($validDonor && $validDescription && $validKG && $validPickUpDate) { //if all the data has been entered correctly

      try{
        $pdo = openConnection();
      } catch (PDOException $e){
        die($e->getMessage());
      }

      $data = array($donor, $foodDescription, $kg, $pickUpDate, $eventName, $eventLocation);
      $sql="INSERT INTO fooddonation (donor, foodDescription, kg, pickUpDate, eventName, eventLocation) VALUES (?, ?, ?, ?, ?, ?)";
      $stmt = $pdo->prepare($sql);
      $stmt->execute($data);

      closeConnection($pdo);
      //incorporating javascript to create a popup and redirect the page once the form has been correctly filld out

      echo "<script>window.alert('Thank you for helping us reduce food waste on campus! A member of our club will contact you shortly.');window.location.href = 'index.php';</script>";
    }
  }
  ?>
  <main id = "foodDonor">
    <h1>Food Donation Form</h1>
    <p><span class="important-notice">An asterisk (*) indicates a required field.</span></p>
    <form id="foodDonation" name="donorSubmission" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
      <fieldset>
        <p><strong>Once you submit this form, you will be contacted with a time of pick-up.</strong></p>
        <p><label>Where is this food coming from?<span class="important-notice">*</span></label>
          <select id ="donorSection" name = "donor">
            <option value="" selected disabled hidden>Select one</option>
            <option value="sunshine">Sunshine</option>
            <option value="spoon">Spoon</option>
            <option value="comma">Comma</option>
            <option value="picnic">Picnic</option>
            <option value="onCampusEvent">On-Campus Event</option>
            <option value="other">Not Listed as a trusted donor</option>
          </select> <span class="leftBlank"><?php echo $donorError;?></span>
          <div id = "createTextbox"></div> <!-- NEEDED in order to have dynamic text boxes for "other" and "onCampusEvent" select options -->
        <p></span><label>Please list the items that are available to be picked up:<span class="important-notice">*</span></label>
          <input type="text" name="foodDescription" value = "<?php echo $foodDescription;?>"><span class="leftBlank"><?php echo $foodDescriptionError;?></span>
        </p>
        <p><label> How much food (in kg) would you estimate that you have?<span class="important-notice">*</span></label>
            <input type="number" name="kg" min=1 value = "<?php echo $kg;?>"><span class="leftBlank"><?php echo $kgError;?></span>
        </p>
        <p><label>When can the food be picked up?<span class="important-notice">*</span></label>
            <input type="datetime-local" name="pickUpDate" value = "<?php echo $pickUpDate;?>"><span class="leftBlank"><?php echo $pickUpDateError;?></span>
        </p>
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
