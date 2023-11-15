  <?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $output=[];
    //$today=date('Y-m-d');
    date_default_timezone_set('Asia/Colombo');
    // $currentDate=date('Y-m-d H:i:s');

    if (isset($_SESSION['Logged']) && $_SESSION['Logged'] == true) 
    {

      $user_email = $_SESSION["email"];

      $getEmpQuery=$conn->query("SELECT user_id,name,email,role FROM users_login WHERE email='$user_email' ");
      while ($emp=$getEmpQuery->fetch_array()) {

        $user_id = $emp['0']; 
        $user_name = $emp['1']; 
        $user_email = $emp['2']; 
        $user_role = $emp['3']; 
        

      }
      
    }

    else
    {
        ?>

            <script type="text/javascript">
                window.location.href="login.php";
            </script>

        <?php
    }
?>

<?php


    $output=[]; 
    $datalist=array();
    $ThisMonthlyJobs = array();
    $LastMonthJobs = array();


    //////////////////This Month//////////////////////////
    $date_month = date("Y-m");
    $getThisMonthQuary = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && reg_date LIKE '%$date_month%' ";
    $ThisMonthresult = mysqli_query($conn, $getThisMonthQuary);
    $monthly_jobs = mysqli_fetch_assoc($ThisMonthresult)['COUNT(*)'];

                array_push($ThisMonthlyJobs,$monthly_jobs);


    ///////////////////Last Month/////////////////////////
    $last_month= date('Y-m', strtotime('-1 month', time()));
    $getLastMonthQuary = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && reg_date LIKE '%$last_month%' ";
    $LastMonthresult = mysqli_query($conn, $getLastMonthQuary);+
    $last_monthly_jobs = mysqli_fetch_assoc($LastMonthresult)['COUNT(*)'];

                array_push($LastMonthJobs,$last_monthly_jobs);

    


    $output['result']=true;

    $output['thisMonthSummery'] = $ThisMonthlyJobs;
    $output['lastMonthSummery'] = $LastMonthJobs;
    // $output['lastMonth'] = $last_month;



    echo json_encode($output);
    
    
    