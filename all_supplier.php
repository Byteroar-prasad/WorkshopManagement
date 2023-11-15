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
<?php if ($user_role=='0'){ ?>

<script type="text/javascript">
    window.location.href="404.php";
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
                                <h3 class="card-title">Suppliers</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="supplierTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Supplier Name</th>
                                                <th>Supplier Company Name</th>
                                                <th>Phone Number</th>
                                                <th>Email</th>
                                                <th>Address</th>
                                                <th>Registration Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                              $sql = "SELECT * FROM `tbl_supplier` ORDER BY 'supplier_id' DESC ";
                                              $rs=$conn->query($sql);
                                              while($row =$rs->fetch_array())
                                              {
                                                $supplier_id = $row[0];
                                                $supplier_name = $row[1];
                                                $supplier_company_name = $row[2];
                                                $address = $row[3];
                                                $phone_no = $row[4];
                                                $supplier_email = $row[5];
                                                $stat = $row[6];
                                                $supplier_datetime = $row[7];
                                                $reg_date = date('d-m-Y', strtotime($supplier_datetime)) ;
                                            
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $supplier_id; ?></td> 
                                                <td><?php echo $supplier_name; ?></td>
                                                <td><?php echo $supplier_company_name; ?></td>
                                                <td><a href="tel:<?php echo $phone_no; ?>"><?php echo $phone_no; ?></a></td>
                                                <td><a href="mailto:<?php echo $supplier_email; ?>"><?php echo $supplier_email; ?></a></td>
                                                <td><?php echo $address; ?></td>
                                                <td><?php echo $reg_date; ?></td>
                                                <td class="actions">
                                                    <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="modal"
                                                    data-target="#exampleModalCenter<?php echo $supplier_id; ?>"><i class="icon-pencil" aria-hidden="true"></i></button>
                                                </td>
                                            </tr>


                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $supplier_id; ?>" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo $supplier_name; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           

                                                            <form id="Update-Supplier-Form" method="POST">
                                                                <input type="hidden" class="form-control" name="supplier_id" id="supplier_id" value="<?php echo $supplier_id; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="supplier_name">Supplier Name <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="supplier_name" id="supplier_name" placeholder="Supplier Name" value="<?php echo $supplier_name; ?>" required>

                                                                              </div>
                                                                              <div class="form-group">
                                                                                <label for="supplier_company_name">Supplier Company Name </label>
                                                                                <input type="text" class="form-control" name="supplier_company_name" id="supplier_company_name" placeholder="Supplier Company Name" value="<?php echo $supplier_company_name; ?>">

                                                                              </div>
                                                                              <div class="form-group">
                                                                                <label for="phone_no">Phone Number </label>
                                                                                <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Phone Number" value="<?php echo $phone_no; ?>">

                                                                              </div>
                                                                              
                                                                              

                                                                              
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="supplier_email">Email </label>
                                                                                <input type="email" class="form-control" name="supplier_email" id="supplier_email" placeholder="Email" value="<?php echo $supplier_email; ?>">
                                                                              </div>
                                                                              
                                                                        </div>


                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="address">Address <font style="color: #FF0000;">*</font></label>
                                                                                <textarea name="address" class="form-control"><?php echo $address; ?></textarea>
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
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

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
        $('#supplierTable').DataTable({
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
        $('#supplierTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>
<?php } ?>

<script>
        
        $(document).on('submit', '#Update-Supplier-Form', function(e){
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

                url:"post/update_supplier.php",
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
                      text:'Successfully Updated Supplier.'
                    });


                    setTimeout(function () {
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

</body>
</html>
<?php } ?>