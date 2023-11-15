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
        $supplier_id = htmlspecialchars($_POST['supplier_id']);
        $user_name = htmlspecialchars($_POST['user_name']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $invoice_number = htmlspecialchars($_POST['invoice_number']);
        // $grn_number = htmlspecialchars($_POST['grn_number']);
        $goods_received_date = htmlspecialchars($_POST['goods_received_date']);
        $note = htmlspecialchars($_POST['note']);
        $grn_type = htmlspecialchars($_POST['grn_type']);

        $stat = 0;

        if($grn_type=='0'){
            $grn_number = '0';
        }else{
            //grn_number-->Updated GRN Currency and other details
            $currency_method = htmlspecialchars($_POST['currency_method']);
            $currency_in_lkr = htmlspecialchars($_POST['currency_in_lkr']);
            $freight_clearance = htmlspecialchars($_POST['freight_clearance']);

            $grn_number = $currency_method.'_'.$currency_in_lkr.'_'.$freight_clearance;
        }

        $sql = "INSERT INTO `tbl_grn_details`(`supplier_id`, `user_name`, `user_id`, `invoice_number`, `grn_number`, `goods_received_date`, `note`, `stat`, `grn_datetime`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $supplier_id, $user_name, $user_id, $invoice_number, $grn_number, $goods_received_date, $note, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';

            $lastId=0;
            $getLast=$conn->query("SELECT grn_detail_id FROM tbl_grn_details ORDER BY grn_detail_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){
              $lastId=$lRs[0];
              
              // $sendId=base64_encode($lastId);
            }

                $output['result']="ok_";
                $output['msg']='Successfully created GRN.';
                $output['j_id']=$lastId;       

        }else{
            // echo 'Error';   

            $output['result']=false;
            $output['msg']='Something went wrong (error code Register)';
        }


    }

    mysqli_close($conn);

    echo json_encode($output);

    ?>