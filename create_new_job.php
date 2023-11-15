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
                        
                         <h4>Job</h4>
                        
                        <form class="card" id="Create-Job">
                            <div class="card-body">
                                <h3 class="card-title">Create JOB</h3>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        
                                          <div class="form-group">
                                            <label class="form-label">License No. <font style="color: #FF0000;">*</font></label>

                                            <select class="js-example-basic-single form-control" name="reg_license_no" onchange = "licenceChanged(this.value)" required>
                                                <option value="" selected disabled>Select License No.</option>
                                                <?php

                                                    $getDataForDate=$conn->query("SELECT * FROM tbl_vehicle");
                                                    while ($row=$getDataForDate->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[2];?>"><?php echo $row[2];?></option>
                                                <?php } ?>
                                            </select>     
                                          </div>
                                          
                                          <input type="hidden" class="form-control" name="client_id" id="client_id" placeholder="Client Id" readonly>
                                          <input type="hidden" class="form-control" name="user_name" value="<?php echo $user_name; ?>" readonly>
                                          <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" readonly>

                                          <div class="form-group">
                                            <label class="form-label">Date</label>
                                            <input type="date" class="form-control" id="2" value="<?php echo date("Y-m-d"); ?>" name="reg_date" placeholder="Date" readonly required>
                                          </div>
                                          <div class="form-group">
                                            <label class="form-label">Customer</label>
                                            <input type="text" class="form-control" name="reg_customer" id="customer" placeholder="Customer" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label class="form-label">Telephone No.</label>
                                            <input type="text" class="form-control" name="reg_phone_no" id="phone_no" placeholder="Telephone No." readonly>
                                          </div>
                                          <!-- <div class="form-group"> -->
                                            <!-- <label for="5">First Reg. Date</label> -->
                                            <input type="hidden" class="form-control" name="f_reg_date" id="f_reg_date" placeholder="First Reg. Date" readonly>
                                          <!-- </div> -->
                                          
                                          
                                        
                                    </div>

                                    <div class="col-md-6">
                                          <div class="form-group">
                                            <label class="form-label">Mileage/Km <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="reg_mileage" id="millage" placeholder="Mileage/Km" required>
                                          </div>
                                       
                                          <div class="form-group">
                                            <label class="form-label">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label class="form-label">Modal</label>
                                            <input type="text" class="form-control" name="reg_model" id="model" placeholder="Modal" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label class="form-label">Chassis No.</label>
                                            <input type="text" class="form-control" name="reg_chassis_no" placeholder="Chassis No." id="chassis" readonly>
                                          </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Description</label>
                                            <textarea class="form-control" value="" name="comments" rows="10"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Create Job</button>
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
              url:'controls/get_vehicle_details.php',
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
            
            
        }
                 
              },
              error:function(data,err,xhr){
                  console.log(data+" "+err)
              }
              
          });
           
           
           
           
           
        }
    </script>

    <script>
        
        $(document).on('submit', '#Create-Job', function(e){
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

                url:"post/submit_job.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json=JSON.parse(data);
                    if(json.result){
                        var j_id = json.j_id;

                         setTimeout(function () {
                        
                        window.location.href = "job_card.php?j="+btoa(j_id);
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