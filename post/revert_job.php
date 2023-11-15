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
        $job_id = htmlspecialchars($_POST['job_id']);

            $sql = "UPDATE tbl_vehicle_details SET `stat`= '1' WHERE v_id= '$job_id' ";
            if ($conn->query($sql) === TRUE) {
                echo "You Can Re-edit Job";
            } else {
                echo "Error updating record: " . $conn->error;
            }
    }

    mysqli_close($conn);

?>