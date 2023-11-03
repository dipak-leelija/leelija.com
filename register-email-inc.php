<?php
session_start();
include_once __DIR__ . "/includes/constant.inc.php";
include_once __DIR__ . "/includes/order-constant.inc.php";
include_once __DIR__ . "/includes/contact-us-email.inc.php";
require_once __DIR__ . "/classes/encrypt.inc.php";


require_once __DIR__ . "/_config/dbconnect.php";

require_once __DIR__ . "/classes/class.phpmailer.php";
require_once __DIR__ . "/mail-templates/welcome-mail-template.php";

require_once __DIR__ . "/classes/contact.class.php";
include_once __DIR__ . "/classes/customer.class.php";
include_once __DIR__ . "/classes/subscriber.class.php";
include_once __DIR__ . "/classes/encrypt.inc.php";
require_once __DIR__ . "/classes/utility.class.php"; 
include_once __DIR__ . "/classes/error.class.php";
include_once __DIR__ . "/classes/utilityMesg.class.php";

$PHPMailer		= new PHPMailer();
$contact 		= new Contact();
$Customer		= new Customer();
$subscriber 	= new EmailSubscriber();
$error			= new MyError();
$uMesg			= new MesgUtility();
$utility		= new Utility();

if(isset($_SESSION['vkey']) && isset($_SESSION['newCustomerSess']) && isset($_SESSION['fisrt-name']) && isset($_SESSION['last-name']) && isset($_SESSION['email'])){	

	$regAction			= '';
	if (isset($_SESSION[PACK_ORD])) {
		$regAction		= strip_tags(trim($_SESSION[PACK_ORD][0]));
	}

	$verifyKey  	= strip_tags(trim($_SESSION['vkey'])); 
	$custId 		= strip_tags(trim($_SESSION['newCustomerSess']));
	$firstName 		= strip_tags(trim($_SESSION['fisrt-name']));
	$lastName 		= strip_tags(trim($_SESSION['last-name']));
	$txtEmail 		= strip_tags(trim($_SESSION['email']));

	//checking for error
	$invalidEmail 	= $error->invalidEmail($txtEmail);

	if($firstName.$lastName == ''){

		echo "<span class='orangeLetter'>".ERLEADGEN001."</span>";

	}else if(preg_match("/^ER/",$invalidEmail)){

		echo "<span class='orangeLetter'>".ERLEADGEN002."</span>";

	}else{		
		
		//$subsRes = $subscriber->addSubscriber($txtContactEmail, 0, $txtContactName, '', 0, '', $txtContactPhone);


		$verifyKey = base64_encode($verifyKey);
		$regAction = base64_encode($regAction);
		$verificationUrl = URL.'/verify-account.php?action='.$regAction.'&verify='.$verifyKey;
		// Contact Data inser in contact table
		$contact->addContact($firstName.' '.$lastName, $txtEmail, '', '');		

		$cusId			= $utility->returnSess('userid', 0);
			
		// $sess_arr	= array('vkey', 'newCustomerSess', 'fisrt-name', 'last-name', 'profession');
		// $utility->delSessArr($sess_arr);			
			

		/*===========================================================================================================
		|																											|
		|										send mail to new customer											|
		|																											|
		============================================================================================================*/

		// echo $encLink =  URL.'/verify-account.php?verify='.$vkey;

		echo "-".$txtEmail."-";

		$userMailBody =  welcomeMailToUser($firstName, $verificationUrl);
		$fullName = $firstName.' '.$lastName; 
		try {
			$PHPMailer->IsSendmail();
			$PHPMailer->IsHTML(true);
			// $PHPMailer->setLanguage('en');
			$PHPMailer->Host        = gethostname();
			$PHPMailer->SMTPAuth    = true;
			$PHPMailer->Username    = SITE_EMAIL;
			$PHPMailer->Password    = SITE_EMAIL_P;
			$PHPMailer->From        = SITE_EMAIL;
			$PHPMailer->FromName    = COMPANY_FULL_NAME;
			$PHPMailer->Sender      = SITE_EMAIL;
			$PHPMailer->addAddress($txtEmail, $fullName);
			$PHPMailer->Subject     = "Verification Link of ". COMPANY_FULL_NAME;
			$PHPMailer->Body        = $userMailBody;
			if (!$PHPMailer->send()) {

				echo "Message could not be sent to customer. Mailer Error:-> {$PHPMailer->ErrorInfo}<br>";
				exit;
			}
			$PHPMailer->clearAllRecipients();

		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error:-> {$PHPMailer->ErrorInfo}";
		}
		print_r($PHPMailer);
		print_r($PHPMailer->send());


		/*===========================================================================================================
		|																											|
		|												send mail to admin											|
		|																											|
		============================================================================================================*/
			
		$data 		= array('Name', 'Email');
		$data_val 	= array($firstName.' '.$lastName, $txtEmail);

		$adminMailBody =  welcomeMailToAdmin($data, $data_val);

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
			$PHPMailer->addAddress(SITE_EMAIL, COMPANY_S.' Admin');
			$PHPMailer->Subject     = "New User Resgisterd to -". COMPANY_FULL_NAME;
			$PHPMailer->Body        = $adminMailBody;
			if (!$PHPMailer->send()) {
				echo "Message could not be sent to admin. Mailer Error:-> {$PHPMailer->ErrorInfo}<br>";
				exit;
			}
			$PHPMailer->clearAllRecipients();
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error:-> {$PHPMailer->ErrorInfo}";
		}
		
		echo "<span style='color:green;'>".SUCONTACT001."</span>";	
	}
	
	// header("location: verification-sent.php");
	// exit;

}else {
	echo 'Session Expired';
}


?>