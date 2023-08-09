<?php 
ob_start();
session_start();
//include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once ("../_config/dbconnect.php");
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/services.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$services		= new Services();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

//$sid				= $utility->returnGetVar('sid',0);
//echo $sid;
//$sampleDetails         = $sample->getAllcolourDtl($sid);

if( (isset($_GET['selNum'])) && ($_GET['selNum'] > 0)  && ($_GET['selNum'] < 16))
{
	$selNum		= $_GET['selNum'];
	
	for($i=1; $i <= $selNum; $i++)
	{
	?>  
    	<h3>Featured-<?php echo $i; ?></h3>
        <div class="cl"></div>
		<label>Featured Name</label>
        <input name="txtFeaturedName[]" id="txtFeaturedName" type="text" class="text-field" />
        <div class="cl"></div>
		
		<label>Featured Description<span class="orangeLetter">*</span></label>
        <textarea  name="txtFeaturedDesc[]" class="textAr" id="txtFeaturedDesc" rows="5" cols="70">
        </textarea>
	   <div class="cl"></div>
	   <label>Upload Image <span class="required">*</span></label>
        <input name="fileImg[]" type="file" class="text_box_large" 
        id="fileImg" onchange="return ajaxFileUpload(this);">	
        <div class="cl"></div>
	  

<?php
                
	}

}
else
{
	// echo NRSPAN.$uMesg->dispMesgImg('ERROR', 'images/icon/', 'error.gif').ERSTCON003.ENDSPAN;
}
?>