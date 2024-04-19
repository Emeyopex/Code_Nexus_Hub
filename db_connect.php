<?php

//session_start();
$host="localhost:3306";
$username="root";
$pass="";
$db="code_nexus_hub";
 
$conn=mysqli_connect($host,$username,$pass,$db);


if(!$conn){
	die("Database connection error");
}
echo "Connected successfully !!!";


?>