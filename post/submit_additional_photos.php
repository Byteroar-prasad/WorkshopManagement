<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $vehicle_detail_id = htmlspecialchars($_POST['vehicle_detail_id']);
        $remark = htmlspecialchars($_POST['remark']);
        
        
        
        $error=array();
        $extension=array("jpeg","jpg","png","JPEG","JPG","PNG");
    
    
        foreach($_FILES["files"]["tmp_name"] as $key=>$tmp_name) {
        $file_name=$_FILES["files"]["name"][$key];
        $file_tmp=$_FILES["files"]["tmp_name"][$key];
        $ext=pathinfo($file_name,PATHINFO_EXTENSION);
    
        if(in_array($ext,$extension)) {
            if(!file_exists("../additinal_image/".$file_name)) {
            if(move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../additinal_image/".$file_name)){
                
                //send to database
                $sql = "INSERT INTO `tbl_additinal_image`(`image_additinal_id`, `image`, `remark`, `vehicle_detail_id`) VALUES(null,'$file_name','$remark','$vehicle_detail_id')";
                
                $conn->query($sql);
                
                
                
                
                
            }
        }// }else {
        //     $filename=basename($file_name,$ext);
        //     $newFileName=$filename.time().".".$ext;
        //     move_uploaded_file($file_tmp=$_FILES["files"]["tmp_name"][$key],"../image_car/".$newFileName);
        // }
    }
    else {
        array_push($error,"$file_name, ");
    }
}
        
        
        // $ImageName1 = $_FILES['img1']['name'];
        // $fileElementName = 'photo';
        // $path = '../additinal_image/';
        // $location = $path . $_FILES['img1']['name']; 
        // move_uploaded_file($_FILES['img1']['tmp_name'], $location);
        
        // //$image = htmlspecialchars($_POST['image']);

        // //$stat = 1;


        // $sql = "INSERT INTO `tbl_additinal_image`(`image`, `remark`, `vehicle_detail_id`) VALUES (?,?,?)";

        // $stmt = mysqli_prepare($conn, $sql);

        // mysqli_stmt_bind_param($stmt, "sss", $ImageName1, $remark, $vehicle_detail_id);

        // $result = mysqli_stmt_execute($stmt);

        // if($result)
        // {
        //     echo 'Completed';

            


        // }else{
            
        //     echo 'Error';
            
        // }


    }

    mysqli_close($conn);

    ?>