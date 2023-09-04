
<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";

require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/domain.class.php";

require_once ROOT_DIR."classes/utility.class.php";

/* INSTANTIATING CLASSES */
$search_obj		= new Search();
$customer		= new Customer();
$domain			= new Domain();
$utility		= new Utility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

if($cusDtl[0][0] == 0){
	header("Location: ".URL);
}
if($cusDtl[0][0] == 1){ 
	header("Location: ".USER_AREA);
}

$domainDtls	= $domain->ShowUserDomainData($cusDtl[0][2]);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/feather/feather.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/font-awesome/free/css/all.min.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="<?= URL ?>assets/vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="<?= URL ?>assets/js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="<?= URL ?>assets/css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />
</head>

<body>
    <div class="container-scroller">
        <!-- NAVBAR -->
        <?php require_once ROOT_DIR."components/navbar.php"; ?>
        <!-- NAVBAR END -->
        <div class="container-fluid page-body-wrapper">
            <!-- SETTING PANEL -->
            <?php require_once ROOT_DIR."components/settings-panel.php"; ?>
            <!-- SETTING PANEL END-->
            <!-- SIDEBAR -->
            <?php require_once ROOT_DIR."components/sidebar.php"; ?>
            <!-- SIDEBAR END -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Welcome Rozy!</h3>
                                    <h6 class="font-weight-normal mb-0">All systems are running smoothly! You have <span
                                            class="text-primary">3 unread alerts!</span></h6>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex">
                                        <div class="dropdown flex-md-grow-1 flex-xl-grow-0">
                                            <button class="btn btn-sm btn-light bg-white dropdown-toggle" type="button"
                                                id="dropdownMenuDate2" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="true">
                                                <i class="mdi mdi-calendar"></i> Today (10 Jan 2021)
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right"
                                                aria-labelledby="dropdownMenuDate2">
                                                <a class="dropdown-item" href="#">January - March</a>
                                                <a class="dropdown-item" href="#">March - June</a>
                                                <a class="dropdown-item" href="#">June - August</a>
                                                <a class="dropdown-item" href="#">August - November</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Today’s Bookings</p>
                                            <p class="fs-30 mb-2">4006</p>
                                            <p>10.00% (30 days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Bookings</p>
                                            <p class="fs-30 mb-2">61344</p>
                                            <p>22.00% (30 days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Number of Meetings</p>
                                            <p class="fs-30 mb-2">34040</p>
                                            <p>2.00% (30 days)</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3 mb-4 stretch-card transparent">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4">Number of Clients</p>
                                            <p class="fs-30 mb-2">47033</p>
                                            <p>0.22% (30 days)</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="row justify-content-end">
                        <div class="col-md-4 stretch-card grid-margin">
                            <div class="card">
                                <div class="card-body">
                                    <p class="card-title">Notifications</p>
                                    <ul class="icon-data-list">
                                        <li>
                                            <div class="d-flex">
                                                <img src="images/faces/face1.jpg" alt="user">
                                                <div>
                                                    <p class="text-info mb-1">Isabella Becker</p>
                                                    <p class="mb-0">Sales dashboard have been created</p>
                                                    <small>9:30 am</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <img src="images/faces/face2.jpg" alt="user">
                                                <div>
                                                    <p class="text-info mb-1">Adam Warren</p>
                                                    <p class="mb-0">You have done a great job #TW111</p>
                                                    <small>10:30 am</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <img src="images/faces/face3.jpg" alt="user">
                                                <div>
                                                    <p class="text-info mb-1">Leonard Thornton</p>
                                                    <p class="mb-0">Sales dashboard have been created</p>
                                                    <small>11:30 am</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <img src="images/faces/face4.jpg" alt="user">
                                                <div>
                                                    <p class="text-info mb-1">George Morrison</p>
                                                    <p class="mb-0">Sales dashboard have been created</p>
                                                    <small>8:50 am</small>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="d-flex">
                                                <img src="images/faces/face5.jpg" alt="user">
                                                <div>
                                                    <p class="text-info mb-1">Ryan Cortez</p>
                                                    <p class="mb-0">Herbs are fun and easy to grow.</p>
                                                    <small>9:00 am</small>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- content-wrapper ends -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?= URL ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?= URL ?>assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= URL ?>assets/js/dataTables.select.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?= URL ?>assets/js/off-canvas.js"></script>
    <script src="<?= URL ?>assets/js/hoverable-collapse.js"></script>
    <script src="<?= URL ?>assets/js/template.js"></script>
    <script src="<?= URL ?>assets/js/settings.js"></script>
    <script src="<?= URL ?>assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="<?= URL ?>assets/js/dashboard.js"></script>
    <script src="<?= URL ?>assets/js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
 
</body>

</html>