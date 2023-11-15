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
        $quantity = htmlspecialchars($_POST['quantity']);
        $price_batch_id = htmlspecialchars($_POST['price_batch_id']);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }


        if ($price_batch_id == 0) {
          //Normal Price
          ///////////////////
          $sql = "UPDATE tbl_item SET `quantity`= quantity + '$quantity' WHERE item_id= '$item_id' ";

          if ($conn->query($sql) === TRUE) {
            // echo "Record updated successfully";

            $getItemData = $conn->query("SELECT * FROM tbl_item WHERE item_id= '$item_id'");
            if($gidRS = $getItemData->fetch_array()){
                $PartCost=$gidRS[4];
                $PartSellingPrice=$gidRS[5];

                $conn->query("INSERT INTO tbl_item_history VALUES(null, '$item_id', '$quantity', '$PartCost', '$PartSellingPrice', '0', '$currentDate')");

                echo "Record updated successfully";

            }else{
              echo "Error adding data";
            }



          } else {
            echo "Error updating record: " . $conn->error;
          }
          ////////////////////////
          
        }else{
          //With Price Badge
          ///////////////////
          $sql = "UPDATE tbl_item_price_batch SET `qty`= qty + '$quantity' WHERE item_id= '$item_id' AND price_batch_id = '$price_batch_id' ";

          if ($conn->query($sql) === TRUE) {
            // echo "Record updated successfully";

            $getItemPriceBatchData = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id= '$item_id' AND price_batch_id = '$price_batch_id' ");
            if($gidPRS = $getItemPriceBatchData->fetch_array()){
                $PartPriceBatchCost=$gidPRS[3];
                $PartPriceBatchSellingPrice=$gidPRS[4];

                $conn->query("INSERT INTO tbl_item_history VALUES(null, '$item_id', '$quantity', '$PartPriceBatchCost', '$PartPriceBatchSellingPrice', '$price_batch_id', '$currentDate')");

                echo "Record updated successfully";

            }else{
              echo "Error adding data";
            }



          } else {
            echo "Error updating record: " . $conn->error;
          }
          ////////////////////////



        }

        









        $conn->close();


    }

   

    ?>