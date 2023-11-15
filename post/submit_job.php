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
        $reg_license_no = htmlspecialchars($_POST['reg_license_no']);
        $client_id = htmlspecialchars($_POST['client_id']);
        $reg_date = htmlspecialchars($_POST['reg_date']);
        $reg_customer = htmlspecialchars($_POST['reg_customer']);
        $reg_phone_no = htmlspecialchars($_POST['reg_phone_no']);
        $f_reg_date = htmlspecialchars($_POST['f_reg_date']);
        $reg_mileage = htmlspecialchars($_POST['reg_mileage']);
        $email = htmlspecialchars($_POST['email']);
        $reg_model = htmlspecialchars($_POST['reg_model']);
        $reg_chassis_no = htmlspecialchars($_POST['reg_chassis_no']);
        $comments = htmlspecialchars($_POST['comments']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_id = htmlspecialchars($_POST['user_id']);
        
        $stat = 1;

        $sql = "INSERT INTO `tbl_job_details`(`reg_email`, `reg_date`, `reg_customer`, `reg_phone_no`, `f_reg_date`, `reg_model`, `reg_chassis_no`, `reg_licens_no`, `reg_mileage`, `user_name`, `comments`, `stat`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssss", $email, $reg_date, $reg_customer, $reg_phone_no, $f_reg_date, $reg_model, $reg_chassis_no, $reg_license_no, $reg_mileage, $user_name, $comments, $stat);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $lastId=0;
            $getLast=$conn->query("SELECT job_id FROM tbl_job_details ORDER BY job_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){
              $lastId=$lRs[0];
              
              // $sendId=base64_encode($lastId);
            }

                if($conn->query("INSERT INTO tbl_tax VALUES(null,'$lastId','$user_id','0','0',null,'0',null,'$client_id')")){

                    $output['result']="ok_";
                    $output['msg']='Successfully registered.';
                    $output['j_id']=$lastId;


                }else{

                    $output['result']=false;
                    $output['msg']='Something went wrong (error code Tax)';
               }


        }else{  
            // echo 'Error';   

            $output['result']=false;
            $output['msg']='Something went wrong (error code Register)';
        }


    }

    mysqli_close($conn);

    echo json_encode($output);

    ?>