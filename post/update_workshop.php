<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $v_id = htmlspecialchars($_POST['v_id']);
        
        $wiper_blades = htmlspecialchars($_POST['wiper_blades']);
        $wiper_blades_remark = htmlspecialchars($_POST['wiper_blades_remark']);
        $windows_glass = htmlspecialchars($_POST['windows_glass']);
        $windows_glass_remark = htmlspecialchars($_POST['windows_glass_remark']);
        
        $replace_microfilter = htmlspecialchars($_POST['replace_microfilter']);
        $replace_microfilter_remark = htmlspecialchars($_POST['replace_microfilter_remark']);
        $coolant = htmlspecialchars($_POST['coolant']);
        $coolant_remark = htmlspecialchars($_POST['coolant_remark']);
        
        $engine_oil = htmlspecialchars($_POST['engine_oil']);
        $engine_oil_remark = htmlspecialchars($_POST['engine_oil_remark']);
        $v_belt = htmlspecialchars($_POST['v_belt']);
        $v_belt_remark = htmlspecialchars($_POST['v_belt_remark']);
        
        $noticeable_leaks = htmlspecialchars($_POST['noticeable_leaks']);
        $noticeable_leaks_remark = htmlspecialchars($_POST['noticeable_leaks_remark']);
        $damage_animals = htmlspecialchars($_POST['damage_animals']);
        $damage_animals_remark = htmlspecialchars($_POST['damage_animals_remark']);
        
        $annual_check = htmlspecialchars($_POST['annual_check']);
        
        $shock = htmlspecialchars($_POST['shock']);
        $shock_remark = htmlspecialchars($_POST['shock_remark']);
        
        $tyre_tread = htmlspecialchars($_POST['tyre_tread']);
        $tyre_tread_remark = htmlspecialchars($_POST['tyre_tread_remark']);
        
        $engine_gearbox = htmlspecialchars($_POST['engine_gearbox']);
        $engine_gearbox_remark = htmlspecialchars($_POST['engine_gearbox_remark']);
        $front_axle = htmlspecialchars($_POST['front_axle']);
        $front_axle_remark = htmlspecialchars($_POST['front_axle_remark']);
        
        $front_brake = htmlspecialchars($_POST['front_brake']);
        $front_brake_remark = htmlspecialchars($_POST['front_brake_remark']);
        $rear_axle = htmlspecialchars($_POST['rear_axle']);
        $rear_axle_remark = htmlspecialchars($_POST['rear_axle_remark']);
        
        $rear_brake = htmlspecialchars($_POST['rear_brake']);
        $rear_brake_remark = htmlspecialchars($_POST['rear_brake_remark']);
        $brake_lines = htmlspecialchars($_POST['brake_lines']);
        $brake_lines_remark = htmlspecialchars($_POST['brake_lines_remark']);
        
        $exhaust_system = htmlspecialchars($_POST['exhaust_system']);
        $exhaust_system_remark = htmlspecialchars($_POST['exhaust_system_remark']);
        $fuel_tank = htmlspecialchars($_POST['fuel_tank']);
        $fuel_tank_remark = htmlspecialchars($_POST['fuel_tank_remark']);
        
        $r_f_tyre_tread = htmlspecialchars($_POST['r_f_tyre_tread']);
        $r_b_tyre_tread = htmlspecialchars($_POST['r_b_tyre_tread']);
        $l_f_tyre_tread = htmlspecialchars($_POST['l_f_tyre_tread']);
        $l_b_tyre_tread = htmlspecialchars($_POST['l_b_tyre_tread']);
        $workshop_name = htmlspecialchars($_POST['workshop_name']);

        $f_l_breakpad_t = htmlspecialchars($_POST['f_l_breakpad_t']);
        $f_r_breakpad_t = htmlspecialchars($_POST['f_r_breakpad_t']);
        $b_l_breakpad_t = htmlspecialchars($_POST['b_l_breakpad_t']);
        $b_r_breakpad_t = htmlspecialchars($_POST['b_r_breakpad_t']);

        $f_l_breakdisk_t = htmlspecialchars($_POST['f_l_breakdisk_t']);
        $f_r_breakdisk_t = htmlspecialchars($_POST['f_r_breakdisk_t']);
        $b_l_breakdisk_t = htmlspecialchars($_POST['b_l_breakdisk_t']);
        $b_r_breakdisk_t = htmlspecialchars($_POST['b_r_breakdisk_t']);

        $road_test_special_comment = htmlspecialchars($_POST['road_test_special_comment']);
        
        
        
        // wiper_blades, wiper_blades_remark, windows_glass, windows_glass_remark, replace_microfilter, replace_microfilter_remark, coolant, coolant_remark, engine_oil, engine_oil_remark, v_belt, v_belt_remark, noticeable_leaks
        // noticeable_leaks_remark, damage_animals, damage_animals_remark, annual_check, shock, shock_remark, tyre_tread, tyre_tread_remark, engine_gearbox, engine_gearbox_remark, front_axle, front_axle_remark, front_brake, front_brake_remark
        // rear_axle, rear_axle_remark, rear_brake, rear_brake_remark, brake_lines, brake_lines_remark, exhaust_system, exhaust_system_remark, fuel_tank, fuel_tank_remark, r_f_tyre_tread, r_b_tyre_tread, l_f_tyre_tread, l_b_tyre_tread
                
        
        
        

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }
        
            $sql = "UPDATE tbl_vehicle_details SET wiper_blades='$wiper_blades', wiper_blades_remark='$wiper_blades_remark', windows_glass='$windows_glass', windows_glass_remark='$windows_glass_remark', replace_microfilter='$replace_microfilter', replace_microfilter_remark='$replace_microfilter_remark', coolant='$coolant', coolant_remark='$coolant_remark', engine_oil='$engine_oil', engine_oil_remark='$engine_oil_remark', v_belt='$v_belt', v_belt_remark='$v_belt_remark', noticeble_leaks='$noticeable_leaks', noticeble_leaks_remark='$noticeable_leaks_remark', damage_animals='$damage_animals', damage_animals_remark='$damage_animals_remark', annual_check='$annual_check', shock='$shock', shock_remark='$shock_remark', tyre_tread='$tyre_tread', tyre_tread_remark='$tyre_tread_remark', engine_gearbox='$engine_gearbox', engine_gearbox_remark='$engine_gearbox_remark', front_axle='$front_axle', front_axle_remark='$front_axle_remark', front_brake='$front_brake', front_brake_remark='$front_brake_remark', rear_axle='$rear_axle', rear_axle_remark='$rear_axle_remark', rear_brake='$rear_brake', rear_brake_remark='$rear_brake_remark', brake_lines='$brake_lines', brake_lines_remark='$brake_lines_remark', exhaust_system='$exhaust_system', exhaust_system_remark='$exhaust_system_remark', fuel_tank='$fuel_tank', fuel_tank_remark='$fuel_tank_remark', r_f_tyre_tread='$r_f_tyre_tread', r_b_tyre_tread='$r_b_tyre_tread', l_f_tyre_tread='$l_f_tyre_tread', l_b_tyre_tread='$l_b_tyre_tread', workshop_name='$workshop_name', f_l_breakpad_t='$f_l_breakpad_t', f_r_breakpad_t='$f_r_breakpad_t', b_l_breakpad_t='$b_l_breakpad_t', b_r_breakpad_t='$b_r_breakpad_t', f_l_breakdisk_t='$f_l_breakdisk_t', f_r_breakdisk_t='$f_r_breakdisk_t', b_l_breakdisk_t='$b_l_breakdisk_t', b_r_breakdisk_t='$b_r_breakdisk_t', road_test_special_comment='$road_test_special_comment' WHERE v_id= '$v_id' ";
            
        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
          
        } else {
          echo "Error updating record: " . $conn->error;
        }
        
    }
        
        $conn->close();


    ?>