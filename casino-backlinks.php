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
require_once("classes/gp-package.class.php");
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
$gp				= new Gporder();
$GPPackage      = new GuestPostpackage();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);


if(isset($_GET['seo_url']))
	{
		 $seo_url			  		= $_GET['seo_url'];
		// $return_url 	= base64_decode($_GET["return_url"]); //get return url
	}

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <link rel="icon" href="images/logo/favicon.png" type="image/png">
    <title>Casino backlinks, Blogger Outreach: <?php echo COMPANY_S; ?></title>
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
    <link href="css/casino-backlinks.css" rel='stylesheet' type='text/css' />
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
    <!-- starting of Casino Backlinks main banner  -->
    <section class="casino-banner-section">
        <div class="casino-sizing-div">
            <h1 class=""> Link Building & Quality Backlinks For <br> <span>Casino &
                    iGaming</span></h1>
            <p class=" ">Do you want the feeling of winning
                advantage?
                Yes, you got the opportunity of collaborating with casino and online gambling link-building
                experts.
            </p>
            <div class="casino-btn-div mt-5">
                <button type="button" class="btn managed-link-btn ">Get Started</button>
            </div>
        </div>
    </section>
    <!-- end of Casino Backlinks  main banner -->
    <!-- --------------------------------------------------------------------------------------------- -->


    <!--Banner Dividor-->
    <?php //include ('quote.php') ?>
    <!--/End of baneer Dividor-->

    <!-- ______________________________________________________________________________________________ -->
    <!-- Challenges Of Casino Backlinks-section start -->
    <!-- -------------------------------------------------------------- -->
    <section class="challenges-casino-section">
        <div class="row">
            <div class="col-lg-6 col-md-6 ">
                <div class="">
                    <div>
                        <h1 class="">Challenges Of <br> <span>Casino Backlinks</span>
                        </h1>
                    </div>
                    <div>
                        <div class="py-4">
                            <div class="real-bo-secondcol-div1">
                                <div class="pe-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="text-start lbp-texting"> <b>High Competitive Domain </b>
                                    The market casino landscape is now very competitive. To stand in this market, one
                                    has to take high strategies and invest in innovative ideas to get the lead from own
                                    competitor.
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">

                                <div class="pe-3 trustworthy-img-div">
                                    <img src="./images/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="text-start lbp-texting"> <b>Link Buildings</b>
                                    Challenges in the link building for casino site is immense. Because not many sites
                                    are not wanting to involve in it. Therefore, you need to choose an authentic site
                                    for this challenge.
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="">
                    <div>
                        <img src="./images/real-bo-img-col2.png" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
            <div class=" buttonsinfo ">
                <button type="button" class="btn blogger-btn ">See Pricing</button>
            </div>
        </div>
    </section>
    <!-- ---------------------------------------------------------------------------------------- -->
    <!-- Challenges Of Casino Backlinks-section end -->
    <!-- _______________________________________________________________________________________________ -->
    <!-- Link Building For Casino Sites start -->
    <!-- -------------------------------------------------------------------------------- -->
    <section class="challenges-casino-section">
        <div class="row ">
            <div class="col-lg-6 col-md-6 ">
                <div>
                    <img src="./images/casino-backlinks.png.webp" class=" w-100  mb-4 " alt="">
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div>
                    <h1 class="mb-5">Link Building For <br> <span>Casino
                            Sites</span>
                    </h1>
                </div>
                <div class="linkbuilding-casino">
                    <p>
                        Reaching your casino website at the top of organic search results is not a cup of tea for
                        seeing the market competition. However, if you take the right steps towards link buildings
                        can add extra sparkling to get online success and push towards far ahead. Our expert team
                        provides high-quality online gaming link-building services that guaranteed quick and
                        endurable results for ambitious online gambling and casino companies
                    </p>
                    <p>Online gaming link-building services and conventional link-building services are totally
                        different from each other. Because the iGaming link building is a different but challenging
                        platform. However, the casein o marketplace is very competitive. Therefore, you need the
                        help of link-building services to remain in the market or go ahead of your competitors in
                        the search engine ranking market.
                    </p>
                    <p>To remain on the search engine, you have to push extra effort to build trust for your
                        websites. As Google is not so inclined towards gambling and casino sites, you need to spend
                        extra time and endeavor. Therefore there is the only way to gain the trust of Google is by
                        building top-quality backlinks. And there is where we can help you. We have previous
                        experience working with a lot of online gambling clients. We knew what exactly the
                        challenges in the field were and how to sort them out. We will help you to make quality
                        backlinks by providing the best strategies.</p>

                    <div class=" buttonsinfo mt-5">
                        <button type="button" class="btn blogger-btn ">Get Started</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- --------------------------------------------------------------------------------------------- -->
    <!-- Link Building For Casino Sites end -->
    <!-- _______________________________________________________________________________________________ -->
    <!-- pricing link-building starts -->
    <!-- ================================================================================================ -->
    <!-- taking from guest-posting.php-page    -->

    <!-- <section class="blogger-fourth-section">
        <div class="price-table">
            <div class="">
                <h1 class="text-center pricing-bo-h1 mb-3">
                    Casino Backlinks Pricing</h1>
                <p class="text-center pricing-bo-p1 mb-3">We offer blogger outreach links categorised as <br> per DA,
                    DR, or organic traffic. Below is the pricing <br> for All 3 models.</p>
                <div class="price-table-box">
                    <div class="row mb-3">
                    <?php
				//	$gpPackage = $gp->showPackage();
					$singlePackage = $GPPackage->allPackages();
					foreach ($singlePackage as $package) {

				 ?>
                        <div class="col-md-4">
                            <div class="price-box-content" id="<?php echo $package['package_type'];?>">
                                <p class="package_type_cat"><?php echo $package['package_type'];?></p>
                                <div class="packHr"></div>
                                <p class="price-box-title"><span class="dollar">$</span><span
                                        class="main-price"><?php echo $package['price'];?></span></p>
                                <p class="chooseNiche"></p>
                                <ul class="price-box-ul">
                                    <li><i class="fas fa-check-square"> </i>Niche : <select class="select-niche"
                                            name="package-niche" id="pack<?php echo $package['package_type'];?>">
                                            <option value="" disabled selected>Choose Niche</option>
                                            <?php
								$BlogMst  = $blogMst->ShowBlogNichMast();
								foreach($BlogMst as $row)
								{ ?>
                                            <option value="<?php echo $row['niche_name']; ?>">
                                                <?php echo $row['niche_name']; ?></option>
                                            <?php }	?>
                                        </select></li>
                                    <li><i class="fas fa-check-square"></i><?php echo $package['gp_number'];?> Blog
                                        Posts </li>
                                    <li><i class="fas fa-check-square"></i><?php echo $package['blog_quality'];?></li>
                                    <li><i class="fas fa-check-square"></i><?php echo $package['link_type'];?> Link</li>
                                    <li><i class="fas fa-check-square"></i>Content
                                        <?php echo $package['words_count'];?>+ Words</li>
                                    <li><i class="fas fa-check-square"></i>DA: <?php echo $package['DA'];?></li>
                                    <li><i class="fas fa-check-square"></i>TF :<?php echo $package['TF'];?></li>
                                    <li><i class="fas fa-check-square"></i>CF: <?php echo $package['CF'];?></li>

                                </ul>
                                <button type="button" name="package-purchase-btn" id="package-purchase-btn"
                                    class="package-purchase-btn">purchase now</button>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section> -->

    <!-- pricing link-building ends -->
    <!-- ================================================================================================ -->
    <!-- more information blogger outreach start -->

    <!-- contact top -->
    <?php include('more-info.php');?>
    <!-- //contact top -->

    <!-- more information blogger outreach ends -->
    <!-- ================================================================================================ -->
    <!-- __________________________________________________________________________________________ -->
    <!-- how it works section starts -->
    <!-- --------------------------------------------------------------------------------------------->
    <section class="how-itsworks-casino-section">
        <div class="how-itsworks-main-div-casino">
            <h1>
                How <strong>Does It Work</strong>
            </h1>
            <p>
                Casino link building is a process of blending relevant topics with sheer volume. We keep the basics the
                same but take unique steps for uncommon challenges in the industry. One has to partner with an expert to
                get help in this rank competitive space. Here we mentioned elements needed for the casino link-building
                strategy that we follow at Leelija Web solution.
            </p>

            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class=" ">
                        <img src="./images/casino-one-img.png" class="" alt="">
                    </div>
                    <h3>Manual Outreach</h3>
                    <div class="text-start">
                        With casino link-building services, we at Leelija manage manual outreach to high-authority and
                        niche-relevant blogs for ensuring our client’s backlinks. Our expert team keeps in contact with
                        these websites for hosting our bespoke content to reach the proper viewers.
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class=" ">
                        <img src="./images/casino-two-img.png" class="" alt="">
                    </div>
                    <h3>Content Creation </h3>
                    <div class="text-start">
                        Our native writers from UK and US create high-quality content that is packed with informative
                        and engaging content understanding the business needs. Moreover, as per the guidelines of the
                        blog site, it is going to publish, the content is beautifully crafted. In fact, we guaranteed
                        that each piece of content will be of top-notch quality and that will engage the audience more
                        and increase the audience interest.
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class=" ">
                        <img src="./images/casino-three-img.png" class="" alt="">
                    </div>
                    <h3>Monitoring Results</h3>
                    <div class="text-start">
                        If we are doing anything, it is always result-oriented. Therefore we keep a track report of our
                        all campaigns and make it transparent to our clients. That’s why clients can see the progress of
                        the project anytime. However, you can not casino link building will work for you instantly. It
                        will take time but we ensure that you will meet your expectations.
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- -=----------------------------------------------------------------------------------------------- -->
    <!-- how it works section ends -->
    <!-- _______________________________________________________________________________________________ -->
    <!-- Benefits Of Online Gaming And Casino Link Building- starts -->
    <!-- ------------------------------------------------------------------------- -->
    <section class="benifits-online-gaming-casino-section">
        <div>
            <h3>Benefits Of Online Gaming And Casino Link Building</h3>
        </div>
        <div>
            <h4>Crystallizing Relationships</h4>
            <p>Link building doing the work of building a relationship between niche influencers and the audience you
                preferred. Moreover, the outreach strategy is to reach authentic bloggers in your zone and collaborate
                with high-quality content. When you get appreciation from them it will easily boost your site. We know
                how important is this relationship and we ensure we will keep improving the relationship.
            </p>
        </div>
        <div>
            <h4>Driving Referral Traffic</h4>
            <p>A perfect link-building service always attaches your site with high-quality and huge organic traffic
                website. When this process is successfully done, your site will start to get referral traffic from the
                linked website. That brings quality organic traffic to your site. Therefore, our expert link-building
                team selects the best available site in the market that helps our client bring more organic traffic.
            </p>
        </div>
        <div>
            <h4>Brand Building</h4>
            <p>Link building is not all about taking your website to the top of the search engine results. It also works
                as a booster for building brands and getting ahead of your competitor. Our expert content writers create
                content that represents your brand and increases its value. In addition, our prominent SEO boosts your
                site to give you the recognition you want.
            </p>
        </div>


    </section>
    <!-- ------------------------------------------------------------------ -->
    <!-- Benefits Of Online Gaming And Casino Link Building- ending -->
    <!-- _______________________________________________________________________________________________ -->

    <!-- ------------------------------------------------------------------ -->
    <!-- Why Choose Leelija WebSolution For Casino Link Building Services? starts -->
    <!-- _______________________________________________________________________________________________ -->

    <section class="why-choose-leelija-casino-section">
        <div>
            <h3>Why Choose Leelija WebSolution For Casino Link Building Services?</h3>
            <ul>
                <li>Our gambling link-building services always tilted toward more traffic and improved search engine.
                </li>
                <li>After placing an order, the client gets a professional expert from Leelija for giving quick replies
                    and clearing all queries. Therefore, the client can match up their expectations.</li>
                <li>We have a huge database of diverse niches from different regions and languages. Therefore, getting
                    the best site for your site will not be a problem for us.</li>
                <li>We have a special outreach team for online gaming, casino, and iGaming domain. Therefore, you can
                    contact us to get the best results without depending on which type of business you run.</li>
            </ul>
            <div class="casino-building-services-maindiv">
                <h1>If My Casino Website Really <br> <span><i>Needs Link-Building Services?</i> </span></h1>
                <p>
                    Yes, undoubtedly, you need it. It is your online presence. Moreover, this is the best way to stay
                    ahead of your competitor. However, you need to invest in a professional online gaming link-building
                    process. If you want to get local customers or international viewership, link building is the best
                    process to start of.

                </p>
            </div>
        </div>
    </section>
    <!-- ------------------------------------------------------------------ -->
    <!-- Why Choose Leelija WebSolution For Casino Link Building Services? ending -->
    <!-- _______________________________________________________________________________________________ -->
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
    <!-- ================================================================================================ -->

    <div class="mt-4">
        <?php include('seller-action.php') ?>
    </div>
    <!-- ================================================================================================= -->
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