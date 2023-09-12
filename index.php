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
    <meta charset="utf-8">
    <meta name="google-site-verification" content="yms7bEjruHA_-HFI2PfRho01yJhjM2PUQMuyYpXlZLM">
    <!-- <link rel="canonical" href="https://www.leelija.com" /> -->

    <meta name="keywords"
        content="Leelija Web Solutions, Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website, Ready website for business, High Quality website sales, blogs sales, expired domain sales, blogs platforms" />


    <link rel="icon" href="<?php echo FAVCON_PATH; ?>" type="image/png">
    <!-- <link rel="shortcut icon" href="favicon.ico" />
    <link rel="apple-touch-icon" href="images/favicon.png" /> -->

    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <link rel="stylesheet" href="css/leelija.css">
    <link rel="stylesheet" href="css/testimonials.css">
    <link rel="stylesheet" href="css/partials.css">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <style>
    /* .row > div {
      padding: 0 4px !important;
}

.img-fluid {
    margin-top: 8px;
    vertical-align: middle;
  
} */
    </style>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div class="row m-0 w-100 ">
        <!--======================================= Navigationbar Start =======================================-->
        <?php require_once "partials/navbar.php"?>
        <!------------------------------------------- Navigationbar End ------------------------------------------->

        <!--======================================== Main Banner Start ========================================-->

        <?php require_once "partials/main-banner.php"; ?>

        <!----------------------------------------- Main Banner End ----------------------------------------->

        <!--==================================== Established Blogs Start ====================================-->
        <?php // require_once 'components/main/items-card.php'; ?>
        <!--------------------------------------- Established Blogs End --------------------------------------->


        <!--============= Our Services SECTION-1 START ================================-->
        <!-- -------- wthfour_section-0 starts ++++++++ -------------- -->
        <section class="wthfour_section px-md-5  m-0">

            <div class="row  justify-content-center m-auto ">
                <div class="col-lg-3 col-md-12  col-sm-12 xm-12 justify-content-center m-auto card-width3 ">
                    <div class="card cd_background">
                        <div class="card-body cd_body">
                            <h4 class="card-title text-center fw-bold ">Our Services</h4>
                            <p class="card-text text-center text-light fs-6 p-3 mt-4">We are providing you the best
                                quality online and Business Development services.Our Expert Team always helps you
                                bring
                                your goal closer to you.
                            </p>
                            <div class="d-flex justify-content-center">
                                <a href="services.php" class="btn  rounded-pill bbtnn ">Explore Services</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-9 row cd-rows d-flex justify-content-center">
                    <div class="col-lg-4  p-3  card-width2">
                        <div class="card plaincard " style="background: #cfe8ff;">
                            <div class="card-body">
                                <img src="./images/icons/web-development.png " class="w-25" alt="">
                                <h5 class="card-title pt-3 fw-semibold">Web Development</h5>
                                <div class="divi-ne pt-3">
                                    <span class="atag_style text-capitalize">Secure</span>
                                    <span class="atag_style text-capitalize">Seo Friendly</span>
                                    <!-- <a class="atag_style " href="">Design</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  p-3  card-width2">
                        <div class="card plaincard " style="background: antiquewhite;">
                            <div class="card-body">
                                <img src="./images/icons/blog.png " class="w-25" alt="">
                                <h5 class="card-title pt-3 fw-semibold">SEO</h5>
                                <div class="divi-ne pt-3">
                                    <span class="atag_style text-capitalize" href="">On Top Results</span>
                                    <span class="atag_style text-capitalize" href="">Better Reach</span>
                                    <!-- <a class="atag_style " href="">Design</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  p-3  card-width2">
                        <div class="card plaincard " style="background: darkgray;">
                            <div class="card-body ">
                                <img src="./images/icons/business-solution.png " class="w-25" alt="">
                                <h5 class="card-title pt-3 fw-semibold">Guest Posting</h5>
                                <div class="divi-ne pt-3">
                                    <span class="atag_style text-capitalize" href="">cheapish</span>
                                    <span class="atag_style text-capitalize" href="">on time</span>
                                    <!-- <a class="atag_style " href="">Design</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  p-3  card-width2">
                        <div class="card plaincard " style="background: #ebddd9;">
                            <div class="card-body">
                                <img src="images/icons/creativity.png" class="w-25" alt="">
                                <h5 class="card-title pt-3 fw-semibold">Content Marketing</h5>
                                <div class="divi-ne pt-3">
                                    <span class="atag_style text-capitalize" href="">remarkable</span>
                                    <span class="atag_style text-capitalize" href="">seo friendly</span>
                                    <!-- <a class="atag_style " href="">Design</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 p-3  card-width2">
                        <div class="card plaincard " style="background: #ebe3eb;">
                            <div class="card-body">
                                <img src="./images/icons/online-reputation.png" class="w-25" alt="">
                                <h5 class="card-title pt-3 fw-semibold">Branding Services</h5>
                                <div class="divi-ne pt-3">
                                    <span class="atag_style text-capitalize">marketing</span>
                                    <span class="atag_style text-capitalize">value addition</span>
                                    <!-- <a class="atag_style " href="">Design</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4  p-3  card-width2">
                        <div class="card plaincard " style="background: #f3caca;">
                            <div class="card-body">
                                <img src="./images/icons/digital-marketing.png" class="w-25" alt="">
                                <h5 class="card-title pt-3 fw-semibold">Social Media Marketing</h5>
                                <div class="divi-ne pt-3">
                                    <span class="atag_style text-capitalize">better reach</span>
                                    <span class="atag_style text-capitalize">more client</span>
                                    <!-- <a class="atag_style " href="">Design</a> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-----------------------------------------------------------
            -- =============== wthfour_section-0 end============== 
        ------------------------------------------------------------->
        <!-- ------------------------------------------------------------
            -----++++++++++  section-image & paragraph starts ++++++++ 
        ------------------------------------------------------------ -->
        <section class="secxn">
            <div class="row w-100 m-0" style="overflow: hidden;">
                <div class="  col-lg-9 col-md-12 col-sm-12 colm1">
                    <h5 class="aegean-blue-color mb-3 "> &#8213; WORKS ABOUT</h5>
                    <h3 class=" mb-0" style="font-weight: 700;">Trusted by 5000+</h3>
                    <h3 class=" mb-3" style="font-weight: 700;">Happy Customers</h3>
                    <p class=" mb-4">We’re a team of SEO and development experts who provide a complete set of
                        integrated services to scale your company’s digital growth.</p>
                    <h6 class="mb-3 tickline"><i class="fa-solid fa-circle-check pe-2 tickicn"></i> 100% Client
                        Satisfaction
                    </h6>
                    <h6 class=" mb-5 tickline"> <i class="fa-solid fa-circle-check pe-2 tickicn"></i> World Class
                        Worker
                    </h6>
                    <div class="d-flex justify-content-center justify-content-lg-start">
                        <a href="<?= URL?>contact.php" class="btn btn-primary bbtnn ">Let's Connect</a>
                    </div>
                </div>
                <div class="divvcs col-lg-3 col-md-12 col-sm-12 ">
                    <img src="images/pplgroup.jpg" class="imggy" width="500px" height="350px" alt="">
                    <div class="textinpicture">
                    </div>
                </div>
            </div>
        </section>
        <!-- -------------------------------  section-image & paragraph ends ++++++++ ------------------------ -->



        <!-- ================================ ABOUT US SECTION  =================================== -->
        <section>
            <div class="row aBout_us-banner-section">
                <h1>About Us</h1>
                <div class="col-md-6 text-center text-md-start ps-md-0 ">
                    <img src="images/aboutus_banner-home2.jpg" width="512px" height="624px" alt="">
                </div>
                <div class="col-md-6 m-auto mb-5">

                    <p>Leelija Web Solutions, an ISO 9001:2015 certified online Marketplace. We are enhancing our
                        business with the same tactics that we employ to our clients. Our aim is quite clear like
                        crystal to help people grow their businesses through an effective and efficient way.</p>
                    <p class="mt-4">
                        Our main
                        focus areas are numbers of online Applications, Business Development Software, Blogs, Guest Post
                        Services, On-Page SEO, Blogs + Domain name + Content with good metrics, live ready website that
                        includes a detailed description covering all aspects of your business and you as entrepreneurs,
                        etc. In an industry where changes are being quite frequent, it’s our duty to stay always far
                        from changes.
                    </p>
                    <div class="aBOUT_btn_div">
                        <a href="about.php">
                            <button value="Send" class="my-buttons-hover text-center mt-4 bn21">Know More</button>
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <!-- ============================== ABOUT US SECTION END ================================= -->

        <!-- ================================ OUR TEAM  =================================== -->

        <section>
            <div class="row R_team_section_div">

                <div class="col-md-6 m-auto">
                    <!-- display only for lg-screen -->
                    <div class="r-div-h1_wrap d-md-block d-none">
                        <div>
                            <img src="images/r-team-small-icon-triangle.png" class="d-md-block d-none" width="50px"
                                class=" mb-3 img-fluid">
                        </div>
                        <h1><span> Meet </span></h1>
                        <h1><strong> Our </strong></h1>
                        <h1 style="border-bottom: none;">Team</h1>
                    </div>
                    <!-- display only for md-screen -->
                    <div class="r-div-h1_wrap d-md-none">
                        <h1> Meet<span><strong> Our </strong> </span> TEAM</h1>
                    </div>
                    <p class="text-md-start text-center mb-4 mx-2">Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        Soluta, atque. Lorem ipsum dolor sit amet consectetur adipisicing elit. Sunt sed enim vitae
                        harum inventore, quasi est earum ipsam explicabo totam, illum quas, eius ratione dolore nam
                        accusamus facere optio nemo! </p>
                    <!-- display only for lg-screen -->
                    <div class="aBOUT_btn_div d-none d-md-block">
                        <a href="about.php#Meet_R_Team">
                            <button value="Send" class="my-buttons-hover text-center mt-4 bn21">View All <i
                                    class="fa-solid fa-arrow-right-long"></i></button>
                        </a>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="row justify-content-end">
                        <div class="col-md-5 col-6 d-flex align-items-end justify-content-end  mt-2">
                            <img src="images/team/r-team-dummy2.jpg" class="img-thumbnail img__wrap_ratio img-fluid">
                        </div>
                        <div class="col-md-7 col-6  mt-2">
                            <img src="images/team/r-team-dummy3.jpg" class="img-thumbnail img__wrap_ratio img-fluid">
                        </div>
                        <div class="col-md-5 col-6 d-flex justify-content-end  mt-2">
                            <img src="images/team/1.jpg" class="img-thumbnail img__wrap_ratio img-fluid">
                        </div>
                        <div class="col-md-5 col-6  mt-2">
                            <img src="images/team/r-team-dummy1.jpg" class="img-thumbnail img__wrap_ratio img-fluid">
                        </div>
                    </div>
                    <!-- display only for md-screen -->
                    <div class="aBOUT_btn_div d-md-none">
                        <a href="about.php#Meet_R_Team">
                            <button value="Send" class="my-buttons-hover text-center mt-4 bn21">View All <i
                                    class="fa-solid fa-arrow-right-long"></i></button>
                        </a>
                    </div>
                </div>

            </div>
        </section>
        <!-- ============================== OUR TEAM END ================================= -->


        <?php require_once ROOT_DIR."components/main/featured-employees.php";?>

        <!--================================== Market Explore Section Start ==================================-->

        <section class="wthree-row text-center mt-4">
            <h1 class=" fs-1 fw-bolder my-2"><span class="aegean-blue-color fw-bold"></span>Explore</span> The
                <span class="aegean-blue-color fw-bold">Marketplace</span>
            </h1>
            <div class="">
                You Are Not Small,<span class="aegean-blue-color"> Join</span> and <span
                    class="aegean-blue-color">Build</span>
                Your <span class="aegean-blue-color">Business</span>
            </div>

            <div class="container mt-4">
                <div id="services" class="container-fluid text-center">
                    <div class="row slideanim">
                        <div class="col-md-4 col-sm-6 ">
                            <div class="indivisual-service">
                                <a href="domains.php">
                                    <span>
                                        <img src="images/icons/blog.png" alt="Domains & Blogs" class="services-icon" />
                                    </span>
                                    <h4>Domains & Blogs</h4>
                                    <p>Domain Name, Design Blog With contents </p>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="indivisual-service">
                                <span>
                                    <img src="images/icons/website.png" alt="website-design" alt="website-design"
                                        class="services-icon" />
                                </span>
                                <h4>Website & eCommerce</h4>
                                <p>Business, Professional and eCommerce Website & Lots More</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="indivisual-service">
                                <span>
                                    <img src="images/icons/software.png" alt="website-design" class="services-icon" />
                                </span>
                                <h4>Business Software</h4>
                                <p>Accounting, Production, Sales, Analytics & Lots More </p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="indivisual-service">
                                <span>
                                    <img src="images/icons/apps.png" alt="website-design" class="services-icon" />
                                </span>
                                <h4>Apps & Tools</h4>
                                <p>Apps for Your Business, SEO & Business Tools & Lots More</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="indivisual-service">
                                <span>
                                    <img src="images/icons/digital-marketing.png" alt="website-design"
                                        class="services-icon" />
                                </span>
                                <h4>Digital Marketing</h4>
                                <p>SEO, Social Media, Guest Posting Services & Lots More</p>
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="indivisual-service">
                                <span>
                                    <img src="images/icons/graphic-design.png" alt="website-design"
                                        class="services-icon" />
                                </span>
                                <h4 style="color:#303030;">Graphics & Design</h4>
                                <p>Logo Design, Website Template & Lots More</p>
                            </div>
                        </div>
                    </div>
                    <!-- <a href="services.php" class="text-uppercase btn-explore-banner btn blue_btn">explore now</a> -->
                    <button class="btn mt-3 explore_btn text-center "><a href="services.php"
                            class="aegean-blue-color text-decoration-none">Explore Now</a></button>
                </div>
            </div>
        </section>


        <!------------------------------------ Market Explore Section End ------------------------------------>
        <?php require_once "partials/testimonials.php"?>

        <!--===================================== Our Blogs Section Start =====================================-->

        <!-- <section class="new_section text-center mt-5">

            <h1 class=" aegean-blue-color fs-1 fw-bolder mt-4 mb-2">Latest Blogs</h1>
            <div class="row mt-4 justify-content-evenly">
                <div class="text-center card-width">
                    <div class="card card1">
                        <a href="#">
                            <div class="card-img">
                                <img class="img-fluid" src="images/banner-new.jpg" alt="">
                                <div class="custom-badge">Technology</div>
                            </div>
                            <div class="box_container">
                                <div class="tag">
                                    <span><i class="fa-regular fa-clock tag_icon"></i> 26 March 2022 </span>
                                    <span><i class="fa-solid fa-user-tie tag_icon"></i> Windstrip</span>
                                </div>
                                <h4 class="card_title">What is holding back the..</h3>
                                    <div class="learn_more">
                                        <a href="#"><i class="fa-solid fa-arrow-right pre_icon"></i> Learn more <i
                                                class="fa-solid fa-arrow-right post_icon"></i></a>
                                        </h5>
                                    </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="text-center card-width">
                    <div class="card card1">
                        <a href="#">
                            <div class="card-img">
                                <img class="img-fluid" src="images/banner-new.jpg" alt="">
                                <div class="custom-badge">Technology</div>
                            </div>
                            <div class="box_container">
                                <div class="tag">
                                    <span><i class="fa-regular fa-clock tag_icon"></i> 26 March 2022 </span>
                                    <span><i class="fa-solid fa-user-tie tag_icon"></i> Windstrip</span>
                                </div>
                                <h4 class="card_title">What is holding back the..</h4>
                                <div class="learn_more">
                                    <a href="#"><i class="fa-solid fa-arrow-right pre_icon"></i> Learn more <i
                                            class="fa-solid fa-arrow-right post_icon"></i></a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="text-center card-width">
                    <div class="card card1">
                        <a href="#">
                            <div class="card-img">
                                <img class="img-fluid" src="images/banner-new.jpg" alt="">
                                <div class="custom-badge">Technology</div>
                            </div>
                            <div class="box_container">
                                <div class="tag">
                                    <span><i class="fa-regular fa-clock tag_icon"></i> 26 March 2022 </span>
                                    <span><i class="fa-solid fa-user-tie tag_icon"></i> Windstrip</span>
                                </div>
                                <h4 class="card_title">What is holding back the..</h4>
                                <div class="learn_more">
                                    <a href="#"><i class="fa-solid fa-arrow-right pre_icon"></i> Learn more <i
                                            class="fa-solid fa-arrow-right post_icon"></i></a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="text-center card-width">
                    <div class="card card1">
                        <a href="#">
                            <div class="card-img">
                                <img class="img-fluid blog_thumb" src="images/banner-new.jpg" alt="">
                                <div class="custom-badge">Technology</div>
                            </div>
                            <div class="box_container">
                                <div class="tag">
                                    <span><i class="fa-regular fa-clock tag_icon"></i> 26 March 2022 </span>
                                    <span><i class="fa-solid fa-user-tie tag_icon"></i> Windstrip</span>
                                </div>
                                <h4 class="card_title">What is holding back the..</h4>
                                <div class="learn_more">
                                    <a href="#"><i class="fa-solid fa-arrow-right pre_icon"></i> Learn more <i
                                            class="fa-solid fa-arrow-right post_icon"></i></a>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <button class="btn mt-5 explore_btn text-center">More Articles</button>

        </section> -->
        <!------------------------------------ Our Blogs Section End ------------------------------------>


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