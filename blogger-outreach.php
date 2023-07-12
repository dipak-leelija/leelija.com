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
    <title>Blogger Outreach Services, Blogger Outreach: <?php echo COMPANY_S; ?></title>
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
    <link href="css/blogger-outreach.css" rel='stylesheet' type='text/css' />
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
    <!-- starting of blogger-outreach main banner -->
    <div class="">
        <section class="blogger_outreach_banner">
            <div class="container bo-main-cntr">
                <div class="row blog-1main-row">
                    <div class="col-12 col-lg-7 col-md-7  px-0 px-md-4">
                        <div class="bo-wrap">
                            <h1 class="blogout-main-h1">Blogger <span>Outreach</span> Services </h1>
                            <p class=" mt-3 mb-4 py-0 py-md-2 blogout-main-p">White-Hat, Niche Relevant, Editorial <br>
                                Backlinks For Best And Long Lasting Result
                            </p>
                            <div class=" buttonsinfo ">
                                <!-- <a href="contact.php" class="btn explore_btn mt-md-3 ms-2">See Pricing</a> -->
                                <button type="button" class="btn blogger-btn ">See Pricing</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-lg-5 col-md-5 vid-col">
                        <div class="bo-wrap">
                            <img src="./images/leelija-outreach-team.png " class="w-100" alt="">
                        </div>

                    </div>

                </div>
            </div>
        </section>
    </div>
    <!-- end of blogger-outreach main banner -->
    <!-- --------------------------------------------------------------------------------------------- -->


    <!--Banner Dividor-->
    <?php //include ('quote.php') ?>
    <!--/End of baneer Dividor-->

    <!-- ______________________________________________________________________________________________________ -->

    <!-- real-blogger-outreach-section start -->
    <section class="real-bo-section">
        <div class="row  real-bo-row1">
            <div class="col-lg-6 col-md-6 real-bo-col-first">
                <div class="">
                    <div>
                        <h1 class="real-bo-text-h1">Genuine Links, Authentic Influencers, <span> Favorable
                                Outcome</span> </h1>
                    </div>
                    <div>
                        <div class="py-4">
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="">
                                    create <b> content</b>
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">

                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="">
                                    <b>Secure </b> placements .
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1 mb-3">
                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="">
                                    Boost website <b> rankings</b>
                                </div>
                            </div>
                        </div>

                        <div class=" buttonsinfo ">
                            <!-- <a href="contact.php" class="btn explore_btn mt-md-3 ms-2">See Pricing</a> -->
                            <button type="button" class="btn real-bo-btn ">Get Your Links Now</button>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-6 real-bo-col-second">
                <div class="">
                    <div>
                        <img src="./images/dummy-img/real-bo-img-col2.png" class="w-100  mb-4" alt="">
                    </div>
                    <div>
                        <p class="real-bo-text-p mb-3">Leelija works with a lot of influencers for securing sustainable
                            and relevant links that easily enhance the client’s search engine rankings and offers
                            targeted traffic.</p>
                        <p class="real-bo-text-p mb-3">We valued every business and website for its uniqueness. Our
                            expert public relation team placement each and every link manually by handpicking.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- real-blogger-outreach-section end -->
    <!-- _______________________________________________________________________________________________ -->

    <!-- AMAZING -blogger-outreach-section start -->

    <section class="real-bo-section">

        <div class="row  real-bo-row1">
            <div class="col-lg-6 col-md-6 real-bo-col-second">
                <div class="">
                    <div>
                        <img src="./images/dummy-img/AMAZING-BO-.col-1.png" class="w-100  mb-4 " alt="">
                    </div>
                    <!-- <div>
                            <p class="real-bo-text-p mb-3">We work with influencers to secure relevant, sustainable
                                links that improve your search engine rankings and drive targeted traffic.</p>
                            <p class="real-bo-text-p mb-3">We understand that every business and website is unique, our
                                PR team manually handpicks each and every placement.</p>
                        </div> -->
                </div>
            </div>
            <div class="col-lg-6 col-md-6 real-bo-col-first">
                <div class="">
                    <div>
                        <h1 class="amazing-bo-text-h1">Creative Content + Prominent Placements <span> = Glittering
                                Results</span> </h1>
                        <div class="mt-3">
                            <p class="real-bo-text-p mb-3">Domain Authority is not a lone factor in our link-building
                                service model. Our main focus is to get the best outcome. Therefore, <b>Domain Ratings,
                                    previous link history, and Trust Flow </b> also matter.</p>
                            <p class="real-bo-text-p mb-3">Our created content passes through a couple of rounds of
                                tough editing</p>
                        </div>
                    </div>
                    <div>
                        <div class="py-4">
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class=""> Overall <b>creative Presentation</b> of Content
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">
                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="">
                                    Quality Outgoing links with <b>Adequate Quantity.</b>
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1">

                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="">Valued clients
                                    <b>preference list</b>
                                </div>
                            </div>
                            <div class="real-bo-secondcol-div1 mb-3">
                                <div class=" px-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <div class="">
                                   <b>Continuous monitoring </b>
                                   after placements
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
    <!-- AMAZING-blogger-outreach-section end -->
    <!-- ______________________________________________________________________________________________________ -->

    <!-- pricing blogger outreach starts -->
    <!-- ================================================================================================ -->
    <!-- taking from guest-posting.php-page    -->

   <!-- <section class="blogger-fourth-section">
        <div class="price-table">
            <div class="">
                <h1 class="text-center pricing-bo-h1 mb-3">Blogger Outreach Pricing</h1>
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
    </section>  -->


    <section class="blogger-fourth-section">
        <div class="price-table">
            <div class="container">
                <!-- <h2 class="text-center">No Contracts – Real Blogger Outreach – Fast Turnaround – Start NOW!</h2> -->
                <h2 class="text-center mb-3">Guest Post Placement Pricing</h2>


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
                                        <?php
                                        $features = $GPPackage->featureByPackageId($package['id']);
                                        // print_r($feature);
                                        foreach($features as $feature){
                                            echo '<li><i class="fas fa-check-square"></i>'.$feature['feature'].'</li>';
                                        }
                                        ?>
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
    </section>

    <!-- pricing blogger outreach ends -->
    <!-- __________________________________________________________________________________________________ -->

    <!-- ================================================================================================ -->
    <!-- more information blogger outreach start -->


    <!-- contact top -->
    <?php include('more-info.php');?>
    <!-- //contact top -->



    <!-- more information blogger outreach ends -->
    <!-- ================================================================================================ -->
    <!-- ______________________________________________________________________________________________________ -->
    <!-- Does-Blogger-Outreach Work For You starts -->
    <section class="works-for-you-bo-section">
        <div class="">
            <div>
                <h2 class=" text-center mt-4 my-3 works-bo-h2">How does blogger outreach  <span> work for your brand?</span></h2>
                <!-- <p class="text-center mb-3 works-bo-p1">
                    Our service is a perfect match for all those who are looking for fast <br>
                    effective and sustainable SEO results.
                </p> -->
            </div>
            <div class="works-f-u-main-card-div">
                <div class="row">
                    <div class="col-md-4 col-xl-4 ">
                        <div class="card works-for-u-card">

                            <div class="pb-3 ">
                                <img src="./images/dummy-img/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  py-2">Businesses</h4>
                            <p class="">
                            To place your business site at a higher position in the search rankings is not a cup of tea. You will face a massive challenge to do it. Let our expert team handle all the pressure by generating quality backlinks that will boost your site rankings. Therefore you can control the more essential aspects of doing your business </p>

                        </div>

                    </div>

                    <div class="col-md-4 col-xl-4">
                        <div class="card works-for-u-card">

                            <div class="pb-3 ">
                                <img src="./images/dummy-img/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  py-2">Resellers</h4>
                            <p class="">
                            As an SEO reseller if you are struggling to find a quality link for your clients our blogger outreach service is a one-stop solution. We are not only experts in link building but also offer white-label reports without any kind of credit for our work. Therefore you can easily scale up. </p>

                        </div>

                    </div>

                    <div class="col-md-4 col-xl-4">
                        <div class="card works-for-u-card">

                            <div class=" pb-3">
                                <img src="./images/dummy-img/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                            </div>
                            <h4 class="how-fonts-h4  py-2">Affiliate Marketers</h4>
                            <p class="">
                            Most people are confused about what to do To boost affiliate sites, with the result-based SEO strategy. The simple answer is to get sufficient high quality links. Our expert team is proficient in this. You can focus on other vital aspects like creative content and improve the conversation. </p>

                        </div>

                    </div>
                </div>
            </div>


            <div class="how-its-wrok-bo-main-div">


                <div>
                    <h1 class=" text-center mt-4 my-3 works-bo-h2"> <span>How Does It work?</span></h1>
                </div>
                <div class="works-f-u-main-card-div">
                    <div class="row">
                        <div class="col-md-4 col-xl-4">
                            <div class="card  how-it-work-f-u-card">

                                <div class="pb-3 ">
                                    <img src="./images/dummy-img/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Best Prospect</h4>
                                <p class="">
                                We have a huge database of prominent sites. We will offer the best prospects that can give you the wanted traffic you targetted. Our aim is to give the best link placements at the perfect sites.
                                </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card">

                                <div class="pb-3 ">
                                    <img src="./images/dummy-img/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Handle Outreach</h4>
                                <p class="">
                                Not only we are finding the best prospect for you, but also we take care of the outreach portion too. Although this is time-consuming but our experts make it quick for you. Our outreach process is fully focused to build the long-term relationship with the best influencers. </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card">

                                <div class=" pb-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Envision And Say For You</h4>
                                <p class="">
                                Our native writers create novel content that has similar views to the outreached blogs. And we pitch it to the editor of it. Moreover, you as a client are always in the loop of the whole process. </p>

                            </div>

                        </div>
                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card">

                                <div class="pb-3 ">
                                    <img src="./images/dummy-img/real-bo-ul-li-1.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Make And Post Content</h4>
                                <p class="">
                                Our native content writing team creates non-promotional guest posts. These posts are fully prolonged with natural editorial in-content links. Moreover, we assure you that the quality of the content will be the best and it will be published on a high DA relevant site. </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4">
                            <div class="card how-it-work-f-u-card">

                                <div class="pb-3 ">
                                    <img src="./images/dummy-img/real-bo-ul-li-2.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Deliver White Label Reports</h4>
                                <p class="">
                                After publishing the content we will deliver the whole white label report to you. What you can share with your client. However, we will not take any credit for it. </p>

                            </div>

                        </div>

                        <div class="col-md-4 col-xl-4 ">
                            <div class="card how-it-work-f-u-card">

                                <div class=" pb-3">
                                    <img src="./images/dummy-img/real-bo-ul-li-3.png" class="real-bo-second-ul-li-img" alt="">
                                </div>
                                <h4 class="how-fonts-h4  py-2">Customize Outreach Content</h4>
                                <p class="">
                                Our target is to give niche relevant sites for our clients. Therefore we plan a custom outreach campaign. It ensures that the customer gets the link to the completely relevant site. </p>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Does-Blogger-Outreach Work For You ends -->
    <!-- ____________________________________________________________________________________________________ -->

    <!-- Examples of Blogs We Outreach To-blogger-outreach starts -->
    <section class="examples-of-blogs-main-div">
        <!-- <div class="container"> -->
        <div>
            <h2 class="text-center">Examples of Blogs <span>We Outreach To?</span> </h2>
        </div>
        <div class="pb-5">
            <div class="row">
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (15).png "
                        class="examples-img-div-short" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 py-2"> <img src="./images/dummy-img/Screenshot (16).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (17).png "
                        class="examples-img-div-short" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (18).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (19).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (20).png "
                        class="examples-img-div-short" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (21).png "
                        class="examples-img-div-long" alt="">
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6  py-2"> <img src="./images/dummy-img/Screenshot (20).png "
                        class="examples-img-div-short" alt="">
                </div>

            </div>
        </div>
        <!-- </div> -->
    </section>
    <!-- Examples of Blogs We Outreach To-blogger-outreach ends -->
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
                    <h4 class="faq-title">What Is Blogger Outreach Services?</h4>
                    <div class="faq-details">
                        <p>
                        When content is published on a website with natural brand mentions and links, it is called a blogger outreach service. As a blogger outreach service agency we offer content creation, strategy, pitching, and publishing outreach.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Is Blogger outreach a safe strategy to follow?</h4>
                    <div class="faq-details">
                        <p>We provide a completely safe outreach service to our customers. We have native content writers for writing manually.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">What Is DA?</h4>
                    <div class="faq-details">
                        <p>	Domain Authority or DA is metrically measured by Moz.com. This metric is used to know the quality of the blog site where we want to publish our content. Team Leelija ensures that your content will be posted on blogs with a DA range of 10-50.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Where is the link placed?</h4>
                    <div class="faq-details">
                        <p>	The link will be placed in the content body but not in the author box.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can I put a single but large order with different clients’ domains?</h4>
                    <div class="faq-details">
                        <p>	Yes, we offer that also. You have the right to choose any quantity you want to order. You just have to give us the target URL’s and anchor text. The rest will be done.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can you give us a guarantee of placement in unique sites in every order?</h4>
                    <div class="faq-details">
                        <p>	Yes, we guaranteed our clients this. We guaranteed that the domains will never duplicate for any orders. Our advanced tools will never allow us to do that. We assure unique links every time.</p>
                    </div>
                </li>

                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Who will write the content for a post?</h4>
                    <div class="faq-details">
                        <p>Our native writers from UK and US will write the content for you. The content will be of high quality and have a professional tone.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can I Write My Content?</h4>
                    <div class="faq-details">
                        <p>	Yes, you can do that certainly. However, our expert outreach team will check the content thoroughly. Moreover, it should have adequate quality to post on our partner website.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Can I review the content before posting?</h4>
                    <div class="faq-details">
                        <p>	Unfortunately, we are not offering this time. We are not offering this to keep our whole process streamlined and to offer the service in a quick time.</p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">How long do the link placements last?</h4>
                    <div class="faq-details">
                        <p>	There is no such specific time. It lasts for an indefinite period of time. However, we take the assurance of minimum 90 days of period. </p>
                    </div>
                </li>
                <li class="faq-li">
                    <i class="fas fa-plus"></i>
                    <h4 class="faq-title">Does your company take orders for adults or gambling sites?</h4>
                    <div class="faq-details">
                        <p>We might be doing it. However, according to our past experience, these are very challenging niches.</p>
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