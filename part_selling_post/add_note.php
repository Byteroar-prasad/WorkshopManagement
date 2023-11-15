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
        $part_selling_id = htmlspecialchars($_POST['part_selling_id']);
        $user_id = htmlspecialchars($_POST['user_id']);
        $note = htmlspecialchars($_POST['note']);

                $UpdateTaxsql = "UPDATE tbl_part_selling_tax SET `user_id`= '$user_id', `note`='$note', `datetime`='$currentDate' WHERE part_selling_id= '$part_selling_id' ";
                if ($conn->query($UpdateTaxsql) === TRUE) {
                  echo "Record updated successfully";
                } else {
                  echo "Error updating record: " . $conn->error;
                }


    }

    mysqli_close($conn);

?>