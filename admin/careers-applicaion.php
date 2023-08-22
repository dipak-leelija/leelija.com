<?php
$page = "Admin_careers-application";
require_once dirname(__DIR__) . "/includes/constant.inc.php";
require_once ADM_DIR . 'incs/global-inc.php';

require_once ROOT_DIR . "classes/job.class.php";

$Job = new Job;

$allApplications = $Job->allApplications();
$allApplications = json_decode($allApplications);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= FAVCON_PATH ?>" type="image/png">
    <title> Leelija - Careers Application</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/soft-ui-dashboard.css.map" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
    <link rel="stylesheet" href="<?= URL ?>plugins/data-table/style.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once ADM_DIR . "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <h6>Applied Applications</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th class=" text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Serial No.</th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Name</th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Contact Details</th>
                                            <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">
                                                Job Role</th>

                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Date Applied</th>
                                            <th class="text-center text-uppercase text-secondary text-xs font-weight-bolder opacity-7">
                                                Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allApplications as $eachApplication) { ?>
                                            <tr>
                                                <td>
                                                    <span class="text-secondary text-xs font-weight-bold"><?= $eachApplication->id ?></span>
                                                </td>
                                                <td>
                                                    <h7 class="mb-0 text-sm"><?= $eachApplication->fname.' '.$eachApplication->lname ?></h7>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?= $eachApplication->phone ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?= $eachApplication->email ?></p>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0"><?= $eachApplication->post ?></p>
                                                    <p class="text-xs text-secondary mb-0"><?= $eachApplication->expriences ?> Years</p>
                                                </td>

                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        <?= $DateUtil->dateTimeNumber($eachApplication->date) ?>
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <a href="<?= URL?>uploaded_cv/<?= $eachApplication->cv ?>" target="_blank" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                        <i class="fa-solid fa-eye pe-4"></i>
                                                    </a>
                                                    <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                        <!-- <i class="fa-solid fa-trash"></i> -->
                                                        <select name="" id="">
                                                            <option value="" disabled selected>Choose</option>
                                                            <option value="">Selected</option>
                                                            <option value="">Rejected</option>
                                                            <option value="">Pending</option>
                                                            <option value="">Block</option>
                                                        </select>
                                                    </a>
                                                </td>
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
    </main>
    
    <?php require_once "partials/bar-setting.php"; ?>
    
    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="../plugins/data-table/simple-datatables.js"></script>
    <script src="../plugins/tinymce/tinymce.js"></script>
    <script src="../plugins/main.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js?v=1.0.7"></script>

</body>

</html>