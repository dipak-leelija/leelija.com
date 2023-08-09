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

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();

/////////////////////////////////////////////////////////////////////////////////////////////////

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');
$statBannerDtl	= $stat->getStaticBannerDataById($id);

?>
<!-- Form -->
<div class="webform-area">
    <!-- show message -->
   
   		<div id="banner-error"></div>
        <h2><a name="addFile">Edit File</a></h2>
        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
        <form id="editbanner-form" action="" method="post"  enctype="multipart/form-data">
                        	
            <label>Banner Heading <span class="required">*</span></label>
            <input name="txtName" type="text" class="" id="txtName"
            value="<?php echo $statBannerDtl[0]; ?>" size="50" />
            <div class="cl"></div>
            
            <label>Short Description</label>
            <textarea name="txtDesc" cols="10" rows="8" wrap="physical" class="textAr" 
            id="txtDesc"><?php echo $statBannerDtl[1]; ?></textarea>
            <div class="cl"></div>
            
            <label>Status<span class="orangeLetter">*</span></label>
            <input name="radioStatus" class="radio" type="radio" value="a" title="Status Active"
            <?php /*?><?php echo $utility->checkSessStr('radioStatus','a', '');?><?php */?>
            <?php echo $utility->checkString($statBannerDtl[3],'a');?>
             />
            <label class="radio">Active</label>
            
            <input name="radioStatus" class="radio" type="radio" value="d" title="Status Deactive"
            <?php /*?><?php echo $utility->checkSessStr('radioStatus','d', '');?> <?php */?>
            <?php echo $utility->checkString($statBannerDtl[3],'d');?>
            />
            <label class="radio">Deactive</label>
            
            <div class="cl"></div>
            <div class="fr">
            <?php 
                echo $utility->imageDisplay2('../images/static/banner/', $statBannerDtl[2], 100, 100, 0,
                                               'greyBorder', $statBannerDtl[0]); 
            ?>
            </div>
            <label>Upload Banner</label>
            <input name="txtUploadBanner" type="file" class="text_box_large" 
            id="txtUploadBanner">
            <div class="fl">	
            <?php 
            if( ($statBannerDtl[2] != '' ) && (file_exists("../images/static/banner/".$statBannerDtl[2])) )
            {
                echo "<input name=\"delImg\" type=\"checkbox\" style=\"width:30px\" value=\"1\"> 
                <span class='blackLarge'>Delete this image</span>"; 
            }
            ?>
            </div>
            <div class="cl"></div>
            
           
            <input name="txtStatId" type="hidden" class="" id="txtStatId"
            value="<?php $id ;?>" size="50" />
            <div class="cl"></div>
            
            <input name="txtBanId" type="hidden" class="" id="txtBanId"
            value="<?php $ban_id ;?>" size="50" />
            <div class="cl"></div>
            
            <label>&nbsp;</label>
            <label>&nbsp;</label>

            <div class="cl"></div>
 
            <?php /*?> <div><?php echo $stat->showDelStaticBannerDtl($id, '../images/static/banner/');?> </div>	<?php */?>


            <label>&nbsp;</label>
            <label>&nbsp;</label>
            <div class="cl"></div>
            <input type="hidden" name="banner_id" value="<?php echo $id ?>" >
           
            <input name="btnEditBanner" type="submit" class="button-add" value="edit" id="btnEditBanner" />
            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" onclick="parent.$.colorbox.close(); return false;" />
            
        </form>

    
</div>
<div class="cl"></div>
<!-- eof Form -->