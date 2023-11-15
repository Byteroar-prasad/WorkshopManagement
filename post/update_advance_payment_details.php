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
        $advance_id = htmlspecialchars($_POST['advance_id']);
        $license_no = htmlspecialchars($_POST['license_no']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE tbl_advance SET `license_number`='$license_no' WHERE advance_id= '$advance_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>