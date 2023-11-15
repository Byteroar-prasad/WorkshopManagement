<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();	

if(isset($_POST['email']))
{
	$email = 'email';
	$email = $_POST['email'];

	if (filter_var($email, FILTER_VALIDATE_EMAIL)) {


    	$sql = "SELECT `email` FROM `tbl_client` WHERE `email` = ?";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt,"s", $email);

		$result = mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $email1);
		mysqli_stmt_fetch($stmt);

		if(mysqli_stmt_num_rows($stmt) <1)
		{
			echo '<span style="color:green;text-align:right !important;">Email is valid</span>';
			?>


				<script>
					document.getElementById("register").disabled = false;
    			</script>




			<?php

		}

		else
		{
			echo '<span style="color:red;text-align:right !important;">Email already taken</span>';
			?>
				<script>
					document.getElementById('register').disabled = true;
				</script>
			<?php
		}
	}

	else 
	{
    	// echo("Not a valid email address");
    	echo '<span style="color:red;text-align:right !important;">Not a valid email address</span>';

    	
		?>
			<script>
				document.getElementById('register').disabled = true;
			</script>
		<?php

	}
}

?>