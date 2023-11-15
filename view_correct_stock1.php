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
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Stock</h3>
                            </div>
                            <div class="card-body">
                                
                                
                                
                                
                                <input type="hidden" id="thid" />
                                
                                
                                
                                
                                
                                
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="stockTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Part Name</th>
                                                <th>Part Number</th>
                                                <th>Part Quantity</th>
                                                <th>Remark</th>
                                                <th>Part Cost Price (.Rs)</th>
                                                <th>Part Selling Price (.Rs)</th>
                                                <th>Action</th>
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
                                                    $part_name = $row[1];
                                                    $part_location = $row[2];
                                                    $part_number = $row[3];
                                                    $part_selling = (double)$row[5];
                                                    $part_discount = $row[6];
                                                    $part_quantity = $row[7];
                                                    $part_cost = (double)$row[13];
                                            ?>
                                            <?php if($part_quantity<=10){ ?>
                                            <tr class="gradeA" style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr class="gradeA" style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $row[0]; ?></td> 
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[7]; ?></td>
                                                <td><?php echo $row[8]; ?></td>
                                                <td style="color: #FF0000;"><b style="float: right;"><?php echo number_format($part_cost,2); ?></b></td>
                                                <td style="color: #008000;"><b style="float: right;"><?php echo number_format($part_selling,2); ?></b></td>
                                                <td>
                                                    <button type="button" class="btn btn-primary" data-toggle="modal" onclick="demoF('<?php echo 'ChangeCostModalCenter'.$row[0]?>')" data-target="#ChangeCostModalCenter<?php echo $row[0]; ?>">
                                                      <i class="fa fa-pencil" aria-hidden="true"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            
                                            <!-- Modal -->
                                            <div class="modal fade" id="ChangeCostModalCenter<?php echo $row[0]; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                              <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                  <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLongTitle">Update Selling <?php echo $part_name; ?></h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                      <span aria-hidden="true">&times;</span>
                                                    </button>
                                                  </div>
                                                  <form id="Update-Real-Selling" method="POST">
                                                      <div class="modal-body">
                                                        <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $row[0]; ?>" required>
                                                        <div class="form-group">
                                                            <label for="part_selling_real">Part Selling Price <font style="color: #FF0000;">**</font></label>
                                                            <input type="text" class="form-control" name="part_selling_real" id="part_cost_real_update_<?php echo $row[0]; ?>" onPaste="textPaste('part_cost_real_update_<?php echo $row[0]; ?>')" placeholder="Part Selling Price" value="<?php echo $part_selling; ?>" onkeypress="return blockSpecialChar(event)" required>
                                                            <span style="font-size: 10px; color: #FF0000; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Please don't use special characters for cost price, Here examples ~`!@#$%^&*()-_+={}[]|\;:<>,/?">Please don't use special characters for cost price</span>
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
<script src="assets/assets/bundles/selectize.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/vendors/selectize.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script>

    function demoF(val){
        // alert(val);
        
        $("#thid").val(val);
        
        
    }


    $(document).ready( function () {
        $('#stockTable').DataTable();
        $('.js-example-basic-single').select2();
    } );
</script>

<script>
    function textPaste(comp){
             setTimeout(function()
           { 
              //get the value of the input text
              var data= $("#"+comp).val() ;
              //replace the special characters to '' 
              var dataFull = data.replace('\,', '');
              //set the new value of the input text without special characters
              $("#"+comp).val(dataFull);
           });

        }
        
        $(document).ready( function () {
        $( "#part_cost" ).bind( 'paste',function()
       {

        setTimeout(function()
           { 
              //get the value of the input text
              var data= $( '#part_cost' ).val() ;
              //replace the special characters to '' 
              var dataFull = data.replace('\,', '');
              //set the new value of the input text without special characters
              $( '#part_cost' ).val(dataFull);
           });

        });
       

        



    } );
</script>

    <script>
        function blockSpecialChar(e) {
            var k = e.keyCode;

            if(k === 44){
                return false;
            }else{
                return true;
            }

            // return ((k > 64 && k < 91) || (k > 96 && k < 123) || k == 8   || (k >= 48 && k <= 57));
        }
    </script>
    
    <script>
        
        $(document).on('submit', '#Update-Real-Selling', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    // swal("Info !","Still Your Details Sending Please Be Patient !","info", {button:false,closeOnClickOutside: false});


                    Swal.fire({
                      title:'Info !',
                      icon:'info',
                      text:'Details is being sending...Please wait.',
                      showConfirmButton:false,
                      showCancelButton:false,
                      allowOutsideClick: false,
                    });

                },

                url:"post/update_item_selling_price.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");

                    swal.close();
                    
                     var dcid = $("#thid").val();
                     $("#"+dcid).modal("hide");
                     
                     

                    // Swal.fire({
                    //   title:'Thanks !',
                    //   icon:'success',
                    //   text:'Successfully Updated Item.'
                    // });


                    setTimeout(function () {
                        //window.location.href = "all_clients.php";
                    //   location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

   
</body>
</html>
