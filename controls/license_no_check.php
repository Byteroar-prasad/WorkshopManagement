<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();	

if(isset($_POST['license_no']))
{
	$license_no = 'license_no';
	$license_no = $_POST['license_no'];

	if ($license_no) {
    	
    	//echo("$email is a valid email address");


    	$sql = "SELECT `license_no` FROM `tbl_vehicle` WHERE `license_no` = ?";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt,"s", $license_no);

		$result = mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $license_no1);
		mysqli_stmt_fetch($stmt);

		if(mysqli_stmt_num_rows($stmt) <1)
		{
			echo '<span style="color:green;text-align:center;">License No is valid</span>';
			?>


				<script>
					document.getElementById("chassis_no").disabled = false;
					document.getElementById("register").disabled = false;
    			</script>




			<?php

		}

		else
		{
			echo '<span style="color:red;text-align:center;">License No already taken</span>';
			?>
				<script>
					// document.getElementById("password").disabled = true;
					document.getElementById("chassis_no").disabled = true;
					document.getElementById('register').disabled = true;
				</script>
			<?php
		}
	}

	else 
	{
    	echo("Not a valid License No");

    	
		?>
			<script>
				// document.getElementById("password").disabled = true;
				document.getElementById("chassis_no").disabled = true;
				document.getElementById('register').disabled = true;
			</script>
		<?php

	}
}

?>