<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    $currentYear=date('Y');
    
    $JobId = base64_decode($_GET['j']);



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

    $sql = "SELECT * FROM tbl_vehicle_details tvd INNER JOIN tbl_tax tx ON tvd.v_id=tx.job_id WHERE tvd.v_id= '$JobId' ";
    $rs=$conn->query($sql);
        while($row =$rs->fetch_array())
        {
            $job_id = $row[0];
            $email=$row[1];
            $reg_date=$row[2];
            $customer=$row[3];
            $phone_number=$row[4];
            $reg_madel=$row[8];
            $reg_chassis_no=$row[9];
            $reg_licens_no=$row[10]; 
            $reg_mileage=$row[11]; 
            $service_advisor=$row[80]; 

            ////////////////////////////////

            $tax_id=$row[110]; 
            $tax_user_id=$row[112]; 
            $vat=$row[113]; 
            $discount=$row[114]; 
            $note=$row[115]; 
            $additional_price=$row[116]; 
            $outdate=$row[117];

            $exitdate = date('Y-m-d', strtotime($outdate)) ;
            
            // EXTRACT(YEAR FROM '2018-07-22')
            
            $jobYear = date('Y', strtotime($outdate)) ;

            //////////////////////////////// 
        }
    ?>
    
<?php 
    
    $InvoiceSaveDetailssql = "SELECT * FROM tbl_invoice WHERE invoice_id= '$JobId' ";
    $ISDrs=$conn->query($InvoiceSaveDetailssql);
        while($Irow =$ISDrs->fetch_array())
        {
            $InvoiceNewId = $Irow[0];
            $InvoiceId=$Irow[1];
            
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
                          @media print {
                            @page {
                              size: auto;   /* auto is the initial value */
                              size: A4 portrait;
                              margin: 0;  /* this affects the margin in the printer settings */
                              border: 1px solid red;  /* set a border for all printed pages */
                            }
                            body {
                                zoom: 80%;
                                /*transform: scale(.6);*/
                                /*margin-top: -320px;*/
                                width: 100%;
                            }
                            #print-page{
                                margin-left: -320px;
                                background-color: #fff !important;
                                margin-top: 10px;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #topnav{
                                display: none;
                            }
                            #sidenav{
                                display: none;
                            }
                            #logo-img{
                                width: 15% !important;
                            }
                            #com-details{
                                margin-top: -150px;
                            }
                            #footer{
                                display: none;
                            }
                            #invoice{
                                display: none;
                            }
                            #re-open-job{
                                display: none;
                            }
                            #add-labour-button{
                                display: none;
                            }
                            #add-part-button{
                                display: none;
                            }
                            #invoice-button{
                                display: none;
                            }
                            #vehicle-details{
                                /*margin-top: -100px;*/
                            }
                            #part-list-area{
                                page-break-before: always;
                                margin-top: 20px;
                            }
                            .plusminus{
                                display: none;
                            }
                            #refresh-btn{
                                display: none;
                            }
                            .table thead th {
                                border-bottom: 2px solid #000000 !important;
                            }
                            .table td, .table th {
                                border-color: #000000 !important;
                            }
                            
                            
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
              

                                
                                <!-- Page Inner -->
                                <div class="page-inner">
                                    <div class="page-title">
                                        <!--<h3 style="color: #000; text-align: center;">Job Card</h3>-->
                                    </div>
                                <div id="main-wrapper">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-body">

                                                    <div class="row">
                                                        <div class="col-md-8" style="padding-left:0;">
                                                            <img src="assets/BAE_Header.png" style="width: 70%;">
                                                            <br><br>
                                                            <p>
                                                                Customer Name - <?php echo $customer; ?>                                                     
                                                            </p>
                                                        </div>
                                                        <div class="col-md-4 text-right" id="com-details" style="padding-right:0;">
                                                            <img src="assets/logo-black.png" id="logo-img" style="width: 20%;"><br>
                                                            <address>
                                                                <h2 class="m-b-md m-t-xxs"><b>JOB CARD<br>
                                                                    <font style="font-size: 14px;">Job No : BAE/JOB/<?php echo $jobYear; ?>/<?php echo (10000+$JobId); ?></font>
                                                                    </b></h2><br>
                                                            </address>
                                                            <div style="display: -webkit-inline-box;">
                                                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-default"><i class="fa fa-print"></i> Print</button>
                                                                <?php if($user_role=='1'){ ?>
                                                                <form id="Re-Open-Job" method="POST">
                                                                    <input type="hidden" value="<?php echo $JobId; ?>" name="job_id" readonly>
                                                                    <input type="hidden" value="<?php echo $InvoiceNewId; ?>" name="invoice_new_id" readonly>
                                                                    &nbsp;&nbsp;<button type="submit" id="re-open-job" class="btn text-white bg-red"><i class="fa fa-retweet"></i> Re-Open Job</button>
                                                                </form>
                                                                <?php }else{ }?>
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                    </div>
                                                        
                                                        <br>

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

                                                        <div class="col-md-12" id="vehicle-details">
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="colorchange">Vehicle Number</th>
                                                                            <th class="colorchange result"><?php echo $reg_licens_no; ?></th>
                                                                            <th class="colorchange">VIN</th>
                                                                            <th class="colorchange result"><?php echo $reg_chassis_no; ?></th>
                                                                            <th class="colorchange">In Date Time</th>
                                                                            <th class="colorchange result"><?php echo $reg_date; ?></th>
                                                                        </tr>
                                                                        <tr>
                                                                            <th class="colorchange">Milage</th>
                                                                            <th class="colorchange result"><?php echo $reg_mileage; ?></th>
                                                                            <th class="colorchange">Model</th>
                                                                            <th class="colorchange result"><?php echo $reg_madel; ?></th>
                                                                            <th class="colorchange">Out Date Time</th>
                                                                            <th class="colorchange result"><?php echo $exitdate; ?></th>
                                                                        </tr>
                                                                    </thead>
                                                                </table>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-12">
                                                            <!-- <hr>

                                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#laber"><i class="fa fa-print"></i> Add Labour</button>

                                                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#part"><i class="fa fa-print"></i> Add Part</button> -->

                                                            <br><br>
                                                            <div class="table-responsive">
                                                                <table class="table table-bordered">
                                                                    <thead>
                                                                        <tr>
                                                                            <th colspan="2" style="text-align: center;">Labour</th>
                                                                            <th colspan="1" style="text-align: center;">Qty</th>
                                                                            <th colspan="1" style="text-align: center;">FRU</th>
                                                                            
                                                                        </tr>
                                                                    </thead>
                                                                
                                                                    <tbody>

                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_job_labour tjl WHERE job_id= '$JobId' ORDER BY tjl.job_labour_id ASC";
                                                                            $rs=$conn->query($sql);
                                                                                while($row =$rs->fetch_array())
                                                                                {
                                                                                    $job_labour_id = $row[0];
                                                                                    $labour_id=$row[2];
                                                                                    $job_fru=$row[3];
                                                                                    $labour_datetime=$row[4];
                                                                                    $labour_name_1=$row[5];
                                                                                    $labour_name_2=$row[6];
                                                                                    $labour_datetime=$row[7];
                                                                                
                                                                            ?>

                                                                        <tr>
                                                                            <td colspan="2"><b><?php echo $labour_name_1.' '.$labour_name_2; ?></b></td>
                                                                            <td colspan="1"></td>
                                                                            <td colspan="1"><b><?php echo $job_fru; ?></b></td>
                                                                        </tr>


                                                                        <?php 
                                                                            $sql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.labour_id='$job_labour_id' AND tji.job_id= '$JobId' ";
                                                                            $rsitem=$conn->query($sql);
                                                                                while($rowitem =$rsitem->fetch_array())
                                                                                {
                                                                                    $qty = $rowitem[5];
                                                                                    $part_name=$rowitem[11];
                                                                                    $rowIndex = $rowitem[0];
                                                                                    
                                                                                    $itemId = $rowitem[4];
                                                                                    $labourId = $rowitem[3];
                                                                                
                                                                            ?>

                                                                            <tr>
                                                                                <td colspan="2">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $part_name; ?></td>
                                                                                <td colspan="1" style="width: 200px;">
                                                                                    <span id="qty-label-<?php echo $rowIndex;?>" style="font-size: 20px; padding-left: 15px; padding-right: 15px; "><?php echo $qty; ?></span>
                                                                                </td>
                                                                                <td colspan="1"></td>
                                                                            </tr>

                                                                        <?php } ?>


                                                                    <?php } ?>

                                                                    </tbody>

                                                                </table>
                                                            </div>
                                                        </div>



                                                        <div class="col-md-12" style="padding-left:0;">
                                                            <hr>
                                                            <p>
                                                                <strong>Service Advisor : <?php echo $service_advisor; ?></strong><br>
                                                            </p>
                                                        </div>
                                                        
                                                    <!-- <button class="btn btn-info" data-toggle="modal" data-target="#genarate_invoice">Genarate invoice</button> -->
                                                </div>
                                            </div>
                                        </div>
                                    </div><!-- Row -->


                                    <div class="row" id="part-list-area">
                                        <div class="col-md-12">
                                            <div class="panel panel-white">
                                                <div class="panel-heading clearfix">
                                                    <h4 class="panel-title">Part Request</h4>
                                                </div>
                                                <div class="panel-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-bordered">
                                                            <thead>
                                                                <tr>
                                                                    <th>Parts</th>
                                                                    <th>Qty</th>
                                                                    <th>Received</th>
                                                                    <th>Remarks</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php 
                                                                    $sql = "SELECT * FROM tbl_job_item tji INNER JOIN tbl_item ti ON tji.item_id=ti.item_id WHERE tji.job_id= '$JobId' ";
                                                                    $rsitem=$conn->query($sql);
                                                                        while($rowitem =$rsitem->fetch_array())
                                                                        {
                                                                            $qty = $rowitem[5];
                                                                            $job_part_remark = $rowitem[6];
                                                                            $part_name=$rowitem[11];
                                                                            $rowIndex = $rowitem[0];
                                                                                    
                                                                            $itemId = $rowitem[4];
                                                                            $labourId = $rowitem[3];
                                                                            $job_part_date = $rowitem[9];
                                                                                
                                                                ?>
                                                                <tr>
                                                                    <td><?php echo $part_name; ?></td>
                                                                    <td><?php echo $qty; ?></td>
                                                                    <td><?php echo $job_part_date; ?></td>
                                                                    <td><?php echo $job_part_remark; ?></td>
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

    <!-----------------------Revert JOB-------------------->

    <script>
        
        $(document).on('submit', '#Re-Open-Job', function(e){
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

                url:"post/re_open_job.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {

                    var json = JSON.parse(data);

                    if(json.result){
                        Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:json.msg
                    });
                    }else{
                        Swal.fire({
                      title:'Warning !',
                      icon:'warning',
                      text:json.msg
                    });
                    }

                    setTimeout(function () {
                    //   location.reload();
                    window.location.href = "job_card.php?j=<?php echo base64_encode($JobId); ?>";
                    },1000);

                }

            });

        return false;
        });
    </script>


</body>
</html>