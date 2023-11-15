<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

	$output = [];

	if(isset($_POST['row_index']) && isset($_POST['item_id']) && isset($_POST['new_qty']) && isset($_POST['operator'])){

		$rowIndex = htmlspecialchars($_POST['row_index']);
		$itemId = htmlspecialchars($_POST['item_id']);
		// $labourId = htmlspecialchars($_POST['labour_id']);
		$newQty = htmlspecialchars($_POST['new_qty']);
		$operator = htmlspecialchars($_POST['operator']);


		$checkQtyForRun = $conn->query("SELECT quantity FROM tbl_item WHERE item_id = '$itemId'");
	    if($qrRS = $checkQtyForRun->fetch_array()){

	        $cRqty = (double)$qrRS[0];


	        if($cRqty> 0){

	     

		////////////////////////////

		if($conn->query("UPDATE tbl_part_selling_list SET qty = '$newQty' WHERE part_selling_list_id='$rowIndex'")){


			if($operator === '+'){
				//minus 1 from items

				$conn->query("UPDATE tbl_item SET quantity = quantity-1 WHERE item_id='$itemId'");	


			}else{
				//add 1 to items

				$checkQty = $conn->query("SELECT qty FROM tbl_part_selling_list WHERE part_selling_list_id='$rowIndex'");
					if($qRS = $checkQty->fetch_array()){

						$cqty = (int)$qRS[0];
						if($cqty >= 0){

							$conn->query("UPDATE tbl_item SET quantity = quantity+1 WHERE item_id='$itemId'");

							if($cqty == 0){
								$conn->query("DELETE FROM tbl_part_selling_list WHERE part_selling_list_id = '$rowIndex'");
								
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


				

			}



			$output['result'] = true;
			$output['msg'] = 'Successfully Updated.';

			

		}else{
			$output['result'] = false;
			$output['msg'] = 'Updating failed, Please try again.';
		}

		///////////////////////////////////////////////////////





		}else{
	           	$output['result'] = false;
				$output['msg'] = 'Please add Quantity First';
	        }
	}




	    



	}else{
		$output['result'] = false;
		$output['msg'] = 'Invalid request, Please try again.';
	}


	echo json_encode($output);


