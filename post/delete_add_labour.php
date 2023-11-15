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
        $labour_id = htmlspecialchars($_POST['labour_id']);

        $sql = "DELETE FROM tbl_labour WHERE labour_id= '$labour_id' ";
                if ($conn->query($sql) === TRUE) {

            // $output['result'] = true;
            // $output['msg'] = 'Successfully deleted';

            echo 'Completed';

            }else{  
                // $output['result'] = false;
                // $output['msg'] = 'Error, Something went wrong';

                echo 'Error';   
            }

    }

    mysqli_close($conn);

    echo json_encode($output);

?>