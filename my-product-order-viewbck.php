<?php
session_start();
//var_dump($_SESSION);
//include_once('checkSession.php');
require_once "_config/dbconnect.php";
require_once "_config/dbconnect.trait.php";

require_once "includes/constant.inc.php";
require_once "classes/encrypt.inc.php";
// require_once "classes/date.class.php";
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
    header("Location: dashboard.php");
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
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' />

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

        .buttonsinfo {
            margin: 1rem 0 0 !important;
        }

        .butnrowss {
            display: inline-grid;
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
        /* background-color: #fff; */
    }

    @media (max-width:360px) {
        .product_image {
            width: 100%;
        }

        .managed-link-btn {
            padding: 12px 10px 12px 10px;
            width: -webkit-fill-available;
        }

        .removingpadding {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }
    }

    .btn-check:focus+.btn,
    .btn:focus {
        color: #F7A546 !important;

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
                                                    src="images/domains/<?php echo $OrdrdProduct[10]?>" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- actions Section start -->
                                    <section
                                        class="d-flex flex-column border-top  border-primary pb-3 px-2 bg_ord_footer">
                                        <?php
                                        if ($orderedData['orders_status_id'] == 3) {
                                            echo '';
                                        }
                                        ?>
                                        <div class="text-center">
                                            <p class="bg-primary text-light fw-bold my-2">Your order has been accepted,
                                                Please Share
                                                require details</p>
                                        </div>


                                        <div class="row m-auto butnrowss">
                                            <div class="col-md-6 removingpadding">
                                                <div class=" buttonsinfo ">
                                                    <button type="button" class="btn managed-link-btn "
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">Self
                                                        Integration</button>
                                                </div>
                                            </div>
                                            <div class="col-md-6 removingpadding">
                                                <div class=" buttonsinfo ">
                                                    <button type="button" class="btn managed-link-btn "
                                                        data-bs-toggle="modal" data-bs-target="#exampleModal">Leelija
                                                        Integration($10) </button>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- <div class="card shadow col-md-6 m-auto my-3">
                                            <div class="card-body m-auto py-4">
                                                <button class="btn btn-primary mx-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Self Integration</button>
                                                <button class="btn btn-primary mx-3" data-bs-toggle="modal"
                                                    data-bs-target="#exampleModal">Leelija Integration ($10)</button>

                                            </div>
                                        </div> -->

                                    </section>

                                </div>
                            </section>
                            <!-- Products Order End -->



                            <!-- Modal Start   -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">New Domain Account
                                                details
                                            </h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label for="domainProvider" class="form-label">Transfer To
                                                    Which Domain Provider</label>
                                                <input type="email" class="form-control" id="domainProvider"
                                                    placeholder="www.example.com">
                                            </div>

                                            <div class="mb-3">
                                                <label for="emailAddress" class="form-label">Account Email
                                                    address</label>
                                                <input type="email" class="form-control" id="emailAddress"
                                                    placeholder="name@example.com">
                                            </div>

                                            <div class="text-center">
                                                <button type="button" class="btn btn-primary m-auto" name="update"
                                                    onclick="selfIntegrate()">Submit Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Modal End  -->

                            <?php
                                    }
                                }

                                ?>

                        </div>

                    </div>

                </div>
                <!-- //end display table-->

                <!-- Footer -->
                <?php require_once 'partials/footer.php'; ?>
                <!-- /Footer -->
            </div>
        </div>
        <!-- js-->
        <script src="js/jquery-2.2.3.min.js"></script>
        <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
        </script>

        <!-- Banner text Responsiveslides -->
        <script src="js/responsiveslides.min.js"></script>

        <!-- start-smooth-scrolling -->
        <script src="js/move-top.js"></script>
        <script src="js/easing.js"></script>
        <script src="js/script.js"></script>

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
            var action = 'accept-order';
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
        </script>
        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="js/bootstrap.js"></script> -->
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
        <script src="plugins/sweetalert/sweetalert2.all.js"></script>
        <!-- Switch Customer Type -->
        <script src="js/customerSwitchMode.js"></script>
</body>

</html>