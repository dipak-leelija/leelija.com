<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/review.inc.php");
require_once("../includes/user.inc.php");


require_once("../classes/error.class.php"); 
require_once("../classes/static.class.php");
require_once("../classes/review.class.php");


require_once("../classes/utility.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();

$static      	= new StaticContent();
$review 		= new Review();


$utility		= new Utility();
$uNum			= new NumUtility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

##############################################################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$review_id	= $utility->returnGetVar('review_id', 0);

//Get Ids
if(isset($_GET['id']))
{
	$id = $_GET['id'];
}

//add reply
if(isset($_POST['btnSubmit']))
{
	//get the vars
	$txtRepComm		= $_POST['txtRepComm'];
	$txtEmail 		= $_POST['txtEmail'];
	$txtName 		= $_POST['txtName'];
	


	
	//registering the post session variables
	$sess_arr	= array('txtEmail');				
	$utility->addPostSessArr($sess_arr);
	
	
	//defining error variables
	$action		= 'add_review';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'addReview';
	$typeM		= 'ERROR';
	
	
	
	if($txtName == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTREV104, $typeM, $anchor);
	}
	elseif($txtRepComm == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTREV102, $typeM, $anchor);
	}
	elseif($txtEmail == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTREV103, $typeM, $anchor);
	}
	else
	{
		//adding static review reply
		
	  $staRevId = $review->addReview(0, 0, 0, $txtName, '',$txtRepComm, $txtEmail, 0, 0, 0,0, 0, 'd', 'static_review');
								   
		//remove session
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUSTREV001, 'SUCCESS');
	}
	
}

?>

<title><?php echo COMPANY_S; ?> - Static Review Reply</title>

<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 

<table class="tblBrd" align="center" width="600">

	<?php 
	if(isset($_GET['msg']))
	{
		echo "<tr class='maroonError'><td align='left' height='25'>".stripslashes($_GET['msg'])."</td></tr>";
	}

	//close button
	echo $utility->showCloseButton();
	?>

	<?php 
	if(isset($_GET['action']) && ($_GET['action'] == 'reply'))
	{
		$staRevDtl = $review->getReviewData($id);
	?>

	<tr>
	  <td height="25" align='left' bgcolor="#EEEEEE"><h3>Reply  Static Review </h3></td>
	</tr>

	<tr>
	  <td>

		<table width="100%"  border="0" cellspacing="0" cellpadding="0">

		  <tr>
			<td width="115" align="left" class="menuText">Customer Name </td>
			<td width="311" height="20" align="left" class="blackLarge pad5">
			  <?php echo $staRevDtl[4]; ?>
            </td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Email</td>
			<td height="20" align="left" class="blackLarge pad5"><?php echo $staRevDtl[3]; ?></td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Added on</td>
			<td height="20" colspan="2" align="left" class="blackLarge pad5">
			<?php echo $staRevDtl[14]; ?>
			</td>
		  </tr>

		  <tr>
			<td align="left" class="menuText">Comments</td>
			<td height="20" colspan="2" align="left" class="pad5 blackLarge">
			<?php echo $staRevDtl[7]; ?>
			</td>
		  </tr>
          <tr>
           <form action="<?php echo $_SERVER['PHP_SELF']."?action=add_review&id=".$_GET['id'];?>"
	  		method="post"  enctype="multipart/form-data">
            <tr>
			<td align="left" class="menuText">Name</td>
			<td height="20" colspan="2" align="left" class="pad5 blackLarge">
				<input type="text" name="txtName" id="txtName" size="35" />
			</td>
		  </tr>
          
		  <tr>
			<td width="115" align="left" class="menuText">Reply To Comment</td>
			<td height="20" colspan="2" align="left">
                <textarea  name="txtRepComm" class="textAr" id="txtRepComm" cols="40" rows="6">
                
                </textarea>
            </td>
		  </tr>

		  <tr>
			<td colspan="3" align="left" class="menuText">&nbsp;</td>
            <td colspan="3" align="left" class="menuText">&nbsp;</td>
		  </tr>

		<tr>
			<td width="115" align="left" class="menuText">Email Address</td>
			<td height="20" colspan="2" align="left">
               <input type="text" name="txtEmail" id="txtEmail" size="35" />
            </td>
		  </tr>
        
		  <tr>
			  <td colspan="3" align="left" class="orangeLetter"></td>
		  </tr>

		 <tr>
			  <td colspan="2" align="left" class="menuText"></td>
		 </tr>

		<tr>
			  <td align="left" class="menuText">&nbsp;</td>
			  <td align="left">&nbsp;</td>
		</tr>

		<tr>
			<td width="115" class="menuText">&nbsp;</td>
            
            
			<td height="25" align="left">
             <input name="btnSubmit" type="submit" class="button-add" id="btnSubmit"  value="Submit">
			
            
			<input name="btnCancel" type="button" class="button-cancel" id="btnCancel" 
			onClick="self.close()" value="close">
			</td>
		</tr>
		</form>
        </tr>
	    <tr>
			<td width="115">&nbsp;</td>
			<td>&nbsp;</td>
	    </tr>
		</table>

	  </td>
	</tr>

	<?php 
	}//eof
	?>
</table>