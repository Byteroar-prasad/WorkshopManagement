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
<?php if ($user_role=='1' || $user_role=='2' || $user_role=='4'){ ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
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
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Stock Selling Summary Check</h3>
                            </div>
                            <div class="card-body">
                                        
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="1">Start Date <font style="color: #FF0000;">*</font></label>
                                           <input type="date" id="stock-start-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                           <label for="6">End Date <font style="color: #FF0000;">*</font></label>
                                           <input type="date" id="stock-end-date" value="<?php echo date('Y-m-d'); ?>" class="form-control">
                                        </div>    
                                    </div>

                                </div>
                                    <input type="submit" id="btn-get-stock" class="btn btn-primary waves-effect waves-light" value="Get Stock">
                            </div>                        
                        </div>
                    </div>
                </div>




                        <div class="row clearfix">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Stock Selling Summary</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <div class="row">
                                            
                                            <div class="col-md-12">
                                               <div class="row" id="stock-container"></div>
                                            </div>

                                            <div class="col-md-12">
                                               <div class="table-responsive">
                                                    <table class="table m-b-0" id="item-selling">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">#</th>
                                                                <th scope="col">Job Number</th>
                                                                <th scope="col">Item Name</th>
                                                                <th scope="col">Item Number</th>
                                                                <th scope="col">Item Selling QTY</th>
                                                                <th scope="col" style="text-align: right;">Total Cost (.Rs)</th>
                                                                <th scope="col" style="text-align: right;">Total Selling (.Rs)</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="selling-summary-area">
                                                            
                                                        </tbody>
                                                        <!--<tfoot id="selling-summary-foot-area">
                                                            
                                                        </tfoot>-->
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
<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script type="text/javascript">

            function downloadStockData(){
            }
        
        
        var sellingsummerytbl = null;
      
          $(document).ready(function(){
            downloadStockData();


            $("#btn-get-stock").click(function(event){
              event.preventDefault();
              
                if(sellingsummerytbl == null){
                        
                        
                }else{
                                                    
                    sellingsummerytbl.clear().draw();
                    sellingsummerytbl.destroy();
                }


              Swal.fire({
                  text: "Please wait...",
                  imageUrl:"assets/loader.gif",
                  showConfirmButton: false,
                  allowOutsideClick: false
                });


              

              $.ajax({
              url:'controls/get_stock_summary_history.php',
              type:'POST',
              data:{
                    stock_start_date:$("#stock-start-date").val(),
                    stock_end_date:$("#stock-end-date").val()
              },
              success:function(data){
                console.log(data);

                // alert(data);

                var json=JSON.parse(data);
                
                if(json.result){

                //   $("#stock-container").html(json.data);
                  $("#selling-summary-area").html(json.data);
                  $("#selling-summary-foot-area").html(json.datafoot);
                  
                  sellingsummerytbl = $('#item-selling').DataTable({ 
                        //   "order": [[ 0, "desc" ]],
                          "destroy": true, //use for reinitialize datatable
                          dom: 'Bfrtip',
                            buttons: [
                                // 'copy', 'csv', 'excel', 'pdf', 'print'
                                'print', 'excel', 'pdf'
                            ]
                    });

                //   var itemName = json.itemName;
                //   var itemQtySum = json.itemQtySum;
                //   loadStockChart(itemName,itemQtySum);

                  // loadStockChart(itemName,itemQtySum);

                }
                
                Swal.close();


              },
              error:function(err){
                console.log(err);
              }


            });








              
              
            });





          });

    </script>

</body>
</html>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php } ?>