<?php
    require_once('../db/database.php');
    // require_once "../mail/autoload.php";
    // require_once "../mail/phpMailer.php";
    // require_once "../mail/smtp.php";
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $job_id = htmlspecialchars($_POST['job_id']);
        $invoice_id = htmlspecialchars($_POST['invoice_id']);
        $customer = htmlspecialchars($_POST['customer']);
        $client_address = htmlspecialchars($_POST['client_address']);
        $email = htmlspecialchars($_POST['email']);
        $phone_number = htmlspecialchars($_POST['phone_number']);

        $licens_no = htmlspecialchars($_POST['licens_no']);
        $chassis_no = htmlspecialchars($_POST['chassis_no']);
        $mileage = htmlspecialchars($_POST['mileage']);
        $invoice_date = htmlspecialchars($_POST['invoice_date']);
        $note = htmlspecialchars($_POST['note']);

        $invoice_screen = htmlspecialchars($_POST['invoice_screen']);

        $screenName = time().".jpg";


        file_put_contents("../invoice_ss/".$screenName,file_get_contents($invoice_screen));


        $labour_total = 0;
        if(isset($_POST['labour_total'])){
            $labour_total = htmlspecialchars($_POST['labour_total']); 
        }else{
             $labour_total = 0;
        }

        $parts_total = 0;
        if(isset($_POST['parts_total'])){
            $parts_total = htmlspecialchars($_POST['parts_total']); 
        }else{
             $parts_total = 0;
        }

        $sublet_price = 0;
        if(isset($_POST['sublet_price'])){
            $sublet_price = htmlspecialchars($_POST['sublet_price']); 
        }else{
             $sublet_price = 0;
        }

        $sub_total = 0;
        if(isset($_POST['sub_total'])){
            $sub_total = htmlspecialchars($_POST['sub_total']); 
        }else{
             $sub_total = 0;
        }

        $vat = 0;
        if(isset($_POST['vat'])){
            $vat = htmlspecialchars($_POST['vat']); 
        }else{
             $vat = 0;
        }

        $advance_pay = 0;
        if(isset($_POST['advance_pay'])){
            $advance_pay = htmlspecialchars($_POST['advance_pay']); 
        }else{
             $advance_pay = 0;
        }

        $grand_total = 0;
        if(isset($_POST['grand_total'])){
            $grand_total = htmlspecialchars($_POST['grand_total']); 
        }else{
             $grand_total = 0;
        }

        // $sub_total = htmlspecialchars($_POST['sub_total']);
        // $vat = htmlspecialchars($_POST['vat']);
        // $grand_total = htmlspecialchars($_POST['grand_total']);


        $advisor = htmlspecialchars($_POST['advisor']);

        $pay = 0;
        $stat = 0;

       


        $sql = "INSERT INTO `tbl_invoice`(`invoice_id`, `customer`, `client_address`, `email`, `phone_number`, `licens_no`, `chassis_no`, `mileage`, `invoice_date`, `note`, `labour_total`, `parts_total`, `sublet_price`, `sub_total`, `vat`, `grand_total`, `advisor`, `pay`, `stat`, `advance_pay`) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssssssssssssssssssss", $invoice_id, $customer, $client_address, $email, $phone_number, $licens_no, $chassis_no, $mileage, $currentDate, $note, $labour_total, $parts_total, $sublet_price, $sub_total, $vat, $grand_total, $advisor, $pay, $stat, $advance_pay);
        $result = mysqli_stmt_execute($stmt);
        if($result)
        {
            echo 'Completed';

            //OLD Update
            // $conn->query("UPDATE tbl_vehicle_details SET stat='2' WHERE v_id='$job_id'");
            
            //Job Details Stat Update
            $conn->query("UPDATE tbl_job_details SET stat='2' WHERE job_id='$job_id'");
            
            //TAX Date Time Update
            $conn->query("UPDATE tbl_tax SET datetime='$currentDate' WHERE job_id='$job_id'");


            $lastId=0;
        
            $getLast=$conn->query("SELECT invoice_new_id FROM tbl_invoice ORDER BY invoice_new_id DESC LIMIT 1");
            if($lRs=$getLast->fetch_array()){

              $lastId=$lRs[0];

            }

            $labour_data="";


            if(isset($_POST['labour_details'])){

                $ld = $_POST['labour_details'];
                foreach ($ld as $key=>$labour_details) {
                   // echo $labour_details;
                    $labour_data = $labour_details;

                    $labour_explode = explode(",",$labour_data);
                    $labour_id = $labour_explode[0];


                    if($conn->query("INSERT INTO tbl_invoice_labour VALUES(null,'$lastId','$labour_id','$labour_data',null)")){

                        echo 'Labour Added';

                    }else{
                        echo "Error123";
                    }




                }

            }




            $part_data="";

            if(isset($_POST['part_details'])){


                    $pd = $_POST['part_details'];
                    foreach ($pd as $key=>$part_details) {
                       // echo $part_details;
                        $part_data = $part_details;

                        $labour_parts_explode = explode(",",$part_data);
                        $part_labour_id = $labour_parts_explode[0];


                        if($conn->query("INSERT INTO tbl_invoice_parts VALUES(null,'$lastId','$part_labour_id','$part_data',null)")){

                            echo 'Part Added';

                        }else{
                            echo "Error478";
                        }





                    }

            }


              


                if($conn->query("INSERT INTO tbl_invoice_image VALUES(null,'$job_id','$lastId','$screenName',null)")){

                        echo 'Invoice Screenshoot Save Success';
                        // echo $invoice_screen;
                        
                            //JOB Closing here
                            // $sql = "UPDATE tbl_vehicle_details SET `stat`= '2' WHERE v_id= '$job_id' ";
                            // if ($conn->query($sql) === TRUE) {
                            //   echo "Record change to stat 2";
                            // } else {
                            //   echo "Error updating stat 1 to 2";
                            // }
                        
                        

                    }else{
                        echo "Invoice Screenshoot Save Error";
                    }



        //////////////////////////////////////Email///////////////////////////////////////////////////////
        
        
        
        //  $msgContent="
                            
        //                 <div style='margin-top: 50px; width: 80%; border: 1px solid grey; left: 0;'>
        //                   <div style='position: relative; top: -35px; margin: 20px;'>
                            
                            
        //                     <img src='http://amazofttestcloud.com/clients/bae/invoice_ss/$screenName' style='width: 100%;'>
                            
        //                     <hr>
        //                     <div style='margin: auto; text-align: center; position: relative;'>This is an auto genereted Email by Bavarian Automobile Engineering (Pvt) Ltd</div>
        //                     <div style='margin: auto; text-align: center; position: relative; font-size: 10px;'>Powered by <a href='http://amazoft.com/' target='_blank'>AMAZOFT (Pvt) Ltd</a></div>
        //                   </div>
        //                 </div>
                        
        //                 ";
                        
                        
        //                 $mail = new PHPMailer;
        //                 $mail->SMTPDebug = 0;
                        
                        
                        
                        
        //                 $mail->isSMTP();
        //                 $mail->Host = 'localhost';
        //                 $mail->SMTPAuth = false;
        //                 $mail->SMTPAutoTLS = false;
        //                 $mail->Port = 25;
                        
                        
                        
                        
        //                 $mail->From = "donotreply@bae.lk";
        //                 $mail->FromName = "Bavarian Automobile Engineering";
        //                 $mail->addAddress($email,"");
        //                 $mail->isHTML(true);
        //                 $mail->Subject = "Invoice";
        //                 $mail->Body = $msgContent;
        //                 $mail->AltBody = "Invoice";
        //                 $mail->send();
        
        
        
                //////////////////////////////////////END Email////////////////////////////////////////////////////////////////////////////////////

            


        }else{  
            echo 'Error';   
        }


    }

    mysqli_close($conn);

?>