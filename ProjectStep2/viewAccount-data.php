<h1> Welcome back, [user's name]</h1>
<form id="accountInfo" name="accountInformation" method="post" action="viewAccount.html">
  <fieldset>
    <img src="images/icons8-person-64.png" alt="Profile Picture">
    <table class="tableFieldset">
      <tbody>
        <tr>
          <th><label> Username: </label>
          <td> <input disabled type="text" name="username" value="[user's username]"></td>
        </tr>
        <tr>
          <th><label> Name: </label></th>
          <td> <input  type="text" name="name" value="[user's full name]" required></td>
        </tr>
        <tr>
          <th><label> Email Address: </label></th>
          <td> <input type="text" name="email" value="[user's email address]" required></td>
        </tr>
        <tr>
          <th><label>Phone Number:</label></th>
          <td><input type="text" name="phonenum" value="[user phone number]" title="Must be a 10-digit phone number in the format 123-456-7890"></td>
        </tr>
        <tr>
          <th><label>Program/Degree: </label></th>
          <td><input type="text" name="program" value="[user program/degree]"></td>
        </tr>
        <tr>
          <th><label>Year of Study: </label></th>
          <td><input  type="text" name="yearOfStudy" value="[user's year of study]"></td>
        </tr>
        <tr>
          <th><label>Profile Picture:</label></th>
          <td><input type="file" name="profilePicture" accept="image/*"></td>
        </tr>
        <tr>
          <th><label>Password:</label></th>
          <td><input type="password" name="password" required></td>
        </tr>
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><input type="submit" value="Save"></td>
        </tr>
      </tfoot>
    </table>
  </fieldset>
</form>
