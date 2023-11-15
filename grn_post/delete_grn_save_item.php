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
        $grn_items_id = htmlspecialchars($_POST['grn_items_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $price_batch_id = htmlspecialchars($_POST['price_batch_id']);
        $qty = htmlspecialchars($_POST['qty']);


        if($price_batch_id=='0'){
            
            $UpdateStockSql = "UPDATE tbl_item SET `quantity`= quantity - '$qty' WHERE item_id='$item_id'";
            if ($conn->query($UpdateStockSql) === TRUE){
                
                    $DeleteGRNListSql = "DELETE FROM tbl_grn_items WHERE grn_items_id='$grn_items_id'";
                    if ($conn->query($DeleteGRNListSql) === TRUE) {
                        
                        $output['result']="ok";
                        $output['msg']='Successfully remove from stock.';  
                      
                    } else {
                      
                        $output['result']=false;
                        $output['msg']='Something went wrong (error code delete grn)';
                      
                    }
                
                
            }else{
                
                $output['result']=false;
                $output['msg']='Something went wrong (error code update stock)';
                
            }
            
        }else{
            
            $UpdateStockPriceBatchSql = "UPDATE tbl_item_price_batch SET `qty`= qty - '$qty' WHERE price_batch_id='$price_batch_id' AND item_id='$item_id'";
            if ($conn->query($UpdateStockPriceBatchSql) === TRUE){
                
                    $DeleteGRNListSql = "DELETE FROM tbl_grn_items WHERE grn_items_id='$grn_items_id'";
                    if ($conn->query($DeleteGRNListSql) === TRUE) {
                        
                        $output['result']="ok";
                        $output['msg']='Successfully remove from stock.';  
                      
                    } else {
                      
                        $output['result']=false;
                        $output['msg']='Something went wrong (error code delete grn)';
                      
                    }
                
                
            }else{
                
                $output['result']=false;
                $output['msg']='Something went wrong (error code update stock)';
                
            }
            
            
        }

        
        
        


    }

    mysqli_close($conn);

    echo json_encode($output);

    ?>