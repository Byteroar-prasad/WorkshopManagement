<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');

    $InvoiceId = base64_decode($_GET['i']);

    $LabourCount=0;
    $PartCount=0;
    $sub_total=0;
    
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

    $sql = "SELECT * FROM tbl_invoice tin INNER JOIN tbl_tax ttx ON tin.invoice_id=ttx.tax_id WHERE tin.invoice_new_id= '$InvoiceId' ";
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
            $advance_full_pay=$row[20];
            $datetime=$row[21];

            ////////////////////////

            $job_id=$row[23];
            
            $InvoiceYear = date('Y', strtotime($datetime)) ;
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
                                zoom: 80%;
                                /*transform: scale(.6);*/
                                /*margin-top: -320px;*/
                                width: 100%;
                                font-weight: 700;
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
                                float:right !important;
                                width:40%;
                                margin-left: 160px;
                            }
                            #print-table3{
                                border: 1px solid #a9a9a9 !important;
                                /*color: #000 !important;*/
                            }
                            #print-table4{
                                border: 1px solid #a9a9a9 !important;
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
                                border-color: #a9a9a9;
                                padding: 5px 5px;
                            }
                            #td{
                                /*border: 0px solid #fff !important;*/
                                border: 1px solid #a9a9a9 !important;
                            }
                            #price1{
                                width: 100%;
                                float: right;

                                /*display: none;*/
                            }
                            #logoimg{
                                margin-top: -200px;
                            }
                            #logosize{
                                width: 15% !important;
                            }
                            #color-change-green{
                                background-color: #0066B3 !important;
                            }
                            #color-change-green-new{
                                background-color: #0066B3 !important;
                                color: #000 !important;
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
                          <!-- Page Inner -->
                            <!-- <form method="POST" id="Save-Invoice"> -->
                            <div class="page-inner">
                                <div class="page-title">
                                    <!-- <h3 class="breadcrumb-header" id="invoice" style="color: #000;">Invoice</h3> -->

                                    <!-- <input type="submit" name="" class="btn btn-default" value="Save "> -->

                                            <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                    <br><br>
                                </div>
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
                                                        <h2 class="m-b-md m-t-xxs"><b>INVOICE</b></h2>
                                                    </div>
                                                    <div class="col-md-4 text-right" id="logoimg">
                                                        <img src="assets/logo-black.png" id="logosize" style="width: 20%;"><br>
                                                        <!-- <h3>Invoice</h3> -->
                                                        <b>
                                                            <font style="font-size: 20px;">Invoice</font><br>
                                                            Job No : BAE/JOB/<?php echo $InvoiceYear; ?>/<?php echo (10000+$invoice_id); ?><br>
                                                            Invoice No : BAE/IN/<?php echo $InvoiceYear; ?>/<?php echo (10000+$invoice_new_id); ?>
                                                        </b>
                                                    </div>
                                                </div>
                                                

                                                <hr>

                                                <div class="row">

                                                    <div class="col-md-8" id="print-table1">
                                                        
                                                        <p>
                                                            Invoice Name & Address:<br>
                                                            <?php echo $customer; ?><br>
                                                            <?php echo $client_address; ?>
                                                            <!-- <?php //echo $email; ?>
                                                            <?php //echo $phone_number; ?> -->
                                                        </p>
                                                        
                                                    </div>

                                                    <div class="col-md-4 text-right" id="print-table2">
                                                        


                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle#</th>
                                                                        <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $licens_no; ?></font></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                        <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $chassis_no; ?></font></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Mileage</th>
                                                                        <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $mileage; ?> Km</font></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                        <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $invoice_date; ?></font></th>
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
                                                        <hr id="hr1">

                                                       
                                                        <div class="table">
                                                            <table class="table table-bordered" id="print-table3">
                                                                <thead>
                                                                    <tr id="color-change-green" style="background-color: #0066B3;">
                                                                        <th id="color-change-green-new" style="text-align: left; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">#</th>
                                                                        <th id="color-change-green-new" style="text-align: left; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">Type</th>
                                                                        <th id="color-change-green-new" style="text-align: center; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">Description</th>
                                                                        <th id="color-change-green-new" style="text-align: right; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">Unit Price</th>
                                                                        <th id="color-change-green-new" style="text-align: right; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">Discount%</th>
                                                                        <th id="color-change-green-new" style="text-align: right; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">QTY</th>
                                                                        <th id="color-change-green-new" style="text-align: right; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;">Total</th>
                                                                        
                                                                    </tr>
                                                                </thead>
                                                            
                                                                <tbody>


                                                                    <?php 
                                                                        $sql = "SELECT * FROM tbl_invoice_labour WHERE invoice_id= '$InvoiceId' ORDER BY tbl_invoice_labour_id ASC";
                                                                        $rs=$conn->query($sql);
                                                                            while($row =$rs->fetch_array())
                                                                            {

                                                                                $tbl_invoice_labour_id = $row[0];
                                                                                $labour_id = $row[2];
                                                                                $labour_details=$row[3];
                                                                                $datetime=$row[4];

                                                                                $labour_details_explode = explode(",",$labour_details);
                                                                                // $labour_id = $labour_details_explode[0];
                                                                                $labour_name = $labour_details_explode[1];
                                                                                $fru_pay = (double)$labour_details_explode[2];
                                                                                $job_fru = $labour_details_explode[3];
                                                                                $job_discount = $labour_details_explode[4];
                                                                                $job_fru_paybel = $labour_details_explode[5];


                                                                    ?>

                                                                            <script>
                                                                                var labour_view_status_<?php echo $labour_id;?> = 1;
                                                                            </script>

                                                                    <?php
                                                                               
                                                                            
                                                                        ?>
                                                                    <tr id="labour-change-<?php echo $labour_id; ?>" style="cursor: pointer;">
                                                                        <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=1; ?></td>
                                                                        <td id="td" style="text-align: left; width: 50px;">LABOUR</td>
                                                                        <?php if ($job_discount=='0') { ?>
                                                                        <td id="td" style="width: 600px; text-transform: uppercase;"><?php echo $labour_name; ?></td>
                                                                        <?php }else{ ?>
                                                                        <td id="td" style="width: 600px; text-transform: uppercase;"><?php echo $labour_name; ?><span style="font-size: 10px;"> (<?php echo $job_discount; ?>% Discount)</span></td>
                                                                        <?php } ?>
                                                                        <td id="td" style="text-align: right; width: 200px;"><?php echo number_format($fru_pay,2); ?></td>
                                                                        <td id="td" style="width: 100px; text-align: right;">
                                                                            <?php if ($job_discount=='0') { }else{?>
                                                                                <?php echo $job_discount; ?>%
                                                                            <?php } ?>
                                                                        </td>
                                                                        <td id="td" style="width: 200px; text-align: right;"><?php echo $job_fru; ?></td>
                                                                        <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($job_fru_paybel,2); ?></b></td>
                                                                    </tr>

                                                                    <?php 
                                                                        $sql = "SELECT * FROM tbl_invoice_parts WHERE part_labour_id='$labour_id' AND invoice_id= '$InvoiceId' ";
                                                                        $rsitem=$conn->query($sql);
                                                                        $total_part_price = 0;
                                                                        while($rowitem =$rsitem->fetch_array())
                                                                            {
                                                                                $tbl_invoice_labour_id = $rowitem[0];
                                                                                $part_details=$rowitem[3];
                                                                                $datetime = $rowitem[4];


                                                                                $labour_parts_explode = explode(",",$part_details);
                                                                                $labourId = $labour_parts_explode[0];
                                                                                $part_name = $labour_parts_explode[1];
                                                                                $Item_price = (double)$labour_parts_explode[2];
                                                                                $Item_discount = $labour_parts_explode[3];
                                                                                $qty = $labour_parts_explode[4];
                                                                                $Item_price_with_qty = $labour_parts_explode[5];

                                                                                $total_part_price += $Item_price_with_qty;

                                                                           
                                                                        ?>
                                                                        <tr id="collapse-parts-<?php echo $labour_id; ?>" class="trhideclass1<?php echo $labour_id; ?>">
                                                                            <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=0.1; ?></td>
                                                                            <td id="td" style="text-align: left; width: 50px;">PART</td>
                                                                            <?php if ($Item_discount!=='0') { ?>
                                                                            <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?> <span style="font-size: 10px;">(<?php echo $Item_discount; ?>% Discount)</span></td>
                                                                            <?php }else{ ?>
                                                                            <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                            <?php } ?>

                                                                            <td id="td" style="width: 200px; text-align: right;"><?php echo number_format($Item_price,2); ?></td>
                                                                            <?php if ($Item_discount!=='0') { ?>
                                                                            <td id="td" style="width: 100px; text-align: right;"><?php echo $Item_discount; ?>%</td>
                                                                            <?php }else{ ?>
                                                                            <td id="td" style="width: 100px; text-align: right;"></td>
                                                                            <?php } ?>
                                                                            <td id="td" style="width: 200px; text-align: right;"><?php echo $qty; ?></td>
                                                                            <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($Item_price_with_qty,2); ?></b></td>
                                                                        </tr>
                                                                    <?php } ?>

                                                                            <tr id="expand-parts<?php echo $labour_id; ?>" style="display: none;">
                                                                                <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=0.1; ?></td>
                                                                                <td id="td" style="text-align: left; width: 50px;">PART</td>
                                                                                <!--<td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $labour_name; ?> PARTS / MATERIALS</td>-->
                                                                                <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;PARTS / MATERIALS</td>
                                                                                <td id="td" style="width: 200px; text-align: right;"></td>
                                                                                <td id="td" style="width: 100px; text-align: right;"></td>
                                                                                <td id="td" style="width: 200px; text-align: right;"></td>
                                                                                <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($total_part_price,2); ?></b></td>
                                                                            </tr>



                                                                            <script>
                                                                                $(document).ready(function(){
                                                                                    $("#labour-change-<?php echo $labour_id; ?>").click(function(){

                                                                                        if(labour_view_status_<?php echo $labour_id; ?> === 1){
                                                                                            //////hide////
                                                                                            $('.trhideclass1<?php echo $labour_id; ?>').hide();
                                                                                            $("#expand-parts<?php echo $labour_id; ?>").show();
                                                                                            labour_view_status_<?php echo $labour_id; ?> = 0;
                                                                                        }else{
                                                                                            ////////show///
                                                                                            $('.trhideclass1<?php echo $labour_id; ?>').show();
                                                                                            $("#expand-parts<?php echo $labour_id; ?>").hide();
                                                                                            labour_view_status_<?php echo $labour_id; ?> = 1;
                                                                                        }

                                                                                    });
                                                                                });
                                                                            </script>

                                                                    

                                                                <?php $LabourCount-=0.1;} ?>

                                                                <?php if ($sublet_price=='0') { }else{ ?>

                                                                    <?php 
                                                                        $Subletsql = "SELECT * FROM tbl_job_sublet WHERE job_id= '$job_id' ORDER BY sublet_id ASC";
                                                                        $Subletrs=$conn->query($Subletsql);
                                                                            while($gssRs =$Subletrs->fetch_array())
                                                                            {

                                                                                $SubletId=$gssRs[0];
                                                                                $SubletJobId=$gssRs[1];
                                                                                $SubletDescription=$gssRs[2];
                                                                                $SubletPrice=$gssRs[3];
                                                                                $SubletUserId=$gssRs[4];
                                                                                $SubletDateTime=$gssRs[5];
                                                                                    

                                                                                ///////////////SUBLET//////////////////
                                                                                // $additional_price += $SubletPrice;
                                                                                //////////////////////////////////////
                                                                             
                                                                            ?>
                                                                        <tr>
                                                                            <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=1; ?></td>
                                                                            <td id="td" style="text-align: left; width: 50px;">SUBLET</td>
                                                                            <td id="td" style="width: 600px;"><?php echo $SubletDescription; ?></td>
                                                                            <td id="td" style="text-align: right; width: 200px;"><?php echo number_format($SubletPrice,2); ?></td>
                                                                            <td id="td" style="width: 100px; text-align: right;"></td>
                                                                            <td id="td" style="width: 200px; text-align: right;"></td>
                                                                            <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($SubletPrice,2); ?></b></td>
                                                                        </tr>


                                                                    <?php } ?>
                                                                <?php } ?>


                                                                    

                                                                    

                                                                </tbody>

                                                                

                                                            </table>
                                                        </div>


                                                    </div>

                                                <div class="row">

                                                    <div class="col-md-8" id="note" style="padding-left:0;">
                                                        <!--<h4>Note</h4>
                                                        <p><?php //echo nl2br($note); ?></p>-->
                                                    </div>

                                                    <?php

                                                    $tax= 0;
                                                    $total_tax_sublet=0;

                                                    $grand_total_advance = $grand_total - $advance_full_pay;
                                                    
                                                    if ($sub_total !=='0') {

                                                        $tax = $vat/$sub_total * 100;

                                                        $total_tax_sublet = $vat/$sub_total * 100;
                                                        
                                                    }

                                                    

                                                     ?>

                                                    


                                                    <div class="col-md-4" id="print-table-total">
                                                        <div class="table-responsive">
                                                            <table class="table table-bordered" style="border: 1px solid #fff !important;">


                                                                <!----------------Without Aditional Price And Without Vat AND Without Advance---------------------------->
                                                                <?php if($vat == '0' AND $sublet_price =='0' AND $advance_full_pay =='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>

                                                                <!----------------Without Aditional Price And Without Vat AND With Advance---------------------------->
                                                                <?php }elseif($vat == '0' AND $sublet_price =='0' AND $advance_full_pay !=='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total_advance,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>


                                                                <!----------------With Aditional Price And Without Vat And Without Advance---------------------------->
                                                                <?php }elseif($vat == '0' AND $sublet_price !=='0' AND $advance_full_pay =='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sublet_price,2); ?></th>
                                                                    </tr>

                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>

                                                                <!----------------With Aditional Price And Without Vat And With Advance---------------------------->
                                                                <?php }elseif($vat == '0' AND $sublet_price !=='0' AND $advance_full_pay !=='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sublet_price,2); ?></th>
                                                                    </tr>

                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                    </tr>

                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total_advance,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>
                                                                   
                                                                <!----------------Without Aditional Price And With Vat And Without Advance---------------------------->
                                                                <?php }elseif ($vat !== '0' AND $sublet_price =='0' AND $advance_full_pay =='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sub_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $tax; ?>%)</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($vat,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>

                                                                <!----------------Without Aditional Price And With Vat And With Advance---------------------------->
                                                                <?php }elseif ($vat !== '0' AND $sublet_price =='0' AND $advance_full_pay !=='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sub_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $tax; ?>%)</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($vat,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total_advance,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>

                                                                <!----------------With Aditional Price And With Vat And Without Advance---------------------------->
                                                                <?php }elseif ($vat !== '0' AND $sublet_price !=='0' AND $advance_full_pay =='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>

                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sublet_price,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sub_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $total_tax_sublet; ?>%)</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($vat,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>

                                                                <!----------------With Aditional Price And With Vat And With Advance---------------------------->
                                                                <?php }elseif ($vat !== '0' AND $sublet_price !=='0' AND $advance_full_pay !=='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($labour_total,2); ?></th>
                                                                        
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($parts_total,2); ?></th>
                                                                    </tr>

                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sublet_price,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($sub_total,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $total_tax_sublet; ?>%)</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($vat,2); ?></th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                    </tr>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total_advance,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>


                                                                <!----------------With Aditional Price Only---------------------------->
                                                                <?php }elseif ($vat == '0' AND $sublet_price !=='0' AND $advance_full_pay =='0'){ ?>
                                                                <thead>
                                                                    <tr>
                                                                        <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                        <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($grand_total,2); ?></th>
                                                                    </tr>

                                                                    
                                                                </thead>

                                                                <?php } ?>


                                                            </table>
                                                        </div>

                                                    </div>
                                                    
                                                        
                                                    


                                                </div>      
                                                <br><br><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        
                                                        <p>
                                                            <strong style="float: left; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                        <p>
                                                            <strong style="float: right; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                                
                                                    <!-------------NOTE View----------------->
                                                    <?php if($note==''){}else{ ?>
                                                    <br><br>
                                                    <div class="col-md-12">
                                                        <h4>Note</h4>
                                                        <p><?php echo nl2br($note); ?></p>
                                                        <!--<p style="text-transform: uppercase;"><?php //echo nl2br($note); ?></p>-->
                                                    </div>
                                                    <?php } ?>


                                                    <div class="col-md-12" style="padding-left:0; display: none;">
                                                        <hr>
                                                        <p>
                                                            <strong>Service Advisor : <?php echo $advisor; ?></strong><br>
                                                        </p>
                                                    </div>
                                                    

                                                    <style type="text/css">
                                                        #content {
                                                            display: table;
                                                        }

                                                        #pageFooter {
                                                            display: table-footer-group;
                                                        }

                                                        #pageFooter:after {
                                                            counter-increment: page;
                                                            content: counter(page);
                                                        }
                                                        #pageFooter:after {
                                                            counter-increment: page;
                                                            content:"Page " counter(page);
                                                            left: 0; 
                                                            top: 100%;
                                                            white-space: nowrap; 
                                                            z-index: 20;
                                                            -moz-border-radius: 5px; 
                                                            -moz-box-shadow: 0px 0px 4px #222;  
                                                            background-image: -moz-linear-gradient(top, #eeeeee, #cccccc);  
                                                          }
                                                    </style>

                                                    <br><br>
                                                    <!-- <div id="content">
                                                      <div id="pageFooter"> </div>
                                                    </div> -->
                                                    <div class="pull-right">
                                                        <!-- https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8 -->
                                                        <!--<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F124.43.5.226/Oshan/workshop/client_invoice?i=<?php //echo base64_encode($invoice_new_id); ?>%2F&choe=UTF-8" title="Client Invoice"/>-->
                                                        <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2Fbae.lk/%2F&choe=UTF-8" title="Client Invoice"/>
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