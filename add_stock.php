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
                <div class="row" style="display: none;">
                    <div class="col-md-12 col-lg-12">
                        
                         <h4>Stock</h4>
                        
                        <form class="card" id="Update-Stock">
                            <div class="card-body">
                                <h3 class="card-title">Add Stock</h3>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Part <font style="color: #FF0000;">*</font></label>
                                            <select class="js-example-basic-single form-control" name="item_id" id="select-part" style="padding: 0.375rem 0.75rem !important;" onchange="onPartChanged()" required>
                                                <option value="" selected disabled>Select Part</option>
                                                <?php

                                                    $itemsQuery=$conn->query("SELECT DISTINCT item_id,part_name,part_number FROM tbl_item");
                                                    while ($row=$itemsQuery->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[0];?>"><?php echo $row[1];?> (<?php echo $row[2];?>)</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Select Price Batch <font style="color: #FF0000;">*</font></label>
                                            <select style="width: 100% !important;" class="form-control" id="price_batch_id" name="price_batch_id" required>
                                                <option value="" selected disabled>Select Price Batch</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="form-label">Quantity <font style="color: #FF0000;">*</font></label>
                                            <input type="number" class="form-control" style="text-align: right;" name="quantity" id="quantity" min="0" placeholder="Quantity" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Add Stock</button>
                            </div>
                        </form>





                    </div>
                    
                </div>




                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">View Stock</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="stockTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>Part Location</th>
                                                <th>Price Batch</th>
                                                <th>Part Quantity</th>
                                                <th>Remark</th>
                                                <th>Part Cost (Foreign)</th>
                                                <th>F&C</th>
                                                <th>International Landing</th>
                                                <th>Rate (.Rs)</th>
                                                <th>Part Cost (.Rs)</th>
                                                <th>Part Selling Price (.Rs)</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                  $total_cost = 0;
                                                  $total_selling = 0;
                                                  $sql = "SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id ORDER BY tit.item_id DESC";
                                                  $rs=$conn->query($sql);
                                                  while($row =$rs->fetch_array())
                                                  {
                                                    $item_id = $row[0];
                                                    $part_name = $row[1];
                                                    $part_location = $row[2];
                                                    $part_number = $row[3];
                                                    
                                                    ////////////
                                                    $Fpart_cost = (double)$row[4];
                                                    $part_cost = (double)$row[13];
                                                    /////////////

                                                    $part_selling = (double)$row[5];
                                                    $part_discount = $row[6];
                                                    $part_quantity = $row[7];
                                                    
                                                    $ItemStat = $row[9];

                                                    $total_cost += $part_cost * $part_quantity;
                                                    $total_selling += $part_selling * $part_quantity;
                                                    
                                                    if($ItemStat=='1'){
            
                                                    }else{

                                                    $CurrenceyDetailsNormal = explode("_",$ItemStat);
                                                    $CurrenceyNormal = $CurrenceyDetailsNormal[0];
                                                    $CurrenceyInLKRNormal = (double)$CurrenceyDetailsNormal[1];
                                                    $FreightClearenceNormal = (double)$CurrenceyDetailsNormal[2];
                                                    $PriceForreginNormal = (double)$CurrenceyDetailsNormal[3];
                                                    
                                                    $NormalInternationalLanding = $PriceForreginNormal + ($PriceForreginNormal * ($FreightClearenceNormal/100) );
                                                    
                                                    }


                                            
                                            ?>
                                            <?php if($part_quantity<=10){ ?>
                                            <tr class="gradeA" style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr class="gradeA" style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $row[0]; ?></td> 
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $part_location; ?></td>
                                                <td><b>Normal</b></td>
                                                <td><?php echo $row[7]; ?></td>
                                                <td><?php echo $row[8]; ?></td>
                                                
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($ItemStat=='1'){ echo '-'; }else{ ?>
                                                        <?php echo number_format($PriceForreginNormal,2).' '.$CurrenceyNormal; ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($ItemStat=='1'){ echo '-'; }else{ ?>
                                                        <?php echo $FreightClearenceNormal.'%'; ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($ItemStat=='1'){ echo '-'; }else{ ?>
                                                        <?php echo $NormalInternationalLanding; ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($ItemStat=='1'){ echo '-'; }else{ ?>
                                                        <?php echo number_format($CurrenceyInLKRNormal,2); ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                
                                                <td style="color: #000;"><b style="float: right;"><?php echo number_format($part_cost,2); ?></b></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($part_selling,2); ?></b></td>
                                            </tr>
                                            
                                            <?php } ?>


                                            <?php

                                                $total_cost_batch = 0;
                                                $total_selling_batch = 0;
                                                $Batchsql = "SELECT * FROM tbl_item ti INNER JOIN tbl_item_price_batch tipb ON ti.item_id=tipb.item_id WHERE tipb.qty > 0 ORDER BY ti.item_id DESC ";
                                                $Irs=$conn->query($Batchsql);
                                                while($Irow =$Irs->fetch_array())
                                                {
                                                    $item_id = $Irow[0];
                                                    $part_name = $Irow[1];
                                                    $part_location = $Irow[2];
                                                    $part_number = $Irow[3];
                                                    $part_remark = $Irow[8];
                                                    
                                                    $GRN = $Irow[13];
                                                    $CostBatchPrice = (double)$Irow[14];
                                                    $SellingBatchPrice = (double)$Irow[15];
                                                    $BatchQty = $Irow[16];
                                                    $BatchLabel = $Irow[17];
                                                    $PBStat = $Irow[18];

                                                    if($PBStat=='0'){
            
                                                    }else{

                                                    $CurrenceyDetails = explode("_",$PBStat);
                                                    $Currencey = $CurrenceyDetails[0];
                                                    $CurrenceyInLKR = (double)$CurrenceyDetails[1];
                                                    $FreightClearence = (double)$CurrenceyDetails[2];
                                                    $PriceForregin = (double)$CurrenceyDetails[3];
                                                    
                                                    $PBInternationalLanding = $PriceForregin + ($PriceForregin * ($FreightClearence/100) );
                                                    
                                                    }

                                                    $total_cost_batch += $CostBatchPrice * $BatchQty;
                                                    $total_selling_batch += $SellingBatchPrice * $BatchQty;

                                                


                                            ?>

                                            <?php if($BatchQty<=10){ ?>
                                            <tr class="gradeA" style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr class="gradeA" style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $item_id; ?></td> 
                                                <td><?php echo $part_name; ?></td>
                                                <td><?php echo $part_number; ?></td>
                                                <td><?php echo $part_location; ?></td>
                                                <td><b><?php echo $BatchLabel; ?></b></td>
                                                <td><?php echo $BatchQty; ?></td>
                                                <td><?php echo $part_remark; ?></td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($PBStat=='0'){ echo '-'; }else{ ?>
                                                        <?php echo number_format($PriceForregin,2).' '.$Currencey; ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($PBStat=='0'){ echo '-'; }else{ ?>
                                                        <?php echo $FreightClearence.'%'; ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($PBStat=='0'){ echo '-'; }else{ ?>
                                                        <?php echo $PBInternationalLanding; ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td>
                                                    <b style="float: right;">
                                                    <?php if($PBStat=='0'){ echo '-'; }else{ ?>
                                                        <?php echo number_format($CurrenceyInLKR,2); ?>
                                                    <?php } ?>
                                                    </b>
                                                </td>
                                                <td style="color: #000;"><b style="float: right;"><?php echo number_format($CostBatchPrice,2); ?></b></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($SellingBatchPrice,2); ?></b></td>
                                            </tr>
                                            
                                            <?php } ?>



                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>

                                                <?php 
                                                    $FullCost= $total_cost+$total_cost_batch;
                                                    $FullSelling= $total_selling+$total_selling_batch;
                                                ?>

                                                <th style="color: #FF0000;"><b style="float: right; font-size: 25px;"><?php echo number_format($FullCost,2); ?></b></th>
                                                <th style="color: #008000;"><b style="float: right; font-size: 25px;"><?php echo number_format($FullSelling,2); ?></b></th>
                                            </tr>
                                        </tfoot>
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

<script>
    $(document).ready( function () {
        $('#stockTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf', 'print'
            'print', 'excel', 'pdf'
        ]
    });
        $('.js-example-basic-single').select2();
    } );
</script>

<script>
    function onPartChanged(){
        var val=$("#select-part").val();
       

        $.ajax({
            url:'stock_post/get_price_batch_for_add_stock.php',
            type:'POST',
            data:{
                part_no:val
            },
            success:function(data){
               
                var json = JSON.parse(data);
                if(json.result){

                    $("#price_batch_id").html(json.data);



                }




            },error:function(err){
                console.log(err);
            }



        //
    });


    }
</script>

    <script>
        
        $(document).on('submit', '#Update-Stock', function(e){
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

                url:"post/update_stock.php",
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
                      text:'Successfully Stock Added.'
                    });


                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>



</body>
</html>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php } ?>