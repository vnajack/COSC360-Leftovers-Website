<!DOCTYPE html>
<html lang="en">
<head>
  <title>Delete Member</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    require_once('include/globals.inc.php');
    require_once('include/top-navigation-bar.inc.php');

    $nameError = $upperName = "";

    if(isLoggedIn() && isAdmin()){
      require_once('include/db_connection.php');
      echo '<main id=\'deleteMember\'>';
      echo "<a href=\"memberList.php\">&laquo; Back to Member List</a>";
      try{
          $pdo = openConnection();
      } catch (PDOException $e){
          die($e->getMessage());
      }

      if($_SERVER["REQUEST_METHOD"] == "GET"){
        $_SESSION["deleteU"] = $_GET["username"];

        $sql = "SELECT name FROM users WHERE username = ?";
        if($stmt = $pdo->prepare($sql)){
          $stmt->bindValue(1, $_SESSION["deleteU"]);
          if($stmt->execute()){
            if($row = $stmt->fetch()){
              $_SESSION["deleteN"] = $row["name"];
            }
          }else{
            print("<script>window.alert('Oops! Something went wrong. Please try again later.');window.location.href = 'memberList.php';</script>");
          }
        }
        closeConnection($pdo);
        $upperName = strtoupper($_SESSION["deleteN"]);

      }
      if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name_entered = $_POST["name"];

        if(strcmp($name_entered, strtoupper($_SESSION["deleteN"]))==0){
          try{
            $sql = "DELETE FROM users WHERE username = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindValue(1, $_SESSION["deleteU"]);
            $stmt->execute();

            unset($_SESSION["deleteU"]);
            unset($_SESSION["deleteN"]);

            print("<script>window.alert('Successfully deleted member.');window.location.href = 'memberList.php';</script>");
          }catch(PDOException $e){
            print("<script>window.alert('Error. Unable to delete member. Please try again later.');</script>");
          }
        }else{
          $nameError = "The names did not match";
        }
        closeConnection($pdo);
      }
      ?>

      <h1>Delete Account?</h1>
      <p>Are you sure you want to delete <?php echo $_SESSION["deleteN"];?>'s account permanently?</p>
      <p>This cannot be undone!</p>

      <form id="deleteForm" name="deleteForm" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <fieldset>
        <table class="tableFieldset">
          <tbody>
            <tr>
              <th><label>Type <b><?php echo strtoupper($_SESSION["deleteN"]); ?></b> to confirm</label></th>
            </tr>
            <tr>
              <td><input type="text" name="name" title="Enter the member's name to confirm"></td>
              <span class="leftBlank"><?php echo "<td>".$nameError."</td>";?></span>
            </tr>
            <tr>
              <td><input type="submit" value="Delete"></td>
            </tr>
            <tr>
              <td><input type="button" value="Cancel and Go Back" onclick="location.href='memberList.php'" title="The member will not be deleted and you will return to the member list."></td>
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
