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
        $supplier_id = htmlspecialchars($_POST['supplier_id']);
        $supplier_name = htmlspecialchars($_POST['supplier_name']);
        $supplier_company_name = htmlspecialchars($_POST['supplier_company_name']);
        $phone_no = htmlspecialchars($_POST['phone_no']);
        $supplier_email = htmlspecialchars($_POST['supplier_email']);
        $address = htmlspecialchars($_POST['address']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE tbl_supplier SET `supplier_name`='$supplier_name', `supplier_company_name`='$supplier_company_name', `address`='$address', `phone_no`='$phone_no', `email`='$supplier_email' WHERE supplier_id= '$supplier_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>