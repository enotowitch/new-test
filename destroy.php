<?
// header("location: index.php");

require 'DB.php';

$post_id = $_REQUEST['hidden_id_delete'];
$user_id = $_POST['user_id'];

// ! first delete files form UPLOADS, then destroy DB record
$delete_files = mysqli_query($connect, "SELECT * FROM `tbl_card` WHERE `tbl_card`.`job_post_id` = '$post_id' AND `user_id` = '$user_id'");

$delete_files = mysqli_fetch_all($delete_files, MYSQLI_ASSOC);


foreach($delete_files as $file){
	$logo = $file["logo_path"];
	$ex_1 = $file["path_example_1"];
	$ex_2 = $file["path_example_2"];
	$ex_3 = $file["path_example_3"];
}

unlink(strval ($logo));
unlink(strval ($ex_1));
unlink(strval ($ex_2));
unlink(strval ($ex_3));


$delete = mysqli_query($connect, "DELETE FROM `tbl_card` WHERE `tbl_card`.`job_post_id` = '$post_id' AND `user_id` = '$user_id'");



?>

