<?php
    require_once('../db/database.php');
    require_once "../mail/autoload.php";
    require_once "../mail/phpMailer.php";
    require_once "../mail/smtp.php";
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $estimate_id = htmlspecialchars($_POST['estimate_id']);
        $estimate_screen = htmlspecialchars($_POST['txt_estimate_img']);

        $screenName = time().".jpg";
        file_put_contents("../estimate_ss/".$screenName,file_get_contents($estimate_screen));
        
        
        if($conn->query("INSERT INTO tbl_estimate_image VALUES(null,'$estimate_id','$screenName',null)")){

            // echo 'Invoice Screenshoot Save Success';
    

            $getEstimateSS=$conn->query("SELECT estimate_ss FROM tbl_estimate_image WHERE estimate_id='$estimate_id' ORDER BY estimate_image_id DESC LIMIT 1 ");
            if($GCSSRs=$getEstimateSS->fetch_array()){
                $EstimateSS=$GCSSRs[0];
                
                
                $getClientEmail=$conn->query("SELECT * FROM tbl_estimate_vehicle_number tevn INNER JOIN tbl_estimate_tax tx ON tevn.estimate_id=tx.estimate_id INNER JOIN tbl_vehicle tv ON tevn.license_no=tv.license_no INNER JOIN tbl_client tc ON tv.client_id=tc.client_id INNER JOIN users_login ul ON tx.user_id=ul.user_id WHERE tevn.estimate_id= '$estimate_id' ");
                if($CERs=$getClientEmail->fetch_array()){
                    
                $ClientEmail=$CERs[23];

                
                //////////////////////////////////////Email///////////////////////////////////////////////////////
        
        
        
         $msgContent="
                            
                        <div style='margin-top: 50px; width: 80%; border: 1px solid grey; left: 0;'>
                          <div style='position: relative; top: -35px; margin: 20px;'>
                            
                            
                            <img src='http://amazofttestcloud.com/clients/bae/estimate_ss/$EstimateSS' style='width: 100%;'>
                            
                            <hr>
                            <div style='margin: auto; text-align: center; position: relative;'>This is an auto genereted Email by Bavarian Automobile Engineering (Pvt) Ltd</div>
                            <div style='margin: auto; text-align: center; position: relative; font-size: 10px;'>Powered by <a href='http://amazoft.com/' target='_blank'>AMAZOFT (Pvt) Ltd</a></div>
                          </div>
                        </div>
                        
                        ";
                        
                        
                        $mail = new PHPMailer;
                        $mail->SMTPDebug = 0;
                        
                        
                        
                        
                        $mail->isSMTP();
                        $mail->Host = 'localhost';
                        $mail->SMTPAuth = false;
                        $mail->SMTPAutoTLS = false;
                        $mail->Port = 25;
                        
                        
                        
                        
                        $mail->From = "donotreply@bae.lk";
                        $mail->FromName = "Bavarian Automobile Engineering";
                        $mail->addAddress($ClientEmail,"");
                        $mail->isHTML(true);
                        $mail->Subject = "Invoice";
                        $mail->Body = $msgContent;
                        $mail->AltBody = "Invoice";
                        $S=$mail->send();
                        
                        $output['result']=true;
                        $output['msg']="OK";
        
        
        
                //////////////////////////////////////END Email////////////////////////////////////////////////////////////////////////////////////
                
                
        }else{
            $output['result']=false;
            $output['msg']="error 01";
        }    
                
                
           
        }else{
            $output['result']=false;
            $output['msg']="error 02";
        }
        
        
    }else{
        $output['result']=false;
        $output['msg']="error 03";
    }




        

            



    }else{
          $output['result']=false;
        $output['msg']="error 04";
    }

    mysqli_close($conn);
    echo json_encode($output);

?>