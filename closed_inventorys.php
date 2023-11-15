<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentYear=date('Y');
    
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
                                <h3 class="card-title">Closed Inventorys</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="closedinventorysTable">
                                        <thead>
                                            <tr>
                                                <th>Job Number</th>
                                                <th></th>
                                                <th>Customer Name</th>
                                                <th>License Number</th>
                                                <th>Telephone Number</th>
                                                <th>Vehicle Model</th>
                                                <th>Mileage</th>
                                                <th>Registration Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql = "SELECT * FROM `tbl_vehicle_details` WHERE (stat='2' OR stat='9')";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
         
                                                    $reg_date = date('d-m-Y', strtotime($row[2])) ;
                                                    $JobYear = date('Y', strtotime($row[2]));
                                                    
                                                    $wiper_blades = $row[26];
                                                    
                                                    $wiper_blades_remark=$row[27];
                                                    $windows_glass=$row[28];
                                                    $windows_glass_remark=$row[29];
                                                    $replace_microfilter=$row[30];
                                                    $replace_microfilter_remark=$row[31];
                                                    $coolant=$row[32];
                                                    $coolant_remark=$row[33];
                                                    $engine_oil=$row[34];
                                        
                                        
                                                    $engine_oil_remark=$row[35];
                                                    $v_belt=$row[36];
                                                    $v_belt_remark=$row[37];
                                                    $noticeble_leaks=$row[38];
                                                    $noticeble_leaks_remark=$row[39];
                                                    $damage_animals=$row[40];
                                                    $damage_animals_remark=$row[41];
                                                    $annual_check=$row[42];
                                        
                                                    $shock=$row[43];
                                                    $shock_remark=$row[44];
                                                    $tyre_tread=$row[45];
                                                    $tyre_tread_remark=$row[46];
                                                    $engine_gearbox=$row[47];
                                                    $engine_gearbox_remark=$row[48];
                                                    $front_axle=$row[49];
                                                    $front_axle_remark=$row[50];
                                        
                                                    $front_brake=$row[51];
                                                    $front_brake_remark=$row[52];
                                                    $rear_axle=$row[53];
                                                    $rear_axle_remark=$row[54];
                                                    $rear_brake=$row[55];
                                                    $rear_brake_remark=$row[56];
                                                    $brake_lines=$row[57];
                                                    $brake_lines_remark=$row[58];
                                        
                                        
                                                    $exhaust_system=$row[59];
                                                    $exhaust_system_remark=$row[60];
                                                    $fuel_tank=$row[61];
                                            
                                            ?>
                                            <tr class="gradeA">
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;">BAE/JOB/<?php echo $JobYear; ?>/<?php echo (10000+$row[0]); ?></a></td>
                                                <td>
                                                    <button type="button" onclick="location.href='single?v_id=<?php echo base64_encode($row[0]); ?>'" class="btn btn-success waves-effect waves-light">View</button>
                                                </td>
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[3]; ?></a></td>
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[10]; ?></a></td>
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[4]; ?></a></td>
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[8]; ?></a></td>
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[11]; ?></a></td>
                                                <td><a href="single.php?v_id=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $reg_date; ?></a></td>
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
        $('#closedinventorysTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>



</body>
</html>