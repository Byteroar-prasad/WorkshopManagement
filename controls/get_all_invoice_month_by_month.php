<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    date_default_timezone_set('Asia/Colombo');
    // $currentDate=date('Y-m-d');
    //$today=date('Y-m-d');

    $output=[]; 
    $datalist=array();
    // $JanInvoice = array();
    // $FebInvoice = array();
    // $MarInvoice = array();
    // $AprInvoice = array();
    // $MayInvoice = array();
    // $JunInvoice = array();
    // $JulInvoice = array();
    // $AugInvoice = array();
    // $SepInvoice = array();
    // $OctInvoice = array();
    // $NovInvoice = array();
    // $DecInvoice = array();

    $summary = [];
    $summarynetincome = [];
    
    $itemCostSumTotalJan = 0;
    $itemIncomeSumTotalJan = 0;
    $SubletSumTotalJan = 0;
    $SubletCostSumTotalJan = 0;
    $NetJanIncome = 0;
    
    $itemCostSumTotalFeb = 0;
    $itemIncomeSumTotalFeb = 0;
    $SubletSumTotalFeb = 0;
    $SubletCostSumTotalFeb = 0;
    $NetFebIncome = 0;
    
    $itemCostSumTotalMar = 0;
    $itemIncomeSumTotalMar = 0;
    $SubletSumTotalMar = 0;
    $SubletCostSumTotalMar = 0;
    $NetMarIncome = 0;
    
    $itemCostSumTotalApr = 0;
    $itemIncomeSumTotalApr = 0;
    $SubletSumTotalApr = 0;
    $SubletCostSumTotalApr = 0;
    $NetAprIncome = 0;
    
    $itemCostSumTotalMay = 0;
    $itemIncomeSumTotalMay = 0;
    $SubletSumTotalMay = 0;
    $SubletCostSumTotalMay = 0;
    $NetMayIncome = 0;
    
    $itemCostSumTotalJun = 0;
    $itemIncomeSumTotalJun = 0;
    $SubletSumTotalJun = 0;
    $SubletCostSumTotalJun = 0;
    $NetJunIncome = 0;
    
    $itemCostSumTotalJul = 0;
    $itemIncomeSumTotalJul = 0;
    $SubletSumTotalJul = 0;
    $SubletCostSumTotalJul = 0;
    $NetJulIncome = 0;
    
    $itemCostSumTotalAug = 0;
    $itemIncomeSumTotalAug = 0;
    $SubletSumTotalAug = 0;
    $SubletCostSumTotalAug = 0;
    $NetAugIncome = 0;
    
    $itemCostSumTotalSep = 0;
    $itemIncomeSumTotalSep = 0;
    $SubletSumTotalSep = 0;
    $SubletCostSumTotalSep = 0;
    $NetSepIncome = 0;
    
    $itemCostSumTotalOct = 0;
    $itemIncomeSumTotalOct = 0;
    $SubletSumTotalOct = 0;
    $SubletCostSumTotalOct = 0;
    $NetOctIncome = 0;
    
    $itemCostSumTotalNov = 0;
    $itemIncomeSumTotalNov = 0;
    $SubletSumTotalNov = 0;
    $SubletCostSumTotalNov = 0;
    $NetNovIncome = 0;
    
    $itemCostSumTotalDec = 0;
    $itemIncomeSumTotalDec = 0;
    $SubletSumTotalDec = 0;
    $SubletCostSumTotalDec = 0;
    $NetDecIncome = 0;


    //////////////////Jan Month//////////////////////////
    $jan = date("Y-01");
    $getJanMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$jan%'");
    if($gjm = $getJanMonthQuary->fetch_array()){
            $jan_invoice = $gjm[0];
            $summary['jan'] = $jan_invoice;

            // array_push($JanInvoice,$jan_invoice);
    }
    
    
    //get labour Jan income/////////
    $getJanLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$jan%'");
    if($lijan = $getJanLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourJanIncome = $lijan[0];
    }
    ////////////////////////
    
    
    
    ////////////////////////////////////////
        $GetJanInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$jan%' ";
        $getJanInvoice=$conn->query($GetJanInvoicequery);
        while ($gIJan=$getJanInvoice->fetch_array()) {
            
            $jobIdJan=$gIJan[0];
        
        
        $Janquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdJan' ORDER BY qty DESC";
        $getStocQtyJan=$conn->query($Janquery);
        while ($sq=$getStocQtyJan->fetch_array()) {

          $itemIdJan=$sq[0];
          $priceBatchIdJan=$sq[1];
          $itemSellingJan=(double)$sq[2];
          $itemDiscountJan=(double)$sq[3];
          $itemQtySumJan=$sq[4];

            if ($priceBatchIdJan == 0) {

                $getItemCostJan = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdJan'");
                if($gicJan = $getItemCostJan->fetch_array()){
                    $itemCostJan=(double)$gicJan[13];
                    $itemCostSumJan=$itemQtySumJan * $itemCostJan;
                }
                
            }else{

                $getItemCostJan = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdJan' AND price_batch_id= '$priceBatchIdJan' ");
                if($gicJan = $getItemCostJan->fetch_array()){
                    $itemCostPriceBatchJan=(double)$gicJan[3];
                    $itemCostSumJan=$itemQtySumJan * $itemCostPriceBatchJan;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueJan = ($itemQtySumJan * $itemSellingJan) - (($itemQtySumJan * $itemSellingJan) * $itemDiscountJan)/100;
            
            $itemIncomeSumJan= $ItemDiscountValueJan;
            //////////////////////
            $itemCostSumTotalJan += $itemCostSumJan;
            $itemIncomeSumTotalJan += $itemIncomeSumJan;
            //////////////////////
            $itemFullIncomeSumTotalJan=$itemIncomeSumTotalJan-$itemCostSumTotalJan;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletJanquery="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdJan' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletJanQuery=$conn->query($SubletJanquery);
        while ($GSsqJan=$getSubletJanQuery->fetch_array()) {
            
            $SubletSumJan=$GSsqJan[0];
            $SubletCostSumJan=$GSsqJan[1];
            
            $SubletSumTotalJan += $SubletSumJan;
            $SubletCostSumTotalJan += $SubletCostSumJan;

        }
        
        $TotalJanRevenue = $itemIncomeSumTotalJan + $labourJanIncome + $SubletSumTotalJan;
        $NetJanIncome = $TotalJanRevenue - $itemCostSumTotalJan - $SubletCostSumTotalJan;
    
      
    }
    
    $summarynetincome['jan'] = $NetJanIncome;
    
    
    //////////////////////////////////////
    
    

    //////////////////Feb Month//////////////////////////
    $feb = date("Y-02");
    $getFebMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND ti.datetime LIKE '%$feb%'");
    if($gfm = $getFebMonthQuary->fetch_array()){
            $feb_invoice = $gfm[0];
            $summary['feb'] = $feb_invoice;

                // array_push($FebInvoice,$feb_invoice);
    }
    
    
    //get labour Feb income/////////
    $getFebLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$feb%'");
    if($lifeb = $getFebLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourFebIncome = $lifeb[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetFebInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$feb%' ";
        $getFebInvoice=$conn->query($GetFebInvoicequery);
        while ($gIFeb=$getFebInvoice->fetch_array()) {
            
            $jobIdFeb=$gIFeb[0];
        
        
        $Febquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdFeb' ORDER BY qty DESC";
        $getStocQtyFeb=$conn->query($Febquery);
        while ($sqFeb=$getStocQtyFeb->fetch_array()) {

          $itemIdFeb=$sqFeb[0];
          $priceBatchIdFeb=$sqFeb[1];
          $itemSellingFeb=(double)$sqFeb[2];
          $itemDiscountFeb=(double)$sqFeb[3];
          $itemQtySumFeb=$sqFeb[4];

            if ($priceBatchIdFeb == 0) {

                $getItemCostFeb = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdFeb'");
                if($gicFeb = $getItemCostFeb->fetch_array()){
                    $itemCostFeb=(double)$gicFeb[13];
                    $itemCostSumFeb=$itemQtySumFeb * $itemCostFeb;
                }
                
            }else{

                $getItemCostFeb = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdFeb' AND price_batch_id= '$priceBatchIdFeb' ");
                if($gicFeb = $getItemCostFeb->fetch_array()){
                    $itemCostPriceBatchFeb=(double)$gicFeb[3];
                    $itemCostSumFeb=$itemQtySumFeb * $itemCostPriceBatchFeb;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueFeb = ($itemQtySumFeb * $itemSellingFeb) - (($itemQtySumFeb * $itemSellingFeb) * $itemDiscountFeb)/100;
            
            $itemIncomeSumFeb= $ItemDiscountValueFeb;
            //////////////////////
            $itemCostSumTotalFeb += $itemCostSumFeb;
            $itemIncomeSumTotalFeb += $itemIncomeSumFeb;
            //////////////////////
            $itemFullIncomeSumTotalFeb=$itemIncomeSumTotalFeb-$itemCostSumTotalFeb;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletFeb="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdFeb' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletFebQuery=$conn->query($SubletFeb);
        while ($GSsqFeb=$getSubletFebQuery->fetch_array()) {
            
            $SubletSumFeb=$GSsqFeb[0];
            $SubletCostSumFeb=$GSsqFeb[1];
            
            $SubletSumTotalFeb += $SubletSumFeb;
            $SubletCostSumTotalFeb += $SubletCostSumFeb;

        }
        
        $TotalFebRevenue = $itemIncomeSumTotalFeb + $labourFebIncome + $SubletSumTotalFeb;
        $NetFebIncome = $TotalFebRevenue - $itemCostSumTotalFeb - $SubletCostSumTotalFeb;
    
      
    }
    
    $summarynetincome['feb'] = $NetFebIncome;
    
    //////////////////////////////////////
    
    

    //////////////////Mar Month//////////////////////////
    $mar = date("Y-03");
    $getMarMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$mar%'");
    if($gmm = $getMarMonthQuary->fetch_array()){
            $mar_invoice = $gmm[0];
            $summary['mar'] = $mar_invoice;

                // array_push($MarInvoice,$mar_invoice);
    }
    
    
    
    
    
    //get labour Mar income/////////
    $getMarLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$mar%'");
    if($limar = $getMarLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourMarIncome = $limar[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetMarInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$mar%' ";
        $getMarInvoice=$conn->query($GetMarInvoicequery);
        while ($gIMar=$getMarInvoice->fetch_array()) {
            
            $jobIdMar=$gIMar[0];
        
        
        $Marquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdMar' ORDER BY qty DESC";
        $getStocQtyMar=$conn->query($Marquery);
        while ($sqMar=$getStocQtyMar->fetch_array()) {

          $itemIdMar=$sqMar[0];
          $priceBatchIdMar=$sqMar[1];
          $itemSellingMar=(double)$sqMar[2];
          $itemDiscountMar=(double)$sqMar[3];
          $itemQtySumMar=$sqMar[4];

            if ($priceBatchIdMar == 0) {

                $getItemCostMar = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdMar'");
                if($gicMar = $getItemCostMar->fetch_array()){
                    $itemCostMar=(double)$gicMar[13];
                    $itemCostSumMar=$itemQtySumMar * $itemCostMar;
                }
                
            }else{

                $getItemCostMar = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdMar' AND price_batch_id= '$priceBatchIdMar' ");
                if($gicMar = $getItemCostMar->fetch_array()){
                    $itemCostPriceBatchMar=(double)$gicMar[3];
                    $itemCostSumMar=$itemQtySumMar * $itemCostPriceBatchMar;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueMar = ($itemQtySumMar * $itemSellingMar) - (($itemQtySumMar * $itemSellingMar) * $itemDiscountMar)/100;
            
            $itemIncomeSumMar= $ItemDiscountValueMar;
            //////////////////////
            $itemCostSumTotalMar += $itemCostSumMar;
            $itemIncomeSumTotalMar += $itemIncomeSumMar;
            //////////////////////
            $itemFullIncomeSumTotalMar=$itemIncomeSumTotalMar-$itemCostSumTotalMar;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletMar="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdMar' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletMarQuery=$conn->query($SubletMar);
        while ($GSsqMar=$getSubletMarQuery->fetch_array()) {
            
            $SubletSumMar=$GSsqMar[0];
            $SubletSumTotalMar += $SubletSumMar;
            
            $SubletCostSumMar=$GSsqMar[1];
            $SubletCostSumTotalMar += $SubletCostSumMar;

        }
        
        $TotalMarRevenue = $itemIncomeSumTotalMar + $labourMarIncome + $SubletSumTotalMar;
        $NetMarIncome = $TotalMarRevenue - $itemCostSumTotalMar - $SubletCostSumTotalMar;
    
      
    }
    
    $summarynetincome['mar'] = $NetMarIncome;
    
    //////////////////////////////////////
    
    
    
    

    

    //////////////////Apr Month//////////////////////////
    $apr = date("Y-04");
    $getAprMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$apr%'");
    if($gam = $getAprMonthQuary->fetch_array()){
            $apr_invoice = $gam[0];
            $summary['apr'] = $apr_invoice;

                // array_push($AprInvoice,$apr_invoice);
    }
    
    
    
    
    //get labour Apr income/////////
    $getAprLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$apr%'");
    if($liapr = $getAprLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourAprIncome = $liapr[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetAprInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$apr%' ";
        $getAprInvoice=$conn->query($GetAprInvoicequery);
        while ($gIApr=$getAprInvoice->fetch_array()) {
            
            $jobIdApr=$gIApr[0];
        
        
        $Aprquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdApr' ORDER BY qty DESC";
        $getStocQtyApr=$conn->query($Aprquery);
        while ($sqApr=$getStocQtyApr->fetch_array()) {

          $itemIdApr=$sqApr[0];
          $priceBatchIdApr=$sqApr[1];
          $itemSellingApr=(double)$sqApr[2];
          $itemDiscountApr=(double)$sqApr[3];
          $itemQtySumApr=$sqApr[4];

            if ($priceBatchIdApr == 0) {

                $getItemCostApr = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdApr'");
                if($gicApr = $getItemCostApr->fetch_array()){
                    $itemCostApr=(double)$gicApr[13];
                    $itemCostSumApr=$itemQtySumApr * $itemCostApr;
                }
                
            }else{

                $getItemCostApr = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdApr' AND price_batch_id= '$priceBatchIdApr' ");
                if($gicApr = $getItemCostApr->fetch_array()){
                    $itemCostPriceBatchApr=(double)$gicApr[3];
                    $itemCostSumApr=$itemQtySumApr * $itemCostPriceBatchApr;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueApr = ($itemQtySumApr * $itemSellingApr) - (($itemQtySumApr * $itemSellingApr) * $itemDiscountApr)/100;
            
            $itemIncomeSumApr= $ItemDiscountValueApr;
            //////////////////////
            $itemCostSumTotalApr += $itemCostSumApr;
            $itemIncomeSumTotalApr += $itemIncomeSumApr;
            //////////////////////
            $itemFullIncomeSumTotalApr=$itemIncomeSumTotalApr-$itemCostSumTotalApr;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletApr="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdApr' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletAprQuery=$conn->query($SubletApr);
        while ($GSsqApr=$getSubletAprQuery->fetch_array()) {
            
            $SubletSumApr=$GSsqApr[0];
            $SubletSumTotalApr += $SubletSumApr;
            
            $SubletCostSumApr=$GSsqApr[1];
            $SubletCostSumTotalApr += $SubletCostSumApr;

        }
        
        $TotalAprRevenue = $itemIncomeSumTotalApr + $labourAprIncome + $SubletSumTotalApr;
        $NetAprIncome = $TotalAprRevenue - $itemCostSumTotalApr + $SubletCostSumTotalApr;
    
      
    }
    
    $summarynetincome['apr'] = $NetAprIncome;
    
    //////////////////////////////////////
    
    
    
    
    
    
    
    
    

    //////////////////May Month//////////////////////////
    $may = date("Y-05");
    $getMayMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$may%'");
    if($gmam = $getMayMonthQuary->fetch_array()){
            $may_invoice = $gmam[0];
            $summary['may'] = $may_invoice;

                // array_push($MayInvoice,$may_invoice);
    }
    
    
    //get labour May income/////////
    $getMayLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$may%'");
    if($liMay = $getMayLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourMayIncome = $liMay[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetMayInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$may%' ";
        $getMayInvoice=$conn->query($GetMayInvoicequery);
        while ($gIMay=$getMayInvoice->fetch_array()) {
            
            $jobIdMay=$gIMay[0];
        
        
        $Mayquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdMay' ORDER BY qty DESC";
        $getStocQtyMay=$conn->query($Mayquery);
        while ($sqMay=$getStocQtyMay->fetch_array()) {

          $itemIdMay=$sqMay[0];
          $priceBatchIdMay=$sqMay[1];
          $itemSellingMay=(double)$sqMay[2];
          $itemDiscountMay=(double)$sqMay[3];
          $itemQtySumMay=$sqMay[4];

            if ($priceBatchIdMay == 0) {

                $getItemCostMay = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdMay'");
                if($gicMay = $getItemCostMay->fetch_array()){
                    $itemCostMay=(double)$gicMay[13];
                    $itemCostSumMay=$itemQtySumMay * $itemCostMay;
                }
                
            }else{

                $getItemCostMay = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdMay' AND price_batch_id= '$priceBatchIdMay' ");
                if($gicMay = $getItemCostMay->fetch_array()){
                    $itemCostPriceBatchMay=(double)$gicMay[3];
                    $itemCostSumMay=$itemQtySumMay * $itemCostPriceBatchMay;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueMay = ($itemQtySumMay * $itemSellingMay) - (($itemQtySumMay * $itemSellingMay) * $itemDiscountMay)/100;
            
            $itemIncomeSumMay= $ItemDiscountValueMay;
            //////////////////////
            $itemCostSumTotalMay += $itemCostSumMay;
            $itemIncomeSumTotalMay += $itemIncomeSumMay;
            //////////////////////
            $itemFullIncomeSumTotalMay=$itemIncomeSumTotalMay-$itemCostSumTotalMay;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletMay="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdMay' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletMayQuery=$conn->query($SubletMay);
        while ($GSsqMay=$getSubletMayQuery->fetch_array()) {
            
            $SubletSumMay=$GSsqMay[0];
            $SubletSumTotalMay += $SubletSumMay;
            
            $SubletCostSumMay=$GSsqMay[1];
            $SubletCostSumTotalMay += $SubletCostSumMay;

        }
        
        $TotalMayRevenue = $itemIncomeSumTotalMay + $labourMayIncome + $SubletSumTotalMay;
        $NetMayIncome = $TotalMayRevenue - $itemCostSumTotalMay - $SubletCostSumTotalMay;
    
      
    }
    
    $summarynetincome['may'] = $NetMayIncome;
    
    //////////////////////////////////////
    
    
    
    
    
    

    //////////////////Jun Month//////////////////////////
    $jun = date("Y-06");
    $getJunMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND ti.datetime LIKE '%$jun%'");
    if($gjum = $getJunMonthQuary->fetch_array()){
            $jun_invoice = $gjum[0];
            $summary['jun'] = $jun_invoice;

                // array_push($JunInvoice,$jun_invoice);
    }
    
    
    //get labour Jun income/////////
    $getJunLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$jun%'");
    if($liJun = $getJunLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourJunIncome = $liJun[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetJunInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$jun%' ";
        $getJunInvoice=$conn->query($GetJunInvoicequery);
        while ($gIJun=$getJunInvoice->fetch_array()) {
            
            $jobIdJun=$gIJun[0];
        
        
        $Junquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdJun' ORDER BY qty DESC";
        $getStocQtyJun=$conn->query($Junquery);
        while ($sqJun=$getStocQtyJun->fetch_array()) {

          $itemIdJun=$sqJun[0];
          $priceBatchIdJun=$sqJun[1];
          $itemSellingJun=(double)$sqJun[2];
          $itemDiscountJun=(double)$sqJun[3];
          $itemQtySumJun=$sqJun[4];

            if ($priceBatchIdJun == 0) {

                $getItemCostJun = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdJun'");
                if($gicJun = $getItemCostJun->fetch_array()){
                    $itemCostJun=(double)$gicJun[13];
                    $itemCostSumJun=$itemQtySumJun * $itemCostJun;
                }
                
            }else{

                $getItemCostJun = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdJun' AND price_batch_id= '$priceBatchIdJun' ");
                if($gicJun = $getItemCostJun->fetch_array()){
                    $itemCostPriceBatchJun=(double)$gicJun[3];
                    $itemCostSumJun=$itemQtySumJun * $itemCostPriceBatchJun;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueJun = ($itemQtySumJun * $itemSellingJun) - (($itemQtySumJun * $itemSellingJun) * $itemDiscountJun)/100;
            
            $itemIncomeSumJun= $ItemDiscountValueJun;
            //////////////////////
            $itemCostSumTotalJun += $itemCostSumJun;
            $itemIncomeSumTotalJun += $itemIncomeSumJun;
            //////////////////////
            $itemFullIncomeSumTotalJun=$itemIncomeSumTotalJun-$itemCostSumTotalJun;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletJun="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdJun' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletJunQuery=$conn->query($SubletJun);
        while ($GSsqJun=$getSubletJunQuery->fetch_array()) {
            
            $SubletSumJun=$GSsqJun[0];
            $SubletSumTotalJun += $SubletSumJun;
            
            $SubletCostSumJun=$GSsqJun[1];
            $SubletCostSumTotalJun += $SubletCostSumJun;

        }
        
        $TotalJunRevenue = $itemIncomeSumTotalJun + $labourJunIncome + $SubletSumTotalJun;
        $NetJunIncome = $TotalJunRevenue - $itemCostSumTotalJun - $SubletCostSumTotalJun;
    
      
    }
    
    $summarynetincome['jun'] = $NetJunIncome;
    
    //////////////////////////////////////
    
    
    
    
    
    
    

    //////////////////Jul Month//////////////////////////
    $jul = date("Y-07");
    $getJulMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$jul%'");
    if($gjulm = $getJulMonthQuary->fetch_array()){
            $jul_invoice = $gjulm[0];
            $summary['jul'] = $jul_invoice;

                // array_push($JulInvoice,$jul_invoice);
    }
    
    
    //get labour Jul income/////////
    $getJulLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$jul%'");
    if($liJul = $getJulLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourJulIncome = $liJul[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetJulInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$jul%' ";
        $getJulInvoice=$conn->query($GetJulInvoicequery);
        while ($gIJul=$getJulInvoice->fetch_array()) {
            
            $jobIdJul=$gIJul[0];
        
        
        $Julquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdJul' ORDER BY qty DESC";
        $getStocQtyJul=$conn->query($Julquery);
        while ($sqJul=$getStocQtyJul->fetch_array()) {

          $itemIdJul=$sqJul[0];
          $priceBatchIdJul=$sqJul[1];
          $itemSellingJul=(double)$sqJul[2];
          $itemDiscountJul=(double)$sqJul[3];
          $itemQtySumJul=$sqJul[4];

            if ($priceBatchIdJul == 0) {

                $getItemCostJul = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdJul'");
                if($gicJul = $getItemCostJul->fetch_array()){
                    $itemCostJul=(double)$gicJul[13];
                    $itemCostSumJul=$itemQtySumJul * $itemCostJul;
                }
                
            }else{

                $getItemCostJul = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdJul' AND price_batch_id= '$priceBatchIdJul' ");
                if($gicJul = $getItemCostJul->fetch_array()){
                    $itemCostPriceBatchJul=(double)$gicJul[3];
                    $itemCostSumJul=$itemQtySumJul * $itemCostPriceBatchJul;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueJul = ($itemQtySumJul * $itemSellingJul) - (($itemQtySumJul * $itemSellingJul) * $itemDiscountJul)/100;
            
            $itemIncomeSumJul= $ItemDiscountValueJul;
            //////////////////////
            $itemCostSumTotalJul += $itemCostSumJul;
            $itemIncomeSumTotalJul += $itemIncomeSumJul;
            //////////////////////
            $itemFullIncomeSumTotalJul=$itemIncomeSumTotalJul-$itemCostSumTotalJul;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletJul="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdJul' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletJulQuery=$conn->query($SubletJul);
        while ($GSsqJul=$getSubletJulQuery->fetch_array()) {
            
            $SubletSumJul=$GSsqJul[0];
            $SubletSumTotalJul += $SubletSumJul;
            
            $SubletCostSumJul=$GSsqJul[1];
            $SubletCostSumTotalJul += $SubletCostSumJul;

        }
        
        $TotalJulRevenue = $itemIncomeSumTotalJul + $labourJulIncome + $SubletSumTotalJul;
        $NetJulIncome = $TotalJulRevenue - $itemCostSumTotalJul - $SubletCostSumTotalJul;
    
      
    }
    
    $summarynetincome['jul'] = $NetJulIncome;
    
    //////////////////////////////////////
    
    
    

    //////////////////Aug Month//////////////////////////
    $aug = date("Y-08");
    $getAugMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$aug%'");
    if($gaum = $getAugMonthQuary->fetch_array()){
            $aug_invoice = $gaum[0];
            $summary['aug'] = $aug_invoice;

                // array_push($AugInvoice,$aug_invoice);
    }
    
    
    
    //get labour Aug income/////////
    $getAugLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$aug%'");
    if($liAug = $getAugLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourAugIncome = $liAug[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetAugInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$aug%' ";
        $getAugInvoice=$conn->query($GetAugInvoicequery);
        while ($gIAug=$getJulInvoice->fetch_array()) {
            
            $jobIdAug=$gIAug[0];
        
        
        $Augquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdAug' ORDER BY qty DESC";
        $getStocQtyAug=$conn->query($Augquery);
        while ($sqAug=$getStocQtyAug->fetch_array()) {

          $itemIdAug=$sqAug[0];
          $priceBatchIdAug=$sqAug[1];
          $itemSellingAug=(double)$sqAug[2];
          $itemDiscountAug=(double)$sqAug[3];
          $itemQtySumAug=$sqAug[4];

            if ($priceBatchIdAug == 0) {

                $getItemCostAug = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdAug'");
                if($gicAug = $getItemCostAug->fetch_array()){
                    $itemCostAug=(double)$gicAug[13];
                    $itemCostSumAug=$itemQtySumAug * $itemCostAug;
                }
                
            }else{

                $getItemCostAug = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdAug' AND price_batch_id= '$priceBatchIdAug' ");
                if($gicAug = $getItemCostAug->fetch_array()){
                    $itemCostPriceBatchAug=(double)$gicAug[3];
                    $itemCostSumAug=$itemQtySumAug * $itemCostPriceBatchAug;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueAug = ($itemQtySumAug * $itemSellingAug) - (($itemQtySumAug * $itemSellingAug) * $itemDiscountAug)/100;
            
            $itemIncomeSumAug= $ItemDiscountValueAug;
            //////////////////////
            $itemCostSumTotalAug += $itemCostSumAug;
            $itemIncomeSumTotalAug += $itemIncomeSumAug;
            //////////////////////
            $itemFullIncomeSumTotalAug=$itemIncomeSumTotalAug-$itemCostSumTotalAug;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletAug="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdAug' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletAugQuery=$conn->query($SubletAug);
        while ($GSsqAug=$getSubletAugQuery->fetch_array()) {
            
            $SubletSumAug=$GSsqAug[0];
            $SubletSumTotalAug += $SubletSumAug;
            
            $SubletCostSumAug=$GSsqAug[1];
            $SubletCostSumTotalAug += $SubletCostSumAug;

        }
        
        $TotalAugRevenue = $itemIncomeSumTotalAug + $labourAugIncome + $SubletSumTotalAug;
        $NetAugIncome = $TotalAugRevenue - $itemCostSumTotalAug - $SubletCostSumTotalAug;
    
      
    }
    
    $summarynetincome['aug'] = $NetAugIncome;
    
    //////////////////////////////////////
    
    
    
    
    

    //////////////////Sep Month//////////////////////////
    $sep = date("Y-09");
    $getSepMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$sep%'");
    if($gsm = $getSepMonthQuary->fetch_array()){
            $sep_invoice = $gsm[0];
            $summary['sep'] = $sep_invoice;

                // array_push($SepInvoice,$sep_invoice);
    }
    
    
    //get labour Sep income/////////
    $getSepLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$sep%'");
    if($liSep = $getSepLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourSepIncome = $liSep[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetSepInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$sep%' ";
        $getSepInvoice=$conn->query($GetSepInvoicequery);
        while ($gISep=$getSepInvoice->fetch_array()) {
            
            $jobIdSep=$gISep[0];
        
        
        $Sepquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdSep' ORDER BY qty DESC";
        $getStocQtySep=$conn->query($Sepquery);
        while ($sqSep=$getStocQtySep->fetch_array()) {

          $itemIdSep=$sqSep[0];
          $priceBatchIdSep=$sqSep[1];
          $itemSellingSep=(double)$sqSep[2];
          $itemDiscountSep=(double)$sqSep[3];
          $itemQtySumSep=$sqSep[4];

            if ($priceBatchIdSep == 0) {

                $getItemCostSep = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdSep'");
                if($gicSep = $getItemCostSep->fetch_array()){
                    $itemCostSep=(double)$gicSep[13];
                    $itemCostSumSep=$itemQtySumSep * $itemCostSep;
                }
                
            }else{

                $getItemCostSep = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdSep' AND price_batch_id= '$priceBatchIdSep' ");
                if($gicSep = $getItemCostSep->fetch_array()){
                    $itemCostPriceBatchSep=(double)$gicSep[3];
                    $itemCostSumSep=$itemQtySumSep * $itemCostPriceBatchSep;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueSep = ($itemQtySumSep * $itemSellingSep) - (($itemQtySumSep * $itemSellingSep) * $itemDiscountSep)/100;
            
            $itemIncomeSumSep= $ItemDiscountValueSep;
            //////////////////////
            $itemCostSumTotalSep += $itemCostSumSep;
            $itemIncomeSumTotalSep += $itemIncomeSumSep;
            //////////////////////
            $itemFullIncomeSumTotalSep=$itemIncomeSumTotalSep-$itemCostSumTotalSep;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletSep="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdSep' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletSepQuery=$conn->query($SubletSep);
        while ($GSsqSep=$getSubletSepQuery->fetch_array()) {
            
            $SubletSumSep=$GSsqSep[0];
            $SubletSumTotalSep += $SubletSumSep;
            
            $SubletCostSumSep=$GSsqSep[1];
            $SubletCostSumTotalSep += $SubletCostSumSep;

        }
        
        $TotalSepRevenue = $itemIncomeSumTotalSep + $labourSepIncome + $SubletSumTotalSep;
        $NetSepIncome = $TotalSepRevenue - $itemCostSumTotalSep - $SubletCostSumTotalSep;
    
      
    }
    
    $summarynetincome['sep'] = $NetSepIncome;
    
    //////////////////////////////////////
    
    
    
    

    //////////////////Oct Month//////////////////////////
    $oct = date("Y-10");
    $getOctMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$oct%'");
    if($gom = $getOctMonthQuary->fetch_array()){
            $oct_invoice = $gom[0];
            $summary['oct'] = $oct_invoice;

                // array_push($OctInvoice,$oct_invoice);
    }
    
    
    
    
    
    
    //get labour Oct income/////////
    $getOctLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$oct%'");
    if($liOct = $getOctLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourOctIncome = $liOct[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetOctInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$oct%' ";
        $getOctInvoice=$conn->query($GetOctInvoicequery);
        while ($gIOct=$getOctInvoice->fetch_array()) {
            
            $jobIdOct=$gIOct[0];
        
        
        $Octquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdOct' ORDER BY qty DESC";
        $getStocQtyOct=$conn->query($Octquery);
        while ($sqOct=$getStocQtyOct->fetch_array()) {

          $itemIdOct=$sqOct[0];
          $priceBatchIdOct=$sqOct[1];
          $itemSellingOct=(double)$sqOct[2];
          $itemDiscountOct=(double)$sqOct[3];
          $itemQtySumOct=$sqOct[4];

            if ($priceBatchIdOct == 0) {

                $getItemCostOct = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdOct'");
                if($gicOct = $getItemCostOct->fetch_array()){
                    $itemCostOct=(double)$gicOct[13];
                    $itemCostSumOct=$itemQtySumOct * $itemCostOct;
                }
                
            }else{

                $getItemCostOct = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdOct' AND price_batch_id= '$priceBatchIdOct' ");
                if($gicOct = $getItemCostOct->fetch_array()){
                    $itemCostPriceBatchOct=(double)$gicOct[3];
                    $itemCostSumOct=$itemQtySumOct * $itemCostPriceBatchOct;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueOct = ($itemQtySumOct * $itemSellingOct) - (($itemQtySumOct * $itemSellingOct) * $itemDiscountOct)/100;
            
            $itemIncomeSumOct= $ItemDiscountValueOct;
            //////////////////////
            $itemCostSumTotalOct += $itemCostSumOct;
            $itemIncomeSumTotalOct += $itemIncomeSumOct;
            //////////////////////
            $itemFullIncomeSumTotalOct=$itemIncomeSumTotalOct-$itemCostSumTotalOct;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletOct="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdOct' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletOctQuery=$conn->query($SubletOct);
        while ($GSsqOct=$getSubletOctQuery->fetch_array()) {
            
            $SubletSumOct=$GSsqOct[0];
            $SubletSumTotalOct += $SubletSumOct;
            
            $SubletCostSumOct=$GSsqOct[1];
            $SubletCostSumTotalOct += $SubletCostSumOct;

        }
        
        $TotalOctRevenue = $itemIncomeSumTotalOct + $labourOctIncome + $SubletSumTotalOct;
        $NetOctIncome = $TotalOctRevenue - $itemCostSumTotalOct - $SubletCostSumTotalOct;
    
      
    }
    
    $summarynetincome['oct'] = $NetOctIncome;
    
    //////////////////////////////////////
    
    
    
    
    
    

    //////////////////Nov Month//////////////////////////
    $nov = date("Y-11");
    $getNovMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$nov%'");
    if($gnm = $getNovMonthQuary->fetch_array()){
            $nov_invoice = $gnm[0];
            $summary['nov'] = $nov_invoice;
                // array_push($NovInvoice,$nov_invoice);
    }
    
    
    
    
    //get labour Nov income/////////
    $getNovLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$nov%'");
    if($liNov = $getNovLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourNovIncome = $liNov[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetNovInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$nov%' ";
        $getNovInvoice=$conn->query($GetNovInvoicequery);
        while ($gINov=$getNovInvoice->fetch_array()) {
            
            $jobIdNov=$gINov[0];
        
        
        $Novquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdNov' ORDER BY qty DESC";
        $getStocQtyNov=$conn->query($Novquery);
        while ($sqNov=$getStocQtyNov->fetch_array()) {

          $itemIdNov=$sqNov[0];
          $priceBatchIdNov=$sqNov[1];
          $itemSellingNov=(double)$sqNov[2];
          $itemDiscountNov=(double)$sqNov[3];
          $itemQtySumNov=$sqNov[4];

            if ($priceBatchIdNov == 0) {

                $getItemCostNov = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdNov'");
                if($gicNov = $getItemCostNov->fetch_array()){
                    $itemCostNov=(double)$gicNov[13];
                    $itemCostSumNov=$itemQtySumNov * $itemCostNov;
                }
                
            }else{

                $getItemCostNov = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdNov' AND price_batch_id= '$priceBatchIdNov' ");
                if($gicNov = $getItemCostNov->fetch_array()){
                    $itemCostPriceBatchNov=(double)$gicNov[3];
                    $itemCostSumNov=$itemQtySumNov * $itemCostPriceBatchNov;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueNov = ($itemQtySumNov * $itemSellingNov) - (($itemQtySumNov * $itemSellingNov) * $itemDiscountNov)/100;
            
            $itemIncomeSumNov= $ItemDiscountValueNov;
            //////////////////////
            $itemCostSumTotalNov += $itemCostSumNov;
            $itemIncomeSumTotalNov += $itemIncomeSumNov;
            //////////////////////
            $itemFullIncomeSumTotalNov=$itemIncomeSumTotalNov-$itemCostSumTotalNov;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletNov="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdNov' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletNovQuery=$conn->query($SubletNov);
        while ($GSsqNov=$getSubletNovQuery->fetch_array()) {
            
            $SubletSumNov=$GSsqNov[0];
            $SubletSumTotalNov += $SubletSumNov;
            
            $SubletCostSumNov=$GSsqNov[1];
            $SubletCostSumTotalNov += $SubletCostSumNov;

        }
        
        $TotalNovRevenue = $itemIncomeSumTotalNov + $labourNovIncome + $SubletSumTotalNov;
        $NetNovIncome = $TotalNovRevenue - $itemCostSumTotalNov - $SubletCostSumTotalNov;
    
      
    }
    
    $summarynetincome['nov'] = $NetNovIncome;
    
    //////////////////////////////////////
    
    
    
    
    

    //////////////////Dec Month//////////////////////////
    $dec = date("Y-12");
    $getDecMonthQuary = $conn->query("SELECT SUM(ti.grand_total) FROM tbl_invoice ti WHERE ti.pay='1' AND  ti.datetime LIKE '%$dec%'");
    if($gdm = $getDecMonthQuary->fetch_array()){
            $dec_invoice = $gdm[0];
            $summary['dec'] = $dec_invoice;

                // array_push($DecInvoice,$dec_invoice);
    }
    
    
    
    //get labour Dec income/////////
    $getDecLabour = $conn->query("SELECT SUM(ti.labour_total) FROM tbl_invoice ti WHERE ti.pay = '1' AND ti.datetime LIKE '%$dec%'");
    if($liDec = $getDecLabour->fetch_array()){
        // $labourIncome = number_format($li[0],2);
        $labourDecIncome = $liDec[0];
    }
    ////////////////////////
    
    
    ////////////////////////////////////////
        $GetDecInvoicequery="SELECT invoice_id FROM tbl_invoice WHERE pay = '1' AND datetime LIKE '%$dec%' ";
        $getDecInvoice=$conn->query($GetDecInvoicequery);
        while ($gIDec=$getDecInvoice->fetch_array()) {
            
            $jobIdDec=$gIDec[0];
        
        
        $Decquery="SELECT item_id,stat,price,part_discount,qty FROM tbl_job_item WHERE job_id='$jobIdDec' ORDER BY qty DESC";
        $getStocQtyDec=$conn->query($Decquery);
        while ($sqDec=$getStocQtyDec->fetch_array()) {

          $itemIdDec=$sqDec[0];
          $priceBatchIdDec=$sqDec[1];
          $itemSellingDec=(double)$sqDec[2];
          $itemDiscountDec=(double)$sqDec[3];
          $itemQtySumDec=$sqDec[4];

            if ($priceBatchIdDec == 0) {

                $getItemCostDec = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$itemIdDec'");
                if($gicDec = $getItemCostDec->fetch_array()){
                    $itemCostDec=(double)$gicDec[13];
                    $itemCostSumDec=$itemQtySumDec * $itemCostDec;
                }
                
            }else{

                $getItemCostDec = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$itemIdDec' AND price_batch_id= '$priceBatchIdDec' ");
                if($gicDec = $getItemCostDec->fetch_array()){
                    $itemCostPriceBatchDec=(double)$gicDec[3];
                    $itemCostSumDec=$itemQtySumDec * $itemCostPriceBatchDec;
                }

            }


            //Calculation Start
            
            $ItemDiscountValueDec = ($itemQtySumDec * $itemSellingDec) - (($itemQtySumDec * $itemSellingDec) * $itemDiscountDec)/100;
            
            $itemIncomeSumDec= $ItemDiscountValueDec;
            //////////////////////
            $itemCostSumTotalDec += $itemCostSumDec;
            $itemIncomeSumTotalDec += $itemIncomeSumDec;
            //////////////////////
            $itemFullIncomeSumTotalDec=$itemIncomeSumTotalDec-$itemCostSumTotalDec;
            //Calculation End

        
        ///
        }
        ///
        
        //Sublet Calculations
        
        $SubletDec="SELECT SUM(sublet_price), SUM(sublet_cost_price) FROM tbl_job_sublet WHERE job_id='$jobIdDec' GROUP BY sublet_id ORDER BY SUM(sublet_price) DESC";
        $getSubletDecQuery=$conn->query($SubletDec);
        while ($GSsqDec=$getSubletDecQuery->fetch_array()) {//
            
            $SubletSumDec=$GSsqDec[0];
            $SubletSumTotalDec += $SubletSumDec;
            
            $SubletCostSumDec=$GSsqDec[1];
            $SubletCostSumTotalDec += $SubletCostSumDec;

        }
        
        $TotalDecRevenue = $itemIncomeSumTotalDec + $labourDecIncome + $SubletSumTotalDec;
        $NetDecIncome = $TotalDecRevenue - $itemCostSumTotalDec - $SubletCostSumTotalDec;
    
      
    }
    
    $summarynetincome['dec'] = $NetDecIncome;
    
    //////////////////////////////////////
    
    
    
    

    /////////////////////////////////////////////////////

    $output['result']=true;
    $output['summary_data'] = $summary;
    $output['summary_net_income_data'] = $summarynetincome;

    // $output['janInvoice'] = $JanInvoice;
    // $output['febInvoice'] = $FebInvoice;
    // $output['marInvoice'] = $MarInvoice;
    // $output['aprInvoice'] = $AprInvoice;
    // $output['mayInvoice'] = $MayInvoice;
    // $output['junInvoice'] = $JunInvoice;
    // $output['julInvoice'] = $JulInvoice;
    // $output['augInvoice'] = $AugInvoice;
    // $output['sepInvoice'] = $SepInvoice;
    // $output['octInvoice'] = $OctInvoice;
    // $output['novInvoice'] = $NovInvoice;
    // $output['decInvoice'] = $DecInvoice;


    echo json_encode($output);