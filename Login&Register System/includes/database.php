<?php
//Params to connect to database
$dbHost = "localhost";
$dbUser = "root";
$dbPass = "";
$dbName= "reglog_db";

//Connection to database
$conn = mysqli_connect($dbHost, $dbUser, $dbPass, $dbName);


if(!$conn) {
	die("Database connection failed!");
}
?>