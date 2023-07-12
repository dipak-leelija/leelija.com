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
    <title>Managed Link Building, Blogger Outreach: <?php echo COMPANY_S; ?></title>
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
    <link href="css/managed-link-building.css" rel='stylesheet' type='text/css' />
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
    <!-- starting of managed-link-building main banner -->
    <section class="managed-link-building-main-banner">
        <div class="container mlb-main-cntainer">
            <div class="row mlb-main-start-row">
                <div class="col-12 col-lg-7 col-md-7  px-0 px-md-4">
                    <div class="mlb-wrapping">
                        <h1 class="mlb-starting-main-h1">Link <span>Building</span> Services </h1>
                        <p class=" mt-3 mb-4 py-0 py-md-2 mlb-starting-main-p">We will lead you and your brand <br>
                            to a
                            new height.
                        </p>
                        <div>
                            <ul>
                                <li class="tick-check"> &#10004; <b class="tick-check-p">Quality over Quantity</b>
                                </li>
                                <li class="tick-check"> &#10004; <b class="tick-check-p">Relevant, White Hat Links
                                    </b></li>
                                <li class="tick-check"> &#10004; <b class="tick-check-p"> No paid links, No PBNs</b>
                                </li>
                                <li class="tick-check"> &#10004; <b class="tick-check-p">Inhouse team of experts</b>
                                </li>

                            </ul>

                        </div>
                        <div class=" buttonsinfo ">
                            <button type="button" class="btn managed-link-btn ">See Pricing</button>
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
    <!-- end of managed-link-building main banner -->
    <!-- --------------------------------------------------------------------------------------------- -->
    <!-- _____________________________________________________________________________________ -->


    <!-- Trusted by top brands & SEO agencies for first page results SLIDER -->
    <!-- Examples of Blogs We Outreach To-blogger-outreach starts -->
    <section class="examples-of-blogs-main-div">
        <div>
            <h2 class="text-center">Trusted by top brands & SEO agencies <span>for first page results</span>
                <h2>
        </div>
        <div class="pb-5">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (15).png "
                        class="examples-img-div-short" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 py-2"> <img src="./images/Screenshot (16).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (17).png "
                        class="examples-img-div-short" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (18).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (19).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (20).png "
                        class="examples-img-div-short" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (21).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/Screenshot (20).png "
                        class="examples-img-div-short" alt="">
                </div>

            </div>
        </div>
    </section>

    <!-- Examples of Blogs We Outreach To-blogger-outreach ends -->
    <!-- Trusted by top brands & SEO agencies for first page results SLIDER -->

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


    <!-- Why does A brand need link buildings start -->
    <section class="a-brand-need-link-section">
        <div class="row  ">
            <div class="a-brand-need-link-main-div">
                <h1 class="text-center a-brand-need-link-main-h1 ">Why does <span>A brand need</span> link buildings?
                </h1>
            </div>
            <div class="col-lg-6 col-md-6 a-brand-need-link-main-col-1">
                <div class="">
                    <div>
                        <div class="mt-5">
                            <ul>
                                <li class="square-box-p"> <span class="sq-pen-css"> <i
                                            class="fa-solid fa-leaf fa-beat-fade"
                                            style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;     color: darkgreen; "></i></span>

                                    Google
                                    has
                                    complex algorithms to deal with. Therefore, backlinks still is an essential factor
                                    to determine the keyword for which the site is trending.
                                </li>
                                <li class="square-box-p"> <span class="sq-pen-css"> <i
                                            class="fa-brands fa-pagelines fa-beat-fade"
                                            style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075; color: #ffc107e0;   "></i></span>

                                    Link
                                    building
                                    is a vital part of SEO service. Depending on your link it signals to Google that
                                    your website has quality content resources.
                                </li>
                                <li class="square-box-p"> <span class="sq-pen-css"> <i
                                            class="fa-brands fa-canadian-maple-leaf fa-beat-fade"
                                            style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;color: brown;"></i></span>

                                    Moreover,
                                    if
                                    your site has more backlinks, it's a high possibility to get upper rankings.
                                </li>
                                <li class="square-box-p"> <span class="sq-pen-css"> <i
                                            class="fa-solid fa-spa fa-beat-fade"
                                            style="--fa-beat-fade-opacity: 0.67; --fa-beat-fade-scale: 1.075;color: #09e2e9;"></i></span>

                                    In fact,
                                    if
                                    your site got more backlinks, the value of your site significantly arises. The
                                    backlinks create an extra impression on google as your site is more trustworthy and
                                    credible.

                            </ul>
                        </div>

                        <div class=" buttonsinfo ">
                            <button type="button" class="btn managed-link-btn ">Get Your Links Now</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6">
                <div class="">
                    <div>
                        <img src="./images/all-set-rank-to-google-768x635.png" class=" w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--Why does A brand need link buildings end -->
    <!-- ________________________________________________________________________________________ -->

    <section class="a-brand-need-link-section mt-0 mb-0">
        <div class="row ">
            <div class="col-lg-6 col-md-6">
                <div class="">
                    <div>
                        <img src="./images/AMAZING-BO-.col-1.png" class="w-100  mb-4 " alt="">
                    </div>

                </div>
            </div>
            <div class="col-lg-6 col-md-6 a-brand-need-link-main-col-1">
                <div class="">
                    <div>
                        <div class="mt-5">
                            <p class="need-link-text-p mb-3">At Leelija, we are helping a lot of owners with our
                                high-quality link-building procedure. We will help you with our top-quality
                                link-building services that might easier your path to go for your big dream. Otherwise,
                                it might be difficult for you to touch that. We have expert teams that create content
                                strategies on our behalf of you. Through high-quality backlinks, your website’s profile
                                will be strengthened organically. </p>
                            <p class="need-link-text-p mb-3">Keep in touch with us for more details and to boost your
                                brand. </p>
                        </div>
                    </div>
                    <div>
                        <div class=" getyour-linkbtn mt-5 ">
                            <button type="button" class="btn managed-link-btn d-flex justify-content-right">Get Your
                                Links Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Why does A brand need link buildings section2 end -->
    <!-- ________________________________________________________________________________________ -->

    <!-- Our clients earned brand mentions from publications like... starts -->
    <section class="examples-of-blogs-main-div">
        <div class="plugging-div">
            <h1 class="plugging-div-main-h1  ">Our clients earned brand mentions from <span class="plugging-div-span">
                    publications like... </span></h1>
            <div class="plugging-div-main-img-divv">
                <img src="./images/takingfrommacrons.rozy.jpg" class=" clients-pubb-div-img    mb-5 " alt="">
                <img src="./images/takingfrommacrons.rozy.jpg" class="clients-pubb-div-img   " alt="">
            </div>
        </div>
    </section>
    <!-- Our clients earned brand mentions from publications like... ends -->
    <!-- ________________________________________________________________________________________ -->
    <!-- Link Building Services that Actually Matters-starts -->
    <section class="lbs-actually-matters-main">
        <div>
            <div class="row">
                <div class=" col-xl-6 col-md-6">
                    <h1 class="lbs-actually-matters-main-h1 mb-3">
                        Link Building Services <br> <span>That Actually Matters !</span>
                    </h1>

                    <div class="actually-card-div1">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Authority Backlinks : </b> <br> We help brands to create diverse link profiles. We
                            publish editorial writings on different authoritative domains.
                        </div>
                    </div>
                    <div class="actually-card-div1">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Detailed Vetting Process : </b> <br> Our expert team has done the whole outreach process
                            in properly oriented vetting. They look for unusual places that could be advantageous for
                            your company profile.
                        </div>
                    </div>

                </div>
                <div class="col-xl-6 col-md-6">
                    <div class="actually-card-div1 ">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Content is the key point : </b> <br> We do not provide content based on links. Moreover,
                            we create beautiful content that everyone loves to read.
                        </div>
                    </div>
                    <div class="actually-card-div1">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Increasing ROI: </b> <br> Our aim is to help the brand to achieve its target by
                            providing organic growth and increased ROI.
                        </div>
                    </div>
                    <div class=" getyour-linkbtn mt-5 ">
                        <button type="button" class="btn managed-link-btn d-flex justify-content-center w-100 ">Get Your
                            Links Now</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Link Building Services that Actually Matters-ends -->
    <!-- ________________________________________________________________________________________ -->

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
    <!-- ____________________________________________________________________________________________ -->

    <!-- our-secret-delivering-main-sec starts -->
    <section class="our-secret-delivering-main-sec">
        <div class="">
            <div>
                <h2 class=" text-center mt-4 my-3 our-secret-d-h2"> <span> Effective and Transparent</span> Link
                    Building
                    Process</h2>

            </div>
            <div class="our-secrect-delvry-main">
                <div class="row">
                    <div class="col-md-6 col-xl-6 ">
                        <div class="our-secret-delivering-main-card">

                            <div class="text-center pb-3 ">
                                <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4 ">Authentic Link</h4>
                            <p class="">
                                We have a huge database of industry related websites from authentic bloggers. These real
                                bloggers already gained trust in the market. After placing the order we reach out to
                                them for improving your online appearance. </p>

                        </div>

                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="our-secret-delivering-main-card">

                            <div class="text-center pb-3 ">
                                <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  ">Build Editorial Content</h4>
                            <p class="">
                                Our expert professionals research your website to generate unique content for your
                                brand. This magazine-style content increases the readership and viewership of your
                                website. </p>

                        </div>

                    </div>

                    <div class="col-md-6 col-xl-6">
                        <div class="our-secret-delivering-main-card">

                            <div class="text-center pb-3">
                                <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  ">Publication of Content</h4>
                            <p class="">
                                We communicate with manually outreached bloggers and keep in touch until the content is
                                published with a do-follow link. Moreover, we stay in the loop with the bloggers for
                                editing if needed before or after publishing. </p>

                        </div>

                    </div>
                    <div class="col-md-6 col-xl-6">
                        <div class="our-secret-delivering-main-card">

                            <div class="text-center pb-3">
                                <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  ">Report & Tracking</h4>
                            <p class="">
                                We provide a white label report and a SERP tracking dashboard. In the report you will
                                find where we created a link for you and the dashboard will help you to check the result
                                and plan for future campaigning. </p>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- our-secret-delivering-main-sec ends -->
    <!-- ______________________________________________________________________________________________ -->

    <section class="our-secret-delivering-main-sec pb-2">
        <div class="">
            <div>
                <h2 class=" text-center mt-4 my-3 our-secret-d-h2">Our Secret to Delivering Wanted Results <span>To Top
                        Brands</span> </h2>

            </div>
            <div class="our-secrect-delvry-main">
                <div class="row">
                    <div class="col-md-6 col-xl-3">
                        <div class="our-secret-delivering-main-card2">

                            <div class="text-start pb-3 ">
                                <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4 ">Campaign Customization</h4>
                            <p class="">
                                We arrange, create and cooperate to offer custom link-building campaigns that benefit
                                the company significantly. </p>

                        </div>

                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="our-secret-delivering-main-card2">

                            <div class="text-start pb-3 ">
                                <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  ">Enhance SERP</h4>
                            <p class="">
                                Our plan is very clear. Create top-notch do-follow links that cause high traffic to your
                                website. </p>

                        </div>

                    </div>

                    <div class="col-md-6 col-xl-3">
                        <div class="our-secret-delivering-main-card2">

                            <div class="text-start pb-3">
                                <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  ">Generate Revenue</h4>
                            <p class="">
                                Editorial and niche-relevant backlinks always lead to improving SERP. Generally, that
                                improves the website traffic. </p>

                        </div>

                    </div>
                    <div class="col-md-6 col-xl-3">
                        <div class="our-secret-delivering-main-card2">

                            <div class="text-start pb-3">
                                <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  ">Target Audience</h4>
                            <p class="">
                                Customer satisfaction is our main motto. At Leelija, we assigned a dedicated expert to
                                your account after placing an order. Therefore, your queries will be resolved very
                                quickly and you will get quick delivery. </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- our secret delivering result ends -->

    <!-- _______________________________________________________________________________________________ -->

    <!-- Why Leelija?-section start -->

    <section class="why-leelija-section-mains">
        <h1 class="why-leelija-h1">Why Leelija?</span> </h1>
        <div class="row  ">
            <div class="col-lg-6 col-md-6  m-auto ">
                <div class="">

                    <div>
                        <img src="./images/AMAZING-BO-.col-1.png" class="w-100  mb-4 " alt="">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 a-brand-need-link-main-col-1">
                <div class="">

                    <div>
                        <div class="py-4">
                            <div class="why-leelija-main-for-card">
                                <div class="  actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start ">
                                    Leelija is a <b> trustable white-label link-building provider</b> . We provide
                                    relevant backlinks through which you will find the result. Moreover, we customize
                                    services according to customer needs.
                                </div>
                            </div>
                            <div class="why-leelija-main-for-card">
                                <div class=" actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start ">
                                    We provide <b>guaranteed customer satisfaction</b> with our work. We will keep in
                                    touch after project delivery.
                                </div>
                            </div>
                            <div class="why-leelija-main-for-card">

                                <div class=" actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start">We provide a <b>dedicated account manager</b> after placing an
                                    order as the customer is our top priority.
                                </div>
                            </div>
                            <div class="why-leelija-main-for-card">
                                <div class=" actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start ">
                                    We provide <b>convenient dashboards</b> to check new orders or renew orders or the
                                    status of the order.
                                </div>
                            </div>
                            <div class="why-leelija-main-for-card">
                                <div class=" actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start ">
                                    We create <b>in-house content for better quality</b> . Your topic will be assigned
                                    to those who have experts in niche skills.
                                </div>
                            </div>
                            <div class="why-leelija-main-for-card">
                                <div class=" actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start ">
                                    We have a <b>huge database of authentic influencers</b> . Over the years we work
                                    with a lot of influencers for industry-related blogs.
                                </div>
                            </div>
                            <div class="why-leelija-main-for-card">
                                <div class=" actually-card-inn-img-div">
                                    <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img"
                                        alt="">
                                </div>
                                <div class="text-start ">
                                    Our expert checks all the aspects before submitting the project. Therefore, there
                                    will be <b>no duplicate links</b> .
                                </div>
                            </div>
                        </div>

                        <div class=" getyour-linkbtn mt-5 ">
                            <button type="button" class="btn managed-link-btn d-flex justify-content-center ">Get Your
                                Links Now</button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </section>
    <!-- Why Leelija?-section end -->
    <!-- ___________________________________________________________________________________________ -->

    <!--  What Makes Leelija So Special? starts -->

    <section class="lbs-actually-matters-main">
        <!-- style="background-image: linear-gradient(to right, #d4ddd80d, #e3c68582, #f7797d2e);" -->
        <div>

            <div class="row">
                <h1 class="lbs-actually-matters-main-h1 textttting mb-3">
                    What Makes <span>Leelija So Special?</span>
                </h1>
                <div class=" col-xl-6 col-md-6">
                    <div class="actually-card-div1 mb-4 mt-5">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-3.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Outsourcing Partner : </b> <br> Link building is a continuous process. We will keep in
                            touch with you at every step. We help a lot of owners by giving quality link profiles from
                            high-traffic websites.
                        </div>
                    </div>
                    <div class="actually-card-div1 mb-4">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> After Delivery Service </b> <br> After completing the whole project and publishing
                            content on behalf of you, still we will revisit them.
                        </div>
                    </div>

                </div>
                <div class="col-xl-6 col-md-6">


                    <div class="actually-card-div1">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-1.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Convenient Dashboard : </b> <br> We provide end-to-end subscriptions. After placing the
                            order we will do the hard work for you. For instance content creation to publishing it on
                            high-traffic websites, everything will be managed.
                        </div>
                    </div>
                    <div class="actually-card-div1">
                        <div class="  actually-card-inn-img-div">
                            <img src="./images/real-bo-ul-li-2.png" class="managed-page-second-ul-li-img" alt="">
                        </div>
                        <div class="lbp-texting">
                            <b> Keyword Selection : </b> <br> Our team is working in this field for several years. They
                            always set their eye on high ranked relevant keywords. Therefore, it will easily boost your
                            website rankings.
                        </div>

                    </div>

                </div>
                <div class=" getyour-linkbtn-for-lbs-matter  ">
                    <button type="button"
                        class="btn managed-link-btn d-flex justify-content-center external-css-fr-size ">Get Your
                        Links Now</button>
                </div>
            </div>
    </section>

    <!-- What Makes Leelija So Special? ends -->
    <!-- ______________________________________________________________________________________________ -->


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
                    <h4 class="faq-title">What Is Link Building Service?</h4>
                    <div class="faq-details">
                        <p>
                            The process of gathering website links with high authority websites to make it visible in
                            the search engines and for the users is known as Link Building. This service provides by an
                            SEO company. They work on optimizing the website. And this service is called link building
                            service.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can you reveal what types of tools you are using?</h4>
                    <div class="faq-details">
                        <p>We use a lot of tools for making the project the best in quality. We can say to you that all
                            the tools we use comply with the latest technologies and that will give you a massive
                            advantage over your competitors.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Do I Need to take link building strategy?</h4>
                    <div class="faq-details">
                        <p> Taking a strong strategy keeps you advantageous position among competitors. However, your
                            competitor also tries to get the best traffic from the market for growth. Therefore, having
                            a strong strategy will help you to maintain your position in the market.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How long it will take to get results?</h4>
                    <div class="faq-details">
                        <p> There is no definite for it. The result will depend on the website authoritativeness of the
                            website and some other factors. I can take up to half of a year or more than that. However,
                            you will feel the result later or sooner.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How Much Does a link building service cost?</h4>
                    <div class="faq-details">
                        <p> Link building is one of the crucial aspects, that affects website rankings. Always try to
                            put a healthy budget towards it. Then we can perform at our top-level potential. You can
                            take our free consultation.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How can you manage the link building process effectively?</h4>
                    <div class="faq-details">
                        <p> Handling the link building process is not a cup of tea for everyone. Unless you are an SEO
                            expert don’t try to do it. To get the best result contact us. We are in the market for
                            several years. And we know the A to Z of link building.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What Are The Key Advantages of Link building?</h4>
                    <div class="faq-details">
                        <p>When your article will be shown to others and waiting for that is baseless. Moreover,
                            creating good content is not gd enough. You have to promote the content so that more people
                            visit them.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How does link building work?</h4>
                    <div class="faq-details">
                        <p> Depending on your requirements the process of link building differs. Our expert team
                            analyzes your profile to select what can be linkable. After that, we suggest some additional
                            things to add that might easily be linkable.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Why link building is so important?</h4>
                    <div class="faq-details">
                        <p> As per the norms of google, backlinks are one of the top three reasons to take into account
                            for website ranking.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How many links are needed to build my website?</h4>
                    <div class="faq-details">
                        <p> Our expert team will research your profile, and after that, we will provide you with an
                            estimated number of links should need. However, we believe in quality more than quantity.
                        </p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Quantity or quality what matters most?</h4>
                    <div class="faq-details">
                        <p> Quality always matters most in every matter. Therefore, quality always matters most than
                            quantity in link building matters.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What is White hat link building?</h4>
                    <div class="faq-details">
                        <p> White hat link buildings are legitimate methods if building backlinks according to google
                            guidelines. The other backlink does not follow any google guidelines and results in
                            artificial backlinks.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What is manual link building?</h4>
                    <div class="faq-details">
                        <p> Manual link building is an automated process that is built by hand. Automatic link building
                            considers a “black hat strategy. </p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What Is a Link Building campaign?</h4>
                    <div class="faq-details">
                        <p> Link building is an endeavor for getting other websites to link to a targeted website.
                            Therefore, the targetted site’s google rank was boosted.</p>
                    </div>
                </li>
                 
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Is link building important for SEO?</h4>
                    <div class="faq-details">
                        <p> When a great website link with your website, that gives a massive boost to your site.
                            Therefore, link building is an important part of SEO. however, you should focus on content
                            rather than artificial link building.</p>
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