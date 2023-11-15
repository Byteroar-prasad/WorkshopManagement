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
        $client_id = htmlspecialchars($_POST['client_id']);
        $reg_customer = htmlspecialchars($_POST['reg_customer']);
        $reg_phone_no = htmlspecialchars($_POST['reg_phone_no']);
        $email = htmlspecialchars($_POST['email']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_id = htmlspecialchars($_POST['user_id']);
        
        $reg_license_no = '';
        $reg_model = '';
        $reg_chassis_no = '';
        
        $stat = 0;
        $pay = 0;

        $sql = "INSERT INTO `tbl_part_selling_details`(`reg_email`, `reg_customer`, `reg_phone_no`, `reg_model`, `reg_chassis_no`, `reg_licens_no`, `user_name`, `stat`, `pay`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $email, $reg_customer, $reg_phone_no, $reg_model, $reg_chassis_no, $reg_license_no, $user_name, $stat, $pay);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $lastId=0;
            $getLast=$conn->query("SELECT part_selling_id FROM tbl_part_selling_details ORDER BY part_selling_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){
              $lastId=$lRs[0];
              
              // $sendId=base64_encode($lastId);
            }

                if($conn->query("INSERT INTO tbl_part_selling_tax VALUES(null,'$lastId','$user_id','0','0',null,'0','$currentDate','$client_id',null)")){

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