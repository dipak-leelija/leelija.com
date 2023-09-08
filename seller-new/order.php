<?php
session_start();
$page = "Admin_orders";
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
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Responsive Admin Dashboard Template">
    <meta name="keywords" content="admin,dashboard">
    <meta name="author" content="stacks">

    <!-- Title -->
    <title><?php echo COMPANY_FULL_NAME; ?>: Orders</title>
    <link rel="shortcut icon" href="<?= FAVCON_PATH ?>" />

    <!-- Styles -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/fontawesome-6.1.1/css/all.min.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/pace/pace.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/highlight/styles/github-gist.css" rel="stylesheet">
    <link href="<?= URL ?>assets/portal-assets/plugins/datatables/datatables.min.css" rel="stylesheet">


    <!-- Theme Styles -->
    <link href="<?= URL ?>assets/portal-assets/css/main.min.css" rel="stylesheet">
    <!-- <link href="<?= URL ?>css/order-table.css" rel="stylesheet"> -->
    <style>
    .avatar {
        border-radius: 5px;
        width: 50px;
        height: 50px;
    }
    </style>
</head>

<body>
    <div class="app align-content-stretch d-flex flex-wrap">
        <?php require_once ROOT_DIR."components/sidebar.php"; ?>
        <!-- sidebar ends -->
        <div class="app-container">
            <!-- navbar header starts -->
            <?php require_once ROOT_DIR."components/navbar.php"; ?>
            <!-- navbar header ends -->
            <div class="app-content">
                <div class="content-wrapper">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col">
                                <div class="card page-description">
                                    <h2>Products</h2>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card">
                                    <!-- <div class="card-header">
                                        <h5 class="card-title">Product Table</h5>
                                    </div> -->
                                    <div class="card-body">
                                        <table id="datatable1" class="display" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Sl. No.</th>
                                                    <th>Images</th>
                                                    <th>Order Id</th>
                                                    <th>Domian</th>
                                                    <th>Order Date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                                $orderedData = $Order->getAllOrderDetails();
                                                                // print_r($orderedData);
                                                                // exit;
                                                                foreach ($orderedData as $orderWise) {
                                                                    $productId = $orderWise['product_id'];
                                                                    $OrdrdProduct = $Domain->productSoldBySeller($productId, $cusDtl[0][3]);
                                                                    // print_r($OrdrdProduct);
                                                                    if ($OrdrdProduct > 0) {
                                                                        foreach ($OrdrdProduct as $productWise) {
                                                                    ?>

                                                <tr>
                                                    <td>01</td>
                                                    <td><img src="<?= URL ?>images/domains/<?php echo $productWise['dimage'];?>"
                                                            alt="Dipak" class="avatar avatar-rounded"></td>
                                                    <td><?php echo '#'.$orderWise['orders_id'];?></td>
                                                    <td><?php echo $productWise['domain'];?></td>
                                                    <td> <?php echo date("d.m.Y - h:i a", strtotime($orderWise['added_on']));?>
                                                    </td>
                                                    <?php 

                                                         $productOrderViewUrl = '='.url_enc($orderWise['orders_id']).'&pdata='.url_enc($productId);
                                                       ?>
                                                    <td>
                                                        <a href="order-details.php?data=<?php echo $productOrderViewUrl;?>"
                                                            title="Edit"><i class="fa-solid fa-pen-to-square"></i>
                                                            <i class=" ps-3 fa-solid fa-trash"
                                                                style="color: #ff0000a1;"></i></a>
                                                    </td>
                                                </tr>
                                                <?php
                                                                        }
                                                                    }
                                                                }

                                                                ?>
                                            </tbody>
                                            <!-- <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>Position</th>
                                                    <th>Office</th>
                                                    <th>Age</th>
                                                    <th>Start date</th>
                                                    <th>Salary</th>
                                                </tr>
                                            </tfoot> -->
                                        </table>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Javascripts -->
    <script src="<?= URL ?>assets/portal-assets/plugins/jquery/jquery-3.5.1.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/perfectscroll/perfect-scrollbar.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/pace/pace.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/highlight/highlight.pack.js"></script>
    <script src="<?= URL ?>assets/portal-assets/plugins/datatables/datatables.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/main.min.js"></script>
    <script src="<?= URL ?>assets/portal-assets/js/pages/datatables.js"></script>
</body>

</html>