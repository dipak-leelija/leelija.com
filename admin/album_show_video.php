<?php 

?>
<?php 
session_start();
include_once('checkSession.php');
require_once("../connection/connection.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/image.inc.php"); 

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/search.class.php");
include_once('../classes/image.class.php');
require_once("../classes/customer.class.php");


require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/pagination.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$search_obj		= new Search();
$album			= new Album();
$photo  		= new Photo();
$customer	    = new Customer();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$page			= new Pagination();

#########################################################################################

//declare type 
$typeM		= $utility->returnGetVar('typeM','');
$image_id	= $utility->returnGetVar('image_id',0);

$numEntry 	= $utility->getNoOfEntry($image_id, 'im_id', 'album_image');

$imgDtl		= $photo->showImage($image_id);
$vName		= $imgDtl[15];
$vTitle		= $imgDtl[1];


?>
<title><?php echo COMPANY_S; ?> - View Video</title>
<link rel="stylesheet" href="../style/style.css" type="text/css" />


	<div align="center">
    	<div class=" invoiceFont mar10 padB10 bdrB"><?php echo $vTitle; ?></div>
		<!--Video Column -->
		<div class="screen">
			<div class="scrInner">
				<div class="mScr">
				<!-- START gddflvplayer code -->
				<div id="gddflvplayer"></div>
				<script type="text/javascript" src="swfobject.js"></script>
				<script type="text/javascript">
				// <![CDATA[
				var so = new SWFObject("gddflvplay-v34.swf", "KTMKard", "407", "315", "9", "#000000"); //change the player size as you want (now:500x360) 
					so.addParam("scale", "noscale");
					so.addParam("quality", "best");
					so.addParam("allowScriptAccess", "always");
					so.addParam("allowFullScreen", 'true');
					//VIDEO PARAMS
					so.addVariable("vdo", escape('../images/gallery/video/<?php echo $vName; ?>')); //video file
					so.addVariable("desc", escape('<?php echo $vTitle ?>')); //  movie title
					so.addVariable("autoplay", 'true'); // autoplay: true or false  | default: false
					so.addVariable("sound", '50'); // sound volume 0-100	
					// ADVERTISING/INTRO VIDEO, (controls temporarily disabled) REMOVE NEXT 2 LINES IF NONE
					//so.addVariable("advert", escape('extreme.flv')); //video file
					//so.addVariable("advertdesc", escape(' Ad  Commercial  Fast  and  Smart  Riding  ')); // description text
					
					// YOUR CUSTOM LOGO, remove the next line if none
					so.addVariable("mylogo", escape('../images/site/logo.png')); // PNG, JPG, GIF,SWF, we recommend PNG for transparency
					//TRACKER LINK URL (goes active on play)
					so.addVariable("tracker", escape('your_tracker_link.php')); // TRACKER LINK | vars sent by POST
				
					// START 
				  so.write("gddflvplayer");
					// ]]>
					
				</script> 
				<!-- END gddflvplayer code -->
				</div>
			</div>
		</div>
        
        <!-- Close -->
        <div class="invoiceFont mar20 padT10 bdrT">
		<input name="btnCancel" type="button" class="button-cancel" id="btnCancel"
			onClick="self.close()" value="close" />
        </div>
        

	</div>	
		
		
	
	