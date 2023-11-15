<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');
    
    $user_id='';
    $user_name='';
    $user_email='';
    $user_role='';


    if (isset($_SESSION['Logged']) && $_SESSION['Logged'] == true) 
    {

      $user_email = $_SESSION["email"];

      $getEmpQuery=$conn->query("SELECT user_id,name,email,role FROM users_login WHERE email='$user_email' ");
      while ($emp=$getEmpQuery->fetch_array()) {

        $user_id = $emp['0']; 
        $user_name = $emp['1']; 
        $user_email = $emp['2']; 
        $user_role = $emp['3']; 
        

      }
      
    }

    else
    {
        ?>

            <script type="text/javascript">
                window.location.href="login.php";
            </script>

        <?php
    }
?>
<?php if ($user_role=='0' || $user_role=='2' || $user_role=='3'){ ?>

<script type="text/javascript">
    window.location.href="404";
</script>

<?php }else{ ?>
<!doctype html>
<html lang="en">
<head>
<?php include_once('controls/meta.php'); ?>
<!-- Plugins css -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.1.0/css/buttons.dataTables.min.css">

</head>

<body class="font-opensans">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
    </div>
</div>

<!-- Start main html -->
<div id="main_content">

    <?php include_once('controls/side_nav.php'); ?>

    <!-- start main body part-->
    <div class="page">

        <!-- start body header -->
        <?php include_once('controls/top_nav.php'); ?>

        <div class="section-body">
            <div class="container-fluid">
                
                <div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Tickets</h3>
                            </div>
                            
                            <div class="card-body">
                                <button class="btn btn-primary light btn-sm float-right" data-toggle="modal" data-target="#exampleModalCenter"><i class="fa fa-external-link"></i> Open Ticket</button>
                                <br><br>
                                <div class="table-responsive">
                                    <table class="table table-hover table-vcenter table-striped" cellspacing="0" id="ticketTable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
						                        <th>Name</th>
						                        <th>Email</th>
						                        <th>Subject</th>
						                        <th>Department</th>
						                        <th>Related Service</th>
						                        <th>Priority</th>
						                        <th>Status</th>
						                        <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            
                                                $servername = "localhost";
                                                $username = "canadagateway";
                                                $password = "canadagateway";
                                                $dbname = "amazoft_ticketing";
                                                
                                                // Create connection
                                                $connTicket = new mysqli($servername, $username, $password, $dbname);
                                                // Check connection
                                                if ($connTicket->connect_error) {
                                                    die("Connection failed: " . $connTicket->connect_error);
                                                }
                                              $ClientProjectId=1;
                                              $sql = "SELECT * FROM tbl_ticket WHERE client_projects_id	='$ClientProjectId' ";
                                              $rs=$connTicket->query($sql);
                                              while($Trow =$rs->fetch_array())
                                              {
     
                                                $TicketId = $Trow[0];
								                $TicketName = $Trow[2];
								                $TicketEmail = $Trow[3];
								                $TicketSubject = $Trow[4];
								                $TicketImei = $Trow[5];
								                $TicketDepartment = $Trow[6];
								                $TicketRelatedService = $Trow[7];
								                $TicketPriority = $Trow[8];
								                $TicketMessage = $Trow[9];
								                $TicketStat = $Trow[10];
								                $TicketDate = $Trow[11];
                                            
                                            
                                            ?>


                                            <tr  class="gradeA" style="color: #000;" style="cursor: pointer !important;" onclick="location.href='ticket_view?t=<?php echo base64_encode($TicketId); ?>'">
						                        <td style="cursor: pointer;"><?php echo $TicketId; ?></td>
						                        <td style="cursor: pointer;"><?php echo $TicketName; ?></td>
						                        <td style="cursor: pointer;"><?php echo $TicketEmail; ?></td>
						                        <td style="cursor: pointer;"><?php echo $TicketSubject; ?></td>
						                        <td style="cursor: pointer;"><?php echo $TicketDepartment; ?></td>
						                        <td style="cursor: pointer;"><?php echo $TicketRelatedService; ?></td>
						                        <td style="cursor: pointer;"><?php echo $TicketPriority; ?></td>
						                        <td style="cursor: pointer;">
						                        	<?php if($TicketStat=='1'){?>
						                        		<span class="badge badge-success">Active</span>
						                        	<?php }else{ ?>
						                        		<span class="badge badge-danger">Closed</span>
						                        	<?php } ?>
						                        </td>
						                        <td style="cursor: pointer;"><?php echo $TicketDate; ?></td>
						                   </tr>

                                            <?php } ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Open Ticket</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                
                <form method="POST" id="Open-Ticket">
                    <input type="hidden" placeholder="Client Project Id" name="client_projects_id" value="1" class="form-control" required readonly>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Name</label>
                            <input type="text" placeholder="Name" name="name" value="<?php echo $user_name; ?>" class="form-control" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" placeholder="Email" name="email" value="<?php echo $user_email; ?>" class="form-control" required readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Subject <font style="color: #FF0000;">*</font></label>
                        <input type="text" placeholder="Subject" name="subject" class="form-control" required>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Department <font style="color: #FF0000;">*</font></label>
                            <select class="form-control default-select" name="department" id="department" required>
                              <option value="Support" selected>Support</option>
                              <option value="Technical">Technical</option>
                              <option value="Other">Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Related Service <font style="color: #FF0000;">*</font></label>
                            <select class="form-control default-select" name="related_service" id="related_service" required>
                              <option value="None">None</option>
                              <option value="Software" selected>Software</option>
                              <option value="Hardware">Hardware</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Priority <font style="color: #FF0000;">*</font></label>
                            <select class="form-control default-select" name="priority" id="priority" required>
                              <option value="High">High</option>
                              <option value="Medium" selected>Medium</option>
                              <option value="Law">Law</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Message <font style="color: #FF0000;">*</font></label>
                        <textarea class="form-control" name="message" rows="5" required></textarea>
                    </div>
                    <hr>
                    <button class="btn btn-primary pull-right" type="submit" id="btn-open-ticket">Open Ticket</button>
                </form>
                
                
              </div>
              <!--<div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
              </div>-->
            </div>
          </div>
        </div>
        

        <!-- Start page footer -->
        <?php include_once('controls/footer.php'); ?>
    </div>
</div>

        <!-------Event Start------------>
        <div class="alert alert-success solid alert-dismissible fade" role="alert" id="success_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-check"></i> <strong>Success!</strong> <span id="success_msg"></span>
        </div>
        <!--------Event End----------->
                            
        <!-------Waiting  Upload Event Start------------>
        <div class="alert alert-warning solid alert-dismissible fade" role="alert" id="progress_upload_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> <strong>Please Wait...</strong>
            <div class="progress" style="height:20px">
                <div class="progress-bar bg-success" style="width:0%;" id="upload-bar"><span id="upload-bar-label">0%</span></div>
            </div>
        </div>
        <!--------Waiting Upload  Event End----------->                   
                            
        <!-------Waiting Event Start------------>
        <div class="alert alert-warning solid alert-dismissible fade" role="alert" id="progress_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-circle-o-notch fa-spin fa-fw"></i><span class="sr-only">Loading...</span> <strong>Please Wait...</strong>
        </div>
        <!--------Waiting Event End----------->
                            
        <!-------Error Event Start------------>
        <div class="alert alert-danger solid alert-dismissible fade" role="alert" id="danger_alert" style="position:fixed;bottom:20px;right:20px">
          <i class="fa fa-times"></i> <strong>Error!</strong> <span>Something went wrong...</span>
        </div>
        <!--------Error Event End----------->

<!-- jQuery and bootstrtap js -->
<script src="assets/assets/bundles/lib.vendor.bundle.js"></script>

<!-- start plugin js file  -->
<!-- <script src="assets/assets/bundles/dataTables.bundle.js"></script> -->

<!-- Start core js and page js -->
<script src="assets/assets/js/core.js"></script>
<!-- <script src="assets/js/table/datatable.js"></script> -->
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

<script src="assets/js/themechanger.js"></script>

<script src="https://cdn.datatables.net/buttons/2.1.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.1.0/js/buttons.print.min.js"></script>


<script>
    $(document).ready( function () {
        $('#ticketTable').DataTable({
            "order": [[ 0, "desc" ]]
        });
    } );
</script>


<script>

        $(document).on('submit', '#Open-Ticket', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-open-ticket").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
 
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 
                },

                url:"ticket_post/post_ticket.php",
                type: 'POST',
                data: formData,
                //async: false,
                cache: false,
                contentType: false,
                processData: false,

                success: function (data) {
                    
                    $("#progress_alert").removeClass('show');
                    
                    var json=JSON.parse(data);
                    
                    if(json.result){
                        
                       $("#success_msg").html(json.msg);
                       $("#success_alert").addClass('show'); 
                       
                       setTimeout(function(){$("#success_alert").removeClass('show');  }, 1000);
                       location.reload();
                        
                    }else{
                        $("#danger_alert").addClass('show');
                        setTimeout(function(){ $("#danger_alert").removeClass('show'); }, 1000);
                        $("#btn-open-ticket").attr("disabled",false);
                    }
                    
                }

            });

        return false;
        });
    </script>

</body>
</html>
<?php } ?>