<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php"); 
require_once "../_config/dbconnect.php";
require_once "../_config/dbconnect.trait.php";


require_once("../includes/constant.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/notice.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/customer.class.php"); 

//require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$notice			= new Notice();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$customer		= new Customer();

//$search_obj		= new Search();
$page			= new Pagination();

$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$utility		= new Utility();

#####################################################################################################

//declare variables
$typeM				= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);
$numVar		   	   = "&numResDisplay=".$numResDisplay;
$numNotice			= $notice->getNoticeIds();


//add testimonial
if(isset($_POST['btnAdd'])) 
{
	$txtTitle		=  $_POST['txtTitle'];
	$txtLink		=  trim($_POST['txtLink']);
    $txtAudio		=  trim($_POST['txtAudio']);

	//hold in session
	$sess_arr	= array('txtTitle', 'txtLink','txtAudio');
	//$sess_arr	= array_merge($sess_arr,$listBox);
	$utility->addPostSessArr($sess_arr);


	//defining error variables
	$action		= 'add_notice';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addNotice';
	$typeM		= 'ERROR';

	$msg = '';//

	if($txtTitle == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, 'Title is empty', $typeM, $anchor);
	}
	
	else
	{
		//add guest
		$notId 		= $notice->addNotice($txtTitle, $txtLink,$txtAudio);
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);

		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], 'Notification is added successfully', 'SUCCESS');
	}
}//eof


//cancel
if(isset($_POST['btnCancel']))
{
	
	//deleting the sessions
	$utility->delSessArr($sess_arr);

	header("Location: ".$_SERVER['PHP_SELF']);
}

//start pagination
$total = count($numNotice);

$pageArray = array_chunk($numNotice, $numResDisplay);


$newPage = array();
$name = "Page";
$numPages = ceil($total/$numResDisplay);

if(isset($_GET['mypage']))
{
 $myPage = $_GET['mypage'];
}
else
{
	$myPage = 'Array0';
}


$arrayNum = explode("Array",$myPage);

$pageNumber = (int)$arrayNum[1];


if($total == 0)
{
	$total = (int)$total;
}

$link= $link."&Page=".$myPage;
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?>-Notification</title>

<!-- Style -->
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen"></link>
<!-- eof Style -->

<!-- Javascript Libraries --> 
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/activity.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>

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
                	<h1>Notice</h1>
                    <!-- Search -->
<?php /*?>                    <div id="search-page-back">
                    	<form name="formTestimonialSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<input name="keyword" type="text" class="search-text" id="keyword" placeholder="Keyword.."
                       		results="5" value="<?php $utility->printGet('keyword');?>" />
                       
                             
                            <div class="search-option">
                            
                           		<div id="dropdown-page-options">
                                
                            		<a href="javascript:void(0)" onClick="showHideDiv('dropdown-page-back', '');">
                                    	Options<img src="../images/admin/icon/search-arrow.png" width="5" height="5" alt="search" />
                                    </a>
                                    
                                    <div id="dropdown-page-back" style="display:none">
                                    	<p class="required">
                                          Note: if you do not use any keyword, you would be able to display listing according to
                                          the selected criteria.
                                        </p> 
                                		
                                        <label>Result Per Page</label>
                                        <?php echo  $utility->dispResPerPage($numResDisplay, '');?>
                                		<div class="cl"></div>
                                        
                            		</div>
                                </div>
                            </div>
                            <input type="submit" class="search-button" name="btnSearch" id="btnSearch" value="Search" />
                        </form>
                    </div><?php */?>
                    <!-- eof Search -->
                    
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_notice#addNotice"; ?>">
				 		 Add Notice</a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
                    if(count($numNotice) == 0)
                    {
                    ?>
                     <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"> No Notice found </td>
                    </tr>
                    <?php 
                    }
                    else 
                    {
					
                    ?>  
                     
                    <thead>
                      <th width="5%">Id.</th>
                      <th width="23%">Title </th>
                      <th width="55%">Link</th>
                       <th width="55%">Ausio file name</th>
                      <th width="17%">Action</th>
                    </thead>
        
					<?php
                        $i=1;
    
                        foreach($numNotice as $k)
                        {
							
                            $notDtl  = $notice->getNoticeData($k);
                            
                            $bgColor 	= $utility->getRowColor($i);
                    ?>
					<tr align="left" <?php $utility->printRowColor($bgColor);  ?>>
					  <td><?php echo $i++; ?></td>
					  <td><?php echo $notDtl[1]; ?></td>
					  <td><?php echo $notDtl[2]; ?></td>
                       <td><?php echo $notDtl[5]; ?></td>
					  <td align="center">
					  <br />
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('notice_edit.php?action=edit&amp;id=<?php echo $k; ?>','RatingEdit','scrollbars=yes,width=650,height=580')">
					  edit					  </a> ]
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('notice_delete.php?action=delete&amp;id=<?php echo $k; ?>','RatingDelete','scrollbars=yes,width=450,height=300')">
					  delete					  
                      </a> ]
                         			  
                          </td>
                       </tr>
                  <?php 
                       
                        }
                  }
                  ?>
                  
                  </table>
                  
                  <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <div class="upper-block">Total  Notice: <?php echo count($numNotice);?></div>
                           <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div>
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
						<?php 
                        if(isset($_GET['action']) && ($_GET['action'] == 'add_notice'))
                        {
                        ?>
                   
                        <h2><a name="addNotice"> Add Notice</a></h2>
                       
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" 
                        enctype="multipart/form-data">
                           <label>Notice Title <span class=" orangeLetter">*</span></label>
                            <input name="txtTitle" type="text" class="text_box_large" id="txtTitle" 
                            value="<?php $utility->printSess('txtTitle'); ?>" />					
                            <div class="cl"></div>
                            
                         
                            <label>Notice Link<span class=" orangeLetter">*</span></label>
                            <input type="text" name="txtLink"  class="text_box_large" id="txtLink"
                              value="<?php $utility->printSess('txtLink'); ?>" />
                             					  
                            <div class="cl"></div>
                            
                            
                            <label>Audio file name<span class=" orangeLetter">*</span></label>
                            <input type="text" name="txtAudio"  class="text_box_large" id="txtAudio"
                              value="<?php $utility->printSess('txtAudio'); ?>" />
                             					  
                            <div class="cl"></div>
                            
                            
                          
                            <label>&nbsp;</label>
                            <input name="btnAdd" type="submit" class="button-add" id="btnAdd" value="add" />
                            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
                            <div class="cl"></div>
                            	
                          
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <div class="cl"></div>
                        
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