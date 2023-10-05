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
<html lang="en">

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
    <div id="home" class=" row m-0 w-100 animate_only_for_scroll">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- //header -->
        <!-- banner -->
        <div class="p-0 d-flex align-items-center justify-content-center my-5">
            <div id="main-wrapper" class="container ">
                <div class="row justify-content-center reveal">
                    <div class="col-xl-10 ">
                        <div class="card border-0" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body p-0">
                                <div class="row w-100 m-0 no-gutters">
                                    <div class="col-lg-6 d-none d-lg-inline-block m-auto text-center p-0">

                                        <div class="account-block rounded-right">

                                            <img src="./images/main/welcome-back-login-banner.webp" class="w-100">
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
                                                        name="txtUser" pattern="[^@\s]+@[^@\s]+\.[^@\s]+" class="form-control" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your email address!
                                                    </div>
                                                </div>
                                                <div class="form-group ">
                                                    <label>Password</label>
                                                    <div class="input-group">
                                                        <input type="password" placeholder="Valid Password"
                                                            minlength="6" id="txtPass" name="txtPass"
                                                            class="form-control custom_view_pass" required>
                                                        <button class="btn" type="button"><i
                                                                class="fa-solid fa-eye custom-toggle-icon"
                                                                id="toggler"></i></button>
                                                        <div class="invalid-feedback">
                                                            Please enter your Password!
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="col-sm-12 mb-2 submit-divclass  text-center">
                                                    <a href="/"><button class="my-buttons-hover bn21" type="submit"
                                                            name="btnLogin"><i
                                                                class="pe-1 fa-solid fa-right-to-bracket"></i>
                                                            Login</button></a>
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
        <!-- //end container sec -->
        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>
        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <script src="assets/vendors/custom-passwordview/c_password-view.js"></script>
    <script src="assets/vendors/js/reveal-animation.js"></script>
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
</body>

</html>