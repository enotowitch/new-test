<?
session_start();

require_once 'DB.php';

$user_email = $_POST['user_email'];
$user_pass = $_POST['user_pass'];
$user_pass_confirm = $_POST['user_pass_confirm'];

// ! validation

$error_fiels = [];

// ! user_email
if(trim(filter_var($user_email, FILTER_VALIDATE_EMAIL)) === ''){

	$error_fiels[] = 'user_email';
	$error_msg = 'Please enter email!';

	if(!empty($error_fiels)){

		$answer = [
		'status' => false,
		'type' => 'error_fiels',
		'msg' => $error_msg,
		'fields' => $error_fiels
		];
		
		echo json_encode($answer);
		
			die();
		}

// ! user_pass
} 
if(trim($user_pass) == ""){

	$error_fiels[] = 'user_pass';
	$error_msg = 'Please enter password!';

} 

// ! user_pass_confirm
if($user_pass != $user_pass_confirm){

	$error_fiels[] = 'user_pass_confirm';
	$error_msg = 'Pass do not match!';
	// $_SESSION['validation_msg'] = 'Passwords do not match!';
	// header("location: register_front.php");

} 

// ! ERROR FIELDS
if(!empty($error_fiels)){

	$answer = [
	'status' => false,
	'type' => 'error_fiels',
	'msg' => $error_msg,
	'fields' => $error_fiels
	];
	
	echo json_encode($answer);
	
		die();
	}

// ! OK
else {
// ! insert user to DB
	$user_pass = md5($user_pass);

	$insert_user = mysqli_query($connect, "INSERT INTO `users` 
	(`user_id`, `user_email`, `user_pass`) 
	VALUES 
	(NULL, '$user_email', '$user_pass')");

	// $_SESSION['validation_msg'] = 'Registered succesfully!';

	$answer = [
		'status' => true,
		'msg' => 'Registered succesfully!',
		];
		
		echo json_encode($answer);

}

// ! insert user to SESSION

$check_user = mysqli_query($connect, 
"SELECT * FROM `users` WHERE `user_email` = '$user_email' AND `user_pass` = '$user_pass'");

if(mysqli_num_rows($check_user) > 0){

	$user = mysqli_fetch_assoc($check_user);

	// print_r($user);

	$_SESSION['user'] = [
		"user_id" => $user['user_id'],
		"user_email" => $user['user_email']
	];

}

?>
