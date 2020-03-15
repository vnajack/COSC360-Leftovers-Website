<!DOCTYPE html>
<html lang="en">
<head>
  <title>Food Donor Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    include "include/checkLoggedIn.inc.php";
    include "include/top-navigation-bar.inc.php";
    include "include/left-column.inc.php";
  ?>
  <main id = "foodDonor">
		<h1>Food Donation Form</h1>
		<p><span class="important-notice">An asterisk (*) indicates a required field.</span></p>
		<form id="foodDonation" name="donorSubmission" method="post" action="index.php"  onsubmit="return checkForm(this);">
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
				</select>
				<div id = "createTextbox"></div> <!-- NEEDED in order to have dynamic text boxes for "other" and "onCampusEvent" select options -->
				<p><label>Please list the items that are available to be picked up:<span class="important-notice">*</span></label>
				<input type="text" name="foodDescription" ></p>
				<p><label> How much food (in kg) would you estimate that you have?<span class="important-notice">*</span></label>
				<input type="number" name="kg" min=1 >
				</p>
				<p><label>When can the food be picked up?<span class="important-notice">*</span></label>
				<input type="datetime-local" name="pickUpDate"></p>
			</fieldset>
			<input type="submit" value="Submit">
		</form>
  </main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
