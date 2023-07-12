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
    <title>Cannabis Backlinks , Blogger Outreach: <?php echo COMPANY_S; ?></title>
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
    <link href="css/cannabis-backlinks.css" rel='stylesheet' type='text/css' />
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
    <!--____________________________________________________________________________________________ -->
    <!-- Cannabis Backlinks main banner starting -->
    <section class="managed-link-building-main-banner">
        <div class="container mlb-main-cntainer">
            <div class="row mlb-main-start-row">
                <div class="col-12 col-lg-5 col-md-5 vid-col">
                    <div class="">
                        <img src="./images/cannabis-backlinks-main-banner.png " class="w-100" alt="">
                    </div>
                </div>
                <div class="col-12 col-lg-7 col-md-7  px-0 px-md-4">
                    <div class="mlb-wrapping">
                        <h1 class="mlb-starting-main-h1">Cannabis Backlinks </h1>
                        <p class=" mt-5 mb-4 py-0 py-md-2 mlb-starting-main-p">Do you want high-quality traffic and a
                            high rank on SERP?<br>
                        	We are the one-stop solution with cannabis and CBD link-building services.
                        </p>
                        <!-- <div>
                            <ul>
                                <li class="tick-check"> &#10004; <b class="tick-check-p">We are the one-stop solution
                                        with <br> cannabis and CBD link-building services.
                                    </b> </li>

                            </ul>
                        </div> -->
                        <div class=" buttonsinfo mt-5">
                            <button type="button" class="btn managed-link-btn ">See Pricing</button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- end of Cannabis Backlinks main banner -->
    <!-- --------------------------------------------------------------------------------------------- -->
    <!-- _______________________________________________________________________________________________ -->
    <!-- Collaboration opportunity-cb start -->

    <section class="lbs-actually-matters-main">
        <div class="row">
            <div class="col-xl-6 col-md-6 m-auto">
                <div class="">
                    <div>
                        <img src="./images/cannabis-2ndsec.png" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
            <div class=" col-xl-6 col-md-6">
                <h1 class="lbs-actually-matters-main-h1 ">Collaboration opportunity With
                    <span>Cannabis & CBD SEO Link Building Specialist</span>
                </h1>
                <p>
                    <i> As per the latest data report of Global CBD Market 2021-2025, it is expected that the cannabis &
                        CBD
                        industry is to touch $33.6 billion.</i>
                </p>

                <p>In recent past years, everyone saw the devastating growth of
                    the cannabis industry. Expert opines that this growth is due to extending the legalization of
                    Cannabis. Therefore the CBD market is expanding quickly. However, it is a very fresh market. That’s
                    why coming to this market would be very challenging for you.</p>
                <p>Leelija assures that your business
                    will get organic growth through a perfect link-building strategy. We are already in the cannabis
                    market the last few times. Therefore we got adequate experience in the CBD & Cannabis market.</p>


                <div class=" buttonsinfo mt-3">
                    <button type="button" class="btn managed-link-btn ">View Pricing</button>
                </div>
            </div>

        </div>

    </section>
    <!-- Collaboration opportunity-cb ends -->
    <!-- _________________________________________________________________________________________________ -->

    <!--========= Cannabis Link Building Or Regular Link Building-  Start =========-->
    <section class="cannabis-clb-rlb-section">
        <div class="cannabis-clb-rlb-main-div ">
            <h2>Cannabis Link Building Or Regular Link Building - <strong>What To Choose And Why?</strong> </h2>

            <ul>
                <li> <span><i class="fa-solid fa-circle-check"></i></span> Outreach expert team vetting only due to CBD
                    niche.</li>
                <li> <span><i class="fa-solid fa-circle-check"></i></span> A large amount of CBD link inventory.
                    Moreover, it is continuously growing.</li>
                <li> <span><i class="fa-solid fa-circle-check"></i></span> The team of content writers specialized in
                    making creative CBD niche content.</li>
                <li> <span><i class="fa-solid fa-circle-check"></i></span> Have experience in the campaigning of
                    CBD-relevant audiences. </li>

            </ul>
            <div class=" buttonsinfo mt-5 justify-content-center cannabis-for-smallsizing">
                <button type="button" class="btn managed-link-btn ">View Pricing</button>
            </div>
        </div>
    </section>


    <!---------- Cannabis Link Building Or Regular Link Building-  End ---------------------->
    <!-- ____________________________________________________________________________________________ -->
    <!-- _______________________________________________________________________________________________ -->
    <!-- How will Leelija Help You To Grow in the CBD business? start -->

    <section class="cbd-business-main-section">
        <div class="row">
            <div class="col-xl-6 col-md-6 m-auto">
                <div class="">
                    <div>
                        <img src="./images/cannabis-cbd-div-img.webp" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
            <div class=" col-xl-6 col-md-6">
                <h1 class="cbd-business-main-section-h1 ">How will Leelija Help You
                    <strong>To Grow in the CBD business?</strong>
                </h1>

                <ul>
                    <li> <span> <i class="fa-solid fa-square-check"></i></span> Selecting the ideal link placement</li>
                    <li> <span><i class="fa-solid fa-square-check"></i></span> The growth of the campaigns will be
                        focused and metric-oriented.</li>
                    <li> <span><i class="fa-solid fa-square-check"></i></span> Hassle-free service</li>
                    <li> <span><i class="fa-solid fa-square-check"></i></span>Result oriented solution </li>
                    <li> <span><i class="fa-solid fa-square-check"></i></span> Valuable and readable content for viewers
                    </li>
                </ul>

                <div class=" buttonsinfo ">
                    <button type="button" class="btn managed-link-btn ">View Pricing</button>
                </div>
            </div>

        </div>

    </section>
    <!-- Collaboration opportunity-cb ends -->
    <!-- _________________________________________________________________________________________________ -->

    <!-- pricing link-building starts -->
    <!-- ================================================================================================ -->
    <!-- taking from guest-posting.php-page    -->

    <!-- <section class="blogger-fourth-section">
        <div class="price-table">
            <div class="">
                <h1 class="text-center pricing-bo-h1 mb-3">Cannabis Backlinks Pricing</h1>
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
    <!-- __________________________________________________________________________________________ -->

    <!-- ================================================================================================ -->
    <!-- more information link-building start -->


    <!-- contact top -->
    <?php include('more-info.php');?>
    <!-- //contact top -->



    <!-- more information link-building ends -->
    <!-- ================================================================================================ -->


    <!-- __________________________________________________________________________________________ -->
    <!-- Why is Link Building Important for Cannabis Business? start -->

    <section class="why-is-lb-important-main pb-0">
        <div class="row">
            <div class="col-xl-6 col-md-6 m-auto">
                <div class="">
                    <div>
                        <img src="./images/AMAZING-BO-.col-1.png" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
            <div class=" col-xl-6 col-md-6">
                <h1 class="why-is-lb-important-main-h1 ">What is the Importance of Link Building
                    <span>For the Cannabis and CBD Industry?</span>
                </h1>
                <p>
                    Link Building is a major essential part of the SEO industry for revenue-boosting. It is considered
                    the most significant factor. At Leelija we do manually fresh outreach to niche relevant websites as
                    per the client’s site.
                </p>

                <p>On the other hand link building is the tried and tested method of increasing traffic to the client’s
                    website. The client’s site got more visibility and could attract more customers through link
                    building. We know and give value to get customers from organic traffic and referral sites to achieve
                    a higher position in the SERP. </p>
                <p>Every customer has different needs and different ideas to run their business. At Leelija, we create a
                    customized plan for every link-building strategy to bring more traffic to you. Our expert team has
                    already gained experience in the CBD sector. Therefore, they have clear ideas of how to plan an
                    outstanding backlink strategy to bring more viewers to your site.</p>

                <p>At Leelija we offer 100% traffic to our eminent clients in an authentic way to improve the brand’s
                    awareness. Moreover, the brand will get its potential customer to grow the business by boosting
                    search engine traffic.</p>
            </div>
        </div>
    </section>
    <!-- Why is Link Building Important for Cannabis Business?  ends -->
    <!-- __________________________________________________________________________________________ -->
    <!-- __________________________________________________________________________________________ -->
    <!-- Why is Link Building Important for Cannabis Business? start -->

    <section class="improve-your-roi-organic-main ">


        <div class="row ">

            <div class=" col-xl-6 col-md-6">
                <h1 class="why-is-lb-important-main-h1 ">Improve Your ROI In The CBD Business With Through
                    <span> Organic Growth Plan!</span>
                </h1>
                <p>
                Our expert team of CBD and Marijuana businesses will give tactics that 10% work for you. With our professional SEO team, your website’s backlinks and traffic will definitely increase. Our professional team will analyze your site and after that their experience, they will give solutions and SEO strategies to boost your company in the Cannabis business.
                </p>

                <p>Organic growth is the most valuable factor in a business. Everyone knows it very well that there is no shortcut process to get a long time organic growth. Therefore, our expert team analyzes very well before implementing anything. They made strategies based on your business model and target audience.</p>
                <p>The content is always king. There is no match-up anything with it. Our native writers of the UK and US create outstanding and niche-relevant content that is loved by viewers. Therefore, it became easier to fetch backlinks and that’s why brand visibility improves.</p>



            </div>
            <div class="col-xl-6 col-md-6 m-auto">
                <div class="">
                    <div>
                        <img src="./images/cannabis-important-lb.webp" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Collaboration opportunity-cb ends -->
    <!-- __________________________________________________________________________________________ -->
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
                    <h4 class="faq-title">How to get ranked on Google for the CBD website?</h4>
                    <div class="faq-details">
                        <p>
                        At Leelija, we follow every rule and norm of Google to fetch more traffic to your site. We provide whole unique niche relevant content and the best possible link placements according to your DA preference of CBD-related websites. And that helps the client to get a higher rank in google search results. </p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What is the role of SEO in the CBD business?</h4>
                    <div class="faq-details">
                        <p>SEO has a very important role in the online CBD business. The cannabis market is very young but challenging. Therefore, one has to do something unique but useful to achieve huge traffic. SEO will help you to do that. They will analyze your website and make strategies for your business growth.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How authority of a CBD site can be increased?</h4>
                    <div class="faq-details">
                        <p>	To improve your domain authority, we will provide high-quality content and niche-relevant strategies on CBD. The whole content will be surrounded by CBD-related information and questions that are most people looking for.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title"> Is Link Building required for the Cannabis business?</h4>
                    <div class="faq-details">
                        <p>Yes, without any doubt. Link building is very important to any kind of business you are doing. CBD business is not an exception. It will help to boost the ranking of your website.
                        </p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How does Leelija develop backlinks?</h4>
                    <div class="faq-details">
                        <p>Our expert team at Leelija has high experience in the CBD business. Theft is always in research for high authority sites. They keep in touch with every top site to request backlinks. After that efficient writers create content that satisfies both the client and Google.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How Leelija is ahead of its competitor?</h4>
                    <div class="faq-details">
                        <p>	We ensure our client's top-quality backlinks in a short time. Our aim is to provide effective and essential features at a reasonable price. A client will get unique creative content and the best backlinks in a quick time.</p>
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