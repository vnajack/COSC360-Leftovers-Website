<!DOCTYPE html>
<html lang="en">
<head>
  <title>Home</title>
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
    include 'db_connection.php';

    try{
        $pdo = openConnection();
    } catch (PDOException $e){
        die($e->getMessage());
    }
  ?>
    <main id="searchResults">
      <?php
      if (isset($_POST['submit-search'])){
        $searchTerm = $_POST["search"];
        $searchFor = '%' .$searchTerm . '%';
        $sql = "SELECT * from foodpost WHERE typeOfFood Like '$searchFor'";
        $result = $pdo->query($sql);

      //obtains the number of rows returned from the query
        $nRows = $pdo->query("SELECT count(*) from foodpost WHERE typeOfFood Like '$searchFor'")->fetchColumn();

        if ($nRows == 0){ //if no rows are returned,
          echo "<h1> There are no posts that match with the keyword you have entered ( '$searchTerm' ) <h2>";
        } else {
          //if we have results that match the query
        while ($row = $result->fetch()){
          $img_src = $row["foodImage"];
          $foodItems = $row["typeOfFood"];
          $safeUntil = $row["safeUntil"];
          $uploads_dir = 'uploads/foodPostPictures'.'/'.$img_src;
          $timeOfPost = $row["timeOfPost"];
          $location = $row["foodLocation"];
          $saved = $row["savedFood"];
          $donor = $row["sources"];
          echo '<article>
            <h2><time datetime="'.$timeOfPost.'">'.$timeOfPost.'</time> <span class="time-remaining" title="Leftovers available while supplies last. This is only a freshness countdown.">Time left: '.$safeUntil.'</span></h2>
            <figure>
            <img src="'.$uploads_dir.'" alt="'.$foodItems.'" width="450" height="350" class="img-fluid">
            <figcaption>'.$foodItems.'</figcaption>
            </figure>
            <p>Where:'.$location.'</p>
            <p>Estimated amount of food saved: '.$saved.' kg</p>
            <p>Free '.$foodItems.' in the '.$location.'!!</p>
            <p> Leftovers from '.$donor.' </p>
          </article>';
        }
      }
    }
       ?>
    </main>
<?php
  include "include/right-column.inc.php";
  include "include/footer.inc.php";
?>
</body>
</html>
