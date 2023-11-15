<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');
    
    
    if(isset($_POST['licence'])){
        
        $licence=htmlspecialchars($_POST['licence']);
        
            $client_id="";
            $email="";
            $customer="";
            $reg_phone_no="";
            $reg_model="";
            $reg_chassis_no="";
            $first_reg_date="";
            $mileage="";
        
        //$sql = "SELECT * FROM tbl_vehicle tbv INNER JOIN tbl_client tbc ON tbv.client_id=tbc.client_id WHERE tbv.license_no='$licence' ";

        $getData=$conn->query("SELECT * FROM tbl_vehicle tbv INNER JOIN tbl_client tbc ON tbv.client_id=tbc.client_id WHERE tbv.license_no='$licence'");
        
        if($data=$getData->fetch_array()){
            
            $client_id=$data[1];
            $email=$data[10];
            $customer=$data[9];
            $reg_phone_no=$data[13];
            $reg_model=$data[3];
            $reg_chassis_no=$data[4];
            $first_reg_date=$data[7];
            
            
            
            $getMileageData=$conn->query("SELECT * FROM tbl_job_details WHERE reg_licens_no='$licence' ORDER BY job_id DESC LIMIT 1");
        
            if($dataM=$getMileageData->fetch_array()){
                
                $mileage=$dataM[9];
                
                
            }
            
            
            
        }
        
        
        $output['result']=true;
        $output['client_id']=$client_id;
        $output['email']=$email;
        $output['customer']=$customer;
        $output['phone_no']=$reg_phone_no;
        $output['model']=$reg_model;
        $output['chassis']=$reg_chassis_no;
        $output['f_reg_date']=$first_reg_date;
        $output['mileage']=$mileage;
        
        
        
    }else{
        $output['result']=false;
        $output['msg']="Invalid request, Please try again.";
    }
    
    echo json_encode($output);
    
    
    