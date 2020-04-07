<!DOCTYPE html>
<html lang="en">
<head>
  <title>Events</title>
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

  try{
    $pdo = openConnection();
  } catch (PDOException $e){
    die($e->getMessage());
  }

  ?>
  <main id="eventsList">
    <section id="upcomingEvents">
      <h1>Upcoming Events</h1>
      <?php
      $sql = "SELECT * FROM events WHERE eventDate >= CURDATE() ORDER BY eventDate ASC";
      $result = $pdo->query($sql); //run the query
      if($result->rowCount() > 0){
        while ($row = $result->fetch()){
          //initializing variables from database
          $img_src = $row["eventPoster"];
          $eventTitle = $row["eventTitle"];
          $eventDate= $row["eventDate"];
          $eventLocation = $row["eventLocation"];
          $description = $row["eventDescription"];

          $eventDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $eventDate);
          $displayDate = $eventDateTime->format('F jS, Y');
          $displayTime = $eventDateTime->format('g:i a');

          $uploads_dir = 'uploads/eventPosters'.'/'.$img_src;

          //creating an article using the info from the database
          echo '<article>
          <h2>'.$eventTitle.'</h2>
          <figure>
            <img src="'.$uploads_dir.'" alt="Poster for '.$eventTitle.' event" width="450" height="350" class="img-fluid">
            <figcaption>'.$description.'</figcaption>
          </figure>
          <p>When: <time datetime="'.$eventDate.'">'.$displayDate.' at '.$displayTime.'</time></p>
          <p>Where:'.$eventLocation.'</p>
          </article>';
        }
      }else{
        echo "<p>Unfortunately, there are no upcoming events.</p>";
      }

      ?>

    </section>
    <br>
    <section id="pastEvents">
      <h1>Past Events</h1>
      <?php
      $sql = "SELECT * FROM events WHERE eventDate < CURDATE() ORDER BY eventDate DESC";
      $result = $pdo->query($sql); //run the query
      while ($row = $result->fetch()){
        //initializing variables from database
        $img_src = $row["eventPoster"];
        $eventTitle = $row["eventTitle"];
        $eventDate= $row["eventDate"];
        $uploads_dir = 'uploads/eventPosters'.'/'.$img_src;
        $eventLocation = $row["eventLocation"];
        $description = $row["eventDescription"];

        $eventDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $eventDate);
        $displayDate = $eventDateTime->format('F jS, Y');
        $displayTime = $eventDateTime->format('g:i a');

        //creating an article using the info from the database
        echo '<article>
        <h2>'.$eventTitle.'</h2>
        <figure>
          <img src="'.$uploads_dir.'" alt="Poster for '.$eventTitle.' event" width="450" height="350" class="img-fluid">
          <figcaption>'.$description.'</figcaption>
        </figure>
        <p>When: <time datetime="'.$eventDate.'">'.$displayDate.' at '.$displayTime.'</time></p>
        <p>Where:'.$eventLocation.'</p>
        </article>';
      }
      ?>
    </section>
  </main>
  <?php
  closeConnection($pdo);
  require_once("include/right-column.inc.php");
  require_once("include/footer.inc.php");
  ?>
</body>
</html>
