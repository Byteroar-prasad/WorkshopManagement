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
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
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
                                <h3 class="card-title">Sublet History</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="subletTable">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">#</th>
                                                <th>Job Number</th>
                                                <th>Description</th>
                                                <th><font style="float: right;">Cost Price (.Rs)</font></th>
                                                <th><font style="float: right;">Selling Price (.Rs)</font></th>
                                                <th>Sublet Added User</th>
                                                <th>Sublet Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="booking-area">

                                            <?php

                                                $sql = "SELECT * FROM tbl_job_sublet tjs INNER JOIN users_login ulo ON tjs.user_id=ulo.user_id INNER JOIN tbl_job_details tjd ON tjs.job_id=tjd.job_id ";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $SubletId = $row[0];
                                                    $SubletJobId = $row[1];
                                                    $SubletDescription = $row[2];
                                                    $SubletSellingPrice = $row[3];
                                                    $SubletUserId = $row[4];
                                                    $SubletDateTime = $row[5];
                                                    $SubletCostPrice = $row[6];
                                                    $SubletRemark = $row[7];
                                                    /////////////////////////
                                                    $UserAccountName = $row[9];
                                                    /////////////////////////
                                                    $JobDate = $row[17];
                                                    $JobYear = date('Y', strtotime($JobDate)) ;
                                            
                                            ?>
                                            <tr class="gradeA">
                                                <td style="display: none;"><?php echo $SubletId; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $SubletId; ?>" style="cursor: pointer;">BAE/JOB/<?php echo $JobYear; ?>/<?php echo $SubletJobId+10000; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $SubletId; ?>" style="cursor: pointer;"><?php echo $SubletDescription; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $SubletId; ?>" style="cursor: pointer;"><font style="float: right; color: #FF0000; font-weight: 600;"><?php echo number_format($SubletCostPrice,2); ?></font></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $SubletId; ?>" style="cursor: pointer;"><font style="float: right; color: #03AC13; font-weight: 600;"><?php echo number_format($SubletSellingPrice,2); ?></font></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $SubletId; ?>" style="cursor: pointer;"><?php echo $UserAccountName; ?></td>
                                                <td data-toggle="modal" data-target="#NoteModalCenter<?php echo $SubletId; ?>" style="cursor: pointer;"><?php echo $SubletDateTime; ?></td>
                                            </tr>
                                            
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="NoteModalCenter<?php echo $SubletId; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $SubletDescription; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <div class="modal-body">
                                                    <?php echo nl2br($SubletRemark); ?>
                                                  </div>
                                                  <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <!--<button type="button" class="btn btn-primary">Save changes</button>-->
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>

<script src="assets/js/themechanger.js"></script>


<script>
    $(document).ready( function () {
        $('#subletTable').DataTable({
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