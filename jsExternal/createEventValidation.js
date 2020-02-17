function checkBlank(input){
  if (input == '') {
    return true;
} else return false;
}

window.onload = function(){
  var mainForm = document.getElementById("event");

mainForm.onsubmit = function(e){
  var inputedTitle = document.forms["makeEvent"]["eventTitle"].value;
  var inputedPoster = document.forms["makeEvent"]["eventPoster"].value;
  var inputedDate = document.forms["makeEvent"]["eventDate"].value;
  var inputedDescription = document.forms["makeEvent"]["eventDescription"].value;

  if (checkBlank(inputedTitle)) {
    console.log(inputedTitle);
  			alert("Please enter a title for your event.");
  			e.preventDefault();
  		} else if(checkBlank(inputedPoster)){
        alert("Please upload an image of the poster.");
  			e.preventDefault();
      }
      else if (checkBlank(inputedDate)){
  			alert("Please select the date and time that the event to be held.");
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
