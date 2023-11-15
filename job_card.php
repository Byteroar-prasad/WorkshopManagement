<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');

    $JobId = base64_decode($_GET['j']);

    $total_part_price = 0;
    $total_job_fru_paybel = 0;
    
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

    $sql = "SELECT * FROM tbl_job_details WHERE job_id= '$JobId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $job_id = $row[0];
            $email=$row[1];
            $reg_date=$row[2];
            $customer=$row[3];
            $phone_number=$row[4];
            $reg_madel=$row[6];
            $reg_chassis_no=$row[7];
            $reg_licens_no=$row[8]; 
            $reg_mileage=$row[9]; 
            $vehicleComment=$row[11]; 
            $service_advisor=$row[10]; 
            
            $job_stat=$row[12];
        }
    ?>

<?php 

    $sql = "SELECT * FROM tbl_labour_paying ORDER BY labour_paying_id DESC LIMIT 1";
    $fruAmount=$conn->query($sql);
        while($Fru =$fruAmount->fetch_array())
        {
            
            $fru_points=$Fru[1];
            $fru_pay=(double)$Fru[2];
            
        }
?>
<?php

    if($job_stat=='2'){

    ?>

        <script type="text/javascript">
            window.location.href="index";
        </script>

<?php 

    }else{

?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

                    <style>
                        #part-list-writing-area{
                            display: none;
                        }
                        #road-test-write-area{
                            display: none;
                        }
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
                                margin-top: 70px;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #logo-img{
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
                            #add-labour-button{
                                display: none;
                            }
                            #part-qty-change-click{
                                display: none;
                            }
                            #add-part-button{
                                display: none;
                            }
                            #add-upload-labour-button{
                                display: none;
                            }
                            #invoice-button{
                                display: none;
                            }
                            #note-button{
                                display: none;
                            }
                            #preview-invoice-button{
                                display: none;
                            }
                            #com-details{
                                margin-top: -150px;
                            }
                            #vehicle-details{
                                margin-top: -50px;
                                /*margin-top: -500px !important;*/
                            }
                            #part-list-area{
                                display: none;
                                /*page-break-before: always;
                                margin-top: 20px;*/
                            }
                            #part-list-writing-area{
                                display: revert !important;
                                page-break-before: always;
                                margin-top: 20px;
                            }
                            #road-test-write-area{
                                display: revert !important;
                            }
                            .plusminus{
                                display: none;
                            }
                            #refresh-btn{
                                display: none;
                            }
                            #price-view{
                                display: none;
                            }
                            #btn-delete{
                                display: none;
                            }
                            .partlistbtn{
                                display: none;
                            }
                            #sublet-button{
                                display: none;
                            }
                            .table thead th {
                                border-bottom: 2px solid #a9a9a9 !important;
                                font-size: 15px;
                            }
                            /*.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {*/
                            /*    border-color: #fff;*/
                            /*    padding: 5px 5px;*/
                            /*}*/
                            #print-fru{
                                display: block !important;
                                text-align: center !important;
                            }
                            #qty_print{
                                display: none;
                            }
                            #discount_print{
                                display: none;
                            }
                            #qty_change_print{
                                display: none;
                            }
                            #labour_discount_print{
                                display: none;
                            }
                            #part_print_view{
                                display: none;
                            }
                            #no_need_print{
                                display: none;
                            }
                            #print_job_details{
                                color: #000 !important;
                            }
                            
                            
                          }
                        .deletelabour{
                            border-color: #e00000;
                            color: #e0000a;
                        }
                        .plusminus{
                            padding: 0.1rem 0.5rem !important;
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
                                    <!--<div class="page-title">
                                        <h3 style="color: #000; text-align: center;">Job Card</h3>
                                    </div>-->
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-8" style="padding-left:0;">
                                                            <img src="assets/BAE_Header.png" style="width: 70%;">
                                                            <br><br>
                                                            <!--<p class="m-b-md m-t-xxs"><b><?php //echo $customer; ?></b></p>-->
                                                            <!--<address>
                                                                E: <?php //echo $email; ?><br>
                                                                P: <?php //echo $phone_number; ?>
                                                            </address>-->
                                                            <p>
                                                                Customer Name - <?php echo $customer; ?>                                                       
                                                            </p>
                                                            <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                            <button class="btn btn-dark plusminus" id="client-button" data-toggle="modal" data-target="#update_client_details"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Update Client Details</button>
                                                            <?php }else{ } ?>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="com-details" style="padding-right:0;">
                                                            <img src="assets/logo-black.png" id="logo-img" style="width: 20%;"><br>
                                                            <address>
                                                                <h2 class="m-b-md m-t-xxs"><b>JOB CARD<br>
                                                                <font style="font-size: 14px;">Job No : BAE/JOB/<?php echo $currentYear; ?>/<?php echo (10000+$JobId); ?></font>
                                                                </b></h2><br>
                                                                <!--<b id="job_id_print">
                                                                    Job No : BAE/JOB/<?php //echo $currentYear; ?>/<?php //echo (10000+$JobId); ?>
                                                                </b><br>-->
                                                            </address>
                                                            
                                                            <?php if ($user_role=='1'){ ?>
                                                            <form id='Close-Job' style="display: initial;">
                                                                <input type="hidden" value="<?php echo $JobId; ?>" name="job_id" readonly required>
                                                                <button type="submit" id="printPageButton" class="btn text-white bg-red"><i class="fa fa-times"></i> Close Job</button>
                                                            </form>
                                                            <?php }else{ } ?>
                                                            
                                                            <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                                        </div>
                                                    </div>
                                                        
                                                        <br><br>

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

                                                        <div class="col-md-12" id="vehicle-details">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="color:#000;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Vehicle Number</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $reg_licens_no; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">VIN</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $reg_chassis_no; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">In Date Time</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $reg_date; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Mileage</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $reg_mileage; ?> Km
                                                                            <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                                                <br><button class="btn btn-light pull-right plusminus" style="margin-top: -22px !important;" id="mileage-button" data-toggle="modal" data-target="#update_mileage"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                            <?php }else{ } ?>
                                                                            
                                                                            </th>
                                                                            <th class="colorchange" style="font-weight: 600;">Model</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $reg_madel; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Service Advisor</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $service_advisor; ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            
                                                            <p>
                                                                <b>Description :</b><br>
                                                                <?php echo nl2br($vehicleComment); ?>
                                                                
                                                                <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                                    <br><button class="btn btn-light plusminus" id="client-button" data-toggle="modal" data-target="#update_job_description"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                                                <?php }else{ } ?>
                                                            </p>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <hr>
                                                        <!--<?php //if ($user_role=='1'){ ?>
                                                            <button type="button" id="add-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>
                                                            <button type="button" id="add-upload-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-cloud-upload"></i> Upload Labour</button>
                                                            <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                                        <?php //}elseif ($user_role=='0') { ?>
                                                            <button type="button" id="add-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>
                                                            <button type="button" id="add-upload-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-cloud-upload"></i> Upload Labour</button>
                                                            <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                                        <?php //}elseif ($user_role=='2') { ?>
                                                            <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                                        <?php //}else{} ?>-->
                                                            <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>

                                                            <br><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="1" style="text-align: center;">#</th>
                                                                            <th colspan="2" style="text-align: center;">Labour</th>
                                                                            <th colspan="1" style="text-align: center;" id="qty_print">Qty</th>
                                                                            <th colspan="1" style="text-align: center;">FRU</th>
                                                                            <th colspan="1" style="text-align: center;" id="discount_print">Discount</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>

                                                                        <?php 
                                                                            $LabourCount=0;
                                                                            $Laboursql = "SELECT * FROM tbl_job_labour WHERE job_id= '$JobId' ORDER BY job_labour_id ASC";
                                                                            $rs=$conn->query($Laboursql);
                                                                            
                                                                                while($row =$rs->fetch_array())
                                                                                {
                                                                                    $job_labour_id = $row[0];
                                                                                    $labour_id=$row[2];
                                                                                    $job_fru=(double)$row[3];
                                                                                    $labour_discount=$row[4];
                                                                                    $labour_name_1=$row[5];
                                                                                    $labour_name_2=$row[6];
                                                                                    $labour_datetime=$row[7];

                                                                                    //////////////////////////////////////
                                                                                    $job_fru_paybel = $job_fru * $fru_pay;

                                                                                    $discountLabourAmount = ((double)$job_fru_paybel * (double)$labour_discount) / 100;
                                                                                    $totalLabourPriceWithDisc = (double)$job_fru_paybel - (double)$discountLabourAmount;

                                                                                    // $job_fru_disocunt_paybel = (double)$job_fru_paybel - (double)$totalLabourPriceWithDisc;

                                                                                    
                                                                                    $total_job_fru_paybel += $totalLabourPriceWithDisc;

                                                                                    //////////////////////////////////////
                                                                                
                                                                            ?>
                                                                        <tr>
                                                                            <td colspan="1"><center><?php echo $LabourCount+=1; ?></center></td>
                                                                            <td colspan="2">
                                                                                <b style="text-transform: uppercase;"><?php echo $labour_name_1.' '.$labour_name_2; ?></b>
                                                                                <?php 
                                                                                    $cRs = $conn->query("SELECT count(*) FROM `tbl_job_item` WHERE `labour_id` ='$job_labour_id'");
                                                                                    if($r = $cRs->fetch_array()){
                                                                                        $count = $r[0];
                                                                                    }
                                                                                ?>
                                                                                <?php if($count > 0){ }else{ ?>
                                                                                    <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                                                    <form id="Delete-Labour" method="POST">
                                                                                        <input type="hidden" class="form-control" name="job_labour_id" id="job_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                                        <button type="submit" class="btn btn-outline-danger btn-sm deletelabour pull-right" id="btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                                    </form>
                                                                                    <?php }else { }?>
                                                                                <?php } ?>

                                                                                <?php if ($user_role=='1' || $user_role=='2'){ ?>
                                                                                <button type="submit" class="btn btn-outline-primary btn-sm addpart pull-right partlistbtn" onclick="showModal('<?php echo $job_labour_id;?>')" style="margin-right: 5px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Parts</button>
                                                                                <?php }else { }?>
                                                                            
                                                                            </td>
                                                                            <td colspan="1" id="qty_change_print"></td>
                                                                            <td colspan="1">
                                                                                <b id="fru-bold"><font id="print-fru"><?php echo $job_fru; ?></font></b>
                                                                                <button class="btn btn-light plusminus" style="float: right;" id="fru-edit-button" class="btn btn-info" data-toggle="modal" data-target="#update_fru_<?php echo $job_labour_id; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                                                            </td>
                                                                            <td colspan="1" style="width: 150px;" id="labour_discount_print">
                                                                                <b><?php echo $labour_discount; ?>%</b>
                                                                                <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                                                <button class="btn btn-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_labour_discount_<?php echo $job_labour_id; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                                                                <?php }else { }?>
                                                                            </td>
                                                                        </tr>
                                                                        
                                                                        <!-- Add FRU Update -->
                                                                        <div class="modal fade" id="update_fru_<?php echo $job_labour_id; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo $labour_name_1.' '.$labour_name_2; ?> FRU</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                
                                                                                <form id="Update-Fru" method="POST">
                                                                                    <input type="hidden" class="form-control" name="job_labour_id" id="job_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                                    <!-- <div class="panel-heading clearfix">
                                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                                    </div> -->
                                                                                    <div class="panel-body">
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group">
                                                                                                <label for="3">FRU <font style="color: #FF0000;">*</font></label>
                                                                                                <input type="number" class="form-control" name="job_fru" min="0" id="job_fru" value="<?php echo $job_fru; ?>" placeholder="FRU" step="any" required>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <center>
                                                                                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update FRU</button>
                                                                                    </center>
                                                                                </form>

                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div>

                                                                        <!-- Add Labour Discount -->
                                                                        <div class="modal fade" id="genarate_labour_discount_<?php echo $job_labour_id; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                          <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                              <div class="modal-header">
                                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo $labour_name_1.' '.$labour_name_2; ?> Discount</h5>
                                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                  <span aria-hidden="true">&times;</span>
                                                                                </button>
                                                                              </div>
                                                                              <div class="modal-body">
                                                                                
                                                                                <form id="Add-Labour-Discount" method="POST">
                                                                                        <input type="hidden" class="form-control" name="job_labour_id" id="job_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                                            <!-- <div class="panel-heading clearfix">
                                                                                                <h4 class="panel-title">Register Client Details</h4>
                                                                                            </div> -->
                                                                                            <div class="panel-body">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="3">Discount % <font style="color: #FF0000;">*</font></label>
                                                                                                        <input type="number" class="form-control" name="labour_discount" min="0" max="100" id="labour_discount" value="<?php echo $labour_discount; ?>" placeholder="Discount %" step="any" required>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <center>
                                                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Add Discount</button>
                                                                                            </center>
                                                                                            
                                                                                        
                                                                                    </form>

                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                              </div>
                                                                            </div>
                                                                          </div>
                                                                        </div>

                                                                        <?php 
                                                                            $Partsql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.labour_id='$job_labour_id' AND tji.job_id= '$JobId' ";
                                                                            $rsitem=$conn->query($Partsql);
                                                                            
                                                                                while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[12];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                    $Part_discount = $rowitem[7];
                                                                                    $ItemStat = $rowitem[8];

                                                                                    /////////////Item Count/////////////////
                                                                                    $PartNumber = $rowitem[14];
                                                                                    //Correct Price
                                                                                    $Item_price = (double)$rowitem[9];
                                                                                    // $Item_price = $rowitem[16];
                                                                                    // $Item_discount = $rowitem[16];

                                                                                    $Item_price_with_qty = $Item_price * $qty;
                                                                                    $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                                    $total_part_price += $totalPriceWithDisc;
                                                                                    //////////////////////////////
                                                                                
                                                                                
                                                                            ?>
                                                                            <tr id="part_print_view">
                                                                                <td colspan="1"></td>
                                                                                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="text-transform: uppercase;"><?php echo $part_name; ?> <b>(<?php echo $PartNumber; ?>)</b></font></td>
                                                                                <?php if ($user_role=='1' || $user_role=='2'){ ?>
                                                                                    <td colspan="1" style="width: 200px;">
                                                                                        <button class="btn text-white bg-red plusminus" onclick="minusOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>','<?php echo $ItemStat;?>')"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                                                        <span id="qty-label-<?php echo $rowIndex;?>" style="padding-left: 15px; padding-right: 15px; ">

                                                                                                <?php echo $qty; ?>
                                                                                            
                                                                                            </span>
                                                                                        <button class="btn text-white bg-green plusminus" onclick="addOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>','<?php echo $ItemStat;?>')"> <i class="fa fa-plus" aria-hidden="true"></i> </button>


                                                                                        <br><a style="font-size: 10px; cursor: pointer;" id="part-qty-change-click" data-toggle="modal" data-target="#change_qty<?php echo $rowIndex; ?>">
                                                                                            Click here to type quantity
                                                                                        </a>
                                                                                    </td>
                                                                                <?php }else{ ?>
                                                                                    <td colspan="1" style="width: 200px;">
                                                                                        <span id="qty-label-<?php echo $rowIndex;?>" style="padding-left: 15px; padding-right: 15px; ">
                                                                                                <?php echo $qty; ?>
                                                                                        </span>
                                                                                    </td>
                                                                                <?php } ?>

                                                                                <td colspan="1"></td>
                                                                                <td colspan="1" style="width: 150px;">
                                                                                    <b><?php echo $Part_discount; ?>%</b>
                                                                                    <button class="btn btn-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_part_discount_<?php echo $rowIndex; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Change Parts Qty by Clicking -->
                                                                            <div class="modal fade" data-backdrop='static' data-keyboard='false' id="change_qty<?php echo $rowIndex; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Change <?php echo $part_name; ?> Quantity</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                    
                                                                                    <form id="Add-Part-Qty-By-Clicking" method="POST">
                                                                                            <input type="hidden" class="form-control" name="job_part_id" id="job_part_id" value="<?php echo $rowIndex; ?>" required>
                                                                                            <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $itemId; ?>" required>
                                                                                            <input type="hidden" class="form-control" name="now_item_qty" id="now_item_qty" value="<?php echo $qty; ?>" required>
                                                                                            <input type="hidden" class="form-control" name="price_batch_id" value="<?php echo $ItemStat; ?>" required>
                                                                                                <div class="panel-body">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="3">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                                            <input type="number" class="form-control" name="change_qty" min="1" id="change_qty" value="<?php echo $qty; ?>" step="any" placeholder="Quantity" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <center>
                                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Quantity</button>
                                                                                                </center>
                                                                                                
                                                                                            
                                                                                        </form>

                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>

                                                                            <!-- Add Part Discount -->
                                                                            <div class="modal fade" data-backdrop='static' data-keyboard='false' id="genarate_part_discount_<?php echo $rowIndex; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Add <?php echo $part_name; ?> Discount</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                    
                                                                                    <form id="Add-Part-Discount" method="POST">
                                                                                            <input type="hidden" class="form-control" name="job_part_id" id="job_part_id" value="<?php echo $rowIndex; ?>" required>
                                                                                                <!-- <div class="panel-heading clearfix">
                                                                                                    <h4 class="panel-title">Register Client Details</h4>
                                                                                                </div> -->
                                                                                                <div class="panel-body">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="3">Discount % <font style="color: #FF0000;">*</font></label>
                                                                                                            <input type="number" class="form-control" name="part_discount" min="0" max="100" id="part_discount" value="<?php echo $Part_discount; ?>" step="any" placeholder="Discount %" required>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <center>
                                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Discount</button>
                                                                                                </center>
                                                                                                
                                                                                            
                                                                                        </form>

                                                                                  </div>
                                                                                  <div class="modal-footer">
                                                                                    <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </div>


                                                                        <?php } ?>


                                                                    <?php } ?>



                                                                        

                                                                        

                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        //Sub Total
                                                        $sub_total = $total_job_fru_paybel + $total_part_price;

                                                        ?>

                                                        <div class="row price" id="price-view">
                                                            <div class="col-md-4">
                                                                
                                                                <p>
                                                                    <strong style="font-size: 13px;">Labour Total : Rs. <?php echo number_format($total_job_fru_paybel,2); ?></strong><br>
                                                                </p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                
                                                                <center><p>
                                                                    <strong style="font-size: 13px;">Parts Total : Rs. <?php echo number_format($total_part_price,2); ?></strong><br>
                                                                </p></center>
                                                            </div>

                                                            <div class="col-md-4">
                                                                
                                                                <p>
                                                                    <strong style="font-size: 13px; float: right;">Sub Total : Rs. <?php echo number_format($sub_total,2); ?></strong><br>
                                                                </p>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12" style="padding-left:0;">
                                                            <hr id="no_need_print">
                                                            <!--<p>
                                                                <strong>Service Advisor : <?php //echo $service_advisor; ?></strong><br>
                                                            </p>-->
                                                        </div>
                                                        
                                                        
                                                        <?php if ($user_role=='1'){ ?>
                                                            <button type="button" id="add-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>
                                                            <button type="button" id="add-upload-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-cloud-upload"></i> Upload Labour</button>
                                                        <?php }elseif ($user_role=='0') { ?>
                                                            <button type="button" id="add-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>
                                                            <button type="button" id="add-upload-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-cloud-upload"></i> Upload Labour</button>
                                                        <?php }elseif ($user_role=='2') { ?>
                                                        
                                                        <?php }else{} ?>
                                                        <br><br>
                                                        
                                                        <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                            <button id="invoice-button" class="btn text-white bg-azure" data-toggle="modal" data-target="#genarate_invoice"><i class="fa fa-plus-circle"></i> Add VAT</button>
                                                            <button id="note-button" class="btn text-white bg-purple" data-toggle="modal" data-target="#write_note"><i class="fa fa-plus-circle"></i> Add Note</button>
                                                            <button id="note-button" class="btn text-white bg-purple" data-toggle="modal" data-target="#advance_add"><i class="fa fa-plus-circle"></i> Add Advance</button>
                                                            <a href="invoice?i=<?php echo base64_encode($JobId); ?>" id="preview-invoice-button" class="btn btn-info" style="float: right;"><i class="fa fa-eye"></i> Preview Invoice</a>
                                                        <?php }else{} ?>
                                                        <?php if ($user_role=='1' || $user_role=='0' || $user_role=='2'){ ?>
                                                            <button id="sublet-button" class="btn text-white bg-teal" data-toggle="modal" data-target="#add_sublet"><i class="fa fa-plus-circle"></i> Add Sublet</button>
                                                        <?php }else{} ?>
                                                    <!--<div id="road-test-write-area">
                                                        <div class="form-group">
                                                            <label>Road test and other comments</label>
                                                            <textarea class="form-control" rows="6"></textarea>
                                                        </div> 
                                                    </div>-->
                                                    
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->
                                    <hr id="no_need_print">
                                    <div class="row" id="part-list-area">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading clearfix">
                                                    <h4 class="panel-title">Part List <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button></h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th colspan='1' style="font-size: 14px;">Parts</th>
                                                                    <th colspan='1' style="font-size: 14px;">Qty</th>
                                                                    <th colspan='1' style="font-size: 14px;">Received</th>
                                                                    <th colspan='2' style="font-size: 14px;">Remarks</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $sql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.job_id= '$JobId' ";
                                                                    $rsitem=$conn->query($sql);
                                                                        while($rowitem =$rsitem->fetch_array())
                                                                        {
                                                                            $qty = $rowitem[5];
                                                                            $job_part_remark = $rowitem[6];
                                                                            $part_name=$rowitem[12];
                                                                            $rowIndex = $rowitem[0];
                                                                                    
                                                                            $itemId = $rowitem[4];
                                                                            $labourId = $rowitem[3];
                                                                            $job_part_date = $rowitem[10];
                                                                                
                                                                ?>
                                                                <tr>
                                                                    <td colspan='1' style="font-size: 14px;"><?php echo $part_name; ?></td>
                                                                    <td colspan='1' style="font-size: 14px;"><?php echo $qty; ?></td>
                                                                    <td colspan='1' style="font-size: 14px;"><?php echo $job_part_date; ?></td>
                                                                    <td colspan='2' style="font-size: 14px;"><?php echo $job_part_remark; ?></td>
                                                                </tr>
                                                            <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <?php include_once('controls/part_empty_table.php'); ?>


                                    <!-- Start All Models-->



                                    <!-- Add part -->
                                                <div class="modal fade" id="part" role="dialog" data-backdrop='static' data-keyboard='false' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Parts</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <form id="Add-Part" method="POST">
                                                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" required>
                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="1">Select Labour <font style="color: #FF0000;">*</font></label>
                                                                                <select style="width: 100% !important;" class="js-example-basic-single-labour form-control" name="labour_id" required>
                                                                                    <option selected disabled>Select Labour</option>
                                                                                    <?php
                                                                                        $LabourNamesQuery=$conn->query("SELECT * FROM tbl_job_labour tjl WHERE job_id= '$JobId' ORDER BY job_labour_id ASC");
                                                                                        while ($row=$LabourNamesQuery->fetch_array()) {
                                                                                    ?>
                                                                                        <option value="<?php echo $row[0];?>"><?php echo $row[5];?></option>
                                                                                    <?php } ?>
                                                                                </select>

                                                                              </div>

                                                                            <div class="form-group">
                                                                                <label for="3">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                <input type="number" class="form-control" name="qty" min="1" max="5" id="qty" placeholder="Quantity" required>
                                                                            </div>
                                                                              
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="2">Select Part <font style="color: #FF0000;">*</font></label>
                                                                                <select style="width: 100% !important;" class="js-example-basic-single-part form-control" name="item_id" required>
                                                                                    <option value="" selected disabled>Select Part</option>
                                                                                    <?php

                                                                                        $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                                                        while ($row=$itemsQuery->fetch_array()) {
                                                                                    ?>
                                                                                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                                                    <?php } ?>
                                                                                </select>
                                                                              </div>

                                                                              <div class="form-group">
                                                                                <label for="4">Remark</label>
                                                                                <input type="text" class="form-control" name="remark" id="4" placeholder="Remark">
                                                                              </div>
                                                                             
                                                                        </div>



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Parts</button>
                                                                
                                                            </form>




                                                      </div>
                                                      <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>

                                                <!-- Add laber -->
                                                <div class="modal fade" id="laber" role="dialog" data-backdrop='static' data-keyboard='false' aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Labour</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <form id="Add-Labour" method="POST">
                                                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="1">Select Labour <font style="color: #FF0000;">*</font></label>
                                                                                <select style="width: 100% !important;" class="js-example-basic-single form-control" name="labour_name" id="labour_name" required>
                                                                                    <option selected disabled>Select Labour</option>
                                                                                    <?php

                                                                                        $clientNamesQuery=$conn->query("SELECT DISTINCT labour_id,labour_name,fru FROM tbl_labour");
                                                                                        while ($row=$clientNamesQuery->fetch_array()) {

                                                                                    ?>

                                                                                        <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                                                                 

                                                                                    <?php } ?>
                                                                                </select>

                                                                              </div>
                                                                              
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="fru">FRU <font style="color: #FF0000;">*</font></label>
                                                                                <input type="number" class="form-control" name="fru" min="0" id="fru" placeholder="FRU" step="any" required>
                                                                              </div>
                                                                             
                                                                        </div>



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Labour</button>
                                                                
                                                            </form>




                                                      </div>
                                                      <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>

                                            <!-- Add Genarate Invoice -->
                                                <div class="modal fade" id="genarate_invoice" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">VAT & Advance</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <form id="Genarate-Invoice" method="POST">
                                                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" required>
                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_advance WHERE job_id= '$JobId' and stat='1' ";
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

                                                                        <?php if ($advance_full_pay=='0') { }else{ ?>
                                                                        <div class="col-md-12">
 
                                                                            <div class="form-group">
                                                                                <label for="1">Advance (.Rs)</label>
                                                                                <input type="number" class="form-control" value="<?php echo $advance_full_pay; ?>" name="advance_pay" min="0" id="1" placeholder="Advance" required readonly>
                                                                            </div>
                                                                              
                                                                        </div>
                                                                        <?php } ?>
                                                                        
                                                                        <?php 
                                                                            $Taxsql = "SELECT * FROM tbl_tax WHERE job_id= '$JobId' ";
                                                                            $TaxQuery=$conn->query($Taxsql);
                                                                                if($tq =$TaxQuery->fetch_array())
                                                                                {
                                                                                    $tax_id = $tq[0];
                                                                                    $tax_vat=$tq[3];
                                                                                    $tax_additional_price = $tq[6];


                                                                                }
                                                                        ?>
                                                                       


                                                                        <div class="col-md-12">
 
                                                                            <div class="form-group">
                                                                                <label for="2">VAT %</label>
                                                                                <input type="number" class="form-control" value="<?php echo $tax_vat; ?>" name="vat" min="0" id="2" step="any" placeholder="VAT" required>
                                                                            </div>
                                                                              
                                                                        </div>

                                                                        <!-- <div class="col-md-6"> -->

                                                                              <!-- <div class="form-group"> -->
                                                                                <!-- <label for="3">DISCOUNT %</label> -->
                                                                                <input type="hidden" class="form-control" value="0" name="discount" min="0" id="3" placeholder="DISCOUNT" required readonly>
                                                                              <!-- </div> -->
                                                                             
                                                                       <!--  </div> -->

                                                                        <div class="col-md-12">

                                                                              <!-- <div class="form-group">
                                                                                <label for="5">Additional Price</label>
                                                                                
                                                                              </div> -->

                                                                              <input type="hidden" class="form-control" min="0" value="<?php echo $tax_additional_price; ?>" name="additional_price" id="5" placeholder="Additional Price">
                                                                             
                                                                        </div>



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add VAT</button>
                                                                
                                                            </form>




                                                      </div>
                                                      <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                
                                                
                                                <!-- Write Note to Invoice -->
                                                <div class="modal fade" id="write_note" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">Write Note</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <form id="Add-Note" method="POST">
                                                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" required>
                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">
                                                                        
                                                                        <?php 
                                                                            $InvoiceNotesql = "SELECT * FROM tbl_tax WHERE job_id= '$JobId' ";
                                                                            $InvoiceNoteQuery=$conn->query($InvoiceNotesql);
                                                                                if($inq =$InvoiceNoteQuery->fetch_array())
                                                                                {
                                                                                    $invoice_note = $inq[5];
                                                                                }
                                                                        ?>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="4">Note</label>
                                                                                <textarea class="form-control" id="4" rows="5" name="note" placeholder="Write Your Note..."><?php echo $invoice_note; ?></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Note</button>
                                                                
                                                            </form>
                                                      </div>
                                                      <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                <!-- Add Advance to Invoice -->
                                                <div class="modal fade" id="advance_add" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">Add Advance</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <div class="card-header">
                                                            <h3 class="card-title">Advance Request</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table m-b-0">
                                                                    <thead class="thead-dark">
                                                                        <tr>
                                                                            <th scope="col">Advance Number</th>
                                                                            <th scope="col">Advance (.Rs)</th>
                                                                            <th scope="col">Advance Date</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="advance-request-area">
                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_advance WHERE license_number= '$reg_licens_no' AND stat='0' ";
                                                                            $advanceQuert=$conn->query($sql);
                                                                            while($aq =$advanceQuert->fetch_array())
                                                                                {
                                                                                    $advance_id = $aq[0];
                                                                                    $advance_note = $aq[3];
                                                                                    $advance_pay=(double)$aq[4];
                                                                                    $advance_stat = $aq[5];
                                                                                    $advance_date = $aq[6];

                                                                                    $AdvanceYear = date('Y', strtotime($advance_date));
                                                                                
                                                                        ?>
                                                                        <tr>
                                                                            <td scope="row">BAE/AD/<?php echo $AdvanceYear; ?>/<?php echo (10000+$advance_id); ?></td>
                                                                            <td><?php echo number_format($advance_pay,2); ?></td>
                                                                            <td><?php echo $advance_date; ?></td>
                                                                            <td>
                                                                                <form id="Add-Advance" method="POST">
                                                                                    <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" readonly required>
                                                                                    <input type="hidden" class="form-control" name="advance_id" id="advance_id" value="<?php echo $advance_id; ?>" readonly required>
                                                                                    <input type="hidden" class="form-control" name="license_number" id="license_number" value="<?php echo $reg_licens_no; ?>" readonly required>
                                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light" id="add_job_btn">Add to job</button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <hr>
                                                        <div class="card-header">
                                                            <h3 class="card-title">Added Advance to this Job</h3>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table m-b-0">
                                                                    <thead class="thead-dark">
                                                                        <tr>
                                                                            <th scope="col">Advance Number</th>
                                                                            <th scope="col">Advance (.Rs)</th>
                                                                            <th scope="col">Advance Date</th>
                                                                            <th scope="col">Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody id="advance-added-area">
                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_advance WHERE license_number= '$reg_licens_no' AND job_id='$job_id' ";
                                                                            $AddadvanceQuert=$conn->query($sql);
                                                                            $advance_full_pay = 0;
                                                                            while($aq =$AddadvanceQuert->fetch_array())
                                                                                {
                                                                                    $ADDadvance_id = $aq[0];
                                                                                    $ADDadvance_note = $aq[3];
                                                                                    $ADDadvance_pay=(double)$aq[4];
                                                                                    $ADDadvance_stat = $aq[5];
                                                                                    $ADDadvance_date = $aq[6];

                                                                                    $ADDAdvanceYear = date('Y', strtotime($ADDadvance_date));
                                                                                    $advance_full_pay += $ADDadvance_pay;
                                                                                
                                                                        ?>
                                                                        <tr>
                                                                            <td scope="row">BAE/AD/<?php echo $ADDAdvanceYear; ?>/<?php echo (10000+$ADDadvance_id); ?></td>
                                                                            <td><?php echo number_format($ADDadvance_pay,2); ?></td>
                                                                            <td><?php echo $ADDadvance_date; ?></td>
                                                                            <td>
                                                                                <form id="Delete-Advance" method="POST">
                                                                                    <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" readonly required>
                                                                                    <input type="hidden" class="form-control" name="advance_id" id="advance_id" value="<?php echo $ADDadvance_id; ?>" readonly required>
                                                                                    <input type="hidden" class="form-control" name="license_number" id="license_number" value="<?php echo $reg_licens_no; ?>" readonly required>
                                                                                    <button type="submit" class="btn text-white bg-red" id="delete_advance_btn">X</button>
                                                                                </form>
                                                                            </td>
                                                                        </tr>
                                                                        <?php } ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                      </div>
                                                      <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>


                                                <!-- Upload Labour -->
                                                <div class="modal fade" id="upload-labour" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">Upload Labour From KSD</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <form id="Add-Labour-KSD" method="POST" enctype="multipart/form-data">
                                                                <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $job_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="4">Upload KSD Labour File</label>
                                                                                <input type="file" name="ksdfile">
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Upload File</button>
                                                                
                                                            </form>




                                                      </div>
                                                      <div class="modal-footer">
                                                        <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save changes</button> -->
                                                      </div>
                                                    </div>
                                                  </div>
                                                </div>


                                                <!-- Add part -->
                                                <div class="modal fade" id="add-part" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                    <div class="modal-dialog modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <!--<h5 class="modal-title" id="exampleModalLongTitle">Add Parts to <?php //echo $labour_name_1.' '.$labour_name_2; ?></h5>-->
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add Parts to Labour</h5>
                                                                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                          
                                                                <input type="hidden"   id="job_id" value="<?php echo $job_id; ?>" required>
                                                                <input type="hidden"  id="user_id" value="<?php echo $user_id; ?>" required>
                                                                <input type="hidden" id="dynamic_labour_id"/>
                                                                    <div class="panel-body">
                                                                        
                                                                        <div class="row">
                                                                            <div class="col-md-6">      
                                                                                <div class="row">

                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="2">Select Part <font style="color: #FF0000;">*</font></label>
                                                                                            <select style="width: 100% !important;" class="js-example-basic-single-part form-control" id="select-part" name="item_id" required onchange="onPartChanged()">
                                                                                                <option value="" selected disabled>Select Part</option>
                                                                                                <?php
                                                                                                    $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                                                                    while ($row=$itemsQuery->fetch_array()) {
                                                                                                ?>
                                                                                                    <option value="<?php echo $row[2];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                            <span style="font-size: 12px; color: #FF0000;">Available Stock : <label id="item_qty_available">0</label> in stock</span>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12" style="visibility: hidden;">
                                                                                        <div class="form-group">
                                                                                            <label for="2">Select Price Batch <font style="color: #FF0000;">*</font></label>
                                                                                            <select style="width: 100% !important;" class="form-control" id="price_batch_id" name="price_batch_id" required>
                                                                                                <option value="" selected disabled>Select Price Batch</option>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-12" style="margin-top: -80px;">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                            <input type="number" min="1" value="1" class="form-control" name="qty" id="part-qty" placeholder="Quantity" required>
                                                                                          </div>
                                                                                    </div>
                                                                                    
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Invoice Type <font style="color: #FF0000;">*</font></label>
                                                                                            <select id="part-type" class="form-control" name="part_type">
                                                                                                <option value="" selected disabled>Select Invoice Type</option>
                                                                                                <option value="1" selected>Normal</option>
                                                                                                <option value="2">Memo</option>
                                                                                            </select>
                                                                                            <!-- <input type="radio" id="part-type1" name="part_type" value="1">
                                                                                            <label style="margin-right: 20px;" for="part-type1"> </label>
                                                                                            <input type="radio" id="part-type" name="part_type" value="2">
                                                                                            <label for="part-type"> </label> -->
                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="col-md-11">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Remark</label>
                                                                                            <input type="text" class="form-control" name="remark" id="part-remark" placeholder="Remark">
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-md-1">
                                                                                        <div class="form-group">
                                                                                            <label for="4" style="color: #fff;">Add</label>
                                                                                            <button type="submit" id="btn-add-part-plus" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>                
                                                                                                 
                                                                            </div>

                                                                            <div class="col-md-6">
                                                                                <div class="panel-body">
                                                                                    <div class="table-responsive">
                                                                                        <table class="table table-bordered" id="myTable">
                                                                                            <thead>
                                                                                                <tr>
                                                                                                    <th>#</th>
                                                                                                    <th>Part Name</th>
                                                                                                    <th>Quantity</th>
                                                                                                    <!-- <th>Batch</th> -->
                                                                                                    <th>Remark</th>
                                                                                                    <th></th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                        <tbody id="part-area">
                                                                    
                                                                                                            
                                                                                        </tbody>
                                                                    
                                                                                        </table>
                                                                                                          
                                                                                    </div>
                                                                                </div>
                                                                            
                                                                            </div>
                                                                        
                                                                                        
                                                                        
                                                                        </div>
                                                                    </div>
                                                                             
                
                                                                </div>
                                                                    <div class="modal-footer">
                                                                        <button type="btn btn-success" onclick="submitPartsData()" class="btn btn-success">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>



                                    <!-- End All Models-->




                            </div>
                        </div>






                    </div>
                    
                </div>




           


            </div>
        </div>


        <!-- Add Sublet -->
        <div class="modal fade" id="add_sublet" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Sublet</h5>
                        <button type="button" class="close" onclick="SubletcloseModal()" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                           
                            <div class="panel-body">                                        
                                <div class="row">
                                    <div class="col-md-6">      
                                        <form class="row" method="POST" id="Add-Sublet">
                                            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>" required>
                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" required>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="4">Small Description <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" name="sublet_description" placeholder="Small Description" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="4">Selling Price <font style="color: #FF0000;">*</font></label>
                                                    <input type="number" min="0" value="0" class="form-control" name="sublet_price" step="any" placeholder="Selling Price" required>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="4">Cost Price <font style="color: #FF0000;">*</font></label>
                                                    <input type="number" min="0" value="0" class="form-control" name="sublet_cost_price" step="any" placeholder="Cost Price" required>
                                                </div>
                                            </div>
                                            <div class="col-md-11">
                                                <div class="form-group">
                                                    <label for="4">Remark</label>
                                                    <input type="text" class="form-control" name="remark" placeholder="Remark">
                                                </div>
                                            </div>
                                            <div class="col-md-1">
                                                <div class="form-group">
                                                    <label for="4" style="color: #fff;">Add</label>
                                                    <button type="submit" id="btn-add-sublet" class="btn btn-primary waves-effect waves-light btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                          
                                    <div class="col-md-6">
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <table class="table table-bordered" id="SubletTable">
                                                    <thead>
                                                        <tr>
                                                            <th>#</th>
                                                            <th>Description</th>
                                                            <th>Selling Price</th>
                                                            <th>Cost Price</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="sublet-area">
                                                        <?php
                                                            $SubletCount=0;
                                                            $getSubletSQL=$conn->query("SELECT * FROM tbl_job_sublet WHERE job_id='$job_id' ORDER BY sublet_id ASC");
                                                            while($gssRs = $getSubletSQL->fetch_array()){

                                                                $SubletId=$gssRs[0];
                                                                $SubletJobId=$gssRs[1];
                                                                $SubletDescription=$gssRs[2];
                                                                $SubletPrice=number_format($gssRs[3],2);
                                                                $SubletUserId=$gssRs[4];
                                                                $SubletDateTime=$gssRs[5];
                                                                $SubletCostPrice=$gssRs[6];

                                                                $SubletCount++;
                                                        ?>

                                                        <tr>
                                                            <th><?php echo $SubletCount; ?></th>
                                                            <th><?php echo $SubletDescription; ?></th>
                                                            <th><?php echo $SubletPrice; ?></th>
                                                            <th><?php echo $SubletCostPrice; ?></th>
                                                            <th>
                                                                <form method="POST" id="Delete-Sublet">
                                                                    <input type="hidden" name="sublet_id" value="<?php echo $SubletId; ?>" readonly>
                                                                    <input type="hidden" name="job_id" value="<?php echo $SubletJobId; ?>" readonly>
                                                                    <button type="submit" id="btn-delete-sublet" class="btn text-white bg-red"><i class="fa fa-times"></i></button>
                                                                </form>
                                                            </th>
                                                        </tr>

                                                        <?php } ?>

                                                    </tbody>            
                                                </table>
                                            </div>
                                        </div>                                   
                                    </div> 

                                </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="SubletcloseModal()" class="btn text-white bg-red" aria-label="Close">Close</button>
                    </div>
                </div>
            </div>
        </div>
        
        
        
        <!-- Update Client Details -->
        <div class="modal fade" id="update_client_details" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Client Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                                                                
                <form id="Update-Client-Details" method="POST">
                    <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $JobId; ?>" required readonly>
                    <input type="hidden" class="form-control" name="licens_no" id="licens_no" value="<?php echo $reg_licens_no; ?>" required readonly>
                        <!-- <div class="panel-heading clearfix">
                            <h4 class="panel-title">Register Client Details</h4>
                        </div> -->
                        
                        <?php 
                            $GetTaxDatasql = "SELECT * FROM tbl_tax WHERE job_id='$JobId'";
                            $TaxData=$conn->query($GetTaxDatasql);
                            if($TaxDataRs =$TaxData->fetch_array())
                            {   
                                $TaxClientId=$TaxDataRs[8];
                                    
                            }
                        ?>
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Client Name <font style="color: #FF0000;">*</font></label>
                                    <select style="width: 100% !important;" class="js-example-basic-single form-control" name="client_id" required>
                                        <option value="" selected disabled>Select License No.</option>
                                        <?php
                                            $getDataForClient=$conn->query("SELECT * FROM tbl_client");
                                            while ($row=$getDataForClient->fetch_array()) {
                                        ?>
                                            <?php if($TaxClientId==$row[0]){ ?>
                                            <option value="<?php echo $TaxClientId;?>" selected><?php echo $row[1];?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                            <?php } ?>
                                            
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    <center>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Client Details</button>
                    </center>                                                                  
                </form>

              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>
        
        
        
        <!-- Update Client Details -->
        <div class="modal fade" id="update_job_description" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Job Description</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                                                                
                <form id="Update-Job-Description" method="POST">
                    <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $JobId; ?>" required readonly>
                        
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Job Description <font style="color: #FF0000;">*</font></label>
                                    <textarea class="form-control" placeholder="Add Job Description..." name="job_description" rows="6"><?php echo $vehicleComment; ?></textarea>
                                </div>
                            </div>
                        </div>
                    <center>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Job Description</button>
                    </center>                                                                  
                </form>

              </div>
              <div class="modal-footer">
                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>
        
        
        
        <!-- Update Job Mileage -->
        <div class="modal fade" id="update_mileage" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Update Vehicle Mileage</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                                                                                
                <form id="Update-Job-Mileage" method="POST">
                    <input type="hidden" class="form-control" name="job_id" id="job_id" value="<?php echo $JobId; ?>" required readonly>
                        
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Vehicle Mileage <font style="color: #FF0000;">*</font></label>
                                    <input type="number" class="form-control" name="job_mileage" placeholder="Add Vehicle Mileage" value="<?php echo $reg_mileage; ?>" required>
                                </div>
                            </div>
                        </div>
                    <center>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">Update Mileage</button>
                    </center>                                                                  
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

        <!-------Event Start------------>
        <div class="alert alert-success solid alert-dismissible fade" role="alert" id="success_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-check"></i> <strong>Success!</strong> <span id="success_msg"></span>
        </div>
        <!--------Event End----------->
                            
        <!-------Waiting  Upload Event Start------------>
        <div class="alert alert-warning solid alert-dismissible fade" role="alert" id="progress_upload_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> <strong>Please Wait...</strong>
            <div class="progress" style="height:20px">
                <div class="progress-bar bg-success" style="width:0%;" id="upload-bar"><span id="upload-bar-label">0%</span></div>
            </div>
        </div>
        <!--------Waiting Upload  Event End----------->                   
                            
        <!-------Waiting Event Start------------>
        <div class="alert alert-warning solid alert-dismissible fade" role="alert" id="progress_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> <strong>Please Wait...</strong>
        </div>
        <!--------Waiting Event End----------->
                            
        <!-------Error Event Start------------>
        <div class="alert alert-danger solid alert-dismissible fade" role="alert" id="danger_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-times"></i> <strong>Error!</strong> <span>Something went wrong...</span>
        </div>
        <!--------Error Event End----------->

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<script src="assets/assets/bundles/selectize.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/vendors/selectize.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script>
    
    $(document).ready(function(){
        
        $("#labour_name").change(function(){
            
            
            
            $.ajax({
                url:'controls/get_fru_rate.php',
                type:'POST',
                data:{
                    labour_name:$("#labour_name").val()
                },
                success:function(data){
                        
                      var json = JSON.parse(data);
                      if(json.result){
                          $("#fru").val(json.data);
                      }
                        
                },error:function(err){
                    console.log(err);
                }
                
                
            });
            
            
        });
        
        
    });
    
</script>



<script>
    function onPartChanged(){
        var val=$("#select-part").val();
       

        $.ajax({
            url:'stock_post/get_price_batch.php',
            type:'POST',
            data:{
                part_no:val
            },
            success:function(data){
               
                var json = JSON.parse(data);
                if(json.result){

                    $("#price_batch_id").html(json.data);
                    $("#item_qty_available").html(json.FullQTYTotal);


                }




            },error:function(err){
                console.log(err);
            }



        //
    });


    }
</script>



<script>
        
                var tempList = [];
                var index = 0;
                
                
                function showModal(labourId){
                    
                    $("#dynamic_labour_id").val(labourId);
                    $('#add-part').modal('show');
                }
                
                function closeModal(){
                    
                    tempList = [];
                    index = 0;
                    addRowsToTmpTable();
                    
                    
                    $('#add-part').modal('hide');
                }
                
                
                
                function submitPartsData(){
                    
                  
                    
                    $.ajax({
                        url:'post/add_parts_labour_jobcard.php',
                        type:'POST',
                        data:{
                            list:JSON.stringify(tempList),
                            job_id:$("#job_id").val(),
                            user_id:$("#user_id").val(),
                            labour_id:$("#dynamic_labour_id").val(),
                            part_type:$("#part-type").val()
                        },
                        success:function(data){
                            
                            var json = JSON.parse(data);
                            
                            if(json.result){
                                
                                Swal.fire({
                                          title: 'Success',
                                          text: json.msg,
                                          icon: 'success',
                                          showCancelButton: false,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'OK',
                                          allowOutsideClick: false,
                                            allowEscapeKey: false
                                        }).then((result) => {
                                          location.reload();
                                        });
                                
                            }else{
                                Swal.fire({
                                          title: 'Warning',
                                          text: json.msg,
                                          icon: 'warning',
                                          showCancelButton: false,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'OK',
                                          allowOutsideClick: false,
                                            allowEscapeKey: false
                                        }).then((result) => {
                                          location.reload();
                                        });
                            }
                            
                            
                            
                        },
                        error:function(e){
                            alert("err "+e);
                        }
                        
                        
                        
                    });
                    
                }
        
        
        function addRowsToTmpTable(){
            
            $('#part-area').empty();
            
                    var markup = "";
                       for(var i = 0;i<tempList.length;i++){
                           var ov = tempList[i];
                            markup += "<tr><td>"+ov.id+"</td><td>"+ov.part+"</td><td>"+ov.qty+"</td><td>"+ov.remark+"</td><td><button class='btn btn-danger' onclick=removeTmpItem("+ov.id+")>X</button></td></tr>"
                       }
                       
                       $("#part-area").append(markup);
            
            
        }
        
        
        function removeTmpItem(value){
            
           var index = tempList.findIndex(function(o){
                 return o.id === value;
            })
            if (index !== -1) tempList.splice(index, 1);
            
                  addRowsToTmpTable();
            
      
            
        }
            
            $(document).ready(function(){
                
                
                
                    $("#btn-add-part-plus").click(function(){
                         
                         index+=1;
                        
                       
                       var selectedPart = $("#select-part").val();
                       var qty = $("#part-qty").val();
                       var batch = $("#price_batch_id").val();
                       var remark = $("#part-remark").val();
                       
                       if(selectedPart =="" || qty ==""){
                           
                           
                       }else{
                           
                            var dp = {id:index,part:selectedPart,qty:qty,batch:batch,remark:remark};
                       tempList.push(dp);
                       
                       addRowsToTmpTable();
                       
                       
                       
                        $("#select-part").val("");
                        $("#part-qty").val("");
                        $("#price_batch_id").val("");
                        $("#part-remark").val("");
                       }
                       
                       
                      
                      
                     
                        
                    });
                
                
                
                
                
                
                
                
                
                
                
                
                
                
             
                
            });
            
            
        </script>
        
        
        
        
        
        
        

        <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

        <script type="text/javascript">
       

            function addOnClick(row,row_index,item_id,labour_id,pb){
               
                var newQty = parseInt($("#"+row).html())+1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'post/add_qty_job_plus.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        labour_id:labour_id,
                        new_qty:newQty,
                        price_batch:pb,
                        operator:'+'
                      },

                      success:function(data){

                       var json = JSON.parse(data);
                       if(json.result){
                           
                       }else{
                           
                             var newQty = parseInt($("#"+row).html())-1;
                                $("#"+row).html(newQty);
                           
                           
                            Swal.fire({
                                icon:'warning',
                                text:json.msg,
                                title:'Warning !'
                            });
                       }
                       

                      },error:function(err){
                        console.log(err);
                      }



                });



            }


            function minusOnClick(row,row_index,item_id,labour_id,pb){

                if(parseInt($("#"+row).html()) > 0 ){

                    var newQty = parseInt($("#"+row).html())-1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'post/add_qty_job_minus.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        labour_id:labour_id,
                        new_qty:newQty,
                        price_batch:pb,
                        operator:'-'
                      },

                      success:function(data){


                        var json = JSON.parse(data);
                        if(json.result){
                            var restart_flag  = json.restart_flag;

                            if(restart_flag === 'ON'){

                                            Swal.fire({
                                          title: 'Success',
                                          text: "Record will be deleted",
                                          icon: 'success',
                                          showCancelButton: false,
                                          confirmButtonColor: '#3085d6',
                                          cancelButtonColor: '#d33',
                                          confirmButtonText: 'OK'
                                        }).then((result) => {
                                          location.reload();
                                        });
                                       
                                   }


                        }else{
                            Swal.fire({
                                icon:'warning',
                                text:json.msg,
                                title:'Warning !'
                            });
                        }



                      },error:function(err){
                        console.log(err);
                      }



                });


                }else{
                    alert('qty is 0');
                }
               
                


            }



            $(document).ready(function() {
                $('.js-example-basic-single').select2();
                $('.js-example-basic-single-labour').select2();
                $('.js-example-basic-single-part').select2();
            });
        </script>
        
        <!----------------------------Client Details Update-------------------------------------->
        
        <script>
            
            $(document).on('submit', '#Update-Client-Details', function(e){
            e.preventDefault(); //stop default form submission
            var formData = new FormData($(this)[0]);
    
            $.ajax({
                
                
                    beforeSend : function() {
                        // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});
    
    
                        Swal.fire({
                          title:'Info !',
                          icon:'info',
                          text:'Details is being sending...Please wait.',
                          showConfirmButton:false,
                          showCancelButton:false,
                          allowOutsideClick: false,
                        });
    
                    },
    
                    url:"post/update_jobcard_client_details.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
    
                    success: function (data) {
                        // swal("Thanks !","Successfully Added Your Details.","success");
    
                        var json = JSON.parse(data);
    
                        if(json.result){
                            Swal.fire({
                          title:'Thanks !',
                          icon:'success',
                          text:json.msg
                        });
                        }else{
                            Swal.fire({
                          title:'Warning !',
                          icon:'warning',
                          text:json.msg
                        });
                        }
    
    
                        setTimeout(function () {
                            //window.location.href = "all_clients.php";
                           location.reload();
                        },1500);
    
                    }
    
                });
    
            return false;
            });
        </script>
        
        
        
        <!----------------------------Job Description Update-------------------------------------->
        
        <script>
            
            $(document).on('submit', '#Update-Job-Description', function(e){
            e.preventDefault(); //stop default form submission
            var formData = new FormData($(this)[0]);
    
            $.ajax({
                
                
                    beforeSend : function() {
                        // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});
    
    
                        Swal.fire({
                          title:'Info !',
                          icon:'info',
                          text:'Details is being sending...Please wait.',
                          showConfirmButton:false,
                          showCancelButton:false,
                          allowOutsideClick: false,
                        });
    
                    },
    
                    url:"post/update_jobcard_job_description.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
    
                    success: function (data) {
                        // swal("Thanks !","Successfully Added Your Details.","success");
    
                        var json = JSON.parse(data);
    
                        if(json.result){
                            Swal.fire({
                          title:'Thanks !',
                          icon:'success',
                          text:json.msg
                        });
                        }else{
                            Swal.fire({
                          title:'Warning !',
                          icon:'warning',
                          text:json.msg
                        });
                        }
    
    
                        setTimeout(function () {
                            //window.location.href = "all_clients.php";
                           location.reload();
                        },1500);
    
                    }
    
                });
    
            return false;
            });
        </script>
        
        <!----------------------------Job Mileage Update-------------------------------------->
        
        <script>
            
            $(document).on('submit', '#Update-Job-Mileage', function(e){
            e.preventDefault(); //stop default form submission
            var formData = new FormData($(this)[0]);
    
            $.ajax({
                
                
                    beforeSend : function() {
                        // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});
    
    
                        Swal.fire({
                          title:'Info !',
                          icon:'info',
                          text:'Details is being sending...Please wait.',
                          showConfirmButton:false,
                          showCancelButton:false,
                          allowOutsideClick: false,
                        });
    
                    },
    
                    url:"post/update_jobcard_job_mileage.php",
                    type: 'POST',
                    data: formData,
                    //async: false,
                    cache: false,
                    contentType: false,
                    processData: false,
    
                    success: function (data) {
                        // swal("Thanks !","Successfully Added Your Details.","success");
    
                        var json = JSON.parse(data);
    
                        if(json.result){
                            Swal.fire({
                          title:'Thanks !',
                          icon:'success',
                          text:json.msg
                        });
                        }else{
                            Swal.fire({
                          title:'Warning !',
                          icon:'warning',
                          text:json.msg
                        });
                        }
    
    
                        setTimeout(function () {
                            //window.location.href = "all_clients.php";
                           location.reload();
                        },1500);
    
                    }
    
                });
    
            return false;
            });
        </script>


        <script>
        
        $(document).on('submit', '#Add-Labour', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});


                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Details is being sending...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },

                url:"post/add_labour_jobcard.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    // swal("Thanks !","Successfully Added Your Details.","success");


                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    


                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <!---------------------Add Part--------------------------------------------->

    <script>
        
        $(document).on('submit', '#Add-Part', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});


                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Details is being sending...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },

                url:"post/add_parts_jobcard.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    // swal("Thanks !","Successfully Added Your Details.","success");

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }



                    // Swal.fire({
                    //   title:'Thanks !',
                    //   icon:'success',
                    //   text:'Successfully Added.'
                    // });


                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    
    <!---------------------Add Part Labour--------------------------------------------->
    
    <script>
        
        $(document).on('submit', '#Add-Part-Labour', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-add-part-plus").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    // $("#progress_alert").addClass('show'); 

                },

                url:"post/add_parts_labour_jobcard.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    // $("#progress_alert").removeClass('show');
                    
                    var json=JSON.parse(data);
                    
                    if(json.result){

                       $("#part-area").html(json.data);
                       $("#success_msg").html(json.msg);
                    //   $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#btn-add-part-plus").attr("disabled",false);
                       document.getElementById('select-part').value = '';
                       document.getElementById('part-remark').value = '';

                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-add-part-plus").attr("disabled",false);
                     
                    }
                    
                }

            });

        return false;
        });
    </script>
    
    
    

    <!-----------------------Add Discount Labour -------------------->

    <script>
        
        $(document).on('submit', '#Add-Labour-Discount', function(e){
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

                url:"post/add_labour_discount.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <!-----------------------Add Part Discount -------------------->

    <script>
        
        $(document).on('submit', '#Add-Part-Discount', function(e){
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

                url:"post/add_part_discount.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <!-----------------------Add Part Qty By Clicking -------------------->

    <script>
        
        $(document).on('submit', '#Add-Part-Qty-By-Clicking', function(e){
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

                url:"post/add_part_qty_clicking.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <!-----------------------Add Labour From KSD-------------------->

    <script>
        
        $(document).on('submit', '#Add-Labour-KSD', function(e){
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

                url:"ksd_post/add_labour_jobcard.php",
                // url:"ksd_post/add_labour_jobcard_1.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    // alert(data);

                    var json = JSON.parse(data);

                    if(json.result){

                        // alert(json.des);

                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg

                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <!-----------------------------Genarate Invoice--------------------------------------->

    <script>
        
        $(document).on('submit', '#Genarate-Invoice', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});


                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Details is being sending...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },

                url:"post/add_tax.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");



                    Swal.fire({
                    //   title:'Thanks !',
                      icon:'success',
                      text:'Successfully Added.'
                    });


                    setTimeout(function () {
                        // window.open('invoice?i=<?php //echo base64_encode($JobId); ?>',
                        //               '_blank' // <- This is what makes it open in a new window.
                        //             );
                        // window.location.href = "old_invoice.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>
    
    
    <!-----------------------------Add Note--------------------------------------->

    <script>
        
        $(document).on('submit', '#Add-Note', function(e){
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

                url:"post/add_note.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    Swal.fire({
                      icon:'success',
                      text:'Successfully note Added.'
                    });


                    setTimeout(function () {
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>


    <script>
        
        $(document).on('submit', '#Delete-Labour', function(e){
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

                url:"post/delete_labour.php",
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
                      text:'Successfully Deleted.'
                    });


                    setTimeout(function () {
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>


    <!-----------------------------Add Sublet-------------------------------->

    <script>
        
        $(document).on('submit', '#Add-Sublet', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-add-sublet").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"post/add_sublet.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    $("#progress_alert").removeClass('show');
                    
                    var json=JSON.parse(data);
                    
                    if(json.result){

                       $("#sublet-area").html(json.data);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#btn-add-sublet").attr("disabled",false);
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-add-sublet").attr("disabled",false);
                     
                    }
                    
                }

            });

        return false;
        });
    </script>

    
    <!-----------------------------Add Advance to job-------------------------------->

    <script>
        
        $(document).on('submit', '#Add-Advance', function(e){
        e.preventDefault(); //stop default form submission

        $("#add_job_btn").attr("disabled",true);
        $("#delete_advance_btn").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"post/add_advance_to_job.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    $("#progress_alert").removeClass('show');
                    
                    var json=JSON.parse(data);
                    
                    if(json.result){

                       $("#advance-request-area").html(json.data);
                       $("#advance-added-area").html(json.dataAdded);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#add_job_btn").attr("disabled",false);
                       $("#delete_advance_btn").attr("disabled",false);
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#add_job_btn").attr("disabled",false);
                        $("#delete_advance_btn").attr("disabled",false);
                     
                    }
                    
                }

            });

        return false;
        });
    </script>
    
    
    
    <!-----------------------------Delete Advance to job-------------------------------->

    <script>
        
        $(document).on('submit', '#Delete-Advance', function(e){
        e.preventDefault(); //stop default form submission

        $("#add_job_btn").attr("disabled",true);
        $("#delete_advance_btn").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"post/remove_advance_to_job.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    $("#progress_alert").removeClass('show');
                    
                    var json=JSON.parse(data);
                    
                    if(json.result){

                       $("#advance-request-area").html(json.data);
                       $("#advance-added-area").html(json.dataAdded);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#add_job_btn").attr("disabled",false);
                       $("#delete_advance_btn").attr("disabled",false);
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#add_job_btn").attr("disabled",false);
                        $("#delete_advance_btn").attr("disabled",false);
                     
                    }
                    
                }

            });

        return false;
        });
    </script>


    <!-----------------------------Delete Sublet-------------------------------->

    <script>

        function SubletcloseModal(){
                    
            $('#add_sublet').modal('hide');
        }
        
        $(document).on('submit', '#Delete-Sublet', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-delete-sublet").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"post/delete_sublet.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    $("#progress_alert").removeClass('show');
                    
                    var json=JSON.parse(data);
                    
                    if(json.result){

                       $("#sublet-area").html(json.data);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#btn-delete-sublet").attr("disabled",false);
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-delete-sublet").attr("disabled",false);
                     
                    }
                    
                }

            });

        return false;
        });
    </script>
    
    <!-----------------------Add Part Discount -------------------->

    <script>
        
        $(document).on('submit', '#Update-Fru', function(e){
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

                url:"post/update_fru.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>
    
    <!-----------------------Add Part Discount -------------------->

    <script>
        
        $(document).on('submit', '#Close-Job', function(e){
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

                url:"post/delete_job.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                        window.location.href = "pending_jobs.php";
                    //   location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>
    

    

</body>
</html>
<?php } ?>