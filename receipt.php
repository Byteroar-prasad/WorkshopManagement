<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');

    $InvoiceId = base64_decode($_GET['r']);

    $LabourCount=0;
    $PartCount=0;
    
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

<?php 

    $sql = "SELECT * FROM tbl_invoice ti INNER JOIN tbl_receipt tr ON ti.invoice_id=tr.invoice_id WHERE ti.invoice_id= '$InvoiceId' ";
    // $sql = "SELECT * FROM tbl_invoice WHERE invoice_id= '$InvoiceId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $invoice_new_id = $row[0];
            $invoice_id=$row[1];
            $customer=$row[2];
            $client_address=$row[3];
            $email=$row[4];
            $phone_number=$row[5];
            $licens_no=$row[6];
            $chassis_no=$row[7];
            $mileage=$row[8]; 
            $invoice_date=$row[9]; 
            $note=$row[10];

            ////////////////////////////////

            $labour_total=$row[11]; 
            $parts_total=$row[12]; 
            $sublet_price=$row[13]; 
            $sub_total=$row[14]; 
            $vat=$row[15]; 
            $grand_total=$row[16]; 
            

            //////////////////////////////// 

            $advisor=$row[17];
            $pay=$row[18];
            $stat=$row[19];
            $datetime=$row[20];

            ////////////////////////////////

            $receipt_id=$row[22];
            $price=$row[24];
            $payment_method=$row[25];
            $date_count=$row[26];
            $recept_note=$row[27];
            $receipt_date=$row[28];

        }
    ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

                        <style>
                          @media print {
                            @page {
                              size: auto;   /* auto is the initial value */
                              size: A4 portrait;
                              margin: 0;  /* this affects the margin in the printer settings */
                              border: 1px solid red;  /* set a border for all printed pages */
                            }
                            body {
                                zoom: 70%;
                                transform: scale(.9);
                                /*margin-top: -320px;*/
                                width: 100%;
                                margin-top: -40px;
                            }
                            body::before {
                                background: transparent;
                            }
                            #print-page{
                                margin-left: -320px;
                                background-color: #fff !important;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #topnav{
                                display: none;
                            }
                            #sidenav{
                                /*visibility: hidden !important;*/
                                display: none !important;
                            }
                            #footer{
                                display: none;
                            }
                            #invoice{
                                display: none;
                            }
                            #print-table1{
                                width:40%; 
                                float:left;
                            }
                            #print-table2{
                                float:right;
                                width:40%;
                            }
                            #print-p{
                                width:100%;
                                /*margin-top: 100px;*/
                            }
                            #print-table4{
                                border: 1px solid #E6E8EB !important;
                            }
                            #print-table-total{
                                float:right;
                                width:50%;
                            }
                            #note{
                                float:left;
                                width:50%;
                            }
                            #hr1{
                                display: none;
                            }
                            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                                border-color: #E6E8EB;
                                padding: 5px 5px;
                            }
                            #td{
                                border: 0px solid #fff !important;
                                /*border: 1px solid #000000 !important;*/
                            }
                            #price1{
                                width: 100%;
                                float: right;

                                /*display: none;*/
                            }
                            #logoimg{
                                margin-top: -180px;
                            }
                            #color-change-green{
                                background-color: #00B050 !important;
                            }
                            #color-change-green-new{
                                background-color: #00B050 !important;
                                color: #fff !important;
                            }
                            #baeimg{
                                width: 10% !important;
                            }
                            /*#print-table5>tbody>tr>td, #print-table5>tbody>tr>th, #print-table5>tfoot>tr>td, #print-table5>tfoot>tr>th, #print-table5>thead>tr>td, #print-table5>thead>tr>th {
                                border: 1px solid #000 !important;
                            }*/

                            /*#navigation-link{
                                display: none;
                            }
                            #inside-check-style{
                                margin-top: -50px;
                            }
                            #vehicle-engine-check-style{
                                margin-top: 150px;
                            }
                            #vehicle-condition-style{
                                margin-top: 210px;
                            }
                            #print-body{
                                background: #fff !important;
                            }
                            #th-style{
                                color: #000 !important;
                            }
                            #agreement-style{
                                margin-top: 150px;
                            }
                            #th-extra-style{
                                display: none;
                            }*/
                            
                          }
                        </style>                       


<!-- Start main html -->
<div id="main_content">
    
    <div id="sidenav">
        <?php include_once('controls/side_nav.php'); ?>
    </div>

    <!-- start main body part-->
    <div class="page">

        <!-- start body header -->
        <div id="topnav">
            <?php include_once('controls/top_nav.php'); ?>
        </div>

        <div class="section-body" id="print-page">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-body">
                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    

                                                    <div class="row">
                                                        <div class="col-md-8 text-left">
                                                            <!--<h3>Bavarian Automobile Engineering (Pvt) Ltd</h3>
                                                            <address>
                                                                No 3/8, Gunasekara Gardens, Nawala, Rajagiriya<br>
                                                                Phone Number<br>
                                                                info@bae.lk<br>
                                                                www.bae.lk
                                                            </address>-->
                                                            <img src="assets/BAE_Header.png" style="width: 70%;">
                                                            <br><br>
                                                            <h2 class="m-b-md m-t-xxs"><b>RECIEPT</b></h2>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="logoimg">
                                                            <img src="assets/logo-black-transparent.png" id="baeimg" style="width: 20%;"><br>
                                                            <!-- <h3>Invoice</h3> -->
                                                            <b>
                                                                <font style="font-size: 20px;">Reciept</font><br>
                                                                Reciept No : <?php echo $receipt_id; ?>
                                                            </b>
                                                        </div>  
                                                    </div>

                                                    <hr>

                                                    <div class="row">

                                                        <div class="col-md-8" id="print-table1">
                                                            
                                                            <p>
                                                                Invoice Name & Address:<br>
                                                                <?php echo $customer; ?><br>
                                                                <?php echo nl2br($client_address); ?><br>
                                                                <?php echo $email; ?><br>
                                                                <?php echo $phone_number; ?>
                                                            </p>
                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="print-table2">
                                                           
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle #</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $licens_no; ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $chassis_no; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Milage</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $mileage; ?>Km</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $receipt_date; ?></th>
                                                                        </tr>
                                                                        
                                                                        
                                                                    </thead>
                                                                </table>
                                                            </div>

                                                        </div>
                                                            
                                                    </div>
                                                        


                                                        <style>
                                                            .colorchange{
                                                                color: #000 !important;
                                                            }
                                                            .result{
                                                                color: #FF0000 !important;
                                                            }
                                                            .table-bordered {
                                                                border: 1px solid #000 !important;
                                                            }
                                                        </style>

                                                       
                                                       <div class="col-md-12">

                                                        <?php if($payment_method!=='Credit' && $date_count>''){ ?>
                                                        

                                                          <p id="print-p">
                                                            <hr>
                                                            
                                                            The outstanding credit amount of <b>Rs. <?php echo number_format($price,2); ?></b> of invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b> was settled though <b><?php echo $payment_method; ?></b> on <?php echo $receipt_date; ?>

                                                            <br><br>

                                                            <?php if ($recept_note=='') { }else{ ?>
                                                            <b>NOTE</b><br>
                                                            <?php echo $recept_note; ?>
                                                            <?php } ?>
                                                          </p>
                                                          

                                                        <?php }elseif($payment_method=='Credit' && $date_count!==''){ ?>

                                                          <p id="print-p">
                                                            <hr>
                                                            An amount of <b>Rs. <?php echo number_format($price,2); ?></b> of invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b> is approved of <b><?php echo $payment_method; ?></b> for <?php echo $date_count; ?> days from <?php echo $receipt_date; ?>
                                                            <br><br>

                                                            <?php if ($recept_note=='') { }else{ ?>
                                                            <b>NOTE</b><br>
                                                            <?php echo $recept_note; ?>
                                                            <?php } ?>
                                                          </p>


                                                        <?php }else{ ?>

                                                          <p id="print-p">
                                                            <hr>
                                                            An amount of <b>Rs. <?php echo number_format($price,2); ?></b> of invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b> was received through <b><?php echo $payment_method; ?></b> on <?php echo $receipt_date; ?>

                                                            <br><br>

                                                            <?php if ($recept_note=='') { }else{ ?>
                                                            <b>NOTE</b><br>
                                                            <?php echo $recept_note; ?>
                                                            <?php } ?>

                                                          </p>
                                                        <?php } ?>     
                                                           
                                                       </div>

                                                    

                                                       
                                                    
                                                    
                                                        <div class="col-md-6">
                                                            
                                                            <p>
                                                                <br><br><br>
                                                                <strong style="float: left; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                        </div>
                                                  


                                                        

                                                        
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->


                                    
                                </div><!-- Main Wrapper -->
                                
                                </div>
                            </div>
                        </div>
                        

                                
                    <!-- 2nd recept-->
                    <div class="col-md-12 col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-body">

                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    

                                                    <div class="row">
                                                        <div class="col-md-8 text-left">
                                                            <!--<h3>Bavarian Automobile Engineering (Pvt) Ltd</h3>
                                                            <address>
                                                                No 3/8, Gunasekara Gardens, Nawala, Rajagiriya<br>
                                                                Phone Number<br>
                                                                info@bae.lk<br>
                                                                www.bae.lk
                                                            </address>-->
                                                            <img src="assets/BAE_Header.png" style="width: 70%;">
                                                            <br><br>
                                                            <h2 class="m-b-md m-t-xxs"><b>RECIEPT</b></h2>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="logoimg">
                                                            <img src="assets/logo-black-transparent.png" id="baeimg" style="width: 20%;"><br>
                                                            <!-- <h3>Invoice</h3> -->
                                                            <b>
                                                                <font style="font-size: 20px;">Reciept</font><br>
                                                                Reciept No : <?php echo $receipt_id; ?>
                                                            </b>
                                                        </div>  
                                                    </div>

                                                    <hr>

                                                    <div class="row">

                                                        <div class="col-md-8" id="print-table1">
                                                            
                                                            <p>
                                                                Invoice Name & Address:<br>
                                                                <?php echo $customer; ?><br>
                                                                <?php echo nl2br($client_address); ?><br>
                                                                <?php echo $email; ?><br>
                                                                <?php echo $phone_number; ?>
                                                            </p>
                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="print-table2">
                                                           
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle #</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $licens_no; ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $chassis_no; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Milage</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $mileage; ?>Km</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $receipt_date; ?></th>
                                                                        </tr>
                                                                        
                                                                        
                                                                    </thead>
                                                                </table>
                                                            </div>

                                                        </div>
                                                            
                                                    </div>
                                                        


                                                        <style>
                                                            .colorchange{
                                                                color: #000 !important;
                                                            }
                                                            .result{
                                                                color: #FF0000 !important;
                                                            }
                                                            .table-bordered {
                                                                border: 1px solid #000 !important;
                                                            }
                                                        </style>

                                                       
                                                       <div class="col-md-12">

                                                        <?php if($payment_method!=='Credit' && $date_count>''){ ?>
                                                        

                                                          <p id="print-p">
                                                            <hr>
                                                            
                                                            The outstanding credit amount of <b>Rs. <?php echo number_format($price,2); ?></b> of invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b> was settled though <b><?php echo $payment_method; ?></b> on <?php echo $receipt_date; ?>

                                                            <br><br>

                                                            <?php if ($recept_note=='') { }else{ ?>
                                                            <b>NOTE</b><br>
                                                            <?php echo $recept_note; ?>
                                                            <?php } ?>
                                                          </p>
                                                          

                                                        <?php }elseif($payment_method=='Credit' && $date_count!==''){ ?>

                                                          <p id="print-p">
                                                            <hr>
                                                            An amount of <b>Rs. <?php echo number_format($price,2); ?></b> of invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b> is approved of <b><?php echo $payment_method; ?></b> for <?php echo $date_count; ?> days from <?php echo $receipt_date; ?>
                                                            <br><br>

                                                            <?php if ($recept_note=='') { }else{ ?>
                                                            <b>NOTE</b><br>
                                                            <?php echo $recept_note; ?>
                                                            <?php } ?>
                                                          </p>


                                                        <?php }else{ ?>

                                                          <p id="print-p">
                                                            <hr>
                                                            An amount of <b>Rs. <?php echo number_format($price,2); ?></b> of invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b> was received through <b><?php echo $payment_method; ?></b> on <?php echo $receipt_date; ?>

                                                            <br><br>

                                                            <?php if ($recept_note=='') { }else{ ?>
                                                            <b>NOTE</b><br>
                                                            <?php echo $recept_note; ?>
                                                            <?php } ?>

                                                          </p>
                                                        <?php } ?>     
                                                           
                                                       </div>

                                                    

                                                       
                                                    
                                                    
                                                        <div class="col-md-6">
                                                            
                                                            <p>
                                                                <br><br><br>
                                                                <strong style="float: left; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                        </div>
                                                  


                                                        

                                                        
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->


                                    
                                </div><!-- Main Wrapper -->
                                
                                </div>
                            </div>
                        </div>
                                
                                

                    <!-- Gatepass Create -->
                    <div class="col-md-12 col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-body">   
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    

                                                    <div class="row">
                                                        <div class="col-md-8 text-left">
                                                            <!--<h3>Bavarian Automobile Engineering (Pvt) Ltd</h3>
                                                            <address>
                                                                No 3/8, Gunasekara Gardens, Nawala, Rajagiriya<br>
                                                                Phone Number<br>
                                                                info@bae.lk<br>
                                                                www.bae.lk
                                                            </address>-->
                                                            <img src="assets/BAE_Header.png" style="width: 70%;">
                                                            <br><br>
                                                            <h2 class="m-b-md m-t-xxs"><b>GATE PASS</b></h2>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="logoimg">
                                                            <img src="assets/logo-black-transparent.png" id="baeimg" style="width: 20%;"><br>
                                                            <!-- <h3>Invoice</h3> -->
                                                            <b>
                                                                <font style="font-size: 20px;">Reciept</font><br>
                                                                Reciept No : <?php echo $receipt_id; ?>
                                                            </b>
                                                        </div>  
                                                    </div>

                                                    <hr>

                                                    <div class="row">
                                                        <div class="col-md-8" id="print-table1">
                                                            
                                                            <p>
                                                                Invoice Name & Address:<br>
                                                                <?php echo $customer; ?><br>
                                                                <?php echo nl2br($client_address); ?><br>
                                                                <?php echo $email; ?><br>
                                                                <?php echo $phone_number; ?>
                                                            </p>
                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="print-table2">
                                                            


                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle #</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $licens_no; ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $chassis_no; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Milage</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $mileage; ?>Km</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><?php echo $receipt_date; ?></th>
                                                                        </tr>
                                                                        
                                                                        
                                                                    </thead>
                                                                </table>
                                                            </div>
  
                                                        </div>
                                                    </div>   


                                                        <style>
                                                            .colorchange{
                                                                color: #000 !important;
                                                            }
                                                            .result{
                                                                color: #FF0000 !important;
                                                            }
                                                            .table-bordered {
                                                                border: 1px solid #000 !important;
                                                            }
                                                        </style>

                                                       
                                                       <div class="col-md-12">
                                                          

                                                       

                                                          <p id="print-p">
                                                            <hr>
                                                            Vehicle allowed to be released against invoice <b>#BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$invoice_new_id); ?></b>
                                                            <br><br>

                                                          </p>


                                                          
                                                           
                                                       </div>

                                                    

                                                       
                                                    
                                                    
                                                        <div class="col-md-6">
                                                            
                                                            <p>
                                                                <br><br><br>
                                                                <strong style="float: left; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                        </div>
                                                  


                                                        

                                                        
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->














                            </div>
                        </div>






                    </div>
                    
                </div>




           


            </div>
        </div>

        <!-- Start page footer -->
        <div id="footer">
        <?php include_once('controls/footer.php'); ?>
        </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script>
    $(document).ready( function () {
        $('#itemTable').DataTable();
    } );
</script>

</body>
</html>