<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    // $currentDate=date('Y-m-d');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $invoice_id = htmlspecialchars($_POST['invoice_id']);
        $pay_type = htmlspecialchars($_POST['pay_type']);
        $note = htmlspecialchars($_POST['note']);
        $pay = 1;

        $UpdateInvoicesSql = "UPDATE tbl_invoice SET `pay`='$pay' WHERE invoice_id= '$invoice_id' ";
        if ($conn->query($UpdateInvoicesSql) === TRUE){
            // echo "Pay updated successfully";

            $UpdateReceptSql = "UPDATE tbl_receipt SET `payment_method`='$pay_type', `note`='$note', `datetime`='$currentDate' WHERE invoice_id= '$invoice_id' ";
                if ($conn->query($UpdateReceptSql) === TRUE){
                    // echo "Pay updated successfully";
                    $output['result'] = true;
                    $output['msg'] = 'Pay updated successfully';
                    $output['invoice'] = base64_encode($invoice_id);
                    
                }else{
                    // echo "Error Pay record (CODE SPRITE)";
                    $output['result'] = false;
                    $output['msg'] = 'Error Pay record (CODE SPRITE)';
                }


            }else{
                // echo "Error Pay record (CODE COKE)";
                
                $output['result'] = false;
                $output['msg'] = 'Error Pay record (CODE COKE)';
                
            }


    }

    mysqli_close($conn);
    echo json_encode($output);

    ?>

