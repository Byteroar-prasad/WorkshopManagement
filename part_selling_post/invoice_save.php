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
        $part_selling_id = htmlspecialchars($_POST['part_selling_id']);
        $grand_total = htmlspecialchars($_POST['grand_total']);
        $stat = 1;

        $sql = "UPDATE tbl_part_selling_details SET stat='$stat' WHERE part_selling_id='$part_selling_id' ";
        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";

            //TAX Date Time Update
            $conn->query("UPDATE tbl_part_selling_tax SET datetime='$currentDate', grand_total='$grand_total' WHERE part_selling_id='$part_selling_id'");

        }else{  
            echo 'Error';   
        }


    }

    mysqli_close($conn);

?>