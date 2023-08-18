<?php
$page = 'Admin_order';
require_once dirname(__DIR__) ."/includes/constant.inc.php";
require_once ADM_DIR . "incs/global-inc.php";

require_once ROOT_DIR . "classes/encrypt.inc.php";

require_once ROOT_DIR . "classes/order.class.php";
require_once ROOT_DIR . "classes/orderStatus.class.php";
require_once ROOT_DIR . "classes/domain.class.php";
require_once ROOT_DIR . "classes/niche.class.php";
require_once ROOT_DIR . "classes/utility.class.php";


$Order	        = new Order();
$OrderStatus    = new OrderStatus();
$Domain         = new Domain();
$Niche          = new Niche();
$Utility        = new Utility();

$Utility->setCurrentPageSession();

$allOrders = $Order->getAllOrderDetails();
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
                        <div class="card-header pb-0">
                            <h6>Total Orders: <?= count($allOrders) ?></h6>
                        </div>
                        <div class="card-body px-0 pt-0 pb-2">
                            <div class="table-responsive p-0">
                                <?php if(count($allOrders) > 0): ?>
                                <table class="table align-items-center mb-0 datatable">
                                    <thead>
                                        <tr>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Order ID</th>
                                            <th
                                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                Item</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Status</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                Date</th>
                                            <th
                                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder">
                                                Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allOrders as $eachOrder) {
                                            
                                            // ( [] => 179 [customer_id] => 220 [billing_name] => Dipak Majumdar [orders_amount] => 1200.00 [orders_code] => ORDER-10082022T2NM8-1180 [delivery_type] => 0 [delivery_name] => Dipak [delivery_address1] => Kolkata [delivery_address2] => [delivery_city] => [delivery_postcode] => 700124 [delivery_phone] => 7699753019 [delivery_state] => Assam [delivery_country] => 99 [billing_address1] => Kolkata [billing_address2] => [billing_city] => [billing_postcode] => 700124 [billing_phone] => 7699753019 [billing_state] => Assam [billing_country] => 99 [last_modified] => 2022-08-10 03:42:50 [] => 2022-08-10 03:42:50 [shipping_id] => 0 [shipping_cost] => 0.00 [shipping_method] => [] => 2 [payment_status] => COMPLETED [orders_date_finished] => [email] => dipakmajumdar.leelija@gmail.com [description] => paypal check [payment_method_id] => credit card [cc_name] => [cc_number] => [coupon_id] => 0 [discount_provided] => 0.00 [currency_code] => [currency_conversion_rate] => [added_on] => 2022-08-10 03:42:50 [orders_products_id] => 95 [product_type] => domain [product_id] => 19 [product_model] => [] => neybg [product_price] => 1200.0000 [final_price] => 1200.0000 [products_tax] => 0.0000 [product_quantity] => 1 )
                                            $tableId        = $eachOrder['orders_id'];
                                            $orderId        = $eachOrder['orders_code'];
                                            $productId      = $eachOrder['product_id'];
                                            $itemName       = $eachOrder['product_name'];
                                            $deliveryName   = $eachOrder['delivery_name'];
                                            $orderDate      = $eachOrder['date_purchased'];

                                            $ordStatus     = $eachOrder['orders_status_id'];
                                            $ordStatus     = $OrderStatus->getOrdStatName($ordStatus);

                                            $item           = $Domain->showDomainsById($productId);
                                            $itemImage      = $item['dimage'];
                                            $itemNiche      = $Niche->getBlogNichMast($item['niche']);
                                            $itemNiche      = $itemNiche['niche_name'];

                                        ?>
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">
                                                    <div>
                                                        <img src="<?= IMG_PATH ?>/domains/<?= $itemImage?>" class="avatar avatar-sm me-3"
                                                            alt="user1">
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm"><?= $deliveryName ?></h6>
                                                        <p class="text-xs text-secondary mb-0">#<?= $orderId ?></p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0"><?= $itemName; ?></p>
                                                <p class="text-xs text-secondary mb-0"><?= $itemNiche; ?></p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-success"><?= $ordStatus ?></span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    <?= $DateUtil->printDate2($orderDate); ?>
                                                </span>
                                            </td>
                                            <td class="align-middle text-center">
                                                <a href="<?= ADM_URL ?>order-details.php?order-id=<?= $tableId ?>" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-eye pe-4"></i>
                                                </a>
                                                <a href="javascript:;" class="text-secondary font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Edit user">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php } ?>

                                    </tbody>
                                </table>
                                <?php else: ?>
                                    <div class="border border-danger rounded m-2 p-2">
                                        <p class="text-bold text-center my-2 py-2">No Orders found</p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
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