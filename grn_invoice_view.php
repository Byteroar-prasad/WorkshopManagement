<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

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
            
        $Currencey = '';
        $CurrenceyInLKR = '';
        $FreightClearence = '';
            
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
                                margin-top: 40px;
                                background-color: #fff !important;
                            }
                            #supplier-details-print{
                                margin-top: -80px !important;
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
                            #delete_area{
                                display: none;
                            }
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
                        
                        

                 
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title">GRN</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="example-container">
                                            <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                            <div class="example-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p style="text-align: left;">
                                                                    <b>GRN Number - BAE/GRN/<?php echo $GRNYear; ?>/<?php echo 10000+$GRNDetailId;?></b><br>
                                                                    <b>Invoice Number - <?php echo $InvoiceNumber; ?></b><br>
                                                                    <b>GR Date - <?php echo $GoodsReceivedDate; ?></b><br>
                                                                    
                                                                    <?php if ($GRNNumber=='0') { }else{ ?>
                                                                    <br>
                                                                    <b>Currencey - <?php echo $Currencey; ?></b><br>
                                                                    <b>Currencey Rate (LKR) - Rs.<?php echo number_format($CurrenceyInLKR,2); ?></b><br>
                                                                    <b>Freight & Clearance - <?php echo $FreightClearence.'%'; ?></b><br>
                                                                    <?php } ?>
                                                                </p>

                                                                <?php if($user_role=='1'){ ?>
                                                                    <?php if ($GRNNumber=='0') { }else{ ?>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="printPageButton">Change Currencey Rate</button>
                                                                    <?php } ?>
                                                                <?php }else {} ?>

                                                            </div>

                                                            <div class="col-md-6" id="supplier-details-print">
                                                                <p style="text-align: right;">
                                                                    <b>Supplier Details</b><br>
                                                                    <?php echo $SupplierName; ?><br>
                                                                    <?php echo $SupplierCompanyName; ?><br>
                                                                    <?php echo $SupplierAddress; ?>
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
                                                        
                                                        <div class="row" style="display: none;">
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
                                                                        <?php if($user_role=='1'){ ?>
                                                                        <th scope="col" id="delete_area"></th>
                                                                        <?php }else{ } ?>
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
                                                                            $PartNumber=$gGRNiRsrow[11];

                                                                            $GRNItemCost = $CostPrice * $GRNQTY;


                                                                    ?>
                                                                    <tr>
                                                                        <th scope="row"><?php echo $ItemCount+=1; ?></th>
                                                                        <td><?php echo $ItemName.' ('.$PartNumber.')'; ?></td>
                                                                        <td><b style="float: right;"><?php echo $GRNQTY; ?></b></td>
                                                                        <td><b style="float: right;"><?php echo number_format($GRNItemCost,2); ?></b></td>
                                                                        <?php if($user_role=='1'){ ?>
                                                                        <td style="float: right;" id="delete_area">
                                                                            <form id="Delete-Item" method="POST">
                                                                                <input type="hidden" value="<?php echo $GRNItemItemId; ?>" name="grn_items_id" readonly>
                                                                                <input type="hidden" value="<?php echo $ItemId; ?>" name="item_id" readonly>
                                                                                <input type="hidden" value="<?php echo $PriceBatchId; ?>" name="price_batch_id" readonly>
                                                                                <input type="hidden" value="<?php echo $GRNQTY; ?>" name="qty" readonly>
                                                                                <button type="submit" class="btn text-white bg-red"><i class="fa fa-trash"></i></button>
                                                                            </form>
                                                                        </td>
                                                                        <?php }else{ } ?>
                                                                    </tr>
                                                                    <?php } ?>
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th><b style="float: right; color: #000; font-size: 20px; font-weight: 700;"><?php echo number_format($GRNInvoiceCost,2); ?></b></th>
                                                                        <?php if($user_role=='1'){ ?>
                                                                        <th id="delete_area"></th>
                                                                        <?php }else{ } ?>
                                                                    </tr>
                                                                </tfoot>

                                                            </table>
                                                        </div>
                                                        
                                                        <?php if($Note==''){ }else{?>
                                                        <p>
                                                            <b>GRN NOTE</b><br>
                                                            <?php echo nl2br($Note); ?>
                                                        </p>
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <font style="float: left;">
                                                                -----------------------<br>
                                                                <p>Prepared By</p>
                                                                </font>
                                                            </div>
                                                            <div class="col-md-4">
                                                                -----------------------<br>
                                                                <p>Set By</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <font style="float: right;">
                                                                -----------------------<br>
                                                                <p>Approved By</p>
                                                                </font>
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
            </div>
        </div>




        <!-- Start page footer -->
        <?php include_once('controls/footer.php'); ?>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Change Currencey</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form id="Change-Currencey">
              <div class="modal-body">

                <div class="col-md-12">
                    <label class="form-label">Change Currencey <font style="color: #FF0000;">*</font></label>
                    <input type="text" name="currency_in_lkr" value="<?php echo $CurrenceyInLKR; ?>" class="form-control" placeholder="Change Currencey" required>
                </div>

                <input type="hidden" class="form-control" name="currency_method" value="<?php echo $Currencey; ?>" required readonly>
                <input type="hidden" class="form-control" name="freight_clearance" value="<?php echo $FreightClearence; ?>" required readonly>
                <input type="hidden" class="form-control" name="grn_detail_id" value="<?php echo $GRNDetailId; ?>" required readonly>
         
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
              </div>
              </form>
            </div>
          </div>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

    <script type="text/javascript">
       
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script> 

    <script>

        
        $(document).on('submit', '#Change-Currencey', function(e){
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

                url:"grn_post/update_new_price.php",
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
                      text:'Successfully updated.'
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

        
        $(document).on('submit', '#Delete-Item', function(e){
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

                url:"grn_post/delete_grn_save_item.php",
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
                      text:'Successfully remove from stock.'
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

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404";
</script>

<?php } ?>

