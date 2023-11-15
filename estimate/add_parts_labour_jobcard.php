<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    //$currentDate=date('Y-m-d H:i:s');


    $output=[];
    $dataArray = array();
    $ItemPrice = 0;

    if($_POST)
    {
      
        
        $data = $_POST['list'];
        
        
        $estimate_id = $_POST['estimate_id'];
        $user_id = $_POST['user_id'];
        $labour_id = $_POST['labour_id'];
       
        
        
        
        $part_discount = 0;
        $stat = 0;
        // $qty = 1;
      
        $list = json_decode($data,false);

        foreach($list as $item) { 
            
            $partCode = $item->part;
            $partqty = $item->qty;  
            $remark = $item->remark; 
            
            //////////////////////save data/////////
            
            $getItemId=$conn->query("SELECT item_id FROM tbl_item WHERE part_number='$partCode'");
            if($giiRs=$getItemId->fetch_array()){

              $ItemId=$giiRs[0];
              
                
                $CheckPriceBatchCount=$conn->query("SELECT COUNT(*) FROM tbl_item_price_batch WHERE item_id='$ItemId'");
                if($cpbcRs=$CheckPriceBatchCount->fetch_array()){
    
                  $PriceBatchCount=$cpbcRs[0];
                }
                
                
                if($PriceBatchCount == '0'){
                    
                    $getItemPrice=$conn->query("SELECT selling_cost FROM tbl_item WHERE item_id='$ItemId'");
                    if($gepRs=$getItemPrice->fetch_array()){
        
                      $ItemPrice=$gepRs[0];
                      
                    }
                    
                    
                    //////////////////////////
              
                    $check = $conn->query("SELECT * FROM tbl_estimate_item WHERE labour_id = '$labour_id' AND item_id = '$ItemId' ");
                    if($crs = $check->fetch_array()){
                        
                        $output['result'] = false;
                        $output['msg'] = 'Already exists.';
                        
                    }else{
                        $sql = "INSERT INTO `tbl_estimate_item`(`estimate_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `stat`, `price`) VALUES (?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ssssssss", $estimate_id, $user_id, $labour_id, $ItemId, $partqty, $remark, $stat, $ItemPrice);
                        $result = mysqli_stmt_execute($stmt);
                        if($result)
                        {
                            $output['result'] = true;
                            $output['msg'] = 'Successfully added';
                        }else{
                            $output['result'] = false;
                            $output['msg'] = 'Error';   
                        }
                        
                        
                    }
                  
                  ///////////////////////////////
                    
                    
                    
                    
                }else{
                    
                    $getItemPriceBatch=$conn->query("SELECT selling_price FROM tbl_item_price_batch WHERE item_id='$ItemId' ORDER BY price_batch_id DESC LIMIT 1");
                    if($gepbRs=$getItemPriceBatch->fetch_array()){
        
                      $ItemPrice=$gepbRs[0];
                      
                    }
                    
                    
                    //////////////////////////
              
                    $check = $conn->query("SELECT * FROM tbl_estimate_item WHERE labour_id = '$labour_id' AND item_id = '$ItemId' ");
                    if($crs = $check->fetch_array()){
                        
                        $output['result'] = false;
                        $output['msg'] = 'Already exists.';
                        
                    }else{
                        $sql = "INSERT INTO `tbl_estimate_item`(`estimate_id`, `user_id`, `labour_id`, `item_id`, `qty`, `remark`, `stat`, `price`) VALUES (?,?,?,?,?,?,?,?)";
                        $stmt = mysqli_prepare($conn, $sql);
                        mysqli_stmt_bind_param($stmt, "ssssssss", $estimate_id, $user_id, $labour_id, $ItemId, $partqty, $remark, $stat, $ItemPrice);
                        $result = mysqli_stmt_execute($stmt);
                        if($result)
                        {
                            $output['result'] = true;
                            $output['msg'] = 'Successfully added';
                        }else{
                            $output['result'] = false;
                            $output['msg'] = 'Error';   
                        }
                        
                        
                    }
                  
                  ///////////////////////////////
                    
                    
                }
              
              
         
              
              
            }else{
                $output['result'] = false;
                $output['msg'] = 'Error 911';
            }
            
            ///////////////////////////////////
      
        }
                

       

    }else{
        $output['result'] = false;
        $output['msg'] = "ERR";
    }

    mysqli_close($conn);

    echo json_encode($output);

?>