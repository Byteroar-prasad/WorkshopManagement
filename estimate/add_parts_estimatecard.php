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
        $estimate_id = htmlspecialchars($_POST['estimate_id']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $labour_id = htmlspecialchars($_POST['labour_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $qty = htmlspecialchars($_POST['qty']);
        $remark = htmlspecialchars($_POST['remark']);

        $stat = 0;

        $sql = "INSERT INTO `tbl_estimate_item`(`estimate_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `stat`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $estimate_id, $user_id, $labour_id, $item_id, $qty, $remark, $stat);
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