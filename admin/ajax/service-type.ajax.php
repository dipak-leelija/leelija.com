<?php
$page = 'service-types';
require_once dirname(dirname(__DIR__)) ."/includes/constant.inc.php";
require_once dirname(dirname(__DIR__)) ."/includes/order-constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";
require_once ROOT_DIR . "classes/services.class.php";

$Services   = new Services;

if (isset($_GET['data'])) {
    $serviceTypeId = $_GET['data'];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    $serviceTypeName = $_POST['name'];
    $serviceTypeDsc  = $_POST['dsc'];

    $status = DEACTIVATEDCODE;
    if (isset($_POST['status'])) {
        if ($_POST['status'] == 'on') {
            $status = ACTIVECODE;
        } 
    };


    $updated = $Services->editServicesCat($serviceTypeId, $serviceTypeName, $serviceTypeDsc, $status, $loggedinAdminEmail);
    if ($updated == 'SU001') {
        $msg = 'Service Type is Updated!';
        $alertClasse    = 'alert-success';
    }elseif ($updated == 'ER001') {
        $msg = 'Failed to Update!';
    }else {
        $msg = 'Something is Error!';
    }
}

$serviceType = $Services->getServiceType($serviceTypeId);
$serviceType = json_decode($serviceType);

// print_r($serviceType);
$typeName = $serviceType->cat_name;
$typeDesc = $serviceType->desc;
$typeStatus = $serviceType->status;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title> Leelija - Blank Page</title>
    <link href="<?= ADM_URL ?>assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="<?= ADM_URL ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <link href="<?= ADM_URL ?>assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="<?= ADM_URL ?>assets/css/soft-ui-dashboard.css?v=1.0.7" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100 p-2 pb-0">
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
        <!-- main area start -->
        <div class="container-fluid px-1">
            <div class="row">
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header py-0">
                            <?php if (isset($msg)) { ?>
                            <div class="alert <?= $alertClasse ?> alert-dismissible fade show" role="alert">
                                <strong><?= $msg ?></strong>
                                <button type="button" class="btn-close btn-dark" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="card-body">
                            <form action="<?= $currentURL ?>" method="POST">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <input type="text" class="form-control" placeholder="Service Type Name" name="name"
                                                value="<?= $typeName ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea">Description</label>
                                            <textarea class="form-control" id="exampleFormControlTextarea"
                                                rows="3" name="dsc"><?= $typeDesc; ?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input <?= $typeStatus == 0 ? 'bg-danger' : '';?>"
                                            type="checkbox" id="statusCheck"
                                            <?= $typeStatus == 1 ? 'checked' : '';?> 
                                            name="status">
                                            <label class="form-check-label" for="statusCheck">
                                                <?= $typeStatus == 1 ? ACTIVE : DEACTIVATED;?>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn bg-gradient-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main area end -->
    </main>

    <script src="<?= ADM_URL ?>assets/js/script.js"></script>
</body>

</html>