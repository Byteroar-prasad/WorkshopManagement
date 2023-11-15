  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');


    $output=[]; 
    $datalist=array();
    $ThisMonthlyJobs = array();
    $LastMonthJobs = array();


    //////////////////This Month//////////////////////////
    $date_month = date("Y-m");
    $getThisMonthQuary = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$date_month%' ";
    $ThisMonthresult = mysqli_query($conn, $getThisMonthQuary);
    $monthly_jobs = mysqli_fetch_assoc($ThisMonthresult)['COUNT(*)'];

                array_push($ThisMonthlyJobs,$monthly_jobs);


    ///////////////////Last Month/////////////////////////
    $last_month= date('Y-m', strtotime('-1 month', time()));
    $getLastMonthQuary = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$last_month%' ";
    $LastMonthresult = mysqli_query($conn, $getLastMonthQuary);
    $last_monthly_jobs = mysqli_fetch_assoc($LastMonthresult)['COUNT(*)'];

                array_push($LastMonthJobs,$last_monthly_jobs);

    


    $output['result']=true;

    $output['thisMonthSummery'] = $ThisMonthlyJobs;
    $output['lastMonthSummery'] = $LastMonthJobs;



    echo json_encode($output);
    
    
    