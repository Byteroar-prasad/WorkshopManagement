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
        $job_id = htmlspecialchars($_POST['job_id']);
        
        
        $getClientEmail=$conn->query("SELECT reg_email FROM tbl_job_details WHERE job_id='$job_id' ");
        if($CERs=$getClientEmail->fetch_array()){
            $email=$CERs[0];
            
            $getInvoiceImage=$conn->query("SELECT invoice_ss FROM tbl_invoice_image WHERE job_id='$job_id' ORDER BY invoice_image_id DESC LIMIT 1");
            if($GIIRs=$getInvoiceImage->fetch_array()){
                $screenName=$GIIRs[0];
                
                
                
                //////////////////////////////////////Email///////////////////////////////////////////////////////
        
        
        
         $msgContent="
                            
                        <div style='margin-top: 50px; width: 80%; border: 1px solid grey; left: 0;'>
                          <div style='position: relative; top: -35px; margin: 20px;'>
                            
                            
                            <img src='http://amazofttestcloud.com/clients/bae/invoice_ss/$screenName' style='width: 100%;'>
                            
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
                        $mail->addAddress($email,"");
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

    mysqli_close($conn);
    echo json_encode($output);

?>