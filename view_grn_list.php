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
                                <h3 class="card-title">Goods Received Note (GRN) List</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="grnTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>GRN Number</th>
                                                <th>GRN Type</th>
                                                <th>Invoice Number</th>
                                                <th>Supplier Name</th>
                                                <th>Goods Received Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $GRNsql = "SELECT * FROM tbl_grn_details tgd INNER JOIN tbl_supplier tsu ON tgd.supplier_id=tsu.supplier_id WHERE tgd.stat='1' ";
                                                $rs=$conn->query($GRNsql);
                                                while($GRNrs =$rs->fetch_array())
                                                {   
                                                    $GRNDetailId=$GRNrs[0];
                                                    $SupplierId=$GRNrs[1];
                                                    $CreateUserName=$GRNrs[2];
                                                    $CreateUserId=$GRNrs[3];
                                                    $InvoiceNumber=$GRNrs[4];
                                                    $GRNNumber=$GRNrs[5];
                                                    $GoodsReceivedDate=$GRNrs[6];
                                                    $Note=$GRNrs[7];
                                                    $Stat=$GRNrs[8];
                                                    $GRNDateTime=$GRNrs[9];
                                                    
                                                    if($GRNNumber == '0'){
                                                        $GRNType = 'Local';
                                                    }else{
                                                        $GRNType = 'International';
                                                    }
                                                    
                                                    $GRNYear = date('Y', strtotime($GRNDateTime)) ;

                                                    /////////////////////////////////

                                                    $SupplierName=$GRNrs[11];
                                                    $SupplierCompanyName=$GRNrs[12];
                                                    $SupplierAddress=$GRNrs[13];
                                                    $SupplierPhoneNumber=$GRNrs[14];
                                                    $SupplierEmail=$GRNrs[15];
                                                    $SupplierStat=$GRNrs[16];
                                                    $SupplierDateTime=$GRNrs[17];
                                            
                                            ?>
                                            <tr class="gradeA" onclick="location.href='grn_invoice_view?g=<?php echo (base64_encode($GRNDetailId)); ?>'" style="cursor: pointer;">
                                                <td><?php echo $GRNDetailId; ?></td>
                                                <td>BAE/GRN/<?php echo $GRNYear; ?>/<?php echo 10000+$GRNDetailId;?></td>
                                                <td><?php echo $GRNType; ?></td>
                                                <td><?php echo $InvoiceNumber; ?></td>
                                                <td><?php echo $SupplierName; ?></td>
                                                <td><?php echo $GoodsReceivedDate; ?></td>
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
        $('#grnTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>

</body>
</html>