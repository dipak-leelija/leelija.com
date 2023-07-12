<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/quote.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/custom_quote.class.php"); 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();
$utility		= new Utility();
$custom_quote	= new CustomQuote();
$uMesg 			= new MesgUtility();


/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM			= $utility->returnGetVar('typeM','');
$quote_id		= $utility->returnGetVar('id','');


if(isset($_POST['btnDelete']))
{	
	
		$utility->deleteFile($quote_id, 'custom_quote_id' ,'../images/custom_quote/', 
								'image', 'custom_quote');
		$custom_quote->deleteCustomQuote($quote_id);
		header("Location:".$_SERVER['PHP_SELF']."?action=success&msg=custom quote is deleted");
	
}
?> 

<title><?php echo COMPANY_S; ?> - Custom Quote Delete</title>
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
	if( (isset($_GET['action'])) && ($_GET['action'] == 'delete_custom_quote') )
	{
		$quoteDtl = $custom_quote->getCustomQuoteData($quote_id);
	?>

        <h3>Delete CustomQuote</h3>
        
        <form action="<?php $_SERVER['PHP_SELF']?>" method="post">
            
            Are you sure that you want to delete this custom quote 
            <?php /*?>named <span class="bld"><?php echo $quoteDtl[1]; ?></span><?php */?>?

			<input name="" type="hidden" value="">
			<input name="btnDelete" type="submit" class="button-add" 
			id="btnDelete" value="delete" />
			<input name="btnCancel" type="button" class="button-cancel" 
			id="btnCancel" onClick="self.close()" value="cancel" />

	  </form>

	<?php 
	}//eof
	?>
</div>
