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
        $job_id = htmlspecialchars($_POST['job_id']);
        $job_description = htmlspecialchars($_POST['job_description']);

            $UpdateJobDescriptionSql = "UPDATE tbl_job_details SET `comments`='$job_description' WHERE job_id= '$job_id' ";
            if($conn->query($UpdateJobDescriptionSql) === TRUE){
            
                $output['result'] = true;
                $output['msg'] = 'Job description updated.';
    
            }else{
                $output['result'] = false;
                $output['msg'] = 'Error update job description.';
            }
            
    }
    
    mysqli_close($conn);
    echo json_encode($output);

   

    ?>