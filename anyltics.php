<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    
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
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
<!------------------------->
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.css">
<!------------------------->
</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

<style>
    
</style>

<!-- Start main html -->
<div id="main_content">

    <?php include_once('controls/side_nav.php'); ?>

    <!-- start main body part-->
    <div class="page">

        <!-- start body header -->
        <?php include_once('controls/top_nav.php'); ?>

        <div class="section-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        
                        <?php if($user_role=='0' || $user_role=='1' || $user_role=='3' || $user_role=='4'){ ?>
                        
                        <div class="row clearfix">
                            <div class="col-lg-12">
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
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-12">
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
                                                        <img src="assets/icons/parts.png" style="width: 20%; float: right; margin-top: -50px;">
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
                                                        <img src="assets/icons/labour.png" style="width: 20%; float: right; margin-top: -50px;">
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
                                                        <img src="assets/icons/income.png" style="width: 20%; float: right; margin-top: -50px;">
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
                                                        <img src="assets/icons/car.png" style="width: 20%; float: right; margin-top: -50px;">
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <?php if($user_role=='1' || $user_role=='3' || $user_role=='0' || $user_role=='4'){ ?>
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
                                            <?php }else{ }?>   

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <canvas id="myChart" width="100%" height="50"></canvas>
                                                </div>
                                                <div class="col-md-6">
                                                    <canvas id="myChartBar" width="100%" height="50"></canvas>
                                                </div>
                                            </div>



                                        </div>

                                    </div>                        
                                </div>
                            </div>
                        </div>

                        <?php }else{ } ?>
                        <?php if($user_role=='1' || $user_role=='3' || $user_role=='4'){ ?>

                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Stock Selling Summary Check</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="1">Start Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                                   <input type="date" id="stock-start-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="6">End Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                                   <input type="date" id="stock-end-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                                </div>    
                                            </div>



                                        </div>
                                        <input type="submit" id="btn-get-stock" class="btn btn-primary waves-effect waves-light" value="Get Stock">

                                    </div>                        
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Stock Selling Summary (JOB Cards)<br>
                                        <font style="color: #FF0000; font-weight: 500;">**Note <b>"BAE/GRN/2022/OLD"</b> Meaning Before creating GRN system</font></h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            
                                            <!--<div class="col-md-12">
                                               <div class="row" id="stock-container"></div>
                                            </div>-->

                                            <div class="col-md-12">
                                               <div class="table-responsive">
                                                    <table class="table m-b-0" id="item-selling">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Item Name & Item Number</th>
                                                                <!--<th scope="col">Item Number</th>-->
                                                                <th scope="col">Item Selling QTY</th>
                                                                <th scope="col">Invoice No & GRN No & Supplier</th>
                                                                <!--<th scope="col">GRN No & Supplier</th>-->
                                                                <!--<th scope="col">Supplier</th>-->
                                                                <th scope="col">International Cost And Landing</th>
                                                                <!--<th scope="col" style="text-align: right;">Currencey Type</th>-->
                                                                <!--<th scope="col" style="text-align: right;">Total Cost International</th>-->
                                                                <!--<th scope="col" style="text-align: right;">International Landing</th>-->
                                                                <th scope="col" style="text-align: right;">Total Cost (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Total Selling (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Discount Value (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Actual Selling (.Rs)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="selling-summary-area">
                                                            
                                                        </tbody>
                                                        <tfoot id="selling-summary-foot-area">
                                                            
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                            <!--<div class="row">
                                                <div class="col-md-6">
                                                   <canvas id="myStockChart" width="100%" height="100"></canvas>
                                                </div>
                                                <div class="col-md-6">
                                                   <canvas id="myStockChartBar" width="100%" height="100"></canvas>
                                                </div>
                                            </div>-->



                                        </div>

                                    </div>   
                                    
                                    <!---------Individual Part Selling Area---------->
                                    
                                    
                                    <div class="card-header">
                                        <h3 class="card-title">Stock Selling Summary (Individual Part Selling)</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            
                                            <!--<div class="col-md-12">
                                               <div class="row" id="stock-container"></div>
                                            </div>-->

                                            <div class="col-md-12">
                                               <div class="table-responsive">
                                                    <table class="table m-b-0" id="individual-item-selling">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Item Name & Item Number</th>
                                                                <th scope="col">Item Number</th>
                                                                <th scope="col">Item Selling QTY</th>
                                                                <th scope="col">Invoice No</th>
                                                                <th scope="col">GRN No</th>
                                                                <th scope="col">Supplier</th>
                                                                <th scope="col" style="text-align: right;">Currencey Type</th>
                                                                <th scope="col" style="text-align: right;">Total Cost International</th>
                                                                <th scope="col" style="text-align: right;">International Landing</th>
                                                                <th scope="col" style="text-align: right;">Total Cost (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Total Selling (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Discount Value (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Actual Selling (.Rs)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="individual-selling-summary-area">
                                                            
                                                        </tbody>
                                                        <tfoot id="individual-selling-summary-foot-area">
                                                            
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>

                                            <div class="row" style="display: none;">
                                                <div class="col-md-6">
                                                   <canvas id="myStockChart" width="100%" height="100"></canvas>
                                                </div>
                                                <div class="col-md-6">
                                                   <canvas id="myStockChartBar" width="100%" height="100"></canvas>
                                                </div>
                                            </div>



                                        </div>

                                    </div>  
                                    
                                    
                                    
                                    
                                </div>
                            </div>
                        </div>


                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Service Advisor Summary Check</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="1">Start Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                                   <input type="date" id="advisor-start-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                   <label for="6">End Date (DD/MM/Y)<font style="color: #FF0000;">*</font></label>
                                                   <input type="date" id="advisor-end-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                                </div>    
                                            </div>



                                        </div>
                                        <input type="submit" id="btn-get-advisor" class="btn btn-primary waves-effect waves-light" value="Get Service Advisor Summary">

                                    </div>                        
                                </div>
                            </div>
                        </div>

                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Service Advisor Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">

                                            <div class="table-responsive">
                                                <table class="table table-bordered" >
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th>Servise Advisor Name</th>
                                                            <th>JOB Count</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="Advisor-container">

                                                        <!-- <tr>
                                                            <td></td> 
                                                            <td></td>
                                                        </tr> -->

                                                    </tbody>
                                                </table>
                                                    
                                            </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                   <canvas id="myAdvisorChart" width="100%" height="70"></canvas>
                                                </div>
                                                <div class="col-md-6">
                                                   <canvas id="myAdvisorChartBar" width="100%" height="70"></canvas>
                                                </div>
                                            </div>



                                        </div>

                                    </div>                        
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="row clearfix">
                            <div class="col-lg-12">
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
                            <div class="col-lg-12">
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
                        
                        
                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Monthly Income Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <canvas id="MonthlyInvoiceSummaryBarChart" width="100%" height="30"></canvas>
                                        </div>
                                        
                                    </div>                        
                                </div>
                            </div>
                        </div>



                        <div class="row clearfix">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Client Register Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <canvas id="myClientChart" width="100%" height="50"></canvas>
                                        </div>

                                    </div>                        
                                </div>
                            </div>
                     

                    
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Payment Method Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <canvas id="paymentMethodChart" width="100%" height="50"></canvas>
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
             

          
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Jobs Daily Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            <canvas id="allJobsTodayChart" width="100%" height="50"></canvas>
                                        </div>

                                    </div>                        
                                </div>
                            </div>
                        </div>





                    <?php }else{ } ?>











                    </div>
                    
                </div>




            </div>
        </div>

        <!-- Start page footer -->
        <?php include_once('controls/footer.php'); ?>

    </div>
</div>

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<script src="assets/assets/bundles/selectize.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/vendors/selectize.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.colVis.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<!------------------>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<!------------------>

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

               loadChart(0,0,0);

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


                                $("#lbl-part-income").html(addCommas(parseFloat(parts_income).toFixed(2)));
                                $("#lbl-labour-income").html(addCommas(parseFloat(labour_income).toFixed(2)));
                                $("#lbl-total-income").html(addCommas(parseFloat(grand_total_income).toFixed(2)));
                                


                                // $("#lbl-labour-income").html(parseFloat(labour_income).toFixed(2));
                                // $("#lbl-total-income").html(parseFloat(grand_total_income).toFixed(2));
                                $("#lbl-total-vehicle").html(vehicle_count);


                                loadChart(parts_income,labour_income,grand_total_income);
                                




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

        

        <script type="text/javascript">

            function downloadStockData(){
            }
            
            var itemsellingtbl = null;
            var individualitemsellingtbl = null;

      
          $(document).ready(function(){
            downloadStockData();


            $("#btn-get-stock").click(function(event){
              event.preventDefault();
              
              
                    if(itemsellingtbl == null){
                        
                        
                    }else{
                                                    
                            itemsellingtbl.clear().draw();
                            itemsellingtbl.destroy();
                    }
                    if(individualitemsellingtbl == null){
                        
                        
                    }else{
                                                    
                            individualitemsellingtbl.clear().draw();
                            individualitemsellingtbl.destroy();
                    }


              Swal.fire({
                  text: "Please wait...",
                  imageUrl:"assets/loader.gif",
                  showConfirmButton: false,
                  allowOutsideClick: false
                });


              

              $.ajax({
              url:'controls/get_stock_summary.php',
              type:'POST',
              timeout: 0,
              data:{
                    stock_start_date:$("#stock-start-date").val(),
                    stock_end_date:$("#stock-end-date").val()
              },
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                //   $("#stock-container").html(json.data);
                  $("#selling-summary-area").html(json.data);
                  $("#selling-summary-foot-area").html(json.datafoot);
                  
                  $("#individual-selling-summary-area").html(json.dataindividual);
                  $("#individual-selling-summary-foot-area").html(json.dataindividualfoot);
                  
                  itemsellingtbl = $('#item-selling').DataTable({ 
                        //   "order": [[ 0, "desc" ]],
                          "destroy": true, //use for reinitialize datatable
                          dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'print',
                                    title: 'Data Export Stock Selling Summary (JOB Cards)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    title: 'Data Export Stock Selling Summary (JOB Cards)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: 'Data Export Stock Selling Summary (JOB Cards)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Data Export Stock Selling Summary (JOB Cards)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                'colvis'
                            ],
                            columnDefs: [ {
                                // targets: 1,
                                // visible: false
                            } ]
                    });
                    individualitemsellingtbl = $('#individual-item-selling').DataTable({ 
                        //   "order": [[ 0, "desc" ]],
                          "destroy": true, //use for reinitialize datatable
                          dom: 'Bfrtip',
                            buttons: [
                                {
                                    extend: 'print',
                                    title: 'Data Export Stock Selling Summary (Individual Part Selling)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'copy',
                                    title: 'Data Export Stock Selling Summary (Individual Part Selling)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'excelHtml5',
                                    title: 'Data Export Stock Selling Summary (Individual Part Selling)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                {
                                    extend: 'pdfHtml5',
                                    title: 'Data Export Stock Selling Summary (Individual Part Selling)',
                                    exportOptions: {
                                        columns: ':visible'
                                    }
                                },
                                'colvis'
                            ],
                            columnDefs: [ {
                                // targets: 1,
                                // visible: false
                            } ]
                    });

                  var itemName = json.itemName;
                  var itemQtySum = json.itemQtySum;
                //   loadStockChart(itemName,itemQtySum);

                  // loadStockChart(itemName,itemQtySum);

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

    // <script>

    //         function loadStockChart(itemName,itemQtySum){


    //         var ctx = document.getElementById('myStockChart');
    //         var myStockChart = new Chart(ctx, {
    //             type: 'pie',
    //             data: {
    //                 labels: itemName,
    //                 datasets: [{
    //                     data: itemQtySum,
    //                     backgroundColor: ["#FF4136", "#E01E84", "#C758D0", "#9C46D0", "#8E6CEF", "#8399EB", "#007ED6", "#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"]
    //                 }]
    //             },
    //             options: {
    //                 responsive: true,
    //                 title:{
    //                     display: true,
    //                     text: "Stock Selling Summary"
    //                 }
    //             }
    //         });


    //         var ctx = document.getElementById('myStockChartBar');
    //                 var myStockChartBar = new Chart(ctx, {
    //                     type: 'bar',
    //                     data: {
    //                         labels: itemName,
    //                         datasets: [{
    //                             label: 'Stock Selling Summary',
    //                             data: itemQtySum,
    //                             backgroundColor: ["#FF4136", "#E01E84", "#C758D0", "#9C46D0", "#8E6CEF", "#8399EB", "#007ED6", "#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"],
    //                             borderColor: ["#FF4136", "#E01E84", "#C758D0", "#9C46D0", "#8E6CEF", "#8399EB", "#007ED6", "#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"],
    //                             borderWidth: 1
    //                         }]
    //                     },
    //                     options: {
    //                         responsive: true,
    //                         scales: {
    //                             y: {
    //                                 beginAtZero: true
    //                             }
    //                         }
    //                     }
    //                 });


    //         }

    //     </script>
        

        <script type="text/javascript">

            function downloadAdvisorData(){
            }

      
          $(document).ready(function(){
            downloadAdvisorData();


            $("#btn-get-advisor").click(function(event){
              event.preventDefault();


              Swal.fire({
                  text: "Please wait...",
                  imageUrl:"assets/loader.gif",
                  showConfirmButton: false,
                  allowOutsideClick: false
                });


              

              $.ajax({
              url:'controls/get_service_advisor_summary.php',
              type:'POST',
              data:{
                    advisor_start_date:$("#advisor-start-date").val(),
                    advisor_end_date:$("#advisor-end-date").val()
              },
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                  $("#Advisor-container").html(json.data);

                  var advisorList = json.advisorList;
                  var advisorVehicleCountList = json.advisorVehicleCountList;
                  loadAdvisorChart(advisorList,advisorVehicleCountList);

                 

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

    <script>

            function loadAdvisorChart(advisorList,advisorVehicleCountList){


            var ctx = document.getElementById('myAdvisorChart');
            var myAdvisorChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: advisorList,
                    datasets: [{
                        data: advisorVehicleCountList,
                        backgroundColor: ["#FF4136", "#E01E84", "#C758D0", "#9C46D0", "#8E6CEF", "#8399EB", "#007ED6", "#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"]
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display: true,
                        text: "Service Advisor Summary"
                    }
                }
            });


            var ctx = document.getElementById('myAdvisorChartBar');
                    var myAdvisorChartBar = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: advisorList,
                            datasets: [{
                                label: 'Service Advisor Summary',
                                data: advisorVehicleCountList,
                                backgroundColor: ["#FF4136", "#E01E84", "#C758D0", "#9C46D0", "#8E6CEF", "#8399EB", "#007ED6", "#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"],
                                borderColor: ["#FF4136", "#E01E84", "#C758D0", "#9C46D0", "#8E6CEF", "#8399EB", "#007ED6", "#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"],
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
        
        
        <!------------Payment metod income--------------------->
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

        


        <script>

            loadClientChart();

            function loadClientChart(){





                $.ajax({
              url:'controls/get_client_summary.php',
              type:'POST',
              data:{},
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var clientList = json.clientList;
                    var clientCount = json.clientCount;


                 var ctx = document.getElementById('myClientChart');
            var myClientChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: clientList,
                    datasets: [{
                        data: clientCount,
                        backgroundColor: ["#97D9FF", "#5FB7D4", "#7CDDDD", "#26D7AE", "#2DCB75", "#1BAA2F", "#52D726", "#D5F30B", "#FFEC00", "#FFAF00", "#FF7300"]
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display: true,
                        text: "Client Summary"
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

        <script>

            todayJobsChart();

            function todayJobsChart(){

                $.ajax({
              url:'controls/get_all_daily_summary.php',
              type:'POST',
              data:{},
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var todaySummery = json.todaySummery;
                    var yesterdaySummery = json.yesterdaySummery;


                var ctx = document.getElementById('allJobsTodayChart');
                var allJobsTodayChart = new Chart(ctx, {
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

            loadClientChart();

            function loadClientChart(){





                $.ajax({
              url:'controls/get_payment_method_summary.php',
              type:'POST',
              data:{},
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                    var paymethod = json.paymethod;
                    var paycount = json.paycount;


                 var ctx = document.getElementById('paymentMethodChart');
            var paymentMethodChart = new Chart(ctx, {
                type: 'pie',
                data: {
                    labels: paymethod,
                    datasets: [{
                        data: paycount,
                        backgroundColor: ["#1F8034", "#195A53", "#0F2B62", "#441E63", "#8D137C", "#821313", "#8F6710"]
                    }]
                },
                options: {
                    responsive: true,
                    title:{
                        display: true,
                        text: "Payment Method Summary"
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
        
        <!--------------------------Start Monthly Line Chart------------------------------------------->

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


        <!--------------------------Start Monthly Line Chart------------------------------------------->


</body>
</html>