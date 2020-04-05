<!DOCTYPE html>
<html lang="en">
<head>
  <title>Member List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
  <?php
    //include files
    require_once('include/globals.inc.php');
    require_once('include/top-navigation-bar.inc.php');



    if(!isLoggedIn()){
      echo '<main>';
      include 'include/error-notLoggedIn.inc.php';
    }elseif(!isApproved()){
      echo '<main>';
      include 'include/error-mustBeApproved.inc.php';
    }else{
      echo '
      <table id=\'memberList-head\'>
        <tr>
          <td id=\'memberList-headLeft\'><h1>Member List</h1></td>
          <td id=\'memberList-headRight\'>
            <form action=\'searchMembers.php\' method=\'POST\'>
                 <input type = \'text\' name=\'search\' placeholder=\'Search for users\'>
                 <button type = \'submit\' name = \'submit-search\'>Search</button>
            </form>
          </td>
        </tr>
      </table>';

      //this below doesn't work because the search bar is fixed and the dropdown menu ends up behind it
      // echo '
      // <div id=\'memberList-head\'>
      //   <h1>Member List</h1>
      //   <form action=\'searchMembers.php\' method=\'POST\'>
      //     <input type = \'text\' name=\'search\' placeholder=\'Search for users\'>
      //     <button type = \'submit\' name = \'submit-search\'>Search</button>
      //   </form>
      // </div>

      echo '<main id=\'memberList\'>';

      if(isApproved()){
      include 'memberList-data.php';
      }else{
      include 'include/error-mustBeApproved.inc.php';
      }
    }

    echo '</main>';

    require_once('include/footer.inc.php');
  ?>
</body>
</html>
