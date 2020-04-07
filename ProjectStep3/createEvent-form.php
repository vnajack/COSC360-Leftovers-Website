<?php

//connect to the database
require_once('include/db_connection.php');

//set things up for pdos
try{
  $pdo = openConnection();
  echo "<h3>Connected Successfully</h3>";
} catch (PDOException $e){
  echo "<h3> Connection failed</h3>";
  die($e->getMessage());
}



//defines our form vairables, setting them to be empty as default
$title = $eventPoster = $eventDate = $eventLocation = $eventDescription = $pname = "";

//a boolean variable used to indicate if all values have been entered correctly (indicates whether to go to index.php or not)
$validTitle = $validPoster = $validDate = $validLocation = $validDescription = FALSE;

//initializes error variables
$titleError = $eventPosterError = $eventDateError = $eventLocationError = $eventDescriptionError = "";



if ($_SERVER["REQUEST_METHOD"] == "POST"){ //essentially is just checking for when the submit button has been pressed
  if (empty($_POST["eventTitle"])){ //goes into the post array at key "eventTitle" to check if it's empty
    $titleError = 'Enter a title'; //if it is, make the text in the $titleError equal to 'enter a title' [will change the <span> text]
  } else {
    $title = $_POST["eventTitle"];
    $validTitle = TRUE;
  }

  //same logic as above. I'm just checking each field that's required to make sure there's information entered
  if (empty($_POST["eventDate"])){
    $eventDateError = "Select a date and time for your event from the calendar and time indicator.";
  } else {
    $eventDate = $_POST["eventDate"];
    $validDate = TRUE;
  }

  if (empty($_POST["eventLocation"])){
    $eventLocationError = "Type the location for the event. If it has not been selected yet, please type 'TBD' and you can edit it later.";
  } else {
    $eventLocation = $_POST["eventLocation"];
    $validLocation = TRUE;
  }

  if (empty($_POST["eventDescription"])){
    $eventDescriptionError = "Enter a description of the event";
  } else {
    $eventDescription = $_POST["eventDescription"];
    $validDescription = TRUE;
  }


  if ($validTitle && $validDate && $validLocation && $validDescription == TRUE) { //if all the data has been entered correctly

    $displayDate = DateTime::createFromFormat('Y-m-d H:i:s', $eventDate);
    $ext = end((explode(".", $_FILES["eventPoster"]["name"]))); # extra () to prevent notice
    $pname = $displayDate."-".$title.$ext;

    #temporary file name to store file
    $tname = $_FILES["eventPoster"]["tmp_name"];

    #upload directory path
    $uploads_dir = 'uploads/eventPosters/';

    #moves the uploaded file to specific location
    move_uploaded_file($tname, $uploads_dir.$pname);

    $data = array($title, $pname, $eventDate, $eventLocation, $eventDescription, $_SESSION["username"]);

    $sql = "INSERT into events(eventTitle,eventPoster, eventDate, eventLocation, eventDescription, creatorUsername) VALUES(?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);

    $stmt->execute($data);

    closeConnection($pdo);
    header('Location: events.php'); //redirect to index.php
    exit();
  }
}
?>

<h1>Create and Post an Event</h1>
<p><span class="important-notice"> An asterisk (*) indicates a required field.</span></p>
<form id="event" name="makeEvent"  method="POST" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"> <!-- 'htmlspecialchars($_SERVER["PHP_SELF"]);' just redirects the page back onto itself !-->
  <fieldset>
    <p>Please fill in this form to post an event to the public.</p>
    <table class="tableFieldset">
      <tr>
        <th><label>Event Title:<span class="important-notice">*</span></label></th>
        <td><span class="leftBlank"><?php echo $titleError;?></span><input type="text" placeholder="Name of event" id="title" name="eventTitle" autofocus value = "<?php echo $title;?>"></td>
      </tr>
      <tr>
        <th><label>Poster:<span class="important-notice">*</span></label></th>
        <td><span class="leftBlank"><?php echo $eventPosterError;?></span><input type="file"  name="eventPoster" value = "<?php echo $eventPoster; ?>" required>
        </td>
      </tr>
      <tr>
        <th><label>Event Date and Time:<span class="important-notice">*</span></label></th>
        <td><span class="leftBlank"><?php echo $eventDateError;?></span><input type="datetime-local" name="eventDate" id="datetime" value = "<?php echo $eventDate; ?>"></td>
      </tr>
      <tr>
        <th><label>Event Location:<span class="important-notice">*</span></label></th>
        <td><span class="leftBlank"><?php echo $eventLocationError;?></span><input type="text" placeholder="Where is the event being held?" id="location" name="eventLocation" value = "<?php echo $eventLocation; ?>"></td>
      </tr>
      <tr>
        <th><label>Description of the Event:<span class="important-notice">*</span></label></th>
        <td><span class="leftBlank"><?php echo $eventDescriptionError;?></span><input type="leftBlank" name="eventDescription" id="description" placeholder="What's happening at this event?" value="<?php echo $eventDescription; ?>"></td>
      </tr>
    </table>
  </fieldset>
  <input id="postEvent" type="submit" value="Post New Event">
</form>
