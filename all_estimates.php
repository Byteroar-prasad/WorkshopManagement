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
                                <h3 class="card-title">All Estimates</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="estimateTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <!--<th></th>-->
                                                <th>License Number</th>
                                                <th>Customer Name</th>
                                                <th>Description</th>
                                                <th>Vehicle Model</th>
                                                <th>Mileage</th>
                                                <th>Registration Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql = "SELECT * FROM tbl_estimate_vehicle_number tevn INNER JOIN tbl_vehicle tv ON tevn.license_no=tv.license_no INNER JOIN tbl_client tc ON tv.client_id=tc.client_id ORDER BY tevn.estimate_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $EstimateNumber=$row[0];
                                                    $reg_date = date('d-m-Y', strtotime($row[3]));
                                                    $EstimateYear = date('Y', strtotime($reg_date));
                                                    
                                                    
                                                    $EstimateNoteGetSql = "SELECT * FROM tbl_estimate_tax WHERE estimate_id='$EstimateNumber'";
                                                    $ENGrs=$conn->query($EstimateNoteGetSql);
                                                    if($ENGrow =$ENGrs->fetch_array())
                                                    {
                                                        $EstimateNumber=$ENGrow[5];
                                                    }
                                            
                                            ?>
                                            <tr class="gradeA">
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;">BAE/ES/<?php echo $EstimateYear; ?>/<?php echo (10000+$row[0]); ?></a></td>
                                                <!--<td>
                                                    <button type="button" onclick="location.href='estimate_invoice?e=<?php //echo base64_encode($row[0]); ?>'" class="btn btn-primary waves-effect waves-light">View</button>
                                                </td>-->
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[1]; ?></a></td>
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[14]; ?></a></td>
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $EstimateNumber; ?></a></td>
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[8]; ?></a></td>
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $row[2]; ?></a></td>
                                                <td><a href="estimate_invoice.php?e=<?php echo base64_encode($row[0]); ?>" style="color: #000;"><?php echo $reg_date; ?></a></td>
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

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<?php if($user_role=='1'){ ?>
<script>
    $(document).ready( function () {
        $('#estimateTable').DataTable({
            "order": [[ 0, "desc" ]],
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
        $('#estimateTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>
<?php } ?>



</body>
</html>