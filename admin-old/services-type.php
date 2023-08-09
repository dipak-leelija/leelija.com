<?php 
session_start();
include_once('checkSession.php');
// require_once("../_config/connect.php");
require_once ("../_config/dbconnect.php");
require_once "../_config/dbconnect.trait.php";

 
require_once("../includes/constant.inc.php"); 
require_once("../includes/category.inc.php");

require_once("../classes/location.class.php");     
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/services.class.php"); 
require_once("../classes/utility.class.php");   
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$service		= new Services();
$lc		 		= new Location();
$search_obj		= new Search();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum			= new NumUtility();

#######################################################################################
//declare vars
$typeM				= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);
$serTypeId 			= $service->ShowServicesCatData();
// print_r($_SESSION['adminuser']);exit;

if(isset($_POST['btnCreateCat'])) 
{
	$parent_id 		= trim($_POST['txtParentId']);
	$cat_name 		= trim($_POST['txtCatName']);
	$txtURL 		= trim($_POST['txtURL']);
	$txtBrief 		= trim($_POST['txtBrief']);
	$txtPageTitle 	= trim($_POST['txtPageTitle']);
	$txtDesc 		= trim($_POST['txtDesc']);
	$file  			= $_FILES['fileCatImg'];
	
	//register session
	$sess_arr	= array('txtParentId', 'txtCatName', 'txtURL', 'txtBrief', 'txtDesc', 'txtPageTitle');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$typeM		= 'ERROR'; 
	$anchor		= 'addCat';
	
	$duplicate = $error->duplicateCat($parent_id, $cat_name,0, 'static_categories');
	
	if($cat_name == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT202, $typeM, $aname);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERCAT201, $typeM, $aname);
	}
	else
	{
		//add the category
		$catId = $category->createCategory( $parent_id, $cat_name, $txtURL, $txtBrief, $txtPageTitle, $txtDesc, 
											$numOrder, 'static_categories');
		
		if($_FILES['fileCatImg']['name'] != '')
		{
			$newName = $utility->getNewName2($_FILES['fileCatImg'], 'STATCAT',$catId,$cat_name);
				
			$uImg->imgUpdResize($_FILES['fileCatImg'], 'STATCAT', $newName, 
								'../images/category/', 200, 200, $catId,
					 			'categories_image', 'categories_id', 'static_categories');	   
		}
		
		//delete session value
		$utility->delSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', $id, $id_var, $_SERVER['PHP_SELF'], SUCAT201, 'SUCCESS');
		
	}
	
}//eof



//cancel
if(isset($_POST['btnCancel']))
{
	$sess_arr	= array('txtParentId', 'txtCatName', 'txtURL', 'txtBrief', 'txtPageTitle', 'txtDesc');
	$utility->delSessArr($sess_arr);
	header("Location: ".$_SERVER['PHP_SELF']);
}


$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($serTypeId);
	
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
<title><?php echo COMPANY_S; ?> - Services Category</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
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
<script type="text/javascript" src="../js/category.js"></script>

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
                	<h1>Services Types</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_user#addAdmin"; ?>">
                          Add Services Type
                        </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
                    $serTypeId 			= $service->ShowServicesCatData();
					
                    if(count($serTypeId) == 0)
                    {
                    ?>
                    <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"> <?php echo ERADM001; ?> </td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                     
                    <thead>
                      <th width="5%"> </th>
                      <th width="24%">Services Type </th>
                      <th width="18%">Descripton </th>
                      <th width="14%">Added On</th>
                      <th width="23%">Action</th>
                    </thead>
                    <?php 
                        //$i = 1;
						$i= $pages->getPageSerialNum($numResDisplay);
					    $serTypeId = array_slice($serTypeId, $start, $limit);
                        
                        foreach($serTypeId as $k){
							// echo $k['id']; exit;
                            $servTypeDetail = $service->getServiceCatDetail($k['id']);
							// print_r($servTypeDetail);
                            $bgColor 		= $utility->getRowColor($i);
                    ?>
                        <tr align="left" <?php $utility->printRowColor($bgColor);  ?>>
                          <td><?php echo  $i++; ?></td>
                          <td><?php echo $servTypeDetail[1] ?></td>
                          <td><?php echo $servTypeDetail[2]; ?></td>
                          <td><?php echo $servTypeDetail[4]; ?></td>
                          <!-- <td><?php //echo $dateUtil->printDate($userDetail[4]); ?></td> -->
                          
                          <td>
                          [ 
                          <a href="javascript:void(0)" 
                          onClick="MM_openBrWindow('admin_edit.php?action=edit_user&id=<?php echo $k; ?>','AdminEdit','scrollbars=yes,width=500,height=350')">
                          edit					  </a> ]
                         [ 
                          <a href="javascript:void(0)" 
                          onClick="MM_openBrWindow('admin_password.php?action=edit_pass&id=<?php echo $k; ?>','AdminChangePass','scrollbars=yes,width=350,height=300')">
                          password					  </a> ]
                          <?php 
                          	if($_SESSION[ADM_SESS] != $k){
                          ?>
                          [ 
                          <a href="javascript:void(0)" onClick="MM_openBrWindow('admin_delete.php?action=delete_user&id=<?php echo $k; ?>','AdminDelete','scrollbars=yes,width=480,height=350')">
                          delete					  
                          </a> 
                          ]
                          <?php }?>					  
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
                            <div class="upper-block">Total Admin User: <?php echo $_SESSION['adminuser'];?></div>
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
					if(isset($_GET['action']) && ($_GET['action'] == 'add_user')) 
					{	
					?>
                   
                        <h2><a name="addUser">Add Admin User</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                        	
                            <label>User Name <span class="required">*</span></label>
                            <input name="txtUser" type="text" class="text" id="txtUser" maxlength="32" 
                            value="<?php $utility->printSess2('txtUser',''); ?>"  />
                            <div class="cl"></div>
                            
                            <label>Password <span class="required">*</span></label>
                            <input name="txtPass" type="password" class="text" id="txtPass" 
                             maxlength="16"  />(minimum 6 chars)
                             <div class="cl"></div>
                                
                            <label>Confirm Password <span class="orangeLetter">*</span></label>
                            <input name="txtCnfPass" type="password" class="text" id="txtCnfPass" size="25" />
                            <div class="cl"></div>
                            
                            <label>First Name <span class="orangeLetter">*</span></label>
                            <input name="txtFName" type="text" class="text" id="txtFName"
                            value="<?php $utility->printSess2('txtFName',''); ?>" size="25" />
                            <div class="cl"></div>
                       
                  
                            <label>Surname <span class="orangeLetter">*</span></label>
                            <input name="txtSurname" type="text" class="text_box_large" id="txtSurname"
                            value="<?php $utility->printSess2('txtSurname','');?>" size="25" />
                            <div class="cl"></div>
                            
                            <label>Address <span class="orangeLetter">*</span></label>
                            <input name="txtAddress" type="text" class="text_box_large" id="txtAddress"
                            value="<?php $utility->printSess2('txtAddress',''); ?>" size="25" />
                            <div class="cl"></div>
                            
                            <label>Email <span class="orangeLetter">*</span></label>
                            <input name="txtEmail" type="text" class="text_box_large" id="txtEmail"
                            value="<?php $utility->printSess2('txtEmail',''); ?>" size="25" />
                            <div class="cl"></div>
                            
                            <label>Image</label>
                            <input name="fileImg" type="file" class="text_box_large" id="fileImg" />
                            <span class="menuText">(Best Size 140 X 140 pixels in width by height)</span> 
                            <div class="cl"></div>
                         
                            <input name="btnCreateUser" type="submit" class="button-add"  value="create" />
                           
                            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
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