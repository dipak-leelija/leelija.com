<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../includes/email.inc.php");
require_once("../includes/email_account.inc.php");
require_once("../includes/subscriber.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/customer.class.php");
require_once("../classes/countries.class.php");
require_once("../classes/search.class.php");
require_once("../classes/email.class.php");
require_once("../classes/subscriber.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$customer	    = new Customer();
$country		= new Countries();
$search_obj		= new Search();
$email_obj		= new Email();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$subscribe		= new EmailSubscriber();
$pages			= new Pagination();
$utility		= new Utility();
$uMesg 			= new MesgUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);

//$getLink = $page->getLink();


if(isset($_GET['numResDisplay']))
{
	$numResDisplay = $_GET['numResDisplay'];
}
else
{
	$numResDisplay = 10;
}


if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	
	$selStatus		= $utility->returnGetVar('selStatus','');
	$cId			= $utility->returnGetVar('cId',0);
	$keyword		= $utility->returnGetVar('keyword','');
	$numResDisplay	= $utility->returnGetVar('numResDisplay',10);
	
	$statVar	= "&selStatus=".$selStatus;
	$numVar		= "&numResDisplay=".$numResDisplay;
	$keyVar		= "&keyword=".$keyword;
	$srchVar	= "&btnSearch=Search";
	
	$link =	$keyVar.$statVar.$numVar.$srchVar;
	
	$noOfCus 	= $subscribe->getAllId('', $selStatus,$cId, $keyword);
								//($letIds, $staIds, $catIds, $keyIds)
	
}
else
{
	$link = '';
	$noOfCus	= $subscribe->getAllId('', '', 0, '');
}

////////////////////////////////////////////////////////////////////////////////

/*	Add new email */
if(isset($_POST['btnAddEmail']))
{
	$txtEmail	= addslashes(trim($_POST['txtEmail']));
	$txtFname	= addslashes(trim($_POST['txtFname']));
	$txtSurname	= addslashes(trim($_POST['txtLname']));
	$selCat		= 	(int)$_POST['selCat'];
	$txtPhone	= 	'';
	$txtCompany	= 	'';
	
	//defining error variables
	$action		= 'add_customer';
	$url		= $_SERVER['PHP_SELF']."?".$getLink;
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addCus';
	$typeM		= 'ERROR';
	
	//check for error
	$duplicateId	= $error->duplicateUser($txtEmail, 'email', 'email_subscriber');
	
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	
	
	if(ereg('^ER',$invalidEmail))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER002, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicateId))
	{
		
		$error->showErrorTA($action, $id, $id_var, $url, ER001, $typeM, $anchor);
	}
	else
	{
		//add email id
		$email_id = $subscribe->addSubscriber( $txtEmail, $txtFname, $txtSurname, $selCat, $txtCompany, $txtPhone);
											 //($customer_id, $email, $fname,$lname, $category, $company, $phone)
		
		
		if($email_id == 0)
		{
			$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC002, $typeM, $anchor);
		}
		else
		{
			//forward
			$uMesg->showSuccessT('success', 0, '', $url, SUSUBSC001, 'SUCCESS');
		}
		
	}
}
/*	End of adding new email*/



/** 
*	Send Initiative Letter
*/
if(isset($_POST['btnSendMail']))
{ 
	//$email_list = $_POST['email_list'];
	$txtSubject = trim($_POST['txtSubject']);
	$txtMessage = trim($_POST['txtMessage']);
	
	 // generate a random string to be used as the boundary marker
	$mime_boundary = "==Multipart_Boundary_x".md5(mt_rand())."x";
	
	
	$tmp_name 	= $HTTP_POST_FILES['fileAttachment']['tmp_name'];
	$file_type 	= $HTTP_POST_FILES['fileAttachment']['type'];
	$file_name 	= $HTTP_POST_FILES['fileAttachment']['name'];
	$file_size	= $HTTP_POST_FILES['fileAttachment']['size'];
	
	$from		= EMAIL_FROM_TO_INFO;
	$header		= '';
	$body		= $txtMessage;
	$data		= array();
	$fname		= array();
	$lname		= array();
	
	$emailIds 	= $subscribe->getIdByCatStatus('a', $_POST['selCat']);
	
	if(count($emailIds) > 0)
	{
		
		foreach($emailIds as $k)
		{
			$subsDtl 	= $subscribe->getSubsDtl($k);
			$data[]	 	= $subsDtl[2];
			$fname[] 	= $subsDtl[3];
			$lname[] 	= $subsDtl[4];
		}
		
		//check if file is attached
		if(file_exists($tmp_name))
		{
			// check to make sure that it is an uploaded file and not a system file
			if(is_uploaded_file($tmp_name))
			{
				// open the file for a binary read
				$file = fopen($tmp_name,'rb');

				// read the file content into a variable
				$newdata = fread($file,filesize($tmp_name));

				// close the file
				fclose($file);

				// now we encode it and split it into acceptable length lines
				$newdata = chunk_split(base64_encode($newdata));
			}
			
			$headers =  "From: $from\r\n" .
						"MIME-Version: 1.0\r\n" .
						"Content-Type: multipart/mixed;\r\n" .
						" boundary=\"{$mime_boundary}\"";
			
			$body =  ".\n\n" .
         			 "--{$mime_boundary}\n" .
         			 "Content-Type: text/html; charset=\"iso-8859-1\"\n" .
         			 "Content-Transfer-Encoding: 7bit\n\n" .
         			 "".$body . "\n\n";//Dear Friend, <br /><br />
				
			$body .= "--{$mime_boundary}\n" .
					 "Content-Type: {$file_type};\n" .
					 " name=\"{$file_name}\"\n" .
					 "Content-Transfer-Encoding: base64\n\n" . 
					 $newdata . "\n\n" .
					 "--{$mime_boundary}--\n";
			
			//sending mail
			for($i=0; $i < count($data); $i++)
			{
				@mail($data[$i] ,$txtSubject,  "Dear ".$fname[$i].",<br /><br />".$body, $headers);
			}
			
		}
		else
		{
			//creating header
			$headers  = "From: ".$from."\n";
			$headers .= "Return-Path: <".INFO_EMAIL.">\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1";
			
			$body	  = $body;
			
			//sending mail
			for($i=0; $i < count($data); $i++)
			{
				@mail($data[$i] ,$txtSubject, "Dear ".$fname[$i].",<br /><br />".$body, $headers);
			}
			
		}
		
	}//if
	
	
	//forward echo $_SERVER['PHP_SELF'];$url
	$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'] ,  SUSUBSC004, 'SUCCESS');//"Location:".
	
}

/*START PAGINATION*/
//$total = count($noOfCus);

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($noOfCus);
	
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
<title><?php echo COMPANY_S; ?> - Email Management</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script>

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
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
                	<h1>Email Management</h1>
                    
                    <!-- Search -->
                    <div id="search-page-back">
                    	<form name="formAdvSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<input name="keyword" type="text" class="search-text" id="keyword" placeholder="Keyword.." results="5"
                          	value="<?php $utility->printGet('keyword');?>" />
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
                         				
                                        <label>Select Status</label>
										<?php 
                                        $arr_value	= array('a','d','');
                                        $arr_label	= array('active','inactive',' Status ');
                                        ?>
                                        <select class="textBoxA" name="selStatus" id="selStatus">
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
                                        
                                        <label>Designation</label>
                                        <select name="selCat" class="textBoxA" id="selCat">
                                            <option value="0">-- All --</option>
                                            <?php
                                            if(isset($_GET['selCat']))
                                            { 
                                                $utility->populateDropDown($_GET['selCat'], 'cat_id', 'title', 'email_categories');								
                                            }
                                            else
                                            {
                                                $utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');
                                            }
                                            ?>
                                        </select>
                                        <div class="cl"></div>
                                        
                                        <label>Result Per Page</label>
										<?php echo  $utility->dispResPerPage($numResDisplay, '');?>
                                		<div class="cl"></div>
                                	</div>
                                </div>
                            </div>
                            <input type="submit" class="search-button" name="btnSearch" id="btnSearch" value="Search" />
                        </form>
                    </div>
                    <!-- eof Search -->
                    
                    <div class="cl"></div>
                </div>
                
                
               <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="email_acc_add.php">Add Member  </a>
                    </div>
                    
                    <div class="add-new-option">
                    	 <a href="#" 
                          onClick="MM_openBrWindow('email_acc_view.php?type=A','ViewSubscriber','status=yes,scrollbars=yes,width=750, height=1200')">
                          View Member 
                          </a>
                    </div>
                    
                </div>
                <!-- eof Options -->
                
                <div class="webform-area">
                	
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                
              		<h2>Send Mail</h2> 
            	
			  			<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" 
                        name="form2" id="form2" >
                
                                                      
                            <label>Group</label>
                        
                            <select name="selCat" class=" textBoxA" id="selCat">
                                <option value="0">-- All --</option>
                                  <?php
                                    $utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');						
                                  ?>
                            </select>
                            <div class="cl"></div>
                               
                            <label>Subject</label>
                            <input name="txtSubject" type="text" class="text_box_large" id="txtSubject" size="64" maxlength="128">	
                            <div class="cl"></div>
                        
                            <label>Attachment</label>
                            <input name="fileAttachment" type="file" class="text_box_large" id="fileAttachment">
                            <div class="cl"></div>
                            
                            <label>Message</label>
                            <div class="cl"></div>
                            
                            <textarea name="txtMessage" class="textAr" id="txtMessage"></textarea>
                            <div class="cl"></div>
                        
                            <input name="btnSendMail" type="submit" class="button-add" id="btnSendMail" value="send">
                            <div class="cl"></div>					
                
              			</form>
            
              		<h2><a name="addCus">Quick Add</a></h2>
              
                		<form name="formQuickAdd" method="post" action="<?php $_SERVER['PHP_SELF'];?>">
                  		
                          <label>Group</label>
                          <select name="selCat" id="selCat" class=" textBoxA">
                            <?php
                            if(isset($_SESSION['selCat']))
                            { 
                                $utility->populateDropDown($_SESSION['selCat'], 'cat_id', 'title', 'email_categories');								
                            }
                            else
                            {
                                $utility->populateDropDown(0, 'cat_id', 'title', 'email_categories');
                            }
                            ?>
                          </select>
                          <div class="cl"></div>
                         
                          
                          <label>Email:</label>
                          <input name="txtEmail" type="text" class="text_box_large" />
                          <div class="cl"></div>
                          
                          <label>First Name:</label>
                          <input name="txtFname" type="text" class="text_box_large" />
                          <div class="cl"></div>
                          
                          <label>Last Name:</label>
                          <input name="txtLname" type="text" class="text_box_large" />
                          <div class="cl"></div>
                          
                          <input name="btnAddEmail" type="submit" class="button-add" id="btnAddEmail" value="add" />
                          <div class="cl"></div>
                          
                    </form>
                </div>
                <div class="cl"></div>
                
                
                <!-- Display Data -->
                <div id="data-column">
                    <table class="single-column" cellpadding="0" cellspacing="0">
                            
						 <?php 
                        if(count($noOfCus) == 0)
                        {
                        ?>
                        <thead>
                          <th colspan="5"> None of the subscriber found </th>
                        </thead>
                        <?php 
                        }
                        else
                        {
                        ?>  
                         
                        <thead >
                          <th width="5%">No.</th>
                          <th width="28%"> Email (send now)</th>
                          <th width="28%">Name</th>
                          <th width="14%">Created On </th>
                          <th width="25%">Action</th>
                         </thead>
                        <?php 
                            
                            $i= $pages->getPageSerialNum($numResDisplay);
					    	$noOfCus = array_slice($noOfCus, $start, $limit);
                            
                            foreach($noOfCus as $k)
                            {
                                //$k = $pageArray[$pageNumber][$j];
                                
                                $cusDetail 	= $subscribe->getSubsDtl($k);
								//print_r($cusDetail);
                                $bgColor 	= $utility->getRowColor($i);
                        ?>
                            <tr <?php $utility->printRowColor($bgColor);  ?>>
                              <td ><?php echo $i++; ?></td>
                              <td ><a href="#" title="mail <?php echo $cusDetail[2]; ?>" 
                              onClick="MM_openBrWindow('customer_mail.php?toEmail=<?php echo $cusDetail[2]; ?>&toName=<?php echo $cusDetail[3]." ".$cusDetail[4]; ?>','SendMail','scrollbars=yes,width=650,height=400')">
                              <?php echo $cusDetail[2]; ?></a></td>
                              <td>
                             <?php echo $cusDetail[3]." ".$cusDetail[4]; ?>					  </td>
                              <td><?php echo $dateUtil->printDate($cusDetail[7]); ?></td>
                              
                              <td>
                              [ 
                              <a href="#" onClick="MM_openBrWindow('email_status.php?action=edit_status&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=600,height=350')">
                              status					  </a> ]
                              
                              [ 
                              <a href="#" onClick="MM_openBrWindow('email_acc_edit.php?action=edit_email&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=600,height=350')">
                              edit					  </a> ]
                              
                              [ 
                              <a href="#" onClick="MM_openBrWindow('email_acc_del.php?action=delete_email&email_id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=500,height=350')">
                              delete	 </a> ]</td>
                           </tr>
                      <?php 
                            }
                      }
                      ?>
                          
                 </table>
                 
                 <div class="first-column">
                 
                <!-- Bottom Pagination-->
                <div class="pagination-bottom">
                    <div class="upper-block">Total  Subscriber: <?php echo count($noOfCus);?></div>
                    <?php echo $pagination ?>
                </div>
                </div>
                
                <!-- Gap-->
                <div class="column-gap">&nbsp;</div>
                <div class="cl"></div>
                 
             </div>
                <!-- eof Display Data -->
                
                
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