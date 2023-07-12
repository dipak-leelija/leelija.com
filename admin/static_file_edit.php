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

$downloadDtl	= $stat->getContentDownloadData($id);

?>

<script type="text/javascript" src="../js/ajax.js"></script>
<!-- Form -->
<div class="webform-area">
    <!-- show message -->
   
   		<div id="file-error"></div>
        <h2><a name="addFile">Edit File</a></h2>
        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
        <form id="editfile-form" <?php /*?>onsubmit="event.preventDefault(), editStaticFile('<?php echo $id ?>');"<?php */?> action=""
         method="post"  enctype="multipart/form-data">
            
            <label>Title <span class="required">*</span></label>
            <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
            value="<?php echo $downloadDtl[1]; ?>" size="50" />
            <div class="cl"></div>
            
            <label>Sort Order <span class="required">*</span></label>
            <input name="intSort" type="text" class="text_box_large" id="intSort"
             value="<?php echo $downloadDtl[5]; ?>" size="5" maxlength="3" 
             onKeyPress="return intOnly(this, event)" />(integer from 1 to 999)
             <div class="cl"></div>
                
            <label>Page Position<span class="orangeLetter">*</span></label>
            
            <input name="radioPagePosition" class="radio" id="pos-top" type="radio" value="top" title="Page Position Left"
            <?php /*?><?php echo $utility->checkSessStr('radioPagePosition','top', '');?> <?php */?>
            <?php echo $utility->checkString($downloadDtl[2],'top');?>
            />
            <label class="radio">Top</label>
            
            <input name="radioPagePosition" class="radio" id="pos-bottom" type="radio" value="bottom" title="Page Position Centre"
            <?php /*?><?php echo $utility->checkSessStr('radioPagePosition','bottom', '');?><?php */?>
             <?php echo $utility->checkString($downloadDtl[2],'bottom');?>
             />
            <label class="radio">Bottom</label>
            
            <input name="radioPagePosition" class="radio" id="pos-both" type="radio" value="both" title="Page Position Right"
            <?php /*?><?php echo $utility->checkSessStr('radioPagePosition','both', '');
            ?><?php */?>
            <?php echo $utility->checkString($downloadDtl[2],'both');?>
             />
            <label class="radio">Both</label>
            
             
            <div class="cl"></div>
            
            <label>Status<span class="orangeLetter">*</span></label>
            <input name="radioStatus"  id="status-a" class="radio" type="radio" value="a" title="Status Active"
            <?php /*?><?php echo $utility->checkSessStr('radioStatus','a', '');?><?php */?>
            <?php echo $utility->checkString($downloadDtl[4],'a');?>
             />
            <label class="radio">Active</label>
            
            <input name="radioStatus" class="radio" id="status-d" type="radio" value="d" title="Status Deactive"
            <?php /*?><?php echo $utility->checkSessStr('radioStatus','d', '');?> <?php */?>
            <?php echo $utility->checkString($downloadDtl[4],'d');?>
            />
            <label class="radio">Deactive</label>
            
            <div class="cl"></div>
            
            <label>Link Alignement<span class="orangeLetter">*</span></label>
            <input name="radioLinkAlignment" id="link-left" class="radio" type="radio" value="left" title="Left"
           <?php /*?> <?php echo $utility->checkSessStr('radioLinkAlignment','left', '');?><?php */?>
             <?php echo $utility->checkString($downloadDtl[3],'left');?>
             />
            <label class="radio">Left</label>
            
            <input name="radioLinkAlignment" id="link-right" class="radio" type="radio" value="right" title="Right"
            <?php /*?><?php echo $utility->checkSessStr('radioLinkAlignment','right', '');?> <?php */?>
             <?php echo $utility->checkString($downloadDtl[3],'right');?>
            />
            <label class="radio">Right</label>
            
            <input name="radioLinkAlignment" id="link-center" class="radio" type="radio" value="center" title="Center"
            <?php /*?><?php echo $utility->checkSessStr('radioLinkAlignment','center', '');?> <?php */?>
            <?php echo $utility->checkString($downloadDtl[3],'center');?>
            />
            <label class="radio">Center</label>
             
            <div class="cl"></div>
            <input name="downId" type="hidden" value="<?php echo $id ?>" />
           
           
            <div id="parent_div">
                <!--<div id="parent_div_new">-->
                    <label>File</label>
                    <input name="txtUploadFile" id="txtUploadFile" type="file" class="text_box_large" onchange="return ajaxFileUpload(this);"  />
                    
                 <!--</div>-->
                <span id="picture_error"></span>
                <br />
                <br />
                <br />
                <div id="picture_preview" class="marL50"></div><!-- eof picture preview-->
             </div> <!-- eof parent div-->  
             
            <div class="cl"></div>
             
            <iframe name="upload_iframe" id="upload_iframe" style="display:none;"></iframe>
            <div class="cl"></div>
            <input name="btnEditFile" id="btnEditFile" <?php /*?>onClick="editStaticFile('<?php echo $id ?>')"<?php */?> type="submit" class="button-add" value="edit" />
            <input name="btnCancel" type="button" class="button-cancel" value="cancel" onClick="self.close()" />
            <div class="cl"></div>
            
        </form>

    
</div>
<div class="cl"></div>
<!-- eof Form -->