	<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/web_ads.inc.php");


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/web_ads.class.php");
require_once("../classes/order.class.php");

require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php");


require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$webAds			= new WebAds();
$order			= new Order();

$search_obj    	= new Search();
$pages			= new Pagination();
$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum			= new NumUtility();

###########################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$numOrder	= $uNum->genSortOrderNum('N', 0, 'web_ads_id', 1, 'web_ads');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);





//search
if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	
	$keyword		= $utility->returnGetVar('keyword','');
	$numResDisplay	= $utility->returnGetVar('numResDisplay',1);
	
	
	$numVar		= "&numResDisplay=".$numResDisplay;
	$keyVar		= "&keyword=".$keyword;
	$srchVar	= "&btnSearch=Search";
	
	$link =	$keyVar.$numVar.$srchVar;
	
	$noOfWebAds = $search_obj->searchWebAds($keyword);
	
}
else
{
	$link = '';
	$noOfWebAds	= $webAds->getAllWebAdsId();
}



if(isset($_POST['btnAddWebAds'])) 
{
	
	//hold the post data
	
	$selCusId 			= $_POST['selCusId'];
	//$selEmail 			= $_POST['selEmail'];

	//$selOrdId 			= $_POST['selOrdId'];
	//$selPackId	 		= $_POST['selPackId'];
	$txtEmail 			= addslashes(trim($_POST['txtEmail']));
	$txtTitle 			= $_POST['txtTitle'];
	$txtUrl 			= $_POST['txtUrl'];
	$txtUrlText 		= $_POST['txtUrlText'];
	$txtDesc 			= $_POST['txtDesc'];
	$txtAdvertiserName	= $_POST['txtAdvertiserName'];
	$txtContPer 		= $_POST['txtContPer'];
	$txtPhone 			= $_POST['txtPhone'];
	$txtAdsTag 			= $_POST['txtAdsTag'];
	$selAdsStatusId 	= $_POST['selAdsStatusId'];
	$intSortOrder 		= $_POST['intSortOrder'];
	$selFeatured 		= $_POST['selFeatured'];
	//$selStartDate 		= $_POST['selStartDate'];
	//$selEndDate 		= $_POST['selEndDate'];
	
	$file  				= $_FILES['fileImg'];
	
	
	$event_start_dates     = $_POST['event_start_date'];
	$event_end_dates       = $_POST['event_end_date'];
	
	
	
	//registering the post session variables
	$sess_arr	= array('selCusId', 'selOrdId', 'selPackId', 'txtEmail', 'txtTitle', 'txtUrl', 'txtUrlText',
						'txtDesc', 'txtAdvertiserName', 'txtContPer', 'txtPhone', 'txtAdsTag', 'selAdsStatusId', 
						'intSortOrder', 'selFeatured', 'event_start_dates', 'event_end_dates');
						
	$utility->addPostSessArr($sess_arr);
	
	
	//defining error variables
	$action		= 'add_web_ads';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addWebAds';
	$typeM		= 'ERROR';
	
	//$stDate = explode("/", $event_start_dates);
	//$strDateArray = array($stDate[2], $stDate[0], $stDate[1]);
	//$event_start_date = implode("-", $strDateArray);
	$event_start_date	= $event_start_dates." 12:00:00";

	/*$endDate = explode("/", $event_end_dates);
	$endDateArray = array($endDate[2], $endDate[0], $endDate[1]);
	$event_end_date = implode("-", $endDateArray);*/
	$event_end_date		= $event_end_dates." 12:00:00";
	
	$email_id   = $error->invalidEmail($txtEmail);
	
	
	if( ($txtEmail == '') || (ereg("^ER",$email_id)) )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD002, $typeM, $anchor);
	}
	elseif($txtTitle == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD001, $typeM, $anchor);
	}	
	elseif($event_start_date == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD004, $typeM, $anchor);
	}
	elseif($event_end_date == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERWEBAD005, $typeM, $anchor);
	}
	else
	{
		//add order
		/*$orderId	= $order->addOrder( '', '0', '', $selCusId, $txtEmail, $txtAdvertiserName, $txtEmail, '','','','','', $txtPhone, '',
											$txtContPer, $txtEmail, '', '' ,'', '', '', $txtPhone, '',  '1', '0', '', '',  '1');*/
											
		//add into web_ads table							 
		$webAdsId	= $webAds->addWebAds( $selCusId, 1, '1', $txtEmail, $txtTitle, $txtUrl, $txtUrlText, $txtDesc,
										  $txtAdvertiserName, $txtContPer, $txtPhone, $txtAdsTag, $selAdsStatusId, $intSortOrder,
										  $selFeatured, $event_start_date, $event_end_date);
		
		
		if($_FILES['fileImg']['name'] != '')
		{
			//renaming the file
			$newName = $utility->getNewName4($_FILES['fileImg'], '',$webAdsId);
			
			//upload in the server
			$uImg->imgCropResize($_FILES['fileImg'], '', $newName, 
								   '../images/ads/banner/', 200, 200, 
						           $webAdsId, 'image', 'web_ads_id', 'web_ads');
		}
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('SU', 0, '', $_SERVER['PHP_SELF'], SUWEBAD001, 'SUCCESS');
	}
	
}//eof

//$total = count($noOfWebAds);

//cancel
if(isset($_POST['btnCancel']))
{
	//registering the post session variables
	$sess_arr	= array('selCusId', 'selOrdId', 'selPackId', 'txtEmail', 'txtTitle', 'txtUrl', 'txtUrlText',
						'txtDesc', 'txtAdvertiserName', 'txtContPer', 'txtPhone', 'txtAdsTag', 'selAdsStatusId', 
						'intSortOrder', 'selFeatured', 'selStartDate', 'event_end_date');
	$utility->delSessArr($sess_arr);
	
	header("Location: ".$_SERVER['PHP_SELF']);
}

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($noOfWebAds);
	
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
<title><?php echo COMPANY_S; ?> - Website Ads</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />


<!--CSS Jquery Calender-->
<link rel="stylesheet" href="../style/jquery-ui.css" type="text/css" media="all" />
<!--CSS Jquery Calender-->


<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script>

<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 


<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/order.js"></script>



<!--Jquery Calender-->
<script src="../js/jquery.min.js" type="text/javascript"></script>
<script src="../js/jquery-ui.min.js" type="text/javascript"></script>
 <!--Jquery Calender--> 
 
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
                	<h1>Website Ads</h1>
                    
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
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_web_ads#addWebAds"; ?>">
                      Add Website Ads 
                      </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                 <table class="single-column" cellpadding="0" cellspacing="0">
                     <?php 
                    //$webAdsIds = $webAds->getAllWebAdsId();
                    if(count($noOfWebAds) == 0)
                    {
                    ?>
                    <thead align="left" class="orangeLetter">
                      <th> <?php echo ERWEBAD000; ?> </th>
                     </thead>
                    <?php 
                    }
                    else
                    {
                    ?>  
                     
                    <thead>
                      <th width="7%">#</th>
                      <th width="13%">Title</th>
                      <th width="13%">Url</th>
                      <th width="13%">Image</th>
                      <th width="14%">Status</th>
                      <th width="16%">Created On </th>
                      <th width="18%">Action</th>
                    </thead>
                    <?php 
                        //$i = 1;
						$i = $pages->getPageSerialNum($numResDisplay);
					    $noOfWebAds = array_slice($noOfWebAds, $start, $limit);
						
                        foreach($noOfWebAds as $k)
                        {
                            $webAdsDtl = $webAds->getWebAdsData($k);
                            $bgColor 	= $utility->getRowColor($i);
                    ?>
                        <tr align="center" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
                        
                          <td><?php echo $i++; ?></td>
                          <td><?php echo $webAdsDtl[4]; ?></td> 
                          <td><?php echo $webAdsDtl[5]; ?></td> 
                          <td>
						  <?php 
                            if(($webAdsDtl[20] != '') && ( file_exists("../images/ads/banner/".$webAdsDtl[20])) )
                            {
                                echo $utility->imageDisplay2('../images/ads/banner/', $webAdsDtl[20], 100, 100, 0, '', $webAdsDtl[4]);
                                            
                            }
                            ?>
                          </td> 
                          <td>
						  <?php 
						  	
							$statusTitle = $utility->getValueByKey( $webAdsDtl[12], 'ads_status_id', 'ads_status_name', 'ads_status');
							echo $statusTitle; 
						  ?>
                          </td> 
                          <td><?php echo $dateUtil->printDate($webAdsDtl[18]); ?></td>
                          <td>
                          [ 
                            <a href="javascript:void(0)" onClick="MM_openBrWindow('web_ads_edit.php?action=edit_web_ads&id=<?php echo $k; ?>','WebAdsEdit','scrollbars=yes,width=700,height=600')">
                          edit
                            </a> ]	
                         
                          [ 
                            <a href="javascript:void(0)" onClick="MM_openBrWindow('web_ads_delete.php?action=delete_web_ads&wAdsId=<?php echo $k; ?>','WebAdsDel','scrollbars=yes,width=400,height=350')">
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
                            <div class="upper-block">Total Web Ads: <?php echo count($noOfWebAds);?></div>
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
                    //CREATING NEW CATEGORY FORM
                    if( (isset($_GET['action'])) && ($_GET['action'] == 'add_web_ads') )
                    {	
                    ?>
                     <h2><a name="addWebAds">Add New Web Ads</a></h2>
                     <span>Please note that all the <span class="required">*</span> marked fileds are required</span>   
                         
                      <!-- Form -->
                     <form name ="WebAdsForm" id ="WebAdsForm" action="<?php $_SERVER['PHP_SELF']?>" method="post" 
                     enctype="multipart/form-data">
                     
                     	<label>Select Customer</label>
                        
                        
                        <?php $populateArr	= array('fname','lname'); ?>
                        <div class="cl"></div>
                        
                        <?php /*?><label>Select Order<span class="orangeLetter">*</span></label>
                        <select name="selOrderId" id="selOrderId" class="textBoxA">
                          <option value="0">-- None Available --</option>
                        </select>
                        <div class="cl"></div><?php */?>
                        <select name="selCusId" id="selCusId" class="textBoxA" onchange="getEmailByCusId();" >
                          <option value="0">-- Select One --</option>
                          <?php 
							   if(isset($_SESSION['selCusId']))
							   {
									 $utility->genDropDownMulCol($_SESSION['selCusId'],'customer_id', $populateArr, 'email', 'sort_order', 
									 							'customer'); 
							   }
							   else
							   {
									$utility->genDropDownMulCol('', 'customer_id', $populateArr, 'email', 'sort_order', 'customer');
							   }
							 ?>
                        </select>
                        
                        				
                       
                        <div class="cl"></div>
                          
                         <?php /*?><label>Select Order</label>				
                        <input name="selOrdId" type="text" class="text_box_large" id="selOrdId" 
                        value="<?php $utility->printSess('selOrdId'); ?>" size="25" 
                        onKeyPress="return intOnly(this, event)" />
                        <div class="cl"></div>
                        
                       <label>Select Package</label>
                        <input name="selPackId" type="text" class="text_box_large" id="selPackId" 
                        value="<?php $utility->printSess('selPackId'); ?>" size="25" />
                        <div class="cl"></div><?php */?>
                     
                        <label>Email Id <span class="orangeLetter">*</span></label>				 
                        <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" 
                        value="<?php $utility->printSess('txtEmail'); ?>" size="25" />	
                        <div class="cl"></div>
                        
                        
                        <label>Title<span class="orangeLetter">*</span></label>
                        <input name="txtTitle" type="text" class="text_box_large" id="txtTitle" 
                        value="<?php $utility->printSess('txtTitle'); ?>" size="25" />
                        <div class="cl"></div>
                      
                        <label>URL</label>
                        <input name="txtUrl" type="text" class="text_box_large" id="txtUrl" 
                        value="<?php $utility->printSess('txtUrl'); ?>" size="25" placeholder="test.com" />				
                        <div class="cl"></div>
                      
                     
                        <label>URL Text</label>
                        <input name="txtUrlText" type="text" class="text_box_large" id="txtUrlText" 
                        value="<?php $utility->printSess('txtUrlText'); ?>" size="25" />	
                        <div class="cl"></div>				
                      
                      
                        <label>Advertiser Name</label>
                        <input name="txtAdvertiserName" type="text" class="text_box_large" id="txtAdvertiserName" 
                        value="<?php $utility->printSess('txtAdvertiserName'); ?>" size="25">
                        <div class="cl"></div>					
                     
                      
                        <label>Description</label>
                       
                        <textarea name="txtDesc" type="text" class="text_box_large" id="txtDesc" size="25">
						<?php $utility->printSess('txtDesc'); ?>
                        </textarea>
                        <div class="cl"></div>				
                     
                        
                        <label>Contact Person</label>
                        <input name="txtContPer" type="text" class="text_box_large" id="txtContPer" 
                        value="<?php $utility->printSess('txtContPer'); ?>" size="25" />
                        <div class="cl"></div>					
                     
                        
                        <label>Phone </label>
                        <input name="txtPhone" type="text" class="text_box_large" id="txtPhone" 
                        value="<?php $utility->printSess('txtPhone'); ?>" size="25" />	
                        <div class="cl"></div>				
                     
                      
                        <label>Ads Tag</label>
                        <input name="txtAdsTag" type="text" class="text_box_large" id="txtAdsTag" 
                        value="<?php $utility->printSess('txtAdsTag'); ?>" size="25" />	
                        <div class="cl"></div>				
                     
                      
                        <label>Ads Status</label>
                        <select name="selAdsStatusId" class=" textBoxA" id="selAdsStatusId">
                        <option value="">-- Select --</option>
                        <?php
                        if(isset($_SESSION['selAdsStatusId']))
                        {
                            $utility->populateDropDown($_SESSION['selAdsStatusId'], 'ads_status_id',
                                                       'ads_status_name', 'ads_status');
                        }
                        elseif(isset($_GET['selAdsStatusId']) && ((int)$_GET['selAdsStatusId'] > 0))
                        {
                            $utility->populateDropDown($_GET['selAdsStatusId'], 'ads_status_id',
                                                       'ads_status_name', 'ads_status');
                        }
                        else
                        {
                            $utility->populateDropDown(0, 'ads_status_id', 'ads_status_name', 'ads_status');
                        }
                        ?>
                        </select>	
                        <div class="cl"></div>				
                     
                      
                        <label>Sort Order</label>
                        
                        <input name="intSortOrder" type="text" class="text_box_large" id="intSortOrder"
                        value="<?php $utility->printSess2('intSortOrder', $numOrder); ?>" maxlength="3"  
                        onKeyPress="return intOnly(this, event)" />
                        <div class="cl"></div>					
                    
                                     
                    
                      
                        <label>Featured</label>
                        <?php 
                         $arr_value = array('Y','N');
                         $arr_label = array('Yes','No');
                         ?>
                         <select name="selFeatured" id="selFeatured" class="textBoxA">
                         <option value="">-- Select One --</option>
                         <?php 
                            if(isset($_SESSION['selFeatured']) && (in_array($_SESSION['selFeatured'],$arr_value)))
                            {
                                $utility->genDropDown($_SESSION['selFeatured'], $arr_value, $arr_label); 
                            }
                            else
                            {
                                $utility->genDropDown('', $arr_value, $arr_label); 
                            }
                            
                         ?>
                         </select>	
                        <div class="cl"></div>	
                        
                        
                        <script>
							$(function() {
								$( "#event_start_date" ).datepicker();
								$( "#event_end_date" ).datepicker();
							});
						</script>
                        
                        <label>Start Date <span class="orangeLetter">*</span></label>
                        
                        <input name="event_start_date" type="text" class="text_box_large" id="event_start_date" />
						 <?php /*?>value="<?php $utility->printSess2('event_start_date',''); ?>" size="20" maxlength="128" readonly=""<?php */?>
                        <?php /*?><a title="Select Date from Calendar" style="cursor:pointer; "
                        onClick="displayCalendar(document.WebAdsForm.event_start_date,'yyyy-mm-dd',this); return false;">
                        <img src="../js/js_calendar/images/cal.gif" width="16" height="16" value="Cal" style="cursor:pointer" ></a><?php */?>
                        <div class="cl"></div>	
                        
                        <label>End Date <span class="orangeLetter">*</span></label>
                        
                        <input name="event_end_date" type="text" class="text_box_large" id="event_end_date"  />
						<?php /*?> value="<?php $utility->printSess2('event_end_date',''); ?>" size="20" maxlength="128" readonly=""<?php */?>
                        <?php /*?><a title="Select Date from Calendar" style="cursor:pointer; "
                        onClick="displayCalendar(document.WebAdsForm.event_end_date,'yyyy-mm-dd',this); return false;">
                        <img src="../js/js_calendar/images/cal.gif" width="16" height="16" value="Cal" style="cursor:pointer" ></a><?php */?>
                        <div class="cl"></div>			
                    
                      
                        <label>Image</label>
                        <input name="fileImg" type="file" class="text_box_large" 
                        id="fileImg" />
                        <span class="orangeLetter">* ( 200 pixels &times; 200 pixels) </span>	
                        <div class="cl"></div>				
                    
                      
                        <label>&nbsp;</label>
                        <input name="btnAddWebAds" type="submit" class="button-add" id="btnAddWebAds" value="add" />
                        <input name="btnCancel" type="submit" class="button-add" value="cancel" />					
                             
                            
            
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