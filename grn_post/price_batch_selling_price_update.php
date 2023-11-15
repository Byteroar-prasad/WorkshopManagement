<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if(isset($_POST['batch_id']) && isset($_POST['item_id']) && isset($_POST['new_price'])){


        $batch_id = htmlspecialchars($_POST['batch_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $new_price =  str_replace(',', '', htmlspecialchars($_POST['new_price']));




        if($batch_id=='0'){

            $UpdateNormalSql = "UPDATE tbl_item SET selling_cost='$new_price' WHERE item_id='$item_id' ";
            if ($conn->query($UpdateNormalSql) === TRUE){

                $output['result'] = true;
                $output['msg'] = 'Selling price updated';

            }else{

                $output['result'] = false;
                $output['msg'] = 'Invalid request, please try again (Code SPRITE).';
            }

        }else{

            $UpdatePriceBatchSql = "UPDATE tbl_item_price_batch SET selling_price='$new_price' WHERE price_batch_id='$batch_id' AND item_id='$item_id' ";
            if ($conn->query($UpdatePriceBatchSql) === TRUE){

                $output['result'] = true;
                $output['msg'] = 'Selling price updated';

            }else{

                $output['result'] = false;
                $output['msg'] = 'Invalid request, please try again (Code SNAKE).';
            }


        }


    }else{
        $output['result'] = false;
        $output['msg'] = 'Invalid request, please try again (Code FIGHT).';
    }




    mysqli_close($conn);

    echo json_encode($output);

    ?>