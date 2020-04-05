
function checkDonor(){
  var inputedDonor = document.forms["donorSubmission"]["donor"].value; //value for whichever select option the user chose
  var createTextbox = document.getElementById("createTextbox"); //the div in foodDonorForm.html

	if (inputedDonor == "onCampusEvent"){ //if the user chose "On-campus Event"
		//The innerHTML method inserts it into the div instead of a separate file
		createTextbox.innerHTML = createTextbox.innerHTML + "<p><label>What is the name of the event? </label><input type='text' name='eventName'></p><p><label>Where can we pick up the leftovers? </label><input type='text' name='eventLocation'></p>"
		//inputedDonor.innerHTML = "<label> Tell us the name of the event as well as where the food can be picked up from</label><br><input type='text' name='nameEvent'>";
	} if (inputedDonor == "other"){
		createTextbox.innerHTML = createTextbox.innerHTML + "<p>Email our executives to become a trusted donor! <a href='mailto:leftoversubco@gmail.com?Subject=New%20Food%20Provider'><img src='images/email_16.png'></a></p><p><label>What is the name of your business? </label><input type='text' name='eventName'></p><p><label>Where can we pick up the leftovers? </label><input type='text' name='eventLocation'></p>"
	}
}

function checkBlank(input){ //checks to ensure all required fields are not blank
	if (input == "") {
		return true;
	} return false;
}

window.onload = function(){
  var mainForm = document.getElementById("foodDonation");

	var select = document.getElementById("donorSection"); //needed in order to dynamically display information for certain option


	select.onchange = function(){ //occurs whenever a new select option is clicked
		document.getElementById("createTextbox").innerHTML="";
		checkDonor(); //goes to checkDonor function
	}

}