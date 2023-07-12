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
require_once("../classes/tax.class.php");


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
$tax			= new Tax();

$utility		= new Utility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uNum 			= new NumUtility();

######################################################################################################################

//declare vars
$typeM			= $utility->returnGetVar('typeM','');

//no of products
$pids = $product->getAllProdId('product_name','ASC');


$total = (int)count($pids);

if(isset($_POST['btnUpdate']))
{
	$newPrice = array();
	foreach($pids as $k)
	{
		
		$newPrice[$k] = $_POST['newPrice'.$k];
		if($newPrice[$k] != '')
		{
			$utility->updateField($k, 'product_id', $newPrice[$k], 'product_price', 'products','YES','pdate_modified');
		}
	}
	//header("Location:".$_SERVER['PHP_SELF']."?msg=Product(s) price(s) changed");
	$uMesg->showSuccessT('success', 0 , '', $_SERVER['PHP_SELF'], 'Product(s) price(s) changed', 'SUCCESS');
}


//cancel
if(isset($_POST['btnCancel']))
{
	//forward
	header("Location: product.php");
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo COMPANY_S; ?> - Price Update</title>

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
                	<h1>Price Update</h1>
                </div>
                <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                <!-- Display Data -->
                <div id="data-column">
                	
                    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
                		<table class="single-column" cellpadding="0" cellspacing="0">
                
					<?php 
					if(count($pids) == 0)
					{
					?>
                    <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"> <?php echo ERSPAN.ERPROD002.ENDSPAN; ?> </td>
                    </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                    
                     <thead>
                      <th width="4%">#</th>
                      <th width="47%">Product Name </th>
                      <th width="12%">Added On</th>
                      <th width="12%">Ordered</th>
                      <th width="9%">Viewed</th>
                      <th width="9%">Old Price</th>
                      <th width="7%">New Price </th>
                    </thead>
                    
                    <?php 
				
					   $k = $page->getSerialNum(20);
						
					   foreach($pids as $x)
					   {
						 $prodDetail = $product->showProduct($x);
						 $bgColor 	 = $utility->getRowColor($k);
					?>
                    <tr align="left" <?php $utility->printRowColor($bgColor);?>>
					  <td align="left"><?php echo $k++; ?></td>
					  <td><?php echo $prodDetail[0]; ?></td>
					  <td><?php echo $dateUtil->printDate($prodDetail[4]); ?></td>
					  <td><?php if($prodDetail[9] == 0) {echo 'not ordered';}else{echo $prodDetail[9];} ?></td>
					  <td><?php if($prodDetail[2] == 0) {echo 'not viewed';}else{echo $prodDetail[2];} ?></td>
					  <td><?php echo $utility->priceFormat($prodDetail[3]); ?></td>
					  <td>
					  	<input name="newPrice<?php echo $x; ?>" type="text" class="text_box_large" id="newPrice" size="10" maxlength="12">
                      </td>
				    </tr>
				  <?php 	
                        }//else
                    }//eof
                    
                  ?>
				    </table>
				    <input name="btnUpdate" type="submit" class="button-add" id="btnUpdate" value="update" />
				    <input name="btnCancel" type="submit" class="button-cancel" value="cancel" />
				 	
                  </form>
                  
                  
                  <div class="first-column">
                 
                    	<!-- Bottom Pagination-->
                        <div class="pagination-bottom">
                            <div class="upper-block">Total Product: <?php echo count($pids);?></div>
                           <?php /*?> <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div><?php */?>
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                
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