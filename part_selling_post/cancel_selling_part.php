<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];

    if($_POST)
    {
        $part_selling_id = htmlspecialchars($_POST['part_selling_id']);


        $DeleteSellingDetailssql = "DELETE FROM tbl_part_selling_details WHERE part_selling_id='$part_selling_id' ";
        if ($conn->query($DeleteSellingDetailssql) === TRUE) {
            //echo 'Completed Receipt';

            $DeleteSellingTaxsql = "DELETE FROM tbl_part_selling_tax WHERE part_selling_id= '$part_selling_id' ";
            if ($conn->query($DeleteSellingTaxsql) === TRUE) {

                echo 'Completly Deleted';

 
            } else {
                 echo 'Err';       
                        
            }

        }else{  
           echo 'Error Deleted';   
        }


    }

    mysqli_close($conn);
    // echo json_encode($output);

    ?>