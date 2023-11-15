<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    
    $user_id='';
    $user_name='';
    $user_email='';
    $user_role='';


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
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="assets/assets/css/dark.css">


</head>

<body class="font-opensans" onload="startTime()">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

<!-- Start main html -->
<div id="main_content">

    <?php include_once('controls/side_nav.php'); ?>

    <!-- start main body part-->
    <div class="page">

        <!-- start body header -->
        <?php include_once('controls/top_nav.php'); ?>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="mb-4">
                            <h2>Welcome <?php echo $user_name; ?>!</h2>                            
                            <small>Measure How Fast You’re Growing Monthly Recurring Revenue. <a href="#">Learn More</a></small>
                        </div>                        
                    </div>
                </div>
                <?php if($user_role=='0'){ }else{ ?>
                <div class="row clearfix row-deck">
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">                                
                                <h6>All Jobs</h6>
                                <?php
                                  $sql = "SELECT COUNT(*) FROM tbl_job_details";
                                  $result = mysqli_query($conn, $sql);
                                  $all_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                  //echo $count;
                                ?>
                                <h3 class="pt-3"><i class="fa fa-car"></i> <span class="counter"><?php echo $all_jobs; ?></span></h3>
                                <span style="font-weight: 700;"><span class="text-danger mr-2"><i class="fa fa-briefcase"></i> </span>All time jobs count</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">                                
                                <h6>Opened Jobs</h6>
                                <?php
                                  $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE stat='1'";
                                  $result = mysqli_query($conn, $sql);
                                  $opened_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                  //echo $count;
                                ?>
                                <h3 class="pt-3"><i class="fa fa-car"></i> <span class="counter"><?php echo $opened_jobs; ?></span></h3>
                                <span style="font-weight: 700;"><span class="text-danger mr-2"><i class="fa fa-briefcase"></i> </span>Opened jobs count</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">                                
                                <h6><?php echo $user_name; ?> Jobs</h6>
                                <?php
                                  $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' ";
                                  $result = mysqli_query($conn, $sql);
                                  $user_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                  //echo $count;
                                ?>
                                <h3 class="pt-3"><i class="fa fa-car"></i> <span class="counter"><?php echo $user_jobs; ?></span></h3>
                                <span style="font-weight: 700;"><span class="text-danger mr-2"><i class="fa fa-briefcase"></i> </span>Your jobs</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h6>Jobs This Month</h6>
                                <?php

                                    $date_month = date("Y-m") ;
                                    
                                    if($user_role=='1'){
                                        
                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$date_month%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $monthly_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                        //echo $count;
    
                                        $last_month= date('Y-m', strtotime('-1 month', time()));
                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$last_month%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $last_monthly_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
    
                                        // $datestring='date("Y-m-d")';
                                        // $dt=date_create($datestring);
                                        // echo $dt->format('Y-m'); 
    
                                        if($last_monthly_jobs=='0'){
                                            $monthleyGrowth=round(((($monthly_jobs-1)/1)*100),2);
                                        }else{
                                            $monthleyGrowth=round(((($monthly_jobs-$last_monthly_jobs)/$last_monthly_jobs)*100),2);
                                        }
                                        
                                    }else{

                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && reg_date LIKE '%$date_month%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $monthly_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                        //echo $count;
    
                                        $last_month= date('Y-m', strtotime('-1 month', time()));
                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && reg_date LIKE '%$last_month%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $last_monthly_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
    
                                        // $datestring='date("Y-m-d")';
                                        // $dt=date_create($datestring);
                                        // echo $dt->format('Y-m'); 
    
                                        if($last_monthly_jobs=='0'){
                                            $monthleyGrowth=round(((($monthly_jobs-1)/1)*100),2);
                                        }else{
                                            $monthleyGrowth=round(((($monthly_jobs-$last_monthly_jobs)/$last_monthly_jobs)*100),2);
                                        }
                                    }
                                    
                                    
                                ?>
                                <h3 class="pt-3"><i class="fa fa-car"></i> <span class="counter"><?php echo $monthly_jobs; ?></span></h3>
                                <?php if ($monthly_jobs > $last_monthly_jobs) { ?>
                                    <span style="color: green; font-weight: 700;"><span><i class="fa fa-long-arrow-up"></i> <?php echo $monthleyGrowth; ?>%</span> Since last month</span>
                                <?php }else{ ?>
                                    <span style="color: #FF0000; font-weight: 700;"><span><i class="fa fa-long-arrow-down"></i> <?php echo $monthleyGrowth; ?>%</span> Since last month</span>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h6>Jobs Today</h6>
                                <?php

                                    $date_today = date("Y-m-d") ;
                                    
                                    if($user_role=='1'){
                                        
                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$date_today%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $today_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                        //echo $count;
    
                                        $yesterday= date('Y-m-d', strtotime("-1 days"));
                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE reg_date LIKE '%$yesterday%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $yesterday_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
    
                                        // $datestring='date("Y-m-d")';
                                        // $dt=date_create($datestring);
                                        // echo $dt->format('Y-m'); 
                                        if($yesterday_jobs=='0'){
                                            $dailyGrowth=round(((($today_jobs-1)/1)*100),2);
                                        }else{
                                            $dailyGrowth=round(((($today_jobs-$yesterday_jobs)/$yesterday_jobs)*100),2);
                                        }
                                    
                                    }else{

                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && reg_date LIKE '%$date_today%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $today_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
                                        //echo $count;
    
                                        $yesterday= date('Y-m-d', strtotime("-1 days"));
                                        $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && reg_date LIKE '%$yesterday%' ";
                                        $result = mysqli_query($conn, $sql);
                                        $yesterday_jobs = mysqli_fetch_assoc($result)['COUNT(*)'];
    
                                        // $datestring='date("Y-m-d")';
                                        // $dt=date_create($datestring);
                                        // echo $dt->format('Y-m'); 
                                        if($yesterday_jobs=='0'){
                                            $dailyGrowth=round(((($today_jobs-1)/1)*100),2);
                                        }else{
                                            $dailyGrowth=round(((($today_jobs-$yesterday_jobs)/$yesterday_jobs)*100),2);
                                        }
                                    
                                    }
                                ?>
                                <h3 class="pt-3"><i class="fa fa-car"></i> <span class="counter"><?php echo $today_jobs; ?></span></h3>
                                <?php if ($today_jobs > $yesterday_jobs) { ?>
                                    <span style="color: green; font-weight: 700;"><span><i class="fa fa-long-arrow-up"></i> <?php echo $dailyGrowth; ?>%</span> Since yesteday</span>      
                                <?php }else{ ?>
                                    <span style="color: #FF0000; font-weight: 700;"><span><i class="fa fa-long-arrow-down"></i> <?php echo $dailyGrowth; ?>%</span> Since yesteday</span>
                                <?php } ?>              
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-6 col-sm-12 ">
                        <div class="card">
                            <div class="card-body">
                                <h6>Date Time</h6>
                                <h3 class="pt-3"><i class="fa fa-clock-o"></i> <span id="txt">00:00:00</span></h3>
                                <span style="font-weight: 700;"><span class="text-danger mr-2"><i class="fa fa-calendar-check-o"></i> <?php echo date('D') ?></span> <?php echo date('Y-m-d') ?></span>                               
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        
        <?php if($user_role=='0'){ }else{ ?>
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card">
                            <div class="card-body ribbon">
                                <a href="create_new_job.php" class="my_sort_cut text-muted">
                                    <i class="icon-briefcase"></i>
                                    <span>New Job</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="create_estimate.php" class="my_sort_cut text-muted">
                                    <i class="icon-doc"></i>
                                    <span>New Estimate</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card">
                            <div class="card-body ribbon">
                                <?php
                                  $PendingSql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' && stat='1' ";
                                  $PendingResult = mysqli_query($conn, $PendingSql);
                                  $pending_jobs = mysqli_fetch_assoc($PendingResult)['COUNT(*)'];
                                  //echo $count;
                                ?>
                                <div class="ribbon-box orange counter"><?php echo $pending_jobs; ?></div>
                                <a href="pending_jobs.php" class="my_sort_cut text-muted">
                                    <i class="icon-wallet"></i>
                                    <span>Pending Jobs</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <!-- <div class="ribbon-box cyan counter">7</div> -->
                                <a href="add_stock.php" class="my_sort_cut text-muted">
                                    <i class="icon-social-dropbox"></i>
                                    <span>Stock</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card">
                            <div class="card-body ribbon">
                                <?php
                                  $InvoiceSql = "SELECT COUNT(*) FROM tbl_invoice WHERE advisor = '$user_name' ";
                                  $InvoiceResult = mysqli_query($conn, $InvoiceSql);
                                  $invoice_jobs = mysqli_fetch_assoc($InvoiceResult)['COUNT(*)'];
                                  //echo $count;
                                ?>
                                <div class="ribbon-box green counter"><?php echo $invoice_jobs; ?></div>
                                <a href="old_invoice.php" class="my_sort_cut text-muted">
                                    <i class="icon-calculator"></i>
                                    <span>Invoices</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 col-md-4 col-xl-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="settings.php" class="my_sort_cut text-muted">
                                    <i class="icon-settings"></i>
                                    <span>Setting</span>
                                </a>
                            </div>
                        </div>
                    </div>                    
                </div>
            </div>
        </div>
        <?php } ?>
        
        <style>
            #bookingTable_filter{
                display: none;
            }
        </style>

        <?php if($user_role=='1'){ ?>

        <div class="section-body">
            <div class="container-fluid">

                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Monthly Income Summary</h3>
                            </div>
                            <div class="card-body">
                                        
                                <div class="row">
                                    <canvas id="MonthlyInvoiceSummaryBarChart" width="100%" height="50"></canvas>
                                </div>
                                        
                            </div>                        
                        </div>
                    </div>
                
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jobs Monthley Summary</h3>
                            </div>
                            <div class="card-body">
                                        
                                <div class="row">
                                    <canvas id="allJobsMonthleyChart" width="100%" height="50"></canvas>
                                </div>

                            </div>                        
                        </div>
                    </div>
                </div>


                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Income Check</h3>
                            </div>
                            <div class="card-body">
                                            
                                <div class="row">

                                    <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="1">Start Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                            <input type="date" id="income-start-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                          </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="6">End Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                            <input type="date" id="income-end-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                        </div>    
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="6">Income Type<font style="color: #FF0000;">*</font></label>
                                            <select class="form-control" id="income-type">
                                                <option disabled>Select Income Type</option>
                                                <option value="1" selected>Without Credit</option>
                                                <option value="2">With Credit</option>
                                            </select>
                                        </div>    
                                    </div>



                                    </div>
                                    <button type="submit" id="btn-get-income" class="btn btn-primary waves-effect waves-light">Get Income</button>

                            </div>                        
                        </div>
                    </div>
                

                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Income Receved Method Summary Check</h3>
                            </div>
                            <div class="card-body">
                                        
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="1">Start Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                           <input type="date" id="income-receved-start-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="6">End Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                           <input type="date" id="income-receved-end-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                        </div>    
                                    </div>



                                </div>
                                <input type="submit" id="btn-get-income-receved" class="btn btn-primary waves-effect waves-light" value="Get Income Receved Method Summary">

                            </div>                        
                        </div>
                    </div>
                </div>



                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Income</h3>
                            </div>
                            <div class="card-body">
                                            
                                <div class="row">

                                    <div class="col-lg-3 col-md-6 card" style="background-color: #efefef; border: 1px solid #000;">
                                        <div class="card-body">
                                            <div class="pull-left">
                                                Rs. <span class="stats-number" id="lbl-part-income" style="color: #000; font-weight: 600;">0.00</span>
                                                <p class="stats-info" style="font-weight: 600; font-size: 18px;">Part Income</p>
                                            </div>
                                            <div class="pull-right">
                                                <!-- <i class="icon-arrow_upward stats-icon"></i> -->
                                                <!-- <img src="assets/icons/parts.png" style="width: 10%; float: right; margin-top: -50px;"> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 card" style="background-color: #efefef; border: 1px solid #000;">
                                        <div class="card-body">
                                            <div class="pull-left">
                                                Rs. <span class="stats-number" id="lbl-labour-income" style="color: #000; font-weight: 600;">0.00</span>
                                                <p class="stats-info" style="font-weight: 600; font-size: 18px;">Labour Income</p>
                                            </div>
                                            <div class="pull-right">
                                                <!-- <i class="icon-arrow_downward stats-icon"></i> -->
                                                <!-- <img src="assets/icons/labour.png" style="width: 20%; float: right; margin-top: -50px;"> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 card" style="background-color: #efefef; border: 1px solid #000;">
                                        <div class="card-body">
                                            <div class="pull-left">
                                                Rs. <span class="stats-number" id="lbl-total-income" style="color: #000; font-weight: 600;">0.00</span>
                                                <p class="stats-info" style="font-weight: 600; font-size: 18px;">Total Income</p>
                                            </div>
                                            <div class="pull-right">
                                                <!-- <i class="icon-arrow_upward stats-icon"></i> -->
                                                <!-- <img src="assets/icons/income.png" style="width: 20%; float: right; margin-top: -50px;"> -->
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-3 col-md-6 card" style="background-color: #efefef; border: 1px solid #000;">
                                        <div class="card-body">
                                            <div class="pull-left">
                                                <span class="stats-number" id="lbl-total-vehicle" style="color: #000; font-weight: 600;">0</span>
                                                <p class="stats-info" style="font-weight: 600; font-size: 18px;">Vehicle Count</p>
                                            </div>
                                            <div class="pull-right">
                                                <!-- <i class="icon-arrow_upward stats-icon"></i> -->
                                                <!-- <img src="assets/icons/car.png" style="width: 20%; float: right; margin-top: -50px;"> -->
                                            </div>
                                        </div>
                                    </div>
                                                
                                                
                                    <div class="col-md-12">
                                        <br><br>
                                        <h3 class="card-title">Income Report</h3>
                                        <div class="table-responsive">
                                            <table class="table m-b-0" id="income-in-detail-tbl" style="width: 100%;">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col" style="display: none;">#</th>
                                                        <th scope="col">Details</th>
                                                        <th scope="col"></th>
                                                        <th scope="col" style="text-align: right;">Calcualtion (.Rs)</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="profit-sumary-area">
                                                                
                                                </tbody>
                                                <!--<tfoot id="-area">-->
                                                                
                                                <!--</tfoot>-->
                                            </table>
                                        </div>
                                        <br><br>
                                    </div>
                                              

                                    <!--<div class="row" style="display: none;">
                                        <div class="col-md-6">
                                            <canvas id="myChart" width="100%" height="50"></canvas>
                                        </div>
                                        <div class="col-md-6">
                                            <canvas id="myChartBar" width="100%" height="50"></canvas>
                                        </div>
                                    </div>-->



                                </div>

                            </div>                        
                        </div>
                    </div>
                
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Income Receved Method Summary</h3>
                            </div>
                            <div class="card-body">
                                        
                                <div class="row">

                                    <div class="table-responsive">
                                        <table class="table table-bordered" >
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th>Payment Method Type</th>
                                                    <th><font style="float: right;">Payment Total (.Rs)</font></th>
                                                    <th><font style="float: right;">Transcation Count</font></th>
                                                </tr>
                                            </thead>
                                            <tbody id="Income-Receved-container">

                                                <!-- <tr>
                                                    <td></td> 
                                                    <td></td>
                                                </tr> -->

                                            </tbody>
                                        </table>
                                                    
                                    </div>

                                </div>

                            </div>                        
                        </div>
                    </div>
                </div>


            </div>
        </div>
        
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bookings</h3>
                            </div>
                            <div class="card-body">
                                <a href="bookings.php" class="btn btn-primary" style="float: right; margin-left: 5px;">View All Bookings</a>
                                <button type="button" data-toggle="modal" data-target="#AddBookingModalCenter" class="btn btn-primary" style="float: right;">Add Bookings</button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="bookingTable">
                                        <thead>
                                            
                                                <th>#</th>
                                                <th>License Number</th>
                                                <th>Customer Name</th>
                                                <th>Contact Number</th>
                                                <th>Email</th>
                                                <th>Booking Date & Time</th>
                                                <th>Category</th>
                                           
                                        </thead>
                                        <tbody id="booking-area">
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>                        
                        </div>
                    </div> 
                </div>
            </div>
        </div>


        <?php }else{ ?>
        
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Bookings</h3>
                            </div>
                            <div class="card-body">
                                <a href="bookings.php" class="btn btn-primary" style="float: right; margin-left: 5px;">View All Bookings</a>
                                <button type="button" data-toggle="modal" data-target="#AddBookingModalCenter" class="btn btn-primary" style="float: right;">Add Bookings</button>
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="bookingTable">
                                        <thead>
                                            
                                                <th>#</th>
                                                <th>License Number</th>
                                                <th>Customer Name</th>
                                                <th>Contact Number</th>
                                                <th>Email</th>
                                                <th>Booking Date & Time</th>
                                                <th>Category</th>
                                           
                                        </thead>
                                        <tbody id="booking-area">
                                            

                                        </tbody>
                                    </table>
                                </div>
                            </div>                        
                        </div>
                    </div> 
                </div>
            </div>
        </div>
        
        <!-- Modal -->
        <div class="modal fade" id="AddBookingModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="bookingForm" method="post">
                  <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Customer Name <font style="color: #FF0000;">*</font></label>
                                <input type="text" class="form-control" name="user_name" placeholder="Customer Name" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Licence Number <font style="color: #FF0000;">*</font></label>
                                <input type="text" class="form-control" name="user_license_number" placeholder="Licence Number" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Customer Phone Number <font style="color: #FF0000;">*</font></label>
                                <input type="text" class="form-control" name="user_phone" placeholder="Customer Phone Number" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Customer Email <font style="color: #FF0000;">*</font></label>
                                <input type="email" class="form-control" name="user_email" placeholder="Customer Email" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Pick a Date <font style="color: #FF0000;">*</font></label>
                                <input type="date" class="form-control" name="book_date" placeholder="Pick a Date" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Pick a Time <font style="color: #FF0000;">*</font></label>
                                <input type="time" class="form-control" name="book_time" placeholder="Pick a Time" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Please choose a Category <font style="color: #FF0000;">*</font></label>
                                <select class="form-control" name="category">
                                    <option selected disabled>Please choose a Category</option>
                                    <option value="Service (Lubrication or Brakes)">Service (Lubrication or Brakes)</option>
                                    <option value="Repair (Electrical)">Repair (Electrical)</option>
                                    <option value="Repair (Mechanical)">Repair (Mechanical)</option>
                                    <option value="Inspection">Inspection</option>
                                    <option value="Accident (Insurance)">Accident (Insurance)</option>
                                    <option value="Accident (Non-Insurance)">Accident (Non-Insurance)</option>
                                    <option value="Detailing (Wax or Full Polish)">Detailing (Wax or Full Polish)</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-label">Message <font style="color: #FF0000;">*</font></label>
                                <textarea class="form-control" id="user-message" name="user_message" rows="6" placeholder="Message" required="required"></textarea>
                            </div>
                        </div>
                        
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                  </div>
              </form>
              
            </div>
          </div>
        </div>
        
        <div class="section-body">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jobs Monthley Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <canvas id="myJobsMonthleyChart" width="100%" height="50"></canvas>
                                </div>
                            </div>                        
                        </div>
                    </div>    
                    <div class="col-lg-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Jobs Daily Summary</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <canvas id="myJobsTodayChart" width="100%" height="50"></canvas>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php } ?>
        

        <!-- Start page footer -->
        <?php include_once('controls/footer.php'); ?>

    </div>
</div>


<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<script src="assets/assets/bundles/apexcharts.bundle.js"></script>
<script src="assets/assets/bundles/counterup.bundle.js"></script>
<script src="assets/assets/bundles/knobjs.bundle.js"></script>
<script src="assets/assets/bundles/c3.bundle.js"></script>
<script src="assets/assets/bundles/flot.bundle.js"></script>
<script src="assets/assets/bundles/jvectormap1.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/page/index.js"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>

<script>
    

    // $(document).ready( function () {
    //     $('#bookingTable').DataTable({
    //         "order": [[ 0, "desc" ]]
    //     });
    // } );
</script>

    <script>
        
        $(document).ready(function(){
            downloadAllAds();
            setInterval(downloadAllAds,300000);

        });

        function downloadAllAds(){


            $.ajax({

                url:'bookings_backend/download_all_bookings.php',
                type:'POST',
                data:{},
                success:function(data){

             
                  
                  var json = JSON.parse(data);

               

                   if(json.result){
                        $("#booking-area").html(json.data);
                        
                         $('#bookingTable').DataTable({ 
                          "order": [[ 0, "desc" ]],
                          "destroy": true, //use for reinitialize datatable
                       });
                   }

                },
                error:function(err){
                    console.log("err "+err);
                }


            });


        }








    </script>


<script>

function setStyleSheet(url){
    var stylesheet = document.getElementById("stylesheet");
    stylesheet.setAttribute('href', url);
}


</script>

<script>
            function startTime() {
              var today = new Date();
              var h = today.getHours();
              var m = today.getMinutes();
              var s = today.getSeconds();
              m = checkTime(m);
              s = checkTime(s);
              document.getElementById('txt').innerHTML =
              h + ":" + m + ":" + s;
              var t = setTimeout(startTime, 500);
            }
            function checkTime(i) {
              if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
              return i;
            }
        </script>

        <script>

            loadMonthleyJobsChart();

            function loadMonthleyJobsChart(){

                $.ajax({
              url:'controls/get_monthley_summary.php',
              type:'POST',
              data:{},
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var thisMonthSummery = json.thisMonthSummery;
                    var lastMonthSummery = json.lastMonthSummery;


                var ctx = document.getElementById('myJobsMonthleyChart');
                var myJobsMonthleyChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                        'This Month',
                        'Last Month'
                        ],
                        datasets: [{
                        data: [thisMonthSummery,lastMonthSummery],
                        backgroundColor: ["#6765D3", "#0D0C59"]
                    }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display: true,
                            text: "Monthley Summary"
                        }
                    }
                });

                 

                }
                
                Swal.close();


              },
              error:function(err){
                console.log(err);
              }


            });



            

            }

        </script>

        <script>

            todayJobsChart();

            function todayJobsChart(){

                $.ajax({
              url:'controls/get_daily_summary.php',
              type:'POST',
              data:{},
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var todaySummery = json.todaySummery;
                    var yesterdaySummery = json.yesterdaySummery;


                var ctx = document.getElementById('myJobsTodayChart');
                var myJobsTodayChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                        'Today',
                        'Yesterday'
                        ],
                        datasets: [{
                        data: [todaySummery,yesterdaySummery],
                        backgroundColor: ["#C36CD2", "#801393"]
                    }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display: true,
                            text: "Daily Summary"
                        }
                    }
                });

                 

                }
                
                Swal.close();


              },
              error:function(err){
                console.log(err);
              }


            });



            

            }

        </script>
        
        
    <script>
        
        $(document).on('submit', '#bookingForm', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {

                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Details is being sending...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },

                url:"bookings_backend/add_booking.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Booked.'
                    });


                    setTimeout(function () {
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <!--------------------Admin Panduka Anylitics----------------------------------->

    <script type="text/javascript">
    
        function addCommas(nStr)
        {
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
    
    
        var incometbl = null;
    
            $(document).ready( function () {

                $('#myTable').DataTable();

            //   loadChart(0,0,0);

                $("#btn-get-income").click(function(){
                    
                    if(incometbl == null){
                        
                        
                    }else{
                                                    
                            incometbl.clear().draw();
                            incometbl.destroy();
                    }

                    var startDate = $("#income-start-date").val();
                    var endDate = $("#income-end-date").val();
                    var incomeType = $("#income-type").val();

                    $.ajax({

                        url:'controls/get_income_summary.php',
                        type:'POST',
                        data:{
                            start_date:startDate,
                            end_date:endDate,
                            income_type:incomeType
                        },
                        beforeSend:function(){
                            Swal.fire({
                              text: "Please wait...",
                              imageUrl:"assets/loader.gif",
                              showConfirmButton: false,
                              allowOutsideClick: false
                            });
                        },
                        success:function(data){
                            var json = JSON.parse(data);
                            var parts_income = 0.00;
                            var labour_income = 0.00;
                            var grand_total_income = 0.00;
                            var vehicle_count = 0;
                            if(json.result){

                                if(json.parts_income != 'null'){
                                    parts_income = json.parts_income;
                                }else{
                                    parts_income = 0.00;
                                }

                                if(json.labour_income != 'null'){
                                    labour_income = json.labour_income;
                                }else{
                                    labour_income = 0.00;
                                }

                                if(json.grand_total_income != 'null'){
                                    grand_total_income = json.grand_total_income;
                                }else{
                                    grand_total_income = 0.00;
                                }

                                if(json.vehicle_count != 'null'){
                                    vehicle_count = json.vehicle_count;
                                }else{
                                    vehicle_count = 0;
                                }
                                
                                
                                ///////Income Summery Details Area//////////
                                $("#profit-sumary-area").html(json.data);
                                
                                incometbl = $('#income-in-detail-tbl').DataTable({ 
                                      "order": [[ 0, "asc" ]],
                                      "destroy": true, //use for reinitialize datatable
                                      dom: 'Bfrtip',
                                        buttons: [
                                            'excel', 'pdf', 'print'
                                        ]
                                });
                                ///////////////////

                                // $("#lbl-part-income").html(parseFloat(parts_income).toFixed(2));
                                // $("#lbl-labour-income").html(parseFloat(labour_income).toFixed(2));
                                // $("#lbl-total-income").html(parseFloat(grand_total_income).toFixed(2));

                                $("#lbl-part-income").html(addCommas(parseFloat(parts_income).toFixed(2)));
                                $("#lbl-labour-income").html(addCommas(parseFloat(labour_income).toFixed(2)));
                                $("#lbl-total-income").html(addCommas(parseFloat(grand_total_income).toFixed(2)));

                                $("#lbl-total-vehicle").html(vehicle_count);


                                // loadChart(parts_income,labour_income,grand_total_income);
                                




                            }

                            Swal.close();
                        },
                        error:function(err){
                            console.log(err);
                        }


                    });



                });




            } );
       
        </script>

        <script>

            function loadChart(parts_income,labour_income,total_income){

                var ctx = document.getElementById('myChart');
                var myChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Parts Income',
                            'Labour Income'
                        ],
                        datasets: [{
                            data: [parts_income,labour_income],
                            backgroundColor: ["#0074D9", "#FF4136"]
                        }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display: true,
                            text: "Income Summary"
                        }
                    }
                });

                var ctx = document.getElementById('myChartBar');
                    var myChartBar = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: ['Parts Income', 'Labour Income'],
                            datasets: [{
                                label: 'Income Summary',
                                data: [parts_income,labour_income],
                                backgroundColor: [
                                    'rgba(255, 99, 132, 0.2)',
                                    'rgba(54, 162, 235, 0.2)'
                                ],
                                borderColor: [
                                    'rgba(255, 99, 132, 1)',
                                    'rgba(54, 162, 235, 1)'
                                ],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });

            }

        </script>

        
        <script>

            loadMonthleyJobsChart();

            function loadMonthleyJobsChart(){

                $.ajax({
              url:'controls/get_all_invoice_month_by_month.php',
              type:'POST',
              data:{},
              success:function(data){
                // console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var summary = json.summary_data;
                 
                    var janInvoice = summary.jan;
                    if(janInvoice === null){
                        janInvoice = 0;
                    }
                    var febInvoice = summary.feb;
                    if(febInvoice === null){
                        febInvoice = 0;
                    }
                    var marInvoice = summary.mar;
                    if(marInvoice === null){
                        marInvoice = 0;
                    }
                    var aprInvoice = summary.apr;
                    if(aprInvoice === null){
                        aprInvoice = 0;
                    }
                    var mayInvoice = summary.may;
                    if(mayInvoice === null){
                        mayInvoice = 0;
                    }
                    var junInvoice = summary.jun;
                    if(junInvoice === null){
                        junInvoice = 0;
                    }
                    var julInvoice = summary.jul;
                    if(julInvoice === null){
                        julInvoice = 0;
                    }
                    var augInvoice = summary.aug;
                    if(augInvoice === null){
                        augInvoice = 0;
                    }
                    var sepInvoice = summary.sep;
                    if(sepInvoice === null){
                        sepInvoice = 0;
                    }
                    var octInvoice = summary.oct;
                    if(octInvoice === null){
                        octInvoice = 0;
                    }
                    var novInvoice = summary.nov;
                    if(novInvoice === null){
                        novInvoice = 0;
                    }
                    var decInvoice = summary.dec;
                    if(decInvoice === null){
                        decInvoice = 0;
                    }
                    
                    var summarynetincome = json.summary_net_income_data;
                 
                    var janNetIncome = summarynetincome.jan;
                    if(janNetIncome === null){
                        janNetIncome = 0;
                    }
                    var febNetInvoice = summarynetincome.feb;
                    if(febNetInvoice === null){
                        febNetInvoice = 0;
                    }
                    var marNetInvoice = summarynetincome.mar;
                    if(marNetInvoice === null){
                        marNetInvoice = 0;
                    }
                    var aprNetInvoice = summarynetincome.apr;
                    if(aprNetInvoice === null){
                        aprNetInvoice = 0;
                    }
                    var mayNetInvoice = summarynetincome.may;
                    if(mayNetInvoice === null){
                        mayNetInvoice = 0;
                    }
                    var junNetInvoice = summarynetincome.jun;
                    if(junNetInvoice === null){
                        junNetInvoice = 0;
                    }
                    var julNetInvoice = summarynetincome.jul;
                    if(julNetInvoice === null){
                        julNetInvoice = 0;
                    }
                    var augNetInvoice = summarynetincome.aug;
                    if(augNetInvoice === null){
                        augNetInvoice = 0;
                    }
                    var sepNetInvoice = summarynetincome.sep;
                    if(sepNetInvoice === null){
                        sepNetInvoice = 0;
                    }
                    var octNetInvoice = summarynetincome.oct;
                    if(octNetInvoice === null){
                        octNetInvoice = 0;
                    }
                    var novNetInvoice = summarynetincome.nov;
                    if(novNetInvoice === null){
                        novNetInvoice = 0;
                    }
                    var decNetInvoice = summarynetincome.dec;
                    if(decNetInvoice === null){
                        decNetInvoice = 0;
                    }

                var ctx = document.getElementById('MonthlyInvoiceSummaryBarChart');
                var MonthlyInvoiceSummaryBarChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: [
                        'Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'
                        ],
                        datasets: [{
                        label: 'Total Revenue',
                        data: [janInvoice,febInvoice,marInvoice,aprInvoice,mayInvoice,junInvoice,julInvoice,augInvoice,sepInvoice,octInvoice,novInvoice,decInvoice],
                        // data: [100,10,1000,5000,100000,3500,150000,150,9000,10000,15000,10000],
                        fill: false,
                        borderColor: 'rgb(255, 17, 0)',
                        // tension: 0.1
                    },
                    {
                        label: 'Gross Income',
                        // data: [janInvoice,febInvoice,marInvoice,aprInvoice,mayInvoice,junInvoice,julInvoice,augInvoice,sepInvoice,octInvoice,novInvoice,decInvoice],
                        data: [janNetIncome,febNetInvoice,marNetInvoice,aprNetInvoice,mayNetInvoice,junNetInvoice,julNetInvoice,augNetInvoice,sepNetInvoice,octNetInvoice,novNetInvoice,decNetInvoice],
                        fill: false,
                        borderColor: 'rgb(0, 176, 24)',
                        // tension: 0.1
                    }
                    
                    ]
                    },
                    options: {
                        responsive: true,
                        legend: {
                            position: 'top',
                            }, 

                          title: {
                            display: true,
                            text: 'Monthly Income Summary'
                          }            
                        }
                });

                 

                }
                
                Swal.close();


              },
              error:function(err){
                console.log(err);
              }


            });



            

            }

        </script>

        <script>

            loadMonthleyJobsChart();

            function loadMonthleyJobsChart(){

                $.ajax({
              url:'controls/get_all_monthley_summary.php',
              type:'POST',
              data:{},
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var thisMonthSummery = json.thisMonthSummery;
                    var lastMonthSummery = json.lastMonthSummery;


                var ctx = document.getElementById('allJobsMonthleyChart');
                var allJobsMonthleyChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: [
                        'This Month',
                        'Last Month'
                        ],
                        datasets: [{
                        data: [thisMonthSummery,lastMonthSummery],
                        backgroundColor: ["#6765D3", "#0D0C59"]
                    }]
                    },
                    options: {
                        responsive: true,
                        title:{
                            display: true,
                            text: "Monthley Summary"
                        }
                    }
                });

                 

                }
                
                Swal.close();


              },
              error:function(err){
                console.log(err);
              }


            });



            

            }

        </script>

        <script type="text/javascript">

            function downloadIncomeMehodRecevedData(){
            }

      
          $(document).ready(function(){
            downloadIncomeMehodRecevedData();


            $("#btn-get-income-receved").click(function(event){
              event.preventDefault();


              Swal.fire({
                  text: "Please wait...",
                  imageUrl:"assets/loader.gif",
                  showConfirmButton: false,
                  allowOutsideClick: false
                });


              

              $.ajax({
              url:'controls/get_income_method_receved_summary.php',
              type:'POST',
              data:{
                    income_receved_start_date:$("#income-receved-start-date").val(),
                    income_receved_end_date:$("#income-receved-end-date").val()
              },
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                  $("#Income-Receved-container").html(json.data);

                //   var advisorList = json.advisorList;
                //   var advisorVehicleCountList = json.advisorVehicleCountList;
                //   loadAdvisorChart(advisorList,advisorVehicleCountList);

                 

                }
                
                Swal.close();


              },
              error:function(err){
                console.log(err);
              }


            });








              
              
            });





          });

    </script>
        
</body>
</html>
