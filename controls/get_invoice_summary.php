  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');

    

    $output=[]; 
    $datalist=array();
    $datalistfoot=array();
    
    $GrandTotal='0.00';

    if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['start_no']) && isset($_POST['end_no']) ){

        $invoice_start_date=htmlspecialchars($_POST['start_date']);
        $invoice_end_date=htmlspecialchars($_POST['end_date']);
        
        $invoice_number_start=htmlspecialchars($_POST['start_no']);
        $invoice_number_end=htmlspecialchars($_POST['end_no']);
        
        if($invoice_number_start=='NaN' && $invoice_number_end=='NaN'){
            $invoice_number_start_final='';
            $invoice_number_end_final='';
        }else{
            $invoice_number_start_final=htmlspecialchars($_POST['start_no']);
            $invoice_number_end_final=htmlspecialchars($_POST['end_no']);
        }
        
      

        




        if(empty($invoice_start_date) && empty($invoice_end_date) && empty($invoice_number_start_final) && empty($invoice_number_end_final)){
            $query = "SELECT * FROM tbl_invoice";
            
        }else if(!empty($invoice_start_date) &&  !empty($invoice_end_date) && empty($invoice_number_start_final) && empty($invoice_number_end_final)){
            $query = "SELECT * FROM tbl_invoice WHERE (DATE(datetime) BETWEEN '$invoice_start_date' AND '$invoice_end_date')";
            
        }else if(!empty($invoice_number_start_final) &&  !empty($invoice_number_end_final) && empty($invoice_start_date) && empty($invoice_end_date)){
             $query = "SELECT * FROM tbl_invoice WHERE (invoice_new_id BETWEEN '$invoice_number_start_final' AND '$invoice_number_end_final')";
             
        }else{
            $query = "SELECT * FROM tbl_invoice WHERE (DATE(datetime) BETWEEN '$invoice_start_date' AND '$invoice_end_date') AND (invoice_new_id BETWEEN '$invoice_number_start_final' AND '$invoice_number_end_final')";
        }


        
        // $output['q'] = $query;
 


        // $query="SELECT * FROM tbl_invoice WHERE DATE(datetime) BETWEEN '$invoice_start_date' AND '$invoice_end_date' ORDER BY invoice_new_id DESC";
        // echo "SELECT * FROM tbl_invoice WHERE DATE(datetime) BETWEEN '$invoice_start_date' AND '$invoice_end_date' ORDER BY invoice_new_id DESC";
        $getInvoiceSummery=$conn->query($query);
        $PaymentStatus='';
        $PaymentColor='';
        $Recept='';
        $GrandTotalSum='0.00';
        while ($GISrs=$getInvoiceSummery->fetch_array()) {

            $InvoiceSaveId = $GISrs[0];
            $JobId = $GISrs[1];
            $CustomerName = $GISrs[2];
            $LicenseNumber = $GISrs[6];
            $ConNumber = $GISrs[5];
            $reg_date = date('d-m-Y', strtotime($GISrs[21])) ;
                                                     
            $price = $GISrs[16];
            $stat = $GISrs[19];
            $pay = $GISrs[18];

            $grand_total = (double)$GISrs[16];
            $advance_full_pay = (double)$GISrs[20];

            $grand_total_advance = $grand_total - $advance_full_pay;
            
            $GrandTotal= number_format($grand_total,2);
            
            $GrandTotalSum += $grand_total;
            $GrandTotalSumView=number_format($GrandTotalSum,2);

            //////////////////
            $InvoiceNumber = 10000+$GISrs[0];
                                                    
            $InvoiceYear = date('Y', strtotime($GISrs[21]));
            
            $InvoiceViewId=base64_encode($InvoiceSaveId);
            $ReceptViewId=base64_encode($JobId);
            
            
            if($pay=='1'){
                $PaymentStatus='Paid';
                $PaymentColor='#008000';
            }elseif($pay=='2'){
                $PaymentStatus='Credit';
                $PaymentColor='#FF0000';
            }else{
                $PaymentStatus='-';
                $PaymentColor='#000';
            }
            
            
                
            
            
            if ($stat=='0') {
                $Recept= '';
                // $Recept= '<a href="'.$Recept.'" class="btn btn-primary">'.$ReceptName.'</a>';
            }else{
                // $Recept= 'receipt?r='.$ReceptViewId.'';
                $Recept= '<a href="receipt?r='.$ReceptViewId.'" class="btn btn-primary">Receipt</a>';
            }
            
                //////
                $GetPaymentTypeSql ="SELECT payment_method FROM tbl_receipt WHERE invoice_id='$JobId'";
                $GPTrs=$conn->query($GetPaymentTypeSql);
                if($GPTrow =$GPTrs->fetch_array())
                {
                    $PaymentType=$GPTrow[0];
                }


          
      $obj=' 
            <tr class="gradeA">
                <td style="display: none;">'.$InvoiceSaveId.'</td>
                <td>BAE/IN/'.$InvoiceYear.'/'.$InvoiceNumber.'</td>
                <td>
                    <a href="old_invoice_final?i='.$InvoiceViewId.'" class="btn btn-success">Invoice</a>
                    '.$Recept.'
                </td>
                <td>'.$CustomerName.'</td>
                <td>'.$LicenseNumber.'</td>
                <td>'.$ConNumber.'</td>
                <td><b style="color: '.$PaymentColor.';">'.$PaymentStatus.'</b></td>
                <td><b>'.$PaymentType.'</b></td>
                <td style="text-align: right;">'.$GrandTotal.'</td>
                <td>'.$reg_date.'</td>
            </tr>

          ';

          array_push($datalist,$obj);
          
        
          
    
    }
    
    
      $obj='
            <tr>
                <th colspan="7" style="text-align:right; font-size: 20px;">Total:</th>
                <th colspan="1" style="text-align:right; font-size: 20px;">'.$GrandTotalSumView.'</th>
                <th colspan="1"></th>
            </tr>
            
          ';

          array_push($datalistfoot,$obj);
    

    $output['result']=true;
    $output['data']=$datalist;
    $output['datafoot']=$datalistfoot;


    }else{
        $output['result']=false;
        $output['data']="Invalid request.";
    }


    echo json_encode($output);
    
    
    