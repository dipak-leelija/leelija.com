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
    <title>Website Design Services | Web Development Services </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Leelija is a ✓web design firm,it provides an affordable ✓web design service.As a ✓small business ✓web design company leelija is among ✓top website design companies in the circuit." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="web design companies,web design company,what is web designing,web design and development,website development company,affordable web design,web design firm,best web design company,simple website design,web design company new york,ecommerce web design company,top web design companies,small business web design company,best website design company,web application development company,web development company in usa,web design company in usa,web development company in new york,top website design companies,web design and development company,website design firm,website development firm" />

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
            <h1 class="blogbanner-heading">Best Web Design And Development Company</h1>

            <div class="wd_heading_details_2">

                <p class="mt-4">
                    Are you searching a platform from where you can grow your business? Is your business halting to take
                    place at online route? Are you looking for professional team to overcome from these problems? If
                    your
                    answer is yes then our team from Leelija Web Solution, one of the best web design and Development
                    Company will help you. In this field you will get well-qualified and professional designers and
                    developers. With the usability and performance, the team fulfills clients’ or customers’ demands.
                    Though there are so many web design companies, but the specialty of Leelija Team is to work smartly
                    and
                    attractive way. Make the website eye-catchy to drag the attention of readers and visitors. For the
                    small
                    business web Design Company or the new start-up companies follow our strategies to grow their
                    business.
                    We classify the brands and take the responsibility to increase the service or product through the
                    customers with our stored data. In this digital era, we know very well the importance of having high
                    quality and engaging websites. The affordable web design of our designers can help to drive more and
                    more traffic towards their blogs.

                </p>

            </div>

        </div>

        <section class="blogger-fourth-section">
            <div class="container">
                <div class="row align-items-center m-0">

                    <div class="col-lg-6 pl-0">
                        <img src="images/Custom_Web_Design.png" alt="Custom Web Design" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">What Is Web Designing?</h3>
                            <p class="mb-5">In modern era, the use of internet increasing randomly and for that every
                                small
                                to big company open a website to promote their service and product through online. The
                                website may be for online marketing, service and product promotion. For designing the
                                websites, we need the website designers. People often want to know what is web
                                designing?
                            </p>

                            <p>The skills, processes and experiences that web designers use to design a website that
                                called
                                web designing. To give perfect touch of your business website you must select top web
                                design
                                companies with good reputation and Leelija is perfect among them. </p>


                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">What Is Web Development?</h3>
                            <p class="mb-5">The method of making data stored on a web server viewable in a web browser
                                connected to the Internet is called web development. A person who sets up or develops a
                                website is called a web developer. The web developers pursue the design or picture of
                                the
                                website and decorate the website using consumer side languages and server side
                                languages.
                            </p>

                            <p>Web development can be defined in different ways. All the work that needs to be done,
                                from
                                making a website to making it visible on the Internet, is called web development. Or the
                                development of software that makes the information stored on the web server viewable
                                over an
                                Internet connection is called web development. </p>


                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/eCommerce_Solution.png" alt="Ecommerce Solution" class="w-100">
                    </div>



                    <div class="col-lg-6 pl-0">
                        <img src="images/web_development_company.png" alt="Web Development Company" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3>Find The Best Web Design Company:</h3>
                            <p class="mb-5">When you are seeking the best web design and developing company, for you
                                there
                                are many considerations in your mind. And you choose the best service provider company
                                that
                                has good reputation. Leelija Web Solution is one of the best among those service
                                providers.
                            </p>

                            <p>If you are searching web design company in USA, India, UK, Australia and other countries
                                then
                                must pick Leelija as it provide worldwide service.
                                Professional designers from Leelija Web Solution can deliver amazing design, SEO, SEO
                                strategies, well communication service with affordable price.
                            </p>


                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">You Are The Boss Of Your Website:</h3>
                            <p class="mb-5">You will be boss of your website after you pay for web design as we don’t
                                use
                                any type of proprietary software that keep you lock. You are always free to pick your
                                website and make any change of it. </p>
                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/Landing_Page_Builder.png" alt=" Landing Page Builder " class="w-100">
                    </div>



                </div>

            </div>
        </section>

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



        <!-- <div class="blogger-third-section">
<div class="container ">
<h2 class="text-center">The Idea about Our Offering Services</h2>
<div class="row">
<div class="col-md-6">
<div class="build-relationship-text">
<p>Having thousands of databases of real bloggers, Leelija is the ultimate hub for guest posting. Outreaching any type of blog is our duty, owing to the list of blog sites that we have in our database. For the same, we have fifteen outreach specialists who work manually for blog outreach, of any given blog. Our main goal is to build strong relationships with the bloggers blog or bloggers websites, by cooperating with each other. The main tasks are analysing followers and traffics, presence of social media, domain authority analysis, and metrics of Moz.
Our company works for big brands, top blogs, outreach agencies, partners, and also for digital media. Our outreach bloggers always stand efficient in pitching, finding, engaging, and following the relevant bloggers or admins.
</p>
</div>
</div>
<div class="col-md-6">

<img src="images/blogging.png" alt="blogging" class="w-100">



</div>

</div> 
</div>
</div> -->

        <section class="blogger-fourth-section">
            <div class="container">
                <h2 class="text-center mb-3">The Idea about Our Offering Services</h2>

                <div class="row align-items-center m-0">

                    <div class="col-lg-6 pl-0">
                        <img src="images/Custom_Web_Design.png" alt="Blogging Outreach" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Custom Web Design:</h3>
                            <p class="mb-5">At present time, a business website is the showcase of the business brand
                                and
                                consumers always look towards the site. With the help of cookie cutter templates
                                lunching a
                                website is very easy but for that custom web design is very important.</p>

                            <p>It shows the business brands of your site. Custom web design is very beneficial for
                                business.
                                Custom web design shows professionalism towards your business, make better rank on
                                search
                                engine, stand out from your competitors, and make flexibility changes. The expert
                                designers
                                from Leelija assure to provide custom web design. </p>


                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">eCommerce Solution:</h3>
                            <p class="mb-5">If you are looking the best ecommerce web design then the best path is to
                                choose
                                Leelija. It provide your industry whatever you want, there are no compromise and
                                limitation.
                                Ecommerce is important to choose as it is secure platform. </p>

                            <p>Payment method, selling and buying method is very secure. Our ecommerce web design
                                service is
                                also mobile-friendly. Leelija also provide digital transformation, global expansion,
                                retailer solution, business to business commerce. </p>


                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/eCommerce_Solution.png" alt="eCommerce_Solution" class="w-100">
                    </div>



                    <div class="col-lg-6 pl-0">
                        <img src="images/Mobile_Version_Website.png" alt="Mobile Version Website" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Mobile Version Website:</h3>
                            <p class="mb-5">Leelija designer team offers you responsive web design with latest version.
                                Almost new clients demand mobile version or mobile friendly website with good
                                resolution.
                            </p>

                            <p>Our team offer innovative designs that are base on the user behavior, orientation, screen
                                size, and platform according to the device.</p>


                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Landing Page Builder:</h3>
                            <p class="mb-5"> Landing page is standalone web page that is especially invented for
                                advertising
                                or marketing campaign. It is the place where readers land and click on the email link.
                            </p>

                            <p> If you have the problem like page development is slow, wasting money, page isn’t
                                practical,
                                etc then you must pick Leelija Web Solution as landing page builder. </p>


                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/Landing_Page_Builder.png" alt="Landing Page Builder" class="w-100">
                    </div>



                    <div class="col-lg-6 pl-0">
                        <img src="images/Progressive_WebApp.png" alt="Progressive Web App" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Progressive Web App:</h3>
                            <p class="mb-5">We all know that web app is an incredible platform and various companies
                                make
                                this platform unique to develop software.</p>

                            <p>With the help of web app you can reach with any person,any place,on the any device with
                                single codebase.Leelija web app provides effective and faster work offline.</p>


                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">SEO Optimization:</h3>
                            <p class="mb-5"> Leelija helps small business web Design Company to increase their business
                                website through SEO. It improves your business with digital marketing strategy. </p>

                            <p> With the best design visibility it targets audience and your website can earn more
                                clicks.
                            </p>


                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/SEO_Optimization.png" alt="SEO Optimization" class="w-100">
                    </div>


                    <div class="col-lg-6 pl-0">
                        <img src="images/Content_ManagementSystem.png" alt="Content Management System" class="w-100">
                    </div>
                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Content Management System:</h3>
                            <p class="mb-5">Content management system is one of best web design service that our company
                                provides. If you have informational or ecommerce website then our content marketing
                                strategy
                                improve your business website. </p>

                            <p>Depending on your business reputation and size we offer three types of service like
                                advance,
                                standard and enterprise.</p>


                        </div>
                    </div>


                    <div class="col-lg-6">
                        <div class="right-ul-section">
                            <h3 class="text-center">Website Copywriting:</h3>
                            <p class="mb-5">The expertise technical of our Leelija team creates compelling copy to
                                engage
                                website visitors. We offer page variation with 5 to 10, 10 to 25 and 25 to 50.</p>

                            <p>For above 50 pages you need to change your design plan. Our specialists also research
                                valuable and relevant keywords to improve your WebPages. </p>


                        </div>
                    </div>

                    <div class="col-lg-6 pl-0">
                        <img src="images/Website_Copywriting.png" alt="Website Copywriting" class="w-100">
                    </div>





                </div>

            </div>
        </section>
        <!-- 
<section class="blogger-fifth-section">
<div class="container">
<h3 class="blogger-fifth-section-main-head">Why Choose Us For Web Design And Development?</h3>
<div class="row align-items-center m-0">
<div class="col-lg-6">
<div class="right-ul-section">
<ul>
<li>	We, at Leelija, have already reached and researched 10,0000 genuine high-authority blogs, with different themes. </li>
<li>	Our outreach specialists are well trained and have immense experience.</li>
<li>	We render your post promotions through social media remarks and mentions.</li>
<li>	We provide Manual outreach service and daily research available. </li>
<li>	We give quality outbound links from high authority websites of your post, that will further gain credibility.</li>
<li>	Our specialists have the ability to provide you with precious links, within viewpoints. </li>
<li>	We have the Online reporting panel accessible. </li>
<li>Online reporting panel accessible.</li>
<li>Our experts examine overall the blogs to give you better links. </li>
<li>We update bloggers database regularly to maintain SEO metrics. </li>
</ul>
</div>
</div>
<div class="col-lg-6 pl-0">
<img src="images/outreach.png" alt="Blogger Outreach Service" class="w-100">
</div>
</div>


</div>
</section> -->


        <!-- ================ Regester Now Section Start ================ -->
        <?php require_once "partials/reg-now.php"; ?>
        <!------------------- Regester Now Section End ------------------->



        <section class="native-content-section">

            <div class="leelija-gp-service-head">
                <h3>Why Choose Us For Web Design And Development?</h3>
            </div>
            <div class="container">
                <div class="row align-items-center m-0">

                    <div class="col-lg-6">
                        <img src="images/solution.png" alt="Guest Posts Services" class="w-100">
                    </div>

                    <div class="col-lg-6">
                        <h3 class="native-content text-center">We Understand Clients’ Vision:</h3>
                        <p class="native-content-p">Our main focus to give priority of our clients’ vision and ensure
                            them
                            with positive responses. We listen of our clients’ requirements carefully and try to provide
                            our
                            best services. </p>
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
                        <img src="images/Approche.png" alt="guest post approach" class="w-100">
                    </div>

                    <div class="col-lg-6">
                        <h3 class="native-content text-center">Best Web Solution:</h3>
                        <p class="native-content-p">Leelija Web Solution is the brand name that offers best services of
                            web
                            design and development worldwide. We help to improve your business name and reputation
                            drawing
                            new customers. </p> <br>

                        <!-- 
<ul>
<li><i class="far fa-check-circle"></i> Relevance of Blogs</li>
<li><i class="far fa-check-circle"></i> Related Niche Websites for Guest posting</li>
<li> <i class="far fa-check-circle"></i>Quality of the content</li>
<li> <i class="far fa-check-circle"></i>Traffic of the website</li>
<li> <i class="far fa-check-circle"></i>Relevant suggestions </li>
</ul> -->



                    </div>



                </div>

            </div>
        </section>



        <section class="native-content-section">


            <div class="container">
                <div class="row align-items-center m-0">

                    <div class="col-lg-6">
                        <h3 class="native-content text-center ">Have Experience And Professional Experts:</h3>
                        <p class="native-content-p">We have experienced and professional thirty members on different
                            departments. Our experts are very much dedicated to complete their project and well
                            communicated
                            with clients. Our experts use their passion and skill to grow your business. </p>
                    </div>

                    <div class="col-lg-6">
                        <img src="images/content.jpg" alt="Native Content" class="w-100">
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
                        <img src="images/Solutions.png" alt=" Guest Linking solution" class="w-100">
                    </div>

                    <div class="col-lg-6">
                        <h3 class="native-content text-center">Satisfied Clients:</h3>
                        <p class="native-content-p">We are always looking forward to satisfy our clients. We have
                            hundred of
                            satisfied clients. The recommendations of our clients are higher from various ranges of
                            industries.
                        </p>
                    </div>



                </div>

            </div>
        </section>


        <section class="native-content-section">


            <div class="container">
                <div class="row align-items-center m-0">

                    <div class="col-lg-6">
                        <h3 class="native-content text-center">User- Friendly Design:</h3>
                        <p class="native-content-p">Our designers provide user-friendly very attractive design of your
                            website. For that clients can easily drag more and more clients. It also beneficial for
                            product
                            website as more customers mean more sells. </p>
                    </div>

                    <div class="col-lg-6">
                        <img src="images/Real-Sites.png" alt="Real Sites" class="w-100">
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
                        <img src="images/NO.png" alt="PBNs sites" class="w-100">
                    </div>

                    <div class="col-lg-6">
                        <h3 class="native-content text-center">Business Strategy:</h3>
                        <p class="native-content-p">

                            Leelija provides the best effective business strategy for your website. Following our
                            strategies
                            your business or product can achieve the pick of popularity and gain onsite supports.
                        </p>
                    </div>



                </div>

            </div>
        </section>




        <section class="native-content-section">


            <div class="container">
                <div class="row align-items-center m-0">

                    <div class="col-lg-6">
                        <h3 class="native-content text-center">Budget-Friendly service provider:</h3>
                        <p class="native-content-p">Leelija is one of the best budget-friendly web design company that
                            think
                            about clients’ problems. We demand affordable budget from Start-up Company. </p>
                    </div>

                    <div class="col-lg-6">
                        <img src="images/Real-Sites.png" alt="Real Sites" class="w-100">
                    </div>

                </div>

            </div>
        </section>

        <!-- 
<section class="risk-free-sec">

<div class="risk-free">
<div class="container">
<div class="row">
<div class="col-sm-6">

<div class="risk-free-img">
<img src="images/payment.png" alt="Risk-Free SEO Service" class="w-100">
</div>


</div>
<div class="col-sm-6">

<h4 class="risk-free-head">

100% Risk-Free SEO Service

</h4>

<div class="risk-free-content">

<p>We make promises to give the best SEO services to our client. Don’t worry, your valuable money is safe with us until we make you happy.</p>
<p>Buying an SEO service from Leelija, remember you are covered under safe hands.  </p>
<p>		If you are not satisfied with our work, no worry we assure 100% money-back guarantee.</p>
<p>We understand the value of your hard-earned money.</p>
<p>As a responsible organization, we are committed to give you 100% money-back if we fail to make our deal fulfill as promised.</p>
<p>
Sincerely,<br>
<span class="cEo">
<span> Safikul Islam </span><br>
CEO,
Leelija Web Solution Private Limited
</span>
</p>
</div>
</div>
</div>
</div>
</div>
</section> -->


        <!-- ============= Benefits of choosing sec start ============= -->
        <?php require_once "partials/benefits-of-choosing.php"; ?>
        <!---------------- Benefits of choosing sec End ------------------>
        <div class="blogger-third-section">
            <div class="container text-center">
                <h2>Drive Good Results for Your Website</h2>
                <div class="row">
                    <div class="col-md-12">
                        <p>We have experience team of blogging outreach experts who help to get in touch with quality
                            blogs.
                            And we can strongly say that we provide one of the best services in this line of work. We
                            have
                            knowledge of work trained team, influential relationship with bloggers and manual blogging
                            outreach services. </p>
                    </div>

                </div>
            </div>
        </div>

        <div class="blogger-faq">
            <div class="faq-head-section text-center">
                <h3>Frequently Asked Questions On Web Design And Development:</h3>
                <p>Submit your requirement or query, We will process it within 24 hours.</p>
            </div>
            <div class="container">

                <ul class="faq-body">

                    <li class="faq-li">
                        <i class="fas fa-plus" id="first_id"></i>
                        <h4 class="faq-title">What Domain Name Should I Choose?</h4>
                        <div class="faq-details">
                            <p>
                                The selection of domain name is totally depending on you. If you permit us to choose
                                your
                                domain name we can. We select trendy domains name that are very attractive. After
                                selecting
                                some domain name we send you to select one of them</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">How Long Does It Take To Create A Website design?</h4>
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
                            <p>Our charge for website design is depending on the website complexity and the deadline
                                time.
                                We like to discuss our requirements with our clients.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Will My Website Design Be Search Engine Friendly?</h4>
                        <div class="faq-details">
                            <p>Yes, we create website keeping in mind of search engine guidelines. So don’t worry about
                                whether your site design is search engine friendly or not. We ensure that your site will
                                be
                                up to date.</p>
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
                        <h4 class="faq-title">Can I See My Website While It's In Progress?</h4>
                        <div class="faq-details">
                            <p>Yes, of course, you can. With the help of our development service we build your website
                                and
                                at that time we share ‘username’ and ‘password’ so that you can check the progress of
                                your
                                site</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What If I Do Not Like The Design?</h4>
                        <div class="faq-details">
                            <p>We always prefer to make our clients’ happy, so if you don’t satisfy with our web design,
                                we
                                come up with another one.</p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Are There Hidden Costs Associated With Web Design Services?</h4>
                        <div class="faq-details">
                            <p>No, there isn’t any hidden cost associated with web design service. </p>
                        </div>
                    </li>

                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">What Are My Options For E-Commerce?</h4>
                        <div class="faq-details">
                            <p>For payment in India we prefer Google Pay and outside India we mostly prefer PayPal. </p>
                        </div>
                    </li>


                    <li class="faq-li">
                        <i class="fas fa-plus"></i>
                        <h4 class="faq-title">Who Owns The Website Once Design Work Is Complete?</h4>
                        <div class="faq-details">
                            <p>Of course, You. The website belongs to you, so after complete website design you own it.
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
    <script type="text/javascript">
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
    </script>


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
        /*
        var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
        };
        */

        $().UItoTop({
            easingType: 'easeOutQuart'
        });

    });
    </script> -->
    <!-- <script src="js/SmoothScroll.min.js"></script> -->
    <!-- //smooth-scrolling-of-move-up -->
    <!-- Bootstrap Core JavaScript -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <!-- //Bootstrap Core JavaScript -->
    <!-- <script>
    $(document).ready(function() {
        /*
        var defaults = {
        containerID: 'toTop', // fading element id
        containerHoverID: 'toTopHover', // fading element hover id
        scrollSpeed: 1200,
        easingType: 'linear'
        };
        */

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