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
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                                <h3 class="card-title">Credit Invoice</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="creditinvoiceTable">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">#</th>
                                                <th></th>
                                                <th>Pay</th>
                                                <th>Invoice Number</th>
                                                <th>Customer Name</th>
                                                <th>License Number</th>
                                                <th>Telephone Number</th>
                                                <th>Payment Status</th>
                                                <th>Invoice Price (Rs.)</th>
                                                <th>Invoice Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql ="SELECT * FROM tbl_invoice WHERE pay = '2' ORDER BY invoice_new_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $InvoiceSaveId = $row[0];
                                                    $reg_date = date('d-m-Y', strtotime($row[9])) ;
                                                    
                                                    $regYear = date('Y', strtotime($row[9])) ;

                                                    $price = $row[16];
                                                    $stat = $row[19];
                                                    $pay = $row[18];

                                                    $grand_total = (double)$row[16];
                                                    $advance_full_pay = $row[20];

                                                    $grand_total_advance = $grand_total - $advance_full_pay;

                                                    //////////////////
                                                    $InvoiceNumber = 10000+$InvoiceSaveId;
                                                    ///////////////////
                                            
                                            ?>
                                            <tr class="gradeA">
                                                <td style="display: none;"><?php echo $InvoiceSaveId; ?></td>
                                                <td>
                                                    <button type="button" onclick="location.href='old_invoice_final?i=<?php echo base64_encode($row[0]); ?>'" class="btn btn-success waves-effect waves-light">Invoice</button>
                                                        
                                                    <button type="button" onclick="location.href='receipt?r=<?php echo base64_encode($row[1]); ?>'" class="btn btn-primary waves-effect waves-light">Receipt</button>
                                                </td>
                                                <td>
                                                    <!-- <form id="Pay" enctype="multipart/form-data" method="POST">
                                                        <input type="hidden" class="form-control" name="invoice_id" id="invoice_id" value="<?php //echo $row[1]; ?>" required>
                                                        <button type="submit" class="btn btn-danger waves-effect waves-light">Pay</button>
                                                    </form>  --> 
                                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row[0]; ?>" class="btn btn-info waves-effect waves-light">Pay</button>
                                                </td>
                                                <td>BAE/IN/<?php echo $regYear.'/'.$InvoiceNumber; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[6]; ?></td>
                                                <td><?php echo $row[5]; ?></td>
                                                <td><b style="color: #FF0000;">Credit</b></td>
                                                <td style="text-align: right;">
                                                    <?php if ($advance_full_pay=='0') { ?>
                                                        <b style="font-size: 15px;"><?php echo number_format($row[16],2); ?></b>
                                                    <?php }else{ ?>
                                                        <b style="font-size: 15px;"><?php echo number_format($grand_total,2); ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $reg_date; ?></td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $row[0]; ?>" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Genarate Receipt for CREDIT INVOICE <br>#BAE/IN/<?php echo $regYear.'/'.$InvoiceNumber; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           

                                                            <form id="Pay" method="POST">
                                                                <input type="hidden" class="form-control" name="invoice_id" id="invoice_id" value="<?php echo $row[1]; ?>" required>
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="customer_name">Select Payment Method</label><br>
                                                                                  <select name="pay_type" class="form-control">
                                                                                      <option disabled>Select Payment Method</option>
                                                                                      <option value="Cash" selected> 💵 Cash</option>
                                                                                      <option value="Online Transfer">Online Transfer</option>
                                                                                      <option value="Bank Deposit">Bank Deposit</option>
                                                                                      <option value="Cheque">Cheque</option>
                                                                                      <option value="Visa">Visa</option>
                                                                                      <option value="Master">Master</option>
                                                                                      <option value="AMEX">AMEX</option>
                                                                                  </select>


                                                                              </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="note">Note</label>
                                                                                <textarea name="note" rows="6" class="form-control"></textarea>
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Genarate</button>
                                                                
                                                            </form>




                                                          </div>
                                                          <div class="modal-footer">
                                                            <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button> -->
                                                          </div>
                                                        </div>
                                                      </div>
                                                    </div>


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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<?php if($user_role=='1'){ ?>
<script>
    $(document).ready( function () {
        $('#creditinvoiceTable').DataTable({
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
        $('#creditinvoiceTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>
<?php } ?>

    <script>
        
        $(document).on('submit', '#Pay', function(e){
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

                url:"post/credit_pay.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    var json=JSON.parse(data);
                        if(json.result){
                            var inv = json.invoice;
                        Swal.fire({
                          title:'Thanks !',
                          icon:'success',
                          text:'Successfully Created Receipt.'
                        });
    
                        setTimeout(function () {
                            window.open('receipt?r='+inv,'_blank');
                           location.reload();
                        },1000);
    
                        }else{
                            console.log('err');
                        }

                    // Swal.fire({
                    //   title:'Thanks !',
                    //   icon:'success',
                    //   text:'Successfully.'
                    // });


                    // setTimeout(function () {
                        
                    //   location.reload();
                    // },1000);

                }

            });

        return false;
        });
    </script>



</body>
</html>