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
    
    $GrandTotalSum = 0.00;


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
                                <h3 class="card-title">Invoices</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="row">

                                    <div class="col-md-4">
                                          <div class="form-group">
                                            <label for="1">Start Date (DD/MM/Y)</label>
                                          <input type="date" id="invoice-start-date" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="6">End Date (DD/MM/Y)</label>
                                            <input type="date" id="invoice-end-date" class="form-control">
                                        </div>    
                                    </div>

                                    <div class="col-md-4">
                                        <div class="row">
                                            <div class="col-md-5">
                                                <div class="form-group">
                                                    <label for="6">Invoice Number Start</label>
                                                    <input type="text" id="invoice-number-start" class="form-control">
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
                                                    <label for="6">Invoice Number End</label>
                                                    <input type="text" id="invoice-number-end" class="form-control">
                                                </div>    
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <button type="submit" id="btn-get-invoice" class="btn btn-primary waves-effect waves-light">Get Invoice</button>
                                
                                <hr>
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="invoiceTable">
                                        <thead>
                                            <tr>
                                                <th style="display: none;">#</th>
                                                <th>Invoice Number</th>
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
                                        <tbody id="invoice-data-area">

                                            <?php
                                                
                                                $sql ="SELECT * FROM tbl_invoice ORDER BY invoice_new_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $InvoiceSaveId = $row[0];
                                                    $InvoiceId = $row[1];
                                                    $invoice_date=$row[9];
                                                    $reg_date = date('d-m-Y', strtotime($invoice_date)) ;
                                                    

                                                    
                                                    $price = $row[16];
                                                    $stat = $row[19];
                                                    $pay = $row[18];

                                                    $grand_total = (double)$row[16];
                                                    $advance_full_pay = $row[20];

                                                    $grand_total_advance = $grand_total - $advance_full_pay;
                                                    
                                                    $GrandTotalSum += $grand_total;


                                                    //////////////////
                                                    $InvoiceNumber = 10000+$InvoiceSaveId;
                                                    
                                                    $InvoiceYear = date('Y', strtotime($row[21])) ;
                                                    ///////////////////
                                                    
                                                        $GetPaymentTypeSql ="SELECT payment_method FROM tbl_receipt WHERE invoice_id='$InvoiceId'";
                                                        $GPTrs=$conn->query($GetPaymentTypeSql);
                                                        if($GPTrow =$GPTrs->fetch_array())
                                                        {
                                                            $PaymentType=$GPTrow[0];
                                                        }
                                                    
                                            
                                            ?>
                                            
                                            <!------------Deleted Invoice View--------------------->
                                            <?php if($InvoiceId=='-1'){ ?> 
                                            <tr class="gradeA">
                                                <td style="display: none;"><?php echo $InvoiceSaveId; ?></td>
                                                <td>BAE/IN/<?php echo $InvoiceYear.'/'.$InvoiceNumber; ?></td>
                                                
                                                <td colspan="7"><font style="font-size: 15px;"><center>This invoice cancelled</center></font></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td style="display: none;"></td>
                                                <td><?php echo $reg_date; ?></td>
                                            </tr>

                                            <?php }else{ ?>
                                            <!------------Genarated Invoice View--------------------->
                                            <tr class="gradeA">
                                                <td style="display: none;"><?php echo $InvoiceSaveId; ?></td>
                                                <td>BAE/IN/<?php echo $InvoiceYear.'/'.$InvoiceNumber; ?></td>
                                                <td>
                                                    <button type="button" onclick="location.href='old_invoice_final?i=<?php echo base64_encode($row[0]); ?>'" class="btn btn-success">Invoice</button>
                                                    <?php if ($stat=='0') { ?>
                                                    <button type="button" data-toggle="modal" data-target="#exampleModalCenter<?php echo $row[0]; ?>" class="btn btn-primary">Genarate Receipt</button>
                                                    <?php }else{ ?>
                                                    <button type="button" onclick="location.href='receipt?r=<?php echo base64_encode($row[1]); ?>'" class="btn btn-primary">Receipt</button>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[6]; ?></td>
                                                <td><?php echo $row[5]; ?></td>

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
                                                    <?php if ($stat=='0') { echo '-'; }else{?>
                                                        <b><?php echo $PaymentType; ?></b>
                                                    <?php } ?>
                                                </td>

                                                <td style="text-align: right;">
                                                    <?php if ($advance_full_pay=='0') { ?>
                                                       <b style="font-size: 15px;"><?php echo number_format($row[16],2); ?></b>
                                                    <?php }else{ ?>
                                                      <b style="font-size: 15px;"><?php echo number_format($grand_total,2); ?></b>
                                                    <?php } ?>
                                                </td>
                                                <td><?php echo $reg_date; ?></td>
                                            </tr>
                                            <?php } ?>

                                             <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $row[0]; ?>" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Genarate Receipt INVOICE <br>#BAE/IN/<?php echo $InvoiceYear.'/'.$InvoiceNumber; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                           

                                                            <form id="Create-receipt" method="POST">
                                                                <input type="hidden" class="form-control" name="invoice_id" id="invoice_id" value="<?php echo $row[1]; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            
                                                                            <?php if ($advance_full_pay=='0') { ?>
                                                                              <div class="form-group">
                                                                                <label for="customer_name">Grand Total</label><br>
                                                                                    <span style="font-size: 20px; font-weight: 600;">Rs. <?php echo number_format($price,2); ?></span>
                                                                                    <input type="hidden" name="price" value="<?php echo $price; ?>">
                                                                              </div>
                                                                            <?php }else{?>

                                                                              <div class="form-group">
                                                                                <label for="customer_name">Grand Total</label><br>
                                                                                    <span style="font-size: 20px; font-weight: 600;">Rs. <?php echo number_format($grand_total_advance,2); ?></span>
                                                                                    <input type="hidden" name="price" value="<?php echo $grand_total_advance; ?>">
                                                                              </div>


                                                                            <?php } ?>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="customer_name">Select Payment Method</label><br>
                                                                                  <select name="pay_type" onchange="paymentMethodChanged('pay_type_<?php echo $row[1]; ?>','date_count_view_<?php echo $row[1];?>')" class="form-control" id="pay_type_<?php echo $row[1]; ?>">
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

                                                                        <!-- <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="payment_method">Select Payment Method <font style="color: #FF0000;">*</font></label><br>

                                                                                <div class="col-md-2" style="text-align: center;">
                                                                                  <input type="radio" id="Cash" name="pay_type" value="cash" checked><br>
                                                                                  <img src="assets/payment_png/1.png" style="width: 30px;"><br>
                                                                                  <label for="Cash">Cash</label>
                                                                                </div>
                                                                                <div class="col-md-2" style="text-align: center;">
                                                                                  <input type="radio" id="Cheque" name="pay_type" value="cheque"><br>
                                                                                  <img src="assets/payment_png/2.png" style="width: 30px;"><br>
                                                                                  <label for="Cheque">Cheque</label>
                                                                                </div>
                                                                                <div class="col-md-2" style="text-align: center;">
                                                                                  <input type="radio" id="Visa" name="pay_type" value="visa"><br>
                                                                                  <img src="assets/payment_png/3.png" style="width: 30px;"><br>
                                                                                  <label for="Visa">Visa</label>
                                                                                </div>
                                                                                <div class="col-md-2" style="text-align: center;">
                                                                                  <input type="radio" id="Master" name="pay_type" value="master"><br>
                                                                                  <img src="assets/payment_png/4.png" style="width: 30px;"><br>
                                                                                  <label for="Master">Master</label>
                                                                                </div>
                                                                                <div class="col-md-2" style="text-align: center;">
                                                                                  <input type="radio" id="AMEX" name="pay_type" value="amex"><br>
                                                                                  <img src="assets/payment_png/5.png" style="width: 30px;"><br>
                                                                                  <label for="AMEX">AMEX</label>
                                                                                </div>
                                                                                <div class="col-md-2" style="text-align: center;">
                                                                                  <input type="radio" id="Credit" name="pay_type" value="credit"><br>
                                                                                  <img src="assets/payment_png/7.png" style="width: 30px;"><br>
                                                                                  <label for="Credit">Credit</label>
                                                                                </div>
                                                                              </div>
                                                                        </div> -->

                                                                        <div class="col-md-12" id="date_count_view_<?php echo $row[1];?>" style="display: none;">
                                                                           
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
                                            
                                                <tfoot id="invoice-data-area-footer">
                                                    <tr>
                                                        <th colspan="7" style="text-align:right; font-size: 20px;">Total:</th>
                                                        <th colspan="1" style="text-align:right; font-size: 20px;"><?php echo number_format($GrandTotalSum,2); ?></th>
                                                        <th colspan="1"></th>
                                                    </tr>
                                                </tfoot>
                                            

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
       invoicetbl = $('#invoiceTable').DataTable({
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
        invoicetbl = $('#invoiceTable').DataTable({
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



    <script type="text/javascript">
    
    
       
    
            $(document).ready( function () {
                
                
                
                
                $("#btn-get-invoice").click(function(){
                    
                    
                    
                    
                    if(invoicetbl == null){
                         
                    }else{        
                            invoicetbl.clear().draw();
                            invoicetbl.destroy();
                    }

                    var startDate = $("#invoice-start-date").val();
                    var endDate = $("#invoice-end-date").val();

                    var instartNumber = parseInt($("#invoice-number-start").val()) - 10000;
                    var inendNumber = parseInt($("#invoice-number-end").val()) - 10000;

                    // alert(inendNumber);



                    $.ajax({

                        url:'controls/get_invoice_summary.php',
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
                                
                                
                                ///////Invoice Summery Details Area//////////
                                $("#invoice-data-area").html(json.data);
                                $("#invoice-data-area-footer").html(json.datafoot);
                                
                                invoicetbl = $('#invoiceTable').DataTable({ 
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

                url:"post/create_receipt.php",
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


                }

            });

        return false;
        });
    </script>


</body>
</html>