function checkBlank(input){
  if (input == '') {
    return true;
} else return false;
}

window.onload = function(){
  var mainForm = document.getElementById("postArea");


  mainForm.onsubmit = function(e){
  var inputedTime = document.forms["makePost"]["safeUntil"].value;
  var inputedFood = document.forms["makePost"]["typeOfFood"].value;
  var inputedLocation = document.forms["makePost"]["foodLocation"].value;


  if (checkBlank(inputedTime)) {
    alert("Please select how much longer the food will last until it can no longer be consumed.");
    e.preventDefault();
  } else if (checkBlank(inputedFood)){
    alert("Tell us what items you picked up.");
    e.preventDefault();
  }else if (checkBlank(inputedLocation)){
    alert("Please type the location of where you're leaving the food.");
    e.preventDefault();
  }
  else {
    return true;
  }
}
}
