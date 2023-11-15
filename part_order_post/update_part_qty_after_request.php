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
        $qty = htmlspecialchars($_POST['qty']);
        $part_order_id = htmlspecialchars($_POST['part_order_id']);

        $ChangeValueSql = "UPDATE tbl_part_order_item SET `qty`='0' WHERE part_order_id='$part_order_id' AND item_id= '$item_id' ";
        if($conn->query($ChangeValueSql) === TRUE){
          
          $getOneValueSql=$conn->query("SELECT part_order_item_id FROM tbl_part_order_item WHERE part_order_id='$part_order_id' AND item_id='$item_id' LIMIT 1");
          if($lRs=$getOneValueSql->fetch_array()){

            $part_order_item_id=$lRs[0];
          
              $sql = "UPDATE tbl_part_order_item SET `qty`='$qty' WHERE part_order_id='$part_order_id' AND part_order_item_id= '$part_order_item_id' ";
              if($conn->query($sql) === TRUE){
                echo "Record updated successfully";
              }else{
                echo "Error updating record: " . $conn->error;
              }

            }

        }else{
          echo "Error updating record: " . $conn->error;
        }


        $conn->close();


    }

   

    ?>