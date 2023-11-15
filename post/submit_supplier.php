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
        $supplier_name = htmlspecialchars($_POST['supplier_name']);
        $supplier_company_name = htmlspecialchars($_POST['supplier_company_name']);
        $address = htmlspecialchars($_POST['address']);
        $phone_no = htmlspecialchars($_POST['phone_no']);
        $email = htmlspecialchars($_POST['email']);

        $stat = 0;

        $sql = "INSERT INTO `tbl_supplier`(`supplier_name`, `supplier_company_name`, `address`, `phone_no`, `email`, `stat`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $supplier_name, $supplier_company_name, $address, $phone_no, $email, $stat);
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