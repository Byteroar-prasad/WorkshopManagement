<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    //$currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $vehicle_id = htmlspecialchars($_POST['vehicle_id']);
        $client_id = htmlspecialchars($_POST['client_id']);
        $license_no = htmlspecialchars($_POST['license_no']);
        $vehicle_modal = htmlspecialchars($_POST['vehicle_modal']);
        $chassis_no = htmlspecialchars($_POST['chassis_no']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE tbl_vehicle SET `client_id`='$client_id', `license_no`='$license_no', `vehicle_modal`='$vehicle_modal', `chassis_no`='$chassis_no'  WHERE vehicle_id= '$vehicle_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>