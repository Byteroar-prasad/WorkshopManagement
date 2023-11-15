<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $fru_pay = htmlspecialchars($_POST['fru_pay']);
        $fru = 1;

        $sql = "INSERT INTO `tbl_labour_paying`(`fru`, `pay_amount`) VALUES (?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ss", $fru, $fru_pay);
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