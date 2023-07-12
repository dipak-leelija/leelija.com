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


if(isset($_POST['btnAddImg']))
{
	//get the vars
	$txtTitle		= $_POST['txtTitle'];
	
	//defining error variables
	$action		= 'add_image';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $id;
	$id_var		= 'id';
	$anchor		= 'addImage';
	$typeM		= 'ERROR';
	
	if($txtTitle == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON005, $typeM, $anchor);
	}
	elseif($_FILES['fileImg']['name'] == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON006, $typeM, $anchor);
	}
	else
	{
		
		$imgId		= $stat->addStaticImg($id, $txtTitle);
		
		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{ 
		
			//rename the file
			$newName = $utility->getNewName4($_FILES['fileImg'], '',$imgId);
			$uImg->imgUpdResize($_FILES['fileImg'], '', $newName, 
								   '../images/static/image/', 800, 800, 
								   $imgId, 'image', 'image_id', 'static_image');
		
		}//upload
		
		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], 'Image uploaded successfully', 'SUCCESS');
	}
}

?>

<title><?php echo COMPANY_S; ?>- Add Image</title>
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
                <div class="cl"></div>
                
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
                        if( (isset($_GET['action'])) && ($_GET['action'] == 'add_image') )
                        {
                            //static detail
                            $staticDtl 	= $stat->getStaticData($id);
                                
                        ?>
                   
                        <h2><a name="addFile">Add File</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF']."?action=add_image&id=".$_GET['id'];?>"
	 					 method="post"  enctype="multipart/form-data">
                        	
                            <label>Title <span class="required">*</span></label>
                            <input name="txtTitle" type="text" class="text_box_large" id="txtTitle"
			 				value="<?php $utility->printSess2('txtTitle', ''); ?>" size="50" />
                            <div class="cl"></div>
                                                     
                            <label>Upload Image <span class="required">*</span></label>
                            <input name="fileImg" type="file" class="text_box_large" 
                            id="fileImg" onchange="return ajaxFileUpload(this);">	
                            <div class="cl"></div>
                           
                            <input name="btnAddImg" type="submit" class="button-add" value="add" />
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
 