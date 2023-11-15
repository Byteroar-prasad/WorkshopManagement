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
        $invoice_id = htmlspecialchars($_POST['invoice_id']);
        $price = htmlspecialchars($_POST['price']);
        $pay_type = htmlspecialchars($_POST['pay_type']);
        $date_count = htmlspecialchars($_POST['date_count']);
        $note = htmlspecialchars($_POST['note']);

        $stat = 1;
        // $pay = 1;




        $sql = "INSERT INTO `tbl_receipt`(`invoice_id`, `price`, `payment_method`, `date_count`, `note`, `datetime`) VALUES (?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssss", $invoice_id, $price, $pay_type, $date_count, $note, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            //echo 'Completed Receipt';


            if ($pay_type=='Credit') {

                $sql = "UPDATE tbl_invoice SET `stat`='$stat', `pay`='2' WHERE invoice_id= '$invoice_id' ";

                    if ($conn->query($sql) === TRUE) {
                    //  echo "Credit updated successfully";

                        $output['result'] = true;
                        $output['msg'] = 'credit';
                        $output['invoice'] = base64_encode($invoice_id);

 
                    } else {
                         $output['result'] = false;
                        $output['msg'] = 'credit failed';
                        
                     // echo "Error Credit record: " . $conn->error;
                    }


            }else{

                $sql = "UPDATE tbl_invoice SET `stat`='$stat', `pay`='1' WHERE invoice_id= '$invoice_id' ";

                    if ($conn->query($sql) === TRUE) {
                    //  echo "Cash updated successfully";
                        $output['result'] = true;
                        $output['msg'] = 'cash';
                        $output['invoice'] = base64_encode($invoice_id);

                    } else {
                        $output['result'] = false;
                        $output['msg'] = 'cash failed';
//echo "Error Cash record: " . $conn->error;
                    }


            }







        }else{  
           // echo 'Error Receipt';   
        }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>