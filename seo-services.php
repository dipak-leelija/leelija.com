<?php
session_start();
require_once("includes/constant.inc.php");
require_once "_config/dbconnect.php";

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




if(isset($_GET['seo_url'])){
    $seo_url			  		= $_GET['seo_url'];
}
//$serviceDtl		= $service->showServicesSeoUrlWise($seo_url);
//$servFeatDtls	= $service->ShowServcFrdDtls($serviceDtl[0]);
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <link rel="icon" href="images/logo/favicon.png" type="image/png">
    <title>SEO Services: Low Cost Search Engine Optimization Services </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="LeeLija is an ✓seo service company, ✓seo service provider, ✓seo service agency,it provides affordable seo services for ✓small business,✓small business seo service,✓local seo service, ✓link building services, ✓link building strategies, ✓outsourcing seo service, ✓affordable local seo services." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="seo service seo service company,seo service companies,seo service provider,seo service agency,seo outsourcing service,small business seo service,affordable seo services for small business,seo service providers,seo consulting service,professional seo service,outsourcing seo service,affordable local seo services,local seo marketing company,seo reseller service,seo service uk,seo service USA,local seo service,seo consulting company,seo consulting firm,consultant seo,consultant seo servicesseo consulting,link building services,seo link building,seo link building services,link building company,link building strategies,what is link building,how to build links" />

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
        <div class="blogger-banner projects-animation_on_text  banner">
            <h1 class="blogbanner-heading"> SEO Services </h1>
            <div class="wd_heading_details_2">
                <p class="mt-4">
                    In today’s world without the internet, we can’t think anything. Here SEO plays a heroic role. If you
                    are
                    seeking a good increase in web traffic for your site, do check our seo services. Our seo consulting
                    company is renowned for the job.
                </p>
            </div>
            <h2 class="text-center  mt-5 mb-4 first_title  ">Boost Your Organic Traffic By the Best SEO Services</h2>
            <p class="text-justify service-heading-details">With the best professional seo services from Leelija Web
                Solution, you can create better connections across the multiple digital platforms that help to rank
                higher
                on search engines. For your website, good search rankings are one of the best ways to get more organic
                visitors. Search rankings lead real visitors to your sites and boost it. That is why good SEO knowledge
                is
                necessary and invaluable in every online business. <br><br> No matter how big business asset you have,
                seo
                service agency came to use in every business and entity of all types, it clearly doesn’t matter about
                their
                brand value and reputation. Our seo consulting firm offers you the best services.
                The advantage of the correct SEO services that you get from Leelija is that they will help you to boost
                your
                marketing costs and conversion rates. No doubt Digital Marketing is an art and the right SEO strategy
                will
                lead you there. <br><br> There is no particular strategy, instead, deeply personalized seo reseller
                service
                that is connects with the objectives and goals of the business. We at Leelija help you to achieve your
                goal-
                get in touch with us for your business needs.
                From local seo service to professional seo service, we offer you the best SEO Services in USA to rank
                high.
                You will get all kinds of services to establish a digital presence such as off-page and on-page SEO,
                e-commerce SEO, content marketing, guest posting, SEO consulting, and others.
            </p>
            <div class="overlay"></div>
        </div>
        <section class="blogger-fourth-section reveal">
            <div class="container">
                <h2 class="text-center first_title  mb-4">How can Leelija’s SEO Services Help You?</h2>
                <div class="row align-items-center reveal m-0">

                    <div class="col-lg-6 pl-0">
                        <img src="images/main/Revenue_Increase.webp" alt="Revenue Increase" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center"> Revenue Increase</h3>
                            <p class="mb-5">After a huge organic traffic count on your site, we assure you that you will
                                definitely see a significant level up in revenue.</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Brand Image</h3>
                            <p class="mb-5">Every company’s dream to be the best brand’s at online recognition. However,
                                we
                                help you giving affordable seo services for small business by creating a positive brand
                                image.</p>
                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/main/eCommerce_Solution.webp" alt="Blogging Outreach" class="w-100">
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/Have_more_Sales.webp" alt="More sales" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Have more Sales</h3>
                            <p class="mb-5">By promoting your site in search engine rankings you will get more visitors.
                            </p>

                            <p>This means you got the opportunity to flaunt more ideas that easily increase your sales.
                                More
                                sales make more profits in your small business seo service.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Faster Growth</h3>
                            <p class="mb-5">All the aforementioned effective factors help your business or brand to grow
                                faster and create a bigger impact on this huge online platform.</p>
                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/main/Faster_Growth.webp" alt="Faster Growth" class="w-100">
                    </div>
                </div>

            </div>
        </section>

        <!-- extra details -->
        <div class="features-sec reveal">
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
        <section class="blogger-fourth-section">
            <div class="container">
                <h2 class="text-center mb-3 first_title ">Different kinds of SEO Services</h2>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/Custom_Web_Design.webp" alt="Enterprise SEO" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Enterprise SEO</h3>
                            <p class="mb-5">Lift up your enterprise website through the help of our enterprise SEO
                                services
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">E- Commerce SEO</h3>
                            <p class="mb-5">Boost traffic on your eCommerce site and start sales through our effective
                                eCommerce SEO services</p>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/E_Commerce_SEO.webp" alt="E- Commerce SEO" class="w-100">
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/SEO_Audit.webp" alt="SEO Audit" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">SEO Audit</h3>
                            <p class="mb-5">
                                You can avail of SEO audit services by our experienced, quite efficient audit team.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Local SEO</h3>
                            <p class="mb-5"> Our local SEO service will help you to increase local traffic from your
                                consumers. </p>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/Local_SEO.webp" alt="Local_SEO" class="w-100">
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/Recovery_of_SEO_Penalty.webp" alt="Recovery_of_SEO_Penalty" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Recovery of SEO Penalty</h3>
                            <p class="mb-5">SEO penalty is very common in this platform. We assure you of penalty
                                recovery
                                services. Through a focused strategy, we recover it from Google's penalty.</p>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center reveal m-0">
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">SEO Contract Staffing</h3>
                            <p class="mb-5"> Get the best SEO performance from our SEO contract staffing services </p>
                        </div>
                    </div>
                    <div class="col-lg-6 pl-0">
                        <img src="images/main/SEO-Contract-Staffing.webp" alt="SEO _Contract Staffing" class="w-100">
                    </div>
                </div>
            </div>
        </section>
        <!-- ================ Regester Now Section Start ================ -->
        <?php require_once "partials/reg-now.php"; ?>
        <!------------------- Regester Now Section End ------------------->

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
                <h3 class="text-center">Why Leelija best as SEO Service Provider?</h3>
                <p class="heading_details_p  mt-3">Being one of the best seo service company, our aim to fulfill our
                    client’s desires and make them satisfied by providing professional seo services. We provide the best
                    SEO
                    strategies that increase your digital revenue. Our dedicated team helps us to lead the industry:</p>
            </div>
            <div class="container">
                <div class="row reveal align-items-center m-0">

                    <div class="col-lg-6">
                        <img src="images/main/Efficient_Project_Manager.webp" alt="Efficient Project Manager"
                            class="w-100">
                    </div>

                    <div class="col-lg-6">
                        <h3 class="native-content">Efficient Project Manager</h3>
                        <p class="native-content-p">Every brand needs a project manager, no matter how big or small a
                            project you get. For every project requirement, we need a project manager to deliver
                            high-quality outcomes every time. The responsibility of the project manager is quite high.
                        </p>
                    </div>
                </div>

            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row reveal align-items-center m-0">
                    <div class="col-lg-6">
                        <h3 class="native-content">Team of 30+ SEO Specialist</h3>
                        <p class="native-content-p">In a short time, we have made a strong team of 30+ SEO Specialists.
                            We
                            divided projects to each individual at a time so that they can work with full concentration.
                            Our
                            team member works with lots of dedication and focuses on achieving their defined goals.</p>
                        <br>

                        <!-- 
<ul>
<li><i class="far fa-check-circle"></i> Relevance of Blogs</li>
<li><i class="far fa-check-circle"></i> Related Niche Websites for Guest posting</li>
<li> <i class="far fa-check-circle"></i>Quality of the content</li>
<li> <i class="far fa-check-circle"></i>Traffic of the website</li>
<li> <i class="far fa-check-circle"></i>Relevant suggestions </li>
</ul> -->

                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/Team_of_SEO_Specialist.webp" alt="Team of 30+ SEO Specialist"
                            class="w-100">
                    </div>
                </div>
            </div>
        </section>
        <section class="native-content-section reveal">
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <img src="images/main/content.webp" alt="Award Winners" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="native-content">Award Winners</h3>
                        <p class="native-content-p">In the past 2 years, for our outstanding performance in the SEO
                            world,
                            we have earned more than 7 awards. Our dedication, hard work, and efficiency towards work
                            made
                            us no.1 in the SEO industry.</p>
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <h3 class="native-content">Experience</h3>
                        <p class="native-content-p">Our seo service company is two years old but our team members have
                            not
                            less experience. Our team has experience of 10-12 years in the SEO industry. </p>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/Real-Sites.webp" alt="Experience" class="w-100">
                    </div>
                </div>
            </div>
        </section>
        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <img src="images/main/Constant_monitoring.webp" alt="Constant monitoring" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="native-content">Constant monitoring</h3>
                        <p class="native-content-p">

                            We constantly monitoring every reports to our clients so that they updated with the latest
                            performance. These reports help us to know the structure of your brand through the
                            performance.
                        </p>
                    </div>
                </div>

            </div>
        </section>
        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">

                    <div class="col-lg-6">
                        <h3 class="native-content">Analyzing Data</h3>
                        <p class="native-content-p">Before starting on a new project we always analyze past data of that
                            site. It helps us to plan and do it to perfection.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/Analyzing_Data.webp" alt=">Analyzing Data" class="w-100">
                    </div>
                </div>
            </div>
        </section>
        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
                <h3>What Our SEO Services Includes?</h3>
                <p class="heading_details_p">Leelija is one of the best seo service provider in the SEO industry. With
                    its
                    flair, we deliver amazing results in the form of search engine rankings. We exceed marketing goals
                    too.
                    Leelija has a proven track record of providing top-tier seo consulting service.</p>
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <img src="images/main/Approche.webp" alt="Competitor Analysis" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="native-content">Competitor Analysis</h3>
                        <!-- <p class="native-content-p">Our strategies ensure to give the best result by boosting your reach organically. We adhere to the Tried & Tested Result Oriented Approach, which further ensures maximum ROI. We also look after what should be practiced and what should be avoided, in order to enhance your returns on investment. One of the main reasons behind it is the ‘links and guests’, which we have with us onboard, at Leelija. These things are assured by us, while envisaging the maximum ROI-</p> <br> -->
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>We deeply analyze your competitors’ works and
                                their
                                SEO practices. Because it is necessary to chart out a commendable strategy to build on
                                and
                                counter them to get ahead.</li>
                            <li><i class="far fa-check-circle pr-1"></i>Affordable local seo services offered including
                                competitor’s chosen keywords and their target pages to generate traffic and their
                                traffic
                                value.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <h3 class="native-content">SEO Audit</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>In SEO Audit services, our experts of SEO go
                                through
                                with site’s pages and make a list of requirements what to do and what to not</li>
                            <li><i class="far fa-check-circle pr-1"></i>We conduct 200+ webpages including content,
                                URLs,
                                web architecture, and responsiveness through SEO Audit.</li>
                            <li><i class="far fa-check-circle pr-1"></i>For your webpage ranking, we will submit a
                                comprehensive audit report along with all the details for improvement and optimization.
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/SEO_Audit.webp" alt="SEO Audit" class="w-100">
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <img src="images/main/Keyword_Research.webp" alt="Keyword Research" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="native-content">Keyword Research</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>Leelija as a local seo marketing company offers
                                many
                                critical elements that utilized with effective keyword analysis.</li>
                            <li><i class="far fa-check-circle pr-1"></i>We have experts in keyword research for your
                                website. Experts will choose the best keywords so it is quite easier to rank your
                                website on
                                SERP.</li>
                            <li><i class="far fa-check-circle pr-1"></i>If you want organic traffic generation on your
                                site,
                                it is very important to target the best keywords and targeted for each page</li>
                            <li><i class="far fa-check-circle pr-1"></i>Keyword analysis and optimization are parts of
                                our
                                complete SEO services.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <h3 class="native-content">On Page SEO Services</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>We optimize each and every web page on the
                                website
                                so your website can easily rank higher on Google.</li>
                            <li><i class="far fa-check-circle pr-1"></i>Our team analyses each contents’ readability,
                                category, tags, focus keyphrase, meta title, meta description, slug, and also makes the
                                article SEO friendly. By these analyses, we ensure that we do not neglect anything that
                                could affect your website rankings on SERP.</li>

                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/OnPage_SEO_Services.webp" alt="On Page SEO Services" class="w-100">
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <img src="images/main/our-mission-TYFRW.webp" alt="Content Optimization" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="native-content">Content Optimization</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>The most important part of any webpage is the
                                articles. No doubt, the content has the ability to determine everything for your online
                                business.</li>
                            <li><i class="far fa-check-circle pr-1"></i>Our seo consulting service team creates and
                                optimizes content for your webpages. Always makes it SEO-friendly to boost your pages.
                            </li>
                            <li><i class="far fa-check-circle pr-1"></i>We always ensure that all contents have your
                                company’s SEO goals</li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <h3 class="native-content">Contextual Internal Link Building</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>The main motive of any webpage is to inform and
                                educate the visitors. Leelija offers genuine link building services for both internal
                                and
                                external.</li>
                            <li><i class="far fa-check-circle pr-1"></i>Internal linking is very prevalent among
                                e-commerce
                                SEO services.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/Contextual_InternalLink_Building.webp"
                            alt="Contextual Internal Link Building" class="w-100">
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <img src="images/main/OffPageSEO_Services.webp" alt="Off Page SEO Services" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <h3 class="native-content">Off Page SEO Services</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>Off-page SEO services, influencer marketing, and
                                Digital PR services help a lot to boost up your brand on a vast network.</li>
                            <li><i class="far fa-check-circle pr-1"></i>Our outreach campaign services did popular brand
                                promotions on various platforms to engage with famous bloggers, vloggers, and other
                                social
                                media influencers.</li>
                            <li><i class="far fa-check-circle pr-1"></i>Also, through our Digital PR Services, we
                                promote
                                your brands, products, and services on the digital landscape.</li>

                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="native-content-section reveal">
            <div class="leelija-gp-service-head">
            </div>
            <div class="container">
                <div class="row align-items-center m-0">
                    <div class="col-lg-6">
                        <h3 class="native-content">Regular Reporting</h3>
                        <ul>
                            <li><i class="far fa-check-circle pr-1"></i>We believe in good relationship with our clients
                                so
                                we report daily and engage targeted audience with their website.</li>

                            <li><i class="far fa-check-circle pr-1"></i>Our all user data, reports, analysis we share in
                                excel sheets.</li>

                            <li><i class="far fa-check-circle pr-1"></i>Regular reports help you to see all the aspects
                                like
                                site traffic, traffic value, and other summaries and detailed analysis of your website.
                            </li>

                            <li><i class="far fa-check-circle pr-1"></i>Our reports combine with consultant seo services
                                data with impactful visualization and a new change from the number alternatives.</li>
                        </ul>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/main/Approche.webp" alt="Regular Reporting" class="w-100">
                    </div>
                </div>
            </div>
        </section>

        <?php require_once "partials/benefits-of-choosing.php"; ?>

        <div class="blogger-faq reveal">
            <div class="faq-head-section text-center">
                <h3 class="text-center">Frequently Asked Questions On SEO Services:</h3>
                <p>Submit your requirement or query, We will process it within 24 hours.</p>
            </div>
            <div class="container">

                <ul class="faq-body">

                    <li class="faq-li">
                        <i class="fas fa-plus" id="first_id"></i>
                        <h4 class="faq-title">What is SEO?</h4>
                        <div class="faq-details">
                            <p>
                                SEO is the short form of Search Engine Optimization. Optimization is the basic thing in
                                all
                                SEO practices. If your website, content, and other social media platforms are optimized
                                across the internet so that it increases your brand’s online visibility. Your website
                                will
                                rank on the first page of SERP./p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How does SEO work?</h4>
                        <div class="faq-details">
                            <p>The time to create a website design is depending on your site and demand. If you provide
                                us
                                deadline then our team work hard to fulfill it. We give time to time work for our
                                clients.
                            </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How Much Do You Charge For Web Site Design?</h4>
                        <div class="faq-details">
                            <p>SEO can change your online presence by making your website more attractive on search
                                engines
                                like Google and Bing. Search engines regularly crawl your site and show every record.
                                Make
                                sure your website is easy for search engines to fully understand your website. Good SEO
                                practices increase organic website traffic and your site visitors at no more additional
                                cost.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How much does SEO cost?</h4>
                        <div class="faq-details">
                            <p>SEO can cost approximately $250 to $7000 in a month. A seo service agency or SEO expert
                                will
                                charge after considering the project scope. Though it completely depends on what the seo
                                service companies offering and in what element your company is working.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What Kind Of Technology Do You Support?</h4>
                        <div class="faq-details">
                            <p>We have experienced web design experts on JavaScript, XHTML, XML, CSS, DHTML, PHP, and
                                Flash.
                                If you need other technological support then we try to connect our partners to meet your
                                requirements. For that you don’t need to pay additional cost.</p>
                        </div>
                    </li>



                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How long does SEO take?</h4>
                        <div class="faq-details">
                            <p>Well, it entirely depends on your goal of SEO, search campaign, and the performance of
                                your
                                company. SEO is a lengthy process you cannot expect results from the word go. You need
                                to be
                                patient and calm. Always focus on your strategy. Plan heavily so you can see the results
                                starting to flow after 4-5 months.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Will blogging help SEO?</h4>
                        <div class="faq-details">
                            <p>Yes, blogging boosts your site. Search engines are always looking for fresh content on
                                your
                                website. So, write high-quality content that will sufficiently fulfill users’ questions.
                                With on-page SEO tactics, Google will find your site more easily.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Do I get report?</h4>
                        <div class="faq-details">
                            <p>Yes, all the works will be reported by the end of the day. All the data will be shared in
                                an
                                excel sheet so that everyone gets information. These will also help the client to
                                measure
                                the impact of SEO service. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How can I find quality SEO services?</h4>
                        <div class="faq-details">
                            <p>Don’t hire any local SEO agency because they might charge a lot. Search some trusted
                                companies and consult with them about your plan, strategy, expectations, and understand
                                the
                                business objects. </p>
                        </div>
                    </li>


                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How to improve website authority?</h4>
                        <div class="faq-details">
                            <p>By creating quality backlinks, content optimization, on-page optimization Domain
                                Authority
                                will be increased.</p>
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
    <script src="assets/vendors/js/reveal-animation.js"></script>
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
    <!-- <script src="js/responsiveslides.min.js"></script> -->
    <!-- <script>
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