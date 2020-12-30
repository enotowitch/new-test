<?php
// DB.php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smth";

$connect = new mysqli($servername, $username, $password, $dbname);

if($connect->connect_error){
die("Connection failed");
}
// echo "conn success";
// header("location: index.php");
?>