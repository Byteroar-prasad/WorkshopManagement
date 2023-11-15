<?php
	require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    date_default_timezone_set('Asia/Colombo');
    // $currentYear=date('Y');
    $currentDate=date('Y-m-d');


    $output=[];	
    $datalist=array();

    $getDataQuery=$conn->query("SELECT * FROM `tbl_booking_web` ORDER BY booking_id DESC");
    while ($row=$getDataQuery->fetch_array()) {

        $BookingId = $row[0];
        $BookingName = $row[1];
        $BookingPhone = $row[2];
        $BookingEmail = $row[3];
        $BookingLicenseNumber = $row[4];
        $BookingDate = $row[5];
        $BookingTime = $row[6];
        $BookingCategory = $row[7];
        $BookingNote = nl2br($row[8]);
        $BookingStat = $row[9];
        $BookingDateTime = $row[10];
        
        //OLD Booking Not Showing
        if($BookingDate < $currentDate){
            
        }else{
  
    	$obj ='<tr>
                <td>'.$BookingId.'</td>
                <td>'.$BookingLicenseNumber.'</td>
                <td>'.$BookingName.'</td>
                <td>'.$BookingPhone.'</td>
                <td>'.$BookingEmail.'</td>
                <td>D- '.$BookingDate.' T- '.$BookingTime.'</td>
                <td>'.$BookingCategory.'</td>
              </tr>
              
              
              ';
              
              

        array_push($datalist,$obj);
        
        }
    	
    }


    $output['result']=true;
    $output['data']=$datalist;

    echo json_encode($output);