<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../includes/constant.inc.php");
require_once("../includes/quote.inc.php");


require_once("../classes/adminLogin.class.php"); 
require_once("../classes/custom_quote.class.php");
require_once("../classes/customer.class.php");
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
$custom_quote	= new CustomQuote();
$customer		= new Customer();
$search_obj		= new Search();
$page			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

###########################################################################################

//declare variables
$typeM			= $utility->returnGetVar('typeM','');
$numOrder		= $uNum->genSortOrderNum('N', 0, 'customer_id', 1, 'customer');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);

if($numResDisplay == 0)
{
	$numResDisplay = 10;
}


//no of customer
if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'Search'))
{
	
	$keyword		= $utility->returnGetVar('keyword','');
	$numResDisplay	= $utility->returnGetVar('numResDisplay',10);
	
	
	$numVar		= "&numResDisplay=".$numResDisplay;
	$keyVar		= "&keyword=".$keyword;
	$srchVar	= "&btnSearch=Search";
	
	$link =	$keyVar.$numVar.$srchVar;
	
	$noOfQuote = $search_obj->searchQuote($keyword);
	
}
else
{
	$link = '';
	$noOfQuote	= $custom_quote->getCustomQuoteIds();
}


if(isset($_POST['btnAddQuote'])) 
{
								
	//hold the post data
	$txtName 				= $_POST['txtName'];
	$txtEmail 				= $_POST['txtEmail'];
	$txtPhone 				= $_POST['txtPhone'];
	$selProdId 				= $_POST['selProdId'];
	$selMaterialId 			= $_POST['selMaterialId'];
	$txtColor 				= $_POST['txtColor'];
	$intQuant 				= $_POST['intQuant'];
	$txtSizeA 				= $_POST['txtSizeA'];
	$txtSizeB 				= $_POST['txtSizeB'];
	$txtSizeC 				= $_POST['txtSizeC'];
	$txtSizeD 				= $_POST['txtSizeD'];
	$selEmbroideryId 		= $_POST['selEmbroideryId'];
	$txtDesc 				= $_POST['txtDesc'];
	
	/*if(isset($_POST['selEmbroideryId']) )
	{
		$selEmbroideryId	= 	$_POST['selEmbroideryId'];
	}
	else
	{
		$selEmbroideryId	= '0';
	}*/
	
	//$file  		= $_FILES['fileImage'];
	
	
	//registering the post session variables
	$sess_arr	= array('selCusId', 'selProdId', 'selMaterialId', 'txtColor', 'intQuant', 'txtSizeA', 'txtSizeB', 
						'txtSizeC', 'txtSizeD', 'selEmbroideryId', 'txtDesc', 'txtName', 'txtEmail', 'txtPhone');
	
	$utility->addPostSessArr($sess_arr);
	
	
	//defining error variables
	$action		= 'add_quote';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addQuote';
	$typeM		= 'ERROR';
	
	
	
	if($selProdId == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE001, $typeM, $anchor);
	}
	elseif($selMaterialId == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE003, $typeM, $anchor);
	}
	elseif($txtColor == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE004, $typeM, $anchor);
	}
	elseif($intQuant == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE005, $typeM, $anchor);
	}
	elseif($txtSizeA == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE006, $typeM, $anchor);
	}
	elseif($txtSizeB == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE007, $typeM, $anchor);
	}
	elseif($txtSizeC == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE008, $typeM, $anchor);
	}
	elseif($txtSizeD == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE009, $typeM, $anchor);
	}
	elseif($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE010, $typeM, $anchor);
	}
	elseif($txtEmail == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERQUOTE011, $typeM, $anchor);
	}
	else
	{
		$customerId	= $utility->getValueByKey($txtEmail,'email','customer_id','customer');
		
		if(( $customerId == '' ) || ($customerId == 0) )
		{	
			$verificationNo	= $customer->generateVerificationCode('VER');
			
			$userPass		= $utility->genRandomPassword('12');
			
			$cus_id= $customer->addCustomer( 1, 1,'', $txtEmail, $userPass, $txtName, '','na', 'a','','','','N','', $numOrder, 
											 $verificationNo, 'Y', 0);
												
			$quote_id	= $custom_quote->addCustomQuote($cus_id, $selProdId, $selMaterialId, $txtColor, $intQuant, $txtSizeA,
														$txtSizeB, $txtSizeC, $txtSizeD, $selEmbroideryId, $txtDesc);
												
			
			
		}
		else
		{
			$quote_id	= $custom_quote->addCustomQuote($customerId, $selProdId, $selMaterialId, $txtColor, $intQuant, $txtSizeA,
														$txtSizeB, $txtSizeC, $txtSizeD, $selEmbroideryId, $txtDesc); 
		}
		
			
		
		if($_FILES['fileImage']['name'] != '')
		{
			//renaming the file
			$newName = $utility->getNewName4($_FILES['fileImage'], '',$quote_id);
			
			//upload in the server
			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName, 
								   '../images/custom_quote/',  200,  200, 
						           $quote_id,  'image', 'custom_quote_id', 'custom_quote');
								   
								  
		}
		
		//deleting the sessions
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('SU', 0, '', $_SERVER['PHP_SELF'], SUQUOTE001, 'SUCCESS');
	}
	
}//eof


/*START PAGINATION*/
$total = count($noOfQuote);

$pageArray = array_chunk($noOfQuote, $numResDisplay);


$newPage = array();
$name = "Page";
$numPages = ceil($total/$numResDisplay);

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


if($total == 0)
{
	$total = (int)$total;
}

$link= $link."&Page=".$myPage;



//cancel
if(isset($_POST['btnCancel']))
{
	//registering the post session variables
	$sess_arr	= array('selCusId', 'selProdId', 'selMaterialId', 'txtColor', 'intQuant', 'txtSizeA', 'txtSizeB', 
						'txtSizeC', 'txtSizeD', 'selEmbroideryId', 'txtDesc', 'txtName', 'txtEmail', 'txtPhone');
	
	$utility->delSessArr($sess_arr);
	
	header("Location: ".$_SERVER['PHP_SELF']);
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Custom Quote</title>

<!-- Style -->
<link rel="stylesheet" type="text/css" href="../style/admin.css" />
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg.js"></script> 
<script language="JavaScript" type="text/javascript" src="js/openwysiwyg/scripts/wysiwyg-settings.js"></script> 
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
                	<h1>Custom Quote</h1>
                    
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
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_quote#addQuote"; ?>">
                      Add Custom Quote 
                      </a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                 <table class="single-column" cellpadding="0" cellspacing="0">
                     <?php 
                    $noOfQuote = $custom_quote->getCustomQuoteIds();
                    if(count($noOfQuote) == 0)
                    {
                    ?>
                    <thead align="left" class="orangeLetter">
                      <th> <?php echo ERQUOTE000; ?> </th>
                     </thead>
                    <?php 
                    }
                    else
                    {
                    ?>  
                     
                    <thead>
                      <th width="5%">#</th>
                      <th width="15%">Customer Name</th>
                      <th width="10%">Product</th>
                      <th width="9%">Size A</th>
                      <th width="9%">Size B</th>
                      <th width="9%">Size C</th>
                      <th width="9%">Size D</th>
                      <th width="9%">Image</th>
                      <th width="10%">Added On </th>
                      <th width="10%">Action</th>
                    </thead>
                    <?php 
					$i	= $page->getSerialNum($numResDisplay);
						
						foreach($pageArray[$pageNumber] as $j => $value)
						{
                            $k 			= $pageArray[$pageNumber][$j];
							
                            $quoteDtl = $custom_quote->getCustomQuoteData($k);
							
                            $bgColor 	= $utility->getRowColor($i);
                    ?>
                        <tr align="center" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
                        
                          <td><?php echo $i++; ?></td>
                          <td>
						  <?php 
						  	$cusName	= $utility->getValueByKey($quoteDtl[0],'customer_id','fname','customer');
						  	echo $cusName; 
						  ?>
                          </td>
                          <td><?php echo $quoteDtl[1]; ?></td> 
                          <td><?php echo $quoteDtl[5]; ?></td> 
                          <td><?php echo $quoteDtl[6]; ?></td> 
                          <td><?php echo $quoteDtl[7]; ?></td> 
                          <td><?php echo $quoteDtl[8]; ?></td>  
                          <td>
                          	<?php 
                                if(($quoteDtl[13] != '') && ( file_exists("../images/custom_quote/".$quoteDtl[13])) )
                                {
                                    echo $utility->imageDisplay2('../images/custom_quote/', $quoteDtl[13], 100, 100, 0, '', 'Custom Image');
                                                
                                }
                                ?>
                          </td> 
                          <td><?php echo $dateUtil->printDate($quoteDtl[11]); ?></td>
                          <td>
                          [ 
                            <a href="#" onClick="MM_openBrWindow('custom_quote_edit.php?action=edit_custom_quote&id=<?php echo $k; ?>','CustomQuoteEdit','scrollbars=yes,width=750,height=600')">
                          edit
                            </a> ]	
                         
                          [ 
                            <a href="#" onClick="MM_openBrWindow('custom_quote_delete.php?action=delete_custom_quote&id=<?php echo $k; ?>','CustomQuoteDelete','scrollbars=yes,width=400,height=350')">
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
                            <div class="upper-block">Total Number of Custom Quote: <?php echo count($noOfQuote);?></div>
                            <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div>
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
                    if( (isset($_GET['action'])) && ($_GET['action'] == 'add_quote') )
                    {	
                    ?>
                     <h2><a name="addQuote">Add New Custom Quote</a></h2>
                     <span>Please note that all the <span class="required">*</span> marked fileds are required</span>       
                     
                     <!-- Form -->
                     <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                      
                        
                            
                        <label>Model<span class="required">*</span></label>				
                        <select name="selProdId" class=" textBoxA" id="selProdId">
                        <option value="">-- Select --</option>
							<?php
                            if(isset($_SESSION['selProdId']))
                            {
                                $utility->populateDropDown($_SESSION['selProdId'], 'product_id',
                                                           'product_name', 'product_description');
                            }
                            elseif(isset($_GET['selProdId']) && ((int)$_GET['selProdId'] > 0))
                            {
                                $utility->populateDropDown($_GET['selProdId'], 'product_id',
                                                           'product_name', 'product_description');
                            }
                            else
                            {
                                $utility->populateDropDown(0, 'product_id', 'product_name', 'product_description');
                            }
                            ?>
                        </select>
                        <div class="cl"></div>
                        
                        
                        <label>Select Material<span class="orangeLetter">*</span></label>
                                    
                        <select name="selMaterialId" class=" textBoxA" id="selMaterialId">
                        <option value="">-- Select --</option>
							<?php
                            if(isset($_SESSION['selMaterialId']))
                            {
                                $utility->populateDropDown($_SESSION['selMaterialId'], 'material_id',
                                                           'title', 'material');
                            }
                            elseif(isset($_GET['selMaterialId']) && ((int)$_GET['selMaterialId'] > 0))
                            {
                                $utility->populateDropDown($_GET['selMaterialId'], 'material_id',
                                                           'title', 'material');
                            }
                            else
                            {
                                $utility->populateDropDown(0, 'material_id', 'title', 'material');
                            }
                            ?>
                        </select>
                        <div class="cl"></div>
                                          
                       
                        <label>Color<span class="orangeLetter">*</span></label>
                        <input type="text" name="txtColor" id="txtColor" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtColor',''); ?>"  />
                        <div class="cl"></div>
                       
                    
                        <label>Quantity<span class="orangeLetter">*</span></label>
                        <input type="text" name="intQuant" id="intQuant" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('intQuant',''); ?>"  />
                        <div class="cl"></div>
                    
                        <label>Size A<span class="orangeLetter">*</span></label>
                        <input type="text" name="txtSizeA" id="txtSizeA" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtSizeA',''); ?>"  />
                        <div class="cl"></div>
                    
                        <label>Size B<span class="orangeLetter">*</span></label>
                        <input type="text" name="txtSizeB" id="txtSizeB" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtSizeB',''); ?>"  />
                        <div class="cl"></div>
                   
                    
                        <label>Size C<span class="orangeLetter">*</span></label>
                        <input type="text" name="txtSizeC" id="txtSizeC" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtSizeC',''); ?>"  />
                        <div class="cl"></div>
                    
                    
                        <label>Size D<span class="orangeLetter">*</span></label>
                        <input type="text" name="txtSizeD" id="txtSizeD" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtSizeD',''); ?>"  />
                        <div class="cl"></div>
                        
                        
                        <label>Upload Your Design</label>
                        <input type="file" name="fileImage" id="fileImage" class="text-field" />
                        <span class="orangeLetter">* ( 200 pixels &times; 200 pixels) </span>	
                        <div class="cl"></div>
                                   
                            
                                
                   		<h4>Additional Information (if any)</h4> 
                    
                    
                        <label>Select Embroidery</label>
                        
                        <select name="selEmbroideryId" class=" textBoxA" id="selEmbroideryId">
                        <option value="0">-- Select --</option>
                        <?php
                        if(isset($_SESSION['selEmbroideryId']))
                        {
                            $utility->populateDropDown($_SESSION['selEmbroideryId'], 'embroidery_id',
                                                       'title', 'embroidery');
                        }
                        elseif(isset($_GET['selEmbroideryId']) && ((int)$_GET['selEmbroideryId'] > 0))
                        {
                            $utility->populateDropDown($_GET['selEmbroideryId'], 'embroidery_id',
                                                       'title', 'embroidery');
                        }
                        else
                        {
                            $utility->populateDropDown(0, 'embroidery_id', 'title', 'embroidery');
                        }
                        ?>
                        </select>
                        <div class="cl"></div>
                                                           
                  
                        <label>Additional Comment</label>
                        <textarea name="txtDesc"  id="txtDesc" cols="30" rows="4">
                        <?php $utility->printSess('txtDesc'); ?></textarea>
                        <script language="JavaScript">
                          WYSIWYG.attach('txtDesc', full);
                        </script>
                        <div class="cl"></div>
                    
                    
                    	<h2>Contact Information</h2> 
                   
                    
                        <label>Name<span class="orangeLetter">*</span></label>
                        <input type="text" name="txtName" id="txtName" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtName',''); ?>"  />
                        <div class="cl"></div>
                       
                    
                        <label>Email<span class="orangeLetter">*</span></label>
                        <input type="email" name="txtEmail" id="txtEmail" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtEmail',''); ?>"  />
                        <div class="cl"></div>
                       
                    
                        <label>Phone</label>
                        <input type="text" name="txtPhone" id="txtPhone" class="text-field" 
                        autocomplete="off" value="<?php $utility->printSess2('txtPhone',''); ?>"  />
                        <div class="cl"></div>
                       
                        <label>&nbsp;</label>
                        <input name="btnAddQuote" type="submit" class="buttonYellow" id="btnAddQuote" value="add" />
                        
                        <input name="btnCancel" type="submit" class="buttonYellow" value="cancel" />					
                        
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