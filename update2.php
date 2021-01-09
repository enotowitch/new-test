<?

require 'DB.php';

$id = htmlentities($_POST['hidden_id']);

$jobs = R::findOne( 'jobs', 'id = ?', [$id] );

$job_title = htmlentities($_POST["job_title"]);
$job_company_name = htmlentities($_POST["job_company_name"]);
$job_salary = htmlentities($_POST["job_salary"]);
$job_exp = htmlentities($_POST["job_exp"]);
$job_location = htmlentities($_POST["job_location"]);
$job_duration = htmlentities($_POST["job_duration"]);
$job_workload = htmlentities($_POST["job_workload"]);



// ! AJAX TAGS
$tag_name_1 = htmlentities($_POST['tag_name_1']);
$tag_name_2 = htmlentities($_POST['tag_name_2']);
$tag_name_3 = htmlentities($_POST['tag_name_3']);



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

// ! before loading NEW need to delete OLD

$logo = R::getCell("select logo_path from jobs where id='$id'");


// ! DO NOTHING if OLD logo REMAINS => if NEW logo posted =>
// ? logo
if($_FILES['file']['name']){
	// delete from UPLOADS
	unlink(strval ($logo));
	//move to UPLOADS
		$logo_path = 'uploads/' . $_FILES['file']['name'];
		move_uploaded_file($_FILES['file']['tmp_name'], $logo_path);		
	// change rec
		$jobs->logo_path = $logo_path;
		
}

// DO NOTHING if OLD pics REMAIN or if NEW pics posted => DELETE from UPLOADS and in DB => write 'uploads/' = NO PIC
if($_FILES['path_example_1']['name']){
	

$ex_1 = R::getCell("select path_example_1 from jobs where id='$id'");
$ex_2 = R::getCell("select path_example_2 from jobs where id='$id'");
$ex_3 = R::getCell("select path_example_3 from jobs where id='$id'");

// ? example 1
if($ex_1 != 'uploads/'){
	//del
	unlink(strval ($ex_1));	
	// change rec
	$jobs->path_example_1 = 'uploads/';	
}
// ? example 2
if($ex_2 != 'uploads/'){
	//del
	unlink(strval ($ex_2));
	// change rec
	$jobs->path_example_2 = 'uploads/';
}
// ? example 3
if($ex_3 != 'uploads/'){
	//del
	unlink(strval ($ex_3));
	// change rec
	$jobs->path_example_3 = 'uploads/';	
}

	}


	// !THESE 'MOVES' MUST BE HERE TO WORK OK!	
		// move 1
		$path_example_1 = 'uploads/' . $_FILES['path_example_1']['name'];
		move_uploaded_file($_FILES['path_example_1']['tmp_name'], $path_example_1);
	
		// move 2
		$path_example_2 = 'uploads/' . $_FILES['path_example_2']['name'];
		move_uploaded_file($_FILES['path_example_2']['tmp_name'], $path_example_2);
	
		// move 3
		$path_example_3 = 'uploads/' . $_FILES['path_example_3']['name'];
		move_uploaded_file($_FILES['path_example_3']['tmp_name'], $path_example_3);
	

				
	
				if($_FILES['path_example_1']['name']){

					$jobs->path_example_1 = $path_example_1;
					$jobs->path_example_2 = $path_example_2;
					$jobs->path_example_3 = $path_example_3;

							}
				



	// ! job_title
	if(isset($job_title)){
		$jobs->title = $job_title;
	}
	// ! job_company_name
	if(isset($job_company_name)){
		$jobs->company_name = $job_company_name;
	}
	// ! job_salary
	if(isset($job_salary)){
		$jobs->salary = $job_salary;
	}
	// ! job_exp
	if(isset($job_exp)){
		$jobs->exp = $job_exp;
	}
	// ! job_location
	if(isset($job_location)){
		$jobs->location = $job_location;
	}
	// ! job_duration
	if(isset($job_duration)){
		$jobs->duration = $job_duration;
	}
	// ! job_workload
	if(isset($job_workload)){
		$jobs->workload = $job_workload;
	}
	// ! TAG 1
	if(isset($tag_name_1)){
		$jobs->tag_name_1 = $tag_name_1;
	}
	// ! TAG 2
	if(isset($tag_name_2)){
		$jobs->tag_name_2 = $tag_name_2;
	}
	// ! TAG 3
	if(isset($tag_name_3)){
		$jobs->tag_name_3 = $tag_name_3;
	}



// ! RESPONSE

	$response = [
	'type' => true,
	'msg' => 'UPDATED!'
];

echo json_encode($response);

}


R::store( $jobs );

?>




