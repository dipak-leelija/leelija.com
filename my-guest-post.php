<?php
session_start();
//var_dump($_SESSION);
//include_once('checkSession.php');
require_once "_config/dbconnect.php";

require_once "includes/constant.inc.php";
require_once "classes/encrypt.inc.php";
require_once "classes/date.class.php";
require_once "classes/error.class.php";
require_once "classes/search.class.php";
require_once "classes/customer.class.php";
require_once "classes/login.class.php";
require_once "classes/domain.class.php";

require_once "classes/utility.class.php";
require_once "classes/gp-order.class.php";
require_once "classes/gp-package.class.php";

require_once "classes/content-order.class.php";
require_once "classes/order.class.php";
require_once "classes/orderStatus.class.php";


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$Domain			= new Domain();
$ContentOrder   = new ContentOrder();
$OrderStatus    = new OrderStatus();

$utility		= new Utility();
// $uMesg 			= new MesgUtility();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
$gp				  = new Gporder();
$GPpackage        = new GuestPostpackage(); 
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
	header("Location: app.client.php");
}

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
    <link rel="stylesheet" href="css/order-table.css">
    <link rel="stylesheet" href="css/leelija.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/order-list.css" rel='stylesheet' type='text/css' />
    <link href="css/my-orders.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="plugins/data-table/style.css">

    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <style>
    @media (min-width:768px) {
        .client_profile_dashboard_right {
            padding-right: 2rem !important;
        }

        .table-responsive {
            overflow-x: auto !important;
            -webkit-overflow-scrolling: touch !important;
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
                           

                            <!-- PRODUCTS ORDERS section starts -->
                            <div class="lists_of_blogs  montserrat-font py-4">
                                <div class="">
                                    <div class=" display-table">
                                        <div class="row ">
                                            <!--Row start-->
                                            <div>
                                                <!--Content sec start-->
                                                <div class="features your_blog_lists" id="features">
                                                    <!--Features Content start-->
                                                    <div class="wrap">
                                                        <!--Wrap start-->
                                                        <h2
                                                            class="title color-blue font-weight-bold text-center text-uppercase pt-4 pb-0">
                                                            PRODUCTS ORDERS</h2>

                                                            
                                                        <div class="features_grids table-responsive">
                                                            <table
                                                                class="table table-striped product-orders-tables table-hover  datatable">
                                                                <thead style="color: white;background:#00008bbf;">
                                                                    <tr>
                                                                        <th>Sl. No.</th>
                                                                        <th>Images</th>
                                                                        <th>Order Id</th>
                                                                        <th>Domian</th>
                                                                        <th class="">Order Date</th>
                                                                        <th class="">Action</th>
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
                                                                        <td><img src="images/domains/<?php echo $productWise['dimage'];?>"
                                                                                alt="Dipak"
                                                                                class="product-table-img-div">
                                                                        </td>
                                                                        <td style="width:100px;font-weight:500;">
                                                                        <?php echo '#'.$orderWise['orders_id'];?></td>
                                                                        <td><?php echo $productWise['domain'];?></td>
                                                                        <td class="text-center"><?php echo date("d.m.Y - h:i a", strtotime($orderWise['added_on']));?></td>
                                                                        <?php 

                                                                        $productOrderViewUrl = '='.url_enc($orderWise['orders_id']).'&pdata='.url_enc($productId);
                                                                    ?>
                                                                        <td>
                                                                            <a href="product-order-view.php?data=<?php echo $productOrderViewUrl;?>"
                                                                                title="Edit"><i
                                                                                    class="fa-solid fa-pen-to-square"></i>
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
                                                            </table>
                                                        </div>
                                                        <!--end features grid and responsive table-->
                                                    </div>
                                                    <!--Wrap End-->
                                                </div>
                                                <!--Features Content end-->
                                            </div>
                                            <!--Content end start-->
                                        </div>
                                        <!--Row end-->
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
                <!-- //end display table-->

            </div>
        </div>
        <!-- js-->
        <!-- <script src="js/jquery-2.2.3.min.js"></script> -->
        <script src="plugins/jquery-3.6.0.min.js"></script>

        <!-- js-->
        <!-- Scrolling Nav JavaScript -->
        <!-- <script src="js/scrolling-nav.js"></script> -->
        <script>
        $(document).ready(function() {
            $('[data-toggle="offcanvas"]').click(function() {
                $("#navigation").toggleClass("hidden-xs");
            });
        });
        </script>


        <!-- //fixed-scroll-nav-js -->
        <script>
        $(window).scroll(function() {
            if ($(document).scrollTop() > 70) {
                $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
            } else {
                $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
            }
        });
        </script>
        <!-- Banner text Responsiveslides -->
        <script src="js/responsiveslides.min.js"></script>
        <script>
        // You can also use"$(window).load(function() {"
        // $(function() {
        //     // Slideshow 4
        //     $("#slider3").responsiveSlides({
        //         auto: true,
        //         pager: true,
        //         nav: false,
        //         speed: 500,
        //         namespace: "callbacks",
        //         before: function() {
        //             $('.events').append("<li>before event fired.</li>");
        //         },
        //         after: function() {
        //             $('.events').append("<li>after event fired.</li>");
        //         }
        //     });

        // });
        </script>
        <!-- //Banner text  Responsiveslides -->
        <!-- start-smooth-scrolling -->
        <script src="js/move-top.js"></script>
        <script src="js/easing.js"></script>
        <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();

                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 1000);
            });
        });
        </script>
        <!-- //end-smooth-scrolling -->
        <!-- smooth-scrolling-of-move-up -->
        <!-- <script>
        $(document).ready(function() {
            /*
             var defaults = {
            	 containerID: 'toTop', // fading element id
            	 containerHoverID: 'toTopHover', // fading element hover id
            	 scrollSpeed: 1200,
            	 easingType: 'linear'
             };
             */

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
        </script> -->
        <!-- <script>
        $(document).ready(function() {
            var readURL = function(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function(e) {
                        $('.profile-pic').attr('src', e.target.result);
                    }

                    reader.readAsDataURL(input.files[0]);
                }
            }


            $(".file-upload").on('change', function() {
                readURL(this);
            });

            $(".upload-button").on('click', function() {
                $(".file-upload").click();
            });
        });
        </script> -->
        <!-- <script src="js/SmoothScroll.min.js"></script> -->
        <!-- //smooth-scrolling-of-move-up -->
        <!-- Bootstrap Core JavaScript -->
        <script src="js/customerSwitchMode.js"></script>



        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>



        <script src="plugins/data-table/simple-datatables.js"></script>

        <script src="plugins/tinymce/tinymce.js"></script>

        <script src="plugins/main.js"></script>
</body>

</html>