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
        $part_name = htmlspecialchars($_POST['part_name']);
        $part_location = htmlspecialchars($_POST['part_location']);
        $part_number = htmlspecialchars($_POST['part_number']);
        $part_cost = htmlspecialchars($_POST['part_cost']);
        $selling_cost = htmlspecialchars($_POST['selling_cost']);
        $discount = htmlspecialchars($_POST['discount']);
        $remark = htmlspecialchars($_POST['remark']);
        // $stat = 1;
        $quantity = 0;

        
        $currency_method = htmlspecialchars($_POST['currency_method']);
        $currency_in_lkr = htmlspecialchars($_POST['currency_in_lkr']);
        $freight_clearance = htmlspecialchars($_POST['freight_clearance']);
        $cost_price_international = htmlspecialchars($_POST['cost_price_international']);

        if($cost_price_international==''){

          $CostInternational = 1;

        }else{

          $CostInternational = $currency_method.'_'.$currency_in_lkr.'_'.$freight_clearance.'_'.$cost_price_international;

        }

        /////////////////////////

        $FakeCost = $selling_cost - (($selling_cost * 20)/100);

        /////////////////////////

        $sql = "INSERT INTO `tbl_item`(`part_name`, `part_location`, `part_number`, `part_cost`, `selling_cost`, `discount`, `quantity`, `remark`, `stat`) VALUES (?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssssssss", $part_name, $part_location, $part_number, $FakeCost, $selling_cost, $discount, $quantity, $remark, $CostInternational);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            // echo 'Completed';


            $lastId=0;
        
            $getLast=$conn->query("SELECT item_id FROM tbl_item ORDER BY item_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){

              $lastId=$lRs[0];

                $AddRealCostsql = "INSERT INTO `tbl_item_cost`(`item_r_id`, `item_id`, `cost`, `item_datetime`) VALUES (null, '$lastId', '$part_cost', '$currentDate')";
                if ($conn->query($AddRealCostsql) === TRUE) {

                  echo 'New record created successfully';


                } else {
                 
                  echo 'Error 7777';
                  
                }


              

              }else{

                echo 'Error 888';   

            }




        }else{  
            echo 'Error 999';   
        }


    }

    mysqli_close($conn);

    ?>