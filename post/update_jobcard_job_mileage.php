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
        $job_mileage = htmlspecialchars($_POST['job_mileage']);

            $UpdateJobDescriptionSql = "UPDATE tbl_job_details SET `reg_mileage`='$job_mileage' WHERE job_id= '$job_id' ";
            if($conn->query($UpdateJobDescriptionSql) === TRUE){
            
                $output['result'] = true;
                $output['msg'] = 'Vehicle Mileage updated.';
    
            }else{
                $output['result'] = false;
                $output['msg'] = 'Error update vehicle mileage.';
            }
            
    }
    
    mysqli_close($conn);
    echo json_encode($output);

   

    ?>