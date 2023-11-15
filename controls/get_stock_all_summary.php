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
    $itemsNameList = array();
    $itemsQtyList = array();
    $itemCostSum=0;
    $itemIncomeSum=0;

    $itemCostSumTotal=0;
    $itemIncomeSumTotal=0;

    if(isset($_POST['stock_start_date']) && isset($_POST['stock_end_date'])){

        $stock_start_date=htmlspecialchars($_POST['stock_start_date']);
        $stock_end_date=htmlspecialchars($_POST['stock_end_date']);

        // $query="SELECT item_id, SUM(qty) FROM tbl_job_item WHERE DATE(datetime) BETWEEN '$stock_start_date' AND '$stock_end_date' GROUP BY item_id ORDER BY SUM(qty) DESC LIMIT 12";
        $query="SELECT item_id, SUM(qty) FROM tbl_job_item WHERE DATE(datetime) BETWEEN '$stock_start_date' AND '$stock_end_date' GROUP BY item_id ORDER BY SUM(qty) DESC";
        $getStocQty=$conn->query($query);
        $itemCount=0;
        while ($sq=$getStocQty->fetch_array()) {

          $itemId=$sq[0];
        
            
            $getItemName = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemId'");
            if($gin = $getItemName->fetch_array()){

                $itemName=$gin[1];
                $itemloc=$gin[2];
                $itemNumber=$gin[3];
                $itemCost=(double)$gin[13];
                $itemSelling=(double)$gin[5];
                
                array_push($itemsNameList,$itemName);

            }
            

              $itemQtySum=$sq[1];
               array_push($itemsQtyList,$itemQtySum);

            //Calculation Start
            $itemCostSum=$itemQtySum * $itemCost;
            $itemIncomeSum=$itemQtySum * $itemSelling;
            //////////////////////
            $itemCostSumTotal += $itemCostSum;
            $itemIncomeSumTotal += $itemIncomeSum;
            //////////////////////
            $itemFullIncomeSumTotal=$itemIncomeSumTotal-$itemCostSumTotal;
            //Calculation End
            
            
            $itemCostSumView=number_format($itemCostSum,2);
            $itemIncomeSumView=number_format($itemIncomeSum,2);
            
            $itemCostSumTotalView=number_format($itemCostSumTotal,2);
            $itemIncomeSumTotalView=number_format($itemIncomeSumTotal,2);
            
            $itemFullIncomeSumTotalView=number_format($itemFullIncomeSumTotal,2);
            
            $itemCount+=1;
          
      $obj='
            <tr>
                <td scope="row">'.$itemCount.'</td>
                <td>'.$itemName.'</td>
                <td>'.$itemNumber.'</td>
                <td style="text-align: center;"><font style="color: #03AC13; font-weight: 800;">'.$itemQtySum.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemCostSumView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemIncomeSumView.'</font></td>
            </tr>
            
          ';

          array_push($datalist,$obj);
          
        



      
    }
    
    
        $obj='
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemIncomeSumTotalView.'</font><br><font style="color: #FF0000;">Full Selling</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemCostSumTotalView.'</font><br><font style="color: #FF0000;">Full Cost</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemFullIncomeSumTotalView.'</font><br><font style="color: #03AC13;">Full Income</font></td>
            </tr>
            
          ';

          array_push($datalistfoot,$obj);


    $output['result']=true;
    $output['data']=$datalist;
    $output['datafoot']=$datalistfoot;
    

    $output['itemName'] = $itemsNameList;
    $output['itemQtySum'] = $itemsQtyList;




    }else{
        $output['result']=false;
        $output['data']="Invalid request.";
    }






   


    echo json_encode($output);
    
    
    