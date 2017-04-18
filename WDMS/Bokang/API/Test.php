<?php
//Setup connection variables, such as database username
//and password
$hostname="localhost";
$username="root";
$password="";
$dbname="academycity";
 
//Connect to the database
$connection = mysqli_connect($hostname, $username, $password);
mysqli_select_db($dbname, $connection);

if($connection == true)
{
	echo "We are connected";
}

?>