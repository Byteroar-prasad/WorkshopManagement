<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');
    
    
    if(isset($_POST['client_id'])){
        
        $client_id=htmlspecialchars($_POST['client_id']);

            $email="";
            $customer="";
            $reg_phone_no="";
            $first_reg_date="";
        
        //$sql = "SELECT * FROM tbl_vehicle tbv INNER JOIN tbl_client tbc ON tbv.client_id=tbc.client_id WHERE tbv.license_no='$licence' ";

        $getData=$conn->query("SELECT * FROM tbl_client WHERE client_id='$client_id'");
        
        if($data=$getData->fetch_array()){
            
            $email=$data[2];
            $customer=$data[1];
            $reg_phone_no=$data[5];
            $first_reg_date=$data[3];
            
            
            
        }
        
        
        $output['result']=true;

        $output['email']=$email;
        $output['customer']=$customer;
        $output['phone_no']=$reg_phone_no;

        $output['f_reg_date']=$first_reg_date;
        
        
        
    }else{
        $output['result']=false;
        $output['msg']="Invalid request, Please try again.";
    }
    
    echo json_encode($output);
    
    
    