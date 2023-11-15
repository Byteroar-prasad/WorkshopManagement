<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();

	$login_id = $_GET['login_id'];


	$sql = "DELETE FROM `users_login` WHERE `user_id` = '$login_id'";
	$result = mysqli_query($conn, $sql);


	if($result)
	{
		?>
			<script>
				window.location.href = "../index.php";
			</script>
		<?php
	}

?>