<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
 
require_once("../includes/constant.inc.php");
require_once("../includes/tracking_code.inc.php");

require_once("../classes/adminLogin.class.php"); 

require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/tracking_code.class.php");
require_once("../classes/pagination.class.php");  

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityStr.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();

$trackc			= new TrackingCode();
$page			= new Pagination();
$category		= new Cat();
$stat			= new StaticContent();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);

if($numResDisplay == 0)
{
	$numResDisplay = 10;
}

//Search
//if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
//{

	//$selStatus		= $utility->returnGetVar('selStatus','');
	//$keyword		= $utility->returnGetVar('keyword','');
	//$numResDisplay	= $utility->returnGetVar('numResDisplay',10);
	
	//$statVar	= "&selStatus=".$selStatus;
	//$numVar		= "&numResDisplay=".$numResDisplay;
	//$keyVar		= "&keyword=".$keyword;
	//$srchVar	= "&btnSearch=Search";
	//$resVar		= '&numResDisplay='.$_GET['numResDisplay'];
	
	//$link =	$keyVar.$statVar.$numVar.$srchVar;
	
	//$noOfNav = $nav->getNavSearch($keyword,$selStatus);

//}
//else
//{
	//$link = '';
	//$noOfNav	= $nav->getNavigationId();
	
	
//}

if(isset($_POST['btnAddTC'])) 
{
	$txtName			= $_POST['txtName'];
	$jsCode				= $_POST['jsCode'];
	$selStatus			= $_POST['selStatus'];
	
	//registering the post session variables
	$sess_arr	= array('txtName', 'jsCode');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_tracking_code';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addTrackingCode';
	$typeM		= 'ERROR';
	
	
	//check the error
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTRC002, $typeM, $anchor);
	}
	elseif ($jsCode == '') 
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTRC004, $typeM, $anchor);
	}
	else
	{
		//set url val
		//$txtURL = $uStr->setSFValByFF($selStaticId, $txtURL, $txtURL);
		
		//add link
		$trackcId = $trackc->addTrackingCode($txtName, $jsCode, $selStatus);
				
		//upload image text
		//upload the file
		//if($_FILES['fileImgText']['name'] != '')
		//{
			//rename the file
			//$newName	= $utility->getNewName4($_FILES['fileImgText'], '', $fileId);
			
			//uploading the file
			//$utility->fileUpload2($_FILES['fileImgText'], '', $newName, '../images/navigation/', 
								 // $navId, 'icon', 'navigation_id', 'navigation');
		//}
		
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUTRC001, 'SUCCESS');
	}
	
}//eof


//cancel button
if(isset($_POST['btnCancel']))
{
	//delete session
	$sess_arr	= array('txtName','jsCode');
	$utility->delSessArr($sess_arr);
		
	header("Location: ".$_SERVER['PHP_SELF']);
}

/*START PAGINATION*/
//$total = count($noOfNav);

//$pageArray = array_chunk($noOfNav, $numResDisplay);


//$newPage = array();
//$name = "Page";
//$numPages = ceil($total/$numResDisplay);

//if(isset($_GET['mypage']))
//{
 //$myPage = $_GET['mypage'];

//}
//else
//{
	//$myPage = 'Array0';
	
//}

//$arrayNum = explode("Array",$myPage);

//$pageNumber = (int)$arrayNum[1];


//if($total == 0)
//{
	//$total = (int)$total;
//}

//$link= $link."&Page=".$myPage;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Navigation Management</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link rel="stylesheet" type="text/css" href="../style/style.css" />

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>

<!-- TinyMCE --> 
 <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
 <script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

		// Theme options
		theme_advanced_buttons1 : "image,fontsizeselect,forecolor,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,link,unlink,|,bullist,numlist,|,outdent,indent",
		theme_advanced_buttons2 :
"undo,redo,|,emotions,|,pasteword,code",
		theme_advanced_buttons3 : "",
		theme_advanced_buttons4 : "",
		
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		formats : {
			alignleft : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'left'},
			aligncenter : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'center'},
			alignright : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'right'},
			alignfull : {selector : 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes : 'full'},
			bold : {inline : 'span', 'classes' : 'bold'},
			italic : {inline : 'span', 'classes' : 'italic'},
			underline : {inline : 'span', 'classes' : 'underline', exact : true},
			strikethrough : {inline : 'del'}
		},

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE -->

<!-- eof JS Libraries -->

</head>

<body>

	<!-- Header -->
	<?php require_once('header.inc.php'); ?>
    
    <!-- Container -->
    <div class="container">
        <div class="inner-container">
        	<div id="admin-menu">
				<?php require_once('menu.inc.php'); ?>
            </div>
            
            <!-- Inner  -->
            <div id="admin-body">
            	
                <div id="admin-top">
                	<h1>Tracking Code Management</h1>
               
                
                <div class="cl"></div>
                
               </div>
                <!--eof admin top-->
                
               
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	 <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_tracking_code#addTrackingCode"; ?>">Add Visitors Tracking</a> 
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                     <!-- First Column-->
                	<div class="first-column">
                      <table class="single-column" cellpadding="0" cellspacing="0">
							 <?php 
                            $trackingCodeIds = $trackc->getTrackingCodeId();
							if(count($trackingCodeIds) == 0)
							{

                            ?>
                            <tr align="left" class="orangeLetter">
                              <td height="20" colspan="6"> <?php echo ERSPAN.ERTRC001.ENDSPAN;?> </td>
                             </tr>
                            <?php 
                            }
                            else
                            {
                            ?>  
                            <thead>
                              <th width="4%">#</th>
                              <th width="24%" >Title</th>
                              <th >JS Code</th>
                              <th width="12%">Added On </th>
                              <th width="19%">Action</th>
                              </thead>
                            <?php 
                                $i = 1;
								foreach($trackingCodeIds as $k)
								{
									$tCDtl = $trackc->getTrackingCodeData($k);
									
									//get the row background color
									$bgColor 	= $utility->getRowColor($i);
                                    
                            ?>
                                <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
                                  <td><?php echo $i++; ?></td>
                                  <td><?php echo $tCDtl[0]; ?></td>
                                  <td>
                                    <?php  echo stripslashes(htmlentities($tCDtl[1])); ?>  
                                  </td>
                                  <td>
                                    <?php echo $dateUtil->printDate($tCDtl[3]); ?>   </td>
                                  <td>
                                  [ 
                                    <a href="#" 
                                  onClick="MM_openBrWindow('tracking_code_edit.php?action=edit_track_code&amp;id=<?php echo $k; ?>','LinkEdit','scrollbars=yes,width=750,height=600')">
                                  edit					  </a> ]
                                 [ 
                                    <a href="#" 
                                  onClick="MM_openBrWindow('tracking_code_delete.php?action=delete&amp;id=<?php echo $k; ?>','LinkDelete','scrollbars=yes,width=450,height=300')">
                                  delete                      </a> ]					</td>
                                </tr>
                          <?php 
                                }
                          }
                          ?>
                          </table>
                      
                      	  <div class="first-column">
                 
                            <!-- Bottom Pagination-->
                            <div class="pagination-bottom">
<?php /*?>                                <div class="upper-block">Total Number of Navigation: <?php echo count($noOfNav);?></div>
                                <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div>
<?php */?>                            </div>
                            
                            <div class="second-column">
                    			
                			</div>
                         	<div class="cl"></div>
                            
                      	 </div>
                         
                </div>
                
                <!-- eof Display Data -->
                
                
                  
                
                <!-- Form -->
                <div class="webform-area">
                    
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    <?php 
					if(isset($_GET['action']) && ($_GET['action'] == 'add_tracking_code')) 
					{	
					?>
                   
                    <h2><a name="addNavigation">Add Tracking Code</a></h2>
                    <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                    
                    <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                    
                    <label>Title <span class="orangeLetter">*</span></label>
                    <input name="txtName" type="text" id="txtName" class="text_box_large"
                    value="<?php  $utility->printSess('txtName'); ?>" />
                    <div class="cl"></div>
                      
                    <label>JS Code</label>
                    <textarea name="jsCode" id="jsCode" cols="35" rows="5" class="textArA"></textarea>
                    <div class="cl"></div>
 					
                    <label>Select Status</label>
                       <?php 
                        $arr_value	= array('a','d','');
                        $arr_label	= array('active','inactive',' Status ');
                        ?>
                        <select class="textBoxA marT15" name="selStatus" id="selStatus">
                        <?php 
                            if(isset($_GET['selStatus']))
                            {
                                $utility->genDropDown($_GET['selStatus'], $arr_value, $arr_label);
                            }
                            else
                            {
                                $utility->genDropDown('', $arr_value, $arr_label);
                            }
                        ?>
                        </select>
                        <div class="cl"></div>                      
                       <label>&nbsp;</label>
                       <label>&nbsp;</label>
                       <div class="cl"></div>

                      <label>&nbsp;</label>
                      <input name="btnAddTC" id="btnAddTC" type="submit" class="button-add" value="add" /> 
                      <input name="btnCancel" id="btnCancel" type="submit" class="button-add" value="cancel" />                   
                      <div class="cl"></div> 
                      
                      <label>&nbsp;</label>
                       <div class="cl"></div>
                      <label>&nbsp;</label>

                  </form>
                        
                   
                    <?php 
					}
					?>
                    
                     
                </div>
                <div class="cl"></div>
                <!-- eof Form -->
                
            </div>
            <!-- eof Inner  -->
             
            <div class="cl"></div>
        </div>  
    </div>
    <!-- eof Container -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>

</body>
</html>