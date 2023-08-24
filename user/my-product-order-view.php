<?php
session_start();
require_once dirname(__DIR__)."/includes/constant.inc.php";
require_once ROOT_DIR."/includes/order-constant.inc.php";
require_once ROOT_DIR."_config/dbconnect.php";
require_once ROOT_DIR."classes/encrypt.inc.php";
require_once ROOT_DIR."classes/error.class.php";
require_once ROOT_DIR."classes/search.class.php";
require_once ROOT_DIR."classes/customer.class.php";
require_once ROOT_DIR."classes/date.class.php";
require_once ROOT_DIR."classes/login.class.php";
require_once ROOT_DIR."classes/domain.class.php";
require_once ROOT_DIR."classes/niche.class.php";
require_once ROOT_DIR."classes/order.class.php";
require_once ROOT_DIR."classes/orderStatus.class.php";
require_once ROOT_DIR."classes/utility.class.php";


/* INSTANTIATING CLASSES */
$DateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Domain			= new Domain();
$Niche          = new Niche();
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
                            <?php require_once USER_PATH."components/order-process.php" ?>

                        </div>
                    </div>
                </div>
                <!-- //end display table-->
            </div>
        </div>




        <div class="toast-container position-fixed bottom-0 end-0 p-3">
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
                success: function(response) {
                    // alert(response)
                    if (response.includes('submited')) {

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
                            response,
                            'error'
                        )
                    };

                }
            });
        }



        const VerifyCompleteOrder = () => {

            let urlString = window.location.href;
            let paramString = urlString.split('?')[1];
            let queryString = new URLSearchParams(paramString);
            for (let pair of queryString.entries()) {
                // console.log(pair);
                if (pair[0] = 'data') {
                    // console.log("Value is:" + pair[1]);
                    orderId = pair[1];
                    break;
                }
            }
            
            $.ajax({
                url: "ajax/update-order-process.php",
                method: "POST",
                data: {
                    action: 'verified',
                    orderId: orderId,
                },
                success: function(response) {
                    // alert(response)
                    if (response.includes('verified')) {

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
                            response,
                            'error'
                        )
                    };

                }
            });
        }


        const copyTextBS = (fieldId, btnId) => {

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