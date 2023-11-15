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
        ?>

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
          
          
          $first_reg_date = date('d-m-Y', strtotime($f_reg_date)) ;
          
          $annual_check_date = date('d-m-Y', strtotime($annual_check)) ;
         

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
                            #tyre-tread{
                                page-break-before: always !important;
                                margin-top: 10px !important;
                            }
                            #tyre-tread-preview{
                               display:none; 
                            }
                            #tyre-tread-print{
                                display: revert !important;
                            }
                            #print-damage{
                                display: revert !important;
                            }
                            #view-damage{
                                display: none;
                            }
                        }
                        #tyre-tread-print{
                            display: none;
                        }
                        #print-damage{
                           display: none; 
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
                <ul class="nav nav-tabs page-header-tab">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-about-tab" data-toggle="pill" href="#pills-about" role="tab" aria-controls="pills-about" aria-selected="false">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-photos-tab" data-toggle="pill" href="#pills-photos" role="tab" aria-controls="pills-photos" aria-selected="true">Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-additionalphotos-tab" data-toggle="pill" href="#pills-additionalphotos" role="tab" aria-controls="pills-additionalphotos" aria-selected="true">Additional Photos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-videos-tab" data-toggle="pill" href="#pills-videos" role="tab" aria-controls="pills-videos" aria-selected="false">Videos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-status-tab" data-toggle="pill" href="#pills-status" role="tab" aria-controls="pills-status" aria-selected="false">Vehicle Status</a>
                    </li>
                </ul>
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



                            <div class="card-body">
                                <button type="button" id="printPageButton" onclick="window.print();" class="btn btn-info btn-block"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                            </div>
                        </div>
                    </div>



                    <div class="col-lg-8 col-md-12">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-about" role="tabpanel" aria-labelledby="pills-about-tab">
                                <div class="card">
                                    <div class="card-header bline">
                                        <h3 class="card-title">About Vehicle</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <!-- Inside Check -->

                                                <div id="inside-check-style" class="col-md-12  profile-detail">
                                                    <div class="">
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/dashboard.png" style="width: 5%;"> Inside Check</h5>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 align-self-center">


                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                            <tr style="background: #4FA7D3;">
                                                                <th></th>
                                                                <th id="th-style" style="color: #fff;">Ok / Not ok</th>
                                                                <th id="th-style" style="color: #fff;">Remark</th>
                                                                <th id="th-extra-style" style="color: #fff;"></th>
                                                             
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr>
                                                                <th scope="row">Display & Instrument Lighting</th>
                                                                <td><?php echo $display; ?></td>
                                                                <td colspan="2"><?php echo $display_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Interior Lights</th>
                                                                <td><?php echo $interior_lights; ?></td>
                                                                <td colspan="2"><?php echo $interior_lights_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Signals (lights, indicators, hazard, horn)</th>
                                                                <td><?php echo $signals; ?></td>
                                                                <td colspan="2"><?php echo $signals_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Steering</th>
                                                                <td><?php echo $steering; ?></td>
                                                                <td colspan="2"><?php echo $steering_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Hand Brake /Parking brake</th>
                                                                <td><?php echo $hand_brake; ?></td>
                                                                <td colspan="2"><?php echo $hand_brake_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Aircon - Blower</th>
                                                                <td><?php echo $aircon; ?></td>
                                                                <td colspan="2"><?php echo $aircon_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Power Window Controls</th>
                                                                <td><?php echo $power_window; ?></td>
                                                                <td colspan="2"><?php echo $power_window_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Exterior Lights</th>
                                                                <td><?php echo $exterior_lights; ?></td>
                                                                <td colspan="2"><?php echo $exterior_lights_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Horn</th>
                                                                <td><?php echo $horn; ?></td>
                                                                <td colspan="2"><?php echo $horn_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Grab Handles</th>
                                                                <td><?php echo $grab_handles; ?></td>
                                                                <td colspan="2"><?php echo $grab_handles_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Sun Roof</th>
                                                                <td><?php echo $sun_roof; ?></td>
                                                                <td colspan="2"><?php echo $sun_roof_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Speaker Covers</th>
                                                                <td><?php echo $speaker_covers; ?></td>
                                                                <td colspan="2"><?php echo $speaker_covers_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Carpets</th>
                                                                <td><?php echo $carpets; ?></td>
                                                                <td colspan="2"><?php echo $carpets_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Seat Covers</th>
                                                                <td><?php echo $seat_covers; ?></td>
                                                                <td colspan="2"><?php echo $seat_covers_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Rear Display</th>
                                                                <td><?php echo $rear_display; ?></td>
                                                                <td colspan="2"><?php echo $rear_display_remark; ?></td>
                                                            </tr>

                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    



                                                </div>


                                                <!-- End Inside Check -->

                                                <!-- Vehicle & Engine Check -->
                                                
                                                <div id="vehicle-engine-check-style" class="col-md-12  profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/engine.png" style="width: 5%;"> Vehicle & Engine Check</h5>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 align-self-center">


                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                            <tr style="background: #4FA7D3;">
                                                                <th></th>
                                                                <th id="th-style" style="color: #fff;">Ok / Not ok</th>
                                                                <th id="th-style" style="color: #fff;">Remark</th>
                                                                <th id="th-extra-style" style="color: #fff;"></th>
                                                             
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr>
                                                                <th scope="row">Wiper Blades</th>
                                                                <td><?php echo $wiper_blades; ?></td>
                                                                <td colspan="2"><?php echo $wiper_blades_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Windows-glass</th>
                                                                <td><?php echo $windows_glass; ?></td>
                                                                <td colspan="2"><?php echo $windows_glass_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Replace microfilter</th>
                                                                <td><?php echo $replace_microfilter; ?></td>
                                                                <td colspan="2"><?php echo $replace_microfilter_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Cooling system (coolant)</th>
                                                                <td><?php echo $coolant; ?></td>
                                                                <td colspan="2"><?php echo $coolant_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Engine oil, Power steering & Brake fluid</th>
                                                                <td><?php echo $engine_oil; ?></td>
                                                                <td colspan="2"><?php echo $engine_oil_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">V-belt/Poly V-belt</th>
                                                                <td><?php echo $v_belt; ?></td>
                                                                <td colspan="2"><?php echo $v_belt_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Noticeable leaks</th>
                                                                <td><?php echo $noticeble_leaks; ?></td>
                                                                <td colspan="2"><?php echo $noticeble_leaks_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Damage by animals</th>
                                                                <td><?php echo $damage_animals; ?></td>
                                                                <td colspan="2"><?php echo $damage_animals_remark; ?></td>
                                                            </tr>

                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    



                                                </div>


                                                <!-- End Vehicle & Engine Check -->


                                                <!-- Vehicle check (half-raised) -->
                                                
                                                <div class="col-md-12  profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/check.png" style="width: 5%;"> Vehicle check (half-raised)</h5>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 align-self-center">


                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                              <tr>
                                                                <th scope="row">Annual Check/Emission test Due on</th>
                                                                <td colspan="3">
                                                                    <?php if($annual_check_date=='01-01-1970'){}else{ ?>
                                                                        <?php echo $annual_check_date; ?>
                                                                    <?php } ?>
                                                                </td>
                                                                
                                                            </tr>
                                                            <tr style="background: #4FA7D3;">
                                                                <th></th>
                                                                <th id="th-style" style="color: #fff;">Ok / Not ok</th>
                                                                <th id="th-style" style="color: #fff;">Remark</th>
                                                                <th id="th-extra-style" style="color: #fff;"></th>
                                                             
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr>
                                                                <th scope="row">Shock absorbers</th>
                                                                <td><?php echo $shock; ?></td>
                                                                <td colspan="2"><?php echo $shock_remark; ?></td>
                                                                
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Tyre tread</th>
                                                                <td><?php echo $tyre_tread; ?></td>
                                                                <td colspan="2"><?php echo $tyre_tread_remark; ?></td>
                                                            </tr>

                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    



                                                </div>


                                                <!-- End Vehicle check (half-raised) -->


                                                <!-- Vehicle check (fully-raised) -->
                                                
                                                <div class="col-md-12  profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/car-check.png" style="width: 5%;"> Vehicle check (fully-raised)</h5>
                                                    </div>
                                                </div>

                                                <div class="col-md-12 col-lg-12 align-self-center">


                                                    <div class="table-responsive">
                                                        <table class="table table-bordered mb-0">
                                                            <thead>
                                                              
                                                            <tr style="background: #4FA7D3;">
                                                                <th></th>
                                                                <th id="th-style" style="color: #fff;">Ok / Not ok</th>
                                                                <th id="th-style" style="color: #fff; border: 0px solid #4FA7D3;">Remark</th>
                                                                <th id="th-extra-style" style="color: #fff;"></th>
                                                             
                                                            </tr>
                                                            </thead>
                                                            <tbody>

                                                            <tr>
                                                                <th scope="row">Engine & Gearbox leaks</th>
                                                                <td><?php echo $engine_gearbox; ?></td>
                                                                <td colspan="2"><?php echo $engine_gearbox_remark; ?></td>
                                                                
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Front axle</th>
                                                                <td><?php echo $front_axle; ?></td>
                                                                <td colspan="2"><?php echo $front_axle_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Front brake pads/discs</th>
                                                                <td><?php echo $front_brake; ?></td>
                                                                <td colspan="2"><?php echo $front_brake_remark; ?></td>
                                                                
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Rear axle leaks</th>
                                                                <td><?php echo $rear_axle; ?></td>
                                                                <td colspan="2"><?php echo $rear_axle_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Rear brake pads/discs</th>
                                                                <td><?php echo $rear_brake; ?></td>
                                                                <td colspan="2"><?php echo $rear_brake_remark; ?></td>
                                                                
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Brake lines/hoses</th>
                                                                <td><?php echo $brake_lines; ?></td>
                                                                <td colspan="2"><?php echo $brake_lines_remark; ?></td>
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Exhaust system</th>
                                                                <td><?php echo $exhaust_system; ?></td>
                                                                <td colspan="2"><?php echo $exhaust_system_remark; ?></td>
                                                                
                                                            </tr>

                                                            <tr>
                                                                <th scope="row">Fuel tank & lines</th>
                                                                <td><?php echo $fuel_tank; ?></td>
                                                                <td colspan="2"><?php echo $fuel_tank_remark; ?></td>
                                                            </tr>

                                                            
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    
                                                    


                                                </div>


                                                <!-- End Vehicle check (fully-raised) -->

                                                <!-- Comment -->

                                              <?php if($comments !=='') {?>
                                                <div class="col-md-12  profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/chat.png" style="width: 5%;"> Comment</h5>
                                                    </div>
                                                </div>

                                                  <div class="col-md-12 col-lg-12 align-self-center">

                                                  <p class="pt-3 text-muted" style="color: #000 !important;" ><?php echo nl2br($comments); ?></p>

                                                </div>
                                              <?php } ?>


                                              <!-- End Comment -->


                                              <!-- Vehicle Condition -->

                                            <div class="row" id="view-damage">
                                                <div id="vehicle-condition-style" class="col-md-8  profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/condition.png" style="width: 5%;"> Vehicle Condition</h5>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            
                                                             <div class="col-md-3">
                                                                    
                                                                <div style="width: 20px; height: 20px; border-radius:100px; background-color: #FF0000; margin-right:10px;">
                                                                    
                                                                </div><label style="font-weight:800;"> Stone Damage</label>
                                                        
                                                              </div>
                                                              <div class="col-md-3">
                                                                    
                                                                <div style="width: 20px; height: 20px; border-radius:100px; background-color: #0025ff; margin-right:20px; margin-left:20px;">
                                                                   
                                                                </div><label style="font-weight:800;">Dents</label>
                                                           
                                                              </div>
                                                              <div class="col-md-3">
                                                           
                                                                    
                                                                <div style="width: 20px; height: 20px; border-radius:100px; background-color: #c700ff; margin-right:20px; margin-left:20px;">
                                                                   
                                                                </div><label style="font-weight:800;">Dents Scratches</label>
                                                          
                                                              </div>
                                                              <div class="col-md-3">
                                                            
                                                                    
                                                                <div style="width: 20px; height: 20px; border-radius:100px; background-color: #ff7100; margin-right:20px; margin-left:20px;">
                                                                   
                                                                </div><label style="font-weight:800;">Collision Damage</label>
                                                            
                                                              </div>
                                                            
                                                            <!--<div class="col-md-8"> -->
                                                                   
                                                            <!--</div>-->
                                                        </div>
                                                    </div>


                                                    <div class="col-md-12 col-lg-12 align-self-center">

                                                      <img src="vehicle_damage_ss/<?php echo $vehicle_screen; ?>" style="width: 100%;">

                                                    </div>


                                                    </div>


                                                    <div class="col-md-12 col-lg-4 align-self-center" id="tyre-tread-preview">
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/tyre.png" style="width: 7%;"> Tyre Thread Depth</h5>
                                                        <div class="table-responsive">
                                                          <table class="table mb-0">
                                                              
                                                              <tbody>
                                                              <tr>
                                                                  <th scope="row">Right Front Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $r_f_tyre_tread; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Right Back Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $r_b_tyre_tread; ?> mm</span></td>                                                    
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Front Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $l_f_tyre_tread; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Back Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $l_b_tyre_tread; ?> mm</span></td>
                                                              </tr>
                                                              </tbody>
                                                          </table>
                                                      </div>

                                                    </div>
                                                </div>
                                                
                                                <div class="row" id="print-damage">
                                                <div id="vehicle-condition-style" class="col-md-12 profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/condition.png" style="width: 5%;"> Vehicle Condition</h5>
                                                    </div>
                                                    
                                                    <div class="col-md-12">
                                                        <img src="assets/damage_nav.JPG">
                                                    </div>


                                                    <div class="col-md-12 col-lg-12 align-self-center">

                                                      <img src="<?php echo $vehicle_screen; ?>" style="width: 100%;">

                                                    </div>


                                                </div>


                                                </div>

                                                <div class="row" id="tyre-tread">
                                                    <div class="col-md-12 col-lg-4 align-self-center" id="tyre-tread-print">
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/tyre.png" style="width: 7%;"> Tyre Thread Depth</h5>
                                                        <div class="table-responsive">
                                                          <table class="table mb-0">
                                                              
                                                              <tbody>
                                                              <tr>
                                                                  <th scope="row">Right Front Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $r_f_tyre_tread; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Right Back Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $r_b_tyre_tread; ?> mm</span></td>                                                    
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Front Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $l_f_tyre_tread; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Back Tyre Thread Depth (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $l_b_tyre_tread; ?> mm</span></td>
                                                              </tr>
                                                              </tbody>
                                                          </table>
                                                      </div>

                                                    </div>
                                                    <div class="col-md-12 col-lg-6 align-self-center">
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/brake.png" style="width: 5%;"> Brake Pad Thickness</h5>
                                                        <div class="table-responsive">
                                                          <table class="table mb-0">
                                                              
                                                              <tbody>
                                                              <tr>
                                                                  <th scope="row">Right Front Brake pad thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $f_l_breakpad_t; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Front Tyre Brake pad thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $f_r_breakpad_t; ?> mm</span></td>                                                    
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Right Back Brake pad thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $b_l_breakpad_t; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Back Tyre Brake pad thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $b_r_breakpad_t; ?> mm</span></td>
                                                              </tr>
                                                              </tbody>
                                                          </table>
                                                      </div>

                                                    </div>


                                                    <div class="col-md-12 col-lg-6 align-self-center">
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/disc-brake.png" style="width: 5%;"> Brake Disk Thickness</h5>
                                                        <div class="table-responsive">
                                                          <table class="table mb-0">
                                                              
                                                              <tbody>
                                                              <tr>
                                                                  <th scope="row">Right Front Brake disk thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $f_l_breakdisk_t; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Front Tyre Brake disk thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-success"><?php echo $f_r_breakdisk_t; ?> mm</span></td>                                                    
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Right Back Brake disk thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $b_l_breakdisk_t; ?> mm</span></td>
                                                              </tr>
                                                              <tr>
                                                                  <th scope="row">Left Back Tyre Brake disk thickness (MM)</th>
                                                                  <td><span class="badge badge-pill  badge-danger"><?php echo $b_r_breakdisk_t; ?> mm</span></td>
                                                              </tr>
                                                              </tbody>
                                                          </table>
                                                      </div>

                                                    </div>
                                                </div>


                                                <style>
                                                  div.radio {
                                                        margin-right: 50px;
                                                    }
                                                </style>

                                                <div class="col-md-12">
                                                <div class="form-group row" style="text-align: center; place-content: center; color: #000; display: none;">
                                                  <label for="example-text-input" class="col-sm-12 col-form-label">Restore Underbody Protection</label>
                                                  

                                                      <div class="radio my-2">
                                                          <div class="custom-control custom-radio">
                                                              <input type="radio" id="Clean1" class="custom-control-input"  <?php 
                                                              if($body_work=='Clean')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                              <label class="custom-control-label" for="Clean1">Clean</label>
                                                          </div>
                                                      </div>
                                                      <div class="radio my-2">
                                                          <div class="custom-control custom-radio">
                                                              <input type="radio" id="Dirty1" class="custom-control-input"  <?php 
                                                              if($body_work=='Dirty')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                              <label class="custom-control-label" for="Dirty1">Dirty</label>
                                                          </div>
                                                      </div>
                                                      <div class="radio my-2">
                                                          <div class="custom-control custom-radio">
                                                              <input type="radio" id="VDirty1" class="custom-control-input"  <?php 
                                                              if($body_work=='Very Dirty')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                              <label class="custom-control-label" for="VDirty1">Very Dirty</label>
                                                          </div>
                                                      </div>
                                                 
                                                      </div>

                                                      <br><br>
                                              </div>

                                                  


                                              <!-- End Vehicle Condition -->


                                              <!-- Spare Wheel -->

                                            <div class="col-md-12 col-lg-12 align-self-center">



                                              <div class="table-responsive">
                                                <table class="table table-bordered mb-0">
                                                    <thead>
                                                    <tr style="background: #4FA7D3;">
                                                        <th id="th-style" style="color: #FFF;">Spare Wheel</th>
                                                        <th id="th-style" style="color: #FFF;">Jack</th>
                                                        <th id="th-style" style="color: #FFF;">Tools</th>
                                                        <th id="th-style" style="color: #FFF;">CD</th>
                                                        <th id="th-style" style="color: #FFF;">Lighter</th>
                                                        <th id="th-style" style="color: #FFF;">Sim Card</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row"><?php echo $spare_wheel; ?></th>
                                                        <td scope="row"><?php echo $jack; ?></td>
                                                        <td scope="row"><?php echo $tools; ?></td>
                                                        <td scope="row"><?php echo $cd; ?></td>
                                                        <td scope="row"><?php echo $lighter; ?></td>
                                                        <td scope="row"><?php echo $sim; ?></td>
                                                    </tr>
                                                    
                                                    
                                                    </tbody>
                                                </table>
                                            </div>

                                          </div>


                                          <!-- End Spare Wheel -->

                                            <!-- Special Comments and Road Tests Comments -->

                                              <?php if($road_test_special_comment !=='') {?>
                                                <div class="col-md-12  profile-detail">
                                                    <div class=""><br>
                                                        <h5 class="mb-0 py-2"> <img src="assets/icons/driving-school.png" style="width: 5%;"> Special Comments and Road Tests Comments</h5>
                                                    </div>
                                                </div>

                                                  <div class="col-md-12 col-lg-12 align-self-center">

                                                  <p class="pt-3 text-muted" style="color: #000 !important;" ><?php echo nl2br($road_test_special_comment); ?></p>

                                                </div>
                                              <?php } ?>


                                            <!-- End Special Comments and Road Tests Comments-->


                                          <!-- Extra -->


         

                                          <div class="col-md-12 col-lg-6 align-self-center" style="display: none;">

                                            <div class="form-group row">
                                              <label class="col-md-3 my-2 control-label">If extra work required</label>
                                                <div class="col-md-9">
                                                    <div class="radio my-2">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="leave_it" class="custom-control-input" <?php 
                                                              if($extra=='Leave it')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                            <label class="custom-control-label" for="leave_it">Leave it</label>
                                                        </div>
                                                    </div>

                                                    <div class="radio my-2">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="radioDisabled" id="do_it" class="custom-control-input" <?php 
                                                              if($extra=='Do')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                            <label class="custom-control-label" for="do_it">Do it</label>
                                                        </div>
                                                    </div>
                                                    <?php if($amount !=='') {?>
                                                    <div class="radio my-2" style="display: none;">
                                                        <div class="custom-control custom-radio">
                                                            
                                                            <label>Up to amount of <b>Rs.<?php echo $amount; ?>.00</b></label>
                                                        </div>
                                                    </div>
                                                  <?php }else{ }?>
                                                    
                                                </div>
                                                  
                                            </div>

                                          </div>


                                          <div class="col-md-12 col-lg-6 align-self-center" style="display: none;">

                                            <div class="form-group row">
                                              <label class="col-md-3 my-2 control-label">From of Payment</label>
                                                <div class="col-md-9">
                                                    <div class="radio my-2">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="Cash" class="custom-control-input" <?php 
                                                              if($pay=='Cash')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                            <label class="custom-control-label" for="Cash">Cash</label>
                                                        </div>
                                                    </div>
                                                    <div class="radio my-2">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="radioDisabled" id="Cheque" class="custom-control-input" <?php 
                                                              if($pay=='Cheque')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                            <label class="custom-control-label" for="Cheque">Cheque</label>
                                                        </div>
                                                    </div>
                                                    <div class="radio my-2">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" name="radioDisabled" id="Card" class="custom-control-input" <?php 
                                                              if($pay=='Credit card')
                                                              {
                                                                 echo "checked";
                                                              }
                                                              ?> disabled >
                                                            <label class="custom-control-label" for="Card">Credit card</label>
                                                        </div>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                          </div>
                                          
                                          
                                            <div id="agreement-style" class="col-md-12 col-lg-12 align-self-center">
                                            <hr>
                                              <p style="font-size: 15px;">
                                                  I/we agree to allow Bavarian Automobile Engineering (Pvt) Ltd to carry out the necessary diagnosis and/or repairs to the vehicle as specified in the repair order. All relevant labor charges and parts shall be paid by me/us prior to the release of the vehicle. Great care and attention is assured while the vehicle is in premises od Bavarian Automobile Engineering (Pvt) Ltd., and any damages on the vehicle which is beyond the control of Bavarian Automobile Engineering (Pvt) Ltd will not be the responsibility of Bavarian Automobile Engineering (Pvt) Ltd. No cash or valuables in the car, please remove any other personal goods. Bavarian Automobile Engineering (Pvt) Ltd., will not bear any responsibility for the customer’s personal belongings. Bavarian Automobile Engineering (Pvt) Ltd will not keep old parts in the possession of Bavarian Automobile Engineering (Pvt) Ltd and the customer has to take all the parts at the time of collecting his/her vehicle.
                                                  <br><br>
                                                  This is an electronically generated document, no signatures are required.
                                              </p>
                                            
                                            </div>  

                                                <br><br>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        
                                                        <p>
                                                            <strong style="float: left; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Authorized By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                        </p>
                                                    </div>
                                                    <div class="col-md-6">
                                                        
                                                        <p>
                                                            <strong style="float: right; text-decoration: overline dotted;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received By&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
                                                        </p>
                                                    </div>
                                                </div>
                                            
                




                                          <!-- End Extra -->



                                    </div>
                                </div>
                            </div>
                            <!--Start Photos -->
                            <div class="tab-pane fade" id="pills-photos" role="tabpanel" aria-labelledby="pills-photos-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Photos</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <!-- Button trigger modal -->
                                        <?php if($stat=='2'){ }else{ ?>
                                        <button type="button" class="btn btn-info waves-effect waves-light" id="btn-view-inv-photo-modal">
                                                  Add Inventry Images</button>
                                        <?php } ?>
                                                
                                                
                                                <!-- Modal -->
                                                    <div class="modal fade" id="UploadInventryImages" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Upload Inventry Photos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="inv-photo-modal-close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                           

                                                                <div class="" style="text-align: center;">
                                                                    <form class="form-horizontal form-material" id="Inventry-photo-Form" method="POST">
                                                                        
                                                                        <input type="hidden" name="vehicle_detail_id" id="vehicle_detail_id" value="<?php echo $vehicleId; ?>" requered readonly>
                                                                        
                                                                        <div class="col-md-12">
                                                                            <br>
                                                                            <div class="col-md">
                                                                                <img id="blah" class="please" style="width: 30%;" src="assets/upload.png" alt="your image" />
                                                                            </div>
                                
                                                                            <div class="col-md">
                                                                                <br>
                                                                                <!--<input type='file' class="maybe"  accept= "image/jpeg, image/png" name="img1" id="img1" onchange="readURL(this);" />-->
                                                                                <input type="file" name="inve_files[]" multiple/>  
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <br>
                                                                        
                                                                        <div class="progress" style="height:20px">
                                                                            <div class="progress-bar bg-default" style="width:0%;" id="upload-bar-inv-photo"><span id="upload-bar-label-inv-photo">0%</span></div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <span id="upload-status-inv-photo">0 MB / 0 MB</span>

                                                                        <br>
                                                                        <button type="submit" id="btn-inv-photo-submit" class="btn btn-success waves-effect waves-light">Submit Image</button>

                                                                        <br><br>
                                                                       
                                                                    </form>
                                                                </div>
                                                
                                                           
                                                           
                                                           
                                                           
                                                          </div>
                                                          <!--<div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                          </div>-->
                                                        </div>
                                                      </div>
                                                    </div>

                                                    <br><br>
                                            <div class="row px-3">


                                              <?php
                                                  $getImageQuery=$conn->query("SELECT * FROM tbl_vehicle_images WHERE vehicle_detail_id = '$vehicleId' ");
                                                  while ($im=$getImageQuery->fetch_array()) {


                                                    $image_id=$im[0];
                                                    $image=$im[1];
                                                    

                                                ?>

                                                
                                                <div class="col-lg-3 col-md-6 p-0">
                                                    <div class="item-box">
                                                        <a class="mfp-image img-fluid" data-toggle="modal" data-target=".bd-example-modal-img-<?php echo $image_id; ?>" >
                                                            <img style="width: 185px; height: 116px; object-fit: contain;" src="image_car/<?php echo $image; ?>" alt="7" />
                                                        </a>
                                                    </div>
                                                </div>


                                                <div class="modal fade bd-example-modal-img-<?php echo $image_id; ?>" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-body">
                                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                  <!-- <span aria-hidden="true" class="text-dark">&times;</span> -->
                                                              </button>
                                                                <img src="image_car/<?php echo $image; ?>" style="width: 100%;" alt="" class="img-fluid">
                                                            </div>
                                                            <br>
                                                        </div>
                                                    </div>
                                                </div>
                                              

                                                

                                              <?php } ?>

                                                
                                            </div>
                                        
        
                                        
                                    </div>
                                </div>
                            </div>
                            <!--End Photos -->
                            <!--Start Video -->
                            <div class="tab-pane fade" id="pills-videos" role="tabpanel" aria-labelledby="pills-videos-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Videos</h3>
                                    </div>
                                    <div class="card-body">
                                        
                                        <!-- Button trigger modal -->
                                            <!--<button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#UploadVideo">-->
                                            <?php if($stat=='2'){ }else{ ?>
                                            <button type="button" class="btn btn-info waves-effect waves-light" id="btn-open-modal-video">
                                                  Add Videos</button>
                                            <?php } ?>
                                                
                                                
                                                <!-- Modal -->
                                                    <div class="modal fade" id="UploadVideo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Upload Video</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="video-modal-close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                           
                                                           
                                                    

                                                                <div class="" style="text-align: center;">
                                                                    <form class="form-horizontal form-material" id="video-Form" method="POST">
                                                                        
                                                                        <input type="hidden" name="vehicle_detail_id" id="vehicle_detail_id" value="<?php echo $vehicleId; ?>" requered readonly>
                                                                        
                                                                        
                                                                            <br>
                                                                            <div class="col-md-12">
                                                                                <video controls class="controlvideo" style="display: none;">
                                                                                    <source type="video/mp4">
                                                                                </video>
                                        
                                                                                <canvas class="lola" id="viewport" style="width: 50%;"></canvas>
                                                                                <br/>
                                                                                
                                        
                                        
                                        
                                                                            </div>
                                        
                                                                            <div class="col-md-6">
                                                                                <input type="file" id="filevideo" accept= "video/mp4" name="filevideo"  class="maybe" onchange="ValidateSize(this)" /><br>
                                                                                <label class="control-label">Max 1024 Mb</label>
                                                                            </div>
                                                                        
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Remark</label>
                                                                            <textarea name="remark" class="form-control" row="5" placeholder="Write Errors"></textarea>
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        <div class="progress" style="height:20px">
                                                                            <div class="progress-bar bg-default" style="width:0%;" id="upload-bar"><span id="upload-bar-label">0%</span></div>
                                                                            
                                                                        </div>
                                                                        
                                                                        <span id="upload-status">0 MB / 0 MB</span>
                                                                        
                                                                        
                                                                        <br>
                                                                        <button type="submit" class="btn btn-success waves-effect waves-light" id="btn-video-submit">Submit Video</button>
                                                                       
                                                                    </form>
                                                                </div>
                                                
                                                           <br><br>
                                                           
                                                           
                                                           
                                                          </div>
                                                          <!--<div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                          </div>-->
                                                        </div>
                                                      </div>
                                                    </div>

                                            <div class="col-md-12">
                                                        <div class="table-rep-plugin">
                                                            <div class="table-responsive mb-0" data-pattern="priority-columns">
                                                                <table id="tech-companies-1" class="table  table-striped">
                                                                    <thead>
                                                                    <tr>
                                                                        <th>Remark</th>
                                                                        <th>Video View</th>
                                                                        
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                    
                                                                <?php
                                                                  $getImageQuery=$conn->query("SELECT * FROM tbl_video WHERE vehicle_detail_id = '$vehicleId' ");
                                                                  while ($im=$getImageQuery->fetch_array()) {
                
                
                                                                    $video_id=$im[0];
                                                                    $video=$im[1];
                                                                    $video_remark=$im[2];
                                                                    $vehicle_detail_id=$im[3];
                                                                    $video_date=$im[4];
                                                                    
                
                                                                ?>
                                                                
                                                                <tr>
                                                                    <td><?php echo nl2br($video_remark); ?></td>
                                                                    <td>
                                                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter-<?php echo $video_id; ?>">
                                                                              Video
                                                                        </button>
                                                                    </td>
                                                                    
                                                                </tr>
                                                    
                                                    
                                                    
                                                    
                                                                <?php } ?> 
                                                                
                                                                 </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                
                                                <?php
                                                  $getImageQuery=$conn->query("SELECT * FROM tbl_video WHERE vehicle_detail_id = '$vehicleId' ");
                                                  while ($im=$getImageQuery->fetch_array()) {


                                                    $video_id=$im[0];
                                                    $video=$im[1];
                                                    $video_remark=$im[2];
                                                    $vehicle_detail_id=$im[3];
                                                    $video_date=$im[4];
                                                    

                                                ?>
                                                
                                               
                                                
                                                <!-- Modal -->
                                                <div class="modal fade" id="exampleModalCenter-<?php echo $video_id; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                  <div class="modal-dialog modal-dialog-centered" role="document">
                                                    <div class="modal-content">
                                                      <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Video</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                          <span aria-hidden="true">&times;</span>
                                                        </button>
                                                      </div>
                                                      <div class="modal-body">
                                                        <video controls style="width: 100%">
                                                            <source src="videos/<?php echo $video; ?>" type="video/mp4">
                                                             Your browser does not support the video tag.
                                                        </video>
                                                      </div>
                                                      <hr>
                                                        <p style="color: #000; font-weight: 700; font-size: large;"><?php //echo nl2br($video_remark); ?></p>
                                                    </div>
                                                  </div>
                                                </div>
                                                
                                                
                                                <?php } ?> 
  
                                                    
                                                </div>


                                    </div>
                                </div>
                            </div>
                            <!--End Video -->
                            <!--Start Status -->
                            <div class="tab-pane fade" id="pills-status" role="tabpanel" aria-labelledby="pills-status-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Vehicle Status</h3>
                                    </div>
                                    <div class="card-body">

                                    <!-- Button trigger modal -->
                                                <?php if($stat=='2'){ }else{ ?>
                                                <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#UpdateStatus">
                                                  Update Status
                                                </button>
                                                <?php } ?>
                                                
                                                
                                                
                                                <!-- Modal -->
                                                    <div class="modal fade" id="UpdateStatus" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Update Status</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                           
                                                           
                                                    

                                                                <div class="" style="text-align: center;">
                                                                    <form class="form-horizontal form-material" id="Status-Form" method="POST">
                                                                        
                                                                        <input type="hidden" name="vehicle_detail_id" id="vehicle_detail_id" value="<?php echo $vehicleId; ?>" requered readonly>
                                                                        <input type="hidden" name="customer_email" id="customer_email" value="<?php echo $customer_email; ?>" requered readonly>
                                                                        <input type="hidden" name="reg_customer" id="reg_customer" value="<?php echo $reg_customer; ?>" requered readonly>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Select Status</label>
                                                                            <select class="form-control" name="status_type" requered>
                                                                                <option value="" selected disabled>Choose ..</option>
                                                                                <option value="In vehicle hoist">In vehicle hoist</option>
                                                                                <option value="Repair on progress">Repair on progress</option>
                                                                                <option value="Vehicle Idle">Vehicle Idle</option>
                                                                                <option value="Awaiting parts">Awaiting parts</option>
                                                                                <option value="In washing">In washing</option>
                                                                                <option value="Interior cleaning">Interior cleaning</option>
                                                                                <option value="Repair Complete">Repair Complete</option>
                                                                            </select>
                                                                            
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Remark</label>
                                                                            <textarea name="remark" class="form-control" row="5" placeholder="Write Remark" requered></textarea>
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        <br>
                                                                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit Status</button>
                                                                       
                                                                    </form>
                                                                </div>
                                                
                                                           <br>
                                                           
                                                           
                                                           
                                                          </div>
                                                          <!--<div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                          </div>-->
                                                        </div>
                                                      </div>
                                                    </div>

                                        <?php

                                            $getImageQuery=$conn->query("SELECT * FROM tbl_status WHERE vehicle_detail_id = '$vehicleId' ORDER BY status_id ASC ");
                                            while ($im=$getImageQuery->fetch_array()) {

                                                $status_id=$im[0];
                                                $status_type=$im[1];
                                                $status_remark=$im[2];
                                                $vehicle_detail_id=$im[3];
                                                $status_date=$im[4];
                                                $status_date_new = date('d-m-Y H:s', strtotime($status_date)) ;                          
                                                //$status_date_new = $status_date = date('d F Y H:s'); 
                        
                                        ?>

                                        <div class="timeline_item ">
                                            <img class="tl_avatar" src="assets/sport-car.png" alt="" />
                                            <span><?php echo $reg_licens_no; ?> <small class="float-right text-right"><?php echo $status_date_new; ?></small></span>
                                            <h6 class="font600"><?php echo $status_type; ?></h6>
                                            <div class="msg">
                                                <p><?php echo nl2br($status_remark); ?></p>
                                                
                                                
                                            </div>                                
                                        </div>

                                        <?php } ?>

                                    </div>
                                </div>
                            </div>
                            <!--End Status -->
                            <!--Start Additinol Photos -->
                            <div class="tab-pane fade" id="pills-additionalphotos" role="tabpanel" aria-labelledby="pills-additionalphotos-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Additional Photos</h3>
                                    </div>
                                    <div class="card-body">
                                        

                                        <!-- Button trigger modal -->
                                        <?php if($stat=='2'){ }else{ ?>
                                        <button type="button" class="btn btn-info waves-effect waves-light" data-toggle="modal" data-target="#UploadImage">Add More Images</button>
                                        <?php } ?>
                                                
                                                
                                                <!-- Modal -->
                                                    <div class="modal fade" id="UploadImage" data-backdrop='static' data-keyboard='false' tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered" role="document">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLongTitle">Upload Additional Photos</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                              <span aria-hidden="true">&times;</span>
                                                            </button>
                                                          </div>
                                                          <div class="modal-body">
                                                           
                                                                <div class="" style="text-align: center;">
                                                                    <form class="form-horizontal form-material" id="Additional-photo-Form" method="POST">
                                                                        
                                                                        <input type="hidden" name="vehicle_detail_id" id="vehicle_detail_id" value="<?php echo $vehicleId; ?>" requered readonly>
                                                                        
                                                                        <div class="col-md-12">
                                                                            <br>
                                                                            <div class="col-md">
                                                                                <img id="blah" class="please" style="width: 30%;" src="assets/upload.png" alt="your image" />
                                                                            </div>
                                
                                                                            <div class="col-md">
                                                                                <br>
                                                                                <!--<input type='file' class="maybe"  accept= "image/jpeg, image/png" name="img1" id="img1" onchange="readURL(this);" />-->
                                                                                <input type="file" name="files[]" multiple/>  
                                                                            </div>
                                                                        </div>
                                                                        
                                                                        <div class="form-group">
                                                                            <label>Remark</label>
                                                                            <textarea name="remark" class="form-control" row="5" placeholder="Write Errors"></textarea>
                                                                            
                                                                        </div>
                                                                        
                                                                        
                                                                        <br>
                                                                        <button type="submit" class="btn btn-success waves-effect waves-light">Submit Image</button>
                                                                       
                                                                       <br><br>

                                                                    </form>
                                                                </div>
                                                
                                                           
                                                           
                                                           
                                                           
                                                          </div>
                                                          <!--<div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="button" class="btn btn-primary">Save changes</button>
                                                          </div>-->
                                                        </div>
                                                      </div>
                                                    </div>

                                            <div class="row px-3">
                                                    
                                            <?php
                                                $getImageQuery=$conn->query("SELECT * FROM tbl_additinal_image WHERE vehicle_detail_id = '$vehicleId' ");
                                                while ($im=$getImageQuery->fetch_array()) {

                                                    $Aimage_id=$im[0];
                                                    $Aimage=$im[1];
                                                    $Aimage_remark=$im[2];
                                                    $vehicle_detail_id=$im[3];
                                                    $Aimg_date=$im[4];
                                            ?>

                                                
                                                    <div class="col-lg-3 col-md-6 p-0">
                                                        <div class="item-box">
                                                            <a class="mfp-image img-fluid" data-toggle="modal" data-target=".bd-example-modal-additional-img-<?php echo $Aimage_id; ?>" >
                                                                <img style="width: 185px; height: 116px; object-fit: contain;" src="additinal_image/<?php echo $Aimage; ?>" alt="7" />
                                                            </a>
                                                        </div>
                                                    </div>

                                                    <div class="modal fade bd-example-modal-additional-img-<?php echo $Aimage_id; ?>" tabindex="-1" data-backdrop='static' data-keyboard='false' role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-body">
                                                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                      <!-- <span aria-hidden="true" class="text-dark">&times;</span> -->
                                                                  </button>
                                                                    <img src="additinal_image/<?php echo $Aimage; ?>" style="width:100%;" alt="" class="img-fluid">
                                                                    <hr>
                                                                    <p style="color: #000; font-weight: 700; font-size: large;"><?php echo nl2br($Aimage_remark); ?></p>
                                                                    <br>
                                                                </div>
                                                                  
                                                            </div>
                                                        </div>
                                                    </div>
                                                
                                            <?php } ?> 
                                                
                                                
                                                
                                             
                                            </div>


                                    </div>
                                </div>
                                
                                
                            </div>   
                            <!--End Additinol Photos -->                     
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script src="assets/js/themechanger.js"></script>

<script>
        
        $(document).on('submit', '#Additional-photo-Form', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);
        
        
        

        $.ajax({
            
            
                beforeSend : function() {
                    swal("Info !","Still Your Images Uploading. Please Be Patient !","info", {button:false,closeOnClickOutside: false});
                },
                
                url:"post/submit_additional_photos.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                
                
                
                
                
                success: function () {
                    swal("Thanks !","Your Details are Successfully Sent.","success");

                    setTimeout(function () {
                       // window.location.href = "index";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>
    
    <script>
        
        $(document).on('submit', '#Inventry-photo-Form', function(e){
        e.preventDefault(); //stop default form submission
        
        $("#btn-inv-photo-submit").attr("disabled",true);
        $("#inv-photo-modal-close").attr("disabled",true);
        
        var formData = new FormData($(this)[0]);
        
        
        

        $.ajax({
            
            
            
            xhr: function(){
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                xhr.upload.addEventListener('progress', function(event) {
                var percent = 0;
                var position = event.loaded || event.position;
                var total = event.total;
                if (event.lengthComputable)
                {
                percent = Math.ceil(position / total * 100);
                }
                
                
                
                $('#upload-bar-inv-photo').width(percent + '%');
                $('#upload-bar-label-inv-photo').html(percent + '%');
                
                
                var convertedTotal=(total/1024/1024).toFixed(2); var convertedUploded=(position/1024/1024).toFixed(2); console.log(convertedUploded+" / "+convertedTotal);
                
                
                $("#upload-status-inv-photo").html(convertedUploded+"MB /"+convertedTotal+"MB");
                
                
                
                
                
                }, true);
                }
                return xhr;
                },
            
            
                // beforeSend : function() {
                //     swal("Info !","Still Your Images Uploading. Please Be Patient !","info", {button:false,closeOnClickOutside: false});
                // },
                
                
                
                url:"post/submit_inventry_images.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                
                
                
                
                
                success: function () {
                    swal("Thanks !","Your Details are Successfully Sent.","success");

                    setTimeout(function () {
                       // window.location.href = "index";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>
    
    <script>
    
    $(document).ready(function(){
        
        $("#btn-open-modal-video").click(function(){
            
            $("#UploadVideo").modal({
                backdrop: 'static',
                keyboard: true
            });
            
        });
        $("#btn-view-inv-photo-modal").click(function(){
            
            $("#UploadInventryImages").modal({
                backdrop: 'static',
                keyboard: true
            });
            
        });
        
    });
        
        $(document).on('submit', '#video-Form', function(e){
        e.preventDefault(); //stop default form submission
        
        
        $("#btn-video-submit").attr("disabled",true);
        $("#video-modal-close").attr("disabled",true);
        
        var formData = new FormData($(this)[0]);
        
        
        

        $.ajax({
            
            xhr: function(){
                //upload Progress
                var xhr = $.ajaxSettings.xhr();
                if (xhr.upload) {
                xhr.upload.addEventListener('progress', function(event) {
                var percent = 0;
                var position = event.loaded || event.position;
                var total = event.total;
                if (event.lengthComputable)
                {
                percent = Math.ceil(position / total * 100);
                }
                
                
                
                $('#upload-bar').width(percent + '%');
                $('#upload-bar-label').html(percent + '%');
                
                
                var convertedTotal=(total/1024/1024).toFixed(2); var convertedUploded=(position/1024/1024).toFixed(2); console.log(convertedUploded+" / "+convertedTotal);
                
                
                $("#upload-status").html(convertedUploded+"MB /"+convertedTotal+"MB");
                
                
                
                
                
                }, true);
                }
                return xhr;
                },
            
            
                // beforeSend : function() {
                //     swal("Info !","Video is Uploading. Please Wait !","info", {button:false,closeOnClickOutside: false});
                // },
                
                url:"post/submit_video.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                
                
                
                
                
                success: function () {
                    swal("Thanks !","Your Details is Successfully Sent.","success");

                    setTimeout(function () {
                       // window.location.href = "index";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>
    
    <script>
        
        $(document).on('submit', '#Status-Form', function(e){
        e.preventDefault(); //stop default form submission
        var formData = new FormData($(this)[0]);
        
        
        

        $.ajax({
            
            
                beforeSend : function() {
                    swal("Info !","Status Updating. Please Wait !","info", {button:false,closeOnClickOutside: false});
                },
                
                url:"post/submit_status.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                
                
                
                
                
                success: function () {
                    swal("Thanks !","Your Details is Successfully Sent.","success");

                    setTimeout(function () {
                       // window.location.href = "index";
                       location.reload();
                    },1000);

                }

            });

        return false;
        });
    </script>

    <script>
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
    
                    reader.onload = function (e) {
                        $('#blah')
                            .attr('src', e.target.result)
                            .width(200)
                            .height(200);
                    };
    
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
        
            <script>
        $(function() {
            var video = $("video");
            var thumbnail = $("canvas");
            var input = $("input[type=file]");
            var ctx = thumbnail.get(0).getContext("2d");
            var duration = 0;
            var img = $("lola");
        
            input.on("change", function(e) {
                var file = e.target.files[0];
                // Validate video file type
                //if (["video/mp4"].indexOf(file.type) === -1) {
                    //alert("Only 'MP4' video format allowed.");
                    //return;
                //}
        
        
        
                // Set video source
                video.find("source").attr("src", URL.createObjectURL(file));
                // Load the video
                video.get(0).load();
                // Load metadata of the video to get video duration and dimensions
                video.on("loadedmetadata", function(e) {
                    duration = video.get(0).duration;
                    // Set canvas dimensions same as video dimensions
                    thumbnail[0].width = video[0].videoWidth;
                    thumbnail[0].height = video[0].videoHeight;
                    // Set video current time to get some random image
                    video[0].currentTime = Math.ceil(duration / 2);
                    // Draw the base-64 encoded image data when the time updates
                    video.one("timeupdate", function() {
                        ctx.drawImage(video[0], 0, 0, video[0].videoWidth, video[0].videoHeight);
                        img.attr("src", thumbnail[0].toDataURL());
                    });
                });
            });
        });
    </script>
        
        <script>
            function ValidateSize(file) {
                var FileSize = file.files[0].size / 1024 / 1024; // in MB
        
                var canvas = document.getElementById('viewport'),
                context = canvas.getContext('2d');
                
                if (FileSize > 1024) {
                    alert('File size exceeds 1024 MB');
                   // $(file).val(''); //for clearing with JquerySSSSS
                    
                    document.getElementById("filevideo").value = "";
                    document.getElementById("viewport").style.display = "none";
        
                } else {
                    document.getElementById("viewport").style.display = "inline";
        
                }
            }
        </script>


</body>
</html>
<?php } ?>