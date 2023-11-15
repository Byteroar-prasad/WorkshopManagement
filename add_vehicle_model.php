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
<?php if ($user_role=='1' || $user_role=='0' || $user_role=='4'){ ?>
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
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        
                         <h4>Vehicle Models</h4>
                        
                        <form class="card" id="Add-Vehicle-Model">
                            <div class="card-body">
                                <h3 class="card-title">Add Vehicle Models</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Make <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="vehicle_make" id="vehicle_make" placeholder="Vehicle Make" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Model <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="vehicle_model" id="vehicle_model" placeholder="Vehicle Model" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Model Code <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="vehicle_model_code" id="vehicle_model_code" placeholder="Vehicle Model Code" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Model Variant <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="vehicle_model_variant" id="vehicle_model_variant" placeholder="Vehicle Model Variant" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" class="btn btn-primary">Add Vehicle Model</button>
                            </div>
                        </form>





                    </div>
                    
                </div>




                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Vehicle Models</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="vehiclemodelTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Make</th>
                                                <th>Model</th>
                                                <th>Model Code</th>
                                                <th>Model Variant</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $VehicleModelCount=0;
                                                $sql = "SELECT * FROM tbl_vehicle_model ORDER BY vehicle_model_id ASC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $ModelId = $row[0];
                                                    $MakeName = $row[1];
                                                    $Model = $row[2];
                                                    $ModelCode = $row[3];
                                                    $ModelVariant = $row[4];
                                            
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $VehicleModelCount+=1; ?></td> 
                                                <td><?php echo $MakeName; ?></td>
                                                <td><?php echo $Model; ?></td>
                                                <td><?php echo $ModelCode; ?></td>
                                                <td><?php echo $ModelVariant; ?></td>
                                                <!-- <td>
                                                    <form method="POST" id="Delete-Model">
                                                        <input type="hidden" name="model_id" value="<?php //echo $ModelId; ?>" required readonly>
                                                        <button type="submit" class="btn text-white bg-red">Delete</button>
                                                    </form>
                                                </td> -->
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
        $('#vehiclemodelTable').DataTable({
            // "order": [[ 0, "desc" ]]
        });
        $('.js-example-basic-single').select2();
    } );
</script>

    <script>
        
        $(document).on('submit', '#Add-Vehicle-Model', function(e){
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

                url:"post/add_model.php",
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
                      text:'Successfully Vehicle Model Added.'
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
    
    <!-- <script>
        
        $(document).on('submit', '#Delete-Labour', function(e){
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

                url:"post/delete_add_labour.php",
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
                      text:'Successfully Labour Deleted.'
                    });


                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script> -->
    
    
    



</body>
</html>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php } ?>