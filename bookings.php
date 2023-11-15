<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentYear=date('Y');
    $currentDate=date('Y-m-d');
    // $currentDate=date('2022-02-09');
    
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
<!-- Plugins css -->
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
                
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Bookings</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="pendingjobsTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>License Number</th>
                                                <th>Customer Name</th>
                                                <th>Contact Number</th>
                                                <th>Email</th>
                                                <th>Booking Date & Time</th>
                                                <th>Category</th>
                                            </tr>
                                        </thead>
                                        <tbody id="booking-area">

                                            <?php

                                                $sql = "SELECT * FROM `tbl_booking_web` ";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $BookingId = $row[0];
                                                    $BookingName = $row[1];
                                                    $BookingPhone = $row[2];
                                                    $BookingEmail = $row[3];
                                                    $BookingLicenseNumber = $row[4];
                                                    $BookingDate = $row[5];
                                                    $BookingTime = $row[6];
                                                    $BookingCategory = $row[7];
                                                    $BookingNote = $row[8];
                                                    $BookingStat = $row[9];
                                                    $BookingDateTime = $row[10];
                                            
                                            ?>
                                            <?php if($BookingDate < $currentDate){ }else{?>
                                            <tr class="gradeA">
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo $BookingId; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo $BookingLicenseNumber; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo $BookingName; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo $BookingPhone; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo $BookingEmail; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo 'D- '.$BookingDate.' T- '.$BookingTime; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $BookingId; ?>" style="cursor: pointer;"><?php echo $BookingCategory; ?></td>
                                            </tr>
                                            
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="NoteModalCenter<?php echo $BookingId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Customer Message</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <?php echo nl2br($BookingNote); ?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                                                  </div>
                                                </div>
                                              </div>
                                            </div>
                                            
                                            
                                            <?php } } ?>

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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>


<script>
    $(document).ready( function () {
        $('#pendingjobsTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>

</body>
</html>