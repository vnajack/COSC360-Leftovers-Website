<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Post</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    require_once('include/globals.inc.php');
    require_once('include/top-navigation-bar.inc.php');

    $postID_error = "";

    if(isLoggedIn() && isAdmin()){
      require_once('include/db_connection.php');
      echo "<main id=\"deleteFoodPost\">";
      echo "<a href=\"index.php\">&laquo; Back to Leftovers Posts</a>";
      echo "<h1>Delete Post?</h1>";

      try{
          $pdo = openConnection();
      } catch (PDOException $e){
          die($e->getMessage());
      }

      if($_SERVER["REQUEST_METHOD"] == "GET"){
        $_SESSION["deletePostID"] = $_GET["postID"];
      }

      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $postID_entered = $_POST["postID"];

        if(strcmp($postID_entered, $_SESSION["deletePostID"])==0){
          try{
            $sql = "DELETE FROM foodpost WHERE postID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_SESSION["deletePostID"]);
            $stmt->execute();

            unset($_SESSION["deletePostID"]);

            print("<script>window.alert('Successfully deleted post.');window.location.href = 'index.php';</script>");
          }catch(PDOException $e){
            print("<script>window.alert('Error. Unable to delete post. Please try again later.');</script>");
          }
        }else{
          $postID_error = "The numbers did not match";
        }
        closeConnection($pdo);
      }

      $sql = "SELECT * FROM foodpost WHERE postID = ?";

      if($stmt = $pdo->prepare($sql)){
        $stmt->bindValue(1, $_SESSION["deletePostID"]);
        if($stmt->execute()){
          if($row = $stmt->fetch()){
            $postID = $row["postID"];
            $img_src = $row["postPicture"];
            $foodItems = $row["postFoodItems"];
            $safeUntil = $row["minutesSafe"]; //TODO: We need to figure out how to make a countdown timer for this --probably using JavaScript
            $timeOfPost = $row["timeOfPost"];
            $location = $row["postLocation"];
            $description = $row["postDescription"];
            $saved = $row["postAmount"];
            $donor = $row["donorName"];

            $postDateTime = DateTime::createFromFormat('Y-m-d H:i:s', $timeOfPost);
            $postDate = $postDateTime->format('F jS, Y');
            $postTime = $postDateTime->format('g:i a');

            $uploads_dir = 'uploads/foodPostPictures/'.$img_src;

            if(empty($donor)){
              $donor = "Anonymous donor";
            }

            echo '
            <article>
             <h2><time datetime="'.$timeOfPost.'">'.$postDate.' at '.$postTime.'</time> <span class="time-remaining" title="Freshness countdown">Time left: '.$safeUntil.':00</span></h2>
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
        }else{
          print("<script>window.alert('Oops! Something went wrong. Please try again later.');window.location.href = 'memberList.php';</script>");
        }
      }

      ?>


      <p class="important-notice center-text">Are you sure you want to delete this post permanently?<br>This cannot be undone!</p>

      <form id="deleteForm" name="deleteForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>
        <table class="tableFieldset">
          <tbody>
            <tr>
              <th><label>Type <b><?php echo $_SESSION["deletePostID"]; ?></b> to confirm</label></th>
              <td></td>
            </tr>
            <tr>
              <td><input type="text" name="postID" title="Enter the post's ID number to confirm"></td>
              <?php echo "<td><span class=\"leftBlank\">".$postID_error."</span></td>";?>
            </tr>
            <tr>
              <td><input type="submit" value="Delete"></td>
              <td></td>
            </tr>
            <tr>
              <td><input type="button" value="Cancel and Go Back" onclick="location.href='index.php'" title="The post will not be deleted and you will return to the member list."></td>
              <td></td>
            </tr>
          </tbody>
        </table>
        </fieldset>
      </form>

      <?php

    }elseif(isLoggedIn()){
      echo '<main>';
      require_once("include/error-mustBeAdmin.inc.php");
    }else{
      echo '<main>';
      require_once("include/error-notLoggedIn.inc.php");
      require_once("include/right-column.inc.php");
    }

    echo '</main></div>';

    require_once('include/footer.inc.php');
  ?>
</body>
</html>
