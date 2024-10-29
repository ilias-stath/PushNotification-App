<?php

define('DB_HOST','localhost');
define('DB_USER','myuni');
define('DB_PASS','6kItuYOrLKy8l2A');
define('DB_NAME','myuni');


$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
$conn->set_charset("utf8");
$connection = false;

if($conn->connect_error){
	die('Connection Failed' . $con->connect_error); //Cuts everything off
	echo "Error, cannot connect to db";
}else{
	$connection = true;
}


?>