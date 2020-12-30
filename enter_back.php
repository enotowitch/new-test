<?
session_start();

require_once 'DB.php';


$user_email = $_POST['user_email'];
$user_pass = $_POST['user_pass'];

// ERROR FIELS
$error_fiels = [];

if(trim(filter_var($user_email, FILTER_VALIDATE_EMAIL)) === ''){
	$error_fiels[] = 'user_email';
	$error_msg = 'Please enter email!';

	$answer = [
		'type' => 'error_fiels',
		'msg' => $error_msg,
		'fields' => $error_fiels
		];
		
		echo json_encode($answer);
		
			die();
}
if(trim($user_pass) === ''){
	$error_fiels[] = 'user_pass';
	$error_msg = 'Please enter pass!';
}
// ! OLD ERROR FOR ALL FIELDS
if(!empty($error_fiels)){

$answer = [
'type' => 'error_fiels',
'msg' => $error_msg,
'fields' => $error_fiels
];

echo json_encode($answer);

	die();
}




$user_pass = md5($_POST['user_pass']);

// ! CHECK USER
$check_user = mysqli_query($connect, 
"SELECT * FROM `users` WHERE `user_email` = '$user_email' AND `user_pass` = '$user_pass'");

if(mysqli_num_rows($check_user) > 0){

	$user = mysqli_fetch_assoc($check_user);

	// print_r($user);

	$_SESSION['user'] = [
		"user_id" => $user['user_id'],
		"user_email" => $user['user_email']
	];
// ! ARRAY for ajax JSON
	$answer = [
		"status" => true,
		"msg" => "WELCOME!",
	];

	echo json_encode($answer);
	

} else {
// ! ARRAY for ajax JSON
	$answer = [
		"status" => false,
		"type" => 'no user',
		"msg" => "No user with this data!",
	];

	// $_SESSION['validation_msg'] = 'No user with this data';

	echo json_encode($answer);
}

?>

