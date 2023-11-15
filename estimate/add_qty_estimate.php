<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

	$output = [];

	if(isset($_POST['row_index']) && isset($_POST['item_id']) && isset($_POST['labour_id']) && isset($_POST['new_qty']) && isset($_POST['operator'])){

		$rowIndex = htmlspecialchars($_POST['row_index']);
		$itemId = htmlspecialchars($_POST['item_id']);
		$labourId = htmlspecialchars($_POST['labour_id']);
		$newQty = htmlspecialchars($_POST['new_qty']);
		$operator = htmlspecialchars($_POST['operator']);


		if($conn->query("UPDATE tbl_estimate_item SET qty = '$newQty' WHERE estimate_item_id='$rowIndex'")){





				$checkQty = $conn->query("SELECT qty FROM tbl_estimate_item WHERE estimate_item_id='$rowIndex'");
					if($qRS = $checkQty->fetch_array()){

						$cqty = (int)$qRS[0];
						if($cqty >= 0){

							if($cqty == 0){
								$conn->query("DELETE FROM tbl_estimate_item WHERE estimate_item_id = '$rowIndex'");
								
								$output['result'] = true;
								$output['restart_flag'] = 'ON';
							}


						}else{
							$output['result'] = false;
							$output['msg'] = 'Invalid operation.(1458)';
						}


					}else{
						$output['result'] = false;
						$output['msg'] = 'Invalid operation.(7483)';
					}







			$output['result'] = True;
			$output['msg'] = 'Updating Done';

		}else{
			$output['result'] = false;
			$output['msg'] = 'Updating failed, Please try again.';
		}




	}else{
		$output['result'] = false;
		$output['msg'] = 'Invalid request, Please try again.';
	}


	echo json_encode($output);


