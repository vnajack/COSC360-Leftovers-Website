
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
    require_once('include/db_connection.php'); //connect to database

//set stuff up for pdos
    try{
        $pdo = openConnection();
    } catch (PDOException $e){
        die($e->getMessage());
    }
  ?>
    <h1>Where can I find leftovers?</h1>
    <p>Please note that when leftovers are posted, they are only available while supplies last. The "time left" is used to ensure we distribute the leftovers within a safe time limit. </p>
    <main id="findLeftovers">
      <form action="search.php" method="POST">
        <input type = "text" name="search" placeholder="Search for posts">
        <button type = "submit" name = "submit-search">Search</button>
      </form>
      <br>
      <?php
     $sql = "SELECT * FROM foodpost ORDER BY timeOfPost DESC";
     $result = $pdo->query($sql); //executes query
     while ($row = $result->fetch()){
       //variables we're using from the database
       $postID = $row["postID"];
       $img_src = $row["postPicture"];
       $foodItems = $row["postFoodItems"];
       $safeUntil = $row["minutesSafe"]; //TODO: We need to figure out how to make a countdown timer for this --probably using JavaScript
       $timeOfPost = $row["timeOfPost"];
       $location = $row["postLocation"];
       $description = $row["postDescription"];
       $saved = $row["postAmount"];
       $donor = $row["donorName"];


       //check variables and adjust as needed
       $postDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $timeOfPost);
       $postDate = $postDateTime->format('F jS, Y');
       $postTime = $postDateTime->format('g:i a');

       $uploads_dir = 'uploads/foodPostPictures/'.$img_src;

       if(empty($donor)){
         $donor = "Anonymous donor";
       }

       //create a post based off of variables from the database

       echo '
       <article>
        <h2><time datetime="'.$timeOfPost.'">'.$postDate.' at '.$postTime.'</time> <span class="time-remaining" title="Freshness countdown">Time left: '.$safeUntil.':00</span>';

       if(isAdmin()){
         echo "
         <span class='editDeletePost'>
           <a href=\"editFoodPost.php?postID=".$postID."\"><img class=\"editDelete\" src=\"images/icons8-edit-30.png\" alt=\"Edit Icon\" title=\"Edit this post\"></a>
           <a href=\"deleteFoodPost.php?postID=".$postID."\"><img class=\"editDelete\" src=\"images/icons8-delete-48.png\" alt=\"Delete Icon\" title=\"Delete this post\"></a>
         </span>";
       }

         echo'</h2>
         <figure>
         <img src="'.$uploads_dir.'" alt="'.$foodItems.'" title="'.$foodItems.'" width="450" height="350" class="img-fluid">
         <figcaption>'.$foodItems.'</figcaption>
         </figure>
         <p>Where: '.$location.'</p>
         <p>'.$description.'</p>
         <p>Estimated amount of food saved: '.$saved.' kg</p>
         <p>Leftovers from '.$donor.' </p>
       </article>';
     }
      closeConnection($pdo);

    echo '</main>';

    require_once("include/right-column.inc.php");
    require_once("include/footer.inc.php");
?>
</body>
</html>
