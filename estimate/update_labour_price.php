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
        $estimate_labour_id = htmlspecialchars($_POST['estimate_labour_id']);
        $fru_pay = htmlspecialchars($_POST['fru_pay']);
        $labour_price = htmlspecialchars($_POST['labour_price']);

        $job_fru=(double)$labour_price / (double)$fru_pay;

        $UpdateJobFRUsql = "UPDATE tbl_estimate_labour SET `estimate_fru`= '$job_fru' WHERE estimate_labour_id = '$estimate_labour_id' ";
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