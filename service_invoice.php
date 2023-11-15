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
<?php if ($user_role=='0' || $user_role=='2' || $user_role=='3'){ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php }else{ ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

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
                
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Service Invoice</h3>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="systemInvoiceTable">
                                        <thead>
                                            <tr>
                                                <th>Invoice Number</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>PDF</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            
                                                $servername = "localhost";
                                                $username = "canadagateway";
                                                $password = "canadagateway";
                                                $dbname = "amazoft_ticketing";
                                                
                                                // Create connection
                                                $connTicket = new mysqli($servername, $username, $password, $dbname);
                                                // Check connection
                                                if ($connTicket->connect_error) {
                                                    die("Connection failed: " . $connTicket->connect_error);
                                                }
                                                $ClientProjectId=1;
                                                $ClientInvoiceSQL = "SELECT * FROM client_invoice WHERE client_projects_id ='$ClientProjectId' ";
                                                $CLrs=$connTicket->query($ClientInvoiceSQL);
                                                while($Clrow =$CLrs->fetch_array())
                                                {
                                                    $ClientInvoiceId = $Clrow[0];
                                                    $InvoiceCreatedPersonId = $Clrow[1];
                                                                                   
                                                    $InvoiceNumber = $Clrow[3];
                                                    $InvoicePrice = $Clrow[4];
                                                    $InvoiceNote = $Clrow[5];
                                                    $InvoicePDF = $Clrow[6];
                                                    $InvoiceStat = $Clrow[7];
                                                    $InvoiceDateTime = $Clrow[8];
                                            
                                            
                                            ?>
						                   
						                   <tr class="gradeA">
                                                <td><?php echo $InvoiceNumber; ?></td>
                                                <td><?php echo number_format($InvoicePrice,2); ?></td>
                                                <td><?php if($InvoiceStat=='0'){ ?>
                                                        Pending Payment
                                                    <?php }else{ ?>
                                                        Paid
                                                    <?php } ?>
                                                </td>
                                                <td><a href="http://amazofttestcloud.com/amazoft_ticket/client_invoices/<?php echo $InvoicePDF; ?>" type="button" class="btn btn-secondary btn-xs"><i class="fa fa-download color-secondary"></i></a></td>
                                                <td><?php echo $InvoiceDateTime; ?></td>
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
<!-- <script src="assets/assets/bundles/dataTables.bundle.js"></script> -->

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<!-- <script src="assets/js/table/datatable.js"></script> -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<script>
    $(document).ready( function () {
        $('#systemInvoiceTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>




</body>
</html>
<?php } ?>