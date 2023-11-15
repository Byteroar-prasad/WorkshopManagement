<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();


    $output=[];
    $dataArray = array();
    $GRNItemTotalCost=0;

    if($_POST)
    {
        $grn_items_id = htmlspecialchars($_POST['grn_items_id']);
        $grn_detail_id = htmlspecialchars($_POST['grn_detail_id']);
        $item_id = htmlspecialchars($_POST['item_id']);
        $price_batch_id = htmlspecialchars($_POST['price_batch_id']);
        $qty = htmlspecialchars($_POST['qty']);



        if ($price_batch_id == 0) {
          //Normal price batch
          /////////////////
          $sql = "DELETE FROM tbl_grn_items WHERE grn_items_id='$grn_items_id'";

          if ($conn->query($sql) === TRUE) {
            //echo "Record Deleted successfully";
            
            $sql = "UPDATE tbl_item SET `quantity`= quantity - '$qty' WHERE item_id= '$item_id'";

            if ($conn->query($sql) === TRUE) {
              //echo "Record Updated successfully";

                    //get all GRN Item
                    $ItemCount=0;
                    $getGRNItems=$conn->query("SELECT * FROM tbl_grn_items tgi INNER JOIN tbl_item tit ON tgi.item_id=tit.item_id WHERE tgi.grn_detail_id='$grn_detail_id' ORDER BY tgi.grn_items_id ASC");
                    $ResultCount = 0;
                    while($gGRNiRsrow = $getGRNItems->fetch_array()){

                        $ResultCount += 1;

                        $GRNItemItemId=$gGRNiRsrow[0];
                        $ItemId=$gGRNiRsrow[2];
                        $PriceBatchId=$gGRNiRsrow[3];
                        $CostPrice=(double)$gGRNiRsrow[4];
                        $SellingPrice=$gGRNiRsrow[5];
                        $GRNQTY=(double)$gGRNiRsrow[6];
                        $GRNItemStat=$gGRNiRsrow[7];
                        ////////////////////////////
                        $ItemName=$gGRNiRsrow[9];

                        $GRNItemCost = $CostPrice * $GRNQTY;

                        $GRNItemTotalCost+=$GRNItemCost;

                        $ItemCountView=$ItemCount+=1;
                        
                        $row='
                                <tr>
                                    <th scope="row">'.$ItemCountView.'</th>
                                    <td>'.$ItemName.'</td>
                                    <td><b style="float: right;">'.$GRNQTY.'</b></td>
                                    <td><b style="float: right;">'.number_format($GRNItemCost,2).'</b></td>
                                    <td>
                                        <form id="Delete-GRN-Item" method="POST">
                                            <input type="hidden" name="grn_items_id" value="'.$GRNItemItemId.'" required readonly>
                                            <input type="hidden" name="grn_detail_id" value="'.$grn_detail_id.'" required readonly>
                                            <input type="hidden" name="item_id" value="'.$ItemId.'" required readonly>
                                            <input type="hidden" name="price_batch_id" value="'.$PriceBatchId.'" required readonly>
                                            <input type="hidden" name="qty" value="'.$GRNQTY.'" required readonly>
                                            <button type="submit" id="btn-delete-grn-item" class="btn text-white bg-red btn-sm" style="float: right;"><i class="fa fa-trash-o"></i> Remove</button>   
                                        </form>   
                                    </td>
                                </tr>
                            ';
                            
                            array_push($dataArray,$row);
                        
                    }
                    
                    /////////////////
                    
                    
                    $output['result'] = true;
                    $output['msg'] = 'Successfully added quantity.';
                    $output['data'] = $dataArray;
                    $output['GRNItemTotalCost'] = number_format($GRNItemTotalCost,2);
                    $output['ResultCount'] = $ResultCount;



            } else {
              //echo "Error updating record: " . $conn->error;
                $output['result'] = false;
                $output['msg'] = 'Error added please reload the page 999';
            }


          } else {
            //echo "Error updating record: " . $conn->error;
            $output['result'] = false;
            $output['msg'] = 'Error added please reload the page 999';
          }
          ///////////////

        }else{
          //With Price Batch
          /////////////////
          $sql = "DELETE FROM tbl_grn_items WHERE grn_items_id='$grn_items_id'";

          if ($conn->query($sql) === TRUE) {
            //echo "Record Deleted successfully";
            
            $sql = "UPDATE tbl_item_price_batch SET `qty`= qty - '$qty' WHERE item_id= '$item_id' AND price_batch_id='$price_batch_id' ";

            if ($conn->query($sql) === TRUE) {
              //echo "Record Updated successfully";

                    //get all GRN Item
                    $ItemCount=0;
                    $getGRNItems=$conn->query("SELECT * FROM tbl_grn_items tgi INNER JOIN tbl_item tit ON tgi.item_id=tit.item_id WHERE tgi.grn_detail_id='$grn_detail_id' ORDER BY tgi.grn_items_id ASC");
                    $ResultCount = 0;
                    while($gGRNiRsrow = $getGRNItems->fetch_array()){

                        $ResultCount += 1;

                        $GRNItemItemId=$gGRNiRsrow[0];
                        $ItemId=$gGRNiRsrow[2];
                        $PriceBatchId=$gGRNiRsrow[3];
                        $CostPrice=(double)$gGRNiRsrow[4];
                        $SellingPrice=$gGRNiRsrow[5];
                        $GRNQTY=(double)$gGRNiRsrow[6];
                        $GRNItemStat=$gGRNiRsrow[7];
                        ////////////////////////////
                        $ItemName=$gGRNiRsrow[9];

                        $GRNItemCost = $CostPrice * $GRNQTY;

                        $GRNItemTotalCost+=$GRNItemCost;

                        $ItemCountView=$ItemCount+=1;
                        
                        $row='
                                <tr>
                                    <th scope="row">'.$ItemCountView.'</th>
                                    <td>'.$ItemName.'</td>
                                    <td><b style="float: right;">'.$GRNQTY.'</b></td>
                                    <td><b style="float: right;">'.number_format($GRNItemCost,2).'</b></td>
                                    <td>
                                        <form id="Delete-GRN-Item" method="POST">
                                            <input type="hidden" name="grn_items_id" value="'.$GRNItemItemId.'" required readonly>
                                            <input type="hidden" name="grn_detail_id" value="'.$grn_detail_id.'" required readonly>
                                            <input type="hidden" name="item_id" value="'.$ItemId.'" required readonly>
                                            <input type="hidden" name="price_batch_id" value="'.$PriceBatchId.'" required readonly>
                                            <input type="hidden" name="qty" value="'.$GRNQTY.'" required readonly>
                                            <button type="submit" id="btn-delete-grn-item" class="btn text-white bg-red btn-sm" style="float: right;"><i class="fa fa-trash-o"></i> Remove</button>   
                                        </form>   
                                    </td>
                                </tr>
                            ';
                            
                            array_push($dataArray,$row);
                        
                    }
                    
                    /////////////////
                    
                    
                    $output['result'] = true;
                    $output['msg'] = 'Successfully added quantity.';
                    $output['data'] = $dataArray;
                    $output['GRNItemTotalCost'] = number_format($GRNItemTotalCost,2);
                    $output['ResultCount'] = $ResultCount;



            } else {
              //echo "Error updating record: " . $conn->error;
                $output['result'] = false;
                $output['msg'] = 'Error added please reload the page 888';
            }


          } else {
            //echo "Error updating record: " . $conn->error;
            $output['result'] = false;
            $output['msg'] = 'Error added please reload the page 999';
          }
          ///////////////

        }







        


    }

    $conn->close();
    echo json_encode($output);

    ?>