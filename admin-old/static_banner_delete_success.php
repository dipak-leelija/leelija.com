<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/front_photo.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();
$frPhoto		= new FrontPhoto();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uNum 			= new NumUtility();

##############################################################################################################

//declare variables
$typeM				= $utility->returnGetVar('typeM','');
$msg 				= '';

//get banner id 
$ban_id				= $utility->returnGetVar('ban_id','');
//echo $id	;exit;
$msg 				= '';


if(!isset($_SESSION['ban_id']))
{
	$_SESSION['ban_id'] = $ban_id ;
}
else
{
	$ban_id	= $_SESSION['ban_id'];
}

if(isset($_SESSION['ban_id']))
		{
			$_SESSION['ban_id'] = '';
			unset($_SESSION['ban_id']);
		}

?>


<link rel="stylesheet" type="text/css" href="style/ansysoft.css"/>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/order.js"></script>
<script type="text/javascript" src="js/utils.js"></script>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/user.js"></script>
<script type="text/javascript" src="js/utility.js"></script>

<script type="text/javascript" src="js/jQuery/jquery.js"></script> 

<script type="text/javascript" src="js/jQuery/jquery-1.7.1.min.js"></script>

<script type="text/javascript" src="js/jQuery/jquery.colorbox.js"></script>
<script type="text/javascript" src="js/jQuery/jquery.colorbox-min.js"></script>

<title>Banner Delete Successful</title>

<div>

	 
         
      <!-- Form -->
     <form name ="statBannerDeleteForm" id ="statBannerDeleteForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" 
     enctype="multipart/form-data" autocomplete="off">
     
     	<div id="heading-box">
     		<h2>Banner Delete Successful</h2>
     	</div>
        
        <div class="success-block">
            <p>
            	Your banner has been successfully deleted.
            </p>
            
         </div>         
         <div>
           <label>&nbsp;</label>
           <input name="btnCancel" type="submit" class="button-add" value="close" onclick="parent.$.colorbox.close(); return false;"/>
           <div class="cl"></div>	
       	</div>  

    </form>
</div>