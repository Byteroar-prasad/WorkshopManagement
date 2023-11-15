<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $job_id = htmlspecialchars($_POST['job_id']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $vat = htmlspecialchars($_POST['vat']);
        $discount = htmlspecialchars($_POST['discount']);
        // $note = htmlspecialchars($_POST['note']);
        $additional_price = htmlspecialchars($_POST['additional_price']);


                $UpdateTaxsql = "UPDATE tbl_tax SET `user_id`= '$user_id', `vat`='$vat', `discount`='$discount', `additional_price`='$additional_price', `datetime`='$currentDate'  WHERE job_id= '$job_id' ";
                if ($conn->query($UpdateTaxsql) === TRUE) {
                  echo "Record updated successfully";
                  
                //   $sql = "UPDATE tbl_vehicle_details SET `stat`= '2' WHERE v_id= '$job_id' ";
                //     if ($conn->query($sql) === TRUE) {
                //       echo "Record updated successfully";
                //     } else {
                //       echo "Error updating record: " . $conn->error;
                //     }
                  
                  
                } else {
                  echo "Error updating record: " . $conn->error;
                }
                
                //Old
                // $UpdateTaxsql = "UPDATE tbl_tax SET `user_id`= '$user_id', `vat`='$vat', `discount`='$discount', `note`='$note', `additional_price`='$additional_price', `datetime`='$currentDate'  WHERE job_id= '$job_id' ";
                // if ($conn->query($UpdateTaxsql) === TRUE) {
                //   echo "Record updated successfully";
                  
                //   $sql = "UPDATE tbl_vehicle_details SET `stat`= '2' WHERE v_id= '$job_id' ";
                //     if ($conn->query($sql) === TRUE) {
                //       echo "Record updated successfully";
                //     } else {
                //       echo "Error updating record: " . $conn->error;
                //     }
                  
                  
                // } else {
                //   echo "Error updating record: " . $conn->error;
                // }


    }

    mysqli_close($conn);

?>