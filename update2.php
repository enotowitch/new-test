<?

require 'DB.php';

$id = $_REQUEST['hidden_id'];

$job_title = $_POST["job_title"];
$job_company_name = $_POST["job_company_name"];
$job_salary = $_POST["job_salary"];
$job_exp = $_POST["job_exp"];
$job_location = $_POST["job_location"];
$job_duration = $_POST["job_duration"];
$job_workload = $_POST["job_workload"];



// ! AJAX TAGS
$tag_name_1 = $_POST['tag_name_1'];
$tag_name_2 = $_POST['tag_name_2'];
$tag_name_3 = $_POST['tag_name_3'];








// ! VALIDATION 

$error_fields = [];
// ! job_title
if(!$job_title){
	$error_fields[] = 'update_job_title';
}
// ! job_company_name
if(!$job_company_name){
	$error_fields[] = 'update_job_company_name';
}
// ! CHECK if tags = 3
if(!($tag_name_3)){
	$error_fields[] = 'tags_not_3';
}
// 
// 
// 
// ! if errors
if(!empty($error_fields)){
	$response = [
		'type' => false,
		'fields' => $error_fields
	];

	echo json_encode($response);

	return;
} 
// ? if NO errors
if(empty($error_fields)){

// ! AJAX FILE

// ! before loading NEW need to delete OLD
// select which file(s) to delete from UPLOADS
$delete_files_up = mysqli_query($connect, "SELECT * FROM `tbl_card` WHERE `tbl_card`.`job_post_id` = '$id'");

$delete_files_up = mysqli_fetch_all($delete_files_up, MYSQLI_ASSOC);


foreach($delete_files_up as $file){
	$logo = $file["logo_path"];
	$ex_1 = $file["path_example_1"];
	$ex_2 = $file["path_example_2"];
	$ex_3 = $file["path_example_3"];
}

// DO NOTHING if OLD pics REMAIN or if NEW pics posted => DELETE from UPLOADS and in DB => write 'uploads/' = NO PIC
if($_FILES['path_example_1']['name']){
	
	if($ex_1 != 'uploads/'){
		unlink(strval ($ex_1));
		mysqli_query($connect, "UPDATE `tbl_card` SET `path_example_1` = 'uploads/' WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	if($ex_2 != 'uploads/'){
		unlink(strval ($ex_2));
		mysqli_query($connect, "UPDATE `tbl_card` SET `path_example_2` = 'uploads/' WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	if($ex_3 != 'uploads/'){
		unlink(strval ($ex_3));
		mysqli_query($connect, "UPDATE `tbl_card` SET `path_example_3` = 'uploads/' WHERE `tbl_card`.`job_post_id` = '$id'");
	}

}


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



	// ! job_title
	if(isset($job_title)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_title` = '$job_title'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! job_company_name
	if(isset($job_company_name)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_company_name` = '$job_company_name'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! job_salary
	if(isset($job_salary)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_salary` = '$job_salary'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! job_exp
	if(isset($job_exp)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_exp` = '$job_exp'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! job_location
	if(isset($job_location)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_location` = '$job_location'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! job_duration
	if(isset($job_duration)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_duration` = '$job_duration'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! job_workload
	if(isset($job_workload)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `job_workload` = '$job_workload'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! TAG 1
	if(isset($tag_name_1)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `tag_name_1` = '$tag_name_1'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! TAG 2
	if(isset($tag_name_2)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `tag_name_2` = '$tag_name_2'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! TAG 3
	if(isset($tag_name_3)){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `tag_name_3` = '$tag_name_3'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}
	// ! LOGO
	if($_FILES['file']['name']){
		mysqli_query($connect, "UPDATE `tbl_card` 
		SET `logo_path` = '$logo_path'
		WHERE `tbl_card`.`job_post_id` = '$id'");
	}


	// ! if 1 NEW example exists => update all examples, then all EMPTY will have 'uploads/' and will not be shown
	if($_FILES['path_example_1']['name']){
mysqli_query($connect, "UPDATE `tbl_card` 
		SET 
		`path_example_1` = '$path_example_1',
		`path_example_2` = '$path_example_2',
		`path_example_3` = '$path_example_3'
		WHERE `tbl_card`.`job_post_id` = '$id'");
		}


// ! RESPONSE

	$response = [
	'type' => true,
	'msg' => 'UPDATED!'
];

echo json_encode($response);

}




?>




