<?php
    require_once('../db/database.php');
    require_once "../mail/autoload.php";
    require_once "../mail/phpMailer.php";
    require_once "../mail/smtp.php";
    $db=new DB();
    $conn=$db->connect();
    session_start();

    $output=[];
                


    // if($_POST){

        if(!isset($_POST['email'])){
            $output['result']=false;
            $output['msg']='Enter a valid email.';
        }else{
             if(!isset($_POST['reg_date'])){
                 $output['result']=false;
                $output['msg']='Enter a date for registration.';
                 
             }else{
                 
                 //all code goes here
                 
                $email=htmlspecialchars($_POST['email']);
                $reg_date=htmlspecialchars($_POST['reg_date']);
                
      $client_id="";
      if(isset($_POST['client_id'])){
          $client_id=htmlspecialchars($_POST['client_id']);
      }
      
      $reg_customer="";
      if(isset($_POST['reg_customer'])){
          $reg_customer=htmlspecialchars($_POST['reg_customer']);
      }
      
      $reg_phone_no="";
      if(isset($_POST['reg_phone_no'])){
          $reg_phone_no=htmlspecialchars($_POST['reg_phone_no']);
      }
      
      $f_reg_date="";
      if(isset($_POST['f_reg_date'])){
          $f_reg_date=htmlspecialchars($_POST['f_reg_date']);
      }
      
      $service_booklet="";
      if(isset($_POST['service_booklet'])){
          $service_booklet=htmlspecialchars($_POST['service_booklet']);
      }
      
      $soc_hv_battery="";
      if(isset($_POST['soc_hv_battery'])){
          $soc_hv_battery=htmlspecialchars($_POST['soc_hv_battery']);
      }
      
      $reg_model="";
      if(isset($_POST['reg_model'])){
          $reg_model=htmlspecialchars($_POST['reg_model']);
      }
      
      $reg_chassis_no="";
      if(isset($_POST['reg_chassis_no'])){
          $reg_chassis_no=htmlspecialchars($_POST['reg_chassis_no']);
      }
      
      $reg_license_no="";
      if(isset($_POST['reg_license_no'])){
          $reg_license_no=htmlspecialchars($_POST['reg_license_no']);
      }
      
      $reg_mileage="";
      if(isset($_POST['reg_mileage'])){
          $reg_mileage=htmlspecialchars($_POST['reg_mileage']);
      }
      
      $reg_fuel="";
      if(isset($_POST['reg_fuel'])){
          $reg_fuel=htmlspecialchars($_POST['reg_fuel']);
      }
      
      $reg_customer_charging="";
      if(isset($_POST['reg_customer_charging'])){
          $reg_customer_charging=htmlspecialchars($_POST['reg_customer_charging']);
      }
      
      $display="";
      if(isset($_POST['display'])){
          $display=htmlspecialchars($_POST['display']);
      }
      
      $display_remark="";
      if(isset($_POST['display_remark'])){
          $display_remark=htmlspecialchars($_POST['display_remark']);
      }
      
      $interior_lights="";
      if(isset($_POST['interior_lights'])){
          $interior_lights=htmlspecialchars($_POST['interior_lights']);
      }
      
      $interior_lights_remark="";
      if(isset($_POST['interior_lights_remark'])){
          $interior_lights_remark=htmlspecialchars($_POST['interior_lights_remark']);
      }
      
      $signals="";
      if(isset($_POST['signals'])){
          $signals=htmlspecialchars($_POST['signals']);
      }
      
      $signals_remark="";
      if(isset($_POST['signals_remark'])){
          $signals_remark=htmlspecialchars($_POST['signals_remark']);
      }
      
      $steering="";
      if(isset($_POST['steering'])){
          $steering=htmlspecialchars($_POST['steering']);
      }
      
      $steering_remark="";
      if(isset($_POST['steering_remark'])){
          $steering_remark=htmlspecialchars($_POST['steering_remark']);
      }
      
      $hand_brake="";
      if(isset($_POST['hand_brake'])){
          $hand_brake=htmlspecialchars($_POST['hand_brake']);
      }
      
      $hand_brake_remark="";
      if(isset($_POST['hand_brake_remark'])){
          $hand_brake_remark=htmlspecialchars($_POST['hand_brake_remark']);
      }
      
      $aircon="";
      if(isset($_POST['aircon'])){
          $aircon=htmlspecialchars($_POST['aircon']);
      }
      
      $aircon_remark="";
      if(isset($_POST['aircon_remark'])){
          $aircon_remark=htmlspecialchars($_POST['aircon_remark']);
      }
      
      $comments="";
      if(isset($_POST['comments'])){
          $comments=htmlspecialchars($_POST['comments']);
      }
      
      $vehicle_screen="";
      if(isset($_POST['vehicle_screen'])){
          $vehicle_screen=htmlspecialchars($_POST['vehicle_screen']);
          
          $screenName = time().".png";
          
          file_put_contents("../vehicle_damage_ss/".$screenName,file_get_contents($vehicle_screen));
          
      }
      
      $body_work="";
      if(isset($_POST['body_work'])){
          $body_work=htmlspecialchars($_POST['body_work']);
      }
      
      $spare_wheel="";
      if(isset($_POST['spare_wheel'])){
          $spare_wheel=htmlspecialchars($_POST['spare_wheel']);
      }
      
      $jack="";
      if(isset($_POST['jack'])){
          $jack=htmlspecialchars($_POST['jack']);
      }
      
      $tools="";
      if(isset($_POST['tools'])){
          $tools=htmlspecialchars($_POST['tools']);
      }
      
      $cd="";
      if(isset($_POST['cd'])){
          $cd=htmlspecialchars($_POST['cd']);
      }
      
      $lighter="";
      if(isset($_POST['lighter'])){
          $lighter=htmlspecialchars($_POST['lighter']);
      }
      
      $sim="";
      if(isset($_POST['sim'])){
          $sim=htmlspecialchars($_POST['sim']);
      }
      
      $extra="";
      if(isset($_POST['extra'])){
          $extra=htmlspecialchars($_POST['extra']);
      }
      
      $amount="";
      if(isset($_POST['amount'])){
          $amount=htmlspecialchars($_POST['amount']);
      }
      
      $pay="";
      if(isset($_POST['pay'])){
          $pay=htmlspecialchars($_POST['pay']);
      }
      
      $user_name="";
      if(isset($_POST['user_name'])){
          $user_name=htmlspecialchars($_POST['user_name']);
      }

      ////////////////New Adding///////////////////

      $power_window="";
      if(isset($_POST['power_window'])){
          $power_window=htmlspecialchars($_POST['power_window']);
      }

      $power_window_remark="";
      if(isset($_POST['power_window_remark'])){
          $power_window_remark=htmlspecialchars($_POST['power_window_remark']);
      }

      $exterior_lights="";
      if(isset($_POST['exterior_lights'])){
          $exterior_lights=htmlspecialchars($_POST['exterior_lights']);
      }

      $exterior_lights_remark="";
      if(isset($_POST['exterior_lights_remark'])){
          $exterior_lights_remark=htmlspecialchars($_POST['exterior_lights_remark']);
      }

      $horn="";
      if(isset($_POST['horn'])){
          $horn=htmlspecialchars($_POST['horn']);
      }

      $horn_remark="";
      if(isset($_POST['horn_remark'])){
          $horn_remark=htmlspecialchars($_POST['horn_remark']);
      }

      $grab_handles="";
      if(isset($_POST['grab_handles'])){
          $grab_handles=htmlspecialchars($_POST['grab_handles']);
      }

      $grab_handles_remark="";
      if(isset($_POST['grab_handles_remark'])){
          $grab_handles_remark=htmlspecialchars($_POST['grab_handles_remark']);
      }

      $sun_roof="";
      if(isset($_POST['sun_roof'])){
          $sun_roof=htmlspecialchars($_POST['sun_roof']);
      }

      $sun_roof_remark="";
      if(isset($_POST['sun_roof_remark'])){
          $sun_roof_remark=htmlspecialchars($_POST['sun_roof_remark']);
      }

      $speaker_covers="";
      if(isset($_POST['speaker_covers'])){
          $speaker_covers=htmlspecialchars($_POST['speaker_covers']);
      }

      $speaker_covers_remark="";
      if(isset($_POST['speaker_covers_remark'])){
          $speaker_covers_remark=htmlspecialchars($_POST['speaker_covers_remark']);
      }

      $carpets="";
      if(isset($_POST['carpets'])){
          $carpets=htmlspecialchars($_POST['carpets']);
      }

      $carpets_remark="";
      if(isset($_POST['carpets_remark'])){
          $carpets_remark=htmlspecialchars($_POST['carpets_remark']);
      }

      $seat_covers="";
      if(isset($_POST['seat_covers'])){
          $seat_covers=htmlspecialchars($_POST['seat_covers']);
      }

      $seat_covers_remark="";
      if(isset($_POST['seat_covers_remark'])){
          $seat_covers_remark=htmlspecialchars($_POST['seat_covers_remark']);
      }

      $rear_display="";
      if(isset($_POST['rear_display'])){
          $rear_display=htmlspecialchars($_POST['rear_display']);
      }

      $rear_display_remark="";
      if(isset($_POST['rear_display_remark'])){
          $rear_display_remark=htmlspecialchars($_POST['rear_display_remark']);
      }
      ///////////////End New Adding///////////////////


       // $output['test']=$reg_date.' | '.$reg_customer;


        // $output['q']="INSERT INTO tbl_vehicle_details VALUES(null,'aaa','$reg_date','$reg_customer','$reg_phone_no','$f_reg_date','$service_booklet','$soc_hv_battery','$reg_model','$reg_chassis_no','$reg_license_no','$reg_mileage','$reg_fuel','$reg_customer_charging','$display','$display_remark','$interior_lights','$interior_lights_remark','$signals','$signals_remark','$steering','$steering_remark','$hand_brake','$hand_brake_remark','$aircon','$aircon_remark','$wiper_blades','$wiper_blades_remark','$windows_glass','$windows_glass_remark','$replace_microfilter','$replace_microfilter_remark','$coolant','$coolant_remark','$engine_oil','$engine_oil_remark','$v_belt','$v_belt_remark','$noticeable_leaks','$noticeable_leaks_remark','$damage_animals','$damage_animals_remark','$annual_check','$shock','$shock_remark','$tyre_tread','$tyre_tread_remark','$engine_gearbox','$engine_gearbox_remark','$front_axle','$front_axle_remark','$front_brake','$front_brake_remark','$rear_axle','$rear_axle_remark','$rear_brake','$rear_brake_remark','$brake_lines','$brake_lines_remark','$exhaust_system','$exhaust_system_remark','$fuel_tank','$fuel_tank_remark','$comments','$vehicle_screen','$r_f_tyre_tread','$r_b_tyre_tread','$l_f_tyre_tread','$l_b_tyre_tread','$body_work','$spare_wheel','$jack','$tools','$cd','$lighter','$sim','$extra','$amount','$pay','1','$user_name',null)";

    //   if($conn->query("INSERT INTO tbl_vehicle_details VALUES(null,'$email','$reg_date','$reg_customer','$reg_phone_no','$f_reg_date','$service_booklet','$soc_hv_battery','$reg_model','$reg_chassis_no','$reg_license_no','$reg_mileage','$reg_fuel','$reg_customer_charging','$display','$display_remark','$interior_lights','$interior_lights_remark','$signals','$signals_remark','$steering','$steering_remark','$hand_brake','$hand_brake_remark','$aircon','$aircon_remark','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','$comments','$vehicle_screen','','','','','$body_work','$spare_wheel','$jack','$tools','$cd','$lighter','$sim','$extra','$amount','$pay','1','$user_name','','$power_window','$power_window_remark','$exterior_lights','$exterior_lights_remark','$horn','$horn_remark','$grab_handles','$grab_handles_remark','$sun_roof','$sun_roof_remark','$speaker_covers','$speaker_covers_remark','$carpets','$carpets_remark','$seat_covers','$seat_covers_remark','$rear_display','$rear_display_remark','','','','','','','','','',null)")){

        
        if($conn->query("INSERT INTO tbl_vehicle_details VALUES(null,'$email','$reg_date','$reg_customer','$reg_phone_no','$f_reg_date','$service_booklet','$soc_hv_battery','$reg_model','$reg_chassis_no','$reg_license_no','$reg_mileage','$reg_fuel','$reg_customer_charging','$display','$display_remark','$interior_lights','$interior_lights_remark','$signals','$signals_remark','$steering','$steering_remark','$hand_brake','$hand_brake_remark','$aircon','$aircon_remark','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','$comments','$screenName','','','','','$body_work','$spare_wheel','$jack','$tools','$cd','$lighter','$sim','$extra','$amount','$pay','1','$user_name','','$power_window','$power_window_remark','$exterior_lights','$exterior_lights_remark','$horn','$horn_remark','$grab_handles','$grab_handles_remark','$sun_roof','$sun_roof_remark','$speaker_covers','$speaker_covers_remark','$carpets','$carpets_remark','$seat_covers','$seat_covers_remark','$rear_display','$rear_display_remark','','','','','','','','','',null)")){
        
        
        // $conn->query("INSERT INTO tbl_job_details VALUES(null,'$email','$reg_date','$reg_customer','$reg_phone_no','$f_reg_date','$reg_model','$reg_chassis_no','$reg_license_no','$reg_mileage','$user_name','$comments','1',null)");

          //get last record

        $lastId=0;
        
        $getLast=$conn->query("SELECT v_id FROM tbl_vehicle_details ORDER BY v_id DESC LIMIT 1");
        if($lRs=$getLast->fetch_array()){

          $lastId=$lRs[0];
          
          //$sendId=base64_encode($lastId);


        }
        
        //send images///////////
        
        $error=array();
        $extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
    
    
        foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
        if(in_array($ext,$extension)) {
            if(!file_exists("../image_car/".$file_name)) {
            if(move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../image_car/".$file_name)){
                
                //send to database
                $sql = "INSERT INTO `tbl_vehicle_images`(`image_id`, `image`, `vehicle_detail_id`) VALUES(null,'$file_name','$lastId')";
                
                $conn->query($sql);
                
                
                
                
                
            }
        }// }else {
        //     $filename=basename($file_name,$ext);
        //     $newFileName=$filename.time().".".$ext;
        //     move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../image_car/".$newFileName);
        // }
    }
    else {
        array_push($error,"$file_name, ");
    }
}

//send status
        if($conn->query("INSERT INTO tbl_status VALUES(null,'Vehicle received','null','$lastId',null)")){
            
            
            // if($conn->query("INSERT INTO tbl_tax VALUES(null,'$lastId',null,'0','0',null,'0',null,'$client_id')")){
                
                //send mail
                $sendId=base64_encode($lastId);


                        
                        
                        $msgContent="
                            
                        <div style='margin-top: 50px; width: 500px; border: 1px solid grey; left: 0;'>
                          <div style='position: relative; top: -35px; margin: 20px;'>
                            <img style='width: 100px; position: relative; left: 30px; margin: 0 0 10px 0;' src='http://amazofttestcloud.com/clients/bae/assets/logo-black-transparent.png' ALIGN='right' />
                            <h2 style='background-color:white;'>Dear $reg_customer,</h2>
                            <p style='padding-left: 20px;'>Your vehicle has been received by one of our service advisors, please click on the following link to view your vehicle's</p>
                            <p style='padding-left: 20px;'>inventory report: <a href='http://amazofttestcloud.com/clients/bae/your_car?v_id=".$sendId."'>Click here</a></p>
                            <p style='padding-left: 20px;'>
                                
                                Regards,<br/>
                                The Management Team,<br/>
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
                        $mail->addAddress($email,"");
                        $mail->isHTML(true);
                        $mail->Subject = "Vehicle Details";
                        $mail->Body = $msgContent;
                        $mail->AltBody = "Vehicle Details";
                        $mail->send();
                
                
                $output['result']="ok_";
                $output['msg']='Successfully registered.';
                $output['id']=$lastId;
                
                
                
        //   }else{

        //      $output['result']=false;
        //     $output['msg']='Something went wrong (error code Tax)';
          
          
        //   }
           
    }else{

        $output['result']=false;
        $output['msg']='Something went wrong (error code xxxx)';
          
          
    }
/////////////
          
          



          /////////////////
            // $output['result']=true;
            // $output['id']=$lastId;
            // $output['msg']='Successfully registered.';

            
           

       }else{
        $output['result']=false;
        $output['msg']='Something went wrong (error code 4785)';
       }

     
   
                 
                 
             }
            
            
        }

       


    mysqli_close($conn);
    echo json_encode($output);



