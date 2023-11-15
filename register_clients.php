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
                        
                         <h4>Client Registration</h4>
                        
                        <form class="card" id="Register-Client-Form">
                            <div class="card-body">
                                <h3 class="card-title">Register Client Details</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Customer Or Company Name <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="name" placeholder="Customer Or Company Name" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Address </label>
                                            <input type="text" class="form-control" name="address" placeholder="Home Address">
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Telephone No. 
                                            <!--<span id="p-tel" style="color: black; text-align: right !important; position: absolute; right: 15px;"></span></label>-->
                                            <!--<input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Telephone No." oninput="return tel_check();" required>-->
                                            <input type="text" class="form-control" name="phone_no" id="phone_no" placeholder="Telephone No.">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Email Address 
                                            <!--<span id="p-email" style="color: black; text-align: right !important; position: absolute; right: 15px;"></span></label>-->
                                            <!--<input type="email" class="form-control" name="email" id="email" oninput="return email_check();" placeholder="Email Address" required>-->
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email Address">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Date <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="date" value="<?php echo date("Y-m-d"); ?>" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-5">
                                        <div class="form-group">
                                            <label class="form-label">Birthday Month </label>
                                                <select name="birthday_month" class="form-control">
                                                    <option disabled selected>Select Month</option>
                                                    <option value="January">January</option>
                                                    <option value="February">February</option>
                                                    <option value="March">March</option>
                                                    <option value="April">Aprilr</option>
                                                    <option value="May">May</option>
                                                    <option value="June">June</option>
                                                    <option value="July">July</option>
                                                    <option value="August">August</option>
                                                    <option value="September">September</option>
                                                    <option value="October">October</option>
                                                    <option value="November">November</option>
                                                    <option value="December">December</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-2">
                                        <div class="form-group">
                                            <label class="form-label">Birthday Date </label>
                                                <select name="birthday_date" class="form-control">
                                                    <option disabled selected>Select Date</option>
                                                    <option value="01">01</option>
                                                    <option value="02">02</option>
                                                    <option value="03">03</option>
                                                    <option value="04">04</option>
                                                    <option value="05">05</option>
                                                    <option value="06">06</option>
                                                    <option value="07">07</option>
                                                    <option value="08">08</option>
                                                    <option value="09">09</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                    <option value="13">13</option>
                                                    <option value="14">14</option>
                                                    <option value="15">15</option>
                                                    <option value="16">16</option>
                                                    <option value="17">17</option>
                                                    <option value="18">18</option>
                                                    <option value="19">19</option>
                                                    <option value="20">20</option>
                                                    <option value="21">21</option>
                                                    <option value="22">22</option>
                                                    <option value="23">23</option>
                                                    <option value="24">24</option>
                                                    <option value="25">25</option>
                                                    <option value="26">26</option>
                                                    <option value="27">27</option>
                                                    <option value="28">28</option>
                                                    <option value="29">29</option>
                                                    <option value="30">30</option>
                                                    <option value="31">31</option>
                                                </select> 
                                        </div>
                                    </div>
                                    
                                    <div class="col-sm-6 col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">How did they hear about us? <font style="color: #FF0000;">*</font></label>
                                            <select name="how_to_know" class="form-control" required>
                                                <option disabled>Select How did they hear about us?</option>
                                                <option value="Friend" selected>Friend</option>
                                                <option value="Facebook">Facebook</option>
                                                <option value="Instergram">Instergram</option>
                                                <option value="News Paper">News Paper</option>
                                                <option value="Other Website">Other Website</option>
                                                <option value="Other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Register Client</button>
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

<script src="assets/js/themechanger.js"></script>

<script>

        
        $(document).on('submit', '#Register-Client-Form', function(e){
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

                url:"post/submit_client.php",
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
                      text:'Successfully Register Client.'
                    });


                    setTimeout(function () {
                        window.location.href = "all_clients.php";
                       // location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <script>
        // function email_check()
        // {
        //     var email=document.getElementById('email').value;
        //     var dataString='email='+  email;
        //     $.ajax({

        //         type:"post",
        //         url: "controls/email_check.php",
        //         data:dataString,
        //         cache: false,

        //         success: function(html1) {

        //             $('#p-email').html(html1);
        //             return d = true;
        //         }

        //     });

        //     return false;
        // }

        // function tel_check()
        // {
        //     var phone_no=document.getElementById('phone_no').value;
        //     var dataString='phone_no='+  phone_no;
        //     $.ajax({

        //         type:"post",
        //         url: "controls/tel_check.php",
        //         data:dataString,
        //         cache: false,

        //         success: function(html1) {

        //             $('#p-tel').html(html1);
        //             return d = true;
        //         }

        //     });

        //     return false;
        // }
    </script>

</body>
</html>