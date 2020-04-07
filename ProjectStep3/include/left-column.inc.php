
<?php
  include "include/db_connection.php";

  try{
      $pdo = openConnection();
  } catch (PDOException $e){
      die($e->getMessage());
  }
  $sql = "select * from foodpost ORDER BY timeOfPost DESC";
  $result = $pdo->query($sql); //executes query
  $totalAmount = 0;
  while ($row = $result->fetch()){
    $totalAmount += $row["postAmount"];
  }

  $futureEventLine = "";

  $sql = "SELECT * FROM events WHERE eventDate >= CURDATE() ORDER BY eventDate ASC LIMIT 1;";
  $result = $pdo->query($sql); //executes query
  if($result->rowCount() > 0){
    while ($row = $result->fetch()){
      $eventTitle = $row["eventTitle"];
      $eventDateTime = $row["eventDate"];
      $eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $eventDateTime)->format('M jS');
    }
    $futureEventLine = "<p id='left-sidebar-event'>Our next event:</p><p id='left-sidebar-event'><a href='events.php'>".$eventTitle." on ".$eventDate."</a></p>";
  }

  closeConnection($pdo);
?>

<div id="container">
  <section id="left-sidebar">
    <figure>
      <a href="index.php"><img src="images/logo_leftovers.png" class="img-fluid" alt="Leftovers Club Logo"></a>
      <figcaption> Reducing food waste on campus at UBC Okanagan</figcaption>
    </figure>
    <article>
      <?php
      echo "<p>We have saved approx. <u><b>".$totalAmount." kg</b></u> of food!</p>";
      echo $futureEventLine;
      ?>
      <p>
      <a href="https://www.facebook.com/LeftoversUBCO/"><img src="images/facebook_16.png" alt="Facebook Link"></a>
      &nbsp;
      <a href="mailto:leftoversubco@gmail.com?Subject=From%20Leftovers%20Club%20Website" target="_top"><img src="images/email_16.png" alt="Email Link"></a>
      </p>
    </article>
  </section>
  <section id="center-column">
