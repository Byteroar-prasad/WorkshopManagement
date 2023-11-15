<?php
    require_once('../db/database.php');
    require_once "../mail/autoload.php";
    require_once "../mail/phpMailer.php";
    require_once "../mail/smtp.php";
    
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $vehicle_detail_id = htmlspecialchars($_POST['vehicle_detail_id']);
        $customer_email = htmlspecialchars($_POST['customer_email']);
        $reg_customer = htmlspecialchars($_POST['reg_customer']);
        $status_type = htmlspecialchars($_POST['status_type']);
        $remark = htmlspecialchars($_POST['remark']);
        

        $sql = "INSERT INTO `tbl_status` (`status_type`, `remark`, `vehicle_detail_id`) VALUES (?,?,?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $status_type, $remark, $vehicle_detail_id);

        $result = mysqli_stmt_execute($stmt);

        if($result)
        {
            echo 'Completed';
            
            
            if($status_type=='Repair Complete'){
                
                
                $sql = "UPDATE tbl_vehicle_details SET stat='2' WHERE v_id= '$vehicle_detail_id' ";

                if ($conn->query($sql) === TRUE) {
                  echo "Record updated successfully";
                  
                  
                  
                  
                  
                  
                // ini_set( 'display_errors', 1 );
                // error_reporting( E_ALL );
                // $from = "prestigeautomobile@99software.lk";
                // $to = $customer_email;
                // $subject = "Repair Complete";
                // $message = "
            
            
                //         Dear $reg_customer,

                //         Your vehicle repair is complete and can be collected. Please call your service advisor and confirm.

                        
                //         Regards,
                //         Prestige Automobile (Pvt) Ltd
                        
                        

                //         ---------------- This is a auto genereted Email by Prestige Automobile (Pvt) Ltd ----------------

                        
                //         ";
                //         $headers = "From:" . $from;
                //         mail($to,$subject,$message, $headers);
                        
                        
                        
                $msgContent="
                

                        
                        <div style='margin-top: 50px; width: 500px; border: 1px solid grey; left: 0;'>
                          <div style='position: relative; top: -35px; margin: 20px;'>
                            <img style='width: 100px; position: relative; left: 30px; margin: 0 0 10px 0;' src='http://amazofttestcloud.com/clients/bae/assets/logo-black-transparent.png' ALIGN='right' />
                            <h2 style='background-color:white;'>Dear $reg_customer,</h2>
                            <p style='padding-left: 20px;'>Your vehicle repair is completed and can be collected. Please call your service advisor and confirm.</p>
                            <p style='padding-left: 20px;'>
                                
                                Regards,<br/>
                                Bavarian Automobile Engineering (Pvt) Ltd
                            
                            </p>
                            
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
                        $mail->addAddress($customer_email,"");
                        $mail->isHTML(true);
                        $mail->Subject = "Repair Complete";
                        $mail->Body = $msgContent;
                        $mail->AltBody = "Repair Complete";
                        $mail->send();        

                  
                } else {
                  echo "Error updating record: " . $conn->error;
                }

                
            }else{
                
            }

            


        }else{
            
            echo 'Error';
            
        }


    }

    mysqli_close($conn);

    ?>