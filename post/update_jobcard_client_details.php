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
        $job_id = htmlspecialchars($_POST['job_id']);
        $licens_no = htmlspecialchars($_POST['licens_no']);
        $client_id = htmlspecialchars($_POST['client_id']);
        
        ///////////////
        $CheckOwnerHasCarPrice = $conn->query("SELECT COUNT(*) FROM tbl_vehicle WHERE license_no='$licens_no' AND client_id='$client_id' ");
        if($COHCrs = $CheckOwnerHasCarPrice->fetch_array()){
            $VehicleCount=$COHCrs[0];
        }
        ///////////////
        
        if($VehicleCount>0){
        
        
            ///////////////
            $GetClientDateSql = "SELECT * FROM tbl_client WHERE client_id='$client_id'";
            $GetClientDataQuery=$conn->query($GetClientDateSql);
            if($ClientDataRs =$GetClientDataQuery->fetch_array())
            {   
                $ClientName=$ClientDataRs[1];
                $ClientEmail=$ClientDataRs[2];
                $ClientPhone=$ClientDataRs[5];
                    
            }
            ///////////////
        



            $UpdateJobClientDetailsSql = "UPDATE tbl_job_details SET `reg_email`='$ClientEmail', `reg_customer`='$ClientName', `reg_phone_no`='$ClientPhone' WHERE job_id= '$job_id' ";
            if($conn->query($UpdateJobClientDetailsSql) === TRUE){
            
                $UpdateTaxClientIDSql = "UPDATE tbl_tax SET `client_id`='$client_id' WHERE job_id= '$job_id' ";
                if($conn->query($UpdateTaxClientIDSql) === TRUE){
                
                    $output['result'] = true;
                    $output['msg'] = 'Client data updated';
                  
                  
                }else{
                    $output['result'] = false;
                    $output['msg'] = 'Error Update Tax Area';
                }
    
              
              
            }else{
                $output['result'] = false;
                $output['msg'] = 'Error Update Job Card';
            }
            
            
        
        
        }else{
            $output['result'] = false;
            $output['msg'] = 'This client and vehicle not match, Please try-again !';
        } 
        
        
        


    }
    
    mysqli_close($conn);
    echo json_encode($output);

   

    ?>