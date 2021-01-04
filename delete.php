<?
	require_once 'DB.php';
	
	$delete_id = $_POST['delete_id'];
	$user_id_index = $_POST['user_id_index'];

	// actually it's HIDING POST 

	// ! todo later JOIN RECORDS

	$hide_post = mysqli_query($connect, "UPDATE `users` SET `user_hidden_posts` = '$delete_id' 
	WHERE `users`.`user_id` = '$user_id_index'");
?>
