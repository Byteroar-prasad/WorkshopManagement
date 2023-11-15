<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

	$output = [];

	if(isset($_POST['row_index']) && isset($_POST['item_id']) && isset($_POST['new_qty']) && isset($_POST['operator']) && isset($_POST['price_batch'])){

		$rowIndex = htmlspecialchars($_POST['row_index']);
		$itemId = htmlspecialchars($_POST['item_id']);
		// $labourId = htmlspecialchars($_POST['labour_id']);
		$newQty = htmlspecialchars($_POST['new_qty']);
		$operator = htmlspecialchars($_POST['operator']);
		$price_batch = htmlspecialchars($_POST['price_batch']);


		//Price Batch Normal
		if($price_batch == 0){

				if($conn->query("UPDATE tbl_part_selling_list SET qty = '$newQty' WHERE part_selling_list_id='$rowIndex'")){

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


					$output['result'] = true;
					$output['msg'] = 'Successfully Updated.';

				}else{
					$output['result'] = false;
					$output['msg'] = 'Updating failed, Please try again Normal.';
				}


			///////////////////////////////////////////////////////


		//With Price Batch
		}else{

				///////////////////////////////////////////////////////
				if($conn->query("UPDATE tbl_part_selling_list SET qty = '$newQty' WHERE part_selling_list_id='$rowIndex'")){

					$checkQty = $conn->query("SELECT qty FROM tbl_part_selling_list WHERE part_selling_list_id='$rowIndex'");
						if($qRS = $checkQty->fetch_array()){

							$cqty = (int)$qRS[0];
							if($cqty >= 0){

								$conn->query("UPDATE tbl_item_price_batch SET qty = qty+1 WHERE item_id='$itemId' AND price_batch_id='$price_batch' ");

								
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


					$output['result'] = true;
					$output['msg'] = 'Successfully Updated.';

				}else{
					$output['result'] = false;
					$output['msg'] = 'Updating failed, Please try again Price Batch.';
				}

				///////////////////////////////////////////////////////

		}

		





	}else{
		$output['result'] = false;
		$output['msg'] = 'Invalid request, Please try again.';
	}


	echo json_encode($output);


