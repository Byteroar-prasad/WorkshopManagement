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
        $license_no = htmlspecialchars($_POST['license_no']);
        $note = htmlspecialchars($_POST['note']);
        $advance_payment = htmlspecialchars($_POST['advance_payment']);
        
        $stat = 0;
        $job_id = '';


        $sql = "INSERT INTO `tbl_advance`(`job_id`, `license_number`, `note`, `advance_payment`, `stat`, `advance_date`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $job_id, $license_no, $note, $advance_payment, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';


            $AdvanceId=0;
        
            $getLast=$conn->query("SELECT advance_id FROM tbl_advance ORDER BY advance_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){

              $AdvanceId=base64_encode($lRs[0]);

              $output['result'] = true;
              $output['data'] = $AdvanceId;

            }



        }else{  
            // echo 'Error';   
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>