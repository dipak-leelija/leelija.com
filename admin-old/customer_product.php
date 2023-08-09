<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 

require_once("../includes/constant.inc.php");
require_once("../includes/product.inc.php");

require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php");  
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/product.class.php"); 
require_once("../classes/search.class.php");
require_once("../classes/pagination.class.php");
require_once("../classes/customer.class.php");

require_once("../classes/utility.class.php"); 
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityNum.class.php");

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();
$product		= new Product();
$search_obj		= new Search();
$page			= new Pagination();
$customer		= new Customer();


$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');
$cusId			= $utility->returnGetVar('cus_id',0);
$keyword		= $utility->returnGetVar('keyword','');
$type			= $utility->returnGetVar('type','');
$mode			= $utility->returnGetVar('mode','');

$cusDtl			= $customer->getCustomerData($cusId);

//NO OF PRODUCTS
if((isset($_GET['btnSearch'])) &&($_GET['btnSearch'] == 'search'))
{
	$link = "&btnSearch=search&keyword=".$_GET['keyword']."&mode=&type=".$_GET['type'];
	$pids = $search_obj->getProductKeyword($keyword);
	
}
else
{
	$link = '';
	$pids = $product->getProdToCusIdByCus($cusId);
}
/*	GET ALL PRODUCT*/
//print_r($pids);exit;


/*START PAGINATION*/
$total = count($pids);
$pageArray = array_chunk($pids, 10);


$newPage = array();
$name = "Page";
$numPages = ceil($total/10);

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
//echo "Page Number = ".$pageNumber."<br>";

if($total == 0)
{
	$total = (int)$total;
}

//add a product
if(isset($_POST['btnAddProd']))
{	
	$cusId	= $utility->returnGetVar('cusId', 0);
	//defining error variables
	$action		= 'add_prod';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $cusId;
	$id_var		= 'cus_id';
	$anchor		= 'addProd';
	$typeM		= 'ERROR';
	

	
	$txtProdId		= array();
	if(isset($_POST['prodCheck']))
	{
		$txtProdId		= $_POST['prodCheck'];
	}
	
	if(count($txtProdId) > 0)
	{
		foreach($txtProdId as $p)
		{
			$pCusId		= $product->addProdToCust($p, $id, 0, '0000-00-00', '0000-00-00', 2013, 0.0000, 1);
			//forward the web page
			$uMesg->showSuccessT('success', $id, $id_var, $url, SUPROD001, 'SUCCESS');
		}
	}
	else
	{
		$error->showErrorTA($action, $id, $id_var, $url, "Select at least one product", $typeM, $anchor);
	}
	
}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Customer Product Management</title>
<!-- Style -->
<link href="../style/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.css?random=20051112" media="screen">
</link>
<!-- eof Style -->

<!-- Javascript Libraries -->
<script language="JavaScript" type="text/javascript" src="../js/openwysiwyg/wysiwyg.js"></script> 
<script type="text/javascript" 
src="../js/js_calendar/dhtmlgoodies_calendar/dhtmlgoodies_calendar.js?random=20051112"></script>

<script type="text/javascript" src="../js/ajax.js"></script>
<script type="text/javascript" src="../js/utility.js"></script>
<script type="text/javascript" src="../js/advertiser.js"></script>
<script type="text/javascript" src="../js/location.js"></script>
<script type="text/javascript" src="../js/checkEmpty.js"></script>
<script type="text/javascript" src="../js/email.js"></script>
<script type="text/javascript" src="../js/static.js"></script>
<script type="text/javascript" src="../js/product.js"></script>
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
                	<h1>Products - <?php echo $cusDtl[5]." ".$cusDtl[6] ?></h1>
                    
                    <div id="search-page-back">
                    	<?php /*?><form name="formSampleSearch" method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        	<input name="keyword" type="text" class="search-text" id="keyword" placeholder="Keyword.." results="5"
                          	value="<?php $utility->printGet('keyword');?>" />
                            
                            <div class="search-option">
                            
                            </div>
                            <input name="mode" type="hidden" value="product">
                            <input name="type" type="hidden" value="name">
                            <input name="btnSearch" type="submit" class="search-button" id="btnSearch" value="search">
                        </form><?php */?>
                    </div>
                   <div class="cl"></div> 
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
           	    <a href="<?php echo $_SERVER['PHP_SELF']."?cus_id=".$cusId."&action=add_prod"; ?>">
                            Add New Product
                        </a> 
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
					if(count($pids) == 0)
					{
					?>
                    <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5">  <?php echo ERSPAN.ERPROD002.ENDSPAN; ?> </td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                    <thead>
                      <th width="3%" height="25"  align="center">#</th>
                      <th width="20%" >Product Name </th>
                      <th width="20%" >Category</th>
                      <th width="20%"  align="center"> Photo</th> 
                      <th width="11%"  align="center">Viewed</th>
                      <th width="11%" >Added On </th>
                      <th width="15%" align="center">Action</th>
                   </thead>
					<?php
                        
                       $k = $page->getSerialNum(20);
                             
                        foreach($pageArray[$pageNumber] as $j => $value)
                            {
							$x = $pageArray[$pageNumber][$j];
							$prodId		= $utility->getSingleValueByKey($x, 'product_to_customer_id', 'product_id', 'product_to_customer', '');
							
							$prodDetail = $product->showProduct($prodId);
							//print_r($prodDetail);exit;
							$bgColor 	= $utility->getRowColor($k);	
                    ?>
                      <tr align="left"<?php $utility->printRowColor($bgColor);?>>
					  <td align="left"><?php echo $k++; ?></td>
					  <td><?php echo $prodDetail[1]; ?></td>
					  <td><?php echo $utility->getSingleValueByKey($prodDetail[0], 'categories_id', 'categories_name', 'categories', ''); ?></td>
					  <td align="center">
					 	<?php 
						$imgId		= $product->getDefaultProdImg($prodId);
						if($imgId > 0)
						{
							$imgDtl		= $product->showProdImg($imgId);
							if(($imgDtl[2] != '') && ( file_exists("../images/product/".$imgDtl[2])) )
							{
								echo $utility->imageDisplay2('../images/product/', $imgDtl[2], 50, 50, 0, '', $imgDtl[0]);
	
							}
						}
						?>
                      </td>
					  <td><?php if($prodDetail[7] == 0) {echo 'not viewed';}else{echo $prodDetail[7];} ?></td>
					  <td><?php echo $dateUtil->printDate($prodDetail[11]); ?></td>
					  <td >
                      <?php 
					  $pCusId		= $product->getProdToCusIdByCusProd($cusId, $prodId);
					  
					  ?>
					<!--  [ 
					    <a href="#" 
					  onClick="MM_openBrWindow('customer_product_edit.php?action=edit_prod&pCusId=<?php echo $pCusId; ?>','ProdEdit','scrollbars=yes,width=600,height=500')">
					  edit					  </a> ]-->
					 
					  [ 
					  <a href="#" onClick="MM_openBrWindow('customer_product_delete.php?action=del_prod&pCusId=<?php echo $pCusId; ?>','ProdDelete','scrollbars=yes,width=400,height=350')">
					  delete					  </a> ]
                      [ 
					  <a href="#" onClick="MM_openBrWindow('customer_add_proDtl.php?action=add_dtl&pCusId=<?php echo $pCusId; ?>&pid=<?php echo $prodId ?>&cusId=<?php echo $cusId ?>','AddImg','scrollbars=yes,width=700,height=600')">
					  Add More					  </a> ]					  </td>
				    </tr>
                  <?php 
                       
                        }
                  }
                  ?>
                  
                  </table>
                  
                  <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <div class="upper-block">Total Product(s): <?php echo count($pids);?></div>
                            <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?>
                            </div>
                        </div>
                  	
                  </div>
                </div>
                <!-- eof Display Data -->
          <div class="webform-area" style="width:500px">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    <?php 
					if(isset($_GET['action']) && ($_GET['action'] == 'add_prod')) 
					{	
					?>
                   
                        <h2><a name="addUser">Add Product</a></h2>
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        <form action="<?php echo $_SERVER['PHP_SELF'] ?>?action=add_prod&cusId=<?php echo $cusId; ?>" method="post" enctype="multipart/form-data">
                        	
                            <?php 
							$catIds						= $category->getAllParentCat('added_on', 'ASC');
							if(count($catIds) > 0)
							{
								foreach($catIds as $c)
								{
									$catDtl				= $category->categoryData($c, 'categories');
									?>
                                    <h3><?php echo $catDtl[0]; ?></h3>
                                    
									<?php 
									$catPIds			= $product->getAllProdIdByCatId($c);
									if(count($catPIds) > 0)
									{
										foreach($catPIds as $cp)
										{
											$cpDtl		= $product->showProduct($cp);
											?>
                                            <div class="fl">
											<?php echo $cpDtl[1] ?>
                                            <br>
                                            <?php 
											$imgId		= $product->getDefaultProdImg($cp);
											if($imgId > 0)
											{
												$imgDtl		= $product->showProdImg($imgId);
												if(($imgDtl[2] != '') && ( file_exists("../images/product/".$imgDtl[2])) )
												{
													echo $utility->imageDisplay2('../images/product/', $imgDtl[2], 60, 60, 0, '', $imgDtl[0]);
						
												}
											}
											?>
                                            </div>
                                            <div class="prod-check">
        									<input type="checkbox" name="prodCheck[]" value="<?php echo $cp ?>" class="checkbox"   >
                                            </div>
        
											<?php 
										}
									}
									?><div class="cl"></div><?php 
								}
							}
							?>
                            <div class="cl"></div>  
                            <input name="btnAddProd" type="submit" class="button-add"  value="add" />
                           
                            <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
						</form>
                    <?php 
					}
					?>
                    
                </div>
                <div class="cl"></div>
                
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
