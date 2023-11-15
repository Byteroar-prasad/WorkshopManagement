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
        $user_id = htmlspecialchars($_POST['user_id']);
        $priority = 1;
        $stat = 1;

        $CreatePartOrderSql = "INSERT INTO `tbl_part_order`(`part_order_id`, `requested_person_id`, `approved_person_id`, `priority`, `stat`, `part_order_datetime`) VALUES (null, '$user_id', null, '$priority', '$stat', '$currentDate')";
        if ($conn->query($CreatePartOrderSql) === TRUE){
          

          $lastId=0;
          $getLast=$conn->query("SELECT part_order_id FROM tbl_part_order ORDER BY part_order_id DESC LIMIT 1");
          if($lRs=$getLast->fetch_array()){

            $lastId=$lRs[0];
            

            $GetPartsSql = "SELECT * FROM tbl_part_order_item WHERE stat='0'";
            $GPrs=$conn->query($GetPartsSql);
            while($GProw =$GPrs->fetch_array())
            {

              $PartOrderItemId=$GProw[0];

              $UpdatePartsDetailsSql = "UPDATE tbl_part_order_item SET part_order_id='$lastId', `stat`='$stat' WHERE part_order_item_id= '$PartOrderItemId' ";

              if ($conn->query($UpdatePartsDetailsSql) === TRUE) {
                echo "Part order requested done";
              } else {
                echo "Error requested part order";
              }


            }



          }



        }else{
          echo "Error: " . $sql . "<br>" . $conn->error;
        }


        $conn->close();


    }

   

    ?>