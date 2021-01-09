<?

require 'DB.php';

$id = $_REQUEST['hidden_id'];
$jobs = R::findOne( 'jobs', 'id = ?', [$id] );


// ! VALIDATION 

$error_fields = [];
// ! job_title
if(!$_POST["job_title"]){
	$error_fields[] = 'update_job_title';
}
// ! job_company_name
if(!$_POST["job_company_name"]){
	$error_fields[] = 'update_job_company_name';
}
// ! CHECK if tags = 3
if(!($_POST['tag_name_3'])){
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

// ! DO NOTHING if OLD pics REMAIN or if NEW pics posted => DELETE from UPLOADS and in DB => write 'uploads/' = NO PIC
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
	

				
	// ! if 1 NEW example exists => update all examples, then all EMPTY will have 'uploads/' and will not be shown
				if($_FILES['path_example_1']['name']){

					$jobs->path_example_1 = $path_example_1;
					$jobs->path_example_2 = $path_example_2;
					$jobs->path_example_3 = $path_example_3;

							}
				



	// ! job_title
	if(isset($_POST["job_title"])){
		$jobs->title = $_POST["job_title"];
	}
	// ! job_company_name
	if(isset($_POST["job_company_name"])){
		$jobs->company_name = $_POST["job_company_name"];
	}
	// ! job_salary
	if(isset($_POST["job_salary"])){
		$jobs->salary = $_POST["job_salary"];
	}
	// ! job_exp
	if(isset($_POST["job_exp"])){
		$jobs->exp = $_POST["job_exp"];
	}
	// ! job_location
	if(isset($_POST["job_location"])){
		$jobs->location = $_POST["job_location"];
	}
	// ! job_duration
	if(isset($_POST["job_duration"])){
		$jobs->duration = $_POST["job_duration"];
	}
	// ! job_workload
	if(isset($_POST["job_workload"])){
		$jobs->workload = $_POST["job_workload"];
	}
	// ! TAG 1
	if(isset($_POST['tag_name_1'])){
		$jobs->tag_name_1 = $_POST['tag_name_1'];
	}
	// ! TAG 2
	if(isset($_POST['tag_name_2'])){
		$jobs->tag_name_2 = $_POST['tag_name_2'];
	}
	// ! TAG 3
	if(isset($_POST['tag_name_3'])){
		$jobs->tag_name_3 = $_POST['tag_name_3'];
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




