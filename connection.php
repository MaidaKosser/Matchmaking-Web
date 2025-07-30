<?php 

$hostname ="localhost:3306";
$username = "root";
$password ="";
$database= "matchmaking";

$connection =mysqli_connect($hostname, $username, $password, $database) or die("Cannot connect to database successfully".mysqli_connect_error());

?>