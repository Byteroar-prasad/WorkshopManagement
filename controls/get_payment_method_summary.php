  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');


    $output=[]; 
    $datalist=array();
    $PaymentMethod = array();
    $PaymentCount = array();


        $query="SELECT payment_method, COUNT(*) FROM tbl_receipt GROUP BY payment_method ORDER BY COUNT(*) DESC";
        $getPaymentMethod=$conn->query($query);
        while ($gpm=$getPaymentMethod->fetch_array()) {

          $PayMethod=$gpm[0];
          $PayCount=$gpm[1];


                array_push($PaymentMethod,$PayMethod);
                array_push($PaymentCount,$PayCount);

    
    }

    $output['result']=true;
    

    $output['paymethod'] = $PaymentMethod;
    $output['paycount'] = $PaymentCount;



    echo json_encode($output);
 