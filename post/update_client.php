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
        $client_id = htmlspecialchars($_POST['client_id']);
        $customer_name = htmlspecialchars($_POST['customer_name']);
        $customer_phone = htmlspecialchars($_POST['customer_phone']);
        $customer_email = htmlspecialchars($_POST['customer_email']);
        $idcard_number = htmlspecialchars($_POST['idcard_number']);
        $address = htmlspecialchars($_POST['address']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE tbl_client SET `name`='$customer_name', `email`='$customer_email', `phone_no`='$customer_phone', `idcard_number`='$idcard_number', `address`='$address' WHERE client_id= '$client_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>