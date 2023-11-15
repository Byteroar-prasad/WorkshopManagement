<?php
    require_once('database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

      $TIsql = "SELECT * FROM tbl_item_price_batch WHERE qty>0";
      $TIrs=$conn->query($TIsql);
      while($TIrow =$TIrs->fetch_array())
      {
          $PriceBatchId=$TIrow[0];
          $ItemId=$TIrow[1];
          $ItemSellingPrice=(double)$TIrow[4];

          $PercentageIncrease=$ItemSellingPrice+(($ItemSellingPrice*10)/100);

          $Updatesql = "UPDATE tbl_item_price_batch SET selling_price='$PercentageIncrease' WHERE price_batch_id='$PriceBatchId' ";

          if ($conn->query($Updatesql) === TRUE) {
            echo "Record updated successfully".$PriceBatchId;
          } else {
            echo "Error updating record: " . $conn->error;
          }

      }

        $conn->close();


    ?>