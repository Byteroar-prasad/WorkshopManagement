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
        $estimate_id = htmlspecialchars($_POST['estimate_id']);

        $KSDFile = $_FILES['ksdfile']['name'];
        $path = '../ksd_file/';
        $location = $path . $_FILES['ksdfile']['name'];
        

        if(move_uploaded_file($_FILES['ksdfile']['tmp_name'], $location)){


            $contents = file_get_contents($location);


            $contents_1 = explode('<?xml version="1.0" encoding="UTF-8" standalone="no"?>',$contents);
            $contents_list_1 = $contents_1[1];

            $contents_2 = explode('<SOAP-ENV:Envelope SOAP-ENV:encodingStyle="http://schemas.xmlsoap.org/soap/encoding/" xmlns:SOAP-ENV="http://schemas.xmlsoap.org/soap/envelope/">',$contents_list_1);
            $contents_list_2 = $contents_2[1];

            $contents_3 = explode('<SOAP-ENV:Body>',$contents_list_2);
            $contents_list_3 = $contents_3[1];

            ////////////////////////////////////

            $contents_4 = explode('</SOAP-ENV:Envelope>',$contents_list_3);
            $contents_list_4 = $contents_4[0];

            $contents_5 = explode('</SOAP-ENV:Body>',$contents_list_4);
            $contents_list_5 = $contents_5[0];

            $contents_list_6 = str_replace('&', 'And', $contents_list_5);

            $contents_list_7 = str_replace(',', 'And', $contents_list_6);

            

            $arr = simplexml_load_string($contents_list_7);

            $encoded = json_encode($arr);

            $position_data = json_decode($encoded,false)->position;
           
            $count = count($position_data);

            // $designation="";

            $LabourCount=0;
            
     
            if($count == 1){
                

                if(isset($position_data->flatRate->additionalInformation)){
                    $LABOURDETAILS = $position_data->flatRate->additionalInformation;
                    
                }else{
                    
                    $LABOURDETAILS = "";
                }
                
                    $LABOURNAME = $position_data->flatRate->designation;
                    $FRU = $position_data->flatRate->value;


                    $LABOUR_ID=$LabourCount+=1;
                    $conn->query("INSERT INTO tbl_estimate_labour VALUES(null, '$estimate_id', '$LABOUR_ID', '$FRU', '$LABOURNAME', '$LABOURDETAILS', '$currentDate')");
                
                
            }else{
                
                for($index = 0 ; $index < count($position_data) ;$index++){
                
                  if(isset($position_data[$index]->flatRate->additionalInformation)){
                    
                    
                    $LABOURDETAILS = $position_data[$index]->flatRate->additionalInformation;
                  
                      
                      
                      
                  }else{
                    $LABOURDETAILS = "";
                  }
    
                   $LABOURNAME = $position_data[$index]->flatRate->designation;
                   $FRU = $position_data[$index]->flatRate->value;
    
    
                   $LABOUR_ID=$LabourCount+=1;
                   $conn->query("INSERT INTO tbl_estimate_labour VALUES(null, '$estimate_id', '$LABOUR_ID', '$FRU', '$LABOURNAME', '$LABOURDETAILS', '$currentDate')");
                 }
                
            }
            
            

            

            $output['result'] = true;
            // $output['data']=$designation;
            $output['msg'] = 'Successfully labour added';
                 
        }else{
            $output['result'] = false;
            $output['msg'] = 'Error';
        }

    }

    mysqli_close($conn);
    echo json_encode($output);

?>