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
        $item_id = htmlspecialchars($_POST['item_id']);
        $part_name = htmlspecialchars($_POST['part_name']);
        $part_number = htmlspecialchars($_POST['part_number']);
        $part_location = htmlspecialchars($_POST['part_location']);
        // $part_cost_real = htmlspecialchars($_POST['part_cost_real']);
        // $part_selling = htmlspecialchars($_POST['part_selling']);
        $part_discount = htmlspecialchars($_POST['part_discount']);
        $part_remark = htmlspecialchars($_POST['part_remark']);


        /////////////////////////

        // $FakeCost = $part_selling - (($part_selling * 20)/100);

        /////////////////////////


        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $UpdateStocksql = "UPDATE tbl_item SET `part_name`='$part_name', `part_number`='$part_number', `part_location`='$part_location', `discount`='$part_discount', `remark`='$part_remark' WHERE item_id= '$item_id' ";

        if ($conn->query($UpdateStocksql) === TRUE) {

          echo "Record updated successfully";
          // $UpdateRealCostsql = "UPDATE tbl_item_cost SET `cost`='$part_cost_real' WHERE item_id= '$item_id' ";

          // if ($conn->query($UpdateRealCostsql) === TRUE) {
          //   echo "Record updated successfully";
          // } else {
          //   echo "Error updating record 222: " . $conn->error;
          // }



        } else {
          echo "Error updating record 111: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>