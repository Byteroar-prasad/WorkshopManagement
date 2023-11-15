<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentYear=date('Y');

    $vehicleId= base64_decode($_GET['v_id']);
    
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
        ?>vi

            <script type="text/javascript">
                window.location.href="login.php";
            </script>

        <?php
    }
?>


    <?php
        $getDataQuery=$conn->query("SELECT * FROM tbl_vehicle_details WHERE v_id = '$vehicleId' ");
        while ($rs=$getDataQuery->fetch_array()) {

          $vehicleId=$rs[0];
          $customer_email=$rs[1];
          $reg_date=$rs[2];
          $reg_customer=$rs[3];
          $reg_phone_no=$rs[4];
          $f_reg_date=$rs[5];
          $service_booklet=$rs[6];
          $soc_hv_battery=$rs[7];
          $reg_model=$rs[8];
          $reg_chassis_no=$rs[9];
          $reg_licens_no=$rs[10];

          $reg_mileage=$rs[11];
          $reg_fuel=$rs[12];
          $reg_customer_charging=$rs[13];
          $display=$rs[14];
          $display_remark=$rs[15];
          $interior_lights=$rs[16];
          $interior_lights_remark=$rs[17];
          $signals=$rs[18];


          $signals_remark=$rs[19];
          $steering=$rs[20];
          $steering_remark=$rs[21];
          $hand_brake=$rs[22];
          $hand_brake_remark=$rs[23];
          $aircon=$rs[24];
          $aircon_remark=$rs[25];
          $wiper_blades=$rs[26];


          $wiper_blades_remark=$rs[27];
          $windows_glass=$rs[28];
          $windows_glass_remark=$rs[29];
          $replace_microfilter=$rs[30];
          $replace_microfilter_remark=$rs[31];
          $coolant=$rs[32];
          $coolant_remark=$rs[33];
          $engine_oil=$rs[34];


          $engine_oil_remark=$rs[35];
          $v_belt=$rs[36];
          $v_belt_remark=$rs[37];
          $noticeble_leaks=$rs[38];
          $noticeble_leaks_remark=$rs[39];
          $damage_animals=$rs[40];
          $damage_animals_remark=$rs[41];
          $annual_check=$rs[42];

          $shock=$rs[43];
          $shock_remark=$rs[44];
          $tyre_tread=$rs[45];
          $tyre_tread_remark=$rs[46];
          $engine_gearbox=$rs[47];
          $engine_gearbox_remark=$rs[48];
          $front_axle=$rs[49];
          $front_axle_remark=$rs[50];

          $front_brake=$rs[51];
          $front_brake_remark=$rs[52];
          $rear_axle=$rs[53];
          $rear_axle_remark=$rs[54];
          $rear_brake=$rs[55];
          $rear_brake_remark=$rs[56];
          $brake_lines=$rs[57];
          $brake_lines_remark=$rs[58];


          $exhaust_system=$rs[59];
          $exhaust_system_remark=$rs[60];
          $fuel_tank=$rs[61];
          $fuel_tank_remark=$rs[62];
          $comments=$rs[63];
          $vehicle_screen=$rs[64];
          $r_f_tyre_tread=$rs[65];
          $r_b_tyre_tread=$rs[66];


          $l_f_tyre_tread=$rs[67];
          $l_b_tyre_tread=$rs[68];
          $body_work=$rs[69];
          $spare_wheel=$rs[70];
          $jack=$rs[71];
          $tools=$rs[72];
          $cd=$rs[73];
          $lighter=$rs[74];


          $sim=$rs[75];
          $extra=$rs[76];
          $amount=$rs[77];
          $pay=$rs[78];
          $stat=$rs[79];
          $service_adviosor_name=$rs[80];
          $workshop_name=$rs[81];


          $power_window=$rs[82];
          $power_window_remark=$rs[83];
          $exterior_lights=$rs[84];
          $exterior_lights_remark=$rs[85];
          $horn=$rs[86];
          $horn_remark=$rs[87];
          $grab_handles=$rs[88];

          $grab_handles_remark=$rs[89];
          $sun_roof=$rs[90];
          $sun_roof_remark=$rs[91];
          $speaker_covers=$rs[92];
          $speaker_covers_remark=$rs[93];
          $carpets=$rs[94];
          $carpets_remark=$rs[95];
          $seat_covers=$rs[96];
          $seat_covers_remark=$rs[97];
          $rear_display=$rs[98];
          $rear_display_remark=$rs[99];

          $f_l_breakpad_t=$rs[100];
          $f_r_breakpad_t=$rs[101];
          $b_l_breakpad_t=$rs[102];
          $b_r_breakpad_t=$rs[103];
          $f_l_breakdisk_t=$rs[104];
          $f_r_breakdisk_t=$rs[105];
          $b_l_breakdisk_t=$rs[106];
          $b_r_breakdisk_t=$rs[107];
          $road_test_special_comment=$rs[108];

          $reg_vehicle_date=$rs[109];
          
         

      ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link rel="stylesheet" href="assets/assets/plugins/summernote/dist/summernote.css"/>
<link rel="stylesheet" href="assets/assets/plugins/fullcalendar/fullcalendar.min.css">
</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

                    <style>
                          @media print {
                            @page {
                              size: auto;   /* auto is the initial value */
                              size: A4 portrait;
                              margin: 0;  /* this affects the margin in the printer settings */
                              border: 1px solid red;  /* set a border for all printed pages */
                            }
                            body {
                                zoom: 80%;
                                /*transform: scale(.6);*/
                                /*margin-top: -320px;*/
                                width: 100%;
                                font-weight: 700;
                            }
                            #print-page{
                                margin-left: -320px;
                                background-color: #fff !important;
                            }
                            #printPageButton {
                                display: none;
                            }
                            #page_top{
                                display: none;
                            }
                            #sidenav{
                                /*visibility: hidden !important;*/
                                display: none !important;
                            }
                            #footer{
                                display: none;
                            }
                            #logo-img{
                                width: 15% !important;
                            }
                        }

                    </style>

<!-- Start main html -->
<div id="main_content">

    <!-- Small icon top menu -->
    <div id="sidenav">
        <?php include_once('controls/side_nav.php'); ?>
    </div>

    <!-- start main body part-->
    <div class="page">

        <!-- start body header -->
        <div id="page_top" class="section-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <h1 class="page-title">Workshop Management</h1>
                    </div>
                    <div class="right">
                        <div class="notification d-flex">
                            <!-- <button type="button" class="btn btn-facebook"><i class="fa fa-info-circle mr-2"></i>Need Help</button>
                            <button type="button" class="btn btn-facebook"><i class="fa fa-file-text mr-2"></i>Data export</button> -->
                            <button type="button" class="btn btn-facebook" onclick="location.href='signout';"><i class="fa fa-power-off mr-2"></i>Sign Out</button>
                        </div>
                    </div>
                </div>
                <!-- <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="false">About</a>
                    </li>
                </ul> -->
            </div>
        </div>
        <div class="section-body py-4" id="print-page">
            <div class="container-fluid">
                <div class="row clearfix">
                    <div class="col-lg-4 col-md-12">
                        <div class="card">
                            <center>
                                <img class="card-img-top" id="logo-img" src="assets/logo-black-transparent.png" style="width: 30%;" alt="Card image cap">
                            </center>
                            <div class="card-body" style="text-align: center;">
                                <h4 class="card-title">
                                    Bavarian Automobile Engineering (Pvt) Ltd<br>
                                    <font style="font-size: 12px;">
                                        No 3/8, Gunasekara Gardens, Nawala, Rajagiriya<br>
                                        info@bae.lk<br>
                                        www.bae.lk
                                    </font>
                                </h4>

                                <?php
                                        $getDataQuery=$conn->query("SELECT * FROM users_login WHERE name = '$service_adviosor_name' ");
                                        while ($rs=$getDataQuery->fetch_array()) {
                                            
                                            $service_advisor_tel=$rs[5];
                                            
                                            ?>
                                    
                                    
                                    <small class="text-muted">Service Advisor - <?php echo $service_adviosor_name; ?> - <a href="tel:<?php echo $service_advisor_tel; ?>"><?php echo $service_advisor_tel; ?></a></small><br>
                                    
                                    <?php } ?>

                                    <small class="text-muted">Technician - <?php echo $workshop_name; ?></small>

                                <!-- <ul class="social-links list-inline mb-4">
                                    <li class="list-inline-item"><a href="javascript:void(0)" title="Facebook" data-toggle="tooltip"><i class="fa fa-facebook"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" title="Twitter" data-toggle="tooltip"><i class="fa fa-twitter"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" title="1234567890" data-toggle="tooltip"><i class="fa fa-phone"></i></a></li>
                                    <li class="list-inline-item"><a href="javascript:void(0)" title="@skypename" data-toggle="tooltip"><i class="fa fa-skype"></i></a></li>
                                </ul>
                                <p class="card-text">795 Folsom Ave, Suite 600 San Francisco, 94107</p>
                                <div class="row">
                                    <div class="col-4">
                                        <h6><strong>3265</strong></h6>
                                        <span>Post</span>
                                    </div>
                                    <div class="col-4">
                                        <h6><strong>1358</strong></h6>
                                        <span>Followers</span>
                                    </div>
                                    <div class="col-4">
                                        <h6><strong>10K</strong></h6>
                                        <span>Likes</span>
                                    </div>
                                </div> -->
                            </div>
                            
                                <div class="table-responsive">
                                    <table class="table table-bordered mb-0">
                                        
                                        <tbody>

                                        <tr>
                                            <th scope="row">Job Number</th>
                                            <td>BAE/JOB/<?php echo $currentYear; ?>/<?php echo (10000+$vehicleId); ?></td>
                                         
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Date</th>
                                            <td><?php echo $reg_date; ?></td>
                                         
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Customer</th>
                                            <td><?php echo $reg_customer; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Customer Email</th>
                                            <td><?php echo $customer_email; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Telephone No.</th>
                                            <td><?php echo $reg_phone_no; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">First Reg Date</th>
                                            <td><?php echo $f_reg_date; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Service Booklet</th>
                                            <td><?php echo $service_booklet; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">SOC (HV Battery)</th>
                                            <!--<td><?php echo $soc_hv_battery; ?> in %</td>-->
                                            
                                            <?php if ($soc_hv_battery != 'N/A') { ?>
                                            <td>

                                                <div class="progress progress-md">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $soc_hv_battery; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $soc_hv_battery; ?>%;">
                                                    <?php echo $soc_hv_battery; ?>%
                                                    </div>
                                                </div>

                                            </td>
                                            <?php }else{ ?>
                                            <td>
                                              N/A
                                            </td>
                                            <?php } ?>
                                            
                                        </tr>


                                        <tr>
                                            <th scope="row">Model</th>
                                            <td><?php echo $reg_model; ?></td>
                                         
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Chassis No.</th>
                                            <td><?php echo $reg_chassis_no; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">License No.</th>
                                            <td><?php echo $reg_licens_no; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Mileage/Km</th>
                                            <td><?php echo $reg_mileage; ?></td>
                                            
                                        </tr>
                                        <tr>
                                            <th scope="row">Fuel</th>
                                            <!-- <td><?php //echo $reg_fuel; ?></td> -->

                                            <td>

                                                <div class="progress progress-md">
                                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?php echo $reg_fuel; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $reg_fuel; ?>%;">
                                                    <?php echo $reg_fuel; ?>%
                                                    </div>
                                                </div>

                                            </td>
                                            
                                        </tr>
                                        <?php if ($reg_customer_charging=='') { }else{ ?>
                                        <tr>
                                            <th scope="row">Customer Charging Wish</th>
                                            <td><?php echo $reg_customer_charging; ?> in %</td>
                                            
                                        </tr>
                                        <?php } ?>

                                        </tbody>
                                    </table>
                                </div>



                            <!-- <div class="card-body">
                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-info btn-block"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                            </div> -->
                        </div>
                    </div>



                    <div class="col-lg-8 col-md-12">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                                <div class="card">
                                    <div class="card-header bline">
                                        <h3 class="card-title">Update Here</h3>
                                    </div>
                                    <div class="card-body">
                                      
                                        
                                        <form id="Update-Form" method="POST">
                                                    
                                                    
                                                    <input type="hidden" name="v_id" value="<?php echo $vehicleId; ?>" readonly>
                                                    
                                                    <!-- Vehicle & Engine Check -->
                                                    <?php if($wiper_blades!=='' AND $windows_glass!=='' AND $replace_microfilter!=='' AND $coolant!=='' AND $engine_oil!=='' AND $v_belt!=='' AND $noticeble_leaks!=='' AND $damage_animals!==''){ ?>

                                                      <input type="hidden" name="wiper_blades" value="<?php echo $wiper_blades?>"> 
                                                      <input type="hidden" name="wiper_blades_remark" value="<?php echo $wiper_blades_remark?>">
                                                      <input type="hidden" name="windows_glass" value="<?php echo $windows_glass?>"> 
                                                      <input type="hidden" name="windows_glass_remark" value="<?php echo $windows_glass_remark?>">
                                                      <input type="hidden" name="replace_microfilter" value="<?php echo $replace_microfilter?>"> 
                                                      <input type="hidden" name="replace_microfilter_remark" value="<?php echo $replace_microfilter_remark?>">
                                                      <input type="hidden" name="coolant" value="<?php echo $coolant?>">  
                                                      <input type="hidden" name="coolant_remark" value="<?php echo $coolant_remark?>">
                                                      <input type="hidden" name="engine_oil" value="<?php echo $engine_oil?>"> 
                                                      <input type="hidden" name="engine_oil_remark" value="<?php echo $engine_oil_remark?>">
                                                      <input type="hidden" name="v_belt" value="<?php echo $v_belt?>"> 
                                                      <input type="hidden" name="v_belt_remark" value="<?php echo $v_belt_remark?>">
                                                      <input type="hidden" name="noticeable_leaks" value="<?php echo $noticeble_leaks?>"> 
                                                      <input type="hidden" name="noticeable_leaks_remark" value="<?php echo $noticeable_leaks_remark?>">
                                                      <input type="hidden" name="damage_animals" value="<?php echo $damage_animals?>"> 
                                                      <input type="hidden" name="damage_animals_remark" value="<?php echo $damage_animals_remark?>">

                                                     <?php }else{?>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card m-b-30">
                                                                    <div class="card-body">
                                                                            <div id="inside-check-style" class="col-md-12  profile-detail">
                                                                                <div class="">
                                                                                    <h5 class="mb-0 py-2"> <img src="assets/icons/engine.png" style="width: 5%;"> Vehicle & Engine Check</h5><br>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                        <!--<h4 class="mt-0 header-title">Vehicle & Engine Check</h4>-->
                                                                        
                                                                        <?php if($wiper_blades!==''){ ?> <input type="hidden" name="wiper_blades" value="<?php echo $wiper_blades?>"> <input type="hidden" name="wiper_blades_remark" value="<?php echo $wiper_blades_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Wiper Blades</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="13" name="wiper_blades" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="13">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="14" name="wiper_blades" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="14">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="wiper_blades_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($windows_glass!==''){ ?> <input type="hidden" name="windows_glass" value="<?php echo $windows_glass?>"> <input type="hidden" name="windows_glass_remark" value="<?php echo $windows_glass_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Windows-glass</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="15" name="windows_glass" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="15">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="16" name="windows_glass" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="16">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="windows_glass_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($replace_microfilter!==''){ ?> <input type="hidden" name="replace_microfilter" value="<?php echo $replace_microfilter?>"> <input type="hidden" name="replace_microfilter_remark" value="<?php echo $replace_microfilter_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Replace microfilter</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="17" name="replace_microfilter" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="17">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="18" name="replace_microfilter" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="18">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="replace_microfilter_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($coolant!==''){ ?> <input type="hidden" name="coolant" value="<?php echo $coolant?>">  <input type="hidden" name="coolant_remark" value="<?php echo $coolant_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Cooling system (coolant)</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="19" name="coolant" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="19">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="20" name="coolant" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="20">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="coolant_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($engine_oil!==''){ ?> <input type="hidden" name="engine_oil" value="<?php echo $engine_oil?>"> <input type="hidden" name="engine_oil_remark" value="<?php echo $engine_oil_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Engine oil, Power steering & Brake fluid</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="21" name="engine_oil" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="21">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="22" name="engine_oil" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="22">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="engine_oil_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($v_belt!==''){ ?> <input type="hidden" name="v_belt" value="<?php echo $v_belt?>"> <input type="hidden" name="v_belt_remark" value="<?php echo $v_belt_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">V-belt/Poly V-belt</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio"> 
                                                                                        <input type="radio" id="23" name="v_belt" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="23">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="24" name="v_belt" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="24">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="v_belt_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($noticeble_leaks!==''){ ?> <input type="hidden" name="noticeable_leaks" value="<?php echo $noticeble_leaks?>"> <input type="hidden" name="noticeable_leaks_remark" value="<?php echo $noticeable_leaks_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Noticeable leaks</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="25" name="noticeable_leaks" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="25">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="26" name="noticeable_leaks" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="26">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" type="text" value="" placeholder="Remarks" name="noticeable_leaks_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($damage_animals!==''){ ?> <input type="hidden" name="damage_animals" value="<?php echo $damage_animals?>"> <input type="hidden" name="damage_animals_remark" value="<?php echo $damage_animals_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Damage by animals</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="27" name="damage_animals" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="27">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="28" name="damage_animals" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="28">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="damage_animals_remark">
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> 
                                                    <?php } ?>
                                                        <!-- end Vehicle & Engine Check -->
                                        
                                        
                                                        <!-- Vehicle check (half-raised) -->
                                                    <?php if($annual_check!=='' AND $shock!=='' AND $replace_microfilter!=='' AND $tyre_tread!==''){ ?>

                                                      <input type="hidden" name="annual_check" value="<?php echo $annual_check?>">
                                                      <input type="hidden" name="shock" value="<?php echo $shock?>"> 
                                                      <input type="hidden" name="shock_remark" value="<?php echo $shock_remark?>">
                                                      <input type="hidden" name="tyre_tread" value="<?php echo $tyre_tread?>"> 
                                                      <input type="hidden" name="tyre_tread_remark" value="<?php echo $tyre_tread_remark?>">

                                                    <?php }else{?>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card m-b-30">
                                                                    <div class="card-body">
                                                                        <!--<h4 class="mt-0 header-title">Vehicle check (half-raised)</h4>-->

                                                                        <div id="inside-check-style" class="col-md-12  profile-detail">
                                                                            <div class="">
                                                                                <h5 class="mb-0 py-2"> <img src="assets/icons/check.png" style="width: 5%;"> Vehicle check (half-raised)</h5><br>
                                                                            </div>
                                                                        </div>
                                                                       
                                                                        
                                                                        
                                                                        <?php if($annual_check!==''){ ?> <input type="hidden" name="annual_check" value="<?php echo $annual_check?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Annual Check/Emission test Due on</label>
                                                                            <div class="col-sm-12">
                                                                                <input class="form-control" type="date" value="" placeholder="Due On" name="annual_check">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($shock!==''){ ?> <input type="hidden" name="shock" value="<?php echo $shock?>"> <input type="hidden" name="shock_remark" value="<?php echo $shock_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Shock absorbers</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="29" name="shock" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="29">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="30" name="shock" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="30">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="shock_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($tyre_tread!==''){ ?> <input type="hidden" name="tyre_tread" value="<?php echo $tyre_tread?>"> <input type="hidden" name="tyre_tread_remark" value="<?php echo $tyre_tread_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Tyre tread</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="31" name="tyre_tread" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="31">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="32" name="tyre_tread" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="32">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="tyre_tread_remark">
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                        
                                                                        
                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> 
                                                    <?php } ?>
                                                        <!-- end Vehicle check (half-raised) -->
                                        
                                        
                                                        <!-- Vehicle check (fully raised) -->
                                                    <?php if($engine_gearbox!=='' AND $front_axle!=='' AND $replace_microfilter!=='' AND $front_brake!=='' AND $rear_axle!=='' AND $rear_brake!=='' AND $brake_lines!=='' AND $exhaust_system!=='' AND $fuel_tank){ ?> 

                                                      <input type="hidden" name="engine_gearbox" value="<?php echo $engine_gearbox?>"> 
                                                      <input type="hidden" name="engine_gearbox_remark" value="<?php echo $engine_gearbox_remark?>">
                                                      <input type="hidden" name="front_axle" value="<?php echo $front_axle?>"> 
                                                      <input type="hidden" name="front_axle_remark" value="<?php echo $front_axle_remark?>">
                                                      <input type="hidden" name="front_brake" value="<?php echo $front_brake?>"> 
                                                      <input type="hidden" name="front_brake_remark" value="<?php echo $front_brake_remark?>">
                                                      <input type="hidden" name="rear_axle" value="<?php echo $rear_axle?>"> 
                                                      <input type="hidden" name="front_axle_remark" value="<?php echo $front_axle_remark?>">
                                                      <input type="hidden" name="rear_brake" value="<?php echo $rear_brake?>"> 
                                                      <input type="hidden" name="rear_brake_remark" value="<?php echo $rear_brake_remark?>">
                                                      <input type="hidden" name="brake_lines" value="<?php echo $brake_lines?>"> 
                                                      <input type="hidden" name="brake_lines_remark" value="<?php echo $brake_lines_remark?>">
                                                      <input type="hidden" name="exhaust_system" value="<?php echo $exhaust_system?>"> 
                                                      <input type="hidden" name="exhaust_system_remark" value="<?php echo $exhaust_system_remark?>">
                                                      <input type="hidden" name="fuel_tank" value="<?php echo $fuel_tank?>"> 
                                                      <input type="hidden" name="fuel_tank_remark" value="<?php echo $fuel_tank_remark?>">

                                                    <?php }else{?>
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card m-b-30">
                                                                    <div class="card-body">
                                                                        <!--<h4 class="mt-0 header-title">Vehicle check (fully-raised)</h4>-->
                                                                            
                                                                            <div id="inside-check-style" class="col-md-12  profile-detail">
                                                                                <div class="">
                                                                                    <h5 class="mb-0 py-2"> <img src="assets/icons/car-check.png" style="width: 5%;"> Vehicle check (fully-raised)</h5><br>
                                                                                </div>
                                                                            </div>
                                                                            
                                        
                                                                        
                                                                        <?php if($engine_gearbox!==''){ ?> <input type="hidden" name="engine_gearbox" value="<?php echo $engine_gearbox?>"> <input type="hidden" name="engine_gearbox_remark" value="<?php echo $engine_gearbox_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Engine & Gearbox leaks</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="33" name="engine_gearbox" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="33">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="34" name="engine_gearbox" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="34">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="engine_gearbox_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($front_axle!==''){ ?> <input type="hidden" name="front_axle" value="<?php echo $front_axle?>"> <input type="hidden" name="front_axle_remark" value="<?php echo $front_axle_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Front axle</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="35" name="front_axle" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="35">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="36" name="front_axle" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="36">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="front_axle_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($front_brake!==''){ ?> <input type="hidden" name="front_brake" value="<?php echo $front_brake?>"> <input type="hidden" name="front_brake_remark" value="<?php echo $front_brake_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Front brake pads/discs</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="37" name="front_brake" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="37">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="38" name="front_brake" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="38">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="front_brake_remark">
                                                                            </div>
                                                                        </div>
                                        
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($rear_axle!==''){ ?> <input type="hidden" name="rear_axle" value="<?php echo $rear_axle?>"> <input type="hidden" name="front_axle_remark" value="<?php echo $front_axle_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Rear axle leaks</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="39" name="rear_axle" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="39">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="40" name="rear_axle" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="40">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="rear_axle_remark">
                                                                            </div>
                                                                        </div>
                                        
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($rear_brake!==''){ ?> <input type="hidden" name="rear_brake" value="<?php echo $rear_brake?>"> <input type="hidden" name="rear_brake_remark" value="<?php echo $rear_brake_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Rear brake pads/discs</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="41" name="rear_brake" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="41">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="42" name="rear_brake" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="42">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="rear_brake_remark">
                                                                            </div>
                                                                        </div>
                                        
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($brake_lines!==''){ ?> <input type="hidden" name="brake_lines" value="<?php echo $brake_lines?>"> <input type="hidden" name="brake_lines_remark" value="<?php echo $brake_lines_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Brake lines/hoses</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="43" name="brake_lines" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="43">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="44" name="brake_lines" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="44">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="brake_lines_remark">
                                                                            </div>
                                                                        </div>
                                        
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($exhaust_system!==''){ ?> <input type="hidden" name="exhaust_system" value="<?php echo $exhaust_system?>"> <input type="hidden" name="exhaust_system_remark" value="<?php echo $exhaust_system_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Exhaust system</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="45" name="exhaust_system" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="45">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="46" name="exhaust_system" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="46">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="exhaust_system_remark">
                                                                            </div>
                                                                        </div>
                                        
                                                                        <hr>
                                                                        <?php } ?>
                                                                        <?php if($fuel_tank!==''){ ?> <input type="hidden" name="fuel_tank" value="<?php echo $fuel_tank?>"> <input type="hidden" name="fuel_tank_remark" value="<?php echo $fuel_tank_remark?>"> <?php }else{ ?>
                                                                        <div class="form-group row">
                                                                            <label for="example-text-input" class="col-sm-12 col-form-label">Fuel tank & lines</label>
                                                                            <div class="col-sm-12">
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="47" name="fuel_tank" value="Ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="47">Ok</label>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-check-inline my-1">
                                                                                    <div class="custom-control custom-radio">
                                                                                        <input type="radio" id="48" name="fuel_tank" value="Not ok" class="custom-control-input">
                                                                                        <label class="custom-control-label" for="48">Not ok</label>
                                                                                    </div>
                                                                                </div>
                                        
                                                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="fuel_tank_remark">
                                                                            </div>
                                                                        </div>
                                                                        <?php } ?>
                                        
                                                                        
                                        
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div> <!-- end col -->
                                                        </div> 
                                                    <?php } ?>
                                                        <!-- end Vehicle check (fully raised) -->




                                                        <!-- Condition -->
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="card m-b-30">
                                                                    <div class="card-body">
                                                                        <?php if($r_f_tyre_tread!=='' AND $r_b_tyre_tread!=='' AND $l_f_tyre_tread!=='' AND $l_b_tyre_tread!==''){ ?>

                                                                          <input type="hidden" name="r_f_tyre_tread" value="<?php echo $r_f_tyre_tread?>">
                                                                          <input type="hidden" name="r_b_tyre_tread" value="<?php echo $r_b_tyre_tread?>">
                                                                          <input type="hidden" name="l_f_tyre_tread" value="<?php echo $l_f_tyre_tread?>">
                                                                          <input type="hidden" name="l_b_tyre_tread" value="<?php echo $l_b_tyre_tread?>">

                                                                        <?php }else{?>
                                                                        <h5 class="mt-0 header-title"><img src="assets/icons/tyre.png" style="width: 5%;"> Tyre Thread Depth</h5>
                                                                        <?php } ?>
                                                                        <div class="row">
                                                                            <!-- <label for="example-text-input" class="col-sm-2 col-form-label">Engine & Gearbox leaks</label> -->
                                                                            <div class="col-md-6">
                                                                                <div class="p-20">
                                                                                    <?php if($r_f_tyre_tread!==''){ ?> <input type="hidden" name="r_f_tyre_tread" value="<?php echo $r_f_tyre_tread?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Right Front Tyre Thread Depth (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="r_f_tyre_tread" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                    <?php if($r_b_tyre_tread!==''){ ?> <input type="hidden" name="r_b_tyre_tread" value="<?php echo $r_b_tyre_tread?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Right Back Tyre Thread Depth (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="r_b_tyre_tread" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                        
                                                                            <div class="col-md-6">
                                                                                <div class="p-20">
                                                                                    <?php if($l_f_tyre_tread!==''){ ?> <input type="hidden" name="l_f_tyre_tread" value="<?php echo $l_f_tyre_tread?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Left Front Tyre Thread Depth (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="l_f_tyre_tread" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                    <?php if($l_b_tyre_tread!==''){ ?> <input type="hidden" name="l_b_tyre_tread" value="<?php echo $l_b_tyre_tread?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Left Back Tyre Thread Depth (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="l_b_tyre_tread" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                                                        </div>

                                                                    </div>

                                                                    <!--------------Brake pad thickness mm (min 3mm)----------->


                                                                    <div class="card-body">
                                                                        <?php if($f_l_breakpad_t!=='' AND $f_r_breakpad_t!=='' AND $b_l_breakpad_t!=='' AND $b_r_breakpad_t!==''){ ?>

                                                                          <input type="hidden" name="f_l_breakpad_t" value="<?php echo $f_l_breakpad_t?>">
                                                                          <input type="hidden" name="f_r_breakpad_t" value="<?php echo $f_r_breakpad_t?>">
                                                                          <input type="hidden" name="b_l_breakpad_t" value="<?php echo $b_l_breakpad_t?>">
                                                                          <input type="hidden" name="b_r_breakpad_t" value="<?php echo $b_r_breakpad_t?>">

                                                                        <?php }else{?>
                                                                        <h5 class="mt-0 header-title"><img src="assets/icons/brake.png" style="width: 5%;"> Brake pad thickness</h5>
                                                                        <?php } ?>
                                                                        <div class="row">
                                                                            <!-- <label for="example-text-input" class="col-sm-2 col-form-label">Engine & Gearbox leaks</label> -->
                                                                            <div class="col-md-6">
                                                                                <div class="p-20">
                                                                                    <?php if($f_l_breakpad_t!==''){ ?> <input type="hidden" name="f_l_breakpad_t" value="<?php echo $f_l_breakpad_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Right Front Brake pad thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="f_l_breakpad_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                    <?php if($f_r_breakpad_t!==''){ ?> <input type="hidden" name="f_r_breakpad_t" value="<?php echo $f_r_breakpad_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Right Back Brake pad thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="f_r_breakpad_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                        
                                                                            <div class="col-md-6">
                                                                                <div class="p-20">
                                                                                    <?php if($b_l_breakpad_t!==''){ ?> <input type="hidden" name="b_l_breakpad_t" value="<?php echo $b_l_breakpad_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Left Front Tyre Brake pad thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="b_l_breakpad_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                    <?php if($b_r_breakpad_t!==''){ ?> <input type="hidden" name="b_r_breakpad_t" value="<?php echo $b_r_breakpad_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Left Back Tyre Brake pad thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="b_r_breakpad_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                                                        </div>

                                                                    </div>


                                                                    <!--------------Brake disk thickness mm (min 3mm)----------->


                                                                    <div class="card-body">
                                                                        <?php if($f_l_breakdisk_t!=='' AND $f_r_breakdisk_t!=='' AND $b_l_breakdisk_t!=='' AND $b_r_breakdisk_t!==''){ ?>

                                                                          <input type="hidden" name="f_l_breakdisk_t" value="<?php echo $f_l_breakdisk_t?>">
                                                                          <input type="hidden" name="f_r_breakdisk_t" value="<?php echo $f_r_breakdisk_t?>">
                                                                          <input type="hidden" name="b_l_breakdisk_t" value="<?php echo $b_l_breakdisk_t?>">
                                                                          <input type="hidden" name="b_r_breakdisk_t" value="<?php echo $b_r_breakdisk_t?>">

                                                                        <?php }else{?>
                                                                        <h5 class="mt-0 header-title"><img src="assets/icons/disc-brake.png" style="width: 5%;"> Brake disk thickness</h5>
                                                                        <?php } ?>
                                                                        <div class="row">
                                                                            <!-- <label for="example-text-input" class="col-sm-2 col-form-label">Engine & Gearbox leaks</label> -->
                                                                            <div class="col-md-6">
                                                                                <div class="p-20">
                                                                                    <?php if($f_l_breakdisk_t!==''){ ?> <input type="hidden" name="f_l_breakdisk_t" value="<?php echo $f_l_breakdisk_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Right Front Brake disk thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="f_l_breakdisk_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                    <?php if($f_r_breakdisk_t!==''){ ?> <input type="hidden" name="f_r_breakdisk_t" value="<?php echo $f_r_breakdisk_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Right Back Brake disk thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="f_r_breakdisk_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                        
                                                                            <div class="col-md-6">
                                                                                <div class="p-20">
                                                                                    <?php if($b_l_breakdisk_t!==''){ ?> <input type="hidden" name="b_l_breakdisk_t" value="<?php echo $b_l_breakdisk_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Left Front Tyre Brake disk thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="b_l_breakdisk_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                    <?php if($b_r_breakdisk_t!==''){ ?> <input type="hidden" name="b_r_breakdisk_t" value="<?php echo $b_r_breakdisk_t?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <label>Left Back Tyre Brake disk thickness (MM) (min 3mm)</label>
                                                                                        <input type="text" placeholder="" value="" name="b_r_breakdisk_t" class="form-control">
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                                                        </div>

                                                                    </div>

                                                                    <!---------Special Comments and Road Tests Comments------>


                                                                    <div class="card-body">
                                                                        <?php if($road_test_special_comment!==''){ ?>
                                                                          <input type="hidden" name="road_test_special_comment" value="<?php echo nl2br($road_test_special_comment); ?>">
                                                                        <?php }else{?>
                                                                        <h5 class="mt-0 header-title"><img src="assets/icons/driving-school.png" style="width: 5%;"> Special Comments and Road Tests Comments</h5>
                                                                        <?php } ?>
                                                                        <div class="form-group row">
                                                                            <!-- <label for="example-text-input" class="col-sm-2 col-form-label">Engine & Gearbox leaks</label> -->
                                                                            <div class="col-md-12">
                                                                                <div class="p-20">
                                                                                    <?php if($road_test_special_comment!==''){ ?> <input type="hidden" name="road_test_special_comment" value="<?php echo nl2br($road_test_special_comment); ?>"><?php }else{ ?>
                                                                                    <div class="form-group">
                                                                                        <textarea name="road_test_special_comment" class="form-control" rows="6"></textarea>
                                                                                    </div>
                                                                                    <?php } ?>
                                                                                </div>
                                                                            </div> 
                                        
                                        
                                                                            
                                        
                                                                        </div>

                                                                    </div>

                                                                    <input type="hidden" name="workshop_name" placeholder="<?php echo $user_name; ?>" value="<?php echo $user_name; ?>" class="form-control" readonly required/>
                                        
                                        
                                                                <br>
                                                                <div class="card-footer text-right">
                                                                    <button type="submit" class="btn btn-success waves-effect waves-light">Update</button>
                                                                </div>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                        
                                                </form>            
                                                
                                                
                                             
                                    </div>


                                </div>
                            </div>
                                
                                
                          
                                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Start page footer -->
        <div id="footer">
            <?php include_once('controls/footer.php'); ?>
        </div>

    </div>
</div>

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<script src="assets/assets/bundles/fullcalendar.bundle.js"></script>
<script src="assets/assets/bundles/knobjs.bundle.js"></script>

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<script src="assets/js/page/calendar.js"></script>
<script src="assets/js/chart/knobjs.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>


    <script>
        
        $(document).on('submit', '#Update-Form', function(e){
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

                url:"post/update_workshop.php",
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
                      text:'Your Details is Successfully Updated.'
                    });


                    setTimeout(function () {
                        
                        window.location.href = "pending_inventorys.php";
                       // location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>


</body>
</html>
<?php } ?>