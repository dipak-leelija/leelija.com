<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once ("../_config/dbconnect.php");
require_once "../_config/dbconnect.trait.php";

require_once("../includes/constant.inc.php"); 
require_once("../includes/content.inc.php"); 
require_once("../includes/url.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/services.class.php"); 
require_once("../classes/pagination.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityStr.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$service		= new Services();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();
$uNum 			= new NumUtility();
$uStr 			= new StrUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay', 10);

//if($numResDisplay == 0)
//{
//	$numResDisplay = 10;
//}
$sDatail	= array();
//$statIds 	= $utility->getAllId('static_id', 'static');

$numOrder	= $uNum->genSortOrderNum('N', 0, 'static_id', 1, 'static');

//parent ids
$pIds		= $utility->getAllId('categories_id', 'static_categories');


//Search
if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	
	$selStatus		= $utility->returnGetVar('selStatus','');
	$keyword		= $utility->returnGetVar('keyword','');
	$numResDisplay	= $utility->returnGetVar('numResDisplay',10);
	
	$statVar	= "&selStatus=".$selStatus;
	$numVar		= "&numResDisplay=".$numResDisplay;
	$keyVar		= "&keyword=".$keyword;
	$srchVar	= "&btnSearch=Search";
	$resVar		= '&numResDisplay='.$_GET['numResDisplay'];
	
	$link =	$keyVar.$statVar.$numVar.$srchVar;
	
	
	$noOfStatic = $stat->getStaticBySearch($keyword,$selStatus);
	
}
else
{
	$link = '';
	$noOfStatic	= $service->getServiceId(0, '');
	//$noOfStatic		= $utility->getAllId('static_id', 'static');
	
}

//	print_r($noOfStatic);exit;



//add new content
if(isset($_POST['btnAddStatic'])) 
{
	$cat_id			= $_POST['cat_id'];
	$txtTitle		= trim($_POST['txtTitle']);
	$selPSId		= $_POST['selPSId'];
	$intSort 		= $_POST['intSort'];
	$txtBrief		= $_POST['txtBrief'];
	$txtDesc		= $_POST['txtDesc'];
	$txtImgTitle	= $_POST['txtImgTitle'];
	$selNum			= $_POST['selNum'];
	$txtCANO			= $_POST['txtCANO'];
	//added video on March 30, 2011
	$txtVideo		= $_POST['txtVideo'];
	
	//added image position on June15, 2011
	if(isset($_POST['radioImgPosition']))
	{
		$radioImgPosition	= 	$_POST['radioImgPosition'];
	}
	else
	{
		$radioImgPosition	= 	'left';
	}
	
	//added Display banner on Jan 5th, 2012
	if(isset($_POST['radioDisBanner']))
	{
		$radioDisBanner	= 	$_POST['radioDisBanner'];
	}
	else
	{
		$radioDisBanner	= 	'N';
	}

    //added Display slide show on Jan 5th, 2012
	if(isset($_POST['radioDisSlideShow']))
	{
		$radioDisSlideShow	= 	$_POST['radioDisSlideShow'];
	}
	else
	{
		$radioDisSlideShow	= 	'N';
	}

	
	//added on September 23, 2011
	$txtPageTitle	= trim($_POST['txtPageTitle']);
	$txtSEOURL		= trim($_POST['txtSEOURL']);
	$txtMetaTitle	= $_POST['txtMetaTitle'];
	$txtMetaKey		= $_POST['txtMetaKey'];
	$txtMetaDesc	= $_POST['txtMetaDesc'];
	
	$intDispWidth	= $_POST['intDispWidth'];
	$intDispHeight	= $_POST['intDispHeight'];
	// Added on 12 th December 2014
	$txtCANO		= trim($_POST['txtCANO']);

	/*if($cat_id == 2)
	{
		$imgWidth	= 620;
		$imgHeight	= 350;
	}
	else
	{
		$imgWidth	= 800;
		$imgHeight	= 800;
	}*/
	
	//added on january 5th, 2012
	$txtURL		= $_POST['txtURL'];
	
	//misc
	//$radioFeatured		= 	'l';
	
	//registering the post session variables
	$sess_arr	= array('txtTitle', 'selPSId', 'intSort','txtBrief','txtDesc', 'txtImgTitle', 'radioImgPosition', 'selNum', 
						'txtVideo', 'txtPageTitle', 'txtSEOURL', 'txtMetaTitle', 'txtMetaKey', 'txtMetaDesc', 'intDispWidth',
						'intDispHeight','txtCANO');
						
	$utility->addPostSessArr($sess_arr);
	$stat->regSubInSess($selNum);
	
	//defining error variables
	$action		= 'add_static';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addStatic';
	$typeM		= 'ERROR';
	
	
	//check for the error
	$urlRes		= $error->checkHttpInURL($txtVideo);
	$curlRes	= $uCurl->validateURL($txtVideo);
	
	$msg = '';
		
	if($txtTitle == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERSTCON002, $typeM, $anchor);
	}
	else if(($cat_id == 0) || (!in_array($cat_id, $pIds)))
	{
		$error->$error->showErrorTA($action, $id, $id_var, $url, ERSTCON004, $typeM, $anchor);;
	}
	elseif( ($txtVideo != '') && ($urlRes == 'ER') )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERURL001, $typeM, $anchor);
	}
	elseif( ($txtVideo != '') && ($curlRes == 'NOT_FOUND') )
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERURL002, $typeM, $anchor);
	}
	else
	{
		//echo $txtBrief;exit;
		//add static
		$staticId = $stat->addStatic($cat_id, $selPSId, $txtTitle, $txtPageTitle, $txtSEOURL, $txtURL, $txtBrief, $txtDesc, 
									 $txtImgTitle, $radioImgPosition, $intSort, $intDispWidth, $intDispHeight, $txtMetaTitle, 
 									 $txtMetaKey, $txtMetaDesc, $radioDisBanner,  $radioDisSlideShow,$txtCANO);
		
			
		//insert the video if string is not null
		if($txtVideo != '')
		{
			//convert video to embedded one 
			$videoURL = $uImg->generateYoutubeEmbedURL($txtVideo);
			
			//add the embedded video
			$videoUpdRes = $uImg->videoUpdate($txtVideo, $staticId, 'static_id', 'video', 'static');
		}
		else
		{
			//add the embedded video
			$videoUpdRes = $uImg->videoUpdate('', $id, 'static_id', 'video', 'static');
		}
		
		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{
			$newName = $utility->getNewName4($_FILES['fileImg'], '',$staticId);
			$uImg->imgCropResize($_FILES['fileImg'], '', $newName, 
								   '../images/static/', 400, 400, 
						           $staticId,'image', 'static_id', 'static');
								   
			//update the other two tables
			//bengali language table
			$utility->updateField($staticId, 'static_id',$newName, 'image', 'static_bn', 'NO', '');
			
			//hindi language table
			$utility->updateField($staticId, 'static_id',$newName, 'image', 'static_hi', 'NO', '');	
		}

		//uploading video
		if($_FILES['fileVideo']['name'] != '')
		{
			$newName = $utility->getNewName4($_FILES['fileVideo'], '', $staticId);
			$utility->fileUpload2($_FILES['fileVideo'], '', $newName, '../images/static/video/', 
								$staticId,'upload_video', 'static_id', 'static');
		
		}						   
		
		
		
		//add the additional paragraphs			
		for($i=0; $i < $selNum; $i++)
		{
			//echo "here";exit;
			if( ($_POST['txtSubTitle'][$i] != '') || ($_POST['txtSubDesc'][$i] != '') )
			{
			
				//add static detail
				$staticDtlId	= $stat->addStaticDtl($staticId, $_POST['txtSubTitle'][$i],'',  
									                  $_POST['txtSubDesc'][$i], $_POST['txtSubImgTitle'][$i], $_POST['selSubImgPos'][$i],
													  $_POST['intSubImgW'][$i], $_POST['intSubImgH'][$i]);
					
				//uploading images
				if($_FILES['fileSubImg']['name'][$i] != '')
				{ 
					
					//rename the file
					$newSubName = $utility->getNewName4Arr($i, $_FILES['fileSubImg'], '',
														   $staticDtlId);
					
					//upload in the server
					$uImg->imgUpdResizeArr($i, $_FILES['fileSubImg'], '', $newSubName, 
										   '../images/static/', 400, 400, 
										   $staticDtlId,'image', 'static_detail_id', 'static_detail');
					
				}//upload
				
			}//if
		}//for

		//deleting the sessions
		$stat->delSubInSess($selNum);
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUSTCON001, 'SUCCESS');

	}
	
}//eof


//cancel button
if(isset($_POST['btnCancel']))
{
	//registering session
	$sess_arr	= array('txtTitle', 'intSort','txtBrief','txtDesc', 'txtImgTitle', 'radioImgPosition', 'selNum', 'txtVideo', 
						'txtPageTitle', 'txtSEOURL', 'txtMetaTitle', 'txtMetaKey', 'txtMetaDesc', 'intDispWidth', 'intDispHeight','txtCANO');
	$stat->regSubInSess($selNum);
	
	//deleting the sessions
	$stat->delSubInSess($selNum);
	$utility->delSessArr($sess_arr);
	
	//refresh header
	header("Location: ".$_SERVER['PHP_SELF']."?id=".$_GET['id']);
}

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($noOfStatic);
	
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
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" type="text/css" href="../style/style.css" />
<link rel="stylesheet" type="text/css" href="../style/jQuery/colorbox.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
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
<script type="text/javascript" src="../js/banner.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.js"></script>

<script type="text/javascript" src="../js/jQuery/jquery-1.7.2.min.js"></script>

<script type="text/javascript" src="../js/jQuery/jquery.colorbox.js"></script>
<script type="text/javascript" src="../js/jQuery/jquery.colorbox-min.js"></script>

<script>
	$(document).ready(function(){
		//Examples of how to assign the ColorBox event to elements
		
		$(".iframe").colorbox({iframe:true, width:"80%", height:"90%"});
		$(".inline").colorbox({inline:true, width:"50%"});
		$(".callbacks").colorbox({
			onOpen:function(){ alert('onOpen: colorbox is about to open'); },
			onLoad:function(){ alert('onLoad: colorbox has started to load the targeted content'); },
			onComplete:function(){ alert('onComplete: colorbox has displayed the loaded content'); },
			onCleanup:function(){ alert('onCleanup: colorbox has begun the close process'); },
			onClosed:function(){ alert('onClosed: colorbox has completely closed'); }
		});
		
		//Example of preserving a JavaScript event for inline calls.
		$("#click").click(function(){ 
			$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
			return false;
		});
	});
</script>

<script src="../js/jquery-1.10.3.js"></script>
<script  type="text/javascript">
$(document).ready(function() {
   $(function() { 
   		$("#divResize, #addDivResize, #manageBannerResize, #manageBannerResize, #addMoreResize").draggable().resizable({
			aspectRatio: true,
			handles: 'ne, se, sw, nw'
		}); 
   });
});
</script>

<!--  popup  -->
<script type="text/javascript">
/*edit file*/
$(document).ready(function(){
	$('.manage-file').click(function(){
		var id			= $(this).attr('id');
		var static_id	= id.slice(11, id.length);
		showStaticFile(static_id);
		ShowDialog(true, 'static-file-dialog', 'static-file-overlay');

        // close option-dialog
        $(".close-popup").click(function (e) {
            HideDialog('static-file-dialog', 'static-file-overlay');
            e.preventDefault();
        });
	});
	
	/* manage banner */
	$('.manage-banner').click(function(){
		var id			= $(this).attr('id');
		var static_id	= id.slice(13, id.length);
		showStaticBanner(static_id);
		ShowDialog(true, 'manage-banner-dialog', 'manage-banner-overlay');

        // close option-dialog
        $(".close-popup").click(function (e) {
            HideDialog('manage-banner-dialog', 'manage-banner-overlay');
            e.preventDefault();
        });
	});
	/* eof manage banner */
	
	function ShowDialog(modal, DialogClassName, OverlayId) {
		$("#" + OverlayId).show();
		$("." + DialogClassName).fadeIn(300);

		if (modal) {
			$("#" + OverlayId).unbind("click");
		}
		else {
			$("#" + OverlayId).click(function (e) {
				HideDialog();
			});
		}
	}

	function HideDialog(DialogClassName, OverlayId) {
		$("." + DialogClassName).hide();
		$("#" + OverlayId).fadeOut(300);
	} 
	
	/* add file popup */
	$('.add-file').click(function(){
		var id			= $(this).attr('id');
		var static_id	= id.slice(8, id.length);
		document.getElementById("static_id").value = static_id;
		ShowDialog(true, 'add-file-dialog', 'add-file-overlay');

        // close option-dialog
        $(".close-popup").click(function (e) {
            HideDialog('add-file-dialog', 'add-file-overlay');
            e.preventDefault();
        });
	});
	
	/* add banner popup */
	$('.add-banner').click(function(){
		var id			= $(this).attr('id');
		var static_id	= id.slice(10, id.length);
		document.getElementById("banner_static_id").value = static_id;
		ShowDialog(true, 'add-banner-dialog', 'add-banner-overlay');

        // close option-dialog
        $(".close-popup").click(function (e) {
            HideDialog('add-banner-dialog', 'add-banner-overlay');
            e.preventDefault();
        });
	});
	
	/* add more popup */
	$('.add-more').click(function(){
		
		var id			= $(this).attr('id');
		var static_id	= id.slice(8, id.length);
		document.getElementById("more_static_id").value = static_id;
		ShowDialog(true, 'add-more-dialog', 'add-more-overlay');

        // close option-dialog
        $(".close-popup").click(function (e) {
            HideDialog('add-more-dialog', 'add-more-overlay');
            e.preventDefault();
        });
	});
	
	function ShowDialog(modal, DialogClassName, OverlayId) {
		$("#" + OverlayId).show();
		$("." + DialogClassName).fadeIn(300);

		if (modal) {
			$("#" + OverlayId).unbind("click");
		}
		else {
			$("#" + OverlayId).click(function (e) {
				HideDialog();
			});
		}
	}

	function HideDialog(DialogClassName, OverlayId) {
		$("." + DialogClassName).hide();
		$("#" + OverlayId).fadeOut(300);
	} 
	
});
</script>
<!--  eof popup  -->

<!-- TinyMCE --> 
 <script type="text/javascript" src="../js/tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
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
<!-- eof TinyMCE --> 


<script type="text/javascript">
$(document).ready(function()
{	
	$('.form-heading img').click(function()
	{
		var imgId		= $(this).attr('id');
		var imgArr		= imgId.split('-');
		var id			= imgArr[0];
		if(imgArr[1] == 'minus')
		{
			$('#'+imgArr[0]+'-body').slideUp();
			$('#'+imgId).removeClass('form-img').addClass('hide-dtl');
				
			$('#'+imgArr[0]+'-plus').removeClass('hide-dtl').addClass('form-img');
		}
		else if(imgArr[1] == 'plus')
		{
			$('#'+imgArr[0]+'-body').slideDown();
			$('#'+imgId).removeClass('form-img').addClass('hide-dtl');
				
			$('#'+imgArr[0]+'-minus').removeClass('hide-dtl').addClass('form-img');
		}

	})
	
	
	
});
</script>

<script type="text/javascript">
$(document).ready(function()
{	
	$('.form-heading img').click(function()
	{
		var imgId		= $(this).attr('id');
		var imgArr		= imgId.split('-');
		var id			= imgArr[0];
		if(imgArr[1] == 'minus')
		{
			$('#'+imgArr[0]+'-body').slideUp();
			$('#'+imgId).removeClass('form-img').addClass('hide-dtl');
				
			$('#'+imgArr[0]+'-plus').removeClass('hide-dtl').addClass('form-img');
		}
		else if(imgArr[1] == 'plus')
		{
			$('#'+imgArr[0]+'-body').slideDown();
			$('#'+imgId).removeClass('form-img').addClass('hide-dtl');
				
			$('#'+imgArr[0]+'-minus').removeClass('hide-dtl').addClass('form-img');
		}

	})
	
	
	
});
</script>

<script type="text/javascript">

/***********************************************
* Drop Down/ Overlapping Content- © Dynamic Drive (www.dynamicdrive.com)
* This notice must stay intact for legal use.
* Visit http://www.dynamicdrive.com/ for full source code
***********************************************/

function getposOffset(overlay, offsettype){
var totaloffset=(offsettype=="left")? overlay.offsetLeft : overlay.offsetTop;
//alert(totaloffset);
var parentEl=overlay.offsetParent;
while (parentEl!=null){
totaloffset=(offsettype=="left")? totaloffset+parentEl.offsetLeft : totaloffset+parentEl.offsetTop;
parentEl=parentEl.offsetParent;
}
return totaloffset;
}

function overlay(curobj, subobjstr, opt_position){
if (document.getElementById){
var subobj=document.getElementById(subobjstr)
subobj.style.display=(subobj.style.display!="block")? "block" : "none"
var xpos=getposOffset(curobj, "left")+((typeof opt_position!="undefined" && opt_position.indexOf("right")!=-1)? -(subobj.offsetWidth-curobj.offsetWidth) : 0) 
var ypos=getposOffset(curobj, "top")+((typeof opt_position!="undefined" && opt_position.indexOf("bottom")!=-1)? curobj.offsetHeight : 0)
//subobj.style.left=xpos+"px"
subobj.style.right="-30px"
subobj.style.top=ypos+20+"px"
//alert(ypos);301
return false
}
else
return true
}

function overlayclose(subobj){
document.getElementById(subobj).style.display="none"
}

</script>
<script type="text/javascript" src="../js/jquery.slimscroll.js"></script>
<script type="text/javascript" src="../js/jquery.slimscroll.js"></script>		
<script>
$(document).ready(function(){
	$('.file').slimScroll({
		width:'900',
		height:'470',
		railVisible: true,
		railColor: '#308ebe',
		wheelStep: 1
	});
	
});
	
</script>

<!-- add file-->
<script>
$(document).ready(function (e) {
	$("#form-add-file").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "static_file_add.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    	    cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
		    {
				if(data == 'Title is empty')
				{
					document.getElementById("add-file-msg").innerHTML = data;
				}
				else
				{
					document.getElementById("add-file-msg").innerHTML = data;
					document.getElementById("add-formfile").innerHTML = '';
				}
		    }	        
	   });
	}));
	
	/* add banner */
	$("#form-add-banner").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "static_banner_add.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    	    cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
		    {
				if((data == 'Banner heading is empty') || (data == 'Please select a banner'))
				{
					document.getElementById("add-banner-msg").innerHTML = data;
				}
				else
				{
					document.getElementById("add-banner-msg").innerHTML = data;
					document.getElementById("add-formbanner").innerHTML = '';
				}
		    }	        
	   });
	}));
	/* eof add banner */
	
	/* add more */
	$("#form-add-more").on('submit',(function(e) {
		e.preventDefault();
		$.ajax({
        	url: "static_sub_add.php",   	// Url to which the request is send
			type: "POST",      				// Type of request to be send, called as method
			data:  new FormData(this), 		// Data sent to server, a set of key/value pairs representing form fields and values 
			contentType: false,       		// The content type used when sending data to the server. Default is: "application/x-www-form-urlencoded"
    	    cache: false,					// To unable request pages to be cached
			processData:false,  			// To send DOMDocument or non processed data file it is set to false (i.e. data should not be in the form of string)
			success: function(data)  		// A function to be called if request succeeds
		    {
				if(data == 'Empty title or description')
				{
					document.getElementById("add-more-msg").innerHTML = data;
				}
				else
				{
					document.getElementById("add-more-msg").innerHTML = data;
					document.getElementById("add-formmore").innerHTML = '';
				}
		    }	        
	   });
	}));
	/* eof add banner */
	
})
</script>



<script type="text/javascript" src="js/jquery.js"></script>

<script type="text/javascript" src="js/jquery.js"></script><script type="text/javascript">
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
</script></head>

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
                	<h1>Services</h1>
                    
                     <!-- Search -->
                    <div id="search-page-back">
                    	<form name="formSampleSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
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
						<a href="services-add.php?action=addServices" >
                            Add New Service				  
						</a>
                    </div>
                </div>
                <!-- eof Options -->
             
                
                <!-- Display Data -->
                <div id="data-column">
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
                        <!-- SHOWING ALL CONTENT -->
                         <?php 
                         
                         //check number of rows
                         if(count($noOfStatic) == 0)
                         {
                         ?>
                         <tr align="left">
                           <td height="20" colspan="7"> <?php echo ERSPAN.ERSTCON001.ENDSPAN;?> </td>
                         </tr>
                        <?php 
                        }
                        else
                        {
                        ?>  
                         
                        <thead>
                          <th width="4%">id</th>
                          <th width="10%">Service Type</th>
                          <th width="10%">Service Name</th>
                          <th width="24%">Description</th>
                          <th width="10%">Page Title</th>
						  <th width="12%">Image</th>
                          <th width="10%">Added On </th>
                          <th width="20%">Action</th>
                          </thead>
                          
                        <?php 
                           $i	= $pages->getPageSerialNum($numResDisplay);
                           $noOfStatic = array_slice($noOfStatic, $start, $limit);
                            foreach($noOfStatic as $k)
                            {
								//echo $value;
                                //$k 			= $pageArray[$pageNumber][$j];
                                $serviceDtl 	= $service->showServices($k);
								// echo $serviceDtl[0];exit;
								$servtypeDtl 	= $service->getServiceCatDetail($serviceDtl[1]);
								// print_r($servtypeDtl);
                                $bgColor 		= $utility->getRowColor($i);	
					    ?>
							
                            <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
								<td><?php echo $i++; ?></td>
								<td><?php echo $servtypeDtl[1]; ?></td>
								<td><?php echo $serviceDtl[2]; ?></td>
								<td><?php echo $serviceDtl[3]; ?></td>
								<td><?php echo $serviceDtl[4]; ?></td>
								<td>
									<?php 
										if(($serviceDtl[12] != '') && ( file_exists("../images/static/".$serviceDtl[12])) )
										{
											echo $utility->imageDisplay2('../images/static/', 
														$serviceDtl[12], 60, 60, 0, 'greyBorder', $serviceDtl[12]);
										}
									?>					  
								</td>
                              
                              <td>
                              
                                <?php echo $dateUtil->printDate($serviceDtl[10]); ?> </td>
                              <td>
                              
                              
                              [ 
                             	view
                              [ 
                                <a href="static_edit.php?action=edit_static&id=<?php echo $k; ?>" >
                              edit					  </a> ]
                              
                                [ 
                                <a href="javascript:void(0)" 
                              onClick="MM_openBrWindow('static_delete.php?action=delete&id=<?php echo $k; ?>','StaticDelete','scrollbars=yes,width=400,height=300')">
                              delete					  </a> ]<br/>
                              
                              [ 
                                <a class="add-more" id="add-more<?php echo $k ?>" href="javascript:void(0)">
                            	 add featured
                                </a>  ]
                                <br/>
                              
                                <br />
                      
                              </div>
                              
                             <!--<div id="stat" style="position:absolute; display:none; border: 5px solid #65D262; background-color: #FFFFFF; width: 200px; height: 75px; padding: 8px">-->
                             <div class="padT5">
                              <!--[ 
                              <a href="javascript:void(0)"
                              onClick="MM_openBrWindow('static_view_banner.php?action=add_banner&id=<?php /*?><?php echo $k; ?><?php */?>','StaticAddFile','scrollbars=yes,width=800,height=600')" >
                              view banner
                              </a> ]-->	
                              <?php /*?>[				  
                              <a href="#"  onClick="return overlay(this,'stat<?php echo $k; ?>')" title="View All Banner">	
                                view banner
                              </a>
                              ]
                              [				  
                              <a href="javascript:void(0)"
                              onClick="MM_openBrWindow('static_add_img.php?action=add_image&id=<?php echo $k; ?>','StaticAddImage','scrollbars=yes,width=800,height=600')" >	
                                Add Image
                              </a>
                              ]<?php */?>
                             <!-- </div>-->
                              </div>
                              </td>
                             
                            </tr>
                            <div id="stat<?php echo $k; ?>" style="position:absolute; display:none; border: 5px solid #65D262; background-color: #FFFFFF; width: 200px; height: auto; padding: 8px; margin-right:50px">
                            
                            	<div align="left" style="padding:0px 0px 4px 0px; float:left; width:155px ">
                                <div class="blackLarge marB10" style="width:110px; float:left ">All Banner: </div>  
                                <div>&nbsp;&nbsp;&nbsp;</div>
                                <div class="purpleHeadingSmall" style="width:190px; float:left; " >
								
                                </div>
                            </div>
                            
                            <div style="float:right; width:80px; padding-bottom:5px; padding-right:5px; " align="right"> 
                              <div class="black" style="background-color: #FCC403; padding:2px; width:80px; 
                              border:1px solid #BABDCE;   text-align: center; font-weight:900; " >
                                <a href="#" onClick="overlayclose('stat<?php echo $k; ?>'); return false" title="close">
                                <div style="float:left; cursor:hand; ">
                                    <!-- <img src="images/icon/cross.gif" width="10" height="10" border="0" alt="close" />-->
                                </div>
                                     Close
                                </a>
                             </div>
                            </div>
                        </div>
                      <?php 
                            }
                      }
                      ?>
                      
                      
                  </table>
                  	
                    
                  <div class="first-column">
                     
                    <!-- Bottom Pagination-->
                    <div class="pagination-bottom">
                        <div class="upper-block">Total  Service(s): <?php echo count($noOfStatic);?></div>
                        <?php echo $pagination ?>
                    </div>
                  <div class="cl"></div>
                  
              </div>
                </div>
               
                <!-- eof Display Data -->
               
        </div>
            <!-- eof Inner  -->
             
            <div class="cl"></div>
    </div>  
    <!-- eof Container -->
   
    
    <!-- add more -->
    <div id="add-more-overlay" class="overlay"></div>
    <div id="addMoreResize" class="dialog add-more-dialog">
    	<div class="file">
            <a href="javascript:void()" class="close-popup topCloseBtn" title="Click here to close the popup">
                <img src="../images/icon/close-button.png" />
            </a>
            <div class="cl"></div>
            
            <h2>Additional Sections</h2>
            <div id="add-more-msg"></div>
        	<div id="add-formmore" class="webform-area">
                <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                <form action="" id="form-add-more" method="post"  enctype="multipart/form-data">
                    <label>Select No. of Sub Desc.</label>
                    <?php 
                    //gen number array
                    $arr_value	= range(1,3);
                    $arr_label	= range(1,3);
                    ?>
                    <select name="selNum" id="selDescNum" onchange="return getNumDesc2(); "
                    class="textBoxA">
                    <option value="0">--Select--</option>
                    <?php 
                    /*if(isset($_SESSION['selNum']))
                    {
                        $utility->genDropDown($_SESSION['selNum'], $arr_value, $arr_label);
                    }
                    else if(isset($_GET['selNum']))
                    {
                        $utility->genDropDown($_GET['selNum'], $arr_value, $arr_label);
                    }
                    else
                    {*/
                        $utility->genDropDown(0, $arr_value, $arr_label);
                    /*}*/
                    ?>
                    </select>
                    <div class="cl"></div>
                    <div id="showAddDescMsg">
                    <?php 
                    if(isset($_SESSION['selNum']))
                    {
                        //echo $stat->genDesc($_SESSION['selNum']);
                    }
                    ?>		
                    </div>
                    <input type="hidden" name="more_static_id" id="more_static_id" />
                    <input name="btnAddStatic" id="btnAddStatic" type="submit" class="button-add" value="add" />
                    <input name="btnCancel" type="submit" class="button-cancel" value="cancel" 
                    onClick="self.close()" />
        
              </form>

            </div>
        </div>
    </div> 
    <!-- eof add more -->
    
    <!-- Footer -->
	<?php require_once('footer.inc.php'); ?>
    
</body>


</html>