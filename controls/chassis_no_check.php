<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();	

if(isset($_POST['chassis_no']))
{
	$chassis_no = 'chassis_no';
	$chassis_no = $_POST['chassis_no'];

	if ($chassis_no) {
    	
    	//echo("$email is a valid email address");


    	$sql = "SELECT `chassis_no` FROM `tbl_vehicle` WHERE `chassis_no` = ?";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt,"s", $chassis_no);

		$result = mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $chassis_no1);
		mysqli_stmt_fetch($stmt);

		if(mysqli_stmt_num_rows($stmt) <1)
		{
			echo '<span style="color:green;text-align:center;">Chassis No is valid</span>';
			?>


				<script>

					document.getElementById("license_no").disabled = false;
					document.getElementById("register").disabled = false;

    			</script>




			<?php

		}

		else
		{
			echo '<span style="color:red;text-align:center;">Chassis No already taken</span>';
			?>
				<script>
					// document.getElementById("password").disabled = true;
					document.getElementById("license_no").disabled = true;
					document.getElementById('register').disabled = true;
				</script>
			<?php
		}
	}

	else 
	{
    	echo("Not a valid Chassis No");

    	
		?>
			<script>
				// document.getElementById("password").disabled = true;
				document.getElementById("license_no").disabled = true;
				document.getElementById('register').disabled = true;
			</script>
		<?php

	}
}

?>