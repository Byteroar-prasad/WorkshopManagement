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
<?php if ($user_role=='1' || $user_role=='0'){ ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

        <style>
            .select2-container .select2-selection--single {
                height: 34px !important;
                border-color: #E8E9E9 !important; 
                font-size: 14px !important;
            }
        </style>

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
                        
                        <!-- <h4>FORM REGISTRATION</h4> -->
                        
                        <form class="card" method="POST" id="Form">
                            <div class="card-body">
                                <h3 class="card-title">Vehicle Details</h3>
                                <div class="row">
                                    
                                    <div class="col-md-6">
                                        
                                          <div class="form-group">
                                            <label for="1">License No. <font style="color: #FF0000;">*</font></label>

                                            <select class="js-example-basic-single form-control" name="reg_license_no" onchange = "licenceChanged(this.value)" required>
                                                <option value="" selected disabled>Select License No.</option>
                                                <?php

                                                    $getDataForDate=$conn->query("SELECT * FROM tbl_vehicle");
                                                    while ($row=$getDataForDate->fetch_array()) {
                                                ?>
                                                    <option value="<?php echo $row[2];?>"><?php echo $row[2];?></option>
                                                <?php } ?>
                                            </select>

                                            <!-- <input type="text" class="form-control" id="1" placeholder="Email"> -->
                                            <input type="hidden" class="form-control">
                                                   
                                          </div>
                                          
                                          <input type="hidden" class="form-control" name="client_id" id="client_id" placeholder="Client Id" readonly>

                                          <div class="form-group">
                                            <label for="2">Date</label>
                                            <input type="date" class="form-control" id="2" value="<?php echo date("Y-m-d"); ?>" name="reg_date" placeholder="Date" readonly required>
                                          </div>
                                          <div class="form-group">
                                            <label for="customer">Customer</label>
                                            <input type="text" class="form-control" name="reg_customer" id="customer" placeholder="Customer" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label for="phone_no">Telephone No.</label>
                                            <input type="text" class="form-control" name="reg_phone_no" id="phone_no" placeholder="Telephone No." readonly>
                                          </div>
                                          <div class="form-group">
                                            <label for="5">First Reg. Date</label>
                                            <input type="text" class="form-control" name="f_reg_date" id="f_reg_date" placeholder="First Reg. Date" readonly>
                                          </div>

                                        <div class="form-group">
                                            <label>Service Booklet <font style="color: #FF0000;">*</font></label><br>
                                                    
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="bookletYes" value="Yes" name="service_booklet" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="bookletYes">Yes</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="bookletNo" value="No" name="service_booklet" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="bookletNo">No</label>
                                                    </div>
                                                </div>
                                                    
                                        </div>

                                        <div class="form-group mb-0">
                                            <label>SOC (HV Battery) <font style="color: #FF0000;">*</font></label><br>
                                            <!--<input type="text" placeholder="" name="soc_hv_battery" class="form-control" required>-->
                                                    
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="soc_hv_1" name="soc_check_value" value="Ok" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="soc_hv_1">Yes</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="soc_hv_2" name="soc_check_value" value="N/A" class="custom-control-input" required>
                                                        <label class="custom-control-label" for="soc_hv_2">N/A</label>
                                                    </div>
                                                </div>
                
                                                    
                                                <div class="slider-wrapper">
                                                    <br><input type="range" style="display: none;" min="0" max="100" id="soc_hv_range" value="0" class="new-bar">
                                                    <span id="hv-range-meter" style="display:none">0 %</span>
                                                </div>
                                                    
                                                    
                                                <input type="hidden" name="soc_hv_battery" id="soc_hv_battery" >
                                                    
                                                <style>
                                                .new-bar {
                                                    background-color: #a9acb1;
                                                    border-radius: 15px;
                                                    display: block;
                                                    height: 4px;
                                                    position: relative;
                                                    width: 100%;
                                                }
                                                        
                                                </style>
                                                    
                                        </div>
                                          
                                          
                                        
                                    </div>

                                    <div class="col-md-6">
                                       
                                          <div class="form-group">
                                            <label for="6">Email Address</label>
                                            <input type="email" class="form-control" name="email" id="email" placeholder="Email" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label for="7">Modal</label>
                                            <input type="text" class="form-control" name="reg_model" id="model" placeholder="Modal" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label for="8">Chassis No.</label>
                                            <input type="text" class="form-control" name="reg_chassis_no" placeholder="Chassis No." id="chassis" readonly>
                                          </div>
                                          <div class="form-group">
                                            <label for="9">Mileage/Km <font style="color: #FF0000;">*</font></label>
                                            <input type="text" class="form-control" name="reg_mileage" id="millage" placeholder="Mileage/Km" required>
                                          </div>

                                        <div class="form-group">
                                            <label>Fuel % (Approximate) <font style="color: #FF0000;">*</font></label><br>        
                                            <br>             
                                                <div class="slider-wrapper">
                                                <!--<input type="text" name="reg_fuel" class="js-step" />-->
                                                    <input type="range" min="0" max="100" name="reg_fuel" value="0" id="reg_fuel" class="new-bar" required> <!--<br> <p id="fuel_limit">%</p>-->
                                                    <span id="fuel-meter">0 %</span>
                                                           
                                                </div>   
                                        </div>

                                        <div class="form-group mb-0" style="margin-top: 22px;">
                                            <label for="10">Customer Charging Wish</label>
                                            <input type="text" placeholder="" id="10" value="" name="reg_customer_charging" class="form-control">
                                                    
                                        </div>
                                          
                                         
                                    </div>

                                    

                                </div>
                            </div>
                            
                            <div class="card-body">
                                <h3 class="card-title">Description</h3>
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        <div class="form-group row">
                                            <div class="col-sm-12">
                                                <textarea class="form-control" value="" name="comments" rows="10"></textarea>
                                            </div>
                                        </div>  
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <h3 class="card-title">Inside Check</h3>
                                <div class="row">
                                    
                                    <div class="col-md-12">
                                        
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Display & Instrument Lighting</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="one" name="display" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="one">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="two" name="display" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="two">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" type="text" value="" name="display_remark" placeholder="Remarks">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Interior Lights</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="three" name="interior_lights" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="three">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="four" name="interior_lights" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="four">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" type="text" value="" name="interior_lights_remark" placeholder="Remarks">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Signals (lights, indicators, hazard, horn)</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="Five" name="signals" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="Five">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="Six" name="signals" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="Six">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" type="text" value="" name="signals_remark" placeholder="Remarks">
                                            </div>
                                        </div>

                                        <hr>


                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Steering</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="Seven" name="steering" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="Seven">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="Eight" name="steering" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="Eight">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" type="text" value="" placeholder="Remarks" name="steering_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Hand Brake /Parking brake</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="Nine" name="hand_brake" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="Nine">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="Ten" name="hand_brake" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="Ten">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="hand_brake_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Aircon - Blower</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="11" name="aircon" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="11">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="12" name="aircon" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="12">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="aircon_remark">
                                            </div>
                                        </div>

                                        <hr>
                                        <!---------------new adding----------->
                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Power Window Controls</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="power_window_1" name="power_window" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="power_window_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="power_window_2" name="power_window" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="power_window_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="power_window_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Exterior Lights</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="exterior_lights_1" name="exterior_lights" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="exterior_lights_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="exterior_lights_2" name="exterior_lights" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="exterior_lights_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="exterior_lights_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Horn</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="horn_1" name="horn" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="horn_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="horn_2" name="horn" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="horn_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="horn_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Grab handles</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="grab_handles_1" name="grab_handles" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="grab_handles_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="grab_handles_2" name="grab_handles" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="grab_handles_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="grab_handles_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Sun Roof</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="sun_roof_1" name="sun_roof" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="sun_roof_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="sun_roof_2" name="sun_roof" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="sun_roof_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="sun_roof_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Speaker Covers</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="speaker_covers_1" name="speaker_covers" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="speaker_covers_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="speaker_covers_2" name="speaker_covers" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="speaker_covers_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="speaker_covers_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Carpets</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="carpets_1" name="carpets" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="carpets_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="carpets_2" name="carpets" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="carpets_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="carpets_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Seat Covers</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="seat_covers_1" name="seat_covers" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="seat_covers_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="seat_covers_2" name="seat_covers" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="seat_covers_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="seat_covers_remark">
                                            </div>
                                        </div>

                                        <hr>

                                        <div class="form-group row">
                                            <label for="example-text-input" class="col-sm-12 col-form-label">Rear Display</label>
                                            <div class="col-sm-12">
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rear_display_1" name="rear_display" value="Ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="rear_display_1">Ok</label>
                                                    </div>
                                                </div>
                                                <div class="form-check-inline my-1">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="rear_display_2" name="rear_display" value="Not ok" class="custom-control-input">
                                                        <label class="custom-control-label" for="rear_display_2">Not ok</label>
                                                    </div>
                                                </div>

                                                <input class="form-control" value="" type="text" placeholder="Remarks" name="rear_display_remark">
                                            </div>
                                        </div>
                                                  
                                        <!-- end new adding --------------->       
                                            </div>    


                                    
                                    

                                </div>
                            </div>


                            


                            <div class="card-body">
                                <h3 class="card-title">Vehicle Condition <font style="color: #FF0000;">*</font></h3>
                                <div class="row">
                                    
                                   <div class="col-md-12">
                                    
                                        <div class="row">
                                            <!-- <label for="example-text-input" class="col-sm-2 col-form-label">Engine & Gearbox leaks</label> -->
                                            <div class="col-md-8" id="img-area" >
                                                <img src="assets/001.jpg" style="width: 100%;" id="v-image">
                                                <!-- <input class="form-control" type="text" placeholder="Remarks" id="example-text-input"> -->
                                            </div>

                                                    
                                            <div class="col-md-4">
                                                <label><b>Legend</b></label>
                                                <input type="hidden" id="txt-v-img" name="vehicle_screen">

                                                <br>
                                                <div id="stone_damage_red" style="background-color: #FF0000; padding: 15px; margin-bottom: 5px; width: 100%; height: 50px;" class="radio my-2">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="stone_damage" name="customRadio" class="custom-control-input stone">
                                                        <label class="custom-control-label" style="color: #FFF;" for="stone_damage">Stone Damage</label>
                                                    </div>
                                                </div>
                                               
                                                <div class="radio my-2" id="dents_blue" style="background-color: #0025ff; padding: 15px; margin-bottom: 5px; width: 100%; height: 50px;">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="dents" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" style="color: #FFF;" for="dents">Dents</label>
                                                    </div>
                                                </div>
                                                
                                                <div id="sents_scratches_purple" class="radio my-2" style="background-color: #c700ff; padding: 15px; margin-bottom: 5px; width: 100%; height: 50px;">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="sents_scratches" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" style="color: #FFF;" for="sents_scratches">Dents Scratches</label>
                                                    </div>
                                                </div>
                                             
                                                <div id="collision_orange" class="radio my-2" style="background-color: #ff7100; padding: 15px; margin-bottom: 5px; width: 100%; height: 50px;">
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="collision" name="customRadio" class="custom-control-input">
                                                        <label class="custom-control-label" style="color: #FFF;" for="collision">Collision Damage</label>
                                                    </div>
                                                </div>
                                              
                                                <button id="t-btn" class="btn btn-success float-right">DONE</button>
                                                
                                                <button id="c-btn" class="btn btn-danger float-right" style="margin-right:10px;">CLEAR</button>


                                                <img id="view-screenshot" style="width: 100%;">
                                                        
                                            </div>
                                        </div> 


                                    <div class="form-group row" style="text-align: center; place-content: center; display: none;">
                                        <label for="example-text-input" class="col-sm-12 col-form-label">Restore Underbody Protection</label>
                                        
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="Clean1" name="body_work" value="Clean" class="custom-control-input">
                                                    <label class="custom-control-label" for="Clean1">Clean</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="Dirty1" name="body_work" value="Dirty" class="custom-control-input">
                                                    <label class="custom-control-label" for="Dirty1">Dirty</label>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="VDirty1" name="body_work" value="Very Dirty" class="custom-control-input">
                                                    <label class="custom-control-label" for="VDirty1">Very Dirty</label>
                                                </div>
                                            </div>
                                       

                                    </div>

                                    <br><br>
                                    <hr>
                                    <br><br>
                                    <div class="table-responsive">
                                        <table class="table table-bordered mb-0">
                                            <thead>
                                            <tr>
                                                <th>Spare Wheel</th>
                                                <th>Jack</th>
                                                <th>Tools</th>
                                                <th>CD</th>
                                                <th>Lighter</th>
                                                <th>Sim Card</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="100" name="spare_wheel" value="Yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="100">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="101" name="spare_wheel" value="No" class="custom-control-input">
                                                            <label class="custom-control-label" for="101">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="102" name="spare_wheel" value="N/A" class="custom-control-input">
                                                            <label class="custom-control-label" for="102">N/A</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="103" name="jack" value="Yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="103">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="104" name="jack" value="No" class="custom-control-input">
                                                            <label class="custom-control-label" for="104">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="105" name="jack" value="N/A" class="custom-control-input">
                                                            <label class="custom-control-label" for="105">N/A</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="106" name="tools" value="Yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="106">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="107" name="tools" value="No" class="custom-control-input">
                                                            <label class="custom-control-label" for="107">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="108" name="tools" value="N/A" class="custom-control-input">
                                                            <label class="custom-control-label" for="108">N/A</label>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="109" name="cd" value="Yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="109">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="110" name="cd" value="No" class="custom-control-input">
                                                            <label class="custom-control-label" for="110">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="111" name="cd" value="N/A" class="custom-control-input">
                                                            <label class="custom-control-label" for="111">N/A</label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="112" name="lighter" value="Yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="112">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="113" name="lighter" value="No" class="custom-control-input">
                                                            <label class="custom-control-label" for="113">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="114" name="lighter" value="N/A" class="custom-control-input">
                                                            <label class="custom-control-label" for="114">N/A</label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="115" name="sim" value="Yes" class="custom-control-input">
                                                            <label class="custom-control-label" for="115">Yes</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="116" name="sim" value="No" class="custom-control-input">
                                                            <label class="custom-control-label" for="116">No</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="117" name="sim" value="N/A" class="custom-control-input">
                                                            <label class="custom-control-label" for="117">N/A</label>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            
                                            </tbody>
                                        </table>
                                    </div>


                                    <br>
                                    <div class="form-group row">
                                        <!-- <label for="example-text-input" class="col-sm-2 col-form-label">Engine & Gearbox leaks</label> -->
                                        <div class="col-md-6" style="display: none;">
                                            <div class="p-20">
                                                <div class="form-group">
                                                    <label>If extra work required</label>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="118" name="extra" value="Leave it" class="custom-control-input">
                                                            <label class="custom-control-label" for="118">Leave it</label>
                                                        </div>
                                                    </div>
                                                    <div class="form-check-inline my-1">
                                                        <div class="custom-control custom-radio">
                                                            <input type="radio" id="119" name="extra" value="Do" class="custom-control-input">
                                                            <label class="custom-control-label" for="119">Do it</label>
                                                        </div>
                                                    </div>
                                                   
                                                    
                                                </div>
                                                <div class="form-group">
                                                    <label style="display: none;">Up to amount of</label>
                                                    <input type="hidden" placeholder="" value="" name="amount" class="form-control">
                                                </div>
                                            </div>
                                        </div> 

                                            <input type="hidden" placeholder="" value="Cash" name="pay" class="form-control">
                                        

                                        <input type="hidden" name="user_name" placeholder="<?php echo $user_name; ?>" value="<?php echo $user_name; ?>" class="form-control" readonly required/>

                                    </div>

                                    <div class="row">
                                        
                                            <div class="col-md-2">

                                                <br>
                                                
                                                <div class="col-md">
                                                    <img id="blah" class="please" style="width: 80%;" src="assets/upload.png" alt="your image" />
                                                </div>

                                                <div class="col-md">
                                                    <br>
                                                    <input type="file" name="files[]" multiple/>   
                                                    <!--<input type='file' class="maybe"  accept= "image/jpeg, image/png" name="img1" id="img1" onchange="readURL(this);" />-->
                                                </div>
                                            </div>

                                    </div>


                                            <div class="col-md-12">
                                                <div class="p-20">
                                                    <div class="form-group">
                                                        <br><br>
                                                        <p>I/we agree to allow Bavarian Automobile Engineering (Pvt) Ltd to carry out the necessary diagnosis and/or repairs to the vehicle as specified in the repair order. All relevant labor charges and parts shall be paid by me/us prior to the release of the vehicle. Great care and attention is assured while the vehicle is in premises od Bavarian Automobile Engineering (Pvt) Ltd., and any damages on the vehicle which is beyond the control of Bavarian Automobile Engineering (Pvt) Ltd will not be the responsibility of Bavarian Automobile Engineering (Pvt) Ltd. No cash or valuables in the car, please remove any other personal goods. Bavarian Automobile Engineering (Pvt) Ltd., will not bear any responsibility for the customer’s personal belongings. Bavarian Automobile Engineering (Pvt) Ltd will not keep old parts in the possession of Bavarian Automobile Engineering (Pvt) Ltd and the customer has to take all the parts at the time of collecting his/her vehicle.</p>
                                                        
                                                        
                                                        <div>
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" class="custom-control-input" id="accept" data-parsley-multiple="groups" data-parsley-mincheck="2" required>
                                                                <label class="custom-control-label" for="accept">Accept <font style="color: #FF0000;">*</font></label>
                                                            </div>
                                                        </div>
                                                    
                                                    
                                                    </div>
                                                </div>
                                            </div>
  
                                    </div> 

                                    
                                    
                                    

                                </div>
                            </div>


                            <div class="card-footer text-right">
                                <button type="submit" id="register" class="btn btn-primary">Register</button>
                            </div>
                        </form>


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

<script src="assets/js/html2canvas.js"></script>
<script src="assets/js/html2canvas.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

    <script type="text/javascript">
       
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>


    <script type="text/javascript">
        
        
        
        function licenceChanged(licence){
           
          $.ajax({
              url:'controls/get_vehicle_details.php',
              type:'POST',
              data:{
                  licence:licence
              },
              success:function(data){
                 
                 var json=JSON.parse(data);
                 
        
        
        if(json.result){
            
            
            $("#client_id").val(json.client_id);
            $("#email").val(json.email);
            $("#customer").val(json.customer);
            $("#phone_no").val(json.phone_no);
            $("#model").val(json.model);
            $("#chassis").val(json.chassis);
            $("#f_reg_date").val(json.f_reg_date);
            
            
            
            
        }
                 
                 
                 
                 
                 
              },
              error:function(data,err,xhr){
                  console.log(data+" "+err)
              }
              
          });
           
           
           
           
           
        }
        
        



                
                $(document).ready(function(){
                    
                     $("#reg_fuel").change(function(){
                          
                         $("#fuel-meter").html($("#reg_fuel").val()+" %");
                    });
                    
                    
                    
                    
                    
                    
                    //SOC HV battrey SHOW Hide Start
                    $("#soc_hv_1").change(function(){
                        $("#soc_hv_range").show(); 
                         $("#hv-range-meter").show(); 
                    });
                    $("#soc_hv_2").change(function(){
                        $("#soc_hv_range").hide(); 
                         $("#hv-range-meter").hide(); 
                        $("#soc_hv_battery").val("N/A");
                    });
                    $("#soc_hv_range").change(function(){
                        //$("#soc_hv_range").hide(); 
                        $("#soc_hv_battery").val(
                            $("#soc_hv_range").val() );
                            
                            $("#hv-range-meter").html($("#soc_hv_range").val()+" %");
                            
                    });
                    //SOC HV battrey SHOW Hide End
                    
                    




                    $("#Form").submit(function(e){

                        e.preventDefault();
                        
                        
                       
                        
                        
                        if($('#view-screenshot').attr('src')==undefined){
                            
                           Swal.fire({
                        title:'Warning !',
                        text:'Please mark all body damages and click done when complete', 
                        icon:'warning'
                    });
                            
                        }else{
                           
                               //alert(imageArray.length);


                        var formData = new FormData($(this)[0]);

                        //alert(formData);


        $.ajax({
            
            
                beforeSend : function() {

                    Swal.fire({
                          title:'Please wait while uploading...',
                          // text:json.msg,
                          html:'<div class="progress" style="height:20px"><div class="progress-bar bg-default" style="width:0%;" id="upload-bar"><span id="upload-bar-label">0%</span></div></div><span id="upload-status">0 MB / 0 MB</span>',
                          icon:'warning',
                          showConfirmButton:false,
                          showCancelButton:false,
                          allowOutsideClick: false,

                        });

                    
                },
                
                
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
                
                
                var convertedTotal=(total/1024/1024).toFixed(2); 
                var convertedUploded=(position/1024/1024).toFixed(2); 
                
                
                
                $("#upload-status").html(convertedUploded+"MB /"+convertedTotal+"MB");
                
                
                
                
                
                }, true);
                }
                return xhr;
                },
                
                
                url:"post/register_vehicle_service_advisor.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,
                 
                success: function (data) {
                    
                   
                var n = data.includes("ok_");


                if(n){


                    Swal.fire({
                        title: 'Success',
                        text: 'Successfully Registered.',
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'OK'
                          }).then((result) => {
                            if (result.isConfirmed) {
                              //location.reload();
                              window.location.href = "index";
                            }
                          });

                }else{
                     Swal.fire({
                        title:'Warning !',
                        text:'Something went wrong.', 
                        icon:'warning'
                    });
                }



                },
                error:function(err){
                    //alert(err);
                    Swal.close();
                }

            });


                           
                           
                           
                        }


                        return false;
                    });



                    $("#c-btn").click(function(event){
                        event.preventDefault();
                        
                        
                                                    
                        Swal.fire({
                              title: 'Are you sure?',
                              text: "Do you want to revert this",
                              icon: 'warning',
                              showCancelButton: true,
                              confirmButtonColor: '#3085d6',
                              cancelButtonColor: '#d33',
                              confirmButtonText: 'Yes, clear it!'
                            }).then((result) => {
                              if (result.isConfirmed) {
                                  
                                    $('#img-area'). empty();
                                    var imageView=document.createElement('img');
                                    imageView.src='assets/001.jpg';
                                    imageView.style.width = '80%';
                                    
                                    
                                    
                                    $('#img-area').append(imageView);
                        
                              }
                            })

                        
                    });



                    var global_color='';
                    

                    $("#t-btn").click(function(event){

                        event.preventDefault();
                        Swal.fire({
                          text: "Please wait...",
                          imageUrl:"assets/car-load.gif",
                          showConfirmButton: false,
                          allowOutsideClick: false
                        });



                       html2canvas(document.getElementById("img-area")).then(function(canvas){
                            var result= canvas.toDataURL('image/png');
                            $("#txt-v-img").val(result);
                            $('#view-screenshot').attr('src',result);

                            Swal.close();


                            // console.log(result);
                        });
                    });





                     $("#img-area").click(function(event){            
                      

                      if(global_color===''){
                            
                             alert('select a value from legend');

                      }else{
                        /*var relX = event.pageX-9;
                        var relY = event.pageY-8;*/
                        
                        var relX = (event.pageX - $(this).offset().left)-9;
                        var relY = (event.pageY - $(this).offset().top)-8;




                        var color = global_color;
                          var size = '20px';
                          $("#img-area").append(


                            $('<div></div>').css('position', 'absolute').css('border-radius', '100px').css('top', relY + 'px').css('left', relX + 'px').css('width', size).css('height', size).css('background-color', color)


                          );
                       
                      }


                         



                    });









                    $("#stone_damage").change(function(){
                       var selectedColor=$("#stone_damage_red").css( "background-color" );
                       global_color=selectedColor;
                        
                    });

                    $("#dents").change(function(){
                       var selectedColor=$("#dents_blue").css("background-color" );
                        global_color=selectedColor;
                    });

                    $("#sents_scratches").change(function(){
                       var selectedColor=$("#sents_scratches_purple").css( "background-color" );
                        global_color=selectedColor;
                    });

                    $("#collision").change(function(){
                       var selectedColor=$("#collision_orange").css( "background-color" );
                        global_color=selectedColor;

                      










                    });

                });

               



        </script>

        
        <script>
            $(document).ready(function(){
                
                $("#soc_hv_1").change(function(){
                       
                      //$("#soc_hv_range").show(); 
                      alert ('guyguy');
                        
                    });
                
            }
     
            
        </script>



</body>
</html>

<?php }else{ ?>

<script type="text/javascript">
    window.location.href="404.php";
</script>

<?php } ?>