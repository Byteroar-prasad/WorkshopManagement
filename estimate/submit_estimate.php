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
        $license_no = htmlspecialchars($_POST['license_no']);
        $mileage = htmlspecialchars($_POST['mileage']);
        $note = htmlspecialchars($_POST['note']);
        $user_id = htmlspecialchars($_POST['user_id']);

        $sql = "INSERT INTO `tbl_estimate_vehicle_number`(`license_no`, `mileage`, `date`) VALUES (?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sss", $license_no, $mileage, $currentDate);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            

            $getDataForDate=$conn->query("SELECT * FROM tbl_estimate_vehicle_number WHERE license_no = '$license_no' ORDER BY estimate_id DESC LIMIT 1 ");
            if ($row=$getDataForDate->fetch_array()) {
                $estimate_id = $row[0];
                
                
                if($conn->query("INSERT INTO tbl_estimate_tax VALUES(null,'$estimate_id','$user_id','0','0','$note','0',null)")){
                    
                    $output['result']= True;
                    $output['e_id']= $estimate_id;
                    
                }else{
                    $output['result']= False;
                }
                
            }else{
                $output['result']= False;
            }

        }else{  
            $output['result']= False;
        }


    }

    mysqli_close($conn);

    echo(json_encode($output))

?>