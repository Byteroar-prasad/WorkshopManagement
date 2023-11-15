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
        $client_projects_id = htmlspecialchars($_POST['client_projects_id']);
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $department = htmlspecialchars($_POST['department']);
        $related_service = htmlspecialchars($_POST['related_service']);
        $priority = htmlspecialchars($_POST['priority']);
        $message = htmlspecialchars($_POST['message']);

        $stat = 1;
        $imei = '';

        $sql = "INSERT INTO `tbl_ticket`(`client_projects_id`, `name`, `email`, `subject`, `imei`, `department`, `related_service`, `priority`, `message`, `stat`, `ticket_date`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssssss", $client_projects_id, $name, $email, $subject, $imei, $department, $related_service, $priority, $message, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);

        if($result)
        {
            $output['result']=true;
            $output['msg']="Ticket Open successfully.";
        }else{

            $output['result']=false;
            $output['msg']="Error open ticket.";
        }

      
    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>