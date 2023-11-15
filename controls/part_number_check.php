<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();	

if(isset($_POST['part_number']))
{
	$part_number = 'part_number';
	$part_number = $_POST['part_number'];

	if ($part_number) {
    	
    	//echo("$email is a valid email address");


    	$sql = "SELECT `part_number` FROM `tbl_item` WHERE `part_number` = ?";

		$stmt = mysqli_prepare($conn, $sql);
		mysqli_stmt_bind_param($stmt,"s", $part_number);

		$result = mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);
		mysqli_stmt_bind_result($stmt, $part_number1);
		mysqli_stmt_fetch($stmt);

		if(mysqli_stmt_num_rows($stmt) <1)
		{
			echo '<span style="color:green;text-align:center;">Part Number is valid</span>';
			?>


				<script>
					document.getElementById("register").disabled = false;
    			</script>




			<?php

		}

		else
		{
			echo '<span style="color:red;text-align:center;">Part Number already taken</span>';
			?>
				<script>
					// document.getElementById("password").disabled = true;
					document.getElementById('register').disabled = true;
				</script>
			<?php
		}
	}

	else 
	{
    	echo("Not a valid Part Number");

    	
		?>
			<script>
				// document.getElementById("password").disabled = true;
				document.getElementById('register').disabled = true;
			</script>
		<?php

	}
}

?>