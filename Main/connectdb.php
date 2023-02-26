<?php
$servername = "phpmyadmin.ecs.westminster.ac.uk";
$username = "w1866983";
$password = "tx6idsYXsJ4p";
$db = "w1866983_0"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $db);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>
