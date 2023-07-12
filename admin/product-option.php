<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");

require_once("../includes/constant.inc.php"); 
require_once("../includes/category.inc.php");
require_once("../includes/product.inc.php");
require_once("../includes/product_attribute.inc.php");
 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/tax.class.php"); 
require_once("../classes/product.class.php");
require_once("../classes/product_attribute.class.php");

require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

//instantiate classes
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$prodAttr		= new Cat();
$product		= new Product();
$prodAttr		= new ProductAttribute();
$tax			= new Tax();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$optId		= $utility->returnGetVar('optId','');


//get all option ids
$optIds		= $prodAttr->getOptionId();

if(isset($_POST['btnAddOpt'])) 
{
	//get vars
	$txtOptName 	= trim($_POST['txtOptName']);
	
	
	//register session
	$sess_arr	= array('txtOptName');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_opt';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$typeM		= 'ERROR'; 
	$anchor		= 'addOpt';
	
	//check for duplicate val
	$duplicate = $error->duplicateEntry($txtOptName, "product_option_name", "products_options", "NO", "", "");
	
	
	if($txtOptName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR002, $typeM, $anchor);
	}
	elseif(preg_match("/^ER/",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR003, $typeM, $anchor);
	}
	else
	{
		//add option
		$optId = $prodAttr->addOption($txtOptName);
		
		/*//add image
		if($_FILES['fileCatImg']['name'] != '')
		{
			$newName = $utility->getNewName4($_FILES['fileCatImg'], '', $optId);
				
			$uImg->imgUpdResize($_FILES['fileCatImg'], '', $newName, 
								   '../images/category/', 150, 113, $optId,
					 			   'categories_image', 'categories_id', 'categories');	   
		}*/
		
		//delete session value
		$utility->delSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', $id, $id_var, $_SERVER['PHP_SELF'], SUPRODATTR101, 'SUCCESS');
	
	}
	
}//eof


//add new option value
if(isset($_POST['btnAddOptVal']))
{
	//get the vars
	$txtOptId			= $_POST['txtOptId'];
	$txtOptValName 		= trim($_POST['txtOptValName']);
	
	//registering the post session variables
	$sess_arr	= array('optId','txtOptValName');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_opt_val';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $txtOptId;
	$id_var		= 'optId';
	$anchor		= 'addOptVal';
	$typeM		= 'ERROR';
	
	//check for duplicate entry
	$duplicate = $error->duplicateEntry($txtOptValName, "product_option_value_name", "product_option_value", "NO", "", "");
	
	$msg = '';
	
	
	if($txtOptValName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR102, $typeM, $anchor);
	}
	elseif(preg_match("/^ER/",$duplicate))
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERPRODATTR103, $typeM, $anchor);
	}
	else
	{
	
		//add the option value
		$optValId	= $prodAttr->addOptionVal($txtOptValName);
		
		//add to option to value
		$optToValId	= $prodAttr->addOptionToVal($txtOptId, $optValId);
		
		/*//add the product image
		if($_FILES['fileProdImg']['name'] != '')
		{
			//rename the image 
			$newName = $utility->getNewName4($_FILES['fileProdImg'], '',$productId);
			
			
			//product large image	
			$uImg->imgUpdResize($_FILES['fileProdImg'],'',$newName,'../images/product/', 
								 600, 600, $productId, 'product_image', 'product_id', 'products');
								 
		}*/					 
		
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);
		
		
		//forward the web page
		$uMesg->showSuccessT('view_opt_val', $optId, 'optId', $_SERVER['PHP_SELF'], SUPRODATTR101, 'SUCCESS');
	}
	
}//eof



//cancel
if(isset($_POST['btnCancel']))
{
	//hold in session array
	$sess_arr	= array('txtOptId', 'txtOptName','txtOptValName',);
	
	//delete the session
	$utility->delSessArr($sess_arr);
	
	header("Location: ".$_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Admin Users</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
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
                	<h1>Product  Option</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_opt#addOpt"; ?>">
					  		Add  Option				  
					  	</a>
                    </div>
                    
                    <?php /*?><div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_opt_val#addOptVal"; ?>">
					  		Add Option Value				  
					  	</a>
                    </div><?php */?>
                    <div class="orangeLetter"> 
				   <?php 
					  //Generating bread crumb
					  if(isset($_GET['optId']))
					  {
						 $myOptId = $_GET['optId'];	
						 $parentPath = "<a href='".$_SERVER['PHP_SELF']."'>Product Option Home</a> ". "> ";
						 echo "<span class=\"orangeLetter \">".$parentPath.$prodAttr->getProdOptName($optId)."<span>"; 	
					  } 
				   ?>
					</div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
                        <!-- display option -->
                        <?php 
                        //number of options
                        $numOpt   = $prodAttr->getOptionId();
                        
                        if(count($numOpt) == 0)
                        {
                        ?>
                        <tr align="left" class="orangeLetter">
                          <td height="20" colspan="5"> <?php echo ERPRODATTR001; ?></td>
                         </tr>
                        <?php 
                        }
                        else
                        {
                        ?>  
                         
                        <thead>
                          <th width="6%">No.</th>
                          <th width="30%">Option Name</th>
                          <th width="26%">Option Value(s)</th>
                          <th width="15%">Created On </th>
                          <th width="23%">Action</th>
                        </thead>
                        <?php 
                            $i= 1;
                            
                            foreach($numOpt as $k)
                            {
                                //get option detail
                                $optDetail 	= $prodAttr->getOptionData($k);
                                
                                //get the option values
                                $optValIds	= $prodAttr->getOptionValId($k);
                                
                                //get teh background row color
                                $bgColor   	= $utility->getRowColor($i);
                        ?>
                            <tr<?php $utility->printRowColor($bgColor);?>>
                              <td><?php echo $i; ?></td>
                              <td><?php echo $optDetail[0]; ?></td>
                              <td>
                              <?php
                              if(count($optValIds) == 1) 
                              {
                                echo "<a href='".$_SERVER['PHP_SELF']."?action=view_opt_val&optId=".$k."'>Option Value(".count($optValIds).")</a>";
                              }
                              else if(count($optValIds) > 1)
                              {
                                echo "<a href='".$_SERVER['PHP_SELF']."?action=view_opt_val&optId=".$k."'>Option Values(".count($optValIds).")</a>";
                              }
                              else
                              {
                                echo "Option Value(".count($optValIds).")";
                              }
                              ?></td>
                              <td>
                                <?php echo $dateUtil->printDate($optDetail[2]); ?>					  
                              </td>
                              <td>
                              [ 
                              <a href="javascript:void(0)" 
                              onClick="MM_openBrWindow('product_option_edit.php?action=edit_opt&opt_id=<?php echo $k; ?>','OptEdit','scrollbars=yes,width=400,height=350')">
                              edit					  
                              </a> ]
                             
                              [ 
                              <a href="javascript:void(0)" onClick="MM_openBrWindow('product_option_delete.php?action=delete_opt&opt_id=<?php echo $k; ?>','OptDelete','scrollbars=yes,width=400,height=350')">
                              delete					  
                              </a> ]  	
                              
                              [ 
                            
                              <a href="<?php echo $_SERVER['PHP_SELF']."?action=add_opt_val&optId=".$k."#addOptVal"; ?>">
                              add option value					  
                              </a> ]					  
                              </td>
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
                            <div class="upper-block">Total Product Option: <?php echo count($numOpt);?></div>
                           <?php /*?> <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div><?php */?>
                        </div>
                   
                  </div>
                  
                   <?php 
					if( (isset($_GET['action']))  && ($_GET['action'] == 'view_opt_val') )
				 	{
					?>
                   
                        <table class="single-column" cellpadding="0" cellspacing="0">
                
							<?php 
                            
                            //get the option value ids
                            $ovIds	= $prodAttr->getOptionValId($optId);;
                            
                                
                            if(count($ovIds) == 0)
                            {
                            ?>
                            <tr align="left" class="orangeLetter">
                              <td height="20" colspan="5"> <?php echo ERPRODATTR101; ?></td>  
                            </tr>
                            <?php 
                            }
                            else
                            {
                                
                            ?>  
                             
                            <thead>
                              <td width="6%">No.</td>
                              <td width="56%">Option Value Name</td>
                              <td width="15%">Added On </td>
                              <td width="23%">Action</td>
                            </thead>
                            <?php
                                $z	= 1;
                                 
                                foreach($ovIds as $x)
                                {
                                    //get option value detail
                                    $optValDetail 	= $prodAttr->getOptionValData($x);
                                    
                                    //get the back color
                                    $bgColor 		= $utility->getRowColor($z);
                            ?>
                                <tr<?php $utility->printRowColor($bgColor);?>>
                                  <td><?php echo $z; ?></td>
                                  <td><?php echo $optValDetail[0]; ?></td>
                                  <td><?php echo $dateUtil->printDate($optValDetail[2]); ?></td>
                                  <td>
                                  [ 
                                    <a href="javascript:void(0)" 
                                  onClick="MM_openBrWindow('product_option_val_edit.php?action=edit_opt_val&opt_val_id=<?php echo $x; ?>','OptValEdit','scrollbars=yes,width=460,height=350')">
                                  edit					  </a> ]
                                 
                                  [ 
                                  <a href="javascript:void(0)" onClick="MM_openBrWindow('product_option_val_delete.php?action=delete_opt_val&opt_val_id=<?php echo $x; ?>','OptValDelete','scrollbars=yes,width=400,height=350')">
                                  delete					  </a> ]                      </td>
                                </tr>
                          <?php 	
                                    $z++;
                                    
                                    }//else
                                }//foreach
                            ?>
                             </table>
                        <div class="first-column">
                 
                            <!-- Bottom Pagination-->
                            <div class="pagination-bottom">
                                <div class="upper-block">Total Product Option Value: <?php echo count($ovIds);?></div>
                               <?php /*?> <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div><?php */?>
                            </div>
                   
                  		</div>
                        
                    <?php 
					}
					?>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    <?php 
					if( (isset($_GET['action'])) && ($_GET['action'] == 'add_opt') )
					{
					?>
                   
                        <h2><a name="addOpt">Add New Option</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            
                            <label>Option Name <span class="orangeLetter">*</span> </label>
                            <input name="txtOptName" type="text" id="txtOptName" size="25" 
                            value="<?php $utility->printSess2('txtOptName',''); ?>" />
                            <div class="cl"></div>
                        
                            <input name="btnAddOpt" id="btnAddOpt" type="submit" class="buttonYellow" value="add" />
                            <input name="btnCancel" type="submit" class="buttonYellow" value="cancel" />
                            <div class="cl"></div>
                            
                        </form>
                    
                    <?php 
					}
					?>
                    
                    <!-- add new option value -->
					<?php 
                    
                    if( (isset($_GET['action'])) && ($_GET['action'] == 'add_opt_val') && (in_array($_GET['optId'],$optIds)) )
                    {
                            
                    ?>
                    	<h2><a name="addOptVal">Add New Option Value</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        
                        <form action="<?php $_SERVER['PHP_SELF']?>?optId=<?php echo $_GET['optId']; ?>" method="post" 
                        enctype="multipart/form-data" name="formAddProd" id="formAddProd">
                            
                            <label>Option </label>
                            <?php 
						  	//Generating bread crumb
						  	if(isset($_GET['optId']))
						  	{
								 $myOptId = $_GET['optId'];	
								 $parentPath = "<a href='".$_SERVER['PHP_SELF']."'>Product Option Home</a> ". ">";
								 echo "<span class=\"orangeLetter \">".$prodAttr->getProdOptName($optId)."<span>"; 	
						  	} 
						 	?>
                            <div class="cl"></div>
                                
                            <!-- start value -->
                            <label><h4>Value Section</h4> </label>
                            <div class="cl"></div>
                              
                            <label>Value Name <span class="orangeLetter">*</span> </label>
                            <input name="txtOptValName" type="text" class="text_box_large" id="txtOptValName" 
                            value="<?php $utility->printSess2('txtOptValName',''); ?>" size="25" />
                            <div class="cl"></div>
                              
                            <input name="txtOptId" type="hidden" value="<?php echo $_GET['optId']; ?>"> <div class="cl"></div>
                             
                            <input name="btnAddOptVal" type="submit" class="button-add" id="btnAddOptVal" value="add" />
                            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
                            <div class="cl"></div>					
                           
                        </form>
                        
			 
					<?php 
                    }
                    ?>
                        
                    <!--eof add new option value -->
                    
                     
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