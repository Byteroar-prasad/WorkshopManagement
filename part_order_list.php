<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    
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
                        
                         <h4>Part Order List</h4>
                        
                        <form class="card" id="Add-Part-Order">
                            <div class="card-body">
                                <h3 class="card-title">Add Part</h3>
                                <div class="row">
                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required readonly>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Select Part Number <font style="color: #FF0000;">*</font></label>
                                            <select style="width: 100% !important;" class="js-example-basic-single-part form-control" id="select-part" name="item_id" required>
                                                <option value="" selected disabled>Select Part Number</option>
                                                <?php
                        
                                                    $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                    while ($row=$itemsQuery->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Quantity <font style="color: #FF0000;">*</font></label>
                                            <input type="number" class="form-control" min="1" step="any" id="qty" name="qty" placeholder="Quantity" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Add Part</button>
                            </div>
                        </form>





                    </div>
                    
                </div>




                <div class="row clearfix">
                    <div class="col-lg-12" id="here">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Order Parts</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th>#</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>Estimate Number</th>
                                                <th>Quantity</th> 
                                                <th>(.Rs) Cost (Aprox)</th> 
                                                <th>Requested Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $ItemTotalCost=0;
                                                $AllItemTotalCost=0;
                                                $sql = "SELECT * FROM tbl_part_order_item tpoi INNER JOIN tbl_item ti ON tpoi.item_id=ti.item_id WHERE tpoi.stat='0' ORDER BY tpoi.part_order_item_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $PartOrderItemId = $row[0];
                                                    $PartOrderId = $row[1];
                                                    $EstimateId = $row[2];
                                                    $ItemId = $row[3];
                                                    $Qty = $row[4];
                                                    $ItemCost = (double)$row[5];
                                                    $UserId = $row[6];
                                                    $Stat = $row[7];
                                                    $PartOrderItemDateTime = $row[8];
                                                    $PartOrderItemDate = date('d-m-Y', strtotime($PartOrderItemDateTime)) ;
                                                    $PartOrderYear = date('Y', strtotime($PartOrderItemDateTime)) ;
                                                    ////
                                                    $PartName = $row[10];
                                                    $PartLocation = $row[11];
                                                    $PartNumber = $row[12];

                                                    $ItemTotalCost=$ItemCost*$Qty;
                                                    $AllItemTotalCost += $ItemTotalCost;
                                            
                                            ?>
                                            <tr class="gradeA">
                                                <td><?php echo $PartOrderItemId; ?></td> 
                                                <td><?php echo $PartName; ?></td>
                                                <td><?php echo $PartNumber; ?></td>
                                                <td>
                                                    <?php if ($EstimateId=='') { echo '-'; }else{ ?>
                                                    BAE/ES/<?php echo $PartOrderYear; ?>/<?php echo (10000+$EstimateId); ?>
                                                    <?php } ?>
                                                </td>
                                                <td data-toggle="modal" data-target="#EditQTYModal<?php echo $PartOrderItemId; ?>" style="cursor: pointer;">
                                                    <font style="font-weight: 700;"><?php echo $Qty; ?></font>
                                                    <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#EditQTYModal<?php //echo $PartOrderItemId; ?>">Edit</button> -->
                                                </td>
                                                <td><font style="float: right; font-weight: 700;"><?php echo number_format($ItemTotalCost,2); ?></font></td>
                                                <td><?php echo $PartOrderItemDate; ?></td>
                                                <td>
                                                    <form id="Delete-Part">
                                                        <input type="hidden" name="part_order_item_id" value="<?php echo $PartOrderItemId; ?>">
                                                        <button type="submit" class="btn text-white bg-red"><i class="fa fa-trash-o"></i></button>
                                                    </form>
                                                </td>
                                            </tr>


                                            <!-- Modal -->
                                            <div class="modal fade" id="EditQTYModal<?php echo $PartOrderItemId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                        <input type="hidden" name="part_order_item_id" value="<?php echo $PartOrderItemId; ?>">
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
                                        <tfoot>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <font style="float: right; font-weight: 700; font-size: 25px;">Rs. <?php echo number_format($AllItemTotalCost,2); ?></font><br>
                                                    <font style="float: right; color: #FF0000;">Previous cost to price calculation<br>(Aprox)</font>
                                                </td>
                                                <td></td>
                                            </tr>
                                        </tfoot>

                                    </table>
                                </div>
                                <?php if($user_role == 1 || $user_role == 2){?>
                                    <?php
                                        $CheckPartOrderedSql = "SELECT COUNT(*) FROM tbl_part_order_item WHERE stat='0'";
                                        $CPOrs=$conn->query($CheckPartOrderedSql);
                                        if($CPOrow =$CPOrs->fetch_array())
                                        {
                                            $CountPardOrderSum=$CPOrow[0];
                                        }
                                    ?>
                                    <?php if($CountPardOrderSum == 0){}else{ ?>
                                    <form id="Finalize-Part-Order">
                                        <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required readonly>
                                        <button type="submit" class="btn btn-primary" style="width: 100%;">Finalize Part Order</button>
                                    </form>
                                    <?php } ?>
                                <?php }else{} ?>


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

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="assets/js/themechanger.js"></script>



<script>
    $(document).ready(function() {
        $('.js-example-basic-single-part').select2();
    });
</script>


    <script>
        
        $(document).on('submit', '#Add-Part-Order', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {

                },

                url:"part_order_post/add_part.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    setTimeout(function () {
                        $( "#here" ).load(window.location.href + " #here" );
                       // location.reload();
                    },500);

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

                url:"part_order_post/delete_part.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {

                    setTimeout(function () {
                        $( "#here" ).load(window.location.href + " #here" );
                       // location.reload();
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

                url:"part_order_post/update_part_qty.php",
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

    

    <script>
        
        $(document).on('submit', '#Finalize-Part-Order', function(e){
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

                url:"part_order_post/submit_part_order.php",
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
                      text:'Successfully Requested Part Order.'
                    });

                    setTimeout(function () {
                        window.location.href = "requested_part_order";
                    },1000);

                }

            });

        return false;
        });
    </script>


</body>
</html>