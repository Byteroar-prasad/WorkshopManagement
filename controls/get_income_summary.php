<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    //$today=date('Y-m-d');
    
    // error_reporting(E_ALL ^ E_NOTICE);
    
    
    $output=[];
    $datalist=array();
    

    
    
    if(isset($_POST['start_date']) && isset($_POST['end_date']) && isset($_POST['income_type'])){
        
        $start_date=htmlspecialchars($_POST['start_date']);
        $end_date=htmlspecialchars($_POST['end_date']);
        $income_type=htmlspecialchars($_POST['income_type']);
        
        $partsIncome = 0.0;
        $labourIncome = 0.0;
        $grandTotalIncome = 0.0;
        $VehicleCount = 0;
        $output['result'] = true;
        
        
        $ItemDiscountDeferenceIndividual = 0;
        $itemCostSumIndividual = 0;
        $itemIncomeSumIndividual = 0;
        $TotalSellingValueIndividual = 0;
        $ItemDiscountDeferenceSumIndividual = 0;
        $itemCostSumTotalIndividual = 0;
        $itemIncomeSumTotalIndividual = 0;
        $itemCostSumTotal = 0;
        $itemIncomeSumTotal = 0;
        $SubletSumTotal = 0;
        $SubletCostSumTotal = 0;
        
        
        
        if($income_type=='1'){
        
        

            //get part income/////////
            $getPartsIncome = $conn->query("SELECT SUM(ti.parts_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND DATE(ti.datetime) BETWEEN '$start_date' AND '$end_date'");
            if($pi = $getPartsIncome->fetch_array()){
                // $partsIncome = number_format($pi[0],2);
                $JobpartsIncome = $pi[0];
            }
            
            ///////////////Individual Part Selling Area////////////////////// 
            $GetIndividualInvoicequery="SELECT part_selling_id FROM tbl_part_selling_details WHERE pay = '1' AND DATE(part_selling_datetime) BETWEEN '$start_date' AND '$end_date' ";
            $getIndividualInvoice=$conn->query($GetIndividualInvoicequery);
            while ($gII=$getIndividualInvoice->fetch_array()) {
                
                $PartSellingId=$gII[0];
            
            // $IndividualPartQuery="SELECT item_id,stat,part_real_price,part_discount, SUM(qty) FROM tbl_part_selling_list WHERE part_selling_id='$PartSellingId' GROUP BY item_id ORDER BY SUM(qty) DESC";
            $IndividualPartQuery="SELECT item_id,stat,part_real_price,part_discount,qty FROM tbl_part_selling_list WHERE part_selling_id='$PartSellingId' ORDER BY qty DESC";
            $getIndividualStocQty=$conn->query($IndividualPartQuery);
            while ($GIsq=$getIndividualStocQty->fetch_array()) {
    
              $itemIdIndividual=$GIsq[0];
              $priceBatchIdIndividual=$GIsq[1];
              $itemSellingIndividual=(double)$GIsq[2];
              $itemDiscountIndividual=(double)$GIsq[3];
              
              $itemQtySumIndividual=$GIsq[4];
            
                
                $getIndividualItemName = $conn->query("SELECT * FROM tbl_item WHERE item_id = '$itemIdIndividual'");
                if($GIin = $getIndividualItemName->fetch_array()){
    
                    $itemNameIndividual=$GIin[1];
                    $itemlocIndividual=$GIin[2];
                    $itemNumberIndividual=$GIin[3];
                    // $itemCost=(double)$GIin[4];
                    // $itemSelling=(double)$GIin[5];
                    
                    // array_push($itemsNameList,$itemName);
    
                }
                
                if ($priceBatchIdIndividual == 0) {
    
                    $getIndividualItemCost = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdIndividual'");
                    if($GIic = $getIndividualItemCost->fetch_array()){
       
                        // $itemCost=(double)$gic[4];
                        $itemCostIndividual=(double)$GIic[13];
    
                        $itemCostSumIndividual=$itemQtySumIndividual * $itemCostIndividual;
    
                    }
                    
                }else{
    
                    $getIndividualItemCost = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdIndividual' AND price_batch_id= '$priceBatchIdIndividual' ");
                    if($GIic = $getIndividualItemCost->fetch_array()){
         
                        $itemCostPriceBatchIndividual=(double)$GIic[3];
    
                        $itemCostSumIndividual=$itemQtySumIndividual * $itemCostPriceBatchIndividual;
    
                    }
    
                }
                
    
                  
                //   array_push($itemsQtyList,$itemQtySum);
    
                //Calculation Start
                
                $TotalSellingValueIndividual = $itemQtySumIndividual * $itemSellingIndividual;
                $ItemDiscountValueIndividual = ($itemQtySumIndividual * $itemSellingIndividual) - (($TotalSellingValueIndividual) * $itemDiscountIndividual)/100;
                $ItemDiscountDeferenceIndividual = (($TotalSellingValueIndividual) * $itemDiscountIndividual)/100;
                $ItemDiscountDeferenceSumIndividual += $ItemDiscountDeferenceIndividual;
                
                
                // $itemCostSum=$itemQtySumIndividual * $itemCost;
                $itemIncomeSumIndividual=$ItemDiscountValueIndividual;
                //////////////////////
                $itemCostSumTotalIndividual += $itemCostSumIndividual;
                $itemIncomeSumTotalIndividual += $itemIncomeSumIndividual;
                //////////////////////
                $itemFullIncomeSumTotalIndividual=$itemIncomeSumTotalIndividual-$itemCostSumTotalIndividual;
                //Calculation End
                
                
                $itemCostSumViewIndividual=number_format($itemCostSumIndividual,2);
                $itemTotalSellingValueViewIndividual=number_format($TotalSellingValueIndividual,2);
                $itemIncomeSumViewIndividual=number_format($itemIncomeSumIndividual,2);
                
                $itemCostSumTotalViewIndividual=number_format($itemCostSumTotalIndividual,2);
                $itemIncomeSumTotalViewIndividual=number_format($itemIncomeSumTotalIndividual,2);
                
                $itemFullIncomeSumTotalViewIndividual=number_format($itemFullIncomeSumTotalIndividual,2);
                
                $itemDiscountDeferenceViewIndividual=number_format($ItemDiscountDeferenceIndividual,2);
                
                $itemDiscountDeferenceSumViewIndividual=number_format($ItemDiscountDeferenceSumIndividual,2);
                
              
            
            ///
            }
            ///
    
          
        }
            
            
            
            $partsIncome = $itemIncomeSumTotalIndividual + $JobpartsIncome;
            
            
            
            
            
            
            ////////////////////////
    
    
            //get labour income/////////
            $getLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND DATE(ti.datetime) BETWEEN '$start_date' AND '$end_date'");
            if($li = $getLabour->fetch_array()){
                // $labourIncome = number_format($li[0],2);
                $labourIncome = $li[0];
            }
            ////////////////////////
    
    
            //get grand total income/////////
            $getGrandTotalIncome = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND DATE(ti.datetime) BETWEEN '$start_date' AND '$end_date'");
            if($gti = $getGrandTotalIncome->fetch_array()){
                // $grandTotalIncome = number_format($gti[0],2);
                $grandTotalSum = $gti[0];
                
            }
            
            $grandTotalIncome = $grandTotalSum + $itemIncomeSumTotalIndividual;
            ////////////////////////
    
    
            //get vehicle count/////////
            $getVehicleCount = $conn->query("SELECT COUNT(*) FROM tbl_job_details tjd WHERE DATE(tjd.reg_date) BETWEEN '$start_date' AND '$end_date'");
            if($gvc = $getVehicleCount->fetch_array()){
                
                $VehicleCount = $gvc[0];
            }
            ////////////////////////
            
            
            ////////////////////////////////////////
            
            
            $GetInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND DATE(datetime) BETWEEN '$start_date' AND '$end_date' ";
            $getInvoice=$conn->query($GetInvoicequery);
            while ($gI=$getInvoice->fetch_array()) {
                
                $jobId=$gI[0];
            
            
            // $query="SELECT item_id,stat,price,part_discount, SUM(qty) FROM tbl_job_item WHERE job_id='$jobId' GROUP BY item_id ORDER BY SUM(qty) DESC";
            $query="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobId' ORDER BY qty DESC";
            $getStocQty=$conn->query($query);
            $itemCount=0;
            while ($sq=$getStocQty->fetch_array()) {
    
              $itemId=$sq[0];
              $priceBatchId=$sq[1];
              $itemSelling=(double)$sq[2];
              $itemDiscount=(double)$sq[3];
              
              $itemQtySum=$sq[4];
            
                
                $getItemName = $conn->query("SELECT * FROM tbl_item WHERE item_id = '$itemId'");
                if($gin = $getItemName->fetch_array()){
    
                    $itemName=$gin[1];
                    $itemloc=$gin[2];
                    $itemNumber=$gin[3];
                    // $itemCost=(double)$gin[4];
                    // $itemSelling=(double)$gin[5];
                    
                    // array_push($itemsNameList,$itemName);
    
                }
                
                if ($priceBatchId == 0) {
    
                    $getItemCost = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemId'");
                    if($gic = $getItemCost->fetch_array()){
       
                        // $itemCost=(double)$gic[4];
                        $itemCost=(double)$gic[13];
    
                        $itemCostSum=$itemQtySum * $itemCost;
    
                    }
                    
                }else{
    
                    $getItemCost = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemId' AND price_batch_id= '$priceBatchId' ");
                    if($gic = $getItemCost->fetch_array()){
         
                        $itemCostPriceBatch=(double)$gic[3];
    
                        $itemCostSum=$itemQtySum * $itemCostPriceBatch;
    
                    }
    
                }
                
    
                  
                //   array_push($itemsQtyList,$itemQtySum);
    
                //Calculation Start
                
                $ItemDiscountValue = ($itemQtySum * $itemSelling) - (($itemQtySum * $itemSelling) * $itemDiscount)/100;
                
                // $itemCostSum=$itemQtySum * $itemCost;
                $itemIncomeSum= $ItemDiscountValue;
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
              
          
              
            
            ///
            }
            ///
            
            //Sublet Calculations
            
            $Subletquery="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobId' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
            $getSubletQuery=$conn->query($Subletquery);
            while ($GSsq=$getSubletQuery->fetch_array()) {
                
                $SubletSellingSum=$GSsq[0];
                $SubletCostSum=$GSsq[1];
                
                $SubletSumTotal += $SubletSellingSum;
                $SubletCostSumTotal += $SubletCostSum;
                
                $SubletSumTotalView = number_format($SubletSumTotal,2);
                $SubletCostSumTotalView = number_format($SubletCostSumTotal,2);
            }
            
            
            
    
          
        }
        
        
        
        /////Main Calculation///////
        $totalpartIncome = $itemIncomeSumTotal + $itemIncomeSumTotalIndividual;
        $TotalPartIncomeSum = number_format($totalpartIncome,2);
        
        $totalpartcost = $itemCostSumTotalIndividual + $itemCostSumTotal;
        $TotalPartCostSum = number_format($totalpartcost,2);
        
        $labourIncomeView = number_format($labourIncome,2);
        $TotalRevenue = $totalpartIncome + $labourIncome + $SubletSumTotal;
        $TotalRevenueView = number_format($TotalRevenue,2);
        
        $NetIncome = $TotalRevenue - $totalpartcost - $SubletCostSumTotal;
        $NetIncomeView = number_format($NetIncome,2);
        
        
        //////////
        
        
        
        
            $obj='
                <tr>
                    <td style="display: none;">1</td>
                    <td>Total Part Sale</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$TotalPartIncomeSum.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">2</td>
                    <td>Total Labour</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$labourIncomeView.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">3</td>
                    <td>Total Sublet</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$SubletSumTotalView.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">4</td>
                    <td><font style="font-weight: 800; font-size: 20px; color: #FF0000;">Total Revenue</font></td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px; color: #FF0000;">'.$TotalRevenueView.'</font></td>
                </tr>
                
                
                <tr>
                    <td style="display: none;">5</td>
                    <td>Total Part Cost</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$TotalPartCostSum.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">5</td>
                    <td>Total Sublet Cost</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$SubletCostSumTotalView.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">6</td>
                    <td><font style="font-weight: 800; font-size: 20px; color: #03AC13;">Gross Income</font></td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px; color: #03AC13;">'.$NetIncomeView.'</font></td>
                </tr>
                
              ';
    
              array_push($datalist,$obj);
            
            
            
            
            
            
    
    
            ////////////////////////////////////////
    
    
    
    
            
            $output['parts_income'] = $partsIncome;
            $output['labour_income'] = $labourIncome;
            $output['grand_total_income'] = $grandTotalIncome;
            $output['vehicle_count'] = $VehicleCount;
            
            $output['data']=$datalist;
        
        
        
        //With Credit
        }else{
            
            //get part income/////////
            $getPartsIncome = $conn->query("SELECT SUM(ti.parts_total) FROM tbl_invoice ti WHERE DATE(ti.datetime) BETWEEN '$start_date' AND '$end_date'");
            if($pi = $getPartsIncome->fetch_array()){
                // $partsIncome = number_format($pi[0],2);
                $JobpartsIncome = $pi[0];
            }
            
            ///////////////Individual Part Selling Area////////////////////// 
            $GetIndividualInvoicequery="SELECT part_selling_id FROM tbl_part_selling_details WHERE DATE(part_selling_datetime) BETWEEN '$start_date' AND '$end_date' ";
            $getIndividualInvoice=$conn->query($GetIndividualInvoicequery);
            while ($gII=$getIndividualInvoice->fetch_array()) {
                
                $PartSellingId=$gII[0];
            
            // $IndividualPartQuery="SELECT item_id,stat,part_real_price,part_discount, SUM(qty) FROM tbl_part_selling_list WHERE part_selling_id='$PartSellingId' GROUP BY item_id ORDER BY SUM(qty) DESC";
            $IndividualPartQuery="SELECT item_id,stat,part_real_price,part_discount,qty FROM tbl_part_selling_list WHERE part_selling_id='$PartSellingId' ORDER BY qty DESC";
            $getIndividualStocQty=$conn->query($IndividualPartQuery);
            while ($GIsq=$getIndividualStocQty->fetch_array()) {
    
              $itemIdIndividual=$GIsq[0];
              $priceBatchIdIndividual=$GIsq[1];
              $itemSellingIndividual=(double)$GIsq[2];
              $itemDiscountIndividual=(double)$GIsq[3];
              
              $itemQtySumIndividual=$GIsq[4];
            
                
                $getIndividualItemName = $conn->query("SELECT * FROM tbl_item WHERE item_id = '$itemIdIndividual'");
                if($GIin = $getIndividualItemName->fetch_array()){
    
                    $itemNameIndividual=$GIin[1];
                    $itemlocIndividual=$GIin[2];
                    $itemNumberIndividual=$GIin[3];
                    // $itemCost=(double)$GIin[4];
                    // $itemSelling=(double)$GIin[5];
                    
                    // array_push($itemsNameList,$itemName);
    
                }
                
                if ($priceBatchIdIndividual == 0) {
    
                    $getIndividualItemCost = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdIndividual'");
                    if($GIic = $getIndividualItemCost->fetch_array()){
       
                        // $itemCost=(double)$gic[4];
                        $itemCostIndividual=(double)$GIic[13];
    
                        $itemCostSumIndividual=$itemQtySumIndividual * $itemCostIndividual;
    
                    }
                    
                }else{
    
                    $getIndividualItemCost = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdIndividual' AND price_batch_id= '$priceBatchIdIndividual' ");
                    if($GIic = $getIndividualItemCost->fetch_array()){
         
                        $itemCostPriceBatchIndividual=(double)$GIic[3];
    
                        $itemCostSumIndividual=$itemQtySumIndividual * $itemCostPriceBatchIndividual;
    
                    }
    
                }
                
    
                  
                //   array_push($itemsQtyList,$itemQtySum);
    
                //Calculation Start
                
                $TotalSellingValueIndividual = $itemQtySumIndividual * $itemSellingIndividual;
                $ItemDiscountValueIndividual = ($itemQtySumIndividual * $itemSellingIndividual) - (($TotalSellingValueIndividual) * $itemDiscountIndividual)/100;
                $ItemDiscountDeferenceIndividual = (($TotalSellingValueIndividual) * $itemDiscountIndividual)/100;
                $ItemDiscountDeferenceSumIndividual += $ItemDiscountDeferenceIndividual;
                
                
                // $itemCostSum=$itemQtySumIndividual * $itemCost;
                $itemIncomeSumIndividual=$ItemDiscountValueIndividual;
                //////////////////////
                $itemCostSumTotalIndividual += $itemCostSumIndividual;
                $itemIncomeSumTotalIndividual += $itemIncomeSumIndividual;
                //////////////////////
                $itemFullIncomeSumTotalIndividual=$itemIncomeSumTotalIndividual-$itemCostSumTotalIndividual;
                //Calculation End
                
                
                $itemCostSumViewIndividual=number_format($itemCostSumIndividual,2);
                $itemTotalSellingValueViewIndividual=number_format($TotalSellingValueIndividual,2);
                $itemIncomeSumViewIndividual=number_format($itemIncomeSumIndividual,2);
                
                $itemCostSumTotalViewIndividual=number_format($itemCostSumTotalIndividual,2);
                $itemIncomeSumTotalViewIndividual=number_format($itemIncomeSumTotalIndividual,2);
                
                $itemFullIncomeSumTotalViewIndividual=number_format($itemFullIncomeSumTotalIndividual,2);
                
                $itemDiscountDeferenceViewIndividual=number_format($ItemDiscountDeferenceIndividual,2);
                
                $itemDiscountDeferenceSumViewIndividual=number_format($ItemDiscountDeferenceSumIndividual,2);
                
              
            
            ///
            }
            ///
    
          
        }
            
            
            
            $partsIncome = $itemIncomeSumTotalIndividual + $JobpartsIncome;
            
            
            
            
            
            
            ////////////////////////
    
    
            //get labour income/////////
            $getLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE DATE(ti.datetime) BETWEEN '$start_date' AND '$end_date'");
            if($li = $getLabour->fetch_array()){
                // $labourIncome = number_format($li[0],2);
                $labourIncome = $li[0];
            }
            ////////////////////////
    
    
            //get grand total income/////////
            $getGrandTotalIncome = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE DATE(ti.datetime) BETWEEN '$start_date' AND '$end_date'");
            if($gti = $getGrandTotalIncome->fetch_array()){
                // $grandTotalIncome = number_format($gti[0],2);
                $grandTotalSum = $gti[0];
                
            }
            
            $grandTotalIncome = $grandTotalSum + $itemIncomeSumTotalIndividual;
            ////////////////////////
    
    
            //get vehicle count/////////
            $getVehicleCount = $conn->query("SELECT COUNT(*) FROM tbl_job_details tjd WHERE DATE(tjd.reg_date) BETWEEN '$start_date' AND '$end_date'");
            if($gvc = $getVehicleCount->fetch_array()){
                
                $VehicleCount = $gvc[0];
            }
            ////////////////////////
            
            
            ////////////////////////////////////////
            
            
            $GetInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE DATE(datetime) BETWEEN '$start_date' AND '$end_date' ";
            $getInvoice=$conn->query($GetInvoicequery);
            while ($gI=$getInvoice->fetch_array()) {
                
                $jobId=$gI[0];
            
            
            // $query="SELECT item_id,stat,price,part_discount, SUM(qty) FROM tbl_job_item WHERE job_id='$jobId' GROUP BY item_id ORDER BY SUM(qty) DESC";
            $query="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobId' ORDER BY qty DESC";
            $getStocQty=$conn->query($query);
            $itemCount=0;
            while ($sq=$getStocQty->fetch_array()) {
    
              $itemId=$sq[0];
              $priceBatchId=$sq[1];
              $itemSelling=(double)$sq[2];
              $itemDiscount=(double)$sq[3];
              
              $itemQtySum=$sq[4];
            
                
                $getItemName = $conn->query("SELECT * FROM tbl_item WHERE item_id = '$itemId'");
                if($gin = $getItemName->fetch_array()){
    
                    $itemName=$gin[1];
                    $itemloc=$gin[2];
                    $itemNumber=$gin[3];
                    // $itemCost=(double)$gin[4];
                    // $itemSelling=(double)$gin[5];
                    
                    // array_push($itemsNameList,$itemName);
    
                }
                
                if ($priceBatchId == 0) {
    
                    $getItemCost = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemId'");
                    if($gic = $getItemCost->fetch_array()){
       
                        // $itemCost=(double)$gic[4];
                        $itemCost=(double)$gic[13];
    
                        $itemCostSum=$itemQtySum * $itemCost;
    
                    }
                    
                }else{
    
                    $getItemCost = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemId' AND price_batch_id= '$priceBatchId' ");
                    if($gic = $getItemCost->fetch_array()){
         
                        $itemCostPriceBatch=(double)$gic[3];
    
                        $itemCostSum=$itemQtySum * $itemCostPriceBatch;
    
                    }
    
                }
                
    
                  
                //   array_push($itemsQtyList,$itemQtySum);
    
                //Calculation Start
                
                $ItemDiscountValue = ($itemQtySum * $itemSelling) - (($itemQtySum * $itemSelling) * $itemDiscount)/100;
                
                // $itemCostSum=$itemQtySum * $itemCost;
                $itemIncomeSum= $ItemDiscountValue;
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
              
          
              
            
            ///
            }
            ///
            
            //Sublet Calculations
            
            $Subletquery="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobId' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
            $getSubletQuery=$conn->query($Subletquery);
            while ($GSsq=$getSubletQuery->fetch_array()) {
                
                $SubletSellingSum=$GSsq[0];
                $SubletCostSum=$GSsq[1];
                
                $SubletSumTotal += $SubletSellingSum;
                $SubletCostSumTotal += $SubletCostSum;
                
                $SubletSumTotalView = number_format($SubletSumTotal,2);
                $SubletCostSumTotalView = number_format($SubletCostSumTotal,2);
            }
            
            
            
    
          
        }
        
        
        
        /////Main Calculation///////
        $totalpartIncome = $itemIncomeSumTotal + $itemIncomeSumTotalIndividual;
        $TotalPartIncomeSum = number_format($totalpartIncome,2);
        
        $totalpartcost = $itemCostSumTotalIndividual + $itemCostSumTotal;
        $TotalPartCostSum = number_format($totalpartcost,2);
        
        $labourIncomeView = number_format($labourIncome,2);
        $TotalRevenue = $totalpartIncome + $labourIncome + $SubletSumTotal;
        $TotalRevenueView = number_format($TotalRevenue,2);
        
        $NetIncome = $TotalRevenue - $totalpartcost - $SubletCostSumTotal;
        $NetIncomeView = number_format($NetIncome,2);
        
        
        //////////
        
        
        
        
            $obj='
                <tr>
                    <td style="display: none;">1</td>
                    <td>Total Part Sale</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$TotalPartIncomeSum.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">2</td>
                    <td>Total Labour</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$labourIncomeView.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">3</td>
                    <td>Total Sublet</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$SubletSumTotalView.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">4</td>
                    <td><font style="font-weight: 800; font-size: 20px; color: #FF0000;">Total Revenue</font></td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px; color: #FF0000;">'.$TotalRevenueView.'</font></td>
                </tr>
                
                
                <tr>
                    <td style="display: none;">5</td>
                    <td>Total Part Cost</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$TotalPartCostSum.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">5</td>
                    <td>Total Sublet Cost</td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800;">'.$SubletCostSumTotalView.'</font></td>
                </tr>
                
                <tr>
                    <td style="display: none;">6</td>
                    <td><font style="font-weight: 800; font-size: 20px; color: #03AC13;">Gross Income</font></td>
                    <td></td>
                    <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px; color: #03AC13;">'.$NetIncomeView.'</font></td>
                </tr>
                
              ';
    
              array_push($datalist,$obj);
            
            
            
            
            
            
    
    
            ////////////////////////////////////////
    
    
    
    
            
            $output['parts_income'] = $partsIncome;
            $output['labour_income'] = $labourIncome;
            $output['grand_total_income'] = $grandTotalIncome;
            $output['vehicle_count'] = $VehicleCount;
            
            $output['data']=$datalist;
            
            
            
            
            
        }
        
        
        
        
        
        
        
        
        
       
        
        
    }else{
        $output['result']=false;
        $output['msg']="Invalid request, Please try again.";
    }
    
    echo json_encode($output);
    
    
    