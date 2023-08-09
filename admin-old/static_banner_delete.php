<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 



/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

########################################################################################################


//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');
?>
<div id="file-del-sucess"></div>
<div id="delete-banner-form">
<form id="deletebanner-form" action=""  method="post"  enctype="multipart/form-data">
	<p>
    	Are you sure you want to delete the banner?
    </p>
    <div class="cl"></div>
    <input type="button" class="button-add" value="delete" onclick="deleteBanner2('<?php echo $id ?>')"  />
    <input type="button" class="button-cancel" value="cancel" />
    <div class="cl"></div>
</form>
</div>