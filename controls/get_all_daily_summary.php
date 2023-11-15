  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    date_default_timezone_set('Asia/Colombo');
    //$today=date('Y-m-d');

    $output=[]; 
    $datalist=array();
    $TodayJobs = array();
    $YesterdayJobs = array();


    //////////////////Today//////////////////////////
    $date_today = date("Y-m-d") ;
    $getTodayQuary = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$date_today%' ";
    $Todayresult = mysqli_query($conn, $getTodayQuary);
    $today_jobs = mysqli_fetch_assoc($Todayresult)['COUNT(*)'];

                array_push($TodayJobs,$today_jobs);


    ///////////////////Yesterday/////////////////////////
    $yesterday= date('Y-m-d', strtotime("-1 days"));
    $getYesterdayQuary = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$yesterday%' ";
    $Yesterdayresult = mysqli_query($conn, $getYesterdayQuary);
    $yesterday_jobs = mysqli_fetch_assoc($Yesterdayresult)['COUNT(*)'];

                array_push($YesterdayJobs,$yesterday_jobs);

    


    $output['result']=true;

    $output['todaySummery'] = $TodayJobs;
    $output['yesterdaySummery'] = $YesterdayJobs;



    echo json_encode($output);
    
    
    