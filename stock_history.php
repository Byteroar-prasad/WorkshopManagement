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
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">


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
                                <h3 class="card-title">Stock Buying History</h3>
                            </div>
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="buyinghistoryTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>GRN</th>
                                                <th>Part Quantity</th>
                                                <th>Part Cost (.Rs)</th>
                                                <th>Part Cost Total (.Rs)</th>
                                                <th>Part Selling Price (.Rs)</th>
                                                <th>Stock Date</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                              $total_history_cost = 0;
                                              $total_history_selling = 0;
                                              $total_cost_one_item = 0;
                                              $sql = "SELECT * FROM tbl_item_history tih INNER JOIN tbl_item ti ON tih.item_id=ti.item_id ORDER BY tih.item_history_id ASC";
                                              $rs=$conn->query($sql);
                                              while($row =$rs->fetch_array())
                                              {
                                                $item_history_id=$row[0];
                                                $item_id=$row[1];
                                                $item_quantity=$row[2];
                                                $item_cost=(double)$row[3];
                                                $item_selling_price=(double)$row[4];
                                                $item_price_batch_id=$row[5];
                                                $item_history_datetime=$row[6];

                                                $part_name = $row[8];
                                                $part_location = $row[9];
                                                $part_number = $row[10];

                                                $total_cost_one_item = (double)$item_cost * (double)$item_quantity;

                                                $total_history_cost += (double)$item_cost * (double)$item_quantity;
                                                $total_history_selling += (double)$item_selling_price * (double)$item_quantity;
                                            
                                            
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $item_history_id; ?></td> 
                                                <td><?php echo $part_name; ?></td>
                                                <td><?php echo $part_number; ?></td>
                                                <td>
                                                    <?php
                                                    if ($item_price_batch_id == 0) { ?>
                                                        NORMAL
                                                    <?php }else{ ?>
                                                        <?php
                                                            $priceBatchsql = "SELECT * FROM tbl_item_price_batch WHERE item_id='$item_id' AND price_batch_id= '$item_price_batch_id' ";
                                                            $Prs=$conn->query($priceBatchsql);
                                                            if($Prow =$Prs->fetch_array())
                                                            {
                                                                $GRN = $Prow[2];
                                                            }
                                                        ?>
                                                        <?php echo $GRN; ?> 
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $item_quantity; ?></td>
                                                <td style="color: #FF0000;"><b style="float: right;"><?php echo number_format($item_cost,2); ?></b></td>
                                                <td style="color: #FF0000;"><b style="float: right;"><?php echo number_format($total_cost_one_item,2); ?></b></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($item_selling_price,2); ?></b></td>
                                                <td><?php echo $item_history_datetime; ?></td>
                                                <td>
                                                    <form id="Delete-Stock" method="POST">
                                                        <input type="hidden" class="form-control" name="item_history_id" id="item_history_id" value="<?php echo $item_history_id; ?>" required readonly>
                                                        <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $item_id; ?>" required readonly>
                                                        <input type="hidden" class="form-control" name="item_quantity" id="item_quantity" value="<?php echo $item_quantity; ?>" required readonly>
                                                        <input type="hidden" class="form-control" name="price_batch_id" id="price_batch_id" value="<?php echo $item_price_batch_id; ?>" required readonly>
                                                        <button type="submit" class="btn text-white bg-red btn-xs deletestock pull-right"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>
                                        <!-- <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th style="color: #FF0000;"><b style="float: right; font-size: 25px;"><?php //echo number_format($total_history_cost,2); ?></b></th>
                                                <th style="color: #008000;"><b style="float: right; font-size: 25px;"><?php //echo number_format($total_history_selling,2); ?></b></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot> -->
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

<script>
    $(document).ready( function () {
        $('#buyinghistoryTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>

    <script>
        
        $(document).on('submit', '#Delete-Stock', function(e){
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

                url:"post/delete_stock.php",
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
                      text:'Successfully Stock Removed.'
                    });


                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

</body>
</html>