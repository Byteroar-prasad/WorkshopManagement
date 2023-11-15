<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');
    
    $JobId = base64_decode($_GET['i']);
    $invoice_save_id =0;

    $LabourCount=0;
    $PartCount=0;
    $total_job_fru_paybel = 0;
    $additional_price = 0;

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

    $GetDatasql = "SELECT * FROM tbl_vehicle_details tvd INNER JOIN tbl_tax tx ON tvd.v_id=tx.job_id INNER JOIN tbl_client tc ON tx.client_id=tc.client_id WHERE tvd.v_id= '$JobId' ";
    //$sql = "SELECT * FROM tbl_vehicle_details WHERE v_id= '$JobId' ";
    $rs=$conn->query($GetDatasql);
        while($row =$rs->fetch_array())
        {
            $job_id = $row[0];
            $email=$row[1];
            $reg_date=$row[2];
            $customer=$row[3];
            $phone_number=$row[4];
            $first_reg_date=$row[5];
            $reg_madel=$row[8];
            $reg_chassis_no=$row[9];
            $reg_licens_no=$row[10]; 
            $reg_mileage=$row[11]; 
            $service_advisor=$row[80];

            ////////////////////////////////

            $tax_id=$row[110]; 
            $tax_user_id=$row[112]; 
            $vat=$row[113]; 
            $discount=$row[114]; 
            $note=$row[115]; 
            // $additional_price=$row[116]; 
            $outdate=$row[117];
            $clientid=$row[118];

            //////////////////////////////// 

            $client_address=$row[126];
        }
    ?>


    <?php 

    $sql = "SELECT * FROM tbl_labour_paying ORDER BY labour_paying_id DESC LIMIT 1";
    $fruAmount=$conn->query($sql);
        while($Fru =$fruAmount->fetch_array())
        {
            
            $fru_points=$Fru[1];
            $fru_pay=$Fru[2];
            
        }
    ?>

    <?php 
        $sql = "SELECT * FROM tbl_advance WHERE job_id= '$JobId' AND stat='1' ";
        $advanceQuert=$conn->query($sql);
        $advance_full_pay = 0;
            while($aq =$advanceQuert->fetch_array())
            {
                $advance_id = $aq[0];
                $advance_note = $aq[3];
                $advance_pay=$aq[4];
                $advance_stat = $aq[5];
                $advance_date = $aq[6];
                $advance_full_pay += $advance_pay;
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
                            #logoimg_print{
                                width: 15% !important;
                            }
                            #topnav{
                                display: none;
                            }
                            #sidenav{
                                display: none;
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
                                margin-left: 160px;
                            }
                            #print-table3{
                                border: 1px solid #000 !important;
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
                            #color-change-green{
                                background-color: #0066B3 !important;
                            }
                            #color-change-green-new{
                                background-color: #0066B3 !important;
                                color: #000 !important;
                                /*border-color: #000000 !important;*/
                            }
                            #main-wrapper{
                                padding: 0px !important;
                            }
                            #btn-revert-job{
                                display: none;
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
                            #main-wrapper{
                                padding: 30px;
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
                                <?php 
                                    
                                    // $sql = "SELECT * FROM tbl_invoice ";
                                    // $SaveInvoice=$conn->query($sql);
                                    // while($SiI =$SaveInvoice->fetch_array())
                                    // {
                                                    
                                    //     $invoice_save_id=$SiI[1];
                                                    
                                    // }
                                ?>
                                <?php //if ($invoice_save_id==$tax_id) { }else{?>
                                <!--<form method="POST" id="Revert-Job">
                                    <input type="hidden" name="job_id" value="<?php //echo $JobId; ?>" readonly>
                                    <button type="submit" id="btn-revert-job" class="btn btn-default"><i class="fa fa-retweet"></i> Revert Job</button>
                                </form>
                                <br>-->
                                <!--<a href="job_card.php?j=<?php //echo base64_encode($JobId); ?>" id="printPageButton" class="btn btn-default"><i class="fa fa-long-arrow-left"></i> Go Back</a>-->
                                <?php //} ?>
                                <!-- Page Inner -->
                                <form method="POST" id="Save-Invoice">
                                <div class="page-inner">
                                    <div class="page-title">
                                        

                                        <!-- <input type="submit" name="" class="btn btn-default" value="Save "> -->

                                        <?php 
                                            
                                            $sql = "SELECT * FROM tbl_invoice ";
                                            $SaveInvoice=$conn->query($sql);
                                                while($SiI =$SaveInvoice->fetch_array())
                                                {
                                                    
                                                    $invoice_save_id=$SiI[1];
                                                    
                                                }
                                            ?>
                                            <?php if ($invoice_save_id==$tax_id) { ?>
                                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                            <?php }else{ ?>
                                                <a href="job_card.php?j=<?php echo base64_encode($JobId); ?>" id="printPageButton" class="btn text-white bg-red"><i class="fa fa-long-arrow-left"></i> Go Back</a>
                                                <button type="submit" id="printPageButton" class="btn text-white bg-green" data-toggle="tooltip" data-placement="right" title="This action can't be revert."><i class="fa fa-print"></i> Generate Invoice</button>
                                            <?php } ?>
                                            <input type="hidden" id="txt-invoice-img" name="invoice_screen">
                                            <input type="hidden" name="job_id" value="<?php echo $JobId; ?>" readonly>
                                        

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
                                                            <img src="assets/logo-black.png" id="logoimg_print" style="width: 20%;"><br>
                                                            <!-- <h3>Invoice</h3> -->
                                                            <b>
                                                                <font style="font-size: 20px;">Invoice</font><br>
                                                                Invoice No : BAE/IN/<?php echo $currentYear; ?>/<?php echo (10000+$tax_id); ?>
                                                            </b>
                                                            <input type="hidden" name="invoice_id" value="<?php echo $tax_id; ?>">
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

                                                            <input type="hidden" name="customer" value="<?php echo $customer; ?>">
                                                            <input type="hidden" name="client_address" value="<?php echo $client_address; ?>">
                                                            <input type="hidden" name="email" value="<?php echo $email; ?>">
                                                            <input type="hidden" name="phone_number" value="<?php echo $phone_number; ?>">

                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="print-table2">
                                                            


                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle #</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_licens_no; ?></font></th>
                                                                            
                                                                        </tr>
                                                                        <input type="hidden" name="licens_no" value="<?php echo $reg_licens_no; ?>">
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_chassis_no; ?></font></th>
                                                                        </tr>
                                                                        <input type="hidden" name="chassis_no" value="<?php echo $reg_chassis_no; ?>">
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Milage</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_mileage; ?> Km</font></th>
                                                                        </tr>
                                                                        <input type="hidden" name="mileage" value="<?php echo $reg_mileage; ?>">
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $outdate; ?></font></th>
                                                                        </tr>
                                                                        <input type="hidden" name="invoice_date" value="<?php echo $outdate; ?>">
                                                                        
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

                                                            <?php
                                                              $sql = "SELECT COUNT(*) FROM tbl_job_labour WHERE job_id= '$JobId'";
                                                              $result = mysqli_query($conn, $sql);
                                                              $labour_all_count = mysqli_fetch_assoc($result)['COUNT(*)'];
                                                              //echo $labour_all_count;
                                                            ?>

                                                            <?php if ($labour_all_count =='0') { ?> <?php }else{ ?>
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
                                                                            $sql = "SELECT * FROM tbl_job_labour WHERE job_id= '$JobId' ORDER BY job_labour_id ASC";
                                                                            $rs=$conn->query($sql);
                                                                            $total_job_fru_paybel = 0;
                                                                                while($row =$rs->fetch_array())
                                                                                {

                                                                                    $job_labour_id = $row[0];
                                                                                    $labour_id=$row[2];
                                                                                    $job_fru=$row[3];
                                                                                    $labour_discount=$row[4];
                                                                                    $labour_name_1=$row[5];
                                                                                    $labour_name_2=$row[6];
                                                                                    $labour_datetime=$row[7];
                                                                                    

                                                                                    ///////////////Labour//////////////////
                                                                                    $job_fru_paybel = $job_fru * $fru_pay;

                                                                                    $discountLabourAmount = ((double)$job_fru_paybel * (double)$labour_discount) / 100;
                                                                                    $totalLabourPriceWithDisc = (double)$job_fru_paybel - (double)$discountLabourAmount;

                                                                                    $total_job_fru_paybel += $totalLabourPriceWithDisc;
                                                                                    //////////////////////////////////////
                                                                             
                                                                            ?>
                                                                        <tr>
                                                                            <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=1; ?></td>
                                                                            <td id="td" style="text-align: left; width: 50px;">LABOUR</td>
                                                                            <?php if ($labour_discount=='0') { ?>
                                                                            <td id="td" style="width: 600px; text-transform: uppercase;"><?php echo $labour_name_1.' '.$labour_name_2; ?></td>
                                                                            <?php }else{ ?>
                                                                            <td id="td" style="width: 600px; text-transform: uppercase;"><?php echo $labour_name_1.' '.$labour_name_2; ?><span style="font-size: 10px;"> (<?php echo $labour_discount; ?>% Discount)</span></td>
                                                                            <?php } ?>
                                                                            <td id="td" style="text-align: right; width: 200px;"><?php echo number_format($fru_pay,2); ?></td>
                                                                            <td id="td" style="width: 100px; text-align: right;">
                                                                                <?php if ($labour_discount=='0') { }else{?>
                                                                                    <?php echo $labour_discount; ?>%
                                                                                <?php } ?>
                                                                            </td>
                                                                            <td id="td" style="width: 200px; text-align: right;"><?php echo $job_fru; ?></td>
                                                                            <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($totalLabourPriceWithDisc,2); ?></b></td>
                                                                        </tr>
                                                                        
                                                                        <input type="hidden" name="labour_details[]" value="<?php echo $job_labour_id; ?>,<?php echo $labour_name_1.' '.$labour_name_2; ?>,<?php echo $fru_pay; ?>,<?php echo $job_fru; ?>,<?php echo $labour_discount; ?>,<?php echo $totalLabourPriceWithDisc; ?>">

                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.labour_id='$job_labour_id' AND tji.job_id= '$JobId' ";
                                                                            $rsitem=$conn->query($sql);
                                                                            $total_part_price = 0;
                                                                            while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[11];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                    $Part_discount = (double)$rowitem[7];

                                                                                    /////////////Item Count/////////////////
                                                                                    $Item_price = (double)$rowitem[15];
                                                                                    // $Item_discount = $rowitem[16];

                                                                                    $Item_price_with_qty = $Item_price * $qty;
                                                                                    $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                                    $total_part_price += $totalPriceWithDisc;

                                                                            ?>

                                                                            <tr>
                                                                                <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=0.1; ?></td>
                                                                                <td id="td" style="text-align: left; width: 50px;">PART</td>
                                                                                <?php if ($Part_discount=='0') { ?>
                                                                                <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                                <?php }else{ ?>
                                                                                <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?> <span style="font-size: 10px;">(<?php echo $Part_discount; ?>% Discount)</span></td>
                                                                                <?php } ?>

                                                                                <td id="td" style="width: 200px; text-align: right;"><?php echo number_format($Item_price,2); ?></td>
                                                                                <?php if ($Part_discount=='0') { ?>
                                                                                <td id="td" style="width: 100px; text-align: right;"></td>
                                                                                <?php }else{ ?>
                                                                                <td id="td" style="width: 100px; text-align: right;"><?php echo $Part_discount; ?>%</td>
                                                                                <?php } ?>
                                                                                <td id="td" style="width: 200px; text-align: right;"><?php echo $qty; ?></td>
                                                                                <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($totalPriceWithDisc,2); ?></b></td>
                                                                            </tr>

                                                                            
                                                                            <input type="hidden" name="part_details[]" value="<?php echo $labourId; ?>,<?php echo $part_name; ?>,<?php echo $Item_price; ?>,<?php echo $Part_discount; ?>,<?php echo $qty; ?>,<?php echo $totalPriceWithDisc; ?>">
                                                                            


                                                                        <?php } ?>

                                                                    <?php $LabourCount-=0.1;} ?>


                                                                        <?php 
                                                                            $Subletsql = "SELECT * FROM tbl_job_sublet WHERE job_id= '$JobId' ORDER BY sublet_id ASC";
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
                                                                                    $additional_price += $SubletPrice;
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




                                                                    </tbody>

                                                                    <?php 
                                                                            $sql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.job_id= '$JobId' ";
                                                                            $rsitem=$conn->query($sql);
                                                                            $total_part_price = 0;
                                                                            while($rowitem =$rsitem->fetch_array())
                                                                                {

                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[10];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                    $Part_discount = $rowitem[7];

                                                                                    /////////////Item Count/////////////////
                                                                                    $Item_price = $rowitem[15];

                                                                                    $Item_price_with_qty = $Item_price * $qty;
                                                                                    $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                                    $total_part_price += $totalPriceWithDisc;

                                                                            ?>

                                                                        <?php } ?>


                                                                </table>
                                                            </div>

                                                            <?php

                                                                ///////////////////Without Additional price//////////////////////////////////

                                                                $total_price = $total_job_fru_paybel + $total_part_price + $additional_price;

                                                                $total_tax = $total_price * $vat/100;
                                                                $total_price_tax = $total_price + $total_tax;

                                                                /////////////////With Sublet(Additional Price)///////////////////////////////

                                                                $total_price_sublet = $total_price;

                                                                $total_tax_sublet = $total_price_sublet * $vat/100;
                                                                $total_price_sublet_tax = $total_price_sublet + $total_tax_sublet;

                                                                //////////////////With Advance/////////////////////////////////////////////////////

                                                                $total_price_advance = $total_price - $advance_full_pay;
                                                                $total_price_sublet_advance = $total_price_sublet - $advance_full_pay;
                                                                $total_price_tax_advance = $total_price_tax - $advance_full_pay;
                                                                $total_price_sublet_tax_advance = $total_price_sublet_tax - $advance_full_pay;



                                                            ?>

                                                        <?php } ?>



                                                        </div>

                                                    <div class="row">

                                                        <div class="col-md-8" id="note" style="padding-left:0;">
                                                            <!--<h4>Note</h4>
                                                            <p><?php //echo nl2br($note); ?></p>-->
                                                            <input type="hidden" name="note" value="<?php echo $note; ?>">
                                                        </div>


                                                        <div class="col-md-4" id="print-table-total">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">


                                                                    <!----------------Without Aditional Price And Without Vat And Advance---------------------------->
                                                                    <?php if($vat == '0' AND $discount == '0' AND $additional_price =='0' AND $advance_full_pay =='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price; ?>">

                                                                    <!----------------Without Aditional Price And Without Vat And With Advance---------------------------->
                                                                    <?php }elseif($vat == '0' AND $discount == '0' AND $additional_price =='0' AND $advance_full_pay !=='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price_advance,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="advance_pay" value="<?php echo $advance_full_pay; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price; ?>">


                                                                    <!----------------With Aditional Price And Without Vat And Without Advance---------------------------->
                                                                    <?php }elseif($vat == '0' AND $discount == '0' AND $additional_price !=='0' AND $advance_full_pay =='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($additional_price,2); ?></th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="sublet_price" value="<?php echo $additional_price; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price; ?>">


                                                                    <!----------------With Aditional Price And Without Vat And With Advance---------------------------->
                                                                    <?php }elseif($vat == '0' AND $discount == '0' AND $additional_price !=='0' AND $advance_full_pay !=='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($additional_price,2); ?></th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price_sublet_advance,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="sublet_price" value="<?php echo $additional_price; ?>">
                                                                        <input type="hidden" name="advance_pay" value="<?php echo $advance_full_pay; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price; ?>">

                                                                    <!----------------Without Aditional Price And With Vat Without Advance---------------------------->
                                                                    <?php }elseif ($vat !== '0' AND $discount == '0' AND $additional_price =='0' AND $advance_full_pay =='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $vat; ?>%)</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_tax,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price_tax,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="sub_total" value="<?php echo $total_price; ?>">
                                                                        <input type="hidden" name="vat" value="<?php echo $total_tax; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price_tax; ?>">


                                                                    <!----------------Without Aditional Price And With Vat With Advance---------------------------->
                                                                    <?php }elseif ($vat !== '0' AND $discount == '0' AND $additional_price =='0' AND $advance_full_pay !=='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $vat; ?>%)</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_tax,2); ?></th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price_tax_advance,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="sub_total" value="<?php echo $total_price; ?>">
                                                                        <input type="hidden" name="vat" value="<?php echo $total_tax; ?>">
                                                                        <input type="hidden" name="advance_pay" value="<?php echo $advance_full_pay; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price_tax; ?>">


                                                                    <!----------------With Aditional Price And With Vat Without Advance---------------------------->
                                                                    <?php }elseif ($vat !== '0' AND $discount == '0' AND $additional_price !=='0' AND $advance_full_pay =='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($additional_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_price_sublet,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $vat; ?>%)</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_tax_sublet,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price_sublet_tax,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="sublet_price" value="<?php echo $additional_price; ?>">
                                                                        <input type="hidden" name="sub_total" value="<?php echo $total_price_sublet; ?>">
                                                                        <input type="hidden" name="vat" value="<?php echo $total_tax_sublet; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price_sublet_tax; ?>">


                                                                    <!----------------With Aditional Price And With Vat With Advance---------------------------->
                                                                    <?php }elseif ($vat !== '0' AND $discount == '0' AND $additional_price !=='0' AND $advance_full_pay !=='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($additional_price,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sub Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_price_sublet,2); ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $vat; ?>%)</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_tax_sublet,2); ?></th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Advance Payment</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">(-<?php echo number_format($advance_full_pay,2); ?>)</th>
                                                                        </tr>

                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($total_price_sublet_tax_advance,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="labour_total" value="<?php echo $total_job_fru_paybel; ?>">
                                                                        <input type="hidden" name="parts_total" value="<?php echo $total_part_price; ?>">
                                                                        <input type="hidden" name="sublet_price" value="<?php echo $additional_price; ?>">
                                                                        <input type="hidden" name="sub_total" value="<?php echo $total_price_sublet; ?>">
                                                                        <input type="hidden" name="vat" value="<?php echo $total_tax_sublet; ?>">
                                                                        <input type="hidden" name="advance_pay" value="<?php echo $advance_full_pay; ?>">
                                                                        <input type="hidden" name="grand_total" value="<?php echo $total_price_sublet_tax; ?>">


                                                                    <!----------------With Aditional Price Only---------------------------->
                                                                    <?php }elseif ($vat == '0' AND $discount == '0' AND $additional_price !=='0' AND $advance_full_pay =='0'){ ?>
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;">Grand Total</th>

                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important;"><?php echo number_format($additional_price,2); ?></th>
                                                                        </tr>

                                                                        
                                                                    </thead>

                                                                        <input type="hidden" name="grand_total" value="<?php echo $additional_price; ?>">
                                                                    <?php } ?>


                                                                </table>
                                                            </div>

                                                        </div>
                                                        
                                                        <!-------------NOTE View----------------->
                                                        <?php if($note==''){}else{ ?>
                                                        <div class="col-md-12">
                                                            <h4>Note</h4>
                                                            <p><?php echo nl2br($note); ?></p>
                                                            <!--<p style="text-transform: uppercase;"><?php //echo nl2br($note); ?></p>-->
                                                        </div>
                                                        <?php } ?>


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


                                                        <div class="col-md-12" style="padding-left:0; display: none;">
                                                            <hr>
                                                            <p>
                                                                <strong>Service Advisor : <?php echo $service_advisor; ?></strong><br>
                                                            </p>
                                                        </div>
                                                        <input type="hidden" name="advisor" value="<?php echo $service_advisor; ?>">
                                                        
                                                        <div class="pull-right">
                                                            <!-- https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.google.com%2F&choe=UTF-8 -->
                                                            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http://amazofttestcloud.com/clients/bae/your_car?v_id=<?php echo base64_encode($job_id); ?>%2F&choe=UTF-8" title="Client Invoice"/>
                                                            <br><label style="text-align: center;">Scan to check inventory<br> and technical data</label>
                                                            <!--<img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2F124.43.5.226/Oshan/workshop/client_invoice?i=<?php echo base64_encode($invoice_new_id); ?>%2F&choe=UTF-8" title="Client Invoice"/>-->
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
                                                        <div id="content">
                                                          <div id="pageFooter"> </div>
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

<script src="assets/js/html2canvas.js"></script>
<script src="assets/js/html2canvas.min.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>


<script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>


        <script>

        $(document).ready(function(){

            html2canvas(document.getElementById("main-wrapper")).then(function(canvas){
            var result= canvas.toDataURL('image/png');
            $("#txt-invoice-img").val(result);

            });
        
        $(document).on('submit', '#Save-Invoice', function(e){
        e.preventDefault(); //stop default form submission
        
        var formData = new FormData($(this)[0]);

         

        $.ajax({

            beforeSend : function() {

                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Data is storing...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },
            
            

                url:"post/invoice_save.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                   

                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                      location.reload();
                      window.print();
                       
                    },1000);

                }

            });



                            
        });


        return false;
        });
    </script>
    
    <!-----------------------------Revert Invoice--------------------------------------->

    <!--<script>
        
        $(document).on('submit', '#Revert-Job', function(e){
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

                url:"post/revert_job.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");

                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Revert Job.'
                    });

                    setTimeout(function () {
                        window.location.href = ('job_card.php?j=<?php echo base64_encode($JobId); ?>');
                       //location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>-->
    
</body>
</html>