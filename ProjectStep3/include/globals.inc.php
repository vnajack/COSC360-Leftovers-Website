<?php
date_default_timezone_set('America/Vancouver');
if(!isset($_SESSION)){
  session_start();
  /* This function first checks to see if a session already exists by looking for the presence of a session ID.
    If it finds one, i.e. if the session is already started, it sets up the session variables
    If doesn't, it starts a new session by creating a new session ID.
  */
}

function isApproved(){
  return (isAdmin() || isVolunteer());
}

function isAdmin(){
  if(strcmp($_SESSION["type"], "Admin")==0){
    return TRUE;
  }else{
    return FALSE;
  }
}

function isVolunteer(){
  if(strcmp($_SESSION["type"], "Volunteer")==0){
    return TRUE;
  }else{
    return FALSE;
  }
}

function isLoggedIn(){
  if(empty($_SESSION["username"])){
    return FALSE;
  }else{
    return TRUE;
  }
}


?>
