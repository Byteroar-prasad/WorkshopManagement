<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    //$currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $user_id = htmlspecialchars($_POST['user_id']);
        $tel = htmlspecialchars($_POST['tel']);
        $name = htmlspecialchars($_POST['name']);
        $password = htmlspecialchars($_POST['password']);

        $hashed = password_hash($password, PASSWORD_DEFAULT);
        
        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $sql = "UPDATE users_login SET `tel`='$tel', `name`='$name', `password`='$hashed' WHERE user_id= '$user_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }

        $conn->close();


    }

   

    ?>