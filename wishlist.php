<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
session_start();

// var_dump($_SESSION);
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/customer.class.php");
require_once("classes/wishList.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once "classes/wishList.class.php";

/* INSTANTIATING CLASSES */
$customer		= new Customer();
$blogMst		= new BlogMst();
$utility		= new Utility();
$WishList       = new WishList();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);
if($cusId == 0){
    header("Location: index.php");
}

if($cusDtl[0] == 1){
    header("Location: dashboard.php");
}
 
$userWishLists = $WishList->showUserWishes($_SESSION['userid']);

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>User Dashboard | Dashboard :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- Bootstrap Core CSS -->
    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <!-- <link rel="stylesheet" href="plugins/bootstrap/css/bootstrap.css"> -->
    <link href="plugins/bootstrap-5.2.0/css/bootstrap.css" rel='stylesheet' type='text/css' />
    <!-- <link href="plugins/fontawesome-6.1.1/css/all.css" rel='stylesheet' type='text/css' /> -->
    <!-- <link href="plugins/fontawesome-6.1.1/icons.css" rel='stylesheet' type='text/css' />
    <link href="plugins/fontawesome-6.1.1/icons-sharp.css" rel='stylesheet' type='text/css' /> -->


    <link href="https://site-assets.fontawesome.com/releases/v6.2.0/css/all.css" rel='stylesheet' type='text/css' />


    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="css/wishlist.css" rel='stylesheet' type='text/css' />

    <!-- //Custom Theme files -->

    <!--//webfonts-->
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once 'partials/navbar.php' ?>
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

                                <!-- <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" /> -->
                                <!-- Customer Switch Mode -->
                                <?php include("dashboard-inc.php");?>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-9 mt-4 pe-5 display-table-cell v-align client_profile_dashboard_right">
                            <?php
                                $x=1;
                                if($userWishLists !=null){
                            ?>
                            <div class="wishListtable m-auto">
                                <div class="table-responsive" id="insideTable">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Site Name</th>
                                                <th scope="col">Niche</th>
                                                <th scope="col">Domain Authority</th>
                                                <th scope="col">Trust Flow</th>
                                                <th scope="col">Link Type</th>
                                                <th scope="col">Price($)</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                            foreach($userWishLists as $singleWish) { 
                                        ?>
                                            <tr>
                                                <td><?php echo $x; $x++?></td>
                                                <td><?php echo $singleWish['domain'];?></td>
                                                <td><?php echo $singleWish['niche'];?></td>
                                                <td><?php echo round($singleWish['da']);?></td>
                                                <td><?php echo round($singleWish['tf']);?></td>
                                                <td><?php echo $singleWish['follow'];?></td>
                                                <td><?php echo $singleWish['cost'];?></td>
                                                <td>
                                                    <a href="webSiteDetailsSingle.php?id=<?php echo $singleWish['blog_id'] ?>"
                                                        class="badge text-bg-success">
                                                        <span>
                                                            <i class="fas fa-shopping-bag"></i>
                                                        </span> Buy
                                                    </a>
                                                    <a href="javascript:void()"
                                                        id="<?php echo $singleWish['blog_id'];?>"
                                                        onclick="delWish(this);" class="badge text-bg-danger">
                                                        <span>
                                                            <i class="fas fa-minus-circle"></i>
                                                        </span> Remove
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
                                            } 
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php
                                }else {
                                    ?>
                                    <div class="border p-4 text-danger text-center empty_bx">
                                        <p class="emp_icon">
                                        <i class="fa-solid fa-heart-circle-plus"></i>
                                        </p>
                                        <p>Wishlist Empty!</p>
                                    </div>
                                    <?php
                                }
                                ?>
                        </div>
                        <!--Row end-->
                    </div>
                </div>
                <!-- //end display table-->

                <!-- Footer -->
                <?php require_once 'partials/footer.php'; ?>
                <!-- /Footer -->
            </div>
        </div>
        <!-- <script src="js/jquery.min.js" type="text/javascript"></script> -->
        <!-- <script src="js/jquery-2.2.3.min.js"></script> -->
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js" type="text/javascript"></script>
        <script src="plugins/jquery-3.6.0.min.js" type="text/javascript"></script>
        <script src="plugins/sweetalert/sweetalert2.all.min.js" type="text/javascript"></script>
        <script src="js/ajax.js" type="text/javascript"></script>
        <script>
        const delWish = (t) => {

            Swal.fire({
                title: 'Are you sure?',
                text: "want to remove this item?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Remove'
            }).then((result) => {
                if (result.isConfirmed) {
                    blogId = t.id;
                    btn = t;

                    $.ajax({
                        url: "wishlistDataRemove.php",
                        type: "GET",
                        data: {
                            BlogId: blogId
                        },
                        success: function(data) {
                            // alert(data);
                            if (data) {
                                // alert(blogId)
                                // getElementById
                                $(`#${blogId}`).closest("tr").fadeOut();
                            } else {
                                // $("#error-message").html("Deletion Field !!!")
                                //     .slideDown();
                                // $("success-message").slideUp();
                                Swal.fire(
                                    'failed!',
                                    'Item Not Removed 😥.',
                                    'error'
                                )
                            }

                        }
                    });
                }
            })
            return false;
        }
        </script>
        <!-- js-->
        <!-- js-->



        <!-- //fixed-scroll-nav-js -->
        <script src="js/pageplugs/fixedNav.js"></script>

        <!-- //Banner text  Responsiveslides -->
        <!-- start-smooth-scrolling -->
        <!-- <script src="js/move-top.js"></script>
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
        </script> -->
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
        </script>-->

        <!-- <script src="js/SmoothScroll.min.js"></script> -->
        <!-- //smooth-scrolling-of-move-up -->
        <!-- Bootstrap Core JavaScript -->
        <!-- <script src="js/bootstrap.js"></script> -->
        <!-- Switch Customer Type -->
        <script src="js/customerSwitchMode.js"></script>
</body>

</html>