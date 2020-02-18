function checkBlank(input){
  if (input == '') {
    return true;
  } else{
    return false;
}
}

window.onload = function(){
  var mainForm = document.getElementById("leftoversForm");


  mainForm.onsubmit = function(e){
  var inputtedImage = document.forms["makePost"]["foodImage"].value;
  var inputtedTime = document.forms["makePost"]["safeUntil"].value;
  var inputtedFood = document.forms["makePost"]["typeOfFood"].value;
  var inputtedLocation = document.forms["makePost"]["foodLocation"].value;
  var inputtedSource = document.forms["makePost"]["source"].value;


  if (checkBlank(inputtedImage)){
    alert("Please provide an image of the leftovers.");
    e.preventDefault();
  }else if (checkBlank(inputtedTime)) {
    alert("Please select how much longer the leftovers will be fresh. This is the length of time until it can no longer be consumed safely (unless otherwise indicated by the food donor.");
    e.preventDefault();
  } else if (checkBlank(inputtedFood)){
    alert("Please list the food items you picked up.");
    e.preventDefault();
  }else if (checkBlank(inputtedLocation)){
    alert("Please indicate where you are taking the leftovers.");
    e.preventDefault();
  }else if(checkBlank(inputtedSource)){
    alert("Please provide the source of the leftovers.");
    e.preventDefault();
  }else {
    return true;
  }
}
}
