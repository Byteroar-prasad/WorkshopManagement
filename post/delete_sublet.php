<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];
    $dataArray = array();

    if($_POST)
    {
        $job_id = htmlspecialchars($_POST['job_id']);
        $sublet_id = htmlspecialchars($_POST['sublet_id']);

        $DeleteSubletsql = "DELETE FROM tbl_job_sublet WHERE sublet_id='$sublet_id'";
        if ($conn->query($DeleteSubletsql) === TRUE) {
        //   echo "Record updated successfully";
                //get all Sublet
                $SubletCount=0;
                $getSubletSQL=$conn->query("SELECT * FROM tbl_job_sublet WHERE job_id='$job_id' ORDER BY sublet_id ASC");
                while($gssRs = $getSubletSQL->fetch_array()){

                    $SubletId=$gssRs[0];
                    $SubletJobId=$gssRs[1];
                    $SubletDescription=$gssRs[2];
                    $SubletPrice=number_format($gssRs[3],2);
                    $SubletUserId=$gssRs[4];
                    $SubletDateTime=$gssRs[5];
                    $SubletCostPrice=$gssRs[6];

                    $SubletCount++;
                    
                    $row='
                            <tr>
                                <td>'.$SubletCount.'</td>
                                <td>'.$SubletDescription.'</td>
                                <td>'.$SubletPrice.'</td>
                                <td>'.$SubletCostPrice.'</td>
                                <td>
                                    <form method="POST" id="Delete-Sublet">
                                        <input type="hidden" name="sublet_id" value="'.$SubletId.'" readonly>
                                        <input type="hidden" name="job_id" value="'.$SubletJobId.'" readonly>
                                        <button type="submit" class="btn text-white bg-red"><i class="fa fa-times"></i></button>
                                    </form>
                                </td>
                            </tr>
                        ';
                        
                        array_push($dataArray,$row);
                    
                    
                }
                
                /////////////////
                
                
                $output['result'] = true;
                $output['msg'] = 'Successfully added sublet price.';
                $output['data'] = $dataArray;
            
           
        }else {

            $output['result'] = false;
            $output['msg'] = 'Error added please reload the page'; 
              
        }




        $conn->close();
    }
    
    
    echo json_encode($output);


    ?>