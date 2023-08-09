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



if(isset($_POST['btnEditFile']))
{
	
	$txtTitle			= $_POST['txtTitle'];
	$intSort			= $_POST['intSort'];
	
	//added image position on June15, 2011
	if(isset($_POST['radioPagePosition']))
	{
		$radioPagePosition	= 	$_POST['radioPagePosition'];
	}
	else
	{
		$radioPagePosition	= 	'top';
	}
	
	
	//added Display banner on Jan 5th, 2012
	if(isset($_POST['radioStatus']))
	{
		$radioStatus	= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus	= 	'a';
	}
	
	
    //added Display slide show on Jan 5th, 2012
	if(isset($_POST['radioLinkAlignment']))
	{
		$radioLinkAlignment	= 	$_POST['radioLinkAlignment'];
	}
	else
	{
		$radioLinkAlignment	= 	'left';
	}

	
	//defining error variables
	$action		= 'static_edit_file';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'staticEditFile';
	$typeM		= 'ERROR';
	
	
	//check for the error
	//$urlRes		= $error->checkHttpInURL($txtVideo);
	//$curlRes	= $uCurl->validateURL($txtVideo);
	$downloadDtl	= $stat->getContentDownloadData($id);
	$msg = '';
		
	if($txtTitle == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON002, $typeM, $anchor);
	}
	else
	{
		//update static
		$stat->updateDownloadContent($id, $downloadDtl[0], $txtTitle, $radioPagePosition, $radioLinkAlignment, $radioStatus, $intSort);
	
		
		
		//uploading file
		if($_FILES['txtUploadFile']['name'] != '')
		{
			//delete the file first
			$utility->deleteFile($id, 'static_download_id' ,'../images/static/download/', 'download_file', 'static_download');
			
			//generate new name
			$newName = $utility->getNewName4($_FILES['txtUploadFile'], '',$id);
			
			//upload and save file
			$utility->fileUpload2($_FILES['txtUploadFile'], '', $newName, '../images/static/download/', 
								$id,'download_file', 'static_download_id', 'static_download');		
		}
		
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTCON002, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?> - Static Content Edit</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript">
function ajaxFileUpload(upload_field)
{
// Checking file type
var re_text = /\.plain|\.msword|\.doc|\.txt|\.pdf|\.postscript|\.rtf/i;
var filename = upload_field.value;
if (filename.search(re_text) == -1) {
alert("File should be either pdf or doc or docx or plain text");
upload_field.form.reset();
return false;
}
//document.getElementById('picture_preview').innerHTML = '<div style="width:80px; height:90px;"><img src="../images/icon/ajax-loader.gif" border="0" /></div>';
upload_field.form.action = 'image_eve_prev.php';
upload_field.form.target = 'upload_iframe';
upload_field.form.submit();
upload_field.form.action = '';
upload_field.form.target = '';
return true;
}
</script>

<div class="container">
        <div class="inner-container">
        	
            
            <!-- Inner  -->
            <!--<div id="admin-body">-->
            	
                <div id="admin-top">
                	<h1>Edit File</h1>
                </div>
                
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
						<?php 
                        //display message
                        $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');
                        
                        //close button
                        echo $utility->showCloseButton();
                        ?>
                        
                   		<?php 
						//CREATING NEW USER FORM
						if( (isset($_GET['action'])) && ($_GET['action'] == 'static_edit_file') )
						{
							//static detail
							//$staticFileDtl 	= $stat->getContentDownloadData($statDownId);
								
						?>
                   
                   
                   
                        <h2><a name="addFile">Edit File</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?action=static_edit_file&id=".$id;?>"
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
                            <input name="radioPagePosition" class="radio" type="radio" value="top" title="Page Position Left"
							<?php /*?><?php echo $utility->checkSessStr('radioPagePosition','top', '');?> <?php */?>
                            <?php echo $utility->checkString($downloadDtl[2],'top');?>
                            />
                            <label class="radio">Top</label>
                            
                            <input name="radioPagePosition" class="radio" type="radio" value="bottom" title="Page Position Centre"
							<?php /*?><?php echo $utility->checkSessStr('radioPagePosition','bottom', '');?><?php */?>
                             <?php echo $utility->checkString($downloadDtl[2],'bottom');?>
                             />
                            <label class="radio">Bottom</label>
                            
                            <input name="radioPagePosition" class="radio" type="radio" value="both" title="Page Position Right"
							<?php /*?><?php echo $utility->checkSessStr('radioPagePosition','both', '');
							?><?php */?>
                           	<?php echo $utility->checkString($downloadDtl[2],'both');?>
                             />
                            <label class="radio">Both</label>
                             
                            <div class="cl"></div>
                            
                            <label>Status<span class="orangeLetter">*</span></label>
                            <input name="radioStatus" class="radio" type="radio" value="a" title="Status Active"
				            <?php /*?><?php echo $utility->checkSessStr('radioStatus','a', '');?><?php */?>
                            <?php echo $utility->checkString($downloadDtl[4],'a');?>
                             />
                            <label class="radio">Active</label>
                            
                            <input name="radioStatus" class="radio" type="radio" value="d" title="Status Deactive"
							<?php /*?><?php echo $utility->checkSessStr('radioStatus','d', '');?> <?php */?>
                            <?php echo $utility->checkString($downloadDtl[4],'d');?>
                            />
                            <label class="radio">Deactive</label>
                            
                            <div class="cl"></div>
                            
                            <label>Link Alignement<span class="orangeLetter">*</span></label>
                            <input name="radioLinkAlignment" class="radio" type="radio" value="left" title="Left"
            			   <?php /*?> <?php echo $utility->checkSessStr('radioLinkAlignment','left', '');?><?php */?>
                             <?php echo $utility->checkString($downloadDtl[3],'left');?>
                             />
                            <label class="radio">Left</label>
                            
                            <input name="radioLinkAlignment" class="radio" type="radio" value="right" title="Right"
               				<?php /*?><?php echo $utility->checkSessStr('radioLinkAlignment','right', '');?> <?php */?>
                             <?php echo $utility->checkString($downloadDtl[3],'right');?>
                            />
                            <label class="radio">Right</label>
                            
                            <input name="radioLinkAlignment" class="radio" type="radio" value="center" title="Center"
                			<?php /*?><?php echo $utility->checkSessStr('radioLinkAlignment','center', '');?> <?php */?>
                            <?php echo $utility->checkString($downloadDtl[3],'center');?>
                            />
                            <label class="radio">Center</label>
                             
                            <div class="cl"></div>
                           
                           
                            <div id="parent_div">
                            	<!--<div id="parent_div_new">-->
                                	<label>File</label>
                               	 	<input name="txtUploadFile" type="file" class="text_box_large" 
                                	id="txtUploadFile" onchange="return ajaxFileUpload(this);">	
                                    
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
                            <input name="btnEditFile" type="submit" class="button-add" value="edit" />
							<input name="btnCancel" type="submit" class="button-cancel" value="cancel" onClick="self.close()" />
                            
						</form>
                        
                    <?php 
					}//eof
					?>
                    
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
                
            <!--</div>-->
            <!-- eof Inner  -->
             
            <div class="cl"></div>
        </div>  
    </div>