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
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        
                         <h4>Vehicle Registration</h4>
                        
                        <form class="card" id="Register-Vehicle-Form">
                            <div class="card-body">
                                <h3 class="card-title">Register Vehicle Details</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Select Customer Or Company Name <font style="color: #FF0000;">*</font></label>
                                            <select class="js-example-basic-single form-control" name="client_id" style="width: 100%;" required>
                                                <option value="" selected disabled>Select Customer Or Company Name</option>
                                                <?php

                                                    $clientNamesQuery=$conn->query("SELECT DISTINCT client_id,name,idcard_number,phone_no FROM tbl_client");
                                                    while ($row=$clientNamesQuery->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[3];?>)</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">License No. <font style="color: #FF0000;">*</font><span id="p-license-no" style="color: black; text-align: right !important; position: absolute; right: 15px;"></span></label>
                                            <input type="text" class="form-control" name="license_no" id="license_no" placeholder="License No." oninput="return license_no_check();" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Vehicle Model <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="vehicle_modal" id="vehicle_modal" placeholder="Vehicle Model" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Chassis No. <font style="color: #FF0000;">*</font><span id="p-chassis-no" style="color: black; text-align: right !important; position: absolute; right: 15px;"></span></label>
                                            <input type="text" class="form-control" name="chassis_no" id="chassis_no" placeholder="Chassis No." oninput="return chassis_no_check();" required>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" rows="10" name="note" placeholder="Write Note"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Register Vehicle</button>
                            </div>
                        </form>


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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="assets/js/themechanger.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        function license_no_check()
        {
            var license_no=document.getElementById('license_no').value;
            var dataString='license_no='+  license_no;
            $.ajax({

                type:"post",
                url: "controls/license_no_check.php",
                data:dataString,
                cache: false,

                success: function(html1) {

                    $('#p-license-no').html(html1);
                    return d = true;
                }

            });

            return false;
        }

        function chassis_no_check()
        {
            var chassis_no=document.getElementById('chassis_no').value;
            var dataString='chassis_no='+  chassis_no;
            $.ajax({

                type:"post",
                url: "controls/chassis_no_check.php",
                data:dataString,
                cache: false,

                success: function(html2) {

                    $('#p-chassis-no').html(html2);
                    return d = true;
                }

            });

            return false;
        }
    </script>

    <script>
        
        $(document).on('submit', '#Register-Vehicle-Form', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});


                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Details is being sending...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },

                url:"post/submit_vehicles.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");



                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Created Ticket.'
                    });


                    setTimeout(function () {
                        window.location.href = "all_vehicles.php";
                       // location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>



</body>
</html>