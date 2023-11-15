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
    window.location.href="404";
</script>

<?php }else{ ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
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
                                <h3 class="card-title">Requested Part Orders</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="RequestedpartOrderTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Requested Person Name</th>
                                                <th>Approved Person Name</th>
                                                <th>Status</th>
                                                <th>Registration Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                              $GetPartOrderDetailsSql = "SELECT * FROM `tbl_part_order` WHERE stat='2' ORDER BY 'part_order_id' DESC ";
                                              $GPODrs=$conn->query($GetPartOrderDetailsSql);
                                              while($row =$GPODrs->fetch_array())
                                              {
                                                $PartOrderId = $row[0];
                                                $RequestedPersonId = $row[1];
                                                $ApprovedPersonId = $row[2];
                                                $Priority = $row[3];
                                                $Stat = $row[4];
                                                $PartOrderDateTime = $row[5];
                                                $PartOrderDate = date('d-m-Y', strtotime($PartOrderDateTime));
                                                $PartOrderYear = date('Y', strtotime($PartOrderDateTime));

                                                $RequestedPersonDetailsSql = "SELECT name FROM `users_login` WHERE user_id='$RequestedPersonId'";
                                                $RPDrs=$conn->query($RequestedPersonDetailsSql);
                                                if($RPDrow =$RPDrs->fetch_array())
                                                {
                                                    $RequestedPersonName=$RPDrow[0];
                                                }
                                                $AcceptPersonDetailsSql = "SELECT name FROM `users_login` WHERE user_id='$ApprovedPersonId'";
                                                $APDrs=$conn->query($AcceptPersonDetailsSql);
                                                if($APDrow =$APDrs->fetch_array())
                                                {
                                                    $ApprovedPersonName=$RPDrow[0];
                                                }
                                            ?>
                                            <tr class="gradeA" onclick="location.href='part_order_view?g=<?php echo (base64_encode($PartOrderId)); ?>'" style="cursor: pointer;">
                                                <td>BAE/PO/<?php echo $PartOrderYear; ?>/<?php echo $PartOrderId+10000; ?></td> 
                                                <td><?php echo $RequestedPersonName; ?></td>
                                                <td><?php echo $ApprovedPersonName; ?></td>
                                                <td><font style="color: green; font-weight: 600;">Approved</font></td>
                                                <td><?php echo $PartOrderDate; ?></td>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<script>
    $(document).ready( function () {
        $('#RequestedpartOrderTable').DataTable({
            "order": [[ 0, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                'print', 'excel', 'pdf'
            ]
        });
    } );
</script>

</body>
</html>
<?php } ?>