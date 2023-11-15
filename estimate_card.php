<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $EstimateId = base64_decode($_GET['e']);
    
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

        $sql = "SELECT * FROM tbl_estimate_vehicle_number tevn INNER JOIN tbl_vehicle tv ON tevn.license_no=tv.license_no INNER JOIN tbl_client tc ON tv.client_id=tc.client_id WHERE tevn.estimate_id= '$EstimateId'";
        //$sql = "SELECT * FROM tbl_vehicle_details WHERE v_id= '$JobId' ";
        $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $estimate_id = $row[0];
            $license_no=$row[1];
            $mileage=$row[2];
            $date=$row[3];

            $vehicle_modal=$row[8];
            $chassis_no=$row[9];

            $customer=$row[14];
            $email=$row[15]; 
            $phone_number=$row[18]; 
            
        }
    ?>
    
<?php
        $GetEstimateTaxsql = "SELECT * FROM tbl_estimate_tax tet INNER JOIN users_login ul ON tet.user_id=ul.user_id WHERE estimate_id= '$EstimateId'";
        $Ers=$conn->query($GetEstimateTaxsql);
        if($Erow =$Ers->fetch_array())
        {
            $estimateTaxId = $Erow[0];

            $AdvisorId=$Erow[2];
            $EstimateVat=$Erow[3];
            $EstimateDiscount=$Erow[4];
            $EstimateNote=$Erow[5];
            $EstimateAdditionalPrice=$Erow[6];
            $EstimateDateTime=$Erow[7]; 
            
            /////////////////////////
            $EstimateServiceAdvisorName=$Erow[9]; 
            
        }
?>
<?php 
    $FRUPaySql = "SELECT * FROM tbl_labour_paying ORDER BY labour_paying_id DESC LIMIT 1";
    $fruAmount=$conn->query($FRUPaySql);
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
                                /*transform: scale(.6);*/
                                /*margin-top: -320px;*/
                                width: 100%;
                                font-weight: 700;
                            }
                            #print-page{
                                margin-left: -320px;
                                background-color: #fff !important;
                                margin-top: 10px;
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
                            #add-labour-button{
                                display: none;
                            }
                            #add-part-button{
                                display: none;
                            }
                            #add-upload-labour-button{
                                display: none;
                            }
                            #write-labour-button{
                                display: none;
                            }
                            #invoice-button{
                                display: none;
                            }
                            #com-details{
                                margin-top: -100px;
                            }
                            #vehicle-details{
                                margin-top: -100px;
                            }
                            #part-list-area{
                                page-break-before: always;
                                margin-top: 20px;
                            }
                            .plusminus{
                                display: none;
                            }
                            #refresh-btn{
                                display: none;
                            }
                            #break-point{
                                display: block !important;
                            }
                            .partlistbtn{
                                display: none;
                            }
                            #esti-prevew-button{
                                display: none;
                            }
                          }
                          #break-point{
                            display: none;
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
                                        <h3 style="color: #000; text-align: center;">Estimate Card</h3>
                                    </div>
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding-left:0;">
                                                            <h3 class="m-b-md m-t-xxs"><b><?php echo $customer; ?></b></h3>
                                                            <!--<address>
                                                                E: <?php //echo $email; ?><br>
                                                                P: <?php //echo $phone_number; ?>
                                                            </address>-->
                                                        </div>
                                                        <div class="col-md-8 text-right" id="com-details" style="padding-right:0;">
                                                            <img src="assets/logo-black-transparent.png" style="width: 20%;"><br>
                                                            <address>
                                                                Bavarian Automobile Engineering (Pvt) Ltd<br>
                                                                No 3/8, Gunasekara Gardens, Nawala, Rajagiriya<br>
                                                                info@bae.lk<br>
                                                                www.bae.lk
                                                            </address>
                                                            <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div id="break-point">
                                                        <br>
                                                        <br><br>
                                                        <br><br>
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

                                                        <div class="col-md-12" id="vehicle-details">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Vehicle Number</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $license_no; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">VIN</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $chassis_no; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Date Time</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $date; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Milage</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $mileage; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Model</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $vehicle_modal; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Service Advisor</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $EstimateServiceAdvisorName; ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        
                                                        <div class="col-md-12">
                                                            
                                                            <p>
                                                                <b>Description :</b><br>
                                                                <?php echo nl2br($EstimateNote); ?>
                                                            </p>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <hr>

                                                            <button type="button" id="add-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>

                                                            <!--<button type="button" id="add-part-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#part"><i class="fa fa-plus-circle"></i> Add Part</button>-->

                                                            <button type="button" id="add-upload-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-cloud-upload"></i> Upload Labour</button>

                                                            <button type="button" id="write-labour-button" class="btn text-white bg-teal" data-toggle="modal" data-target="#write-labour"><i class="fa fa-cloud-upload"></i> Write Labour</button>
                                                            
                                                            <!--<button type="button" id="esti-prevew-button" class="btn text-white bg-cyan" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-eye"></i> Preview Estimate</button>-->

                                                            <br><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2" style="text-align: center;">Labour</th>
                                                                            <th colspan="1" style="text-align: center;">Qty</th>
                                                                            <th colspan="1" style="text-align: center;">FRU</th>
                                                                            <th colspan="1" style="text-align: center;">Discount</th>
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>

                                                                        <?php 
                                                                            $labour_name_1='';
                                                                            $labour_name_2='';
                                                                            $sql = "SELECT * FROM tbl_estimate_labour WHERE estimate_id= '$EstimateId' ORDER BY estimate_labour_id ASC";
                                                                            $rs=$conn->query($sql);
                                                                                while($row =$rs->fetch_array())
                                                                                {
                                                                                    $job_labour_id = $row[0];
                                                                                    $labour_id=$row[2];
                                                                                    $job_fru=$row[3];
                                                                                    $labour_name_1=$row[4];
                                                                                    $labour_name_2=$row[5];
                                                                                    $labour_datetime=$row[6];
                                                                                    
                                                                                    $LabourPrice=(double)$job_fru*(double)$fru_pay;
                                                                            ?>

                                                                        <tr>
                                                                            <td colspan="2">
                                                                                <b style="text-transform: uppercase;"><?php echo $labour_name_1.' '.$labour_name_2; ?>
                                                                                
                                                                                    <?php 
                                                                                        $cRs = $conn->query("SELECT count(*) FROM `tbl_estimate_item` WHERE `labour_id` ='$job_labour_id'");
                                                                                        if($r = $cRs->fetch_array()){
                                                                                            $count = $r[0];
                                                                                        }
                                                                                    ?>
                                                                                    <?php if($count > 0){ }else{ ?>
                                                                                       
                                                                                    <form id="Delete-Labour" method="POST">
                                                                                        <input type="hidden" class="form-control" name="job_labour_id" id="job_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                                        <button type="submit" class="btn btn-outline-danger btn-sm deletelabour pull-right" id="btn-delete"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                                                    </form>
                                                                                      
                                                                                    <?php } ?>
                                                                                
                                                                                
                                                                                </b>
                                                                                <button type="submit" class="btn btn-default btn-xs addpart pull-right partlistbtn" onclick="showModal('<?php echo $job_labour_id;?>')" style="margin-right: 5px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Parts</button>
                                                                            </td>
                                                                            <td colspan="1"></td>
                                                                            <td colspan="1"><b><?php echo round($job_fru,1); ?></b>
                                                                                <button class="btn btn-light plusminus" style="float: right;" id="fru-edit-button" class="btn btn-info" data-toggle="modal" data-target="#update_fru_<?php echo $job_labour_id; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>

                                                                                <br><a style="cursor: pointer;" id="fru-price-edit-button" data-toggle="modal" data-target="#update_fru_price_<?php echo $job_labour_id; ?>">Update Price</a>

                                                                            </td>
                                                                            <td colspan="1" style="width: 150px;">
                                                                                
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
                                                                                        <input type="hidden" class="form-control" name="estimate_labour_id" id="estimate_labour_id" value="<?php echo $job_labour_id; ?>" required>
                                                                                        <!-- <div class="panel-heading clearfix">
                                                                                            <h4 class="panel-title">Register Client Details</h4>
                                                                                        </div> -->
                                                                                        <div class="panel-body">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="3">FRU <font style="color: #FF0000;">*</font></label>
                                                                                                    <input type="number" class="form-control" name="job_fru" min="0" id="job_fru" value="<?php echo $job_fru; ?>" step="any" placeholder="FRU" required>
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

                                                                            

                                                                            <!-- Add FRU Price Update -->
                                                                            <div class="modal fade" id="update_fru_price_<?php echo $job_labour_id; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                  <div class="modal-header">
                                                                                    <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo $labour_name_1.' '.$labour_name_2; ?> Price</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                      <span aria-hidden="true">&times;</span>
                                                                                    </button>
                                                                                  </div>
                                                                                  <div class="modal-body">
                                                                                    
                                                                                    <form id="Update-Fru-Price" method="POST">
                                                                                        <input type="hidden" class="form-control" name="estimate_labour_id" id="estimate_labour_id" value="<?php echo $job_labour_id; ?>" readonly required>
                                                                                        <input type="hidden" class="form-control" name="fru_pay" value="<?php echo $fru_pay; ?>" readonly required>
                                                                                        <!-- <div class="panel-heading clearfix">
                                                                                            <h4 class="panel-title">Register Client Details</h4>
                                                                                        </div> -->
                                                                                        <div class="panel-body">
                                                                                            <div class="col-md-12">
                                                                                                <div class="form-group">
                                                                                                    <label for="3">Price <font style="color: #FF0000;">*</font></label>
                                                                                                    <input type="number" class="form-control" name="labour_price" min="0" value="<?php echo $LabourPrice; ?>" placeholder="Labour Price" required>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <center>
                                                                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update Price</button>
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
                                                                            $labourId = '';
                                                                            $sql = "SELECT * FROM tbl_estimate_item tei INNER JOIN tbl_item ti ON tei.item_id=ti.item_id WHERE tei.labour_id='$job_labour_id' AND tei.estimate_id= '$EstimateId' ";
                                                                            $rsitem=$conn->query($sql);
                                                                                while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $partId= $rowitem[0];
                                                                                    $qty = $rowitem[5];
                                                                                    ///////Part Discount == stat(DB)//////
                                                                                    $partDiscount = (double)$rowitem[7];
                                                                                    /////////////////////////////////////
                                                                                    $PartNumber = $rowitem[13];
                                                                                    $part_name=$rowitem[11];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                
                                                                            ?>

                                                                            <tr>
                                                                                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="text-transform: uppercase;"><?php echo $part_name; ?> <b>(<?php echo $PartNumber; ?>)</b></font></td>
                                                                                <td colspan="1" style="width: 200px;">
                                                                                    <button class="btn text-white bg-red plusminus" onclick="minusOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>')"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                                                    <span id="qty-label-<?php echo $rowIndex;?>" style="font-size: 20px; padding-left: 15px; padding-right: 15px; ">

                                                                                        <?php echo $qty; ?>
                                                                                            

                                                                                        </span>
                                                                                    <button class="btn text-white bg-green plusminus" onclick="addOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>')"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                                                                                </td>
                                                                                <td colspan="1"></td>
                                                                                <td colspan="1" style="width: 150px;">
                                                                                    <?php echo $partDiscount; ?>%
                                                                                    <button class="btn btn-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_part_discount_<?php echo $partId; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                            <!-- Add Part Discount -->
                                                                            <div class="modal fade" data-backdrop='static' data-keyboard='false' id="genarate_part_discount_<?php echo $partId; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                            <input type="hidden" class="form-control" name="estimate_part_id" id="estimate_part_id" value="<?php echo $partId; ?>" required>
                                                                                                <!-- <div class="panel-heading clearfix">
                                                                                                    <h4 class="panel-title">Register Client Details</h4>
                                                                                                </div> -->
                                                                                                <div class="panel-body">
                                                                                                    <div class="col-md-12">
                                                                                                        <div class="form-group">
                                                                                                            <label for="3">Discount % <font style="color: #FF0000;">*</font></label>
                                                                                                            <input type="number" class="form-control" name="estimate_part_discount" min="0" max="100" id="estimate_part_discount" value="<?php echo $partDiscount; ?>" placeholder="Discount %" required>
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



                                                        <div class="col-md-12" style="padding-left:0;">
                                                            <hr>
                                                            <!--<p>-->
                                                            <!--    <strong>Service Advisor : <?php //echo $EstimateServiceAdvisorName; ?></strong><br>-->
                                                            <!--</p>-->
                                                        </div>
                                                        
                                                    <button class="btn text-white bg-azure" id="invoice-button" data-toggle="modal" data-target="#add_vat"><i class="fa fa-plus-circle"></i> Add VAT</button>
                                                    <button id="note-button" class="btn text-white bg-purple" data-toggle="modal" data-target="#write_note"><i class="fa fa-plus-circle"></i> Add Note</button>
                                                    <button id="sublet-button" class="btn text-white bg-teal" data-toggle="modal" data-target="#add_sublet"><i class="fa fa-plus-circle"></i> Add Sublet</button>
                                                    <a href="estimate_invoice.php?e=<?php echo base64_encode($EstimateId); ?>" id="preview-invoice-button" class="btn btn-info" style="float: right;"><i class="fa fa-eye"></i> Preview Estimate</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->
                   
                       

                        
                                    <!--Start All Models -->

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
                                                                <input type="hidden" class="form-control" name="estimate_id" id="estimate_id" value="<?php echo $EstimateId; ?>" required>
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
                                                                                        $clientNamesQuery=$conn->query("SELECT * FROM tbl_estimate_labour WHERE estimate_id='$EstimateId' ORDER BY estimate_labour_id ASC");
                                                                                        while ($row=$clientNamesQuery->fetch_array()) {
                                                                                    ?>
                                                                                        <option value="<?php echo $row[0];?>"><?php echo $row[4];?></option>
                                                                                    <?php } ?>
                                                                                </select>

                                                                              </div>

                                                                            <div class="form-group">
                                                                                <label for="3">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                <input type="number" class="form-control" name="qty" min="1" id="qty" step="any" placeholder="Quantity" required>
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
                                                                <input type="hidden" class="form-control" name="estimate_id" id="estimate_id" value="<?php echo $EstimateId; ?>" required>
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

                                                                                    <?php if ($labour_id==$row[0]) { }else{ ?>
                                                                                        <option value="<?php echo $row[1];?>"><?php echo $row[1];?></option>
                                                                                    <?php } ?>

                                                                                    <?php } ?>
                                                                                </select>

                                                                              </div>
                                                                              
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="fru">FRU <font style="color: #FF0000;">*</font></label>
                                                                                <input type="number" class="form-control" step="any" name="fru" min="0" id="fru" placeholder="FRU" required>
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
                                                <div class="modal fade" id="add_vat" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">Add VAT</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <form id="Add-Vat" method="POST">
                                                                <input type="hidden" class="form-control" name="estimate_id" id="estimate_id" value="<?php echo $EstimateId; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
 
                                                                            <div class="form-group">
                                                                                <label for="2">VAT %</label>
                                                                                <input type="number" class="form-control" value="<?php echo $EstimateVat; ?>" name="vat" min="0" id="2" placeholder="VAT" required>
                                                                            </div>
                                                                              
                                                                        </div>

                                                                        <!--<div class="col-md-12">-->

                                                                        <!--      <div class="form-group">-->
                                                                        <!--        <label for="3" style="display: none;">DISCOUNT %</label>-->
                                                                        <!--        <input type="hidden" class="form-control" value="0" name="discount" min="0" id="3" placeholder="DISCOUNT">-->
                                                                        <!--      </div>-->
                                                                             
                                                                        <!--</div>-->

                                                                        <!--<div class="col-md-12">-->

                                                                        <!--      <div class="form-group">-->
                                                                        <!--        <label for="4">Note</label>-->
                                                                        <!--        <textarea class="form-control" id="4" rows="5" name="note" placeholder="Write Your Note..."><?php //echo $tax_note; ?></textarea>-->
                                                                        <!--      </div>-->

                                                                        <!--      <div class="form-group">-->
                                                                        <!--        <label for="5">Additional Price</label>-->
                                                                        <!--        <input type="number" class="form-control" min="0" value="<?php //echo $tax_additional_price; ?>" name="additional_price" id="5" placeholder="Additional Price" required>-->
                                                                        <!--      </div>-->
                                                                             
                                                                        <!--</div>-->



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add Vat</button>
                                                                
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
                                                                <input type="hidden" class="form-control" name="estimate_id" id="estimate_id" value="<?php echo $EstimateId; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="4">Note</label>
                                                                                <textarea class="form-control" id="4" rows="5" name="note" placeholder="Write Your Note..."><?php echo $EstimateNote; ?></textarea>
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
                                                                                    <input type="hidden" name="estimate_id" value="<?php echo $EstimateId; ?>" required>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Small Description <font style="color: #FF0000;">*</font></label>
                                                                                            <input type="text" class="form-control" name="sublet_description" placeholder="Small Description" required>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-11">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Price <font style="color: #FF0000;">*</font></label>
                                                                                            <input type="number" min="0" value="0" class="form-control" name="sublet_price" placeholder="Price" required>
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
                                                                                                    <th>Price</th>
                                                                                                    <th></th>
                                                                                                </tr>
                                                                                            </thead>
                                                                                            <tbody id="sublet-area">
                                                                                                <?php
                                                                                                    $SubletCount=0;
                                                                                                    $getSubletSQL=$conn->query("SELECT * FROM tbl_estimate_sublet WHERE estimate_id='$EstimateId' ORDER BY sublet_id ASC");
                                                                                                    while($gssRs = $getSubletSQL->fetch_array()){
                                        
                                                                                                        $SubletId=$gssRs[0];
                                                                                                        $SubletEstimateId=$gssRs[1];
                                                                                                        $SubletDescription=$gssRs[2];
                                                                                                        $SubletPrice=number_format($gssRs[3],2);
                                                                                                        $SubletDateTime=$gssRs[4];
                                        
                                                                                                        $SubletCount++;
                                                                                                ?>
                                        
                                                                                                <tr>
                                                                                                    <th><?php echo $SubletCount; ?></th>
                                                                                                    <th><?php echo $SubletDescription; ?></th>
                                                                                                    <th><?php echo $SubletPrice; ?></th>
                                                                                                    <th>
                                                                                                        <form method="POST" id="Delete-Sublet">
                                                                                                            <input type="hidden" name="sublet_id" value="<?php echo $SubletId; ?>" readonly>
                                                                                                            <input type="hidden" name="estimate_id" value="<?php echo $SubletEstimateId; ?>" readonly>
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


                                                <!-- Upload Labour -->
                                                <div class="modal fade" id="upload-labour" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                <input type="hidden" class="form-control" name="estimate_id" id="estimate_id" value="<?php echo $EstimateId; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="4">Upload KSD Labour File</label>
                                                                                <input type="file" name="ksdfile" required>
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

                                                

                                                <!-- Write Labour -->
                                                <div class="modal fade" id="write-labour" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h3 class="modal-title" id="exampleModalLongTitle">Write Labour</h3>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        
                                                        <form id="Write-Labour" method="POST">
                                                                <input type="hidden" class="form-control" name="estimate_id" value="<?php echo $EstimateId; ?>" readonly required>
                                                                <input type="hidden" class="form-control" name="fru_pay" value="<?php echo $fru_pay; ?>" readonly required>
                                                                    
                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Write Labour <font style="color: #FF0000;">*</font></label>
                                                                            <input type="text" class="form-control" name="labour_name" placeholder="Write Labour" required>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <div class="form-group">
                                                                            <label>Price <font style="color: #FF0000;">*</font></label>
                                                                            <input type="number" class="form-control" step="any"min="0" name="price" id="estimate-price" placeholder="Price" required>
                                                                        </div>
                                                                    </div>
                                                                   
                                                                <button type="submit" class="btn btn-primary waves-effect waves-light">Write Labour</button>
                                                                
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
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Add Parts to <?php echo $labour_name_1.' '.$labour_name_2; ?></h5>
                                                                        <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                      </div>
                                                                      <div class="modal-body">
                                                                          
                                                                          <input type="hidden" class="form-control" name="estimate_id" id="estimate_id" value="<?php echo $EstimateId; ?>" required>
                                                                            <input type="hidden"  id="user_id" value="<?php echo $user_id; ?>" required>
                                                                          <input type="hidden" id="dynamic_labour_id"/>
                                                                        
                                                                        <!--<form id="Add-Part-Labour" method="POST">-->
                                                                                
                                                                                    <!-- <div class="panel-heading clearfix">
                                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                                    </div> -->
                                                                                    <div class="panel-body">
                                                                                        
                                                                                        <div class="row">
                                                                                            
                                                                                        

                                                                                        <div class="col-md-6">
                                                                                            
                                                                                            
                                                                                            <div class="row">
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="2">Select Part <font style="color: #FF0000;">*</font></label>
                                                                                                        <select style="width: 100% !important;" class="js-example-basic-single-part form-control" id="select-part" name="item_id" onchange="PartQTYChanged(this.value)" required>
                                                                                                        <!--<select style="width: 100% !important;" class="js-example-basic-single-part form-control" id="select-part" name="item_id" required>-->
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
                                                                                                <div class="col-md-12">
                                                                                                    <div class="form-group">
                                                                                                        <label for="4">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                                        <input type="text" class="form-control" name="qty" id="part-qty" placeholder="Quantity" required>
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
                                                                                    
                                                                                
                                                                            <!--</form>-->
                
                
                
                
                                                                      </div>
                                                                      <div class="modal-footer">
                                                                            <button type="btn btn-success" onclick="submitPartsData()" class="btn btn-success">Save changes</button>
                                                                      </div>
                                                                    </div>
                                                                  </div>
                                                                </div>
                                  

                                    <!--End All Models -->


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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>



    <script>
        function PartQTYChanged(Partnumber){
           
        $.ajax({
            url:'estimate/get_available_qty.php',
            type:'POST',
            data:{
                Partnumber:Partnumber
            },
                success:function(data){
                 
                var json=JSON.parse(data);
                if(json.result){
                    
                    $("#item_qty_available").html(json.FullQTYTotal);
                    //var FullQTYTotal = document.getElementById('item_qty_available');
                
                }
                 
            },
                error:function(data,err,xhr){
                console.log(data+" "+err)
                }
              
        });
        
    }
    </script>



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


    <script type="text/javascript">
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
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
                        url:'estimate/add_parts_labour_jobcard.php',
                        type:'POST',
                        data:{
                            list:JSON.stringify(tempList),
                            estimate_id:$("#estimate_id").val(),
                            user_id:$("#user_id").val(),
                            labour_id:$("#dynamic_labour_id").val()
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
                       var remark = $("#part-remark").val();
                       
                       if(selectedPart =="" || qty ==""){
                           
                           
                       }else{
                           
                            var dp = {id:index,part:selectedPart,qty:qty,remark:remark};
                       tempList.push(dp);
                       
                       addRowsToTmpTable();
                       
                       
                       
                        $("#select-part").val("");
                        $("#part-qty").val("");
                        $("#part-remark").val("");
                       }
                       
                       
                      
                      
                     
                        
                    });
  
                
             
                
            });
            
            
        </script>

        <script type="text/javascript">
       

            function addOnClick(row,row_index,item_id,labour_id){
               
                var newQty = parseInt($("#"+row).html())+1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'estimate/add_qty_estimate.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        labour_id:labour_id,
                        new_qty:newQty,
                        operator:'+'
                      },

                      success:function(data){

                       

                      },error:function(err){
                        console.log(err);
                      }



                });



            }


            function minusOnClick(row,row_index,item_id,labour_id){

                if(parseInt($("#"+row).html()) > 0 ){

                    var newQty = parseInt($("#"+row).html())-1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'estimate/add_qty_estimate.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        labour_id:labour_id,
                        new_qty:newQty,
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

                url:"estimate/add_labour_estimatecard.php",
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
                      text:'Successfully Added.'
                    });


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

                url:"ksd_post/add_labour_estimatecard_ksd.php",
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

                url:"estimate/add_parts_estimatecard.php",
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
                      text:'Successfully Added.'
                    });


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

                url:"estimate/add_part_discount.php",
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


    <script>
        
        $(document).on('submit', '#Add-Vat', function(e){
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

                url:"estimate/add_tax.php",
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
                      text:'Successfully Added.'
                    });


                    setTimeout(function () {
                        // window.location.href = "estimate_invoice?e=<?php //echo base64_encode($EstimateId); ?>";
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

                url:"estimate/add_note.php",
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

                url:"estimate/add_sublet.php",
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

                url:"estimate/delete_sublet.php",
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

                url:"estimate/delete_estimate_labour.php",
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

                url:"estimate/update_fru.php",
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



    <script>
        
        $(document).on('submit', '#Write-Labour', function(e){
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

                url:"estimate/write_labour.php",
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


    
    <script>
        
        $(document).on('submit', '#Update-Fru-Price', function(e){
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

                url:"estimate/update_labour_price.php",
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

</body>
</html>