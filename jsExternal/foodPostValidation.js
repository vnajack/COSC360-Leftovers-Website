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
  var inputedImage = document.forms["makePost"]["foodImage"].value;
  var inputedTime = document.forms["makePost"]["safeUntil"].value;
  var inputedFood = document.forms["makePost"]["typeOfFood"].value;
  var inputedLocation = document.forms["makePost"]["foodLocation"].value;
  var inputedSource = document.forms["makePost"]["source"].value;


  if (checkBlank(inputedImage)){
    alert("Please provide an image of the leftovers.");
    e.preventDefault();
  }else if (checkBlank(inputedTime)) {
    alert("Please select how much longer the leftovers will be fresh. This is the length of time until it can no longer be consumed safely (unless otherwise indicated by the food donor.");
    e.preventDefault();
  } else if (checkBlank(inputedFood)){
    alert("Please list the food items you picked up.");
    e.preventDefault();
  }else if (checkBlank(inputedLocation)){
    alert("Please indicate where you are taking the leftovers.");
    e.preventDefault();
  }else if(checkBlank(inputedSource)){
    alert("Please provide the source of the leftovers.");
    e.preventDefault();
  }else {
    return true;
  }
}
}
