<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/testimonial.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/rating.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 

require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
 

require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$rating			= new Rating();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$search_obj		= new Search();
$pages			= new Pagination();

$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$utility		= new Utility();

#####################################################################################################

//declare variables
$typeM				= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);
$numVar				= "&numResDisplay=".$numResDisplay;

if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	//get the variables
	$keyword		= $utility->returnGetVar('keyword','');
	$type			= $utility->returnGetVar('type','');
	$mode			= $utility->returnGetVar('mode','');
	
	//defining vars
	$keyVar			= "&keyword=".$keyword;
	$typeVar		= "&type=".$type;
	$modeVar		= "&mode=".$mode;
	$btnVar			= "&btnSearch=Search";
	
	$link =	$btnVar.$keyVar.$typeVar.$modeVar.$numVar;
	
	$numRate 	= $search_obj->getTestimonialByKeyword($keyword);
}
else
{
	$link 		= $numVar;
	$numRate    = $rating->getGuestId();
}


//add testimonial
if(isset($_POST['btnAdd'])) 
{
	$txtName		=  $_POST['txtName'];
	$txtEmail		=  $_POST['txtEmail'];
	$txtAdd			=  $_POST['txtAdd'];
	$txtDesc		=  trim($_POST['txtDesc']);
	$intSort		=  $_POST['intSort'];
	$intIPO			= $_POST['intIPO'];
	
	//added on July 21, 2010
	$txtDesg		= $_POST['txtDesg'];

	//get the dropdown values
	$listBox 		= $rating->genListBoxName();

	//hold in session
	$sess_arr	= array('txtName', 'txtEmail', 'txtAdd', 'txtDesc', 'intSort', 'intIPO');
	$sess_arr	= array_merge($sess_arr,$listBox);
	$utility->addPostSessArr($sess_arr);


	//defining error variables
	$action		= 'add_testm';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addTestimonial';
	$typeM		= 'ERROR';

	$msg = '';//

	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTESTM002, $typeM, $anchor);
	}
	else if( ($txtDesc == '')  || (strlen($txtDesc) < 8) )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERTESTM003, $typeM, $anchor);
	}
	else
	{
		//add guest
		$guestId = $rating->addGuest($txtName, $txtDesg, $txtEmail, $txtAdd, $txtDesc, 'a', $intSort, $intIPO);

		//add to guest rating section
		if(count($listBox) > 0)
		{
			foreach($listBox as $k)
			{
				if(isset($_POST[$k]))
				{
					$listVal	= $_POST[$k];
					$rating_id	= strrev(substr(strrev($k),1));

					//add to rating
					$rating->addGuestRating($guestId, $rating_id, $listVal);
				}
			}
		}

		//upload image
		if($_FILES['fileImage']['name'] != '')
		{			
			//image update
			$newName  = $utility->getNewName4($_FILES['fileImage'], '', $guestId);

			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName,'../images/upload/rating/', 
					  			   200, 200, $guestId, 'person_img', 'guest_id', 'guest');
		}

		//deleting the sessions
		$utility->delSessArr($sess_arr);

		//forward
		$uMesg->showSuccessT('success', $id, 'id', $_SERVER['PHP_SELF'], SUTESTM001, 'SUCCESS');
	}
}//eof


//cancel
if(isset($_POST['btnCancel']))
{
	//get the dropdown values
	$listBox 		= $rating->genListBoxName();
	
	//hold in session
	$sess_arr	= array('txtName', 'txtEmail', 'txtAdd', 'txtDesc', 'intSort', 'intIPO');
	$sess_arr	= array_merge($sess_arr, $listBox);

	//deleting the sessions
	$utility->delSessArr($sess_arr);

	header("Location: ".$_SERVER['PHP_SELF']);
}


//start pagination
//$total = count($numRate);

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($numRate);
	
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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Testimonial and Client Rating</title>

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
                	<h1>Testimonial and Client Rating</h1>
                    <!-- Search -->
                    <div id="search-page-back">
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
                    </div>
                    <!-- eof Search -->
                    
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_testm#addTestimonial"; ?>">
				 		 Add Testimonials</a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
                    if(count($numRate) == 0)
                    {
                    ?>
                     <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"> No guest rating found </td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                     
                    <thead>
                      <th width="5%">Id.</th>
                      <th width="20%">Person Name </th>
                      <th width="47%">Rating</th>
                      <th width="11%">Added On </th>
                      <th width="17%">Action</th>
                    </thead>
        
					<?php
                        //$i=1;
						$i = $pages->getPageSerialNum($numResDisplay);
					    $numRate = array_slice($numRate, $start, $limit);
    
                        foreach($numRate as $k)
                        {
                            $ratingDtl  = $rating->getGuestData($k);
                            
                            $bgColor 	= $utility->getRowColor($i);
                    ?>
					<tr align="left" <?php $utility->printRowColor($bgColor);  ?>>
					  <td><?php echo $i++; ?></td>
					  <td><?php echo $ratingDtl[0]; ?></td>
					  <td>
					  	<?php $rating->showRating($k, "box.png", "box_grey.png", "../images/icon/", 15, 15);	 ?> 
					 	<?php echo stripslashes(substr($ratingDtl[3], 0, 200)); ?>					  
                      </td>
					  <td>
					  	<?php echo $dateUtil->printDate($ratingDtl[7]); ?>
                      </td>
					  <td align="center">
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('guest_rating_view.php?action=edit&amp;id=<?php echo $k; ?>','RatingEdit','scrollbars=yes,width=650,height=400')">
					  view					  </a> ]
					  <br />
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('guest_rating_edit.php?action=edit&amp;id=<?php echo $k; ?>','RatingEdit','scrollbars=yes,width=650,height=580')">
					  edit					  </a> ]
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('guest_rating_delete.php?action=delete&amp;id=<?php echo $k; ?>','RatingDelete','scrollbars=yes,width=450,height=300')">
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
                            <div class="upper-block">Total  Testimonial: <?php echo count($numRate);?></div>
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
                        if(isset($_GET['action']) && ($_GET['action'] == 'add_testm'))
                        {
                        ?>
                   
                        <h2><a name="addTestimonial"> Add Testimonial</a></h2>
                       
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" 
                        enctype="multipart/form-data">
                           <label>Person Name <span class=" orangeLetter">*</span></label>
                            <input name="txtName" type="text" class="text_box_large" id="txtName" 
                            value="<?php $utility->printSess('txtName'); ?>" />					
                            <div class="cl"></div>
                            
                            
                            <label>Designation</label>
                            <input name="txtDesg" type="text" class="text_box_large" id="txtDesg" 
                            value="<?php $utility->printSess('txtDesg'); ?>" />	
                            <div class="cl"></div>
                          
                            <label>Email</label>
                            <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" 
                            value="<?php $utility->printSess('txtEmail'); ?>" />
                            <div class="cl"></div>
                            
                         
                            <label>Address</label>
                            <input name="txtAdd" type="text" class="text_box_large" id="txtAdd" 
                            value="<?php $utility->printSess('txtAdd'); ?>" />
                            <div class="cl"></div>
                            
                         
                            <label>Sort Order </label>
                            <input name="intSort" type="text" class="text_box_large" id="intSort" 
                            value="<?php $utility->printSess('intSort'); ?>" />
                            <div class="cl"></div>
                            
                          
                            <label>Intra Page Order</label>
                            <input name="intIPO" type="text" class="text_box_large" id="intIPO" 
                            value="<?php $utility->printSess2('intIPO', '1'); ?>" />
                            <div class="cl"></div>
                          
                            	
                            
                         
                            <label>Comment<span class=" orangeLetter">*</span></label>
                            <textarea name="txtDesc" cols="35" rows="5" class="textAr" id="txtDesc">
                              <?php $utility->printSess('txtDesc'); ?>
                            </textarea> 					  
                            <div class="cl"></div>
                            
                            
                          
                           <label>Person Image </label>
                            <input name="fileImage" type="file" class="text_box_large" />
                            <span class="orangeLetter">(200 X 200 pixels in width by height)</span>	
                            <div class="cl"></div>
                         <!-- <tr>
                            <td align="left" class="menuText">Place in Front page </td>
                            <td height="20" align="left" class="menuText pad5">
                            <input name="radioFT" type="radio" value="a">
                              Yes 
                                <input name="radioFT" type="radio" value="d" checked> 
                                No </td>
                            </tr> -->
                          
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