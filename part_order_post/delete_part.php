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
        $part_order_item_id = htmlspecialchars($_POST['part_order_item_id']);

        $sql = "DELETE FROM tbl_part_order_item WHERE part_order_item_id= '$part_order_item_id' ";
        if ($conn->query($sql) === TRUE) {

            echo 'Completed';

        }else{  
            echo 'Error';   
        }

    }

    mysqli_close($conn);

?>