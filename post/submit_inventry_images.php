<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $vehicle_detail_id = htmlspecialchars($_POST['vehicle_detail_id']);

        $error=array();
        $extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
    
    
        foreach($_FILES["inve_files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["inve_files"]["name"][$key];
        $file_tmp=$_FILES["inve_files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
        if(in_array($ext,$extension)) {
            if(!file_exists("../image_car/".$file_name)) {
            if(move_uploaded_file($file_tmp=$_FILES["inve_files"]["tmp_name"][$key],"../image_car/".$file_name)){
                
                //send to database
                $sql = "INSERT INTO `tbl_vehicle_images`(`image_id`, `image`, `vehicle_detail_id`) VALUES(null,'$file_name','$vehicle_detail_id')";
                
                $conn->query($sql);
   
            }
        }
    }

    else {
        array_push($error,"$file_name, ");
    }
}
        
        



    }

    mysqli_close($conn);

    ?>