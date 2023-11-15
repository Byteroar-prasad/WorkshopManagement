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
        $invoice_new_id = htmlspecialchars($_POST['invoice_new_id']);
        $stat=1;

            $Updatesql = "UPDATE tbl_job_details SET stat= '$stat' WHERE job_id= '$job_id' ";
                if ($conn->query($Updatesql) === TRUE) {
                    
                    
                    $UpdateInvoiceDetailsSql = "UPDATE tbl_invoice SET invoice_id= '-1', customer= '', client_address= '', email= '', phone_number= '', licens_no= '', chassis_no= '', mileage= '', note= '', labour_total= '0', parts_total= '0', sublet_price= '0', sub_total= '0', vat= '0', grand_total= '0', pay= '0', stat='0', advance_pay= '0'  WHERE invoice_new_id='$invoice_new_id' ";
                    if ($conn->query($UpdateInvoiceDetailsSql) === TRUE) {
                    
                        $conn->query("DELETE FROM tbl_invoice_image WHERE job_id='$job_id'");
                        
                        //Here invoice id == job id//
                        // $conn->query("DELETE FROM tbl_invoice WHERE invoice_id='$job_id'");
                        
                        //Part and labour delete from $invoice_new_id //////////////////
                        ///////Part Delete////////
                        $conn->query("DELETE FROM tbl_invoice_parts WHERE invoice_id='$invoice_new_id'");
                        ///////Labour Delete////////
                        $conn->query("DELETE FROM tbl_invoice_labour WHERE invoice_id='$invoice_new_id'");

                        ///////Recept Delete////////
                        $conn->query("DELETE FROM tbl_receipt WHERE invoice_id='$job_id'");
                    
                    
                    

                        $output['result'] = true;
                        $output['msg'] = 'Successfully Re-Open Job';

                    }else{  

                        $output['result'] = false;
                        $output['msg'] = 'Error, Something went wrong 99';

                    }
            

            }else{  

                $output['result'] = false;
                $output['msg'] = 'Error, Something went wrong 88';

            }

    }

    mysqli_close($conn);
    echo json_encode($output);

?>