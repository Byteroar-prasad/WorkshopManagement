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
                                <h3 class="card-title">Unsaved Invoice</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="clientTable">
                                        <thead>
                                            <tr>
                                                <th>Job ID</th>
                                                <th></th>
                                                <th>Invoice Number</th>
                                                <th>Customer Name</th>
                                                <th>License Number</th>
                                                <th>Telephone Number</th>
                                                <th>Invoice Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql ="SELECT * FROM `tbl_vehicle_details` tvd INNER JOIN tbl_tax tt ON tvd.v_id=tt.job_id WHERE tvd.stat='2'";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                            
                                                    $job_id=$row[0];
                                                    $tax_id=$row[110];
                                                    $tax_datetime=$row[117];
                                                    $reg_date = date('d-m-Y', strtotime($tax_datetime));

                                                    //////////////////
                                                    $InvoiceNumber = 10000+$job_id;
                                                    ///////////////////
                                            
                                            ?>
                                            <tr class="gradeA">
                                                <td><?php echo $job_id; ?></td>
                                                <td>
                                                    <button type="button" onclick="location.href='invoice?i=<?php echo base64_encode($job_id); ?>'" class="btn btn-primary waves-effect waves-light">Invoice</button>
                                                </td>
                                                <td>BAE/IN/<?php echo $currentYear.'/'.$InvoiceNumber; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[10]; ?></td>
                                                <td><?php echo $row[4]; ?></td>
                                                <td><?php echo $reg_date; ?></td>
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
        $('#clientTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>



</body>
</html>