<?php
$page = 'services';
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once dirname(__DIR__) ."/includes/order-constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";
require_once ROOT_DIR . "classes/services.class.php";

$Services   = new Services;

$allServices = $Services->ShowAllServices();
$allServices = json_decode($allServices);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo/favicon.png" type="image/png">
    <title> Leelija - Blank Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <script defer data-site="YOUR_DOMAIN_HERE" src="https://api.nepcha.com/js/nepcha-analytics.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->

        <!-- main area start -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <?php if (isset($msg)) { ?>
                            <div class="alert <?= $alertClasse ?> alert-dismissible fade show" role="alert">
                                <strong><?= $msg ?></strong>
                                <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                            <h6>Services</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Service</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Description</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Added On</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allServices as $eachservice) {
                                            // print_r($eachservice);exit;
                                            $seviceID       = $eachservice->id;
                                            $seviceID       = url_enc($seviceID);
                                            $seviceName     = $eachservice->service_name;
                                            $serviceDsc     = $eachservice->service_desc;
                                            $serviceAddOn   = $eachservice->added_on;
                                            $servicecatId   = $eachservice->service_cat_id;
                                            $serviceStatus  = $eachservice->status;
                                            if ($serviceStatus == 1) {
                                                $serviceStatus = ACTIVE;
                                            }
                                            if ($serviceStatus == 0) {
                                                $serviceStatus = DEACTIVATED;
                                            }
                                            
                                            $serviceIcon = IMG_PATH.'default-icons/default-emp.png';
                                            if ($eachservice->image != '') {
                                                $serviceIcon = IMG_PATH.'services/'.$eachservice->image;
                                            }

                                            $setviceType = $Services->getServiceType($servicecatId);
                                            $setviceType = json_decode($setviceType);
                                            $serviceTypeName = $setviceType->cat_name;

                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="<?= $serviceIcon ?>"
                                                            class="object-fit-cover avatar avatar-sm me-3" alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $seviceName ?></h6>
                                                        <p class="text-xs text-secondary mb-0"><?= $serviceTypeName ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <p class="text-xs text-secondary">
                                                    <?= strip_tags(substr($serviceDsc, 0, 50)); ?>
                                                    <br>
                                                    <?= strip_tags(substr($serviceDsc, 50, 50)); ?>
                                                    ..
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-success"><?= $serviceStatus ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $serviceAddOn; ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="employee-details.php?data=<?= $seviceID; ?>"
                                                    class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-eye pe-4"></i>
                                                </a>
                                                <span class="text-secondary font-weight-bold cursor-pointer text-xs"
                                                    id="<?= $Utility->getLatersOnly($seviceID); ?>"
                                                    data-id="<?= $seviceID; ?>" onclick="deleteRow(this, event)"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-trash"></i>
                                                    </a>
                                            </td>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main area end -->
    </main>

    <?php require_once ADM_DIR .'partials/bar-setting.php'; ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="assets/js/plugins/chartjs.min.js"></script>

    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }

    </script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>
</body>

</html>