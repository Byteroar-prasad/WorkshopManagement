<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    
    $user_id='';
    $user_name='';
    $user_email='';
    $user_role='';
    $user_tel='';


    if (isset($_SESSION['Logged']) && $_SESSION['Logged'] == true) 
    {

      $user_email = $_SESSION["email"];

      $getEmpQuery=$conn->query("SELECT user_id,name,email,role,tel FROM users_login WHERE email='$user_email' ");
      while ($emp=$getEmpQuery->fetch_array()) {

        $user_id = $emp['0']; 
        $user_name = $emp['1']; 
        $user_email = $emp['2']; 
        $user_role = $emp['3']; 
        $user_tel = $emp['4']; 
        

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

            <?php if ($user_role=='1' || $user_role=='4') { ?>
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        
                        <form class="card" id="Add-Fru" method="POST">
                            <div class="card-body">
                                <h3 class="card-title">Change FRU</h3>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="1">FRU Points <font style="color: #FF0000;">*</font></label>
                                            <input type="number" id="1" placeholder="FRU Points" value="1" class="form-control" required readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                          
                                          <div class="form-group">
                                            <label for="2">FRU Price (Rs.) <font style="color: #FF0000;">*</font></label>
                                            <input type="number" class="form-control" id="2" name="fru_pay" min="0" placeholder="FRU Price (Rs.)" required>
                                          </div>
                                    </div>

                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Add</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    
                </div>




                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">FRU History</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table mb-0" cellspacing="0" id="fruTable">
                                        <thead>
                                            <tr>
                                                <th>FRU Point</th>
                                                <th><font style="float: right;">FRU Pay (Rs.)</font></th>
                                                <th><font style="float: right;">Added Date</font></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql = "SELECT * FROM tbl_labour_paying ORDER BY labour_paying_id DESC";
                                                $GetFru=$conn->query($sql);
                                                while($gf =$GetFru->fetch_array())
                                                {
                                                    $fru_id = $gf[0];
                                                    $fru_point = $gf[1];
                                                    $fru_pay = $gf[2];
                                                    $added_date = date('d-m-Y', strtotime($gf[3])) ;
                                            
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $fru_point; ?></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($fru_pay,2); ?></b></td>
                                                <td><font style="float: right;"><?php echo $added_date; ?></font></td>
                                            </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            <?php }else { } ?>

                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <div class="card-body">
                                
                                <form id="Change-Pass" method="POST">

                                        <div class="row">

                                            <input type="hidden" name="user_id" value="<?php echo $user_id; ?>" class="form-control" required readonly>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="3">Email <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" id="3" placeholder="Email" value="<?php echo $user_email; ?>" class="form-control" required readonly>
                                                </div>
                                            </div>

                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="4">Contact Number <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" id="4" min="0" placeholder="Contact Number" name="tel" value="<?php echo $user_tel; ?>" class="form-control" required>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                  
                                                  <div class="form-group">
                                                    <label for="5">User Name <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" id="5" name="name" value="<?php echo $user_name; ?>" placeholder="User Name" required>
                                                  </div>
                                            </div>

                                            <div class="col-md-6">
                                                  
                                                  <div class="form-group">
                                                    <label for="6">New Password <font style="color: #FF0000;">*</font></label>
                                                    <input type="text" class="form-control" id="6" name="password" placeholder="New Password" required>
                                                  </div>
                                            </div>

                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                        </div>
                                    
                                </form>


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

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

        <script>
            $(document).ready( function () {
                $('#fruTable').DataTable();
            } );
        </script>

<script>
        
        $(document).on('submit', '#Add-Fru', function(e){
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

                url:"post/submit_fru_point.php",
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
                      text:'Successfully Added FRU.'
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

    <script>
        
        $(document).on('submit', '#Change-Pass', function(e){
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

                url:"post/update_password.php",
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
                      text:'Successfully Updated User Details.'
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