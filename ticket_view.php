<?php
    require_once('db/database.php');
    $db=new DB();
    $conn=$db->connect();
    session_start();
    date_default_timezone_set('Asia/Colombo');

    $TicketId= base64_decode($_GET['t']);
    
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
    // $ClientProjectId=1;

	$Ticketsql = "SELECT * FROM tbl_ticket tbt INNER JOIN client_projects clp ON tbt.client_projects_id=clp.client_projects_id INNER JOIN project_details prd ON clp.project_id=prd.project_id INNER JOIN client_details cld ON clp.client_id=cld.client_id WHERE tbt.ticket_id ='$TicketId' ";
	$rs=$connTicket->query($Ticketsql);
	if($Trow =$rs->fetch_array())
	{
		// $TicketId = $Trow[0];
		$ClientProjectId = $Trow[1];
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
		////////////////////////
		// $ClientProjectId = $Trow[12];
		$RegisterpersonId = $Trow[13];
		$ClientID = $Trow[14];
		$ProjectId = $Trow[15];
		$PaymentType = $Trow[16];
		$PaymentMethod = $Trow[17];
		$SellingPrice = (double)$Trow[18];
		$Currency = $Trow[19];
		$Comment = $Trow[20];
		$ClientProjectStat = $Trow[21];
		$ClientProjectDateTime = $Trow[22];
		//////////////////////////
		$ProjectName = $Trow[24];
		//////////////////////////
		$CompanyName = $Trow[34];
	}
?>

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
                
                <!--<div class="row clearfix">
                    <div class="col-lg-12">
                        <div class="card" style="background-color: #FFF;">
                            <div class="card-header">
                                <h3 class="card-title">Tickets</h3>
                            </div>
                            <div class="card-body">
                                
                                <div class="table-responsive">
                              
                                </div>
                                
                            </div>                        
                        </div>
                    </div>
                </div>-->
                
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4><?php echo $TicketSubject; ?></h4>
                                <!--<p><?php //echo nl2br($TicketMessage); ?></p>-->
                            	<div class="row">
	                                <div class="col-md-4">
	                                    <!-- <div class="p-0">
	                                        <a href="email-compose.html" class="btn btn-primary btn-block">Compose</a>
	                                    </div> -->
	                                    <div class="mail-list mt-4">
	                                        <a href="#!" class="list-group-item active"><i
	                                                class="fa fa-inbox font-18 align-middle mr-2"></i> Ticket ID <span
	                                                class="badge badge-primary badge-sm float-right" style="color: #FFF; font-size: 16px;"><?php echo '#'.$TicketId; ?></span> </a>
	                                        <a href="#!" class="list-group-item"><i
	                                                class="fa fa-microchip font-18 align-middle mr-2"></i> Project Name <span
	                                                class="badge badge-secondary badge-sm float-right" style="color: #FFF; font-size: 12px;"><?php echo $ProjectName; ?></span> </a>
	                                        <a href="#!" class="list-group-item"><i
	                                                class="fa fa-address-card-o font-18 align-middle mr-2"></i> Department <span
	                                                class="badge badge-primary badge-sm float-right" style="color: #FFF; font-size: 14px;"><?php echo $TicketDepartment; ?></span> </a>
	                                        <a href="#!" class="list-group-item"><i
	                                                class="fa fa-calendar font-18 align-middle mr-2"></i> Ticket Open Date <span
	                                                class="badge badge-primary badge-sm float-right" style="color: #FFF; font-size: 14px;"><?php echo $TicketDate; ?></span> </a>
	                                        <a href="#!" class="list-group-item"><i
	                                                class="fa fa-exclamation-circle font-18 align-middle mr-2"></i> Priority <span
	                                                class="badge badge-danger badge-sm float-right" style="color: #FFF; font-size: 14px;"><?php echo $TicketPriority; ?></span> </a>
	                                        <a href="#!" class="list-group-item"><i
	                                                class="fa fa-server font-18 align-middle mr-2"></i> Releted Service <span
	                                                class="badge badge-primary badge-sm float-right" style="color: #FFF; font-size: 14px;"><?php echo $TicketRelatedService; ?></span> </a>
	                                        <a href="#!" class="list-group-item"><i
	                                                class="fa fa-user-circle-o font-18 align-middle mr-2"></i> Opened Person <span
	                                                class="badge badge-success badge-sm float-right" style="color: #FFF; font-size: 14px;"><?php echo $TicketName; ?></span> </a>
	                                    </div>


	                                </div>
	                                <div class="col-md-8">
	                                	<?php if ($TicketStat=='0') {?>
	                                		<div class="alert alert-danger alert-dismissible fade show">
												<svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="mr-2"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12.01" y2="17"></line></svg>
												<strong>Ticket Closed!</strong> This Ticket is Closed.
											</div>
	                                	<?php }else{ ?>
	                                	<br><br>
	                                	<button class="btn btn-info light btn-sm" id="btn_reply_view" style="width: 100%;" type="button"><span class="mr-2"><i class="fa fa-pencil" aria-hidden="true"></i></span>Reply</button>
	                                	<?php } ?>
	                                	<div id="ticket-reply" style="display: none; margin-top: 10px;">
		                                    <form method="POST" id="Reply-Ticket">
			                                    <div class="compose-content">
			                                        <div class="row">
			                                        	<input type="hidden" class="form-control" name="ticket_id" value="<?php echo $TicketId; ?>" readonly required>
			                                        	<div class="col-md-6">
			                                        		<div class="form-group">
					                                            <input type="text" class="form-control bg-transparent" value="<?php echo $user_name; ?>" placeholder=" Name:" name="name" required readonly>
					                                        </div>
			                                        	</div>
			                                        	<div class="col-md-6">
			                                        		<div class="form-group">
					                                            <input type="email" class="form-control bg-transparent" value="<?php echo $user_email; ?>" name="email" placeholder=" Email:">
					                                        </div>
			                                        	</div>
			                                        	<div class="col-md-12">
			                                        		<div class="form-group">
					                                            <textarea id="email-compose-editor" class="textarea_editor form-control bg-transparent" rows="5" name="reply" placeholder="Enter text ..."></textarea>
					                                        </div>
			                                        	</div>
			                                        </div>
			                                    </div>
			                                    <div class="text-left mt-4 mb-3">
			                                        <button class="btn btn-primary btn-sl-sm mr-2" type="submit" id="btn-reply"><span class="mr-2"><i class="fa fa-paper-plane"></i></span>Reply</button>
			                                    </div>
		                                    </form>
	                                	</div>

	                                	<div>
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
                                                // $ClientProjectId=1;

												$Ticketsql = "SELECT * FROM tbl_ticket_reply WHERE ticket_id='$TicketId' ORDER BY reply_id DESC ";
								                $rs=$connTicket->query($Ticketsql);
								                while($Rrow =$rs->fetch_array())
								                {
								                    $ReplyId = $Rrow[0];
								                    $ReplyName = $Rrow[2];
								                    $ReplyEmail = $Rrow[3];
								                    $ReplyNote = $Rrow[4];
								                    $ReplyPossition = $Rrow[5];
								                    $ReplyDateTime = $Rrow[6];
											?>
	                                		<div class="profile-uoloaded-post border-bottom-1 pb-5">
	                                			<hr>
	                                			<div style="border: 2px solid #F7F7F7; padding: 10px; background-color: #F7F7F7;">
													<h3 class="text-black" style="font-size: 15px; font-weight: 100;"><?php echo $ReplyName; ?><span style="float: right;"><?php echo $ReplyDateTime; ?></span></h3>
													<h3 class="text-black" style="font-size: 12px;"><?php echo $ReplyPossition; ?></h3>
                                                	<p><?php echo nl2br($ReplyNote); ?></p>
                                            	</div>
                                            </div>
                                        	<?php } ?>
                                        	<div class="profile-uoloaded-post border-bottom-1 pb-5">
	                                			<hr>
	                                			<div style="border: 2px solid #F7F7F7; padding: 10px; background-color: #F7F7F7;">
													<h3 class="text-black" style="font-size: 15px; font-weight: 100;"><?php echo $TicketName; ?><span style="float: right;"><?php echo $TicketDate; ?></span></h3>
													<h3 class="text-black" style="font-size: 12px;"><?php echo $TicketSubject; ?></h3>
                                                	<p><?php echo nl2br($TicketMessage); ?></p>
                                            	</div>
                                            </div>
	                                	</div>

	                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
	$(document).ready(function(){
		$("#btn_reply_view").click(function(){
			$("#ticket-reply").toggle(500);
		});
	});
</script>

    <script>

        $(document).on('submit', '#Reply-Ticket', function(e){
        e.preventDefault(); //stop default form submission

        $("#btn-reply").attr("disabled",true);

        var formData = new FormData($(this)[0]);

        $.ajax({
            
            
                beforeSend : function() {
                    $("#progress_alert").addClass('show'); 
                },

                url:"ticket_post/post_reply.php",
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
                        $("#btn-reply").attr("disabled",false);
                    }
                    
                }

            });

        return false;
        });
    </script>



</body>
</html>
