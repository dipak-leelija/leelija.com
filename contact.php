<?php
session_start();
require_once __DIR__ . "/includes/constant.inc.php";
require_once ROOT_DIR . "/_config/dbconnect.php";
include_once ROOT_DIR . "/includes/contact-us-email.inc.php";
include_once ROOT_DIR . "/includes/user.inc.php";

require_once("classes/date.class.php");
require_once("classes/error.class.php");
// require_once("classes/search.class.php");
require_once("classes/customer.class.php");
require_once("classes/login.class.php");
require_once ROOT_DIR . "classes/email.class.php";
require_once ROOT_DIR . "classes/contact.class.php";
require_once("classes/utility.class.php");
// require_once("classes/utilityMesg.class.php");
// require_once("classes/utilityImage.class.php");
// require_once("classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$DateUtil      	= new DateUtil();
$MyError 		= new MyError();
// $search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$EmailObj		= new Email();
$Contact		= new Contact();
$utility		= new Utility();
// $uMesg 			= new MesgUtility();
// $uImg 			= new ImageUtility();
// $uNum 			= new NumUtility();
######################################################################################################################
$typeM		= $utility->returnGetVar('typeM','');
//user id
$cusId		= $utility->returnSess('userid', 0);

$errMsg = '';
$alertMsg  = '';

if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if(isset($_GET['errMsg']) && isset($_GET['alertMsg'])){
		$errMsg 	= $_GET['errMsg'];
		$alertMsg	= $_GET['alertMsg'];
	}
}


if ($_SERVER['REQUEST_METHOD'] == 'POST'){

	if(isset($_POST['contactName']) && isset($_POST['contactEmail']) && isset($_POST['contactPhone']) && isset($_POST['contactMessage'])){


		//get values in variables
		$fullName				  = strip_tags(trim($_POST['contactName']));
		$txtEmail				  = strip_tags(trim($_POST['contactEmail']));
		$txtPhone				  = strip_tags(trim($_POST['contactPhone']));
		$txtMessage				  = strip_tags(trim($_POST['contactMessage']));
		
		$sess_arr	= array('contactName', 'contactEmail', 'contactPhone', 'contactMessage');
		$utility->addGetSessArr($sess_arr);
		
		//checking for error
		$invalidEmail 	= $MyError->invalidEmail($txtEmail);

		if($fullName == ''){

		$errMsg = ERLEADGENAME;
		$alertMsg  = 'alert-warning';

		}else if(preg_match("/^ER/",$invalidEmail)){

		$errMsg = ERLEADGEN003;
		$alertMsg  = 'alert-warning';

		}else if($txtPhone == '' || $txtPhone < 10){

		$errMsg = ERLEADGEN004;
		$alertMsg  = 'alert-warning';

		}else if($txtMessage == ''){
		
		$errMsg = ERLEADGEN006;
		$alertMsg  = 'alert-warning';

		}else{		
				
					//send email
					$subjectEmail 	= "Contact from ".$fullName." - ". $DateUtil->todayWithTime('.');
					$to 			= COMPANY_S. "<webtechhelp.org@gmail.com>";			
					$from 			= $fullName. "<".$txtEmail.">";
					
					
					$body = '
						<div style="width: 100%; height:auto; font:normal 13px Georgia, Times, Arial, Verdana, sans-serif;
									color: #000000; bachground-color:#fff;">
							<div style="padding:10px; margin:0px auto;" align="center">
								<img src="'.LOGO_WITH_PATH.'" height="'.LOGO_HEIGHT.'" width="'.LOGO_WIDTH.'" 
								alt="'.LOGO_ALT.'" />
							</div>
							
							<div style="width: 650px; height:auto; margin:5px auto 10px auto; padding:20px 10px;
										font:normal 12px Helvetica, Arial, Verdana, sans-serif;
										color: #000000; bachground-color:#FCFCFC; -moz-border-radius: 4px; 
										-webkit-border-radius: 4px;border:1px solid #eee;">
										
								<h2 style="font:bold 12px Arial, Verdana, sans-serif;width:650px; height:30px;
										background-color:#DCDCC7; color:#7C6677; text-align:center; line-height:30px;
										vertical-align:middle; padding:0; margin:0">
									New Lead
								</h2>
								
								<p>Dear Admin,</p>
								<p>You have received a new lead. Below is the detail:</p>
								
								
								<p style="padding:10px">
									Name:    '.addslashes($fullName).'<br />
									Email:   '.$txtEmail.'<br />
									Phone:   '.$txtPhone.'<br />
									Message: '.addslashes($txtMessage).'<br />
								</p>
								
								<p>
								Regards,<br />
								Customer Service<br />
								'.COMPANY_S.'
								</p>
							</div>
					
					</div>
					';
					
						
					//send email to client
					// $EmailObj->sendEmail($to, $subjectEmail, $body, $fullName, $txtEmail);
					
					// Contact Data inser in contact table
					$added = $Contact->addContact($fullName, $txtEmail, $txtPhone, $txtMessage);
					if ($added) {
						$errMsg = SUCONTACT001;
						$alertMsg  = 'alert-primary';
						header('Location: '.$_SERVER['PHP_SELF'].'?errMsg='.$errMsg.'&alertMsg='.$alertMsg);
						exit;
					}
			
					$sess_arr	= array('contactName', 'contactEmail', 'contactPhone', 'contactMessage');
					$utility->delSessArr($sess_arr);			
			}


	}
	
	
}
?>
<!DOCTYPE HTML>
<html lang="en">

<head>
    <?php include('head-section.php');?>
    <title>Contact Us - <?= COMPANY_S ?> Global Support</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="LeeLija staff always available for your support. Our technical and SEO staffs always online, Leelija team provided free support for every one." />
    <meta charset="utf-8">
    <meta name="keywords"
        content="contact for SEO, contact for web development, support for on page SEO, support for technical SEO, contact for guest post" />
    <link href="css/contact.css" rel='stylesheet' type='text/css' />

</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="home">
        <!-- header -->
        <?php require_once "partials/navbar.php"; ?>
        <!-- //header -->

        <!-- contact -->
        <?php //require_once "partials/contact-section.php"; ?>


        <div class="contact-page-section px-3 py-5" id="contact">

            <section class="contact-mainpage">
                <div class="contact-box col-12 col-xl-10">
                    <div class="contact-social-div">
                        <div class="d-flex h-100">
                            <div class="links">
                                <div class="icons-social-div">
                                    <a href="https://www.facebook.com/leelijaweb/" target="_blank"><img
                                            class="smedia-logo" src="images/icons/social-media-icons/facebook2x.png"
                                            alt="email"></a>
                                </div>
                                <div class="icons-social-div">
                                    <a href="https://www.linkedin.com/in/leelija" target="_blank"><img
                                            class="smedia-logo" src="images/icons/social-media-icons/linkedin2x.png"
                                            alt="email"></a>
                                </div>
                                <div class="icons-social-div">
                                    <a href="https://twitter.com/lee_lija" target="_blank"><img class="smedia-logo"
                                            src="images/icons/social-media-icons/twitter2x.png" alt="email"></a>
                                </div>
                                <div class="icons-social-div">
                                    <a href="https://goo.gl/maps/AKCsxmTbJcdta2YKA" target="_blank"
                                        class="text-link link--right-icon text-white"><img class="smedia-logo"
                                            src="images/icons/social-media-icons/getlocationmap.png" alt="email"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="contact-form-wrapper">
                        <form name="formContact" id="formContact" class="needs-validation" method="post"
                            action="<?= $_SERVER['PHP_SELF']?>" enctype="multipart/form-data" autocomplete="off"
                            novalidate>
                            <h2 class="contact-main-h2">Contact Us</h2>

                            <?php if ($errMsg != '') {?>

                            <div class="alert <?= $alertMsg ?> alert-dismissible fade show" role="alert">
                                <strong><?= $errMsg ?></strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>

                            <?php } ?>

                            <div class="form-floating mb-3">
                                <input type="text" minlength="7" name="contactName" id="contactName"
                                    class="form-control" placeholder="name@example.com" required>
                                <label for="floatingInput">Full Name</label>
                                <div class="invalid-feedback">
                                    Please Enter your Full Name!
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" name="contactEmail" id="contactEmail" inputmode="email"
                                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
                                    value="<?php if(isset($_SESSION['txtEmail'])){ echo $_SESSION['txtEmail'];}?>"
                                    class="form-control" placeholder="name@example.com" required>
                                <label for="floatingInput">Email Address</label>
                                <div class="invalid-feedback">
                                    Please enter your email!
                                </div>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    minlength="10" pattern="[0-9]+" maxlength="10" name="contactPhone" id="contactPhone"
                                    class="form-control" id="floatingInput" placeholder="name@example.com" required>
                                <label for="floatingInput">Phone </label>
                                <div class="invalid-feedback">
                                    Please enter valid phone Number!
                                </div>
                            </div>
                            <div class="form-floating">
                                <textarea class="form-control" name="contactMessage" minlength="10" maxlength="200"
                                    placeholder="Leave a comment here" id="floatingTextarea" style="min-height: 96px;"
                                    required></textarea>
                                <label for="floatingTextarea">Message</label>
                                <div class="invalid-feedback">
                                    Please enter your queries!
                                </div>
                            </div>

                            <div class="text-center  pt-4">
                                <a href="/">
                                    <button value="Send" class="my-buttons-hover bn21">Submit</button>
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

            </section>

        </div>
        <!-- //contact -->

        <!-- Footer -->
        <?php require_once "partials/footer.php"; ?>

        <!-- /Footer -->
    </div>
    <!-- js-->
    <script src="plugins/jquery-3.6.0.min.js"></script>
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.js"></script>
    <script src="plugins/bootstrap-5.2.0/js/bootstrap.bundle.min.js"></script>
    <script src="<?= URL ?>js/ajax.js" type="text/javascript"></script>
    <script src="<?= URL ?>js/contact_form.js" type="text/javascript"></script>
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