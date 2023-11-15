  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');


    $output=[]; 
    $datalist=array();

    if(isset($_POST['income_receved_start_date']) && isset($_POST['income_receved_end_date'])){

        $income_receved_start_date=htmlspecialchars($_POST['income_receved_start_date']);
        $income_receved_end_date=htmlspecialchars($_POST['income_receved_end_date']);


        $query="SELECT payment_method, SUM(price), COUNT(*) FROM tbl_receipt WHERE DATE(datetime) BETWEEN '$income_receved_start_date' AND '$income_receved_end_date' GROUP BY payment_method ORDER BY SUM(price) DESC";
        // echo "SELECT payment_method, SUM(price), COUNT(*) FROM tbl_receipt WHERE DATE(datetime) BETWEEN '$income_receved_start_date' AND '$income_receved_end_date' GROUP BY payment_method ORDER BY SUM(price) DESC";
        $getPaymentMethodType=$conn->query($query);
        while ($gsa=$getPaymentMethodType->fetch_array()) {

          $PaymentType=$gsa[0];
          $PaymentRecevedMoney=number_format($gsa[1],2);
          $PaymentMethodCount=$gsa[2];
          
      $obj=' 
            <tr>
                <td><b>'.$PaymentType.'</b></td> 
                <td><b style="float: right;">'.$PaymentRecevedMoney.'</b></td>
                <td><b style="float: right;">'.$PaymentMethodCount.'</b></td>
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
    
    
    