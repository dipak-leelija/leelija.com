<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php"); 
require_once("../includes/email.inc.php");
require_once("../includes/autoresponder.inc.php"); 
require_once("../includes/front_content.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/email.class.php"); 
require_once("../classes/pagination.class.php");

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityNum.class.php"); 
require_once("../classes/utilityImage.class.php");



//instantiate classes
$adminLogin 	= new adminLogin();
$email			= new Email();
$pages			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$numUtility		= new NumUtility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


################################################################################################

//declare variables
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay		= (int)$utility->returnGetVar('numResDisplay',10);
$autoResTypeId = $email->getAutoResponderTypeId();

if(isset($_POST['btnAddAutoRes'])) 
{
	$txtEmailSub 	= $_POST['txtEmailSub'];
	$selConType 	= $_POST['selConType'];
	$txtDesc 		= $_POST['txtDesc'];
	
	//added Display banner on Jan 5th, 2012
	if(isset($_POST['radioStatus']))
	{
		$radioStatus	= 	$_POST['radioStatus'];
	}
	else
	{
		$radioStatus	= 	'deactive';
	}
//echo "i m here"; exit;
	
	
	//registering the post session variables 
	$sess_arr	= array('txtEmailSub', 'txtDesc', 'selConType');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_autoresponder';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addAutoresponder';
	$typeM		= 'ERROR';
	
	//error check
	if($txtEmailSub == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, EREAUTO001, $typeM, $anchor);
	}
	elseif($selConType == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, EREAUTO002, $typeM, $anchor);
	}

	elseif($txtDesc == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, EREAUTO003, $typeM, $anchor);
	}
	else
	{
		//add autorespoder
		$autoRes = $email->addAutoRespoder('All', $txtEmailSub, $selConType,  $txtDesc, 'immediately', date("Y-m-d H:i:s"), $radioStatus);
		//echo print_r($autoRes);exit;
		
		
		//delete session array
		$utility->delSessArr($sess_arr);
		
		//forwarding
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUAUTORES001, 'SUCCESS');
	}
	
}//eof


//cancel action
if(isset($_POST['btnCancel']))
{
	//registering the post session variables
	$sess_arr	= array('txtEmailSub', 'txtDesc', 'selConType');
	
	//delete session array
	$utility->delSessArr($sess_arr);
		
	//forward
	header("Location: ".$_SERVER['PHP_SELF']);
}

$link			= "numResDisplay=".$numResDisplay;

/* pagination*/
$adjacents = 3;

$total_pages = count($autoResTypeId);
	
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
<title><?php echo COMPANY_S; ?> -  Auto Responder</title>
<link rel="stylesheet" type="text/css" href="../style/admin/admin.css" />
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { 
  window.open(theURL,winName,features);
}
//-->
</script>
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/package.js"></script>

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
                	<h1>Set Auto Responder</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	    <div class="add-new-option">
                        <a href="javascript:void(0)" 
                        onClick="MM_openBrWindow('auto_responder_type_add.php?action=add_autoresponder_type&autoResType=<?php echo 0; ?>','ImageAdd','status=yes,scrollbars=yes,width=750,height=600')" class="curP">Define Type</a>
                    </div>

                	
                	<div class="add-new-option">
                      <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_autoresponder#addAutoresponder"; ?>">
                      Add Auto Responder
                      </a> 
                    </div>
                    

                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
                     if(isset($_GET['id']))
                     {
                        $autoId = $_GET['id'];
                     }
                     else
                     {
                        $autoId = 0;
                     }

					
                    $autoResTypeId = $email->getAutoResponderTypeId();
					//echo print_r($autoResTypeId);exit;
                    if(count($autoResTypeId) == 0)
                    {
                    ?>
                    <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"><?php echo ERFRONT001; ?></td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                      <thead>
                          <th width="5%">#</td>
                          <td width="15%">Title</td>
                          <td width="15%">Responder Code</td>
                          <td width="15%">Autorespoder</td>
                          <td width="20%">Description</td>
                          <td width="10%">Created On </td>
                          <td width="20%" align="center">Action</td>
                      </thead>
                        
                      <?php 
                        $i= $pages->getPageSerialNum($numResDisplay);
					    $autoResTypeId = array_slice($autoResTypeId, $start, $limit);
                        foreach($autoResTypeId as $k)
                        {
							//echo $k;exit;
							$autoResTypeDetail 	= $email->getAutoResponderTypeData($k);
							$bgColor 		= $utility->getRowColor($i);
                      ?>
					<tr align="left" <?php $utility->printRowColor($bgColor);  ?>>
					  <td align="center"><?php echo $i++; ?></td>
                      <td><?php echo $autoResTypeDetail[0]; ?> </td>
                      <td><?php echo $autoResTypeDetail[1];?> </td>
					  <td> 
                      <?php 
					 $total	= count($numUtility->getPrimByFk($k, 'email_autoresponder_id', 'email_autoresponder_type_id', 'email_autoresponder'));
					 // $total = count($email->getAutoresponderList($k, 'all'));
					  //echo print_r($total);exit; 
                      if( $total > 0)
					  {
					  	echo "<a href='".$_SERVER['PHP_SELF']."?action=view_autoid&autoId=".$k."'>Autoresponder (".$total.")</a>";
					  }
					  else
					  {
					  	echo "<a href='".$_SERVER['PHP_SELF']."?action=view_autoid&autoId=".$k."'>Autoresponder (0)</a>";
					  }
					  ?>
                      </td>
					  <td align="left">
						  <?php echo $autoResTypeDetail[2];?>
					  </td>					  
					  <td>
					  	<?php echo $dateUtil->printDate($autoResTypeDetail[4]); ?>
					  </td>
					  
					  <td align="center">
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('auto_responder_type_edit.php?action=edit_auto_responder_type&id=<?php echo $k; ?>','autoResponderEdit','scrollbars=yes,width=800,height=450')">
					  edit
					  </a> ]
					 
					  [ 
					  <a href="#" onClick="MM_openBrWindow('auto_responder_type_delete.php?action=delete_auto_responder_type&id=<?php echo $k; ?>','autoResponderDelete','scrollbars=yes,width=400,height=350')">
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
                            <div class="upper-block">Total Auto Responder: <?php echo count($autoResTypeId);?></div>
                           <?php echo $pagination ?>
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
      			<!-- display autoresponder data --> 
                <div id="data-column">
                <tr>
              <td>
			   
                
				
				 <?php 
				 if( (isset($_GET['action']))  && ($_GET['action'] == 'view_autoid') )
				 {
					 //get all autoresponder type id
					 $allAutoTypeId	= $utility->getAllId('email_autoresponder_type_id','email_autoresponder');
					 //echo print_r($allAutoTypeId);exit;
					 
					 if( (isset($_GET['autoId']))  && (in_array($_GET['autoId'],$allAutoTypeId)) )
					 {
					 	
				?>
                        <div class="padT10 padB10" align="left"> <h4>Autoresponder Data</h4></div>
                        <table class="single-column" cellpadding="0" cellspacing="0">
                        <?php 
                         
                        //get all autoresponder id based on it's type id
                        $allAutoResIdByType = $numUtility->getPrimByFk($_GET['autoId'], 'email_autoresponder_id', 
                                                                       'email_autoresponder_type_id', 'email_autoresponder');
                        
                        if(count($allAutoResIdByType) == 0)
                        {
                        
                        ?>
                            <tr align="left" class="orangeLetter">
                              <td height="20" colspan="8"> 
                                <?php echo ERFRONT001; ?>                  
                              </td>
                            </tr>
                        <?php 
                        }
                        else
                        {
                            
                        ?>  
                         
                        <thead>
                          <td width="6%">No.</td>
                          <td width="23%">Send to</td>
                          <td width="18%">Email Subject</td>
                          <td width="15%">Message</td>
                          <td width="11%">Status</td>
                          <td width="10%">Added On </td>
                          <td width="17%">Action</td>
                        </thead>
                        <?php
                            $z	= 1;
                             
                            foreach($allAutoResIdByType as $x)
                            {
                                $autoResDetail 	= $email->getAutoResponderData($x);
                                $bgColor 		= $utility->getRowColor($z);
                                    
                                //$prodDetail = $product->showProduct($x);
                                //$bgColor 	= $utility->getRowColor($z);
                        ?>
                            <tr align="left" <?php $utility->printRowColor($bgColor);?>>
                              <td><?php echo $z++; ?></td>
                              <td><?php echo $autoResDetail[0]; ?></td>
                              <td><?php echo $autoResDetail[1]; ?></td>
                              <td><?php echo $autoResDetail[3]; ?></td>
                              <td><?php echo $autoResDetail[6]; ?>
                             </td>
                              <td><?php echo $dateUtil->printDate($autoResDetail[7]); ?></td>
                              <td align="center">
                              [ 
                                <a href="javascript:void(0)" 
                              onClick="MM_openBrWindow('auto_responder_edit.php?action=edit_auto_responder&id=<?php echo $x; ?>','autoResponderEdit','scrollbars=yes,width=780,height=600')">
                              edit					  </a> ]
                             
                              [ 
                              <a href="javascript:void(0)" onClick="MM_openBrWindow('auto_responder_delete.php?action=delete_auto_responder&id=<?php echo $x; ?>','autoResponderDelete','scrollbars=yes,width=400,height=350')">
                              delete					  </a> ]                      </td>
                            </tr>
                      <?php 	
                                $i++;
                                
                                }//END OF ELSE
                            }//END OF FOREACH
                        ?>
                         </table>
				<?php 
					 }
			  	}//if
			  	?>
			  
             </td>
            </tr>
            </div>
                <!-- eof display autoresponder data-->
                <!-- Form -->
                <div class="webform-area">
                        <!-- show message -->
                        <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                            
                        <!-- Add new image -->
                        <?php 
                        if(isset($_GET['action']) && ($_GET['action'] == 'add_autoresponder'))
                        {
                        ?>
                   
                    <h2><a name="addAutoresponder">Add Auto Responder</a></h2>
                    <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                      <form action="<?php $_SERVER['PHP_SELF']?>" method="post" 
                      enctype="multipart/form-data">
                      
                            <label>Email Subject<span class="orangeLetter">*</span></label>
                            <input name="txtEmailSub" type="text" class="text_box_large" id="txtEmailSub" 
                            value="<?php $utility->printSess('txtEmailSub'); ?>" size="25" />
                            <div class="cl"></div>


                          <label>Select Constant Type</label>
                          <select name="selConType" id="selConType" class="textBoxA"  >
                            <option value="0">-- Select One --</option>
                            <?php 
                                if(isset($_SESSION['selConType']))
                                {
                                    $utility->populateDropDown($_SESSION['selConType'],'email_autoresponder_type_id',
                                                              'constant_code','email_autoresonder_type'); 
                                }
                                else if(isset($_GET['selConType']))
                                {
                                    $utility->populateDropDown($_GET['selConType'],'email_autoresponder_type_id',
                                                               'constant_code','email_autoresonder_type');
                                }
                                else
                                {
                                    $utility->populateDropDown(0,'email_autoresponder_type_id','constant_code',
                                                               'email_autoresonder_type');
                                }
                                
                            ?>
                          </select>
                          <div class="cl"></div>


                         
                            <label>Message</label><!--cols="50" rows="8" wrap="physical"-->
                            <textarea name="txtDesc"  class="textAr" 
                            id="txtDesc"><?php $utility->printSess('txtDesc'); ?></textarea>
                            <div class="cl"></div>
                            
                            <label>Status</label>
                            <input name="radioStatus" type="radio" value="active" title="Active" class="radio" id="radioStatus"
                            <?php echo $utility->checkSessStr('radioStatus','active', '');?>>
                            <label class="radio">Active</label>
                            
                            <input name="radioStatus" type="radio" value="deactive" title="Deactive" class="radio" id="radioStatus"
                            <?php echo $utility->checkSessStr('radioStatus','deactive', '');?>>
                            <label class="radio">Deactive</label>
                            
                            <div class="cl"></div>

                                                      
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <div class="cl"></div>
                            
                            <label>&nbsp;</label>
                            <input name="btnAddAutoRes" type="submit" class="button-add" 
                            id="btnAddAutoRes" value="create" />
                            <input name="btnCancel" type="submit" class="button-cancel" onClick="self.close()" value="cancel" />
							<div class="cl"></div>

                            <label>&nbsp;</label>
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
