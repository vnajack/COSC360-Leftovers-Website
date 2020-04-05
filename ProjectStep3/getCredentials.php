<!DOCTYPE html>
<html lang="en">
<head>
  <title>Your Credentials</title>
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
  <main id="getCredentials">
    <h1>Your Credentials</h1>
    <p>Thank you for confirming your identity with your email address and security question.</p>
    <p>Find below the credential you forgot. Please keep this information in a safe place.</p>
    <table>
      <tbody>
      <tr>
        <th>Username:</th>
        <td>your username here</td>
      </tr>
      <tr>
        <th>Password:</th>
        <td>your password here</td>
      </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><a href="login.php">Log in</a></td>
        </tr>
      </tfoot>
    </table>
  </main>
  <?php
    include "include/right-column.inc.php";
    include "include/footer.inc.php";
  ?>
</body>
</html>
