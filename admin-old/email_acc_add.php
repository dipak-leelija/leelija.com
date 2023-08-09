<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/subscriber.inc.php");

 
require_once("../classes/adminLogin.class.php"); 
include_once("../classes/countries.class.php"); 
include_once("../classes/subscriber.class.php"); 
include_once("../classes/customer.class.php"); 

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$country		= new Countries();
$subscribe		= new EmailSubscriber();
$customer		= new Customer();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$cus_id		= $utility->returnGetVar('id','');

//add user
if(isset($_POST['btnRegister']))
{
	//GET THE POST DATA
	$txtEmail		= 	$_POST['txtEmail'];
	$txtFname		= 	$_POST['txtFname'];
	$txtSurname		= 	$_POST['txtSurname'];
	$selCat			= 	(int)$_POST['selCat'];
	$txtPhone		= 	$_POST['txtPhone'];
	$txtCompany		= 	$_POST['txtCompany'];
	
	
	//REGISTERING THE SESSION VARIABLE
	$sess_arr		= array('txtEmail','txtFname','txtSurname','selCat','txtCompany','txtPhone');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_customer';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addCus';
	$typeM		= 'ERROR';
	
	//check for error
	$duplicateId	= $error->duplicateUser($txtEmail, 'email', 'email_subscriber');
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	
	//field validation
	if(ereg('^ER',$invalidEmail))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER002, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicateId))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER001, $typeM, $anchor);
	}
	elseif($txtFname == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER003, $typeM, $anchor);
	}
	elseif($txtSurname == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER004, $typeM, $anchor);
	}
	else
	{
		//get customer id
		$customerId	= $utility->getValueByKey( $txtEmail, 'email', 'customer_id', 'customer');
		
		if($customerId == '')
		{
			//get verification no  
			$verificationNo		= $customer->generateVerificationCode('VER');
			
			$userPass			= $utility->genRandomPassword('12');
		
			
			$customer_id 		= $customer->addCustomer( 1, 0,  '',  $txtEmail,  $userPass,  $txtFname, $txtSurname,  'na', 'a',
															 '',   '',  $txtCompany, 'N', '', '', $verificationNo,  'Y', 0);
								
			//add the address
			$customer->addCusAddress( $customer_id, 'Add 1',  '',  '', 'Town',  'Province', 'Postal Code', '0',
								 	  $txtPhone, '', 'Fax', 'Mobile' );
									  
									  
			//add subscriber
			$id = $subscribe->addSubscriber($customer_id, $txtEmail, $txtFname, $txtSurname, $selCat, $txtCompany, $txtPhone);
		}
		else
		{
			//add subscriber
			$id = $subscribe->addSubscriber($customerId, $txtEmail, $txtFname, $txtSurname, $selCat, $txtCompany, $txtPhone);
		}
		
		//delete session
		$utility->addPostSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', 0, '', 'email.php', SUSUBSC001, 'SUCCESS');
		
	}//end of else

}//END OF REGISTRATION



/* 	ACTION ON PRESSING BUTTON CANCEL */
if(isset($_POST['btnCancel']))
{	
	$sess_arr	= array('txtEmail','txtFname','txtSurname','selCat','txtCompany','txtPhone');
	$utility->addPostSessArr($sess_arr);
	
	header("Location: "."email.php");
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Add Email Account</title>

<!-- Style -->
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<!-- eof JS Libraries -->


</head>

<body>

 <!-- Header -->
	<?php require_once('header.inc.php'); ?>
    
    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	<div id="admin-menu">
				<?php require_once('menu.inc.php'); ?>
            </div>
            
            <!-- Inner  -->
            <div id="admin-body">
            	
                <div id="admin-top">
                	<h1>Add New Email Member</h1>
                </div>
                
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                  
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="formRegister" id="formRegister">
                    
                            <label>Email <span class="orangeLetter">*</span></label>
                            <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" size="25" title="email"
                            value="<?php $utility->printSess2('txtEmail', ''); ?>" /> 			
                            <div class="cl"></div>
                            
                            
                            <label>First Name <span class="orangeLetter">*</span></label>
                            <input name="txtFname" type="text" class="text_box_large" 
                            id="txtFname" size="25" title="First Name"
                            value="<?php $utility->printSess2('txtFname', ''); ?>" />
                            <div class="cl"></div>
                            
                            <label>Last Name <span class="orangeLetter">*</span></label>
                            <input name="txtSurname" type="text" class="text_box_large"
                            id="txtSurname" size="25" title="Last Name"
                            value="<?php $utility->printSess2('txtSurname', '');?>" />					
                            <div class="cl"></div>
                            
                            
                            <label>Group </label>
                            <select name="selCat" class=" textBoxA" id="selCat">
                                    <?php
                                    if(isset($_SESSION['selCat']))
                                    { 
                                        $utility->populateDropDown($_SESSION['selCat'], 'cat_id', 'title', 'email_categories');								
                                    }
                                    else
                                    {
                                        $utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');
                                    }
                                    ?>
                             </select>
                             <div class="cl"></div>
                           
                            
                            <label>Company Name </label>
                            <input name="txtCompany" type="text" class="text_box_large"
                            id="txtCompany" size="25" title="Company Name"
                            value="<?php $utility->printSess2('txtCompany', ''); ?>" />
                            <div class="cl"></div>
                           
                            <label>Phone Number </label>
                            <input name="txtPhone" type="text" class="text_box_large"
                            id="txtPhone" size="25" title="Phone Number"
                            value="<?php $utility->printSess2('txtPhone', ''); ?>" />					
                            <div class="cl"></div>
                            
                            
                            <input name="btnRegister" type="submit" class="button-add" id="btnRegister" value="add" />
                            <input name="btnCancel" type="submit" class="button-add" id="btnCancel" value="Cancel" /> 
                            <div class="cl"></div>
                            
						</form>
                        
                  
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
                
            </div>
            <!-- eof Inner  -->
             
            <div class="cl"></div>
        </div>  
    </div>
    <!-- eof Container -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>
     



</body>
</html>