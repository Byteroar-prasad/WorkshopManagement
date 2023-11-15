<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $name = htmlspecialchars($_POST['name']);
        $date = htmlspecialchars($_POST['date']);
        $phone_no = htmlspecialchars($_POST['phone_no']);
        $email = htmlspecialchars($_POST['email']);
        $birthday_month = htmlspecialchars($_POST['birthday_month']);
        $birthday_date = htmlspecialchars($_POST['birthday_date']);
        $how_to_know = htmlspecialchars($_POST['how_to_know']);
        $address = htmlspecialchars($_POST['address']);

        $birthday = $birthday_month.' '.$birthday_date;


        $sql = "INSERT INTO `tbl_client`(`name`, `email`, `date`, `idcard_number`, `phone_no`, `how_to_know`, `address`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $name, $email, $date, $birthday, $phone_no, $how_to_know, $address);
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