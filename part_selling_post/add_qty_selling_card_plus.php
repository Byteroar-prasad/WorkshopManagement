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

			$checkQtyForRun = $conn->query("SELECT quantity FROM tbl_item WHERE item_id = '$itemId'");
		    if($qrRS = $checkQtyForRun->fetch_array()){

		        $cRqty = (double)$qrRS[0];


		        if($cRqty> 0){

					///////////////////////////////////
					if($conn->query("UPDATE tbl_part_selling_list SET qty = '$newQty' WHERE part_selling_list_id='$rowIndex'")){

						$conn->query("UPDATE tbl_item SET quantity = quantity-1 WHERE item_id='$itemId'");	

						$output['result'] = true;
						$output['msg'] = 'Successfully Updated.';

					
					}else{
						$output['result'] = false;
						$output['msg'] = 'Updating failed, Please try again.';
					}
					///////////////////////////////////

				}else{
					$output['result'] = false;
					$output['msg'] = 'Please add stock first, Please try again.';
				}
			}



		//With Price Batch
		}else{

			$checkQtyForRun = $conn->query("SELECT qty FROM tbl_item_price_batch WHERE item_id = '$itemId' AND price_batch_id='$price_batch'");
		    if($qrRS = $checkQtyForRun->fetch_array()){

		        $cRqty = (double)$qrRS[0];


		        if($cRqty> 0){

					///////////////////////////////////
					if($conn->query("UPDATE tbl_part_selling_list SET qty = '$newQty' WHERE part_selling_list_id='$rowIndex'")){

						$conn->query("UPDATE tbl_item_price_batch SET qty = qty-1 WHERE item_id='$itemId' AND price_batch_id='$price_batch' ");	

						$output['result'] = true;
						$output['msg'] = 'Successfully Updated.';

					}else{
						$output['result'] = false;
						$output['msg'] = 'Updating failed, Please try again.';
					}
					///////////////////////////////////

				}else{
					$output['result'] = false;
					$output['msg'] = 'Please add stock first, Please try again.';
				}

			}


		}



	}else{
		$output['result'] = false;
		$output['msg'] = 'Invalid request, Please try again.';
	}

		





	


	echo json_encode($output);


