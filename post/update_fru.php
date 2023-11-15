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
        $job_labour_id = htmlspecialchars($_POST['job_labour_id']);
        $job_fru = htmlspecialchars($_POST['job_fru']);

        $UpdateJobFRUsql = "UPDATE tbl_job_labour SET `job_fru`= '$job_fru' WHERE job_labour_id = '$job_labour_id' ";
                if ($conn->query($UpdateJobFRUsql) === TRUE) {

            $output['result'] = true;
            $output['msg'] = 'Successfully update FRU';

            // echo 'Completed';

            }else{  

                $output['result'] = false;
                $output['msg'] = 'Error, Something went wrong';

                // echo 'Error';   
            }

    }

    mysqli_close($conn);

    echo json_encode($output);

?>