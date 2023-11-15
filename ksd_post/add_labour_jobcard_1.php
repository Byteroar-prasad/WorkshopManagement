<?php
    require_once('../db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    $currentDate=date('Y-m-d H:i:s');

    $LabourCount1=0;
    $LabourCount2=0;
    $LabourCount3=0;
    $LabourCount4=0;
    $FRUCount=0;



    function getP1Data($searchfor,$contents){

        global $tempArrayP1;


        $m = '';
         $pattern = preg_quote($searchfor, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store all matching occurences in $matches
           
            if(preg_match_all($pattern, $contents, $matches)){
               
               $m =  implode("*", $matches[0]);
                
                array_push($tempArrayP1, $m);

            }

    }

    function getP2Data($searchfor,$contents){

        global $tempArrayP2;
        
         $pattern = preg_quote($searchfor, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store all matching occurences in $matches
            $o ='';
            if(preg_match_all($pattern, $contents, $matches)){
               
              $o =  implode("*", $matches[0]);
                
                array_push($tempArrayP2,$o);

            }

    }

    function getP3Data($searchfor,$contents){

        global $tempArrayP3;
        
         $pattern = preg_quote($searchfor, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store all matching occurences in $matches
            $p ='';
            if(preg_match_all($pattern, $contents, $matches)){
               
              $p =  implode("*", $matches[0]);
                
                array_push($tempArrayP3,$p);

            }

    }

    function getP4Data($searchfor,$contents){

        global $tempArrayP4;
        
         $pattern = preg_quote($searchfor, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store all matching occurences in $matches
            $q ='';
            if(preg_match_all($pattern, $contents, $matches)){
               
              $q =  implode("*", $matches[0]);
                
                array_push($tempArrayP4,$q);

            }

    }

    function getP10Data($searchfor,$contents){

        global $tempArrayP10;
        
         $pattern = preg_quote($searchfor, '/');
            // finalise the regular expression, matching the whole line
            $pattern = "/^.*$pattern.*\$/m";
            // search, and store all matching occurences in $matches
            $n ='';
            if(preg_match_all($pattern, $contents, $matches)){
               
              $n =  implode("*", $matches[0]);
                
                array_push($tempArrayP10,$n);

            }

    }

    $output=[];

    if($_POST)
    {
        $job_id = htmlspecialchars($_POST['job_id']);

        $KSDFile = $_FILES['ksdfile']['name'];
        $path = '../ksd_file/';
        $location = $path . $_FILES['ksdfile']['name'];
        

        if(move_uploaded_file($_FILES['ksdfile']['tmp_name'], $location)){


            $contents = file_get_contents($location);
            $tempArrayP1 = array();
            $tempArrayP2 = array();
            
            $tempArrayP3 = array();
            $tempArrayP4 = array();
            $tempArrayP10 = array();

            $LABOUR_2_ID=0;
            $LABOUR_3_ID=0;
            $LABOUR_4_ID=0;
            $FRUID=0;

            $searchfor = '<P01>';
            getP1Data($searchfor,$contents);

            $searchfor = '<P02>';
            getP2Data($searchfor,$contents);

            $searchfor = '<P03>';
            getP3Data($searchfor,$contents);

            $searchfor = '<P04>';
            getP4Data($searchfor,$contents);

            $searchfor = '<P10>';
            getP10Data($searchfor,$contents);


            ////////Labour 1/////////

            for($i = 0;$i < count($tempArrayP1) ;$i++){

                $p1Val = $tempArrayP1[$i];


                $labour_Names = explode("*",$p1Val);

                    for($l = 0;$l < count($labour_Names) ;$l++){

                        $Labours = $labour_Names[$l];

                        $labour_Name_Explode_1 = explode("<P01>",$Labours);
                        $Labour_Name_1 = $labour_Name_Explode_1[1];

                        $labour_Name_Explode_2 = explode("</P01>",$Labour_Name_1);
                        $Labour_Name_2 = $labour_Name_Explode_2[0];

                        $LABOUR_1_ID=$LabourCount1+=1;

                        $conn->query("INSERT INTO tbl_job_labour VALUES(null, '$job_id', '$LABOUR_1_ID', 'N/A', '0', '$Labour_Name_2', null, null, null, '$currentDate')");
                        // $conn->query("INSERT INTO test_labour VALUES(null,'$job_id', '$LABOURID','$Labour_Name_2','N/A','$currentDate')");

                    }

            ////////Labour 1/////////
   

            }
            ////////Labour 2/////////


                    for($p2 = 0;$p2 < count($tempArrayP2) ;$p2++){

                        $p2Val = $tempArrayP2[$p2];


                        $labour_Names_2 = explode("*",$p2Val);

                            for($l2 = 0;$l2 < count($labour_Names_2) ;$l2++){

                                $Labours_2 = $labour_Names_2[$l2];

                                $labour_Name_Explode_2_1 = explode("<P02>",$Labours_2);
                                $Labour_Name_2_1 = $labour_Name_Explode_2_1[1];

                                $labour_Name_Explode_2_2 = explode("</P02>",$Labour_Name_2_1);
                                $Labour_Name_2_2 = $labour_Name_Explode_2_2[0];

                                $LABOUR_2_ID=$LabourCount2+=1;

                                $t_data = 't-data = '.count($labour_Names_2);



                                $conn->query("UPDATE tbl_job_labour SET labour_name_2='$Labour_Name_2_2' WHERE labour_id='$LABOUR_2_ID' AND job_id='$job_id' AND labour_datetime='$currentDate'");
                                // $conn->query("INSERT INTO test_labour VALUES(null,'$job_id', '$LABOURID','$Labour_Name_2','N/A','$currentDate')");

                            }


                        }
                   

                    ////////Labour 2/////////

                    ////////Labour 3/////////


                    for($p3 = 0;$p3 < count($tempArrayP3) ;$p3++){

                        $p3Val = $tempArrayP3[$p3];


                        $labour_Names_3 = explode("*",$p3Val);

                            for($l3 = 0;$l3 < count($labour_Names_3) ;$l3++){

                                $Labours_3 = $labour_Names_3[$l3];

                                $labour_Name_Explode_3_1 = explode("<P03>",$Labours_3);
                                $Labour_Name_3_1 = $labour_Name_Explode_3_1[1];

                                $labour_Name_Explode_3_2 = explode("</P03>",$Labour_Name_3_1);
                                $Labour_Name_3_2 = $labour_Name_Explode_3_2[0];

                                $LABOUR_3_ID=$LabourCount3+=1;

                                $conn->query("UPDATE tbl_job_labour SET labour_name_3='$Labour_Name_3_2' WHERE labour_id='$LABOUR_3_ID' AND job_id='$job_id' AND labour_datetime='$currentDate'");
                                // $conn->query("INSERT INTO test_labour VALUES(null,'$job_id', '$LABOURID','$Labour_Name_2','N/A','$currentDate')");

                            }
                        }
                    

                    ////////Labour 3/////////


                        ////////Labour 4/////////
                  

                    for($p4 = 0;$p4 < count($tempArrayP4) ;$p4++){

                        $p4Val = $tempArrayP4[$p4];


                        $labour_Names_4 = explode("*",$p4Val);

                            for($l4 = 0;$l4 < count($labour_Names_4) ;$l4++){

                                $Labours_4 = $labour_Names_4[$l4];

                                $labour_Name_Explode_4_1 = explode("<P04>",$Labours_4);
                                $Labour_Name_4_1 = $labour_Name_Explode_4_1[1];

                                $labour_Name_Explode_4_2 = explode("</P04>",$Labour_Name_4_1);
                                $Labour_Name_4_2 = $labour_Name_Explode_4_2[0];

                                $LABOUR_4_ID=$LabourCount4+=1;

                                $conn->query("UPDATE tbl_job_labour SET labour_name_4='$Labour_Name_4_2' WHERE labour_id='$LABOUR_4_ID' AND job_id='$job_id' AND labour_datetime='$currentDate'");
                                // $conn->query("INSERT INTO test_labour VALUES(null,'$job_id', '$LABOURID','$Labour_Name_2','N/A','$currentDate')");


                            }
                        }
                    

                    ////////Labour 4/////////





                    ///////FRU//////
                    

                    for($i1 = 0;$i1<count($tempArrayP10) ;$i1++){

                        $p10Val = $tempArrayP10[$i1];

                        $fru_points = explode("*",$p10Val);


                        for($f = 0;$f < count($fru_points) ;$f++){

                            $FRU = $fru_points[$f];

                            $FRU_Explode_1 = explode("<P10>",$FRU);
                            $FRU_1 = $FRU_Explode_1[1];

                            $FRU_Explode_2 = explode("</P10>",$FRU_1);
                            $FRU_2 = $FRU_Explode_2[0];

                            $FRUID=$FRUCount+=1;

                            $conn->query("UPDATE tbl_job_labour SET job_fru='$FRU_2' WHERE labour_id='$FRUID' AND job_id='$job_id' AND labour_datetime='$currentDate'");
                            // $conn->query("UPDATE test_labour SET fru='$FRU_2' WHERE labour_find_id='$FRUID' AND job_id='$job_id' AND test_labour_datetime='$currentDate'");
                            // $conn->query("INSERT INTO test_labour VALUES(null,'$job_id','$Labour_Name_2','$FRU_2','$currentDate')");

                            }

                    }

                

                    //////FRU//////////
















            $output['result'] = true;
            $output['data']=$Labour_Name_2.'|'.$FRU_2;
            $output['msg'] = 'Successfully labour added';
                 
        }else{
            $output['result'] = false;
            $output['msg'] = 'Error';
        }

    }

    mysqli_close($conn);
    echo json_encode($output);

?>