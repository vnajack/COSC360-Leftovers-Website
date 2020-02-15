function checkBlank(input){
  if (input == '') {
    return true;
} else return false;
}

window.onload = function(){
  var mainForm = document.getElementById("event");

mainForm.onsubmit = function(e){
  var inputedTitle = document.forms["makeEvent"]["eventTitle"].value;
  var inputedDate = document.forms["makeEvent"]["eventDate"].value;
  var inputedTime = document.forms["makeEvent"]["eventTime"].value;
  var inputedLocation = document.forms["makeEvent"]["eventLocation"].value;
  var inputedDescription = document.forms["makeEvent"]["eventDescription"].value;

  if (checkBlank(inputedTitle)) {
  			alert("Please enter a title for your event.");
  			e.preventDefault();
  		} else if (inputedDate == ''){
  			alert("Please select a date from the calendar to choose the day of the event");
  			e.preventDefault();
  		}
  		else if (checkBlank(inputedTime)){
  			alert("Please choose a time for your event");
  			e.preventDefault();
  		}else if (checkBlank(inputedLocation)){
  			alert("Please type the location for the event. If it has not been selected yet, please type 'TBD' and you can edit it later");
  			e.preventDefault();
  		}
  		else if (checkBlank(inputedDescription)){
  			alert("Enter a brief description for the event");
  			e.preventDefault();
  		}
  		else {
  			return true;
  		}
  }
}
