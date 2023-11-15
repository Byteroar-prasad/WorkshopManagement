<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    // $currentYear=date('Y');
    // $currentDate=date('Y-m-d H:i:s');
    
    $EstimateId = base64_decode($_GET['e']);
    $total_part_price = 0;
    $total_job_fru_paybel = 0;
    $LabourCount=0;
    $PartCount=0;
    $additional_price=0;
    
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

    $sql = "SELECT * FROM tbl_estimate_vehicle_number tevn INNER JOIN tbl_estimate_tax tx ON tevn.estimate_id=tx.estimate_id INNER JOIN tbl_vehicle tv ON tevn.license_no=tv.license_no INNER JOIN tbl_client tc ON tv.client_id=tc.client_id INNER JOIN users_login ul ON tx.user_id=ul.user_id WHERE tevn.estimate_id= '$EstimateId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $estimate_id = $row[0];
            $reg_licens_no=$row[1];
            $reg_mileage=$row[2];
            $reg_date=$row[3];
            $reg_madel=$row[16];
            $reg_chassis_no=$row[17];

            $email=$row[23];
            
            $customer=$row[22];
            $phone_number=$row[26];
            $client_address=$row[28];
            
            
            $estimate_creator=$row[31];

            ////////////////////////////////

            $tax_id=$row[5]; 
            $tax_user_id=$row[7]; 
            $vat=$row[8]; 
            $discount=$row[9]; 
            $note=$row[10]; 
            // $additional_price=$row[11]; 
            $outdate=$row[12];
            

            $currentYear=date('Y', strtotime($reg_date));

            //////////////////////////////// 
        }
    ?>


    <?php 

    $sql = "SELECT * FROM tbl_labour_paying ";
    $fruAmount=$conn->query($sql);
        while($Fru =$fruAmount->fetch_array())
        {
            
            $fru_points=$Fru[1];
            $fru_pay=$Fru[2];
            
        }
    ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                transform: scale(1);
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
                                display: none;
                            }
                            #footer{
                                display: none;
                            }
                            #invoice{
                                display: none;
                            }
                            #estimateButton{
                                display: none;
                            }
                            #print-table1{
                                width:40%; 
                                float:left;
                            }
                            #print-table2{
                                float:right;
                                width:30%;
                                margin-left: 270px;
                            }
                            #print-table3{
                                border: 1px solid #E6E8EB !important;
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
                                margin-top: -200px;
                            }
                            #logoimg_print{
                                width: 15% !important;
                            }
                            #color-change-green{
                                background-color: #0066B3 !important;
                            }
                            #color-change-green-new{
                                background-color: #0066B3 !important;
                                color: #fff !important;
                            }
                            #main-wrapper{
                                padding: 0px !important;
                            }
                            #part-order{
                                border: 0px solid #fff !important;
                                display: none !important;
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
                          




                                <!-- Page Inner -->
                                <div class="page-inner">
                                    <div class="page-title">
                                        <!-- <h3 class="breadcrumb-header" id="invoice">Estimate</h3> -->

                                            <?php if($user_role=='4'){ ?>
                                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                            <?php }else{ ?>
                                                <button type="button" id="printPageButton" onclick="location.href='estimate_card?e=<?php echo base64_encode($EstimateId); ?>'" class="btn text-white bg-red"><i class="fa fa-retweet"></i> Edit Again</button>
                                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                                <?php if($email==''){ }else{ ?>
                                                <button type="button" id="estimateButton" onclick="SendEmail('<?php echo $EstimateId; ?>')" class="btn btn-default"><i class="fa fa-envelope"></i> Email</button>
                                                <input type="hidden" id="txt_estimate_img" name="estimate_screen" readonly>
                                                <?php } ?>
                                                <button type="button" class="btn text-white bg-teal" data-toggle="modal" data-target="#move-labours-to-job"><i class="fa fa-plus"></i> Add This Labours to Job</button>
                                            <?php } ?>    
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
                                                            <h2 class="m-b-md m-t-xxs"><b>ESTIMATE</b></h2>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="logoimg">
                                                            <img src="assets/logo-black.png" id="logoimg_print" style="width: 20%;"><br>
                                                            <!-- <h3>Invoice</h3> -->
                                                            <b>
                                                                <font style="font-size: 20px;">Estimate</font><br>
                                                                Estimate : BAE/ES/<?php echo $currentYear; ?>/<?php echo (10000+$EstimateId); ?>
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
                                                            </p>
                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="print-table2">
                                                            


                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle#</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_licens_no; ?></font></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_chassis_no; ?></font></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Mileage</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_mileage; ?> Km</font></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $reg_date; ?></font></th>
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

                                                           
                                                            <div class="table" id="here">
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
                                                                            <th id="part-order" style="text-align: right; color: #fff; border: 0px solid #0066B3 !important; font-weight: 600;"></th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>


                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_estimate_labour WHERE estimate_id= '$EstimateId' ORDER BY estimate_id ASC";
                                                                            $rs=$conn->query($sql);
                                                                            
                                                                                while($row =$rs->fetch_array())
                                                                                {

                                                                                    $job_labour_id = $row[0];
                                                                                    $labour_id=$row[2];
                                                                                    $job_fru=$row[3];
                                                                                    $labour_name_1=$row[4];
                                                                                    $labour_name_2=$row[5];
                                                                                    $labour_datetime=$row[6];

                                                                                    ///////////////Labour//////////////////
                                                                                    $job_fru_paybel = $job_fru * $fru_pay;
                                                                                    $total_job_fru_paybel += $job_fru_paybel;
                                                                                    //////////////////////////////////////
                                                                                
                                                                            ?>
                                                                        <tr>
                                                                            <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=1; ?></td>
                                                                            <td id="td" style="text-align: left; width: 50px;">LABOUR</td>
                                                                            <td id="td" style="width: 600px; text-transform: uppercase;"><?php echo $labour_name_1.' '.$labour_name_2; ?></td>
                                                                            
                                                                            <td id="td" style="text-align: right; width: 200px;"><?php echo number_format($fru_pay,2); ?></td>
                                                                            <td id="td" style="width: 100px; text-align: right;">
                                                                                
                                                                            </td>
                                                                            <td id="td" style="width: 200px; text-align: right;"><?php echo round($job_fru,1); ?></td>
                                                                            <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($job_fru_paybel,2); ?></b></td>
                                                                            <td id="part-order"></td>
                                                                        </tr>

                                                                        <?php 
                                                                            $EstimateItemsql = "SELECT * FROM tbl_estimate_item tei INNER JOIN tbl_item ti ON tei.item_id=ti.item_id WHERE tei.labour_id='$job_labour_id' AND tei.estimate_id= '$EstimateId' ";
                                                                            $rsitem=$conn->query($EstimateItemsql);
                                                                            
                                                                            while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[11];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];

                                                                                    /////////////Item Count/////////////////
                                                                                    $Item_price = (double)$rowitem[8];
                                                                                    $Item_discount = $rowitem[7];

                                                                                    $discountAmount = ((double)$Item_price * (double)$Item_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price - (double)$discountAmount;



                                                                                    $Item_price_with_qty = (double)$totalPriceWithDisc * (double)$qty;
                                                                                    $total_part_price += (double)$Item_price_with_qty;
                                                                                    //////////////////////////////
                                                                            ?>
                                                                            <tr>
                                                                                <td id="td" style="text-align: left; width: 50px;"><?php echo $LabourCount+=0.1; ?></td>
                                                                                <td id="td" style="text-align: left; width: 50px;">PART</td>
                                                                                <?php if ($Item_discount=='0') { ?>
                                                                                <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                                <?php }else{ ?>
                                                                                <td id="td" style="width: 600px; text-transform: uppercase;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?> <span style="font-size: 10px;">(<?php echo $Item_discount; ?>% Discount)</span></td>
                                                                                <?php } ?>

                                                                                <td id="td" style="width: 200px; text-align: right;"><?php echo number_format($Item_price,2); ?></td>
                                                                                <?php if ($Item_discount=='0') {?>
                                                                                <td id="td" style="width: 200px; text-align: right;"></td>
                                                                                <?php }else{ ?>
                                                                                <td id="td" style="width: 100px; text-align: right;"><?php echo $Item_discount; ?>%</td>
                                                                                <?php } ?>
                                                                                <td id="td" style="width: 200px; text-align: right;"><?php echo $qty; ?></td>
                                                                                <td id="td" style="width: 200px; text-align: right;"><b><?php echo number_format($Item_price_with_qty,2); ?></b></td>
                                                                                <td id="part-order">
                                                                                <?php
                                                                                    //////////
                                                                                    $CheckPartOrderedSql = "SELECT COUNT(*) FROM tbl_part_order_item WHERE estimate_id='$EstimateId' AND item_id='$itemId'";
                                                                                    $CPOrs=$conn->query($CheckPartOrderedSql);
                                                                                    if($CPOrow =$CPOrs->fetch_array())
                                                                                    {
                                                                                        $CountPardOrderSum=$CPOrow[0];
                                                                                    }
                                                                                ?>
                                                                                <?php if($CountPardOrderSum > 0){}else{ ?>

                                                                                    <?php
                                                                                        //////////
                                                                                        $SumQTYNormalsql = "SELECT SUM(quantity) FROM tbl_item WHERE item_id='$itemId'";
                                                                                        $SQNrs=$conn->query($SumQTYNormalsql);
                                                                                        if($SQNrow =$SQNrs->fetch_array())
                                                                                        {
                                                                                            $QtyNormalSum=$SQNrow[0];
                                                                                        }
                                                                                        ///////////
                                                                                        $SumQTYPriceBadgesql = "SELECT SUM(qty) FROM tbl_item_price_batch WHERE item_id='$itemId'";
                                                                                        $SQrs=$conn->query($SumQTYPriceBadgesql);
                                                                                        if($SQrow =$SQrs->fetch_array())
                                                                                        {
                                                                                            $QtyPriceBatchSum=$SQrow[0];
                                                                                        }
                                                                                        $TotalQty=$QtyNormalSum+$QtyPriceBatchSum;
                                                                                    ?>
                                                                                    <?php if($TotalQty < $qty){ ?>
                                                                                    <form id="Add-Part-Order">
                                                                                        <input type="hidden" name="estimate_id" value="<?php echo $EstimateId; ?>">
                                                                                        <input type="hidden" name="item_id" value="<?php echo $itemId; ?>">
                                                                                        <input type="hidden" name="qty" value="<?php echo $qty; ?>">
                                                                                        <input type="hidden" name="item_cost" value="<?php echo $Item_price; ?>">
                                                                                        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                                                        <button type="submit" id="printPageButton" class="btn text-white bg-indigo" style="font-size: 10px;"><i class="fa fa-plus"></i></button>
                                                                                    </form>
                                                                                    <?php }else{ } ?>

                                                                                <?php } ?>

                                                                                </td>
                                                                            </tr>
                                                                        <?php } ?>

                                                                        

                                                                    <?php $LabourCount-=0.1;} ?>


                                                                        <?php 
                                                                            $Subletsql = "SELECT * FROM tbl_estimate_sublet WHERE estimate_id= '$EstimateId' ORDER BY sublet_id ASC";
                                                                            $Subletrs=$conn->query($Subletsql);
                                                                                while($gssRs =$Subletrs->fetch_array())
                                                                                {

                                                                                    $SubletId=$gssRs[0];
                                                                                    $SubletJobId=$gssRs[1];
                                                                                    $SubletDescription=$gssRs[2];
                                                                                    $SubletPrice=$gssRs[3];
                                                                                    $SubletDateTime=$gssRs[4];
                                                                                    

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
                                                                            <td id="part-order"></td>
                                                                        </tr>


                                                                        <?php } ?>

                                                                        

                                                                    </tbody>

                                                                    

                                                                </table>
                                                            </div>


                                                        </div>

                                                    <div class="row">

                                                        <?php

                                                            $total_price = $total_job_fru_paybel + $total_part_price + $additional_price;

                                                            $total_tax = $total_price * $vat/100;
                                                            $total_price_tax = $total_price + $total_tax;

                                                        ?>

                                                        <div class="col-md-8" id="note" style="padding-left:0;">
                                                            <h4>Note</h4>
                                                            <p>ESTIMATE PROVIDED IS VALID FOR 5 DAYS ONLY. 60% ADVANCE REQUIRED TO CONFIRM.</p>
                                                            <p><?php echo nl2br($note); ?></p>
                                                            <input type="hidden" name="note" value="<?php echo $note; ?>">
                                                        </div>

                                                        

                                                        
                                                        

                                                        <div class="col-md-4" id="print-table-total">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">


                                                                    
                                                                    <thead>
                                                                        <?php if ($total_job_fru_paybel=='0') { }else{ ?>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Labour Total</th>
                
                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_job_fru_paybel,2); ?></th>
                                                                            
                                                                        </tr>
                                                                        <?php }if ($total_part_price=='0') { }else{ ?>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Parts Total</th>
                
                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_part_price,2); ?></th>
                                                                        </tr>
                                                                        <?php }if ($additional_price=='0') { }else{ ?>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">Sublet Total</th>
                
                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($additional_price,2); ?></th>
                                                                        </tr>
                                                                        <?php }if ($vat=='0') { }else{ ?>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;">VAT (<?php echo $vat; ?>%)</th>
                
                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 14px;"><?php echo number_format($total_tax,2); ?></th>
                                                                        </tr>
                                                                        <?php }if ($total_price_tax=='0') { }else{ ?>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; width: 150px; padding: 5px 8px; font-weight: 600; text-align: center; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 20px;">Grand Total</th>
                
                                                                            <th class="colorchange" style="padding: 5px 8px; width: 100px; font-weight: 600; text-align: right; border: 1px solid #E6E8EB !important; border-top-color:#000 !important; border-right-color:#fff !important; border-left-color:#fff !important; border-bottom-color:#000 !important; font-size: 20px;"><?php echo number_format($total_price_tax,2); ?></th>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </thead>

                                                              


                                                                   


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


                                                        <div class="col-md-12" style="padding-left:0; display: none;">
                                                            <hr>
                                                            <p>
                                                                <strong>Service Advisor : <?php echo $estimate_creator; ?></strong><br>
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
                                                            <img src="https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=http%3A%2F%2Fbae.lk/%2F&choe=UTF-8" title="Estimate Invoice"/>
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


        <!-- Write Labour -->
        <div class="modal fade" id="move-labours-to-job" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLongTitle">Move Labours to Job</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                                        
                <form id="Add-Labours-To-Job" method="POST">
                    <input type="hidden" class="form-control" name="estimate_id" value="<?php echo $EstimateId; ?>" readonly required>
                                                                  
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Job Number <font style="color: #FF0000;">*</font></label>
                                <select class="js-example-basic-single form-control" name="job_id" style="width: 100% !important;" required>
                                    <option selected disabled>Select Job Number</option>
                                    <?php
                                        $getDataForDate=$conn->query("SELECT job_id,reg_date FROM tbl_job_details WHERE stat='1'");
                                        while ($gDFDrow=$getDataForDate->fetch_array()) {
                                            $JobId=$gDFDrow[0];
                                            $JobDate=$gDFDrow[1];
                                            $JobYear = date('Y', strtotime($JobDate));
                                    ?>
                                        <option value="<?php echo $JobId;?>">BAE/JOB/<?php echo $JobYear; ?>/<?php echo (10000+$JobId); ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                                                                   
                    <button type="submit" class="btn btn-primary waves-effect waves-light">Move Labours</button>
                                                                
                </form>

               </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-primary">Save changes</button> -->
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script type="text/javascript">
       
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>

<script>
    $(document).ready( function () {
        
        html2canvas(document.getElementById("main-wrapper")).then(function(canvas){
            var result= canvas.toDataURL('image/png');
            $("#txt_estimate_img").val(result);

            });
        
        
        $('#itemTable').DataTable();
    } );
</script>

    <script>
        
        function SendEmail(estimate_id,txt_estimate_img){
            
            // var txt_estimate_img = $("#txt_estimate_img").val();
            
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

                url:"estimate/send_estimate_email.php",
                type: 'POST',
                data: {
                    estimate_id:estimate_id,
                    txt_estimate_img:$("#txt_estimate_img").val()
                },
                //async: false,
                // cache: false,
                // contentType: false,
                // processData: false,

                success: function (data) {
                    
                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Email Successfully Sent.'
                    });

                    setTimeout(function () {
                  
                      location.reload();
                    },1000);

                }

            });
            
            
            
        }
        
        
        
    </script>

    
    <script>
        
        $(document).on('submit', '#Add-Part-Order', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
                beforeSend : function() {

                    // Swal.fire({
                    //   title:'Info !',
                    //   icon:'info',
                    //   text:'Details is being sending...Please wait.',
                    //   showConfirmButton:false,
                    //   showCancelButton:false,
                    //   allowOutsideClick: false,
                    // });

                },

                url:"part_order_post/add_parts_from_estimate_to_part_order.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    // Swal.fire({
                    //   title:'Thanks !',
                    //   icon:'success',
                    //   text:'Successfully Added Item.'
                    // });


                    setTimeout(function () {
                       // location.reload();
                       $( "#here" ).load(window.location.href + " #here" );
                    },500);

                }

            });

        return false;
        });
    </script>

    

    <script>
        
        $(document).on('submit', '#Add-Labours-To-Job', function(e){
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

                url:"estimate/move_labours_to_job.php",
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
                      text:'Successfully Added Item.'
                    });


                    setTimeout(function () {
                       // location.reload();
                       // $( "#here" ).load(window.location.href + " #here" );
                    },1000);

                }

            });

        return false;
        });
    </script>

</body>
</html>