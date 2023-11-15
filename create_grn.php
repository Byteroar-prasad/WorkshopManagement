<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    
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
    
    function rand_code($len)
    {
     $min_lenght= 0;
     $max_lenght = 100;
     // $bigL = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     //$smallL = "abcdefghijklmnopqrstuvwxyz";
     $number = "0123456789";
     // $bigB = str_shuffle($bigL);
     //$smallS = str_shuffle($smallL);
     $numberS = str_shuffle($number);
     // $subA = substr($bigB,0,5);
     // $subB = substr($bigB,6,5);
     // $subC = substr($bigB,10,5);
     // $subD = substr($smallS,0,5);
     // $subE = substr($smallS,6,5);
     // $subF = substr($smallS,10,5);
     $subG = substr($numberS,0,5);
     $subH = substr($numberS,6,5);
     $subI = substr($numberS,10,5);
     $RandCode1 = str_shuffle($subH.$subI.$subG);
     // $RandCode1 = str_shuffle($subA.$subH.$subC.$subI.$subB.$subG);
     $RandCode2 = str_shuffle($RandCode1);
     $RandCode = $RandCode1.$RandCode2;
     if ($len>$min_lenght && $len<$max_lenght)
     {
     $CodeEX = substr($RandCode,0,$len);
     }
     else
     {
     $CodeEX = $RandCode;
     }
     return $CodeEX;
    }
    
?>


<?php if ($user_role=='1' || $user_role=='2' || $user_role=='4'){ ?>

<?php
    $getGRNDetailsQuery=$conn->query("SELECT COUNT(*) FROM tbl_grn_details WHERE stat='0' ORDER BY grn_detail_id DESC LIMIT 1");
    if ($GgrnQ=$getGRNDetailsQuery->fetch_array()) {
        $GRNOngoingCount=$GgrnQ[0];
    }
?>
<?php if($GRNOngoingCount=='0'){ ?>

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
                        
                         <h4>Create Goods Received Note (GRN)</h4>
                        
                        <form class="card" id="Create-GRN-Details">
                            <div class="card-body">
                                <h3 class="card-title">Create Goods Received Note (GRN)</h3>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        
                                        <div class="form-group">
                                            <label class="form-label">Supplier Name <font style="color: #FF0000;">*</font></label>

                                            <select class="js-example-basic-single form-control" name="supplier_id" required>
                                                <option value="" selected disabled>Select Supplier Name</option>
                                                <?php

                                                    $getDataForDate=$conn->query("SELECT * FROM tbl_supplier");
                                                    while ($row=$getDataForDate->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                                                <?php } ?>
                                            </select>     
                                        </div>
                                        
                                          <!--<input type="hidden" class="form-control" name="client_id" id="client_id" placeholder="Client Id" readonly>-->
                                            <input type="hidden" class="form-control" name="user_name" value="<?php echo $user_name; ?>" readonly>
                                            <input type="hidden" class="form-control" name="user_id" value="<?php echo $user_id; ?>" readonly>

                                        <div class="form-group">
                                            <label class="form-label">Invoice Number <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="invoice_number" id="invoice_number" placeholder="Invoice Number" required>
                                        </div>
                                        
                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label class="form-label">Auto Genarate Number <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" value="<?php echo rand_code(6); ?>" placeholder="Auto Genarate Number" readonly required>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label">Goods Received Date <font style="color: #FF0000;">*</font></label>
                                            <input type="date" class="form-control" value="<?php echo date('Y-m-d') ?>" name="goods_received_date" id="goods_received_date" placeholder="Goods Received Date" required>
                                        </div>
                                          
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Select GRN Type <font style="color: #FF0000;">*</font></label>
                                        <label style="cursor: pointer;"><input type="radio" id="local-shop" value="0" name="grn_type" checked> Local</label>
                                        <label style="cursor: pointer; margin-left: 50px;"><input type="radio" id="internatinal-shop" value="1" name="grn_type"> Internatianal</label>
                                    </div>


                                    <div class="row" id="View-GRN-Details" style="display: none; width: 100%; margin-left: 1px;">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Select Currency <font style="color: #FF0000;">*</font></label>
                                                <select class="form-control" name="currency_method" required>
                                                    <option value="" disabled>Select Currency</option>
                                                    <option value="GBP" selected>GBP</option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="US-DOLLER">US-DOLLER</option>
                                                </select> 
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Currency in LKR <font style="color: #FF0000;">*</font></label>
                                                <input type="number" class="form-control" min="0" value="0" name="currency_in_lkr" placeholder="Currency in LKR" required>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="form-label">Freight & Clearance % <font style="color: #FF0000;">*</font></label>
                                                <input type="number" class="form-control" min="0" value="0" name="freight_clearance" placeholder="Freight & Clearance %" required>
                                            </div>
                                        </div>          
                                    </div>




                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Note</label>
                                            <textarea class="form-control" value="" name="note" rows="5"></textarea>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Create GRN</button>
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
        //edit-name
        $("#local-shop").change(function(){
            $("#View-GRN-Details").hide();
        });
        $("#internatinal-shop").change(function(){
            $("#View-GRN-Details").show();
            
        });
    </script>

    <script>
        
        $(document).on('submit', '#Create-GRN-Details', function(e){
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

                url:"grn_post/submit_grn_details.php",
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
                        
                        window.location.href = "grn_invoice.php?g="+btoa(j_id);
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

<?php
    $getGRNDetailsOngoingIdQuery=$conn->query("SELECT grn_detail_id FROM tbl_grn_details WHERE stat='0' ORDER BY grn_detail_id DESC LIMIT 1");
    if ($GgrnDOrs=$getGRNDetailsOngoingIdQuery->fetch_array()) {
        $GRNDetailId=$GgrnDOrs[0];
    }
?>
    <script>
        window.location.href = "grn_invoice.php?g=<?php echo(base64_encode($GRNDetailId)) ?>";
    </script>

<?php }?>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php } ?>

