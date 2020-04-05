function checkBlank(input){
  if (input == '') {
    return true;
  } else{
    return false;
}}

window.onload = function(){
  var mainForm = document.getElementById("event");

mainForm.onsubmit = function(e){
  var inputtedTitle = document.forms["makeEvent"]["eventTitle"].value;
  var inputtedPoster = document.forms["makeEvent"]["eventPoster"].value;
  var inputtedDate = document.forms["makeEvent"]["eventDate"].value;
  var inputtedLocation = document.forms["makeEvent"]["eventLocation"].value;
  var inputtedDescription = document.forms["makeEvent"]["eventDescription"].value;

  if (checkBlank(inputtedTitle)) {
  	alert("Please enter a title for your event.");
  	e.preventDefault();
  } else if (checkBlank(inputtedPoster)){
  	alert("Please include your event poster for the public to see it.");
  	e.preventDefault();
  } else if (checkBlank(inputtedDate)){
  	alert("Please select a date and time for your event from the calendar and time indicator.");
  	e.preventDefault();
  } else if (checkBlank(inputtedLocation)){
  	alert("Please type the location for the event. If it has not been selected yet, please type 'TBD' and you can edit it later.");
  	e.preventDefault();
  } else if (checkBlank(inputtedDescription)){
  	alert("Enter a brief description for the event");
  	e.preventDefault();
  } else {
  	return true;
  }
}
}
