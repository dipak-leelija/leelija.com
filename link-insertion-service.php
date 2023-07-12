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
    <title>Link Insertion Service , Blogger Outreach: <?php echo COMPANY_S; ?></title>
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
    <link href="css/link-insertion-service.css" rel='stylesheet' type='text/css' />
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
    <!-- Link Insertion Services main banner starting -->
    <section class="managed-link-building-main-banner">
        <div class="container mlb-main-cntainer">
            <div class="row mlb-main-start-row">
                <div class="col-12 col-lg-7 col-md-7  px-0 px-md-4">
                    <div class="mlb-wrapping">
                        <h1 class="mlb-starting-main-h1">Link <span>Insertion</span> Services </h1>
                        <p class=" mt-3 mb-4 py-0 py-md-2 mlb-starting-main-p">Find your website link placed
                            contextually in suitable blog posts on authentic websites.
                        </p>
                        <div>
                            <ul>
                                <li class="tick-check"> &#10004; <b class="tick-check-p">100% editorial, niche relevant,
                                    </b> </li>
                                <li class="tick-check"> &#10004; <b class="tick-check-p">outreach-based edits for better
                                        traffic and better results </b></li>
                            </ul>
                        </div>
                        <div class=" buttonsinfo ">
                            <button type="button" class="btn managed-link-btn ">Get Started</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-lg-5 col-md-5 vid-col">
                    <div class="mlb-wrapping">
                        <img src="./images/leelija-outreach-team.png " class="w-100" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- end of Link Insertion Service main banner -->
    <!-- --------------------------------------------------------------------------------------------- -->
    <!-- _______________________________________________________________________________________________ -->
    <!-- Advantages Of Link Insert start -->

    <section class="lbs-actually-matters-main">
        <div class="row">
            <div class=" col-xl-6 col-md-6">
                <h1 class="lbs-actually-matters-main-h1 mb-3">
                    <span> Advantages </span> Of Link Insert
                </h1>
                <div class="actually-card-div1">
                    <div class="  actually-card-inn-img-div">
                        <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                    </div>
                    <div class="lbp-texting">
                        In the content, <b>Editorial Links</b> are inserted naturally, like within the flow of
                        words.
                    </div>
                </div>
                <div class="actually-card-div1">
                    <div class="  actually-card-inn-img-div">
                        <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img" alt="">
                    </div>
                    <div class="lbp-texting">
                        The links are placed naturally and published on <b>niche-relevant and authority websites</b>
                        for High URL Ratings.
                    </div>
                </div>
                <div class="actually-card-div1 ">
                    <div class="  actually-card-inn-img-div">
                        <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img" alt="">
                    </div>
                    <div class="lbp-texting">
                        <b>Genuine Outreach</b> offers valuable niche relevant edits on authentic websites.
                    </div>
                </div>
                <div class="actually-card-div1">
                    <div class="  actually-card-inn-img-div">
                        <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                    </div>
                    <div class="lbp-texting">
                        Guaranteed <b>Zero Duplication</b> Policy. Every time you got a unique site.
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 m-auto">
                <div class="">
                    <div>
                        <img src="./images/all-set-rank-to-google-768x635.png" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class=" buttonsinfo mt-3">
            <button type="button" class="btn managed-link-btn ">See Pricing</button>
        </div>
    </section>
    <!-- Advantages Of Link Insert ends -->
    <!-- _________________________________________________________________________________________________ -->

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
    </section>
    <!------------------------------------ Client Review section End ------------------------------------->
    <!-- ____________________________________________________________________________________________ -->

    <!-- pricing link-building starts -->
    <!-- ================================================================================================ -->
    <!-- taking from guest-posting.php-page    -->

    <!-- <section class="blogger-fourth-section">
        <div class="price-table">
            <div class="">
                <h1 class="text-center pricing-bo-h1 mb-3">Link Building Pricing</h1>
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

    <!-- How It Works-section starts -->
    <!-- __________________________________________________________________________________________ -->

    <section class="how-it-works-main-section">
        <h1>How It <span> <b>Works?</b> </span></h1>
        <div class="text-center py-4">
            <img src="./images/link-inserting-123img.png" class="how-it-works-1st-img" alt="">
        </div>


        <div class="row">
            <div class="col-md-4 col-xl-4">
                <div class="how-it-works-main-card-div">
                    <div class=" ">
                        <img src="./images/link-insertion-service-howitwork1.png" class="w-100" alt="">
                    </div>
                    <h4>Genuine <span>Outreach</span> </h4>
                    <p>
                        Just select which anchor text and URL you want to link for your site. Our expert outreach team
                        will find authentic websites and real blog posts for your specification. Moreover, they will
                        connect you with the site admins or owners to get perfect contextual link arrangements in their
                        posts. </p>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="how-it-works-main-card-div">
                    <div class="">
                        <img src="./images/link-insertion-service-howitwork2.png" class="w-100" alt="">
                    </div>
                    <h4>Valuable <span>Content</span> </h4>
                    <p>
                        We have prominent native writers from UK and US. they value every anchor text. Therefore, they
                        create niche relevant blog post and the anchor text are placed lawlessly in the content.</p>
                </div>
            </div>
            <div class="col-md-4 col-xl-4">
                <div class="how-it-works-main-card-div">
                    <div class="">
                        <img src="./images/link-insertion-service-howitwork3.png" class="w-100" alt="">
                    </div>
                    <h4>Reliable <span>Reporting</span> </h4>
                    <p>
                        You will get every real-time notification and view of single niche edit. The client can all
                        these features within your dashboard. Moreover, you will get to know the full DA metrics. Also,
                        a client can export a non-branded CSV that can be used for White Label reporting. </p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works-section ends -->
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
                    <h4 class="faq-title">What is a niche edits service?</h4>
                    <div class="faq-details">
                        <p>
                            Niche edits service is a process of securing linked placement in the existing blog posts.
                            This process has a lot of benefits like increased traffic or boosting site rankings. </p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Could I select the DA of the blog site?</h4>
                    <div class="faq-details">
                        <p>Yes, you can certainly choose from DA metrics. You need to check the DA metrics at the time
                            of order placement. However, after updating DA if the DA reduces we are not refunding money
                            or replacing the content. On the other side, if DA increases you do not have to pay extra
                            money.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How relevant will be the content?</h4>
                    <div class="faq-details">
                        <p> Our expert team has long years of experience in this field. They ensure the relevance of the
                            blog site. On the other hand, our prominent writers create a relevant topic and will insert
                            the anchor text flawlessly.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can I Approve Content or Site before placing the links?</h4>
                    <div class="faq-details">
                        <p>No, we are not offering pre-approval. However, you can check through our dashboard of live
                            progression. We ensure that the content will be purely non-promotional and niche relevant.
                        </p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">In which of the countries did you secure the placements?</h4>
                    <div class="faq-details">
                        <p> Majorly we offer placements on the UK and US blogs. However, we have tied it with several
                            other countries' blog sites. </p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Do you accept orders for adult, gambling, or pharmaceutical?</h4>
                    <div class="faq-details">
                        <p> Yes, we do. However, our past experience says that building a very good link building is
                            tough in these niches. Still, you can discuss this with us in this regard.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Who writes content for blogs?</h4>
                    <div class="faq-details">
                        <p>Leelija has an in-house team of native writers from the US and UK to create content on your
                            behalf of you. They very experience that the quality of the content will never be
                            compromised. Moreover, they ensure that the link will be full and natural.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Where are the links placed?</h4>
                    <div class="faq-details">
                        <p> Our expert content writing team understands your website. And they write niche relevant
                            traffic and the anchor text with th link beautifully placed. </p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How long does the link placement last?</h4>
                    <div class="faq-details">
                        <p> There is no time of staying in link placements. It can stay long for indefinite days.
                            However, we guaranteed that the link will remain at least for 120 days.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What will happen if you can not find any relevant link?</h4>
                    <div class="faq-details">
                        <p> In case of any problem or issue, we will keep updating you. Even if we do not fulfill your
                            terms will refund all amounts of money. However, till date, we are not facing such issues.
                            Therefore you can trust us.
                        </p>
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