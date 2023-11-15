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
        $estimate_id = htmlspecialchars($_POST['estimate_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $qty = htmlspecialchars($_POST['qty']);
        $item_cost = htmlspecialchars($_POST['item_cost']);
        $user_id = htmlspecialchars($_POST['user_id']);

        $part_order_id='';
        $stat='0';

        $sql = "INSERT INTO `tbl_part_order_item`(`part_order_id`, `estimate_id`, `item_id`, `qty`, `item_cost`, `user_id`, `stat`, `part_order_item_datetime`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $part_order_id, $estimate_id, $item_id, $qty, $item_cost, $user_id, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            echo 'Completed';
        }else{  
            echo 'Error';   
        }


    }

    mysqli_close($conn);

?>