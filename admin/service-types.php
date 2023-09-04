<?php
$page = 'service-types';
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once dirname(__DIR__) ."/includes/order-constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";
require_once ROOT_DIR . "classes/services.class.php";

$Services   = new Services;

$allServiceTypes = $Services->ShowServicesCatData();
$allServiceTypes = json_decode($allServiceTypes);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= FAVCON_PATH ?>" type="image/png">
    <title> Services - <?= COMPANY_S ?></title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
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
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Name</th>
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
                                        <?php foreach ($allServiceTypes as $eachType) {
                                            // print_r($eachType);exit;
                                            $typeID       = $eachType->id;
                                            $typeID       = url_enc($typeID);
                                            $typeName     = $eachType->cat_name;
                                            $typeDsc     = $eachType->desc;
                                            $typeAddOn   = $eachType->added_on;
                                            $typeStatus  = $eachType->status;

                                            if ($typeStatus == 1) {
                                                $typeStatus = ACTIVE;
                                            }
                                            if ($typeStatus == 0) {
                                                $typeStatus = DEACTIVATED;
                                            }
                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $typeName ?></h6>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <p class="text-xs text-secondary">
                                                    <?= strip_tags(substr($typeDsc, 0, 50)); ?>
                                                    <br>
                                                    <?= strip_tags(substr($typeDsc, 50, 50)); ?>
                                                </p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span
                                                    class="badge badge-sm bg-gradient-success"><?= $typeStatus ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $typeAddOn; ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <small
                                                    class="badge badge-sm rounded-pill text-bg-primary cursor-pointer text-xss"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    onclick="showServiceType(<?= url_dec($typeID) ?>)">
                                                    View
                                                    <!-- <i class="fa-solid fa-eye pe-4"> -->
                                                </small>

                                                <small
                                                    class="badge badge-sm rounded-pill text-bg-danger cursor-pointer text-xss"
                                                    id="<?= $Utility->getLatersOnly($typeID); ?>"
                                                    data-id="<?= $typeID; ?>" onclick="deleteRow(this, event)">
                                                    Delete
                                                    <!-- <i class="fa-solid fa-trash"></i> -->
                                                </small>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Service Type</h5>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modal-body">
                </div>
            </div>
        </div>
    </div>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <!-- <script src="assets/js/plugins/chartjs.min.js"></script> -->
    <script src="<?= URL ?>js/ajax.js"></script>

    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }



    const showServiceType = (serviceTypeId) => {
        let url = 'ajax/service-type.ajax.php?data=' + serviceTypeId;
        document.getElementById('modal-body').innerHTML =
            `<iframe id="idIframe" onload="iframeLoaded(this.id)" width="99%" height="350px" frameborder="0" allowtransparency="true" src="${url}"></iframe>`;
    }
    </script>
    <!-- Github buttons -->
    <!-- <script async defer src="https://buttons.github.io/buttons.js"></script> -->
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="assets/js/soft-ui-dashboard.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>