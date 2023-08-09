<?php 
ob_start();
session_start();
//include_once('checkSession.php');
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";

require_once "../includes/constant.inc.php";
require_once "../classes/date.class.php";
require_once "../classes/error.class.php";
require_once "../classes/search.class.php";
require_once "../classes/customer.class.php";
require_once "../classes/login.class.php";
require_once "../classes/adminLogin.class.php"; 
require_once "../classes/pagination.class.php";

//require_once("../classes/front_photo.class.php");
require_once "../classes/email.class.php"; 
require_once "../classes/blog_mst.class.php";
require_once "../classes/domain.class.php";
require_once "../classes/utility.class.php";
require_once "../classes/utilityMesg.class.php";
require_once "../classes/utilityImage.class.php";
require_once "../classes/utilityNum.class.php";

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$search_obj		= new Search();
$customer		= new Customer();
$logIn			= new Login();
$pages			= new Pagination();

//$ff				= new FrontPhoto();
$emailObj		= new Email();
$blogMst		= new BlogMst();
$domain			= new Domain();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
######################################################################################################################
$typeM			= $utility->returnGetVar('typeM','');
//user id
$userId			= $utility->returnSess('userid', 0);
$userData 		=  $adminLogin->getUserDetail($_SESSION[ADM_SESS]);

if(isset($_GET['bid'])){
	$id   = $_GET['bid'];
}
//NO OF CUSTOMER



if(isset($_POST['btnApproved'])){	
	
	$id 		= 	$_GET['id'];
	// echo $id;exit;
	$blogDtls		= $blogMst->showBlog($id);
	// print_r($blogDtls); exit;
	
	$blogMst->updateStatus($id,'yes',$userData[10]);
		
		
		$txtNewsLetterEmail  = $blogDtls[14];
		$txtCompany			 =  '.COMPANY_S.' ;	
			//send email
			$subjectEmail 	= "Your Blog  - ".$blogDtls[0]." Approved ";
			$to 			= "<".$txtNewsLetterEmail.">";
			$from 			= $txtCompany. "<".SITE_EMAIL.">";
			$body = '
				<div style="width: 100%; height:auto; font:normal 13px Georgia, Times, Arial, Verdana, sans-serif;
				color: #000000; bachground-color:#fff;">
				<div style="padding:10px; margin:0px auto;" align="center">
					<img src="'.URL.LOGO_WITH_PATH.'" height="'.LOGO_HEIGHT.'" width="'.LOGO_WIDTH.'" alt="'.LOGO_ALT.'" />
				</div>
					<div style="width: 650px; height:auto; margin:5px auto 10px auto; padding:20px 10px;
						font:normal 12px Helvetica, Arial, Verdana, sans-serif;
						color: #000000; bachground-color:#FCFCFC; -moz-border-radius: 4px; -webkit-border-radius: 4px;
						border:1px solid #eee;">
						<h2 style="font:bold 12px Arial, Verdana, sans-serif;width:650px; height:30px;
						background-color:#DCDCC7; color:#7C6677; text-align:center; line-height:30px;vertical-align:middle; padding:0; margin:0">
						Blog Name. '.$blogDtls[0].'
						</h2>
						<p style=" font-size: 20px;">Dear '.$blogDtls[15].',</p>
						<p>Your Blog has been successfully Approved . Check Your live blog on:
						<a href="https://www.leelija.com">LeeLija
						</a></p><br>
							
						<p style=" font-size: 20px; style: bold;">
							Thanks & Regards,<br />
							Customer Service<br />
							'.COMPANY_S.'
						</p>
					</div>
								
				</div>
				';
							
				//send email to All Employee
				$emailObj->sendEmail($to, $subjectEmail, $body, $blogDtls[15], $from);
				
			//end send email..
	
	header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=Blog is approved &code=&id=");
	
}
?>

<title><?php echo COMPANY_S; ?> - Blog Approved </title>
<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<div class="popup-form">
	<?php 
	//display message
	$uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
	
	//close button
	echo $utility->showCloseButton();
	?>
	<?php 
                
    //creating new user form
    if(isset($_GET['action']))
    {
        if($_GET['action'] == 'BlogAppr')
        {
            
            $blogDtl  = $blogMst->showBlog($id);
    ?>

      <h3>Blog Approved</h3>

      <form action="<?php $_SERVER['PHP_SELF']?>?id=<?php echo $id; ?>" method="post">

            Are you sure	that	you	want	to Approved this blog <br /><br />
           	<strong><?php echo $blogDtl[0];?></strong>
            <p class=" orangeLetter">
            Note: If all detail about this site are wrong then don't approved please cancel it.
            </p>
            
            <input name="btnApproved" type="submit" class=" button-add" id="btnApproved" value="Approved" />
            <input name="btnCancel" type="button" class="button-cancel" id="btnCancel" onClick="self.close()" value="cancel" />


      </form>

    <?php 
        }//END OF  IF
    }//END OF  IF
    ?>
