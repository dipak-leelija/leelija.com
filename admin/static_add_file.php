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
require_once("../classes/utilityNum.class.php");


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
$uNum 			= new NumUtility();

##############################################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$id			= $utility->returnGetVar('id','');
$msg 		= '';

//get the sort order
if(isset($_GET['id']))
{
	$numOrder	= $uNum->genSortOrderNum('Y', $_GET['id'], 'static_id', 1, 'static_download');
}
else
{
	$numOrder	= $uNum->genSortOrderNum('Y', 0, 'static_id', 1, 'static_download');
}


if(isset($_POST['btnAddFile']))
{
	//get the vars
	$txtTitle		= $_POST['txtTitle'];
	$intSort 		= $_POST['intSort'];
	
	//print_r($_FILES['txtUploadFile']);exit;
	/*txtTitle
	intSort
	radioPagePosition
	radioStatus
	radioLinkAlignment
	txtUploadFile*/
	
	//page position
	if(isset($_POST['radioPagePosition']))
	{
		$radioPagePosition		= 	$_POST['radioPagePosition'];
	}
	else
	{
		$radioPagePosition		= 	'top';
	}
	
	//status
	if(isset($_POST['radioStatus']))
	{
		$radioStatus		= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus		= 	'd';
	}
	
	//province id and city id
	if(isset($_POST['radioLinkAlignment']))
	{
		$radioLinkAlignment		= 	$_POST['radioLinkAlignment'];
	}
	else
	{
		$radioLinkAlignment		= 	'left';
	}
	
	//registering the post session variables
	$sess_arr	= array('txtTitle', 'intSort','radioPagePosition','radioStatus', 'radioLinkAlignment');				
	$utility->addPostSessArr($sess_arr);
	
	
	//defining error variables
	$action		= 'add_file';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'addFile';
	$typeM		= 'ERROR';
	
		
	if($txtTitle == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON005, $typeM, $anchor);
	}
	elseif($_FILES['txtUploadFile']['name'] == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON006, $typeM, $anchor);
	}
	else
	{
		//adding the file information
		$fileId = $stat->addDownloadContent($id, $txtTitle, $radioPagePosition, $radioLinkAlignment, $radioStatus, $intSort);
		
		//upload the file
		if($_FILES['txtUploadFile']['name'] != '')
		{
			//rename the file
			$newName	= $utility->getNewName4($_FILES['txtUploadFile'], '', $fileId);
			
			//uploading the file
			$utility->fileUpload2($_FILES['txtUploadFile'], '', $newName, '../images/static/download/', 
								  $fileId, 'download_file', 'static_download_id', 'static_download');
		}
		
		//remove session
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUSTCON101, 'SUCCESS');
	}
	
}
?>

<title><?php echo COMPANY_S; ?>- Add File</title>
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../style/parent_style.css"/>


<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<script type="text/javascript" src="../js/category.js"></script>
<script type="text/javascript" src="../js/jquery.js"></script>
<script type="text/javascript" src="../js/address.js"></script>
<script type="text/javascript" src="../js/form.js"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script language="JavaScript" type="text/javascript" src="../js/utility.js"></script> 


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

<!--<script type="text/javascript">
function deleteFile(id, cancel )
{
	var cId	= document.getElementById(id);
	cId.value	= cancel ;
	cId.innerHTML	= cancel ;
	cancel_button.form.action = 'delete_file.php';
}
</script>-->


    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	
            
            <!-- Inner  -->
            <!--<div id="admin-body">-->
            	
                <div id="admin-top">
                	<h1>Add File</h1>
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
                        if( (isset($_GET['action'])) && ($_GET['action'] == 'add_file') )
                        {
                            //static detail
                            $staticDtl 	= $stat->getStaticData($id);
                                
                        ?>
                   
                        <h2><a name="addFile">Add File</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?action=add_file&id=".$_GET['id'];?>"
	 					 method="post"  enctype="multipart/form-data">
                        	
                            <label>Title <span class="required">*</span></label>
                            <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
			 				value="<?php $utility->printSess2('txtTitle', ''); ?>" size="50" />
                            <div class="cl"></div>
                            
                            <label>Sort Order <span class="required">*</span></label>
                            <input name="intSort" type="text" class="text_box_large" id="intSort"
                             value="<?php $utility->printSess2('intSort', $numOrder); ?>" size="5" maxlength="3" 
                             onKeyPress="return intOnly(this, event)" />(integer from 1 to 999)
                             <div class="cl"></div>
                                
                            <label>Page Position<span class="orangeLetter">*</span></label>
                            <input name="radioPagePosition" class="radio" type="radio" value="top" title="Page Position Left"
							<?php echo $utility->checkSessStr('radioPagePosition','top', '');?> />
                            <label class="radio">Top</label>
                            
                            <input name="radioPagePosition" class="radio" type="radio" value="bottom" title="Page Position Centre"
							<?php echo $utility->checkSessStr('radioPagePosition','bottom', '');?> />
                            <label class="radio">Bottom</label>
                            
                            <input name="radioPagePosition" class="radio" type="radio" value="both" title="Page Position Right"
							<?php echo $utility->checkSessStr('radioPagePosition','both', '');?> />
                            <label class="radio">Both</label>
                             
                            <div class="cl"></div>
                            
                            <label>Status<span class="orangeLetter">*</span></label>
                            <input name="radioStatus" class="radio" type="radio" value="a" title="Status Active"
				            <?php echo $utility->checkSessStr('radioStatus','a', '');?> />
                            <label class="radio">Active</label>
                            
                            <input name="radioStatus" class="radio" type="radio" value="d" title="Status Deactive"
							<?php echo $utility->checkSessStr('radioStatus','d', '');?> />
                            <label class="radio">Deactive</label>
                            
                            <div class="cl"></div>
                            
                            <label>Link Alignement<span class="orangeLetter">*</span></label>
                            <input name="radioLinkAlignment" class="radio" type="radio" value="left" title="Left"
            			    <?php echo $utility->checkSessStr('radioLinkAlignment','left', '');?> />
                            <label class="radio">Left</label>
                            
                            <input name="radioLinkAlignment" class="radio" type="radio" value="right" title="Right"
               				<?php echo $utility->checkSessStr('radioLinkAlignment','right', '');?> />
                            <label class="radio">Right</label>
                            
                            <input name="radioLinkAlignment" class="radio" type="radio" value="center" title="Center"
                			<?php echo $utility->checkSessStr('radioLinkAlignment','center', '');?> />
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
                           
                            <input name="btnAddFile" type="submit" class="button-add" value="add" />
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
    <!-- eof Container -->
 