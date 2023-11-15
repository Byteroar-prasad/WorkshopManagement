<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');

    $AdvanceId = base64_decode($_GET['a']);
    
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

<?php 

    $sql = "SELECT * FROM tbl_advance ta INNER JOIN tbl_vehicle tav ON ta.license_number=tav.license_no INNER JOIN tbl_client tc ON tav.client_id=tc.client_id WHERE ta.advance_id= '$AdvanceId' ";
    // $sql = "SELECT * FROM tbl_vehicle_details tvd INNER JOIN tbl_advance ta ON tvd.v_id=ta.job_id INNER JOIN tbl_client tc ON tvd.reg_email=tc.email WHERE ta.advance_id= '$AdvanceId' ";
    // $sql = "SELECT * FROM tbl_invoice WHERE invoice_id= '$InvoiceId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $advance_id = $row[0];
            // $job_date = $row[2];

            ///////////////////////////////

            $customer=$row[16];
            $email=$row[17];
            $phone_number=$row[20];
            $client_address=$row[22];
            
            //////////////////////////////


            $licens_no=$row[2];
            $chassis_no=$row[11];
            // $mileage=$row[11]; 

            ////////////////////////////////


            $note=$row[3];
            $advance_payment=$row[4];
            $advance_stat=$row[5];
            $advance_date=$row[6];


            $AdvanceYear = date('Y', strtotime($advance_date));
            // $JobYear = date('Y', strtotime($job_date));

           

        }
    ?>
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

                        <style>
                          @media print {
                            @page {
                              size: auto;   /* auto is the initial value */
                              size: A4 portrait;
                              margin: 0;  /* this affects the margin in the printer settings */
                              border: 1px solid red;  /* set a border for all printed pages */
                            }
                            body {
                                zoom: 70%;
                                transform: scale(.9);
                                /*margin-top: -320px;*/
                                width: 100%;
                                margin-top: 50px;
                            }
                            body::before {
                                background: transparent;
                            }
                            #print-page{
                                margin-left: -320px;
                                background-color: #fff !important;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #topnav{
                                display: none;
                            }
                            #sidenav{
                                /*visibility: hidden !important;*/
                                display: none !important;
                            }
                            #footer{
                                display: none;
                            }
                            #invoice{
                                display: none;
                            }
                            #print-table1{
                                width:40%; 
                                float:left;
                            }
                            #print-table2{
                                float:right;
                                width:40%;
                                margin-left: 180px;
                            }
                            #print-p{
                                width:100%;
                                /*margin-top: 100px;*/
                            }
                            #print-table4{
                                border: 1px solid #E6E8EB !important;
                            }
                            #print-table-total{
                                float:right;
                                width:50%;
                            }
                            #note{
                                float:left;
                                width:50%;
                            }
                            #hr1{
                                display: none;
                            }
                            .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
                                border-color: #E6E8EB;
                                padding: 5px 5px;
                            }
                            #td{
                                border: 0px solid #fff !important;
                                /*border: 1px solid #000000 !important;*/
                            }
                            #price1{
                                width: 100%;
                                float: right;

                                /*display: none;*/
                            }
                            #logoimg{
                                margin-top: -180px;
                            }
                            #color-change-green{
                                background-color: #00B050 !important;
                            }
                            #color-change-green-new{
                                background-color: #00B050 !important;
                                color: #fff !important;
                            }
                            #baeimg{
                                width: 10% !important;
                            }
                            /*#print-table5>tbody>tr>td, #print-table5>tbody>tr>th, #print-table5>tfoot>tr>td, #print-table5>tfoot>tr>th, #print-table5>thead>tr>td, #print-table5>thead>tr>th {
                                border: 1px solid #000 !important;
                            }*/

                            /*#navigation-link{
                                display: none;
                            }
                            #inside-check-style{
                                margin-top: -50px;
                            }
                            #vehicle-engine-check-style{
                                margin-top: 150px;
                            }
                            #vehicle-condition-style{
                                margin-top: 210px;
                            }
                            #print-body{
                                background: #fff !important;
                            }
                            #th-style{
                                color: #000 !important;
                            }
                            #agreement-style{
                                margin-top: 150px;
                            }
                            #th-extra-style{
                                display: none;
                            }*/
                            
                          }
                        </style>                       


<!-- Start main html -->
<div id="main_content">
    
    <div id="sidenav">
        <?php include_once('controls/side_nav.php'); ?>
    </div>

    <!-- start main body part-->
    <div class="page">

        <!-- start body header -->
        <div id="topnav">
            <?php include_once('controls/top_nav.php'); ?>
        </div>

        <div class="section-body" id="print-page">
            <div class="container-fluid">
                <div class="row">
                    
                    <div class="col-md-12 col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-body">
                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">
                                                    

                                                    <div class="row">
                                                        <div class="col-md-8 text-left">
                                                            <img src="assets/BAE_Header.png" style="width: 70%;">
                                                            <br><br>
                                                            <h2 class="m-b-md m-t-xxs"><b>ADVANCE PAYMENT</b></h2>
                                                            
                                                            <?php if($user_role=='1'){ ?>
                                                                <?php if($advance_stat=='0'){ ?>
                                                                <!-- Button trigger modal -->
                                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AdvancePaymentModalCenter">
                                                                  Update Advance Payment Data
                                                                </button>
                                                                <?php }else{ }?>
                                                            <?php }else{ }?>
                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="logoimg">
                                                            <img src="assets/logo-black-transparent.png" id="baeimg" style="width: 20%;"><br>
                                                            <!-- <h3>Invoice</h3> -->
                                                            <b>
                                                                <font style="font-size: 20px;">Advance Payment</font><br>
                                                                Advance No : BAE/AD/<?php echo $AdvanceYear; ?>/<?php echo (10000+$AdvanceId); ?>
                                                            </b>
                                                        </div>  
                                                    </div>

                                                    <hr>

                                                    <div class="row">

                                                        <div class="col-md-8" id="print-table1">
                                                            
                                                            <p>
                                                                Invoice Name & Address:<br>
                                                                <?php echo $customer; ?><br>
                                                                <?php echo nl2br($client_address); ?><br>
                                                                <?php echo $phone_number; ?>
                                                            </p>
                                                            
                                                        </div>
                                                        <div class="col-md-4 text-right" id="print-table2">
                                                           
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered" style="border: 1px solid #fff !important;">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">Vehicle #</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $licens_no; ?></font></th>
                                                                            
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; width: 400px; padding: 5px 8px; font-weight: 600;">VIN</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $chassis_no; ?></font></th>
                                                                        </tr>
                                                                        <!--<tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Milage</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php //echo $mileage; ?> Km</font></th>
                                                                        </tr>-->
                                                                        <tr>
                                                                            <th class="colorchange" style="text-align: left; border: 0px solid #fff !important; padding: 5px 8px; font-weight: 600;">Date</th>
                                                                            <th class="colorchange" style="border: 0px solid #fff !important; padding: 5px 8px; width: 1000px;"><font style="float: left;"><?php echo $advance_date; ?></font></th>
                                                                        </tr>
                                                                        
                                                                        
                                                                    </thead>
                                                                </table>
                                                            </div>

                                                        </div>
                                                            
                                                    </div>
                                                        


                                                        <style>
                                                            .colorchange{
                                                                color: #000 !important;
                                                            }
                                                            .result{
                                                                color: #FF0000 !important;
                                                            }
                                                            .table-bordered {
                                                                border: 1px solid #000 !important;
                                                            }
                                                        </style>

                                                       
                                                        <div class="col-md-12">
                                                            <div class="row">
                                                               <div class="col-md-8">
                                                                  
                                                                  <p id="print-p">
                                                                    
                                                                    <font style="font-size: 16px;">Receved an advance of <b>License Number - <?php echo $licens_no; ?></b></font>
                                                                    <br><br>

                                                                    <?php if ($note=='') { }else{ ?>
                                                                        <b>NOTE</b><br>
                                                                        <?php echo $note; ?>
                                                                    <?php } ?>
                                                                  </p>    
                                                                   
                                                               </div>

                                                               <div class="col-md-4 text-right">
                                                                    <font style="font-size: 20px; font-weight: 600;">Rs. <?php echo number_format($advance_payment,2); ?></font>
                                                               </div>
                                                            </div>
                                                        </div>

                                                    

                                                       
                                                    
                                                    
                                                        <div class="col-md-6">
                                                            
                                                            <p>
                                                                <br><br><br>
                                                                <strong style="float: left; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                        </div>
                                                  


                                                        

                                                        
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->


                                    
                                </div><!-- Main Wrapper -->
                                
                                </div>
                            </div>
                        </div>
          

            </div>
        </div>

        <!-- Start page footer -->
        <div id="footer">
        <?php include_once('controls/footer.php'); ?>
        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="AdvancePaymentModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Advance Payment Data Update</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form id="Update-License-Number" method="POST">
          <div class="modal-body">
              <input type="hidden" value="<?php echo $advance_id; ?>" name="advance_id" required readonly>
            <div class="col-md-12">
                <div class="form-group">
                    <label class="form-label">Select License No<font style="color: #FF0000;">*</font></label>
                    <select class="js-example-basic-single form-control" id="1" name="license_no" style="width: 100%;" required>
                        <option value="" selected disabled>Select License No</option>
                        <?php
    
                            $LicenseNumberQuery=$conn->query("SELECT DISTINCT license_no FROM tbl_vehicle");
                            while ($row=$LicenseNumberQuery->fetch_array()) {
                        ?>
                            
                            <?php if($licens_no == $row[0]){ ?>
                                <option value="<?php echo $row[0];?>" selected><?php echo $row[0];?></option>
                            <?php }else{ ?>
                                <option value="<?php echo $row[0];?>"><?php echo $row[0];?></option>
                            <?php } ?>
                                
                            
                        <?php } ?>
                    </select>
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

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<script src="assets/assets/bundles/selectize.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/vendors/selectize.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script>
    $(document).ready( function () {
        $('#itemTable').DataTable();
    } );
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.js-example-basic-single').select2();
    });
</script>


    <script>
        
        $(document).on('submit', '#Update-License-Number', function(e){
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

                url:"post/update_advance_payment_details.php",
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
                      text:'Successfully updated details.'
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