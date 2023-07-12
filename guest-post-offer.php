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
// require_once("classes/login.class.php");
// require_once("classes/services.class.php");

require_once "classes/gp-offer.class.php";
//require_once("../classes/front_photo.class.php");
// require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");
require_once("classes/gp-order.class.php");
/* INSTANTIATING CLASSES */
$dateUtil       = new DateUtil();
$error 			= new Error();
$search_obj	    = new Search();
$customer		= new Customer();
// $logIn			= new Login();
$GpOfferList  = new GpOfferList();
// $service		= new Services();
// $blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
// $gp				  = new Gporder();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);



if(isset($_GET['seo_url'])){
	$seo_url			  		= $_GET['seo_url'];
	// $return_url 	= base64_decode($_GET["return_url"]); //get return url
}


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
    <title>Blogger Outreach Services, Guest Post Service: <?php echo COMPANY_S; ?></title>
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

    <div class="blogger-banner  banner">
        <h1 class="blogbanner-heading">Our Premium Service in Guest Posting</h1>
        <div class="gp-heading-details-2">
            <p>
                In the last couple of years, we are one of the leading companies in the SEO and Digital
                Marketing Sector. <br> We helped a lot of brands to stand in the market with our professional
                SEO and Guest Posting Services.<br> We worked as a team with the company to catch more leads on the website.

            </p>

        </div>

    </div>

    <!--Banner Dividor-->
    <?php //include ('quote.php') ?>
    <!--/End of baneer Dividor-->


    <!-- ================================================================================================ -->

    <section class="blogger-fourth-section">
        <div class="price-table">
            <div class="container">


                <div class="price-table-box">
                    <div class="row mb-3">
                        <?php
                        $list = $GpOfferList->getGpOfferList();
                        foreach($list as $blog){
                    
                    echo '<div class="col-md-4 mb-3">
                            <div class="item_bx" id="">     
                                <p class="package_type_cat"><a href="'.$blog['link'].'" target="_blank">'.$blog['domain'].'</a></p>
                                <p class="price-box-title"><span class="item_dollar">$</span><span
                                        class="item_price">'.$blog['price'].'</span></p>
                                <ul class="item_bx_ul">
                                    <li><i class="fas fa-check-square"></i> 1 Blog Post </li>
                                    <li><i class="fas fa-check-square"></i>'.$blog['follow'].' Link</li>
                                    <li><i class="fas fa-check-square"></i>DA: '.$blog['da'].'</li>
                                    <li><i class="fas fa-check-square"></i>TF :'.$blog['pa'].'</li>
                                    <li><i class="fas fa-check-square"></i>Spam: '.$blog['spam'].'</li>
                                    <li><i class="fas fa-check-square"></i>Organic Traffic: '.$blog['organic_traffic'].'K</li>
                                </ul>

                                <a href="guest-post-offer-order.php?data-id='.$blog['id'].'"><button>Order Now</button></a>
                                <!-- <form action="guest-post-offer-order.php" method="post">
                                <button >Order Now</button>
                            </form> -->
                            <!-- <button type="button" name="package-purchase-btn" id="package-purchase-btn"
                                class="package-purchase-btn">purchase now</button> -->

                            </div>
                        </div>';
                            }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </section>



    <!-- ================================================================================================ -->


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


    <!-- ===================================================================================================== -->



    <!-- ================================================================================================ -->

    <div class="blogger-faq">
        <div class="faq-head-section text-center">
            <h3>FAQs on Guest Posting Service</h3>
            <p>Submit your requirement or query, We will process it within 24 hours.</p>
        </div>
        <div class="container">

            <ul class="faq-body">

                <li class="faq-li">
                    <i class="fas fa-plus" id="first_id"></i>
                    <h4 class="faq-title">Is the guest post worthy to get more sales?</h4>
                    <div class="faq-details">
                        <p>
                        Yes, a guest post is very much important as it will set up a good relationship in the market and noise for your brand.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can I provide my content for publishing?</h4>
                    <div class="faq-details">
                        <p>Yeah, you can and we will appreciate your effort.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Could You write for my company?</h4>
                    <div class="faq-details">
                        <p>Yes, we have professional expert content writers. However, the content writing charge will additionally apply.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can I give you Anchor texts?</h4>
                    <div class="faq-details">
                        <p>Yes, you can give anchor text.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How much do you need to post my article?</h4>
                    <div class="faq-details">
                        <p>We respond to our clients very quickly. We will post your article within 72 hours.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Will google index my article?</h4>
                    <div class="faq-details">
                        <p>Of course. We only deal with high DA and high-traffic websites.</p>
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