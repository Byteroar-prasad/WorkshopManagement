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
        $job_part_id = htmlspecialchars($_POST['job_part_id']);
        $part_discount = htmlspecialchars($_POST['part_discount']);

        $sql = "UPDATE tbl_part_selling_list SET `part_discount`= '$part_discount' WHERE part_selling_list_id = '$job_part_id' ";
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