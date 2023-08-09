<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/encrypt.inc.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/login.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/blog_mst.class.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/orderStatus.class.php";
require_once ROOT_DIR."classes/utility.class.php";


/* INSTANTIATING CLASSES */
// $dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Domain			= new Domain();
$BlogMst        = new BlogMst();
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

if($cusDtl[0][0] == 2){
    header("Location: ".SELLER_AREA);
}

// print_r($_REQUEST);exit;

if (!isset($_GET['data']) || !isset($_GET['pdata'])) {
    // header("")
    echo 'Get Request Failed';
    exit; 
}
$ordId  =  url_dec($_GET['data']) ;
$prodId =  url_dec($_GET['pdata']) ;


?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>User Dashboard | Dashboard :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo/favicon.png" type="image/png">


    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link href="<?= URL ?>plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/sharp-solid.css">

    <!-- Custom CSS -->
    <link href="<?= URL ?>css/style.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/leelija.css" rel="stylesheet">
    <link href="<?= URL ?>css/order-list.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/my-orders.css" rel='stylesheet' type='text/css' />
    <link href="<?= URL ?>css/dashboard.css" rel='stylesheet' type='text/css' />

    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">

    <style>
    .client_profile_dashboard_right {
        padding-right: 2rem !important;
    }

    .product_image_sec_right {
        text-align: center;
    }

    .product_image {
        object-fit: cover;
        width: 90%;
        border: 1px solid blue;
        border-radius: 0.4rem;
        image-rendering: pixelated;
    }

    .product_image:before {
        content: " ";
        position: absolute;
        z-index: -1;
        top: 5px;
        left: 5px;
        right: 5px;
        bottom: 5px;
        border: 5px solid #ffea00;
    }

    .info-styling-mine {
        background: cornflowerblue;
        font-size: 20px;
        color: white;
        font-weight: 500;
        border: 3px solid white;
        text-align: center;
        padding: 4px 9px;
        border-radius: 0.4rem;
    }

    .info-styling-mine:hover {
        background: #487ad3;
    }

    @media (max-width:767px) {
        .client_profile_dashboard_right {
            padding-right: 3rem !important;
        }

        .p-kage-de-tails {
            background: aliceblue;
            padding: 1rem 1rem !important;
        }

        .product_image {
            width: 60%;
        }

        .product_image_sec_right {
            margin: 2rem;
        }

    }

    .buttonsinfo {
        margin: 3rem 0 1.5rem;
    }

    .managed-link-btn {
        font-family: "Helvetica", Poppins;
        font-size: 16px;
        line-height: 1em;
        fill: #FFF;
        color: #FFF;
        background-color: darkblue;
        border-style: solid;
        border-width: 1px 1px 1px 1px;
        border-color: darkblue !important;
        border-radius: 100px 100px 100px 100px;
        /* padding: 16px 55px 16px 55px; */
        padding: 16px 10px 16px 10px;
        width: 13rem;
    }

    .managed-link-btn:hover {
        color: darkblue !important;
    }

    @media (min-width:800px) {
        .managed-link-btn {
            margin: 0 1rem;
        }
    }

    @media (max-width:532px) {
        .buttonsinfo {
            display: grid;
            margin: 1rem 0rem;
        }

        .managed-link-btn {
            margin-top: 1rem;
        }
    }

    @media (max-width:360px) {
        .product_image {
            width: 100%;
        }

        .managed-link-btn {
            padding: 12px 10px 12px 10px;
            width: -webkit-fill-available;
            font-size: 15px;
        }

        .removingpadding {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }

    .btn-check:focus+.btn,
    .btn:focus {
        color: darkblue !important;

    }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once ROOT_DIR.'partials/navbar.php'; ?>
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
                            </div>
                        </div>
                        <div class="col-md-9  display-table-cell v-align client_profile_dashboard_right">


                            <?php
                                $orderedData = $Order->getFullOrderDetailsById($ordId);
                                if ($prodId == $orderedData['product_id']) {
                                    $OrdrdProduct = $Domain->showDomainsById($prodId);
                                    if ($OrdrdProduct > 0) {
                                        ?>
                            <!-- Products Order Start -->
                            <section class="my-gp-order">
                                <div class="p-kage-de-tails">
                                    <div class="row">
                                        <div class="col-md-8">

                                            <!-- Details section Start  -->
                                            <div class="">
                                                <!-- Order Details Start -->
                                                <h2 class="fw-bolder"><?php echo $OrdrdProduct[0]; ?>
                                                    <span class="badge bg-primary">
                                                        <?php echo $OrderStatus->getOrdStatName($orderedData['orders_status_id']) ?>
                                                    </span>
                                                    </h1>
                                                    <p class="niche_name">
                                                        <?php
                                                        $niche = $BlogMst->showBlogNichMst($OrdrdProduct[1]);
                                                        echo $niche[0][1]; // niche name
                                                    ?>
                                                    </p>
                                                    <div class=" bg-light px-3 mt-2 pt-4 pb-4">
                                                        <div class="row">
                                                            <div class="col-md-6 col-12 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 text-center text-sm-start">DA
                                                                    </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[2];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 text-center text-sm-start">PA
                                                                    </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[3];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 text-center text-sm-start">CF
                                                                    </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[4];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 text-center text-sm-start">TF
                                                                    </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[5];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6 ">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 text-center text-sm-start">
                                                                        Alexa Traffic </div>
                                                                    <div class="col-4 "
                                                                        style="    word-break: break-word;">
                                                                        <?php echo $OrdrdProduct[6];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6 ">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div
                                                                        class="col-6 ps-0 pe-0 text-center text-sm-start">
                                                                        Organic Traffic </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[7];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 text-center text-sm-start">
                                                                        <?php echo $OrdrdProduct[7];?></div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[1];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                                            <td><?php echo date('l jS \of F Y h:i:s A', strtotime($orderedData['added_on'])); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </div>
                                            <!-- Details section End -->

                                        </div>
                                        <div class="col-md-4">
                                            <div class="product_image_sec_right">
                                                <img class="product_image"
                                                    src="<?= URL ?>images/domains/<?php echo $OrdrdProduct[10]?>" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- actions Section start -->
                                    <section
                                        class="d-flex flex-column border-top  border-primary pb-3 px-2 bg_ord_footer">
                                        <?php
                                    if ($orderedData['orders_status_id'] == 3) { // if order status accepted/processesing

                                        if ($orderedData['delivery_type'] == 1 ) { // if delivery type is self integration

                                            // ====== steps and processes after order is accepted by seller ====== 

                                            $deliveryDtls = $Order->deliveryDtlsByOrdId($orderedData['orders_id']);

                                            // if ($orderedData['delivery_type'] == 1) {
                                                
                                                if($deliveryDtls['waiting_time'] == null){
                                                
                                                ?>

                                        <p class="text-center bg-primary text-light fw-bold my-2 py-1">Please Wait for
                                            seller integration</p>
                                        <p class="text-center fw-normal cursor_pointer" data-bs-toggle="modal"
                                            data-bs-target="#detailsModal">
                                            Click here to see the details you have shared.
                                        </p>


                                        <!-- Details Modal Start -->
                                        <div class="modal fade" id="detailsModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Integration
                                                            Sharing Details</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                             foreach ($deliveryDtls as $key => $value) {
                                                                 if ($value != null || $value != '') {
                                                                     if ($key != 'id' && $key != 'updated_by' && $key != 'order_status_id' && $key != 'accepted_on') {

                                                                         if ($key == 'orders_id') $value = '#'.$value;
                                                                         if ($key == 'updated_on') $value = $dateUtil->fullDateTimeText($value);
                                                                            
                                                                         echo '<div>
                                                                                 <laber>'.$key.' :</laber><br>
                                                                                 <p class="fw-semibold">'.$value.'</p>
                                                                             </div>';
                                                                     }
                                                                 }
                                                             }
                                                             ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Details Modal End -->

                                        <?php
                                                }else{
                                                ?>
                                        <div class="order_action_bx">
                                            <div class="m-auto dtls_bx">
                                                <h3 class="text-center">Client Domain Account Details</h3>

                                                <label class="fw-bold">Domain Provider</label>
                                                <p class="fw-normal">
                                                    <span id="domain_provider">
                                                        <?php echo $deliveryDtls['domain_provider'];?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('domain_provider', 'domain_provider')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>

                                                <label class="fw-bold">Domain Email</label>
                                                <p class="fw-normal">
                                                    <span id="domain_email">
                                                        <?php echo $deliveryDtls['domain_email'];?>
                                                    </span>
                                                    <small data-bs-toggle="modal" data-bs-target="#editModal"
                                                        onclick="editSingleData('domain_email', 'domain_email')"
                                                        class="ms-2 text-danger cursor_pointer">
                                                        <i class="fa-light fa-pen-to-square"></i>
                                                        Edit
                                                    </small>
                                                </p>
                                            </div>

                                            <div class="m-auto mt-4 form_bx">
                                                <p class="fw-bold">Domain Email <span class="text-danger">Wrong?</span>
                                                </p>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control"
                                                        id="domain_authorizatrion_code"
                                                        value="<?php echo $deliveryDtls['domain_authorizatrion_code'];?>"
                                                        readonly>
                                                    <div id="domain_authorizatrion_code_copy"
                                                        onclick="copyText('domain_authorizatrion_code', this.id)"
                                                        class="clipboard icon">
                                                    </div>
                                                </div>


                                                <p class="fw-bold mt-2">Website File Link <span
                                                        class="text-danger">Wrong?</span></p>
                                                <div class="text-wrap">
                                                    <input type="text" class="form-control" id="website_file_link"
                                                        value="<?php echo $deliveryDtls['website_file_link'];?>"
                                                        readonly>
                                                    <div id="website_file_link_copy"
                                                        onclick="copyText('website_file_link', this.id)"
                                                        class="clipboard icon">
                                                    </div>
                                                </div>

                                                <div class="mt-4 text-center">
                                                    <button type="submit" class="btn btn-primary">Verified</button>
                                                </div>

                                            </div>
                                        </div>
                                        <?php
                                                }
                                        
                                        }elseif($orderedData['delivery_type'] == 2) { // if delivery type is Leelija integration
                                        ?>
                                        <p class="text-light text-primary"></p>
                                        <?php
                                        }else {   //if delivery type not selected yet
                                        ?>

                                        <div class="text-center">
                                            <p class="bg-primary text-light fw-bold my-2">
                                                Your order has been accepted, Please Share require details
                                            </p>
                                        </div>

                                        <!-- Integration Buttons Section Start-->
                                        <div class="row m-auto butnrowss">
                                            <div class="col-md-12 removingpadding">
                                                <div class="buttonsinfo">
                                                    <?php
                                                        $deliveryType = $Order->allDeliveryType();
                                                        foreach($deliveryType as $delivery){
                                                        ?>
                                                    <button class="btn managed-link-btn" data-bs-toggle="modal"
                                                        data-bs-target="#modal-<?php echo $delivery['integration_id']; ?>">
                                                        <?php 
                                                        echo $delivery['integration_name']; 
                                                        if ($delivery['cost'] > 0) {
                                                            echo " ( $".$delivery['cost']." )";
                                                        } ?>
                                                    </button>



                                                    <!-- Modal Start   -->
                                                    <div class="modal fade"
                                                        id="modal-<?php echo $delivery['integration_id'] ?>"
                                                        tabindex="-1" aria-labelledby="exampleModalLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h1 class="modal-title fs-5" id="exampleModalLabel">
                                                                        New Domain Account Details
                                                                    </h1>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="mb-3">
                                                                        <label for="domainProvider" class="form-label">
                                                                            Transfer To Which Domain Provider
                                                                        </label>
                                                                        <input type="email" class="form-control"
                                                                            id="domainProvider"
                                                                            placeholder="www.example.com">
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="emailAddress" class="form-label">
                                                                            Account Email Address
                                                                        </label>
                                                                        <input type="email" class="form-control"
                                                                            id="emailAddress"
                                                                            placeholder="name@example.com">
                                                                    </div>

                                                                    <div class="text-center">
                                                                        <button type="button"
                                                                            class="btn btn-primary m-auto" name="update"
                                                                            onclick="selfIntegrate()">
                                                                            Submit Details
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal End  -->

                                                    <?php
                                                        }
                                                        ?>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Integration Buttons Section End-->

                                        <?php
                                        }//eof delivery type cheaking conditions

                                    }elseif($orderedData['orders_status_id'] == 2){ // if order status pending
                                        echo "Order Pending";
                                    }elseif($orderedData['orders_status_id'] == 1){ // if order status delivered
                                        echo "delivered";
                                    }elseif($orderedData['orders_status_id'] == 0){ // if order status failed
                                        echo 'Order Failed';
                                    }elseif($orderedData['orders_status_id'] == 4){ // if order status ordered
                                        echo '<p class="text-center bg-primary text-light fw-bold my-2 py-1">Please Wait for
                                                seller Response.</p>';
                                    }elseif($orderedData['orders_status_id'] == 5){ // if order status Completed
                                        echo 'Order Completed';
                                    }elseif($orderedData['orders_status_id'] == 6){ // if order status hold
                                        echo 'Order Hold';
                                    }else{
                                        echo "Order Failed or something may wrong!";
                                    }
                                    ?>

                                    </section>

                                </div>
                            </section>
                            <!-- Products Order End -->

                            <?php
                                    }
                                }

                                ?>

                        </div>

                    </div>

                </div>
                <!-- //end display table-->
            </div>
        </div>




        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="tost" class="toast text-bg-primary " role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="<?= URL ?>images/icons/tick.png" class="rounded me-2" alt="...">
                    <strong id="toast-heading" class="me-auto">Text Copied!</strong>
                    <small id="toast-time" class="text-muted toast-time">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div id="toast-msg" class="toast-body">
                    See? Just like this.
                </div>
            </div>
        </div>



        <!-- js-->
        <script src="<?= URL ?>js/jquery-2.2.3.min.js"></script>
        <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
        </script>

        <!-- Banner text Responsiveslides -->
        <script src="<?= URL ?>js/responsiveslides.min.js"></script>

        <!-- start-smooth-scrolling -->
        <script src="<?= URL ?>js/move-top.js"></script>
        <script src="<?= URL ?>js/easing.js"></script>
        <script src="<?= URL ?>js/script.js"></script>

        <script>
        const selfIntegrate = () => {

            var domainProvider = $('#domainProvider').val();
            urlIs = validateUrl(domainProvider)
            if (urlIs == false) {
                return false;
            }

            var emailAddress = $('#emailAddress').val();
            emailIs = ValidateEmail(emailAddress);
            if (emailIs == false) {
                return false
            };


            let urlString = window.location.href;
            let paramString = urlString.split('?')[1];
            let queryString = new URLSearchParams(paramString);
            for (let pair of queryString.entries()) {
                if (pair[0] = 'data') {
                    // console.log("Value is:" + pair[1]);
                    orderId = pair[1];
                    break;
                }
            }
            // alert(orderId);
            var action = 'self-integration';
            var orderId = orderId;
            $.ajax({
                url: "ajax/update-products-delivery.php",
                method: "POST",
                data: {
                    action: action,
                    orderId: orderId,
                    domainProvider: domainProvider,
                    emailAddress: emailAddress
                },
                success: function(data) {
                    // alert(data)
                    if (data.includes('submited')) {

                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Details Submited!',
                            showConfirmButton: false,
                            timer: 1500
                        }).then((result) => {
                            location.reload();
                        });
                    } else {
                        Swal.fire(
                            'Failed!',
                            'Failed to submit details!',
                            'error'
                        )
                    };

                }
            });
        }


        const copyText = (fieldId, btnId) => {

            var text = document.getElementById(fieldId);
            text.select();
            document.execCommand('copy');

            const toastTrigger = document.getElementById(btnId);
            const toastLiveExample = document.getElementById('tost');

            document.getElementById("toast-time").innerText = new Date(new Date().getTime()).toLocaleTimeString();
            document.getElementById("toast-heading").innerText = `Text Copied!`;
            document.getElementById("toast-msg").innerHTML = `<b>${text.value}</b><br> Copied to Clipboard`;

            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
        }
        </script>
        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="<?= URL ?>js/bootstrap.js"></script> -->
        <script src="<?= URL ?>plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
        <script src="<?= URL ?>plugins/sweetalert/sweetalert2.all.js"></script>
        <!-- Switch Customer Type -->
        <script src="<?= URL ?>js/customerSwitchMode.js"></script>
</body>

</html>