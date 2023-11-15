  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');



    $output=[]; 
    $datalist=array();

    if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['start_no']) && isset($_POST['end_no']) ){

        $receipt_start_date=htmlspecialchars($_POST['start_date']);
        $receipt_end_date=htmlspecialchars($_POST['end_date']);

        $receipt_number_start=htmlspecialchars($_POST['start_no']);
        $receipt_number_end=htmlspecialchars($_POST['end_no']);



        if(empty($receipt_start_date) && empty($receipt_end_date) && empty($receipt_number_start) && empty($receipt_number_end)){
            $query = "SELECT * FROM tbl_receipt";
        }else if(!empty($receipt_start_date) &&  !empty($receipt_end_date) && empty($receipt_number_start) && empty($receipt_number_end)){
            $query = "SELECT * FROM tbl_receipt WHERE (DATE(datetime) BETWEEN '$receipt_start_date' AND '$receipt_end_date')";
        }else if(!empty($receipt_number_start) &&  !empty($receipt_number_end) && empty($receipt_start_date) && empty($receipt_end_date)){
             $query = "SELECT * FROM tbl_receipt WHERE (receipt_id BETWEEN '$receipt_number_start' AND '$receipt_number_end')";
        }else{
            $query = "SELECT * FROM tbl_receipt WHERE (DATE(datetime) BETWEEN '$receipt_start_date' AND '$receipt_end_date') AND (receipt_id BETWEEN '$receipt_number_start' AND '$receipt_number_end')";
        }


        
        // $output['q'] = $query;
        $getReceptSummery=$conn->query($query);
        while ($row=$getReceptSummery->fetch_array()) {

            $ReceiptId = $row[0];
            $InvoiceId = $row[1];
            $Price = $row[2];
            $PaymentMethod = $row[3];
            $DataCount = $row[4];
            $Note = $row[5];
            $ReceptDateTime = $row[6];

            $ReceptDate = date('d-m-Y', strtotime($ReceptDateTime)) ;
            $InvoiceYear = date('Y', strtotime($ReceptDateTime));

            if(strpos($InvoiceId, "PIN") !== false){
                $InvoiceIdEx = explode('PIN-', $InvoiceId)[1];
                $NumberGenPInvoice = 10000+$InvoiceIdEx;
                $InvoiceNumber = 'BAE/PIN/'.$InvoiceYear.'/'.$NumberGenPInvoice;
                $ReceptLink = 'part_receipt?r='.base64_encode($InvoiceIdEx);
            }else{

                $GetInvoiceIdSql ="SELECT * FROM tbl_invoice WHERE invoice_id='$InvoiceId'";
                $GIIrs=$conn->query($GetInvoiceIdSql);
                if($GIIrow =$GIIrs->fetch_array())
                {
                    $InvoiceRealId = $GIIrow[0];
                }

                $NumberGenNormalInvoice=$InvoiceRealId+10000;
                $InvoiceNumber = 'BAE/IN/'.$InvoiceYear.'/'.$NumberGenNormalInvoice;
                $ReceptLink = 'receipt?r='.base64_encode($InvoiceId);
            }


          
      $obj='
            <tr class="gradeA">
                <td>'.$ReceiptId.'</td>
                <td>
                    <a href="'.$ReceptLink.'" class="btn btn-primary">Receipt</a>
                </td>
                <td>'.$InvoiceNumber.'</td>
                <td>'.$PaymentMethod.'</td>
                <td>'.$DataCount.'</td>
                <td><b style="float: right;">'.number_format($Price,2).'</b></td>
                <td>'.$ReceptDate.'</td>
            </tr>
          ';

          array_push($datalist,$obj);
    
    }

    $output['result']=true;
    $output['data']=$datalist;


    }else{
        $output['result']=false;
        $output['data']="Invalid request.";
    }


    echo json_encode($output);
    
    
    