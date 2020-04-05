<?php
 function openConnection(){
    $connString = "mysql:host=localhost; dbname=leftovers_db"; //NOTE: I called my database in phpmyadmin "leftovers_db" if yours is different, change the dbname
    $user="root";
    $pass="";
    $pdo=new PDO($connString, $user, $pass);
    return $pdo;   //important to return the connection
}
function closeConnection($pdo){
    $pdo=null;
}
?>
