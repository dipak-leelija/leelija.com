<?php
session_start();
require_once("includes/constant.inc.php");

require_once("_config/dbconnect.php");
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
    <title>WordPress Development Services ! WordPress customization </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Leelija is a WordPress Development firm,it provides an affordable WordPress Development service.As a small business WordPress Development company leelija is among top website design companies in the circuit." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="wordpress website builder,how to build a wordpress website,wordpress website design,hire wordpress developer,start a wordpress blog,create wordpress blog,wordpress theme development,wordpress local development,wordpress website development,freelance wordpress developer,wordpress development services,wordpress web design company,custom wordpress development,setting up a wordpress blog,wordpress best website builder,wordpress free website builder,wordpress web development,wordpress website design company,how to build a website using wordpress,wordpress website design services,custom wordpress website,hire dedicated wordpress developer,wordpress web development company,wordpress free website builder" />

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
        <div class="blogger-banner  banner ">
            <h1 class="blogbanner-heading"> WordPress Development Services </h1>
            <div class="wd_heading_details_2">
                <p class="mt-4">
                    WordPress is an easy and popular medium that help to make us our own website or blog. There are huge
                    amount of WordPress users and from billions of websites there are 34% of site make with WordPress.
                    Wordpress is simplest and one of the most powerful content management system. It amazes you with its
                    development experience. The WordPess management system is very easy and you can easily add-on
                    features
                    and plugins. If you need leading WordPress Development Company or hire WordPress developer then
                    Leelija
                    Web Solution is the best to offer best services. From personal portfolios to commercial websites our
                    WordPress website builder develops your business websites with fully responsible.
                </p>
            </div>

            <h2 class="text-center  mt-5 mb-4 first_title  ">How To Build A Wordpress Website?</h2>
            <div class="wd_heading_details_2">

                <p class="mt-4">
                    There is an unclear vision about how to build a WordPress website. Our Leelija team will help you to
                    start a WordPress blog and WordPress website design. Opening a WordPress account you can easily
                    create
                    WordPress blog. Now you may think if you easily create WordPress account then why do you need our
                    services? You need us for WordPress theme development, WordPress local development and WordPress
                    website
                    development. Our developers use their skills to look your website attractive and can drive audience
                    easily.
                    Our WordPress web design company is always looking forward to help you with their professional
                    experience and we try to make our clients happy with our service.

                </p>

            </div>
        </div>

        <section class="Social_Media_Marketing">

            <h2 class="text-center first_title mt-4">WordPress Development Services We Offer</h2>

            <section class="native-content-section">

                <div class="leelija-gp-service-head">
                </div>
                <div class="container">
                    <div class="row align-items-center m-0">
                        <div class="col-lg-6">
                            <img src="images/How_To_Build A_Wordpress_Website.png" alt="Website Development"
                                title=">Website Development" class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">Website Development</h3>
                            <p class="social-media-point">Our Leelija Web Solution is one of the best leading WordPress
                                development company. We have professional and experienced in-house WordPress experts.
                                The
                                experts will help you the best wordpress development services</p>

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
                            <h3 class="native-content">Configuration & Installation</h3>
                            <p class="social-media-point">If you are searching the best wordpress best website builder
                                then
                                Leelija is the best choice as it works keeping in mind of clients’ demands. It provides
                                best
                                service in configuration and installation with proper strategies and following multiple
                                functional systems. Providing CMS Installation & Configuration, the dedicated team set
                                up
                                your WordPress blog and website</p>


                        </div>

                        <div class="col-lg-6">
                            <img src="images/Configuration__Installation.png" alt="Configuration & Installation"
                                class="w-100">
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
                            <img src="images/Wordpress_Them_Development.jpg" alt="Wordpress Theme Development"
                                class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">Wordpress Theme Development</h3>
                            <p class="social-media-point">At the present time, building a responsive website is the main
                                key
                                to get achievements. So, if you want success on online you need a responsive wordpress
                                theme
                                development. We provide Wordpress UX creative theme development, help clients PSD
                                WordPress
                                theme conversion service, custom theme development, making mobile first orientation
                                development. </p>


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
                            <h3 class="native-content">WordPress Plugin Development</h3>
                            <p class="social-media-point">Plugins are the main center of WordPress CMS development. If
                                you
                                want to fulfill your futuristic goal then use powerful and relevant WordPress Plugins.
                                Our
                                wordpress web development company offers you all plugins development service that every
                                business need. Leelija offers plugins documentation and installations, upgrade,
                                modification
                                and enchantment of plugins.</p>


                        </div>

                        <div class="col-lg-6">
                            <img src="images/WordPress_Plugin_Development.png" alt="WordPress Plugin Development"
                                class="w-100">
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
                            <img src="images/Migration_And Maintenance_Services.png"
                                alt="Migration And Maintenance Services" class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">Migration And Maintenance Services</h3>
                            <p class="social-media-point">Our freelance wordpress developer always gives their best
                                service
                                of every client’s demand. We offer a complete set of supports, maintains, and web
                                hosting
                                solutions depending on the consumers’ requirements. Leelija team also offers migration
                                service in addition. The service those we provide for setting up a wordpress blog are
                                monitoring the performance of websit, notify the error and find out the effective
                                solution
                                of this error, first response rate of website, an malware protection. </p>


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
                            <h3 class="native-content">Wordpress Template Design Services</h3>
                            <p class="social-media-point">Leelija is the best in leading WordPress theme development
                                that
                                has great knowledgeable experts of designers who are handle all responsibilities in
                                effective manners. Make creative and beautiful designing brands, use latest WordPress
                                functionalities features with best solutions. </p>


                        </div>

                        <div class="col-lg-6">
                            <img src="images/template.png" alt="Wordpress Template Design Services" class="w-100">
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
                            <img src="images/BlogPost.png" alt="Blog Development" class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">Blog Development</h3>
                            <p class="social-media-point">Our teams help you to develop your blog from A to Z. We
                                provide
                                SEO friendly services to grow your blog and make place on Google rank, and engaging
                                audience. </p>


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
                            <h3 class="native-content">API Integration & Customization</h3>
                            <p class="social-media-point">Do you want to hire dedicated wordpress developer to develop
                                your
                                WordPress website then Leelija Web Solution is the best one to select for that service.
                                We
                                offer mobile app integration and data sync service for your wordpress site. We also
                                provide
                                management service for your website. </p>


                        </div>

                        <div class="col-lg-6">
                            <img src="images/api_intrigation.png" alt="API Integration & Customization" class="w-100">
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
                            <img src="images/woocommrece.png" alt="WooCommerce Development" class="w-100">
                        </div>

                        <div class="col-lg-6">
                            <h3 class="native-content">WooCommerce Development</h3>
                            <p class="social-media-point">WooCommerce powers millions of websites and online stores
                                acrose
                                the world. Many people chose this development as it allows creating e-commerce business
                                at
                                the low cost. It helps to develop online business store. Our company provides you the
                                best
                                WooCommerce development services and follows your requirements. </p>


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
                            <h3 class="native-content">WordPress Upgrading</h3>
                            <p class="social-media-point">The upgrading process of your website may harmful and cause
                                deleted of all files and folders when installing the main WordPress. Leelija Web
                                Solution
                                helps you to escape from this problem. We have wordpress best website builder and
                                developers
                                team with experience skills. Our developers follow latest technologies to complete
                                upgrading
                                method. They also can provide manually WordPress upgrading method. </p>


                        </div>

                        <div class="col-lg-6">
                            <img src="images/upgrading.png" alt="WordPress Upgrading" class="w-100">
                        </div>
                    </div>
                </div>
            </section>





        </section>


        <!-- ================ Regester Now Section Start ================ -->
        <?php require_once "partials/reg-now.php"; ?>
        <!------------------- Regester Now Section End ------------------->



        <section class="blogger-fourth-section">

            <div class="container">
                <h2 class="text-center mb-3 first_title mt-5">Why Our Consumers Love Us</h2>



                <div class="row align-items-center m-0">

                    <div class="col-lg-6">
                        <img src="images/Custom_Web_Design.png" alt="Blogging Outreach" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Dedicated WordPress Team</h3>
                            <p class="mb-5">We have powerful and supportive team members who constantly develop
                                WordPress
                                design and development service. We also have dedicated programmers with skilled and
                                experienced to customize any web solutions and make clients business growth. Leelija
                                also
                                connected with partner team to resolve any WordPress problems. </p>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Providing Speed & Performance</h3>
                            <p class="mb-5">Our team create your website smooth, highly optimize and superfast
                                performance.
                                We ensure our consumers to give them best custom wordpress development that improves
                                your
                                overall users’ engagements. </p>
                        </div>
                    </div>
                    <div class="col-lg-6 ">
                        <img src="images/SEO_Audit.png" alt="SEO_Audit" class="w-100">
                    </div>



                    <div class="col-lg-6 mt-4">
                        <img src="images/consulting.png" alt="Free WordPress Consulting" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Free WordPress Consulting</h3>
                            <p class="mb-5">
                                If any reader, audience or consumer need wordpress related consulting, we always welcome
                                them. We love to connect with our consumers, readers and discuss on projects
                                requirements.
                                Your remark about our company is very valuable. We try to connect with our audience
                                firstly
                                and resolve their queries.
                            </p>
                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Full Standards Compliance</h3>
                            <p class="mb-5"> At the Leelija Web Solution we offer best wordpress coding standers mixed
                                with
                                perfection. From core code to plugin development to wordpress theme development our
                                service
                                bound with full standards compliance. </p>

                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/compliance.png" alt="Full Standards Compliance" class="w-100">
                    </div>



                    <div class="col-lg-6">
                        <img src="images/smart.png" alt="SEO-Smart Web Solutions" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">SEO-Smart Web Solutions</h3>
                            <p class="mb-5">Our basic SEO implementation is to optimizing search engine with Meta tags,
                                Alt
                                Text, image optimization, heading tags, etc. Following latest techniques we make
                                smoother
                                implementation. For our clients our teams give their additional efforts. </p>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Reporting & Quality Assurance</h3>
                            <p class="mb-5"> The wordpress development and design service of our company approaches the
                                quality of reporting assurance. Our experts provide daily updates of client’s projects
                                and
                                always check the business growth. They assure to complete project up before the
                                deadline.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <img src="images/repoting.png" alt="Reporting & Quality Assurance" class="w-100">
                    </div>


                    <div class="col-lg-6">
                        <img src="images/Content_ManagementSystem.png" alt="Blogging Outreach" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Seamlessly Upgradable & Secure:</h3>
                            <p class="mb-5">Without creating any problems our websites are easily upgradable for strong
                                functional features. Our company uses higher security in technical development to ensure
                                that the site is totally safe from Bot attacks. We follow the spam protection, proper
                                file
                                permission, setting of configuration, and validation to make website is safe and secure.
                            </p>




                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Simple, Clean & Functional Websites</h3>
                            <p class="mb-5"> Our coding practices are worldwide accepted for well comented and
                                intelligence
                                frameworks. The first thing that you always expect from a trustworthy wordpress
                                development
                                company is to use easily translation for all languages. Our company provides this
                                service to
                                its clients. </p>

                        </div>
                    </div>

                    <div class="col-lg-6">
                        <img src="images/clean.png" alt="Simple, Clean & Functional Websites" class="w-100">
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
        <!-- ============= Benefits of choosing sec start ============= -->
        <?php require_once "partials/benefits-of-choosing.php"; ?>
        <!---------------- Benefits of choosing sec End ------------------>
        <div class="blogger-faq">
            <div class="faq-head-section text-center">
                <h3>FAQ for WordPress Development Service:</h3>
                <p>Submit your requirement or query, We will process it within 24 hours.</p>
            </div>
            <div class="container">

                <ul class="faq-body">

                    <li class="faq-li">
                        <i class="fas fa-plus" id="first_id"></i>
                        <h4 class="faq-title">Why social media is so important?</h4>
                        <div class="faq-details">
                            <p>
                                To connect with us you can mail us or whatsapp with us collecting details from the site.
                                We
                                provide our contact information on Leelija.com. Our team will be come back within few
                                hours
                                later and will hear your requirement or any query. We will discuss you with details try
                                to
                                solve all things. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What types of task can you do for me?</h4>
                        <div class="faq-details">
                            <p>We provide you all SEO service from WordPress development to Web Design service all. From
                                Hosting, migration to optimization to Writing services everything we provide to our
                                clients.
                                For more information with contact us. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title"> How long does a task take to complete?</h4>
                        <div class="faq-details">
                            <p>The project task completing is totally depends on the package and service that you
                                select. If
                                you request emergency task or requirements our specialists will work their task to
                                complete
                                your project but for that you need to pay extra charge. Generally we complete your
                                projects
                                within 24 hours. We will give you give you the updates during our discussions. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How do you manage the project once hired?</h4>
                        <div class="faq-details">
                            <p>When you choose our wordpress development company, we assign 5 members of developer’s
                                team to
                                complete your project as soon as possible. Our team will doing their best to complete
                                your
                                project but during this time if got any problem then will connect with you. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How would I know the updates on my project?</h4>
                        <div class="faq-details">
                            <p>At that time our company takes your project, we assign our dedicated team member as per
                                requirements. Our developers will be direct touch with you when offering daily updates
                                of
                                project’s growth. We use various social sites for better communication and projects’
                                success.</p>
                        </div>
                    </li>



                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What experience do you have?</h4>
                        <div class="faq-details">
                            <p>We have 10 years experienced wordpress development specialists who are perfect for
                                dealing
                                anything. They also solve your any queries or difficulties.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How do I pay?</h4>
                        <div class="faq-details">
                            <p>We mostly consider PayPal payment method outside India. In India, we consider Google Pay,
                                Phone Pay. We prefer PayPal as it is easy method and highly secure.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How does the money back guarantee work?</h4>
                        <div class="faq-details">
                            <p>If we are unable to resolve your problems and if you are unhappy with our service, then
                                we
                                will be not hesitating to refund your money. But for that you must show us the logical
                                issues. If we will find out that the problem is not too big then we avoid your issue.
                            </p>
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

    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

</body>

</html>