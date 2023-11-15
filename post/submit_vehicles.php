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
        $client_id = htmlspecialchars($_POST['client_id']);
        $license_no = htmlspecialchars($_POST['license_no']);
        $vehicle_modal = htmlspecialchars($_POST['vehicle_modal']);
        $chassis_no = htmlspecialchars($_POST['chassis_no']);
        $note = htmlspecialchars($_POST['note']);
        
        $stat = 1;


        $sql = "INSERT INTO `tbl_vehicle`(`client_id`, `license_no`, `vehicle_modal`, `chassis_no`, `note`, `stat`, `reg_date`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $client_id, $license_no, $vehicle_modal, $chassis_no, $note, $stat, $currentDate);
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