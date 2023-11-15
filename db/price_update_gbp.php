<?php
    require_once('database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

      
      $TJsql = "SELECT * FROM test_tbl";
      $TJrs=$conn->query($TJsql);
      while($TJrow =$TJrs->fetch_array())
      {

        $PartNumber=$TJrow[0];
        $Stat=$TJrow[1];

        $TIsql = "SELECT * FROM tbl_item_price_batch tipb INNER JOIN tbl_item ti ON tipb.item_id=ti.item_id WHERE ti.part_number='$PartNumber' ";
        $TIrs=$conn->query($TIsql);
        while($TIrow =$TIrs->fetch_array())
        {
          $PriceBatchID=$TIrow[0];
          $PriceBatchStat=$TIrow[7];

          // echo $PriceBatchID.' - ';

          if ($PriceBatchStat=='0') {
            
              $Updatesql = "UPDATE tbl_item_price_batch SET stat='$Stat', grn='0' WHERE price_batch_id='$PriceBatchID'";
              if($conn->query($Updatesql) === TRUE){
                echo "Record updated successfully, $PriceBatchID - <br>";
              }else{
                echo "Error updating record:";
              }

          }else{
            echo "Stat not equal to 0.. $PriceBatchID <br>";
          }

        }












      }


      // echo "Error ";

  $conn->close();

    ?>