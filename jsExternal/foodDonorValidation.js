
function checkDonor(){
	var inputedDonor = document.forms["donorSubmission"]["donor"].value; //value for whichever select option the user chose
  var createTextbox = document.getElementById("createTextbox"); //the div in foodDonorForm.html
	if (inputedDonor == "onCampusEvent"){ //if the user chose "On-campus Event"
		// In class we used document.write(), but that was creating an entirely new page outside of the form (?). The innerHTML method inserts it into the div instead
		createTextbox.innerHTML = createTextbox.innerHTML + "<label> Tell us the name of the event </label><br><input type='text' name='eventName' size=50><br><label>Where the food can be picked up from?</label><br><input type='text' name='eventLocation' size=50>"
		//inputedDonor.innerHTML = "<label> Tell us the name of the event as well as where the food can be picked up from</label><br><input type='text' name='nameEvent'>";
	} if (inputedDonor == "other"){
		createTextbox.innerHTML = createTextbox.innerHTML + "<p> Email our executives to become a trusted donor! <a href='mailto:leftoversubco@gmail.com?Subject=Food%20Provider'><img src='images/email_16.png'></a> "
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
		checkDonor(); //goes to checkDonor function
	}

  mainForm.onsubmit = function(e){ //for when the form is submitted

	var inputedItems = document.forms["donorSubmission"]["foodDescription"].value;
	var inputedPicture = document.forms["donorSubmission"]["picture"].value;
	var inputedKiloGrams = document.forms["donorSubmission"]["kg"].value;
	var inputedDate = document.forms["donorSubmission"]["pickUpDate"].value;

	 if (checkBlank(inputedItems) || checkBlank(inputedPicture) || checkBlank(inputedKiloGrams) || checkBlank(inputedDate)){
		alert("Please fill out all of the required fields");
		e.preventDefault();
	}
	else {
		alert("Thank you for helping us reduce food waste on campus!");
		window.location.href = "index.html";
		return true;
	}
}
}
