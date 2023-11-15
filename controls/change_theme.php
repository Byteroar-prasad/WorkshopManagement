<?php
session_start();
$output = [];

if(isset($_POST['change']) && $_POST['change'] == 'ok'){

	
		if(isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] == 'yes_'){
			$_SESSION['dark_mode'] = 'no_';
		}else{
			$_SESSION['dark_mode'] = 'yes_';
		}

	

	

	$output['result'] = true;
	

}else{
	$output['result'] = false;
	$output['msg'] = "Failed changing the theme";
}

echo json_encode($output);


