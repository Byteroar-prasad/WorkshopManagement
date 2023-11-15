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
        $labour_name = htmlspecialchars($_POST['labour_name']);
        $fru = htmlspecialchars($_POST['fru']);

        $sql = "INSERT INTO `tbl_labour`(`labour_name`, `fru`, `datetime`) VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $labour_name, $fru, $currentDate);
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