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
    require_once("include/globals.inc.php");
    require_once("include/top-navigation-bar.inc.php");
    require_once("include/left-column.inc.php");
    require_once('include/db_connection.php');

  echo "<a href=\"index.php\">&laquo; Back to Leftovers</a>";

    try{
        $pdo = openConnection();
    } catch (PDOException $e){
        die($e->getMessage());
    }
  ?>
    <main id="searchResults">

      <?php
      if (isset($_POST['submit-search'])){ //if search button was clicked
        //obtains what the user entered in the text field
        $searchTerm = $_POST["search"];
        echo '<h1>Results for \'<u>'.$searchTerm.'</u>\'</h1>';
        //sets up to find the keyword anywhere in a post
        $searchFor = '%' .$searchTerm . '%';

        $sql = "SELECT * from foodpost WHERE postFoodItems Like '$searchFor'";
        $result = $pdo->query($sql); //executes the query (could also use a prepared statement like I did in validateLogin.)

      //obtains the number of rows returned from the query
        $nRows = $pdo->query("SELECT count(*) from foodpost WHERE postFoodItems Like '$searchFor'")->fetchColumn();

        if ($nRows == 0){ //if no rows are returned,
          echo "<h1> There are no posts that match with the keyword you have entered ( '$searchTerm' ) <h2>";
        } else {
          //if we have results that match the query
          while ($row = $result->fetch()){
            $img_src = $row["postPicture"];
            $foodItems = $row["postFoodItems"];
            $safeUntil = $row["minutesSafe"];
            $timeOfPost = $row["timeOfPost"];
            $location = $row["postLocation"];
            $description = $row["postDescription"];
            $saved = $row["postAmount"];
            $donor = $row["donorName"];


            //check variables and adjust as needed
            $postDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $timeOfPost);
            $postDate = $postDateTime->format('F jS, Y');
            $postTime = $postDateTime->format('H:i a');

            $uploads_dir = 'uploads/foodPostPictures/'.$img_src;

            if(empty($donor)){
              $donor = "Anonymous donor";
            }

            //create a post based off of variables from the database
            //to shorten the first line of our article
            $countdownTitle = "Leftovers available while supplies last. This is only a freshness countdown.";

            echo '<article>
              <h2><time datetime="'.$timeOfPost.'">'.$postDate.' at '.$postTime.'</time> <span class="time-remaining" title='.$countdownTitle.'>Time left: '.$safeUntil.':00</span></h2>
              <figure>
              <img src="'.$uploads_dir.'" alt="'.$foodItems.'" width="450" height="350" class="img-fluid">
              <figcaption>'.$foodItems.'</figcaption>
              </figure>
              <p>Where: '.$location.'</p>
              <p>'.$description.'</p>
              <p>Estimated amount of food saved: '.$saved.' kg</p>
              <p>Leftovers from '.$donor.' </p>
            </article>';
          }
        }
      }
        closeConnection($pdo);
    echo "</main>";
  include "include/right-column.inc.php";
  include "include/footer.inc.php";
?>
</body>
</html>
