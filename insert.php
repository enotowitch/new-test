<?php
// header("location: index.php");

require_once 'DB.php';

$job_title = $_POST["job_title"];
$job_company_name = $_POST["job_company_name"];
$job_salary = $_POST["job_salary"];
$job_exp = $_POST["job_exp"];
$job_location = $_POST["job_location"];
$job_duration = $_POST["job_duration"];
$job_workload = $_POST["job_workload"];

// AJAX TAGS
$tag_name_1 = $_POST['tag_name_1'];
$tag_name_2 = $_POST['tag_name_2'];
$tag_name_3 = $_POST['tag_name_3'];

$user_id = $_POST['user_id'];




// AJAX FILE

// ! Path for uploading logo - IN POST JOB
$logo_path = 'uploads/' . $_FILES['file']['name'];
move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $_FILES['file']['name']);

// ! 1
$path_example_1 = 'uploads/' . $_FILES['path_example_1']['name'];
move_uploaded_file($_FILES['path_example_1']['tmp_name'], 'uploads/' . $_FILES['path_example_1']['name']);
// ! 2
$path_example_2 = 'uploads/' . $_FILES['path_example_2']['name'];
move_uploaded_file($_FILES['path_example_2']['tmp_name'], 'uploads/' . $_FILES['path_example_2']['name']);
// ! 3
$path_example_3 = 'uploads/' . $_FILES['path_example_3']['name'];
move_uploaded_file($_FILES['path_example_3']['tmp_name'], 'uploads/' . $_FILES['path_example_3']['name']);



// ! VALIDATION 

$error_fields = [];
// ! job_title
if(!$job_title){
	$error_fields[] = 'job_title';
}
// ! job_company_name
if(!$job_company_name){
	$error_fields[] = 'job_company_name';
}
// ! job_salary FOR CHOSEN PLUGIN title="Salary"
if(!$job_salary){
	$error_fields[] = 'Salary';
}
// ! job_exp FOR CHOSEN PLUGIN title="Experience"
if(!$job_exp){
	$error_fields[] = 'Experience';
}
// ! job_location FOR CHOSEN PLUGIN title="Country"
if(!$job_location){
	$error_fields[] = 'Country';
}
// ! job_duration FOR CHOSEN PLUGIN title="Duration"
if(!$job_duration){
	$error_fields[] = 'Duration';
}
// ! job_workload FOR CHOSEN PLUGIN title="Workload"
if(!$job_workload){
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
// ! IF ERRORS
if(!empty($error_fields)){
	$response = [
		'type' => false,
		'fields' => $error_fields
	];
} else{

	$response = [
		'type' => true,
		'msg' => 'POSTED!'
	];


	$insert = mysqli_query($connect, "INSERT INTO `tbl_card` 
(`job_post_id`, `job_title`, `job_company_name`, `job_status`, `job_salary`, `job_exp`, `job_location`, `job_duration`, `job_workload`, `tag_name_1`, `tag_name_2`, `tag_name_3`, `logo_path`, `path_example_1`, `path_example_2`, `path_example_3`, `user_id`) VALUES 
         (NULL, '$job_title', '$job_company_name', 'POSTED', '$job_salary', '$job_exp', '$job_location', '$job_duration', '$job_workload' ,'$tag_name_1' ,'$tag_name_2' ,'$tag_name_3','$logo_path','$path_example_1','$path_example_2','$path_example_3','$user_id')");
}

echo json_encode($response);


// 



?>




