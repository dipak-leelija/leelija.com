<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/encrypt.inc.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";
require_once ROOT_DIR."classes/domain.class.php";

require_once ROOT_DIR."classes/utility.class.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/orderStatus.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Domain			= new Domain();
$OrderStatus    = new OrderStatus();

$utility		= new Utility(); 
$Order            = new Order();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

// print_r($cusDtl);exit;

if($cusId == 0){
	header("Location: index.php");
}

if($cusDtl[0][0] == 1){
	header("Location: ".USER_AREA);
}

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
                                        <table class="table table-striped dataTable" id="datatable">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        Order
                                                    </th>
                                                    <th>
                                                        Order ID
                                                    </th>
                                                    <th>
                                                        Status
                                                    </th>
                                                    <th>
                                                        Date
                                                    </th>
                                                    <th>
                                                        Action
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>


                                                <?php
                                                    $orderedData = $Order->getAllOrderDetails();
                                                    foreach ($orderedData as $orderWise) {
                                                    $productId = $orderWise['product_id'];
                                                    $statusName = $OrderStatus->getOrdStatName($orderWise['orders_status_id']);

                                                    $OrdrdProduct = $Domain->productSoldBySeller($productId, $cusDtl[0][3]);
                                                    // print_r($OrdrdProduct);
                                                    if ($OrdrdProduct > 0) {
                                                    foreach ($OrdrdProduct as $productWise) {
                                                ?>

                                                <tr>
                                                    <td class="py-1">
                                                        <img src="<?= URL ?>images/domains/<?php echo $productWise['dimage'];?>"
                                                            alt="Dipak">
                                                        <?= $productWise['domain'];?>
                                                    </td>
                                                    <td style="width:100px;font-weight:500;">
                                                        <?= '#'.$orderWise['orders_code'];?>
                                                    </td>
                                                    <td>
                                                        <label class="badge badge-danger">
                                                            <?= $statusName;?>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <?php echo date("d.m.Y - h:i a", strtotime($orderWise['added_on']));?>
                                                    </td>
                                                    <?php
                                                     $productOrderViewUrl = '='.url_enc($orderWise['orders_id']).'&pdata='.url_enc($productId);
                                                    ?>
                                                    <td>
                                                        <a href="product-order-view.php?data=<?php echo $productOrderViewUrl;?>"
                                                            title="Edit">
                                                            <i class="fa-solid fa-pen-to-square"></i>
                                                        </a>
                                                        <span>
                                                            <i class="ps-3 fa-solid fa-trash"></i>
                                                        </span>
                                                    </td>
                                                </tr>

                                                <?php
                                                        }
                                                    }
                                                    }

                                                ?>
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