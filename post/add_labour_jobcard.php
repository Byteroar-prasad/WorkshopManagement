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
        $labour_name = htmlspecialchars($_POST['labour_name']);
        $fru = htmlspecialchars($_POST['fru']);
        $labour_name_2 = '';

        $labour_discount = 0;
        $labour_id = 0;



        $check = $conn->query("SELECT * FROM tbl_job_labour WHERE job_id = '$job_id' AND labour_name_1 = '$labour_name'");
        if($crs = $check->fetch_array()){
            $output['result'] = false;
            $output['msg'] = 'Already exists.';

          
        }else{
            $sql = "INSERT INTO `tbl_job_labour`(`job_id`, `labour_id`, `job_fru`, `labour_discount`, `labour_name_1`, `labour_name_2`) VALUES (?,?,?,?,?,?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "ssssss", $job_id, $labour_id, $fru, $labour_discount, $labour_name, $labour_name_2);
            $result = mysqli_stmt_execute($stmt);
            if($result)
            {

                 $output['result'] = true;
                 $output['msg'] = 'Labour added success';
               
            }else{  
                 $output['result'] = false;
                 $output['msg'] = 'Error';
            }
        }





    }

    mysqli_close($conn);

    echo json_encode($output);


?>