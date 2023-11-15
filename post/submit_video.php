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
        
        
        $VideoName1 = $_FILES['filevideo']['name'];
        $fileElementName = 'video';
        $path = '../videos/';
        $location = $path . $_FILES['filevideo']['name']; 
        move_uploaded_file($_FILES['filevideo']['tmp_name'], $location);
        
        //$image = htmlspecialchars($_POST['image']);

        //$stat = 1;


        $sql = "INSERT INTO `tbl_video` (`video`, `remark`, `vehicle_detail_id`) VALUES (?,?,?)";

        $stmt = mysqli_prepare($conn, $sql);

        mysqli_stmt_bind_param($stmt, "sss", $VideoName1, $remark, $vehicle_detail_id);

        $result = mysqli_stmt_execute($stmt);

        if($result)
        {
            echo 'Completed';

            


        }else{
            
            echo 'Error';
            
        }


    }

    mysqli_close($conn);

    ?>