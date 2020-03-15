<!DOCTYPE html>
<html lang="en">
<head>
  <title>Forgotten Credentials</title>
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
  <main id="forgottenCredentials">
    <h1>Forgot Credentials</h1>
    <form name="getCredentials" method=post action="getCredentials.php" autocomplete="off">
      <fieldset>
        <p><strong>Fill out the following fields to obtain your credentials.</strong></p>
        <table class="tableFieldset">
          <tr>
            <th><label>Which email address associated with your account?</label></th>
            <td><input type="email" name="email" required></td>
          </tr>
          <tr>
            <th><label> Which credential(s) did you forget? </label></th>
            <td><input type="checkbox" name="username" value="username">Username &nbsp;<input type="checkbox" name="password" value="password">Password</td>
          </tr>
          <tr>
            <th><label>Select your security question </label></th>
            <td><select name="securityQuestion" required>
              <option value="" selected hidden disabled>Select yours</option>
              <option value="Q1">What is the name of your first pet?</option>
              <option value="Q2">What was the first name of your childhood best friend?</option>
            </select></td>
          </tr>
          <tr>
            <th><label>Provide the answer to your security question:</label></th>
            <td><input type="text" name="securityResponse" required></td>
          </tr>
        </table>
      </fieldset>
      <input type = "submit">
    </form>
  </main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
