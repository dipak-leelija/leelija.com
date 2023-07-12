<?php 
session_start();
// require_once("_config/connect.php");
require_once("_config/dbconnect.php");

include_once("includes/constant.inc.php");
include_once("includes/contact-us-email.inc.php");

require_once("classes/contact.class.php"); 

require_once("classes/email.class.php"); 
include_once("classes/subscriber.class.php");

require_once("classes/utility.class.php"); 
include_once("classes/error.class.php");
include_once("classes/utilityMesg.class.php");

$contact 		= new Contact();
$subscriber 	= new EmailSubscriber();
$myerror		= new Myerror();
$emailObj		= new Email();
$uMesg			= new MesgUtility();
$utility		= new Utility();

if(isset($_GET['txtName']) && isset($_GET['txtEmail']) && isset($_GET['txtPhone']) && isset($_GET['txtMessage']))
{
	
	//get values in variables
	$txtName				= strip_tags(trim($_GET['txtName']));
	$txtEmail				= strip_tags(trim($_GET['txtEmail']));
	$txtPhone				= strip_tags(trim($_GET['txtPhone']));
	$txtMessage				= strip_tags(trim($_GET['txtMessage']));
	
	$sess_arr	= array('txtName', 'txtEmail', 'txtMessage');
	$utility->addGetSessArr($sess_arr);
	
	//checking for error
	$invalidEmail 	= $myerror->invalidEmail($txtEmail);	
	if($txtName == '')
	{
		//$uMesg->dispMesgWithMesgVal(' ER: '.ERLEADGEN001, "ERROR", "images/icon/", '', 'error-block', 'success-block');
		echo "<span class='orangeLetter'>".ERLEADGEN001."</span>";
	}
	else if(preg_match("/^ER/",$invalidEmail))
	{
		//$uMesg->dispMesgWithMesgVal(' ER: '.ERLEADGEN002, "ERROR", "images/icon/", '', 'error-block', 'success-block');
		echo "<span class='orangeLetter'>".ERLEADGEN002."</span>";
	}
	else if($txtPhone == '')
	{
		//$uMesg->dispMesgWithMesgVal(' ER: '.ERLEADGEN005, "ERROR", "images/icon/", '', 'error-block', 'success-block');
		echo "<span class='orangeLetter'>".ERLEADGEN003."</span>";
	}
	else if($txtMessage == '')
	{
		//$uMesg->dispMesgWithMesgVal(' ER: '.ERLEADGEN005, "ERROR", "images/icon/", '', 'error-block', 'success-block');
		echo "<span class='orangeLetter'>".ERLEADGEN005."</span>";
	}
	else
	{		
		
			//$subsRes = $subscriber->addSubscriber($txtContactEmail, 0, $txtContactName, '', 0, '', $txtContactPhone);
			
			//send email
			$subjectEmail 	= "Contact from ".$txtName." - ". date("Y-m-d");
			$to 			= COMPANY_S. "<".SITE_EMAIL.">";			
			$from 			= $txtName. "<".$txtEmail.">";
			
			 
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
							Name:    '.addslashes($txtName).'<br />
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
			$emailObj->sendEmail($to, $subjectEmail, $body, $txtName, $txtEmail);
			
			// Contact Data inser in contact table
			$contact->addContact($txtName, $txtEmail, $txtPhone, $txtMessage);
			
			$sess_arr	= array('txtName', 'txtEmail', 'txtMessage');
			$utility->delSessArr($sess_arr);			
			echo "<span style='color:green;'>".SUCONTACT001."</span>";
			//$uMesg->dispMesgWithMesgVal(SUCONTACT001,"SUCCESS","images/icon/",'','error-block','success-block');  
			
	}
	
}
else
{	
	$uMesg->dispMesgWithMesgVal(' ER: '.SULEADGEN001, "ERROR", "images/icon/", '', 'error-block', 'success-block');
}

?>