<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');
    
    
    if(isset($_POST['Partnumber'])){
        
        $Partnumber=htmlspecialchars($_POST['Partnumber']);
        
            $FullQTYTotal="";
            
            
            $getItemId=$conn->query("SELECT * FROM tbl_item WHERE part_number='$Partnumber'");
            if($dataItemId=$getItemId->fetch_array()){
                $itemId=$dataItemId[0];


                    $getNormalData=$conn->query("SELECT quantity FROM tbl_item WHERE item_id='$itemId'");
                    if($dataNormal=$getNormalData->fetch_array()){
                        
                        $NormalQty=$dataNormal[0];
                        
                        $PriceBatchQtyTotal=0;
                        $getPriceBatchData=$conn->query("SELECT qty FROM tbl_item_price_batch WHERE item_id='$itemId' ");
                        while($dataPriceBatch=$getPriceBatchData->fetch_array()){
                            
                            /////////////////////////////////
                            $PriceBatchQty=$dataPriceBatch[0];
                            $PriceBatchQtyTotal += $PriceBatchQty;
                            /////////////////////////////////
                        }
                        
                        $FullQTYTotal = $NormalQty + $PriceBatchQtyTotal;
                        
                        
                        
                    }
                    
                    $output['result']=true;
                    $output['FullQTYTotal']=$FullQTYTotal;
                    
                    
            }
        
        
        
        
        
        
    }else{
        $output['result']=false;
        $output['msg']="Invalid request, Please try again.";
    }
    
    echo json_encode($output);
    
    
    