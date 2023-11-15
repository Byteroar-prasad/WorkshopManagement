<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');

    $output=[];
    $output['sp'] = 0;
    $output['cp'] = 0;

    if(isset($_POST['price_batch_id']) && isset($_POST['part_no'])){

    $part_no = htmlspecialchars($_POST['part_no']);
    $price_batch_id = htmlspecialchars($_POST['price_batch_id']);

          

    if ($price_batch_id == 0) {

        $checkPbatch = $conn->query("SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id = '$part_no'");
        if($cpRs = $checkPbatch->fetch_array()){
            // $output['1'] = 1111111;
            $selling_price = $cpRs[5];
            $part_cost = $cpRs[13];


            $output['sp'] = $selling_price;
            $output['cp'] = $part_cost;
           
        }
        
    }else{
        // $output['2'] = "SELECT * FROM tbl_item_price_batch WHERE item_id = '$part_no' AND price_batch_id = '$price_batch_id' ";
        $checkPbatch = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$part_no' AND price_batch_id = '$price_batch_id' ");
        if($cpRs = $checkPbatch->fetch_array()){

            $part_cost = $cpRs[3];
            $selling_price = $cpRs[4];

  
            $output['sp'] = $selling_price;
            $output['cp'] = $part_cost;

           
        }

    } 




    $output['result'] = true;

}else{
    $output['result'] = false;
    $output['msg'] = "Required fields are not provided.";
}
    
mysqli_close($conn);
echo json_encode($output);


?>