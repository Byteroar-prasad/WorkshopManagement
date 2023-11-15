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
        $estimate_id = htmlspecialchars($_POST['estimate_id']);
        $sublet_description = htmlspecialchars($_POST['sublet_description']);
        $sublet_price = htmlspecialchars($_POST['sublet_price']);

        $AddSubletsql = "INSERT INTO `tbl_estimate_sublet`(`sublet_id`, `estimate_id`, `sublet_description`, `sublet_price`, `sublet_datetime`) VALUES (null, '$estimate_id', '$sublet_description', '$sublet_price', '$currentDate')";
        if ($conn->query($AddSubletsql) === TRUE) {
        //   echo "Record updated successfully";
        
                //get all Sublet
                $SubletCount=0;
                $getSubletSQL=$conn->query("SELECT * FROM tbl_estimate_sublet WHERE estimate_id='$estimate_id' ORDER BY sublet_id ASC");
                while($gssRs = $getSubletSQL->fetch_array()){

                    $SubletId=$gssRs[0];
                    $SubletEstimateId=$gssRs[1];
                    $SubletDescription=$gssRs[2];
                    $SubletPrice=number_format($gssRs[3],2);
                    $SubletDateTime=$gssRs[4];

                    $SubletCount++;
                    
                    $row='
                            <tr>
                                <td>'.$SubletCount.'</td>
                                <td>'.$SubletDescription.'</td>
                                <td>'.$SubletPrice.'</td>
                                <td>
                                    <form method="POST" id="Delete-Sublet">
                                        <input type="hidden" name="sublet_id" value="'.$SubletId.'" readonly>
                                        <input type="hidden" name="estimate_id" value="'.$SubletEstimateId.'" readonly>
                                        <button type="submit" id="btn-delete-sublet" class="btn text-white bg-red"><i class="fa fa-times"></i></button>
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