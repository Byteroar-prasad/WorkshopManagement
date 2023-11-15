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

        <style>
            .select2-container .select2-selection--single {
                height: 34px !important;
                border-color: #E8E9E9 !important; 
                font-size: 14px !important;
            }
        </style>

        <div class="section-body">
            <div class="container-fluid">
             
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Stock</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="stockTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>GRN</th>
                                                <th>Part Quantity</th>
                                                <th>Remark</th>
                                                <th>Part Selling Price (.Rs)</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                  $total_cost = 0;
                                                  $total_selling = 0;
                                                  $sql = "SELECT * FROM tbl_item ORDER BY item_id DESC";
                                                  $rs=$conn->query($sql);
                                                  while($row =$rs->fetch_array())
                                                  {
                                                    $part_name = $row[1];
                                                    $part_location = $row[2];
                                                    $part_number = $row[3];
                                                    $part_cost = $row[4];
                                                    $part_selling = (double)$row[5];
                                                    $part_discount = $row[6];
                                                    $part_quantity = $row[7];
                                            ?>
                                            <?php if($part_quantity<=10){ ?>
                                            <tr class="gradeA" style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr class="gradeA" style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $row[0]; ?></td> 
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><b>Normal</b></td>
                                                <td><?php echo $row[7]; ?></td>
                                                <td><?php echo $row[8]; ?></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($part_selling,2); ?></b></td>
                                            </tr>
                                            
                                            <?php } ?>
                                            
                                            <?php

                                                $total_cost_batch = 0;
                                                $total_selling_batch = 0;
                                                $Batchsql = "SELECT * FROM tbl_item ti INNER JOIN tbl_item_price_batch tipb ON ti.item_id=tipb.item_id ORDER BY ti.item_id DESC ";
                                                $Irs=$conn->query($Batchsql);
                                                while($Irow =$Irs->fetch_array())
                                                {
                                                    $item_id = $Irow[0];
                                                    $part_name = $Irow[1];
                                                    $part_location = $Irow[2];
                                                    $part_number = $Irow[3];
                                                    $part_remark = $Irow[8];
                                                    
                                                    $GRN = $Irow[13];
                                                    $CostBatchPrice = (double)$Irow[14];
                                                    $SellingBatchPrice = (double)$Irow[15];
                                                    $BatchQty = $Irow[16];

                                                    $total_cost_batch += $CostBatchPrice * $BatchQty;
                                                    $total_selling_batch += $SellingBatchPrice * $BatchQty;

                                                


                                            ?>

                                            <?php if($BatchQty<=10){ ?>
                                            <tr class="gradeA" style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr class="gradeA" style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $item_id; ?></td> 
                                                <td><?php echo $part_name; ?></td>
                                                <td><?php echo $part_number; ?></td>
                                                <td><b><?php echo $GRN; ?></b></td>
                                                <td><?php echo $BatchQty; ?></td>
                                                <td><?php echo $part_remark; ?></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($SellingBatchPrice,2); ?></b></td>
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
<script src="assets/assets/bundles/selectize.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/vendors/selectize.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script>
    $(document).ready( function () {
        $('#stockTable').DataTable();
        $('.js-example-basic-single').select2();
    } );
</script>

   
</body>
</html>
