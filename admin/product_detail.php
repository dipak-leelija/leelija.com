<?php 
session_start();
include_once('checkSession.php');
require_once("../_config/connect.php"); 
require_once("../classes/adminLogin.class.php"); 
require_once("../classes/date.class.php"); 
require_once("../includes/constant.inc.php"); 
require_once("../classes/error.class.php"); 
require_once("../classes/category.class.php"); 
require_once("../classes/utility.class.php"); 
require_once("../classes/product.class.php"); 
require_once("../classes/tax.class.php"); 

/* INSTANTIATING CLASSES */
$adminLogin 	= new adminLogin();
$dateUtil      	= new DateUtil();
$error 			= new Error();
$category		= new Cat();
$utility		= new Utility();
$product		= new Product();
$tax			= new Tax();

if(isset($_GET['id']))
{
	$pid = $_GET['id'];
}

?>

<title><?php echo COMPANY_S; ?> -  - Product Detail</title>
<link href="../style/admin/style.css" rel="stylesheet" type="text/css">
<link href="../style/admin/admin.css" rel="stylesheet" type="text/css">

</head>

<table style="border:1px solid #CC0000 " align="center" width="600">
			
			
			<?php 
	
			if(isset($_GET['action']))
			{
				if($_GET['action'] == 'view_prod')
				{
					
					$prodDetail = $product->showProduct($pid);
					$prodImgDetail = $product->showProdImg($pid);
			?>
			<tr class='maroonError'>
			  <td height="25" align='left' bgcolor="#EEEEEE"><strong>View Product :: </strong></td>
			</tr>
            <tr>
              <td>
			 
			  	<table width="100%"  border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td width="22%" align="left" class="menuText"><!-- Category --> Product Name </td>
					<td width="46%" align="left">
					  <?php echo $prodDetail[1]; ?>
				     </td>
				    <td width="32%" rowspan="5" align="center" valign="top">
					<?php 
						if(($prodImgDetail[2] != '') || ($prodImgDetail[2] != NULL) && (file_exists("../images/category/products/".$prodImgDetail[2])))
						{
						  echo "&nbsp;<img src='../images/category/products/".$prodImgDetail[2]."' height='100' width='100'>";
						}
					?>
					
					</td>
				  </tr>
				  <tr>
				    <td align="left" class="menuText">Product Quantity </td>
				    <td height="25" align="left" class="bodyText">
					<?php echo $prodDetail[12]; ?>
				     </td>
			      </tr>
				  <tr>
				    <td align="left" class="menuText">Price</td><!--  -->
				    <td height="25" align="left" class="bodyText">
					<?php echo $product->priceFormat($prodDetail[14]);?>
                     </td>
			      </tr>
				  
				  <tr>
				    <td align="left" class="menuText">&nbsp;</td>
				    <td height="25" align="left" class="bodyText">&nbsp;</td>
					</tr>
				  <tr>
				    <td align="left" valign="top" class="menuText">Product Description </td>
				    <td height="20" colspan="2" align="left" class="bodyText">
					<?php echo $prodDetail[1]; ?>
					</td>
			      </tr>
				 
				  <tr>
				    <td align="left" class="menuText">&nbsp;</td>
				    <td height="25" colspan="2" align="left">&nbsp;</td>
				    </tr>
				  <tr bgcolor="#F3F3F3">
				    <td height="25" colspan="3" align="left" class="blackSmall">Special price or discount </td>
				    </tr>
					
				 
				  <tr bgcolor="#F3F3F3">
                    <td align="left" class="menuText">Special Price </td>
                    <td height="25" colspan="2" align="left" class="bodyText">
					
					   <?php if(isset($spclDetail[1]) > 0){echo $spclDetail[1];} else {echo "No Special Price Given";} ?>
					
					  </td>
				    </tr>
				  <tr bgcolor="#F3F3F3">
				    <td align="left" bgcolor="#F3F3F3" class="menuText">Expire Date </td>
				    <td height="25" colspan="2" align="left" class="bodyText">
					<?php if(isset($spclDetail[4]) != ''){echo $spclDetail[4];} else {echo "No Special Price Given to expire";} ?>
					</td>
				    </tr>
				  <tr bgcolor="#F3F3F3">
				    <td align="left" class="menuText">&nbsp;</td>
				    <td height="25" colspan="2" align="left" class="bodyText">&nbsp;</td>
				    </tr>
				  <tr>
				    <td class="menuText">&nbsp;</td>
				    <td height="25" colspan="2" align="left">
					<input name="btnCancel" type="button" class="buttonStyle_1" id="btnCancel" onClick="self.close()" value="close">
					</td>
				    </tr>
				  <tr>
				    <td>&nbsp;</td>
				    <td colspan="2">&nbsp;</td>
				    </tr>
				</table>


			  </td>
            </tr>
			<?php }
			}
			?>
</table>