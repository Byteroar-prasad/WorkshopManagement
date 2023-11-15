<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    //$currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $job_part_id = htmlspecialchars($_POST['job_part_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $change_qty = htmlspecialchars($_POST['change_qty']);
        $now_item_qty = htmlspecialchars($_POST['now_item_qty']);
        //
        $price_batch_id = htmlspecialchars($_POST['price_batch_id']);


        if($price_batch_id == 0){

            //Price Batch Normal
            $checkQtyForRun = $conn->query("SELECT quantity FROM tbl_item WHERE item_id = '$item_id'");
            if($qrRS = $checkQtyForRun->fetch_array()){

                $cRqty = (double)$qrRS[0];
                $TotQty = (double)$cRqty + (double)$now_item_qty;


                if($TotQty >= $change_qty){


                    $UpdateMainQtysql = "UPDATE tbl_item SET `quantity`= quantity + '$now_item_qty' WHERE item_id = '$item_id' ";
                    if ($conn->query($UpdateMainQtysql) === TRUE) {

                            $checkQty = $conn->query("SELECT quantity FROM tbl_item WHERE item_id = '$item_id'");
                            if($qRS = $checkQty->fetch_array()){

                                $cqty = (double)$qRS[0];
                                if($cqty >= $change_qty){

                                    $UpdateJobPartQtysql = "UPDATE tbl_part_selling_list SET `qty`= '$change_qty' WHERE part_selling_list_id = '$job_part_id' ";
                                    if ($conn->query($UpdateJobPartQtysql) === TRUE) {

                                        $UpdateMainQtyNewQtysql = "UPDATE tbl_item SET `quantity`= quantity - '$change_qty' WHERE item_id = '$item_id' ";
                                        if ($conn->query($UpdateMainQtyNewQtysql) === TRUE) {

                                        $output['result'] = true;
                                        $output['msg'] = 'Successfully item added';

                                        // echo 'Completed';

                                        }else{  

                                            $output['result'] = false;
                                            $output['msg'] = 'Error, Something went wrong 991';

                                            // echo 'Error';   
                                        }

                                    }else{  

                                        $output['result'] = false;
                                        $output['msg'] = 'Error, Something went wrong 888';

                                        // echo 'Error';   
                                    }





                                }else{

                                    $output['result'] = false;
                                    $output['msg'] = 'Not enough stock';

                                }
                            }

                   

                    }else{  

                        $output['result'] = false;
                        $output['msg'] = 'Error, Something went wrong 111';

                        
                    }


                }else{

                    $output['result'] = false;
                    $output['msg'] = 'Not enough stock, Please add stock first';


                }

            }

        //////////////////////////////////////////
        }else{

            //Price Batch With
            $checkQtyForRun = $conn->query("SELECT qty FROM tbl_item_price_batch WHERE item_id = '$item_id' AND price_batch_id = '$price_batch_id' ");
            if($qrRS = $checkQtyForRun->fetch_array()){

                $cRqty = (double)$qrRS[0];
                $TotQty = (double)$cRqty + (double)$now_item_qty;


                if($TotQty >= $change_qty){


                    $UpdateMainQtysql = "UPDATE tbl_item_price_batch SET `qty`= qty + '$now_item_qty' WHERE item_id = '$item_id' AND price_batch_id = '$price_batch_id' ";
                    if ($conn->query($UpdateMainQtysql) === TRUE) {

                            $checkQty = $conn->query("SELECT qty FROM tbl_item_price_batch WHERE item_id = '$item_id' AND price_batch_id = '$price_batch_id'");
                            if($qRS = $checkQty->fetch_array()){

                                $cqty = (double)$qRS[0];
                                if($cqty >= $change_qty){

                                    $UpdateJobPartQtysql = "UPDATE tbl_part_selling_list SET `qty`= '$change_qty' WHERE part_selling_list_id = '$job_part_id' ";
                                    if ($conn->query($UpdateJobPartQtysql) === TRUE) {

                                        $UpdateMainQtyNewQtysql = "UPDATE tbl_item_price_batch SET `qty`= qty - '$change_qty' WHERE item_id = '$item_id' AND price_batch_id = '$price_batch_id' ";
                                        if ($conn->query($UpdateMainQtyNewQtysql) === TRUE) {

                                        $output['result'] = true;
                                        $output['msg'] = 'Successfully item added';

                                        // echo 'Completed';

                                        }else{  

                                            $output['result'] = false;
                                            $output['msg'] = 'Error, Something went wrong 991';

                                            // echo 'Error';   
                                        }

                                    }else{  

                                        $output['result'] = false;
                                        $output['msg'] = 'Error, Something went wrong 888';

                                        // echo 'Error';   
                                    }





                                }else{

                                    $output['result'] = false;
                                    $output['msg'] = 'Not enough stock';

                                }
                            }

                   

                    }else{  

                        $output['result'] = false;
                        $output['msg'] = 'Error, Something went wrong 111';

                        
                    }


                }else{

                    $output['result'] = false;
                    $output['msg'] = 'Not enough stock, Please add stock first';


                }











            }

        }












    }

    mysqli_close($conn);

    echo json_encode($output);

?>