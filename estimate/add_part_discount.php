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
        $estimate_part_id = htmlspecialchars($_POST['estimate_part_id']);
        $estimate_part_discount = htmlspecialchars($_POST['estimate_part_discount']);

            $sql = "UPDATE tbl_estimate_item SET `stat`= '$estimate_part_discount' WHERE estimate_item_id = '$estimate_part_id' ";
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