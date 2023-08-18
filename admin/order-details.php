<?php
$page = 'Admin_order-details';
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/order.class.php";
require_once ROOT_DIR . "classes/orderStatus.class.php";
require_once ROOT_DIR . "classes/domain.class.php";
require_once ROOT_DIR . "classes/niche.class.php";
require_once ROOT_DIR . "classes/date.class.php";
require_once ROOT_DIR . "classes/utility.class.php";


$Order	        = new Order();
$OrderStatus    = new OrderStatus();
$Domain         = new Domain();
$Niche          = new Niche();
$DateUtil       = new DateUtil ();
$Utility        = new Utility();

$Utility->setCurrentPageSession();

if (isset($_GET['order-id'])) {
    $orTableId = $_GET['order-id'];
}

$orderedData = $Order->getFullOrderDetailsById($orTableId);
$prodId = $orderedData['product_id'];
$OrdrdProduct = $Domain->showDomainsById($prodId);
$statusName = $OrderStatus->getOrdStatName($orderedData['orders_status_id']);
$niche = $Niche->showBlogNichMst($OrdrdProduct['niche']);

// if(isset($_GET['action']) && isset($_GET['msg'])){
//     $_GET['action'] == 'SUCCESS' ? $alertClasse = 'alert-primary' : $alertClasse = 'alert-warning';
//     $msg = $_GET['msg'];
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="../images/logo/favicon.png" type="image/png">
    <title> Leelija - Orders Page</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <link href="assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="assets/css/nucleo-svg.css" rel="stylesheet" />
    <link id="pagestyle" href="assets/css/soft-ui-dashboard.css" rel="stylesheet" />
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
                        <!-- =================================================== -->
                        <?php if ($OrdrdProduct > 0): ?>

                        <div class="card-header pb-0">
                        <h5 class="fw-bolder">
                            <?= $OrdrdProduct['domain']; ?>
                                <small class="badge bg-primary small">
                                    <?= $statusName ?>
                                </small>
                        </h5>
                        </div>

                        <div class="card-body">

                            <section>

                                <div class="row">
                                    <div class="col-md-8">

                                        <!-- Details section Start  -->
                                        <div class="">
                                            <!-- Order Details Start -->
                                                <table class="ordered-details-table-css " style="width: 100%;">
                                                    <tr>
                                                        <td>Order Id</td>
                                                        <td>:</td>
                                                        <td><?php echo "#".$orderedData['orders_id']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Transection Id</td>
                                                        <td>:</td>
                                                        <td style="word-break: break-word;">
                                                            <?php echo "#".$orderedData['orders_code']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Price</td>
                                                        <td>:</td>
                                                        <td><?php echo "$".$orderedData['orders_amount']; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Payment Status</td>
                                                        <td>:</td>
                                                        <td><?php echo $orderedData['payment_status']; ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>:</td>
                                                        <td><?php echo $DateUtil->fullDateTimeText($orderedData['added_on']); ?>
                                                        </td>
                                                    </tr>
                                                </table>
                                        </div>
                                        <!-- Details section End -->

                                    </div>
                                    <div class="col-md-4">
                                        <div class="">
                                            <img class="w-100"
                                                src="<?= IMG_PATH ?>domains/<?= $OrdrdProduct['dimage']?>" alt="">
                                        </div>
                                    </div>
                                </div>

                                <!-- actions Section start -->

                                <section class="d-flex justify-content-evenly order_action_bx">
                                    <?php
                                        if ($orderedData['orders_status_id'] == 3) {
                                            if ($orderedData['delivery_type'] == 1) {
                                                $deliveryDtls = $Order->deliveryDtlsByOrdId($orderedData['orders_id']);
                                                ?>
                                    <div class="w-100">

                                        <div class="">
                                            <div class="m-auto dtls_bx">
                                                <h3 class="text-center">Client Domain Account Details</h3>
                                                <p class="text-primary fw-bold" id="headingTxt">Domain Provider</p>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="domain-provider"
                                                        value="<?php echo url_dec($deliveryDtls['domain_provider']);?>">
                                                    <div id="domain-provider-copy"
                                                        onclick="copyText('domain-provider', this.id)"
                                                        class="clipboard icon">
                                                    </div>
                                                </div>

                                                <p class="text-primary fw-bold">Domain Email</p>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="domain-email"
                                                        value="<?php echo $deliveryDtls['domain_email'];?>">
                                                    <div id="domain-email-copy"
                                                        onclick="copyText('domain-email', this.id)"
                                                        class="clipboard icon">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                                if($deliveryDtls['domain_authorizatrion_code'] != null){
                                            ?>

                                        <div class="">
                                            <div class="m-auto mt-3 form_bx">
                                                <h3 class="text-center">Send Required Details</h3>

                                                <label class="fw-bold">Domain Authorozation Code
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Collect From Your Domain Account."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span id="domainAuthCodeEdit">
                                                        <?php echo $deliveryDtls['domain_authorizatrion_code']; ?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('domainAuthCodeEdit', 'domain_authorizatrion_code')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>

                                                <label class="fw-bold mt-2">Complete Website Zip Drive Link
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Upload your website and database to Google drive and share the link."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span id="decodedLinkEdit">
                                                        <?php echo $deliveryDtls['website_file_link']; ?>
                                                    </span>
                                                    <small
                                                        onclick="editSingleData('decodedLinkEdit', 'website_file_link')"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>

                                                <label class="fw-bold mt-2">Database drive Link
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Upload your website and database to Google drive and share the link."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span id="dbLlinkEdit">
                                                        <?php echo $deliveryDtls['db_drive_link']; ?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('dbLlinkEdit', 'db_drive_link')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>

                                                <label class="fw-bold mt-2">Database Name
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Upload your website and database to Google drive and share the link."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span id="dbName">
                                                        <?php echo $deliveryDtls['db_name']; ?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('dbName', 'db_name')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>

                                                <label class="fw-bold mt-2">Database Username
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Upload your website and database to Google drive and share the link."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span id="dbUser">
                                                        <?php echo $deliveryDtls['db_user']; ?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('dbUser', 'db_user')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>

                                                <label class="fw-bold mt-2">Database Password
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Upload your website and database to Google drive and share the link."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span id="dbPass">
                                                        <?php echo $deliveryDtls['db_pass']; ?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('dbPass', 'db_pass')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>



                                                <label class="fw-bold mt-2">Waiting Time
                                                    <span>
                                                        <i class="far fa-exclamation-circle text-danger"
                                                            data-bs-toggle="tooltip"
                                                            title="Waiting Time Required By Domain Provider."></i>
                                                    </span>
                                                </label>
                                                <p class="fw-normal">
                                                    <span
                                                        id="waitingTimeEdit"><?php echo $deliveryDtls['waiting_time']; ?>
                                                    </span>
                                                    <small onclick="editSingleData('waitingTimeEdit', 'waiting_time')"
                                                        data-bs-toggle="modal" data-bs-target="#editModal"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>


                                                <label class="fw-bold mt-2">Last Update </label>
                                                <p class="fw-normal">
                                                    <span
                                                        id="waitingTimeEdit"><?php echo $DateUtil->fullDateTimeText($deliveryDtls['updated_on']); ?>
                                                    </span>
                                                </p>

                                            </div>
                                        </div>
                                        <?php
                                                }else{

                                            ?>

                                        <div class="" id="sendDataSection">
                                            <div class="m-auto mt-3 form_bx">
                                                <h3 class="text-center">Send Required Details</h3>

                                                <label class="fw-bold">Domain Authorization Code
                                                    <span>
                                                        <a href="#">
                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Collect From Your Domain Account, Click to Know More">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>

                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="domain-code"
                                                        autocomplete="off">
                                                </div>

                                                <label class="fw-bold mt-2">Complete Website Zip Drive Link
                                                    <span>
                                                        <a href="#">

                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Upload your website and database to Google drive and share the link, Click to Know More">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="drive-url"
                                                        autocomplete="off">
                                                </div>

                                                <label class="fw-bold mt-2">Database Drive Link
                                                    <span>
                                                        <a href="#">
                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Upload your website and database to Google drive and share the link.">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="drive-url"
                                                        autocomplete="off">
                                                </div>


                                                <label class="fw-bold mt-2">Database Name
                                                    <span>
                                                        <a href="#">
                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Upload your website and database to Google drive and share the link, Click to Know More">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="db-name"
                                                        autocomplete="off">
                                                </div>

                                                <label class="fw-bold mt-2">Database Username
                                                    <span>
                                                        <a href="#">
                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Upload your website and database to Google drive and share the link, Click to Know More">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="db-username"
                                                        autocomplete="off">
                                                </div>

                                                <label class="fw-bold mt-2">Database Password
                                                    <span>
                                                        <a href="#">
                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Upload your website and database to Google drive and share the link, Click to Know More">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="db-pass"
                                                        autocomplete="off">
                                                </div>

                                                <label class="fw-bold mt-2">Waiting Time
                                                    <span>
                                                        <a href="#">
                                                            <i class="far fw-light fa-exclamation-circle text-danger"
                                                                data-bs-toggle="tooltip"
                                                                title="Waiting Time Required By Domain Provider, Click to Know More">
                                                            </i>
                                                        </a>
                                                    </span>
                                                </label>
                                                <select class="form-select" aria-label="Select Waiting Time"
                                                    id="waiting-time">
                                                    <option selected disabled value="">Completation Time</option>
                                                    <option value="12Hr">12Hr</option>
                                                    <option value="24Hrs">24Hrs</option>
                                                    <option value="48Hrs">48Hrs</option>
                                                    <option value="3 Days">3 Days</option>
                                                    <option value="4 Days">4 Days</option>
                                                    <option value="5 Days">5 Days</option>
                                                    <option value="6 Days">6 Days</option>
                                                    <option value="7 Days">7 Days</option>
                                                    <option value="8 Days">8 Days</option>
                                                    <option value="9 Days">9 Days</option>
                                                    <option value="10 Days">10 Days</option>
                                                </select>


                                                <div class="m-autom-auto text-center pt-3">
                                                    <button class="btn btn-sm btn-primary m-auto"
                                                        onclick="sendData(<?php echo $orderedData['orders_id']?>)">Submit</button>
                                                </div>
                                            </div>

                                        </div>
                                        <?php
                                                }
                                            ?>
                                    </div>


                                    <?php
                                            }elseif($orderedData['delivery_type'] == 2) {
                                                echo '<p class="info-styling-mine">Please Contact To leelija.</p>';
                                            }else {
                                                echo '<p class="info-styling-mine">Please Wait For Customer Response.</p>';
                                            }
                                        }elseif ($orderedData['orders_status_id'] == 4) {
                                            echo '<button class="btn btn-primary" onclick="acceptProductOrder()">Accept</button>
                                                <button class="btn btn-danger" onclick="rejectProductOrder()">Cancel</button>';
                                        }elseif ($orderedData['orders_status_id'] == 2) {
                                            // echo '<button class="btn btn-primary" onclick="acceptProductOrder()">Accept</button>
                                            //     <button class="btn btn-danger" onclick="rejectProductOrder()">Cancel</button>';
                                            echo 'Order Pending';
                                        }else {
                                            echo "Something error!";
                                        }
                                        ?>
                                </section>
                                <!-- actions Section end -->
                            </section>
                        </div>
                        <?php endif; ?>
                        <!-- =================================================== -->
                    </div>
                </div>
            </div>
        </div>
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