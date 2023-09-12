<?php
session_start();
require_once("includes/constant.inc.php");
require_once("_config/dbconnect.php");

require_once("includes/constant.inc.php");
require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once("classes/services.class.php");
require_once "classes/employee.class.php";

//require_once("../classes/front_photo.class.php");
require_once("classes/blog_mst.class.php");
require_once("classes/utility.class.php");
require_once("classes/utilityMesg.class.php");
require_once("classes/utilityImage.class.php");
require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$service		= new Services();
$blogMst		= new BlogMst();
$Employee       = new Employee();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
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
<?php
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <title>About Our Company :<?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Leelija is an online product selling agency based in India. We are enhancing our business with the same tactics that we employ to our clients.">
    <meta charset="utf-8">
    <meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
		Ready website for business, High Quality website sales, High quality blogs sales, expired domain sales" />
    
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
    <!-- <link href="css/style.css" rel='stylesheet' type='text/css' /> -->
    <link href="css/about.css" rel='stylesheet' type='text/css' />
    <link href="css/leelija.css" rel='stylesheet' type='text/css' />

    <!--webfonts-->
    <!-- <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">

    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet"> -->
    <!--//webfonts-->


</head>


<body id="page-top">
    <?php require_once "partials/navbar.php"; ?>

    <div class="about_us">
        <div class="container-fluid">
            <div class="row my-3" onmouseleave="hideDetails()">
                <div class="col-12 col-lg-5 mx-sm-0 py-2">
                    <!-- <img src="images/team/1.jpg" alt=""> -->
                    <div class="team_details text-primary" id="team_details">
                        <div>
                            <h2 class="fs-1">Meet Our Team</h2>
                            <p class="pl-2">None of us ever do great things individually but teamwork is always more fruitful toward organizational objectives. Our hardworking employees are focused on being productive and doing their best. </p>
                        </div>

                    </div>
                </div>
                <div class="col-12 col-lg-7 p-0 p-lg-5">
                    <div class="row justify-content-evenly px-1 px-lg-0">

                    <?php
                    
                    $emps = $Employee->allEmps();
                    foreach ($emps as $emp) {
                        

                    if ($emp['image'] == '') {
                     
                        if ($emp['gender'] == 'Male') {
                            $img = 'images/icons/male-user.png';
                        }else{
                            $img = 'images/icons/female-user.png';
                        }

                    }else {
                        $img = 'images/emps/'.$emp['image'];
                    }

                        echo '<div class="col-6 col-sm-4 col-md-3 col-lg-3 d-flex flex-column align-items-center c_col"
                            style="height: 12rem;">
                            <img src="'.$img.'" class="team_thumnail m-2" alt="" onmouseover="showInfo(this)"
                                onmouseleave="hideInfo(this)" onclick="showDetails(this)" data-name="'.$emp['name'].'"
                                data-role="'.$emp['designation'].'" data-fb="#" data-wp="#">
                            <div class="team_emp bg-primary w-100 p-auto d-none">
                                <p class="text-light"><b>'.$emp['name'].'</b></p>
                                <span><small>Click to See Details</small></span>
                            </div>
                        </div>';
                    }
                    ?>

                    </div>
                </div>
            </div>
        </div>

        <!-- =============================================================================== -->
        <div class="our_passion">
            <div class="container">
                <h4 class="py-4 blue_color_class text-uppercase text-center font-weight-bold">Our Main Goals are</h4>

                <div class="row justify-content-evenly m-0">
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="d-flex align-items-center">
                            <span class="our_goals_img w-25"><img class="w-100 p-1" src="images/icons/website.png"
                                    alt=""> </span>
                            <span class="w-75"><a href="web-development-services.php">Web Design &<span
                                        class="br"></span>Development</a></span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2">
                        <div class="d-flex align-items-center">
                            <span class="our_goals_img w-25"><img class="w-100 p-1"
                                    src="images/icons/digital-marketing.png" alt="">
                            </span>
                            <span class="w-75"><a href="social-media-marketing-services.php">Business<span
                                        class="br"></span>Branding</a></span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 mt-2 mt-md-0">
                        <div class="d-flex align-items-center">
                            <span class="our_goals_img w-25"><img class="w-100 p-1" src="images/training.png" alt="">
                            </span>
                            <span class="w-75"><a href="seo-services.php">Online<span
                                        class="br"></span>Reputation</a></span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 mt-2 mt-md-0">
                        <div class="d-flex align-items-center">
                            <span class="our_goals_img w-25"><img class="w-100 p-1" src="images/income.png" alt="">
                            </span>
                            <span class="w-75"><a href="content-marketing.php">Content<span
                                        class="br"></span>Branding</a></span>
                        </div>
                    </div>
                    <div class="col-6 col-md-3 col-lg-2 mt-2 mt-md-0">
                        <div class="d-flex align-items-center">
                            <span class="our_goals_img w-25"><img class="w-100 p-1" src="images/icons/apps.png" alt="">
                            </span>
                            <span class="w-75"><a href="web-development-services.php">Application<span
                                        class="br"></span>Development</a></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ====================================================================================== -->



        <!-- <div class="about_us_header text-center text-white">
            <h1 class="text-uppercase font-weight-bold">Know More About Us</h1>
            <h3 class="pt-3 mons-font">check out who we are</h3>
        </div> -->

        <div class="about_body px-3 px-md-0 py-3">

            <div class="row my-5">
                <div class="col-12 col-md-5 m-auto">
                    <h2 class="text-uppercase fw-bolder text-center py-2 text-primary">About Us</h2>
                </div>
                <div class="col-12 col-md-7 pe-md-5 text-center text-md-start">
                    <p>Leelija Web Solutions, an ISO 9001:2015 certified online Marketplace. We are enhancing our
                        business
                        with the same tactics that we employ to our clients. Our aim is quite clear like crystal to help
                        people grow their businesses through an effective and efficient way. Our main focus areas are
                        numbers of online Applications, Business Development Software, Blogs, Guest Post Services,
                        On-Page
                        SEO, Blogs + Domain name + Content with good metrics, live ready website that includes a
                        detailed
                        description covering all aspects of your business and you as entrepreneurs, etc. In an industry
                        where changes are being quite frequent, it’s our duty to stay always far from changes. Our team
                        is
                        quite efficient in learning, educating, innovating, creating, beyond these delivering effective
                        results. It’s very simple if we can do that for ourselves then certainly, we can do for our
                        clients
                        too.
                    </p>
                </div>
            </div>

            <!-- =============================================================================================== -->
            <div class="what_we_do light_blue_bg">
                <div class="row text-center text-md-start align-items-center">
                    <div class="col-lg-6">
                        <div class="container-fluid">
                            <div class="service_small_box">
                                <h3 class="p-3 p-md-0 py-md-3">What we do?</h3>
                                <p>
                                    We are enhancing our business with the same tactics that we employ to our clients.
                                    Our aim is quite clear like crystal to help people grow their businesses through an
                                    effective and efficient way. Our main focus areas are numbers of online
                                    Applications, Business Development Software, Blogs, Guest Post Services, On-Page
                                    SEO, Blogs + Domain name + Content with good metrics, live ready website that
                                    includes a detailed description covering all aspects of your business and you as
                                    entrepreneurs, etc.
                                </p>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-6 side_img ps-0">
                        <img src="images/what_we_do.jpg" alt="What We Do">
                    </div>
                </div>
            </div>
            <!-- =============================================================================================== -->
            <div class="row align-items-center text-center text-md-start">
                <div class="col-lg-6 side_img ps-0">
                    <img src="images/our_mission.jpg" alt="Our Mission">
                </div>
                <div class="col-lg-6">
                    <div class="container-fluid">
                        <div class="service_small_box">
                            <h3 class="p-3 p-md-0 py-md-3">Our Mission</h3>
                            <p>
                                The world is changing each second so each industry, we make it a priority to stay a
                                couple of steps ahead all the time. Led by dynamic management, we are always acquiring
                                knowledge to develop more, taking all the counts of the latest trends and whenever need
                                adding services that is influential to our client's growth. Our goal is to make clients
                                success and we never stop until that point is reached, even if it requires extra time
                                and resources from our end. I always think the success of our client is our success;
                                without them, we would be in an empty planet. The number is going upward each day. We
                                are really excited to witness something more tremendous in the near future.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============================================================================================== -->
            <div class="light_blue_bg">
                <div class="container text-center">
                    <h2 class="text-uppercase fw-bolder py-5"><strong>Our Advantage</strong></h2>
                    <div class="row">
                        <div class="col-sm-4 mt-3 mt-sm-0">
                            <h3><a href="start-selling.php">Global Marketplace</a></h3>
                            <p>We Provide <a href="start-selling.php">Global Marketplace, Where any can sales their
                                    ready web products, ready blogs, guest post etc..</a></p>
                        </div>

                        <div class="col-sm-4 mt-3 mt-sm-0">
                            <h3><a href="domains.php">Ready Web Products</a></h3>
                            <p><a href="domains.php"> Here Applications ready for your business, No need to wastes time
                                    just pick it up, Graet domain name also</a></p>
                        </div>

                        <div class="col-sm-4 mt-3 mt-sm-0">
                            <h3> <a href="start-selling.php">Dream Big</a></h3>
                            <p><a href="start-selling.php">We Will Help You To DREAM BIG About Your BUSINESS, Now a days
                                    no one samll just need to be see DREAM BIG</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- =============================================================================================== -->
        </div>


        <!-- =============================================================================================== -->
        <div class="our_passion">
            <div class="container p-2 p-md-5">
                <h3 class="text-center">Wesite Development <span class="text-primary">|</span> Business Branding
                    <span class="text-primary">|</span> Digital Marketing
                </h3>
                <p class="bbdm">
                    Web Development is a keypart to make your business online presence. Our team is very much capable of
                    providing a well developed websites keeping all your requirements in considerations. Leelija is also
                    helping on branding of your websites. We are proud of delivering such digital experinces to our
                    clients that makes an impact on their business. Currently, we are working with so many clients and
                    their feedback inspires us to make something different than others.
                </p>
            </div>
        </div>
        <!-- ====================================================================================== -->




    </div>
    <div class="mt-4">
        <?php include('seller-action.php') ?>
    </div>

    <!-- </div> -->
    <!--  Single service page end //-->

    <!-- </div> -->
    <!--  Main service page end //-->

    <?php require_once "partials/footer.php"; ?>
    <!-- /Footer -->

    <!-- </div> -->

    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>

    <!-- ==== js for smooth scrollbar ==== -->
    <script src="plugins/smooth-scrollbar.js"></script>
    <script>
    var Scrollbar = window.Scrollbar;
    Scrollbar.init(document.querySelector('body'));
    </script>
    <!-- ==== js for smooth scrollbar End ==== -->

    <script>
    const showInfo = (t) => {
        t.nextSibling.nextElementSibling.classList.remove("d-none");
    }

    const hideInfo = (t) => {
        t.nextSibling.nextElementSibling.classList.add("d-none");
    }

    function showDetails(t) {
        let image = t.getAttribute('src');
        // alert(image);
        let name = t.getAttribute('data-name');
        let role = t.getAttribute('data-role');
        let fbLink = t.getAttribute('data-fb');
        let wpLink = t.getAttribute('data-wp');

        let content = `<div>
                            <h3 class="pb-0 mb-0">${name}</h3>
                            <p><b>${role}</b></p>
                            <div class="row team_social mt-3">
                                <div class="col-3"><a href="#"><img src="images/icons/linkedIn_logo.png" alt=""></a></div>
                                <div class="col-3"><a href="#"><img src="images/icons/email_logo.png" alt=""></a></div>
                                <div class="col-3"><a href="#"><img src="images/icons/facebook-logo.png" alt=""></a></div>
                                <div class="col-3"><a href="#"><img src="images/icons/whatsapp_logo.png" alt=""></a></div>

                            </div>
                        </div>`;


        document.getElementById("team_details").innerHTML = content;
    }

    function hideDetails() {
        let teamContent = `<div>
                            <h2 class="fs-1">Meet Our Team</h2>
                            <p class="pl-2">None of us ever do great things individually but teamwork is always more fruitful toward organizational objectives. Our hardworking employees are focused on being productive and doing their best. </p>
                        </div>`;

        document.getElementById("team_details").innerHTML = teamContent;

    }
    </script>
</body>

</html>