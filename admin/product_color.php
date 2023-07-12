<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php");

require_once("../includes/constant.inc.php");
require_once("../includes/content.inc.php"); 
require_once("../includes/user.inc.php");
require_once("../includes/product.inc.php");
 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/product.class.php");

require_once("../classes/error.class.php");  
require_once("../classes/date.class.php"); 
require_once("../classes/utility.class.php");
require_once("../classes/utilityNum.class.php");
require_once("../classes/utilityMesg.class.php"); 
require_once("../classes/utilityImage.class.php");
require_once("../classes/utilityCurl.class.php");

//instantiate classes
$adminLogin 	= new adminLogin();
$product		= new Product();

$dateUtil      	= new DateUtil();
$error 			= new Error();
$utility		= new Utility();
$uNum			= new NumUtility();
$uMesg 			= new MesgUtility();
$uImg 			= new ImageUtility();
$uCurl 			= new CurlUtility();


###############################################################################################

//declare vars
$sDatail	= array();
$productId			= $utility->returnGetVar('pid', 0);
$proColorIds 		= $product->getAllProductColorIdByProductId($productId);

$typeM				= $utility->returnGetVar('typeM','');

//geting product data
$productDetail		 = $product->showProduct($productId);


//add new content
if(isset($_POST['btnAddVenRev'])) 
{
	
	$txtColorHexCode				= $_POST['txtColorHexCode'];
	$txtColorName					= $_POST['txtColorName'];
	

	//registering the post session variables
	$sess_arr	= array('txtColorHexCode', 'txtColorName');
	
	$utility->addPostSessArr($sess_arr);

	
	//defining error variables
	$action		= 'add_prodColor';
	$url		= $_SERVER['PHP_SELF'];
	$id			= $productId;
	$id_var		= 'pid';
	$anchor		= 'addProdColor';
	$typeM		= 'ERROR';
	
	
	
		
	if($txtColorName == '')
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERPRCO002, $typeM, $anchor);
	}
	/*elseif(strlen($txtColorHexCode) > 7 || (strlen($txtColorHexCode) < 7 ))
	{ 
		$error->showErrorTA($action, $id, $id_var, $url, ERPRCO003, $typeM, $anchor);
	}*/
	else
	{
		//add offer
		$proColId = $product->addProductColor($productId,  $txtColorName, $txtColorHexCode);
		
		
		if($_FILES['fileImage']['name'] != '')
		{
			$newName2 = $utility->getNewName4($_FILES['fileImage'], 'IMAGE', $proColId);
				
			$uImg->imgUpdResize($_FILES['fileImage'], '', $newName2, 
								'../images/upload/product_color/', 800, 800, $proColId,
					 			'product_image', 'product_color_id', 'product_color');	   
		}
		
		
		$utility->delSessArr($sess_arr);
		
		
		//forward
		$uMesg->showSuccessT('success', $id, $id_var, $url, SUPRCO001, 'SUCCESS');
		
	}
	
}//eof


//cancel button
if(isset($_POST['btnCancel']))
{
	//registering session
	$sess_arr	= array('txtColorHexCode', 'txtColorName');
	
	$utility->delSessArr($sess_arr);
		
	//refresh header
	header("Location: ".$_SERVER['PHP_SELF']."?id=".$_GET['id']);
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

<!-- include jQuery library -->
<script type="text/javascript" src="../js/jquery.min.js"></script>

<!-- include Cycle plugin -->
<script type="text/javascript" src="../js/jquery.cycle.all.js"></script>

<!--  initialize the slideshow when the DOM is ready -->
<script type="text/javascript">
$(document).ready(function() {
    $('.slideshow').cycle({
		fx: 'scrollLeft' // choose your transition type, ex: fade, scrollUp, shuffle, etc...
	});
});
</script>
<script type="text/javascript" src="js/animatedcollapse.js"></script>

<script type="text/javascript">
animatedcollapse.addDiv('Travel', 'fade=1,speed=1000,group=tour')
animatedcollapse.addDiv('Accommodations', 'fade=1,speed=1000,group=tour,hide=0')
animatedcollapse.addDiv('Car_Hire', 'fade=1,speed=1000,group=tour,hide=0')
animatedcollapse.ontoggle=function($, divobj, state){ //fires each time a DIV is expanded/contracted
	//$: Access to jQuery
	//divobj: DOM reference to DIV being expanded/ collapsed. Use "divobj.id" to get its ID
	//state: "block" or "none", depending on state
}
animatedcollapse.init()
</script>
<script language="javascript">
function changeMe2() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
    ele.style.display = "none";
	text.innerHTML = "show";
}
function changeMe() {
	var ele = document.getElementById("toggleText");
	var text = document.getElementById("displayText");
	ele.style.display = "block";
	text.innerHTML = "hide";
}
</script>



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
                	<h1>Product Color</h1>
                </div>
                
                <!-- Options -->
                <div id="options-area">
                	<div class="add-new-option">
                    	<a href="<?php echo $_SERVER['PHP_SELF']."?action=add_prodColor#addProdColor"; ?>">
				  		Add Product Color
				  		</a>
                    </div>
                </div>
                <!-- eof Options -->
                
                
                <!-- Display Data -->
                <div id="data-column">
                	
                    
                	<table class="single-column" cellpadding="0" cellspacing="0">
                
					<!-- SHOWING ALL CONTENT -->
					 <?php 
                     
                     //check number of rows
                     if(count($proColorIds) == 0)
                     {
                     ?>
                     <tr align="left" class="orangeLetter">
                      <td height="20" colspan="5"> <?php echo ERSPAN.ERPRCO001.ENDSPAN;?> </td> 
                     </tr>
                    <?php 
                    }
                    else
                    {
                    ?>  
                     
                    <thead>
                      <th width="8%">id</th>
                      <th width="15%">Color Name</th>
                      <th width="19%">Color Hex Code</th>
                      <th width="16%">Product Image </th>
                      <th width="23%">Added On </th>
                      <th width="19%">Action</th>
                    </thead>
                    <?php 
                        $i=1;
                        foreach($proColorIds as $m)
                        {
                            $proColDtl 		= $product->getProductColorData($m);
                            //$venDetail 		= $product->getVendorData($venRevDtl[0]);
                            //$productDetail 	= $product->getClientData($venRevDtl[1]);
                            $bgColor 		= $utility->getRowColor($i);					
                    ?>
                        <tr align="left" class="blackLarge" <?php $utility->printRowColor($bgColor);?>>
                          <td align="left" class="pad5 bdrR bdrB"><?php echo $i++; ?></td>
                          <td class="pad5 bdrR bdrB"><?php echo $proColDtl[1]; ?></td>
                          <td align="center" class="pad5 bdrR bdrB"><?php echo $proColDtl[2]; ?></td>
                          <td align="center" class="pad5 bdrR bdrB">
                          <?php 
                            if(($proColDtl[3] != '') && ( file_exists("../images/upload/product_color/".$proColDtl[3])) )
                            {
                                echo $utility->imageDisplay2('../images/upload/product_color/', $proColDtl[3], 75, 75, 0, '', $proColDtl[1]);
                                            
                            }
                            ?>
                          </td>
                          <td align="center" class="pad5 bdrR bdrB"><?php echo $proColDtl[4]; ?></td>
                          <td align="center" class="pad5 bdrB">
                         <?php /*?> [ 
                            <a href="javascript:void(0)" 
                          onClick="MM_openBrWindow('offer_view.php?action=offer_view&id=<?php echo $m; ?>','offerView','scrollbars=yes,width=700,height=600')">
                          view					  
                          </a> 
                          ]<?php */?>
                          
                          [ 
                            <a href="javascript:void(0)" 
                          onClick="MM_openBrWindow('product_color_edit.php?action=edit_proColor&amp;id=<?php echo $m; ?>','proColorEdit','scrollbars=yes,width=550,height=450')">
                          edit					  
                            </a> 
                          ]
                          
                            [ 
                            <a href="javascript:void(0)" 
                          onClick="MM_openBrWindow('product_color_del.php?action=delete&id=<?php echo $m; ?>','proColorDelete','scrollbars=yes,width=400,height=300')">
                          delete					  </a> ]
                                            
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
                            <div class="upper-block">Total Color: <?php echo count($proColorIds);?></div>
                           <?php /*?> <div class="lower-block"><?php $page->getPage($numPages, $link, $pageNumber, $pageArray);?></div><?php */?>
                        </div>
                   
                  </div>
                </div>
                <!-- eof Display Data -->
                
                <!-- Form -->
                <div class="webform-area">
                    <!-- show message -->
                    <?php $uMesg->dispMessage($typeM, '../images/icon/', 'blackLarge');?>
                    
                    <?php 
					if( (isset($_GET['action'])) && ($_GET['action'] == 'add_prodColor') )
			{	
					?>
                   
                        <h2><a name="addProdColor">Add Product Color</a></h2>
                        
                        <span>Please note that all the <span class="required">*</span> marked fileds are required</span>
                        
                          <form action="<?php $_SERVER['PHP_SELF'];?>" method="post" name="formChoice" 
                          enctype="multipart/form-data">
                          
                          
                          <label>Color Name  <span class="orangeLetter">*</span> </label>
                          <input name="txtColorName" type="text" class="text_box_large" id="txtColorName"
                          value="<?php $utility->printSess('txtColorName'); ?>" size="30" />
                          <div class="cl"></div>
                                 
                          <label>Color Hex Code </label>
                          <input name="txtColorHexCode" type="text" class="text_box_large" id="txtColorHexCode"
                          value="<?php $utility->printSess('txtColorHexCode'); ?>" size="30" />                     
                          Must be 7 Characaters Long)
                          <div class="cl"></div>
                                 
                          <label>Color Image </label>
                          <input name="fileImage" type="file" class="text_box_large" id="fileImage" />
                          <div class="cl"></div>
                                  
                          
                          <input name="btnAddVenRev" type="submit" class="buttonYellow" value="add" />
                          <input name="btnCancel" type="submit" class="buttonYellow" value="cancel" onclick="self.close()">	
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