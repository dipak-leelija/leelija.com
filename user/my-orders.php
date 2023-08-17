<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";

require_once ROOT_DIR."/_config/dbconnect.php";
require_once ROOT_DIR."/classes/encrypt.inc.php";

require_once ROOT_DIR."/classes/customer.class.php";
require_once ROOT_DIR."/classes/orderStatus.class.php";
require_once ROOT_DIR."/classes/order.class.php";
require_once ROOT_DIR."/classes/domain.class.php";
require_once ROOT_DIR."/classes/blog_mst.class.php";
require_once ROOT_DIR."/classes/date.class.php";
require_once ROOT_DIR."/classes/utility.class.php";

/* INSTANTIATING CLASSES */
$customer		= new Customer();
$Order          = new Order();
$Domain         = new Domain();
$BlogMst		= new BlogMst();
$OrderStatus    = new OrderStatus();
$DateUtil       = new DateUtil();
$utility		= new Utility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0){
    header("Location: index.php");
}

if($cusDtl[0][0] == 2){
    header("Location: seller/dashboard.php");
}
// $gpPackagesOrd  = $Gporder->getOrderDetails($cusId);
$orders         = $Order->getOrdersByCusId($cusId);


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>My Order :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo/favicon.png" type="image/png">

    <!-- Bootstrap Core CSS -->
    <link href="<?= URL ?>plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />
    <!-- Custom CSS -->

    <link href="<?= URL ?>css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/my-orders.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/order-list.css" rel='stylesheet' type='text/css' />

    <!-- font-awesome icons -->
    <!-- <link href="css/fontawesome-all.min.css" rel="stylesheet"> -->

    <!-- Datatable CSS  -->
    <link href="<?= URL ?>plugins/data-table/style.css" rel="stylesheet">


    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">


</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php  require_once ROOT_DIR."/partials/navbar.php" ?>
        <?php //include 'header-user-profile.php'?>

        <!-- //header -->
        <!-- banner -->
        <div class="edit_profile">
            <div class="container-fluid1">
                <div class=" display-table">
                    <div class="row ">
                        <!--Row start-->
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">

                            <div class="client_profile_dashboard_left">
                                <?php include ROOT_DIR."partials/dashboard-inc.php";?>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-9 mt-1  display-table-cell v-align client_profile_dashboard_right">

                            <!-- Product Order Show Section -->
                            <div class="row justify-content-evenly dashorder_row me-2">
                                <div class="bg-light mt-1">
                                    <h3 class="fw-bold text-center">My Orders:</h3>
                                </div>
                                <?php
                                if (count($orders) > 0 ) { ?>

                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">Oder ID</th>
                                            <th scope="col">Item</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Date</th>
                                            <th scope="col">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php
                                        foreach ($orders as $ordItem) {
                                        
                                        $productId = $Order->getOrdDtlsByOrdId($ordItem['orders_id']);
                                        $item      = $Domain->showDomainsById($productId[0]['product_id']);

                                        $ordStatusName = $OrderStatus->getOrdStatName($ordItem['orders_status_id']);

                                        $productQueryString = 'data='.url_enc($ordItem['orders_id']).'&pdata='.url_enc($productId[0]['product_id']);
        
                                    ?>
                                        <tr>
                                            <th scope="row">#<?= $ordItem['orders_id'] ?></th>
                                            <td ><?= $item['domain'];?></td>
                                            <td ><?= $ordStatusName;?></td>
                                            <td ><?= $DateUtil->dateTimeNumber($ordItem['date_purchased']);?></td>
                                            <td>
                                                <a href="my-product-order-view.php?<?= $productQueryString; ?>">
                                                    <span class="badge text-bg-primary small">
                                                        <small>View</small>
                                                        <i class="fa-regular fa-eye"></i>
                                                    </span>
                                                </a>
                                            </td>
                                        </tr>

                                        <?php
                                }
                                ?>
                                    </tbody>
                                </table>
                                <?php
                            }
                            ?>
                            </div>
                            <!-- Product Order Show Section End -->




                        </div>
                        <!--Row end-->
                    </div>
                </div>
                <!-- //end display table-->
            </div>
        </div>
        <script src="<?= URL ?>plugins/bootstrap-5.2.0/js/bootstrap.js" type="text/javascript"></script>
        <script src="<?= URL ?>plugins/sweetalert/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="<?= URL ?>plugins/data-table/simple-datatables.js"></script>
        <script src="<?= URL ?>plugins/tinymce/tinymce.js"></script>
        <script src="<?= URL ?>plugins/main.js"></script>
        <script src="<?= URL ?>plugins/jquery-3.6.0.min.js"></script>
        <script src="<?= URL ?>js/customerSwitchMode.js"></script>
</body>

</html>