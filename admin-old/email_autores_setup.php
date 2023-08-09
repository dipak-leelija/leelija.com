<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");
require_once("../includes/email.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/category.class.php");
require_once("../classes/static.class.php");
require_once("../classes/email.class.php");
require_once("../classes/pagination.class.php");

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
$email			= new Email();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();


###############################################################################################

//declare vars
$sDatail	= array();
$autoresSetIds 	= $utility->getAllId('email_autores_setup_id', 'email_autores_setup');

$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);


//add new content
if(isset($_POST['btnAutoresSetup'])) 
{
	$txtEmailForm			= $_POST['txtEmailForm'];
	$txtFooter				= $_POST['txtFooter'];
	$txtName				= $_POST['txtName'];
	//Status type
	if(isset($_POST['radioStatus']))
	{
		$radioStatus	= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus	= 	'a';
	}

	
	//registering the post session variables
	$sess_arr	= array('txtEmailForm', 'txtFooter', 'txtName');
	$utility->addPostSessArr($sess_arr);
	//$stat->regSubInSess($selNum);
	
	//defining error variables
	$action		= 'add_autores_setup';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addAutoresSetup';
	$typeM		= 'ERROR';
	
	
	
	//check for error
	$duplicateId	= $error->duplicateUser($txtEmailForm, 'email_from', 'email_autores_setup');
	$invalidEmail 	= $error->invalidEmail($txtEmailForm);
	
	if(preg_match('/^ER/',$invalidEmail))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE002, $typeM, $anchor);
	}
	elseif(preg_match("/^ER/",$duplicateId))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE001, $typeM, $anchor);
	}
	elseif($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERE004, $typeM, $anchor);
	}

	else
	{
		//add Email autores setup
		$autoresSetupId = $email->addAutoResponderSetup($txtName, $txtEmailForm, $txtFooter,$radioStatus);
		
		$utility->delSessArr($sess_arr);
				
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUAUTOSET001, 'SUCCESS');

	}
	
}//eof


//cancel button
if(isset($_POST['btnCancel']))
{	
	//deleting the sessions
	$utility->delSessArr($sess_arr);
	
	//refresh header
	header("Location: ".$_SERVER['PHP_SELF']."?id=".$_GET['id']);
}

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($autoresSetIds);
	
/* Setup vars for query. */
$targetpage = $_SERVER['PHP_SELF']."?".$link; 	//your file name  (the name of this file)
$limit = 10; 	
if(isset($_GET['page']))
{							//how many items to show per page
	$page = $_GET['page'];
}
else
{
	$page = 1;
}
//echo $page;exit;
if($page) 
	$start = ($page - 1) * $limit; 			//first item to display on this page
else
	$start = 0;								//if no page var is given, set start to 0
	
	/* Get data. */
/*	$sql = "SELECT customer_id FROM $tbl_name LIMIT $start, $limit";
	$result = mysql_query($sql);*/
	//echo $sql.mysql_error();exit;
	/* Setup page vars for display. */
					//if no page var is given, default to 1.
$prev = $page - 1;							//previous page is page - 1
$next = $page + 1;							//next page is page + 1
$lastpage = ceil($total_pages/$limit);		//lastpage is = total pages / items per page, rounded up.
$lpm1 = $lastpage - 1;						//last page minus 1

/* 
	Now we apply our rules and draw the pagination object. 
	We're actually saving the code to a variable in case we want to draw it more than once.
*/
$pagination = "";
//echo $total_pages;exit;
if($lastpage > 1)
{	
	$pagination .= "<div class=\"pagination\">";
	//previous button
	if ($page > 1) 
		$pagination.= "<a href=\"$targetpage&page=$prev\" id='previous-button'>< previous</a>";
	else
		$pagination.= "<span class=\"disabled\">< previous</span>";	
	
	//pages	
	if ($lastpage < 7 + ($adjacents * 2))	//not enough pages to bother breaking it up
	{	
		for ($counter = 1; $counter <= $lastpage; $counter++)
		{
			if ($counter == $page)
				$pagination.= "<span class=\"current\">$counter</span>";
			else
				$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
		}
	}
	elseif($lastpage > 5 + ($adjacents * 2))	//enough pages to hide some
	{
		//close to beginning; only hide later pages
		if($page < 1 + ($adjacents * 2))		
		{
			for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";				
			}
			$pagination.= "...";
			$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
			$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
		}
		//in middle; hide some front and some back
		elseif($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2))
		{
			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";
			for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
			$pagination.= "...";
			$pagination.= "<a href=\"$targetpage&page=$lpm1\">$lpm1</a>";
			$pagination.= "<a href=\"$targetpage&page=$lastpage\">$lastpage</a>";		
		}
		//close to end; only hide early pages
		else
		{
			$pagination.= "<a href=\"$targetpage&page=1\">1</a>";
			$pagination.= "<a href=\"$targetpage&page=2\">2</a>";
			$pagination.= "...";
			for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++)
			{
				if ($counter == $page)
					$pagination.= "<span class=\"current\">$counter</span>";
				else
					$pagination.= "<a href=\"$targetpage&page=$counter\">$counter</a>";					
			}
		}
	}
	
	//next button
	if ($page < $counter - 1) 
		$pagination.= "<a href=\"$targetpage&page=$next\" id='next-button'>next ></a>";
	else
		$pagination.= "<span class=\"disabled\" id='next-button-disabled'>next ></span>";
	$pagination.= "</div>\n";		
}
/* eof pagination*/
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - <?php if(count($sDatail) >0) {echo $sDatail[0];} else{ echo 'Website Content ';}?></title>

<!-- Style -->
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<!-- eof JS Libraries -->

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
                	<h1>Email Autoresponder Setup</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_autores_setup#addAutoresSetup"; ?>">
                          Add Autoresponder Setup 
                        </a> 
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
					 //check number of rows
					 if(count($autoresSetIds) == 0)
					 {
					?>
					<tr align="left" class="orangeLetter">
                     <td height="20" colspan="5"> <?php echo "No autores setup has been added so far"; ?> </td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                      <thead>
                      <th width="5%" height="25">id</th>
                      <th width="16%" height="25">Name</th>
                      <th width="20%" height="25">Email</th>
                      <th width="20%" align="center">Footer</th>
                      <th width="14%" align="center">Status</th>
                      <th width="15%" height="25"  align="center">Added On </th>
                      <th width="20%" height="25" align="center">Action</th>
                      </thead>
                    
					   <?php 
                        $i= $pages->getPageSerialNum($numResDisplay);
					    $autoresSetIds = array_slice($autoresSetIds, $start, $limit);
                        foreach($autoresSetIds as $k)
                        {
                            $autoresSetDtl 	= $email->getAutoResponderSetupData($k);
                            $bgColor 	= $utility->getRowColor($i);					
                       ?>
                       
                      <tr align="left"<?php $utility->printRowColor($bgColor);?>>
					  <td align="left"><?php echo $i++; ?></td>
                      <td>
					  	<?php echo $autoresSetDtl[5]; ?>
                      </td>
					  <td>
					  	<?php echo $autoresSetDtl[0]; ?>
                      </td>
					  <td align="center">
					  	<?php echo $autoresSetDtl[1]; ?>
                      </td>
                      <td align="center">
					  	<?php /*?><?php echo $autoresSetDtl[4]; ?><?php */?>
						<?php echo $utility->getStatusMesg($autoresSetDtl[4]); ?>
                      </td>

					  <td align="center">
					  	<?php echo $dateUtil->printDate($autoresSetDtl[2]); ?>					  </td>
					  <td align="center">
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('email_autores_setup_edit.php?action=edit_autores_set&id=<?php echo $k; ?>','StaticEdit','scrollbars=yes,width=700,height=600')">
					  edit					  </a> ]
					  					  
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
                            <div class="upper-block">Total Admin User: <?php echo count($autoresSetIds);?></div>
                            <?php echo $pagination ?>
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    	<?php 
						//add content form 
						if( (isset($_GET['action'])) && ($_GET['action'] == 'add_autores_setup') )
						{
						?>
                   
                        <h2><a name="addUser">Add Autorespoder setup</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                       <form action="<?php $_SERVER['PHP_SELF'];?>" method="post"  enctype="multipart/form-data">
                        	
                            <label>Name <span class="required">*</span></label>
                            <input name="txtName" type="text" class="text_box_large" id="txtName"
					 		value="<?php $utility->printSess('txtName'); ?>" size="50" />
                            <div class="cl"></div>
                            
                            <label>Email From<span class="orangeLetter">*</span></label>
                            <input name="txtEmailForm" type="text" class="text_box_large" id="txtEmailForm"
					 		value="<?php $utility->printSess('txtEmailForm'); ?>" size="50" />
                            <div class="cl"></div>
                       
                  
                            <label>Footer <span class="orangeLetter">*</span></label>
                            <textarea name="txtFooter" class="textAr" id="txtFooter" rows="5" cols="35"/>
							<?php $utility->printSess('txtFooter'); ?>	
                            </textarea>
                            <div class="cl"></div>
                            
                            <label>Status <span class="orangeLetter">*</span></label>
                            <input type="radio" name="radioStatus" id="radioStatus" value="a" title="Active"
							<?php echo $utility->checkSessStr('radioStatus','a','');?>/>
                            <label for="radioStatus">Active</label>
                            <input type="radio" name="radioStatus" id="radioStatus" value="d" title="Deactive" 
                            <?php echo $utility->checkSessStr('radioStatus','d','');?> />
                            <label for="radioStatus">Deactive</label>
                            <div class="cl"></div>
                            
                            
                            <input name="btnAutoresSetup" type="submit" class="buttonYellow" value="add">
							<input name="btnCancel" type="submit" class="buttonYellow" value="cancel">		
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