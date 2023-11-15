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
        $grn_number = htmlspecialchars($_POST['grn_number']);
        $selected_item_id = htmlspecialchars($_POST['selected_item_id']);
        $batch_label = htmlspecialchars($_POST['batch_label']);
        $cost_price = htmlspecialchars($_POST['cost_price']);
        $selling_price = htmlspecialchars($_POST['selling_price']);
        $stat = htmlspecialchars($_POST['stat']);

        if ($stat=='0') {
           $StatValue='0';
        }else{
            $grn_currencey_details = htmlspecialchars($_POST['grn_currencey_details']);
            $currencey_rate = htmlspecialchars($_POST['currencey_rate']);
            $StatValue = $grn_currencey_details.'_'.$currencey_rate;
        }


        $qty=0;

        $sql = "INSERT INTO `tbl_item_price_batch`(`item_id`, `grn`, `cost_price`, `selling_price`, `qty`, `batch_label`, `stat`) VALUES (?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssss", $selected_item_id, $grn_number, $cost_price, $selling_price, $qty, $batch_label, $StatValue);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
              
            $data = "";

            $getLast = $conn->query("SELECT tipb.price_batch_id,tipb.batch_label FROM tbl_item_price_batch tipb ORDER BY tipb.price_batch_id DESC LIMIT 1");
            if($glRs = $getLast->fetch_array()){
                $id = $glRs[0];
                $label = $glRs[1];

                $data = '<option value='.$id.'>'.$label.'</option>';

            }

            $output['result'] = true;
            $output['data'] = $data;





        }else{  
           $output['result'] = false;
            $output['data'] = $data;
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

?>