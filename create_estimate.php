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
<?php if ($user_role=='1' || $user_role=='0'){ ?>
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
                        
                         <h4>Estimate</h4>
                        
                        <form class="card" id="Estimate">
                            <div class="card-body">
                                <h3 class="card-title">Create Estimate</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Select License No. <font style="color: #FF0000;">*</font></label>
                                            <select class="js-example-basic-single form-control" name="license_no" onchange = "licenceChanged(this.value)" required>
                                                <option value="" selected disabled>Select License No.</option>
                                                <?php

                                                    $getDataForDate=$conn->query("SELECT * FROM tbl_vehicle");
                                                    while ($row=$getDataForDate->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[2];?>"><?php echo $row[2];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Mileage (Km)<font style="color: #FF0000;">*</font></label>
                                            <input type="number" class="form-control" name="mileage" id="mileage" placeholder="Mileage (Km)" required>
                                            <span style="font-size: 10px; color: #FF0000; cursor: pointer;">Auto fill Mileage came from last job of this selected license number</span>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Customer</label>
                                            <input type="text" class="form-control" id="customer" placeholder="Customer" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Telephone No.</label>
                                            <input type="text" class="form-control" id="phone_no" placeholder="Telephone No." readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" id="email" placeholder="Email" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Modal</label>
                                            <input type="text" class="form-control" id="model" placeholder="Modal" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Chassis No.</label>
                                            <input type="text" class="form-control" placeholder="Chassis No." id="chassis" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">First Reg. Date</label>
                                            <input type="text" class="form-control" id="f_reg_date" placeholder="First Reg. Date" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Estimate Description</label>
                                            <textarea class="form-control" name="note" rows="5" placeholder="Write your Estimate Note"></textarea>
                                        </div>
                                    </div>
                                    
                                    <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" required readonly>
                                    
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Next</button>
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
        function licenceChanged(licence){
           
          $.ajax({
              url:'estimate/get_vehicle_details.php',
              type:'POST',
              data:{
                  licence:licence
              },
              success:function(data){
                 
                 var json=JSON.parse(data);
        if(json.result){
            
            $("#client_id").val(json.client_id);
            $("#email").val(json.email);
            $("#customer").val(json.customer);
            $("#phone_no").val(json.phone_no);
            $("#model").val(json.model);
            $("#chassis").val(json.chassis);
            $("#f_reg_date").val(json.f_reg_date);
            $("#mileage").val(json.mileage);
            
            
        }
                 
              },
              error:function(data,err,xhr){
                  console.log(data+" "+err)
              }
              
          });
           
           
           
           
           
        }
    </script>

    <script>
        
        $(document).on('submit', '#Estimate', function(e){
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

                url:"estimate/submit_estimate.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    // swal("Thanks !","Successfully Added Your Details.","success");

                    var json=JSON.parse(data);
                    if(json.result){
                        var e_id = json.e_id;

                         setTimeout(function () {
                        
                        window.location.href = "estimate_card.php?e="+btoa(e_id);
                       //location.reload();
                    },1000);



                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:'Something went wrong, please try again.'
                    });
                    }

                    


                   

                }

            });

        return false;
        });
    </script>

</body>
</html>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php } ?>