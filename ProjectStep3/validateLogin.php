<?php

require_once('include/globals.inc.php');
require_once('include/db_connection.php');
global $isLoggedIn, $isVolunteerLoggedIn, $isAdminLoggedIn;

try{
    $pdo = openConnection();
} catch (PDOException $e){
    die($e->getMessage());
}

// Check if the user is already logged in, if yes then redirect them to index.php
if(!empty($_SESSION["username"]) && $isLoggedIn){
    header("location: viewAccount.php");
}

// Processing form data when form is submitted
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  //print("<script>window.alert('submit was clicked');</script>"); //this was just used for testing
  $username = $_POST["username"];
  $password = $_POST["password"];
  // Validate credentials

  if(!empty($username) && !empty($password)){ // check if both username and password were entered
      $sql = "SELECT name, typeOfUser, username, password FROM users WHERE username = ?"; // prepared statement
      if($stmt = $pdo->prepare($sql)){
          $stmt->bindValue(1, $username); // Bind variable to the prepared statement as a parameter
          if($stmt->execute()){ // Attempt to execute the prepared statement
              if($stmt->rowCount() == 1){ // Check if username exists, if yes then verify password
                  if($row = $stmt->fetch()){
                      $databasePassword = $row["password"];
                      if(strcmp($password, $databasePassword)==0){
                        // Password is correct, so change session and global variables
                          session_destroy();
                          session_start();
                          $_SESSION["username"] = $username;
                          $_SESSION["fullName"] = $row["name"];
                          $_SESSION["type"] = $row["typeOfUser"];
                        // Redirect user to user's profile
                        header("location: viewAccount.php");
                      } else{
                          // Display an error message if password is not valid
                          print("<script>window.alert('The password you entered for that username was incorrect.');window.location.href = 'login.php';</script>");
                      }
                  }
              } else{
                  // Display an error message if username doesn't exist
                  print("<script>window.alert('The username entered does not match with any in our records. Please try again.');window.location.href = 'login.php';</script>");
              }
          } else{ // in the case that the prepared statement fails (which would be odd)
            print("<script>window.alert('Oops! Something went wrong. Please try again later.');window.location.href = 'login.php';</script>");
          }
          unset($stmt); // Close statement
      }
  }
  closeConnection($pdo); // Close connection
}
?>
