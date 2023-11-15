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
        
        $GetLabourCount=$conn->query("SELECT COUNT(*) FROM tbl_job_labour WHERE job_id='$job_id'");
        if($lRs=$GetLabourCount->fetch_array()){
            $LabourCount=$lRs[0];
            
            if($LabourCount=='0'){
                
                $DeleteJobDetailsSql = "DELETE FROM tbl_job_details WHERE job_id= '$job_id' ";
                if ($conn->query($DeleteJobDetailsSql) === TRUE) {
        
                    $DeleteTaxDetailsSql = "DELETE FROM tbl_tax WHERE job_id= '$job_id' ";
                    if ($conn->query($DeleteTaxDetailsSql) === TRUE) {
            
                        $output['result'] = true;
                        $output['msg'] = 'Successfully deleted';
            
                    }else{  
            
                        $output['result'] = false;
                        $output['msg'] = 'Error, Something went wrong. (CODE SNAKE)';
               
                    }
        
                }else{  
        
                    $output['result'] = false;
                    $output['msg'] = 'Error, Something went wrong. (CODE SPRITE)';
           
                }
                
                
            }else{
                $output['result'] = false;
                $output['msg'] = 'Please remove Labour and Item first';
            }
            
            
            
        }
        

    }

    mysqli_close($conn);

    echo json_encode($output);

?>