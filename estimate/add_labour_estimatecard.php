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
        $labour_name = htmlspecialchars($_POST['labour_name']);
        $labour_id = 0;
        $labour_name_2 = '';
        $fru = htmlspecialchars($_POST['fru']);


        $sql = "INSERT INTO `tbl_estimate_labour`(`estimate_id`, `labour_id`, `estimate_fru`, `labour_name_1`, `labour_name_2`) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $estimate_id, $labour_id, $fru, $labour_name, $labour_name_2);
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