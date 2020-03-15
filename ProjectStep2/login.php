<!DOCTYPE html>
<html lang="en">
<head>
  <title>Log In</title>
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
  <main id="loginPage">
    <h1> Welcome Back! </h1>
    <form name="createAccount" method=post action="index.php" autocomplete="off">
  		<fieldset>
  		<h2>Log In</h2>
  		<table class="tableFieldset">
  			<tr>
  				<th><label>Username: </label></th>
  				<td><input type="text" name="username" pattern="[a-zA-Z0-9]+" title="Can only contain letters and numbers. No punctuation or special characters." required autofocus></td>
  			</tr>
  			<tr>
  				<th><label>Password: </label></th>
  				<td><input type="password" name="password" pattern=".{6,}" title="Your password must contain 6 or more characters" required></td>
  			</tr>
      </table>
    	<input type = "submit">
  	 </fieldset>
  	</form>
		<p class="center-text"><a href="forgotCredentials.php">Forgot your credentials?</a></p>
		<p class="center-text">Don't have an account? <a href="volunteerForm.php">Become a volunteer!</a></p>
	</main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
