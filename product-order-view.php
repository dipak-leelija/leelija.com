<?php
session_start();
require_once "_config/dbconnect.php";

require_once "classes/encrypt.inc.php";
require_once "includes/constant.inc.php";

require_once "classes/date.class.php";
require_once "classes/error.class.php";
require_once "classes/search.class.php";
require_once "classes/customer.class.php";
require_once "classes/login.class.php";
require_once "classes/domain.class.php";
require_once "classes/blog_mst.class.php";

//require_once("../classes/front_photo.class.php");
require_once "classes/order.class.php";
require_once "classes/orderStatus.class.php";
require_once "classes/utility.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Domain			= new Domain();
$BlogMst        = new BlogMst();
$OrderStatus    = new OrderStatus();

$utility		= new Utility();
$Order          = new Order();
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
	header("Location: app.client.php");
}
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
    <title>Product | <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <link rel="icon" href="images/logo/favicon.png" type="image/png">


    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/icons-all.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/icons-sharp.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.2.0/css/sharp-solid.css">

    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/leelija.css">
    <link href="css/order-list.css" rel='stylesheet' type='text/css' />
    <link href="css/my-orders.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />

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
        /* border-radius: 10rem; */
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

        .product_image {
            width: 60%;
        }

        .product_image_sec_right {
            margin: 2rem;
        }
    }
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="edit_profile">
            <div class="container-fluid1">
                <div class=" display-table">
                    <div class="row ">
                        <!--Row start-->
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">
                            <div class="client_profile_dashboard_left">
                                <?php include("dashboard-inc.php");?>
                            </div>
                        </div>
                        <div class="col-md-9  display-table-cell v-align client_profile_dashboard_right">

                            <!-- Products Order Start -->
                            <section class="my-gp-order">
                                <div class="p-kage-de-tails">

                                    <?php
                                $orderedData = $Order->getFullOrderDetailsById($ordId);
                                if ($prodId == $orderedData['product_id']) {
                                    $OrdrdProduct = $Domain->showDomainsById($prodId);
                                    if ($OrdrdProduct > 0) {
                                    ?>
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
                                                                    <div class="col-6 ps-0">DA </div>
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
                                                                    <div class="col-6 ps-0">PA </div>
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
                                                                    <div class="col-6 ps-0">CF </div>
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
                                                                    <div class="col-6 ps-0">TF </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[5];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6 col-xm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0">Alexa Traffic </div>
                                                                    <div class="col-4 "><?php echo $OrdrdProduct[6];?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-12 col-sm-6 col-xm-6">
                                                                <div class="row">
                                                                    <div class="col-2">
                                                                        <td><i
                                                                                class="fa-sharp fa-solid fa-forward me-1"></i>
                                                                    </div>
                                                                    <div class="col-6 ps-0 pe-0">Organic Traffic </div>
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
                                                                    <div class="col-6 ps-0">
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
                                                            <td><?php echo $dateUtil->fullDateTimeText($orderedData['added_on']); ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                            </div>
                                            <!-- Details section End -->

                                        </div>
                                        <div class="col-md-4">
                                            <div class="product_image_sec_right">
                                                <img class="product_image"
                                                    src="images/domains/<?php echo $OrdrdProduct[10]?>" alt="">
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
                                                        <small
                                                            onclick="editSingleData('waitingTimeEdit', 'waiting_time')"
                                                            data-bs-toggle="modal" data-bs-target="#editModal"
                                                            class="ms-2 text-danger cursor_pointer">
                                                            <i class="fa-light fa-pen-to-square"></i>
                                                            Edit
                                                        </small>
                                                    </p>


                                                    <label class="fw-bold mt-2">Last Update </label>
                                                    <p class="fw-normal">
                                                        <span
                                                            id="waitingTimeEdit"><?php echo $dateUtil->fullDateTimeText($deliveryDtls['updated_on']); ?>
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



                                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            Launch demo modal
                                        </button>
                                        <div class="modal fade" id="exampleModal" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        ...
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="button" class="btn btn-primary">Save
                                                            changes</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> -->
                                    </section>
                                    <!-- actions Section end -->

                                    <?php
                                    }
                                }

                                ?>
                                </div>
                            </section>
                            <!-- Products Order End -->


                            <!-- Faq Section Start  -->
                            <h1>Faq</h1>
                            <div class="accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true"
                                            aria-controls="collapseOne">
                                            Accordion Item #1
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse"
                                        aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the first item's accordion body.</strong> It is shown by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseTwo"
                                            aria-expanded="false" aria-controls="collapseTwo">
                                            Accordion Item #2
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse"
                                        aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the second item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Accordion Item #3
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                            <strong>This is the third item's accordion body.</strong> It is hidden by
                                            default, until the collapse plugin adds the appropriate classes that we use
                                            to style each element. These classes control the overall appearance, as well
                                            as the showing and hiding via CSS transitions. You can modify any of this
                                            with custom CSS or overriding our default variables. It's also worth noting
                                            that just about any HTML can go within the <code>.accordion-body</code>,
                                            though the transition does limit overflow.
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Faq Section End  -->

                        </div>

                    </div>

                </div>
                <!-- //end display table-->
            </div>
        </div>



        <!-- Modal -->
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editModalLabel">Edit Details</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="editContent">
                        <!-- Edit Contents Goes Here  -->
                        <div class="mb-3">
                            <label for="editInp" class="form-label">Email address</label>
                            <input type="text" class="form-control" id="editInp">
                            <input type="hidden" class="form-control" id="inpCol">
                        </div>
                        <div class="mb-3 text-center">
                            <button class="btn btn-primary btn-sm" id="updateBtn"
                                onclick="update(<?php echo $orderedData['orders_id']; ?>, 'inpCol', 'editInp')">Update</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <div class="toast-container position-fixed top-0 end-0 p-3">
            <div id="tost" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <img src="images/icons/tick.png" class="rounded me-2" alt="...">
                    <strong id="toast-heading" class="me-auto">Text Copied!</strong>
                    <small id="toast-time" class="text-muted toast-time">just now</small>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div id="toast-msg" class="toast-body">
                    See? Just like this.
                </div>
            </div>
        </div>


        <script>
        const acceptProductOrder = () => {

            Swal.fire({
                title: 'Are you sure?',
                text: "You want to accept this order!",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Accept'
            }).then((result) => {
                if (result.isConfirmed) {

                    let urlString = window.location.href;
                    let paramString = urlString.split('?')[1];
                    let queryString = new URLSearchParams(paramString);
                    for (let pair of queryString.entries()) {
                        if (pair[0] = 'data') {
                            orderId = pair[1];
                            break;
                        }
                    }

                    var action = 'accept-order';
                    var orderId = orderId;
                    $.ajax({
                        url: "ajax/accept-product-order.ajax.php",
                        method: "POST",
                        data: {
                            action: action,
                            orderId: orderId
                        },
                        success: function(data) {
                            // alert(data);
                            if (data.includes('accepted')) {

                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Order Accepted Succesfully!',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then((result) => {
                                    location.reload();
                                });

                            }
                        }
                    });

                }
            })
        }

        const rejectProductOrder = () => {

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success'
                    )
                }
            })
        }

        const copyText = (fieldId, btnId) => {

            var text = document.getElementById(fieldId);
            text.select();
            document.execCommand('copy');

            const toastTrigger = document.getElementById(btnId);
            const toastLiveExample = document.getElementById('tost');

            toastLiveExample.classList.add("text-bg-primary");
            document.getElementById("toast-time").innerText = new Date(new Date().getTime()).toLocaleTimeString();
            document.getElementById("toast-heading").innerText = `Text Copied!`;
            document.getElementById("toast-msg").innerHTML = `<b>${text.value}</b><br> Copied to Clipboard`;

            const toast = new bootstrap.Toast(toastLiveExample)

            toast.show()
        }


        const sendData = (ordrId) => {

            sec = document.getElementById('sendDataSection');
            allinp = sec.querySelectorAll('input');
            allSelect = sec.querySelectorAll('select');


            for (let i = 0; i < allinp.length; i++) {
                const element = allinp[i];
                // alert(element.value)
                if (element.value == '') {
                    element.style.border = "2px solid red";
                    alert("Data Can Not Be Blank!");
                    return false;
                    break;
                } else {
                    element.style.border = "1px solid #0673BA5c";
                    if (element.id == 'drive-url') {
                        // alert('Url Box');
                        let url;
                        try {
                            url = new URL(element.value);
                            element.style.border = "1px solid #0673BA5c";
                        } catch (_) {
                            alert("Invalid Url Provided")
                            element.style.border = "2px solid red";
                            return false;
                        }
                    }
                }
            } //end of for loop

            for (let i = 0; i < allSelect.length; i++) {
                const selectElement = allSelect[i];
                // alert(element.value)
                if (selectElement.value == '') {
                    selectElement.style.border = "2px solid red";
                    alert("Data Can Not Be Blank!");
                    return false;
                    break;
                } else {
                    selectElement.style.border = "1px solid #0673BA5c";
                }
            } //end of for loop


            domainCode = allinp[0].value;
            websiteFile = allinp[1].value;
            dbFile = allinp[2].value;
            dbName = allinp[3].value;
            dbUser = allinp[4].value;
            dbPass = allinp[5].value;

            waitingTime = allSelect[0].value;

            var action = 'sendData';
            $.ajax({
                url: "ajax/send-order-data.php",
                method: "POST",
                data: {
                    action: action,
                    ordrId: ordrId,
                    domainCode: domainCode,
                    websiteFile: websiteFile,
                    dbFile: dbFile,
                    dbName: dbName,
                    dbUser: dbUser,
                    dbPass: dbPass,
                    waitingTime: waitingTime
                },
                success: function(data) {
                    alert(data);
                    if (data.includes('updated')) {
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

                        const toastTrigger = document.getElementById(data);
                        const toastLiveExample = document.getElementById('tost');

                        toastLiveExample.classList.add("text-bg-danger");
                        document.getElementById("toast-time").innerText = new Date(new Date().getTime())
                            .toLocaleTimeString();
                        document.getElementById("toast-heading").innerText = `Failed to Update!`;
                        document.getElementById("toast-msg").innerHTML =
                            `<b>Something is wrong!</b><br> Details can not updated!`;

                        const toast = new bootstrap.Toast(toastLiveExample)

                        toast.show()

                    }
                }
            });

        } // sendData



        const editSingleData = (tagId, columnName) => {

            let columnValue = document.getElementById(tagId).innerText;

            document.getElementById('editInp').value = columnValue.trim();
            document.getElementById('inpCol').value = columnName.trim();

        }


        const update = (orderId, columnNameId, columnValueId) => {

            let colName = document.getElementById(columnNameId).value.trim();
            let colValue = document.getElementById(columnValueId).value.trim();


            if (colName == 'website_file_link') {

                if (colValue == '') {
                    alert("File Url Can Not Be Blank!");
                    return false;
                } else {
                    let url;
                    try {
                        url = new URL(colValue);
                    } catch (_) {
                        alert("Invalid Url Provided")
                        return false;
                    }
                }

            }



            var action = 'updateSingleData';
            $.ajax({
                url: "ajax/update-products-delivery.php",
                method: "POST",
                data: {
                    action: action,
                    orderId: orderId,
                    colName: colName,
                    colValue: colValue
                },
                success: function(data) {
                    // alert(data);
                    if (data.includes('updated')) {
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Details Updated!',
                            showConfirmButton: false,
                            timer: 1500

                            // const toastTrigger = document.getElementById(data);
                            // const toastLiveExample = document.getElementById('tost');

                            // document.getElementById("toast-time").innerText = new Date(
                            //     new Date().getTime()).toLocaleTimeString();
                            // document.getElementById("toast-heading").innerText = `Success!`;
                            // document.getElementById("toast-msg").innerHTML =
                            //     `<b>Request Data Updated!</b>`;

                            // const toast = new bootstrap.Toast(toastLiveExample)

                            // toast.show();
                        }).then((result) => {
                            location.reload();
                        });
                    }
                }
            });


        }
        </script>
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.bundle.js"></script>
        <script src="plugins/sweetalert/sweetalert2.all.js"></script>
        <script src="plugins/jquery-3.6.0.min.js"></script>
        <!-- Switch Customer Type -->
        <script src="js/customerSwitchMode.js"></script>

        <script>
        const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
        const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));
        </script>
</body>

</html>