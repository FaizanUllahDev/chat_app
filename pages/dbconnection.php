<?php

$servername = 'localhost';
$username = "root";
$password = "";
$db = "chat_app";

// Create connection
$conn =  mysqli_connect($servername, $username, $password , $db);

if (mysqli_connect_errno()) {
   // echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
  }
//echo "Connected successfully";

?>