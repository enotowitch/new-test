<?php
session_start();
require 'DB.php';

// ! VALIDATION 

$error_fields = [];
// ! job_title
if(!$_POST["job_title"]){
	$error_fields[] = 'job_title';
}
// ! job_company_name
if(!$_POST["job_company_name"]){
	$error_fields[] = 'job_company_name';
}
// ! job_salary FOR CHOSEN PLUGIN title="Salary"
if(!$_POST["job_salary"]){
	$error_fields[] = 'Salary';
}
// ! job_exp FOR CHOSEN PLUGIN title="Experience"
if(!$_POST["job_exp"]){
	$error_fields[] = 'Experience';
}
// ! job_location FOR CHOSEN PLUGIN title="Country"
if(!$_POST["job_location"]){
	$error_fields[] = 'Country';
}
// ! job_duration FOR CHOSEN PLUGIN title="Duration"
if(!$_POST["job_duration"]){
	$error_fields[] = 'Duration';
}
// ! job_workload FOR CHOSEN PLUGIN title="Workload"
if(!$_POST["job_workload"]){
	$error_fields[] = 'Workload';
}
// ! CHECK if tags = 3
if(!$_POST['tag_name_3']){
	$error_fields[] = 'tags_not_3';
}
// ! NO LOGO
if(!$_FILES['file']['name']){
	$error_fields[] = 'no logo';
}
// ! NO atleast 1 EXAMPLE
if(!$_FILES['path_example_1']['name']){
	$error_fields[] = 'examples_not_1';
}
//
//
// ? if errors
if(!empty($error_fields)){
	$response = [
		'type' => false,
		'fields' => $error_fields
	];
} 
// ? if NO errors
if(empty($error_fields)){

	$response = [
		'type' => true,
		'msg' => 'POSTED!'
	];

	// AJAX FILE

// ! Path for uploading logo - IN POST JOB
$logo_path = 'uploads/' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], $logo_path);

// ! 1
$path_example_1 = 'uploads/' . $_FILES['path_example_1']['name'];
move_uploaded_file($_FILES['path_example_1']['tmp_name'], $path_example_1);
// ! 2
$path_example_2 = 'uploads/' . $_FILES['path_example_2']['name'];
move_uploaded_file($_FILES['path_example_2']['tmp_name'], $path_example_2);
// ! 3
$path_example_3 = 'uploads/' . $_FILES['path_example_3']['name'];
move_uploaded_file($_FILES['path_example_3']['tmp_name'], $path_example_3);



// 	$insert = mysqli_query($connect, "INSERT INTO `tbl_card` 
// (`job_post_id`, `job_title`, `job_company_name`, `job_status`, `job_salary`, `job_exp`, `job_location`, `job_duration`, `job_workload`, `tag_name_1`, `tag_name_2`, `tag_name_3`, `logo_path`, `path_example_1`, `path_example_2`, `path_example_3`, `user_id`) VALUES 
//          (NULL, '$job_title', '$job_company_name', 'POSTED', '$job_salary', '$job_exp', '$job_location', '$job_duration', '$job_workload' ,'$tag_name_1' ,'$tag_name_2' ,'$tag_name_3','$logo_path','$path_example_1','$path_example_2','$path_example_3','$user_id')");


$jobs = R::dispense( 'jobs' );

$jobs->user_id = $_SESSION['user']['user_id'];
// $jobs->user_id = $_POST["user_id"];


$jobs->title = $_POST["job_title"];
$jobs->company_name = $_POST["job_company_name"];

$jobs->salary = $_POST["job_salary"];
$jobs->exp = $_POST["job_exp"];
$jobs->location = $_POST["job_location"];
$jobs->duration = $_POST["job_duration"];
$jobs->workload = $_POST["job_workload"];

$jobs->tag_name_1 = $_POST["tag_name_1"];
$jobs->tag_name_2 = $_POST["tag_name_2"];
$jobs->tag_name_3 = $_POST["tag_name_3"];

$jobs->logo_path = $logo_path;
$jobs->path_example_1 = $path_example_1;
$jobs->path_example_2 = $path_example_2;
$jobs->path_example_3 = $path_example_3;

R::store($jobs);

}

echo json_encode($response);

// 



?>




