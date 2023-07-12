<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");

require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/customer.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/email.inc.php");
require_once("../includes/billing.inc.php");
require_once("../includes/registration.inc.php");


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/customer.class.php");


require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$customer		= new Customer();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uNum			= new NumUtility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();


###############################################################################################

//declare vars
$typeM				= $utility->returnGetVar('typeM','');
$cus_id		    	= $utility->returnGetVar('cus_id','');

//$numOrder			= $uNum->genSortOrderNum('N', 0, 'customer_id', 1, 'customer');

//$customerIds 		= $customer->getAllCustomerId();



//add new content
if(isset($_POST['btnAddCustomerType'])) 
{
	$txtBilProfId			= $_POST['txtBilProfId'];
	$txtBillingName			= $_POST['txtBillingName'];
	$txtBillingEmail		= $_POST['txtBillingEmail'];
	$txtBillingAddress		= $_POST['txtBillingAddress'];
	$txtBillingCity			= $_POST['txtBillingCity'];
	$txtState				= $_POST['txtState'];
	$selCountryId			= $_POST['selCountryId'];
	$txtBillingPostalCode	= $_POST['txtBillingPostalCode'];
	$txtBillingPhone		= $_POST['txtBillingPhone'];
	$txtBillingFax			= $_POST['txtBillingFax'];
	$txtMobile				= $_POST['txtMobile'];
		
	//Account verified 
	if(isset($_POST['radioDftBilProf']))
	{
		$radioDftBilProf	= 	$_POST['radioDftBilProf'];
	}
	else
	{
		$radioDftBilProf	= 	'Y';
	}
	
	//registering the post session variables
	$sess_arr	= array('txtBilProfId','radioDftBilProf', 'txtBillingName','txtBillingEmail', 'txtBillingAddress','txtBillingCity', 
						'txtState', 'txtBillingPostalCode',  'radioDftBilProf', 'txtBillingPhone', 'txtBillingFax', 'selCountryId',
						'txtMobile');
												
	
	$utility->addPostSessArr($sess_arr);

	
	//defining error variables
	$action		= 'add_bill';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cus_id;
	$id_var		= 'cus_id';
	$anchor		= 'addBill';
	$typeM		= 'ERROR';
	
	//error check
	$duplicateId	= $error->duplicateUser($txtBillingEmail, 'billing_email', 'customer_billing');
	//$dupMemId		= $error->duplicateUser($txtMemberId, 'member_id', 'customer');
	$invalidEmail 	= $error->invalidEmail($txtBillingEmail);
	
	//echo $radioDesg ;
	//CHECK FIELD VALIDATION 	txtUserName
	
	if($_POST['txtUserName'] == '') 
	{ 	
		$error->showErrorTA($action, $id, $id_var, $url, ERREG000, $typeM, $anchor);
	}
	elseif($txtBilProfId == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL104, $typeM, $anchor);
	}
	elseif(!isset($_POST['radioDftBilProf'])  )
	{ 	
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL101, $typeM, $anchor);
	}
	/*else if ( ($radioDesg != 'retailer') || ($radioDesg != 'grower') )
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERU129, $typeM, $anchor);
		echo "here1";exit;
	}*/
	elseif($txtBillingName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL106, $typeM, $anchor);
	}
	elseif( ($txtBillingEmail == '') && (ereg("^ER",$invalidEmail)) )				//(preg_match("/^ER/",$invalidEmail))
	
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL102, $typeM, $anchor);
	}
	elseif($txtBillingAddress == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL107, $typeM, $anchor);
	}
	elseif($txtBillingCity == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL108, $typeM, $anchor);
	}
	elseif($txtState == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL109, $typeM, $anchor);
	}
	elseif($txtBillingPostalCode == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL110, $typeM, $anchor);
	}
	elseif($txtBillingPhone == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERUBIL111, $typeM, $anchor);
	}
	elseif($selCountryId == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERREG012, $typeM, $anchor);
	}
	else
	{
		//get verification no
		//$verificationNo	= $customer->genCusVerificationNum($radioAcc);
		
		//add Customer Bill
		$billId		= $customer->addCustomerBilling( $cus_id, $txtBilProfId, $radioDftBilProf, $txtBillingName, $txtBillingEmail,
													$txtBillingAddress, $txtBillingCity, $txtState, $selCountryId, $txtBillingPostalCode,
													$txtBillingPhone, $txtMobile, $txtBillingFax);
		
			
		$utility->delSessArr($sess_arr);
		
		
		//forward
		//$uMesg->showSuccessT('success', 0, '', 'customer_billing.php', SUCUSTBIL201, 'SUCCESS');
		$uMesg->showSuccessT('success', $cus_id, 'cus_id', $_SERVER['PHP_SELF'], SUCUSTBIL201, 'SUCCESS');

	}
	
}//eof


//cancel button
if(isset($_POST['btnCancel']))
{
	//registering session
	$sess_arr	= array('txtBilProfId', 'radioDftBilProf', 'txtBillingName','txtBillingEmail', 'txtBillingAddress','txtBillingCity', 
						'txtBillProvince', 'txtBillingPostalCode',  'radioDftBilProf', 'txtBillingPhone', 'txtBillingFax');
	//$mealplan->regSubInSess($selNum);
	
	//deleting the sessions
	//$mealplan->delSubInSess($selNum);
	$utility->delSessArr($sess_arr);
	
	//refresh header
	header("Location: ".$_SERVER['PHP_SELF']."?cus_id=".$_GET['cus_id']);
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Add Customer</title>

<!-- Style -->
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
</script>
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/user.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<!-- eof JS Libraries -->

</head>

<body>	
<table width="98%"  border="0" cellspacing="0" cellpadding="0" style="
 " class="tblBrd">
		<?php 
        //display message
        $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
        
        //close button
        echo $utility->showCloseButton();
        ?>
		<?php 
        
            if( (isset($_GET['action'])) && ($_GET['action'] == 'add_bill') )
            {
                $cusDetail = $customer->getCustomerData($cus_id);
				//$cusDetail = $customer->getCustomerBillingData($cus_id);
				
        ?>
			
  <tr>
    <td><table width="100%"  border="0" cellspacing="0" cellpadding="0">
       <tr>
        <td align="center" valign="top">
		  <table width="100%"  border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td height="25" align='left' bgcolor="#EEEEEE"><h3>Customer Billing </h3></td>
            </tr>
           
			<!-- adding new job seeker -->
			
			
            <tr>
              <td>
			  <table width="800"  border="0" cellpadding="0" cellspacing="0" title="add client">
              <?php /*?><tr>
                  <td>
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                  </td>
              </tr><?php */?>
              <tr>
                   <td align="left">
                    <div class="padT10 padB10 grey">
                        <span class="orangeLetter">Note:</span>
                        All the <span class="orangeLetter">*</span>
                        marked fields are required
                    </div>
                    
                    <div title="regsitration">
                    <form action="<?php $_SERVER['PHP_SELF'];?>?action=add_bill&amp;cus_id=<?php echo $cus_id; ?>" method="post" 
			  		enctype="multipart/form-data">
			  	<table width="100%"  border="0" cellspacing="0" cellpadding="0">                    
				  <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Customer Name<span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtUserName" type="text" class="text_box_large" id="txtUserName"
					 value="<?php echo $cusDetail[5]." ".$cusDetail[6];?>" size="30" />	
                    </td>
				 </tr>
                    
                  <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Profile Id <span class="orangeLetter"></span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
					
				      <input name="txtBilProfId" type="text" class="text_box_large" id="txtBilProfId"
					 value="<?php echo $customer->generateVerificationCodeForBillinPRof('BILLING#'); ?>" size="30" />	
                    </td>
				  </tr>
                   
                   <tr>
                        <td width="22%" height="25" align="left" class="menuText">Default Billing Profile <span class="orangeLetter">*</span></td>
                        <td width="78%" height="20" align="left" class="bodyText pad5">
                          <div class="fl marR10">
                            <input type="radio" name="radioDftBilProf" id="radioDftBilProf"  value="Y" title="Default Billing Profile Yes"
                            <?php  $utility->checkSessStr('radioDftBilProf','Y', '');?> />
                            <label for="radioDftBilProf">Y</label>
                          </div>
                          <div class="fl marL10">
                            <input type="radio" name="radioDftBilProf" id="radioDftBilProf" value="N" title="Default Billing Profile No"	
                            <?php  $utility->checkSessStr('radioDftBilProf','N', '');?> />
                            <label for="radioDftBilProf">N</label>
                          </div>
                          <div class="cl"></div>
                        </td>
                      </tr>

                   <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Name <span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingName" type="text" class="text_box_large" id="txtBillingName"
					   value="<?php echo $cusDetail[5]." ".$cusDetail[6];?>" size="30" />					
                    </td>
				   </tr>
                    
                     <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				     Billing Email<span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingEmail" type="text" class="text_box_large" id="txtBillingEmail"
					 value="<?php echo $cusDetail[3];?>" size="30" />					 </td>
				    </tr>
                     <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Address<span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingAddress" type="text" class="text_box_large" id="txtBillingAddress"
					 value="<?php echo $cusDetail[24];?>" size="30"/>	
                     </td>
				    </tr>
                     <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing City  <span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingCity" type="text" class="text_box_large" id="txtBillingCity"
					 value="<?php echo $cusDetail[27];?>" size="30"/>
                     <span id='passCnf'></span>					 </td>
				    </tr>
                    
                   <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Province <span class="orangeLetter">*</span></td>
				    	<td width="78%" height="20" align="left" class="bodyText pad5">
                            <input name="txtState" type="text" class="text_box_large" id="txtState"
                            value="<?php echo $cusDetail[28];?>" size="30"/>
                         
                       </td>
				    </tr>
                    
                   <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Postal Code <span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingPostalCode" type="text" class="text_box_large" id="txtBillingPostalCode"
					 value="<?php echo $cusDetail[29];?>" size="30" />					 </td>
				   </tr>
                   
                   <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Country <span class="orangeLetter">*</span></td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <select name="selCountryId" class=" textBoxA" id="selCountryId">
                      <option value="">-- Select --</option>
						<?php
                        
                            $utility->populateDropDown($cusDetail[30], 'countries_id',
                                                       'countries_name', 'countries');
                        
                        ?>
                      </select>
                      
                    </td>
				   </tr>
                    
                                     
                     <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Phone<span class="orangeLetter">*</span>					</td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingPhone" type="text" class="text_box_large" id="txtBillingPhone"
					 value="<?php echo $cusDetail[31];?>" size="30" />					 </td>
				    </tr>
                     <tr>
				    <td width="22%" height="25" align="left" class="menuText">
				      Billing Fax<span class="orangeLetter"></span>					</td>
				    <td width="78%" height="20" align="left" class="bodyText pad5">
				      <input name="txtBillingFax" type="text" class="text_box_large" id="txtBillingFax"
                     value="<?php echo $cusDetail[33];?>" maxlength="3" size="30" />					 </td>
				    </tr>
                    
                    <tr>
                       <td width="22%" height="25" align="left" class="menuText">
                        Billing Mobile</td>
                       <td width="78%" height="20" align="left" class="bodyText pad5">
                        <input name="txtMobile" type="text" class="text_box_large" id="txtMobile"
					 value="<?php echo $cusDetail[34];?>" size="30" />					 </td>
                     </tr>
                     <tr>
                       <td align="left" class="menuText">&nbsp;</td>
                       <td height="20" align="left" class="bodyText">&nbsp;</td>
                     </tr>
                     <tr>
				    <td class="menuText">&nbsp;</td>
				    <td height="25" align="left">
					<input name="btnAddCustomerType" id="btnAddCustomerType" type="submit" class="buttonYellow" value="add" />
					<input name="btnCancel" type="submit" class="buttonYellow" value="cancel" onClick="self.close()">	</td>
				    </tr>
                     <tr>
                       <td height="20" colspan="2" align="left" class="menuText"><h3>&nbsp;</h3> </td>
                       </tr>
                      
 				</table>

			  </form>
                    <!-- END OF REGISTRATION FORM -->
                    </div>
                    </td>
                  </tr>
          <tr>
            <td>&nbsp;</td>
          </tr>
        </table>			  </td>
            </tr>
			<?php 
			}
			?>
			<!-- eof adding job seeker -->
          </table>		</td>
      </tr>
    </table></td>
  </tr>
  <tr>
   <?php /*?> <td><?php require_once('footer.inc.php'); ?></td><?php */?>
  </tr>
</table>
</body>
</html>