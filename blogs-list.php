<?php
session_start();
//include_once('checkSession.php');
// require_once("_config/dbconnect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once("classes/blog_mst.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

require_once "classes/wishList.class.php";

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$blogMst		= new BlogMst();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

$WishList		= new WishList();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);
$cusDtl		= $customer->getCustomerData($cusId);

if($cusId == 0){
	header("Location: index.php");
}

if($cusDtl[0] == 2){ 
	header("Location: dashboard.php");
}
	
//echo $cusId;exit;
$blogDtls		= $blogMst->ShowBlogApprData();

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title> Guest posting Blogs List| :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords"
        content="Best guest post sites list, Blogs list, Paid posting sites list, Guest Posting services, best guest post services, best health guest posting sites, best fashion blog" />
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>

    <!-- New Files  -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <link rel="stylesheet" href="plugins/data-table/style.css">
    <!-- <link rel="stylesheet" href="plugins"> -->

    <!-- End New Files  -->

    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/leelija.css">
    <!-- <link href="css/custom.css" rel='stylesheet' type='text/css' /> -->
    <link href="css/dashboard.css" rel='stylesheet' type='text/css' />
    <link href="css/blog-list.css" rel='stylesheet' type='text/css' />


    <!-- //Custom Theme files -->
    <link href="css/jquery-ui.css" rel="stylesheet">

    <!--webfonts-->
    <!--//webfonts-->
    <link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/themes/base/jquery-ui.css" rel="stylesheet"
        type="text/css" />

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">


    <style>
    .accordion {
        --bs-accordion-border-width: none;
        --bs-accordion-btn-focus-box-shadow: none;

    }

    .accordion-button:not(.collapsed) {
        color: var(--bs-accordion-active-color);
        background-color: white;

    }

    @media (max-width:312px) {
        .accordion-button {
            font-size: .9rem;
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
                    <!--Row start-->
                    <div class="row ">
                        <div class="col-md-3 hidden-xs display-table-cell v-align" id="navigation">

                            <div class="client_profile_dashboard_left">
                                <div class="logo text-center">
                                    <a href="edit-profile.php">
                                        <?php
                                            if($cusDtl[0][9] == ''){
                                        ?>
                                        <img src="images/icons/user.png" alt=""
                                            class="visible-xs visible-sm circle-logo">
                                        <?php
								}else{
							?>
                                        <img src="images/user/<?php echo $cusDtl[0][9] ?>"
                                            alt="<?php echo $cusDtl[0][5] ?>" class="visible-xs visible-sm circle-logo">
                                        <?php
								}
							?>
                                    </a>
                                    <p class="blod"><?php echo $cusDtl[0][5];?></p>
                                    <p><?php echo $cusDtl[0][14];?></p>
                                </div>


                                <div class="navi">
                                    <div class="accordion" id="accordionExample">
                                        <div class="accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button ps-0 collapsed" type="button"
                                                    data-bs-toggle="collapse" data-bs-target="#collapseOne"
                                                    style="color: var(--bs-link-color);" aria-expanded="false"
                                                    aria-controls="collapseOne"><i
                                                        class="fa-solid fa-magnifying-glass-plus pe-2"
                                                        style="font-size: 18px;"></i>
                                                    Advanced Search
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse "
                                                aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="list-group">
                                                        <h3>DA</h3>
                                                        <input type="hidden" id="hidden_minimum_da" value="0" />
                                                        <input type="hidden" id="hidden_maximum_da" value="100" />
                                                        <p id="da_show">1 - 100</p>
                                                        <div id="da_range"></div>
                                                    </div>
                                                    <div class="list-group">
                                                        <h3>TF</h3>
                                                        <input type="hidden" id="hidden_minimum_tf" value="0" />
                                                        <input type="hidden" id="hidden_maximum_tf" value="100" />
                                                        <p id="tf_show">1 - 100</p>
                                                        <div id="tf_range"></div>
                                                    </div>
                                                    <div class="list-group">
                                                        <h3>Niches</h3>
                                                        <div
                                                            style="height: 380px; overflow-y: auto; overflow-x: hidden;">
                                                            <?php
								$BlogMst  = $blogMst->ShowBlogNichMast();
								foreach($BlogMst as $row)
								{
								?>
                                                            <div class="list-group-item checkbox">
                                                                <label><input type="checkbox"
                                                                        class="common_selector niche"
                                                                        value="<?php echo $row['niche_name']; ?>">
                                                                    <?php echo $row['niche_name']; ?></label>
                                                            </div>
                                                            <?php
								}
							?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php if($cusDtl[0][0] == 2){?>
                                    <!-- Customer Switch Mode -->
                                    <div class="form-check form-switch  my-3">
                                        <input class="form-check-input" type="checkbox" id="toClient" />
                                        <label class="form-check-label" for="flexSwitchCheckDefault"
                                            style="color:#0673BA; font-weight: 600;">Become a
                                            Client</label>
                                    </div>

                                    <ul>

                                        <li class="active">
                                            <a href="dashboard.php"><i class="fa fa-home pe-2"
                                                    aria-hidden="true"></i><span
                                                    class="hidden-xs hidden-sm">Dashboard</span></a>
                                        </li>
                                        <li>

                                            <a href="my-guest-post.php"><i class="fas fa-cart-arrow-down"></i> <span
                                                    class="hidden-xs hidden-sm">Order</span></a>

                                        </li>

                                        <li>
                                            <a href="gblogs-list.php"><i class="fa fa-tasks pe-2"
                                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Guest
                                                    posting Blogs</span></a>
                                        </li>
                                        <li>
                                            <a href="add-blog.php"><i class="fa fa-plus pe-2"
                                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Add Blog
                                                    for Guest Post</span></a>
                                        </li>
                                        <li>
                                            <a href="my-domain.php"><i class="fa fa-globe pe-2"
                                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Web
                                                    Products Or Blogs</span></a>
                                        </li>
                                        <li>
                                            <a href="add-domain.php"><i class="fa fa-plus pe-2"
                                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Sell
                                                    Products or Blogs</span></a>
                                        </li>


                                        <li>
                                            <a href="#"><i class="fa fa-user pe-2" aria-hidden="true"></i><span
                                                    class="hidden-xs hidden-sm">Notification</span></a>
                                        </li>

                                        <li>
                                            <a href="edit-profile.php"><i class="fa fa-cog pe-2"
                                                    aria-hidden="true"></i><span
                                                    class="hidden-xs hidden-sm">Setting</span></a>
                                        </li>
                                        <li>
                                            <a href="logout.php" class="wishlistBlog"><i
                                                    class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <span>Logout</span></a>
                                        </li>
                                    </ul>
                                    <?php } else{?>


                                    <!-- ==================================================================================================     Side Navbar For Client ===================== 
                                    ============================================================-->
                                    <!-- Customer Switch Mode -->
                                    <div class="form-check form-switch  my-3">
                                        <input class="form-check-input" type="checkbox" id="toSeller" />
                                        <label class="form-check-label" for="flexSwitchCheckDefault"
                                            style="color:#0673BA; font-weight: 600;">Become a
                                            Seller</label>
                                    </div>
                                    <!-- Customer Switch Mode end-->

                                    <ul>
                                        <li class="active">
                                            <a href="app.client.php"><i class="fa fa-home pe-2"
                                                    aria-hidden="true"></i><span
                                                    class="hidden-xs hidden-sm">Dashboard</span></a>
                                        </li>
                                        <li>
                                            <a href="my-orders.php"><i class="text-primary fas fa-handshake pe-2"
                                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">My
                                                    Orders</span></a>
                                        </li>
                                        <li>
                                            <a href="blogs-list.php"><i class="fa fa-tasks pe-2"
                                                    aria-hidden="true"></i><span class="hidden-xs hidden-sm">Guest
                                                    posting Blogs</span></a>
                                        </li>


                                        <li>
                                            <a href="#"><i class="fa fa-user pe-2" aria-hidden="true"></i><span
                                                    class="hidden-xs hidden-sm">Notification</span></a>
                                        </li>

                                        <li>
                                            <a href="edit-profile.php"><i class="fa fa-cog pe-2"
                                                    aria-hidden="true"></i><span
                                                    class="hidden-xs hidden-sm">Setting</span></a>
                                        </li>
                                        <!-- <div><span class="wisListHeart"><i class="fas fa-heart"></i></span> <span><a href="">Wishlist</a></span></div> -->
                                        <li>
                                            <a href="wishlist.php" class="wishlistBlog"><span class="wisListHeart"><i
                                                        class="fas fa-heart"></i></span>
                                                <span>Wishlist</span></a>
                                        </li>
                                        <li>
                                            <a href="logout.php" class="wishlistBlog"><i
                                                    class="fa-solid fa-arrow-right-from-bracket"></i>
                                                <span>Logout</span></a>
                                        </li>

                                    </ul>
                                    <?php }?>
                                </div>
                                <hr>
                            </div>

                        </div>
                        <div class="col-md-9 mt-4  display-table-cell v-align client_profile_dashboard_right">

                            <!--Content sec start-->
                            <div class="table-responsive" id="insideTable">

                                <div class="container text-center text-primary loader">
                                    <img src="images/preloader/loading-preloader.gif" alt="">
                                    <h3>Loding List...</h3>
                                </div>

                            </div>

                        </div>
                        <!--Content end start-->

                    </div>
                    <!--Row end-->

                </div>
            </div>
            <!-- //end container sec -->

            <!-- Footer -->
            <?php require_once 'partials/footer.php' ?>
            <!-- /Footer -->
        </div>
        <!-- js-->
        <script src="plugins/jquery-3.6.0.min.js"></script>
        <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
        <script src="plugins/sweetalert/sweetalert2.all.js"></script>
        <!-- js-->
        <script src="js/jquery-ui.js"></script>
        <script src="js/cart.js"></script>
        <script src="js/jquery.min.js" type="text/javascript"></script>
        <script src="js/ajax.js" type="text/javascript"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.9.2/jquery-ui.min.js"></script>
        <script src="js/wishlist.js" type="text/javascript"></script>
        <script src="js/customerSwitchMode.js" type="text/javascript"></script>


        <!-- DataTables -->
        <script src="plugins/data-table/simple-datatables.js"></script>
        <script src="plugins/tinymce/tinymce.js"></script>
        <script src="plugins/main.js"></script>


        <!--Start fetching DATA-->
        <script>
        $(document).ready(function() {

            filter_data();

            function filter_data() {
                $('.filter_data').html('<div id="loading" style="" ></div>');
                var action = 'fetch_data';
                var minimum_da = $('#hidden_minimum_da').val();
                var maximum_da = $('#hidden_maximum_da').val();
                var minimum_tf = $('#hidden_minimum_tf').val();
                var maximum_tf = $('#hidden_maximum_tf').val();
                var niche = get_filter('niche');
                $.ajax({
                    url: "blog-list.inc.php",
                    method: "POST",
                    data: {
                        action: action,
                        minimum_da: minimum_da,
                        maximum_da: maximum_da,
                        minimum_tf: minimum_tf,
                        maximum_tf: maximum_tf,
                        niche: niche
                    },
                    success: function(data) {

                        $('#insideTable').html(data);
                    }
                });
            }

            function get_filter(class_name) {
                var filter = [];
                $('.' + class_name + ':checked').each(function() {
                    filter.push($(this).val());
                });
                return filter;
            }

            $('.common_selector').click(function() {
                filter_data();
            });

            $('#da_range').slider({
                range: true,
                min: 0,
                max: 100,
                values: [1, 100],
                step: 2,
                stop: function(event, ui) {
                    $('#da_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_da').val(ui.values[0]);
                    $('#hidden_maximum_da').val(ui.values[1]);
                    filter_data();
                }
            });
            $('#tf_range').slider({
                range: true,
                min: 0,
                max: 100,
                values: [1, 100],
                step: 2,
                stop: function(event, ui) {
                    $('#tf_show').html(ui.values[0] + ' - ' + ui.values[1]);
                    $('#hidden_minimum_tf').val(ui.values[0]);
                    $('#hidden_maximum_tf').val(ui.values[1]);
                    filter_data();
                }
            });

        });
        </script>


</body>

</html>