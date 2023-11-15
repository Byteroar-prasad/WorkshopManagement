<?php

	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output = [];


        if(isset($_POST['labour_name'])){
            
            $labourName = htmlspecialchars($_POST['labour_name']);
            $fru = 0;
            $getFru = $conn->query("SELECT fru FROM tbl_labour WHERE labour_name = '$labourName'");
            if($frRs = $getFru->fetch_array()){
               $fru =  $frRs[0];
            }
            $output['result'] = true;
            $output['data'] = $fru;
            
        }else{
            $output['result'] = false;
            $output['msg'] = "Required fields are not provided.";
        }
        
        
        echo json_encode($output);