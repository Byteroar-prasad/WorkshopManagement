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
                                <h3 class="card-title">Parts Selling Invoices</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="invoiceTable">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">#</th>
                                                <th>Invoice Number</th>
                                                <th></th>
                                                <th></th>
                                                <th>Customer Name</th>
                                                <th>License Number</th>
                                                <th>Telephone Number</th>
                                                <th>Payment Status</th>
                                                <th>Payment Type</th>
                                                <th>Invoice Price (Rs.)</th>
                                                <th>Invoice Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql ="SELECT * FROM tbl_part_selling_details tpsd INNER JOIN tbl_part_selling_tax tpst ON tpsd.part_selling_id=tpst.part_selling_id ORDER BY tpsd.part_selling_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $InvoiceSaveId = $row[0];
                                                    $reg_date = date('d-m-Y', strtotime($row[18]));
                                                    
                                                    $stat = $row[8];
                                                    $pay = $row[9];

                                                    $grand_total = (double)$row[20];

                                                    //////////////////
                                                    $InvoiceNumber = 10000+$InvoiceSaveId;
                                                    
                                                    $InvoiceYear = date('Y', strtotime($row[18]));
                                                    ///////////////////
                                                    
                                                    $ReceptId = 'PIN-'.$InvoiceSaveId;
                                                    $GetPaymentTypeSql ="SELECT receipt_id,payment_method FROM tbl_receipt WHERE invoice_id='$ReceptId'";
                                                    $GPTrs=$conn->query($GetPaymentTypeSql);
                                                    if($GPTrow =$GPTrs->fetch_array())
                                                    {
                                                        $ReceptIdView=$GPTrow[0];
                                                        $PaymentType=$GPTrow[1];
                                                    }
                                            
                                            ?>
                                            
                                            <tr class="gradeA">
                                                <td style="display: none;"><?php echo $InvoiceSaveId; ?></td>
                                                <td>BAE/PIN/<?php echo $InvoiceYear.'/'.$InvoiceNumber; ?></td>
                                                <td>
                                                    <button type="button" onclick="location.href='part_selling_invoice?i=<?php echo base64_encode($row[0]); ?>'" class="btn btn-success">Invoice</button>
                                                    <?php if ($pay=='0') { ?>
                                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row[0]; ?>" class="btn btn-primary">Genarate Receipt</button>
                                                    <?php }else{ ?>
                                                    <button type="button" onclick="location.href='part_receipt?r=<?php echo base64_encode($row[0]); ?>'" class="btn btn-primary">Receipt</button>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if($pay=='2'){ ?>
                                                    <button type="button" data-toggle="modal" data-target="#payModalCenter<?php echo $row[0]; ?>" class="btn btn-info waves-effect waves-light">Pay</button>
                                                    
                                                        <!-- Modal -->
                                                        <div class="modal fade" id="payModalCenter<?php echo $row[0]; ?>" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Genarate Receipt for CREDIT INVOICE <br>#BAE/PIN/<?php echo $InvoiceYear.'/'.$InvoiceNumber; ?></h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                          <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                       
            
                                                                        <form id="Pay" method="POST">
                                                                            <input type="hidden" class="form-control" name="part_selling_id" id="part_selling_id" value="<?php echo $InvoiceSaveId; ?>" required>
                                                                            <input type="hidden" class="form-control" name="receipt_id" id="receipt_id" value="<?php echo $ReceptIdView; ?>" required>
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
                                                        
                                                    
                                                    <?php }else{ } ?>
                                                </td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[6]; ?></td>
                                                <td><?php echo $row[3]; ?></td>

                                                <td>
                                                    <?php if ($pay=='1') { ?>
                                                        <b style="color: #008000;">Paid</b>
                                                    <?php }elseif($pay=='2'){ ?>
                                                        <b style="color: #FF0000;">Credit</b>
                                                    <?php }else{ ?>
                                                        <b style="color: #000;">-</b>
                                                    <?php } ?>
                                                </td>
                                                <td>
                                                    <?php if ($pay=='1' || $pay=='2') { ?>
                                                        <b><?php echo $PaymentType; ?></b>
                                                    <?php }else{ echo '-'; } ?>
                                                </td>

                                                <td style="text-align: right;">
                                                      <b style="font-size: 15px;"><?php echo number_format($grand_total,2); ?></b>
                                                </td>
                                                <td><?php echo $reg_date; ?></td>
                                            </tr>


                                             <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $row[0]; ?>" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Genarate Receipt INVOICE <br>#BAE/PIN/<?php echo $InvoiceYear.'/'.$InvoiceNumber; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           

                                                            <form id="Create-receipt" method="POST">
                                                                <input type="hidden" class="form-control" name="part_selling_id" id="part_selling_id" value="<?php echo $row[0]; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                            

                                                                              <div class="form-group">
                                                                                <label for="customer_name">Grand Total</label><br>
                                                                                    <span style="font-size: 20px; font-weight: 600;">Rs. <?php echo number_format($grand_total,2); ?></span>
                                                                                    <input type="hidden" name="price" value="<?php echo $grand_total; ?>">
                                                                              </div>


                                                                       
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="customer_name">Select Payment Method</label><br>
                                                                                  <select name="pay_type" onchange="paymentMethodChanged('pay_type_<?php echo $row[0]; ?>','date_count_view_<?php echo $row[0];?>')" class="form-control" id="pay_type_<?php echo $row[0]; ?>">
                                                                                      <option disabled>Select Payment Method</option>
                                                                                      <option value="Cash" selected> 💵 Cash</option>
                                                                                      <option value="Online Transfer">Online Transfer</option>
                                                                                      <option value="Bank Deposit">Bank Deposit</option>
                                                                                      <option value="Cheque">Cheque</option>
                                                                                      <option value="Visa">Visa</option>
                                                                                      <option value="Master">Master</option>
                                                                                      <option value="AMEX">AMEX</option>
                                                                                      <option value="Credit">Credit</option>
                                                                                  </select>


                                                                              </div>
                                                                        </div>

                                                                        <div class="col-md-12" id="date_count_view_<?php echo $row[0];?>" style="display: none;">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="date_count">Date Count</label>
                                                                                <input type="number" class="form-control" name="date_count" id="date_count" placeholder="Date Count">
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<?php if($user_role=='1' || $user_role=='3'){ ?>
<script>
    $(document).ready( function () {
        $('#invoiceTable').DataTable({
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
        $('#invoiceTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>
<?php } ?>

<script>

    function paymentMethodChanged(payType,dateCountField){

        var type = $('#'+payType).val();

            if(type === "Credit"){
                $('#'+dateCountField).show();
            }else{
                 $('#'+dateCountField).hide();
            }
       
    }
    
</script>


    <script>
        
        $(document).on('submit', '#Create-receipt', function(e){
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

                url:"part_selling_post/create_receipt.php",
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
                        window.open('part_receipt?r='+inv,'_blank');
                       location.reload();
                    },1000);

                    }else{
                        console.log('err');
                    }


                }

            });

        return false;
        });
    </script>
    
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

                url:"part_selling_post/credit_pay.php",
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
                            window.open('part_receipt?r='+inv,'_blank');
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