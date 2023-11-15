 <?php
 // session_start();
 $path = $_SERVER['PHP_SELF'];
 $page = basename($path);
 $page = basename($path, '.php');

 ?>     
    <!-- Small icon top menu -->
    <div id="header_top" class="header_top" id="sidenavone">
        <div class="container">
            <div class="hleft">
                <div class="dropdown">
                    <a href="javascript:void(0)" class="nav-link user_btn"><img class="avatar" src="assets/logo-ori.png" alt=""/></a>
                    <!-- <a href="page-search.html" class="nav-link icon"><i class="fa fa-search"></i></a> -->
                    <a href="index.php" class="nav-link icon"><i class="fa fa-home"></i></a>
                    <a href="all_clients.php"  class="nav-link icon app_inbox"><i class="fa fa-address-book"></i></a>
                    <a href="all_vehicles.php"  class="nav-link icon app_inbox"><i class="fa fa-car"></i></a>
                    <a href="register_form.php"  class="nav-link icon xs-hide"><i class="fa fa-briefcase"></i></a>
                    <?php if ($user_role == '0') { ?>
                        <a href="view_stock.php"  class="nav-link icon app_file xs-hide"><i class="fa fa-dropbox"></i></a>
                    <?php } else { ?>
                        <a href="add_stock.php"  class="nav-link icon app_file xs-hide"><i class="fa fa-dropbox"></i></a>
                    <?php } ?>
                </div>
            </div>
            <div class="hright">
                <div class="dropdown">
                    <?php if ($user_role == '0') {
                    } else { ?>
                        <a onclick="location.href='signout.php';" class="nav-link icon settingbar"><i class="fa fa-power-off"></i></a>
                    <?php } ?>
                    <a href="javascript:void(0)" class="nav-link icon menu_toggle"><i class="fa fa-navicon"></i></a>
                </div>            
            </div>
        </div>
    </div>

    <!-- start Main menu -->
    <div id="left-sidebar" class="sidebar">
        <div class="d-flex justify-content-between brand_name">
            <?php if ($user_role == '0') { ?>
                    <h5 class="brand-name"><a href="index.php" style="color:#000;"><i class="icon-home"></i> HOME</a></h5>
            <?php } else { ?>
                    <h5 class="brand-name"><a href="index.php" style="color:#000;">Management</a></h5>
                    <div class="theme_btn">
                        <a class="theme1" data-toggle="tooltip" title="Theme Radical" href="#" onclick="setStyleSheet('assets/assets/css/theme1.css', 0);"></a>
                        <a class="theme2" data-toggle="tooltip" title="Theme Turmeric" href="#" onclick="setStyleSheet('assets/assets/css/theme2.css', 0);"></a>
                        <a class="theme3" data-toggle="tooltip" title="Theme Caribbean" href="#" onclick="setStyleSheet('assets/assets/css/theme3.css', 0);"></a>
                        <a class="theme4" data-toggle="tooltip" title="Theme Cascade" href="#" onclick="setStyleSheet('assets/assets/css/theme4.css', 0);"></a>
                    </div>
            <?php } ?>
            
        </div>
        <!-- <div class="input-icon">
            <span class="input-icon-addon">
                <i class="fe fe-search"></i>
            </span>
            <input type="text" class="form-control" placeholder="Search...">
        </div> -->
        <?php if ($user_role == '0') {
        } else { ?>
            <ul class="nav nav-tabs b-none">
                <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#all-tab"><i class="fa fa-list-ul"></i> All</a></li>
                <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#app-tab">Elements</a></li> -->
                <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#setting-tab">Settings</a></li>
            </ul>
        <?php } ?>
        <div class="tab-content">
            <div class="tab-pane fade active show" id="all-tab">
                <!--Start Super Admin-->
                <?php if ($user_role == '1') { ?>
                    <nav class="sidebar-nav">
                        <ul class="metismenu ci-effect-1">
                            <li class="g_heading">Directories</li>
                            <li <?php if ($page == 'index')
                                echo 'class="active"'; ?>><a href="index.php"><i class="icon-home"></i><span data-hover="Dashboard">Dashboard</span></a></li>

                            <li <?php if ($page == 'create_new_job' || $page == 'pending_jobs' || $page == 'closed_jobs' || $page == 'all_jobs')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-briefcase"></i><span data-hover="Jobs">Jobs</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_new_job')
                                        echo 'class="active"'; ?>><a href="create_new_job.php"><span data-hover="NewJob">New Job</span></a></li>
                                    <li <?php if ($page == 'pending_jobs')
                                        echo 'class="active"'; ?>><a href="pending_jobs.php"><span data-hover="OpenedJobs">Opened Jobs</span></a></li>
                                    <li <?php if ($page == 'closed_jobs')
                                        echo 'class="active"'; ?>><a href="closed_jobs.php"><span data-hover="ClosedJobs">Closed Jobs</span></a></li>
                                    <li <?php if ($page == 'all_jobs')
                                        echo 'class="active"'; ?>><a href="all_jobs.php"><span data-hover="AllJobs">All Jobs</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'pending_inventorys' || $page == 'closed_inventorys' || $page == 'register_form')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-layers"></i><span data-hover="Inventorys">Inventorys</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_form')
                                        echo 'class="active"'; ?>><a href="register_form.php"><span data-hover="NewInventorys">New Inventorys</span></a></li>
                                    <li <?php if ($page == 'pending_inventorys')
                                        echo 'class="active"'; ?>><a href="pending_inventorys.php"><span data-hover="OpenedInventorys">Opened Inventorys</span></a></li>
                                    <li <?php if ($page == 'closed_inventorys')
                                        echo 'class="active"'; ?>><a href="closed_inventorys.php"><span data-hover="ClosedInventorys">Closed Inventorys</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'bookings')
                                echo 'class="active"'; ?>><a href="bookings.php"><i class="icon-pin"></i><span data-hover="Bookings">Bookings</span></a></li>
                            <li <?php if ($page == 'register_clients' || $page == 'all_clients')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-users"></i><span data-hover="Clients">Clients</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_clients')
                                        echo 'class="active"'; ?>><a href="register_clients.php"><span data-hover="RegisterClient">Register Client</span></a></li>
                                    <li <?php if ($page == 'all_clients')
                                        echo 'class="active"'; ?>><a href="all_clients.php"><span data-hover="AllClients">All Clients</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_supplier' || $page == 'all_supplier')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-basket-loaded"></i><span data-hover="Suppliers">Suppliers</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_supplier')
                                        echo 'class="active"'; ?>><a href="register_supplier.php"><span data-hover="RegisterSupplier">Register Supplier</span></a></li>
                                    <li <?php if ($page == 'all_supplier')
                                        echo 'class="active"'; ?>><a href="all_supplier.php"><span data-hover="AllSuppliers">All Suppliers</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_vehicles' || $page == 'all_vehicles')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fa fa-car"></i><span data-hover="Vehicle">Vehicle</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_vehicles')
                                        echo 'class="active"'; ?>><a href="register_vehicles.php"><span data-hover="RegisterVehicle">Register Vehicle</span></a></li>
                                    <li <?php if ($page == 'all_vehicles')
                                        echo 'class="active"'; ?>><a href="all_vehicles.php"><span data-hover="AllVehicles">All Vehicles</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'add_item' || $page == 'add_stock' || $page == 'stock_selling_history' || $page == 'create_grn' || $page == 'view_grn_list' || $page == 'part_allocations')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-social-dropbox"></i><span data-hover="Stock">Stock</span></a>
                                <ul>
                                    <li <?php if ($page == 'add_item')
                                        echo 'class="active"'; ?>><a href="add_item.php"><span data-hover="AddNewItem">Add New Item</span></a></li>

                                    <li <?php if ($page == 'add_stock')
                                        echo 'class="active"'; ?>><a href="add_stock.php"><span data-hover="ViewStock">View Stock</span></a></li>

                                    <li <?php if ($page == 'create_grn')
                                        echo 'class="active"'; ?>><a href="create_grn.php"><span data-hover="CreateGRN">Create GRN</span></a></li>

                                    <li <?php if ($page == 'view_grn_list')
                                        echo 'class="active"'; ?>><a href="view_grn_list.php"><span data-hover="ViewGRNList">View GRN List</span></a></li>

                                    <!-- <li <?php //if ($page == 'stock_history') echo 'class="active"';?>><a href="stock_history"><span data-hover="StockBuyingHistory">Stock Buying History</span></a></li> -->
                                    <li <?php if ($page == 'stock_selling_history')
                                        echo 'class="active"'; ?>><a href="stock_selling_history.php"><span data-hover="StockSellingHistory">Stock Selling History</span></a></li>

                                    <li <?php if ($page == 'part_allocations')
                                        echo 'class="active"'; ?>><a href="part_allocations.php"><span data-hover="PartAllocations">Part Allocations</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Invoices</li>
                            <li <?php if ($page == 'old_invoice' || $page == 'credit_invoice' || $page == 'create_advance' || $page == 'advance_payment_history' || $page == 'sublet_history' || $page == 'open_invoice' || $page == 'receipt_history')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Invoices">Invoices</span></a>
                                <ul>
                                    <li <?php if ($page == 'old_invoice')
                                        echo 'class="active"'; ?>><a href="old_invoice.php"><span data-hover="Invoices">Invoices</span></a></li>
                                    <li <?php if ($page == 'open_invoice')
                                        echo 'class="active"'; ?>><a href="open_invoice.php"><span data-hover="OpenInvoices">Open Invoices</span></a></li>
                                    <!--<li <?php //if ($page == 'unsaved_invoice') echo 'class="active"';?>><a href="unsaved_invoice"><span data-hover="UnsavedInvoice">Unsaved Invoice</span></a></li>-->
                                    <li <?php if ($page == 'credit_invoice')
                                        echo 'class="active"'; ?>><a href="credit_invoice.php"><span data-hover="CreditInvoice">Credit Invoice</span></a></li>
                                    <li <?php if ($page == 'create_advance')
                                        echo 'class="active"'; ?>><a href="create_advance.php"><span data-hover="AdvancePayment">Advance Payment</span></a></li>
                                    <li <?php if ($page == 'advance_payment_history')
                                        echo 'class="active"'; ?>><a href="advance_payment_history.php"><span data-hover="AdvancePaymentHistory">Advance Payment History</span></a></li>
                                    <li <?php if ($page == 'receipt_history')
                                        echo 'class="active"'; ?>><a href="receipt_history.php"><span data-hover="ReceiptHistory">Receipt History</span></a></li>
                                    <li <?php if ($page == 'sublet_history')
                                        echo 'class="active"'; ?>><a href="sublet_history.php"><span data-hover="SubletHistory">Sublet History</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_estimate' || $page == 'all_estimates')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Estimates">Estimates</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_estimate')
                                        echo 'class="active"'; ?>><a href="create_estimate.php"><span data-hover="NewEstimate">New Estimate</span></a></li>
                                    <li <?php if ($page == 'all_estimates')
                                        echo 'class="active"'; ?>><a href="all_estimates.php"><span data-hover="AllEstimates">All Estimates</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_part_selling_invoice' || $page == 'all_part_selling_invoice')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="PartSale">Part Sale</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="create_part_selling_invoice.php"><span data-hover="NewPartSelling">New Part Selling</span></a></li>
                                    <li <?php if ($page == 'all_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="all_part_selling_invoice.php"><span data-hover="AllPartSellingInvoices">All Part Selling Invoices</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Part Order</li>
                                <li <?php if ($page == 'part_order_list')
                                    echo 'class="active"'; ?>><a href="part_order_list.php"><i class="icon-book-open"></i><span data-hover="PartOrderList">Part Order List</span></a></li>
                                <li <?php if ($page == 'requested_part_order')
                                    echo 'class="active"'; ?>><a href="requested_part_order.php"><i class="icon-doc"></i><span data-hover="RequestedPartOrder">Requested Part Order</span></a></li>
                                <li <?php if ($page == 'part_order_history')
                                    echo 'class="active"'; ?>><a href="part_order_history.php"><i class="icon-bag"></i><span data-hover="PartOrderHistory">Part Order History</span></a></li>
                        

                            <li class="g_heading">Settings and Report</li>
                            <!-- <li>
                            <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-lock"></i><span data-hover="Authentication">Authentication</span></a>
                            <ul>
                                <li><a href="login.html"><span data-hover="Login">Login</span></a></li>
                                <li><a href="register.html"><span data-hover="Register">Register</span></a></li>
                                <li><a href="forgot-password.html"><span data-hover="Forgot">Forgot password</span></a></li>
                                <li><a href="404.html"><span data-hover="404">404 error</span></a></li>
                                <li><a href="500.html"><span data-hover="500">500 error</span></a></li>   
                            </ul>
                        </li> -->
                            <li <?php if ($page == 'anyltics' || $page == 'create_users' || $page == 'settings' || $page == 'add_labours' || $page == 'add_vehicle_model')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-settings"></i><span data-hover="Settings">Settings</span></a>
                                <ul>
                                    <li <?php if ($page == 'anyltics')
                                        echo 'class="active"'; ?>><a href="anyltics.php"><span data-hover="SalesReport">Sales Report</span></a></li>
                                    <li <?php if ($page == 'add_labours')
                                        echo 'class="active"'; ?>><a href="add_labours.php"><span data-hover="Labours">Labours</span></a></li>
                                    <li <?php if ($page == 'create_users')
                                        echo 'class="active"'; ?>><a href="create_users.php"><span data-hover="CreateUsers">Create Users</span></a></li>
                                    <li <?php if ($page == 'add_vehicle_model')
                                        echo 'class="active"'; ?>><a href="add_vehicle_model.php"><span data-hover="VehicleModels">Vehicle Models</span></a></li>
                                    <li <?php if ($page == 'settings')
                                        echo 'class="active"'; ?>><a href="settings.php"><span data-hover="Settings">Settings</span></a></li>                        
                                </ul>
                            </li>
                            <li <?php if ($page == 'tickets' || $page == 'service_invoice')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-bubble"></i><span data-hover="SystemService">System Service</span></a>
                                <ul>
                                    <li <?php if ($page == 'tickets')
                                        echo 'class="active"'; ?>><a href="tickets.php"><span data-hover="Tickets">Tickets</span></a></li>
                                    <li <?php if ($page == 'service_invoice')
                                        echo 'class="active"'; ?>><a href="service_invoice.php"><span data-hover="SystemInvoices">System Invoices</span></a></li>                       
                                </ul>
                            </li>
                            <li <?php if ($page == 'user_manual')
                                echo 'class="active"'; ?>><a href="user_manual.php"><i class="fe fe-help-circle"></i><span data-hover="UserManual">User Manual</span></a></li>
                            <!-- <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li> -->
                        </ul>
                    </nav>
                    <!--End Super Admin-->
                    <!--Start Service Advisor-->
            <?php } elseif ($user_role == '0') { ?>

                    <nav class="sidebar-nav">
                        <!--<ul class="metismenu ci-effect-1">-->
                        <ul class="metismenu">
                            <li class="g_heading">Directories</li>
                            <!--<li <?php //if ($page == 'index') echo 'class="active"';?>><a href="index.php"><i class="icon-home"></i><span data-hover="Dashboard">Dashboard</span></a></li>-->
                        
                            <li <?php if ($page == 'create_estimate' || $page == 'all_estimates')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Estimates">Estimates</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_estimate')
                                        echo 'class="active"'; ?>><a href="create_estimate.php"><span data-hover="NewEstimate">New Estimate</span></a></li>
                                    <li <?php if ($page == 'all_estimates')
                                        echo 'class="active"'; ?>><a href="all_estimates.php"><span data-hover="AllEstimates">All Estimates</span></a></li>
                                </ul>
                            </li>

                            <li <?php if ($page == 'create_new_job' || $page == 'pending_jobs' || $page == 'closed_jobs' || $page == 'all_jobs')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-briefcase"></i><span data-hover="Jobs">Jobs</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_new_job')
                                        echo 'class="active"'; ?>><a href="create_new_job.php"><span data-hover="NewJob">New Job</span></a></li>
                                    <li <?php if ($page == 'pending_jobs')
                                        echo 'class="active"'; ?>><a href="pending_jobs.php"><span data-hover="OpenedJobs">Opened Jobs</span></a></li>
                                    <li <?php if ($page == 'closed_jobs')
                                        echo 'class="active"'; ?>><a href="closed_jobs.php"><span data-hover="ClosedJobs">Closed Jobs</span></a></li>
                                    <li <?php if ($page == 'all_jobs')
                                        echo 'class="active"'; ?>><a href="all_jobs.php"><span data-hover="AllJobs">All Jobs</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'pending_inventorys' || $page == 'register_form')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-layers"></i><span data-hover="Inventorys">Inventorys</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_form')
                                        echo 'class="active"'; ?>><a href="register_form.php"><span data-hover="NewInventorys">New Inventorys</span></a></li>
                                    <li <?php if ($page == 'pending_inventorys')
                                        echo 'class="active"'; ?>><a href="pending_inventorys.php"><span data-hover="OpenedInventorys">Opened Inventorys</span></a></li>
                                    <li <?php if ($page == 'closed_inventorys')
                                        echo 'class="active"'; ?>><a href="closed_inventorys.php"><span data-hover="ClosedInventorys">Closed Inventorys</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'bookings')
                                echo 'class="active"'; ?>><a href="bookings.php"><i class="icon-home"></i><span data-hover="Bookings">Bookings</span></a></li>
                            <li <?php if ($page == 'register_clients' || $page == 'all_clients')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-pin"></i><span data-hover="Clients">Clients</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_clients')
                                        echo 'class="active"'; ?>><a href="register_clients.php"><span data-hover="RegisterClient">Register Client</span></a></li>
                                    <li <?php if ($page == 'all_clients')
                                        echo 'class="active"'; ?>><a href="all_clients.php"><span data-hover="AllClients">All Clients</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_vehicles' || $page == 'all_vehicles')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fa fa-car"></i><span data-hover="Vehicle">Vehicle</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_vehicles')
                                        echo 'class="active"'; ?>><a href="register_vehicles.php"><span data-hover="RegisterVehicle">Register Vehicle</span></a></li>
                                    <li <?php if ($page == 'all_vehicles')
                                        echo 'class="active"'; ?>><a href="all_vehicles.php"><span data-hover="AllVehicles">All Vehicles</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'view_stock')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-social-dropbox"></i><span data-hover="Stock">Stock</span></a>
                                <ul>
                                    <li <?php if ($page == 'view_stock')
                                        echo 'class="active"'; ?>><a href="view_stock"><span data-hover="ViewStock">View Stock</span></a></li>
                                </ul>
                            </li>
                        

                            <li class="g_heading">Invoices</li>
                            <li <?php if ($page == 'old_invoice' || $page == 'credit_invoice' || $page == 'create_advance' || $page == 'advance_payment_history' || $page == 'sublet_history' || $page == 'open_invoice' || $page == 'receipt_history')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Invoices">Invoices</span></a>
                                <ul>
                                    <li <?php if ($page == 'old_invoice')
                                        echo 'class="active"'; ?>><a href="old_invoice"><span data-hover="Invoices">Invoices</span></a></li>
                                    <li <?php if ($page == 'open_invoice')
                                        echo 'class="active"'; ?>><a href="open_invoice.php"><span data-hover="OpenInvoices">Open Invoices</span></a></li>
                                    <li <?php if ($page == 'credit_invoice')
                                        echo 'class="active"'; ?>><a href="credit_invoice.php"><span data-hover="CreditInvoice">Credit Invoice</span></a></li>
                                    <li <?php if ($page == 'create_advance')
                                        echo 'class="active"'; ?>><a href="create_advance.php"><span data-hover="AdvancePayment">Advance Payment</span></a></li>
                                    <li <?php if ($page == 'advance_payment_history')
                                        echo 'class="active"'; ?>><a href="advance_payment_history.php"><span data-hover="AdvancePaymentHistory">Advance Payment History</span></a></li>
                                    <li <?php if ($page == 'receipt_history')
                                        echo 'class="active"'; ?>><a href="receipt_history.php"><span data-hover="ReceiptHistory">Receipt History</span></a></li>
                                    <li <?php if ($page == 'sublet_history')
                                        echo 'class="active"'; ?>><a href="sublet_history.php"><span data-hover="SubletHistory">Sublet History</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_part_selling_invoice' || $page == 'all_part_selling_invoice')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="PartSale">Part Sale</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="create_part_selling_invoice.php"><span data-hover="NewPartSelling">New Part Selling</span></a></li>
                                    <li <?php if ($page == 'all_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="all_part_selling_invoice.php"><span data-hover="AllPartSellingInvoices">All Part Selling Invoices</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Part Order</li>
                                <li <?php if ($page == 'part_order_list')
                                    echo 'class="active"'; ?>><a href="part_order_list.php"><i class="icon-book-open"></i><span data-hover="PartOrderList">Part Order List</span></a></li>
                                <li <?php if ($page == 'requested_part_order')
                                    echo 'class="active"'; ?>><a href="requested_part_order.php"><i class="icon-doc"></i><span data-hover="RequestedPartOrder">Requested Part Order</span></a></li>
                                <li <?php if ($page == 'part_order_history')
                                    echo 'class="active"'; ?>><a href="part_order_history.php"><i class="icon-bag"></i><span data-hover="PartOrderHistory">Part Order History</span></a></li>
                        
                        
                            <li class="g_heading">Settings and Report</li>
                            <li <?php if ($page == 'settings' || $page == 'anyltics')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-settings"></i><span data-hover="Settings">Settings</span></a>
                                <ul>
                                    <li <?php if ($page == 'anyltics')
                                        echo 'class="active"'; ?>><a href="anyltics.php"><span data-hover="SalesReport">Sales Report</span></a></li>
                                    <li <?php if ($page == 'add_vehicle_model')
                                        echo 'class="active"'; ?>><a href="add_vehicle_model.php"><span data-hover="VehicleModels">Vehicle Models</span></a></li>
                                    <li <?php if ($page == 'settings')
                                        echo 'class="active"'; ?>><a href="settings.php"><span data-hover="Settings">Settings</span></a></li>                        
                                </ul>
                            </li>
                            <li <?php if ($page == 'user_manual')
                                echo 'class="active"'; ?>><a href="user_manual.php"><i class="fe fe-help-circle"></i><span data-hover="UserManual">User Manual</span></a></li>
                            <!-- <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li> -->
                        </ul>
                    </nav>
                    <!--End Service Advisor-->
                    <!--Start Stores-->
                <?php } elseif ($user_role == '2') { ?>
                    <nav class="sidebar-nav">
                        <ul class="metismenu ci-effect-1">
                            <li class="g_heading">Directories</li>
                            <li <?php if ($page == 'index')
                                echo 'class="active"'; ?>><a href="index.php"><i class="icon-home"></i><span data-hover="Dashboard">Dashboard</span></a></li>

                            <li <?php if ($page == 'pending_jobs' || $page == 'closed_jobs')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-briefcase"></i><span data-hover="Jobs">Jobs</span></a>
                                <ul>
                                    <li <?php if ($page == 'pending_jobs')
                                        echo 'class="active"'; ?>><a href="pending_jobs"><span data-hover="OpenedJobs">Opened Jobs</span></a></li>
                                    <li <?php if ($page == 'closed_jobs')
                                        echo 'class="active"'; ?>><a href="closed_jobs"><span data-hover="ClosedJobs">Closed Jobs</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_supplier' || $page == 'all_supplier')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-basket-loaded"></i><span data-hover="Suppliers">Suppliers</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_supplier')
                                        echo 'class="active"'; ?>><a href="register_supplier.php"><span data-hover="RegisterSupplier">Register Supplier</span></a></li>
                                    <li <?php if ($page == 'all_supplier')
                                        echo 'class="active"'; ?>><a href="all_supplier.php"><span data-hover="AllSuppliers">All Suppliers</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'add_item' || $page == 'add_stock' || $page == 'create_grn' || $page == 'view_grn_list' || $page == 'stock_selling_history' || $page == 'part_allocations')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-social-dropbox"></i><span data-hover="Stock">Stock</span></a>
                                <ul>
                                    <li <?php if ($page == 'add_item')
                                        echo 'class="active"'; ?>><a href="add_item.php"><span data-hover="AddNewItem">Add New Item</span></a></li>
                                    <li <?php if ($page == 'add_stock')
                                        echo 'class="active"'; ?>><a href="add_stock.php"><span data-hover="ViewStock">View Stock</span></a></li>

                                    <li <?php if ($page == 'create_grn')
                                        echo 'class="active"'; ?>><a href="create_grn.php"><span data-hover="CreateGRN">Create GRN</span></a></li>
                                    <li <?php if ($page == 'view_grn_list')
                                        echo 'class="active"'; ?>><a href="view_grn_list.php"><span data-hover="ViewGRNList">View GRN List</span></a></li>

                                    <!--<li <?php //if ($page == 'stock_history') echo 'class="active"';?>><a href="stock_history"><span data-hover="StockBuyingHistory">Stock Buying History</span></a></li>-->
                                    <li <?php if ($page == 'stock_selling_history')
                                        echo 'class="active"'; ?>><a href="stock_selling_history.php"><span data-hover="StockSellingHistory">Stock Selling History</span></a></li>

                                    <li <?php if ($page == 'part_allocations')
                                        echo 'class="active"'; ?>><a href="part_allocations.php"><span data-hover="PartAllocations">Part Allocations</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Invoices</li>
                            <li <?php if ($page == 'old_invoice' || $page == 'sublet_history')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Invoices">Invoices</span></a>
                                <ul>
                                    <li <?php if ($page == 'old_invoice')
                                        echo 'class="active"'; ?>><a href="old_invoice"><span data-hover="Invoices">Invoices</span></a></li>
                                    <li <?php if ($page == 'sublet_history')
                                        echo 'class="active"'; ?>><a href="sublet_history.php"><span data-hover="SubletHistory">Sublet History</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_part_selling_invoice' || $page == 'all_part_selling_invoice')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="PartSale">Part Sale</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="create_part_selling_invoice.php"><span data-hover="NewPartSelling">New Part Selling</span></a></li>
                                    <li <?php if ($page == 'all_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="all_part_selling_invoice.php"><span data-hover="AllPartSellingInvoices">All Part Selling Invoices</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_estimate' || $page == 'all_estimates')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Estimates">Estimates</span></a>
                                <ul>
                                    <li <?php if ($page == 'all_estimates')
                                        echo 'class="active"'; ?>><a href="all_estimates"><span data-hover="AllEstimates">All Estimates</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Part Order</li>
                                <li <?php if ($page == 'part_order_list')
                                    echo 'class="active"'; ?>><a href="part_order_list.php"><i class="icon-book-open"></i><span data-hover="PartOrderList">Part Order List</span></a></li>
                                <li <?php if ($page == 'requested_part_order')
                                    echo 'class="active"'; ?>><a href="requested_part_order.php"><i class="icon-doc"></i><span data-hover="RequestedPartOrder">Requested Part Order</span></a></li>
                                <li <?php if ($page == 'part_order_history')
                                    echo 'class="active"'; ?>><a href="part_order_history.php"><i class="icon-bag"></i><span data-hover="PartOrderHistory">Part Order History</span></a></li>
                        
                            <li class="g_heading">Settings and Report</li>
                            <li <?php if ($page == 'settings')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-settings"></i><span data-hover="Settings">Settings</span></a>
                                <ul>
                                    <li <?php if ($page == 'settings')
                                        echo 'class="active"'; ?>><a href="settings.php"><span data-hover="Settings">Settings</span></a></li>                        
                                </ul>
                            </li>
                            <li <?php if ($page == 'user_manual')
                                echo 'class="active"'; ?>><a href="user_manual.php"><i class="fe fe-help-circle"></i><span data-hover="UserManual">User Manual</span></a></li>
                            <!-- <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li> -->
                        </ul>
                    </nav>
                    <!--End Stores-->
                    <!--Start Accounts-->
                <?php } elseif ($user_role == '3') { ?>
                    <nav class="sidebar-nav">
                        <ul class="metismenu ci-effect-1">
                            <li class="g_heading">Directories</li>
                            <li <?php if ($page == 'index')
                                echo 'class="active"'; ?>><a href="index.php"><i class="icon-home"></i><span data-hover="Dashboard">Dashboard</span></a></li>
                            <li <?php if ($page == 'bookings')
                                echo 'class="active"'; ?>><a href="bookings.php"><i class="icon-pin"></i><span data-hover="Bookings">Bookings</span></a></li>
                            <li <?php if ($page == 'register_clients' || $page == 'all_clients')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-users"></i><span data-hover="Clients">Clients</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_clients')
                                        echo 'class="active"'; ?>><a href="register_clients.php"><span data-hover="RegisterClient">Register Client</span></a></li>
                                    <li <?php if ($page == 'all_clients')
                                        echo 'class="active"'; ?>><a href="all_clients.php"><span data-hover="AllClients">All Clients</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_vehicles' || $page == 'all_vehicles')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fa fa-car"></i><span data-hover="Vehicle">Vehicle</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_vehicles')
                                        echo 'class="active"'; ?>><a href="register_vehicles.php"><span data-hover="RegisterVehicle">Register Vehicle</span></a></li>
                                    <li <?php if ($page == 'all_vehicles')
                                        echo 'class="active"'; ?>><a href="all_vehicles.php"><span data-hover="AllVehicles">All Vehicles</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Invoices</li>
                            <li <?php if ($page == 'old_invoice' || $page == 'credit_invoice' || $page == 'create_advance' || $page == 'advance_payment_history' || $page == 'receipt_history' || $page == 'sublet_history')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Invoices">Invoices</span></a>
                                <ul>
                                    <li <?php if ($page == 'old_invoice')
                                        echo 'class="active"'; ?>><a href="old_invoice"><span data-hover="Invoices">Invoices</span></a></li>
                                    <li <?php if ($page == 'credit_invoice')
                                        echo 'class="active"'; ?>><a href="credit_invoice.php"><span data-hover="CreditInvoice">Credit Invoice</span></a></li>
                                    <li <?php if ($page == 'create_advance')
                                        echo 'class="active"'; ?>><a href="create_advance.php"><span data-hover="AdvancePayment">Advance Payment</span></a></li>
                                    <li <?php if ($page == 'advance_payment_history')
                                        echo 'class="active"'; ?>><a href="advance_payment_history.php"><span data-hover="AdvancePaymentHistory">Advance Payment History</span></a></li>
                                    <li <?php if ($page == 'receipt_history')
                                        echo 'class="active"'; ?>><a href="receipt_history.php"><span data-hover="ReceiptHistory">Receipt History</span></a></li>
                                    <li <?php if ($page == 'sublet_history')
                                        echo 'class="active"'; ?>><a href="sublet_history.php"><span data-hover="SubletHistory">Sublet History</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_estimate' || $page == 'all_estimates')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Estimates">Estimates</span></a>
                                <ul>
                                    <li <?php if ($page == 'all_estimates')
                                        echo 'class="active"'; ?>><a href="all_estimates"><span data-hover="AllEstimates">All Estimates</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'all_part_selling_invoice')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="PartSale">Part Sale</span></a>
                                <ul>
                                    <li <?php if ($page == 'all_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="all_part_selling_invoice.php"><span data-hover="AllPartSellingInvoices">All Part Selling Invoices</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Part Order</li>
                                <li <?php if ($page == 'requested_part_order')
                                    echo 'class="active"'; ?>><a href="requested_part_order.php"><i class="icon-doc"></i><span data-hover="RequestedPartOrder">Requested Part Order</span></a></li>
                                <li <?php if ($page == 'part_order_history')
                                    echo 'class="active"'; ?>><a href="part_order_history.php"><i class="icon-bag"></i><span data-hover="PartOrderHistory">Part Order History</span></a></li>
                        
                            <li class="g_heading">Settings and Report</li>
                            <li <?php if ($page == 'settings')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-settings"></i><span data-hover="Settings">Settings</span></a>
                                <ul>
                                    <li <?php if ($page == 'anyltics')
                                        echo 'class="active"'; ?>><a href="anyltics.php"><span data-hover="SalesReport">Sales Report</span></a></li>
                                    <li <?php if ($page == 'settings')
                                        echo 'class="active"'; ?>><a href="settings.php"><span data-hover="Settings">Settings</span></a></li>                        
                                </ul>
                            </li>
                            <li <?php if ($page == 'user_manual')
                                echo 'class="active"'; ?>><a href="user_manual.php"><i class="fe fe-help-circle"></i><span data-hover="UserManual">User Manual</span></a></li>
                            <!-- <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li> -->
                        </ul>
                    </nav>
                    <!--End Accounts-->
                
                    <!--Start Finance-->
                <?php } elseif ($user_role == '4') { ?>
                    <nav class="sidebar-nav">
                        <ul class="metismenu ci-effect-1">
                            <li class="g_heading">Directories</li>
                            <li <?php if ($page == 'index')
                                echo 'class="active"'; ?>><a href="index.php"><i class="icon-home"></i><span data-hover="Dashboard">Dashboard</span></a></li>

                            <li <?php if ($page == 'create_new_job' || $page == 'pending_jobs' || $page == 'closed_jobs' || $page == 'all_jobs')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-briefcase"></i><span data-hover="Jobs">Jobs</span></a>
                                <ul>
                                    <li <?php if ($page == 'pending_jobs')
                                        echo 'class="active"'; ?>><a href="pending_jobs"><span data-hover="OpenedJobs">Opened Jobs</span></a></li>
                                    <li <?php if ($page == 'closed_jobs')
                                        echo 'class="active"'; ?>><a href="closed_jobs"><span data-hover="ClosedJobs">Closed Jobs</span></a></li>
                                    <li <?php if ($page == 'all_jobs')
                                        echo 'class="active"'; ?>><a href="all_jobs"><span data-hover="AllJobs">All Jobs</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'pending_inventorys' || $page == 'closed_inventorys' || $page == 'register_form')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-layers"></i><span data-hover="Inventorys">Inventorys</span></a>
                                <ul>
                                    <li <?php if ($page == 'pending_inventorys')
                                        echo 'class="active"'; ?>><a href="pending_inventorys.php"><span data-hover="OpenedInventorys">Opened Inventorys</span></a></li>
                                    <li <?php if ($page == 'closed_inventorys')
                                        echo 'class="active"'; ?>><a href="closed_inventorys.php"><span data-hover="ClosedInventorys">Closed Inventorys</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'bookings')
                                echo 'class="active"'; ?>><a href="bookings.php"><i class="icon-pin"></i><span data-hover="Bookings">Bookings</span></a></li>
                            <li <?php if ($page == 'register_clients' || $page == 'all_clients')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-users"></i><span data-hover="Clients">Clients</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_clients')
                                        echo 'class="active"'; ?>><a href="register_clients.php"><span data-hover="RegisterClient">Register Client</span></a></li>
                                    <li <?php if ($page == 'all_clients')
                                        echo 'class="active"'; ?>><a href="all_clients.php"><span data-hover="AllClients">All Clients</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_supplier' || $page == 'all_supplier')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-basket-loaded"></i><span data-hover="Suppliers">Suppliers</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_supplier')
                                        echo 'class="active"'; ?>><a href="register_supplier.php"><span data-hover="RegisterSupplier">Register Supplier</span></a></li>
                                    <li <?php if ($page == 'all_supplier')
                                        echo 'class="active"'; ?>><a href="all_supplier.php"><span data-hover="AllSuppliers">All Suppliers</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'register_vehicles' || $page == 'all_vehicles')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="fa fa-car"></i><span data-hover="Vehicle">Vehicle</span></a>
                                <ul>
                                    <li <?php if ($page == 'register_vehicles')
                                        echo 'class="active"'; ?>><a href="register_vehicles.php"><span data-hover="RegisterVehicle">Register Vehicle</span></a></li>
                                    <li <?php if ($page == 'all_vehicles')
                                        echo 'class="active"'; ?>><a href="all_vehicles.php"><span data-hover="AllVehicles">All Vehicles</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'add_item' || $page == 'add_stock' || $page == 'stock_selling_history' || $page == 'create_grn' || $page == 'view_grn_list' || $page == 'part_allocations')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-social-dropbox"></i><span data-hover="Stock">Stock</span></a>
                                <ul>
                                    <li <?php if ($page == 'add_item')
                                        echo 'class="active"'; ?>><a href="add_item.php"><span data-hover="AddNewItem">Add New Item</span></a></li>

                                    <li <?php if ($page == 'add_stock')
                                        echo 'class="active"'; ?>><a href="add_stock.php"><span data-hover="ViewStock">View Stock</span></a></li>

                                    <li <?php if ($page == 'create_grn')
                                        echo 'class="active"'; ?>><a href="create_grn.php"><span data-hover="CreateGRN">Create GRN</span></a></li>

                                    <li <?php if ($page == 'view_grn_list')
                                        echo 'class="active"'; ?>><a href="view_grn_list.php"><span data-hover="ViewGRNList">View GRN List</span></a></li>

                                    <!-- <li <?php //if ($page == 'stock_history') echo 'class="active"';?>><a href="stock_history"><span data-hover="StockBuyingHistory">Stock Buying History</span></a></li> -->
                                    <li <?php if ($page == 'stock_selling_history')
                                        echo 'class="active"'; ?>><a href="stock_selling_history.php"><span data-hover="StockSellingHistory">Stock Selling History</span></a></li>

                                    <li <?php if ($page == 'part_allocations')
                                        echo 'class="active"'; ?>><a href="part_allocations.php"><span data-hover="PartAllocations">Part Allocations</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Invoices</li>
                            <li <?php if ($page == 'old_invoice' || $page == 'credit_invoice' || $page == 'create_advance' || $page == 'advance_payment_history' || $page == 'sublet_history' || $page == 'open_invoice' || $page == 'receipt_history')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Invoices">Invoices</span></a>
                                <ul>
                                    <li <?php if ($page == 'old_invoice')
                                        echo 'class="active"'; ?>><a href="old_invoice.php"><span data-hover="Invoices">Invoices</span></a></li>
                                    <li <?php if ($page == 'open_invoice')
                                        echo 'class="active"'; ?>><a href="open_invoice.php"><span data-hover="OpenInvoices">Open Invoices</span></a></li>
                                    <!--<li <?php //if ($page == 'unsaved_invoice') echo 'class="active"';?>><a href="unsaved_invoice.php"><span data-hover="UnsavedInvoice">Unsaved Invoice</span></a></li>-->
                                    <li <?php if ($page == 'credit_invoice')
                                        echo 'class="active"'; ?>><a href="credit_invoice.php"><span data-hover="CreditInvoice">Credit Invoice</span></a></li>
                                    <li <?php if ($page == 'create_advance')
                                        echo 'class="active"'; ?>><a href="create_advance.php"><span data-hover="AdvancePayment">Advance Payment</span></a></li>
                                    <li <?php if ($page == 'advance_payment_history')
                                        echo 'class="active"'; ?>><a href="advance_payment_history.php"><span data-hover="AdvancePaymentHistory">Advance Payment History</span></a></li>
                                    <li <?php if ($page == 'receipt_history')
                                        echo 'class="active"'; ?>><a href="receipt_history.php"><span data-hover="ReceiptHistory">Receipt History</span></a></li>
                                    <li <?php if ($page == 'sublet_history')
                                        echo 'class="active"'; ?>><a href="sublet_history.php"><span data-hover="SubletHistory">Sublet History</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_estimate' || $page == 'all_estimates')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="Estimates">Estimates</span></a>
                                <ul>
                                    <li <?php if ($page == 'all_estimates')
                                        echo 'class="active"'; ?>><a href="all_estimates.php"><span data-hover="AllEstimates">All Estimates</span></a></li>
                                </ul>
                            </li>
                            <li <?php if ($page == 'create_part_selling_invoice' || $page == 'all_part_selling_invoice')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-film"></i><span data-hover="PartSale">Part Sale</span></a>
                                <ul>
                                    <li <?php if ($page == 'create_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="create_part_selling_invoice.php"><span data-hover="NewPartSelling">New Part Selling</span></a></li>
                                    <li <?php if ($page == 'all_part_selling_invoice')
                                        echo 'class="active"'; ?>><a href="all_part_selling_invoice.php"><span data-hover="AllPartSellingInvoices">All Part Selling Invoices</span></a></li>
                                </ul>
                            </li>

                            <li class="g_heading">Part Order</li>
                                <li <?php if ($page == 'part_order_list')
                                    echo 'class="active"'; ?>><a href="part_order_list.php"><i class="icon-book-open"></i><span data-hover="PartOrderList">Part Order List</span></a></li>
                                <li <?php if ($page == 'requested_part_order')
                                    echo 'class="active"'; ?>><a href="requested_part_order.php"><i class="icon-doc"></i><span data-hover="RequestedPartOrder">Requested Part Order</span></a></li>
                                <li <?php if ($page == 'part_order_history')
                                    echo 'class="active"'; ?>><a href="part_order_history.php"><i class="icon-bag"></i><span data-hover="PartOrderHistory">Part Order History</span></a></li>
                        

                            <li class="g_heading">Settings and Report</li>
                            <li <?php if ($page == 'anyltics' || $page == 'create_users' || $page == 'settings' || $page == 'add_labours' || $page == 'add_vehicle_model')
                                echo 'class="active"'; ?>>
                                <a href="javascript:void(0)" class="has-arrow arrow-b"><i class="icon-settings"></i><span data-hover="Settings">Settings</span></a>
                                <ul>
                                    <li <?php if ($page == 'anyltics')
                                        echo 'class="active"'; ?>><a href="anyltics.php"><span data-hover="SalesReport">Sales Report</span></a></li>
                                    <li <?php if ($page == 'add_labours')
                                        echo 'class="active"'; ?>><a href="add_labours.php"><span data-hover="Labours">Labours</span></a></li>
                                    <li <?php if ($page == 'add_vehicle_model')
                                        echo 'class="active"'; ?>><a href="add_vehicle_model.php"><span data-hover="VehicleModels">Vehicle Models</span></a></li>
                                    <li <?php if ($page == 'settings')
                                        echo 'class="active"'; ?>><a href="settings.php"><span data-hover="Settings">Settings</span></a></li>                        
                                </ul>
                            </li>
                            <li <?php if ($page == 'user_manual')
                                echo 'class="active"'; ?>><a href="user_manual.php"><i class="fe fe-help-circle"></i><span data-hover="UserManual">User Manual</span></a></li>
                            <!-- <li><a href="page-maps.html"><i class="icon-map"></i><span data-hover="Maps">Maps</span></a></li> -->
                        </ul>
                    </nav>
                    <!--End Finance-->
                
            <?php } else {
                } ?>



            </div>
            <div class="tab-pane fade" id="app-tab">
                <nav class="sidebar-nav">
                    <ul class="metismenu">
                        <li class="g_heading">Components</li>
                        <li><a href="components/typography.html"><i class="fe fe-type"></i><span>Typography</span></a></li>
                        <li><a href="components/colors.html"><i class="fe fe-feather"></i><span>Colors</span></a></li>
                        <li><a href="components/alerts.html"><i class="fe fe-alert-triangle"></i><span>Alerts</span></a></li>
                        <li><a href="components/avatars.html"><i class="fe fe-user"></i><span>Avatars</span></a></li>
                        <li><a href="components/buttons.html"><i class="fe fe-toggle-right"></i><span>Buttons</span></a></li>
                        <li><a href="components/breadcrumb.html"><i class="fe fe-link-2"></i><span>Breadcrumb</span></a></li>
                        <li><a href="components/forms.html"><i class="fe fe-layers"></i><span>Input group</span></a></li>
                        <li><a href="components/list-group.html"><i class="fe fe-list"></i><span>List group</span></a></li>
                        <li><a href="components/modal.html"><i class="fe fe-square"></i><span>Modal</span></a></li>
                        <li><a href="components/pagination.html"><i class="fe fe-file-text"></i><span>Pagination</span></a></li>
                        <li><a href="components/cards.html"><i class="fe fe-image"></i><span>Cards</span></a></li>
                        <li><a href="components/charts.html"><i class="fe fe-pie-chart"></i><span>Charts</span></a></li>
                        <li><a href="components/form-components.html"><i class="fe fe-check-square"></i><span>Form</span></a></li>
                        <li><a href="components/tags.html"><i class="fe fe-tag"></i><span>Tags</span></a></li>                        
                        <li><a href="javascript:void(0)"><i class="fe fe-help-circle"></i><span>Documentation</span></a></li>
                        <li><a href="javascript:void(0)"><i class="fe fe-life-buoy"></i><span>Changelog</span></a></li>
                    </ul>
                </nav>
            </div>
            <div class="tab-pane fade" id="setting-tab">
                <div class="mb-4 mt-3">
                    <h6 class="font-14 font-weight-bold text-muted">Font Style</h6>
                    <div class="custom-controls-stacked font_setting">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-opensans" checked="">
                            <span class="custom-control-label">Open Sans Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-montserrat">
                            <span class="custom-control-label">Montserrat Google Font</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="font" value="font-poppins">
                            <span class="custom-control-label">Poppins Google Font</span>
                        </label>
                    </div>
                </div>
                <!-- <div class="mb-4">
                    <h6 class="font-14 font-weight-bold text-muted">Dropdown Menu Icon</h6>
                    <div class="custom-controls-stacked arrow_option">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="marrow" value="arrow-a" checked="">
                            <span class="custom-control-label">A</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="marrow" value="arrow-b">
                            <span class="custom-control-label">B</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="marrow" value="arrow-c">
                            <span class="custom-control-label">C</span>
                        </label>
                    </div>
                    <h6 class="font-14 font-weight-bold mt-4 text-muted">SubMenu List Icon</h6>
                    <div class="custom-controls-stacked list_option">
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="listicon" value="list-a" checked="">
                            <span class="custom-control-label">A</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="listicon" value="list-b">
                            <span class="custom-control-label">B</span>
                        </label>
                        <label class="custom-control custom-radio custom-control-inline">
                            <input type="radio" class="custom-control-input" name="listicon" value="list-c">
                            <span class="custom-control-label">C</span>
                        </label>
                    </div>
                </div> -->
                <div>
                    <h6 class="font-14 font-weight-bold mt-4 text-muted">General Settings</h6>
                    <ul class="setting-list list-unstyled mt-1 setting_switch">
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Night Mode</span>
                                <!-- <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-darkmode"> -->


                                  <?php

                                  if (isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] == 'yes_') {

                                      ?>
                                         <input type="checkbox" checked name="custom-switch-checkbox" onchange="changeTheme()" class="custom-switch-input">
                                      <?php

                                  } else {


                                      ?>
                                         <input type="checkbox" name="custom-switch-checkbox" onchange="changeTheme()" class="custom-switch-input">
                                      <?php

                                  }


                                  ?>

                                
                               
                                



                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Fix Navbar top</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-fixnavbar">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Header Dark</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-pageheader">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Min Sidebar Dark</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-min_sidebar">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Sidebar Dark</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-sidebar">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Icon Color</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-iconcolor">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Gradient Color</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-gradient">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Box Shadow</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxshadow">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">RTL Support</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-rtl">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                        <li>
                            <label class="custom-switch">
                                <span class="custom-switch-description">Box Layout</span>
                                <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input btn-boxlayout">
                                <span class="custom-switch-indicator"></span>
                            </label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>


<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


    <script>

        function changeTheme(){

            $.ajax({

                url:'controls/change_theme.php',
                type:'POST',
                data:{
                    change:'ok'
                },
                success:function(data){
                   var json = JSON.parse(data);
                   if(json.result){
                    location.reload();
                   }else{
                    console.log("err changing theme.");
                   }
                },
                error:function(err){
                    console.log(err);
                }



            });

        }


        $(document).ready(function(){

          

            <?php

            if (isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] == 'yes_') {

                ?>
                            $('body').addClass('dark-mode');
                        <?php

            } else {

                ?>

                        $('body').removeClass('dark-mode')

                        <?php

            }


            ?>

          

        });
        

       

    </script>