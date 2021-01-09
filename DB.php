<?
require 'RB/rb.php';

R::setup( 'mysql:host=localhost;dbname=smth',
	 'root', '' );
	 
	 // ! OLD DB
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "smth";

$connect = new mysqli($servername, $username, $password, $dbname);

if($connect->connect_error){
die("Connection failed");
}


?>