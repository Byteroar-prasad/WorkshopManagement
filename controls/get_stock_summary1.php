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
    
    $datalistindividual=array();
    $datalistindividualfoot=array();
    
    
    $itemsNameList = array();
    $itemsQtyList = array();
    
    
            $itemCostSum=0;
            $itemIncomeSum=0;
        
            $itemCostSumTotal=0;
            $itemIncomeSumTotal=0;
            $itemCount=0;
            $itemIndividualCount=0;
            $ItemDiscountDeferenceSum=0;
            $ItemDiscountDeferenceSumIndividual=0;
            $itemCostSumTotalIndividual=0;
            $itemIncomeSumTotalIndividual=0;
            
            $TotalPriceWithFandC=0;
            $TotalPriceWithFandCIndividual=0;
    


    if(isset($_POST['stock_start_date']) && isset($_POST['stock_end_date'])){

        $stock_start_date=htmlspecialchars($_POST['stock_start_date']);
        $stock_end_date=htmlspecialchars($_POST['stock_end_date']);
        
        
        
        $GetInvoicequery="SELECT invoice_id,invoice_new_id,datetime FROM tbl_invoice WHERE pay = '1' AND DATE(datetime) BETWEEN '$stock_start_date' AND '$stock_end_date' ";
        $getInvoice=$conn->query($GetInvoicequery);
        while ($gI=$getInvoice->fetch_array()) {
            
            $jobId=$gI[0];
            $InvoiceSaveId=$gI[1];
            $InvoiceDateTime=$gI[2];
            
            $InvoiceNumber = 10000+$InvoiceSaveId;        
            $InvoiceYear = date('Y', strtotime($InvoiceDateTime)) ;
        
        // $query="SELECT item_id,stat,price, SUM(qty) FROM tbl_job_item WHERE DATE(datetime) BETWEEN '$stock_start_date' AND '$stock_end_date' GROUP BY item_id ORDER BY SUM(qty) DESC";
        // $query="SELECT item_id,stat,price,part_discount, SUM(qty) FROM tbl_job_item WHERE job_id='$jobId' GROUP BY item_id ORDER BY SUM(qty) DESC";
        $query="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobId' ORDER BY qty DESC";
        $getStocQty=$conn->query($query);
        
        while ($sq=$getStocQty->fetch_array()) {

          $itemId=$sq[0];
          $priceBatchId=$sq[1];
          $itemSelling=(double)$sq[2];
          $itemDiscount=(double)$sq[3];
          
          $itemQtySum=(double)$sq[4];
          
            $getItemGRNPriceBatchDetails = $conn->query("SELECT * FROM tbl_grn_details tgd INNER JOIN tbl_grn_items tgi ON tgd.grn_detail_id=tgi.grn_detail_id WHERE tgi.item_id = '$itemId' AND tgi.price_batch_id='$priceBatchId' ORDER BY tgi.grn_items_id DESC LIMIT 1");
            if($giGRNpbd = $getItemGRNPriceBatchDetails->fetch_array()){
       
                $GRNDetailId=$giGRNpbd[0];
                $GRNSupplierId=$giGRNpbd[1];
                $GRNDateTime=$giGRNpbd[9];
                        
                $GRNNumber = 10000+$GRNDetailId;        
                $GRNYear = date('Y', strtotime($GRNDateTime)) ;
                
                $getSupplierName = $conn->query("SELECT * FROM tbl_supplier WHERE supplier_id = '$GRNSupplierId'");
                if($gsn = $getSupplierName->fetch_array()){
    
                    $SupplierName=$gsn[1];
    
                }
    
            }else{
                $GRNNumber ='OLD';
                $GRNYear ='2022';
                $SupplierName='No Supplier Data';
            }
        
            
            $getItemName = $conn->query("SELECT * FROM tbl_item WHERE item_id = '$itemId'");
            if($gin = $getItemName->fetch_array()){

                $itemName=$gin[1];
                $itemloc=$gin[2];
                $itemNumber=$gin[3];
                // $itemCost=(double)$gin[4];
                // $itemSelling=(double)$gin[5];
                
                array_push($itemsNameList,$itemName);

            }
            
            if ($priceBatchId == 0) {

                $getItemCost = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemId'");
                if($gic = $getItemCost->fetch_array()){
   
                    // $itemCost=(double)$gic[4];
                    $InternationalOrNot=$gic[9];
                    $itemCost=(double)$gic[13];

                    $itemCostSum=$itemQtySum * $itemCost;

                    //International
                    if ($InternationalOrNot=='1') {

                        $CurrenceyView='-';
                        $InternationalCost='-';
                        $PriceWithFandCView='-';
                        
            
                    }else{

                        $CurrenceyDetails = explode("_",$InternationalOrNot);
                        $Currencey = $CurrenceyDetails[0];
                        $CurrenceyInLKR = (double)$CurrenceyDetails[1];
                        $FreightClearence = (double)$CurrenceyDetails[2];
                        $PriceForregin = (double)$CurrenceyDetails[3];

                        $ItemCostInternational=$itemQtySum * $PriceForregin;

                        $ItemCostInternationalViewIndividual=number_format($ItemCostInternational,2);

                        $InternationalCost=$ItemCostInternationalViewIndividual;
                        
                        $CurrenceyView=$Currencey;
                        
                        
                        $PriceWithFandC = $ItemCostInternational + ($ItemCostInternational * ($FreightClearence / 100) );
                        $PriceWithFandCView = number_format($PriceWithFandC,2);
                        
                        
                    }
                    //
                    
                    
                }
                
                
                
            }else{

                $getItemCost = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemId' AND price_batch_id= '$priceBatchId' ");
                if($gic = $getItemCost->fetch_array()){
     
                    $itemCostPriceBatch=(double)$gic[3];
                    $PBInternationalOrNot=$gic[7];

                    $itemCostSum=$itemQtySum * $itemCostPriceBatch;

                    //International
                    if ($PBInternationalOrNot=='0') {
                        $CurrenceyView='-';
                        $InternationalCost='-';
                        $PriceWithFandCView='-';
            
                    }else{

                        $PBCurrenceyDetails = explode("_",$PBInternationalOrNot);
                        $PBCurrencey = $PBCurrenceyDetails[0];
                        $PBCurrenceyInLKR = (double)$PBCurrenceyDetails[1];
                        $PBFreightClearence = (double)$PBCurrenceyDetails[2];
                        $PBPriceForregin = (double)$PBCurrenceyDetails[3];

                        $PBItemCostInternational=$itemQtySum * $PBPriceForregin;

                        $PBItemCostViewInternational=number_format($PBItemCostInternational,2);

                        $InternationalCost=$PBItemCostViewInternational;
                        
                        
                        $CurrenceyView=$PBCurrencey;
                        
                        $PBPriceWithFandC = $PBItemCostInternational + ($PBItemCostInternational * ($PBFreightClearence / 100) );
                        $PriceWithFandCView = number_format($PBPriceWithFandC,2);
                    }
                    //

                }
                
                
                
                

            }
            

              
               array_push($itemsQtyList,$itemQtySum);

            //Calculation Start
            
            $TotalSellingValue = $itemQtySum * $itemSelling;
            
            $ItemDiscountValue = ($itemQtySum * $itemSelling) - (($itemQtySum * $itemSelling) * $itemDiscount)/100;
            
            $ItemDiscountDeference = (($itemQtySum * $itemSelling) * $itemDiscount)/100;
            
            $ItemDiscountDeferenceSum += $ItemDiscountDeference;
            
            
            //Start International Landing Calculations//
            $TotalPriceWithFandC += (double)$PriceWithFandCView;
            $TotalPriceWithFandCView = number_format($TotalPriceWithFandC,2);
            //End International Landing Calculations//
            
            
            // $itemCostSum=$itemQtySum * $itemCost;
            $itemIncomeSum=$ItemDiscountValue;
            //////////////////////
            $itemCostSumTotal += $itemCostSum;
            $itemIncomeSumTotal += $itemIncomeSum;
            //////////////////////
            $itemFullIncomeSumTotal=$itemIncomeSumTotal-$itemCostSumTotal;
            //Calculation End
            
            
            $itemCostSumView=number_format($itemCostSum,2);
            $itemTotalSellingValueView=number_format($TotalSellingValue,2);
            $itemIncomeSumView=number_format($itemIncomeSum,2);
            
            $itemCostSumTotalView=number_format($itemCostSumTotal,2);
            $itemIncomeSumTotalView=number_format($itemIncomeSumTotal,2);
            
            $itemFullIncomeSumTotalView=number_format($itemFullIncomeSumTotal,2);
            
            $itemDiscountDeferenceView=number_format($ItemDiscountDeference,2);
            
            $itemDiscountDeferenceSumView=number_format($ItemDiscountDeferenceSum,2);
            
            
            $itemCount+=1;
          
      $obj='
      
                                                                
      
      
            <tr>
                <td scope="row">'.$itemCount.'</td>
                <td>'.$itemName.'</td>
                <td>'.$itemNumber.'</td>
                <td style="text-align: center;"><font style="color: #03AC13; font-weight: 800;">'.$itemQtySum.'</font></td>
                <td style="text-align: center;"><font style="color: #00008B; font-weight: 800;">BAE/IN/'.$InvoiceYear.'/'.$InvoiceNumber.'</font></td>
                <td style="text-align: center;"><font style="color: #5C008B; font-weight: 800;">BAE/GRN/'.$GRNYear.'/'.$GRNNumber.'</font></td>
                <td style="text-align: center;"><font style="font-weight: 800;">'.$SupplierName.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$CurrenceyView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$InternationalCost.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$PriceWithFandCView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemCostSumView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemTotalSellingValueView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemDiscountDeferenceView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemIncomeSumView.'</font></td>
            </tr>
            
          ';

          array_push($datalist,$obj);
          
        
        ///
        }
        ///

      
    }
    
    
        $obj='
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$TotalPriceWithFandCView.'</font><br><font style="color: #FF0000;">International Landing</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemIncomeSumTotalView.'</font><br><font style="color: #FF0000;">Full Selling</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemCostSumTotalView.'</font><br><font style="color: #FF0000;">Full Cost</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemDiscountDeferenceSumView.'</font><br><font style="color: #FF0000;">Discount Value</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemFullIncomeSumTotalView.'</font><br><font style="color: #03AC13;">Full Income</font></td>
            </tr>
            
          ';

          array_push($datalistfoot,$obj);
          
          
          
          
          
          ///////////////Individual Part Selling Area//////////////////////
          
          
        $GetIndividualInvoicequery="SELECT part_selling_id,part_selling_datetime FROM tbl_part_selling_details WHERE pay = '1' AND DATE(part_selling_datetime) BETWEEN '$stock_start_date' AND '$stock_end_date' ";
        $getIndividualInvoice=$conn->query($GetIndividualInvoicequery);
        while ($gII=$getIndividualInvoice->fetch_array()) {
            
            $PartSellingId=$gII[0];
            $PartSellingDateTime=$gII[1];
            
            $PartInvoiceNumber = 10000+$PartSellingId;
                                                    
            $PartInvoiceYear = date('Y', strtotime($PartSellingDateTime));
        
        // $IndividualPartQuery="SELECT item_id,stat,part_real_price,part_discount, SUM(qty) FROM tbl_part_selling_list WHERE part_selling_id='$PartSellingId' GROUP BY item_id ORDER BY SUM(qty) DESC";
        $IndividualPartQuery="SELECT item_id,stat,part_real_price,part_discount,qty FROM tbl_part_selling_list WHERE part_selling_id='$PartSellingId' ORDER BY qty DESC";
        $getIndividualStocQty=$conn->query($IndividualPartQuery);
        while ($GIsq=$getIndividualStocQty->fetch_array()) {

          $itemIdIndividual=$GIsq[0];
          $priceBatchIdIndividual=$GIsq[1];
          $itemSellingIndividual=(double)$GIsq[2];
          $itemDiscountIndividual=(double)$GIsq[3];
          
          $itemQtySumIndividual=$GIsq[4];
          
          
          $getIndividualItemGRNPriceBatchDetails = $conn->query("SELECT * FROM tbl_grn_details tgd INNER JOIN tbl_grn_items tgi ON tgd.grn_detail_id=tgi.grn_detail_id WHERE tgi.item_id = '$itemIdIndividual' AND tgi.price_batch_id='$priceBatchIdIndividual' ORDER BY tgi.grn_items_id DESC LIMIT 1");
            if($giiGRNpbd = $getIndividualItemGRNPriceBatchDetails->fetch_array()){
       
                $IndividualGRNDetailId=$giiGRNpbd[0];
                $IndividualGRNDateTime=$giiGRNpbd[9];
                        
                $IndividualGRNNumber = 10000+$IndividualGRNDetailId;        
                $IndividualGRNYear = date('Y', strtotime($GRNDateTime)) ;
                
                $getIndividualSupplierName = $conn->query("SELECT * FROM tbl_supplier WHERE supplier_id = '$GRNSupplierId'");
                if($gisn = $getIndividualSupplierName->fetch_array()){
    
                    $IndividualSupplierName=$gisn[1];
    
                }
    
            }else{
                $IndividualGRNNumber ='OLD';
                $IndividualGRNYear ='2022';
                $IndividualSupplierName='No Supplier Data';
            }
        
            
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
                    $InternationalOrNotIndividual=$GIic[9];
                    $itemCostIndividual=(double)$GIic[13];

                    $itemCostSumIndividual=$itemQtySumIndividual * $itemCostIndividual;


                    //International
                    if ($InternationalOrNotIndividual=='1') {

                        $InternationalCostIndividual='-';
                        $CurrenceyIndividualView='-';
                        $PriceWithFandCIndividualView='-';
            
                    }else{

                        $CurrenceyDetailsIndividual = explode("_",$InternationalOrNotIndividual);
                        $CurrenceyIndividual = $CurrenceyDetailsIndividual[0];
                        $CurrenceyInLKRIndividual = (double)$CurrenceyDetailsIndividual[1];
                        $FreightClearenceIndividual = (double)$CurrenceyDetailsIndividual[2];
                        $PriceForreginIndividual = (double)$CurrenceyDetailsIndividual[3];

                        $ItemCostInternationalIndividual=$itemQtySumIndividual * $PriceForreginIndividual;

                        $ItemCostInternationalViewIndividual=number_format($ItemCostInternationalIndividual,2);

                        $InternationalCostIndividual=$ItemCostInternationalViewIndividual;
                        
                        $PriceWithFandCIndividual = $ItemCostInternationalIndividual + ($ItemCostInternationalIndividual * ($FreightClearenceIndividual / 100) );
                        $PriceWithFandCIndividualView=number_format($PriceWithFandCIndividual,2);
                        
                        $CurrenceyIndividualView = $CurrenceyIndividual;
                        
                        
                    }
                    //




                }
                
            }else{

                $getIndividualItemCost = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdIndividual' AND price_batch_id= '$priceBatchIdIndividual' ");
                if($GIic = $getIndividualItemCost->fetch_array()){
     
                    $itemCostPriceBatchIndividual=(double)$GIic[3];
                    $PBInternationalOrNotIndividual=$GIic[7];

                    $itemCostSumIndividual=$itemQtySumIndividual * $itemCostPriceBatchIndividual;


                    //International
                    if ($PBInternationalOrNotIndividual=='0') {

                        $InternationalCostIndividual='-';
                        $CurrenceyIndividualView='-';
                        $PriceWithFandCIndividualView='-';
            
                    }else{

                        $PBCurrenceyDetailsIndividual = explode("_",$PBInternationalOrNotIndividual);
                        $PBCurrenceyIndividual = $PBCurrenceyDetailsIndividual[0];
                        $PBCurrenceyInLKRIndividual = (double)$PBCurrenceyDetailsIndividual[1];
                        $PBFreightClearenceIndividual = (double)$PBCurrenceyDetailsIndividual[2];
                        $PBPriceForreginIndividual = (double)$PBCurrenceyDetailsIndividual[3];

                        $PBItemCostInternationalIndividual=$itemQtySumIndividual * $PBPriceForreginIndividual;

                        $PBItemCostInternationalViewIndividual=number_format($PBItemCostInternationalIndividual,2);

                        $InternationalCostIndividual=$PBItemCostInternationalViewIndividual;
                        
                        $PBPriceWithFandCIndividual = $PBItemCostInternationalIndividual + ($PBItemCostInternationalIndividual * ($PBFreightClearenceIndividual / 100) );
                        $PriceWithFandCIndividualView=number_format($PriceWithFandCIndividual,2);
                        
                        $CurrenceyIndividualView = $PBCurrenceyIndividual;
                    }
                    //


                }

            }
            

              
            //   array_push($itemsQtyList,$itemQtySum);

            //Calculation Start
            
            $TotalSellingValueIndividual = $itemQtySumIndividual * $itemSellingIndividual;
            
            $ItemDiscountValueIndividual = ($itemQtySumIndividual * $itemSellingIndividual) - (($itemQtySumIndividual * $itemSellingIndividual) * $itemDiscountIndividual)/100;
            
            $ItemDiscountDeferenceIndividual = (($itemQtySumIndividual * $itemSellingIndividual) * $itemDiscountIndividual)/100;
            
            $ItemDiscountDeferenceSumIndividual += $ItemDiscountDeferenceIndividual;
            
            //Start Induvidual International Landing Calculations//
            $TotalPriceWithFandCIndividual += (double)$PriceWithFandCIndividualView;
            $TotalPriceWithFandIndividualCView = number_format($TotalPriceWithFandCIndividual,2);
            //End Induvidual International Landing Calculations//
            
            
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
            
            
            $itemIndividualCount+=1;
          
      $obj='
      
                                                                
      
      
            <tr>
                <td scope="row">'.$itemIndividualCount.'</td>
                <td>'.$itemNameIndividual.'</td>
                <td>'.$itemNumberIndividual.'</td>
                <td style="text-align: center;"><font style="color: #03AC13; font-weight: 800;">'.$itemQtySumIndividual.'</font></td>
                <td style="text-align: center;"><font style="color: #00008B; font-weight: 800;">BAE/PIN/'.$PartInvoiceYear.'/'.$PartInvoiceNumber.'</font></td>
                <td style="text-align: center;"><font style="color: #5C008B; font-weight: 800;">BAE/GRN/'.$IndividualGRNYear.'/'.$IndividualGRNNumber.'</font></td>
                <td style="text-align: center;"><font style="font-weight: 800;">'.$IndividualSupplierName.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$CurrenceyIndividualView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$InternationalCostIndividual.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$PriceWithFandCIndividualView.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemCostSumViewIndividual.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemTotalSellingValueViewIndividual.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemDiscountDeferenceViewIndividual.'</font></td>
                <td style="text-align: right;"><font style="font-weight: 800;">'.$itemIncomeSumViewIndividual.'</font></td>
            </tr>
            
          ';

          array_push($datalistindividual,$obj);
          
        
        ///
        }
        ///

      
    }
    
    
        $obj='
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$TotalPriceWithFandIndividualCView.'</font><br><font style="color: #FF0000;">International Landing</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemIncomeSumTotalViewIndividual.'</font><br><font style="color: #FF0000;">Full Selling</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemCostSumTotalViewIndividual.'</font><br><font style="color: #FF0000;">Full Cost</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemDiscountDeferenceSumViewIndividual.'</font><br><font style="color: #FF0000;">Discount Value</font></td>
                <td style="text-align: right;"><font style="font-weight: 800; font-size: 20px;">'.$itemFullIncomeSumTotalViewIndividual.'</font><br><font style="color: #03AC13;">Full Income</font></td>
            </tr>
            
          ';

          array_push($datalistindividualfoot,$obj);
          
          
          
          
          
          
          
          
          
          
          
          
          
          
          


    $output['result']=true;
    $output['data']=$datalist;
    $output['datafoot']=$datalistfoot;
    
    $output['dataindividual']=$datalistindividual;
    $output['dataindividualfoot']=$datalistindividualfoot;
    

    $output['itemName'] = $itemsNameList;
    $output['itemQtySum'] = $itemsQtyList;




    }else{
        $output['result']=false;
        $output['data']="Invalid request.";
    }






   


    echo json_encode($output);
    
    
    