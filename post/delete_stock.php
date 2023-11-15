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
        $item_id = htmlspecialchars($_POST['item_id']);
        $item_history_id = htmlspecialchars($_POST['item_history_id']);
        $item_quantity = htmlspecialchars($_POST['item_quantity']);
        $price_batch_id = htmlspecialchars($_POST['price_batch_id']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }


        if ($price_batch_id == 0) {
          //Normal price batch
          /////////////////
          $sql = "DELETE FROM tbl_item_history WHERE item_history_id='$item_history_id'";

          if ($conn->query($sql) === TRUE) {
            echo "Record Deleted successfully";
            
            $sql = "UPDATE tbl_item SET `quantity`= quantity - '$item_quantity' WHERE item_id= '$item_id'";

            if ($conn->query($sql) === TRUE) {
              echo "Record Updated successfully";

            } else {
              echo "Error updating record: " . $conn->error;
            }


          } else {
            echo "Error updating record: " . $conn->error;
          }
          ///////////////

        }else{
          //With Price Batch
          /////////////////
          $sql = "DELETE FROM tbl_item_history WHERE item_history_id='$item_history_id'";

          if ($conn->query($sql) === TRUE) {
            echo "Record Deleted successfully";
            
            $sql = "UPDATE tbl_item_price_batch SET `qty`= qty - '$item_quantity' WHERE item_id= '$item_id' AND price_batch_id='$price_batch_id' ";

            if ($conn->query($sql) === TRUE) {
              echo "Record Updated successfully";

            } else {
              echo "Error updating record: " . $conn->error;
            }


          } else {
            echo "Error updating record: " . $conn->error;
          }
          ///////////////

        }

        











        $conn->close();


    }

   

    ?>