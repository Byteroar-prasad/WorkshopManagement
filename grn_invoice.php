<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    // $currentDate=date('Y-m-d H:i:s');
    $BatchDate=date('d/m/y');

    $GRNDetailId= base64_decode($_GET['g']);
    $ItemCount=0;
    $GRNInvoiceCost=0;
    
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


<?php if ($user_role=='1' || $user_role=='2'){ ?>

<?php
    $getDataQuery=$conn->query("SELECT * FROM tbl_grn_details tgd INNER JOIN tbl_supplier tsu ON tgd.supplier_id=tsu.supplier_id WHERE tgd.grn_detail_id = '$GRNDetailId' ");
    if ($GRNrs=$getDataQuery->fetch_array()) {

        $SupplierId=$GRNrs[1];
        $CreateUserName=$GRNrs[2];
        $CreateUserId=$GRNrs[3];
        $InvoiceNumber=$GRNrs[4];
        $GRNNumber=$GRNrs[5];
        $GoodsReceivedDate=$GRNrs[6];
        $Note=$GRNrs[7];
        $Stat=$GRNrs[8];
        $GRNDateTime=$GRNrs[9];
        
        $GRNYear = date('Y', strtotime($GRNDateTime)) ;

        if ($GRNNumber=='0') {
            
        }else{

        $GRNType = explode("_",$GRNNumber);
        $Currencey = $GRNType[0];
        $CurrenceyInLKR = (double)$GRNType[1];
        $FreightClearence = (double)$GRNType[2];
        }

        /////////////////////////////////

        $SupplierName=$GRNrs[11];
        $SupplierCompanyName=$GRNrs[12];
        $SupplierAddress=$GRNrs[13];
        $SupplierPhoneNumber=$GRNrs[14];
        $SupplierEmail=$GRNrs[15];
        $SupplierStat=$GRNrs[16];
        $SupplierDateTime=$GRNrs[17];
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
            .select2-container .select2-selection--single {
                height: 34px !important;
                border-color: #E8E9E9 !important; 
                font-size: 14px !important;
            }
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
                        
                        

                 
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title"><?php echo $SupplierName; ?> | GRN Date - <?php echo $GRNDateTime; ?></h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="example-container">
                                            <div class="example-content">

                                                <div class="row">
                                                    <div class="col-md-4">

                                                        <!--Local -->
                                                        <?php if ($GRNNumber=='0') { ?>

                                                        <form class="row g-3" id="Add-GRN-Bill-Item">
                                                            <input type="hidden" name="grn_detail_id" value="<?php echo $GRNDetailId;?>" required readonly>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Select Part <font style="color: #FF0000;">*</font></label>
                                                                <select class="js-example-basic-single form-control" name="item_id" id="select-part" style="padding: 0.375rem 0.75rem !important;" onchange="onPartChanged()" required>
                                                                    <option value="" selected disabled>Select Part</option>
                                                                    <?php

                                                                        $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                                        while ($row=$itemsQuery->fetch_array()) {
                                                                    ?>
                                                                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-10">
                                                                <label class="form-label">Select Price Batch <font style="color: #FF0000;">*</font></label>
                                                                <select style="width: 100% !important;" class="form-control" id="price_batch_id" name="price_batch_id" onchange="onPriceBatchChanged()" required>
                                                                    <option value="" selected disabled>Select Price Batch</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-2">
                                                                <label class="form-label" style="color: #FFF;">1</label>
                                                                <button type="button" id="btn-add-new-price-batch" class="btn btn-primary" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Add new price batch here"><i class="fa fa-plus"></i></button>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Cost Price (.Rs) <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" name="cost_price" id="cost-input" class="form-control" placeholder="Cost Price" required readonly>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Selling Price (.Rs) <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" name="selling_price" id="selling-input" class="form-control" placeholder="Selling Price" required readonly>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <label class="form-label">Quantity <font style="color: #FF0000;">*</font></label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" min="1" name="qty" aria-describedby="basic-addon2" placeholder="Quantity" style="text-align: right;" id="stock-input" required>
                                                                    <!-- <span class="input-group-text" id="basic-addon2">kg</span> -->
                                                                </div>
                                                                <span style="color: #FF0000; font-size: 12px;">Don't put Unit Type</span>
                                                            </div>

                                                            


                                                            <div class="col-12">
                                                                <button type="submit" id="btn-add-grn-bill-item" class="btn btn-primary">Add</button>
                                                            </div>
                                                        </form>

                                                    <!--Internatinal-->
                                                    <?php }else { ?>

                                                        <form class="row g-3" id="Add-GRN-Bill-Item-Internatinal">
                                                            <input type="hidden" name="grn_detail_id" value="<?php echo $GRNDetailId;?>" required readonly>
                                                            <div class="col-md-12">
                                                                <label class="form-label">Select Part <font style="color: #FF0000;">*</font></label>
                                                                <select class="js-example-basic-single form-control" name="item_id" id="select-part" style="padding: 0.375rem 0.75rem !important;" onchange="onPartChanged()" required>
                                                                    <option value="" selected disabled>Select Part</option>
                                                                    <?php

                                                                        $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                                        while ($row=$itemsQuery->fetch_array()) {
                                                                    ?>
                                                                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>

                                                                <input type="hidden" class="form-control" value="<?php echo $BatchDate ?>" name="batch_label" placeholder="Batch Label" required>
                                                                <input type="hidden" class="form-control" id="Currencey-In-LKR" value="<?php echo $CurrenceyInLKR; ?>" required readonly>
                                                                <input type="hidden" class="form-control" id="Freight-Clearence" value="<?php echo $FreightClearence; ?>" required readonly>
                                                                <!-- <input type="hidden" class="form-control" name="stat" value="1" placeholder="Stat" required readonly> -->
                                                                <input type="hidden" class="form-control" value="<?php echo $GRNNumber; ?>" name='grn_currencey_details' required readonly>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Cost <?php echo $Currencey; ?> <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" class="form-control" name="currencey_rate" id="Currencey-Rate" placeholder="Cost Price" required>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Cost Price (.Rs) <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" name="cost_price" id="cost_price" class="form-control" placeholder="Cost Price" required readonly>
                                                            </div>

                                                            <div class="col-md-12">
                                                                <label class="form-label">Selling Price (.Rs) <font style="color: #FF0000;">*</font></label>
                                                                <input type="text" name="selling_price" id="selling-input" class="form-control" placeholder="Selling Price" required>
                                                            </div>


                                                            <div class="col-md-12">
                                                                <label class="form-label">Quantity <font style="color: #FF0000;">*</font></label>
                                                                <div class="input-group">
                                                                    <input type="number" class="form-control" min="1" name="qty" aria-describedby="basic-addon2" placeholder="Quantity" style="text-align: right;" id="stock-input" required>
                                                                    <!-- <span class="input-group-text" id="basic-addon2">kg</span> -->
                                                                </div>
                                                                <span style="color: #FF0000; font-size: 12px;">Don't put Unit Type</span>
                                                            </div>

                                                            


                                                            <div class="col-12">
                                                                <button type="submit" id="btn-add-grn-bill-item-inter" class="btn btn-primary">Add</button>
                                                            </div>
                                                        </form>
                                                        
                                                    <?php } ?>
                                                          
                                                    </div>

                                                    <div class="col-md-8">


                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p style="text-align: left;">
                                                                    <b>GRN Number - BAE/GRN/<?php echo $GRNYear; ?>/<?php echo 10000+$GRNDetailId;?></b><br>
                                                                    <b>Invoice Number - <?php echo $InvoiceNumber; ?></b><br>
                                                                    <b>GR Date - <?php echo $GoodsReceivedDate; ?></b><br>
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p style="text-align: right;">
                                                                    <b>Supplier Details</b><br>
                                                                    <?php echo $SupplierName; ?><br>
                                                                    <?php echo $SupplierCompanyName; ?><br>
                                                                    <?php echo $SupplierAddress; ?>
                                                                </p>
                                                                <p style="text-align: right;">
                                                                    <?php if ($GRNNumber=='0') { }else{?>
                                                                        <b>
                                                                           Currencey - <?php echo $Currencey; ?><br> 
                                                                           Currencey Rate - <?php echo number_format($CurrenceyInLKR,2); ?><br> 
                                                                           F & C - <?php echo $FreightClearence.'%'; ?>
                                                                        </b>
                                                                    <?php } ?>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <?php      
                                                            $getGRNInvoiceCost = "SELECT * FROM tbl_grn_items WHERE grn_detail_id='$GRNDetailId'";
                                                            $gGRNiRs=$conn->query($getGRNInvoiceCost);
                                                            $ResultCount = 0;
                                                            while($gGRNirow =$gGRNiRs->fetch_array())
                                                            {
                                                                $ResultCount += 1;
                                                                //////
                                                                $GCostPrice=(double)$gGRNirow[4];
                                                                $GGRNQTY=(double)$gGRNirow[6];
                                                                $GGRNItemCost = $GCostPrice * $GGRNQTY;
                                                                //////
                                                                $GRNInvoiceCost+=$GGRNItemCost;
                                                            }
                                                        ?>
                                                        
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="card widget widget-info-navigation" style="background-color: #e7ecf8;">
                                                                    <div class="card-body">
                                                                        <div class="widget-info-navigation-container">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="widget-info-navigation-content">
                                                                                        <span class="text-dark">Item Count</span><br>
                                                                                        <span class="text-danger fw-bolder fs-2" id="grn-item-count" style="color: #ff4857!important; font-size: 30px; font-weight: 700;"><?php echo $ResultCount; ?></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="widget-info-navigation-action">
                                                                                        <a href="#!" class="btn btn-light btn-rounded" style="border-radius: 18px;"><i class="fe fe-arrow-down-circle"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="card widget widget-info-navigation" style="background-color: #e7ecf8;">
                                                                    <div class="card-body">
                                                                        <div class="widget-info-navigation-container">
                                                                            <div class="row">
                                                                                <div class="col-md-10">
                                                                                    <div class="widget-info-navigation-content">
                                                                                        <span class="text-dark">Total Cost</span><br>
                                                                                        <span class="text-danger fw-bolder fs-2" id="grn-total-cost" style="color: #ff4857!important; font-size: 30px; font-weight: 700;"><?php echo number_format($GRNInvoiceCost,2); ?></span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-2">
                                                                                    <div class="widget-info-navigation-action">
                                                                                        <a href="#!" class="btn btn-light btn-rounded" style="border-radius: 18px;"><i class="icon-wallet"></i></a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        

                                                        <div class="example-content">
                                                            <table class="table table-hover">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Item</th>
                                                                        <th scope="col"><font style="float: right;">Qty</font></th>
                                                                        <th scope="col"><font style="float: right;">Cost (Rs)</font></th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="grn-item-area">
                                                                    <?php
                                                                        $getGRNItems = "SELECT * FROM tbl_grn_items tgi INNER JOIN tbl_item tit ON tgi.item_id=tit.item_id WHERE tgi.grn_detail_id='$GRNDetailId' ORDER BY tgi.grn_items_id ASC";
                                                                        $gGRNiRs=$conn->query($getGRNItems);
                                                                        while($gGRNiRsrow =$gGRNiRs->fetch_array())
                                                                        {
                                                                            $GRNItemItemId=$gGRNiRsrow[0];
                                                                            $ItemId=$gGRNiRsrow[2];
                                                                            $PriceBatchId=$gGRNiRsrow[3];
                                                                            $CostPrice=(double)$gGRNiRsrow[4];
                                                                            $SellingPrice=$gGRNiRsrow[5];
                                                                            $GRNQTY=(double)$gGRNiRsrow[6];
                                                                            $GRNItemStat=$gGRNiRsrow[7];
                                                                            ////////////////////////////
                                                                            $ItemName=$gGRNiRsrow[9];

                                                                            $GRNItemCost = $CostPrice * $GRNQTY;


                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $ItemCount+=1; ?></th>
                                                                        <td><?php echo $ItemName; ?></td>
                                                                        <td><b style="float: right;"><?php echo $GRNQTY; ?></b></td>
                                                                        <td><b style="float: right;"><?php echo number_format($GRNItemCost,2); ?></b></td>
                                                                        <td>
                                                                            <form id="Delete-GRN-Item" method="POST">
                                                                                <input type="hidden" name="grn_items_id" value="<?php echo $GRNItemItemId; ?>" required readonly>
                                                                                <input type="hidden" name="grn_detail_id" value="<?php echo $GRNDetailId; ?>" required readonly>
                                                                                <input type="hidden" name="item_id" value="<?php echo $ItemId; ?>" required readonly>
                                                                                <input type="hidden" name="price_batch_id" value="<?php echo $PriceBatchId; ?>" required readonly>
                                                                                <input type="hidden" name="qty" value="<?php echo $GRNQTY; ?>" required readonly>
                                                                                <button type="submit" id="btn-delete-grn-item" class="btn text-white bg-red btn-sm" style="float: right;"><i class="fa fa-trash-o"></i> Remove</button>   
                                                                            </form>
                                                                        </td>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                            </table>
                                                        </div>


                                                        <form method="POST" id="GRN-Finalize">
                                                            <input type="hidden" name="grn_detail_id" value="<?php echo $GRNDetailId; ?>" required readonly>
                                                            <button type="submit" id="btn-final-grn-bill" class="btn btn-primary" style="width: 100%;" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="This action can't be reverted">Finalize GRN</button>
                                                        </form>
                                                        

                                                    </div>

                                                </div>

                                            </div>
                                            

                                        </div>
                                    </div>
                                </div>

                    
                        
                        


                    </div>
                    
                </div>
            </div>
        </div>

        <!--Price Batch Modal -->
        <div class="modal fade" id="modal_add_price_batch" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Add Price Batch <span id="selected-part-name"></span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                                                            
                        <form id="Add-Price-Batch" method="POST">
                            <input type="hidden" class="form-control" name="selected_item_id" id="selected_item_id" readonly required>
                                <!-- <div class="panel-heading clearfix">
                                    <h4 class="panel-title">Register Client Details</h4>
                                </div> -->
                                <div class="panel-body">
                                    <input type="hidden" class="form-control" value="<?php echo $GRNDetailId; ?>" name="grn_number" required readonly>
                                    <div class="form-group">
                                        <label for="batch_label">Batch Label <font style="color: #FF0000;">*</font></label>
                                        <input type="text" class="form-control" name="batch_label" id="batch_label_check" placeholder="Batch Label" required>
                                    </div>

                                    <?php

                                        if ($GRNNumber=='0') { ?>
                                            <input type="hidden" class="form-control" name="stat" value="0" placeholder="Stat" required readonly>
                                            <div class="form-group">
                                                <label for="cost_price">Cost Price <font style="color: #FF0000;">*</font></label>
                                                <input type="text" class="form-control" name="cost_price" placeholder="Cost Price" required>
                                            </div>

                                        <?php }else{ ?>
                                            <input type="hidden" class="form-control" id="Currencey-In-LKR" value="<?php echo $CurrenceyInLKR; ?>" required readonly>
                                            <input type="hidden" class="form-control" id="Freight-Clearence" value="<?php echo $FreightClearence; ?>" required readonly>
                                            <input type="hidden" class="form-control" name="stat" value="1" placeholder="Stat" required readonly>
                                            <input type="hidden" class="form-control" value="<?php echo $GRNNumber; ?>" name='grn_currencey_details' required readonly>
                                            <div class="form-group">
                                                <label for="currencey_rate">Cost <?php echo $Currencey; ?> <font style="color: #FF0000;">*</font></label>
                                                <input type="text" class="form-control" name="currencey_rate" id="Currencey-Rate" placeholder="Cost Price" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="cost_price">Cost Price <font style="color: #FF0000;">*</font></label>
                                                <input type="text" class="form-control" name="cost_price" placeholder="Cost Price" id="cost_price" required readonly>
                                            </div>


                                        <?php } ?>

                                    <div class="form-group">
                                        <label for="selling_price">Selling Price <font style="color: #FF0000;">*</font></label>
                                        <input type="text" class="form-control" name="selling_price" placeholder="Selling Price" required>
                                    </div>

                                </div>
                            <button type="submit" id="btn-add-new-price-batch" class="btn btn-primary waves-effect waves-light">Add Price Batch</button>
                                                                
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
        <?php include_once('controls/footer.php'); ?>

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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

    <script type="text/javascript">
       
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script> 

    <script>



        function calculateRealCostLKR(){
             var cil = document.getElementById('Currencey-In-LKR').value;
             var fc = document.getElementById('Freight-Clearence').value;
             var cr = document.getElementById('Currencey-Rate').value;

             var fcprice = (parseFloat(fc)/100) * parseFloat(cr);

             var realp = parseFloat(fcprice) + parseFloat(cr);

             var newCost = parseFloat(realp) * parseFloat(cil);


            $("#cost_price").val(newCost);
            // $("#price").val(newPRice.toFixed(2));
        }

        setInterval(function(){
          calculateRealCostLKR();
        }, 500);
    </script>



    <script>
       
        $(document).ready(function() {
            $("#btn-add-new-price-batch").click(function(){

                

                if($("#select-part").val() === null || $("#select-part").val() === ''){

                }else{
                    $("#selected-part-name").html($("#select-part").children("option").filter(":selected").text());
                    $("#selected_item_id").val($("#select-part").val());
                    $("#modal_add_price_batch").modal('show'); 
                }



                

            });
        });
    </script>

    

<script>
    function onPartChanged(){

        $("#cost-input").val("");
        $("#selling-input").val("");

        var val=$("#select-part").val();      

        $.ajax({
            url:'grn_post/get_price_batch_for_add_stock.php',
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
    ///////////////////////////////////////////////
    function onPriceBatchChanged(){
        var valp=$("#select-part").val();  
        var valb=$("#price_batch_id").val();             

        $.ajax({
            url:'grn_post/get_cost_price.php',
            type:'POST',
            data:{
                part_no:valp,
                price_batch_id:valb
            },
            success:function(data){
               
                var json = JSON.parse(data);
                if(json.result){

                    $("#cost-input").val(json.cp);
                    $("#selling-input").val(json.sp);
                }

            },error:function(err){
                console.log(err);
            }
        //
    });


    }

</script>

    <script>
        
        $(document).on('submit', '#Add-GRN-Bill-Item', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-add-grn-bill-item").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show');
                },

                url:"grn_post/add_grn_item.php",
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
                    
                       $("#grn-item-area").html(json.data);
                       $("#grn-total-cost").html(json.GRNItemTotalCost);
                       $("#grn-item-count").html(json.ResultCount);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show');
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#btn-add-grn-bill-item").attr("disabled",false);
                       document.getElementById('stock-input').value = '';
                       document.getElementById('cost-input').value = '';
                       document.getElementById('selling-input').value = '';
                       document.getElementById('price_batch_id').value = '';
                       

                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-add-grn-bill-item").attr("disabled",false);
                    }
                    
                }

            });

        return false;
        });
    </script>
<!-----Interna--------->
    <script>
        
        $(document).on('submit', '#Add-GRN-Bill-Item-Internatinal', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-add-grn-bill-item-inter").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show');
                },

                url:"grn_post/add_grn_item_internatinal.php",
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
                    
                       $("#grn-item-area").html(json.data);
                       $("#grn-total-cost").html(json.GRNItemTotalCost);
                       $("#grn-item-count").html(json.ResultCount);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show');
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       $("#btn-add-grn-bill-item-inter").attr("disabled",false);
                       document.getElementById('stock-input').value = '';
                       document.getElementById('cost-input').value = '';
                       document.getElementById('selling-input').value = '';
                       document.getElementById('price_batch_id').value = '';
                       

                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-add-grn-bill-item-inter").attr("disabled",false);
                    }
                    
                }

            });

        return false;
        });
    </script>


    <script>
        
        $(document).on('submit', '#Delete-GRN-Item', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-delete-grn-item").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"grn_post/delete_grn_item.php",
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

                       $("#grn-item-area").html(json.data);
                       $("#grn-total-cost").html(json.GRNItemTotalCost);
                       $("#grn-item-count").html(json.ResultCount);
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);

                       // window.location.href = "products";
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-delete-grn-item").attr("disabled",false);
                    }
                    
                }

            });

        return false;
        });
    </script>

    <script>
        
        $(document).on('submit', '#Add-Price-Batch', function(e){
        e.preventDefault(); //stop default form submission
        
        var bn = $("#batch_label_check").val();
        
            if(bn ==='Normal' || bn ==='normal' || bn ==='NORMAL'){
                
                alert(bn+" is a keyword, please use another word.");
                
            }else{
                
                 var formData = new FormData($(this)[0]);

        $.ajax({

                beforeSend : function() {

                     $("#progress_alert").addClass('show');

                },

                url:"grn_post/add_price_batch.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                   var json = JSON.parse(data);
                   if(json.result){

                        $("#price_batch_id").append(json.data);

                   }

                    $("#modal_add_price_batch").modal('hide'); 
                    $("#progress_alert").removeClass('show');
                    $("#success_msg").html(json.msg);
                    $("#success_alert").addClass('show');

                }

            });
                
            }
        
        
        
        
        
       

        return false;
        });
    </script>

    

    <script>
        
        $(document).on('submit', '#GRN-Finalize', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-final-grn-bill").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 

                },

                url:"grn_post/update_status_grn.php",
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

                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       window.location.href = "view_grn_list.php";
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-final-grn-bill").attr("disabled",false);
                    }
                    
                }

            });

        return false;
        });
    </script>


</body>
</html>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404";
</script>

<?php } ?>

