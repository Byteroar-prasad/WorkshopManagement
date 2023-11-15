<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $grn_detail_id = htmlspecialchars($_POST['grn_detail_id']);
        $currency_in_lkr = htmlspecialchars($_POST['currency_in_lkr']);
        $currency_method = htmlspecialchars($_POST['currency_method']);
        $freight_clearance = htmlspecialchars($_POST['freight_clearance']);

        $grn_number = $currency_method.'_'.$currency_in_lkr.'_'.$freight_clearance;

        $sql = "UPDATE tbl_grn_details SET grn_number='$grn_number' WHERE grn_detail_id='$grn_detail_id' ";
        if($conn->query($sql) === TRUE){

            $GetItemDetailsSql = "SELECT price_batch_id,item_id,stat FROM tbl_item_price_batch WHERE grn='$grn_detail_id' ";
            $GIDrs=$conn->query($GetItemDetailsSql);
            while($GIDrow =$GIDrs->fetch_array())
            {
                $PriceBatchId=$GIDrow[0];
                $ItemId=$GIDrow[1];
                $Stat=$GIDrow[2];

                $CurrenceyDetails = explode("_",$Stat);
                $PriceForregin = (double)$CurrenceyDetails[3];

                //Calculation Real Cost
                $FreightClearenceCal=($freight_clearance/100)*$PriceForregin;
                $NewPrice=$FreightClearenceCal+$PriceForregin;
                $RealCost=$currency_in_lkr*$NewPrice;

                //GRN Details Update
                $GRNDetails = $currency_method.'_'.$currency_in_lkr.'_'.$freight_clearance.'_'.$PriceForregin;


                $UpdatePrcieBatchDetailsSql = "UPDATE tbl_item_price_batch SET cost_price='$RealCost', stat='$GRNDetails' WHERE item_id='$ItemId' AND price_batch_id='$PriceBatchId' ";
                if($conn->query($UpdatePrcieBatchDetailsSql) === TRUE){

                    $UpdateGRNItemsSql = "UPDATE tbl_grn_items SET cost_price='$RealCost' WHERE item_id='$ItemId' AND price_batch_id='$PriceBatchId' AND grn_detail_id='$grn_detail_id' ";
                    if($conn->query($UpdateGRNItemsSql) === TRUE){

                        $output['result']="ok_";
                        $output['msg']='Successfully Updated Currencey Rate.';

                    }else{
                        $output['result']=false;
                        $output['msg']='Something went wrong (error code SPRITE)';
                    }

                }else{
                    $output['result']=false;
                    $output['msg']='Something went wrong (error code COKE)';
                }

            }


        }else{
            $output['result']=false;
            $output['msg']='Something went wrong (error code SNAKE)';
        }
           


    }

    mysqli_close($conn);

    echo json_encode($output);

    ?>