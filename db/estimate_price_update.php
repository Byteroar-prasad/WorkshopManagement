<?php
    require_once('database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

      
      $TJsql = "SELECT * FROM tbl_estimate_item ";
      $TJrs=$conn->query($TJsql);
      while($TJrow =$TJrs->fetch_array())
      {

        $ItemId=$TJrow[4];


        $TIsql = "SELECT * FROM tbl_item WHERE item_id='$ItemId' ";
        $TIrs=$conn->query($TIsql);
        if($TIrow =$TIrs->fetch_array())
        {
          $ItemSellingPrice=$TIrow[5];

          $Updatesql = "UPDATE tbl_estimate_item SET price='$ItemSellingPrice' WHERE item_id='$ItemId' ";

          if ($conn->query($Updatesql) === TRUE) {
            echo "Record updated successfully";
          } else {
            echo "Error updating record: " . $conn->error;
          }

        }else{
          echo "Err 456";
        }



      }


      echo "Error 999";




        $conn->close();


 

    ?>