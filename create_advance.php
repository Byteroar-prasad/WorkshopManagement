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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

        <style>
            .select2-container .select2-selection--single {
                height: 34px !important;
                border-color: #E8E9E9 !important; 
                font-size: 14px !important;
            }
        </style>

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
                        
                         <h4>Advance Payment</h4>
                        
                        <form class="card" id="Form-Advance-Payment">
                            <div class="card-body">
                                <h3 class="card-title">Create Advance Payment Receipt</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Select License No<font style="color: #FF0000;">*</font></label>
                                            <select class="js-example-basic-single form-control" id="1" name="license_no" style="width: 100%;" required>
                                                <option value="" selected disabled>Select License No</option>
                                                <?php

                                                    $LicenseNumberQuery=$conn->query("SELECT DISTINCT license_no FROM tbl_vehicle");
                                                    while ($row=$LicenseNumberQuery->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Note </label>
                                            <textarea class="form-control" name="note" rows="5"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Advance Payment (Rs.) <font style="color: #FF0000;">*</font></label>
                                            <input type="number" class="form-control" name="advance_payment" placeholder="Advance Payment (Rs.)" min="0" required>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Payment</button>
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

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

    <script type="text/javascript">
       
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        
        $(document).on('submit', '#Form-Advance-Payment', function(e){
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

                url:"post/submit_advance_receipt.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var jason=JSON.parse(data);

                    if (jason.result) {

                        Swal.fire({
                          title:'Thanks !',
                          icon:'success',
                          text:'Successfully Created Advance.'
                        });

                        setTimeout(function () {
                            window.open(
                                          'advance_receipt?a='+jason.data,'_blank' // <- This is what makes it open in a new window.
                                        );
                            
                           window.location.href = "index";
                        },1000);
                    }else{
                        Swal.fire({
                          title:'Warning !',
                          icon:'warning',
                          text:'Something went wrong.'
                        });
                    }
                    
                    

                }

            });

        return false;
        });
    </script>

</body>
</html>