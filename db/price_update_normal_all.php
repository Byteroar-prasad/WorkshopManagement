<?php
    require_once('database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

      $TIsql = "SELECT * FROM tbl_item WHERE quantity>0";
      $TIrs=$conn->query($TIsql);
      while($TIrow =$TIrs->fetch_array())
      {
          $ItemId=$TIrow[0];
          $ItemSellingPrice=(double)$TIrow[5];

          $PercentageIncrease=$ItemSellingPrice+(($ItemSellingPrice*10)/100);

          $Updatesql = "UPDATE tbl_item SET selling_cost='$PercentageIncrease' WHERE item_id='$ItemId' ";

          if ($conn->query($Updatesql) === TRUE) {
            echo "Record updated successfully".$ItemId;
          } else {
            echo "Error updating record: " . $conn->error;
          }

      }

        $conn->close();


    ?>