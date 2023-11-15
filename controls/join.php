<?php

    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


     if($_POST)
     {
        
        // echo json_encode($_POST['name']);
         
        $name = $_POST['name'];     
        $email = $_POST['email'];
        $role = $_POST['role']; 
        $tel = $_POST['tel'];
        $cpassword = $_POST['confirm_password'];
        $hashed = password_hash($cpassword, PASSWORD_DEFAULT);

        //$stat = 0;
        //$days = 0;


        $sql = "INSERT INTO  users_login (name, email, password, role, tel) VALUES (?,?,?,?,?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $name, $email, $hashed, $role, $tel);
        $result = mysqli_stmt_execute($stmt);

 
        ini_set( 'display_errors', 1 );
        error_reporting( E_ALL );
        $from = "prestigeautomobile@silicontech.lk";
        $to = $email;
        $subject = "Users Login Details";
        $message = "
        
        
                    Dear $name,

                    Your Workshop Management™ Account has been created, you can use these credentials to login to your account

                    User Name - $email
                    Password - $cpassword
                    
                    Regards,
                    The Management Team,
                    Bavarian Automobile Engineering (Pvt) Ltd
                    
                    

                    ---------------- This is a auto genereted Email by Bavarian Automobile Engineering (Pvt) Ltd ----------------
                    ------------------------------------------ Powered By AMAZOFT -----------------------------------------------

                    
                    ";
                    $headers = "From:" . $from;
                    mail($to,$subject,$message, $headers);

     }else{
         echo 'Error 9119';
     }

    mysqli_close($conn);

?>