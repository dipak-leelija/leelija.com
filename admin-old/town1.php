<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");

require_once("../classes/adminLogin.class.php"); 

require_once("../classes/location.class.php"); 
require_once("../classes/pagination.class.php");
require_once("../classes/search.class.php");

require_once("../classes/error.class.php"); 
require_once("../classes/date.class.php"); 

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();

$search			= new Search();
$page			= new Pagination();
$lc		 		= new Location();

$dateUtil      	= new DateUtil();
$error 			= new Error();

$utility		= new Utility();
$uMesg 			= new MesgUtility();

///////////////////////////////////////////////////////////////////////////

//declare vars
$typeM		= $utility->returnGetVar('typeM','');

$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',20);

if($numResDisplay == 0)
{
	$numResDisplay = 20;
}


if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	
	
	$keyword			= $utility->returnGetVar('keyword','');
	$numResDisplay		= $utility->returnGetVar('numResDisplay',10);
	$cId				= $utility->returnGetVar('cId',0);
	

	
	$cntVar		= "&cId=".$cId;
	$numVar		= "&numResDisplay=".$numResDisplay;
	$keyVar		= "&keyword=".$keyword;
	$srchVar	= "&btnSearch=Search";
	

	$mode 		= '';
	$type 		= '';
	
	$link =	$keyVar.$cntVar.$numVar.$srchVar;//$genVar.$occVar.
	
	
	$noOfTown = $search->searchTown($keyword);
	
}
else
{
	$link 		= '';
	$noOfTown	= $lc->getTownId(0, '');
}


//add town
if(isset($_POST['btnAddTown']))
{
	$txtName 		= $_POST['txtName'];
	$txtDesc 		= $_POST['txtDesc'];
	$txtProvinceId 	= (int)$_POST['txtProvinceId'];
	
	
	//hold in session
	$sess_arr = array('txtName', 'txtDesc','txtProvinceId');
	$utility->addPostSessArr($sess_arr);
	
	//check duplicate town
	$duplicate = $error->duplicateChild($txtProvinceId, 'province_id', $txtName, 'town_name', 'town');
	
	
	if($txtProvinceId == 0)
	{
		$msg = "&msg=Error: province is empty#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town".$page->getLink().$msg);
	}
	else if($txtName == '')
	{
		$msg = "&msg=Error: town name is empty#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town".$page->getLink().$msg);
	}
	else if(($txtProvinceId > 0) && (ereg("^ER",$duplicate)))
	{
		$msg = "&msg=Error: town already exist#addt";
		header("Location:".$_SERVER['PHP_SELF']."?action=add_town".$page->getLink().$msg);
	}
	else
	{
		//add town
		$t_id = $lc->addTown($txtProvinceId, $txtName, $txtDesc);
		
		
		//add images if exist
		if($_FILES['fileImg']['name'] != '')
		{
			$utility->fileUpload($_FILES['fileImg'], 'T' ,'../images/location/', $t_id, 'town_image', 'town_id', 'town');
		}
		
		//remove session vars
		$utility->delSessArr($sess_arr);
		
		//forwarding
		$msg = "&msg=Success !!! town added successfully&typeM=SUCCESS";
		header("Location:".$_SERVER['PHP_SELF']."?".$msg.$page->getLink());
	}
	
}//eof add town

/* 	ACTION ON PRESSING BUTTON CANCEL */
if(isset($_POST['btnCancel']))
{
	$sess_arr = array('txtName','txtDesc','txtProvinceId','c_Id');
	$utility->delSessArr($sess_arr);
	
	header("Location: ".$_SERVER['PHP_SELF']);
}

/*START PAGINATION*/

$total 			= count($noOfTown);
$pageArray 		= array_chunk($noOfTown, $numResDisplay);


$newPage 	= array();
$name 		= "Page";
$numPages 	= ceil($total/$numResDisplay);

if(isset($_GET['mypage']))
{
 $myPage = $_GET['mypage'];
}
else
{
	$myPage = 'Array0';
}
//echo "MyPage = ".$myPage;

$arrayNum = explode("Array",$myPage);

$pageNumber = (int)$arrayNum[1];
//echo "Page Number = ".$pageNumber."<br />";

if($total == 0)
{
	$total = (int)$total;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> -  Manage Town</title>
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<script type="text/javascript" src="../js/utility.js"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 

<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 

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


<script language="javascript" type="text/javascript">
//	Create XMLHttp request object to talk to the server 
var request = false;
//xml http object for internet explorer
if(window.ActiveXObject)
{
	try
	{
		request = new ActiveXObject("Msxml2.XMLHTTP");
	}//end of try, start catch
	catch (e)
	{
		try 
		{
			request = new ActiveXObject("Microsoft.XMLHTTP");
		}
		catch(e)
		{
			request = false;
		}
	}//end of catch
}
else
{
	try
	{
		request = new XMLHttpRequest();
	}
	catch(e)
	{
		request = false;
	}
	
	if(!request)
	{
		alert("Error Create request");
	}
}

/**
*	Make a call to the server
*/
function getCountyList()
{
	//Get the field values from the web form
	var txtProvinceId = document.getElementById("txtProvinceId").value;
	//build url to connect to the server
	var url= "county_option.php?txtProvinceId= " + escape(txtProvinceId);
	//open a conenction to the server
	request.open('GET',url,true);
	//set up a function to the server when its done
	request.onreadystatechange = populateCounty;
	//send the request
	request.send(null);
	
}//end of calling server

/**
*	Handle server response
*	Populating county
*/
function populateCounty()
{
	if(request.readyState == 4)
	{
		if(request.status == 200)
		{
			var xmlResponse = request.responseText;//.split("|")
			document.getElementById("countyList").innerHTML = xmlResponse;
		}
		else if(request.status == 404)
		{
			alert("Request page doesn't exist");
		}
		else if(request.status == 403)
		{
			alert("Request page doesn't exist");
		}
		else
		{
			alert("Error: Status Code is " + request.statusText);
		}
	}
	
}//end of updating page

/**ShowLoadingMessage();
*	Loading message

function ShowLoadingMessage()
{
	document.getElementById('loadingMesg').innerHTML = 'Loading ...';
}*/

/**
*	Make a call to the server
*/
function countyAlt()
{
	//Get the field values from the web form
	var c_Id = document.getElementById("c_Id").value;
	//build url to connect to the server
	var url= "county_alternate.php?c_Id= " + escape(c_Id);
	//open a conenction to the server
	request.open('GET',url,true);
	//set up a function to the server when its done
	request.onreadystatechange = altCat;
	//send the request
	request.send(null);
	
}//end of calling server

/**
*	Handle server response
*	Fields for alternate category
*/
function altCat()
{
	if(request.readyState == 4)
	{
		if(request.status == 200)
		{
			var xmlResponse = request.responseText;//.split("|")
			document.getElementById("altCat").innerHTML = xmlResponse;
		}
		else if(request.status == 404)
		{
			alert("Request page doesn't exist");
		}
		else if(request.status == 403)
		{
			alert("Request page doesn't exist");
		}
		else
		{
			alert("Error: Status Code is " + request.statusText);
		}
	}
}//end of updating page
</script>
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
                	<h1>Town / City</h1>
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
                    
                    <div class="cl"></div>
                    
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_town".$page->getLink()."#addt"; ?>">
				   Add Town </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                  
                  <table class="single-column" cellpadding="0" cellspacing="0">
                
				 <?php 
					if(count($noOfTown) == 0)
					{ 
				?>
				<tr align="left" class="orangeLetter">
                  <td height="20" colspan="6"> <?php echo "No town has been found"; ?> </td>
                 </tr>
					<?php 
					}
					else
					{
					?>  
				 
                <thead>
                  <td width="3%" height="20">ID</td>
                  <td width="14%" height="20">Location</td>
                  <td width="24%" height="20">Description</td>
                  <td >Province</td>
                  <td width="13%" height="20">Added On</td>
                  <td width="23%" height="20">Action</td>
                  </thead>
				<?php 
					
					$x = $page->getSerialNum($numResDisplay);
					
					foreach($pageArray[$pageNumber] as $j => $value)
				    {
					    $k = $pageArray[$pageNumber][$j];
						
						$townDetail 	= $lc->getTownData($k);	
											
						$bgColor 		= $utility->getRowColor($x);
				?>
					<tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
					  <td><?php echo $x++; ?></td>
					  <td><?php echo $townDetail[0]; ?></td>
					  <td>
					  	<?php 
							if($townDetail[1] != '')
							{
								echo "<div style='padding:0px 10px 10px 2px;'>".substr($townDetail[1],0,100)."</div>";
							}
							else
							{
								echo "<div class='error'>No description added</div>";
							}
						?> 
					  </td>
					  <td>
					  <?php echo $townDetail[6]; ?>
					  </td>
					  <td  class="pad5 bdrR bdrB">
					  <?php echo $dateUtil->printDate($townDetail[3]); ?>
					  </td>
					  <td>
					
					  [ 
					  <a href="#" 
					  onClick="MM_openBrWindow('town_edit.php?action=town_edit&id=<?php echo $k; ?>','TownEdit','scrollbars=yes,width=700,height=430')">
					  edit
					  </a> ]
					 
					  [ 
					  <a href="#" onClick="MM_openBrWindow('town_delete.php?action=town_delete&id=<?php echo $k; ?>','TownDelete','scrollbars=yes,width=400,height=350')">
					  delete
					  </a> ]
					  
					 
					  
					 
					  </td>
				   </tr>
			  <?php 
					}//end of foreach
			  }//end of else
			  ?>
			 </table>
                  
                  <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <div class="upper-block">Total: <?php echo count($noOfTown);?></div>
                            <div class="lower-block"><?php //$page->getPage($numPages, $link, $pageNumber, $pageArray);?></div>
                          	
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    <?php 
					if(isset($_GET['action']) && ($_GET['action'] == 'add_town')) 
					{	
					?>
                   
                        <h2><a name="addt">Add New Town</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                         <form action="<?php echo $_SERVER['PHP_SELF']."?action=add_town".$page->getLink();?>" 
                          method="post" enctype="multipart/form-data">
                                <label>Select Province</label>
                                <select name="txtProvinceId" class=" textBoxA" id="txtProvinceId">
                                <option value="0">-- Select One --</option>
                                <?php 
                                    if(isset($_SESSION['txtProvinceId']))
                                    {
                                        $utility->populateDropDown($_SESSION['txtProvinceId'], 'province_id', 'province_name', 'province');
                                    }
                                    elseif(isset($_GET['txtProvinceId']) && ((int)$_GET['txtProvinceId'] > 0))
                                    {
                                        $utility->populateDropDown($_GET['txtProvinceId'], 'province_id', 'province_name', 'province');
                                    }
                                    else
                                    {
                                        $utility->populateDropDown('', 'province_id', 'province_name', 'province');
                                    }
                                 ?>
                                 </select>			
                              <div class="cl"></div>
                             
                              <label>Town Name<span class=" orangeLetter">*</span> </label>
                                  <input name="txtName" type="text" class="text_box_large" id="txtName" 
                                  value="<?php if(isset($_SESSION['txtName'])){echo $_SESSION['txtName'];}?>" size="50">
                                                    
                              <div class="cl"></div>
                              
                             
                               <label>Description</label>
                                <textarea  name="txtDesc" class="textAr" id="txtDesc">
                                <?php if(isset($_SESSION['txtDesc'])){echo $_SESSION['txtDesc'];}?></textarea>			
                                <div class="cl"></div>
                               
                             
                                <!--<label>Image</label>
                                <input name="fileImg" type="file" class="text_box_large" id="fileImg" />
                                 <div class="cl"></div>-->
                                 
                              <label>&nbsp;</label>
                                    <input name="btnAddTown" type="submit" class="" id="btnAddTown" value="add" />					
                                    <input name="btnCancel" type="submit" class="" value="cancel" />	
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