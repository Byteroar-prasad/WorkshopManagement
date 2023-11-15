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
        $vehicle_make = htmlspecialchars($_POST['vehicle_make']);
        $vehicle_model = htmlspecialchars($_POST['vehicle_model']);
        $vehicle_model_code = htmlspecialchars($_POST['vehicle_model_code']);
        $vehicle_model_variant = htmlspecialchars($_POST['vehicle_model_variant']);
        $stat=1;

        $sql = "INSERT INTO `tbl_vehicle_model`(`make`, `model`, `model_code`, `model_variant`, `stat`) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $vehicle_make, $vehicle_model, $vehicle_model_code, $vehicle_model_variant, $stat);
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