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
        $part_selling_id = htmlspecialchars($_POST['part_selling_id']);
        $price = htmlspecialchars($_POST['price']);
        $pay_type = htmlspecialchars($_POST['pay_type']);
        $date_count = htmlspecialchars($_POST['date_count']);
        $note = htmlspecialchars($_POST['note']);

        // $pay = 1;

        $PartSellingInvoiceId= 'PIN-'.$part_selling_id;


        $sql = "INSERT INTO `tbl_receipt`(`invoice_id`, `price`, `payment_method`, `date_count`, `note`, `datetime`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $PartSellingInvoiceId, $price, $pay_type, $date_count, $note, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            //echo 'Completed Receipt';


            if ($pay_type=='Credit') {

                $sql = "UPDATE tbl_part_selling_details SET `pay`='2' WHERE part_selling_id= '$part_selling_id' ";

                    if ($conn->query($sql) === TRUE) {

                        $output['result'] = true;
                        $output['msg'] = 'credit';
                        $output['invoice'] = base64_encode($part_selling_id);

 
                    } else {
                        $output['result'] = false;
                        $output['msg'] = 'credit failed';
                        
                    }


            }else{

                $sql = "UPDATE tbl_part_selling_details SET `pay`='1' WHERE part_selling_id= '$part_selling_id' ";

                    if ($conn->query($sql) === TRUE) {

                        $output['result'] = true;
                        $output['msg'] = 'cash';
                        $output['invoice'] = base64_encode($part_selling_id);

                    } else {
                        $output['result'] = false;
                        $output['msg'] = 'cash failed';

                    }


            }







        }else{  
           // echo 'Error Receipt';   
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>