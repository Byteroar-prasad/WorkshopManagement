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
        $part_order_id = htmlspecialchars($_POST['part_order_id']);
        $user_id = htmlspecialchars($_POST['user_id']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE tbl_part_order SET `stat`='2' ,`approved_person_id`='$user_id' WHERE part_order_id= '$part_order_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>