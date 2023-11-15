<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');


    $output=[];

    if($_POST)
    {
        $estimate_id = htmlspecialchars($_POST['estimate_id']);
        $vat = htmlspecialchars($_POST['vat']);
        
        // $user_id = htmlspecialchars($_POST['user_id']);
        // $discount = htmlspecialchars($_POST['discount']);
        // $note = htmlspecialchars($_POST['note']);
        // $additional_price = htmlspecialchars($_POST['additional_price']);
        
        
        $sql = "UPDATE tbl_estimate_tax SET vat='$vat', datetime='$currentDate' WHERE estimate_id='$estimate_id' ";

        if ($conn->query($sql) === TRUE) {
          echo "Record updated successfully";
        } else {
          echo "Error updating record: " . $conn->error;
        }


    }

    mysqli_close($conn);

?>