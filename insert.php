<?php
session_start();
require 'DB.php';

$title = htmlentities($_POST["job_title"]);
$company_name = htmlentities($_POST["job_company_name"]);
$salary = htmlentities($_POST["job_salary"]);
$exp = htmlentities($_POST["job_exp"]);
$location = htmlentities($_POST["job_location"]);
$duration = htmlentities($_POST["job_duration"]);
$workload = htmlentities($_POST["job_workload"]);

// TAGS
$tag_name_1 = htmlentities($_POST['tag_name_1']);
$tag_name_2 = htmlentities($_POST['tag_name_2']);
$tag_name_3 = htmlentities($_POST['tag_name_3']);

$user_id = $_SESSION['user']['user_id'];

// ! VALIDATION 

$error_fields = [];
// ! job_title
if(!$title){
	$error_fields[] = 'job_title';
}
// ! job_company_name
if(!$company_name){
	$error_fields[] = 'job_company_name';
}
// ! job_salary FOR CHOSEN PLUGIN title="Salary"
if(!$salary){
	$error_fields[] = 'Salary';
}
// ! job_exp FOR CHOSEN PLUGIN title="Experience"
if(!$exp){
	$error_fields[] = 'Experience';
}
// ! job_location FOR CHOSEN PLUGIN title="Country"
if(!$location){
	$error_fields[] = 'Country';
}
// ! job_duration FOR CHOSEN PLUGIN title="Duration"
if(!$duration){
	$error_fields[] = 'Duration';
}
// ! job_workload FOR CHOSEN PLUGIN title="Workload"
if(!$workload){
	$error_fields[] = 'Workload';
}
// ! CHECK if tags = 3
if(!($tag_name_3)){
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
	$maxsize = 2097152;
	$accept = array(
		'image/jpeg',
		'image/jpg',
		'image/gif',
		'image/png'
  );

if(($_FILES['file']['size'] >= $maxsize) && $_FILES['file']['size'] != NULL){
	$error_fields[] = 'big file logo';
}

if(!in_array($_FILES['file']['type'], $accept) && (!empty($_FILES['file']['type']))) {
	$error_fields[] = 'bad file logo';
}
// 

if(($_FILES['path_example_1']['size'] >= $maxsize) && $_FILES['path_example_1']['size'] != NULL){
	$error_fields[] = 'big file ex_1';
}
if(($_FILES['path_example_2']['size'] >= $maxsize) && $_FILES['path_example_2']['size'] != NULL){
	$error_fields[] = 'big file ex_2';
}
if(($_FILES['path_example_3']['size'] >= $maxsize) && $_FILES['path_example_3']['size'] != NULL){
	$error_fields[] = 'big file ex_3';
}
// 
// todo
if(!in_array($_FILES['path_example_1']['type'], $accept) && (!empty($_FILES['path_example_1']['type']))) {
	$error_fields[] = 'bad file ex_1';
}
if(!in_array($_FILES['path_example_2']['type'], $accept) && (!empty($_FILES['path_example_2']['type']))) {
	$error_fields[] = 'bad file ex_2';
}
if(!in_array($_FILES['path_example_3']['type'], $accept) && (!empty($_FILES['path_example_3']['type']))) {
	$error_fields[] = 'bad file ex_3';
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



$jobs = R::dispense( 'jobs' );

$jobs->user_id = $user_id;


$jobs->title = $title;
$jobs->company_name = $company_name;

$jobs->salary = $salary;
$jobs->exp = $exp;
$jobs->location = $location;
$jobs->duration = $duration;
$jobs->workload = $workload;

$jobs->tag_name_1 = $tag_name_1;
$jobs->tag_name_2 = $tag_name_2;
$jobs->tag_name_3 = $tag_name_3;

$jobs->logo_path = $logo_path;
$jobs->path_example_1 = $path_example_1;
$jobs->path_example_2 = $path_example_2;
$jobs->path_example_3 = $path_example_3;

R::store($jobs);

}

echo json_encode($response);

// 



?>




