<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php");
require_once("../includes/user.inc.php");
require_once("../includes/subscriber.inc.php");

 
require_once("../classes/adminLogin.class.php"); 
include_once("../classes/countries.class.php"); 
include_once("../classes/subscriber.class.php");
require_once("../classes/pagination.class.php"); 

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php");  
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$country		= new Countries();
$subscribe		= new EmailSubscriber();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);
$rootCat = $subscribe->getCategoryId();

if(isset($_POST['btnCreateCat'])) 
{
	
	$cat_name 	= $_POST['txtCatName'];
	$txtCatDesc = $_POST['txtCatDesc'];
	
	//add session
	$sess_arr = array('txtCatName', 'txtCatDesc');
	$utility->addPostSessArr($sess_arr);
	
	//initialize variables
	$action		= 'add_cat';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addCat';
	$typeM		= 'ERROR';
	
	$duplicate = $error->duplicateEntry($cat_name, 'title', 'email_categories', 'NO', '', '');
	
	if($cat_name == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC102, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERSUBSC103, $typeM, $anchor);
	}
	else
	{
		//add the group name
		$catId = $subscribe->addCategory($cat_name, $txtCatDesc);
		
		//delete session
		$utility->delSessArr($sess_arr);
		
		//forward
		//header("Location: ".$url."?action=".$action."&typeM=".$typeM."&msg=".$msg);
		$uMesg->showSuccessT('success', 0, '', $url, SUSUBSC101, 'SUCCESS');
	}
	
}//eof add category


if(isset($_POST['btnRegister']))
{
	//GET THE POST DATA
	$txtEmail		= 	$_POST['txtEmail'];
	$txtFname		= 	$_POST['txtFname'];
	$txtSurname		= 	$_POST['txtSurname'];
	$selCat			= 	(int)$_POST['selCat'];
	$txtPhone		= 	$_POST['txtPhone'];
	$txtCompany		= 	$_POST['txtCompany'];
	
	
	//REGISTERING THE SESSION VARIABLE
	$sess_arr		= array('txtEmail','txtFname','txtSurname','selCat','txtCompany','txtPhone');
	$utility->addPostSessArr($sess_arr);   
	
	//error
	$duplicateId	= $error->duplicateUser($txtEmail, 'email', 'email_subscriber');
	$invalidEmail 	= $error->invalidEmail($txtEmail);
	
	//initialize variables
	$action		= 'add_email';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $_POST['selCat'];
	$id_var		= 'catId';
	$anchor		= 'addCus';
	$typeM		= 'ERROR';
	
	if(ereg('^ER',$invalidEmail))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER002, $typeM, $anchor);
	}
	elseif(ereg("^ER",$duplicateId))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER001, $typeM, $anchor);
	}
	elseif($txtFname == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER003, $typeM, $anchor);
	}
	elseif($txtSurname == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ER004, $typeM, $anchor);
	}
	else
	{
		//add subscriber
		$id = $subscribe->addSubscriber('', $txtEmail, $txtFname,$txtSurname, $selCat, $txtCompany, $txtPhone);
									//($customer_id,$email,$fname,$lname, $category, $company, $phone)
		
		//delete session
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $url, SUSUBSC001, 'SUCCESS');
	}//else
	
}//eof


//cancel
if(isset($_POST['btnCancel']))
{
	//create array
	$sess_arr = array('txtEmail','txtFname','txtSurname','selCat','txtCompany','txtPhone',
					  'txtCatName', 'txtCatDesc');
	//delete session
	$utility->addPostSessArr($sess_arr);
	header("Location: ".$_SERVER['PHP_SELF']);
}

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($rootCat);
	
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
<title><?php echo COMPANY_S; ?> - Email Categories</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen" />

<!-- eof Style -->

<!-- Javascript Libraries -->
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg-settings.js"></script>
<script language="javascript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script>

<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 

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
                	<h1>Group</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	 <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_cat#addCat"; ?>">Add New Group</a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
           <div id="data-column">
             <table class="single-column" cellpadding="0" cellspacing="0">
                <!-- SHOWING ALL CATEGORY AND SUB CATEGORY -->
                <?php 
				$rootCat = $subscribe->getCategoryId();
				if(count($rootCat) == 0)
				{
				?>
                <tr align="left" class="orangeLetter">
                  <td height="20" colspan="4"> None of the group found, create your group to add subscriber </td>
                </tr>
                <?php 
				}
				else
				{
				?>
                <thead>
                  <th width="36%">Group </th>
                  <th width="20%">Member</th>
                  <th width="17%">Added </th>
                  <th width="27%">Action</th>
                </thead>
                <?php
					$i= $pages->getPageSerialNum($numResDisplay);
					$rootCat = array_slice($rootCat, $start, $limit);
					foreach($rootCat as $k)
					{
						$catDetail 	= $subscribe->getCategoryData($k);
						
						$numSubs	= $subscribe->getSubsByCat($k);
						
						$bgColor 	= $utility->getRowColor($i);
				?>
                <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);  ?>>
                  <td ><?php echo $catDetail[0]; ?></td>
                  <td><?php echo "Members (".count($numSubs).")";?></td>
                  <td><?php echo $dateUtil->printDate($catDetail[2]); ?></td>
                  <td> [ <a href="#" 
					  onClick="MM_openBrWindow('email_cat_edit.php?action=edit_cat&id=<?php echo $k; ?>','CatEdit','scrollbars=yes,width=700,height=450')"> edit</a> ]
                    
                    [ <a href="#" onClick="MM_openBrWindow('email_cat_del.php?action=delete_cat&id=<?php echo $k; ?>','CatDelete','scrollbars=yes,width=400,height=350')"> delete</a> ]  	
                    
                    [ <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_email&selCat=".$k."#addCus"; ?>"> add member </a> ] </td>
                </tr>
                <?php 
					$i++;
					}
			  }
			  ?>
            </table>
            
             <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <div class="upper-block">Total Group: <?php echo count($rootCat);?></div>
                           <?php echo $pagination ?>
                        </div>
                   
                </div>
               
                
		 </div>
         
         <!-- Another Table -->
          <tr>
            <td>&nbsp;</td>
          </tr>
          <!-- SHOWING LIST OF PRODUCTS -->
          <tr>
            <td>
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <?php 
				 if(isset($_GET['action']))
				 {
				 	if($_GET['action'] == 'view_prod')
					{
					  $pids = array_merge($product->getProductList($catId, 0, 'only'),$product->getProductList($catId, 0, 'all'));
				
				
				
				if(count($pids) == 0)
				{
				?>
                <tr align="left" class="orangeLetter">
                  <td height="20" colspan="5"> None of the subscriber or user found under this group</td>
                </tr>
                <?php 
				}
				else
				{
					
				?>
                <thead>
                	<th>
                		<h3>Subscriber List </h3>
                    </th>
                </thead>
                <thead>
                  <th width="23%"><strong>Subscriber Name </strong></td>
                  <th width="27%"><strong>Email</strong></td>
                  <th width="13%"><strong>Status</strong></td>
                  <th width="14%"><strong>Added On </strong></td>
                  <th width="23%"><strong>Action</strong></th>
                </thead>
                <?php 
					foreach($pids as $x)
					{
						$prodDetail = $product->showProduct($x);
				?>
                <tr align="left" class="bodyText" onMouseOver="this.bgColor='#f9f9f9';" onMouseOut="this.bgColor='#ffffff';">
                  <td><?php echo $prodDetail[0]; ?></td>
                  <td><?php 
					 	echo $category->categoryPath($prodDetail[13], 'no');
					  /* if(count($category->diplayCategory($k)) > 0)
					  {
					   	echo "<a href='".$_SERVER['PHP_SELF']."?catId=".$k."'>Subcategories(".count($category->diplayCategory($k)).")</a>";
					  }
					  else
					  {
					  	echo "Subcategories(".count($category->diplayCategory($k)).")";
					  } */
					  ?>                  </td>
                  <td>&nbsp;</td>
                  <td><?php echo $dateUtil->printDate($prodDetail[4]); ?></td>
                  <td> [ <a href="#" 
					  onClick="MM_openBrWindow('product_edit.php?action=edit_prod&id=<?php echo $x; ?>','CatEdit','scrollbars=yes,width=720,height=600')"> edit </a> ]
                    
                    [ <a href="#" onClick="MM_openBrWindow('product_delete.php?action=del_prod&id=<?php echo $x; ?>','CatDelete','scrollbars=yes,width=400,height=350')"> delete </a> ] </td>
                </tr>
                <?php 	}//END OF ELSE
					}//END OF FOREACH
				 }//END OF INNER IF
			  }//END OF OUTER IF
			  ?>
            </table>
            
            </td>
          </tr>
                
                
                <!-- eof Display Data -->
               
			  	<!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
			  
					<?php 
                    //CREATING NEW CATEGORY FORM
                    if( (isset($_GET['action'])) && ($_GET['action'] == 'add_cat') )
                    {	
                    ?>
                     <h2><a name="addCat">Add New Group</a></h2>
                     <span>Please note that all the <span class="required">*</span> marked fileds are required</span>       
                      <!-- Form -->
          	     <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                
                    <label> Group Name  <span class="orangeLetter">*</span></label>
                    <input name="txtCatName" type="text" class="text_box_large" id="txtCatName" 
					value="<?php $utility->printSess2('txtCatName', ''); ?>" size="25" />
                      <div class="cl"></div> 
                      
                   <label>Description</label>
                    <textarea  name="txtCatDesc" cols="35" rows="5" class="textAr" id="txtCatDesc">
					<?php $utility->printSess('txtCatDesc'); ?>
					</textarea>                  
                   <div class="cl"></div> 
                   
                  <label>&nbsp;</label>
                  <div class="cl"></div>
                 
                 <label>&nbsp;</label>
                 <input name="btnCreateCat" type="submit" class="button-add" value="create" />
                 <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />                    
                 <div class="cl"></div>
                 
                 <label>&nbsp;</label>
                 <div class="cl"></div>
                 
                 <label>&nbsp;</label>
              
                 </form>   
			  <?php 
                }
              ?>
              
               <!-- Form 2 -->
                <div class="webform-area">

                    <?php 
					if(isset($_GET['action']) && ($_GET['action'] == 'add_email')) 
					{	
					?>
                   
                        <h2><a name="addUser">Add New User</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
         		
                <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post" name="formRegister" id="formRegister">
                <!-- ACCOUNT DETAIL -->
                
              	<label> Email <span class="orangeLetter">*</span></label>
                <input name="txtEmail" type="text" class="text_box_large" id="txtEmail" size="25" title="email"
			    value="<?php $utility->printSess2('txtEmail', ''); ?>" />
                <div class="cl"></div>
                
              
                <label>First Name <span class="orangeLetter">*</span></label> 
                <input name="txtFname" type="text" class="text_box_large" 
				id="txtFname" size="25" title="First Name"
				value="<?php $utility->printSess2('txtFname', ''); ?>" />
                <div class="cl"></div>
            
                <label>Last Name <span class="orangeLetter">*</span></label>
                <input name="txtSurname" type="text" class="text_box_large"
                 id="txtSurname" size="25" title="Last Name"
                 value="<?php $utility->printSess2('txtSurname', ''); ?>" />
                <div class="cl"></div>
              
               <label>Group</label>
                    <select name="selCat" id="selCat" class=" textBoxA">
                      <?php
						if(isset($_GET['selCat']))
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
             
             <label>Company Name</label>
            <input name="txtCompany" type="text" class="text_box_large"
             id="txtCompany" size="25" title="Company Name"
             value="<?php $utility->printSess2('txtCompany', ''); ?>" />
             <div class="cl"></div>
             
             <label>Phone Number</label>
             <input name="txtPhone" type="text" class="text_box_large"
             id="txtPhone" size="25" title="Phone Number"
             value="<?php $utility->printSess2('txtPhone', ''); ?>" />
              <div class="cl"></div>
              
			<label>&nbsp;</label>
            <div class="cl"></div>
             
             <label>&nbsp;</label>
            <input name="btnRegister" type="submit" class="button-add" id="btnRegister" value="add" />
            <input name="btnCancel" type="submit" class="button-add" id="btnCancel" value="Cancel" />

            </form>
		<?php 
        }
        ?>
                    
                     
                </div>
                <div class="cl"></div>
                <!-- eof Form 2 --> 
              
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
