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
        $labour_discount = htmlspecialchars($_POST['labour_discount']);

        $sql = "UPDATE tbl_job_labour SET `labour_discount`= '$labour_discount' WHERE job_labour_id= '$job_labour_id' ";
                if ($conn->query($sql) === TRUE) {

            $output['result'] = true;
            $output['msg'] = 'Successfully discount added';

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