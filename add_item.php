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
                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        
                         <h4>Items</h4>
                        
                        <form class="card" id="Item-Register-Form">
                            <div class="card-body">
                                <h3 class="card-title">Add Item</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Part Number <font style="color: #FF0000;">*</font><span id="part-no" style="color: black; text-align: right !important; position: absolute; right: 15px;"></span></label>
                                            <input type="text" class="form-control" name="part_number" id="part_number" placeholder="Part Number" oninput="return part_number_check();" onkeypress="return blockSpecialChar(event)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Part Name <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" id="part_name" name="part_name" placeholder="Part Name" onkeypress="return blockSpecialChar(event)" onPaste="return blockSpecialChar(event)" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Cost Price (Rs.) <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="part_cost" id="part_cost" placeholder="Cost Price." onkeypress="return blockSpecialChar(event)" required>
                                            <span style="font-size: 10px; color: #FF0000; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Please don't use special characters for cost price, Here examples ~`!@#$%^&*()-_+={}[]|\;:<>,/?">Please don't use special characters for cost price</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Selling Price (Rs.) <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="selling_cost" id="selling_cost" placeholder="Selling Price." onkeypress="return blockSpecialChar(event)" required>
                                            <span style="font-size: 10px; color: #FF0000; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Please don't use special characters for cost price, Here examples ~`!@#$%^&*()-_+={}[]|\;:<>,/?">Please don't use special characters for selling price</span>
                                        </div>
                                    </div>

                                    <!-------Start Price International---------->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Select Currency</label>
                                                <select class="form-control" name="currency_method">
                                                    <option value="">Select Currency</option>
                                                    <option value="GBP" selected>GBP</option>
                                                    <option value="SGD">SGD</option>
                                                    <option value="US-DOLLER">US-DOLLER</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">Cost Price international</label>
                                                <input type="number" class="form-control" min="0" name="cost_price_international" step="any" placeholder="Cost Price international">
                                            </div>
                                        </div>

                                        <input type="hidden" class="form-control" min="0" value="0" name="currency_in_lkr" placeholder="Currency in LKR" required>
                                        <input type="hidden" class="form-control" min="0" value="0" name="freight_clearance" placeholder="Freight & Clearance %" required>

                                    <!-------End Price International---------->

                                    <div class="col-md-12" style="display: none;">
                                        <div class="form-group">
                                            <label class="form-label">Discount (%) </label>
                                            <input type="text" class="form-control" name="discount" id="discount" value="0" placeholder="Discount (%)" required readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Part Location</label>
                                            <input type="text" class="form-control" name="part_location" placeholder="Part Location">
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="form-label">Remark </label>
                                            <textarea class="form-control" name="remark" placeholder="Remark" rows="3"></textarea>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Add Item</button>
                            </div>
                        </form>





                    </div>
                    
                </div>




                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Items</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="itemTable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Part Name</th>
                                                <th>Part Location</th>
                                                <th>Part Number</th>
                                                <th>Remark</th>
                                                <th>Quantity</th> 
                                                <th>Registration Date</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php

                                                $sql = "SELECT * FROM tbl_item ORDER BY item_id DESC";
                                                $rs=$conn->query($sql);
                                                while($row =$rs->fetch_array())
                                                {
                                                    $part_id = $row[0];
                                                    $reg_date = date('d-m-Y', strtotime($row[10])) ;
                                                    $part_name = $row[1];
                                                    $part_location = $row[2];
                                                    $part_number = $row[3];
                                                    $part_cost = (double)$row[4];
                                                    $part_selling = (double)$row[5];

                                                    $part_discount = $row[6];
                                                    $part_quantity = $row[7];
                                                    $part_remark = $row[8];
                                            
                                            ?>
                                            <?php

                                                $SumQTYPriceBadgesql = "SELECT SUM(qty) FROM tbl_item_price_batch WHERE item_id='$part_id'";
                                                $SQrs=$conn->query($SumQTYPriceBadgesql);
                                                if($SQrow =$SQrs->fetch_array())
                                                {
                                                    $QtyPriceBatchSum=$SQrow[0];
                                                }
                                                $TotalQty=$part_quantity+$QtyPriceBatchSum;
                                            ?>
                                            <?php if($part_quantity<=10){ ?>
                                            <tr class="gradeA" style="background-color: #ffcccc66;">
                                            <?php }else{ ?>
                                            <tr class="gradeA" style="background-color: #00800033;">
                                            <?php } ?>
                                                <td><?php echo $row[0]; ?></td> 
                                                <td><?php echo $row[1]; ?></td>
                                                <td><?php echo $row[2]; ?></td>
                                                <td><?php echo $row[3]; ?></td>
                                                <td><?php echo $row[8]; ?></td>
                                                <td><font style="font-weight: 600;"><?php echo $TotalQty; ?></font></td>
                                                <td><?php echo $reg_date; ?></td>
                                                <td class="actions">
                                                    <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="modal"
                                                    data-target="#exampleModalCenter<?php echo $row[0]; ?>"><i class="icon-pencil" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Edit Item Details"></i></button>

                                                    <!-- <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="modal"
                                                    data-target="#exampleModalCenterPriceBadge<?php //echo $row[0]; ?>"><i class="icon-equalizer" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="Add New Price Batches"></i></button> -->

                                                    <button class="btn btn-sm btn-icon on-default m-r-5 button-edit" data-toggle="modal"
                                                    data-target="#exampleModalCenterPriceBadgeView<?php echo $row[0]; ?>"><i class="icon-control-play" aria-hidden="true" data-toggle="tooltip" data-placement="left" title="View Price Batches"></i></button>
                                                </td>
                                            </tr>

                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModalCenter<?php echo $row[0]; ?>" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update <?php echo $row[1]; ?></h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            
                                                            <form id="Update-Item" method="POST">
                                                                <input type="hidden" class="form-control" name="item_id" id="item_id" value="<?php echo $row[0]; ?>" required>
                                                                    <!-- <div class="panel-heading clearfix">
                                                                        <h4 class="panel-title">Register Client Details</h4>
                                                                    </div> -->
                                                                    <div class="panel-body">

                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label for="part_name">Part Name <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="part_name" id="part_name_update_<?php echo $row[0]; ?>" placeholder="Part Name" value="<?php echo $part_name; ?>" onPaste="textPaste('part_name_update_<?php echo $row[0]; ?>')" onkeypress="return blockSpecialChar(event)" required>
                                                                            </div>
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                            
                                                                              <div class="form-group">
                                                                                <label for="part_number">Part Number <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="part_number" id="part_number_update_<?php echo $row[0]; ?>" onPaste="textPaste('part_number_update_<?php echo $row[0]; ?>')" placeholder="Part Number" value="<?php echo $part_number; ?>" onkeypress="return blockSpecialChar(event)" required>
                                                                              </div>
                                                                              
                                                                              <!-- <div class="form-group">
                                                                                <label for="part_cost_real">Part Cost Price <font style="color: #FF0000;">**</font></label>
                                                                                <input type="text" class="form-control" name="part_cost_real" id="part_cost_real_update_<?php //echo $row[0]; ?>" onPaste="textPaste('part_cost_real_update_<?php //echo $row[0]; ?>')" placeholder="Part Cost Price" value="<?php //echo $part_cost; ?>" onkeypress="return blockSpecialChar(event)" required>

                                                                                <span style="font-size: 10px; color: #FF0000; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Please don't use special characters for cost price, Here examples ~`!@#$%^&*()-_+={}[]|\;:<>,/?">Please don't use special characters for cost price</span>

                                                                              </div> -->

                                                                              
                                                                        </div>

                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="part_location">Part Location </label>
                                                                                <input type="text" class="form-control" name="part_location" id="part_location" placeholder="Part Location" value="<?php echo $part_location; ?>">
                                                                              </div>

                                                                              <!-- <div class="form-group">
                                                                                <label for="part_selling">Part Selling Price <font style="color: #FF0000;">*</font></label>
                                                                                <input type="text" class="form-control" name="part_selling" id="part_selling_update_<?php //echo $row[0]; ?>" onPaste="textPaste('part_selling_update_<?php //echo $row[0]; ?>')" placeholder="Part Selling Price" value="<?php //echo $part_selling; ?>" onkeypress="return blockSpecialChar(event)" required>

                                                                                <span style="font-size: 10px; color: #FF0000; cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Please don't use special characters for cost price, Here examples ~`!@#$%^&*()-_+={}[]|\;:<>,/?">Please don't use special characters for selling price</span>

                                                                              </div> -->
                                                                              
                                                                        </div>

                                                                        <div class="col-md-12" style="display: none;">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="part_discount">Part Discount </label>
                                                                                <input type="number" class="form-control" name="part_discount" id="part_discount" placeholder="Part Discount" value="<?php echo $part_discount; ?>" readonly>
                                                                              </div>

                                                                              
                                                                        </div>
                                                                        
                                                                        <div class="col-md-12">
                                                                           
                                                                              <div class="form-group">
                                                                                <label for="part_remark">Remark </label>
                                                                                <input type="text" class="form-control" name="part_remark" id="part_remark" placeholder="Remark" value="<?php echo $part_remark; ?>">
                                                                              </div>

                                                                              
                                                                        </div>



                                                                    </div>
                                                                    <button type="submit" class="btn btn-primary waves-effect waves-light">Update</button>
                                                                
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

                <?php

                    $Batchsql = "SELECT * FROM tbl_item ORDER BY item_id DESC";
                    $Brs=$conn->query($Batchsql);
                    while($Brow =$Brs->fetch_array())
                    {
                        $Batchpart_id = $Brow[0];
                        $Batchpart_name = $Brow[1];
                                            
                ?>

                <!--Price batch View Modal -->
                <div class="modal fade" id="exampleModalCenterPriceBadgeView<?php echo $Batchpart_id; ?>" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLongTitle">View Price Batchs For <?php echo $Batchpart_name; ?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">

                                <div class="card-status bg-blue"></div>
                                <table class="table table-responsive table-hover table-vcenter table-striped" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>GRN</th>
                                            <th>GRN Type</th>
                                            <th>Price Batch Label</th>
                                            <th><font style="float: right;">Part Cost (.Rs)</font></th>
                                            <th></th>
                                            <th><font style="float: right;">Part Selling Price (.Rs)</font></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php

                                        $NormalPriceBatchsql = "SELECT * FROM tbl_item tit INNER JOIN tbl_item_cost tic ON tit.item_id=tic.item_id WHERE tit.item_id='$Batchpart_id' ";
                                        $NPBrs=$conn->query($NormalPriceBatchsql);
                                        if($NPBrow =$NPBrs->fetch_array())
                                        {
                                            $item_id = $NPBrow[0];
                                            $NormalStat = $NPBrow[9];
                                            //$PriceBatchpart_cost = (double)$NPBrow[4];
                                            $PriceBatchpart_cost = (double)$NPBrow[13];
                                            $PriceBatchpart_selling = (double)$NPBrow[5];

                                            if ($NormalStat=='1') {
            
                                            }else{
                                                $CurrenceyNormalDetails = explode("_",$NormalStat);
                                                $CurrenceyNormal = $CurrenceyNormalDetails[0];
                                                $CurrenceyNormalInLKR = (double)$CurrenceyNormalDetails[1];
                                                $NormalFreightClearence = (double)$CurrenceyNormalDetails[2];
                                                $PriceForreginNormal = (double)$CurrenceyNormalDetails[3];
                                            }
                                                                
                                    ?>

                                        <tr>
                                            <td>1</td>
                                            <td>NORMAL</td>
                                            <td>-</td>
                                            <td>NORMAL</td>
                                            <td><font style="float: right;"><input type="text" id="lbl_cost_0_<?php echo $item_id;?>" style="border:0px #ffffff00; text-align: right; background-color: #ffffff00;" name="" value="<?php echo number_format($PriceBatchpart_cost,2); ?>"></font><br>
                                                <?php if($NormalStat=='1'){ }else{ ?>
                                                    <font style="float: right; font-weight: 600; font-size: 10px;">
                                                        <?php echo $CurrenceyNormal.' - '.$CurrenceyNormalInLKR.' X '.$NormalFreightClearence.'% X '.$PriceForreginNormal; ?>
                                                    </font>
                                                <?php } ?>
                                            </td>
                                            <!-- <td><font style="float: right;"><?php //echo number_format($PriceBatchpart_cost,2); ?></font></td> -->
                                                
                                            <td>
                                                <button type="button" class="btn btn-info waves-effect waves-light" onclick="updateCostPrice('0','<?php echo $item_id;?>',document.getElementById('lbl_cost_0_<?php echo $item_id;?>').value)" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Update Cost Price"><i class="fa fa-pencil-square"></i></button>
                                            </td>
                                            <td><font style="float: right;"><input type="text" id="lbl_0_<?php echo $item_id;?>" style="border:0px #ffffff00; text-align: right; background-color: #ffffff00;" name="" value="<?php echo number_format($PriceBatchpart_selling,2); ?>"></font></td>
                                            <td>
                                                <button type="button" class="btn btn-primary waves-effect waves-light" onclick="updateSellingPrice('0','<?php echo $item_id;?>',document.getElementById('lbl_0_<?php echo $item_id;?>').value)" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Update Selling Price"><i class="fa fa-pencil-square"></i></button>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                    <?php
                                        $PriceBatchCount=1;
                                        $PriceBatchsql = "SELECT * FROM tbl_item_price_batch WHERE item_id='$Batchpart_id' ";
                                        $PBrs=$conn->query($PriceBatchsql);
                                        while($PBrow =$PBrs->fetch_array())
                                        {
                                            $PriceBatchId = $PBrow[0];
                                            $item_id = $PBrow[1];
                                            $PriceBatchGRN = $PBrow[2];
                                            $PriceBatchLabel = $PBrow[6];
                                            $PriceBatchCost = (double)$PBrow[3];
                                            $PriceBatchSelling = (double)$PBrow[4];

                                            $PBStat = $PBrow[7];

                                            if ($PBStat=='0') {
            
                                            }else{

                                            $CurrenceyDetails = explode("_",$PBStat);
                                            $Currencey = $CurrenceyDetails[0];
                                            $CurrenceyInLKR = (double)$CurrenceyDetails[1];
                                            $FreightClearence = (double)$CurrenceyDetails[2];
                                            $PriceForregin = (double)$CurrenceyDetails[3];
                                            }
                                                                
                                    ?>

                                        <tr>
                                            <td><?php echo $PriceBatchCount+=1; ?></td>
                                            <td>
                                                <?php if($PBStat=='0'){ ?>
                                                    <?php echo $PriceBatchGRN; ?>
                                                <?php }else{ ?>
                                                    <?php 
                                                        $PriceBatchGRNNumber=(double)$PriceBatchGRN;
                                                    ?>
                                                    <?php echo $PriceBatchGRNNumber+10000; ?>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if($PBStat=='0'){ ?>
                                                    LOCAL
                                                <?php }else{ ?>
                                                    INTERNATIONAL
                                                <?php } ?>
                                            </td>
                                            <td><?php echo $PriceBatchLabel; ?></td>

                                            <?php if($PBStat=='0'){ ?>
                                            <td><font style="float: right;"><input type="text" id="lbl_cost_<?php echo $PriceBatchId;?>" style="border:0px #ffffff00; text-align: right; background-color: #ffffff00;" name="" value="<?php echo number_format($PriceBatchCost,2); ?>"></font></td>
                                            <!-- <td><font style="float: right;"><?php //echo number_format($PriceBatchCost,2); ?></font></td> -->
                                            <td>
                                                <button type="button" onclick="updateCostPrice('<?php echo $PriceBatchId;?>','<?php echo $item_id;?>',document.getElementById('lbl_cost_<?php echo $PriceBatchId;?>').value)" class="btn btn-info waves-effect waves-light" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Update Cost Price"><i class="fa fa-pencil-square"></i></button>
                                            </td>
                                            <?php }else{?>
                                            <td>
                                                <?php if($PriceBatchGRN=='0'){ ?>
                                                    <font style="float: right;"><input type="text" id="lbl_cost_<?php echo $PriceBatchId;?>" style="border:0px #ffffff00; text-align: right; background-color: #ffffff00;" name="" value="<?php echo number_format($PriceBatchCost,2); ?>"></font><br>
                                                    <font style="float: right; font-weight: 600; font-size: 10px;">
                                                        <?php echo $Currencey.' - '.$CurrenceyInLKR.' X '.$FreightClearence.'% X '.$PriceForregin; ?>
                                                    </font>
                                                <?php }else{ ?>
                                                    <font style="float: right;"><?php echo number_format($PriceBatchCost,2); ?></font><br>
                                                    <font style="float: right; font-weight: 600; font-size: 10px;">
                                                        <?php echo $Currencey.' - '.$CurrenceyInLKR.' X '.$FreightClearence.'% X '.$PriceForregin; ?>
                                                    </font>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <?php if($PriceBatchGRN=='0'){ ?>
                                                    <button type="button" onclick="updateCostPrice('<?php echo $PriceBatchId;?>','<?php echo $item_id;?>',document.getElementById('lbl_cost_<?php echo $PriceBatchId;?>').value)" class="btn btn-info waves-effect waves-light" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Update Cost Price"><i class="fa fa-pencil-square"></i></button>
                                                <?php }else{ }?>
                                                
                                            </td>
                                            <?php } ?>

                                            <td><font style="float: right;"><input type="text" id="lbl_<?php echo $PriceBatchId;?>" style="border:0px #ffffff00; text-align: right; background-color: #ffffff00;" name="" value="<?php echo number_format($PriceBatchSelling,2); ?>"></font></td>
                                            <td>
                                                <button type="button" onclick="updateSellingPrice('<?php echo $PriceBatchId;?>','<?php echo $item_id;?>',document.getElementById('lbl_<?php echo $PriceBatchId;?>').value)" class="btn btn-primary waves-effect waves-light" aria-hidden="true" data-toggle="tooltip" data-placement="bottom" title="Update Selling Price"><i class="fa fa-pencil-square"></i></button>
                                            </td>
                                        </tr>

                                    <?php } ?>

                                    </tbody>
                                </table>


                                </div>
                            <div class="modal-footer">
                                <!-- <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button> -->
                            </div>
                        </div>
                    </div>
                </div>

                <?php } ?>

            </div>
        </div>

        <!-- Start page footer -->
        <?php include_once('controls/footer.php'); ?>

    </div>
</div>

        <!-------Event Start------------>
        <div class="alert alert-success solid alert-dismissible fade" role="alert" id="success_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-check"></i> <strong>Success!</strong> <span id="success_msg"></span>
        </div>
        <!--------Event End----------->
                            
        <!-------Waiting  Upload Event Start------------>
        <div class="alert alert-warning solid alert-dismissible fade" role="alert" id="progress_upload_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> <strong>Please Wait...</strong>
            <div class="progress" style="height:20px">
                <div class="progress-bar bg-success" style="width:0%;" id="upload-bar"><span id="upload-bar-label">0%</span></div>
            </div>
        </div>
        <!--------Waiting Upload  Event End----------->                   
                            
        <!-------Waiting Event Start------------>
        <div class="alert alert-warning solid alert-dismissible fade" role="alert" id="progress_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> <strong>Please Wait...</strong>
        </div>
        <!--------Waiting Event End----------->
                            
        <!-------Error Event Start------------>
        <div class="alert alert-danger solid alert-dismissible fade" role="alert" id="danger_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-times"></i> <strong>Error!</strong> <span>Something went wrong...</span>
        </div>
        <!--------Error Event End----------->

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<script src="assets/assets/bundles/selectize.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/vendors/selectize.js"></script>

<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>


<script>
    
    function updateSellingPrice(batchId,itemId,newPrice){
       
        $.ajax({
            url:'grn_post/price_batch_selling_price_update.php',
            type:'POST',
            data:{
                batch_id:batchId,
                item_id:itemId,
                new_price:newPrice
            },
            success:function(data){

                var json = JSON.parse(data);

                $("#success_msg").html(json.msg);
                $("#success_alert").addClass('show');
                       
                setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
            },
            error:function(err){
                $("#danger_alert").addClass('show');
                setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
            }



        });




    }




</script>

<script>
    
    function updateCostPrice(batchId,itemId,newPrice){
       
        $.ajax({
            url:'grn_post/price_batch_cost_price_update.php',
            type:'POST',
            data:{
                batch_id:batchId,
                item_id:itemId,
                new_price:newPrice
            },
            success:function(data){

                var json = JSON.parse(data);

                $("#success_msg").html(json.msg);
                $("#success_alert").addClass('show');
                       
                setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
            },
            error:function(err){
                $("#danger_alert").addClass('show');
                setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
            }



        });




    }




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
        $('#itemTable').DataTable();

        $( "#part_name" ).bind( 'paste',function()
       {

        setTimeout(function()
           { 
              //get the value of the input text
              var data= $( '#part_name' ).val() ;
              //replace the special characters to '' 
              var dataFull = data.replace('\,', '');
              //set the new value of the input text without special characters
              $( '#part_name' ).val(dataFull);
           });

        });
        $( "#part_number" ).bind( 'paste',function()
       {

        setTimeout(function()
           { 
              //get the value of the input text
              var data= $( '#part_number' ).val() ;
              //replace the special characters to '' 
              var dataFull = data.replace('\,', '');
              //set the new value of the input text without special characters
              $( '#part_number' ).val(dataFull);
           });

        });
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
        $( "#selling_cost" ).bind( 'paste',function()
       {

        setTimeout(function()
           { 
              //get the value of the input text
              var data= $( '#selling_cost' ).val() ;
              //replace the special characters to '' 
              var dataFull = data.replace('\,', '');
              //set the new value of the input text without special characters
              $( '#selling_cost' ).val(dataFull);
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
        function part_number_check()
        {
            var part_number=document.getElementById('part_number').value;
            var dataString='part_number='+  part_number;
            $.ajax({

                type:"post",
                url: "controls/part_number_check.php",
                data:dataString,
                cache: false,

                success: function(html) {

                    $('#part-no').html(html);
                    return d = true;
                }

            });

            return false;
        }
    </script>


    <script>
        
        $(document).on('submit', '#Item-Register-Form', function(e){
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

                url:"post/submit_item.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");



                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Added Item.'
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

    <script>
        
        $(document).on('submit', '#Update-Item', function(e){
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

                url:"post/update_item.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");



                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Updated Item.'
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

    <script>
        
        $(document).on('submit', '#Add-Price-Batch', function(e){
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

                url:"stock_post/add_price_batch.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function () {
                    // swal("Thanks !","Successfully Added Your Details.","success");



                    Swal.fire({
                      title:'Thanks !',
                      icon:'success',
                      text:'Successfully Added Price Batch.'
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