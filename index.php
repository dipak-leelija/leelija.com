<?php
session_start();
require_once("includes/constant.inc.php");
require_once("_config/dbconnect.php");

require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/domain.class.php");
require_once "classes/employee.class.php";
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$Employee       = new Employee();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$domain			= new Domain();

######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php //include('head-section.php');?>
    <title><?php echo COMPANY_FULL_NAME; ?>: Create website, blogs sales, blogs for beginners</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Business solution to grow online. create a beautiful website, blogs for beginners, blogs sales, buy a domain name, digital marketing services, guest post and 24/7 support.">
    <meta name="google-site-verification" content="yms7bEjruHA_-HFI2PfRho01yJhjM2PUQMuyYpXlZLM">
    <!-- <link rel="canonical" href="https://www.leelija.com" /> -->

    <meta name="keywords"
        content="Leelija Web Solutions, Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website, Ready website for business, High Quality website sales, blogs sales, expired domain sales, blogs platforms" />


    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">

    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <link rel="stylesheet" href="css/leelija.css">
    <link rel="stylesheet" href="css/testimonials.css">
    <link rel="stylesheet" href="css/partials.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div class="row m-0 w-100 ">
        <!--======================================= Navigationbar Start =======================================-->
        <?php require_once "partials/navbar.php"?>
        <!------------------------------------------- Navigationbar End ------------------------------------------->

        <!--======================================== Main Banner Start ========================================-->

        <?php require_once "partials/main-banner.php"; ?>

        <!----------------------------------------- Main Banner End ----------------------------------------->

        <!-- _____________________________________________________________________________________ -->

        <!-- Trusted by top brands & SEO agencies for first page results SLIDER -->
        <?php require_once "components/main/our-clients.inc"; ?>
        <!-- Trusted by top brands & SEO agencies for first page results SLIDER -->

        <!--==================================== Established Blogs Start ====================================-->
        <?php // require_once 'components/main/items-card.inc'; ?>
        <!--------------------------------------- Established Blogs End --------------------------------------->


        <!-- ================================ OUR SERVICES SECTION START ================================ -->
        <?php require_once "components/main/our-services.inc"; ?>
        <!-- ================================ OUR SERVICES SECTION END ================================ -->


        <!-- ================================  WORK ABOUT SECTION START ================================ -->
        <?php require_once "components/main/work-about.inc"; ?>
        <!-- ================================  WORK ABOUT SECTION END ================================ -->

        <!-- ============================== Market Explore Section Start ============================== -->
        <?php require_once "components/main/explore-marketplace.inc"; ?>
        <!-- ============================== Market Explore Section End ============================== -->


        <!-- ================================ OUR TEAM  =================================== -->
        <?php require_once ROOT_DIR."components/main/featured-employees.inc"; ?>
        <!-- ============================== OUR TEAM END ================================= -->


        <!-- ================================ ABOUT US SECTION  =================================== -->
        <?php require_once "components/main/about-us.inc"; ?>
        <!-- ============================== ABOUT US SECTION END ================================= -->


        <!-- ============================== Testimonial Section Start ============================== -->
        <?php require_once "components/main/testimonials.inc"?>
        <!-- ============================== Testimonial Section End ============================== -->
        <!-- ------------------------------------------------------------------- -->
        <!-- contact section for index page  -->
        <section class="indexpage_contactus-show ">
            <h1> How can we help? </h1>
            <p>Send us a message!</p>
            <a href="contact.php">
                <button type="button" class="btn btn-success mt-3 px-3 py-2 rounded-5">Contact Us
                    <i class="fa-solid fa-comments"></i>
                </button>
            </a>
        </section>
        <!-- contact section for index page  -->
        <!-- ------------------------------------------------------------------- -->
        <!-- ============================== Our Blogs Section Start ============================== -->
        <?php // require_once "components/main/latest-blogs.inc"; ?>
        <!-- ============================== Our Blogs Section End ============================== -->

        <!--============================================  Footer Section Start ============================================-->
        <?php  require_once "partials/footer.php"?>
        <!-----------------------------------------------  Footer Section End ------------------------------------------------>
    </div>
    <!-- Container End  -->

    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <script src="plugins/jquery-3.6.0.min.js"></script>

    <script>
    var Scrollbar = window.Scrollbar;
    Scrollbar.init(document.querySelector('body'));
    </script>

    <!-- ==== js for smooth scrollbar ==== -->
    <!-- <script src="plugins/smooth-scrollbar.js"></script>
    <script>
        var Scrollbar = window.Scrollbar;
        Scrollbar.init(document.querySelector('body'));
    </script> -->
    <!-- ==== js for smooth scrollbar End ==== -->

    <script>
    var path = window.location.pathname.substring(1);
    console.log(path);
    // $('.nav>li>a[href="' + path + '"]').addClass('active');

    // $(document).ready(function($) {
    //     // var url = window.location.href;
    //     // console.log(url)
    //     // // alert(url)
    //     // $('.nav li a[href="' + url + '"]').addClass('active');

    //     // // $('.nav li a[href="' + url + '"]').addClass('active');

    // });
    </script>

</body>

</html>