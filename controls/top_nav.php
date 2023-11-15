        <div id="page_top" class="section-body">
            <div class="container-fluid">
                <div class="page-header">
                    <div class="left">
                        <h1 class="page-title">Workshop Management</h1>
                    </div>
                    <div class="right">
                        <div class="notification d-flex">
                            <button type="button" onclick="location.href='all_jobs'" class="btn btn-facebook" style="border: 1px solid #000; margin-right: 5px;"><i class="fa fa-briefcase mr-2"></i>
                            <?php
                                  $sql = "SELECT COUNT(*) FROM tbl_job_details";
                                  $result = mysqli_query($conn, $sql);
                                  $all_jobs_top_bar = mysqli_fetch_assoc($result)['COUNT(*)'];
                                  //echo $count;
                                ?>
                            All Jobs - <b><?php echo $all_jobs_top_bar; ?></b>
                            </button>
                            <button type="button" onclick="location.href='pending_jobs'" class="btn btn-facebook" style="border: 1px solid #000; margin-right: 5px;"><i class="fa fa-coffee mr-2"></i>
                            <?php
                                  $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE stat='1'";
                                  $result = mysqli_query($conn, $sql);
                                  $opened_jobs_top_bar = mysqli_fetch_assoc($result)['COUNT(*)'];
                                  //echo $count;
                            ?>
                            Opened Jobs - <b><?php echo $opened_jobs_top_bar; ?></b>
                            </button>
                            <button type="button" onclick="location.href='all_jobs'" class="btn btn-facebook" style="border: 1px solid #000; margin-right: 5px;"><i class="fa fa-user-circle-o mr-2"></i>
                            <?php
                                  $sql = "SELECT COUNT(*) FROM tbl_job_details WHERE user_name = '$user_name' ";
                                  $result = mysqli_query($conn, $sql);
                                  $user_jobs_top_bar = mysqli_fetch_assoc($result)['COUNT(*)'];
                                  //echo $count;
                            ?>
                            <?php echo $user_name; ?> Jobs - <b><?php echo $user_jobs_top_bar; ?></b>
                            </button>
                            
                            <button type="button" class="btn btn-facebook" onclick="location.href='signout';"><i class="fa fa-power-off mr-2"></i>Sign Out</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>