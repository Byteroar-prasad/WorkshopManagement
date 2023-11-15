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
        $grn_number = htmlspecialchars($_POST['grn_number']);
        $batch_label = htmlspecialchars($_POST['batch_label']);
        $cost_price = htmlspecialchars($_POST['cost_price']);
        $selling_price = htmlspecialchars($_POST['selling_price']);
        $stat=0;
        $qty=0;

        $sql = "INSERT INTO `tbl_item_price_batch`(`item_id`, `grn`, `cost_price`, `selling_price`, `qty`, `batch_label`, `stat`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $item_id, $grn_number, $cost_price, $selling_price, $qty, $batch_label, $stat);
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