<?php
    require_once('../db/database_ticket.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    // $currentDate=date('Y-m-d');
    $currentDate=date('Y-m-d H:i:s');

    $output=[];
               
    if($_POST)
    {
        $ticket_id = htmlspecialchars($_POST['ticket_id']);
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $reply = htmlspecialchars($_POST['reply']);
        $possition = 'Client';

        $sql = "INSERT INTO `tbl_ticket_reply`(`ticket_id`, `name`, `email`, `reply`, `possition`, `reply_date`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $ticket_id, $name, $email, $reply, $possition, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            $output['result']=true;
            $output['msg']="Reply successfully sent.";
        }else{
            $output['result']=true;
            $output['msg']="Error Reply sent. 999";
        }

      
    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>