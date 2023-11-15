<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

    $PartOrderId= base64_decode($_GET['g']);

    $ItemCount=0;
    $AllItemTotalCost=0;
    
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
    $getDataQuery=$conn->query("SELECT * FROM `tbl_part_order` WHERE part_order_id = '$PartOrderId' ");
    if ($row=$getDataQuery->fetch_array()) {

        // $PartOrderId = $row[0];
        $RequestedPersonId = $row[1];
        $ApprovedPersonId = $row[2];
        $Priority = $row[3];
        $Stat = $row[4];
        $PartOrderDateTime = $row[5];
        $PartOrderDate = date('d-m-Y', strtotime($PartOrderDateTime));
        $PartOrderYear = date('Y', strtotime($PartOrderDateTime));
    }
?>

<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
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
                            .dt-button{
                                display: none !important;
                            }
                            .dataTables_filter{
                                display: none !important;
                            }
                            .dataTables_info{
                                display: none !important;
                            }
                            .dataTables_paginate{
                                display: none !important;
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
                        
                        

                 
                                <div class="card" id="here">
                                    <div class="card-header">
                                        <h5 class="card-title">Part Order</h5>
                                    </div>
                                    <div class="card-body">
                                        <div class="example-container">
                                            
                                            <div class="example-content">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p style="text-align: left;">
                                                                    <img src="assets/BAE_Header.png" style="width: 70%;">
                                                                </p>
                                                            </div>
                                                            <div class="col-md-6" id="supplier-details-print">
                                                                <p style="text-align: right;">
                                                                    <img src="assets/logo-black.png" id="logo-img" style="width: 10%;"><br>
                                                                    <b>PO Number - BAE/PO/<?php echo $PartOrderYear; ?>/<?php echo 10000+$PartOrderId;?></b><br>
                                                                    <b>PO Date - <?php echo $PartOrderDate; ?></b><br>
                                                                    <?php if ($Stat=='1') { }else{?>
                                                                    <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                                                    <?php } ?>
                                                                </p>
                                                            </div>
                                                        </div>

                                                        <div class="example-content">
                                                            <table class="table table-hover" id="Part-Order">
                                                                <thead>
                                                                    <tr>
                                                                        <th scope="col">#</th>
                                                                        <th scope="col">Part Name</th>
                                                                        <th scope="col">Part Number</th>
                                                                        <th scope="col">Estimate Number</th>
                                                                        <th scope="col"><font style="float: right;">Requested Qty</font></th>
                                                                        <?php if ($Stat=='1') { ?>
                                                                        <th scope="col"></th>
                                                                        <?php }else{ } ?>
                                                                        <!--<th scope="col"><font style="float: right;">Cost (Rs)</font></th>-->
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="grn-item-area">
                                                                    <?php
                                                                        $GetPartOrderItemId = "SELECT DISTINCT(`item_id`) FROM tbl_part_order_item WHERE part_order_id='$PartOrderId' ORDER BY part_order_item_id ASC";
                                                                        $GPOIDrs=$conn->query($GetPartOrderItemId);
                                                                        while($GPOIDrow =$GPOIDrs->fetch_array())
                                                                        {
                                                                            $ItemId = $GPOIDrow[0];
                                                                    ?>

                                                                    <?php
                                                                        $ItemTotalCost=0;
                                                                        $GetPartDetails = "SELECT `item_id`,SUM(`qty`),`item_cost`,`part_order_item_id` FROM tbl_part_order_item WHERE item_id='$ItemId'";
                                                                        $GPDrs=$conn->query($GetPartDetails);
                                                                        if($GPDrow =$GPDrs->fetch_array())
                                                                        {
                                                                            $PartItemId = $GPDrow[0];
                                                                            $Qty = $GPDrow[1];
                                                                            $ItemCost = $GPDrow[2];
                                                                            $PartOrderItemId = $GPDrow[3];

                                                                            $ItemTotalCost=$ItemCost*$Qty;

                                                                            $GetItemDetails = "SELECT part_name,part_location,part_number FROM `tbl_item` WHERE item_id='$PartItemId'";
                                                                            $GIDrs=$conn->query($GetItemDetails);
                                                                            if($GIDrow =$GIDrs->fetch_array())
                                                                            {
                                                                                $PartName=$GIDrow[0];
                                                                                $PartLocation=$GIDrow[1];
                                                                                $PartNumber=$GIDrow[2];
                                                                            }

                                                                        }
                                                                    ?>

                                                                        

                                                                    <tr>
                                                                        <th scope="row"><?php echo $ItemCount+=1; ?></th>
                                                                        <td><?php echo $PartName; ?></td>
                                                                        <td><?php echo $PartNumber; ?></td>
                                                                        <td>
                                                                            <?php
                                                                                $GetEstimateNumber = "SELECT `estimate_id` FROM tbl_part_order_item WHERE item_id='$ItemId' AND part_order_id='$PartOrderId'";
                                                                                $GENrs=$conn->query($GetEstimateNumber);
                                                                                while($GENrow =$GENrs->fetch_array())
                                                                                {
                                                                                    $EstimateId=$GENrow[0];
                                                                                    // $EstimateNumber=$EstimateId+10000;
                                                                            ?>
                                                                                <?php if($EstimateId==''){ echo '-'; }else{ $EstimateNumber=$EstimateId+10000; ?>
                                                                                    BAE/ES/<?php echo $PartOrderYear; ?>/<?php echo $EstimateNumber.'<br>'; ?>
                                                                                <?php } ?>
                                                                            <?php } ?>
                                                                        </td>
                                                                        <?php if ($Stat=='1') { ?>
                                                                            <td data-toggle="modal" data-target="#EditQTYModal<?php echo $ItemId; ?>" style="cursor: pointer;"><b style="float: right;"><?php echo $Qty; ?></b></td>
                                                                        <?php }else{ ?>
                                                                            <td><b style="float: right;"><?php echo $Qty; ?></b></td>
                                                                        <?php  } ?>
                                                                        <?php if ($Stat=='1') { ?>
                                                                            <td>
                                                                                <form id="Delete-Part">
                                                                                    <input type="hidden" name="part_order_item_id" value="<?php echo $PartOrderItemId; ?>">
                                                                                    <input type="hidden" name="item_id" value="<?php echo $ItemId; ?>">
                                                                                    <input type="hidden" name="part_order_id" value="<?php echo $PartOrderId; ?>">
                                                                                    <button type="submit" class="btn text-white bg-red"><i class="fa fa-trash-o"></i></button>
                                                                                </form>  
                                                                            </td>
                                                                        <?php }else{  } ?>
                                                                        <!--<td><b style="float: right;"><?php //echo number_format($ItemTotalCost,2); ?></b></td>-->
                                                                    </tr>


                                                                    <!-- Modal -->
                                                                    <div class="modal fade" id="EditQTYModal<?php echo $ItemId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                                        <div class="modal-content">
                                                                          <div class="modal-header">
                                                                            <h5 class="modal-title" id="exampleModalLongTitle">Change Quantity <?php echo $PartName; ?></h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                              <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                          </div>
                                                                            <form id="Update-Qty">
                                                                              <div class="modal-body">
                                                                                <input type="hidden" name="item_id" value="<?php echo $ItemId; ?>">
                                                                                <input type="hidden" name="part_order_id" value="<?php echo $PartOrderId; ?>">
                                                                                <div class="form-group">
                                                                                    <label class="form-label">Quantity <font style="color: #FF0000;">*</font></label>
                                                                                    <input type="number" class="form-control" min="1" step="any" id="qty" name="qty" value="<?php echo $Qty; ?>" placeholder="Quantity" required>
                                                                                </div>
                                                                              </div>
                                                                              <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                <button type="submit" class="btn btn-primary">Update Quantity</button>
                                                                              </div>
                                                                            </form>
                                                                        </div>
                                                                      </div>
                                                                    </div>

                                                                        
                                                                    <?php } ?>
                                                                </tbody>

                                                                <?php
                                                                        $ItemTotalCostForCal=0;
                                                                        $GetCalculationSql = "SELECT qty,item_cost FROM tbl_part_order_item tpoi INNER JOIN tbl_item ti ON tpoi.item_id=ti.item_id WHERE tpoi.part_order_id='$PartOrderId' ORDER BY tpoi.part_order_item_id ASC";
                                                                        $GCrs=$conn->query($GetCalculationSql);
                                                                        while($GCrow =$GCrs->fetch_array())
                                                                        {
                                                                            $CalQty = $GCrow[0];
                                                                            $CalItemCost = (double)$GCrow[1];

                                                                            $ItemTotalCostForCal=$CalItemCost*$CalQty;
                                                                            $AllItemTotalCost += $ItemTotalCostForCal;
                                                                        }
                                                                    ?>

                                                                <tfoot>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <th></th>
                                                                        <?php if ($Stat=='1') { ?>
                                                                        <th></th>
                                                                        <?php } ?>
                                                                        <!--<th></th>-->
                                                                        <!--<th><b style="float: right; color: #000; font-size: 20px; font-weight: 700;">Rs. <?php //echo number_format($AllItemTotalCost,2); ?></b></th>-->
                                                                    </tr>
                                                                </tfoot>

                                                            </table>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                    
                                                    
                                                    <div class="col-md-12">
                                                        <?php if ($Stat=='1') { ?>
                                                            <?php if($user_role == 1 || $user_role == 3){?>
                                                                <form id="Approve-Part-Order">
                                                                    <input type="hidden" name="part_order_id" value="<?php echo $PartOrderId; ?>">
                                                                    <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
                                                                    <button type="submit" id="printPageButton" class="btn text-white bg-green" style="float: right;"><i class="fa fa-check"></i> Aprove</button>
                                                                </form>
                                                            <?php }else{} ?>
                                                        <?php }else{ ?>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <p style="text-decoration: overline; float: left;">Prepared By</p>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <p style="text-decoration: overline; float: right;">Approved By</p>
                                                            </div>
                                                        </div>
                                                        <?php } ?>
                                                    </div>
                                                    
                                                    

                                                </div>

                                            </div>
                                            
                                            <br><br>
                                        </div>
                                    </div>
                                </div>

                    
                        
                        


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

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<script src="assets/js/themechanger.js"></script>

    <script type="text/javascript">
       
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script> 
    
    <script>
    $(document).ready( function () {
       invoicetbl = $('#Part-Order').DataTable({
            "pageLength": 100,
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                'excel', 'pdf'
            ]
        });
    } );
    </script>
    
    <script>

        
        $(document).on('submit', '#Approve-Part-Order', function(e){
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

                url:"part_order_post/approve_part_order.php",
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
                      text:'Successfully approved.'
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
        
        $(document).on('submit', '#Delete-Part', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {

                },

                url:"part_order_post/delete_part_after_request.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    setTimeout(function () {
                        // $( "#here" ).load(window.location.href + " #here" );
                       location.reload();
                    },500);

                }

            });

        return false;
        });
    </script>

    <script>
        
        $(document).on('submit', '#Update-Qty', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {

                },

                url:"part_order_post/update_part_qty_after_request.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    setTimeout(function () {
                        // $('body').removeClass('modal-open');
                        // $('.modal-backdrop').remove();
                        // $( "#here" ).load(window.location.href + " #here" );
                       location.reload();
                    },500);

                }

            });

        return false;
        });
    </script>

</body>
</html>