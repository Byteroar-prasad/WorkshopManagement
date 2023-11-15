<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
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

    $sql = "SELECT * FROM tbl_vehicle_details WHERE v_id= '$JobId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $job_id = $row[0];
            $email=$row[1];
            $reg_date=$row[2];
            $customer=$row[3];
            $phone_number=$row[4];
            $reg_madel=$row[8];
            $reg_chassis_no=$row[9];
            $reg_licens_no=$row[10]; 
            $reg_mileage=$row[11]; 
            $service_advisor=$row[80]; 
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
                                margin-top: 10px;
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
                            #add-part-button{
                                display: none;
                            }
                            #add-upload-labour-button{
                                display: none;
                            }
                            #invoice-button{
                                display: none;
                            }
                            #com-details{
                                margin-top: -100px;
                            }
                            #vehicle-details{
                                margin-top: -50px;
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
                            
                            
                          }
                        .deletelabour{
                            border-color: #e00000;
                            color: #e0000a;
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
                                        <h3 style="color: #000; text-align: center;">Job Card</h3>
                                    </div>
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-md-4" style="padding-left:0;">
                                                            <h3 class="m-b-md m-t-xxs"><b><?php echo $customer; ?></b></h3>
                                                            <address>
                                                                E: <?php echo $email; ?><br>
                                                                P: <?php echo $phone_number; ?>
                                                            </address>
                                                        </div>
                                                        <div class="col-md-8 text-right" id="com-details" style="padding-right:0;">
                                                            <img src="assets/logo-black.png" id="logo-img" style="width: 20%;"><br>
                                                            <address>
                                                                <h3>Bavarian Automobile Engineering (Pvt) Ltd</h3><br>
                                                                No 3/8, Gunasekara Gardens, Nawala, Rajagiriya<br>
                                                                info@bae.lk<br>
                                                                www.bae.lk
                                                            </address>
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
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Vehicle Number</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $reg_licens_no; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">VIN</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $reg_chassis_no; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">In Date Time</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $reg_date; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Milage</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $reg_mileage; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Model</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"><?php echo $reg_madel; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Out Date Time</th>
                                                                            <th class="colorchange result" style="font-weight: 600;"></th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <hr>

                                                            <button type="button" id="add-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#laber"><i class="fa fa-plus-circle"></i> Add Labour</button>

                                                            <button type="button" id="add-part-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#part"><i class="fa fa-plus-circle"></i> Add Part</button>

                                                            <button type="button" id="add-upload-labour-button" class="btn text-white bg-indigo" data-toggle="modal" data-target="#upload-labour"><i class="fa fa-cloud-upload"></i> Upload Labour</button>

                                                            <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>

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
                                                                            $sql = "SELECT * FROM tbl_job_labour WHERE job_id= '$JobId' ORDER BY job_labour_id ASC";
                                                                            $rs=$conn->query($sql);
                                                                            
                                                                                while($row =$rs->fetch_array())
                                                                                {
                                                                                    $job_labour_id = $row[0];
                                                                                    $labour_id=$row[2];
                                                                                    $job_fru=$row[3];
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
                                                                            <td colspan="2">
                                                                                <b><?php echo $labour_name_1.' '.$labour_name_2; ?></b>
                                                                                <?php 
                                                                                    $cRs = $conn->query("SELECT count(*) FROM `tbl_job_item` WHERE `labour_id` ='$job_labour_id'");
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
                                                                                <button type="submit" class="btn btn-outline-primary btn-sm addpart pull-right partlistbtn" onclick="showModal('<?php echo $job_labour_id;?>')" style="margin-right: 5px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Parts</button>
                                                                            
                                                                            </td>
                                                                            <td colspan="1"></td>
                                                                            <td colspan="1"><b><?php echo $job_fru; ?></b></td>
                                                                            <td colspan="1" style="width: 150px;">
                                                                                <b><?php echo $labour_discount; ?>%</b>
                                                                                <button class="btn btn-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_labour_discount_<?php echo $job_labour_id; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                                                            </td>
                                                                        </tr>

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
                                                                                                        <input type="number" class="form-control" name="labour_discount" min="0" max="100" id="labour_discount" value="<?php echo $labour_discount; ?>" placeholder="Discount %" required>
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
                                                                            $sql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.labour_id='$job_labour_id' AND tji.job_id= '$JobId' ";
                                                                            $rsitem=$conn->query($sql);
                                                                            
                                                                                while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[11];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                    $Part_discount = $rowitem[7];

                                                                                    /////////////Item Count/////////////////
                                                                                    $Item_price = $rowitem[15];
                                                                                    // $Item_discount = $rowitem[16];

                                                                                    $Item_price_with_qty = $Item_price * $qty;
                                                                                    $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                                    $total_part_price += $totalPriceWithDisc;
                                                                                    //////////////////////////////
                                                                                
                                                                                
                                                                            ?>
                                                                            <tr>
                                                                                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                                <td colspan="1" style="width: 200px;">
                                                                                    <button class="btn text-white bg-red plusminus" onclick="minusOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>')"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                                                    <span id="qty-label-<?php echo $rowIndex;?>" style="font-size: 20px; padding-left: 15px; padding-right: 15px; ">

                                                                                        <?php echo $qty; ?>
                                                                                            

                                                                                        </span>
                                                                                    <button class="btn text-white bg-green plusminus" onclick="addOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $labourId;?>')"> <i class="fa fa-plus" aria-hidden="true"></i> </button>
                                                                                </td>
                                                                                <td colspan="1"></td>
                                                                                <td colspan="1" style="width: 150px;">
                                                                                    <b><?php echo $Part_discount; ?>%</b>
                                                                                    <button class="btn btn-light plusminus" style="float: right;" id="discount-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_part_discount_<?php echo $rowIndex; ?>"> <i class="fa fa-pencil-square-o" aria-hidden="true"></i> </button>
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Add Part Discount -->
                                                                            <div class="modal fade" id="genarate_part_discount_<?php echo $rowIndex; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                                            <input type="number" class="form-control" name="part_discount" min="0" max="100" id="part_discount" value="<?php echo $Part_discount; ?>" placeholder="Discount %" required>
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
                                                                    <strong style="font-size: 17px;">Labour Total : Rs. <?php echo number_format($total_job_fru_paybel,2); ?></strong><br>
                                                                </p>
                                                            </div>

                                                            <div class="col-md-4">
                                                                
                                                                <center><p>
                                                                    <strong style="font-size: 17px;">Parts Total : Rs. <?php echo number_format($total_part_price,2); ?></strong><br>
                                                                </p></center>
                                                            </div>

                                                            <div class="col-md-4">
                                                                
                                                                <p>
                                                                    <strong style="font-size: 17px; float: right;">Sub Total : Rs. <?php echo number_format($sub_total,2); ?></strong><br>
                                                                </p>
                                                            </div>
                                                        </div>


                                                        <div class="col-md-12" style="padding-left:0;">
                                                            <hr>
                                                            <p>
                                                                <strong>Service Advisor : <?php echo $service_advisor; ?></strong><br>
                                                            </p>
                                                        </div>
                                                        
                                                    <button id="invoice-button" class="btn btn-info" data-toggle="modal" data-target="#genarate_invoice">Genarate invoice</button>
                                                    
                                                    <div id="road-test-write-area">
                                                        <div class="form-group">
                                                            <label>Road test and other comments</label>
                                                            <textarea class="form-control" rows="6"></textarea>
                                                        </div> 
                                                    </div>
                                                    
                                                    
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->

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
                                                                    <th colspan='1'>Parts</th>
                                                                    <th colspan='1'>Qty</th>
                                                                    <th colspan='1'>Received</th>
                                                                    <th colspan='2'>Remarks</th>
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
                                                                            $part_name=$rowitem[11];
                                                                            $rowIndex = $rowitem[0];
                                                                                    
                                                                            $itemId = $rowitem[4];
                                                                            $labourId = $rowitem[3];
                                                                            $job_part_date = $rowitem[9];
                                                                                
                                                                ?>
                                                                <tr>
                                                                    <td colspan='1'><?php echo $part_name; ?></td>
                                                                    <td colspan='1'><?php echo $qty; ?></td>
                                                                    <td colspan='1'><?php echo $job_part_date; ?></td>
                                                                    <td colspan='2'><?php echo $job_part_remark; ?></td>
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
                                                                                <select style="width: 100% !important;" class="js-example-basic-single form-control" name="labour_name" required>
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
                                                                                <input type="number" class="form-control" name="fru" min="1" id="fru" placeholder="FRU" required>
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
                                                        <h3 class="modal-title" id="exampleModalLongTitle">Create Invoice</h3>
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
                                                                            $sql = "SELECT * FROM tbl_advance WHERE job_id= '$JobId' ";
                                                                            $advanceQuert=$conn->query($sql);
                                                                            $advance_full_pay = 0;
                                                                                while($aq =$advanceQuert->fetch_array())
                                                                                {
                                                                                    $advance_id = $aq[0];
                                                                                    $advance_note = $aq[2];
                                                                                    $advance_pay=$aq[3];
                                                                                    $advance_stat = $aq[4];
                                                                                    $advance_date = $aq[5];


                                                                                    $advance_full_pay += $advance_pay;
                                                                                }
                                                                        ?>

                                                                        <?php if ($advance_full_pay=='0') { }else{ ?>
                                                                        <div class="col-md-12">
 
                                                                            <div class="form-group">
                                                                                <label for="1">Advance</label>
                                                                                <input type="number" class="form-control" value="<?php echo $advance_full_pay; ?>" name="advance_pay" min="0" id="1" placeholder="Advance" required readonly>
                                                                            </div>
                                                                              
                                                                        </div>
                                                                        <?php } ?>
                                                                       


                                                                        <div class="col-md-12">
 
                                                                            <div class="form-group">
                                                                                <label for="2">VAT %</label>
                                                                                <input type="number" class="form-control" value="0" name="vat" min="0" id="2" placeholder="VAT" required>
                                                                            </div>
                                                                              
                                                                        </div>

                                                                        <!-- <div class="col-md-6"> -->

                                                                              <!-- <div class="form-group"> -->
                                                                                <!-- <label for="3">DISCOUNT %</label> -->
                                                                                <input type="hidden" class="form-control" value="0" name="discount" min="0" id="3" placeholder="DISCOUNT" required readonly>
                                                                              <!-- </div> -->
                                                                             
                                                                       <!--  </div> -->

                                                                        <div class="col-md-12">

                                                                              <div class="form-group">
                                                                                <label for="4">Note</label>
                                                                                <textarea class="form-control" id="4" rows="5" name="note" placeholder="Write Your Note..."></textarea>
                                                                              </div>

                                                                              <div class="form-group">
                                                                                <label for="5">Additional Price</label>
                                                                                <input type="number" class="form-control" min="0" value="0" name="additional_price" id="5" placeholder="Additional Price">
                                                                              </div>
                                                                             
                                                                        </div>



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Create Invoice</button>
                                                                
                                                            </form>




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
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add Parts to <?php echo $labour_name_1.' '.$labour_name_2; ?></h5>
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
                                                                                            <select style="width: 100% !important;" class="js-example-basic-single-part form-control" id="select-part" name="item_id" required>
                                                                                                <option value="" selected disabled>Select Part</option>
                                                                                                <?php
                                                                                                    $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                                                                    while ($row=$itemsQuery->fetch_array()) {
                                                                                                ?>
                                                                                                    <option value="<?php echo $row[2];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                                                                <?php } ?>
                                                                                            </select>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-12">
                                                                                        <div class="form-group">
                                                                                            <label for="4">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                            <input type="number" min="1" value="1" class="form-control" name="qty" id="part-qty" placeholder="Quantity" required>
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
                       
                       if(selectedPart =="" || qty =="" || remark==""){
                           
                           
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
            $(function () {
              $('[data-toggle="tooltip"]').tooltip()
            })
        </script>

        <script type="text/javascript">
       

            function addOnClick(row,row_index,item_id,labour_id){
               
                var newQty = parseInt($("#"+row).html())+1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'post/add_qty_job.php',
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

                      url:'post/add_qty_job.php',
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
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Added.'
                    });


                    setTimeout(function () {
                        window.open('invoice?i=<?php echo base64_encode($JobId); ?>',
                                      '_blank' // <- This is what makes it open in a new window.
                                    );
                        window.location.href = "old_invoice.php";
                       //location.reload();
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

</body>
</html>