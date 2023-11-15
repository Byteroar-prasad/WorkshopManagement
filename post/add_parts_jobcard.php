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
        $user_id = htmlspecialchars($_POST['user_id']);
        $labour_id = htmlspecialchars($_POST['labour_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $qty = htmlspecialchars($_POST['qty']);
        $remark = htmlspecialchars($_POST['remark']);

        $part_discount = 0;
        $stat = 0;


    $check = $conn->query("SELECT * FROM tbl_job_item WHERE job_id = '$job_id' AND item_id = '$item_id'");
    if($crs = $check->fetch_array()){
        $output['result'] = false;
        $output['msg'] = 'Already exists.';

    }else{


        $sql = "INSERT INTO `tbl_job_item`(`job_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `part_discount`, `stat`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $job_id, $user_id, $labour_id, $item_id, $qty, $remark, $part_discount, $stat);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {

            $output['result'] = true;
            $output['msg'] = 'Successfully added';

            // echo 'Completed';

                 $sql = "UPDATE tbl_item SET `quantity`= quantity - '$qty' WHERE item_id= '$item_id' ";
                if ($conn->query($sql) === TRUE) {
                  // echo "Record updated successfully";

                  $output['result'] = true;
                  $output['msg'] = 'Successfully added';


                }else {
                  // echo "Error updating record: " . $conn->error;

                  $output['result'] = false;
                  $output['msg'] = 'Error stock updated';


                }



            }else{  

                $output['result'] = false;
                $output['msg'] = 'Error';

                // echo 'Error';   
            }


        }




    }

    mysqli_close($conn);

    echo json_encode($output);

?>