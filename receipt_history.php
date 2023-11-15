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
                                <h3 class="card-title">Recepts</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="row">

                                    <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="1">Start Date (DD/MM/Y)</label>
                                          <input type="date" id="recept-start-date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="6">End Date (DD/MM/Y)</label>
                                            <input type="date" id="recept-end-date" class="form-control">
                                        </div>    
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="6">Recept Number Start</label>
                                                    <input type="text" id="recept-number-start" class="form-control">
                                                </div>    
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="6">-</label>
                                                    <!-- <input type="text" value="-" class="form-control"> -->
                                                </div>
                                            </div>
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="6">Recept Number End</label>
                                                    <input type="text" id="recept-number-end" class="form-control">
                                                </div>    
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" id="btn-get-recept" class="btn btn-primary waves-effect waves-light">Get Recept</button>
                                
                                <hr>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="ReceptTable">
                                        <thead>
                                            <tr>
                                                <th>Receipt Number</th>
                                                <th></th>
                                                <th>Invoice Number</th>
                                                <th>Payment Method</th>
                                                <th>Date Count</th>
                                                <th>Recept Price (Rs.)</th>
                                                <th>Recept Date</th>
                                            </tr>
                                        </thead>
                                        <tbody id="recept-data-area">

                                            <?php

                                                $sql ="SELECT * FROM tbl_receipt ORDER BY receipt_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $ReceiptId = $row[0];
                                                    $InvoiceId = $row[1];
                                                    $Price = $row[2];
                                                    $PaymentMethod = $row[3];
                                                    $DataCount = $row[4];
                                                    $Note = $row[5];
                                                    $ReceptDateTime = $row[6];

                                                    $ReceptDate = date('d-m-Y', strtotime($ReceptDateTime)) ;
                                                    $InvoiceYear = date('Y', strtotime($ReceptDateTime));

                                                    if(strpos($InvoiceId, "PIN") !== false){
                                                        $InvoiceIdEx = explode('PIN-', $InvoiceId)[1];
                                                        $NumberGenPInvoice = 10000+$InvoiceIdEx;
                                                        $InvoiceNumber = 'BAE/PIN/'.$InvoiceYear.'/'.$NumberGenPInvoice;
                                                        $ReceptLink = 'part_receipt?r='.base64_encode($InvoiceIdEx);
                                                    }else{

                                                        $GetInvoiceIdSql ="SELECT * FROM tbl_invoice WHERE invoice_id='$InvoiceId'";
                                                        $GIIrs=$conn->query($GetInvoiceIdSql);
                                                        if($GIIrow =$GIIrs->fetch_array())
                                                        {
                                                            $InvoiceRealId = $GIIrow[0];
                                                        }

                                                        $NumberGenNormalInvoice=$InvoiceRealId+10000;
                                                        $InvoiceNumber = 'BAE/IN/'.$InvoiceYear.'/'.$NumberGenNormalInvoice;
                                                        $ReceptLink = 'receipt?r='.base64_encode($InvoiceId);
                                                    }
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td><?php echo $ReceiptId; ?></td>
                                                <td>
                                                    <button type="button" onclick="location.href='<?php echo $ReceptLink; ?>'" class="btn btn-primary">Receipt</button>
                                                </td>
                                                <td><?php echo $InvoiceNumber; ?></td>
                                                <td><?php echo $PaymentMethod; ?></td>
                                                <td><?php echo $DataCount; ?></td>
                                                <td><b style="float: right;"><?php echo number_format($Price,2); ?></b></td>
                                                <td><?php echo $ReceptDate; ?></td>
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
     var invoicetbl = null;
</script>


<?php if($user_role=='1' || $user_role=='3'){ ?>
<script>
    $(document).ready( function () {
       invoicetbl = $('#ReceptTable').DataTable({
            "order": [[ 0, "desc" ]],
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf', 'print'
                'print', 'excel', 'pdf'
            ]
        });
    } );
</script>
<?php }else{ ?>
<script>
    $(document).ready( function () {
        invoicetbl = $('#ReceptTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>
<?php } ?>

    <script type="text/javascript">
    
            $(document).ready( function () {
                
                $("#btn-get-recept").click(function(){
                    
                    if(invoicetbl == null){
                         
                    }else{        
                            invoicetbl.clear().draw();
                            invoicetbl.destroy();
                    }

                    var startDate = $("#recept-start-date").val();
                    var endDate = $("#recept-end-date").val();

                    var instartNumber = $("#recept-number-start").val();
                    var inendNumber = $("#recept-number-end").val();

                    $.ajax({

                        url:'controls/get_recept_summary.php',
                        type:'POST',
                        data:{
                            start_date:startDate,
                            end_date:endDate,
                            start_no:instartNumber,
                            end_no:inendNumber

                        },
                        beforeSend:function(){
                            Swal.fire({
                              text: "Please wait...",
                              imageUrl:"assets/invoice.gif",
                              showConfirmButton: false,
                              allowOutsideClick: false
                            });
                        },
                        success:function(data){
                            var json = JSON.parse(data);
                            if(json.result){
                                
                                ///////Recept Summery Details Area//////////
                                $("#recept-data-area").html(json.data);
                                
                                invoicetbl = $('#ReceptTable').DataTable({ 
                                      "order": [[ 0, "desc" ]],
                                      "destroy": true, //use for reinitialize datatable
                                      dom: 'Bfrtip',
                                        buttons: [
                                            'excel', 'pdf', 'print'
                                        ]
                                });
                                ///////////////////

                            }

                            Swal.close();
                        },
                        error:function(err){
                            console.log(err);
                        }


                    });



                });




            } );
       
        </script>

</body>
</html>