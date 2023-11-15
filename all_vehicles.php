<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    
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
<?php if ($user_role=='2'){ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php }else{ ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
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
                
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Vehicles</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped nowrap" cellspacing="0" id="vehicleTable" style="width: 100%;">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Customer Name</th>
                                                <th>Vehicle Modal</th>
                                                <th>License Number</th>
                                                <th>Chassis Number</th>
                                                <th>Phone Number</th>
                                                <th>Email</th>
                                                <th>Registration Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql = "SELECT * FROM tbl_vehicle tbv INNER JOIN tbl_client tbc ON tbv.client_id=tbc.client_id ORDER BY tbv.vehicle_id DESC";
                                                //$sql = "SELECT * FROM `tbl_vehicle` ORDER BY 'vehicle_id' DESC ";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
 
                                                $reg_date = date('d-m-Y', strtotime($row[7])) ;
                                                $customer_id = $row[1];
                                                $customer_name = $row[9];
                                                $car_model = $row[3];
                                                $license_no = $row[2];
                                                $chassis_no = $row[4];
                                            
                                            
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $row[0]; ?></td> 
                                                <td><?php echo $row[9]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[4]; ?></td>
                                                <td><a href="tel:<?php echo $row[13]; ?>"><?php echo $row[13]; ?></a></td>
                                                <td><a href="mailto:<?php echo $row[10]; ?>"><?php echo $row[10]; ?></a></td>
                                                <td><?php echo $reg_date; ?></td>
                                                <td class="actions">
                                                    <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="modal"
                                                    data-target="#exampleModalCenter<?php echo $row[0]; ?>"><i class="icon-pencil" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $row[0]; ?>" role="dialog" aria-labelledby="exampleModalCenterTitle" data-backdrop='static' data-keyboard='false' aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo $row[2]; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <form id="Update-Form" method="POST">
                                                                <input type="hidden" class="form-control" name="vehicle_id" id="vehicle_id" value="<?php echo $row[0]; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="1">Select Customer Or Companey Name <font style="color: #FF0000;">*</font></label>
                                                                                <select style="width: 100% !important; border-color: #E8E9E9; font-size: 14px; height: auto; padding: 0.375rem 0.75rem;" class="js-example-basic-single form-control" name="client_id" required>
                                                                                    <option value="<?php echo $customer_id; ?>" selected><?php echo $customer_name; ?></option>
                                                                                    <?php

                                                                                        $clientNamesQuery=$conn->query("SELECT DISTINCT client_id,name,idcard_number,phone_no FROM tbl_client");
                                                                                        while ($row=$clientNamesQuery->fetch_array()) {
                                                                                    ?>

                                                                                    <?php if ($customer_id==$row[0]) { }else{ ?>
                                                                                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[3];?>)</option>
                                                                                    <?php } ?>

                                                                                    <?php } ?>
                                                                                </select>

                                                                              </div>
                                                                              
                                                                              <div class="form-group">
                                                                                <label for="license_no">License No. <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="license_no" id="license_no" placeholder="License No." value="<?php echo $license_no; ?>" required>
                                                                              </div>

                                                                              
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="vehicle_modal">Vehicle Modal <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="vehicle_modal" id="vehicle_modal" placeholder="Vehicle Modal" value="<?php echo $car_model; ?>" required>
                                                                              </div>
                                                                              <div class="form-group">
                                                                                <label for="chassis_no">Chassis No. <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="Chassis No." value="<?php echo $chassis_no; ?>" required>
                                                                              </div>
                                                                              
                                                                        </div>



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                                                
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
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start page footer -->
        <?php include_once('controls/footer.php'); ?>
    </div>
</div>

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<!-- <script src="assets/assets/bundles/dataTables.bundle.js"></script> -->

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<!-- <script src="assets/js/table/datatable.js"></script> -->
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<script>
    $(document).ready( function () {
        $('.js-example-basic-single').select2();
    } );
</script>

<?php if($user_role=='1'){ ?>
<script>
    $(document).ready( function () {
        $('#vehicleTable').DataTable({
            "order": [[ 0, "desc" ]],
            "scrollX": true,
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                'print', 'excel', 'pdf'
            ]
        });
        
    } );
</script>
<?php }else{ ?>
<script>
    $(document).ready( function () {
        $('#vehicleTable').DataTable({
            "order": [[ 0, "desc" ]],
            //"scrollX": true
        });
    } );
</script>
<?php } ?>

    <script>
        
        $(document).on('submit', '#Update-Form', function(e){
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

                url:"post/update_vehicles.php",
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
                      text:'Successfully Updated.'
                    });


                    setTimeout(function () {
                        window.location.href = "all_vehicles.php";
                       // location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

</body>
</html>
<?php } ?>