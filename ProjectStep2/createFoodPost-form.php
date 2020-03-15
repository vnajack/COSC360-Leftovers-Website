<form id="foodPost" name="makePost" method="post" action="index.php">
  <h1>Post Leftovers to the Public</h1>
  <p><span class="important-notice"> An asterisk (*) indicates a required field.</span></p>
  <fieldset>
    <p><strong>Please fill out the following details to post the food drop to the public.</strong></p>
    <table class="tableFieldset">
      <tr>
        <th><label>Image of Food:<span class="important-notice">*</span></label></th>
        <td><input type="file"  name="foodImage" accept="image/*" title="Pleave provide an image of the leftovers"></td>
      </tr>
      <tr>
        <th><label>How much longer (in minutes) will the leftovers be fresh?<span class="important-notice">*</span></label></th>
        <td><input type="number" name="safeUntil" min="1" max="45" title="How much longer the leftovers will be fresh?"></td>
      </tr>
      <tr>
        <td colspan="2"><p class="reminder">Reminder: we can only keep food out for 30 minutes until it needs to be refrigerated or completely eaten <strong>unless</strong> otherwise indicated by the food donor.</p></td>
      </tr>
      <tr>
        <th><label>List the food items you picked up:<span class="important-notice">*</span></label></th>
        <td><input type="text"  name="typeOfFood" title="Please list the food items you picked up."></td>
      </tr>
      <tr>
        <th><label>Where will these leftovers be located?<span class="important-notice">*</span></label></th>
        <td><input type="text" name="foodLocation" title="Please indicate where you are taking the leftovers."></td>
      </tr>
      <tr>
        <th><label>Provide an estimate of how much food has been saved (in kg):</label></th>
        <td><input type="number" name="savedFood" min=1 title="how much food has been saved?"></td>
      </tr>
      <tr>
        <th><label>Where did the leftovers come from?<span class="important-notice">*</span></label></th>
        <td><input type="text" name="source" title="Where did these leftovers come from?"></td>
      </tr>
    </table>
  </fieldset>
  <input id="postFoodDrop" type="submit" value="Post">
</form>
