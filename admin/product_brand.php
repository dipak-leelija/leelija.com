<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");
require_once("../includes/constant.inc.php");
require_once("../includes/product_brand.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/product_brand.class.php");
require_once("../classes/pagination.class.php");
 
require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");

//instantiate classes
$adminLogin 	= new adminLogin();
$brand			= new ProductBrand();
$page			= new Pagination();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();

###############################################################################################

//declare vars
$typeM		= $utility->returnGetVar('typeM','');
$numResDisplay	= (int)$utility->returnGetVar('numResDisplay',10);

if($numResDisplay == 0)
{
	$numResDisplay = 10;
}

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
	
	$noOfBrand 	= $brand->getBrandByKeyword($keyword);
	
}
else
{
	$link = '';
	
	$noOfBrand	= $brand->getProductBrandId();
}

if(isset($_POST['btnAddBrand'])) 
{
	$txtName		= $_POST['txtName'];
	$txtDesc 		= $_POST['txtDesc'];
	$txtURL			= $_POST['txtURL'];
	$image			= $_FILES['fileImg'];
	
	//registering the post session variables
	$sess_arr	= array('txtName', 'txtDesc','txtURL');
	$utility->addPostSessArr($sess_arr);
	
	//defining error variables
	$action		= 'add_product_brand';
	$url		= $_SERVER['PHP_SELF'];
	$id			= 0;
	$id_var		= '';
	$anchor		= 'addBrand';
	$typeM		= 'ERROR';
	
	
	//check the error
	if($txtName == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERBRANDCFA002, $typeM, $anchor);
	}
	/*elseif($_FILES['fileImg']['name'] == '')
	{
		$error->showErrorTA($action, $id, $id_var, $url, ERBRANDCFA005, $typeM, $anchor);
	}*/
	else
	{
		//add brand
		$brandId = $brand->addProductBrand($txtName, $txtDesc, $txtURL);
		
		
		
		//uploading images
		if($_FILES['fileImg']['name'] != '')
		{
			//rename the image
			$newName  = $utility->getNewName4($_FILES['fileImg'], '',  $brandId);
								
			//crop and resize
			$uImg-> fileUpload2($_FILES['fileImg'], '' , $newName, '../images/brands/', $brandId, 'logo', 'product_brand_id', 'product_brand');
					 
		}
		
		//deleting the sessions
		$sess_arr	= array('txtName','txtDesc','txtURL');
		$utility->delSessArr($sess_arr);
		
		//forward
		$uMesg->showSuccessT('success', 0, '', $_SERVER['PHP_SELF'], SUBRANDCFA001, 'SUCCESS');
	}
	
}//eof

/*START PAGINATION*/
$total = count($noOfBrand);

$pageArray = array_chunk($noOfBrand, $numResDisplay);

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

$arrayNum = explode("Array",$myPage);

$pageNumber = (int)$arrayNum[1];


if($total == 0)
{
	$total = (int)$total;
}

$link= $link."&Page=".$myPage;



//cancel button
if(isset($_POST['btnCancel']))
{
	//delete session
	$sess_arr	= array('txtName', 'txtDesc','txtURL');
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
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
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
                	<h1>Brand Management</h1>
                    
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
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_product_brand#addBrand"; ?>">Add New Brand</a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
						 <?php 
                        //$numBrand   = $brand->getProductBrandId();
                        if(count($noOfBrand) == 0)
                        {
                        ?>
                        <tr align="left" class="orangeLetter">
                          <td height="20" colspan="5"> <?php echo ERSPAN.ERBRANDCFA001.ENDSPAN;?> </td>
                         </tr>
                        <?php 
                        }
                        else
                        {
                        ?>  
                         
                        <thead>
                          <th width="3%">#</th>
                          <th width="22%">Title</th>
                          <th width="20%">Image</th>
                          <th width="24%">URL</th>
                          <th width="12%">Added On </th>
                          <th width="19%">Action</th>
                        </thead>
                        <?php 
						$i=1;
						foreach($noOfBrand as $k)
						{
							//get the brand detail
							$brandDtl 		= $brand->getProductBrandData($k);
							
							//get the row background color
							$bgColor 	= $utility->getRowColor($i);
						?>
						<tr <?php $utility->printRowColor($bgColor);?>>
						  <td><?php echo $i++; ?></td>
						  <td><?php echo $brandDtl[0]; ?></td>
						  <td>
							<?php 
							$utility->imgDisplay('../images/brands/', $brandDtl[3],  150, 60, 0, 'greyBorder', $brandDtl[0], " ");
							?>
						  </td>
						  <td>
							<?php 
								echo "<a href='".$brandDtl[2]."' target='_blank' 
									 title='".$brandDtl[0]."'>".$brandDtl[2]."</a>"; 
							?>
						  </td>
						  <td>
							<?php echo $dateUtil->printDate($brandDtl[4]); ?>
						  </td>
						  <td>
						  [ 
							<a href="#" 
						  onClick="MM_openBrWindow('product_brand_edit.php?action=edit&amp;id=<?php echo $k; ?>','ProductBrandEdit','scrollbars=yes,width=650,height=500')">
						  edit					  </a> ]
						 [ 
							<a href="#" 
						  onClick="MM_openBrWindow('product_brand_delete.php?action=delete&amp;id=<?php echo $k; ?>','ProductBrandDelete','scrollbars=yes,width=450,height=300')">
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
                            <div class="upper-block">Total Product Brand: <?php echo count($noOfBrand);?></div>
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
					if( (isset($_GET['action'])) && ($_GET['action'] == 'add_product_brand') )
					{	
					?>
                   
                        <h2><a name="addBrand">Add Brand</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="post" enctype="multipart/form-data">
                            
                            <label> Title <span class="orangeLetter">*</span></label>
                            <input name="txtName" type="text" id="txtName" class="text_box_large"
                            value="<?php  $utility->printSess('txtName'); ?>" />
                            <div class="cl"></div>
                                 
                            <label>Description</label>
                            <textarea  name="txtDesc" cols="30" rows="5" id="txtDesc" class="textAr">
                            <?php  $utility->printSess('txtDesc'); ?>
                            </textarea>
                            <div class="cl"></div>
                            
                            
                            <label>URL</label>
                            <input name="txtURL" type="text" id="txtURL" class="text_box_large"
                            value="<?php  $utility->printSess2('txtURL', "http://");?>" />
                            <div class="cl"></div>
                            
                            <label>Brand Image</label>
                            <input name="fileImg" type="file" id="fileImg" class="text_box_large" />
                            <div class="cl"></div>
                            
                            <input name="btnAddBrand" id="btnAddBrand" type="submit" class="buttonYellow" value="add" />
                            <input name="btnCancel" id="btnCancel" type="submit" class="buttonYellow" value="cancel" />
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