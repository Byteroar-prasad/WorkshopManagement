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
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_phone = htmlspecialchars($_POST['user_phone']);
        $user_email = htmlspecialchars($_POST['user_email']);
        $user_license_number = htmlspecialchars($_POST['user_license_number']);
        $book_date = htmlspecialchars($_POST['book_date']);
        $book_time = htmlspecialchars($_POST['book_time']);
        $category = htmlspecialchars($_POST['category']);
        $user_message = htmlspecialchars($_POST['user_message']);
        
        $stat=0;

        $sql = "INSERT INTO `tbl_booking_web`(`user_name`, `user_phone`, `user_email`, `user_license_number`, `book_date`, `book_time`, `category`, `user_message`, `stat`, `booking_datetime`) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssss", $user_name, $user_phone, $user_email, $user_license_number, $book_date, $book_time, $category, $user_message, $stat, $currentDate);
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