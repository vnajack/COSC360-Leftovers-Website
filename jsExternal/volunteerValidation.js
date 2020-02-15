//I created functions to validate each to make things easier to read

function validName(input){ //a function to validate the name text field
  var nameReg = /[a-zA-Z- ]+/; //these are the allowable letters a user can enter. They can also have a "-" and a space in their name
  if (input == "" || !(input).match(nameReg)) { //if the input is left blank, or their input doesn't match the allowable values (i.e their name contains numbers) it'll return false
    return false;
  } else return true; //if they've entered a valid username, it moves on
}

function validUsername(input){ //same logic for the following functions
  var userNameReg = /[a-zA-Z0-9]+/;
  if (input == "" || !(input).match(userNameReg)){
    return false;
  } else return true;
}

function validEmail(input){
  var emailReg = /[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/;
  if (input == "" || !(input).match(emailReg)){
    return false;
  } else return true;
}

function validPassword(input){
    var passwordReg = /.{6,}/;
    if (input == "" || !(input).match(passwordReg)){
      return false;
    } else return true;

}

function checkBlank(input){ //I use this function to check the profile picture and security question. If we wanted to restrict the input more, we could.
  if (input == ""){
    return true; //if the input is blank, return true.
  } return false;
}



window.onload = function(){ //whenever we load the page, we want to check the inputs
  var mainForm = document.getElementById("volunteer"); //to obtain the form so we can use the onsubmit method. NOTE: this using the form's ID, not the form name

//mainForm is identified from the volunteer form, and we want the anonymous function to run whenever we click the "submit" button.
//The "onsubmit" method listens for whenever the submit button is clicked
  mainForm.onsubmit = function(e){
    var inputedName = document.forms["volunteerApplication"]["name"].value; //document.forms follows the following format [form name][input name]. Essentially obtains the values the user enters
    var inputedUsername = document.forms["volunteerApplication"]["username"].value;
    var inputedEmail = document.forms["volunteerApplication"]["email"].value;
    var inputedPassword = document.forms["volunteerApplication"]["password"].value;
    var inputedProfilePicture = document.forms["volunteerApplication"]["profilePicture"].value;
    var inputedSecurityResponse = document.forms["volunteerApplication"]["securityResponse"].value;



    if (validName(inputedName) == false) { //calling the various methods and verifying whether the user entered what is allowable or not
      alert("You must enter a valid name. A name can only contain letters, hyphens, and spaces.");
      e.preventDefault(); //the page will display the alert, but continue to "index.html" otherwise. This method pretty much blocks that from happening so the user continues to enter information until it's valid
    }
    else if (validUsername(inputedUsername) == false){
      alert("Please enter a username. It can only contain letters and numbers. No punctuation or special characters.");
      e.preventDefault();
    }else if (validEmail(inputedEmail) == false){
      alert("You must enter a valid email. A valid email contains characters before and after '@' and at least two characters after '.'");
      e.preventDefault();
    }else if (validPassword(inputedPassword) == false){
      alert("Your password must contain 6 or more characters");
      e.preventDefault();
    }else if (checkBlank(inputedProfilePicture)){
      alert("You must provide a profile picture");
      e.preventDefault();
    }else if (checkBlank(inputedSecurityResponse)){
      alert("Please provide an answer for the security question");
      e.preventDefault();
    }
    else {
      alert("Thank you for wanting to volunteer with us! An admin will approve your account later. Please do not fill out another form in the meantime.");
      window.location.href = "index.html";
      return true;
    }
  }
}
