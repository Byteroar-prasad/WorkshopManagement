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
<!--<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />-->
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
                        
                         <h4>Users</h4>
                        
                        <form class="card" id="Update-Stock">
                            <div class="card-body">
                                <h3 class="card-title">Create Users</h3>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Type Name <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" placeholder="John Doe" name="name" id="name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Email <font style="color: #FF0000;">*</font></label>
                                            <input type="email" class="form-control" placeholder="xxxxx@gmail.com" name="email" id="email" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Password <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" placeholder="Password" name="password" id="password" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Confirm Password <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" placeholder="Confirm Password" name="cpassword" id="confirm_password" required>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Contact Number <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" placeholder="Contact Number" name="tel" id="tel" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">User Role <font style="color: #FF0000;">*</font></label>
                                            <select class="form-control" id="role" name="role">
                                                <option value="0" selected>Service Advisor</option>
                                                <option value="1">Super Admin</option>
                                                <option value="2">Stores</option>
                                                <option value="3">Accounts</option>
                                                <option value="4">Finance</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" name="register" class="btn btn-primary log">Create Account</button>
                            </div>
                        </form>





                    </div>
                    
                </div>




                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Users List</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="stockTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Role</th>
                                                <th>Telephone Number</th>
                                                <th>Register Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                                $sql = "SELECT `user_id`, `name`, `email`, `password`, `role`, `tel`, `create_date` FROM `users_login` ";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $login_id = $row[0];
                                                    $role = $row[4];
                                                    $email = $row[2];
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $row[0]; ?></td>
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><b><?php if ($role=="1") {  echo "Super Admin"; }else if($role=="0"){ echo "Service Advisor"; }else if($role=="2"){ echo "Stores"; }else{ echo "Accounts"; } ?></b></td>
                                                <td><?php echo $row[5]; ?></td>
                                                <td><?php echo $row[6]; ?></td>
                                                <td>
                                                    <?php if ($email!=='admin@mail.com') { ?>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <form method="POST" action="controls/delete_user.php?login_id=<?php echo $login_id; ?>" >
                                                                <input type="hidden" name="login_id" id="login_id" value="<?php echo $login_id; ?>">
                                                                <button class="btn btn-danger">Remove</button>
                                                            </form>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#PswChangeModalCenter<?php echo $row[0]; ?>">
                                                              Password Change
                                                            </button>
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                    <!--Psw Change Modal -->
                                                    <div class="modal fade" id="PswChangeModalCenter<?php echo $row[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Password Chnage <?php echo $row[1]; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <form id="Psw-Update" method="POST">
                                                              <div class="modal-body">
                                                                <div class="col-md-12">
                                                                    <div class="form-group">
                                                                        <input type="hidden" name="user_id" id="user_id" value="<?php echo $login_id; ?>">
                                                                        <label class="form-label">Type New Password <font style="color: #FF0000;">*</font></label>
                                                                        <input type="text" class="form-control" placeholder="Type New Password" name="password" id="password" required>
                                                                    </div>
                                                                </div>
                                                              </div>
                                                              <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary">Save changes</button>
                                                              </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                    
                                                    
                                                    
                                                    <?php }else{}?>
                                                </td>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="assets/js/themechanger.js"></script>

<script>
    $(document).ready( function () {
        $('#stockTable').DataTable();
    } );
</script>

    <script type="text/javascript">
        $(function() {
            $(".log").click(function() {
                var name = $("#name").val();
                var email = $("#email").val();
                var role = $("#role").val();
                var tel = $("#tel").val();
                var password = $("#password").val();
                var confirm_password = $("#confirm_password").val();
                //var dataString = 'name='+ name + 'email='+ email + '&confirm_password=' + confirm_password + 'role='+ role ;
                var data = {
                  'name': name,
                  'role' : role, 
                  'tel' : tel,
                  'email' : email, 
                  'confirm_password' : confirm_password
                }
                
                //debugger;
                if(name=='' || email=='' || password=='' || confirm_password=='' || (password !=confirm_password) || role=='' || tel=='')
                {
                    swal("Sorry !", "Couldn't create your account !", "error");
                }
                
                else
                {
                    $.ajax({
                        type: "POST",
                        url: "controls/join.php",
                        data: {
                        'name': name,
                        'role' : role, 
                        'tel' : tel,
                        'email' : email, 
                        'confirm_password' : confirm_password
                      },
                        success: function(data){
                            //debugger;

                            //$('.success').fadeIn(200).show();
                            //$('.error').fadeOut(200).hide();
                            swal("Thanks !","Your account is created !"+" "+"Redirecting you to login","success", {button:false});


                            setTimeout(function () {
                                location.reload();
                                //window.location.href = "index"; //will redirect to your blog page (an ex: blog.html)
                            }, 1000);
                        }
                    });
                }
                return false;
            });
        });
    </script> 
    
    
    
    <script>
        
        $(document).on('submit', '#Psw-Update', function(e){
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

                url:"post/update_user_psw.php",
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
                      text:'Successfully updated password.'
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