<?php
require_once dirname(__DIR__)."/includes/constant.inc.php";
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
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Products</h4>
                                   
                                    <div class="table-responsive">
                                        <table  class="table table-striped dataTable" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        User
                                                    </th>
                                                    <th>
                                                        First name
                                                    </th>
                                                    <th>
                                                        Progress
                                                    </th>
                                                    <th>
                                                        Amount
                                                    </th>
                                                    <th>
                                                        Deadline
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face1.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Herman Beck
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-success" role="progressbar"
                                                                style="width: 25%" aria-valuenow="25" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 77.99
                                                    </td>
                                                    <td>
                                                        May 15, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face2.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Messsy Adam
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 75%" aria-valuenow="75" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $245.30
                                                    </td>
                                                    <td>
                                                        July 1, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face3.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        John Richards
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 90%" aria-valuenow="90" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $138.00
                                                    </td>
                                                    <td>
                                                        Apr 12, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face4.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Peter Meggik
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-primary" role="progressbar"
                                                                style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 77.99
                                                    </td>
                                                    <td>
                                                        May 15, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face5.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Edward
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-danger" role="progressbar"
                                                                style="width: 35%" aria-valuenow="35" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 160.25
                                                    </td>
                                                    <td>
                                                        May 03, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face6.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        John Doe
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar"
                                                                style="width: 65%" aria-valuenow="65" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 123.21
                                                    </td>
                                                    <td>
                                                        April 05, 2015
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>assets/images/faces/face7.jpg" alt="image" />
                                                    </td>
                                                    <td>
                                                        Henry Tom
                                                    </td>
                                                    <td>
                                                        <div class="progress">
                                                            <div class="progress-bar bg-warning" role="progressbar"
                                                                style="width: 20%" aria-valuenow="20" aria-valuemin="0"
                                                                aria-valuemax="100"></div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        $ 150.00
                                                    </td>
                                                    <td>
                                                        June 16, 2015
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
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
    <!-- <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script> -->
    <!-- <script src="<?= URL ?>plugins/data-table/simple-datatables.js"></script> -->

    <script src="<?= URL ?>assets/vendors/js/vendor.bundle.base.js"></script>
  
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- <script src="<?= URL ?>assets/vendors/chart.js/Chart.min.js"></script> -->
    <script src="<?= URL ?>assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="<?= URL ?>assets/vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="<?= URL ?>assets/js/dataTables.select.min.js"></script>
    <script src="<?= URL ?>assets/js/data-table.js"></script>
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
    <!-- End custom js for this page-->
</body>

</html>