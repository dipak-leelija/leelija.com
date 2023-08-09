<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/logo.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/Cal_for_action.class.php");  

require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php"); 


/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$calFAct		= new CallForAction();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();


###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');

if(isset($_POST['btnAddLogo'])) 
{
	$txtName	= $_POST['txtName'];
	$txtDesc 	= $_POST['txtDesc'];
	$txtURL		= $_POST['txtURL'];
	
	//registering the post session variables
	$sess_arr	= array('txtName', 'txtDesc','txtURL');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_logo';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addLogo';
	$typeM		= 'ERROR';
	
	
	//check the error
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERLOGOCFA002, $typeM, $anchor);
	}
	elseif($_FILES['fileImg']['name'] == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERLOGOCFA004, $typeM, $anchor);
	}
	else
	{
		//add logo
		$logoId = $calFAct->addCallForAction($txtName, $txtDesc, $txtURL);
		
		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{
			//rename the image
			$newName  = $utility->getNewName4($_FILES['fileImg'], '',  $logoId);
								
			//crop and resize
			$utility-> fileUpload2($_FILES['fileImg'], '' , $newName, '../images/upload/logo/', $logoId, 'cal_for_action', 'call_for_action_id', 'call_for_action');
			
					 
		}
		
		//deleting the sessions
		$sess_arr	= array('txtName','txtDesc','txtURL');
		$utility->delSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SULOGOCFA001, 'SUCCESS');
	}
	
}//eof


//cancel button
if(isset($_POST['btnCancel']))
{
	//delete session
	$sess_arr	= array('txtName', 'txtDesc','txtURL');
	$utility->delSessArr($sess_arr);
		
	header("Location: ".$_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?>-  Logo or Call for Action Management</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<script language="JavaScript" type="text/JavaScript">
<!--
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
//-->
</script>
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<logo rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</LOGOCFA>
<SCRIPT type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112">
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
                	<h1>Call for Action Management </h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                        <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_logo#addLogo"; ?>">
                          Add New Call for Action
                        </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                    
                    <?php 
                    $numLogo   = $calFAct->getCallForActionId();
                    if(count($numLogo) == 0)
                    {
                    ?>                    
                	<tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"> <?php echo ERSPAN.ERLOGOCFA001.ENDSPAN;?></td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                     
                      <thead>
                      <th width="3%" align="center">#</th>
                      <th width="22%">Title</th>
                      <th width="20%">Image</th>
                      <th width="24%">URL</th>
                      <th width="12%">Added On </th>
                      <th width="19%" align="center">Action</th>
                      </tr>
                      
 				<?php 
					$i=1;
					foreach($numLogo as $k)
					{
						//get the logo detail
						$logoDtl 		= $calFAct->getCallForActionData($k);
						
						//get the row background color
						$bgColor 	= $utility->getRowColor($i);
				?>
					<tr align="left"<?php $utility->printRowColor($bgColor);?>>
					  <td align="center"><?php echo $i++; ?></td>
					  <td><?php echo $logoDtl[0]; ?></td>
					  <td>
                      	<?php 
						$utility->imgDisplay('../images/static/call-to-action/', $logoDtl[3],  150, 60, 0, 'greyBorder', $logoDtl[0], " ");
						?>
                      </td>
					  <td>
					  	<?php 
							echo "<a href='".$logoDtl[2]."' target='_blank' 
								 title='".$logoDtl[0]."'>".$logoDtl[2]."</a>"; 
						?>
                      </td>
					  <td>
					  	<?php echo $dateUtil->printDate($logoDtl[4]); ?>
                      </td>
					  <td align="center">
					  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('cal_for_action_edit.php?action=edit&amp;id=<?php echo $k; ?>','LogoEdit','scrollbars=yes,width=650,height=500')">
					  edit					  </a> ]
					 [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('cal_for_action_delete.php?action=delete&amp;id=<?php echo $k; ?>','LogoDelete','scrollbars=yes,width=450,height=300')">
					  delete					  
                      </a> ]
					</td>
				    </tr>
                  <?php 
                       
                        }
                  }
                  ?>
                  
                  </table>
                  
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
						<?php 
                        if( (isset($_GET['action'])) && ($_GET['action'] == 'add_logo') )
                        {
                        ?>
                   
                        <h2><a name="addLogo">Call for Action</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                          
                            
                            <label>   Title <span class="orangeLetter">*</span></label>
                            <input name="txtName" type="text" id="txtName" class="text_box_large"
                            value="<?php  $utility->printSess('txtName'); ?>" />
                            <div class="cl"></div> 
                          
                            <label>Description</label>
                            <textarea  name="txtDesc" cols="30" rows="5" id="txtDesc" class="textAr">
                            <?php  $utility->printSess('txtDesc'); ?>
                            </textarea>
                            <div class="cl"></div>
                            
                          
                            <label>&nbsp;</label>
                            <label>&nbsp;</label>
                            <div class="cl"></div>
                            
                          
                            
                            <label> URL <span class="orangeLetter">*</span></label>
                            <input name="txtURL" type="text" id="txtURL" class="text_box_large"
                            value="<?php  $utility->printSess2('txtURL', "http://");?>" />
                            <div class="cl"></div>
                          
                            <label>Call for Action Image</label>
                            <input name="fileImg" type="file" id="fileImg" class="text_box_large" />
                            <div class="cl"></div>
                         
                           <label>&nbsp;</label>
                           <label>&nbsp;</label>
                           <div class="cl"></div>
                          
                            <label>&nbsp;</label>
                            <input name="btnAddLogo" id="btnAddLogo" type="submit" class="button-add" 
                            value="add" />
                            <input name="btnCancel" id="btnCancel" type="submit" class="button-cancel" 
                            value="cancel" />					
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