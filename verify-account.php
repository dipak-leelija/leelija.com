<?php
require_once "includes/constant.inc.php";
require_once "includes/registration.inc.php";
require_once "includes/content.inc.php";
require_once "classes/encrypt.inc.php";

// session_start();

require_once("_config/dbconnect.php");

require_once "classes/class.phpmailer.php";

require_once "classes/date.class.php";
require_once "classes/error.class.php";
require_once "classes/search.class.php";
require_once "classes/customer.class.php";
require_once "classes/login.class.php";

require_once "classes/utility.class.php";
require_once "classes/utilityMesg.class.php";
require_once "classes/utilityImage.class.php";
require_once "classes/utilityNum.class.php";

require_once "includes/registration.inc.php";
require_once "mail-templates/welcome-mail-template.php";

/* INSTANTIATING CLASSES */
$dateUtil      	= new DateUtil();
$myError 		= new MyError();
$search_obj		= new Search();
$customer		= new Customer();
$PHPMailer		= new PHPMailer();
$Login          = new Login();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId			= $utility->returnSess('userid', 0);
//$cusDtl			= $client->getClientData($cusId);

$verified = false;

if (isset($_GET['verify'])) {
    $encVKey    = $_GET['verify'];
    $verifyCode = base64_decode($encVKey);

    $cusdata            = $customer->getCustomerDataByVerCode($verifyCode);

    if ($cusdata['acc_verified'] != 'Y' ) {
    
        $verified = $customer->updateVerStatusByCode($verifyCode, 'Y', 'Self Verification');

        if ($verified) {
            
            $errorMsg        = '';

            $toMail             = $cusdata['email'];
            $firstName          = $cusdata['fname'];
            $toFullName         = $cusdata['fname'].' '.$cusdata['lname'];
            $userMailBody       =  VerifiedMailtoUser($firstName);

            try {
                $PHPMailer->IsSendmail();
                $PHPMailer->IsHTML(true);
                $PHPMailer->Host        = gethostname();
                $PHPMailer->SMTPAuth    = true;
                $PHPMailer->Username    = SITE_EMAIL;
                $PHPMailer->Password    = SITE_EMAIL_P;
                $PHPMailer->From        = SITE_EMAIL;
                $PHPMailer->FromName    = COMPANY_FULL_NAME;
                $PHPMailer->Sender      = SITE_EMAIL;
                $PHPMailer->addAddress($toMail, $toFullName);
                $PHPMailer->Subject     = "Thank You for Verifying Your Account on ". COMPANY_FULL_NAME;
                $PHPMailer->Body        = $userMailBody;
                if (!$PHPMailer->send()) {

                	$errorMsg =  "Message could not be sent to customer. Mailer Error:-> {$PHPMailer->ErrorInfo}<br>";
                }
                $PHPMailer->clearAllRecipients();

            } catch (Exception $e) {
                $errorMsg = "Message could not be sent. Mailer Error:-> {$PHPMailer->ErrorInfo}";
            }

            // cheaking action value in the url
            if (isset($_GET['action'])) {
                
                if ($_GET['action'] != null || $_GET['action'] != '') {
                    $action    = $_GET['action'];
                    $actionId  = base64_decode($action);
                
                    $x_password = md5_decrypt($cusdata['password'], USER_PASS);

                    if(session_status() !== PHP_SESSION_ACTIVE){
                        session_start();
                        $_SESSION[PACK_ORD] = array($actionId);
                    }else{
                        $_SESSION[PACK_ORD] = array($actionId);
                    }
                    
                    $Login->validate($cusdata['email'], $x_password, 'email', 'password', 'customer', 'packages-summary.php');
                } 
            }
        }
    }else {
        $verified = true;
    }

}

?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta name="robots" content="noindex,nofollow">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Verification Status - <?php echo COMPANY_S; ?></title>
    <link rel="shortcut icon" href="<?php echo FAVCON_PATH?>" type="image/png" />
    <link rel="apple-touch-icon" href="<?php echo FAVCON_PATH?>" />

    <!-- Plugins Files -->
    <link href="<?= URL ?>/plugins/bootstrap-5.2.0/css/bootstrap.css" rel="stylesheet">
    <?php require_once ROOT_DIR.'/plugins/font-awesome/fontawesome.php'?>

    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link href="css/form.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/verified-account.css">
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
                                <?php
                                if ($verified) {
                                ?>
                                <div class=" mb-3 text-center">
                                    <img class="pending-img" src="<?php echo URL; ?>/images/email-verify.png">
                                </div>

                                <h1 class=""> Your Account is Verified!</h1>
                                <p class="">Congratulations! Now you can <a href="<?php echo URL; ?>/login">Login</a> to
                                    your Account.
                                    If you need any kind of help, feel free to Contact <a class="" style="color: coral;"
                                        href="contact.php"><?php echo COMPANY_FULL_NAME?></a>
                                </p>
                                <?php
                                }else{
                                ?>
                                <div class=" mt-5 text-center">
                                    <img class="pending-img" src="<?php echo URL; ?>/images/icons/error.png">
                                </div>

                                <h1 class=""> Failed to Verify!</h1>
                                <p class="">Sorry! We can not verify your account, please try to verify again or Contact
                                    <a class="" style="color: coral;"
                                        href="<?php echo URL; ?>/contact"><?php echo COMPANY_FULL_NAME?></a>
                                </p>
                                <?php
                                echo '<p class="text-center">'.$errorMsg.'<p>';
                                }
                                ?>
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