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
        $item_id = htmlspecialchars($_POST['item_id']);
        $qty = htmlspecialchars($_POST['qty']);
        $user_id = htmlspecialchars($_POST['user_id']);

        $part_order_id='';
        $estimate_id='';
        $stat='0';

              
            $item_cost='';  
            $CheckPriceBatchCount=$conn->query("SELECT COUNT(*) FROM tbl_item_price_batch WHERE item_id='$item_id'");
            if($cpbcRs=$CheckPriceBatchCount->fetch_array()){
    
                $PriceBatchCount=$cpbcRs[0];
            }
                if($PriceBatchCount == '0'){
                    
                    $getItemPrice=$conn->query("SELECT cost FROM tbl_item_cost WHERE item_id='$item_id'");
                    if($gepRs=$getItemPrice->fetch_array()){
        
                      $item_cost=$gepRs[0];
                      
                    }
                }else{

                    $getItemPriceBatch=$conn->query("SELECT cost_price FROM tbl_item_price_batch WHERE item_id='$item_id' ORDER BY price_batch_id DESC LIMIT 1");
                    if($gepbRs=$getItemPriceBatch->fetch_array()){
        
                      $item_cost=$gepbRs[0];
                      
                    }


                }
           
                                           


        $sql = "INSERT INTO `tbl_part_order_item`(`part_order_id`, `estimate_id`, `item_id`, `qty`, `item_cost`, `user_id`, `stat`, `part_order_item_datetime`) VALUES (?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssss", $part_order_id, $estimate_id, $item_id, $qty, $item_cost, $user_id, $stat, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            echo 'Completed';
        }else{  
            echo 'Error';   
        }


    }

    mysqli_close($conn);

?>