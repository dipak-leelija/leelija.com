<?php
session_start();
require_once("includes/constant.inc.php");
require_once("_config/dbconnect.php");

require_once("classes/date.class.php");
require_once("classes/error.class.php");
require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");

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

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM			= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
$return_url		= "";
//$cusDtl			= $client->getClientData($cusId);
if(isset($_GET['return_url'])){
    //$return_url			  	= $_GET['return_url'];
    $_SESSION['return_url'] 	= base64_decode($_GET["return_url"]); //get return url
}

if(isset($_POST['btnLogin'])){
    $login 			= $_POST['txtUser'];
    $password 		= $_POST['txtPass'];
    //echo $login;exit;

    if(($login == '') || ($password == '')){

        header("Location: ".$_SERVER['PHP_SELF']."?msg=invalid username or password");
	
    }else{

        if($_SESSION['return_url'] == ''){
	        if(isset($_SESSION['orderNow'])){
		     $_SESSION['return_url'] 	= "blogDetailsShare.php?id=".$_SESSION['orderNowId'];
	        }else{
		        $_SESSION['return_url'] 	= "dashboard.php"; 
	        }
        }
        //echo $_SESSION['return_url'];exit;
        $logIn->validate($login, $password, 'email', 'password', 'customer', $_SESSION['return_url']);
    }
}

?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
<?php include('head-section.php');?>
    <title>Login with Trustfully Platform | Login :: <?php echo COMPANY_S; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="Client login for buy ready web products or guest post services Or Reseller can login for sell his/her web products or guest post services">
    <meta charset="utf-8">
    <meta name="keywords" content="Web Design, Web Development, Apps Development, SEO Services, Guest Post Services, Domain name with Ready Website,
Ready website for business, High Quality website sales, High quality blogs sales, expired domain sales" />
    <link rel="stylesheet" href="css/login.css">
    <script>
    addEventListener("load", function() {
        setTimeout(hideURLbar, 0);
    }, false);

    function hideURLbar() {
        window.scrollTo(0, 1);
    }
    </script>
</head>

<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- //header -->
        <!-- banner -->

        <div class=" d-flex align-items-center justify-content-center mt-3">
            <div id="main-wrapper" class="container ">
                <div class="row justify-content-center">
                    <div class="col-xl-10">
                        <div class="card border-0" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body p-0">
                                <div class="row w-100 m-0 no-gutters">
                                    <div class="col-lg-6 d-none d-lg-inline-block m-auto text-center p-0">

                                        <div class="account-block rounded-right">

                                            <img src="./images/loginmainbanner.png" class="w-100">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 p-0">
                                        <div class="login-div-below-card">
                                            <!-- <div>
                                                <div class="alert-dismissible fade <?php echo $invUser;?>" role="alert">
                                                    <strong>Sorry!</strong> <?php echo $errorMsg; ?>
                                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            </div> -->
                                            <div class="mb-2">
                                                <h3 class="h4 font-weight-bold text-theme">Login</h3>
                                            </div>
                                            <h6 class="h5 mb-0">Welcome back!</h6>
                                            <p class="text-muted mt-2 mb-2">Enter your email address and password to
                                                access
                                                admin panel.</p>

                                            <form role="form" class="form-horizontal-login needs-validation"
                                                action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform"
                                                method="POST" enctype="multipart/form-data" autocomplete="off"
                                                novalidate>
                                                <div class="form-group">
                                                    <label>Email address</label>
                                                    <input type="email" placeholder="example@gmail.com" id="txtUser"
                                                        name="txtUser" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your email address!
                                                    </div>
                                                </div>

                                                <div class="form-group ">
                                                    <label>Password</label>
                                                    <input type="password" placeholder="Valid Password" minlength="6"
                                                        id="txtPass" name="txtPass" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your Password!
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 mb-2 submit-divclass  text-center">
                                                    <a href="/"><button class="my-buttons-hover bn21" type="submit"
                                                            name="btnLogin"><i class="pe-1 fa-solid fa-right-to-bracket"></i> Login</button></a>
                                                </div>
                                                <div>
                                                    <a href="#l" class="forgot-link text-right text-primary">Forgot
                                                        password?</a>
                                                </div>
                                                <p class="text-muted float-right mt-2 mb-0">Don't have an account? <a
                                                        href="register.php" class="text-primary ml-1">register</a></p>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- <div class="login_register_section">
            <div class="">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-md-6 d-none d-md-block">
                            <div class="login-sec-img text-center">
                                <div class="login-logo text-center p-2">
                                    <a href="index.php"> <img src="images/logo/logo.png" alt="" srcset=""></a>
                                </div>
                                <img src="images/login.png" alt="login-image" style="width: 54% !important">

                            </div>
                        </div>

                        <div class="col-12 col-md-6">
                            <div class="log_section mt-4 mt-md-0 p-3 w-75">

                                <form class="form-horizontal-login" role="form"
                                    action="<?php echo $_SERVER['PHP_SELF'] ?>" name="formContactform" method="POST"
                                    enctype="multipart/form-data" autocomplete="off">
                                    <form class="form-horizontal" role="form"
                                        action="<?php echo ''.htmlspecialchars(basename($_SERVER["PHP_SELF"], '.php'), ENT_QUOTES, "utf-8"); ?>"
                                        method="post" name="formContactform" enctype="multipart/form-data"
                                        autocomplete="off">

                                        <b
                                            style="color: red;"><?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?></b>
                                        <h3 class="text-center fw-bold  purple-text login_text">Sign in to your
                                            account</h3>

                                        <p class="login-second-title">-----------LOGIN WITH YOUR EMAIL-----------</p>

                                        <div class="col-12 p-0 m-0">
                                            <p class="login-tag-line">Place orders. Track reports. Great place to start
                                                growing your organic results.</p>
                                        </div>


                                        <div class="col-11 m-auto">
                                            <div class="col-sm-12">
                                                <div class="form-group">

                                                    <input type="text" id="txtUser" name="txtUser"
                                                        placeholder="Your Register Email" required class="form-control"
                                                        autofocus>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="password" id="txtPass" name="txtPass"
                                                        placeholder="Your Password" required class="form-control"
                                                        autofocus>
                                                </div>
                                            </div>

                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <button type="submit" name="btnLogin"
                                                        class="btn btn-primary w-100 fw-normal" id="loginBTN"><i
                                                            class="fas fa-sign-in-alt pr-2"></i> Login</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <hr>
                                        </div>

                                        <div class="form-group">
                                            <div class=" sign-up-btn pr-3 text-center">
                                                <span>Didn't have an account?</span> <a href="register.php" class="">
                                                    SignUp
                                                    Now</a>
                                            </div>
                                        </div>
                                    </form>
                                    <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
        <!-- //end container sec -->

        <!-- Seller Action section -->

        <!-- //Seller Action section -->

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->

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
    <!-- <script src="js/bootstrap.js"></script> -->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <script>
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()
    </script>
    <!-- ==== js for smooth scrollbar ==== -->
    <!-- <script src="plugins/smooth-scrollbar.js"></script>
    <script>
    var Scrollbar = window.Scrollbar;
    Scrollbar.init(document.querySelector('body'));
    </script> -->
    <!-- ==== js for smooth scrollbar End ==== -->
    <!-- //Bootstrap Core JavaScript -->
</body>

</html>