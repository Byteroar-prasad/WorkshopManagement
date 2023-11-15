<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];
    $dataArray = array();
    $AdddataArray = array();

    if($_POST)
    {
        $job_id = htmlspecialchars($_POST['job_id']);
        $advance_id = htmlspecialchars($_POST['advance_id']);
        $license_number = htmlspecialchars($_POST['license_number']);
        $stat = 0;

        $AddAdvancesql = "UPDATE `tbl_advance` SET job_id='', stat='$stat' WHERE advance_id='$advance_id' ";
        if ($conn->query($AddAdvancesql) === TRUE) {
        
                //get all Advance Available
                $getAdvanceSQL=$conn->query("SELECT * FROM tbl_advance WHERE license_number= '$license_number' AND stat='0'");
                while($gasRs = $getAdvanceSQL->fetch_array()){

                    $advance_id = $gasRs[0];
                    $advance_note = $gasRs[3];
                    $advance_pay=(double)$gasRs[4];
                    $advance_stat = $gasRs[5];
                    $advance_date = $gasRs[6];

                    $AdvanceYear = date('Y', strtotime($advance_date));
                    $AdvanceNumber = 10000+$advance_id;
                    $AdvancePay = number_format($advance_pay,2);

                    
                    $row='
                            <tr>
                                <td scope="row">BAE/AD/'.$AdvanceYear.'/'.$AdvanceNumber.'</td>
                                <td>'.$AdvancePay.'</td>
                                <td>'.$advance_date.'</td>
                                <td>
                                    <form id="Add-Advance" method="POST">
                                        <input type="hidden" class="form-control" name="job_id" id="job_id" value="'.$job_id.'" readonly required>
                                        <input type="hidden" class="form-control" name="advance_id" id="advance_id" value="'.$advance_id.'" readonly required>
                                        <input type="hidden" class="form-control" name="license_number" id="license_number" value="'.$license_number.'" readonly required>
                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Add to job</button>
                                    </form>
                                </td>
                            </tr>
                        ';
                        
                        array_push($dataArray,$row);
                    
                    
                }
                
                /////////////////
                //get all Advance Added
                $getAdvanceAddSQL=$conn->query("SELECT * FROM tbl_advance WHERE license_number= '$license_number' AND job_id='$job_id'");
                while($gaasRs = $getAdvanceAddSQL->fetch_array()){

                    $Addadvance_id = $gaasRs[0];
                    $Addadvance_note = $gaasRs[3];
                    $Addadvance_pay=(double)$gaasRs[4]; 
                    $Addadvance_stat = $gaasRs[5];
                    $Addadvance_date = $gaasRs[6];

                    $AddAdvanceYear = date('Y', strtotime($Addadvance_date));
                    $AddAdvanceNumber = 10000+$Addadvance_id;
                    $AddAdvancePay = number_format($Addadvance_pay,2);

                    
                    $rowAdd='
                            <tr>
                                <td scope="row">BAE/AD/'.$AddAdvanceYear.'/'.$AddAdvanceNumber.'</td>
                                <td>'.$AddAdvancePay.'</td>
                                <td>'.$Addadvance_date.'</td>
                                <td>
                                    <form id="Delete-Advance" method="POST">
                                        <input type="hidden" class="form-control" name="job_id" id="job_id" value="'.$job_id.'" readonly required>
                                        <input type="hidden" class="form-control" name="advance_id" id="advance_id" value="'.$Addadvance_id.'" readonly required>
                                        <input type="hidden" class="form-control" name="license_number" id="license_number" value="'.$license_number.'" readonly required>
                                        <button type="submit" class="btn text-white bg-red">X</button>
                                    </form>
                                </td>
                            </tr>
                        ';
                        
                        array_push($AdddataArray,$rowAdd);
                    
                    
                }
                
                
                /////////////////
                
                
                $output['result'] = true;
                $output['msg'] = 'Successfully added advance price.';
                $output['data'] = $dataArray;
                $output['dataAdded'] = $AdddataArray;
            
           
        }else {

            $output['result'] = false;
            $output['msg'] = 'Error added please reload the page'; 
              
        }




        $conn->close();
    }
    
    
    echo json_encode($output);


    ?>