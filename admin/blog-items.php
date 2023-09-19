<?php
$page = "blog-items";
require_once dirname(__DIR__) . "/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/domain.class.php";
require_once ROOT_DIR . "classes/utility.class.php";


$Domain    = new Domain();
$Utility    = new Utility();

$Utility->setCurrentPageSession();

$allDomains = $Domain->ShowBlogItems();
$allDomains = json_decode($allDomains);

if (isset($_GET['action']) && isset($_GET['msg'])) {
    $_GET['action'] == 'SUCCESS' ? $alertClasse = 'alert-primary' : $alertClasse = 'alert-warning';
    $msg = $_GET['msg'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="<?= FAVCON_PATH ?>" type="image/png">
    <title> Leelija - Employee Details</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="assets/css/leelija-admin.css" rel="stylesheet" />
    <link href="assets/css/soft-ui-dashboard.css" rel="stylesheet" id="pagestyle" />
    <link rel="stylesheet" href="../plugins/data-table/style.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
    <?php require_once "partials/sidebar.php"; ?>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- Navbar -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header pb-0">
                            <?php if (isset($msg)) { ?>
                                <div class="alert <?= $alertClasse ?> alert-dismissible fade show" role="alert">
                                    <strong><?= $msg ?></strong>
                                    <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>
                            <?php } ?>
                            <h6>Employee Details</h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-uppercase text-dark text-sm font-weight-bolder">
                                                Blog
                                            </th>
                                            <th class="text-uppercase text-dark text-sm font-weight-bolder">
                                                Seller
                                            </th>
                                            <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                                Status
                                            </th>
                                            <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                                Approved
                                            </th>
                                            <th class="text-center text-uppercase text-dark text-sm font-weight-bolder">
                                                Action
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($allDomains as $eachDomain) {

                                            $domainId = url_enc($eachDomain->id);

                                            $status = $eachDomain->selling_status;
                                            $checked = $status == 1 ? 'checked' : '';

                                            // $empIcon = DOMAIN_IMG_DIR .'default-icons/default-emp.png';
                                            if ($eachDomain->dimage != '') {
                                                $empIcon = IMG_PATH . 'domains/' . $eachDomain->dimage;
                                            }
                                        ?>
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div>
                                                            <img src="<?= $empIcon ?>" class="object-fit-cover avatar avatar-sm me-3" alt="user1">
                                                        </div>
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm"><?= $eachDomain->domain ?></h6>
                                                            <a class="text-xs text-primary mb-0" target="_blank" rel="nofollow" href="<?= $eachDomain->durl ?>"><?= $eachDomain->durl ?></a>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <p class="text-sm font-weight-bold mb-0"><?= $eachDomain->added_by ?></p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" id="status-switch" 
                                                        <?= $checked ?> onchange="changeStatus(this, '<?= $domainId ?>',  'domain-status')">
                                                    </div>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <div class="form-switch">
                                                        <input class="form-check-input" type="checkbox" id="approval-switch" <?= $eachDomain->approved == 1 ? 'checked' : ''; ?> onchange="changeStatus(this, '<?= $domainId ?>', 'approval')">
                                                    </div>

                                                    <!-- <span
                                                    class="text-secondary text-xs font-weight-bold"><?= $eachDomain->selling_status ?></span> -->
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="badge bg-gradient-secondary text-light">
                                                        <a href="blog-items-details.php?data=<?= $domainId; ?>" class="text-light font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                                                            <i class="fa-solid fa-eye"></i>
                                                            <small class="small">View</small>
                                                        </a>
                                                    </span>
                                                    <!-- <span class="text-secondary font-weight-bold cursor-pointer text-xs"
                                                    id="<?= $Utility->getLatersOnly($domainId); ?>"
                                                    data-id="<?= $domainId; ?>" onclick="deleteRow(this, event)"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-trash"></i>
                                                </span> -->
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

    <?php require_once ADM_DIR . 'partials/bar-setting.php'; ?>

    <!--   Core JS Files   -->
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
    <script src="<?= URL ?>plugins/data-table/simple-datatables.js"></script>
    <script src="<?= URL ?>plugins/tinymce/tinymce.js"></script>
    <script src="<?= URL ?>plugins/main.js"></script>
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <script src="<?= URL ?>js/ajax.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        const changeStatus = (elem, id, name)=>{
                data = {name: name, id: id};
                $.ajax({
                url: "ajax/blog-item-update.php",
                type: "POST",
                data: data,
                success: function(response) {
                    // console.log(response);
                    if (response.trim() == 'SU001') {
                        alert('Updated');
                    } else {
                        alert(response)
                    }
                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Status: " + textStatus);
                    alert("Error: " + errorThrown);
                }
            });
        }
    </script>
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <script src="assets/js/soft-ui-dashboard.min.js"></script>

</body>

</html>