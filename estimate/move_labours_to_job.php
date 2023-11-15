<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $estimate_id = htmlspecialchars($_POST['estimate_id']);
        $job_id = htmlspecialchars($_POST['job_id']);
        $LabourDiscount=0;


          $getEstimateLabourDetailsSQL=$conn->query("SELECT * FROM tbl_estimate_labour WHERE estimate_id='$estimate_id' ORDER BY estimate_labour_id ASC");
          while($geldRs = $getEstimateLabourDetailsSQL->fetch_array()){
            $EstimateLabourId=$geldRs[0];
            //$estimate_id=$geldRs[1];
            $LabourId=$geldRs[2];
            $EstimateFru=$geldRs[3];
            $LabourNameOne=$geldRs[4];
            $LabourNameTwo=$geldRs[5];


            $AddJobToLaboursSql = "INSERT INTO `tbl_job_labour`(`job_labour_id`, `job_id`, `labour_id`, `job_fru`, `labour_discount`, `labour_name_1`, `labour_name_2`, `labour_datetime`) VALUES (null, '$job_id', '0', '$EstimateFru', '$LabourDiscount', '$LabourNameOne', '$LabourNameTwo', '$currentDate')";
            if($conn->query($AddJobToLaboursSql) === TRUE){
              echo "Labours added successfully";
            }else{
              echo "Error updating record";
            }


          }


    }

    mysqli_close($conn);

?>