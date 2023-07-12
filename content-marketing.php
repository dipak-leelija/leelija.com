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
    <title> What is Content Marketing? | Content Marketing Guide | Leelija </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Leelija is an effective content marketing agency,helps you to grow your content marketing plan,among many content marketing companies leelija provides best content marketing services." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="what is content marketing,content marketing strategy,content marketing agency,content marketing services,content marketing plan,
what is content marketing strategy,content marketing companies,content marketing guide,content marketing for business,content marketing for small business,digital content strategy,seo content marketing,digital content marketing,content marketing for startups,seo and content marketing,creating a content strategy,content marketing firm,content planning strategy,content marketing,content marketing platform,content marketing consultancy" />
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
            <h1 class="blogbanner-heading">CONTENT MARKETING </h1>
            <div class="wd_heading_details_2">
                <p class="mt-4">
                    Contentment marketing is the marketing process or business process that producing, posting and
                    distributing informative, unique, valuable, well understood and proper content to attract the
                    readers
                    and visitors, so that it can be profitable to driving customers on the website. Content is used to
                    attract the attention of the readers, to increase customer base, to expand brand awareness, to
                    develop
                    online selling, and expand the community with the customers.

                </p>
            </div>
            <h2 class="text-center  mt-5 mb-4 first_title  ">Examples of content marketing</h2>
            <p class="text-justify service-heading-details">With the help of Content marketing, you can able to show
                your
                valuable and informative thoughts and ideas with the customers. Here are some examples of content
                marketing
                :
            </p>
        </div>

        <section class="Social_Media_Marketing">
            <!-- <h2 class="text-center first_title">Examples of content marketing</h2> -->
            <section class="native-content-section">
                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-lg-6">
                            <img src="images/blogging2.png" alt="Blogging content marketing" class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">Blogging content marketing</h3>
                            <p class="social-media-point"> Most people think the types of content marketing are the
                                starting
                                point and blogging helps to drag visitors with useful information. Hupspot, buffer, Rip
                                Curl
                                are the blogging content marketing example. Those companies used guest blogging, writing
                                content daily and publishing on high visibility sites. And it helps them to attract many
                                visitors on their sites.</p>
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
                            <h3 class="native-content">Social media content marketing</h3>
                            <p class="social-media-point">Glossier, Intrepid Travel, Superdrug, GE, John Deere, and AARP
                                are
                                the example of social media content marketing. Social media content marketing indirectly
                                helps to grow search ranking and many companies have their focused on social media
                                content
                                marketing. Those companies are the great example of business to business content
                                marketing.
                                They share their thoughts on social sites like Instagram, Facebook, Twitter, Snapchat,
                                etc.
                                AARP is the magazine that has won award for the quality of it content, photography and
                                design. This magazine company has achieved their success because of they listen their
                                readers who reach them by email, and social media. </p>
                        </div>
                        <div class="col-lg-6">
                            <img src="images/social-media.png" alt="Social media content marketing" class="w-100">
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
                            <img src="images/visual.png" alt="Visual content marketing" class="w-100">
                        </div>
                        <div class="col-lg-6">
                            <h3 class="native-content">Visual content marketing</h3>
                            <p class="social-media-point">Zomato, Shutterstock, Rolex, Amazon, Flipcart, etc are the
                                example
                                of visual content marketing. In these content marketing images is the lifeblood; using
                                visual content marketing those companies increase their brand. Zomato is the restaurant
                                finder mobile app that is available in many countries and it increases its popularity by
                                creating and sharing particular and perfect I images. Shutterstock is the business of
                                huge
                                images and this site able to attract billion of visitors in their site. Amazon and
                                Flipcart
                                are the online shopping sites and a huge number of visitors visit in those sites. </p>
                        </div>
                    </div>
                </div>
            </section>

        </section>

        <section class="blogger-fourth-section">
            <div class="container">
                <h2 class="text-center mb-3 first_title ">How to make your content marketing more effective?</h2>
                <div class="wd_heading_details_2">
                    <p class="mt-4 mb-4">
                        At first, you should have a plan to make your content more attractive and more compatible. You
                        should know that the reader’s choice and what types of content they want to read. Research the
                        keywords that many people try to search on social media. You should know the audience mind and
                        know
                        when and where to post your content. Should keep in mind that the content must be valuable and
                        informative that can get more attention from the audience. it is important to mix up your
                        content
                        with text, images, videos and graphics and experiment.
                        Not only focus on the search engine but also focus on people that what they try to search on
                        Google,
                        once you able to read the mind of readers then you will be very successful content writer. And
                        at
                        last always optimize, test and analysis your content that are very effective for your business.
                    </p>
                </div>
                <h2 class="text-center mb-3 first_title ">The importance of content marketing?</h2>
                <div class="wd_heading_details_2">
                    <p class="mt-4 mb-4">
                        Content marketing is very essential for making your brand modern and it is the heart of many
                        successful digital marketing companies. Informative and relevant content connected with the
                        success
                        of many companies. Here we discuss about the importance of content marketing:
                    </p>
                </div>
                <div class="row align-items-center m-0">

                    <div class="col-lg-6 pl-0">
                        <img src="images/brand-reputation.png" alt="Improve brand reputation" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Improve brand reputation</h3>
                            <p class="mb-5">Content marketing builds the reputation of many businesses by its quality of
                                great content writing. In modern busy market place most business build trust for their
                                customers and it helps to gain positive reputation. With the help of great content you
                                can
                                earn trust from your customers as your customers read your content and know the opinion
                                of
                                the brand. If in the content they see the educational and informative ideas then they
                                can
                                think about your business. </p>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Help to influence conversation</h3>
                            <p class="mb-5">Content marketing is important to improve website conversation and it
                                provides
                                high conversation rate than other marketing methods. After reading submissions on the
                                blog
                                many online customers decides to purchase it. Content marketing has increased marketing
                                leads in many companies and it helps to improve conversation because it allows
                                connecting
                                with the customers. </p>

                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/setup_fees.png" alt="Help to influence conversation" class="w-100">
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/efforts.png" alt="Improve SEO efforts" class="w-100">
                    </div>

                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Improve SEO efforts</h3>
                            <p class="mb-5">Content marketing plays an important role to build your business and
                                increase
                                search engine optimization. This search engine optimization helps you to show your
                                business
                                online, so you need optimize content to improve SEO. If you have many contents on your
                                sites
                                then the more pages search engine has to index. Thus it easily shows to the users in
                                their
                                searching result. </p>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Effective way to bring in new leads</h3>
                            <p class="mb-5">Content marketing is important because it helps you to bring your business
                                in
                                new leads. It boosts to grow your brands and helps to sales the products and it is
                                essential
                                for growing small business. It three time produce many lead and paid search ads. </p>

                        </div>
                    </div>
                    <div class="col-lg-6 pl-0">
                        <img src="images/OffPageSEO_Services.png" alt="Effective way to bring in new leads"
                            class="w-100">
                    </div>
                    <div class="col-lg-6 pl-0">
                        <img src="images/relationship-customer.png" alt="Build relationship with customers"
                            class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Build relationship with customers</h3>
                            <p class="mb-5">Content marketing build relationship between blogger and customers and royal
                                customers are advantage for your business. Content that contains valuable information to
                                your customers and that will help to increase the relation with the customers.
                                With those important discussions, you can understand that why is content marketing
                                important
                                to start a business. You should work on increasing on content marketing strategy that
                                can
                                improve your business.
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </section>
        <section class="go-to-regiser-sec mt-3">
            <div class=" go-to-regiser orienta-font">
                <div class="container">
                    <div class="go-to-regiser-head">
                        <h4 class="text-center"> For best outreach services </h4>
                    </div>
                    <div class="registerBtn text-center">
                        <a href="login.php" class="btn btn-primary">register now</a>
                    </div>
                </div>
            </div>
        </section>

        <div class="blogger-faq">
            <div class="faq-head-section text-center">
                <h3>Frequently Asked Questions On Content Marketing</h3>
                <p>Submit your requirement or query, We will process it within 24 hours.</p>
            </div>
            <div class="container">
                <ul class="faq-body">
                    <li class="faq-li">
                        <i class="fas fa-plus" id="first_id"></i>
                        <h4 class="faq-title">What is content marketing?</h4>
                        <div class="faq-details">
                            <p>
                                Content marketing is a beneficial marketing method that basically focused on creating
                                and
                                distributing informative, valuable, relevant information to attract the defined audience
                                and, ultimately drive much profit from customer action. </p>
                        </div>
                    </li>
                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What is creative content marketing?</h4>
                        <div class="faq-details">
                            <p>Creative content marketing is significantly more than blog posts and website content,
                                incorporating everything from the social media content, to photographs and custom
                                pictures
                                like infographics, and even sound and video. That implies unlimited opportunities for
                                inventive, creative employments of content marketing for brands, everything being equal.
                            </p>
                        </div>
                    </li>
                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What is the purpose of content marketing?</h4>
                        <div class="faq-details">
                            <p>Every business company needs a plan or design for their social marketing strategy. Your
                                marketing strategy will help you to summarize and plan everything for your business</p>
                        </div>
                    </li>
                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What are the best ways to do content marketing?</h4>
                        <div class="faq-details">
                            <p>There are many ways to do content marketing such as you should have a proper plan, know
                                what
                                your audience like, remember quality over quantity, optimize your content, know when and
                                where to post, mix up your content with valuable information.</p>
                        </div>
                    </li>
                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How is SEO and Content Marketing related?</h4>
                        <div class="faq-details">
                            <p>SEO and content marketing is highly related to each other as SEO shares a symbiotic
                                connection with content marketing. Though SEO is a technical process it ensures traffic
                                to
                                your website. Content marketing uses attractive contents that are initiative to connect
                                the
                                audience.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How relevant are keywords in content marketing for SEO?</h4>
                        <div class="faq-details">
                            <p>It is very important to use right keywords in the content for your website. If you use
                                good
                                and relevant keywords it can ensure that your webpage would rank high on SERPs. However,
                                it
                                is equally important that do not over use the relevant keywords in the overall content.
                                When
                                we work on targeted keywords, we should do a detailed analysis. We create highly
                                authoritative and quality content to boost ranking in search engines. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How do you ensure quality content for content marketing and SEO?</h4>
                        <div class="faq-details">
                            <p> Quality content has a higher probability of getting indexed and ranking higher soon as
                                compared to the low-quality content. We develop content keeping in mind all the
                                necessary
                                requirements that are needed for rankings. </p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-4">
            <?php include('seller-action.php') ?>
        </div>

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
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
    <!-- <script src="js/responsiveslides.min.js"></script>
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
    </script> -->
    <!-- //Banner text  Responsiveslides -->
    <!-- start-smooth-scrolling -->
    <!-- <script src="js/move-top.js"></script> -->
    <!-- <script src="js/easing.js"></script> -->
    <!-- <script>
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