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
        $part_selling_real = htmlspecialchars($_POST['part_selling_real']);


        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

          $UpdateRealCostsql = "UPDATE tbl_item SET `selling_cost`='$part_selling_real' WHERE item_id= '$item_id' ";

          if ($conn->query($UpdateRealCostsql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record 222: " . $conn->error;
          }

        $conn->close();


    }

   

    ?>