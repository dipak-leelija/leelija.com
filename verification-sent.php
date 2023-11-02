<?php
session_start();
require_once "includes/constant.inc.php";
require_once "includes/registration.inc.php";
require_once("_config/dbconnect.php");

require_once "classes/date.class.php";
require_once "classes/error.class.php";
require_once "classes/search.class.php";
require_once "classes/customer.class.php";

require_once "classes/blog_mst.class.php";
require_once "classes/utility.class.php";
require_once "classes/utilityMesg.class.php";
require_once "classes/utilityImage.class.php";
require_once("classes/utilityNum.class.php");

require_once("includes/registration.inc.php");


/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$myError 		= new MyError();
$search_obj		= new Search();
$customer		= new Customer();

//$ff				= new FrontPhoto();
$blogMst		= new BlogMst();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
//$cusDtl			= $client->getClientData($cusId);

if (!isset($_SESSION['email'])) {
    header('Location: '.URL);
    exit;
}
$email = $_SESSION['email'];
session_unset();
session_destroy();
?>
<!DOCTYPE HTML>
<html lang="zxx">

<head>
    <meta name="robots" content="noindex,nofollow">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verify your Email - <?php echo COMPANY_S; ?></title>
    <link rel="shortcut icon" href="<?php echo FAVCON_PATH?>" type="image/png" />
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH?>" />

    <!-- Plugins Files -->
    <link href="<?= URL ?>/plugins/bootstrap-5.2.0/css/bootstrap.css" rel="stylesheet">
    <?php require_once ROOT_DIR.'/plugins/font-awesome/fontawesome.php'?>

    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/verification-email-sent.css">

    <!--webfonts-->
    <link href="//fonts.googleapis.com/css?family=Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">    
    <link href="//fonts.googleapis.com/css?family=Montserrat:400,500,600,700,900" rel="stylesheet">
    <link href="//fonts.googleapis.com/css?family=Nunito+Sans:400,700,900" rel="stylesheet">
    <!--//webfonts-->
</head>
<body class="pt-0">
    <div id="home">
        <!-- header -->
        <?php require_once 'partials/navbar.php'; ?>
        <!-- //header -->
        <section class="verify-section">
            <div id="main-wrapper" class="">
                <div class="row justify-content-center ">
                    <div class="col-xl-10 col-md-10">
                        <div class="card border-0" style="box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
                            <div class="card-body text-center py-5">
                                <div class=" mb-3 text-center">
                                    <img class="pending-img" src="./images/email-not-verified.png">
                                </div>

                                <h1 class="">Verify Your Email!</h1>
                                <p>We have sent an email to <?php echo $email;?></p>
                                <p class="">
                                    You Need to verify Your email to continue.
                                    If you have not received the verification email, please check your "Spam" or "Bulk
                                    Email" folder.You can also Contact to <a class="" style="color: coral;"
                                        href="contact.php"><?php echo COMPANY_FULL_NAME?></a>

                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- js-->
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.bundle.js"></script>
    <script src="plugins/jquery-3.6.0.min.js"></script>


</body>

</html>