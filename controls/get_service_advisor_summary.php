  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');


    $output=[]; 
    $datalist=array();
    $AdvisorList = array();
    $AdvisorVehicleCountList = array();

    if(isset($_POST['advisor_start_date']) && isset($_POST['advisor_end_date'])){

        $advisor_start_date=htmlspecialchars($_POST['advisor_start_date']);
        $advisor_end_date=htmlspecialchars($_POST['advisor_end_date']);

        // $sql ="SELECT user_name, COUNT(*) FROM tbl_vehicle_details GROUP BY user_name ORDER BY COUNT(*) DESC ";
        $query="SELECT user_name, COUNT(*) FROM tbl_job_details WHERE DATE(reg_date) BETWEEN '$advisor_start_date' AND '$advisor_end_date' GROUP BY user_name ORDER BY COUNT(*) DESC";
        $getServiceAdvisor=$conn->query($query);
        while ($gsa=$getServiceAdvisor->fetch_array()) {

          $AdvisorName=$gsa[0];
          $AdvisorVehicleCount=$gsa[1];


                array_push($AdvisorList,$AdvisorName);
                array_push($AdvisorVehicleCountList,$AdvisorVehicleCount);

            



          
      $obj=' 
            <tr>
                <td>'.$AdvisorName.'</td> 
                <td>'.$AdvisorVehicleCount.'</td>
            </tr>

          ';

          array_push($datalist,$obj);



      
    
    }

    $output['result']=true;
    $output['data']=$datalist;
    

    $output['advisorList'] = $AdvisorList;
    $output['advisorVehicleCountList'] = $AdvisorVehicleCountList;




    }else{
        $output['result']=false;
        $output['data']="Invalid request.";
    }






   


    echo json_encode($output);
    
    
    