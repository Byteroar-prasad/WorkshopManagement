<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');

    $PartSellingId = base64_decode($_GET['p']);

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

    $sql = "SELECT * FROM tbl_part_selling_details WHERE part_selling_id= '$PartSellingId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $part_selling_id = $row[0];
            $email=$row[1];
            $customer=$row[2];
            $phone_number=$row[3];
            $reg_madel=$row[4];
            $reg_chassis_no=$row[5];
            $reg_licens_no=$row[6];   
            $service_advisor=$row[7]; 
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
                                margin-top: 70px;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #CancelInvoiceButton {
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
                                                            <p>
                                                                Customer Name - <?php echo $customer; ?>                                                       
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="com-details" style="padding-right:0;">
                                                            <img src="assets/logo-black.png" id="logo-img" style="width: 20%;"><br>
                                                            <address>
                                                                <h2 class="m-b-md m-t-xxs"><b>Part Invoice<br>
                                                                <font style="font-size: 14px;">Part Invoice No : BAE/PIN/<?php echo $currentYear; ?>/<?php echo (10000+$PartSellingId); ?></font>
                                                                </b></h2><br>
                                                            </address>

                                                            <div style="display: -webkit-inline-box;">
                                                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>

                                                                <?php
                                                                  $PartSellingCountsql = "SELECT COUNT(*) FROM tbl_part_selling_list WHERE part_selling_id = '$part_selling_id' ";
                                                                  $PartSellingCountresult = mysqli_query($conn, $PartSellingCountsql);
                                                                  $PartSellingCount = mysqli_fetch_assoc($PartSellingCountresult)['COUNT(*)'];
                                                                  //echo $count;
                                                                ?>
                                                                <?php if ($PartSellingCount==0) { ?>
                                                                <form id="Cancel-Selling-Part" method="POST">
                                                                    <input type="hidden" value="<?php echo $part_selling_id; ?>" name="part_selling_id" readonly required>
                                                                    &nbsp;&nbsp;<button type="submit" id="CancelInvoiceButton" class="btn text-white bg-red"><i class="fa fa-times"></i> Cancel</button>
                                                                </form>
                                                                <?php } else{}?>
                                                            </div>

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
                                                                            <th class="colorchange" style="font-weight: 600;">Client Name</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $customer; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Contact Number</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $phone_number; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="font-weight: 600;">Email Address</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $email; ?></th>
                                                                            <th class="colorchange" style="font-weight: 600;">Service Advisor</th>
                                                                            <th class="colorchange result" id="print_job_details" style="font-weight: 600;"><?php echo $service_advisor; ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <hr>
                                                            <button class="btn btn-primary" id="refresh-btn" style="float: right;" data-toggle="tooltip" data-placement="bottom" title="Refresh To Load" onclick="location.reload();"><i class="fa fa-refresh" aria-hidden="true"></i></button>

                                                            <br><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="1" style="text-align: center;">#</th>
                                                                            <th colspan="2" style="text-align: center;">PART</th>
                                                                            <th colspan="1" style="text-align: center;" id="qty_print">Qty</th>
                                                                            <th colspan="1" style="text-align: center;" id="discount_print">Discount</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>

                                                                        <?php 
                                                                            $PartCount=0;
                                                                            $Partsql = "SELECT * FROM tbl_part_selling_list tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.part_selling_id= '$PartSellingId' ";
                                                                            $rsitem=$conn->query($Partsql);
                                                                            
                                                                                while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[12];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                    $Part_discount = $rowitem[7];
                                                                                    $ItemStat = $rowitem[9];

                                                                                    /////////////Item Count/////////////////
                                                                                    $PartNumber = $rowitem[14];
                                                                                    $Item_price = (double)$rowitem[8];
                                                                                    // $Item_discount = $rowitem[16];

                                                                                    $Item_price_with_qty = $Item_price * $qty;
                                                                                    $discountPartAmount = ((double)$Item_price_with_qty * (double)$Part_discount) / 100;
                                                                                    $totalPriceWithDisc = (double)$Item_price_with_qty - (double)$discountPartAmount;
                                                                                    
                                                                                    $total_part_price += $totalPriceWithDisc;
                                                                                    //////////////////////////////
                                                                                
                                                                                
                                                                            ?>
                                                                            <tr id="part_print_view">
                                                                                <td colspan="1"><center><?php echo $PartCount+=1; ?></center></td>
                                                                                <td colspan="2"><font style="text-transform: uppercase;"><?php echo $part_name; ?> <b>(<?php echo $PartNumber; ?>)</b></font></td>

                                                                                    <td colspan="1" style="width: 200px;">
                                                                                        <button class="btn text-white bg-red plusminus" onclick="minusOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $ItemStat;?>')"> <i class="fa fa-minus" aria-hidden="true"></i> </button>
                                                                                        <span id="qty-label-<?php echo $rowIndex;?>" style="padding-left: 15px; padding-right: 15px; ">

                                                                                                <?php echo $qty; ?>
                                                                                            
                                                                                            </span>
                                                                                        <button class="btn text-white bg-green plusminus" onclick="addOnClick('qty-label-<?php echo $rowIndex;?>','<?php echo $rowIndex;?>','<?php echo $itemId;?>','<?php echo $ItemStat;?>')"> <i class="fa fa-plus" aria-hidden="true"></i> </button>


                                                                                        <br><a style="font-size: 10px; cursor: pointer;" id="part-qty-change-click" data-toggle="modal" data-target="#change_qty<?php echo $rowIndex; ?>">
                                                                                            Click here to type quantity
                                                                                        </a>
                                                                                    </td>
                                                                                
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


                                                                  



                                                                        

                                                                        

                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>

                                                        <?php
                                                        //Sub Total
                                                        $sub_total = $total_job_fru_paybel + $total_part_price;

                                                        ?>



                                                        <div class="col-md-12" style="padding-left:0;">
                                                            <hr id="no_need_print">
                                                            <!--<p>
                                                                <strong>Service Advisor : <?php //echo $service_advisor; ?></strong><br>
                                                            </p>-->
                                                        </div>
                                                        
                                                            
                                                            <button type="submit" class="btn text-white bg-indigo" onclick="showModal('1')" style="margin-right: 5px;"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Parts</button>
                                                            
                                                        <br><br>
                                                        
                                                        <?php if ($user_role=='1' || $user_role=='0'){ ?>
                                                            <button id="invoice-button" class="btn text-white bg-azure" data-toggle="modal" data-target="#genarate_invoice"><i class="fa fa-plus-circle"></i> Add VAT</button>
                                                            <button id="note-button" class="btn text-white bg-purple" data-toggle="modal" data-target="#write_note"><i class="fa fa-plus-circle"></i> Add Note</button>
                                                            
                                                            <a href="part_selling_invoice?i=<?php echo base64_encode($PartSellingId); ?>" id="preview-invoice-button" class="btn btn-info" style="float: right;"><i class="fa fa-eye"></i> Preview Invoice</a>
                                                        <?php }else{} ?>
                                                        <?php if ($user_role=='1' || $user_role=='0' || $user_role=='2'){ ?>
                                                            <!-- <button id="sublet-button" class="btn text-white bg-teal" data-toggle="modal" data-target="#add_sublet"><i class="fa fa-plus-circle"></i> Add Sublet</button> -->
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
                                    

                                   


                                    <!-- Start All Models-->

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
                                                                <input type="hidden" class="form-control" name="part_selling_id" id="part_selling_id" value="<?php echo $PartSellingId; ?>" required>
                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <?php 
                                                                            $Taxsql = "SELECT * FROM tbl_part_selling_tax WHERE part_selling_id= '$PartSellingId' ";
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
                                                                                <input type="number" class="form-control" value="<?php echo $tax_vat; ?>" name="vat" min="0" id="2" placeholder="VAT" required>
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
                                                                <input type="hidden" class="form-control" name="part_selling_id" id="part_selling_id" value="<?php echo $PartSellingId; ?>" required>
                                                                <input type="hidden" class="form-control" name="user_id" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">
                                                                        
                                                                        <?php 
                                                                            $InvoiceNotesql = "SELECT * FROM tbl_part_selling_tax WHERE part_selling_id= '$PartSellingId' ";
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
                                                
                                               


                                                <!-- Add part -->
                                                <div class="modal fade" id="add-part" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true" data-backdrop="static" data-keyboard="false">
                                                    <div class="modal-dialog modal-dialog modal-lg" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLongTitle">Add Parts</h5>
                                                                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                          
                                                                <input type="hidden" id="part_selling_id" value="<?php echo $PartSellingId; ?>" required>
                                                                <input type="hidden" id="user_id" value="<?php echo $user_id; ?>" required>
                                                                <!-- <input type="hidden" id="dynamic_labour_id"/> -->
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
                    
                    // $("#dynamic_labour_id").val(labourId);
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
                        url:'part_selling_post/add_parts_selling_part_card.php',
                        type:'POST',
                        data:{
                            list:JSON.stringify(tempList),
                            part_selling_id:$("#part_selling_id").val(),
                            user_id:$("#user_id").val()
                            // labour_id:$("#dynamic_labour_id").val()
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
       

            function addOnClick(row,row_index,item_id,pb){
               
                var newQty = parseInt($("#"+row).html())+1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'part_selling_post/add_qty_selling_card_plus.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        // labour_id:labour_id,
                        new_qty:newQty,
                        price_batch:pb,
                        operator:'+'
                      },

                      success:function(data){

                       

                      },error:function(err){
                        console.log(err);
                      }



                });



            }


            function minusOnClick(row,row_index,item_id,pb){

                if(parseInt($("#"+row).html()) > 0 ){

                    var newQty = parseInt($("#"+row).html())-1;
                $("#"+row).html(newQty);


                $.ajax({

                      url:'part_selling_post/add_qty_selling_card_minus.php',
                      type:'POST',
                      data:{
                        row_index:row_index,
                        item_id:item_id,
                        // labour_id:labour_id,
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

                url:"part_selling_post/add_part_discount.php",
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

                url:"part_selling_post/add_part_qty_clicking.php",
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

                url:"part_selling_post/add_tax.php",
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

                url:"part_selling_post/add_note.php",
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


    <!-----------------------------Cancel Selling Part--------------------------------------->

    <script>
        
        $(document).on('submit', '#Cancel-Selling-Part', function(e){
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

                url:"part_selling_post/cancel_selling_part.php",
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
                      text:'Successfully Canceled This invoice.'
                    });


                    setTimeout(function () {
                       // location.reload();
                       window.location.href = "index.php";
                    },1000);

                }

            });

        return false;
        });
    </script>
    
    
    

    

</body>
</html>