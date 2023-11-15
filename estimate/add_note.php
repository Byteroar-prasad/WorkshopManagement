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
        $note = htmlspecialchars($_POST['note']);

                $UpdateNotesql = "UPDATE tbl_estimate_tax SET `note`='$note', `datetime`='$currentDate' WHERE estimate_id= '$estimate_id' ";
                if ($conn->query($UpdateNotesql) === TRUE) {
                  echo "Record updated successfully";
                } else {
                  echo "Error updating record: " . $conn->error;
                }


    }

    mysqli_close($conn);

?>