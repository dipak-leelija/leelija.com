<?php
$page = 'services';
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once dirname(__DIR__) ."/includes/order-constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";
require_once ROOT_DIR . "classes/services.class.php";

$Services   = new Services;


if(isset($_GET['data'])){
    $serviceId = url_dec($_GET['data']);

}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $serviceName        = $_POST['service'];
    $serviceType        = $_POST['category'];
    $servicePageTitle   = $_POST['page-title'];
    $serviceSEOURL      = $_POST['seo-url'];
    $serviceMetaTags    = $_POST['meta-tags'];
    $serviceMetaDesc    = $_POST['meta-description'];
    $serviceDsc         = $_POST['service-description'];
    
    if (!empty($_FILES['service-icon']['name'])){
        $imageName = basename($Utility->fileUploadWithRename($_FILES['service-icon'], SERVICE_IMG_DIR));
    }else {
        $imageName = '';
    }
    
    $updated = $Services->editServices($serviceId, $serviceType, $serviceName, $serviceDsc, $servicePageTitle, $serviceSEOURL, $serviceMetaTags, $serviceMetaDesc, $imageName, $loggedinAdminEmail);

    if ($updated == 'SU001') {
        $msg = 'Contents Updated!';
        $action = 'SU';
    }else {
        $msg = 'Failed to Updated Contents!';
        $action = 'ER';
    }
    
    header('Location: '.$currentURL.'&action='.$action.'&msg='.$msg);
}
$service = $Services->showServices($serviceId);

$serviceName       = $service[2];
$serviceType       = $service[1];
$serviceDsc        = $service[3];
$imagename         = $service[12];
$servicePageTitle  = $service[4];
$serviceSEOURL     = $service[5];
$serviceMetaTags   = $service[6];
$serviceMetaDesc   = $service[7];

$serviceIcon = IMG_PATH.'default-icons/default-emp.png';
if (!empty($imagename)) {
    $serviceIcon = IMG_PATH.'services/'.$imagename;
}
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
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
    <link href="<?= URL ?>assets/vendors/dropify/dist/css/dropify.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/summernote/summernote-lite.min.css" rel="stylesheet">

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

                            <?php if (isset($_GET['msg'])) { ?>
                            <div class="alert <?= $_GET['action'] == 'SU' ? 'alert-info' : 'alert-danger' ; ?> alert-dismissible fade show" role="alert">
                                <span class="alert-text text-light"><strong><?= $_GET['msg']; ?></strong></span>
                            </div>
                            <?php } ?>

                        </div>
                        <div class="card-body px-0 pt-0 pb-2">

                            <form action="<?= $currentURL; ?>" method="POST" enctype="multipart/form-data">
                                <div class="row px-4">
                                    <div class="col-md-6">
                                        <div>
                                            <input type="file" class="dropify" name="service-icon"
                                                data-default-file="<?= $serviceIcon ?>" data-max-file-size="2M"
                                                data-allowed-file-extensions="jpg jpeg png" data-height="200" />
                                        </div>

                                        <div class="form-group">
                                            <label for="service">Name of Service: </label>
                                            <input type="text" name="service" id="service" placeholder="Regular"
                                                class="form-control" value="<?= $serviceName ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label for="category">Service Type: </label>
                                            <select class="form-control" id="category" name="category" required>
                                                <option value="" selected disabled>Select</option>
                                                <?= $Utility->populateDropDown($serviceType, 'id', 'cat_name', 'service_cat')?>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="page-title">Page Title: </label>
                                            <input type="text" name="page-title" id="page-title" class="form-control"
                                                value="<?= $servicePageTitle ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label for="seo-url">SEO URL: </label>
                                            <input type="text" name="seo-url" id="seo-url" class="form-control"
                                                value="<?= $serviceSEOURL ?>" />
                                        </div>

                                        <div class="form-group">
                                            <label for="meta-tags">Meta Tags: </label>
                                            <textarea class="form-control" name="meta-tags" id="meta-tags"
                                                rows="2"><?= $serviceMetaTags ?></textarea>
                                        </div>

                                        <div class="form-group">
                                            <label for="meta-description">Meta Description: </label>
                                            <textarea class="form-control" name="meta-description" id="meta-description"
                                                rows="2"><?= $serviceMetaDesc ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 px-4 mt-2">
                                    <textarea class="form-control" id="summernote"
                                        name="service-description"><?= $serviceDsc?></textarea>
                                </div>
                                <div class="d-flex justify-content-evenly mt-2">
                                    <a href="services.php" role="button" class="btn btn-secondary btm-sm">Cancel</a>
                                    <button type="submit" class="btn btn-primary btm-sm">Update</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- main area end -->
    </main>

    <?php require_once ADM_DIR .'partials/bar-setting.php'; ?>

    <!-- Core JS Files -->
    <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
    <script src="assets/js/core/popper.min.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
    <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>

    <script src="<?= URL ?>assets/vendors/dropify/dist/js/dropify.min.js"></script>
    <script src="<?= URL ?>assets/vendors/dropify/dist/js/dropify.js"></script>
    <script src="<?= URL ?>assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/summernote/summernote-lite.min.js"></script>

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
    <script src="assets/js/soft-ui-dashboard.min.js"></script>
    <script>
    $(document).ready(function() {
        // Basic
        $('.dropify').dropify();


        $('#summernote').summernote({
            height: 350
        });

        // Used events
        // var drEvent = $('#input-file-events').dropify();

        // drEvent.on('dropify.beforeClear', function(event, element) {
        //     return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
        // });

        // drEvent.on('dropify.afterClear', function(event, element) {
        //     alert('File deleted');
        // });

        // drEvent.on('dropify.errors', function(event, element) {
        //     console.log('Has Errors');
        // });

        // var drDestroy = $('#input-file-to-destroy').dropify();
        // drDestroy = drDestroy.data('dropify')
        // $('#toggleDropify').on('click', function(e) {
        //     e.preventDefault();
        //     if (drDestroy.isDropified()) {
        //         drDestroy.destroy();
        //     } else {
        //         drDestroy.init();
        //     }
        // })
    });
    </script>
</body>

</html>