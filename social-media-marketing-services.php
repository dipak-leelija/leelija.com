<!--
Author: Safikul Islam
Author URL: https://webtechhelp.org
-->
<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
    <title>SMM Services: Social Media Marketing Services Company</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="LeeLija is an ✓Social Media Marketing service company, ✓Social Media Marketing service provider,✓SMM service agency,it provides an ✓affordable SMM services for small business, It also helps to grow your ✓social media marketing strategy." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="
social media marketing strategy,social media marketing cost,social media marketing management,using social media for marketing,social media marketing ideas,nonprofit social media strategy,social media influencer marketing,social influencer marketing,how to create a social media strategy,creating a social media strategy,digital and social media marketing,facebook marketing company,what is a social media strategy,social media marketing facebook,social media strategy for business,social marketing companies,social media strategy for small business,social marketing strategy,local social media marketing,social media marketing agency for small business" />
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
    <link rel="stylesheet" href="plugins/bootstrap-5.2.0/css/bootstrap.css">
    <link rel="stylesheet" href="plugins/fontawesome-6.1.1/css/all.css">

    <!-- Custom CSS -->
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />

    <!-- //Custom Theme files -->
    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <!--//webfonts-->


</head>

<body>
    <div>


        <?php require_once "partials/navbar.php"; ?>
        <div class="blogger-banner  banner">
            <h1 class="blogbanner-heading"> Social Media Marketing Strategy </h1>
            <div class="wd_heading_details_2">
                <p class="mt-4">
                    What is a social media strategy? In today’s world, 50% of the population now engage with social
                    networks. At least one running account has on social media. So, it is quite safe to think that on
                    social
                    media you will have a vast audience and they could help you in your business. On various social
                    media
                    platforms, you can grow your business too quickly. More people will interact with businesses. If you
                    still not doing social media campaigns for your business, then what stops you? The key ingredient
                    for
                    creating a social media strategy, well is having a strategy. A social media marketing strategy is
                    very
                    important if you plan to do marketing and hope to achieve a business goal using social media for
                    marketing. Have to make social media marketing ideas strong and specific, so that it will be
                    effective.
                    Without having a strategy, you might do posting on various social platforms for the sake of posting.
                    It
                    has no value. Without understanding the value of your goals, your targeted audience, and what your
                    audience actually wants, it will be very hard to achieve the desired results on social media
                    platforms.
                    If you want to grow or boost up your brand as a social media marketer, developing the knowledge of
                    how
                    to create a social media strategy because social media strategy for business is essential. As a
                    social
                    platform user, you have to stumble with blogs and ads from different business sources. From
                    e-commerce
                    stores to local shops, service-based brand, B2C brands, B2B service companies, non-profit
                    organizations-
                    business owners all are investing on social platforms just to promote their business in front of
                    everyone. Because they know it will work well.

                    Our team see how a social media marketing agency does magical things for small business and we are
                    quite
                    confident to make some wonders for your brand too. Everyone wants to be updated by the time and it's
                    common as a business persona most want to take social media marketing management to the next level.

                </p>
            </div>
        </div>

        <section class="Social_Media_Marketing">
            <h2 class="text-center first_title">How Social Media Networks Benefit Your Business?</h2>
            <section class="native-content-section">
                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-lg-6">
                            <img src="images/facebook.png" alt="Facebook" class="w-100">
                        </div>
                        <div class="col-lg-6">
                            <h3 class="native-content">Facebook</h3>
                            <p class="social-media-point">Social media marketing facebook is a much-known term. With
                                millions and millions of active users, Facebook remains one of the best social
                                networking
                                platforms for worldwide marketers. No matter your business is small or you have a
                                start-up
                                company or an established brand, a business through Facebook page is too much necessary
                                in
                                your digital and social media marketing to keep your consumers informed. Through
                                Facebook,
                                you may develop your brand awareness and widen your business reach very well. Here we
                                will
                                share some interesting facts about Facebook for your business that can help you to grow.
                                Using Facebook one can do local social media marketing very easily.</p>
                            <ul>
                                <li><i class="far fa-check-circle pr-1"></i> According to facebook marketing company,
                                    more
                                    than 1 thousand 6 hundred million Facebook users of this world are already connected
                                    to
                                    a business on Facebook</li>
                                <li><i class="far fa-check-circle pr-1"></i> Users are very much fond of watching
                                    Facebook
                                    videos on android phones daily. It will help facebook marketing company to grow.
                                </li>
                                <li><i class="far fa-check-circle pr-1"></i> Facebook advertisements are generated
                                    $17.65
                                    billion in total cost at the end of 2019</li>
                                <li><i class="far fa-check-circle pr-1"></i> More than 66% of Facebook users are saying
                                    that
                                    they Like or Follow a particular brand on Facebook.</li>

                            </ul>
                        </div>
                    </div>
                </div>
            </section>
            <section class="native-content-section">
                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-lg-6">
                            <h3 class="native-content">Twitter</h3>
                            <p class="social-media-point">After listening to the most two common words “hashtags” and
                                “trending”, the first social media network that comes to our mind is none other than
                                Twitter. Nowadays, having a Twitter account is one of the easiest ways to know what is
                                happening around us and what people are currently talking about. It is a great platform
                                for
                                social marketing companies business to stay connected with your targeted audience.
                                Through
                                your business account on Twitter, you can offer new products and time-limited
                                offers.Also,
                                you can hold a TweetChat to boost interaction with your followers. See more Twitter
                                facts
                            </p>
                            <ul>
                                <li><i class="far fa-check-circle pr-1"></i>80% of Twitter users are saying that they
                                    like
                                    to use this network for their social marketing strategy as well as to get notified
                                    of
                                    what’s new around us.</li>
                                <li><i class="far fa-check-circle pr-1"></i>Users are reported that they like to watch
                                    Twitter ads. Using Twitter is one of the best social media strategy for small
                                    business.
                                </li>
                                <li><i class="far fa-check-circle pr-1"></i>Twitter commended with 9% growth in revenue
                                    for
                                    the last few months of 2019 which translates to 824 million dollars.</li>
                                <li><i class="far fa-check-circle pr-1"></i>Twitter’s website increased traffic up to 6%
                                    every year</li>
                                <li><i class="far fa-check-circle pr-1"></i>Twitter users watch 2 billion videos in a
                                    day
                                </li>
                            </ul>
                        </div>

                        <div class="col-lg-6">
                            <img src="images/twitter.png" alt="Twitter" class="w-100">
                        </div>
                    </div>
                </div>
            </section>
            <section class="native-content-section">
                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-lg-6">
                            <img src="images/instagram.png" alt="Instagram" class="w-100">
                        </div>
                        <div class="col-lg-6">
                            <h3 class="native-content">Instagram</h3>
                            <p class="social-media-point">Instagram is another important platform for social media
                                influencer marketing. If you think Instagram is only for brands as they are visually
                                appealing, you have to think again. You can easily increase your business awareness
                                through
                                your creative posts. It also boosts your website traffic. You may use Instagram as a
                                networking tool to find more business owners to connect with you. Instagram helps you to
                                increase your social media marketing cost. Now check out these amazing Instagram
                                statistics.
                            </p>
                            <ul>
                                <li><i class="far fa-check-circle pr-1"></i> 0.5 billion Instagram users stated that
                                    they
                                    always check IG Stories and Explore every month.</li>
                                <li><i class="far fa-check-circle pr-1"></i> Around 92% of users say that they followed
                                    many
                                    Instagram stores and visit their website to purchase products on Instagram. Make
                                    sure
                                    you choose the genuine business accompany.</li>
                                <li><i class="far fa-check-circle pr-1"></i>After watching Instagram Stories 62% of
                                    users
                                    become more enthusiastic about a brand. It will help in digital and social media
                                    marketing very well.</li>
                                <li><i class="far fa-check-circle pr-1"></i> In the USA 11% of social media users shop
                                    on
                                    Instagram.</li>
                                <li><i class="far fa-check-circle pr-1"></i> More than 130 million users of Instagram
                                    check
                                    shopping posts on this platform per month.</li>

                            </ul>

                        </div>
                    </div>
                </div>
            </section>




            <section class="native-content-section">

                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">


                        <div class="col-lg-6">
                            <h3 class="native-content">LinkedIn</h3>
                            <p class="social-media-point">LinkedIn is one of the best social platforms for business
                                owners
                                or professionals. If you are using LinkedIn, you don’t have to struggle with generating
                                leads or reaching your targeted audience. It will establish your brand reputation, and
                                build
                                a strong connection with other brand owners. It has become one of the best use of social
                                media networks for business. Now LinkedIn has 600 million users worldwide. If you have a
                                professional profile on LinkedIn, it will boost your SEO rank on SERPs. Check some
                                LinkedIn
                                facts which are surely worth nothing</p>
                            <ul>
                                <li><i class="far fa-check-circle pr-1"></i>No doubt LinkedIn is almost 277% effective
                                    in
                                    leads generating.</li>
                                <li><i class="far fa-check-circle pr-1"></i>Users are reported that they like to watch
                                    Twitter ads. Using Twitter is one of the best social media strategy for small
                                    business.
                                </li>
                                <li><i class="far fa-check-circle pr-1"></i>Twitter commended with 9% growth in revenue
                                    for
                                    the last few months of 2019 which translates to 824 million dollars.</li>
                                <li><i class="far fa-check-circle pr-1"></i>Twitter’s website increased traffic up to 6%
                                    every year</li>
                                <li><i class="far fa-check-circle pr-1"></i>Twitter users watch 2 billion videos in a
                                    day
                                </li>

                            </ul>

                        </div>

                        <div class="col-lg-6">
                            <img src="images/linkedin.png" alt="LinkedIn" class="w-100">
                        </div>
                    </div>
                </div>
            </section>


            <section class="native-content-section">

                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-lg-6">
                            <img src="images/pinterest.png" alt="Pinterest" class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">Pinterest</h3>
                            <p class="social-media-point">Pinterest has more than 300 million active users. For each
                                advertising on Pinterest, advertisers get two dollars. This is happening because
                                Pinterest
                                users are very active and they always searching for products and services. Pinterest
                                users
                                share inspiration through Pins. This platform became one of the leading networks for all
                                the
                                influencers and consumers. Pinterest help in social influencer marketing. Now check out
                                some
                                fun facts about Pinterest.</p>
                            <ul>
                                <li><i class="far fa-check-circle pr-1"></i>77% of daily users say that they have got a
                                    new
                                    product or a brand by using this amazing social platform.</li>
                                <li><i class="far fa-check-circle pr-1"></i> More than 83% of users stated they buy
                                    brands
                                    based on content</li>
                                <li><i class="far fa-check-circle pr-1"></i> Advertisers generate extra returns on their
                                    advertisements on this social network.</li>
                                <li><i class="far fa-check-circle pr-1"></i> According to 48% of Pinners, social
                                    marketing
                                    strategy is the reason for their use. Also, shopping is their main priority on
                                    Pinterest.</li>Every year the revenue from Pinterest shopping ads has increased very
                                well.</li>

                            </ul>

                        </div>
                    </div>
                </div>
            </section>



        </section>
















        <section class="blogger-fourth-section">

            <div class="container">
                <h2 class="text-center mb-3 first_title ">Our Social Media Marketing Management Plans</h2>

                <div class="wd_heading_details_2">

                    <p class="mt-4">
                        We have discussed above how social media platforms can help your business with the best social
                        media
                        marketing strategy. And our digital marketing team help you with that. Leelija Web Solution
                        provides
                        you the best social marketing strategy for your brands that helps you to broaden your digital
                        and
                        social media marketing strategy. Our social media marketing agency for small business offers
                        flexible and custom social media marketing ideas and plans that you can choose from.

                    </p>




                </div>

                <div class="row align-items-center m-0">

                    <div class="col-lg-6 pl-0">
                        <img src="images/management_fees.png" alt="Management Fees" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Management Fees</h3>
                            <p class="mb-5">Our social media marketing management team charge on average $500 to $1000
                                per
                                month. This price is completely based on how many posts we are managing for you. One
                                thing
                                you need to note that our fee is only for the services that perform on your behalf. So
                                you
                                have to bear the other expenditure like paid ads on social networking platforms. We have
                                an
                                experienced and well-trained social influencer marketing expert who will run all things
                                and
                                continually reported you. It will save your time and money, also allow you to
                                concentrate on
                                other important work for your business.</p>

                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Setup Fees</h3>
                            <p class="mb-5">We demand a one-time setup fee from our clients. We charge $150 which is
                                associated with our social media management service. This fee will be compensated to set
                                up
                                your campaign for the business. It includes monitoring software, systems of social
                                media,
                                and other necessary advertising, and media pages.</p>

                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/setup_fees.png" alt="Setup Fees" class="w-100">
                    </div>

                </div>

            </div>
        </section>


        <!-- Social Media Management Services  -->

        <section class="features-sec-main">
            <h2 class="text-center first_title pt-2 ">Our Social Media Management Services Include</h2>
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
                                        Social Media Management Expert
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
                                        Ad Maintenance Manager
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
                                        Short term Agreements
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
                                        24/7 Monitoring
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



        </section>


        <!-- ================ Regester Now Section Start ================ -->
        <?php require_once "partials/reg-now.php"; ?>
        <!------------------- Regester Now Section End ------------------->


        <!-- ============= Benefits of choosing sec start ============= -->
        <?php require_once "partials/benefits-of-choosing.php"; ?>
        <!---------------- Benefits of choosing sec End ------------------>


        <div class="blogger-faq">
            <div class="faq-head-section text-center">
                <h3>Frequently Asked Questions On SEO Services:</h3>
                <p>Submit your requirement or query, We will process it within 24 hours.</p>
            </div>
            <div class="container">

                <ul class="faq-body">

                    <li class="faq-li">
                        <i class="fas fa-plus" id="first_id"></i>
                        <h4 class="faq-title">Why social media is so important?</h4>
                        <div class="faq-details">
                            <p>
                                Social media has become one of the better part of our life,today it has huge impact on
                                our
                                daily life.Not only spending times with friends on social media platform it also give us
                                an
                                impactful opportunity to broaden our channels through which we can reach, nurture, and
                                engage with our targeted audience no matter where are they from. If your business can
                                use
                                social platforms to connect with customers, then it can use social media to create brand
                                awareness among all. Using social media for marketing is very important.
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What is social media used for in today's society?</h4>
                        <div class="faq-details">
                            <p>In today's society, social media has become necessary as our daily activity. It is mainly
                                used for social interaction. Also, you can access news, various information, and use for
                                business purpose. It is very valuable for communication across the world.One can also do
                                local social media marketing</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title"> Is social media good or bad?</h4>
                        <div class="faq-details">
                            <p>This answer will depend on you how you are using social media in a positive or negative
                                way!
                                Social media is a very good option for broadening your business. It will help you to
                                grow
                                your brand and services. Social marketing companies know the real value of using such
                                platforms for their business.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What is a social media marketing strategy?</h4>
                        <div class="faq-details">
                            <p>Every business company needs a plan or design for their social marketing strategy. Your
                                marketing strategy will help you to summarize and plan everything for your business</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How do you create social media strategy?</h4>
                        <div class="faq-details">
                            <p>Choose a marketing goal that could connect to your business objectives. Research
                                everything
                                about your audience. Keep an eye on your competitors, find your inspiration, and then
                                apply
                                and adjust your strategy.</p>
                        </div>
                    </li>



                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Why do you need a social media strategy?</h4>
                        <div class="faq-details">
                            <p>As we all know without a strategy you are unable to fulfill your desired business. So
                                without
                                a social media marketing strategy, you are wasting your business resources. It can be a
                                long-term process, so you need to follow a plan.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Will blogging help SEO?</h4>
                        <div class="faq-details">
                            <p>Social media can help you create a strong and organic presence. Also, help to gain a
                                reputation for excellence in the business field. Your overall business and marketing
                                goals
                                will be fulfilled if you are using social media for marketing.</p>
                        </div>
                    </li>


                </ul>
            </div>
        </div>
        <div class="mt-4">
            <?php include('seller-action.php') ?>
        </div>



        <!-- Footer -->
        <?php require_once "partials/footer.php" ?>
    </div>
    <script src="js/jquery-2.2.3.min.js"></script>
    <!-- <script type="text/javascript">
    $(document).ready(function() {
        $("select").change(function() {
            var crntSel = $(this).val();
            var crntSec = $(this).parents().parents().parents().children('.package-purchase-btn').css(
                'background', '#1E80C0').css('color', 'white');
        });

        $(".package-purchase-btn").click(function() {
            var nicheV = $(this).parents().attr('id');
            var niche = "#" + nicheV + "";
            var currentNiche = $(niche).children('.price-box-ul').children('li').children(
                '.package-niche').val();

            if (currentNiche == '' || currentNiche == null) {
                $(niche).children(".chooseNiche").html("Please Choose a Niche");
            } else {
                window.location.href = 'package-order.php?package-type=' + nicheV + '&niche=' +
                    currentNiche;
            }

        })
    })
    </script> -->


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


    <!-- js-->
    <!-- Scrolling Nav JavaScript -->
    <!-- <script src="js/scrolling-nav.js"></script> -->
    <!-- //fixed-scroll-nav-js -->
    <!-- <script>
    $(window).scroll(function() {
        if ($(document).scrollTop() > 70) {
            $('nav.pagescrollfix,nav.RWDpagescrollfix').addClass('shrink');
        } else {
            $('nav.pagescrollfix,nav.RWDpagescrollfix').removeClass('shrink');
        }
    });
    </script> -->
    <!-- Banner text Responsiveslides -->
    <script src="js/responsiveslides.min.js"></script>
    <script>
    // You can also use"$(window).load(function() {"
    $(function() {
        // Slideshow 4
        $("#slider3").responsiveSlides({
            auto: true,
            pager: true,
            nav: false,
            speed: 500,
            namespace: "callbacks",
            before: function() {
                $('.events').append("<li>before event fired.</li>");
            },
            after: function() {
                $('.events').append("<li>after event fired.</li>");
            }
        });

    });
    </script>
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
     

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
    </script> -->
    <!-- <script src="js/SmoothScroll.min.js"></script> -->
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <!-- //Bootstrap Core JavaScript -->
    <!-- <script>
    $(document).ready(function() {
      

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

        $(".EndQuote").on('click', function() {
            $(".leelijaQuote").css("display", "block!important");

        });

        $(".EndQuote").click(function() {
            $(".leelijaQuote").css("display", "block!important");
        });

        $("#EndQuote").click(function() {
            $(".leelijaQuote").css("display", "block");
        });

        $(".quote-close").click(function() {
            $(".leelijaQuote").css("display", "none");
        });

    });
    </script> -->
</body>

</html>