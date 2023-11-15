  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');


    $output=[]; 
    $datalist=array();
    $ClientHowKnowList = array();
    $ClientCount = array();


        $query="SELECT how_to_know, COUNT(*) FROM tbl_client GROUP BY how_to_know ORDER BY COUNT(*) DESC";
        $getClient=$conn->query($query);
        while ($gc=$getClient->fetch_array()) {

          $ClKnow=$gc[0];
          $Ccount=$gc[1];


                array_push($ClientHowKnowList,$ClKnow);
                array_push($ClientCount,$Ccount);

    
    }

    $output['result']=true;
    

    $output['clientList'] = $ClientHowKnowList;
    $output['clientCount'] = $ClientCount;




   





   


    echo json_encode($output);
    
    
    