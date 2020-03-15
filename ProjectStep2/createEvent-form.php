<h1>Create and Post an Event</h1>
<p><span class="important-notice"> An asterisk (*) indicates a required field.</span></p>
<form id="event" name="makeEvent" method="post" action="events.php">
  <fieldset>
    <p>Please fill in this form to post an event to the public.</p>
    <table class="tableFieldset">
      <tr>
        <th><label>Event Title:<span class="important-notice">*</span></label></th>
        <td><input type="text" placeholder="Name of event" id="title" name="eventTitle" autofocus ></td>
      </tr>
      <tr>
        <th><label>Poster:<span class="important-notice">*</span></label></th>
        <td><input type="file"  name="eventPoster" ></td>
      </tr>
      <tr>
        <th><label>Event Date and Time:<span class="important-notice">*</span></label></th>
        <td><input type="datetime-local" name="eventDate" id="datetime" ></td>
      </tr>
      <tr>
        <th><label>Event Location:<span class="important-notice">*</span></label></th>
        <td><input type="text" placeholder="Where is the event being held?" id="location" name="eventLocation"></td>
      </tr>
      <tr>
        <th><label>Description of the Event:<span class="important-notice">*</span></label></th>
        <td><input type="text" name="eventDescription" id="description" placeholder="What's happening at this event?" ></td>
      </tr>
    </table>
  </fieldset>
    <input id="postEvent" type="submit" value="Post New Event">
</form>
