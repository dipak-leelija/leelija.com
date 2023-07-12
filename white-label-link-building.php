<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
-->
<?php
session_start();

//include_once('checkSession.php');
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");
require_once "_config/dbconnect.trait.php";

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once("classes/services.class.php");

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/gp-order.class.php");
/* INSTANTIATING CLASSES */
$dateUtil   = new DateUtil();
$error 			= new Error();
$search_obj	= new Search();
$customer		= new Customer();
$logIn			= new Login();
$service		= new Services();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$gp				  = new Gporder();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);


//If User has a failed TRANSACTION

// if(isset($_SESSION["userid"])){
// 	$crUId = $_SESSION["userid"];
// 	$checkPendingOrder = $gp->getOrderDetails($crUId);
// 	if($checkPendingOrder[10] == 'Pending'){
// 		header("Location:package-order.php?package-type=Gold&niche=Art")
// 	}
// }




if(isset($_GET['seo_url']))
	{
		 $seo_url			  		= $_GET['seo_url'];
		// $return_url 	= base64_decode($_GET["return_url"]); //get return url
	}
//$serviceDtl		= $service->showServicesSeoUrlWise($seo_url);
//$servFeatDtls	= $service->ShowServcFrdDtls($serviceDtl[0]);
?>
<?php
/*
define('WP_USE_THEMES', false);
require('blog/wp-load.php');
query_posts('showposts=3');
*/
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <link rel="icon" href="images/logo/favicon.png" type="image/png">
    <title> White Label Link Building, Blogger Outreach: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="LeeLija provided Guest Post Service at reasonable prices on fashion blogs, beauty blogs, health blogs, travel blogs, fitness blogs, tech blogs, home improvement  or more." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="Guest Post, Guest Posting,Guest Post Service, blogger outreach, guest posting services, guest posting blogs, fashion blogs, beauty blogs, health blogs, travel blogs, fitness blogs, tech blogs, home improvement blogs, CBD blogs, Casino Blogs" />


    <!-- <link href="css/bootstrap.css" rel='stylesheet' type='text/css' /> -->
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">
    <!-- Custom CSS -->
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/guest-post-offer.css" rel='stylesheet' type='text/css' />
    <link href="css/white-label-link-building.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/partials.css">


    <!-- font-awesome icons -->
    <link href="css/fontawesome-all.min.css" rel="stylesheet">
    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <!--//webfonts-->



</head>

<body data-scrollbar>
    <?php require_once "partials/navbar.php"; ?>
    <!--___________________________________________________________________________________________________ -->
    <!-- starting of white lebel links building main banner    -->
    <div class="">
        <section class="white_lebel_link_banner">
            <div class="container bo-main-cntr">
                <div class="row blog-1main-row">

                    <div class="col-12 col-lg-5 col-md-5 vid-col">
                        <div class="bo-wrap">
                            <img src="./images/leelija-outreach-team.png " class="w-100" alt="">
                        </div>

                    </div>
                    <div class="col-12 col-lg-7 col-md-7  px-0 px-md-4">
                        <div class="bo-wrap">
                            <h1 class="blogout-main-h1">White Label Link Building Services </h1>
                            <p class=" mt-3 mb-4 py-0 py-md-2 white-lebel-main-p">Leelija Websolutions works with a lot
                                of
                                business leaders as the background partner in white label link building for delivering
                                results to our eminent clients.
                            </p>
                            <div class=" buttonsinfo ">
                                <!-- <a href="contact.php" class="btn explore_btn mt-md-3 ms-2">See Pricing</a> -->
                                <button type="button" class="btn blogger-btn ">See Pricing</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- end of white lebel links building main banner -->
    <!-- --------------------------------------------------------------------------------------------- -->


    <!--Banner Dividor-->
    <?php //include ('quote.php') ?>
    <!--/End of baneer Dividor-->

    <!-- ______________________________________________________________________________________________ -->

    <!-- trustworthy-white-lebel-section start -->
    <section class="trustwhite-section">
        <div class="row  real-bo-row1">
            <div class="col-lg-6 col-md-6 real-bo-col-first">
                <div class="">
                    <div>
                        <h1 class="trustworthy-white-lebel-text-h1">Trustworthy Link Building Process <span> For You And
                                Your
                                Clients</span> </h1>
                    </div>
                    <div>
                        <div class="py-4">
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="text-start lbp-texting">
                                    Collect do follow the editorial links for clients. The link should be <b> indexable
                                        and unique.</b>
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">

                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="text-start lbp-texting">
                                    Our expert checks all the insert links carefully <b>to avoid any kind of duplicate
                                        links.</b>
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="text-start lbp-texting">
                                    Our own expert writers create <b>industry-relevant</b> but non-promotional content.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1 mb-3">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="text-start lbp-texting">
                                    We follow the <b> business guidelines</b> strictly.
                                </div>
                            </div>

                        </div>

                        <div class=" buttonsinfo ">
                            <button type="button" class="btn real-bo-btn ">Get Your Links Now</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 real-bo-col-second">
                <div class="">
                    <div>
                        <img src="./images/real-bo-img-col2.png" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- trustworthy-white-lebel-section end -->
    <!-- _______________________________________________________________________________________________ -->

    <!--  Our Work Procedure-section start -->

    <section class="trustwhite-section wp-building1">
        <h1 class="work-procedure-white-lebel-text-h1 wp-building2">Our Work Procedure </h1>
        <div class="row  real-bo-row1">

            <div class="col-lg-6 col-md-6 real-bo-col-second">
                <div class="">
                    <div>
                        <img src="./images/AMAZING-BO-.col-1.png" class="w-100  mb-4 " alt="">
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 real-bo-col-first">
                <div class="">

                    <div>
                        <div class="py-4">
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class=" lbp-texting">
                                    <b>Outreach Influencers : </b> Expert outreach influencers researched very deeply to
                                    get relevant keywords for better conceptualizing concepts.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting">
                                    <b>Create Beautiful Content : </b> Content is the main focus. Our professional
                                    writers provide natural content that is unique readable and relevant to clients.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">

                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting"><b> Publish Content : </b> We published that content on the
                                    perfect
                                    influencing site. The content gets high traffic and you will get your targetted
                                    audience.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1 mb-3">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting">
                                    <b>Special Report :</b>
                                    A special report on the white label progress of improvement in the website ranking
                                    on the readership, SERPs, and links will be sent to you.
                                </div>
                            </div>

                        </div>

                        <div class=" getyour-linkbtn ">
                            <!-- <a href="contact.php" class="btn explore_btn mt-md-3 ms-2">See Pricing</a> -->
                            <button type="button" class="btn blogger-btn d-flex justify-content-right">Get Your
                                Links Now</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </section>
    <!-- Our Work Procedure-section end -->
    <!-- ______________________________________________________________________________________________________ -->


    <!-- ================================================================================================ -->
    <!-- more information blogger outreach start -->


    <!-- contact top -->
    <?php include('more-info.php');?>
    <!-- //contact top -->



    <!-- more information blogger outreach ends -->
    <!-- ================================================================================================ -->
    <!-- ______________________________________________________________________________________________________ -->

    <!--================================= Client Review section Start =================================-->

    <section class="sliderbar  text-center">
        <h2 class="what-others-say-testimonial  my-3">TESTIMONIAL</h2>
        <h1 class="what-others-say-bo-slider-h1  my-2">What <span>Our Client</span> Says</h1>
        <div class="p-3">Client satisfaction is the first priority of our company. We are passionate and committed to
            surpassing the expectations of good work.
        </div>
        <div class="container" style="max-width: 1325px;">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators ci-blogger-outingreach">
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"
                        aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="3"
                        aria-label="Slide 4"></button>
                </div>

                <!-- ======================= Carousel inner Start ======================= -->
                <div class="carousel-inner">

                    <!-- =============== Review One =============== -->
                    <div class="carousel-item active slider">
                        <!-- <h5 class="header">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5><br> -->
                        <h4 class="what-others-say-bo-ci-h4">"Honestly, they are the best in the digital marketing
                            world. Very much
                            committed and punctual towards their delivery. Definitely, we will use the services of
                            Leelija in the upcoming years."</h4>
                        <div class="containerslider">
                            <img src="images/icons/male-user.png" class="imageslider" alt="...">
                            <div class="sliderbox1">

                                <h5 class="paraname">Kishu Setia</h5>
                                <p class="para1">Experienced Blogger</p>
                            </div>
                        </div>
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <!-- =============== Review One End =============== -->



                    <!-- =============== Review Two =============== -->
                    <div class="carousel-item slider">
                        <!-- <h5 class="header">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5><br> -->
                        <h4 class="what-others-say-bo-ci-h4">"Leelija did a fantastic job with our online marketing
                            strategy.We have to
                            say they have a great reporting process and are always touched with our manager and
                            outreach team."</h4>
                        <div class="containerslider">
                            <img src="images/icons/female-user.png" class="imageslider" alt="...">
                            <div class="sliderbox1">

                                <h5 class="paraname">Gemma Bell</h5>
                                <p class="para1">Marketing Expert</p>
                            </div>
                        </div>
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <!-- =============== Review Two End =============== -->



                    <!-- =============== Review Three =============== -->
                    <div class="carousel-item slider">
                        <!-- <h5 class="header">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5><br> -->
                        <h4 class="what-others-say-bo-ci-h4">"I really appreciate the business relationship we have had
                            with Leelija
                            Team for the last 1 year. They have helped us in website development and design for our
                            organic growth."</h4>
                        <div class="containerslider">
                            <img src="images/icons/female-user.png" class="imageslider" alt="...">
                            <div class="sliderbox1">

                                <h5 class="paraname">Stewart</h5>
                                <p class="para1">Indivisual Blogger</p>
                            </div>
                        </div>
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <!-- =============== Review Three End =============== -->


                    <!-- =============== Review Four =============== -->
                    <div class="carousel-item slider">
                        <!-- <h5 class="header">Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5><br> -->
                        <h4 class="what-others-say-bo-ci-h4">"From a digital marketing point of view, I am highly
                            impressed with the
                            hard work of the Leelija Team. They are amazing and so has been their support and
                            contribution."</h4>
                        <div class="containerslider">
                            <img src="images/icons/male-user.png" class="imageslider" alt="...">
                            <div class="sliderbox1">

                                <h5 class="paraname">Louie Arim</h5>
                                <p class="para1">Marketing Team Lead</p>
                            </div>
                        </div>
                        <div class="carousel-caption d-none d-md-block">

                        </div>
                    </div>
                    <!-- =============== Review Four End =============== -->

                </div>
                <!-- ======================= Carousel inner End ======================= -->

                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"><i
                            class="fa-solid fa-arrow-left-long iconbutton"></i></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions"
                    data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"><i
                            class="fa-solid fa-arrow-right-long iconbutton"></i></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </div>
        <!-- end -->
    </section>

    <!------------------------------------ Client Review section End ------------------------------------->
    <!-- _______________________________________________________________________________________________ -->
    <!-- _______________________________________________________________________________________________ -->

    <!-- What We Can Deliver-section start -->

    <section class="trustwhite-section">
        <h1 class="work-procedure-white-lebel-text-h1">What We Can Deliver?</span> </h1>
        <div class="row  real-bo-row1">

            <div class="col-lg-6 col-md-6 real-bo-col-first">
                <div class="">
                    <div>
                        <div class="py-4">
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting">
                                    <b> White Label Services : </b> We work as behind-the-scenes partners for you. Our
                                    service on white label link building lets you take all credit. Moreover, you will be
                                    shown as the marketer.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting">
                                    <b>Business Growth : </b> An outsourcing service never costs you more than you earn.
                                    Therefore, you can generate more revenue while we will work for you.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">

                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting"><b> Quality Work : </b> Our quality is our preface. We never
                                    compromise
                                    with quality. You don’t think about it twice. Otherwise, you should keep eye on the
                                    production. Link building for your site is in safe hands.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1 mb-3">
                                <div class=" px-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="lbp-texting">
                                    <b> Client Satisfaction :</b>
                                    Client satisfaction is our topmost priority. We will never try to contact your
                                    clients. Moreover, we will try to help you to create a strong bond between you and
                                    your clients by delivering superfast services.
                                </div>
                            </div>
                        </div>

                        <div class=" buttonsinfo ">
                            <button type="button" class="btn real-bo-btn ">Get Your Links Now</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 real-bo-col-second">
                <div class="">
                    <div>
                        <img src="./images/AMAZING-BO-.col-1.png" class="w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- What We Can Deliver-section end -->
    <!-- ______________________________________________________________________________________________________ -->

    <!--  Why Leelija Can Give You That Top Level? starts -->
    <section class="works-for-you-bo-section">
        <div class="">
            <div class="how-its-wrok-bo-main-div">
                <div>
                    <h2 class=" text-center mt-4 my-3 works-bo-h2">Why Leelija Can <span> Give You That Top
                            Level?</span></h2>
                </div>
                <div class="works-f-u-main-card-div">
                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="card  how-it-work-f-u-card" style="background: #cd5c5c21;">

                                <div class="pb-3 ">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Specially Engaged Managers</h4>
                                <p class="lbp-texting">
                                    When you place your order, we assign a dedicated manager to supervise. Therefore,
                                    you got a quick response and delivery on or before time.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card">

                                <div class="pb-3 ">
                                    <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Supreme Keyword Research</h4>
                                <p class="lbp-texting">
                                    We have a proficient team that picks up the trending and highest-ranking keywords
                                    for you. </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card" style="background: #cd5c5c21;">

                                <div class=" pb-3">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Zero Spam Service</h4>
                                <p class="lbp-texting">
                                    Our team never indulges in the spam policy and keeps away from PBNs. Our creative
                                    content gives good readership and popularity. </p>

                            </div>

                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card">

                                <div class="pb-3 ">
                                    <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Existing Link Analysis</h4>
                                <p class="lbp-texting">
                                    We ensure our clients that backlinks are never repeated. Moreover, before doing
                                    outreach our expert team thoroughly checks the client’s link profile. </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card" style="background: #cd5c5c21;">

                                <div class="pb-3 ">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Native Professionals</h4>
                                <p class="lbp-texting">
                                    Our team of PR experts and content writers are local to UK and US. therefore, the
                                    laity of content never is compromised.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4 ">
                            <div class="card how-it-work-f-u-card">

                                <div class=" pb-3">
                                    <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Vast database of Authentic Influencers</h4>
                                <p class="lbp-texting">
                                    We are engaged with 1000+ authentic bloggers and influencers from each industry.
                                    Therefore you will get appropriate traffics. </p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why Leelija Can Give You That Top Level? ends -->
    <!-- ____________________________________________________________________________________________________ -->


    <!-- _________________________________________________________________________________________________ -->


    <!-- extra details -->
    <div class="features-sec">
        <div class="features">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3">
                        <p class="features-sec-head-icon">
                            <i class="fas fa-chart-line"></i>
                        </p>
                        <div class="features-sec-all-details">
                            <p class="features-sec-head">
                                Real Ranking Sites
                            </p>
                            <p class="features-sec-details">
                                Manual outreach on 100% real sites ranking in Google
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <p class="features-sec-head-icon">
                            <i class="fas fa-th"></i>
                        </p>
                        <div class="features-sec-all-details">
                            <p class="features-sec-head">
                                Customize Your Criteria
                            </p>
                            <p class="features-sec-details">
                                Choose between Domain Authority or Publisher Traffic
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <p class="features-sec-head-icon">
                            <i class="fas fa-truck"></i>
                        </p>
                        <div class="features-sec-all-details">
                            <p class="features-sec-head">
                                Fast Deliverables
                            </p>
                            <p class="features-sec-details">
                                7-day turnaround time guaranteed for your Guest Post
                            </p>
                        </div>
                    </div>

                    <div class="col-sm-3">
                        <p class="features-sec-head-icon">
                            <i class="fas fa-users"></i>
                        </p>
                        <div class="features-sec-all-details">
                            <p class="features-sec-head">
                                Reseller Friendly
                            </p>
                            <p class="features-sec-details">
                                Reseller friendly white-label reports to share with your clients
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- extra details -->

    <!-- _______________________________________________________________________________________________ -->

    <!-- What Makes Us Special In This Category-section start -->

    <section class="trustwhite-section">
        <h1 class="work-procedure-white-lebel-text-h1">What Makes Us Special In This Category? </h1>
        <div class="row  real-bo-row1">

            <div class="col-lg-6 col-md-6 real-bo-col-second">
                <div class="">
                    <div>
                        <img src="./images/AMAZING-BO-.col-1.png" class="w-100  mb-4 " alt="">
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 real-bo-col-first">
                <!-- <div class="">

                    <div> -->
                <div class="py-4">
                    <div class="real-bo-secondcol-div1">
                        <div class=" px-3 trustworthy-img-div">
                            <img src="./images/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Customization in Price Range on bulk orders. </b> We genuinely care for your
                            brand, and that’s why we provide customized prices on several occasions.
                        </div>
                    </div>
                    <div class="real-bo-secondcol-div1">
                        <div class=" px-3 trustworthy-img-div">
                            <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            We Work as your <b>outsourcing partner.</b> After placing the order, we will handle
                            all work. For instance, from generating content to publishing it on the website.
                        </div>
                    </div>
                    <div class="real-bo-secondcol-div1">

                        <div class=" px-3 trustworthy-img-div">
                            <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting"> <b>Client satisfaction</b> is our topmost priority. We are
                            ready to help you at any time. Your client will be never disappointed.
                        </div>
                    </div>


                </div>

                <div class=" getyour-linkbtn ">
                    <!-- <a href="contact.php" class="btn explore_btn mt-md-3 ms-2">See Pricing</a> -->
                    <button type="button" class="btn blogger-btn d-flex justify-content-right">Get Your
                        Links Now</button>
                </div>
                <!-- </div>
                </div> -->

            </div>
        </div>

    </section>
    <!-- What Makes Us Special In This Category-section end -->
    <!-- ______________________________________________________________________________________________________ -->

    <!-- ================================================================================================= -->
    <!-- Frequently Asked Questions starts -->
    <!-- ================================================================================================ -->

    <div class="blogger-faq">
        <div class="faq-head-section text-center">
            <h2>Frequently Asked Questions <span>(FAQs)</span> </h2>
            <!-- <p>Want to know more about our blogger outreach services? Your questions, our answers!</p> -->
        </div>
        <div class="container">

            <ul class="faq-body">

                <li class="faq-li">
                    <i class="fas fa-plus" id="first_id"></i>
                    <h4 class="faq-title">What Is White Label Link Building?</h4>
                    <div class="faq-details">
                        <p> White-label link building is one type of business solution where a company conducts and
                            supplies link-building projects without its own branding or references.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How We Safeguard Our Clients?</h4>
                    <div class="faq-details">
                        <p>We deliver top-notch quality backlinks and content for clients. It offers the wanted
                            result.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What are the pricing of campaigning and white-label link building?</h4>
                    <div class="faq-details">
                        <p> The price is depending on the link parameters, spend level, and contract length. Moreover,
                            we offer different pricing options per link, per package, monthly, quarterly, half-yearly,
                            and annually.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How does a link building become top quality?</h4>
                    <div class="faq-details">
                        <p> We have expert SEO and local language speaker of your choice. We provide multilingual
                            campaigns with expert SEO.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What are the three factors to getting significant ranks?</h4>
                    <div class="faq-details">
                        <p>Google prefers three factors to build top-quality links. Those are linking page’s
                            authority, linking the site’s authority, and the relevance of the content. At Leelija we
                            ensure all three factors to increase the significant rank of your brand.</p>
                    </div>
                </li>




            </ul>
        </div>
    </div>

    <!-- ================================================================================================ -->

    <div class="mt-4">
        <?php include('seller-action.php') ?>
    </div>



    <!-- Footer -->
    <?php require_once "partials/footer.php"; ?>

    <script src="js/jquery-2.2.3.min.js"></script>



    <!-- /Footer -->
    <script type="text/javascript">
    $(document).ready(function() {
        $(".faq-li").click(function() {
            var icon = $(this).children("i");
            var notThis = $(".faq-li").not(this);
            var include = icon.hasClass("fa-plus");
            $(this).children("i").toggleClass("fa-plus fa-minus");
            $(this).children(".faq-details").toggle();
            notThis.children(".faq-details").css("display", "none");
            notThis.children("i").addClass("fa-plus").remove("fa-minus");
        })
    });
    </script>


    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

</body>

</html>