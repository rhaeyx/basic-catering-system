<?php
    session_start();
    if (!empty($_SERVER['HTTPS']) && ('on' == $_SERVER['HTTPS'])) {
        $uri = 'https://';
    } else {
        $uri = 'http://';
    }
    $uri .= $_SERVER['HTTP_HOST'];

    
    if (!$_SESSION["authorized"]) {
        header("Location: ".$uri."/xander/admin/login");
    } else { 
        $link = mysqli_connect("localhost", "onejoy", "password", "onejoy");

        // Check connection
        if($link === false){
            die("ERROR: Could not connect. " . mysqli_connect_error());
        }

        if (isset($_GET["order_id"])) {
            $order_id = $_GET["order_id"];
        } else {
            header("Location: ".$uri."/xander/admin/dashboard");
        }

        $sql = "SELECT * FROM orders WHERE order_id = $order_id";
        $data = mysqli_query($link, $sql);
        $item = mysqli_fetch_assoc($data);

        $packages = array();
        $packages["30 Pax"] = 30;
        $packages["50 Pax"] = 50;
        $packages["70 Pax"] = 70;
        $packages["100 Pax"] = 100;

        $prices = array();
        $prices["30 Pax"] = "Php 14,000.00";
        $prices["50 Pax"] = "Php 22,500.00";
        $prices["70 Pax"] = "Php 28,500.00";
        $prices["100 Pax"] = "Php 45,000.00";

        ?>
    <!DOCTYPE html>
    <html dir="ltr" lang="en">
        
        <head>
            <meta charset="utf-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <!-- Tell the browser to be responsive to screen width -->
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="keywords"
            content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 5 admin, bootstrap 5, css3 dashboard, bootstrap 5 dashboard, Xtreme lite admin bootstrap 5 dashboard, frontend, responsive bootstrap 5 admin template, Xtreme admin lite design, Xtreme admin lite dashboard bootstrap 5 dashboard template">
            <meta name="description"
            content="Xtreme Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
            <meta name="robots" content="noindex,nofollow">
            <title>OneJoy Catering Services - Admin Dashboard</title>
            <link rel="canonical" href="https://www.wrappixel.com/templates/xtreme-admin-lite/" />
            <!-- Favicon icon -->
            <link rel="icon" type="image/png" sizes="16x16" href="./assets/images/favicon.png">
            <!-- Custom CSS -->
            <link href="./assets/libs/chartist/dist/chartist.min.css" rel="stylesheet">
            <!-- Custom CSS -->
            <link href="./dist/css/style.min.css" rel="stylesheet">
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
                <!--[if lt IE 9]>
                <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
                <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
                <![endif]-->
            </head>
            
            <body>
                <!-- ============================================================== -->
                <!-- Preloader - style you can find in spinners.css -->
                <!-- ============================================================== -->
                <div class="preloader">
            <div class="lds-ripple">
                <div class="lds-pos"></div>
                <div class="lds-pos"></div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Main wrapper - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
            <!-- Topbar header - style you can find in pages.scss -->
            <!-- ============================================================== -->
            <header class="topbar" data-navbarbg="skin5">
                <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                    <div class="navbar-header" data-logobg="skin5">
                        <!-- ============================================================== -->
                        <!-- Logo -->
                        <!-- ============================================================== -->
                        <a class="navbar-brand" href="index.html">
                            <!-- Logo icon -->
                            <b class="logo-icon">
                                <!--You can put here icon as well // <i class="wi wi-sunset"></i> //-->
                                <!-- Dark Logo icon -->
                                <img src="./assets/images/logo-icon.png" alt="homepage" class="dark-logo" />
                                <!-- Light Logo icon -->
                                <img src="./assets/images/logo-light-icon.png" alt="homepage" class="light-logo" />
                            </b>
                            <!--End Logo icon -->
                            <!-- Logo text -->
                            <span class="logo-text">
                                <span>OneJoy Catering</span>
                            </span>
                        </a>
                        <!-- ============================================================== -->
                        <!-- End Logo -->
                        <!-- ============================================================== -->
                        <!-- This is for the sidebar toggle which is visible on mobile only -->
                        <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)"><i
                        class="ti-menu ti-close"></i></a>
                    </div>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                </nav>
            </header>
            <!-- ============================================================== -->
            <!-- End Topbar header -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <aside class="left-sidebar" data-sidebarbg="skin6">
                <!-- Sidebar scroll-->
                <div class="scroll-sidebar">
                    <!-- Sidebar navigation-->
                    <nav class="sidebar-nav">
                        <ul id="sidebarnav">
                            <!-- User Profile-->
                            <li>
                                <!-- User Profile-->
                                <div class="user-profile d-flex no-block dropdown m-t-20">
                                    <div class="user-pic"><img src="./assets/images/users/1.jpg" alt="users"
                                            class="rounded-circle" width="40" /></div>
                                            <div class="user-content hide-menu m-l-10">
                                                <a href="#" class="" id="Userdd" role="button"
                                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <h5 class="m-b-0 user-name font-medium">OneJoy Admin <i
                                                class="fa fa-angle-down"></i></h5>
                                                <span class="op-5 user-email">onejoycatering@gmail.com</span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="Userdd">
                                            <a class="dropdown-item" href="<?php echo $uri.'/xander/admin/logout/' ?>"><i
                                                    class="fa fa-power-off m-r-5 m-l-5"></i> Logout</a>
                                        </div>
                                    </div>
                                </div>
                                <!-- End User Profile-->
                            </li>
                            <!-- User Profile-->
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                            href="index.php" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                            class="hide-menu">Dashboard</span></a></li>
                            <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                    href="table.php" aria-expanded="false"><i class="mdi mdi-border-all"></i><span
                                    class="hide-menu">Orders</span></a></li>
                                </ul>

                    </nav>
                    <!-- End Sidebar navigation -->
                </div>
                <!-- End Sidebar scroll-->
            </aside>
            <!-- ============================================================== -->
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Page wrapper  -->
            <!-- ============================================================== -->
            <div class="page-wrapper">
                <!-- ============================================================== -->
                <!-- Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <div class="page-breadcrumb">
                    <div class="row align-items-center">
                        <div class="col-5">
                            <h4 class="page-title">Dashboard</h4>
                            <div class="d-flex align-items-center">
                                <nav aria-label="breadcrumb">
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Container fluid  -->
                <!-- ============================================================== -->
                <div class="container-fluid">
                    <!-- ============================================================== -->
                    <!-- Sales chart -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <center>
                        <div class="col-md-6">
                            <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> 
                                    <a class="btn btn-circle d-flex btn-info text-white">
                                        <?php                                             
                                            echo $packages[$item["package"]];
                                        ?>
                                    </a>
                                    <h4 class="card-title m-t-10">
                                        <?php echo $item["package"]; ?>
                                    </h4>
                                    <h6>
                                        <?php 
                                            echo $prices[$item["package"]]; 
                                        ?>
                                    </h6>
                                </center>
                            </div>
                            <div>
                                <hr>
                            </div>
                            <div class="card-body"> 
                                <?php if (!$item["confirmed"]) { ?>
                                    <a href="<?php echo $uri.'/xander/admin/dashboard/confirm.php?order_id='.$item["order_id"]; ?>" class="btn d-block w-50 btn-danger text-white">Unconfirmed (Click to Confirm)</a>
                                <?php } else { ?>
                                    <a href="<?php echo $uri.'/xander/admin/dashboard/confirm.php?order_id='.$item["order_id"]; ?>" class="btn d-block w-50 btn-success text-white">Confirmed (Click to Unconfirm)</a>
                                <?php } ?>
                                <?php
                                    echo "<span>Customer Name</span>";
                                    echo "<h5>".$item['name']."</h5> ";
                                    echo "<span>Email</span>";
                                    echo "<h5>".$item['email']."</h5> ";
                                    echo "<span>Contact Number</span>";
                                    echo "<h5>".$item['contact']."</h5> ";
                                    echo "<span>Date</span>";
                                    echo "<h5>".$item['date']."</h5> ";
                                    echo "<span>Time</span>";
                                    echo "<h5>".$item['time']."</h5> ";
                                    echo "<span>Message</span>";
                                    echo "<h5>".$item['message']."</h5>";
                                ?>
                            </div>
                        </div>

                            </div>
                        </div>
                        </center>
                    </div>
            </div>
            <!-- ============================================================== -->
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Wrapper -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- All Jquery -->
        <!-- ============================================================== -->
        <script src="./assets/libs/jquery/dist/jquery.min.js"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="./assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        <script src="./dist/js/app-style-switcher.js"></script>
        <!--Wave Effects -->
        <script src="./dist/js/waves.js"></script>
        <!--Menu sidebar -->
        <script src="./dist/js/sidebarmenu.js"></script>
        <!--Custom JavaScript -->
        <script src="./dist/js/custom.js"></script>
        <!--This page JavaScript -->
        <!--chartis chart-->
        <script src="./assets/libs/chartist/dist/chartist.min.js"></script>
        <script src="./assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js"></script>
        <script src="./dist/js/pages/dashboards/dashboard1.js"></script>
    </body>

    </html>

<?php } ?>