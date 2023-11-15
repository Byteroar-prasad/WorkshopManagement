<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];
    $dataList = array();

    if(isset($_POST['part_no'])){

    $part_no = htmlspecialchars($_POST['part_no']);



    // $getItemId=$conn->query("SELECT item_id FROM tbl_item WHERE item_id='$part_no'");
    // if($giiRs=$getItemId->fetch_array()){

    //     $ItemId=$giiRs[0];
        $rowData = '<option value="0" selected>Normal</option>';
        array_push($dataList, $rowData);


        $checkPbatch = $conn->query("SELECT * FROM tbl_item_price_batch WHERE item_id = '$part_no'");


        while($cpRs = $checkPbatch->fetch_array()){
            $id = $cpRs[0];
            $label = $cpRs[6].' ('.$cpRs[2].')';

            $rowData = "<option value=".$id.">".$label."</option>";

            array_push($dataList, $rowData);


        }



        $output['result'] = true;
        $output['data'] = $dataList;


    // }else{
    //     $output['result'] = false;
    //     $output['msg'] = "part verification failed.";
    // }


     

}else{
    $output['result'] = false;
    $output['msg'] = "Required fields are not provided.";
}
    
mysqli_close($conn);
echo json_encode($output);


?>